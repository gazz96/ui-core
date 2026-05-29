# FormBuilder Examples Guide

Panduan lengkap untuk menjalankan dan memahami contoh FormBuilder untuk setiap CSS framework.

## 📋 Daftar Contoh

Kami menyediakan **3 file contoh standalone** yang dapat diakses langsung di browser:

1. **contoh-bootstrap4.php** - FormBuilder dengan Bootstrap 4
2. **contoh-bootstrap5.php** - FormBuilder dengan Bootstrap 5
3. **contoh-tailwind.php** - FormBuilder dengan Tailwind CSS

Setiap file menampilkan **4 form yang sama** dengan styling yang berbeda:

1. Form Kontak Sederhana
2. Form Pendaftaran Pengguna
3. Form Produk dengan Multi-column Layout
4. Form Survei

---

## 🚀 Cara Mengakses Contoh

### Opsi 1: Via Web Server (Rekomendasi)

Jika Anda menggunakan Laragon atau XAMPP:

```
http://localhost/ui-core/examples/contoh-bootstrap4.php
http://localhost/ui-core/examples/contoh-bootstrap5.php
http://localhost/ui-core/examples/contoh-tailwind.php
```

### Opsi 2: PHP Built-in Server

```bash
cd examples
php -S localhost:8000
# Kemudian akses:
# http://localhost:8000/contoh-bootstrap4.php
```

---

## 📊 Perbandingan Framework

### Bootstrap 4 Example
**File:** `examples/contoh-bootstrap4.php`

**Karakteristik:**
- CSS Framework: Bootstrap 4.6.2
- Form Group Class: `form-group`
- Label Class: `form-control-label`
- Select Class: `custom-select`
- Row Layout: `form-row`
- Dependencies: jQuery + Popper.js + Bootstrap JS

**Kode Setup:**
```php
use BagasTopati\UiCore\CssFrameworks\Bootstrap4Framework;
use BagasTopati\UiCore\UI;

UI::setFramework(new Bootstrap4Framework());
```

---

### Bootstrap 5 Example
**File:** `examples/contoh-bootstrap5.php`

**Karakteristik:**
- CSS Framework: Bootstrap 5.3.0
- Form Group Class: `mb-3` (utility)
- Label Class: `form-label`
- Select Class: `form-select`
- Row Layout: `row g-3`
- Dependencies: Bootstrap Bundle only (no jQuery!)

**Kode Setup:**
```php
use BagasTopati\UiCore\CssFrameworks\Bootstrap5Framework;
use BagasTopati\UiCore\UI;

UI::setFramework(new Bootstrap5Framework());
```

**Keuntungan vs Bootstrap 4:**
- ✅ Tidak perlu jQuery
- ✅ Lebih ringan
- ✅ CSS classes yang lebih modern
- ✅ Better responsive design

---

### Tailwind CSS Example
**File:** `examples/contoh-tailwind.php`

**Karakteristik:**
- CSS Framework: Tailwind CSS (CDN)
- Approach: Utility-first
- Customizable: Fully via Tailwind config
- Responsive: Mobile-first design
- Dependencies: None (Tailwind JS via CDN)

**Kode Setup:**
```php
use BagasTopati\UiCore\CssFrameworks\TailwindFramework;
use BagasTopati\UiCore\UI;

UI::setFramework(new TailwindFramework());
```

**Keuntungan:**
- ✅ Highly customizable
- ✅ Utility-first approach
- ✅ JIT compilation (smaller bundle)
- ✅ Dark mode support
- ✅ No class conflicts

---

## 🎯 Form Examples Dalam Setiap File

### 1. Form Kontak Sederhana

Mendemonstrasikan:
- Text input
- Email input
- Telephone input
- Select dropdown
- Textarea
- Checkbox

**Fitur:**
```php
[
    'type' => 'text',
    'name' => 'name',
    'label' => 'Nama Anda',
    'placeholder' => 'Masukkan nama lengkap',
    'validation' => 'required|string|max:255'
]
```

---

### 2. Form Pendaftaran Pengguna

Mendemonstrasikan:
- Multiple text inputs
- Email validation
- Password fields dengan confirmation
- Select (untuk country)
- Date input
- Radio buttons
- Checkbox validation

**Fitur Khusus:**
- Password confirmation validation
- Unique email validation
- Date field dengan before validation
- Multiple validation rules

---

### 3. Form Produk dengan Multi-column

Mendemonstrasikan:
- **Row field** untuk multi-column layout
- File upload field
- Number inputs
- Textarea
- Checkbox

**Fitur Khusus:**
```php
[
    'type' => 'row',
    'fields' => [
        ['type' => 'number', 'name' => 'price', 'label' => 'Harga'],
        ['type' => 'number', 'name' => 'stock', 'label' => 'Stok'],
    ]
]
```

**Layout Rendering:**
- Bootstrap 4: `form-row` class
- Bootstrap 5: `row g-3` classes
- Tailwind: Grid utilities

---

### 4. Form Survei

Mendemonstrasikan:
- Radio buttons
- Checkbox
- Textarea
- Simple validation

---

## 🔍 Membandingkan Framework

Untuk melihat perbedaan CSS classes antar framework:

1. Buka **contoh-bootstrap4.php** di browser
2. Buka **Developer Tools** (F12)
3. **Inspect Element** untuk melihat CSS classes
4. Bandingkan dengan **contoh-bootstrap5.php** dan **contoh-tailwind.php**

