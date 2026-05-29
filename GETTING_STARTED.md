# FormBuilder - Getting Started Guide

Selamat datang ke **FormBuilder**! Panduan ini akan membantu Anda memulai dengan package kami.

## 🎯 Tujuan Anda?

### 1. 👨‍💻 **Saya ingin menggunakan FormBuilder di project saya**

**Start dengan:**
1. [README.md](README.md) - Overview dan features
2. [USAGE.md](USAGE.md) - Contoh penggunaan lengkap
3. [examples/](examples/) - Working examples

**Installation:**
```bash
composer require bagastopati/form-builder
```

### 2. 🚀 **Saya ingin upload package ke Packagist**

**Follow panduan di:**
1. [QUICK_PACKAGIST_SUMMARY.md](QUICK_PACKAGIST_SUMMARY.md) - Quick reference (5 steps)
2. [PACKAGIST_GUIDE.md](PACKAGIST_GUIDE.md) - Complete detailed guide

**Quick Overview:**
- Push ke GitHub
- Register di Packagist
- Submit package
- Setup webhook

### 3. 🎓 **Saya ingin belajar FormBuilder secara mendalam**

**Learning Path:**
1. [README.md](README.md) - Mulai dari sini (5 min)
2. [USAGE.md](USAGE.md) - Detail guide (20 min)
3. [docs/BOOTSTRAP_SUPPORT.md](docs/BOOTSTRAP_SUPPORT.md) - Bootstrap guide (10 min)
4. [examples/](examples/) - Explore examples (10 min)

### 4. 🔧 **Saya ingin contribute ke project**

**Read:**
1. [CONTRIBUTING.md](CONTRIBUTING.md) - Contribution guidelines
2. [SECURITY.md](SECURITY.md) - Security guidelines
3. Explore [tests/](tests/) - Understand testing

---

## 📚 Documentation Index

| File | Tujuan | Durasi |
|------|--------|--------|
| [README.md](README.md) | Overview dan quick start | 5 min |
| [USAGE.md](USAGE.md) | Complete usage guide | 20 min |
| [EXAMPLES_GUIDE.md](EXAMPLES_GUIDE.md) | Guide untuk examples | 10 min |
| [docs/BOOTSTRAP_SUPPORT.md](docs/BOOTSTRAP_SUPPORT.md) | Bootstrap 4 & 5 guide | 15 min |
| [PACKAGIST_GUIDE.md](PACKAGIST_GUIDE.md) | Detailed upload guide | 20 min |
| [QUICK_PACKAGIST_SUMMARY.md](QUICK_PACKAGIST_SUMMARY.md) | Quick reference | 3 min |
| [PROJECT_STATUS.md](PROJECT_STATUS.md) | Project overview | 10 min |
| [CONTRIBUTING.md](CONTRIBUTING.md) | Contribution guidelines | 10 min |
| [SECURITY.md](SECURITY.md) | Security guidelines | 10 min |

---

## 🚀 Quick Start

### Installation

```bash
composer require bagastopati/form-builder
```

### Basic Usage - Array Configuration

```php
use BagasTopati\UiCore\Builders\FormBuilder;

$form = FormBuilder::fromArray([
    'action' => '/users/store',
    'method' => 'POST',
    'fields' => [
        ['type' => 'text', 'name' => 'name', 'label' => 'Name'],
        ['type' => 'email', 'name' => 'email', 'label' => 'Email'],
        ['type' => 'password', 'name' => 'password', 'label' => 'Password'],
    ],
    'buttons' => [
        ['type' => 'submit', 'label' => 'Create User'],
    ]
]);

echo $form->render();
```

### Basic Usage - Fluent API

```php
use BagasTopati\UiCore\UI;

$form = UI::form('/users/store')
    ->text('name', 'Full Name')
    ->email('email', 'Email Address')
    ->password('password', 'Password')
    ->submit('Create User');

echo $form->render();
```

### Framework Selection

```php
use BagasTopati\UiCore\UI;
use BagasTopati\UiCore\CssFrameworks\Bootstrap5Framework;

// Set framework
UI::setFramework(new Bootstrap5Framework());

// Your form config now uses Bootstrap 5 classes
$form = FormBuilder::fromArray($config);
echo $form->render();
```

---

## 📖 Features Overview

### ✅ Supported Field Types

```
text, email, password, tel, number, url, date, time,
color, range, search, hidden, file, textarea, select,
checkbox, radio, group, row
```

### ✅ CSS Frameworks

```
Bootstrap 4 (form-group, form-control-label, etc.)
Bootstrap 5 (mb-3, form-label, form-select, etc.)
Tailwind CSS (utility-first, px-4, py-2, etc.)
```

### ✅ Key Features

- Array/JSON configuration
- Fluent API
- Validation integration
- Multi-column layouts (row type)
- Field grouping (group type)
- Custom field types
- HTML5 validation

---

## 🎯 Common Tasks

### Extract Validation Rules

```php
$form = FormBuilder::fromArray($config);
$rules = $form->getValidationRules();

// Use with Laravel validator
validator($request->all(), $rules)->validate();
```

### Create Multi-Column Form

```php
'fields' => [
    ['type' => 'text', 'name' => 'first_name', 'label' => 'First Name'],
    ['type' => 'row', 'fields' => [
        ['type' => 'number', 'name' => 'price', 'label' => 'Price'],
        ['type' => 'number', 'name' => 'stock', 'label' => 'Stock'],
    ]],
]
```

### Create Custom Field Type

Lihat [CONTRIBUTING.md](CONTRIBUTING.md) untuk detailed instructions.

---

## ❓ FAQ

**Q: Apakah saya perlu install dependencies lain?**  
A: Tidak! Hanya PHP 8.1+ dan Laravel (untuk service provider).

**Q: Bisa switch framework tanpa ubah code?**  
A: Ya! Cukup ubah `UI::setFramework()` call.

**Q: Dimana example forms?**  
A: Lihat folder [examples/](examples/) dengan 12 contoh forms.

**Q: Apakah backward compatible?**  
A: Ya, 100% backward compatible dengan existing FormBuilder code.

**Q: Bagaimana cara contribute?**  
A: Lihat [CONTRIBUTING.md](CONTRIBUTING.md) untuk guidelines.

---

## 🔗 Useful Links

- **GitHub**: https://github.com/bagastopati/form-builder
- **Packagist**: https://packagist.org/packages/bagastopati/form-builder
- **Laravel Docs**: https://laravel.com/docs
- **Bootstrap 4**: https://getbootstrap.com/docs/4.6/
- **Bootstrap 5**: https://getbootstrap.com/docs/5.3/
- **Tailwind CSS**: https://tailwindcss.com/docs

---

## 📞 Need Help?

1. **Usage Questions?** → Check [USAGE.md](USAGE.md)
2. **Bootstrap Issues?** → Check [docs/BOOTSTRAP_SUPPORT.md](docs/BOOTSTRAP_SUPPORT.md)
3. **Packagist Help?** → Check [PACKAGIST_GUIDE.md](PACKAGIST_GUIDE.md)
4. **Want to Contribute?** → Check [CONTRIBUTING.md](CONTRIBUTING.md)
5. **Security Issue?** → Check [SECURITY.md](SECURITY.md)

---

## 🎉 Next Steps

1. **Install** the package
2. **Read** README.md
3. **Try** the examples
4. **Build** your first form
5. **Explore** advanced features

Happy form building! 🚀
