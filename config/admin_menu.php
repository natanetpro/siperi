<?php

return [
    [
        'nama_menu' => 'Dashboard',
        'url' => 'admin/dashboard',
        'children' => [],
        'permission' => ['Administrator', 'Pimpinan', 'Pembimbing', 'Operator']
    ],
    [
        'nama_menu' => 'Pengajuan',
        'url' => 'admin/pengajuan',
        'children' => [],
        'permission' => ['Administrator', 'Pimpinan']
    ],
    [
        'nama_menu' => 'Daftar Kegiatan',
        'url' => 'pembimbing/logbook',
        'children' => [],
        'permission' => ['Pembimbing']
    ],
    [
        'nama_menu' => 'Laporan Akhir',
        'url' => 'pembimbing/laporan-akhir',
        'children' => [],
        'permission' => ['Pembimbing']
    ],
    [
        'nama_menu' => 'Masukan & Saran',
        'url' => 'pembimbing/masukan',
        'children' => [],
        'permission' => ['Pembimbing']

    ],
    [
        'nama_menu' => 'Daftar Kegiatan',
        'url' => 'admin/logbook',
        'children' => [],
        'permission' => ['Administrator', 'Pimpinan', 'Operator']

    ],
    [
        'nama_menu' => 'Laporan Akhir',
        'url' => 'admin/laporan-akhir',
        'children' => [],
        'permission' => ['Administrator', 'Pimpinan', 'Operator']
    ],
    [
        'nama_menu' => 'Sertifikat',
        'url' => 'admin/sertifikat',
        'children' => [],
        'permission' => ['Administrator', 'Pimpinan', 'Operator']
    ],
    [
        'nama_menu' => 'Master Data',
        'url' => 'admin/master-data/*',
        'permission' => ['Administrator', 'Pimpinan', 'Operator'],
        'children' => [
            [
                'nama_menu' => 'Daftar Pengguna',
                'url' => 'admin/master-data/pengguna',
                'children' => [],
                'permission' => ['Administrator', 'Pimpinan', 'Operator']
            ],
            // [
            //     'nama_menu' => 'Daftar Operator',
            //     'url' => 'admin/master-data/operator',
            //     'children' => []
            // ],
            // [
            //     'nama_menu' => 'Daftar Pimpinan',
            //     'url' => 'admin/master-data/pimpinan',
            //     'children' => []
            // ],
            // [
            //     'nama_menu' => 'Daftar Pembimbing',
            //     'url' => 'admin/master-data/pembimbing',
            //     'children' => []
            // ],
            [
                'nama_menu' => 'Sertifikat',
                'url' => 'admin/master-data/sertifikat',
                'children' => [],
                'permission' => ['Administrator', 'Pimpinan', 'Operator']
            ]
        ]
    ],
    [
        'nama_menu' => 'Setelan',
        'url' => 'admin/setelan/*',
        'permission' => ['Administrator', 'Pimpinan', 'Operator'],
        'children' => [
            [
                'nama_menu' => 'Manajemen Peran',
                'url' => 'admin/setelan/peran',
                'children' => [],
                'permission' => ['Administrator', 'Pimpinan', 'Operator']

            ],
            // [
            //     'nama_menu' => 'Manajemen Menu',
            //     'url' => 'admin/setelan/menu/panel',
            //     'children' => []
            // ]
        ]
    ]
];
