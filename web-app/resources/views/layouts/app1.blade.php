<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>Dashboard | Boondock Admin</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/front/MiniLogo.svg') }}">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/font/bootstrap-icons.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/tom-select/dist/css/tom-select.bootstrap5.css') }}">
    <script src="https://kit.fontawesome.com/a79c528d01.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('assets/vendor/tom-select/dist/css/tom-select.bootstrap5.css') }}">
    <!-- CSS Front Template -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet preload prefetch" href="{{ asset('assets/css/theme.min.css') }}" data-hs-appearance="default"
        as="style">
    <link rel="stylesheet preload prefetch" href="{{ asset('assets/css/theme-dark.min.css') }}"
        data-hs-appearance="dark" as="style">
    {{-- for dropzone od news edit and create --}}
    <!-- Dropzone CSS -->
    <link href="https://cdn.jsdelivr.net/npm/dropzone@5.9.2/dist/min/dropzone.min.css" rel="stylesheet">

    <!-- Cropper CSS -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js"></script>

    {{-- style for table --}}
    <style>
        table th,
        table td {
            padding: .625em;
            /* text-align: center; */
        }

        table th {
            font-size: .85em;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        @media screen and (max-width: 600px) {
            tr.hide-in-mobile {
                display: none;
            }

            table {
                border: 0;
            }

            table caption {
                font-size: 1.3em;
            }

            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;

                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            table tr {
                border-bottom: 1px solid #ddd;
                display: block;

            }

            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: .8em;
                text-align: right;
            }

            table td::before {
                /*
        * aria-label has no advantage, it won't be read inside a table
        content: attr(aria-label);
        */
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }

            table td:last-child {
                border-bottom: 0;
            }

            tr:nth-child(even) {
                background-color: rgba(250, 250, 250, 0.589);
            }
        }

        /* Add styles for alternating row colors */
        table.show-original tr:nth-child(odd) {
            background-color: white;
        }

        table.show-original tr:nth-child(even) {
            background-color: rgb(250, 250, 250);
        }
    </style>

    {{-- /* style for sho hide icon on hover */   --}}
    <style>
        /* Replace '.bi-trash-fill' with the appropriate class for the delete icon */
        .show-hide:hover .show-hide-icon {
            display: inline-block;
            /* Show the show-hide icon on hover */
        }

        .show-hide .show-hide-icon {
            display: none;
            /* Hide the show-hide icon by default */
        }

        /* Optional: Remove text selection highlight when clicking the show-hide icon */
        .show-hide .show-hide-icon::selection {
            background-color: transparent;
        }
    </style>
    {{-- style for schduler and monitor hide buttons --}}
    <style>
        .hover-content .date-time {
            visibility: visible;
        }

        .hover-content:hover .date-time {
            visibility: hidden;
        }

        .hover-content .delete-btn {
            visibility: hidden;
        }

        .hover-content:hover .delete-btn {
            visibility: visible;
        }
    </style>
    <style data-hs-appearance-onload-styles>
        * {
            transition: unset !important;
        }

        body {
            opacity: 0;
        }
    </style>
    <style>
        /* ... your other styles ... */

        .transition-link {
            position: relative;
            display: inline-block;
            overflow: hidden;
        }

        .transition-link i {
            display: inline-block;
            animation: push 3s infinite linear;
        }

        @keyframes push {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(100%);
            }
        }

        /* ... your other styles ... */
    </style>


    <script>
        window.hs_config = {
            "autopath": "@@autopath",
            "deleteLine": "hs-builder:delete",
            "deleteLine:build": "hs-builder:build-delete",
            "deleteLine:dist": "hs-builder:dist-delete",
            "previewMode": false,
            "startPath": "/index.html",
            "vars": {
                "themeFont": "https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap",
                "version": "?v=1.0"
            },
            "layoutBuilder": {
                "extend": {
                    "switcherSupport": true
                },
                "header": {
                    "layoutMode": "default",
                    "containerMode": "container-fluid"
                },
                "sidebarLayout": "default"
            },
            "themeAppearance": {
                "layoutSkin": "default",
                "sidebarSkin": "default",
                "styles": {
                    "colors": {
                        "primary": "#377dff",
                        "transparent": "transparent",
                        "white": "#fff",
                        "dark": "132144",
                        "gray": {
                            "100": "#f9fafc",
                            "900": "#1e2022"
                        }
                    },
                    "font": "Inter"
                }
            },
            "languageDirection": {
                "lang": "en"
            },
            "skipFilesFromBundle": {
                "dist": ["assets/js/hs.theme-appearance.js", "assets/js/hs.theme-appearance-charts.js",
                    "assets/js/demo.js"
                ],
                "build": ["assets/css/theme.css",
                    "assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js",
                    "assets/js/demo.js", "assets/css/theme-dark.css", "assets/css/docs.css",
                    "assets/vendor/icon-set/style.css", "assets/js/hs.theme-appearance.js",
                    "assets/js/hs.theme-appearance-charts.js",
                    "node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js",
                    "assets/js/demo.js"
                ]
            },
            "minifyCSSFiles": ["assets/css/theme.css", "assets/css/theme-dark.css"],
            "copyDependencies": {
                "dist": {
                    "*assets/js/theme-custom.js": ""
                },
                "build": {
                    "*assets/js/theme-custom.js": "",
                    "node_modules/bootstrap-icons/font/*fonts/**": "assets/css"
                }
            },
            "buildFolder": "",
            "replacePathsToCDN": {},
            "directoryNames": {
                "src": "./src",
                "dist": "./dist",
                "build": "./build"
            },
            "fileNames": {
                "dist": {
                    "js": "theme.min.js",
                    "css": "theme.min.css"
                },
                "build": {
                    "css": "theme.min.css",
                    "js": "theme.min.js",
                    "vendorCSS": "vendor.min.css",
                    "vendorJS": "vendor.min.js"
                }
            },
            "fileTypes": "jpg|png|svg|mp4|webm|ogv|json"
        }
        window.hs_config.gulpRGBA = (p1) => {
            const options = p1.split(',')
            const hex = options[0].toString()
            const transparent = options[1].toString()

            var c;
            if (/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)) {
                c = hex.substring(1).split('');
                if (c.length == 3) {
                    c = [c[0], c[0], c[1], c[1], c[2], c[2]];
                }
                c = '0x' + c.join('');
                return 'rgba(' + [(c >> 16) & 255, (c >> 8) & 255, c & 255].join(',') + ',' + transparent + ')';
            }
            throw new Error('Bad Hex');
        }
        window.hs_config.gulpDarken = (p1) => {
            const options = p1.split(',')

            let col = options[0].toString()
            let amt = -parseInt(options[1])
            var usePound = false

            if (col[0] == "#") {
                col = col.slice(1)
                usePound = true
            }
            var num = parseInt(col, 16)
            var r = (num >> 16) + amt
            if (r > 255) {
                r = 255
            } else if (r < 0) {
                r = 0
            }
            var b = ((num >> 8) & 0x00FF) + amt
            if (b > 255) {
                b = 255
            } else if (b < 0) {
                b = 0
            }
            var g = (num & 0x0000FF) + amt
            if (g > 255) {
                g = 255
            } else if (g < 0) {
                g = 0
            }
            return (usePound ? "#" : "") + (g | (b << 8) | (r << 16)).toString(16)
        }
        window.hs_config.gulpLighten = (p1) => {
            const options = p1.split(',')

            let col = options[0].toString()
            let amt = parseInt(options[1])
            var usePound = false

            if (col[0] == "#") {
                col = col.slice(1)
                usePound = true
            }
            var num = parseInt(col, 16)
            var r = (num >> 16) + amt
            if (r > 255) {
                r = 255
            } else if (r < 0) {
                r = 0
            }
            var b = ((num >> 8) & 0x00FF) + amt
            if (b > 255) {
                b = 255
            } else if (b < 0) {
                b = 0
            }
            var g = (num & 0x0000FF) + amt
            if (g > 255) {
                g = 255
            } else if (g < 0) {
                g = 0
            }
            return (usePound ? "#" : "") + (g | (b << 8) | (r << 16)).toString(16)
        }
    </script>
