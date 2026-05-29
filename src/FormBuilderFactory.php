<?php

declare(strict_types=1);

namespace BagasTopati\FormBuilder;

use BagasTopati\UiCore\Builders\FormBuilder;
use Illuminate\Contracts\Container\Container;
use InvalidArgumentException;

class FormBuilderFactory
{
    public function __construct(private Container $app)
    {
    }

    public function fromArray(array $config): FormBuilder
    {
        $this->validateConfig($config);

        $action = $config['action'] ?? '/';
        $method = strtoupper($config['method'] ?? 'POST');

        $form = new FormBuilder($action, $method);

        // Apply form-level attributes
        if (!empty($config['attributes'])) {
            foreach ($config['attributes'] as $key => $value) {
                $form = $form->attr($key, $value);
            }
        }

        // Parse fields
        if (!empty($config['fields'])) {
            $this->parseFields($form, $config['fields']);
        }

        // Parse buttons
        if (!empty($config['buttons'])) {
            $this->parseButtons($form, $config['buttons']);
        }

        return $form;
    }

    public function fromJson(string $json): FormBuilder
    {
        try {
            $config = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new InvalidArgumentException('Invalid JSON configuration: ' . $e->getMessage());
        }

        if (!is_array($config)) {
            throw new InvalidArgumentException('JSON must decode to an array');
        }

        return $this->fromArray($config);
    }

    public function fromFile(string $path): FormBuilder
    {
        if (!file_exists($path)) {
            throw new InvalidArgumentException("Configuration file not found: {$path}");
        }

        $ext = pathinfo($path, PATHINFO_EXTENSION);

        return match ($ext) {
            'json' => $this->fromJson(file_get_contents($path)),
            'php' => $this->fromArray(require $path),
            default => throw new InvalidArgumentException("Unsupported file type: .{$ext}"),
        };
    }

    /**
     * Create FormBuilder from Laravel config
     *
     * This method retrieves form configuration from config/form-builder.php
     * and creates a FormBuilder instance (Cara 2 - Config approach).
     *
     * Usage:
     * ```php
     * $form = form_builder()->fromConfig('user_registration');
     *
     * // In controller
     * public function create()
     * {
     *     $form = form_builder()->fromConfig('user_registration');
     *     return view('forms.create', compact('form'));
     * }
     * ```
     *
     * @param string $formName The form name as defined in config/form-builder.php forms section
     * @return FormBuilder The FormBuilder instance
     *
     * @throws \InvalidArgumentException If form configuration is not found
     */
    public function fromConfig(string $formName): FormBuilder
    {
        $config = $this->app['config']->get("form-builder.forms.{$formName}");

        if (!$config) {
            throw new InvalidArgumentException(
                "Form configuration '{$formName}' not found in config/form-builder.php. " .
                "Available forms: " . implode(', ', array_keys($this->app['config']->get('form-builder.forms', [])))
            );
        }

        return $this->fromArray($config);
    }

    /**
     * Get all available form names from config
     *
     * Usage:
     * ```php
     * $formNames = form_builder()->getAvailableForms();
     * // Returns: ['user_registration', 'contact_form', 'product_form']
     * ```
     *
     * @return array List of all form names available in config
     */
    public function getAvailableForms(): array
    {
        return array_keys($this->app['config']->get('form-builder.forms', []));
    }

    /**
     * Check if a form configuration exists
     *
     * Usage:
     * ```php
     * if (form_builder()->hasForm('user_registration')) {
     *     // Form exists
     * }
     * ```
     *
     * @param string $formName The form name
     * @return bool True if form exists, false otherwise
     */
    public function hasForm(string $formName): bool
    {
        return !is_null($this->app['config']->get("form-builder.forms.{$formName}"));
    }

    protected function parseFields(FormBuilder $form, array $fieldsConfig): void
    {
        foreach ($fieldsConfig as $fieldConfig) {
            $this->parseField($form, $fieldConfig);
        }
    }

