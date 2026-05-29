# Contributing to FormBuilder

Thank you for considering a contribution to FormBuilder! We appreciate your help in making this project better.

## How to Contribute

### Reporting Bugs

Before creating a bug report, please check the issue list to avoid duplicates. When creating a bug report, include:

- A clear, descriptive title
- A detailed description of the issue
- Steps to reproduce the issue
- Expected behavior
- Actual behavior
- Code examples (if applicable)
- Environment information (PHP version, Laravel version, etc.)

### Suggesting Enhancements

Enhancement suggestions are welcome! Please provide:

- A clear, descriptive title
- A detailed description of the enhancement
- Use cases and examples
- Why this enhancement would be useful

### Pull Requests

1. **Fork the repository** and create a new branch for your feature
   ```bash
   git checkout -b feature/your-feature-name
   ```

2. **Make your changes** following the code standards (see below)

3. **Write or update tests** for your changes
   ```bash
   composer test
   ```

4. **Update documentation** if needed

5. **Commit your changes** with clear commit messages
   ```bash
   git commit -m "feat: Add your feature description"
   ```

6. **Push to your fork** and create a Pull Request

## Code Standards

### PHP Style

- Follow PSR-12 coding standard
- Use PHP 8.1+ features
- Use type hints for all function parameters and return types
- Use meaningful variable and function names

### Code Example

```php
<?php

namespace BagasTopati\UiCore\Builders;

class MyClass
{
    public function myMethod(string $parameter): string
    {
        return strtoupper($parameter);
    }
}
```

### Naming Conventions

- **Classes**: PascalCase (e.g., `FormBuilder`, `Bootstrap5Framework`)
- **Methods/Functions**: camelCase (e.g., `renderField`, `parseFieldConfig`)
- **Constants**: UPPER_SNAKE_CASE (e.g., `DEFAULT_FRAMEWORK`)
- **Private properties**: camelCase with underscore prefix (e.g., `$_internalField`)

### Documentation

- Add PHPDoc comments to all public methods
- Include parameter and return type documentation
- Add examples for complex methods

Example:

```php
/**
 * Render a field as HTML
 *
 * @param array $field Field configuration array
 * @return string HTML representation of the field
 */
public function renderField(array $field): string
{
    // implementation
}
```

## Testing

### Running Tests

```bash
# Install dependencies
composer install

# Run all tests
composer test

# Run specific test file
composer test tests/Unit/FormBuilderArrayTest.php

# Run with code coverage
composer test -- --coverage-html coverage/
```

### Writing Tests

- Create test files in `tests/Unit/` or `tests/Feature/`
- Use descriptive test names: `test_should_render_text_field_with_validation`
- Test both success and failure cases
- Follow Arrange-Act-Assert pattern

Example:

```php
public function test_should_create_form_from_array_with_multiple_fields(): void
{
    // Arrange
    $config = [
        'action' => '/submit',
        'fields' => [
            ['type' => 'text', 'name' => 'email', 'label' => 'Email'],
        ]
    ];

    // Act
    $form = FormBuilder::fromArray($config);

    // Assert
    $this->assertNotNull($form);
}
```

## Git Commit Messages

Follow conventional commits format:

```
type(scope): subject

body

footer
```

**Types:**
- `feat`: A new feature
- `fix`: A bug fix
- `docs`: Documentation only changes
- `style`: Changes that don't affect code meaning (formatting, etc.)
- `refactor`: Code change that neither fixes a bug nor adds a feature
- `test`: Adding missing tests or correcting existing tests
- `chore`: Changes to build process, dependencies, etc.

**Examples:**
```
feat(form-builder): add support for Bootstrap 5

fix(renderer): escape HTML in field labels

docs(readme): update installation instructions

test(validation): add tests for email validation rules
```

## Development Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/gazz96/form-builder.git
   cd form-builder
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Run tests**
   ```bash
   composer test
   ```

4. **Create a feature branch**
   ```bash
   git checkout -b feature/your-feature-name
   ```

## Code Review Process

- At least one maintainer review is required
- All tests must pass
- Code coverage should not decrease
- Documentation must be updated
- Conventional commit format must be followed

## License

By contributing to this project, you agree that your contributions will be licensed under the MIT License.

## Questions?

Feel free to open an issue for any questions or concerns!

---

**Thank you for contributing to FormBuilder!**