</head>

<body class="has-navbar-vertical-aside navbar-vertical-aside-show-xl   footer-offset">

    <script src="{{ asset('assets/js/hs.theme-appearance.js') }}"></script>

    <script src="{{ asset('assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js') }}">
    </script>

    <!-- ========== HEADER ========== -->

    <header id="header"
        class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-container navbar-bordered bg-white">
        <div class="navbar-nav-wrap">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('inbox') }}">
                <img class="navbar-brand-logo" src="{{ asset('assets/img/front/logo-name.png') }}" alt="Logo"
                    data-hs-theme-appearance="default">
                <img class="navbar-brand-logo" src="{{ asset('assets/img/front/logo-name.png') }}" alt="Logo"
                    data-hs-theme-appearance="dark">
                <img class="navbar-brand-logo-mini" src="{{ asset('assets/img/front/head.png') }}" alt="Logo"
                    data-hs-theme-appearance="default">
                <img class="navbar-brand-logo-mini" src="{{ asset('assets/img/front/head.png') }}" alt="Logo"
                    data-hs-theme-appearance="dark">
            </a>
            <!-- End Logo -->

            <div class="navbar-nav-wrap-content-start">
                <!-- Navbar Vertical Toggle -->
                <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
                    <i class="bi-arrow-bar-left navbar-toggler-short-align"
                        data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                        data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
                    <i class="bi-arrow-bar-right navbar-toggler-full-align"
                        data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                        data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
                </button>

                <!-- End Navbar Vertical Toggle -->


            </div>
            @php
                use App\Helpers\DockpackHelper;
                $dockpacks = getDockpacks();
                $currentUrl = url()->current();
                $activeFlag = false; // set flag to false initially
                
                // check if the URL contains "pack" or if it's the root URL "/"