    protected function parseField(FormBuilder $form, array $fieldConfig): void
    {
        $type = $fieldConfig['type'] ?? 'text';
        $name = $fieldConfig['name'] ?? null;
        $label = $fieldConfig['label'] ?? null;

        if (!$name) {
            throw new InvalidArgumentException('Field must have a "name" property');
        }

        $attributes = $fieldConfig['attributes'] ?? [];
        $default = $fieldConfig['default'] ?? null;

        // Add HTML5 required attribute if field is required
        if (
            $this->app['config']['form-builder.validation.include_html5_validation'] &&
            !empty($fieldConfig['required'])
        ) {
            $attributes['required'] = true;
        }

        // Add placeholder if provided
        if (!empty($fieldConfig['placeholder'])) {
            $attributes['placeholder'] = $fieldConfig['placeholder'];
        }

        // Add validation attributes
        if (!empty($fieldConfig['validation'])) {
            $this->addValidationAttributes($attributes, $fieldConfig['validation']);
        }

        match ($type) {
            'text', 'email', 'password', 'number', 'tel', 'url', 'date', 'time', 'datetime', 'color', 'range', 'search', 'hidden'
            => $form->{$type}($name, $label, $attributes)->value($default),

            'textarea'
            => $form->textarea($name, $label, $attributes)->value($default),

            'select'
            => $this->parseSelectField($form, $fieldConfig),

            'checkbox'
            => $form->checkbox($name, $label, $attributes)->value($default ?? 1),

            'radio'
            => $this->parseRadioField($form, $fieldConfig),

            'file'
            => $form->file($name, $label, $attributes),

            'group'
            => $this->parseGroupField($form, $fieldConfig),

            'row'
            => $this->parseRowField($form, $fieldConfig),

            default => throw new InvalidArgumentException("Unsupported field type: {$type}"),
        };
    }

    protected function parseSelectField(FormBuilder $form, array $fieldConfig): void
    {
        $name = $fieldConfig['name'];
        $label = $fieldConfig['label'] ?? null;
        $options = $fieldConfig['options'] ?? [];
        $attributes = $fieldConfig['attributes'] ?? [];
        $default = $fieldConfig['default'] ?? null;

        if (isset($fieldConfig['placeholder'])) {
            $attributes['placeholder'] = $fieldConfig['placeholder'];
        }

        $select = $form->select($name, $options, $label, $attributes);

        if ($default !== null) {
            $select->value($default);
        }
    }

    protected function parseRadioField(FormBuilder $form, array $fieldConfig): void
    {
        $name = $fieldConfig['name'];
        $label = $fieldConfig['label'] ?? null;
        $options = $fieldConfig['options'] ?? [];
        $attributes = $fieldConfig['attributes'] ?? [];
        $default = $fieldConfig['default'] ?? null;

        $radio = $form->radio($name, $options, $label, $attributes);

        if ($default !== null) {
            $radio->value($default);
        }
    }

    protected function parseGroupField(FormBuilder $form, array $fieldConfig): void
    {
        $label = $fieldConfig['label'] ?? null;
        $fields = $fieldConfig['fields'] ?? [];
        $attributes = $fieldConfig['attributes'] ?? [];

        $form->group($label, $attributes);

        foreach ($fields as $nestedField) {
            $this->parseField($form, $nestedField);
        }
    }

    protected function parseRowField(FormBuilder $form, array $fieldConfig): void
    {
        $fields = $fieldConfig['fields'] ?? [];
        $form->row($fields);
    }

    protected function parseButtons(FormBuilder $form, array $buttonsConfig): void
    {
        foreach ($buttonsConfig as $buttonConfig) {
            $type = $buttonConfig['type'] ?? 'submit';
            $label = $buttonConfig['label'] ?? 'Submit';
            $attributes = $buttonConfig['attributes'] ?? [];

            match ($type) {
                'submit' => $form->submit($label, $attributes),
                'reset' => $form->reset($label, $attributes),
                'button' => $form->button($label, $attributes),
                default => throw new InvalidArgumentException("Unsupported button type: {$type}"),
            };
        }
    }

    protected function addValidationAttributes(array &$attributes, string $rules): void
    {
        // Parse Laravel validation rules and add HTML5 validation attributes
        $ruleArray = explode('|', $rules);

        foreach ($ruleArray as $rule) {
            $rule = trim($rule);

            if ($rule === 'required') {
                $attributes['required'] = true;
            } elseif (str_starts_with($rule, 'min:')) {
                $min = substr($rule, 4);
                $attributes['min'] = $min;
            } elseif (str_starts_with($rule, 'max:')) {
                $max = substr($rule, 4);
                $attributes['max'] = $max;
            } elseif (str_starts_with($rule, 'pattern:')) {
                $pattern = substr($rule, 8);
                $attributes['pattern'] = $pattern;
            }
        }
    }

    protected function validateConfig(array $config): void
    {
        if (empty($config['action'])) {
            throw new InvalidArgumentException('Form configuration must have an "action" property');
        }
    }
}
