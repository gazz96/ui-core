# FormBuilder - Laravel Form Builder Package

A powerful and flexible Laravel package for creating HTML forms from array or JSON configuration. Support for multiple CSS frameworks (Bootstrap, Tailwind) with a fluent, intuitive API.

## Features

- 🎨 **Multiple CSS Frameworks** - Bootstrap 4, Bootstrap 5, Tailwind, or custom CSS frameworks
- 📋 **Array/JSON Configuration** - Define forms declaratively using arrays or JSON
- 🔄 **Fluent API** - Chainable methods for easy form building
- 🎯 **Form Fields** - Support for all standard HTML5 input types (15+ types)
- ✅ **Validation Integration** - Extract validation rules directly from field configuration
- 🎪 **Field Grouping** - Organize fields with fieldsets and rows
- 📦 **Zero Dependencies** - Only requires PHP 8.1+
- 🔧 **Extensible** - Create custom field types easily
- 🅱️ **Bootstrap Support** - Full support for Bootstrap 4 and Bootstrap 5

## Installation

```bash
composer require gazz96/form-builder
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

FormBuilder supports multiple CSS frameworks with different Bootstrap versions!

### Supported Frameworks

- **bootstrap** - Bootstrap (default)
- **bootstrap4** - Bootstrap 4.x
- **bootstrap5** - Bootstrap 5.x
- **tailwind** - Tailwind CSS
- **default** - Generic CSS

### In Configuration

```php
// config/form-builder.php
'default_framework' => env('FORM_BUILDER_FRAMEWORK', 'bootstrap5'),

'frameworks' => [
    'bootstrap' => Bootstrap Framework::class,
    'bootstrap4' => Bootstrap4Framework::class,
    'bootstrap5' => Bootstrap5Framework::class,
    'tailwind' => TailwindFramework::class,
    'default' => DefaultFramework::class,
]
```

### At Runtime

```php
use BagasTopati\UiCore\UI;

// Use Bootstrap 4
UI::setFramework(new \BagasTopati\UiCore\CssFrameworks\Bootstrap4Framework());

// or Bootstrap 5
UI::setFramework(new \BagasTopati\UiCore\CssFrameworks\Bootstrap5Framework());

// or via environment variable
UI::useBootstrap(); // Uses default framework

$form = FormBuilder::fromArray($config);
echo $form->render();
```

### Environment Variable

```bash
# .env
FORM_BUILDER_FRAMEWORK=bootstrap5
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

## Bootstrap Version Differences

FormBuilder automatically handles differences between Bootstrap 4 and Bootstrap 5:

### Select Fields
```php
// Bootstrap 4: Uses custom-select class
// Bootstrap 5: Uses form-select class (custom-select removed)
```

### Form Groups
```php
// Bootstrap 4: form-group class
// Bootstrap 5: mb-3 utility class
```

### Form Labels
```php
// Bootstrap 4: form-control-label class
// Bootstrap 5: form-label class
```

### Form Rows
```php
// Bootstrap 4: form-row for horizontal layouts
// Bootstrap 5: row with g-3 gap utility
```

### CSS & JS Requirements
```php
// Bootstrap 4: Requires jQuery, Popper.js, Bootstrap JS
// Bootstrap 5: Bootstrap bundle includes Popper.js (no jQuery needed)
```

The framework automatically includes the correct CDN links and styling classes!

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

## Configuration-Based Forms (Cara 2 & 3)

### Problem

Form definitions and validation rules are often separated in Laravel controllers:

```php
public function create()  // Display form
{
    $form = FormBuilder::fromArray($config);
    return view('form', compact('form'));
}

public function store(Request $request)  // Handle submission
{
    $validated = $request->validate($rules);
    // Form and validation are disconnected!
}
```

### Solution: Store Forms in Config

Define your forms in `config/form-builder.php` and access them from both methods.

#### Step 1: Define Form in Config

```php
// config/form-builder.php
'forms' => [
    'user_registration' => [
        'action' => '/users/store',
        'method' => 'POST',
        'fields' => [
            [
                'type' => 'text',
                'name' => 'name',
                'label' => 'Full Name',
                'validation' => 'required|string|max:255'
            ],
            [
                'type' => 'email',
                'name' => 'email',
                'label' => 'Email',
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
            ]
        ],
        'buttons' => [
            ['type' => 'submit', 'label' => 'Register']
        ]
    ]
]
```