if (strpos($currentUrl, '/pack/') !== false) {
    $activeFlag = true; // set flag to true
} elseif ($currentUrl == '/') {
                    $activeFlag = true; // set flag to true
                }
                
            @endphp
            @if ($activeFlag)
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                        <li class="breadcrumb-item">
                            <a class="breadcrumb-link" href="">Received </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a class="text-capitalize">
                                @php
                                    $activeFlag = false; // reset flag to false
                                @endphp
                                @foreach ($dockpacks as $dockpack)
                                    @if (isset($dockpack['active_class']) && $dockpack['active_class'] != '')
                                        {{ $dockpack['name'] }}
                                        @php
                                            $activeFlag = true; // set flag to true if active class is found
                                        @endphp
                                    @break

                                    // exit the loop if an active dockpack is found
                                @endif
                            @endforeach

                        </a>
                    </li>
                </ol>
            </nav>
        @endif
        @if (Request::is('/receive'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href="">Received </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a class="text-capitalize">All dock Packs</a>
                    </li>
                </ol>
            </nav>
        @elseif (Request::is('outbox'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href="">Message </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a class="text-capitalize">Sent</a>
                    </li>
                </ol>
            </nav>
        @elseif (Request::is('favorites'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href="">Message </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a class="text-capitalize">Favorites</a>
                    </li>
                </ol>
            </nav>
        @elseif (Request::is('mydocks'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href="">Manage </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a class="text-capitalize">My Docks</a>
                    </li>
                </ol>
            </nav>
        @elseif (Request::is('dockpack'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href="">Manage </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a class="text-capitalize">Dock packs</a>
                    </li>
                </ol>
            </nav>
        @elseif (Request::is('alerts'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href="">Manage </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a class="text-capitalize">Monitor Dashboard</a>
                    </li>
                </ol>
            </nav>
        @elseif (Request::is('schedular'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href="">Manage </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a class="text-capitalize">schedular</a>
                    </li>
                </ol>
            </nav>
        @elseif (Request::is('dockadmin'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href="">
                            @if (Auth::check())
                                <?php $account = \App\Models\Account::find(Auth::user()->company); ?>
                                @if ($account)
                                    {{ $account->account_name }}
                                @else
                                    Admin Account
                                @endif
                            @endif
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a class="text-capitalize">Assign Docks</a>
                    </li>
                </ol>
            </nav>
        @elseif (Request::is('myaccount'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href="">
                            @if (Auth::check())
                                <?php $account = \App\Models\Account::find(Auth::user()->company); ?>
                                @if ($account)
                                    {{ $account->account_name }}
                                @else
                                    Manage Account
                                @endif
                            @endif
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a class="text-capitalize">Manage Account</a>
                    </li>
                </ol>
            </nav>
        @elseif (Request::is('useradmin'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href="">
                            @if (Auth::check())
                                <?php $account = \App\Models\Account::find(Auth::user()->company); ?>
                                @if ($account)
                                    {{ $account->account_name }}
                                @else
                                    Admin Account
                                @endif
                            @endif
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a class="text-capitalize">Manage Users</a>
                    </li>
                </ol>
            </nav>
        @elseif (Request::is('docks'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href=""> Super admin </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a class="text-capitalize">Manage Docks</a>
                    </li>
                </ol>
            </nav>
        @elseif (Request::is('accounts'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href=""> Super admin </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a class="text-capitalize">Manage Accounts</a>
                    </li>
                </ol>
            </nav>
        @elseif (Request::is('users'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href=""> Super admin </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a class="text-capitalize">Manage Users</a>
                    </li>
                </ol>
            </nav>
        @elseif (Request::is('roles'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href=""> Super admin </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a class="text-capitalize">Manage Roles</a>
                    </li>
                </ol>
            </nav>
        @elseif (Request::is('contacts'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href=""> Super admin </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a class="text-capitalize">Manage Contacts</a>
                    </li>
                </ol>
            </nav>
        @elseif (Request::is('user_activity'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href=""> Super admin </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a class="text-capitalize">User Tracking Dashboard</a>
                    </li>
                </ol>
            </nav>
        @elseif (Request::is('profile'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href="">Account </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a class="text-capitalize">Profile</a>
                    </li>
                </ol>
            </nav>
        @elseif (Request::is('activitystream'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href="">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a class="text-capitalize">Activity Stream</a>
                    </li>
                </ol>
            </nav>
        @elseif (Request::is('license'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href="">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a class="text-capitalize">License Information</a>
                    </li>
                </ol>
            </nav>
        @elseif (Request::is('news-admin'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href="">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a class="text-capitalize">News Admin</a>
                    </li>
                </ol>
            </nav>
        @elseif (Request::is('explore'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href="">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a class="text-capitalize">Explore</a>
                    </li>
                </ol>
            </nav>
            @elseif (Request::is('import-csv'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter mt-2">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href="">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a class="text-capitalize">Manage Explore Data</a>
                    </li>
                </ol>
            </nav>
          
        @endif
        {{-- {{ Request::is('/') ? 'All Dock Packs' : '' }} --}}
        <div class="navbar-nav-wrap-content-end">


            <!-- Navbar -->
            <ul class="navbar-nav">

                <li class="nav-item d-none d-sm-inline-block">
                    <!-- Notification -->

                    <!-- End Notification -->
                </li>






                <li class="nav-item">
                    <!-- Account -->
                    <div class="dropdown">
                        <a class="navbar-dropdown-account-wrapper" href="javascript:;" id="accountNavbarDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"
                            data-bs-dropdown-animation>
                            <div class="avatar avatar-sm avatar-circle">
                                @if (auth()->user()->profile_picture !== url('/storage'))
                                    <img class="avatar-img" src="{{ auth()->user()->profile_picture }}"
                                        alt="Image Description">
                                @else
                                    <img class="avatar-img" src="{{ asset('default.jpg') }}"
                                        alt="Image Description">
                                @endif
                                <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account"
                            aria-labelledby="accountNavbarDropdown" style="width: 16rem;">
                            <div class="dropdown-item-text">
                                <div class="d-flex align-items-center">
                                    {{-- <div class="avatar avatar-sm avatar-circle">
                      <img class="avatar-img" src="{{asset('assets/img/160x160/img6.jpg" alt="Image Description">
                    </div> --}}
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-0">
                                            {{ auth()->user()->nick_name ?? auth()->user()->name . (auth()->user()->last_name ? ' ' . auth()->user()->last_name : '') }}
                                        </h5>
                                        <p class="card-text text-body">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-divider"></div>

                            <!-- Dropdown -->
                            {{-- <div class="dropdown">
                  <a class="navbar-dropdown-submenu-item dropdown-item dropdown-toggle" href="javascript:;" id="navSubmenuPagesAccountDropdown1" data-bs-toggle="dropdown" aria-expanded="false">Set status</a>

                  <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-sub-menu" aria-labelledby="navSubmenuPagesAccountDropdown1">
                    <a class="dropdown-item" href="#">
                      <span class="legend-indicator bg-success me-1"></span> Available
                    </a>
                    <a class="dropdown-item" href="#">
                      <span class="legend-indicator bg-danger me-1"></span> Busy
                    </a>
                    <a class="dropdown-item" href="#">
                      <span class="legend-indicator bg-warning me-1"></span> Away
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"> Reset status
                    </a>
                  </div>
                </div> --}}
                            <!-- End Dropdown -->

                            <a class="dropdown-item" href="{{ route('profile') }}">My Profile</a>
                            {{-- <a class="dropdown-item" href="#">Settings</a> --}}

                            {{-- <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('alerts.show') }}">
                                Alerts <span class="badge bg-primary rounded-pill ms-1">{{ Auth::user()->alerts()->count() }}</span>
                            </a> --}}

                            {{-- <a class="dropdown-item" href="#">Settings</a> --}}

                            <div class="dropdown-divider"></div>

                            {{-- <a class="dropdown-item" href="#">
                  <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                      <div class="avatar avatar-sm avatar-dark avatar-circle">
                        <span class="avatar-initials">HS</span>
                      </div>
                    </div>
                    <div class="flex-grow-1 ms-2">
                      <h5 class="mb-0">Htmlstream <span class="badge bg-primary rounded-pill text-uppercase ms-1">PRO</span></h5>
                      <span class="card-text">hs.example.com</span>
                    </div>
                  </div>
                </a> --}}

                            {{-- <div class="dropdown-divider"></div> --}}

                            <!-- Dropdown -->
                            {{-- <div class="dropdown">
                  <a class="navbar-dropdown-submenu-item dropdown-item dropdown-toggle" href="javascript:;" id="navSubmenuPagesAccountDropdown2" data-bs-toggle="dropdown" aria-expanded="false">Customization</a>

                  <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-sub-menu" aria-labelledby="navSubmenuPagesAccountDropdown2">
                    <a class="dropdown-item" href="#">
                      Invite people
                    </a>
                    <a class="dropdown-item" href="#">
                      Analytics
                      <i class="bi-box-arrow-in-up-right"></i>
                    </a>
                    <a class="dropdown-item" href="#">
                      Customize Front
                      <i class="bi-box-arrow-in-up-right"></i>
                    </a>
                  </div>
                </div> --}}
                            <!-- End Dropdown -->

                            {{-- <a class="dropdown-item" href="#">Manage team</a> --}}

                            {{-- <div class="dropdown-divider"></div> --}}

                            {{-- <a class="dropdown-item" href="#">Sign out</a> --}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                    <!-- End Account -->
                </li>
            </ul>
            <!-- End Navbar -->
        </div>
    </div>
</header>

<!-- ========== END HEADER ========== -->

<!-- ========== MAIN CONTENT ========== -->
<!-- Navbar Vertical -->

{{-- <aside class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white  "> --}}
<aside
    class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-dark bg-dark navbar-vertical-aside-initialized">
    <div class="navbar-vertical-container">
        <div class="navbar-vertical-footer-offset">
            <!-- Logo -->

            <a class="navbar-brand" href="{{ route('inbox') }}">
                <img class="navbar-brand-logo" style="min-width: 10.5rem;"
                    src="{{ asset('assets/img/front/logo-name.png') }}" alt="Logo"
                    data-hs-theme-appearance="default">
                <img class="navbar-brand-logo" style="min-width: 10.5rem;"
                    src="{{ asset('assets/img/front/logo-name.png') }}" alt="Logo"
                    data-hs-theme-appearance="dark">
                <img class="navbar-brand-logo-mini" src="{{ asset('assets/img/front/head.png') }}"
                    alt="Logo" data-hs-theme-appearance="default">
                <img class="navbar-brand-logo-mini" src="{{ asset('assets/img/front/head.png') }}"
                    alt="Logo" data-hs-theme-appearance="dark">
            </a>

            <!-- End Logo -->

            <!-- Navbar Vertical Toggle -->
            <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
                <i class="bi-arrow-bar-left navbar-toggler-short-align"
                    data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
                <i class="bi-arrow-bar-right navbar-toggler-full-align"
                    data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
            </button>

            <!-- End Navbar Vertical Toggle -->
            
            <!-- Content -->
            <div class="navbar-vertical-content">
                <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">
                    <span class="dropdown-header mt-2">Network</span>
                    <div class="nav-item">
                     
                        <a class="nav-link {{ Request::is('explore') ? 'active' : '' }}" href="/explore">  
                            <i class="nav-icon">
                                <img src="{{ asset('assets/img/front/explore.png') }}" alt="Icon"
                                    style="width: 20px; height: 20px;">
                            </i> 
                            <span class="nav-link-title">Explore</span>  
                        </a>
                    </div>
                    <span class="dropdown-header mt-2">Messages</span>
                   

                   
                    <div id="navbarVerticalMenuPagesMenu">
                        {{-- <div class="nav-item">
                                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('inbox', ['date_range' => '30_days']) }}" data-placement="left">
                                        <i class="fa-solid fa-download nav-icon"></i>
                                    <span class="nav-link-title">Received</span>
                                    </a>
                                </div> --}}
                        <!-- Collapse -->
                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle " href="#menuofallreceived" role="button"
                                data-bs-toggle="collapse" data-bs-target="#menuofallreceived"
                                aria-expanded="false" aria-controls="menuofallreceived">
                                <i class="fa-solid fa-download nav-icon"></i>
                                <span class="nav-link-title">Received</span>
                            </a>

                            <div id="menuofallreceived"
                                class="nav-collapse {{ Request::is('/') || Str::contains($currentUrl, '/pack/') ? '' : 'collapse' }}"
                                data-bs-parent="#navbarVerticalMenuPagesMenu">
                                <span class="dropdown-header mt-4">DOCK PACKS </span>
                                <small class="bi-three-dots nav-subtitle-replacer"></small>
                                <a class="nav-link {{ Request::is('/') ? 'active' : '' }} "
                                    href="{{ route('inbox', ['date_range' => '30_days']) }}">All Dock Packs</a>
                                @foreach ($dockpacks as $dockpack)
                                    <a class="nav-link {{ $dockpack['active_class'] }}"
                                        href="{{ $dockpack['route'] }}">{{ $dockpack['name'] }}</a>
                                @endforeach

                            </div>
                        </div>

                        <!-- End Collapse -->
                        @if (auth()->user()->hasRole('Super Admin'))
                            {{-- <div class="nav-item">
                                <a class="nav-link {{ Request::is('allinbox') ? 'active' : '' }}"
                                    href="{{ route('allinbox.index') }}" data-placement="left">
                                    <i class="fa-solid fa-download nav-icon"></i>
                                    <span class="nav-link-title">All Received

                                        <span class="badge bg-info rounded-pill ms-1">Super Admin</span>


                                    </span>
                                </a>
                            </div> --}}
                        @endif

                        <div class="nav-item">
                            <a class="nav-link {{ Request::is('outbox') ? 'active' : '' }}"
                                href="{{ route('outbox.index') }}" data-placement="left">
                                <i class="fa-regular fa-paper-plane nav-icon"></i>
                                <span class="nav-link-title">Sent</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link {{ Request::is('favorites') ? 'active' : '' }}"
                                href="{{ route('favorites.index') }}" data-placement="left">
                                <i class="fa-regular fa-heart nav-icon"></i>
                                <span class="nav-link-title">Favorites </span>
                            </a>
                        </div>



                        {{-- <div class="nav-item">
                <a class="nav-link " href="#" data-placement="left">
                  <i class="bi-check2-all nav-icon"></i>
                  <span class="nav-link-title">Sent</span>
                </a>
              </div> --}}
                        <span class="dropdown-header mt-4">Manage</span>
                        <small class="bi-three-dots nav-subtitle-replacer"></small>

                        <div class="nav-item">
                            <a class="nav-link {{ Request::is('mydocks') ? 'active' : '' }}"
                                href="{{ route('mydocks.index') }}" data-placement="left">
                                <i class="nav-icon">
                                    <img src="{{ asset('assets/img/front/dock.png') }}" alt="Icon"
                                        style="width: 22px; height: 22px;">
                                </i>  
                                <span class="nav-link-title">My Docks</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link {{ Request::is('dockpack') ? 'active' : '' }} "
                                href="{{ route('dockpack.index') }}" data-placement="left">
                                <i class="nav-icon">
                                    <img src="{{ asset('assets/img/front//icions/dockpack_3.png') }}"
                                        alt="Icon" style="width: 22px; height: 22px;">
                                </i>
                                <span class="nav-link-title">My Dock Packs</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link {{ Request::is('schedular') ? 'active' : '' }}"
                                href="{{ route('schedular.index') }}" data-placement="left">
                                <i class="fa-regular fa-clock nav-icon"></i>
                                <span class="nav-link-title">Schedular </span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link {{ Request::is('alerts') ? 'active' : '' }}"
                                href="{{ route('alerts.show') }}" data-placement="left">
                                <i class="fa-regular fa-eye  nav-icon"></i>
                                <span class="nav-link-title">Monitor </span>
                            </a>
                        </div>



                        {{-- @if (auth()->user()->hasRole('Admin'))
              <div class="nav-item">
                <a class="nav-link {{ Request::is('myaccount') ? 'active' : '' }} " href="{{route('myaccount.index')}}" data-placement="left">
                  <i class="bi bi-collection nav-icon"></i>
                  <span class="nav-link-title">My Account</span>
                </a>
              </div>
              @endif --}}
                        @if (auth()->user()->hasRole('Admin'))
                            <!-- Collapse -->
                            <div class="nav-item">
                                <a class="nav-link dropdown-toggle " href="#navbarVerticalMenuPagesUsersMenu1"
                                    role="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarVerticalMenuPagesUsersMenu1" aria-expanded="false"
                                    aria-controls="navbarVerticalMenuPagesUsersMenu1">
                                    <i class="bi-person-workspace nav-icon"></i>
                                    <span class="nav-link-title">
                                        @if (Auth::check())
                                            <?php $account = \App\Models\Account::find(Auth::user()->company); ?>
                                            @if ($account)
                                                {{ $account->account_name }}
                                            @else
                                                Admin Account
                                            @endif
                                        @endif
                                    </span>
                                </a>

                                <div id="navbarVerticalMenuPagesUsersMenu1"
                                    class="nav-collapse {{ Request::is('useradmin', 'myaccount', 'dockadmin') ? '' : 'collapse' }} "
                                    data-bs-parent="#navbarVerticalMenuPagesMenu">
                                    <span class="dropdown-header mt-4">Manage </span>
                                    <small class="bi-three-dots nav-subtitle-replacer"></small>
                                    <a class="nav-link {{ Request::is('dockadmin') ? 'active' : '' }} "
                                        href="{{ route('dockadmin.index') }}">Assign Docks</a>
                                    <a class="nav-link {{ Request::is('myaccount') ? 'active' : '' }}"
                                        href="{{ route('myaccount.index') }}">Manage Accounts </a>
                                    <a class="nav-link {{ Request::is('useradmin') ? 'active' : '' }}"
                                        href="{{ route('useradmin.index') }}">Manage Users </a>

                                </div>
                            </div>
                            <!-- End Collapse -->
                        @endif
                        @if (auth()->user()->hasRole('Super Admin'))
                            <!-- Collapse -->
                            <div class="nav-item">
                                <a class="nav-link dropdown-toggle " href="#navbarVerticalMenuPagesUsersMenu"
                                    role="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarVerticalMenuPagesUsersMenu" aria-expanded="false"
                                    aria-controls="navbarVerticalMenuPagesUsersMenu">
                                    <i class="bi-person-workspace nav-icon"></i>
                                    <span class="nav-link-title">Super Admin </span>
                                </a>

                                <div id="navbarVerticalMenuPagesUsersMenu"
                                    class="nav-collapse  {{ Request::is('users', 'roles', 'accounts', 'docks', 'user_activity') ? '' : 'collapse' }} "
                                    data-bs-parent="#navbarVerticalMenuPagesMenu">
                                    <span class="dropdown-header mt-4">Manage </span>
                                    <small class="bi-three-dots nav-subtitle-replacer"></small>
                                    <a class="nav-link {{ Request::is('docks') ? 'active' : '' }} "
                                        href="{{ route('docks.index') }}">Assign Docks</a>
                                    <a class="nav-link {{ Request::is('accounts') ? 'active' : '' }}"
                                        href="{{ route('accounts.index') }}">Manage Accounts </a>
                                    <a class="nav-link {{ Request::is('users') ? 'active' : '' }}"
                                        href="{{ route('users.index') }}">Manage Users </a>
                                    <a class="nav-link {{ Request::is('roles') ? 'active' : '' }}"
                                        href="{{ route('roles.index') }}">Manage Roles </a>
                                    <a class="nav-link {{ Request::is('contacts') ? 'active' : '' }}"
                                        href="{{ route('contacts.index') }}">Manage Contacts </a>
                                    <a class="nav-link {{ Request::is('queue_dashboard') ? 'active' : '' }}"
                                        href="{{ route('horizon.index') }}">Queue dashboard </a>
                                    <a class="nav-link {{ Request::is('Monitor') ? 'active' : '' }}"
                                        href="{{ url('monitor') }}">Monitor Request dashboard </a>
                                    <a class="nav-link {{ Request::is('user_activity') ? 'active' : '' }}"
                                        href="{{ route('user_activity.index') }}">User Tracking Dashboard </a>
                                    <a class="nav-link {{ Request::is('logs') ? 'active' : '' }}"
                                        href="/logs">Logs</a>
                                    <a class="nav-link {{ Request::is('news-admin') ? 'active' : '' }}"
                                        href="/news-admin">News</a>
                                    <a class="nav-link {{ Request::is('explore') ? 'active' : '' }}"
                                        href="/import-csv">Manage Explore Data<span class="badge bg-danger mx-2"> Dev</span></a>
                                    <a class="nav-link {{ Request::is('error_code_management') ? 'active' : '' }}"
                                        href="/error_code_management">Event Code manage <span
                                            class="badge bg-danger mx-2"> Dev</span></a>
                                </div>
                            </div>
                            <!-- End Collapse -->
                        @endif
                    </div>

                </div>
                <!-- End Content -->

                <!-- Footer -->
                <div class="navbar-vertical-footer">
                    <ul class="navbar-vertical-footer-list">
                        <li class="navbar-vertical-footer-list-item">
                            <!-- Style Switcher -->
                            <div class="dropdown dropup">
                                <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle"
                                    id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                                    data-bs-dropdown-animation></button>

                                <div class="dropdown-menu navbar-dropdown-menu navbar-dropdown-menu-borderless"
                                    aria-labelledby="selectThemeDropdown">
                                    <a class="dropdown-item" href="#" data-icon="bi-moon-stars"
                                        data-value="auto" onclick="setDarkMode(0)">
                                        <i class="bi-moon-stars me-2"></i>
                                        <span class="text-truncate" title="Auto (system default)">Auto (system
                                            default)</span>
                                    </a>
                                    <a class="dropdown-item" href="#" data-icon="bi-brightness-high"
                                        data-value="default" onclick="setDarkMode(0)">
                                        <i class="bi-brightness-high me-2"></i>
                                        <span class="text-truncate" title="Default (light mode)">Default (light
                                            mode)</span>
                                    </a>
                                    <a class="dropdown-item" href="#" data-icon="bi-moon"
                                        data-value="dark" onclick="setDarkMode(1)">
                                        <i class="bi-moon me-2"></i>
                                        <span class="text-truncate" title="Dark">Dark</span>
                                    </a>
                                </div>
                            </div>
                            <!-- End Style Switcher -->

                            <script>
                                function setDarkMode(darkModeValue) {
                                    // Make an AJAX request to update the user's dark mode preference
                                    $.ajax({
                                        type: 'POST',
                                        url: '{{ route('updateDarkMode') }}',
                                        data: {
                                            '_token': '{{ csrf_token() }}',
                                            'darkMode': darkModeValue,
                                        },
                                        success: function(response) {
                                            console.log(response); // You can handle the response as needed
                                            // Optionally, you can reload the page or update the UI based on the response.
                                        },
                                        error: function(error) {
                                            console.log(error);
                                        }
                                    });
                                }
                            </script>

                            <!-- End Style Switcher -->
                        </li>


                    </ul>
                </div>
                <!-- End Footer -->
            </div>
        </div>
</aside>
{{-- <script>
    $(document).ready(function() {
        $(".nav-link").click(function() {
            $(".my-button").removeClass("active");
            $(this).addClass("active");
        });
    });
</script> --}}
<!-- End Navbar Vertical -->

@yield('content')
<!-- ========== END MAIN CONTENT ========== -->

<!-- ========== SECONDARY CONTENTS ========== -->




<!-- Welcome Message Modal -->
<div class="modal fade" id="welcomeMessageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-close">
                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="bi-x-lg"></i>
                </button>
            </div>
            <!-- End Header -->

            <!-- Body -->
            <div class="modal-body p-sm-5">
                <div class="text-center">
                    <div class="w-75 w-sm-50 mx-auto mb-4">
                        <img class="img-fluid" src="{{ asset('assets/svg/illustrations/oc-collaboration.svg') }}"
                            alt="Image Description" data-hs-theme-appearance="default">
                        <img class="img-fluid"
                            src="{{ asset('assets/svg/illustrations-light/oc-collaboration.svg') }}"
                            alt="Image Description" data-hs-theme-appearance="dark">
                    </div>

                
                </div>
            </div>
            <!-- End Body -->

            <!-- Footer -->
            <div class="modal-footer d-block text-center py-sm-5">
                <small class="text-cap text-muted">Trusted by the world's best teams</small>

                <div class="w-85 mx-auto">
                    <div class="row justify-content-between">
                        <div class="col">
                            <img class="img-fluid" src="{{ asset('assets/svg/brands/gitlab-gray.svg') }}"
                                alt="Image Description">
                        </div>
                        <div class="col">
                            <img class="img-fluid" src="{{ asset('assets/svg/brands/fitbit-gray.svg') }}"
                                alt="Image Description">
                        </div>
                        <div class="col">
                            <img class="img-fluid" src="{{ asset('assets/svg/brands/flow-xo-gray.svg') }}"
                                alt="Image Description">
                        </div>
                        <div class="col">
                            <img class="img-fluid" src="{{ asset('assets/svg/brands/layar-gray.svg') }}"
                                alt="Image Description">
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Footer -->
        </div>
    </div>
</div>

<!-- End Welcome Message Modal -->


<!-- ========== END SECONDARY CONTENTS ========== -->

<!-- JS Global Compulsory  -->
<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-migrate/dist/jquery-migrate.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

<!-- JS Implementing Plugins -->
<script src="{{ asset('assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside.min.js') }}"></script>
<script src="{{ asset('assets/vendor/hs-form-search/dist/hs-form-search.min.js') }}"></script>


<script src="{{ asset('assets/vendor/hs-file-attach/dist/hs-file-attach.min.js') }}"></script>
<script src="{{ asset('assets/vendor/hs-step-form/dist/hs-step-form.min.js') }}"></script>
<script src="{{ asset('assets/vendor/hs-add-field/dist/hs-add-field.min.js') }}"></script>
<script src="{{ asset('assets/vendor/imask/dist/imask.min.js') }}"></script>
<script src="{{ asset('assets/vendor/tom-select/dist/js/tom-select.complete.min.js') }}"></script>

<script src="{{ asset('assets/vendor/chart.js/dist/chart.min.js') }}"></script>
{{-- <script src="{{ asset('assets/vendor/chartjs-chart-matrix/dist/chartjs-chart-matrix.min.js') }}"></script> --}}
<script src="{{ asset('assets/vendor/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js') }}"></script>
<script src="{{ asset('assets/vendor/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('assets/vendor/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/vendor/tom-select/dist/js/tom-select.complete.min.js') }}"></script>
<script src="{{ asset('assets/vendor/clipboard/dist/clipboard.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net.extensions/select/select.min.js') }}"></script>
<script src="{{ asset('assets/vendor/imask/dist/imask.min.js') }}"></script>


<!-- JS Front -->
<script src="{{ asset('assets/js/theme.min.js') }}"></script>
<script src="{{ asset('assets/js/hs.theme-appearance-charts.js') }}"></script>
{{-- for news edit and create --}}
<!-- Dropzone and Cropper JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/dropzone@5.9.2/dist/min/dropzone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<!-- JS Plugins Init. -->
<script>
    $(document).on('ready', function() {
        // INITIALIZATION OF DATERANGEPICKER
        // =======================================================
        $('.js-daterangepicker').daterangepicker();

        $('.js-daterangepicker-times').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                format: 'M/DD hh:mm A'
            }
        });

        var start = moment();
        var end = moment();

        function cb(start, end) {
            $('#js-daterangepicker-predefined .js-daterangepicker-predefined-preview').html(start.format(
                'MMM D') + ' - ' + end.format('MMM D, YYYY'));
        }

        $('#js-daterangepicker-predefined').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            }
        }, cb);

        cb(start, end);
    });


    // INITIALIZATION OF DATATABLES
    // =======================================================
    HSCore.components.HSDatatables.init($('#datatable'), {
        select: {
            style: 'multi',
            selector: 'td:first-child input[type="checkbox"]',
            classMap: {
                checkAll: '#datatableCheckAll',
                counter: '#datatableCounter',
                counterInfo: '#datatableCounterInfo'
            }
        },
        language: {
            zeroRecords: `<div class="text-center p-4">
              <img class="mb-3" src="{{ asset('assets/svg/illustrations/oc-error.svg') }}" alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="default">
              <img class="mb-3" src="{{ asset('assets/svg/illustrations-light/oc-error.svg') }}" alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="dark">
            <p class="mb-0">No data to show</p>
            </div>`
        }
    });

    const datatable = HSCore.components.HSDatatables.getItem(0)

    document.querySelectorAll('.js-datatable-filter').forEach(function(item) {
        item.addEventListener('change', function(e) {
            const elVal = e.target.value,
                targetColumnIndex = e.target.getAttribute('data-target-column-index'),
                targetTable = e.target.getAttribute('data-target-table');

            HSCore.components.HSDatatables.getItem(targetTable).column(targetColumnIndex).search(
                elVal !== 'null' ? elVal : '').draw()
        })
    })
</script>

<!-- JS Plugins Init. -->
<script>
    (function() {
        localStorage.removeItem('hs_theme')

        window.onload = function() {


            // INITIALIZATION OF NAVBAR VERTICAL ASIDE
            // =======================================================
            new HSSideNav('.js-navbar-vertical-aside').init()


            // INITIALIZATION OF FORM SEARCH
            // =======================================================
            const HSFormSearchInstance = new HSFormSearch('.js-form-search')

            if (HSFormSearchInstance.collection.length) {
                HSFormSearchInstance.getItem(1).on('close', function(el) {
                    el.classList.remove('top-0')
                })

                document.querySelector('.js-form-search-mobile-toggle').addEventListener('click', e => {
                    let dataOptions = JSON.parse(e.currentTarget.getAttribute(
                            'data-hs-form-search-options')),
                        $menu = document.querySelector(dataOptions.dropMenuElement)

                    $menu.classList.add('top-0')
                    $menu.style.left = 0
                })
            }


            // INITIALIZATION OF BOOTSTRAP DROPDOWN
            // =======================================================
            HSBsDropdown.init()

            // INITIALIZATION OF STEP FORM
            // =======================================================
            new HSStepForm('.js-step-form', {
                finish: () => {
                    document.getElementById("addUserStepFormProgress").style.display = 'none'
                    document.getElementById("addUserStepProfile").style.display = 'none'
                    document.getElementById("addUserStepBillingAddress").style.display = 'none'
                    document.getElementById("addUserStepConfirmation").style.display = 'none'
                    document.getElementById("successMessageContent").style.display = 'block'
                    scrollToTop('#header');
                    const formContainer = document.getElementById('formContainer')
                },
                onNextStep: function() {
                    scrollToTop()
                },
                onPrevStep: function() {
                    scrollToTop()
                }
            })

            function scrollToTop(el = '.js-step-form') {
                el = document.querySelector(el)
                window.scrollTo({
                    top: (el.getBoundingClientRect().top + window.scrollY) - 30,
                    left: 0,
                    behavior: 'smooth'
                })
            }


            // INITIALIZATION OF CHARTJS
            // =======================================================
            HSCore.components.HSChartJS.init('.js-chart')


            // INITIALIZATION OF CHARTJS
            // =======================================================
            // HSCore.components.HSChartJS.init('#updatingBarChart')
            // const updatingBarChart = HSCore.components.HSChartJS.getItem('updatingBarChart')

            // Call when tab is clicked
            document.querySelectorAll('[data-bs-toggle="chart-bar"]').forEach(item => {
                item.addEventListener('click', e => {
                    let keyDataset = e.currentTarget.getAttribute('data-datasets')

                    const styles = HSCore.components.HSChartJS.getTheme('updatingBarChart',
                        HSThemeAppearance.getAppearance())

                    if (keyDataset === 'lastWeek') {
                        updatingBarChart.data.labels = ["Apr 22", "Apr 23", "Apr 24", "Apr 25",
                            "Apr 26", "Apr 27", "Apr 28", "Apr 29", "Apr 30", "Apr 31"
                        ];
                        updatingBarChart.data.datasets = [{
                                "data": [120, 250, 300, 200, 300, 290, 350, 100, 125, 320],
                                "backgroundColor": styles.data.datasets[0].backgroundColor,
                                "hoverBackgroundColor": styles.data.datasets[0]
                                    .hoverBackgroundColor,
                                "borderColor": styles.data.datasets[0].borderColor,
                                "maxBarThickness": 10
                            },
                            {
                                "data": [250, 130, 322, 144, 129, 300, 260, 120, 260, 245,
                                    110
                                ],
                                "backgroundColor": styles.data.datasets[1].backgroundColor,
                                "borderColor": styles.data.datasets[1].borderColor,
                                "maxBarThickness": 10
                            }
                        ];
                        updatingBarChart.update();
                    } else {
                        updatingBarChart.data.labels = ["May 1", "May 2", "May 3", "May 4",
                            "May 5", "May 6", "May 7", "May 8", "May 9", "May 10"
                        ];
                        updatingBarChart.data.datasets = [{
                                "data": [200, 300, 290, 350, 150, 350, 300, 100, 125, 220],
                                "backgroundColor": styles.data.datasets[0].backgroundColor,
                                "hoverBackgroundColor": styles.data.datasets[0]
                                    .hoverBackgroundColor,
                                "borderColor": styles.data.datasets[0].borderColor,
                                "maxBarThickness": 10
                            },
                            {
                                "data": [150, 230, 382, 204, 169, 290, 300, 100, 300, 225,
                                    120
                                ],
                                "backgroundColor": styles.data.datasets[1].backgroundColor,
                                "borderColor": styles.data.datasets[1].borderColor,
                                "maxBarThickness": 10
                            }
                        ]
                        updatingBarChart.update();
                    }
                })
            })


            // INITIALIZATION OF CHARTJS
            // =======================================================
            // HSCore.components.HSChartJS.init('.js-chart-datalabels', {
            //     plugins: [ChartDataLabels],
            //     options: {
            //         plugins: {
            //             datalabels: {
            //                 anchor: function(context) {
            //                     var value = context.dataset.data[context.dataIndex];
            //                     return value.r < 20 ? 'end' : 'center';
            //                 },
            //                 align: function(context) {
            //                     var value = context.dataset.data[context.dataIndex];
            //                     return value.r < 20 ? 'end' : 'center';
            //                 },
            //                 color: function(context) {
            //                     var value = context.dataset.data[context.dataIndex];
            //                     return value.r < 20 ? context.dataset.backgroundColor : context
            //                         .dataset.color;
            //                 },
            //                 font: function(context) {
            //                     var value = context.dataset.data[context.dataIndex],
            //                         fontSize = 25;

            //                     if (value.r > 50) {
            //                         fontSize = 35;
            //                     }

            //                     if (value.r > 70) {
            //                         fontSize = 55;
            //                     }

            //                     return {
            //                         weight: 'lighter',
            //                         size: fontSize
            //                     };
            //                 },
            //                 formatter: function(value) {
            //                     return value.r
            //                 },
            //                 offset: 2,
            //                 padding: 0
            //             }
            //         },
            //     }
            // })

            // INITIALIZATION OF SELECT
            // =======================================================
            HSCore.components.HSTomSelect.init('.js-select')


            // INITIALIZATION OF CLIPBOARD
            // =======================================================
            HSCore.components.HSClipboard.init('.js-clipboard')

            new HSFileAttach('.js-file-attach')

               // INITIALIZATION OF INPUT MASK
            // =======================================================
            HSCore.components.HSMask.init('.js-input-mask')

        }
    })()
</script>
<script>
    (function() {
        // INITIALIZATION OF CHARTJS
        // =======================================================
        document.querySelectorAll('.js-chart').forEach(item => {
            HSCore.components.HSChartJS.init(item)
        })
    })();
</script>
<!-- Style Switcher JS -->

<!-- Style Switcher JS -->

<script>
    (function() {
        // STYLE SWITCHER
        // =======================================================
        const $dropdownBtn = document.getElementById('selectThemeDropdown') // Dropdowon trigger
        const $variants = document.querySelectorAll(
            `[aria-labelledby="selectThemeDropdown"] [data-icon]`) // All items of the dropdown

        // Function to set active style in the dorpdown menu and set icon for dropdown trigger
        const setActiveStyle = function() {
            $variants.forEach($item => {
                if ($item.getAttribute('data-value') === HSThemeAppearance.getOriginalAppearance()) {
                    $dropdownBtn.innerHTML = `<i class="${$item.getAttribute('data-icon')}" />`
                    return $item.classList.add('active')
                }

                $item.classList.remove('active')
            })
        }

        // Add a click event to all items of the dropdown to set the style
        $variants.forEach(function($item) {
            $item.addEventListener('click', function() {
                HSThemeAppearance.setAppearance($item.getAttribute('data-value'))
            })
        })

        // Call the setActiveStyle on load page
        setActiveStyle()

        // Add event listener on change style to call the setActiveStyle function
        window.addEventListener('on-hs-appearance-change', function() {
            setActiveStyle()
        })
    })()
</script>
@if (auth()->check())
    @if (auth()->user()->dark_mode === 1)
        <script>
            HSThemeAppearance.setAppearance('dark');
        </script>
    @elseif(is_null(auth()->user()->dark_mode))
        <script>
            HSThemeAppearance.setAppearance('default');
        </script>
    @endif
@endif

<!-- End Style Switcher JS -->
{{-- sript for table colour change on switch to show original  --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get references to the elements
        const showOriginalSwitch = document.getElementById("showAllOriginalAudios");
        const dataTable = document.getElementById("datatable");

        // Add event listener to the switch
        showOriginalSwitch.addEventListener("change", function() {
            if (this.checked) {
                dataTable.classList.add("show-original");
            } else {
                dataTable.classList.remove("show-original");
            }
        });
    });
</script>
</body>

</html>
