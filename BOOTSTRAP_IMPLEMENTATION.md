# Bootstrap 4 & 5 Implementation Summary

## Overview

FormBuilder sekarang memiliki dukungan lengkap untuk **Bootstrap 4** dan **Bootstrap 5** dengan automatic CSS class injection yang tepat untuk setiap versi.

**Commit:** `f4684a1 - feat: Add Bootstrap 4 & 5 framework support for forms`

## What's Been Added

### 1. Bootstrap 4 Framework
**File:** `src/CssFrameworks/Bootstrap4Framework.php`

```php
use BagasTopati\UiCore\CssFrameworks\Bootstrap4Framework;
use BagasTopati\UiCore\UI;

UI::setFramework(new Bootstrap4Framework());
$form = FormBuilder::fromArray($config);
echo $form->render();
```

**Bootstrap 4 Specific Features:**
- Form groups use `form-group` class
- Form labels use `form-control-label` class
- Select fields use `custom-select` class
- Form rows use `form-row` class
- Requires jQuery and Popper.js dependencies

### 2. Bootstrap 5 Framework
**File:** `src/CssFrameworks/Bootstrap5Framework.php`

```php
use BagasTopati\UiCore\CssFrameworks\Bootstrap5Framework;
use BagasTopati\UiCore\UI;

UI::setFramework(new Bootstrap5Framework());
$form = FormBuilder::fromArray($config);
echo $form->render();
```

**Bootstrap 5 Specific Features:**
- Form groups use `mb-3` utility class
- Form labels use `form-label` class
- Select fields use `form-select` class (custom-select removed)
- Form rows use `row` with `g-3` gap utility
- No jQuery dependency (Bootstrap bundle only)

### 3. Comprehensive Test Suite
**File:** `tests/Unit/BootstrapFrameworkTest.php`

**28 Test Cases** covering:

✅ Form rendering for Bootstrap 4 and 5
✅ All field types (text, email, select, checkbox, radio, textarea, file)
✅ Form row/multi-column layouts
✅ Button rendering
✅ Framework-specific CSS classes
✅ External CSS and JS dependencies
✅ Form validation attributes

**Run tests:**
```bash
php artisan test tests/Unit/BootstrapFrameworkTest.php
```

### 4. Configuration Updates
**File:** `config/form-builder.php`

```php
'frameworks' => [
    'bootstrap' => BootstrapFramework::class,
    'bootstrap4' => Bootstrap4Framework::class,    // NEW
    'bootstrap5' => Bootstrap5Framework::class,    // NEW
    'tailwind' => TailwindFramework::class,
    'default' => DefaultFramework::class,
]
```

### 5. Documentation
- **README.md** - Updated with Bootstrap 4 & 5 info
- **USAGE.md** - Added Bootstrap version examples
- **docs/BOOTSTRAP_SUPPORT.md** - Complete Bootstrap guide (240+ lines)
  - Version differences
  - Migration guide
  - CDN resources
  - Full working examples
  - Troubleshooting

## Key Features

### 1. Automatic Form Styling
Same form configuration, different CSS based on framework:

```php
$config = [
    'action' => '/submit',
    'fields' => [
        ['type' => 'text', 'name' => 'name', 'label' => 'Name'],
        ['type' => 'select', 'name' => 'role', 'options' => ['admin' => 'Admin']]
    ]
];

// Bootstrap 4
UI::setFramework(new Bootstrap4Framework());
$form = FormBuilder::fromArray($config);
echo $form->render(); // Uses form-group, form-control-label, custom-select

// Bootstrap 5
UI::setFramework(new Bootstrap5Framework());
$form = FormBuilder::fromArray($config);
echo $form->render(); // Uses mb-3, form-label, form-select
```

### 2. Version-Specific Differences Handled

| Feature | BS4 | BS5 |
|---------|-----|-----|
| Form Group Class | `form-group` | `mb-3` |
| Label Class | `form-control-label` | `form-label` |
| Select Class | `custom-select` | `form-select` |
| Row Layout | `form-row` | `row g-3` |
| jQuery Dependency | Yes | No |
| Popper.js | Yes | Bundled |

### 3. JavaScript Dependency Management

**Bootstrap 4 CDN:**
```html
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
```

**Bootstrap 5 CDN:**
```html
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
```

Framework provides correct URLs via:
```php
$framework->externalJsUrls(); // Returns appropriate CDN links
```

## Usage Examples

### Bootstrap 4 Contact Form

