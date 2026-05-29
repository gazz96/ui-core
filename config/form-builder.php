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
];
