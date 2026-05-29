<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\Rendering\Renderer;
use BagasTopati\UiCore\UI;

class FormBuilder implements Renderable
{
    protected string $action;
    protected string $method = 'POST';
    protected array $fields = [];
    protected array $formAttributes = [];
    protected array $extraClasses = [];
    protected bool $multipart = false;
    protected string $fieldWrapper = 'div';

    protected array $validationRules = [];
    protected array $validationMessages = [];

    public function __construct(string $action = '#', string $method = 'POST')
    {
        $this->action = $action;
        $this->method = $method;
    }

    public function post(): static
    {
        $this->method = 'POST';
        return $this;
    }

    public function get(): static
    {
        $this->method = 'GET';
        return $this;
    }

    public function put(): static
    {
        $this->method = 'PUT';
        return $this;
    }

    public function delete(): static
    {
        $this->method = 'DELETE';
        return $this;
    }

    public function patch(): static
    {
        $this->method = 'PATCH';
        return $this;
    }

    public function multipart(): static
    {
        $this->multipart = true;
        return $this;
    }

    public function attr(string $key, string|int|bool|null $value = true): static
    {
        $this->formAttributes[$key] = $value;
        return $this;
    }

    public function class(string|array $class): static
    {
        if (is_string($class)) {
            $class = array_filter(explode(' ', $class));
        }
        $this->extraClasses = array_merge($this->extraClasses, $class);
        return $this;
    }

    protected function addField(string $type, string $name, array $options = []): static
    {
        $this->fields[] = array_merge([
            'type' => $type,
            'name' => $name,
            'label' => $options['label'] ?? ucfirst(str_replace(['_', '-'], ' ', $name)),
            'value' => $options['value'] ?? null,
            'placeholder' => $options['placeholder'] ?? null,
            'attributes' => $options['attributes'] ?? [],
            'classes' => $options['classes'] ?? [],
            'id' => $options['id'] ?? $name,
        ], $options);

        return $this;
    }

    public function text(string $name, ?string $label = null, array $options = []): static
    {
        return $this->addField('text', $name, array_merge($options, ['label' => $label]));
    }

    public function email(string $name, ?string $label = null, array $options = []): static
    {
        return $this->addField('email', $name, array_merge($options, ['label' => $label]));
    }

    public function password(string $name, ?string $label = null, array $options = []): static
    {
        return $this->addField('password', $name, array_merge($options, ['label' => $label]));
    }

    public function number(string $name, ?string $label = null, array $options = []): static
    {
        return $this->addField('number', $name, array_merge($options, ['label' => $label]));
    }

    public function tel(string $name, ?string $label = null, array $options = []): static
    {
        return $this->addField('tel', $name, array_merge($options, ['label' => $label]));
    }

    public function url(string $name, ?string $label = null, array $options = []): static
    {
        return $this->addField('url', $name, array_merge($options, ['label' => $label]));
    }

    public function date(string $name, ?string $label = null, array $options = []): static
    {
        return $this->addField('date', $name, array_merge($options, ['label' => $label]));
    }

    public function time(string $name, ?string $label = null, array $options = []): static
    {
        return $this->addField('time', $name, array_merge($options, ['label' => $label]));
    }

    public function datetime(string $name, ?string $label = null, array $options = []): static
    {
        return $this->addField('datetime-local', $name, array_merge($options, ['label' => $label]));
    }

    public function color(string $name, ?string $label = null, array $options = []): static
    {
        return $this->addField('color', $name, array_merge($options, ['label' => $label]));
    }

    public function range(string $name, ?string $label = null, array $options = []): static
    {
        return $this->addField('range', $name, array_merge($options, ['label' => $label]));
    }

    public function search(string $name, ?string $label = null, array $options = []): static
    {
        return $this->addField('search', $name, array_merge($options, ['label' => $label]));
    }

    public function hidden(string $name, $value = null): static
    {
        return $this->addField('hidden', $name, ['value' => $value, 'label' => null]);
    }