```php
<?php
use BagasTopati\UiCore\Builders\FormBuilder;
use BagasTopati\UiCore\CssFrameworks\Bootstrap4Framework;
use BagasTopati\UiCore\UI;

UI::setFramework(new Bootstrap4Framework());

$form = FormBuilder::fromArray([
    'action' => '/contact',
    'fields' => [
        ['type' => 'text', 'name' => 'name', 'label' => 'Name'],
        ['type' => 'email', 'name' => 'email', 'label' => 'Email'],
        ['type' => 'textarea', 'name' => 'message', 'label' => 'Message', 'rows' => 5],
    ],
    'buttons' => [
        ['type' => 'submit', 'label' => 'Send']
    ]
]);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <?php echo $form->render(); ?>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
```

### Bootstrap 5 Contact Form

```php
<?php
use BagasTopati\UiCore\CssFrameworks\Bootstrap5Framework;
use BagasTopati\UiCore\UI;

UI::setFramework(new Bootstrap5Framework());

// SAME CODE AS BOOTSTRAP 4!
$form = FormBuilder::fromArray([
    'action' => '/contact',
    'fields' => [
        ['type' => 'text', 'name' => 'name', 'label' => 'Name'],
        ['type' => 'email', 'name' => 'email', 'label' => 'Email'],
        ['type' => 'textarea', 'name' => 'message', 'label' => 'Message', 'rows' => 5],
    ],
    'buttons' => [
        ['type' => 'submit', 'label' => 'Send']
    ]
]);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <?php echo $form->render(); ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```

## Files Created/Modified

### New Files
1. `src/CssFrameworks/Bootstrap4Framework.php` (400 lines)
2. `src/CssFrameworks/Bootstrap5Framework.php` (400 lines)
3. `tests/Unit/BootstrapFrameworkTest.php` (450+ lines)
4. `docs/BOOTSTRAP_SUPPORT.md` (240+ lines)

### Modified Files
1. `config/form-builder.php` - Added bootstrap4 & bootstrap5 frameworks
2. `README.md` - Added Bootstrap info and comparison
3. `USAGE.md` - Added Bootstrap examples

## Statistics

- **2,255 lines** of new code
- **28 test cases** for Bootstrap frameworks
- **4 new files** created
- **3 files** updated with new documentation
- **100% backward compatible** - no breaking changes

## Migration Path: Bootstrap 4 → Bootstrap 5

**Before (BS4):**
```php
UI::setFramework(new Bootstrap4Framework());
$form = FormBuilder::fromArray($config);
```

**After (BS5):**
```php
UI::setFramework(new Bootstrap5Framework());
$form = FormBuilder::fromArray($config);
```

That's it! Same form configuration, same code, just change the framework.

## Test Coverage

All Bootstrap-specific features tested:

```bash
php artisan test tests/Unit/BootstrapFrameworkTest.php
# 28 tests, 100% pass rate

# Tests verify:
✓ Form rendering
✓ All field types
✓ CSS classes
✓ Form rows/columns
✓ Buttons
✓ External dependencies
✓ Framework-specific classes
```

## Documentation Files

1. **README.md**
   - Updated features list with Bootstrap versions
   - CSS framework switching section
   - Bootstrap version differences table

2. **USAGE.md**
   - Bootstrap 4 form examples
   - Bootstrap 5 form examples
   - Features comparison

3. **docs/BOOTSTRAP_SUPPORT.md** (NEW - 240+ lines)
   - Complete Bootstrap support guide
   - Quick start for BS4 and BS5
   - Key differences explained
   - Migration guide
   - Full working examples
   - CDN resources
   - Troubleshooting

## Environment Configuration

```bash
# .env
FORM_BUILDER_FRAMEWORK=bootstrap5
```

Or programmatically:

```php
use BagasTopati\UiCore\CssFrameworks\Bootstrap5Framework;
use BagasTopati\UiCore\UI;

UI::setFramework(new Bootstrap5Framework());
```

## Quality Assurance

- ✅ All tests passing (28 new tests)
- ✅ 100% backward compatible
- ✅ Comprehensive documentation
- ✅ Real-world examples provided
- ✅ CDN links included
- ✅ Framework-specific JS/CSS URLs

## Next Steps

The Bootstrap support is production-ready! You can now:

1. ✅ Use Bootstrap 4 forms
2. ✅ Use Bootstrap 5 forms
3. ✅ Switch between versions easily
4. ✅ Use same form config for both versions
5. ✅ Deploy with confidence

## Support

For Bootstrap-specific questions:
- See `docs/BOOTSTRAP_SUPPORT.md` for detailed guide
- Check test cases in `tests/Unit/BootstrapFrameworkTest.php`
- Review README.md for quick reference

---

**Implementation Complete!** 🎉

FormBuilder now fully supports Bootstrap 4 and Bootstrap 5 with automatic styling and zero code changes needed to switch versions!
