# Bootstrap Support Guide

FormBuilder memiliki dukungan lengkap untuk Bootstrap 4 dan Bootstrap 5 dengan perbedaan otomatis dalam rendering HTML.

## Versions Supported

- ✅ Bootstrap 4 (4.0.0+)
- ✅ Bootstrap 5 (5.0.0+)
- ✅ Bootstrap 5.3 (latest)

## Quick Start

### Bootstrap 4

```php
use BagasTopati\UiCore\CssFrameworks\Bootstrap4Framework;
use BagasTopati\UiCore\Builders\FormBuilder;
use BagasTopati\UiCore\UI;

// Set Bootstrap 4 as framework
UI::setFramework(new Bootstrap4Framework());

// Create form
$form = FormBuilder::fromArray([
    'action' => '/submit',
    'fields' => [
        ['type' => 'text', 'name' => 'name', 'label' => 'Name'],
        ['type' => 'email', 'name' => 'email', 'label' => 'Email'],
    ]
]);

echo $form->render();
```

### Bootstrap 5

```php
use BagasTopati\UiCore\CssFrameworks\Bootstrap5Framework;
use BagasTopati\UiCore\UI;

// Set Bootstrap 5 as framework
UI::setFramework(new Bootstrap5Framework());

// Create form (same code as Bootstrap 4)
$form = FormBuilder::fromArray([
    'action' => '/submit',
    'fields' => [
        ['type' => 'text', 'name' => 'name', 'label' => 'Name'],
        ['type' => 'email', 'name' => 'email', 'label' => 'Email'],
    ]
]);

echo $form->render();
```

## Key Differences Between Bootstrap 4 & 5

### 1. Form Groups

**Bootstrap 4:**
```html
<div class="form-group">
  <label class="form-control-label" for="name">Name</label>
  <input type="text" class="form-control" name="name" id="name">
</div>
```

**Bootstrap 5:**
```html
<div class="mb-3">
  <label class="form-label" for="name">Name</label>
  <input type="text" class="form-control" name="name" id="name">
</div>
```

### 2. Select Fields

**Bootstrap 4:**
```html
<select class="form-control custom-select" name="role">
  <option>Choose Role</option>
</select>
```

**Bootstrap 5:**
```html
<select class="form-select" name="role">
  <option>Choose Role</option>
</select>
```

Note: Bootstrap 5 removed `custom-select` class.

### 3. Form Row (Multi-Column)

**Bootstrap 4:**
```php
[
    'type' => 'row',
    'fields' => [
        ['type' => 'text', 'name' => 'first_name', 'label' => 'First Name'],
        ['type' => 'text', 'name' => 'last_name', 'label' => 'Last Name'],
    ]
]
```

Renders as:
```html
<div class="form-row">
  <div class="col"><!-- first name --></div>
  <div class="col"><!-- last name --></div>
</div>
```

**Bootstrap 5:**

Same configuration, but renders as:
```html
<div class="row g-3">
  <div class="col"><!-- first name --></div>
  <div class="col"><!-- last name --></div>
</div>
```

### 4. Checkbox & Radio Fields

Both versions use `form-check` class, but implementation is identical.

**Bootstrap 4 & 5:**
```html
<div class="form-check">
  <input type="checkbox" class="form-check-input" name="agree" id="agree">
  <label class="form-check-label" for="agree">I agree</label>
</div>
```

### 5. Buttons

Both versions use `btn` and `btn-{variant}` classes. No differences.

```php
['type' => 'submit', 'label' => 'Save']
```

Renders as:
```html
<button type="submit" class="btn btn-primary">Save</button>
```

### 6. JavaScript Requirements

**Bootstrap 4:**
- Requires jQuery
- Requires Popper.js
- Requires Bootstrap JS

```html
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
```

**Bootstrap 5:**
- No jQuery required!
- Popper.js is bundled
- Only needs Bootstrap bundle

```html
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
```

FormBuilder automatically includes correct dependencies!

## Form Field Comparison Table

| Field Type | Bootstrap 4 | Bootstrap 5 | Notes |
|-----------|-----------|-----------|-------|
| Text Input | ✅ | ✅ | Same classes |
| Email | ✅ | ✅ | Same classes |
| Password | ✅ | ✅ | Same classes |
| Select | ✅ custom-select | ✅ form-select | Different class names |
| Textarea | ✅ | ✅ | Same classes |
| Checkbox | ✅ form-check | ✅ form-check | Identical |
| Radio | ✅ form-check | ✅ form-check | Identical |
| File | ✅ | ✅ | Same classes |
| Hidden | ✅ | ✅ | Same classes |

## HTML5 Validation Attributes

Both Bootstrap versions support HTML5 validation attributes:

```php
[
    'type' => 'text',
    'name' => 'email',
    'validation' => 'required|email|max:255'
]
```