    public function textarea(string $name, ?string $label = null, array $options = []): static
    {
        return $this->addField('textarea', $name, array_merge($options, [
            'label' => $label,
            'rows' => $options['rows'] ?? 4,
            'cols' => $options['cols'] ?? null,
        ]));
    }

    public function select(string $name, array $options_list, ?string $label = null, array $options = []): static
    {
        return $this->addField('select', $name, array_merge($options, [
            'label' => $label,
            'options_list' => $options_list,
            'selected' => $options['selected'] ?? null,
            'multiple' => $options['multiple'] ?? false,
            'placeholder' => $options['placeholder'] ?? '-- Pilih --',
        ]));
    }

    public function checkbox(string $name, ?string $label = null, array $options = []): static
    {
        return $this->addField('checkbox', $name, array_merge($options, [
            'label' => $label,
            'checked' => $options['checked'] ?? false,
            'checkbox_label' => $options['checkbox_label'] ?? $label ?? ucfirst($name),
        ]));
    }

    public function radio(string $name, array $radioOptions, ?string $label = null, array $options = []): static
    {
        return $this->addField('radio', $name, array_merge($options, [
            'label' => $label,
            'radio_options' => $radioOptions,
            'checked' => $options['checked'] ?? null,
        ]));
    }

    public function file(string $name, ?string $label = null, array $options = []): static
    {
        $this->multipart = true;
        return $this->addField('file', $name, array_merge($options, [
            'label' => $label,
            'accept' => $options['accept'] ?? null,
        ]));
    }

    public function submit(string $label = 'Submit', array $options = []): static
    {
        return $this->addField('submit', '_submit', array_merge($options, ['label' => $label]));
    }

    public function reset(string $label = 'Reset', array $options = []): static
    {
        return $this->addField('reset', '_reset', array_merge($options, ['label' => $label]));
    }

    public function button(string $label, string $type = 'button', array $options = []): static
    {
        return $this->addField('button', '_button', array_merge($options, ['label' => $label, 'button_type' => $type]));
    }

    public function group(string $label, array $fields): static
    {
        $this->fields[] = [
            'type' => 'group',
            'label' => $label,
            'fields' => $fields,
        ];
        return $this;
    }

    public function row(array $fields): static
    {
        $this->fields[] = [
            'type' => 'row',
            'fields' => $fields,
        ];
        return $this;
    }

    protected function normalizeField(array $field): array
    {
        $defaults = [
            'type' => 'text',
            'name' => '',
            'label' => ucfirst(str_replace(['_', '-'], ' ', $field['name'] ?? '')),
            'value' => null,
            'placeholder' => null,
            'attributes' => [],
            'classes' => [],
            'id' => $field['name'] ?? '',
        ];

        return array_merge($defaults, $field);
    }

    protected function renderField(array $field): string
    {
        if ($field['type'] === 'hidden') {
            $val = Renderer::escape((string)($field['value'] ?? ''));
            return "<input type='hidden' name='{$field['name']}' value='{$val}'>";
        }

        $fw = UI::framework();

        if ($field['type'] === 'submit' || $field['type'] === 'reset') {
            $btnClasses = array_merge(
                $field['type'] === 'submit' ? $fw->buttonPrimary() : $fw->buttonSecondary(),
                $fw->buttonSpacing(),
                $field['classes'] ?? []
            );
            return "<button type='{$field['type']}'" . Renderer::classes($btnClasses) . ">{$field['label']}</button>";
        }

        if ($field['type'] === 'button') {
            $btnClasses = array_merge($fw->button('secondary'), $fw->buttonSpacing(), $field['classes'] ?? []);
            $btnType = $field['button_type'] ?? 'button';
            return "<button type='{$btnType}'" . Renderer::classes($btnClasses) . ">{$field['label']}</button>";
        }

        $html = '';
        $label = $field['label'] ?? null;

        if ($field['type'] === 'group') {
            $html .= "<fieldset><legend>{$label}</legend>";
            foreach ($field['fields'] as $subField) {
                $html .= $this->renderField($this->normalizeField($subField));
            }
            $html .= "</fieldset>";
            return $html;
        }

        if ($field['type'] === 'row') {
            $rowClasses = $fw->formRow();
            $html .= "<div" . Renderer::classes($rowClasses) . ">";
            foreach ($field['fields'] as $subField) {
                $itemClasses = $fw->formRowItem();
                $html .= "<div" . Renderer::classes($itemClasses) . ">" . $this->renderField($this->normalizeField($subField)) . "</div>";
            }
            $html .= "</div>";
            return $html;
        }

        $groupClasses = $fw->formGroup();
        $html .= "<{$this->fieldWrapper}" . Renderer::classes($groupClasses) . ">";

        if ($label && $field['type'] !== 'checkbox') {
            $labelClasses = $fw->formLabel();
            $html .= "<label for='{$field['id']}'" . Renderer::classes($labelClasses) . ">{$label}</label>";
        }

        $html .= $this->renderInput($field);

        $html .= "</{$this->fieldWrapper}>";

        return $html;
    }