**Contoh: Form Group Classes**

**Bootstrap 4:**
```html
<div class="form-group">
  <label class="form-control-label">Name</label>
  <input type="text" class="form-control">
</div>
```

**Bootstrap 5:**
```html
<div class="mb-3">
  <label class="form-label">Name</label>
  <input type="text" class="form-control">
</div>
```

**Tailwind CSS:**
```html
<div class="mb-3">
  <label class="block mb-1 font-medium">Name</label>
  <input type="text" class="border rounded px-3 py-2">
</div>
```

---

## 💡 Tips Menggunakan Contoh

### 1. Modify the Examples
Edit file contoh untuk experiment:

```php
// Tambah field baru
[
    'type' => 'color',
    'name' => 'favorite_color',
    'label' => 'Warna Favorit'
]
```

### 2. Copy Code
Salin bagian yang relevan untuk digunakan di project Anda:

```php
$form = FormBuilder::fromArray([
    'action' => '/my-form',
    'fields' => [
        // Copy from examples...
    ]
]);

echo $form->render();
```

### 3. Test Validation
Form-form contoh sudah dilengkapi dengan validation rules. Test dengan:

```php
$form = FormBuilder::fromArray($config);
$rules = $form->getValidationRules();
// Use dengan Laravel validator
```

### 4. Compare Frameworks
Gunakan examples untuk memilih framework yang tepat:

- **Bootstrap 4** - Legacy support
- **Bootstrap 5** - Modern, no jQuery
- **Tailwind** - Highly customizable, smallest bundle

---

## 🎨 Styling Customization

### Bootstrap 4
```php
'attributes' => [
    'class' => 'shadow-sm p-4 rounded'
]
```

### Bootstrap 5
```php
'attributes' => [
    'class' => 'shadow-sm p-4 rounded'
]
```

### Tailwind CSS
```php
'attributes' => [
    'class' => 'shadow-sm p-4 rounded-lg max-w-2xl mx-auto'
]
```

---

## 📁 File Struktur

```
examples/
├── form-builder-example.php     (General examples - 7 forms)
├── contoh-bootstrap4.php        (Bootstrap 4 - 4 forms)
├── contoh-bootstrap5.php        (Bootstrap 5 - 4 forms)
└── contoh-tailwind.php          (Tailwind CSS - 4 forms)
```

---

## 🔗 Related Files

- **examples/form-builder-example.php** - Detailed examples dengan documentation lengkap
- **USAGE.md** - Complete usage guide
- **docs/BOOTSTRAP_SUPPORT.md** - Bootstrap framework guide
- **README.md** - Feature overview

---

## ✅ Checklist Experiment

Ketika menggunakan examples, coba:

- [ ] Buka masing-masing file di browser
- [ ] Bandingkan visual styling antar framework
- [ ] Inspect element untuk melihat CSS classes
- [ ] Modify salah satu field
- [ ] Add field baru
- [ ] Test form submission (akan ke action URL)
- [ ] Lihat validation rules di developer console
- [ ] Copy dan adapt ke project Anda

---

## 🐛 Troubleshooting

### CSS tidak muncul

**Solusi:** Pastikan CDN link accessible:
- Bootstrap 4: Perlu jQuery + Popper.js + Bootstrap JS
- Bootstrap 5: Hanya perlu Bootstrap bundle
- Tailwind: Akses Tailwind Play CDN

### Form tidak render

**Solusi:** Pastikan:
1. Framework sudah di-set dengan `UI::setFramework()`
2. File contoh di-include dengan `require_once`
3. Tidak ada error PHP

### Styling tidak sesuai

**Solusi:** 
1. Check framework yang digunakan
2. Verify CSS adalah yang tepat
3. Check browser compatibility

---

## 📖 Learning Path

1. **Start Here:** Buka `contoh-bootstrap5.php` di browser
2. **Compare:** Buka `contoh-bootstrap4.php` dan bandingkan
3. **Explore:** Inspect element untuk lihat CSS classes
4. **Experiment:** Modify form configuration
5. **Learn:** Baca USAGE.md untuk detail
6. **Create:** Buat form Anda sendiri

---

## 🎓 Educational Purpose

Contoh-contoh ini berfungsi untuk:

✅ Memahami FormBuilder capabilities
✅ Melihat perbedaan antar framework
✅ Belajar form structure dan configuration
✅ Copying dan adapting ke project
✅ Testing dan experimenting
✅ Best practices reference

---

## 📞 Support

Jika ada pertanyaan tentang examples:

1. Check **USAGE.md** untuk dokumentasi lengkap
2. Check **docs/BOOTSTRAP_SUPPORT.md** untuk Bootstrap detail
3. Read code di file contoh
4. Lihat test cases di `tests/Unit/` folder

---

## 🚀 Next Steps

Setelah memahami examples:

1. Choose framework yang tepat untuk project Anda
2. Buat form configuration array/JSON
3. Set framework dengan `UI::setFramework()`
4. Render form dengan `FormBuilder::fromArray()`
5. Extract validation rules dengan `getValidationRules()`
6. Validate dengan Laravel validator

---

**Happy Form Building!** 🎉

FormBuilder examples dibuat untuk memudahkan pembelajaran dan implementasi.
Gunakan untuk reference, testing, dan exploration!

---

*Last Updated: May 29, 2026*
*FormBuilder v2.0.0*
