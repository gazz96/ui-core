# FormBuilder Usage Guide

Panduan lengkap untuk menggunakan FormBuilder package.

## Daftar Isi

1. [Instalasi](#instalasi)
2. [Konfigurasi](#konfigurasi)
3. [Membuat Form dari Array](#membuat-form-dari-array)
4. [Membuat Form dari JSON](#membuat-form-dari-json)
5. [Field Types](#field-types)
6. [Validasi](#validasi)
7. [CSS Framework](#css-framework)
8. [Contoh Penggunaan](#contoh-penggunaan)

## Instalasi

```bash
composer require bagastopati/form-builder
```

Laravel akan otomatis melakukan auto-discovery dan mendaftarkan service provider.

## Konfigurasi

Publish konfigurasi:

```bash
php artisan vendor:publish --tag=form-builder-config
```

Edit `config/form-builder.php` sesuai kebutuhan:

```php
return [
    'default_framework' => env('FORM_BUILDER_FRAMEWORK', 'tailwind'),
    'frameworks' => [
        'bootstrap' => BagasTopati\UiCore\CssFrameworks\BootstrapFramework::class,
        'tailwind' => BagasTopati\UiCore\CssFrameworks\TailwindFramework::class,
    ],
    'custom_field_types' => [],
];
```

## Membuat Form dari Array

### Syntax Dasar

```php
use BagasTopati\UiCore\Builders\FormBuilder;

$config = [
    'action' => '/submit',
    'method' => 'POST',
    'fields' => [
        // field definitions
    ]
];

$form = FormBuilder::fromArray($config);
echo $form->render();
```

### Struktur Array Lengkap

```php
[
    'action' => '/users/store',           // Form action URL (required)
    'method' => 'POST',                    // HTTP method: POST, GET, PUT, DELETE, PATCH (default: POST)
    'attributes' => [                      // Custom form attributes
        'class' => 'my-form',
        'id' => 'user-form',
        'novalidate' => true
    ],
    'fields' => [                          // Array of field configurations
        // field configurations here
    ],
    'buttons' => [                         // Array of button configurations
        // button configurations here
    ]
]
```

## Membuat Form dari JSON

```php
$json = '{
    "action": "/submit",
    "method": "POST",
    "fields": [
        {
            "type": "text",
            "name": "name",
            "label": "Your Name"
        }
    ]
}';

$form = FormBuilder::fromJson($json);
echo $form->render();
```

Ini sangat berguna untuk menyimpan form configuration di database atau file JSON.

## Field Types

### 1. Text Input Fields

#### Text
```php
[
    'type' => 'text',
    'name' => 'username',
    'label' => 'Username',
    'placeholder' => 'Enter username',
    'value' => 'john_doe',
    'attributes' => ['maxlength' => 20]
]
```

#### Email
```php
[
    'type' => 'email',
    'name' => 'email',
    'label' => 'Email Address'
]
```

#### Password
```php
[
    'type' => 'password',
    'name' => 'password',
    'label' => 'Password'
]
```

#### Number
```php
[
    'type' => 'number',
    'name' => 'age',
    'label' => 'Age',
    'attributes' => ['min' => 0, 'max' => 120]
]
```

#### Other Input Types
```php
// Telephone
['type' => 'tel', 'name' => 'phone', 'label' => 'Phone Number']

// URL
['type' => 'url', 'name' => 'website', 'label' => 'Website']

// Date
['type' => 'date', 'name' => 'birth_date', 'label' => 'Date of Birth']

// Time
['type' => 'time', 'name' => 'time', 'label' => 'Time']

// DateTime
['type' => 'datetime', 'name' => 'meeting_date', 'label' => 'Meeting Date']

// Color Picker
['type' => 'color', 'name' => 'color', 'label' => 'Pick Color']

// Range Slider
['type' => 'range', 'name' => 'volume', 'label' => 'Volume']

// Search
['type' => 'search', 'name' => 'query', 'label' => 'Search']

// Hidden
['type' => 'hidden', 'name' => 'token', 'value' => 'abc123']
```

### 2. Textarea

```php
[
    'type' => 'textarea',
    'name' => 'description',
    'label' => 'Description',
    'placeholder' => 'Enter description',
    'rows' => 5,
    'cols' => 40,
    'validation' => 'required|max:500'
]
```

### 3. Select (Dropdown)

```php
[
    'type' => 'select',
    'name' => 'role',
    'label' => 'Select Role',
    'options' => [
        'admin' => 'Administrator',
        'editor' => 'Editor',
        'viewer' => 'Viewer'
    ],
    'default' => 'viewer',
    'placeholder' => '-- Choose Role --',
    'validation' => 'required'
]
```

**Dengan Optgroup:**
```php
[
    'type' => 'select',
    'name' => 'country',
    'label' => 'Country',
    'options' => [
        'Asia' => [
            'id' => 'Indonesia',
            'ph' => 'Philippines',
            'my' => 'Malaysia'
        ],
        'Europe' => [
            'fr' => 'France',
            'de' => 'Germany'
        ]
    ]
]
```

### 4. Checkbox

```php
[
    'type' => 'checkbox',
    'name' => 'subscribe',
    'label' => 'Newsletter',
    'checkbox_label' => 'Subscribe to our newsletter',
    'default' => false,
    'validation' => 'nullable'
]
```

### 5. Radio

```php
[
    'type' => 'radio',
    'name' => 'gender',
    'label' => 'Gender',
    'options' => [
        'M' => 'Male',
        'F' => 'Female',
        'O' => 'Other'
    ],
    'default' => 'M',
    'validation' => 'required|in:M,F,O'
]
```

### 6. File Upload

```php
[
    'type' => 'file',
    'name' => 'avatar',
    'label' => 'Profile Picture',
    'accept' => 'image/*',
    'attributes' => ['multiple' => false],
    'validation' => 'required|image|max:2048'
]
```

### 7. Grouped Fields (Fieldset)

```php
[
    'type' => 'group',
    'label' => 'Address Information',
    'fields' => [
        [
            'type' => 'text',
            'name' => 'street',
            'label' => 'Street Address'
        ],
        [
            'type' => 'text',
            'name' => 'city',
            'label' => 'City'
        ]
    ]
]
```

### 8. Row Layout (Multi-Column)

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

## Validasi

### Menyimpan Validation Rules

Definisikan aturan validasi dalam field configuration:

```php
$config = [
    'action' => '/submit',
    'fields' => [
        [
            'type' => 'text',
            'name' => 'email',
            'validation' => 'required|email|unique:users'
        ],
        [
            'type' => 'password',
            'name' => 'password',
            'validation' => 'required|min:8|confirmed'
        ]
    ]
];
```

### Mengekstrak Validation Rules

```php
$form = FormBuilder::fromArray($config);
$rules = $form->getValidationRules();

// Result:
// [
//     'email' => 'required|email|unique:users',
//     'password' => 'required|min:8|confirmed'
// ]

// Gunakan dengan Laravel Validator
$validated = validator($request->all(), $rules)->validate();
```

### Validation Rules yang Didukung

FormBuilder mendukung semua Laravel validation rules:

- `required` - Field harus diisi
- `email` - Format email yang valid
- `unique:table` - Nilai unik di database
- `min:value` - Nilai minimum
- `max:value` - Nilai maksimum
- `confirmed` - Harus match dengan field `_confirmation`
- `in:value1,value2` - Nilai harus salah satu dari daftar
- `string` - Harus string
- `integer` - Harus integer
- `numeric` - Harus numeric
- `image` - Harus file image
- `mimes:jpeg,png` - Format file yang diterima
- Dan banyak lagi...

## CSS Framework

### Bootstrap

```php
use BagasTopati\UiCore\UI;

UI::useBootstrap();

$form = FormBuilder::fromArray($config);
echo $form->render();
```

### Tailwind

```php
UI::useTailwind();

$form = FormBuilder::fromArray($config);
echo $form->render();
```

### Custom Framework

Buat custom CSS framework dengan mengimplementasikan `CssFramework` contract.

## Contoh Penggunaan

### 1. Contact Form Sederhana

```php
use BagasTopati\UiCore\Builders\FormBuilder;

$form = FormBuilder::fromArray([
    'action' => '/contact',
    'method' => 'POST',
    'fields' => [
        [
            'type' => 'text',
            'name' => 'name',
            'label' => 'Your Name',
            'validation' => 'required|string'
        ],
        [
            'type' => 'email',
            'name' => 'email',
            'label' => 'Email Address',
            'validation' => 'required|email'
        ],
        [
            'type' => 'textarea',
            'name' => 'message',
            'label' => 'Message',
            'rows' => 5,
            'validation' => 'required|string|max:1000'
        ]
    ],
    'buttons' => [
        ['type' => 'submit', 'label' => 'Send Message']
    ]
]);

echo $form->render();
```

### 2. User Registration Form

```php
$form = FormBuilder::fromArray([
    'action' => route('register'),
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
            'validation' => 'required'
        ],
        [
            'type' => 'checkbox',
            'name' => 'agree',
            'checkbox_label' => 'I agree to Terms & Conditions',
            'validation' => 'required'
        ]
    ],
    'buttons' => [
        ['type' => 'submit', 'label' => 'Register']
    ]
]);

echo $form->render();
```

### 3. Dalam Blade Template

```blade
@php
    $config = [
        'action' => '/users/store',
        'method' => 'POST',
        'fields' => [
            ['type' => 'text', 'name' => 'name', 'label' => 'Name'],
            ['type' => 'email', 'name' => 'email', 'label' => 'Email'],
        ],
        'buttons' => [
            ['type' => 'submit', 'label' => 'Save']
        ]
    ];

    $form = \BagasTopati\UiCore\Builders\FormBuilder::fromArray($config);
@endphp

{!! $form->render() !!}
```

### 4. Export & Import Form Configuration

```php
// Export ke JSON untuk disimpan di database
$form = FormBuilder::fromArray($config);
$json = $form->toJson(JSON_PRETTY_PRINT);

// Simpan ke database
$formDefinition = FormDefinition::create([
    'name' => 'User Registration',
    'config' => $json
]);

// Load dari database
$formDef = FormDefinition::find($id);
$form = FormBuilder::fromJson($formDef->config);
echo $form->render();
```

### 5. Dengan Fluent API (Tetap Didukung)

```php
// FormBuilder masih mendukung fluent API lama
$form = FormBuilder::fromArray(['action' => '/test', 'fields' => []])
    ->text('name', 'Name')
    ->email('email', 'Email')
    ->submit('Save');

echo $form->render();
```

## Tips & Tricks

### 1. Reusable Form Components

Simpan form config di file terpisah:

```php
// app/Forms/UserFormConfig.php
namespace App\Forms;

class UserFormConfig
{
    public static function config(): array
    {
        return [
            'action' => '/users/store',
            'method' => 'POST',
            'fields' => [
                // ...
            ]
        ];
    }
}

// Dalam controller atau template
use App\Forms\UserFormConfig;
use BagasTopati\UiCore\Builders\FormBuilder;

$form = FormBuilder::fromArray(UserFormConfig::config());
```

### 2. Dynamic Form Configuration

```php
$roles = Role::all()->pluck('name', 'id')->toArray();

$config = [
    'action' => '/users/store',
    'fields' => [
        [
            'type' => 'select',
            'name' => 'role_id',
            'label' => 'Role',
            'options' => $roles,
            'validation' => 'required|exists:roles,id'
        ]
    ]
];

$form = FormBuilder::fromArray($config);
```

### 3. Conditional Fields

Tambahkan logic di form config:

```php
$config = [
    'action' => '/test',
    'fields' => [
        [
            'type' => 'select',
            'name' => 'user_type',
            'label' => 'User Type',
            'options' => ['individual' => 'Individual', 'company' => 'Company']
        ]
    ]
];

// Tambah field company jika diperlukan via JavaScript/Alpine/Vue
```

### 4. Validate dan Render Bersamaan

```php
$form = FormBuilder::fromArray($config);
$rules = $form->getValidationRules();

// Validate request
try {
    $validated = validator($request->all(), $rules)->validate();
} catch (\Illuminate\Validation\ValidationException $e) {
    // Re-render form dengan old values
    return back()->withErrors($e->validator)->withInput();
}
```

Selamat menggunakan FormBuilder! Jika ada pertanyaan, silakan buka issue di GitHub.