    protected function renderInput(array $field): string
    {
        $fw = UI::framework();
        $name = $field['name'];
        $id = $field['id'] ?? $name;
        $value = $field['value'] ?? null;
        $placeholder = $field['placeholder'] ?? null;
        $attrs = $field['attributes'] ?? [];
        $extraClasses = $field['classes'] ?? [];

        switch ($field['type']) {
            case 'textarea':
                $rows = $field['rows'] ?? 4;
                $content = $value !== null ? Renderer::escape((string)$value) : '';
                $inputClasses = array_merge($fw->formTextarea(), $extraClasses);
                $attrStr = Renderer::buildAttributes(
                    array_filter(['rows' => $rows, 'cols' => $field['cols'] ?? null, 'placeholder' => $placeholder] + $attrs),
                    $inputClasses
                );
                return "<textarea name='{$name}' id='{$id}'{$attrStr}>{$content}</textarea>";

            case 'select':
                $multiple = ($field['multiple'] ?? false) ? ' multiple' : '';
                $inputClasses = array_merge($fw->formSelect(), $extraClasses);
                $attrStr = Renderer::buildAttributes($attrs, $inputClasses);
                $html = "<select name='{$name}' id='{$id}'{$attrStr}{$multiple}>";

                if ($field['placeholder'] ?? null) {
                    $html .= "<option value='' disabled selected>{$field['placeholder']}</option>";
                }

                foreach ($field['options_list'] as $key => $label) {
                    if (is_array($label)) {
                        $html .= "<optgroup label='{$key}'>";
                        foreach ($label as $optVal => $optLabel) {
                            $selected = ($field['selected'] ?? null) == $optVal ? ' selected' : '';
                            $html .= "<option value='{$optVal}'{$selected}>{$optLabel}</option>";
                        }
                        $html .= "</optgroup>";
                    } else {
                        $selected = ($field['selected'] ?? null) == $key ? ' selected' : '';
                        $html .= "<option value='{$key}'{$selected}>{$label}</option>";
                    }
                }

                $html .= "</select>";
                return $html;

            case 'checkbox':
                $checked = ($field['checked'] ?? false) ? ' checked' : '';
                $cbLabel = $field['checkbox_label'] ?? '';
                $wrapperClasses = $fw->formCheckbox();
                $html = "<div" . Renderer::classes($wrapperClasses) . ">";
                $html .= "<label>";
                $html .= "<input type='checkbox' name='{$name}' id='{$id}'{$checked}> {$cbLabel}";
                $html .= "</label>";
                $html .= "</div>";
                return $html;

            case 'radio':
                $html = '';
                $radioOptions = $field['radio_options'] ?? [];
                $checked = $field['checked'] ?? null;
                $wrapperClasses = $fw->formRadio();
                $html .= "<div" . Renderer::classes($wrapperClasses) . ">";
                $idx = 0;
                foreach ($radioOptions as $key => $label) {
                    $isChecked = $checked == $key ? ' checked' : '';
                    $radioId = "{$id}_{$idx}";
                    $html .= "<label><input type='radio' name='{$name}' id='{$radioId}' value='{$key}'{$isChecked}> {$label}</label> ";
                    $idx++;
                }
                $html .= "</div>";
                return $html;

            case 'file':
                $accept = $field['accept'] ?? null;
                $inputClasses = array_merge($fw->formInput(), $extraClasses);
                $attrStr = Renderer::buildAttributes(
                    array_filter(['accept' => $accept] + $attrs),
                    $inputClasses
                );
                return "<input type='file' name='{$name}' id='{$id}'{$attrStr}>";

            default:
                $inputClasses = array_merge($fw->formInput(), $extraClasses);
                $inputAttrs = array_filter(['placeholder' => $placeholder, 'value' => $value] + $attrs);
                $attrStr = Renderer::buildAttributes($inputAttrs, $inputClasses);
                return "<input type='{$field['type']}' name='{$name}' id='{$id}'{$attrStr}>";
        }
    }

