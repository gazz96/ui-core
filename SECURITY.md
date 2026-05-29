# Security Policy

## Supported Versions

| Version | Supported          |
| ------- | ------------------ |
| 2.x     | :white_check_mark: |
| 1.x     | :x:                |

## Reporting a Vulnerability

If you discover a security vulnerability in this project, please email **bagas.topati@gmail.com** instead of using the issue tracker.

Please include the following details:

- Description of the vulnerability
- Steps to reproduce
- Potential impact
- Suggested fix (if any)

We will respond to security reports within 48 hours and will work to fix verified vulnerabilities as quickly as possible.

## Security Considerations

### XSS Prevention

This form builder automatically escapes output to prevent XSS attacks. All user input is HTML-escaped before rendering.

### CSRF Protection

When using Laravel, ensure CSRF middleware is enabled. Add `@csrf` token to your forms:

```php
// In Blade template
<form action="/submit" method="POST">
    @csrf
    <!-- form fields -->
</form>
```

Or if using array configuration with Laravel request:

```php
'fields' => [
    // ... your fields
]
// Remember to validate on backend with Laravel validator
```

### Input Validation

Always validate form input on the server-side. The form builder provides validation rule extraction via `getValidationRules()`, but never rely solely on client-side validation.

Example with Laravel Validator:

```php
$form = FormBuilder::fromArray($config);
$rules = $form->getValidationRules();

validator($request->all(), $rules)->validate();
```

### SQL Injection

This form builder generates HTML only. SQL injection prevention is your responsibility when handling form data. Always use parameterized queries or Eloquent ORM:

```php
// Good - Using Eloquent
User::where('email', $request->email)->first();

// Good - Using prepared statements
DB::select('SELECT * FROM users WHERE email = ?', [$request->email]);

// Bad - Don't do this
DB::select("SELECT * FROM users WHERE email = '{$request->email}'");
```

## Best Practices

1. **Always validate on the backend** - Never rely solely on client-side validation
2. **Use HTTPS** - Ensure all forms are submitted over secure connections
3. **Sanitize output** - The builder escapes output, but sanitize when displaying user data
4. **Keep dependencies updated** - Regularly update Laravel and other dependencies
5. **Use environment variables** - Never hardcode sensitive information

## Known Issues

None currently known. Please report any security concerns responsibly.
