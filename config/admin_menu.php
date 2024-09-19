<?php

return [
    [
        'nama_menu' => 'Dashboard',
        'url' => 'admin/dashboard',
        'children' => []
    ],
    [
        'nama_menu' => 'Pengajuan',
        'url' => 'admin/pengajuan',
        'children' => []
    ],
    [
        'nama_menu' => 'Master Data',
        'url' => 'admin/master-data/*',
        'children' => [
            [
                'nama_menu' => 'Daftar Operator',
                'url' => 'admin/master-data/operator',
                'children' => []
            ],
            [
                'nama_menu' => 'Daftar Pimpinan',
                'url' => 'admin/master-data/pimpinan',
                'children' => []
            ],
            [
                'nama_menu' => 'Daftar Pembimbing',
                'url' => 'admin/master-data/pembimbing',
                'children' => []
            ],
        ]
    ],
    [
        'nama_menu' => 'Setelan',
        'url' => 'admin/setelan/*',
        'children' => [
            [
                'nama_menu' => 'Manajemen Peran',
                'url' => 'admin/setelan/peran',
                'children' => []
            ],
            [
                'nama_menu' => 'Manajemen Menu',
                'url' => 'admin/setelan/menu/panel',
                'children' => []
            ]
        ]
    ]
];