    public function render(): string
    {
        $fw = UI::framework();

        $formAttrs = array_merge([
            'action' => $this->action,
            'method' => $this->method === 'GET' ? 'GET' : 'POST',
        ], $this->formAttributes);

        if ($this->multipart) {
            $formAttrs['enctype'] = 'multipart/form-data';
        }

        $html = "<form" . Renderer::buildAttributes($formAttrs, $this->extraClasses) . ">";

        if (!in_array($this->method, ['GET', 'POST'])) {
            $html .= "<input type='hidden' name='_method' value='{$this->method}'>";
        }

        foreach ($this->fields as $field) {
            $html .= $this->renderField($field);
        }

        $html .= "</form>";

        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }

    public static function fromArray(array $config): static
    {
        if (!isset($config['action'])) {
            throw new \InvalidArgumentException('Form configuration must have an "action" property');
        }

        $action = $config['action'];
        $method = strtoupper($config['method'] ?? 'POST');

        $form = new static($action, $method);

        if (!empty($config['attributes'])) {
            foreach ($config['attributes'] as $key => $value) {
                $form->attr($key, (string)$value);
            }
        }

        if (!empty($config['fields'])) {
            foreach ($config['fields'] as $fieldConfig) {
                $form->parseFieldConfig($fieldConfig);
            }
        }

        if (!empty($config['buttons'])) {
            foreach ($config['buttons'] as $buttonConfig) {
                $form->parseButtonConfig($buttonConfig);
            }
        }

        return $form;
    }

    public static function fromJson(string $json): static
    {
        try {
            $config = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new \InvalidArgumentException('Invalid JSON configuration: ' . $e->getMessage());
        }

        if (!is_array($config)) {
            throw new \InvalidArgumentException('JSON must decode to an array');
        }

        return static::fromArray($config);
    }

    public function toArray(): array
    {
        return [
            'action' => $this->action,
            'method' => $this->method,
            'attributes' => $this->formAttributes,
            'fields' => $this->fields,
        ];
    }

