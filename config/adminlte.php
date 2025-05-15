<?php

return [

    'title' => 'Agatha Space Panel', // Judul lebih spesifik
    'title_prefix' => '',
    'title_postfix' => ' | Admin', // Tambahkan postfix untuk tab browser

    'use_ico_only' => true, // Jika punya favicon.ico di public/
    'use_full_favicon' => false,

    'google_fonts' => [
        'allowed' => true,
    ],

    // Logo utama di sidebar
    'logo' => '<b>Agatha</b>Space', // Bisa juga hanya gambar jika 'logo_img_xl' di set
    'logo_img' => 'img/agathaspace_logo.png', // GANTI DENGAN PATH LOGO KAMU (misal: public/img/agathaspace_logo.png)
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_alt' => 'Agatha Space Logo',

    // Logo kecil saat sidebar di-minimize (opsional, jika beda)
    // 'logo_img_xl' => null,
    // 'logo_img_xl_class' => 'brand-image-xs',

    'auth_logo' => [
        'enabled' => true, // Aktifkan jika ingin logo di halaman login/register
        'img' => [
            'path' => 'img/agathaspace_logo.png', // GANTI DENGAN PATH LOGO KAMU
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 80, // Sesuaikan ukuran
            'height' => 80, // Sesuaikan ukuran
        ],
    ],

    'preloader' => [
        'enabled' => true,
        'mode' => 'fullscreen', // atau 'standard'
        'img' => [
            'path' => 'img/agathaspace_logo.png', // GANTI DENGAN PATH LOGO KAMU
            'alt' => 'Agatha Space Preloader Image',
            'effect' => 'animation__shake', // atau animation__pulse, animation__bounce, dll.
            'width' => 80,
            'height' => 80,
        ],
    ],

    'usermenu_enabled' => true,
    'usermenu_header' => true, // Tampilkan header dengan nama user di dropdown
    'usermenu_header_class' => 'bg-primary', // Warna header dropdown user
    'usermenu_image' => true, // Tampilkan avatar user (jika ada field avatar di model User)
    'usermenu_desc' => true, // Tampilkan role atau deskripsi user (jika ada)
    'usermenu_profile_url' => '#', // Arahkan ke halaman profil user jika ada

    // Layout options
    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true, // Sidebar tetap saat scroll
    'layout_fixed_navbar' => true,  // Navbar atas tetap saat scroll
    'layout_fixed_footer' => false,
    'layout_dark_mode' => null,    // Bisa di set 'dark-mode' untuk tema gelap default

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_btn' => 'btn-flat btn-primary',

    // Skin sidebar (pilih salah satu atau kombinasikan)
    // Contoh: 'sidebar-dark-primary', 'sidebar-light-info', 'sidebar-dark-indigo', dll.
    'classes_sidebar' => 'sidebar-dark-primary elevation-4', // Kombinasi warna dan shadow
    'classes_topnav' => 'navbar-white navbar-light', // Bisa juga 'navbar-dark navbar-primary'
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container', // atau 'container-fluid'

    'sidebar_mini' => 'lg', // 'md' atau 'xs' atau true untuk selalu mini
    'sidebar_collapse' => false, // Apakah sidebar defaultnya ter-collapse
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    'right_sidebar' => false, // Nonaktifkan right sidebar jika tidak dipakai
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    'use_route_url' => false, // Set false agar bisa pakai helper route()
    'dashboard_url' => 'admin.dashboard', // Gunakan nama route
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register', // Kosongkan jika tidak ada fitur register publik
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => '#', // Link ke profil user

    'menu' => [
        // Navbar items:
        // [
        //     'type'         => 'navbar-search',
        //     'text'         => 'search',
        //     'topnav_right' => true,
        // ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        ['header' => 'MENU UTAMA', 'classes' => 'text-bold text-uppercase'], // Header lebih menonjol
        [
            'text' => 'Dashboard',
            'route'  => 'admin.dashboard', // Pastikan nama route ini ada
            'icon' => 'fas fa-fw fa-tachometer-alt',
        ],

        ['header' => 'MANAJEMEN KONTEN', 'classes' => 'text-bold text-uppercase'],
        [
            'text' => 'Kategori',
            'route' => 'admin.categories.index',
            'icon' => 'fas fa-fw fa-tags',
        ],
        [
            'text' => 'Menu Makanan/Minuman', // Lebih deskriptif
            'route' => 'admin.menus.index',
            'icon' => 'fas fa-fw fa-utensils',
        ],
        [
            'text' => 'Galeri',
            'route' => 'admin.gallery.index',
            'icon' => 'fas fa-fw fa-images',
        ],
        [
            'text' => 'Promo & Event',
            'route' => 'admin.promo-event.index',
            'icon' => 'fas fa-fw fa-bullhorn',
        ],

        ['header' => 'INTERAKSI PELANGGAN', 'classes' => 'text-bold text-uppercase'],
        [
            'text' => 'Kritik & Saran',
            'route' => 'admin.kritik-saran.index',
            'icon' => 'fas fa-fw fa-comment-dots', // Icon lebih sesuai
        ],
        [
            'text' => 'Reservasi Meja', // Lebih jelas
            'route' => 'admin.table.index',
            'icon' => 'fas fa-fw fa-concierge-bell',
        ],
        [
            'text' => 'Pesanan Pelanggan',
            'route' => 'admin.orders.index',
            'icon' => 'fas fa-fw fa-shopping-cart',
        ],

        ['header' => 'MANAJEMEN PENGGUNA', 'classes' => 'text-bold text-uppercase'],
        [
            'text'    => 'Pengguna',
            'route'     => 'admin.users.index',
            'icon'    => 'fas fa-fw fa-users',

        [ 
            'text' => 'Keluar',
            'route' => 'logout',
            'icon'  =>'fas fa-sign-out-alt' ,
        ]    


           
            // 'can'  => 'manage-users', // Aktifkan jika pakai permission
        ],
        // Contoh submenu:
        // [
        //     'text' => 'Pengaturan',
        //     'icon' => 'fas fa-fw fa-cogs',
        //     'submenu' => [
        //         [
        //             'text' => 'Profil Toko',
        //             'url'  => '#', // Ganti dengan route
        //             'icon' => 'fas fa-fw fa-store',
        //         ],
        //         [
        //             'text' => 'Umum',
        //             'url'  => '#', // Ganti dengan route
        //             'icon' => 'fas fa-fw fa-cog',
        //         ],
        //     ]
        // ]
    ],

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    'plugins' => [
        'Datatables' => [
            'active' => true, // Aktifkan jika kamu pakai datatables
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js', // Versi lebih baru
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js', // Versi lebih baru
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css', // Versi lebih baru
                ],
            ],
        ],
        'Select2' => [ // Contoh plugin lain
            'active' => false, // Aktifkan jika perlu
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css',
                ],
            ],
        ],
        'Chartjs' => [ // Untuk grafik jika dibutuhkan di dashboard
            'active' => false, // Aktifkan jika perlu
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js',
                ],
            ],
        ],
        // ... plugin lain seperti Sweetalert2, Pace, dll.
    ],

    'iframe' => [ // Nonaktifkan jika tidak menggunakan fitur tab iframe
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => false,
            'close_all' => false,
            'close_all_other' => false,
            'scroll_left' => false,
            'scroll_right' => false,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => false,
            'use_navbar_items' => false,
        ],
    ],

    'livewire' => false, // Set true jika kamu menggunakan Livewire dalam AdminLTE
];