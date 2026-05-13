<?php

require 'vendor/autoload.php';

use BagasTopati\UiCore\UI;

UI::useBootstrap();

$users = [
    ['id' => 1, 'name' => 'Bagas Topati', 'email' => 'bagas@mail.com', 'role' => 'Admin', 'status' => 'Active'],
    ['id' => 2, 'name' => 'Budi Santoso', 'email' => 'budi@mail.com', 'role' => 'Editor', 'status' => 'Active'],
    ['id' => 3, 'name' => 'Citra Dewi', 'email' => 'citra@mail.com', 'role' => 'Viewer', 'status' => 'Inactive'],
    ['id' => 4, 'name' => 'Dian Pratama', 'email' => 'dian@mail.com', 'role' => 'Editor', 'status' => 'Active'],
    ['id' => 5, 'name' => 'Eka Putra', 'email' => 'eka@mail.com', 'role' => 'Admin', 'status' => 'Active'],
    ['id' => 6, 'name' => 'Fani Wulandari', 'email' => 'fani@mail.com', 'role' => 'Viewer', 'status' => 'Active'],
    ['id' => 7, 'name' => 'Gilang Ramadhan', 'email' => 'gilang@mail.com', 'role' => 'Editor', 'status' => 'Inactive'],
    ['id' => 8, 'name' => 'Hana Safitri', 'email' => 'hana@mail.com', 'role' => 'Viewer', 'status' => 'Active'],
    ['id' => 9, 'name' => 'Irfan Hakim', 'email' => 'irfan@mail.com', 'role' => 'Admin', 'status' => 'Inactive'],
    ['id' => 10, 'name' => 'Joko Widodo', 'email' => 'joko@mail.com', 'role' => 'Editor', 'status' => 'Active'],
    ['id' => 11, 'name' => 'Kartika Sari', 'email' => 'kartika@mail.com', 'role' => 'Viewer', 'status' => 'Active'],
    ['id' => 12, 'name' => 'Lukman Hakim', 'email' => 'lukman@mail.com', 'role' => 'Editor', 'status' => 'Inactive'],
    ['id' => 13, 'name' => 'Maya Angelina', 'email' => 'maya@mail.com', 'role' => 'Admin', 'status' => 'Active'],
    ['id' => 14, 'name' => 'Nadia Putri', 'email' => 'nadia@mail.com', 'role' => 'Viewer', 'status' => 'Active'],
    ['id' => 15, 'name' => 'Oscar Pratama', 'email' => 'oscar@mail.com', 'role' => 'Editor', 'status' => 'Active'],
];