    public function toJson(int $options = 0): string
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_SLASHES | $options);
    }

    public function getValidationRules(): array
    {
        return $this->validationRules;
    }

    public function getValidationMessages(): array
    {
        return $this->validationMessages;
    }

    protected function parseFieldConfig(array $fieldConfig): void
    {
        $type = $fieldConfig['type'] ?? 'text';

        // Container types (row, group) don't require a name property
        if (in_array($type, ['row', 'group'])) {
            $this->parseContainerField($fieldConfig);
            return;
        }

        $name = $fieldConfig['name'] ?? null;

        if (!$name) {
            throw new \InvalidArgumentException('Field must have a "name" property');
        }

        $label = $fieldConfig['label'] ?? null;
        $attributes = $fieldConfig['attributes'] ?? [];
        $default = $fieldConfig['default'] ?? null;

        // Store validation rules if provided
        if (!empty($fieldConfig['validation'])) {
            $this->validationRules[$name] = $fieldConfig['validation'];
        }

        // Add HTML5 required attribute if needed
        if (!empty($fieldConfig['required'])) {
            $attributes['required'] = true;
        }

        if (!empty($fieldConfig['placeholder'])) {
            $attributes['placeholder'] = $fieldConfig['placeholder'];
        }

        // Add validation attributes
        if (!empty($fieldConfig['validation'])) {
            $this->addValidationAttributes($attributes, $fieldConfig['validation']);
        }

        match ($type) {
            'text', 'email', 'password', 'number', 'tel', 'url', 'date', 'time', 'datetime', 'color', 'range', 'search', 'hidden'
            => $this->{$type}($name, $label, array_merge($attributes, ['value' => $default])),

            'textarea'
            => $this->textarea($name, $label, array_merge($attributes, ['value' => $default])),

            'select'
            => $this->parseSelectField($fieldConfig),

            'checkbox'
            => $this->checkbox($name, $label, array_merge($attributes, ['checked' => (bool)$default])),

            'radio'
            => $this->parseRadioField($fieldConfig),

            'file'
            => $this->file($name, $label, $attributes),

            'group'
            => $this->parseGroupField($fieldConfig),

            'row'
            => $this->parseRowField($fieldConfig),

            default => throw new \InvalidArgumentException("Unsupported field type: {$type}"),
        };
    }

    protected function parseContainerField(array $fieldConfig): void
    {
        $type = $fieldConfig['type'];

        if ($type === 'group') {
            $this->parseGroupField($fieldConfig);
        } elseif ($type === 'row') {
            $this->parseRowField($fieldConfig);
        }
    }

    protected function parseSelectField(array $fieldConfig): void
    {
        $name = $fieldConfig['name'];
        $label = $fieldConfig['label'] ?? null;
        $options = $fieldConfig['options'] ?? [];
        $attributes = $fieldConfig['attributes'] ?? [];
        $default = $fieldConfig['default'] ?? null;

        if (isset($fieldConfig['placeholder'])) {
            $attributes['placeholder'] = $fieldConfig['placeholder'];
        }

        $this->select($name, $options, $label, array_merge($attributes, ['selected' => $default]));
    }

    protected function parseRadioField(array $fieldConfig): void
    {
        $name = $fieldConfig['name'];
        $label = $fieldConfig['label'] ?? null;
        $options = $fieldConfig['options'] ?? [];
        $attributes = $fieldConfig['attributes'] ?? [];
        $default = $fieldConfig['default'] ?? null;

        $this->radio($name, $options, $label, array_merge($attributes, ['checked' => $default]));
    }

    protected function parseGroupField(array $fieldConfig): void
    {
        $label = $fieldConfig['label'] ?? null;
        $fields = $fieldConfig['fields'] ?? [];

        $this->fields[] = [
            'type' => 'group',
            'label' => $label,
            'fields' => $fields,
        ];

        foreach ($fields as $nestedField) {
            $this->parseFieldConfig($nestedField);
        }
    }

    protected function parseRowField(array $fieldConfig): void
    {
        $fields = $fieldConfig['fields'] ?? [];

        $this->fields[] = [
            'type' => 'row',
            'fields' => $fields,
        ];
    }

    protected function parseButtonConfig(array $buttonConfig): void
    {
        $type = $buttonConfig['type'] ?? 'submit';
        $label = $buttonConfig['label'] ?? 'Submit';
        $attributes = $buttonConfig['attributes'] ?? [];

        match ($type) {
            'submit' => $this->submit($label, $attributes),
            'reset' => $this->reset($label, $attributes),
            'button' => $this->button($label, 'button', $attributes),
            default => throw new \InvalidArgumentException("Unsupported button type: {$type}"),
        };
    }

    protected function addValidationAttributes(array &$attributes, string $rules): void
    {
        $ruleArray = explode('|', $rules);

        foreach ($ruleArray as $rule) {
            $rule = trim($rule);

            if ($rule === 'required') {
                $attributes['required'] = true;
            } elseif (str_starts_with($rule, 'min:')) {
                $min = substr($rule, 4);
                $attributes['min'] = (int)$min;
            } elseif (str_starts_with($rule, 'max:')) {
                $max = substr($rule, 4);
                $attributes['max'] = (int)$max;
            } elseif (str_starts_with($rule, 'pattern:')) {
                $pattern = substr($rule, 8);
                $attributes['pattern'] = $pattern;
            }
        }
    }
}
