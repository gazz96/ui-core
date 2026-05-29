# FormBuilder - Laravel Form Builder Package

A powerful and flexible Laravel package for creating HTML forms from array or JSON configuration. Support for multiple CSS frameworks (Bootstrap, Tailwind) with a fluent, intuitive API.

## Features

- 🎨 **Multiple CSS Frameworks** - Bootstrap, Tailwind, or custom CSS frameworks
- 📋 **Array/JSON Configuration** - Define forms declaratively using arrays or JSON
- 🔄 **Fluent API** - Chainable methods for easy form building
- 🎯 **Form Fields** - Support for all standard HTML5 input types
- ✅ **Validation Integration** - Extract validation rules directly from field configuration
- 🎪 **Field Grouping** - Organize fields with fieldsets and rows
- 📦 **Zero Dependencies** - Only requires PHP 8.1+
- 🔧 **Extensible** - Create custom field types easily

## Installation

```bash
composer require bagastopati/form-builder
```

Laravel will auto-register the service provider.

## Quick Start

### Using Fluent API (Existing Method)

```php
use BagasTopati\UiCore\UI;

$form = UI::form('/users/store')
    ->text('name', 'Full Name')
    ->email('email', 'Email Address')
    ->password('password', 'Password')
    ->submit('Create User')
    ->render();
```

### Using Array Configuration (New)

```php
use BagasTopati\UiCore\Builders\FormBuilder;

$config = [
    'action' => '/users/store',
    'method' => 'POST',
    'attributes' => [
        'class' => 'user-form',
        'id' => 'user-form'
    ],
    'fields' => [
        [
            'type' => 'text',
            'name' => 'name',
            'label' => 'Full Name',
            'placeholder' => 'Enter your full name',
            'validation' => 'required|string|max:255'
        ],
        [
            'type' => 'email',
            'name' => 'email',
            'label' => 'Email Address',
            'validation' => 'required|email'
        ],
        [
            'type' => 'password',
            'name' => 'password',
            'label' => 'Password',
            'validation' => 'required|min:8'
        ]
    ],
    'buttons' => [
        [
            'type' => 'submit',
            'label' => 'Create User'
        ]
    ]
];

$form = FormBuilder::fromArray($config);
echo $form->render();
```

### Using JSON Configuration

```php
$json = '{
    "action": "/users/store",
    "method": "POST",
    "fields": [
        {
            "type": "text",
            "name": "name",
            "label": "Full Name",
            "validation": "required|string"
        }
    ]
}';

$form = FormBuilder::fromJson($json);
echo $form->render();
```

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --tag=form-builder-config
```

Edit `config/form-builder.php`:

```php
return [
    'default_framework' => env('FORM_BUILDER_FRAMEWORK', 'tailwind'),
    'frameworks' => [
        'bootstrap' => BagasTopati\UiCore\CssFrameworks\BootstrapFramework::class,
        'tailwind' => BagasTopati\UiCore\CssFrameworks\TailwindFramework::class,
        'default' => BagasTopati\UiCore\CssFrameworks\DefaultFramework::class,
    ],
    'custom_field_types' => [],
    'validation' => [
        'include_html5_validation' => true,
    ],
];
```

## Supported Field Types

### Input Fields
- `text` - Text input
- `email` - Email input
- `password` - Password input
- `number` - Number input
- `tel` - Telephone input
- `url` - URL input
- `date` - Date input
- `time` - Time input
- `datetime` - DateTime input
- `color` - Color picker
- `range` - Range slider
- `search` - Search input
- `hidden` - Hidden input

### Complex Fields
- `textarea` - Multi-line text
- `select` - Dropdown selection
- `checkbox` - Single checkbox
- `radio` - Radio button group
- `file` - File upload

### Special Fields
- `group` - Fieldset grouping
- `row` - Multi-column layout

## Field Configuration

Each field can have the following properties:

```php
[
    'type' => 'text',                    // Field type (required)
    'name' => 'field_name',              // Field name (required)
    'label' => 'Field Label',            // Display label
    'placeholder' => 'Enter value',      // Placeholder text
    'default' => 'default_value',        // Default value
    'validation' => 'required|email',    // Laravel validation rules
    'required' => true,                  // HTML5 required attribute
    'attributes' => [                    // Custom HTML attributes
        'class' => 'custom-class',
        'data-custom' => 'value'
    ]
]
```

## Validation Rules

Extract validation rules from form configuration:

```php
$form = FormBuilder::fromArray($config);
$rules = $form->getValidationRules();
// ['name' => 'required|string|max:255', 'email' => 'required|email']