echo UI::page('Dashboard', [
    UI::alert('Selamat datang di UI Builder Dashboard!', 'success')
        ->title('Halo, Bagas!')
        ->dismissible(),

    UI::alert('Ada 3 request yang menunggu approval.', 'warning')
        ->dismissible(),

    UI::grid([
        UI::card('Total Users', 1284)
            ->subtitle('+12% dari bulan lalu')
            ->variant('primary')
            ->footer('Diperbarui hari ini'),

        UI::card('Revenue', '$12,450')
            ->subtitle('+8.2% growth')
            ->variant('success')
            ->footer('Bulan ini'),

        UI::card('Orders', 356)
            ->subtitle('24 pending')
            ->variant('warning'),

        UI::card('Bounce Rate', '2.4%')
            ->subtitle('-0.3% dari kemarin')
            ->variant('danger'),
    ])->columns(4)->gap('20px'),

    UI::element('h2', 'Data Pengguna'),

    UI::table($users)
        ->columns(['id' => '#', 'name' => 'Nama', 'email' => 'Email', 'role' => 'Role'])
        ->column('status', 'Status', fn($val) => $val === 'Active'
            ? '<span class="badge bg-success">Active</span>'
            : '<span class="badge bg-danger">Inactive</span>'
        )
        ->sortable(['id', 'name', 'email', 'role'])
        ->sortBy('id', 'asc')
        ->sortUrl('?sort={column}&direction={direction}')
        ->searchable('Cari pengguna...')
        ->addFilter('role', 'select', [
            'placeholder' => 'Role',
            'items' => ['Admin' => 'Admin', 'Editor' => 'Editor', 'Viewer' => 'Viewer'],
        ])
        ->addFilter('status', 'select', [
            'placeholder' => 'Status',
            'items' => ['Active' => 'Active', 'Inactive' => 'Inactive'],
        ])
        ->filterAction('/users')
        ->paginate(5, 1)
        ->paginationUrl('?page={page}')
        ->perPageSelector([5, 10, 25])
        ->actions([
            'Edit' => fn($row) => '/users/' . $row['id'] . '/edit',
            'Hapus' => fn($row) => '/users/' . $row['id'] . '/delete',
        ])
        ->striped()
        ->hoverable()
        ->caption('Daftar semua pengguna terdaftar')
        ->responsive(),

    UI::element('h2', 'Custom Column & Object Data'),

    UI::table($users)
        ->column('id', '#', fn($val) => '<strong>' . $val . '</strong>')
        ->rawColumn('avatar', 'Foto', fn($row) => '<div class="d-flex align-items-center gap-2">'
            . '<div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:32px;height:32px;font-size:14px">'
            . strtoupper(substr($row['name'], 0, 1))
            . '</div>'
            . '</div>')
        ->column('name', 'Nama')
        ->column('email', 'Email')
        ->rawColumn('role_badge', 'Role', fn($row) => match($row['role']) {
            'Admin' => '<span class="badge bg-danger">' . $row['role'] . '</span>',
            'Editor' => '<span class="badge bg-info">' . $row['role'] . '</span>',
            default => '<span class="badge bg-secondary">' . $row['role'] . '</span>',
        })
        ->rawColumn('status_badge', 'Status', fn($row) => $row['status'] === 'Active'
            ? '<span class="badge bg-success"><span class="me-1">●</span>Active</span>'
            : '<span class="badge bg-danger"><span class="me-1">●</span>Inactive</span>')
        ->rawColumn('actions', 'Aksi', fn($row) => '<div class="d-flex gap-1">'
            . '<a href="/users/' . $row['id'] . '/edit" class="btn btn-sm btn-outline-primary">Edit</a>'
            . '<a href="/users/' . $row['id'] . '/delete" class="btn btn-sm btn-outline-danger">Hapus</a>'
            . '</div>')
        ->sortable(['name', 'email'])
        ->sortBy('name', 'asc')
        ->sortUrl('?sort={column}&direction={direction}')
        ->searchable('Cari pengguna...')
        ->paginate(5, 1)
        ->paginationUrl('?page={page}')
        ->striped()
        ->hoverable()
        ->responsive(),

    UI::element('h2', 'Form Tambah Pengguna'),

    UI::form('/users/save')
        ->row([
            ['type' => 'text', 'name' => 'first_name', 'label' => 'Nama Depan'],
            ['type' => 'text', 'name' => 'last_name', 'label' => 'Nama Belakang'],
        ])
        ->email('email')
        ->password('password')
        ->select('role', ['admin' => 'Admin', 'editor' => 'Editor', 'viewer' => 'Viewer'], 'Role', ['selected' => 'editor'])
        ->date('birth_date', 'Tanggal Lahir')
        ->textarea('address', 'Alamat', ['rows' => 3])
        ->checkbox('is_active', 'Status', ['checkbox_label' => 'Aktifkan akun'])
        ->radio('gender', ['M' => 'Laki-laki', 'F' => 'Perempuan'], 'Jenis Kelamin', ['checked' => 'M'])
        ->file('avatar', 'Foto Profil', ['accept' => 'image/*'])
        ->hidden('token', 'abc123')
        ->submit('Simpan Data')
        ->reset('Reset'),

    UI::element('h2', 'Tabs Component'),

    UI::tabs()
        ->tab('Informasi', UI::div()
            ->child(UI::p('Ini adalah konten tab informasi. Anda bisa menarik komponen apapun di sini.'))
            ->child(UI::ul(['Fitur UI Builder lengkap', 'Rendering HTML yang bersih', 'Fluent API yang mudah digunakan', 'Standalone tanpa dependency'])->styled(false))
        )
        ->tab('Pengaturan', UI::div()
            ->child(UI::p('Konten pengaturan akan muncul di sini.'))
        )
        ->tab('Log Aktivitas', UI::table([
            ['time' => '10:30', 'action' => 'Login', 'user' => 'Bagas'],
            ['time' => '11:45', 'action' => 'Update profile', 'user' => 'Budi'],
            ['time' => '13:20', 'action' => 'Upload file', 'user' => 'Citra'],
        ])->striped()->compact()),

    UI::modal('myModal', 'Detail Pengguna')
        ->size('medium')
        ->addBody(UI::p('Ini adalah contoh modal dialog yang bisa digunakan untuk menampilkan detail atau konfirmasi.'))
        ->addBody(UI::ul(['Nama: Bagas Topati', 'Email: bagas@mail.com', 'Role: Admin']))
        ->addFooter(UI::button('Tutup')->attr('onclick', "bootstrap.Modal.getInstance(document.getElementById('myModal')).hide()")),

    UI::div()
        ->child(UI::button('Buka Modal')->attr('onclick', "new bootstrap.Modal(document.getElementById('myModal')).show()")),

    UI::grid([
        UI::card('Daftar Fitur')
            ->addBody(UI::ul([
                'Form Builder (text, email, password, select, dll)',
                'Table Builder (sort, filter, pagination, actions)',
                'Grid & Flex Layout',
                'Card, Alert, Modal',
                'Navbar & Sidebar',
                'Tabs',
                'Element Builder (div, span, heading, dll)',
                'Full HTML Page Document',
            ])->styled(false)),
        UI::card('Tech Stack')
            ->addBody(UI::ol([
                'PHP 8.1+',
                'PSR-4 Autoloading',
                'Fluent Builder Pattern',
                'Zero External Dependencies',
            ])->styled(true)),
    ])->columns(2)->gap('20px'),

    UI::hr(),

    UI::element('h2', 'Utility API'),

    UI::utility()
        ->dFlex()
        ->flexRow()
        ->gap('3')
        ->p('4')
        ->bg('light')
        ->rounded('3')
        ->shadow('sm')
        ->child(
            UI::utility()
                ->tag('div')
                ->p('3')
                ->bg('primary')
                ->textColor('white')
                ->rounded()
                ->content('Box 1')
        )
        ->child(
            UI::utility()
                ->tag('div')
                ->p('3')
                ->bg('success')
                ->textColor('white')
                ->rounded()
                ->content('Box 2')
        )
        ->child(
            UI::utility()
                ->tag('div')
                ->p('3')
                ->bg('warning')
                ->textColor('white')
                ->rounded()
                ->content('Box 3')
        ),

    UI::utility()
        ->dFlex()
        ->flexRow()
        ->justify('between')
        ->alignItems('center')
        ->my('4')
        ->px('3')
        ->py('2')
        ->border()
        ->borderRadius('3')
        ->child(UI::utility()->tag('span')->textWeight('bold')->textSize('5')->content('Spacing & Sizing'))
        ->child(UI::utility()->tag('span')->textColor('muted')->content('Utility API Demo')),

    UI::utility()
        ->dFlex()
        ->flexRow()
        ->gap('2')
        ->mb('3')
        ->child(UI::utility()->tag('div')->w('25')->p('3')->bg('info')->textColor('white')->rounded()->textAlign('center')->content('w-25'))
        ->child(UI::utility()->tag('div')->w('50')->p('3')->bg('danger')->textColor('white')->rounded()->textAlign('center')->content('w-50'))
        ->child(UI::utility()->tag('div')->w('25')->p('3')->bg('success')->textColor('white')->rounded()->textAlign('center')->content('w-25')),

    UI::utility()
        ->dFlex()
        ->flexRow()
        ->gap('3')
        ->mb('3')
        ->child(UI::utility()->tag('div')->shadow()->p('3')->rounded()->content('Shadow Default'))
        ->child(UI::utility()->tag('div')->shadow('sm')->p('3')->rounded()->content('Shadow SM'))
        ->child(UI::utility()->tag('div')->shadow('lg')->p('3')->rounded()->content('Shadow LG'))
        ->child(UI::utility()->tag('div')->shadow('none')->p('3')->rounded()->border()->content('Shadow None')),

    UI::utility()
        ->dFlex()
        ->flexRow()
        ->gap('2')
        ->mb('3')
        ->child(UI::utility()->tag('div')->rounded()->p('2')->border()->content('Rounded'))
        ->child(UI::utility()->tag('div')->rounded('circle')->p('2')->border()->w('5')->h('5')->dFlex()->justify('center')->alignItems('center')->content('C'))
        ->child(UI::utility()->tag('div')->rounded('pill')->px('3')->py('1')->bg('primary')->textColor('white')->text('class', 'd-flex align-items-center')->content('Pill Badge'))
        ->child(UI::utility()->tag('div')->rounded('0')->p('2')->border()->content('Sharp')),

    UI::hr(),

    UI::flex([
        UI::p('© 2026 BagasTopati UI Core'),
    ])->center(),

])->fullDocument()
    ->meta('description', 'PHP UI Builder Dashboard Demo')
    ->meta('author', 'Bagas Topati')
    ->navbar(
        UI::navbar('UI Core')
            ->brandHref('/')
            ->links(['Dashboard' => '/', 'Users' => '/users', 'Settings' => '/settings'])
    );
