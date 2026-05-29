<?php

declare(strict_types=1);

namespace BagasTopati\FormBuilder\Traits;

use BagasTopati\UiCore\Builders\FormBuilder;
use BagasTopati\FormBuilder\FormBuilderFactory;

/**
 * Trait HasFormConfiguration
 *
 * Provides convenient methods for working with form configurations
 * stored in Laravel's config/form-builder.php file.
 *
 * Usage in Controller:
 * ```php
 * class FormController extends Controller
 * {
 *     use HasFormConfiguration;
 *
 *     public function create()
 *     {
 *         $form = $this->getFormBuilder('user_registration');
 *         return view('forms.create', compact('form'));
 *     }
 *
 *     public function store(Request $request)
 *     {
 *         $rules = $this->getFormValidationRules('user_registration');
 *         $validated = $request->validate($rules);
 *         User::create($validated);
 *     }
 * }
 * ```
 */
trait HasFormConfiguration
{
    /**
     * Get form configuration by name from config/form-builder.php
     *
     * @param string $formName The form name (e.g., 'user_registration')
     * @return array The form configuration array
     *
     * @throws \InvalidArgumentException If form configuration is not found
     */
    public function getFormConfiguration(string $formName): array
    {
        $config = config("form-builder.forms.{$formName}");

        if (!$config) {
            throw new \InvalidArgumentException(
                "Form configuration '{$formName}' not found in config/form-builder.php"
            );
        }

        return $config;
    }

    /**
     * Get FormBuilder instance by form name
     *
     * @param string $formName The form name (e.g., 'user_registration')
     * @return FormBuilder The FormBuilder instance
     *
     * @example
     * $form = $this->getFormBuilder('user_registration');
     * echo $form->render();
     */
    public function getFormBuilder(string $formName): FormBuilder
    {
        $config = $this->getFormConfiguration($formName);

        /** @var FormBuilderFactory $factory */
        $factory = app('form-builder');

        return $factory->fromArray($config);
    }

    /**
     * Get validation rules for a form
     *
     * @param string $formName The form name (e.g., 'user_registration')
     * @return array Laravel validation rules array
     *
     * @example
     * $rules = $this->getFormValidationRules('user_registration');
     * $validated = $request->validate($rules);
     */
    public function getFormValidationRules(string $formName): array
    {
        $form = $this->getFormBuilder($formName);

        return $form->getValidationRules();
    }

    /**
     * Get validation messages for a form
     *
     * @param string $formName The form name (e.g., 'user_registration')
     * @return array Custom validation messages
     */
    public function getFormValidationMessages(string $formName): array
    {
        $form = $this->getFormBuilder($formName);

        return $form->getValidationMessages();
    }

    /**
     * Validate request data against form rules
     *
     * @param string $formName The form name (e.g., 'user_registration')
     * @param \Illuminate\Http\Request $request The HTTP request
     * @return array The validated data
     *
     * @example
     * $validated = $this->validateForm('user_registration', $request);
     * User::create($validated);
     */
    public function validateForm(string $formName, \Illuminate\Http\Request $request): array
    {
        $rules = $this->getFormValidationRules($formName);
        $messages = $this->getFormValidationMessages($formName);

        return $request->validate($rules, $messages);
    }

    /**
     * Get form configuration array for exporting/storing
     *
     * @param string $formName The form name (e.g., 'user_registration')
     * @return array The form configuration
     *
     * @example
     * $config = $this->exportFormConfiguration('user_registration');
     * // Can save to DB or send to API
     */
    public function exportFormConfiguration(string $formName): array
    {
        return $this->getFormConfiguration($formName);
    }

    /**
     * Get all registered form names from config
     *
     * @return array List of all form names available
     *
     * @example
     * $forms = $this->getAllFormNames();
     * // Returns: ['user_registration', 'product_form', 'contact_form']
     */
    public function getAllFormNames(): array
    {
        $forms = config('form-builder.forms', []);

        return array_keys($forms);
    }

    /**
     * Check if form configuration exists
     *
     * @param string $formName The form name (e.g., 'user_registration')
     * @return bool True if form exists, false otherwise
     *
     * @example
     * if ($this->hasForm('user_registration')) {
     *     // Form exists, use it
     * }
     */
    public function hasForm(string $formName): bool
    {
        return !is_null(config("form-builder.forms.{$formName}"));
    }
}
