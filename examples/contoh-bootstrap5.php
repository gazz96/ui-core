<?php

declare(strict_types=1);

/**
 * Bootstrap 5 FormBuilder Example
 *
 * Contoh penggunaan FormBuilder dengan Bootstrap 5 CSS framework
 */

require_once __DIR__ . '/../vendor/autoload.php';

use BagasTopati\UiCore\Builders\FormBuilder;
use BagasTopati\UiCore\CssFrameworks\Bootstrap5Framework;
use BagasTopati\UiCore\UI;

// Set Bootstrap 5 sebagai framework
UI::setFramework(new Bootstrap5Framework());

// ============================================================================
// Example 1: Simple Contact Form with Bootstrap 5
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
    <title>FormBuilder - Bootstrap 5 Examples</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
            border-bottom: 3px solid #0d6efd;
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }
        .framework-info {
            background-color: #cfe2ff;
            border-left: 4px solid #0d6efd;
            padding: 1rem;
            margin-bottom: 2rem;
            border-radius: 0.25rem;
        }
        .form-code {
            background-color: #f5f5f5;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            padding: 1rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            overflow-x: auto;
        }
        code {
            color: #d63384;
        }
        .feature-badge {
            display: inline-block;
            background-color: #d1ecf1;
            color: #0c5460;
            padding: 0.25rem 0.75rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="mb-5">
            <h1 class="mb-2">FormBuilder - Bootstrap 5 Examples</h1>
            <p class="text-muted">Contoh penggunaan FormBuilder dengan CSS framework Bootstrap 5 (terbaru)</p>
        </div>

        <!-- Framework Info -->
        <div class="framework-info">
            <strong>✓ Framework: Bootstrap 5</strong>
            <p class="mb-0 mt-2">Contoh ini menampilkan FormBuilder dengan Bootstrap 5 CSS classes seperti:</p>
            <ul class="mb-0 mt-2 ms-3">
                <li><code>mb-3</code> untuk form groups (utility classes)</li>
                <li><code>form-label</code> untuk labels</li>
                <li><code>form-select</code> untuk select fields (menggantikan custom-select)</li>
                <li><code>row g-3</code> untuk multi-column layouts (menggantikan form-row)</li>
                <li><code>form-check</code> untuk checkboxes & radios</li>
            </ul>
        </div>

        <!-- Example 1: Contact Form -->
        <div class="example-section">
            <div class="example-title">
                <h3>1. Form Kontak Sederhana</h3>
            </div>
            <p class="text-muted">Contoh form kontak dengan berbagai field types menggunakan Bootstrap 5</p>

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
            <p class="text-muted">Contoh form dengan layout multi-kolom menggunakan <code>row</code> field dengan Bootstrap 5</p>

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
            <h4 class="mb-3">✨ Fitur Bootstrap 5</h4>
            <div class="row">
                <div class="col-md-6">
                    <h6>CSS Classes yang Digunakan:</h6>
                    <ul class="small">
                        <li><code>mb-3</code> - Margin bottom untuk form groups</li>
                        <li><code>form-label</code> - Label styling</li>
                        <li><code>form-control</code> - Input fields styling</li>
                        <li><code>form-select</code> - Select fields styling</li>
                        <li><code>form-check</code> - Checkboxes & radios</li>
                        <li><code>row g-3</code> - Horizontal layouts with gaps</li>
                        <li><code>btn btn-primary</code> - Button styling</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h6>Keuntungan Bootstrap 5:</h6>
                    <div class="feature-badge">✓ Tidak perlu jQuery</div>
                    <div class="feature-badge">✓ Popper.js sudah bundled</div>
                    <div class="feature-badge">✓ Lebih ringan</div>
                    <div class="feature-badge">✓ Modern CSS features</div>
                    <div class="feature-badge">✓ Utility-first classes</div>

                    <h6 class="mt-3">Field Types:</h6>
                    <ul class="small">
                        <li>✓ 15+ input types</li>
                        <li>✓ Select fields</li>
                        <li>✓ Multi-column layouts</li>
                        <li>✓ HTML5 validation</li>
                        <li>✓ Responsive design</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Code Example -->
        <div class="example-section">
            <h4 class="mb-3">💻 Cara Menggunakan</h4>
            <div class="form-code">
                <pre><code>use BagasTopati\UiCore\Builders\FormBuilder;
use BagasTopati\UiCore\CssFrameworks\Bootstrap5Framework;
use BagasTopati\UiCore\UI;

// Set Bootstrap 5 sebagai framework
UI::setFramework(new Bootstrap5Framework());

// Buat form dari array (SAMA SEPERTI BOOTSTRAP 4!)
$form = FormBuilder::fromArray([
    'action' => '/submit',
    'method' => 'POST',
    'fields' => [
        ['type' => 'text', 'name' => 'name', 'label' => 'Name'],
        ['type' => 'email', 'name' => 'email', 'label' => 'Email'],
    ]
]);

// Render form dengan CSS classes Bootstrap 5
echo $form->render();</code></pre>
            </div>

            <div class="alert alert-info" role="alert">
                <strong>💡 Catatan Penting:</strong> Kode form configuration sama persis untuk Bootstrap 4 dan Bootstrap 5!
                Hanya perlu ubah framework yang digunakan, dan FormBuilder akan otomatis menggunakan CSS classes yang tepat.
            </div>
        </div>

        <!-- Comparison -->
        <div class="example-section">
            <h4 class="mb-3">🔄 Perbedaan Bootstrap 4 vs Bootstrap 5</h4>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Fitur</th>
                            <th>Bootstrap 4</th>
                            <th>Bootstrap 5</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Form Group</td>
                            <td><code>form-group</code></td>
                            <td><code>mb-3</code></td>
                        </tr>
                        <tr>
                            <td>Label</td>
                            <td><code>form-control-label</code></td>
                            <td><code>form-label</code></td>
                        </tr>
                        <tr>
                            <td>Select Field</td>
                            <td><code>custom-select</code></td>
                            <td><code>form-select</code></td>
                        </tr>
                        <tr>
                            <td>Multi-column Layout</td>
                            <td><code>form-row</code></td>
                            <td><code>row g-3</code></td>
                        </tr>
                        <tr>
                            <td>jQuery</td>
                            <td>Required ✓</td>
                            <td>Not needed ✗</td>
                        </tr>
                        <tr>
                            <td>Popper.js</td>
                            <td>Required ✓</td>
                            <td>Bundled ✓</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center text-muted py-4">
            <p>FormBuilder v2.0.0 • Bootstrap 5 Examples</p>
            <p class="small">
                <a href="contoh-bootstrap4.php" class="text-decoration-none">Bootstrap 4 Examples</a> •
                <a href="contoh-tailwind.php" class="text-decoration-none">Tailwind Examples</a> •
                <a href="../examples.php" class="text-decoration-none">Form Examples</a>
            </p>
        </div>
    </div>

    <!-- Bootstrap 5 Script (Bundle includes Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