// Use with Laravel validator
$validated = validator($data, $rules)->validate();
```

## Form Export

### Export to Array

```php
$form = FormBuilder::fromArray($config);
$array = $form->toArray();
```

### Export to JSON

```php
$json = $form->toJson();
// Or with options
$json = $form->toJson(JSON_PRETTY_PRINT);
```

## Advanced Examples

### Select Field with Options

```php
[
    'type' => 'select',
    'name' => 'role',
    'label' => 'User Role',
    'options' => [
        'admin' => 'Administrator',
        'editor' => 'Editor',
        'viewer' => 'Viewer'
    ],
    'default' => 'viewer',
    'validation' => 'required|in:admin,editor,viewer'
]
```

### Grouped Fields

```php
[
    'type' => 'group',
    'label' => 'Personal Information',
    'fields' => [
        [
            'type' => 'text',
            'name' => 'first_name',
            'label' => 'First Name'
        ],
        [
            'type' => 'text',
            'name' => 'last_name',
            'label' => 'Last Name'
        ]
    ]
]
```

### Row Layout (Multi-Column)

```php
[
    'type' => 'row',
    'fields' => [
        [
            'type' => 'text',
            'name' => 'first_name',
            'label' => 'First Name'
        ],
        [
            'type' => 'text',
            'name' => 'last_name',
            'label' => 'Last Name'
        ]
    ]
]
```

### File Upload with Validation

```php
[
    'type' => 'file',
    'name' => 'avatar',
    'label' => 'Profile Picture',
    'accept' => 'image/*',
    'validation' => 'required|image|max:2048'
]
```

## CSS Framework Switching

### In Configuration

```php
// config/form-builder.php
'default_framework' => 'bootstrap', // or 'tailwind'
```

### At Runtime

```php
use BagasTopati\UiCore\UI;

UI::useBootstrap();
// or
UI::useTailwind();

$form = FormBuilder::fromArray($config);
echo $form->render();
```

## Real-World Example

```php
// Store user form configuration
$userFormConfig = [
    'action' => route('users.store'),
    'method' => 'POST',
    'attributes' => [
        'class' => 'user-registration-form',
        'novalidate' => true
    ],
    'fields' => [
        [
            'type' => 'text',
            'name' => 'name',
            'label' => 'Full Name',
            'placeholder' => 'John Doe',
            'validation' => 'required|string|max:255'
        ],
        [
            'type' => 'email',
            'name' => 'email',
            'label' => 'Email Address',
            'placeholder' => 'john@example.com',
            'validation' => 'required|email|unique:users'
        ],
        [
            'type' => 'password',
            'name' => 'password',
            'label' => 'Password',
            'validation' => 'required|min:8|confirmed'
        ],
        [
            'type' => 'password',
            'name' => 'password_confirmation',
            'label' => 'Confirm Password'
        ],
        [
            'type' => 'select',
            'name' => 'country',
            'label' => 'Country',
            'options' => [
                'id' => 'Indonesia',
                'ph' => 'Philippines',
                'my' => 'Malaysia'
            ],
            'validation' => 'required|in:id,ph,my'
        ],
        [
            'type' => 'checkbox',
            'name' => 'agree_terms',
            'label' => 'I agree to the terms',
            'checkbox_label' => 'I have read and agree to the Terms of Service',
            'validation' => 'required'
        ]
    ],
    'buttons' => [
        [
            'type' => 'submit',
            'label' => 'Create Account'
        ]
    ]
];

// In your controller
$form = FormBuilder::fromArray($userFormConfig);

// In your blade template
{{ $form->render() }}

// Extract validation rules
$rules = $form->getValidationRules();
```

## Creating Custom Field Types

Implement the `FieldType` contract:

```php
namespace App\FormBuilder\FieldTypes;

use BagasTopati\FormBuilder\Contracts\FieldType;

class DateRangeFieldType implements FieldType
{
    public function getName(): string
    {
        return 'date_range';
    }

    public function render(array $config): string
    {
        // Your custom rendering logic
        return '<input type="text" class="daterange">';
    }

    public function getValidationRules(array $config): array
    {
        return [$config['name'] => 'required|date_format:Y-m-d'];
    }
}
```

Register in config:

```php
// config/form-builder.php
'custom_field_types' => [
    'date_range' => App\FormBuilder\FieldTypes\DateRangeFieldType::class,
]
```

## Methods Reference

### FormBuilder

#### Static Methods
- `fromArray(array $config): static` - Create form from array configuration
- `fromJson(string $json): static` - Create form from JSON string

#### Instance Methods
- `toArray(): array` - Export form configuration to array
- `toJson(int $options = 0): string` - Export form configuration to JSON
- `getValidationRules(): array` - Get all validation rules
- `getValidationMessages(): array` - Get validation messages

#### Field Methods
- `text(string $name, ?string $label, array $options): static`
- `email(string $name, ?string $label, array $options): static`
- `password(string $name, ?string $label, array $options): static`
- `number(string $name, ?string $label, array $options): static`
- `textarea(string $name, ?string $label, array $options): static`
- `select(string $name, array $options_list, ?string $label, array $options): static`
- `checkbox(string $name, ?string $label, array $options): static`
- `radio(string $name, array $options, ?string $label, array $options): static`
- `file(string $name, ?string $label, array $options): static`
- `group(string $label, array $fields): static`
- `row(array $fields): static`

#### Form Methods
- `post(): static` - Set form method to POST
- `get(): static` - Set form method to GET
- `put(): static` - Set form method to PUT
- `delete(): static` - Set form method to DELETE
- `patch(): static` - Set form method to PATCH
- `multipart(): static` - Enable multipart/form-data
- `attr(string $key, string|int|bool|null $value): static` - Add form attribute
- `class(string|array $class): static` - Add CSS class
- `render(): string` - Render form to HTML

## Testing

Run tests with:

```bash
php artisan test
```

## License

MIT License - see LICENSE file for details

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Support

For issues, questions, or suggestions, please open an issue on GitHub.