#### Step 2: Use Trait in Controller (Recommended)

```php
use BagasTopati\FormBuilder\Traits\HasFormConfiguration;

class UserController extends Controller
{
    use HasFormConfiguration;

    public function create()
    {
        $form = $this->getFormBuilder('user_registration');
        return view('users.create', compact('form'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateForm('user_registration', $request);
        User::create($validated);
        return redirect()->route('users.show', $validated);
    }
}
```

#### Available Trait Methods

```php
$this->getFormBuilder($formName)              // Get FormBuilder instance
$this->validateForm($formName, $request)      // Validate request with form rules
$this->getFormValidationRules($formName)      // Get validation rules only
$this->getFormValidationMessages($formName)   // Get validation messages
$this->hasForm($formName)                     // Check if form exists
$this->getAllFormNames()                      // List all registered forms
$this->getFormConfiguration($formName)        // Get raw config array
```

### Alternative: Without Trait

```php
public function create()
{
    $config = config('form-builder.forms.user_registration');
    $form = FormBuilder::fromArray($config);
    return view('users.create', compact('form'));
}

public function store(Request $request)
{
    $config = config('form-builder.forms.user_registration');
    $form = FormBuilder::fromArray($config);
    $rules = $form->getValidationRules();
    $validated = $request->validate($rules);
}
```

### Benefits

✅ Form and validation in **one place**  
✅ No **duplication** between methods  
✅ Changes to form **automatically update** validation  
✅ **DRY principle** - less code  
✅ **Cleaner, more readable** controller code  

## Validation Integration

### 3-Layer Validation

FormBuilder supports three levels of validation:

1. **HTML5 Validation** (Browser) - Real-time user feedback
2. **Server-side (Laravel Validator)** - Secure backend validation
3. **Custom Logic** (Optional) - Business-specific validation

### Extracting Validation Rules

```php
$form = FormBuilder::fromArray($config);
$rules = $form->getValidationRules();

// Result: ['name' => 'required|string|max:255', 'email' => 'required|email']

// Use with Laravel validator
$validated = $request->validate($rules);

// Or with custom messages
$messages = [
    'name.required' => 'Please enter your name',
    'email.email' => 'Please enter a valid email'
];
$validated = $request->validate($rules, $messages);
```

### Supported Validation Rules

- `required` - Field is required
- `nullable` - Field is optional
- `string` - Must be string
- `email` - Must be valid email
- `unique:table[,column]` - Must be unique in database
- `min:5` - Minimum length (5 chars)
- `max:255` - Maximum length (255 chars)
- `confirmed` - Must match field_confirmation
- `regex:/pattern/` - Custom regex pattern
- `in:value1,value2` - Must be one of values
- `before:date`, `after:date` - Date validation
- `image`, `file`, `mimes:jpg,png` - File validation
- ... and all standard Laravel validation rules

### HTML5 Attributes

Validation rules are automatically converted to HTML5 attributes:

```php
'validation' => 'required|email|max:255'

// Generates:
// <input type="email" required maxlength="255">
```

## Security

### XSS Prevention

All output is automatically HTML-escaped to prevent XSS attacks:

```php
$form = FormBuilder::fromArray($config);
echo $form->render(); // Safe - output is escaped
```

### CSRF Protection

Always use Laravel CSRF token in your forms:

```blade
<form method="POST" action="/submit">
    @csrf
    {!! $form->render() !!}
</form>
```

### SQL Injection Prevention

Always validate and use parameterized queries:

```php
$rules = $form->getValidationRules();
$validated = $request->validate($rules);

// Safe - use validated data with Eloquent
User::create($validated);
```

### Best Practices

1. **Always validate on backend** - Never trust client-side only
2. **Use HTTPS** - Ensure forms submitted over secure connection
3. **Keep dependencies updated** - Update Laravel and dependencies regularly
4. **Use environment variables** - Never hardcode sensitive data
5. **Sanitize output** - FormBuilder escapes output automatically

## Support

For issues, questions, or suggestions, please open an issue on GitHub.

## Security Issues

Found a security vulnerability? Please email bagas.topati@gmail.com with:
- Description of the vulnerability
- Steps to reproduce
- Potential impact
- Suggested fix
