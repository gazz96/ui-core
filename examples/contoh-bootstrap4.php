<?php

declare(strict_types=1);

/**
 * Bootstrap 4 FormBuilder Example
 *
 * Contoh penggunaan FormBuilder dengan Bootstrap 4 CSS framework
 */

require_once __DIR__ . '/../vendor/autoload.php';

use BagasTopati\UiCore\Builders\FormBuilder;
use BagasTopati\UiCore\CssFrameworks\Bootstrap4Framework;
use BagasTopati\UiCore\UI;

// Set Bootstrap 4 sebagai framework
UI::setFramework(new Bootstrap4Framework());

// ============================================================================
// Example 1: Simple Contact Form with Bootstrap 4
// ============================================================================

$contactForm = [
    'action' => '/contact/submit',
    'method' => 'POST',
    'attributes' => [
        'class' => 'contact-form',
        'novalidate' => true
    ],
    'fields' => [
        [
            'type' => 'text',
            'name' => 'name',
            'label' => 'Nama Anda',
            'placeholder' => 'Masukkan nama lengkap',
            'validation' => 'required|string|max:255'
        ],
        [
            'type' => 'email',
            'name' => 'email',
            'label' => 'Alamat Email',
            'placeholder' => 'your@example.com',
            'validation' => 'required|email'
        ],
        [
            'type' => 'tel',
            'name' => 'phone',
            'label' => 'Nomor Telepon',
            'placeholder' => '+62 812 3456 7890',
            'validation' => 'nullable|string'
        ],
        [
            'type' => 'select',
            'name' => 'subject',
            'label' => 'Subjek',
            'options' => [
                'general' => 'Pertanyaan Umum',
                'support' => 'Dukungan Teknis',
                'sales' => 'Penjualan',
                'feedback' => 'Umpan Balik'
            ],
            'default' => 'general',
            'validation' => 'required'
        ],
        [
            'type' => 'textarea',
            'name' => 'message',
            'label' => 'Pesan Anda',
            'placeholder' => 'Tulis pesan Anda di sini...',
            'rows' => 5,
            'validation' => 'required|string|max:1000'
        ],
        [
            'type' => 'checkbox',
            'name' => 'subscribe',
            'label' => 'Langganan',
            'checkbox_label' => 'Saya setuju menerima informasi terbaru via email',
            'default' => true
        ]
    ],
    'buttons' => [
        [
            'type' => 'submit',
            'label' => 'Kirim Pesan',
            'attributes' => ['class' => 'btn-lg']
        ],
        [
            'type' => 'reset',
            'label' => 'Bersihkan'
        ]
    ]
];

// ============================================================================
// Example 2: User Registration Form
// ============================================================================

$registrationForm = [
    'action' => '/register',
    'method' => 'POST',
    'fields' => [
        [
            'type' => 'text',
            'name' => 'first_name',
            'label' => 'Nama Depan',
            'validation' => 'required|string|max:50'
        ],
        [
            'type' => 'text',
            'name' => 'last_name',
            'label' => 'Nama Belakang',
            'validation' => 'required|string|max:50'
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
            'label' => 'Konfirmasi Password'
        ],
        [
            'type' => 'select',
            'name' => 'country',
            'label' => 'Negara',
            'options' => [
                'id' => 'Indonesia',
                'ph' => 'Filipina',
                'my' => 'Malaysia',
                'sg' => 'Singapura',
                'th' => 'Thailand'
            ],
            'default' => 'id',
            'validation' => 'required'
        ],
        [
            'type' => 'date',
            'name' => 'birth_date',
            'label' => 'Tanggal Lahir',
            'validation' => 'required|date|before:today'
        ],
        [
            'type' => 'radio',
            'name' => 'gender',
            'label' => 'Jenis Kelamin',
            'options' => [
                'M' => 'Laki-laki',
                'F' => 'Perempuan',
                'O' => 'Lainnya'
            ],
            'default' => 'M',
            'validation' => 'required'
        ],
        [
            'type' => 'checkbox',
            'name' => 'terms',
            'checkbox_label' => 'Saya setuju dengan Syarat dan Ketentuan',
            'validation' => 'required'
        ]
    ],
    'buttons' => [
        ['type' => 'submit', 'label' => 'Daftar Akun']
    ]
];

