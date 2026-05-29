<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Default CSS Framework
    |--------------------------------------------------------------------------
    |
    | Specify the default CSS framework for form styling.
    | Supported: 'bootstrap', 'tailwind', 'default'
    |
    */
    'default_framework' => env('FORM_BUILDER_FRAMEWORK', 'tailwind'),

    /*
    |--------------------------------------------------------------------------
    | Framework Classes
    |--------------------------------------------------------------------------
    |
    | Register CSS framework implementations for form styling.
    | Supported: 'bootstrap', 'bootstrap4', 'bootstrap5', 'tailwind', 'default'
    |
    */
    'frameworks' => [
        'bootstrap' => BagasTopati\UiCore\CssFrameworks\BootstrapFramework::class,
        'bootstrap4' => BagasTopati\UiCore\CssFrameworks\Bootstrap4Framework::class,
        'bootstrap5' => BagasTopati\UiCore\CssFrameworks\Bootstrap5Framework::class,
        'tailwind' => BagasTopati\UiCore\CssFrameworks\TailwindFramework::class,
        'default' => BagasTopati\UiCore\CssFrameworks\DefaultFramework::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Field Types
    |--------------------------------------------------------------------------
    |
    | Register custom field type implementations.
    | Key is the field type name, value is the class implementing FieldType.
    |
    */
    'custom_field_types' => [
        // 'my_custom_type' => App\FormBuilder\FieldTypes\MyCustomFieldType::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Validation Settings
    |--------------------------------------------------------------------------
    |
    | Configure validation-related settings for form fields.
    |
    */
    'validation' => [
        'include_html5_validation' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Data Binding Configuration
    |--------------------------------------------------------------------------
    |
    | Configure binding-related settings for form fields.
    |
    */
    'binding' => [
        'auto_escape' => true,           // HTML escape bound values
        'date_format' => 'Y-m-d',        // Format dates when binding
        'format_currency' => false,      // Automatic currency formatting
    ],

    /*
    |--------------------------------------------------------------------------
    | Form Configurations (Cara 2)
    |--------------------------------------------------------------------------
    |
    | Define form configurations here. Each form configuration is an array
    | that can be used with FormBuilder::fromArray() or the HasFormConfiguration trait.
    |
    | Usage in Controller:
    | - Using config directly:     $form = FormBuilder::fromArray(config('form-builder.forms.user_registration'));
    | - Using trait method:        $form = $this->getFormBuilder('user_registration');
    |
    | Structure:
    | 'form_name' => [
    |     'action' => '/route',
    |     'method' => 'POST',
    |     'fields' => [...],
    |     'buttons' => [...]
    | ]
    |
    */
    'forms' => [
        // 'user_registration' => [
        //     'action' => '/users/store',
        //     'method' => 'POST',
        //     'fields' => [
        //         [
        //             'type' => 'text',
        //             'name' => 'name',
        //             'label' => 'Full Name',
        //             'validation' => 'required|string|max:255'
        //         ],
        //         [
        //             'type' => 'email',
        //             'name' => 'email',
        //             'label' => 'Email',
        //             'validation' => 'required|email|unique:users'
        //         ],
        //         [
        //             'type' => 'password',
        //             'name' => 'password',
        //             'label' => 'Password',
        //             'validation' => 'required|min:8|confirmed'
        //         ],
        //     ],
        //     'buttons' => [
        //         ['type' => 'submit', 'label' => 'Register'],
        //     ]
        // ]
    ],
];
