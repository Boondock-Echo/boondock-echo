<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title> Sign Up | Boondock Echo</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/front/MiniLogo.svg') }}">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-icons/font/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/tom-select/dist/css/tom-select.bootstrap5.css')}}">

    <!-- CSS Front Template -->

    <link rel="preload" href="{{asset('assets/css/theme.min.css')}}" data-hs-appearance="default" as="style">
    <link rel="preload" href="{{asset('assets/css/theme-dark.min.css')}}" data-hs-appearance="dark" as="style">

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

    <script src="{{asset('assets/js/hs.theme-appearance.js')}}"></script>

    <!-- ========== HEADER ========== -->
    <header class="position-absolute top-0 start-0 end-0 mt-3 mx-3">
        <div class="d-flex d-lg-none justify-content-between">
            <a href="./">
                <img class="w-100" src="{{asset('assets/img/front/logo-name.png')}}" alt="Image Description"
                    data-hs-theme-appearance="default" style="min-width: 7rem; max-width: 7rem;">
                <img class="w-100" src="{{asset('assets/svg/logos-light/logo.svg')}}" alt="Image Description"
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
                    {{-- <div class="position-absolute top-0 start-0 end-0 mt-3 mx-3">
                        <div class="d-none d-lg-flex justify-content-between">
                            <a href="./">
                                <img class="w-100" src="{{asset('assets/img/front/logo-name.png')}}" alt="Image Description"
                                    data-hs-theme-appearance="default" style="min-width: 7rem; max-width: 7rem;">
                                <img class="w-100" src="{{asset('assets/svg/logos-light/logo.svg')}}" alt="Image Description"
                                    data-hs-theme-appearance="dark" style="min-width: 7rem; max-width: 7rem;">
                            </a>


                        </div>
                    </div> --}}
                    <!-- End Logo & Language -->

                    <div style="max-width: 23rem;">
                        <div class="text-center mb-5">
                            <img class="img-fluid" src="{{asset('assets/img/front/boondock-logo.png')}}" alt="Image Description"
                                style="width: 24rem;" data-hs-theme-appearance="default">
                            <img class="img-fluid" src="{{asset('assets/svg/illustrations-light/oc-chatting.svg')}}"
                                alt="Image Description" style="width: 12rem;" data-hs-theme-appearance="dark">
                        </div>

                        <div class="mb-5">
                            <h2 class="display-5">Welcome to Boondock Echo!</h2>
                        </div>

                        <!-- List Checked -->
                        <ul class="list-checked list-checked-lg list-checked-primary list-py-2">
                            <li class="list-checked-item">
                                <span class="d-block fw-semibold mb-1">All-in-one tool</span>
                                Comminicate, Record, and Share your recordings
                            </li>

                            <li class="list-checked-item">
                                <span class="d-block fw-semibold mb-1">Easily add &amp; manage your radio
                                    recordings</span>
                                It brings together your tasks, projects, timelines, files and more
                            </li>
                        </ul>
                        <!-- End List Checked -->


                        <!-- End Row -->
                    </div>
                </div>
                <!-- End Col -->

                <div class="col-lg-6 d-flex justify-content-center align-items-center min-vh-lg-100">
                    <div class="w-100 content-space-t-4 content-space-t-lg-2 content-space-b-1"
                        style="max-width: 25rem;">
                        <!-- Form -->
                        <form method="POST" action="{{ route('register') }}" class="js-validate needs-validation"
                            novalidate>
                            @csrf
                            <div class="text-center">
                                <div class="mb-5">
                                    <h1 class="display-5">Create your account</h1>
                                    {{-- <p>Already have an account? <a class="link" href="{{route('login')}}">Sign in here</a></p> --}}
                                </div>


                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="signupSrEmail">Your email</label>
                                <input id="email" type="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    name="email" placeholder="Markwilliams@site.com" value="{{ old('email') }}"
                                    aria-label="Markwilliams@site.com" required>
                                <span class="invalid-feedback">Please enter a valid email address.</span>

                                {{-- @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror --}}
                            </div>
                            @error('email')
                                <div>
                                    <div class="mb-5 mt-4">

                                        <p>You Already have an account <a class="link" href="{{ route('login') }}">Sign in
                                                here</a></p>
                                        <p>Reset Your Password ? <a class="link"
                                                href="{{ route('password.request') }}">Reset My Password</a></p>
                                    </div>

                                </div>
                            @enderror
                            <label class="form-label" for="fullNameSrEmail">Full name</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- Form -->
                                    <div class="mb-4">
                                        <input id="name" type="text"
                                            class="form-control form-control-lg @error('name') is-invalid @enderror"
                                            name="name" placeholder="Mark" value="{{ old('name') }}"
                                            aria-label="Mark" required>
                                        <span class="invalid-feedback">Please enter your first name.</span>
                                        {{-- @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror --}}
                                    </div>
                                    <!-- End Form -->
                                </div>

                                <div class="col-sm-6">
                                    <!-- Form -->
                                    <div class="mb-4">
                                        <input id="last_name" type="text" class="form-control form-control-lg"
                                            name="last_name" placeholder="Williams" value="{{ old('last_name') }}"
                                            aria-label="Williams" required>
                                        <span class="invalid-feedback">Please enter your last name.</span>
                                    </div>
                                    <!-- End Form -->
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                  <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                  <div class="col-md-6">
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div> --}}

                            {{-- <div class="row mb-3">
                  <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                  <div class="col-md-6">
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div> --}}
                            <div class="mb-4">
                                <label class="form-label" for="password">Password</label>

                                <div class="input-group input-group-merge" data-hs-validation-validate-class>
                                    <input id="password" type="password"
                                        class="js-toggle-password form-control form-control-lg  @error('password') is-invalid @enderror"
                                        name="password" id="signupSrPassword" placeholder="8+ characters required"
                                        aria-label="8+ characters required" required minlength="8"
                                        data-hs-toggle-password-options='{
                           "target": [".js-toggle-password-target-1", ".js-toggle-password-target-2"],
                           "defaultClass": "bi-eye-slash",
                           "showClass": "bi-eye",
                           "classChangeTarget": ".js-toggle-password-show-icon-1"
                         }'>
                                    <a class="js-toggle-password-target-1 input-group-append input-group-text"
                                        href="javascript:;">
                                        <i class="js-toggle-password-show-icon-1 bi-eye"></i>
                                    </a>
                                </div>

                                <span class="invalid-feedback">Your password is invalid. Please try again.</span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- <div class="row mb-3">
                  <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                  <div class="col-md-6">
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div> --}}

                            <div class="mb-4">
                                <label class="form-label" for="password-confirm">Confirm password</label>

                                <div class="input-group input-group-merge" data-hs-validation-validate-class>
                                    <input id="password-confirm" type="password"
                                        class="js-toggle-password form-control form-control-lg"
                                        name="password_confirmation" placeholder="8+ characters required"
                                        aria-label="8+ characters required" required minlength="8"
                                        data-hs-toggle-password-options='{
                           "target": [".js-toggle-password-target-1", ".js-toggle-password-target-2"],
                           "defaultClass": "bi-eye-slash",
                           "showClass": "bi-eye",
                           "classChangeTarget": ".js-toggle-password-show-icon-2"
                         }'>
                                    <a class="js-toggle-password-target-2 input-group-append input-group-text"
                                        href="javascript:;">
                                        <i class="js-toggle-password-show-icon-2 bi-eye"></i>
                                    </a>
                                </div>

                                <span class="invalid-feedback">Password does not match the confirm password.</span>
                            </div>

                            {{-- <div class="row mb-3">
                  <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                  <div class="col-md-6">
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                  </div>
              </div> --}}
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" value="" id="termsCheckbox"
                                    required>
                                <label class="form-check-label" for="termsCheckbox">
                                    I accept the <a href="#">Terms and Conditions</a>
                                </label>
                                <span class="invalid-feedback">Please accept our Terms and Conditions.</span>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Create an account</button>

                                {{-- <button type="submit" class="btn btn-link">
                  or Start your 30-day trial <i class="bu-chevron-right"></i>
                </button> --}}
                            </div>
                            <div class="text-center">
                                <div class="mb-5 mt-4">

                                    <p>Already have an account? <a class="link" href="{{ route('login') }}">Sign in
                                            here</a></p>
                                </div>

                                <span class="divider-center text-muted mb-4">OR</span>

                                <div class="d-grid mb-4">
                                    <a class="btn btn-white btn-lg" href="{{ route('auth.google') }}">
                                        <span class="d-flex justify-content-center align-items-center">
                                            <img class="avatar avatar-xss me-2"
                                                src="{{asset('assets/svg/brands/google-icon.svg')}}" alt="Image Description">
                                            Sign up with Google
                                        </span>
                                    </a>
                                </div>


                            </div>

                            {{-- <div class="row mb-0">
                  <div class="col-md-6 offset-md-4">
                      <button type="submit" class="btn btn-primary">
                          {{ __('Register') }}
                      </button>
                  </div>
              </div> --}}
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

    <!-- JS Global Compulsory  -->
    <script src="{{asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery-migrate/dist/jquery-migrate.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

    <!-- JS Implementing Plugins -->
    <script src="{{asset('assets/vendor/hs-toggle-password/dist/js/hs-toggle-password.js')}}"></script>
    <script src="{{asset('assets/vendor/tom-select/dist/js/tom-select.complete.min.js')}}"></script>

    <!-- JS Front -->
    <script src="{{asset('assets/js/theme.min.js')}}"></script>

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
