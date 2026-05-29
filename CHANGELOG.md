# Changelog

All notable changes to this project will be documented in this file.

## [2.0.0] - 2026-05-29

### Added

#### New FormBuilder Array/JSON Support
- ✨ `FormBuilder::fromArray(array $config)` - Create forms from array configuration
- ✨ `FormBuilder::fromJson(string $json)` - Create forms from JSON configuration
- ✨ `FormBuilder::toArray()` - Export form structure to array
- ✨ `FormBuilder::toJson(int $options = 0)` - Export form structure to JSON

#### Validation Integration
- ✨ `FormBuilder::getValidationRules()` - Extract validation rules from field configuration
- ✨ `FormBuilder::getValidationMessages()` - Get validation messages
- Added support for HTML5 validation attributes (required, min, max, pattern)
- Integrated with Laravel validation rule syntax (required|email|max:255)

#### Field Type System
- ✨ Created `FieldType` contract for extensible field types
- Implemented built-in field type classes:
  - `TextFieldType` - Text input fields
  - `SelectFieldType` - Select/dropdown fields
  - `TextareaFieldType` - Textarea fields
  - `CheckboxFieldType` - Checkbox fields
  - `RadioFieldType` - Radio button fields

#### Laravel Package Integration
- ✨ Created `FormBuilderServiceProvider` for Laravel auto-discovery
- ✨ Added configuration file `config/form-builder.php`
- ✨ Created `FormBuilderFactory` for form creation
- Updated `composer.json` with Laravel framework requirements
- Added auto-discovery configuration for package

#### Constructor Enhancement
- Updated `FormBuilder::__construct()` to accept `$method` parameter
- Supports all HTTP methods: GET, POST, PUT, DELETE, PATCH

### Changed

- Updated package name from `gazz96/ui-core` to `gazz96/form-builder`
- Enhanced form configuration to support comprehensive field definitions
- Improved form attribute handling for better HTML generation

### Documentation

- 📚 Created comprehensive `README.md` with examples
- 📚 Created `USAGE.md` with detailed usage guide and examples
- 📚 Created `examples/form-builder-example.php` with real-world examples
- Added inline documentation and type hints

### Testing

- 📝 Created comprehensive unit tests in `tests/Unit/FormBuilderArrayTest.php`
- Test coverage includes:
  - Array configuration parsing
  - JSON configuration parsing
  - All field types
  - Button parsing
  - Form attributes
  - Validation rules extraction
  - Error handling and exceptions

### Examples

Updated `index.php` with:
- New example form using array configuration
- Demonstration of FormBuilder with both old fluent API and new array configuration

### Backward Compatibility

✅ **Fully Backward Compatible** - All existing FormBuilder methods continue to work:
- Fluent API methods (text(), email(), select(), etc.)
- Field methods (submit(), reset(), button())
- Form methods (post(), get(), put(), delete(), patch(), multipart())

## [1.0.0] - 2026-05-28

### Initial Release

- Basic FormBuilder with fluent API
- Support for multiple CSS frameworks (Bootstrap, Tailwind)
- Table builder with sorting, filtering, pagination
- Grid and layout components
- Modal, Alert, Card components
- Element builder for generic HTML elements
- Page builder for full HTML documents
- Navbar and Sidebar components
- Tab component
- Utility API for spacing, sizing, colors, flexbox

---

## Migration Guide: v1.x → v2.x

### For Existing Code

No changes needed! All existing code will continue to work:

```php
// This still works exactly as before
$form = UI::form('/action')
    ->text('name', 'Name')
    ->email('email', 'Email')
    ->submit('Save');
```

### New Recommended Pattern

For new forms, use the array/JSON configuration:

```php
// New approach - cleaner for complex forms
$form = FormBuilder::fromArray([
    'action' => '/action',
    'fields' => [
        ['type' => 'text', 'name' => 'name', 'label' => 'Name'],
        ['type' => 'email', 'name' => 'email', 'label' => 'Email'],
    ]
]);
```

### Benefits of Array/JSON Configuration

1. **Declarative** - Define form structure as data, not code
2. **Persistent** - Store form configuration in database or JSON files
3. **Validation Integration** - Extract validation rules automatically
4. **Transferable** - Export/import form configurations
5. **Dynamic** - Build forms from database or API responses

---

## Future Roadmap

- [ ] Custom field type registry
- [ ] Form validation attributes (aria-*, data-* attributes)
- [ ] Conditional field display
- [ ] Multi-step/wizard forms
- [ ] Form value binding from models
- [ ] CSRF token integration
- [ ] File upload preview
- [ ] Async field validation
- [ ] Form state management
- [ ] Blade component versions