// ============================================================================
// Example 3: Product Form with Multi-column Layout
// ============================================================================

$productForm = [
    'action' => '/products/store',
    'method' => 'POST',
    'attributes' => ['enctype' => 'multipart/form-data'],
    'fields' => [
        [
            'type' => 'text',
            'name' => 'name',
            'label' => 'Nama Produk',
            'validation' => 'required|string|max:255'
        ],
        [
            'type' => 'textarea',
            'name' => 'description',
            'label' => 'Deskripsi',
            'rows' => 4,
            'validation' => 'required|string'
        ],
        [
            'type' => 'row',
            'fields' => [
                [
                    'type' => 'number',
                    'name' => 'price',
                    'label' => 'Harga',
                    'validation' => 'required|numeric|min:0'
                ],
                [
                    'type' => 'number',
                    'name' => 'stock',
                    'label' => 'Stok',
                    'validation' => 'required|integer|min:0'
                ]
            ]
        ],
        [
            'type' => 'select',
            'name' => 'category',
            'label' => 'Kategori',
            'options' => [
                'electronics' => 'Elektronik',
                'clothing' => 'Pakaian',
                'food' => 'Makanan',
                'books' => 'Buku'
            ],
            'validation' => 'required'
        ],
        [
            'type' => 'file',
            'name' => 'image',
            'label' => 'Gambar Produk',
            'accept' => 'image/*',
            'validation' => 'nullable|image|max:2048'
        ],
        [
            'type' => 'checkbox',
            'name' => 'is_active',
            'checkbox_label' => 'Produk Aktif',
            'default' => true
        ]
    ],
    'buttons' => [
        ['type' => 'submit', 'label' => 'Simpan Produk'],
        ['type' => 'reset', 'label' => 'Bersihkan']
    ]
];

// ============================================================================
// Example 4: Survey Form
// ============================================================================

