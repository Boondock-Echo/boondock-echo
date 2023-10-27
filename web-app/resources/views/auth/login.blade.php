<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>Log In | Boondock Echo</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/front/MiniLogo.svg') }}">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/font/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/tom-select/dist/css/tom-select.bootstrap5.css') }}">

    <!-- CSS Front Template -->

    <link rel="preload" href="{{ asset('assets/css/theme.min.css') }}" data-hs-appearance="default" as="style">
    <link rel="preload" href="{{ asset('assets/css/theme-dark.min.css') }}" data-hs-appearance="dark" as="style">

    <style data-hs-appearance-onload-styles>
        * {
            transition: unset !important;
        }

        body {
            opacity: 0;
        }
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

<body class="d-flex align-items-center min-h-100">

    <script src="{{ asset('assets/js/hs.theme-appearance.js') }}"></script>

    <!-- ========== HEADER ========== -->
    <header class="position-absolute top-0 start-0 end-0 mt-3 mx-3">
        <div class="d-flex d-lg-none justify-content-between">
            <a href="{{ route('inbox') }}">
                <img class="w-100" src="{{ asset('assets/img/front/logo-name.png') }}" alt="Image Description"
                    data-hs-theme-appearance="default" style="min-width: 7rem; max-width: 7rem;">
                <img class="w-100" src="{{ asset('assets/img/front/logo-name.png') }}" alt="Image Description"
                    data-hs-theme-appearance="dark" style="min-width: 7rem; max-width: 7rem;">
            </a>

        </div>
    </header>
    <!-- ========== END HEADER ========== -->

    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="main pt-0">
        <!-- Content -->
        <div class="container-fluid px-3">
            <div class="row">
                <div
                    class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center min-vh-lg-100 position-relative bg-light px-0">
                    <!-- Logo & Language -->
                    <div class="position-absolute top-0 start-0 end-0 mt-3 mx-3">
                        <div class="d-none d-lg-flex justify-content-between">
                            <a href="{{ route('inbox') }}">
                                {{-- <img class="w-100" src="{{asset('assets/img/front/logo-name.png')}}" alt="Image Description"
                    data-hs-theme-appearance="default" style="min-width: 7rem; max-width: 7rem;"> --}}
                                <img class="w-100" src="{{ asset('assets/img/front/logo-name.png') }}"
                                    alt="Image Description" data-hs-theme-appearance="dark"
                                    style="min-width: 7rem; max-width: 7rem;">
                            </a>


                        </div>
                    </div>
                    <!-- End Logo & Language -->

                    <div style="max-width: 23rem;">
                        <div class="text-center mb-5">
                            <img class="img-fluid" src="{{ asset('assets/img/front/boondock-logo.png') }}"
                                alt="Image Description" style="width: 24rem;" data-hs-theme-appearance="default">
                            <img class="img-fluid" src="{{ asset('assets/img/front/boondock-logo.png') }}"
                                alt="Image Description" style="width: 12rem;" data-hs-theme-appearance="dark">
                        </div>

                        

                        <div class="mb-5">
                            <h2 class="display-5">Welcome to Boondock Echo!</h2>
                        </div>

                        <!-- List Checked -->
                        <ul class="list-checked list-checked-lg list-checked-primary list-py-2">
                            <li class="list-checked-item">
                                <span class="d-block fw-semibold mb-1">All-in-one tool</span>
                                Comminicate, Record, and Share your recordings - end to end User
                            </li>

                            <li class="list-checked-item">
                                <span class="d-block fw-semibold mb-1">Easily add &amp; manage your radio
                                    recordings</span>
                                It brings together your tasks, projects, timelines, files and more
                            </li>
                        </ul>

                    </div>
                </div>
                <!-- End Col -->

                <div class="col-lg-6 d-flex justify-content-center align-items-center min-vh-lg-100">
                    <div class="w-100 content-space-t-4 content-space-t-lg-2 content-space-b-1"
                        style="max-width: 25rem;">
                        <!-- Form -->
                        <form method="POST" action="{{ route('login') }}" class="js-validate needs-validation"
                            novalidate>
                            @csrf
                            <div class="text-center">
                                <div class="mb-5">
                                    <h1 class="display-5">Sign in</h1>
                                    <p>Don't have an account yet? <a class="link" href="{{ route('register') }}">Sign
                                            up
                                            here</a></p>
                                </div>

                                <div class="d-grid mb-4">
                                    <a class="btn btn-white btn-lg" href="{{ route('auth.google') }}">
                                        <span class="d-flex justify-content-center align-items-center">
                                            <img class="avatar avatar-xss me-2"
                                                src="{{ asset('assets/svg/brands/google-icon.svg') }}"
                                                alt="Image Description">
                                            Sign in with Google
                                        </span>
                                    </a>
                                </div>

                                <span class="divider-center text-muted mb-4">OR</span>
                            </div>

                            <!-- Form -->
                            <div class="mb-4">
                                <label class="form-label" for="signinSrEmail">Your email</label>
                                <input id="email" type="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" tabindex="1"
                                    placeholder="email@address.com" aria-label="email@address.com" required>
                                <span class="invalid-feedback"> <strong>Please enter a valid email
                                        address.</strong></span>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- End Form -->
                            <input type="hidden" name="user_ip" id="user_ip" value="">
                            <!-- Form -->
                            <div class="mb-4">
                                <label class="form-label w-100" for="signupSrPassword" tabindex="0">
                                    <span class="d-flex justify-content-between align-items-center">
                                        <span>Password</span>
                                        {{-- <a class="form-label-link mb-0" href="{{ route('password.request') }}">Forgot
                      Password?</a> --}}
                                    </span>
                                </label>

                                <div class="input-group input-group-merge" data-hs-validation-validate-class>
                                    <input id="password" type="password"
                                        class="js-toggle-password form-control form-control-lg @error('password') is-invalid @enderror"
                                        name="password" id="signupSrPassword" placeholder="8+ characters required"
                                        aria-label="8+ characters required" required minlength="8"
                                        data-hs-toggle-password-options='{
                           "target": "#changePassTarget",
                           "defaultClass": "bi-eye-slash",
                           "showClass": "bi-eye",
                           "classChangeTarget": "#changePassIcon"
                         }'>
                                    <a id="changePassTarget" class="input-group-append input-group-text"
                                        href="javascript:;">
                                        <i id="changePassIcon" class="bi-eye"></i>
                                    </a>
                                </div>

                                <span class="invalid-feedback"><strong>Please enter a valid password.</strong></span>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <!-- End Form -->

                            <!-- Form Check -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" value="" id="termsCheckbox">
                                <label class="form-check-label" for="termsCheckbox">
                                    Remember me
                                </label>
                            </div>
                            <!-- End Form Check -->

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Sign in</button>

                            </div>
                            <div class="text-center mt-2">

                                <a class="form-label-link mb-0" href="{{ route('password.request') }}">Forgot
                                    Password?</a>
                                <span class="divider-end text-muted mt-4"></span>
                            </div>
                            <div class="d-grid mt-4">

                                <a class="btn btn-secondary btn-lg" style="color: white"
                                    href="{{ route('register') }}">
                                    Create New Account </a>

                            </div>

                        </form>

                        <!-- End Form -->
                    </div>

                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Content -->
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function getUserIP(callback) {
            $.ajax({
                url: 'https://api.ipify.org?format=json',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    callback(response.ip);
                },
                error: function(error) {
                    console.error('Failed to get user IP:', error);
                    callback(''); // Return an empty string if the IP address cannot be fetched
                }
            });
        }

        $(document).ready(function() {
            getUserIP(function(ip) {
                $('#user_ip').val(ip);
            });
        });
    </script>
    <!-- JS Global Compulsory  -->
    <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-migrate/dist/jquery-migrate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- JS Implementing Plugins -->
    <script src="{{ asset('assets/vendor/hs-toggle-password/dist/js/hs-toggle-password.js') }}"></script>
    <script src="{{ asset('assets/vendor/tom-select/dist/js/tom-select.complete.min.js') }}"></script>

    <!-- JS Front -->
    <script src="{{ asset('assets/js/theme.min.js') }}"></script>

    <!-- JS Plugins Init. -->
    <script>
        (function() {
            window.onload = function() {
                // INITIALIZATION OF BOOTSTRAP VALIDATION
                // =======================================================
                HSBsValidation.init('.js-validate', {
                    onSubmit: data => {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $('#submit').html('Please Wait...');
                        $("#submit").attr("disabled", true);
                        $.ajax({
                            url: "{{ route('inbox') }}",
                            type: "POST",
                            data: $('#form1').serialize(),
                            success: function(response) {
                                $('#submit').html('Submit');
                                $("#submit").attr("disabled", false);
                                alert('Ajax form has been submitted successfully');
                                document.getElementById("form1").reset();
                            }
                        })
                    }

                })


                // INITIALIZATION OF TOGGLE PASSWORD
                // =======================================================
                new HSTogglePassword('.js-toggle-password')


                // INITIALIZATION OF SELECT
                // =======================================================
                HSCore.components.HSTomSelect.init('.js-select')
            }
        })()
    </script>
</body>

</html>