Renders with attributes:
```html
<input type="text" name="email" required>
```

## Migration from Bootstrap 4 to 5

**Good news:** FormBuilder code is the same for both versions!

Just change the framework:

```php
// Bootstrap 4
UI::setFramework(new Bootstrap4Framework());

// Change to Bootstrap 5
UI::setFramework(new Bootstrap5Framework());

// Same form code works with both!
$form = FormBuilder::fromArray($config);
```

## Full Example: Bootstrap 4

```php
<?php

use BagasTopati\UiCore\Builders\FormBuilder;
use BagasTopati\UiCore\CssFrameworks\Bootstrap4Framework;
use BagasTopati\UiCore\UI;

UI::setFramework(new Bootstrap4Framework());

$form = FormBuilder::fromArray([
    'action' => '/users/store',
    'method' => 'POST',
    'fields' => [
        [
            'type' => 'text',
            'name' => 'name',
            'label' => 'Full Name',
            'validation' => 'required|string'
        ],
        [
            'type' => 'email',
            'name' => 'email',
            'label' => 'Email',
            'validation' => 'required|email'
        ],
        [
            'type' => 'select',
            'name' => 'role',
            'label' => 'Role',
            'options' => ['admin' => 'Admin', 'user' => 'User'],
            'validation' => 'required'
        ],
        [
            'type' => 'row',
            'fields' => [
                ['type' => 'text', 'name' => 'first_name', 'label' => 'First Name'],
                ['type' => 'text', 'name' => 'last_name', 'label' => 'Last Name'],
            ]
        ]
    ],
    'buttons' => [
        ['type' => 'submit', 'label' => 'Save'],
        ['type' => 'reset', 'label' => 'Clear']
    ]
]);

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>User Form</h1>
        <?php echo $form->render(); ?>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
```

## Full Example: Bootstrap 5

```php
<?php

use BagasTopati\UiCore\Builders\FormBuilder;
use BagasTopati\UiCore\CssFrameworks\Bootstrap5Framework;
use BagasTopati\UiCore\UI;

UI::setFramework(new Bootstrap5Framework());

// SAME CODE AS BOOTSTRAP 4 EXAMPLE!
// Only change is the framework initialization
$form = FormBuilder::fromArray([
    'action' => '/users/store',
    'method' => 'POST',
    'fields' => [
        [
            'type' => 'text',
            'name' => 'name',
            'label' => 'Full Name',
            'validation' => 'required|string'
        ],
        [
            'type' => 'email',
            'name' => 'email',
            'label' => 'Email',
            'validation' => 'required|email'
        ],
        [
            'type' => 'select',
            'name' => 'role',
            'label' => 'Role',
            'options' => ['admin' => 'Admin', 'user' => 'User'],
            'validation' => 'required'
        ],
        [
            'type' => 'row',
            'fields' => [
                ['type' => 'text', 'name' => 'first_name', 'label' => 'First Name'],
                ['type' => 'text', 'name' => 'last_name', 'label' => 'Last Name'],
            ]
        ]
    ],
    'buttons' => [
        ['type' => 'submit', 'label' => 'Save'],
        ['type' => 'reset', 'label' => 'Clear']
    ]
]);

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>User Form</h1>
        <?php echo $form->render(); ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```

## Troubleshooting

### Form looks wrong with Bootstrap 4

**Issue:** Select field not styled correctly
**Solution:** Make sure `custom-select` class is present. Check that Bootstrap4Framework is set.

```php
UI::setFramework(new Bootstrap4Framework());
```

### Form looks wrong with Bootstrap 5

**Issue:** Custom styling from Bootstrap 4 not working
**Solution:** Bootstrap 5 removed `custom-select`. Use `form-select` instead (automatic with Bootstrap5Framework).

### jQuery errors with Bootstrap 5

**Issue:** `$ is not defined` errors
**Solution:** Bootstrap 5 doesn't need jQuery. Remove jQuery includes if migrating from Bootstrap 4.

## Environment Configuration

Set default framework via environment variable:

```bash
# .env
FORM_BUILDER_FRAMEWORK=bootstrap5
```

## Testing Bootstrap Versions

Run tests for Bootstrap compatibility:

```bash
php artisan test tests/Unit/BootstrapFrameworkTest.php
```

Tests verify correct CSS classes for both Bootstrap 4 and Bootstrap 5.

## CDN Resources

### Bootstrap 4
```html
<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<!-- JS (requires jQuery & Popper) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
```

### Bootstrap 5
```html
<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<!-- JS (bundle includes Popper, no jQuery) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
```

## Support & Issues

For Bootstrap-specific issues or feature requests, please open an issue on GitHub with:
- Bootstrap version
- PHP version
- FormBuilder version
- Form configuration example
- Expected vs actual output

Happy form building! 🚀