$surveyForm = [
    'action' => '/survey/submit',
    'method' => 'POST',
    'fields' => [
        [
            'type' => 'text',
            'name' => 'respondent_name',
            'label' => 'Nama Responden',
            'validation' => 'required|string'
        ],
        [
            'type' => 'radio',
            'name' => 'satisfaction',
            'label' => 'Tingkat Kepuasan Layanan',
            'options' => [
                'very_satisfied' => 'Sangat Puas',
                'satisfied' => 'Puas',
                'neutral' => 'Netral',
                'unsatisfied' => 'Tidak Puas'
            ],
            'validation' => 'required'
        ],
        [
            'type' => 'checkbox',
            'name' => 'would_recommend',
            'checkbox_label' => 'Saya akan merekomendasikan layanan ini kepada teman',
            'default' => true
        ],
        [
            'type' => 'textarea',
            'name' => 'feedback',
            'label' => 'Saran dan Masukan',
            'rows' => 4,
            'placeholder' => 'Bagaimana cara kami dapat meningkatkan layanan?',
            'validation' => 'nullable|string|max:500'
        ]
    ],
    'buttons' => [
        ['type' => 'submit', 'label' => 'Kirim Survei']
    ]
];

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FormBuilder - Bootstrap 4 Examples</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            padding: 2rem 0;
            background-color: #f8f9fa;
        }
        .example-section {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 2rem;
            padding: 2rem;
        }
        .example-title {
            border-bottom: 2px solid #007bff;
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }
        .framework-info {
            background-color: #e7f3ff;
            border-left: 4px solid #007bff;
            padding: 1rem;
            margin-bottom: 2rem;
        }
        .form-code {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 0.25rem;
            padding: 1rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            overflow-x: auto;
        }
        code {
            color: #d63384;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="mb-5">
            <h1 class="mb-2">FormBuilder - Bootstrap 4 Examples</h1>
            <p class="text-muted">Contoh penggunaan FormBuilder dengan CSS framework Bootstrap 4</p>
        </div>

        <!-- Framework Info -->
        <div class="framework-info">
            <strong>✓ Framework: Bootstrap 4</strong>
            <p class="mb-0 mt-2">Contoh ini menampilkan FormBuilder dengan Bootstrap 4 CSS classes seperti:</p>
            <ul class="mb-0 mt-2 ml-3">
                <li><code>form-group</code> untuk form groups</li>
                <li><code>form-control-label</code> untuk labels</li>
                <li><code>custom-select</code> untuk select fields</li>
                <li><code>form-row</code> untuk multi-column layouts</li>
            </ul>
        </div>

        <!-- Example 1: Contact Form -->
        <div class="example-section">
            <div class="example-title">
                <h3>1. Form Kontak Sederhana</h3>
            </div>
            <p class="text-muted">Contoh form kontak dengan berbagai field types</p>

            <?php
                $form = FormBuilder::fromArray($contactForm);
                echo $form->render();
            ?>
        </div>

        <!-- Example 2: Registration Form -->
        <div class="example-section">
            <div class="example-title">
                <h3>2. Form Pendaftaran Pengguna</h3>
            </div>
            <p class="text-muted">Contoh form registrasi dengan validasi dan field kompleks</p>

            <?php
                $form = FormBuilder::fromArray($registrationForm);
                echo $form->render();
            ?>
        </div>

        <!-- Example 3: Product Form -->
        <div class="example-section">
            <div class="example-title">
                <h3>3. Form Produk dengan Multi-column Layout</h3>
            </div>
            <p class="text-muted">Contoh form dengan layout multi-kolom menggunakan <code>row</code> field</p>

            <?php
                $form = FormBuilder::fromArray($productForm);
                echo $form->render();
            ?>
        </div>

        <!-- Example 4: Survey Form -->
        <div class="example-section">
            <div class="example-title">
                <h3>4. Form Survei</h3>
            </div>
            <p class="text-muted">Contoh form survei dengan radio buttons dan checkboxes</p>

            <?php
                $form = FormBuilder::fromArray($surveyForm);
                echo $form->render();
            ?>
        </div>

        <!-- Features Info -->
        <div class="example-section mt-5">
            <h4 class="mb-3">✨ Fitur Bootstrap 4</h4>
            <div class="row">
                <div class="col-md-6">
                    <h6>CSS Classes yang Digunakan:</h6>
                    <ul class="small">
                        <li><code>form-group</code> - Untuk grouping fields</li>
                        <li><code>form-control-label</code> - Untuk labels</li>
                        <li><code>form-control</code> - Untuk input fields</li>
                        <li><code>custom-select</code> - Untuk select fields</li>
                        <li><code>form-check</code> - Untuk checkboxes & radios</li>
                        <li><code>form-row</code> - Untuk horizontal layouts</li>
                        <li><code>btn btn-primary</code> - Untuk buttons</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h6>Dependencies:</h6>
                    <ul class="small">
                        <li>✓ jQuery</li>
                        <li>✓ Popper.js</li>
                        <li>✓ Bootstrap 4.6.2 JS</li>
                    </ul>

                    <h6 class="mt-3">Field Types:</h6>
                    <ul class="small">
                        <li>✓ 15+ input types</li>
                        <li>✓ Select fields</li>
                        <li>✓ Multi-column layouts</li>
                        <li>✓ HTML5 validation</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Code Example -->
        <div class="example-section">
            <h4 class="mb-3">💻 Cara Menggunakan</h4>
            <div class="form-code">
                <pre><code>use BagasTopati\UiCore\Builders\FormBuilder;
use BagasTopati\UiCore\CssFrameworks\Bootstrap4Framework;
use BagasTopati\UiCore\UI;

// Set Bootstrap 4 sebagai framework
UI::setFramework(new Bootstrap4Framework());

// Buat form dari array
$form = FormBuilder::fromArray([
    'action' => '/submit',
    'method' => 'POST',
    'fields' => [
        ['type' => 'text', 'name' => 'name', 'label' => 'Name'],
        ['type' => 'email', 'name' => 'email', 'label' => 'Email'],
    ]
]);

// Render form
echo $form->render();</code></pre>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center text-muted py-4">
            <p>FormBuilder v2.0.0 • Bootstrap 4 Examples</p>
            <small>Untuk Bootstrap 5 examples, lihat: <a href="contoh-bootstrap5.php">contoh-bootstrap5.php</a></small>
        </div>
    </div>

    <!-- Bootstrap 4 Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
