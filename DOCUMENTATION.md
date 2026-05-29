# FormBuilder - Complete Documentation

**Version**: 2.0.0  
**Last Updated**: 2026-05-29

---

## Table of Contents

1. [Getting Started](#getting-started)
2. [Installation](#installation)
3. [Quick Start](#quick-start)
4. [Features](#features)
5. [Usage Guide](#usage-guide)
6. [Field Types](#field-types)
7. [CSS Frameworks](#css-frameworks)
8. [Bootstrap Support](#bootstrap-support)
9. [Advanced Features](#advanced-features)
10. [Examples](#examples)
11. [Contributing](#contributing)
12. [Security](#security)

---

## Getting Started

FormBuilder adalah Laravel package powerful untuk membuat HTML forms dari array atau JSON configuration. Package ini mendukung multiple CSS frameworks dengan API yang intuitive.

### For Different User Types

**👨‍💻 Users (ingin menggunakan package):**
1. Baca [Installation](#installation)
2. Follow [Quick Start](#quick-start)
3. Explore [Usage Guide](#usage-guide)
4. Check [Examples](#examples)

**🚀 Want to upload to Packagist?:**
- See `PACKAGIST_GUIDE.md` for complete instructions

**🔧 Developers (ingin contribute):**
- See [Contributing](#contributing)
- See [Security](#security)
- Check `src/` dan `tests/` directories

---

## Installation

### Requirements
- PHP 8.1+
- Laravel 10.0+

### Via Composer

```bash
composer require bagastopati/form-builder
```

Laravel will auto-register the service provider.

---

## Quick Start

### Array Configuration (Recommended)

```php
use BagasTopati\UiCore\Builders\FormBuilder;

$form = FormBuilder::fromArray([
    'action' => '/users/store',
    'method' => 'POST',
    'fields' => [
        ['type' => 'text', 'name' => 'name', 'label' => 'Full Name'],
        ['type' => 'email', 'name' => 'email', 'label' => 'Email'],
        ['type' => 'password', 'name' => 'password', 'label' => 'Password'],
    ],
    'buttons' => [
        ['type' => 'submit', 'label' => 'Create User'],
    ]
]);

echo $form->render();
```

### Fluent API (Traditional)

```php
use BagasTopati\UiCore\UI;

$form = UI::form('/users/store')
    ->text('name', 'Full Name')
    ->email('email', 'Email')
    ->password('password', 'Password')
    ->submit('Create User');

echo $form->render();
```

### JSON Configuration

```php
$json = json_encode([
    'action' => '/users/store',
    'fields' => [
        ['type' => 'text', 'name' => 'name', 'label' => 'Name'],
    ]
]);

$form = FormBuilder::fromJson($json);
echo $form->render();
```

---

## Features

- ✅ **Array/JSON Configuration** - Deklaratif form definition
- ✅ **Multiple CSS Frameworks** - Bootstrap 4, Bootstrap 5, Tailwind
- ✅ **15+ Field Types** - Semua standard HTML5 input types
- ✅ **Validation Integration** - Extract Laravel validation rules
- ✅ **Multi-column Layouts** - Row field type untuk grid layouts
- ✅ **Field Grouping** - Group field untuk organize fields
- ✅ **Fluent API** - Chainable methods
- ✅ **Custom Field Types** - Extensible via contract
- ✅ **Form Export/Import** - Convert form to/from array/JSON
- ✅ **Zero Dependencies** - Hanya PHP 8.1+

---

## Usage Guide

### Basic Form

```php
$form = FormBuilder::fromArray([
    'action' => '/submit',
    'method' => 'POST',
    'fields' => [
        ['type' => 'text', 'name' => 'username', 'label' => 'Username'],
        ['type' => 'email', 'name' => 'email', 'label' => 'Email'],
    ]
]);

echo $form->render();
```

### With Validation Rules

```php
$form = FormBuilder::fromArray([
    'action' => '/users/store',
    'fields' => [
        [
            'type' => 'text',
            'name' => 'name',
            'label' => 'Name',
            'validation' => 'required|string|max:255'
        ],
        [
            'type' => 'email',
            'name' => 'email',
            'label' => 'Email',
            'validation' => 'required|email|unique:users'
        ],
    ]
]);

// Extract validation rules
$rules = $form->getValidationRules();
// Result: ['name' => 'required|string|max:255', 'email' => 'required|email|unique:users']

// Use with Laravel validator
validator($request->all(), $rules)->validate();
```

### Multi-column Layout

```php
$form = FormBuilder::fromArray([
    'action' => '/products/store',
    'fields' => [
        ['type' => 'text', 'name' => 'name', 'label' => 'Product Name'],
        [
            'type' => 'row',
            'fields' => [
                ['type' => 'number', 'name' => 'price', 'label' => 'Price'],
                ['type' => 'number', 'name' => 'stock', 'label' => 'Stock'],
            ]
        ],
    ]
]);

echo $form->render();
```

### Field Grouping

```php
$form = FormBuilder::fromArray([
    'action' => '/contact',
    'fields' => [
        [
            'type' => 'group',
            'label' => 'Personal Information',
            'fields' => [
                ['type' => 'text', 'name' => 'first_name', 'label' => 'First Name'],
                ['type' => 'text', 'name' => 'last_name', 'label' => 'Last Name'],
            ]
        ]
    ]
]);

echo $form->render();
```

---

## Field Types

### Text Inputs

```php
// Text
['type' => 'text', 'name' => 'username', 'label' => 'Username']

// Email
['type' => 'email', 'name' => 'email', 'label' => 'Email']

// Password
['type' => 'password', 'name' => 'password', 'label' => 'Password']

// Number
['type' => 'number', 'name' => 'quantity', 'label' => 'Quantity']

// Tel
['type' => 'tel', 'name' => 'phone', 'label' => 'Phone']

// URL
['type' => 'url', 'name' => 'website', 'label' => 'Website']

// Search
['type' => 'search', 'name' => 'search', 'label' => 'Search']

// Hidden
['type' => 'hidden', 'name' => 'token', 'value' => 'abc123']
```

### Date/Time Inputs

```php
// Date
['type' => 'date', 'name' => 'birth_date', 'label' => 'Birth Date']

// Time
['type' => 'time', 'name' => 'start_time', 'label' => 'Start Time']

// DateTime
['type' => 'datetime', 'name' => 'created_at', 'label' => 'Created At']

// Color
['type' => 'color', 'name' => 'favorite_color', 'label' => 'Color']
```

### Large Inputs

```php
// Textarea
['type' => 'textarea', 'name' => 'message', 'label' => 'Message', 'rows' => 5]

// File
['type' => 'file', 'name' => 'attachment', 'label' => 'Attachment']
```

### Selection Inputs

```php
// Select
[
    'type' => 'select',
    'name' => 'country',
    'label' => 'Country',
    'options' => ['us' => 'USA', 'uk' => 'UK']
]

// Radio
[
    'type' => 'radio',
    'name' => 'gender',
    'label' => 'Gender',
    'options' => ['M' => 'Male', 'F' => 'Female']
]

// Checkbox
['type' => 'checkbox', 'name' => 'agree', 'checkbox_label' => 'I agree']
```

### Container Fields

```php
// Row (for multi-column layout)
[
    'type' => 'row',
    'fields' => [
        ['type' => 'text', 'name' => 'first_name', 'label' => 'First'],
        ['type' => 'text', 'name' => 'last_name', 'label' => 'Last'],
    ]
]

// Group (for fieldset)
[
    'type' => 'group',
    'label' => 'Address',
    'fields' => [
        ['type' => 'text', 'name' => 'street', 'label' => 'Street'],
        ['type' => 'text', 'name' => 'city', 'label' => 'City'],
    ]
]
```

---

## CSS Frameworks

### Bootstrap 4

```php
use BagasTopati\UiCore\CssFrameworks\Bootstrap4Framework;
use BagasTopati\UiCore\UI;

UI::setFramework(new Bootstrap4Framework());

$form = FormBuilder::fromArray($config);
echo $form->render();
```

**CSS Classes Used:**
- `form-group` - Field wrapper
- `form-control-label` - Label
- `form-control` - Input
- `custom-select` - Select
- `form-check` - Checkbox/Radio
- `form-row` - Row layout

### Bootstrap 5

```php
use BagasTopati\UiCore\CssFrameworks\Bootstrap5Framework;

UI::setFramework(new Bootstrap5Framework());

$form = FormBuilder::fromArray($config);
echo $form->render();
```

**CSS Classes Used:**
- `mb-3` - Field wrapper (margin-bottom)
- `form-label` - Label
- `form-control` - Input
- `form-select` - Select
- `form-check` - Checkbox/Radio
- `row g-3` - Row layout

### Tailwind CSS

```php
use BagasTopati\UiCore\CssFrameworks\TailwindFramework;

UI::setFramework(new TailwindFramework());

$form = FormBuilder::fromArray($config);
echo $form->render();
```

**Classes Used:**
- Utility-first approach
- `flex`, `gap`, `px-4`, `py-2`, etc.
- `bg-blue-500`, `text-white`, `rounded-md`
- Dark mode support

### Switch Between Frameworks

```php
// Bootstrap 4
UI::setFramework(new Bootstrap4Framework());
$form = FormBuilder::fromArray($config);

// Switch to Bootstrap 5 - same code!
UI::setFramework(new Bootstrap5Framework());
$form = FormBuilder::fromArray($config); // Different CSS, same structure
```

---

## Bootstrap Support

### Bootstrap 4 vs Bootstrap 5 Differences

| Feature | Bootstrap 4 | Bootstrap 5 |
|---------|-----------|-----------|
| Form Group | `form-group` | `mb-3` |
| Label | `form-control-label` | `form-label` |
| Select | `custom-select` | `form-select` |
| Row | `form-row` | `row g-3` |
| jQuery | Required | Not required |

### Migration from Bootstrap 4 to 5

**Before (Bootstrap 4):**
```php
UI::setFramework(new Bootstrap4Framework());
$form = FormBuilder::fromArray($config);
```

**After (Bootstrap 5):**
```php
UI::setFramework(new Bootstrap5Framework());
// Same $config works! No changes needed
$form = FormBuilder::fromArray($config);
```

### Bootstrap Example

```php
$form = FormBuilder::fromArray([
    'action' => '/users/store',
    'method' => 'POST',
    'fields' => [
        [
            'type' => 'text',
            'name' => 'name',
            'label' => 'Name',
            'placeholder' => 'Enter full name',
            'validation' => 'required|string|max:255'
        ],
        [
            'type' => 'email',
            'name' => 'email',
            'label' => 'Email',
            'validation' => 'required|email'
        ],
        [
            'type' => 'row',
            'fields' => [
                ['type' => 'number', 'name' => 'price', 'label' => 'Price'],
                ['type' => 'number', 'name' => 'stock', 'label' => 'Stock'],
            ]
        ]
    ],
    'buttons' => [
        ['type' => 'submit', 'label' => 'Save'],
        ['type' => 'reset', 'label' => 'Clear']
    ]
]);

echo $form->render();
```

---

## Advanced Features

### Custom Field Attributes

```php
[
    'type' => 'text',
    'name' => 'username',
    'label' => 'Username',
    'attributes' => [
        'class' => 'custom-input',
        'data-validate' => 'true',
        'minlength' => 3
    ]
]
```

### Default Values

```php
[
    'type' => 'text',
    'name' => 'email',
    'label' => 'Email',
    'default' => 'user@example.com'
]
```

### Placeholder

```php
[
    'type' => 'text',
    'name' => 'name',
    'label' => 'Name',
    'placeholder' => 'Enter your full name'
]
```

### Export Form to Array

```php
$form = FormBuilder::fromArray($config);
$array = $form->toArray();
// Returns the form structure
```

### Export Form to JSON

```php
$json = $form->toJson();
// Returns JSON string of form structure

// Use later
$form = FormBuilder::fromJson($json);
echo $form->render();
```

### Validation Rules Extraction

```php
$form = FormBuilder::fromArray($config);

// Get validation rules
$rules = $form->getValidationRules();

// Use with Laravel
$validator = validator($request->all(), $rules);
if ($validator->fails()) {
    return back()->withErrors($validator);
}
```

---

## Examples

Check `examples/` directory for complete working examples:

1. **contoh-bootstrap4.php** - Bootstrap 4 with 4 form examples
2. **contoh-bootstrap5.php** - Bootstrap 5 with 4 form examples
3. **contoh-tailwind.php** - Tailwind CSS with 4 form examples

Each file includes:
- Contact form
- Registration form
- Product form with multi-column layout
- Survey form

### Run Examples

**Option 1: Via Web Server**
```bash
# Assuming Laragon/XAMPP
http://localhost/ui-core/examples/contoh-bootstrap4.php
```

**Option 2: PHP Built-in Server**
```bash
cd examples
php -S localhost:8000
# Visit http://localhost:8000/contoh-bootstrap4.php
```

---

## Contributing

### How to Contribute

1. Fork the repository
2. Create feature branch: `git checkout -b feature/your-feature`
3. Make changes following PSR-12
4. Write/update tests
5. Commit with conventional format: `git commit -m "feat: Add feature"`
6. Push to branch: `git push origin feature/your-feature`
7. Create Pull Request

### Code Standards

- **PSR-12 Compliant** - Follow PHP standards
- **Type Hints** - All methods must be typed
- **Tests** - Add tests for new features
- **Documentation** - Update docs for new features

### Commit Message Format

```
type(scope): subject

body

footer
```

**Types:** feat, fix, docs, style, refactor, test, chore

**Example:**
```
feat(form-builder): add custom field types support

Allow developers to create custom field types by implementing
the FieldType contract.

Closes #123
```

### Testing

```bash
# Run tests
composer test

# Run specific test
composer test tests/Unit/FormBuilderArrayTest.php
```

---

## Security

### XSS Prevention

All output is automatically HTML-escaped to prevent XSS attacks:

```php
$form = FormBuilder::fromArray($config);
echo $form->render(); // Safe - output is escaped
```

### CSRF Protection

Use Laravel CSRF token in forms:

```php
// In Blade
<form method="POST" action="/submit">
    @csrf
    <!-- form fields -->
</form>
```

### SQL Injection

Always validate and use parameterized queries:

```php
// Get validation rules from form
$rules = $form->getValidationRules();

// Validate input
$validated = validator($request->all(), $rules)->validate();

// Use Eloquent or prepared statements
User::create($validated);
```

### Vulnerability Reporting

Found a security vulnerability? Email: **bagas.topati@gmail.com**

Please include:
- Description
- Steps to reproduce
- Potential impact
- Suggested fix

### Security Best Practices

1. **Always validate on backend** - Never trust client-side only
2. **Use HTTPS** - Ensure forms submitted over secure connection
3. **Keep dependencies updated** - Update Laravel and dependencies regularly
4. **Use environment variables** - Never hardcode sensitive data
5. **Sanitize output** - FormBuilder escapes output automatically

---

## FAQ

**Q: Do I need to install anything else?**  
A: Just PHP 8.1+ and Laravel. No external dependencies.

**Q: Can I switch frameworks without changing code?**  
A: Yes! Just change `UI::setFramework()` call.

**Q: Are examples available?**  
A: Yes, check `examples/` directory with 12 working forms.

**Q: Can I create custom field types?**  
A: Yes, implement the FieldType contract.

**Q: Is this backward compatible?**  
A: Yes, 100% backward compatible with existing FormBuilder code.

**Q: How do I get validation rules?**  
A: Use `$form->getValidationRules()` method.

---

## License

MIT License - see LICENSE file

## Support

- **Documentation**: See this file
- **Examples**: Check `examples/` directory
- **Contributing**: See CONTRIBUTING.md
- **Security**: See SECURITY.md or email bagas.topati@gmail.com

---

**FormBuilder v2.0.0 - Production Ready** 🚀
