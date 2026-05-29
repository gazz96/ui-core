<?php

declare(strict_types=1);

/**
 * Tailwind CSS FormBuilder Example
 *
 * Contoh penggunaan FormBuilder dengan Tailwind CSS framework
 */

require_once __DIR__ . '/../vendor/autoload.php';

use BagasTopati\UiCore\Builders\FormBuilder;
use BagasTopati\UiCore\CssFrameworks\TailwindFramework;
use BagasTopati\UiCore\UI;

// Set Tailwind CSS sebagai framework
UI::setFramework(new TailwindFramework());

// ============================================================================
// Example 1: Simple Contact Form with Tailwind CSS
// ============================================================================

$contactForm = [
    'action' => '/contact/submit',
    'method' => 'POST',
    'attributes' => [
        'class' => 'max-w-md mx-auto',
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
            'attributes' => ['class' => 'w-full']
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
    'attributes' => ['class' => 'max-w-2xl mx-auto'],
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
    'attributes' => [
        'enctype' => 'multipart/form-data',
        'class' => 'max-w-2xl mx-auto'
    ],
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
    'attributes' => ['class' => 'max-w-md mx-auto'],
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
    <title>FormBuilder - Tailwind CSS Examples</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        code {
            @apply bg-red-100 text-red-700 px-2 py-1 rounded;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold mb-2">FormBuilder - Tailwind CSS Examples</h1>
            <p class="text-gray-600">Contoh penggunaan FormBuilder dengan CSS framework Tailwind CSS</p>
        </div>

        <!-- Framework Info -->
        <div class="mb-8 p-4 bg-blue-50 border-l-4 border-blue-500 rounded">
            <strong class="text-blue-900">✓ Framework: Tailwind CSS</strong>
            <p class="text-blue-900 mt-2 mb-2">Contoh ini menampilkan FormBuilder dengan Tailwind CSS utility classes seperti:</p>
            <ul class="text-blue-900 ml-4 space-y-1">
                <li>• <code>mb-3</code> untuk spacing</li>
                <li>• <code>px-4 py-2 border rounded</code> untuk input styling</li>
                <li>• <code>max-w-md mx-auto</code> untuk responsive layouts</li>
                <li>• <code>grid grid-cols-2 gap-4</code> untuk multi-column layouts</li>
                <li>• <code>flex items-center</code> untuk checkboxes & radios</li>
            </ul>
        </div>

        <!-- Example 1: Contact Form -->
        <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
            <h2 class="text-2xl font-bold border-b-2 border-blue-500 pb-4 mb-6">1. Form Kontak Sederhana</h2>
            <p class="text-gray-600 mb-6">Contoh form kontak dengan berbagai field types menggunakan Tailwind CSS</p>

            <?php
                $form = FormBuilder::fromArray($contactForm);
                echo $form->render();
            ?>
        </div>

        <!-- Example 2: Registration Form -->
        <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
            <h2 class="text-2xl font-bold border-b-2 border-blue-500 pb-4 mb-6">2. Form Pendaftaran Pengguna</h2>
            <p class="text-gray-600 mb-6">Contoh form registrasi dengan validasi dan field kompleks</p>

            <?php
                $form = FormBuilder::fromArray($registrationForm);
                echo $form->render();
            ?>
        </div>

        <!-- Example 3: Product Form -->
        <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
            <h2 class="text-2xl font-bold border-b-2 border-blue-500 pb-4 mb-6">3. Form Produk dengan Multi-column Layout</h2>
            <p class="text-gray-600 mb-6">Contoh form dengan layout multi-kolom menggunakan <code>row</code> field dengan Tailwind CSS</p>

            <?php
                $form = FormBuilder::fromArray($productForm);
                echo $form->render();
            ?>
        </div>

        <!-- Example 4: Survey Form -->
        <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
            <h2 class="text-2xl font-bold border-b-2 border-blue-500 pb-4 mb-6">4. Form Survei</h2>
            <p class="text-gray-600 mb-6">Contoh form survei dengan radio buttons dan checkboxes</p>

            <?php
                $form = FormBuilder::fromArray($surveyForm);
                echo $form->render();
            ?>
        </div>

        <!-- Features Info -->
        <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
            <h3 class="text-2xl font-bold mb-6">✨ Fitur Tailwind CSS</h3>
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h4 class="font-bold text-lg mb-3">CSS Classes yang Digunakan:</h4>
                    <ul class="text-sm space-y-2">
                        <li><code>mb-3</code> - Margin bottom untuk spacing</li>
                        <li><code>px-4 py-2</code> - Padding untuk form inputs</li>
                        <li><code>border rounded</code> - Border dan rounded corners</li>
                        <li><code>focus:outline-none</code> - Focus states</li>
                        <li><code>flex items-center</code> - Checkbox & radio alignment</li>
                        <li><code>grid grid-cols-2</code> - Multi-column layouts</li>
                        <li><code>max-w-md</code> - Responsive containers</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-lg mb-3">Keuntungan Tailwind CSS:</h4>
                    <div class="space-y-2">
                        <div class="inline-block bg-cyan-100 text-cyan-900 px-3 py-1 rounded text-sm">✓ Utility-first approach</div>
                        <div class="inline-block bg-cyan-100 text-cyan-900 px-3 py-1 rounded text-sm">✓ Highly customizable</div>
                        <div class="inline-block bg-cyan-100 text-cyan-900 px-3 py-1 rounded text-sm">✓ Responsive design</div>
                        <div class="inline-block bg-cyan-100 text-cyan-900 px-3 py-1 rounded text-sm">✓ Dark mode support</div>
                        <div class="inline-block bg-cyan-100 text-cyan-900 px-3 py-1 rounded text-sm">✓ JIT compilation</div>
                        <div class="inline-block bg-cyan-100 text-cyan-900 px-3 py-1 rounded text-sm">✓ No dependencies</div>

                        <h4 class="font-bold text-lg mb-3 mt-4">Field Types:</h4>
                        <ul class="text-sm space-y-1">
                            <li>✓ 15+ input types</li>
                            <li>✓ Select fields</li>
                            <li>✓ Multi-column layouts</li>
                            <li>✓ HTML5 validation</li>
                            <li>✓ Fully responsive</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Code Example -->
        <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
            <h3 class="text-2xl font-bold mb-4">💻 Cara Menggunakan</h3>
            <div class="bg-gray-900 text-gray-100 p-4 rounded overflow-x-auto mb-4 text-sm">
                <pre><code>use BagasTopati\UiCore\Builders\FormBuilder;
use BagasTopati\UiCore\CssFrameworks\TailwindFramework;
use BagasTopati\UiCore\UI;

// Set Tailwind CSS sebagai framework
UI::setFramework(new TailwindFramework());

// Buat form dari array
$form = FormBuilder::fromArray([
    'action' => '/submit',
    'method' => 'POST',
    'fields' => [
        ['type' => 'text', 'name' => 'name', 'label' => 'Name'],
        ['type' => 'email', 'name' => 'email', 'label' => 'Email'],
    ]
]);

// Render form dengan Tailwind CSS classes
echo $form->render();</code></pre>
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded p-4 mb-4">
                <strong class="text-blue-900">💡 Catatan Penting:</strong>
                <p class="text-blue-900 text-sm mt-2">Sama seperti Bootstrap, kode form configuration sama persis untuk semua framework!
                Hanya perlu ubah framework yang digunakan, dan FormBuilder akan otomatis menggunakan CSS classes yang tepat.</p>
            </div>
        </div>

        <!-- Comparison -->
        <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
            <h3 class="text-2xl font-bold mb-6">🔄 Perbandingan Frameworks</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b-2 border-gray-200">
                            <th class="text-left py-3 px-4">Fitur</th>
                            <th class="text-left py-3 px-4">Bootstrap 4</th>
                            <th class="text-left py-3 px-4">Bootstrap 5</th>
                            <th class="text-left py-3 px-4">Tailwind CSS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-200">
                            <td class="py-3 px-4"><code>Form Group</code></td>
                            <td class="py-3 px-4">form-group</td>
                            <td class="py-3 px-4">mb-3</td>
                            <td class="py-3 px-4">mb-3</td>
                        </tr>
                        <tr class="border-b border-gray-200">
                            <td class="py-3 px-4"><code>Label</code></td>
                            <td class="py-3 px-4">form-control-label</td>
                            <td class="py-3 px-4">form-label</td>
                            <td class="py-3 px-4">block mb-1</td>
                        </tr>
                        <tr class="border-b border-gray-200">
                            <td class="py-3 px-4"><code>Input</code></td>
                            <td class="py-3 px-4">form-control</td>
                            <td class="py-3 px-4">form-control</td>
                            <td class="py-3 px-4">border rounded px-3 py-2</td>
                        </tr>
                        <tr class="border-b border-gray-200">
                            <td class="py-3 px-4"><code>Select</code></td>
                            <td class="py-3 px-4">custom-select</td>
                            <td class="py-3 px-4">form-select</td>
                            <td class="py-3 px-4">border rounded px-3 py-2</td>
                        </tr>
                        <tr class="border-b border-gray-200">
                            <td class="py-3 px-4"><code>jQuery</code></td>
                            <td class="py-3 px-4">Required</td>
                            <td class="py-3 px-4">Not needed</td>
                            <td class="py-3 px-4">Not needed</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4"><code>Bundle Size</code></td>
                            <td class="py-3 px-4">Medium</td>
                            <td class="py-3 px-4">Smaller</td>
                            <td class="py-3 px-4">Smallest (JIT)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center text-gray-600 py-8">
            <p>FormBuilder v2.0.0 • Tailwind CSS Examples</p>
            <p class="text-sm mt-2">
                <a href="contoh-bootstrap4.php" class="hover:text-blue-600">Bootstrap 4 Examples</a> •
                <a href="contoh-bootstrap5.php" class="hover:text-blue-600">Bootstrap 5 Examples</a> •
                <a href="../examples.php" class="hover:text-blue-600">Form Examples</a>
            </p>
        </div>
    </div>
</body>
</html>
