@extends('layouts.app2')


@section('content')
    <style>
        .nav-link {
            position: relative;
            color: #000;
            /* Set your default text color */
            text-decoration: none;
        }

        .nav-link:hover {
            color: #f60;
            /* Set your hover text color */
        }

        .nav-link:hover::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            /* Set the thickness of the underline */
            background-color: #f60;
            /* Set your desired underline color */

        }
    </style>


    <!-- ========== END HEADER ========== -->

    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="main">

        <!-- Hero -->
        <div class="position-relative bg-img-start "
            style="background-image: url('{{ asset('front_asset/img/svg/components/card-11.svg') }}');">
            <div class="d-lg-flex position-relative content-space-t-1" id="home">
                <div class="container d-lg-flex align-items-lg-center content-space-t-1 content-space-lg-0 min-vh-lg-100">
                    <!-- Heading -->
                    <div class="w-100">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <h4 class="display-6 mb-3">Communication at the push of a
                                        button</h4>

                                    <!-- <p class="lead"> Communication at the push of a button</p> -->

                                    <h5 class="display-6 mb-3">
                                        Stay connected,

                                        <span class="text-primary">
                                            <span class="js-typedjs"
                                                data-hs-typed-options='{
                            "strings": ["anytime.", "anywhere."],
                            "typeSpeed": 30,
                            "loop": true,
                            "backSpeed": 25,
                            "backDelay": 2000
                          }'></span>
                                        </span>
                                    </h5>

                                    <p class="lead">Transforming the two-way radio experience.</p>
                                </div>

                            </div>
                            <div class="d-grid d-md-flex gap-3 align-items-md-center">
                                <a class="btn btn-primary" href="{{ asset('https://docs.boondockecho.com/') }}"
                                    target="_blank">Get Started</a>

                                <!-- Fancybox -->
                                <a class="video-player video-player-btn"
                                    href="{{ asset('https://docs.boondockecho.com/boondock-echo/user-interface/start-guide') }}"
                                    target="_blank" role="button">
                                    <span class="video-player-icon shadow-sm me-2">
                                        <i class="bi-play-fill"></i>
                                    </span>
                                    How it works
                                </a>
                                <!-- End Fancybox -->
                            </div>
                            <!-- End Col -->
                        </div>
                        <!-- End Row -->
                    </div>
                    <!-- End Title & Description -->

                    <!-- SVG Shape -->
                    <div class="col-lg-6 col-xl-6 d-none d-lg-block position-absolute top-3 end-0 pe-0"
                        style="margin-bottom: 0rem;">

                        <style>
                            .image-container {
                                position: relative;
                                display: inline-block;
                            }

                            .image-container img {
                                transition: transform 0.5s ease-in-out;
                            }

                            .image-container img:hover {
                                transform: scale(1.2);
                            }
                        </style>

                        <div class="image-container ms-7">
                            <img src="{{ asset('front_asset/img/boondock-banner-bg-remove.png') }}" alt
                                style="margin-bottom: 0rem;   width: 500px; 
            height: auto;">
                        </div>

                    </div>

                </div>

                <!-- End SVG Shape -->
            </div>
        </div>
        </div>
        <!-- End Hero -->

        <!-- about us strat -->
        <div class="">


            <div class="w-lg-75 text-center mx-lg-auto content-space-t-1" id="about">
                <!-- Heading -->
                <div class="mb-2 mt-3">
                    <h6 class="display-6 text-navy-blue">About <span class="display-5 text-primary   mb-3">Boondock
                            Echo</span></h6>

                    <p class="lead text-navy-blue mt-7 ">We provide sophisticated and seamless
                        communication experience that revolutionizes the way you use two-way
                        radios. Boondock Echo is an internet-backed recording and playback
                        device that denoises, transcribes, translates, and more!
                    </p>
                </div>
                <!-- End Heading -->

            </div>



            <!-- new Features -->
            <div class="container content-space-b-1 ">

                <div class="row justify-content-lg-between align-items-md-center content-space-t-1 content-space-t-lg-0 pb">


                    <div class="col-md-6 col-lg-6  col-sm-12 order-md-1">
                        <div class="bg-img-center h-100 rounded-2 text-center rounded-2 d-flex justify-content-center align-items-center"
                            style="background-image: url('{{ asset('front_asset/img/boondock-logo2-crop.png') }}'); min-height: 20rem; ">

                            <div id="video-container">
                                <div id="play-icon" onclick="playVideo()">
                                    <span class="video-player-icon shadow-sm">
                                        <i class="bi-play-fill">
                                        </i>
                                    </span>
                                </div>
                                <div id="cancel-button" onclick="closeVideo()">
                                    <button type="button" class="btn btn-close btn btn-outline-primary  btn-icon "
                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <iframe id="video-iframe" width="610" height="400"
                                    src="https://www.youtube.com/embed/5CJuMuLHsgM" frameborder="0"
                                    allowfullscreen></iframe>
                            </div>

                        </div>
                        <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/5CJuMuLHsgM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> -->

                        <!-- <a class="card-link mb-5" href="#">See how to Boondock works. </a> -->

                        <style>
                            #play-icon {
                                display: block;
                                width: 50px;
                                /* Adjust the size of the icon as needed */
                                height: 50px;

                                background-image: url(./assets/img/boondock-logo2-crop.png);
                                /* Adjust the color of the icon background as needed */
                                color: #fff;
                                /* Adjust the color of the icon itself as needed */
                                cursor: pointer;
                                text-align: center;
                                line-height: 50px;
                            }

                            #cancel-button {
                                display: none;

                            }

                            #video-iframe {
                                display: none;
                            }
                        </style>
                        <script>
                            function playVideo() {
                                var icon = document.getElementById("play-icon");
                                var cancelButton = document.getElementById("cancel-button");
                                var video = document.getElementById("video-iframe");

                                icon.style.display = "none";
                                cancelButton.style.display = "block";
                                video.style.display = "block";
                            }

                            function closeVideo() {
                                var icon = document.getElementById("play-icon");
                                var cancelButton = document.getElementById("cancel-button");
                                var video = document.getElementById("video-iframe");

                                icon.style.display = "block";
                                cancelButton.style.display = "none";
                                video.style.display = "none";
                            }
                        </script>

                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-12 order-md-1 content-space-1 content-space-md-1  card-transition">

                        <h2 class=" text-primary">Our Product </h2>
                        <div class="border-top  border-black-10 my-3" style="max-width: 10rem;"></div>
                        <p class="text-black" style="font-weight: 300;">

                            We recognize the criticality of clear and dependable two-way
                            radio communications, particularly in remote locations or
                            challenging conditions. Introducing Boondock Echo, our
                            groundbreaking internet-connected record and playback device
                            meticulously crafted to meet the unique needs of two-way radios.
                            Boondock Echo ensures unmatched clarity and reliability,
                            empowering you to communicate seamlessly in any environment.
                            Experience the power of our innovative solution, designed to
                            enhance your two-way radio communications at all times.
                        </p>

                    </div>
                </div>
            </div>
            <!-- new Features end -->
            <!-- fetures we offer 6 start -->
            <div class="container ">
                <!-- Heading -->
                <div class="w-md-75 w-lg-50 text-center mx-md-auto mb-5 mb-md-9">

                    <span class="text-cap text-muted">Why choose us? </span>
                    <h6 class="display-6 text-navy-blue">Key<span class="display-5 text-primary   mb-3"> Features</span>
                    </h6>
                    <!-- <h2>Key Features</h2> -->
                </div>
                <!-- End Heading -->

                <div class="row mb-5 mb-md-9">
                    <div class="col-sm-6 col-md-4 mb-3 mb-sm-7 card card-transition shadow-none">
                        <!-- Icon Block -->
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0">
                                <i class="bi bi-mic icon-large text-primary"></i>
                            </div>

                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0 text-navy-blue">Reliable Recording</h4>
                            </div>
                        </div>
                        <!-- End Icon Block -->

                        <p class="text-black">Our device captures and stores your radio conversations in
                            real-time, ensuring accurate and reliable records.</p>
                    </div>
                    <!-- End Col -->

                    <div class="col-sm-6 col-md-4 mb-3 mb-sm-7 card card-transition shadow-none">
                        <!-- Icon Block -->
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0">
                                <i class="bi bi-bar-chart icon-large text-primary"></i>
                            </div>

                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0 text-navy-blue">Internet Connectivity</h4>
                            </div>
                        </div>
                        <!-- End Icon Block -->

                        <p class="text-black">Boondock Echo connects to the internet, enabling you to access your
                            recorded conversations remotely and securely.</p>
                    </div>
                    <!-- End Col -->

                    <div class="col-sm-6 col-md-4 mb-3 mb-sm-7 mb-md-0 card card-transition shadow-none">
                        <!-- Icon Block -->
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-plus-circle-dotted icon-large text-primary"></i>
                                </div>
                            </div>

                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0 text-navy-blue">Seamless Integration</h4>
                            </div>
                        </div>
                        <!-- End Icon Block -->

                        <p class="text-black">Boondock Echo seamlessly integrates with a wide range of two-way
                            radio models, making it compatible with your existing communication
                            systems.</p>
                    </div>
                    <!-- End Col -->

                    <div class="col-sm-6 col-md-4 mb-3 mb-sm-7 mb-md-0 card card-transition shadow-none">
                        <!-- Icon Block -->
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-file-earmark-play icon-large text-primary"></i>
                                </div>
                            </div>

                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0 text-navy-blue">Playback Flexibility</h4>
                            </div>
                        </div>
                        <!-- End Icon Block -->

                        <p class="text-black">Easily retrieve and replay recorded conversations whenever you need
                            them. This feature is invaluable for training, incident analysis, or
                            legal purposes.</p>
                    </div>
                    <!-- End Col -->

                    <div class="col-sm-6 col-md-4 mb-3 mb-sm-7 mb-md-0 card card-transition shadow-none">
                        <!-- Icon Block -->
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-box icon-large text-primary"></i>
                                </div>
                            </div>

                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0 text-navy-blue">Rugged Design</h4>
                            </div>
                        </div>
                        <!-- End Icon Block -->

                        <p class="text-black">Boondock Echo is built to withstand harsh environments and extreme
                            conditions, making it a reliable companion wherever your two-way
                            radio communications take you.</p>
                    </div>
                    <!-- End Col -->

                    <div class="col-sm-6 col-md-4 card card-transition shadow-none">
                        <!-- Icon Block -->
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-people icon-large text-primary"></i>
                                </div>
                            </div>

                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0 text-navy-blue">User-Friendly Interface</h4>
                            </div>
                        </div>
                        <!-- End Icon Block -->

                        <p class="text-black">Our device features an intuitive and user-friendly interface,
                            ensuring ease of use for both beginners and experienced radio
                            operators.</p>
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->

            </div>
            <!-- features we offer 6 end -->
        </div>
        <!-- about us end -->
        <!-- services strat -->

        <!-- services end -->
        <!--services Card Grid -->


        <div class="container content-space-1 bg-gradient " id="services">
            <!-- Heading -->
            <div class="text-center mx-md-auto mb-3 mb-md-3 sticky-heading">
                <span class="text-cap text-muted">What we offer</span>
                <h6 class="display-6 text-navy-blue">Our<span class="display-5 text-primary "> Services</span></h6>



            </div>
            <p class="lead text-navy-blue mt-7 w-lg-75 text-center mx-lg-auto mb-3">At Boondock Echo, we are dedicated
                to providing a complete, high-quality
                service experience beyond just selling our product. Our range of
                services is designed to support and
                enhance your user experience with Boondock Echo.
            </p>
            <!-- End Heading -->

            <div class="row justify-content-lg-center content-space-1">
                <div class="col-md-6 col-lg-6 mb-3 mb-md-5 mb-lg-5 ">
                    <!-- Icon Blocks -->
                    <div class="d-flex pe-md-5">
                        <div class="flex-shrink-0">
                            <div class="svg-icon text-primary">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3"
                                        d="M20.335 15.537C21.725 14.425 21.57 12.812 21.553 11.224C21.4407 9.50899 20.742 7.88483 19.574 6.624C18.5503 5.40102 17.2668 4.4216 15.817 3.757C14.4297 3.26981 12.9703 3.01966 11.5 3.01701C8.79576 2.83108 6.11997 3.66483 4 5.35398C2.289 6.72498 1.23101 9.12497 2.68601 11.089C3.22897 11.6881 3.93029 12.1214 4.709 12.339C5.44803 12.6142 6.24681 12.6888 7.024 12.555C6.88513 12.9965 6.85078 13.4644 6.92367 13.9215C6.99656 14.3786 7.17469 14.8125 7.444 15.189C7.73891 15.5299 8.10631 15.8006 8.51931 15.9812C8.93232 16.1619 9.38047 16.2478 9.831 16.233C10.0739 16.2296 10.3141 16.1807 10.539 16.089C10.7371 15.9871 10.9288 15.8732 11.113 15.748C12.1594 15.2831 13.3275 15.1668 14.445 15.416C15.7795 15.7213 17.1299 15.952 18.49 16.107C18.7927 16.1438 19.0993 16.1313 19.398 16.07C19.7445 15.9606 20.0639 15.7789 20.335 15.537V15.537Z"
                                        fill="#035A4B"></path>
                                    <path
                                        d="M19.008 16.114C18.9486 16.6061 18.7934 17.0817 18.551 17.514C18.229 18.114 17.581 18.314 17.103 18.752C16.457 19.343 16.595 20.38 16.632 21.164C16.6522 21.3437 16.621 21.5254 16.542 21.688C16.4335 21.835 16.2751 21.9373 16.0965 21.9758C15.9179 22.0143 15.7314 21.9863 15.572 21.897C15.2577 21.7083 15.0072 21.4296 14.853 21.097C14.581 20.607 14.362 20.085 14.053 19.612C13.3182 18.7548 12.4201 18.0525 11.411 17.546C10.9334 17.1942 10.5857 16.6942 10.422 16.124C10.459 16.111 10.499 16.106 10.536 16.09C10.7336 15.9879 10.925 15.8741 11.109 15.749C12.1554 15.2842 13.3234 15.1678 14.441 15.417C15.7754 15.7223 17.1259 15.953 18.486 16.108C18.6598 16.1191 18.834 16.1211 19.008 16.114V16.114ZM18.8 10.278V3C18.8 2.73478 18.6946 2.48044 18.5071 2.29291C18.3196 2.10537 18.0652 2 17.8 2C17.5348 2 17.2804 2.10537 17.0929 2.29291C16.9053 2.48044 16.8 2.73478 16.8 3V10.278C16.4187 10.4981 16.1207 10.8379 15.9522 11.2447C15.7838 11.6514 15.7542 12.1024 15.8681 12.5277C15.9821 12.953 16.2332 13.3287 16.5825 13.5967C16.9318 13.8648 17.3597 14.0101 17.8 14.0101C18.2403 14.0101 18.6682 13.8648 19.0175 13.5967C19.3668 13.3287 19.6179 12.953 19.7318 12.5277C19.8458 12.1024 19.8162 11.6514 19.6477 11.2447C19.4793 10.8379 19.1813 10.4981 18.8 10.278V10.278ZM13.8 2C13.5348 2 13.2804 2.10537 13.0929 2.29291C12.9053 2.48044 12.8 2.73478 12.8 3V8.586L12.312 9.07397C11.8792 8.95363 11.4188 8.98004 11.0026 9.14899C10.5864 9.31794 10.2379 9.61994 10.0115 10.0079C9.78508 10.3958 9.69351 10.8478 9.75109 11.2933C9.80867 11.7387 10.0122 12.1526 10.3298 12.4702C10.6474 12.7878 11.0612 12.9913 11.5067 13.0489C11.9522 13.1065 12.4042 13.0149 12.7921 12.7885C13.18 12.5621 13.4821 12.2136 13.651 11.7974C13.82 11.3812 13.8463 10.9207 13.726 10.488L14.507 9.70697C14.6945 9.51948 14.7999 9.26519 14.8 9V3C14.8 2.73478 14.6946 2.48044 14.5071 2.29291C14.3196 2.10537 14.0652 2 13.8 2ZM9.79999 2C9.53478 2 9.28042 2.10537 9.09289 2.29291C8.90535 2.48044 8.79999 2.73478 8.79999 3V4.586L7.31199 6.07397C6.87924 5.95363 6.41882 5.98004 6.00263 6.14899C5.58644 6.31794 5.23792 6.61994 5.0115 7.00787C4.78508 7.39581 4.69351 7.84781 4.75109 8.29327C4.80867 8.73874 5.01216 9.1526 5.32977 9.47021C5.64739 9.78783 6.06124 9.99131 6.50671 10.0489C6.95218 10.1065 7.40417 10.0149 7.7921 9.78851C8.18004 9.56209 8.48207 9.21355 8.65102 8.79736C8.81997 8.38117 8.84634 7.92073 8.726 7.48798L10.507 5.70697C10.6945 5.51948 10.7999 5.26519 10.8 5V3C10.8 2.73478 10.6946 2.48044 10.5071 2.29291C10.3196 2.10537 10.0652 2 9.79999 2Z"
                                        fill="#035A4B"></path>
                                </svg>

                            </div>
                        </div>

                        <div class="flex-grow-1 ms-3">
                            <h3 class="text-navy-blue">Product Training</h3>

                            <p class="text-black "> Our experts guide you through all the
                                functionalities of our device, ensuring
                                you can use it to
                                its full potential. Whether you are a beginner or an
                                experienced two-way radio user, our training
                                sessions will empower you with the knowledge to efficiently
                                operate your Boondock Echo.</p>
                        </div>
                    </div>
                    <!-- End Icon Blocks -->
                </div>

                <div class="col-md-6 col-lg-6 mb-3 mb-md-5 mb-lg-5">
                    <!-- Icon Blocks -->
                    <div class="d-flex ps-md-5">
                        <div class="flex-shrink-0">
                            <div class="svg-icon text-primary">

                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3"
                                        d="M22.0318 8.59998C22.0318 10.4 21.4318 12.2 20.0318 13.5C18.4318 15.1 16.3318 15.7 14.2318 15.4C13.3318 15.3 12.3318 15.6 11.7318 16.3L6.93177 21.1C5.73177 22.3 3.83179 22.2 2.73179 21C1.63179 19.8 1.83177 18 2.93177 16.9L7.53178 12.3C8.23178 11.6 8.53177 10.7 8.43177 9.80005C8.13177 7.80005 8.73176 5.6 10.3318 4C11.7318 2.6 13.5318 2 15.2318 2C16.1318 2 16.6318 3.20005 15.9318 3.80005L13.0318 6.70007C12.5318 7.20007 12.4318 7.9 12.7318 8.5C13.3318 9.7 14.2318 10.6001 15.4318 11.2001C16.0318 11.5001 16.7318 11.3 17.2318 10.9L20.1318 8C20.8318 7.2 22.0318 7.59998 22.0318 8.59998Z"
                                        fill="#035A4B"></path>
                                    <path
                                        d="M4.23179 19.7C3.83179 19.3 3.83179 18.7 4.23179 18.3L9.73179 12.8C10.1318 12.4 10.7318 12.4 11.1318 12.8C11.5318 13.2 11.5318 13.8 11.1318 14.2L5.63179 19.7C5.23179 20.1 4.53179 20.1 4.23179 19.7Z"
                                        fill="#035A4B"></path>
                                </svg>

                            </div>
                        </div>

                        <div class="flex-grow-1 ms-3">
                            <h4 class="text-navy-blue">Hardware Maintenance and Repair</h4>
                            <p class="text-black">We understand the importance of a
                                reliable and durable device for two-way radio
                                communication.
                                Therefore, we offer maintenance services to keep your
                                Boondock Echo in optimal condition. And if any
                                repair is needed, our highly skilled technicians are ready
                                to restore your device's functionality
                                with minimal downtime.</p>
                        </div>
                    </div>
                    <!-- End Icon Blocks -->
                </div>

                <div class="w-100"></div>

                <div class="col-md-6 col-lg-6 mb-3 mb-md-5 mb-lg-5">
                    <!-- Icon Blocks -->
                    <div class="d-flex pe-md-5">
                        <div class="flex-shrink-0">
                            <div class="svg-icon text-primary">

                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3" d="M5 8.04999L11.8 11.95V19.85L5 15.85V8.04999Z" fill="#035A4B">
                                    </path>
                                    <path
                                        d="M20.1 6.65L12.3 2.15C12 1.95 11.6 1.95 11.3 2.15L3.5 6.65C3.2 6.85 3 7.15 3 7.45V16.45C3 16.75 3.2 17.15 3.5 17.25L11.3 21.75C11.5 21.85 11.6 21.85 11.8 21.85C12 21.85 12.1 21.85 12.3 21.75L20.1 17.25C20.4 17.05 20.6 16.75 20.6 16.45V7.45C20.6 7.15 20.4 6.75 20.1 6.65ZM5 15.85V7.95L11.8 4.05L18.6 7.95L11.8 11.95V19.85L5 15.85Z"
                                        fill="#035A4B"></path>
                                </svg>

                            </div>
                        </div>

                        <div class="flex-grow-1 ms-3">
                            <h4 class="text-navy-blue">Customization Services</h4>
                            <p class="text-black">We recognize that every user has unique
                                requirements. That's why we offer
                                customization services
                                for large orders. Our team works closely with you to
                                understand your specific needs and design a
                                customized solution that best fits your application.
                            </p>
                        </div>
                    </div>
                    <!-- End Icon Blocks -->
                </div>

                <div class="col-md-6 col-lg-6 mb-3 mb-md-5 mb-lg-5">
                    <!-- Icon Blocks -->
                    <div class="d-flex ps-md-5">
                        <div class="flex-shrink-0">
                            <div class="svg-icon text-primary">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3"
                                        d="M20.9 12.9C20.3 12.9 19.9 12.5 19.9 11.9C19.9 11.3 20.3 10.9 20.9 10.9H21.8C21.3 6.2 17.6 2.4 12.9 2V2.9C12.9 3.5 12.5 3.9 11.9 3.9C11.3 3.9 10.9 3.5 10.9 2.9V2C6.19999 2.5 2.4 6.2 2 10.9H2.89999C3.49999 10.9 3.89999 11.3 3.89999 11.9C3.89999 12.5 3.49999 12.9 2.89999 12.9H2C2.5 17.6 6.19999 21.4 10.9 21.8V20.9C10.9 20.3 11.3 19.9 11.9 19.9C12.5 19.9 12.9 20.3 12.9 20.9V21.8C17.6 21.3 21.4 17.6 21.8 12.9H20.9Z"
                                        fill="#035A4B"></path>
                                    <path
                                        d="M16.9 10.9H13.6C13.4 10.6 13.2 10.4 12.9 10.2V5.90002C12.9 5.30002 12.5 4.90002 11.9 4.90002C11.3 4.90002 10.9 5.30002 10.9 5.90002V10.2C10.6 10.4 10.4 10.6 10.2 10.9H9.89999C9.29999 10.9 8.89999 11.3 8.89999 11.9C8.89999 12.5 9.29999 12.9 9.89999 12.9H10.2C10.4 13.2 10.6 13.4 10.9 13.6V13.9C10.9 14.5 11.3 14.9 11.9 14.9C12.5 14.9 12.9 14.5 12.9 13.9V13.6C13.2 13.4 13.4 13.2 13.6 12.9H16.9C17.5 12.9 17.9 12.5 17.9 11.9C17.9 11.3 17.5 10.9 16.9 10.9Z"
                                        fill="#035A4B"></path>
                                </svg>

                            </div>
                        </div>

                        <div class="flex-grow-1 ms-3">
                            <h4 class="text-navy-blue">Firmware Updates </h4>
                            <p class="text-black">At Boondock Echo, we are constantly
                                working on improving our device's
                                performance and
                                functionality. As part of this commitment, we offer regular
                                firmware updates to ensure your device
                                benefits from the latest technological advancements and
                                operates at peak performance.</p>
                        </div>
                    </div>
                    <!-- End Icon Blocks -->
                </div>

                <div class="w-100"></div>
            </div>
        </div>

        <!--services End Card Grid -->


        <!-- Team -->
        <div id="team"></div>
        <div class=" bg-dark rounded-2 mx-2 mx-xl-10 content-space-2 content-space-lg-2  "
            style="background-image: url('{{ asset('assets/svg/components/wave-pattern-light.svg') }}');">

            <!-- Heading -->
            <div class="w-md-75 w-lg-50 text-center mx-md-auto mb-2 mb-md-9 mb-sm-4">
                <span class="text-cap text-muted">Our team</span>
                <h6 class="display-6 text-white">Our<span class="display-5 text-primary   mb-1"> Creative Minds</span>
                </h6>

            </div>
            <!-- End Heading -->

            <!-- Team -->
            <div class="container content-space-0">


                <div class="row gx-3 mb-5 w-md-75 w-lg-100 mx-md-auto mb-5 mb-md-9 mt-sm">
                    <div class="col-sm-12 col-lg-4 mb-3 ">
                        <!-- Card -->
                        <div class="card card-transition h-100" data-bs-toggle="modal"
                            data-bs-target=".bd-example-modal-sm-mark">
                            <div class="card-body">
                                <div class="d-flex avatar avatar-xl  mb-4">
                                    <img class="avatar-img" src="{{ asset('front_asset/img/Mark_avatar.png') }}"
                                        alt="Image Description">
                                </div>
                                <!-- <p class=" lead text-navy-blue">Kaushlesh Chandel -<span
                      class="lead  text-primary  mb-1 "> The Firmware Maestro</span></p> -->
                                <span class="card-subtitle text-primary">The Visionary</span>
                                <h4 class="card-title text-navy-blue">Mark Hughes</h4>
                                <!-- <h5 class="card-title text-black">Mark Hughes</h5>
                      <h3 class="card-text lead text-primary">The Visionary</h3> -->

                                <p class="card-text text-navy-blue">Mark Hughes, the brain behind Boondock Echo, has always
                                    been fascinated with communication technology and its end<a href="mySmallModalLabelkc"
                                        data-bs-toggle="modal" data-bs-target=".bd-example-modal-sm-mark"
                                        class="text-muted"> ...read more</a></p>

                            </div>

                            <div class="card-footer pt-0">

                                <!-- Socials -->
                                <!-- <ul class="list-inline mb-0">
                      <li class="list-inline-item">
                        <a class="btn btn-outline-primary btn-xs btn-icon rounded" href="#">
                          <i class="bi-facebook"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="btn btn-outline-primary btn-xs btn-icon rounded" href="#">
                          <i class="bi-google"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="btn btn-outline-primary btn-xs btn-icon rounded" href="#">
                          <i class="bi-twitter"></i>
                        </a>
                      </li>
                    </ul> -->
                                <!-- End Socials -->
                            </div>
                        </div>

                        <!-- End Card -->
                        <!-- Modal -->
                        <div class="modal modal-lg fade bd-example-modal-sm-mark content-space-4" tabindex="-1"
                            role="dialog" aria-labelledby="mySmallModalLabelkc" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="d-flex avatar avatar-circle mx-2">
                                            <img class="avatar-img" src="{{ asset('front_asset/img/Mark_avatar.png') }}"
                                                alt="Image Description">
                                        </div>
                                        <h5 class="modal-title lead h4 text-navy-blue" id="mySmallModalLabelkc">Mark
                                            Hughes -</h5>
                                        <h5 class="modal-title lead h4 text-primary" id="mySmallModalLabelkc">The
                                            Visionary</h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <span class="divider-end mt-2"></span>
                                    <div class="modal-body text-navy-blue">Mark Hughes, the brain behind Boondock Echo, has
                                        always been fascinated with communication technology and its endless possibilities.
                                        With a strong background in electronics engineering and a passion for the outdoors,
                                        Mark saw a gap in the two-way radio market. His vision for a device that could not
                                        just communicate but also record and playback radio messages led to the creation of
                                        Boondock Echo. Mark believes in pushing the boundaries of technology to better serve
                                        the needs of our society, and his dream of redefining two-way radio communication
                                        fuels our company.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                    </div>
                    <!-- End Col mark -->

                    <div class="col-sm-12 col-lg-4 mb-3 ">
                        <!-- Card -->
                        <div class="card card-transition h-100" data-bs-toggle="modal"
                            data-bs-target=".bd-example-modal-sm-kc">
                            <div class="card-body">
                                <div class="d-flex avatar avatar-xl  mb-4">
                                    <img class="avatar-img" src="{{ asset('front_asset/img/EC_avatar.new.jpg') }}"
                                        alt="Image Description">
                                </div>
                                <!-- <p class=" lead text-navy-blue">Kaushlesh Chandel -<span
                      class="lead  text-primary  mb-1 "> The Firmware Maestro</span></p> -->
                                <span class="card-subtitle text-primary">The Firmware Maestro</span>
                                <h4 class="card-title text-navy-blue">Emelia Chandel</h4>
                                <!-- <h5 class="card-title text-black">Mark Hughes</h5>
                      <h3 class="card-text lead text-primary">The Visionary</h3> -->

                                <p class="card-text text-navy-blue">Emelia Chandel, the maestro of our firmware team, is
                                    responsible for the brain every Boondock Echo. With a strong background <a
                                        href="mySmallModalLabelkc" data-bs-toggle="modal"
                                        data-bs-target=".bd-example-modal-sm-kc" class="text-muted"> ...read more</a></p>

                            </div>

                            <div class="card-footer pt-0">

                                <!-- Socials -->
                                <!-- <ul class="list-inline mb-0">
                      <li class="list-inline-item">
                        <a class="btn btn-outline-primary btn-xs btn-icon rounded" href="#">
                          <i class="bi-facebook"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="btn btn-outline-primary btn-xs btn-icon rounded" href="#">
                          <i class="bi-google"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="btn btn-outline-primary btn-xs btn-icon rounded" href="#">
                          <i class="bi-twitter"></i>
                        </a>
                      </li>
                    </ul> -->
                                <!-- End Socials -->
                            </div>
                        </div>

                        <!-- End Card -->
                        <!-- Modal -->
                        <div class="modal modal-lg fade bd-example-modal-sm-kc content-space-4" tabindex="-1"
                            role="dialog" aria-labelledby="mySmallModalLabelkc" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="d-flex avatar avatar-circle ">
                                            <img class="avatar-img" src="{{ asset('front_asset/img/EC_avatar.new.jpg') }}"
                                                alt="Image Description">
                                        </div>
                                        <h5 class="modal-title lead h4 text-navy-blue" id="mySmallModalLabelkc">Emelia
                                            Chandel -</h5>
                                        <h5 class="modal-title lead h4 text-primary" id="mySmallModalLabelkc">The Firmware
                                            Maestro</h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <span class="divider-end mt-2"></span>
                                    <div class="modal-body text-navy-blue">Emelia Chandel, the maestro of our firmware
                                        team, is responsible for the brain inside every Boondock Echo. With a strong
                                        background in computer engineering and an innate ability to solve complex problems,
                                        Emelia ensures our device not only meets but exceeds the high standards of
                                        functionality and reliability we set. Her deep understanding of firmware intricacies
                                        and relentless dedication make her the pillar of our technical team, ensuring that
                                        our devices deliver superior performance in every situation.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                    </div>
                    <!-- End Col kc-->

                    <div class="col-sm-12 col-lg-4 mb-3 ">
                        <!-- Card -->
                        <div class="card card-transition h-100" data-bs-toggle="modal"
                            data-bs-target=".bd-example-modal-sm-jesse">
                            <div class="card-body">
                                <div class="d-flex avatar avatar-xl  mb-4">
                                    <img class="avatar-img" src="{{ asset('front_asset/img/Jesse_avatar.png') }}"
                                        alt="Image Description">
                                </div>
                                <!-- <p class=" lead text-navy-blue">Kaushlesh Chandel -<span
                      class="lead  text-primary  mb-1 "> The Firmware Maestro</span></p> -->
                                <span class="card-subtitle text-primary">The Hardware Architect</span>
                                <h4 class="card-title text-navy-blue">Jesse Robinson </h4>
                                <!-- <h5 class="card-title text-black">Mark Hughes</h5>
                      <h3 class="card-text lead text-primary">The Visionary</h3> -->

                                <p class="card-text text-navy-blue">Jesse Robinson, our hardware architect, breathes life
                                    into the Boondock Echo. An experienced and innovative electronics <a
                                        href="mySmallModalLabelkc" data-bs-toggle="modal"
                                        data-bs-target=".bd-example-modal-sm-jesse" class="text-muted"> ...read more</a>
                                </p>

                            </div>

                            <div class="card-footer pt-0">

                                <!-- Socials -->
                                <!-- <ul class="list-inline mb-0">
                      <li class="list-inline-item">
                        <a class="btn btn-outline-primary btn-xs btn-icon rounded" href="#">
                          <i class="bi-facebook"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="btn btn-outline-primary btn-xs btn-icon rounded" href="#">
                          <i class="bi-google"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="btn btn-outline-primary btn-xs btn-icon rounded" href="#">
                          <i class="bi-twitter"></i>
                        </a>
                      </li>
                    </ul> -->
                                <!-- End Socials -->
                            </div>
                        </div>

                        <!-- End Card -->
                        <!-- Modal -->
                        <div class="modal modal-lg fade bd-example-modal-sm-jesse content-space-4" tabindex="-1"
                            role="dialog" aria-labelledby="mySmallModalLabelkc" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="d-flex avatar avatar-circle mx-2">
                                            <img class="avatar-img" src="{{ asset('front_asset/img/Jesse_avatar.png') }}"
                                                alt="Image Description">
                                        </div>
                                        <h5 class="modal-title lead h4 text-navy-blue" id="mySmallModalLabelkc">Jesse
                                            Robinson -</h5>
                                        <h5 class="modal-title lead h4 text-primary" id="mySmallModalLabelkc">The Hardware
                                            Architect</h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <span class="divider-end mt-2"></span>
                                    <div class="modal-body text-navy-blue">Jesse Robinson, our hardware architect, breathes
                                        life into the Boondock Echo. An experienced and innovative electronics engineer,
                                        Jesse is the force behind the robust and durable design of our device. He ensures
                                        the Boondock Echo withstands extreme conditions while maintaining its sleek,
                                        user-friendly design. Jesse's commitment to excellence and eye for detail make our
                                        product not only efficient but also aesthetically pleasing and easy to handle.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                    </div>
                    <!-- End Col jesse-->

                </div>
                <!-- End Row -->

            </div>
            <!-- End Team -->
            <!-- Team -->
            <div class="container content-space">

                <div class="row gx-3 mb-5 w-md-75 w-lg-100 mx-md-auto mb-5 mb-md-9">
                    <div class="col-sm-6 col-lg-2 mb-3 ">

                    </div>
                    <!-- End Col -->

                    <div class="col-sm-12 col-lg-4 mb-3 ">
                        <!-- Card -->
                        <div class="card card-transition " data-bs-toggle="modal"
                            data-bs-target=".bd-example-modal-sm-suraj">
                            <div class="card-body">
                                <div class="d-flex avatar avatar-xl  mb-4">
                                    <img class="avatar-img" src="{{ asset('front_asset/img/suraj_avatar.jpg') }}"
                                        alt="Image Description">
                                </div>
                                <!-- <p class=" lead text-navy-blue">Kaushlesh Chandel -<span
                      class="lead  text-primary  mb-1 "> The Firmware Maestro</span></p> -->
                                <span class="card-subtitle text-primary">Infrastructure Architect</span>
                                <h4 class="card-title text-navy-blue">Suraj Tiwari</h4>
                                <!-- <h5 class="card-title lead text-black">Kaushlesh Chandel</h5>
                      <h3 class="card-text lead text-primary">The Firmware Maestro</h3> -->

                                <p class="card-text text-navy-blue">Suraj Tiwari, the mastermind behind cutting-edge
                                    backend architecture and automation, is driven by a deep fascination with optimize<a
                                        href="mySmallModalLabelkc" data-bs-toggle="modal"
                                        data-bs-target=".bd-example-modal-sm-suraj" class="text-muted"> ...read more</a>
                                </p>
                            </div>

                            <div class="card-footer pt-0">
                                <!-- Socials -->
                                <!-- <ul class="list-inline mb-0">
                      <li class="list-inline-item">
                        <a class="btn btn-outline-primary btn-xs btn-icon rounded" href="#">
                          <i class="bi-facebook"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="btn btn-outline-primary btn-xs btn-icon rounded" href="#">
                          <i class="bi-google"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="btn btn-outline-primary btn-xs btn-icon rounded" href="#">
                          <i class="bi-twitter"></i>
                        </a>
                      </li>
                    </ul> -->
                                <!-- End Socials -->
                            </div>
                        </div>

                        <!-- End Card -->
                        <!-- Modal -->
                        <div class="modal modal-lg fade bd-example-modal-sm-suraj content-space-4" tabindex="-1"
                            role="dialog" aria-labelledby="mySmallModalLabelkc" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="d-flex avatar avatar-circle mx-2">
                                            <img class="avatar-img" src="{{ asset('front_asset/img/suraj_avatar.jpg') }}"
                                                alt="Image Description">
                                        </div>
                                        <h5 class="modal-title lead h4 text-navy-blue" id="mySmallModalLabelkc">Suraj
                                            Tiwari -</h5>
                                        <h5 class="modal-title lead h4 text-primary" id="mySmallModalLabelkc">
                                            Infrastructure Architect</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <span class="divider-end mt-2"></span>
                                    <div class="modal-body text-navy-blue">Suraj Tiwari, the mastermind behind cutting-edge
                                        backend architecture and automation, is driven by a deep fascination with optimizing
                                        software systems. With a solid foundation in development and a passion for
                                        problem-solving, Suraj recognized the need for scalable solutions. His vision for
                                        efficient server management, streamlined databases, and automated processes has
                                        paved the way for groundbreaking applications. Suraj's commitment to pushing the
                                        boundaries of technology continues to inspire our team and shape the future of
                                        software development.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                    </div>
                    <!-- End Col suraj-->

                    <div class="col-sm-12 col-lg-4 mb-3 ">
                        <!-- Card -->
                        <div class="card card-transition" data-bs-toggle="modal"
                            data-bs-target=".bd-example-modal-sm-nandani">
                            <div class="card-body">
                                <div class="d-flex avatar avatar-xl  mb-4">
                                    <img class="avatar-img" src="{{ asset('front_asset/img/nandani_avtar.jpg') }}  "
                                        alt="Image Description">
                                </div>
                                <!-- <p class=" lead text-navy-blue">Kaushlesh Chandel -<span
                      class="lead  text-primary  mb-1 "> The Firmware Maestro</span></p> -->
                                <span class="card-subtitle text-primary">Application Architect</span>
                                <h4 class="card-title text-navy-blue">Nandani Rathod</h4>
                                <!-- <h5 class="card-title lead text-black">Kaushlesh Chandel</h5>
                      <h3 class="card-text lead text-primary">The Firmware Maestro</h3> -->

                                <p class="card-text text-navy-blue"> Nandani Rathod, a skilled developer and UI/UX
                                    designer, is known for creating captivating responsive web applications. With a keen
                                    <a href="mySmallModalLabelkc" data-bs-toggle="modal"
                                        data-bs-target=".bd-example-modal-sm-nandani" class="text-muted"> ...read more</a>
                                </p>

                            </div>

                            <div class="card-footer pt-0">
                                <!-- Socials -->
                                <!-- <ul class="list-inline mb-0">
                      <li class="list-inline-item">
                        <a class="btn btn-outline-primary btn-xs btn-icon rounded" href="#">
                          <i class="bi-facebook"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="btn btn-outline-primary btn-xs btn-icon rounded" href="#">
                          <i class="bi-google"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="btn btn-outline-primary btn-xs btn-icon rounded" href="#">
                          <i class="bi-twitter"></i>
                        </a>
                      </li>
                    </ul> -->
                                <!-- End Socials -->
                            </div>
                        </div>

                        <!-- End Card -->
                        <!-- Modal -->
                        <div class="modal modal-lg fade bd-example-modal-sm-nandani content-space-4" tabindex="-1"
                            role="dialog" aria-labelledby="mySmallModalLabelkc" aria-hidden="true">
                            <div class="modal-dialog modal-lg " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="d-flex avatar avatar-circle mx-2">
                                            <img class="avatar-img"
                                                src="{{ asset('front_asset/img/nandani_avtar.jpg') }}"
                                                alt="Image Description">
                                        </div>
                                        <h5 class="modal-title lead h4 text-navy-blue" id="mySmallModalLabelkc">Nandani
                                            Rathod -</h5>
                                        <h5 class="modal-title lead h4 text-primary" id="mySmallModalLabelkc">Application
                                            Architect</h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <span class="divider-end mt-2"></span>
                                    <div class="modal-body text-navy-blue">
                                        Nandani Rathod, a skilled developer and UI/UX designer, is known for creating
                                        captivating responsive web applications. With a keen eye for aesthetics and a focus
                                        on user-centric design, Nandani excels at crafting seamless and visually stunning
                                        experiences. Her ability to bridge the gap between design and functionality ensures
                                        each interaction leaves a lasting impression. Nandani's dedication to staying up to
                                        date with the latest trends and technologies drives her to continually deliver
                                        intuitive and engaging user experiences.</div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                    </div>
                    <!-- End Col nandani-->

                    <div class="col-sm-6 col-lg-2 mb-3">

                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->

            </div>
            <!-- End Team -->
        </div>

        <!-- End Team -->
        <!-- mission and vision start -->

        <!-- Card Grid -->
        <div class="container content-space-2 content-space-lg-2">
            <!-- Heading -->
            <!-- <div class="w-md-75 w-lg-50 text-center mx-md-auto mb-5 mb-md-9">
        <h2>Browse more projects</h2>
      </div> -->
            <!-- End Heading -->

            <div class="row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <!-- Card -->
                    <div class="card-body card card-transition text-center">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <span class="svg-icon svg-icon-lg text-primary">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M4 4L11.6314 2.56911C11.875 2.52343 12.125 2.52343 12.3686 2.56911L20 4V11.9033C20 15.696 18.0462 19.2211 14.83 21.2313L12.53 22.6687C12.2057 22.8714 11.7943 22.8714 11.47 22.6687L9.17001 21.2313C5.95382 19.2211 4 15.696 4 11.9033L4 4Z"
                                            fill="#035A4B"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M11.175 14.75C10.9354 14.75 10.6958 14.6542 10.5042 14.4625L8.58749 12.5458C8.20415 12.1625 8.20415 11.5875 8.58749 11.2042C8.97082 10.8208 9.59374 10.8208 9.92915 11.2042L11.175 12.45L14.3375 9.2875C14.7208 8.90417 15.2958 8.90417 15.6792 9.2875C16.0625 9.67083 16.0625 10.2458 15.6792 10.6292L11.8458 14.4625C11.6542 14.6542 11.4146 14.75 11.175 14.75Z"
                                            fill="#035A4B"></path>
                                    </svg>

                                </span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="display-6 text-navy-blue">Our<span class="display-5 text-primary  lead mb-3">
                                        Mission</span></h6>
                                <div class="border-top  border-10 my-3" style="max-width: 25rem;"></div>
                                <!-- <span class="blockquote-footer-source">Happy customer</span> -->
                            </div>
                        </div>


                        <!-- Blockquote -->
                        <figure>
                            <p class=" text-navy-blue">Our mission is to provide high-quality, cutting-edge technology
                                which strive to offer solutions that improve the clarity, reliability, and convenience of
                                using two-way radios, making it easier for you to communicate and stay connected, regardless
                                of where you are .</p>

                        </figure>
                        <!-- End Blockquote -->
                        <div class="border-top  border-10 my-3" style="max-width: 30rem;"></div>
                    </div>

                    <!-- End Card -->
                </div>
                <!-- End Col -->

                <div class="col-sm-6 mb-3 mb-sm-0">
                    <!-- Card -->
                    <div class="card-body card card-transition text-center">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 ">
                                <h6 class="display-6 text-navy-blue">Our<span class="display-5 text-primary  lead mb-3">
                                        Vision</span></h6>
                                <div class="border-top  border-10 my-3" style="max-width: 25rem;"></div>
                                <!-- <span class="blockquote-footer-source">Happy customer</span> -->
                            </div>
                            <div class="flex-shrink-0 ms-3">

                                <span class="svg-icon svg-icon-lg  text-primary">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5 15L3 21.5L9.5 19.5L5 15Z" fill="#035A4B"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M13.5 21C18.7467 21 23 16.7467 23 11.5C23 6.2533 18.7467 2 13.5 2C8.2533 2 4 6.2533 4 11.5C4 16.7467 8.2533 21 13.5 21ZM13.5 14.0061L11.5463 15.0332C11.3124 15.1562 11.0232 15.0663 10.9003 14.8324C10.8513 14.7393 10.8344 14.6326 10.8522 14.5289L11.2254 12.3533L9.6447 10.8126C9.4555 10.6282 9.45165 10.3254 9.63605 10.1362C9.7095 10.0609 9.8057 10.0118 9.9098 9.9967L12.0942 9.67925L13.0711 7.69985C13.1881 7.46295 13.4749 7.3657 13.7118 7.4826C13.8061 7.52915 13.8825 7.60555 13.9291 7.69985L14.9059 9.67925L17.0903 9.9967C17.3517 10.0347 17.5329 10.2774 17.4949 10.5388C17.4798 10.6429 17.4307 10.7392 17.3554 10.8126L15.7748 12.3533L16.1479 14.5289C16.1926 14.7893 16.0177 15.0366 15.7573 15.0813C15.6537 15.0991 15.5469 15.0822 15.4538 15.0332L13.5 14.0061Z"
                                            fill="#035A4B"></path>
                                    </svg>

                                </span>
                            </div>
                        </div>


                        <!-- Blockquote -->
                        <figure>
                            <p class=" text-navy-blue">Boondock Technologies is committed to pioneering advanced
                                open-source wireless communication tools. Our vision is to leverage cutting-edge technology,
                                transform global connectivity, and redefine the future of seamless, limitless communication.
                            </p>

                        </figure>
                        <!-- End Blockquote -->
                        <div class="border-top  border-10 my-3" style="max-width: 30rem;"></div>
                    </div>

                    <!-- End Card -->
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Card Grid -->

        <!-- mision and vision end -->


        <!-- Contact Form -->
        <!-- Contact Form -->
        <div class="bg-dark rounded-2 mx-2 mx-xl-10 "
            style="background-image: url('/assets/svg/components/wave-pattern-light.svg');" id="contact">
            <div class="container-xl  content-space-1 content-space-md-2 px-4 px-md-8 px-lg-3">

                <!-- team email strat -->
                <!-- Team -->
                <div class="container ">
                    <!-- Heading -->
                    <div class="w-md-75 w-lg-100 text-center mx-md-auto  mb-md-9">
                        <p class="lead text-white">We at Boondock Echo are always eager to
                            hear from our customers, potential
                            partners, or anyone interested in our technology. We value your
                            feedback and inquiries as they drive us
                            towards constant improvement and innovation. Don't hesitate to get
                            in touch!</p>

                    </div>
                    <!-- End Heading -->


                </div>
                <!-- End Team -->
                <!-- team email end -->
                <div class="row justify-content-lg-between align-items-lg-center">
                    <div class="col-md-10 col-lg-5 mb-9 mb-lg-0">

                        <div class="d-flex mb-2 my-3">
                            <img class="avatar mx-3" src="{{ asset('front_asset/img/MiniLogo-boondock.svg') }}"
                                alt="Logo">
                            <p class="text-white">Our professional support team is available Monday-Friday, 9 AM-5 PM (CST)
                                to assist you.</p>

                        </div>

                        <div class="border-top  border-white-10 my-3" style="max-width: 10rem;"></div>
                        <div class="card bg-soft-light px-5 py-5">
                            <h4 class="lead text-white">General Inquiries </h4>

                            <p class=" text-muted">
                                For general inquiries, product information, and press/media inquiries, please email us at
                            </p>


                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 icon icon-soft-light icon-circle ">
                                    <i class="bi-envelope-open-fill "></i>
                                </div>

                                <div class="flex-grow-1 ms-3 h4">
                                    <a class="" href="mailto:info@boondock.live">info@boondock.live</a>
                                </div>
                            </div>
                        </div>
                        <div class="border-top border-white-10 my-5" style="max-width: 10rem;"></div>
                        <div class="card bg-soft-light px-5 py-5">
                            <h4 class="lead text-white">Technical Support</h4>
                            <p class=" text-muted">For technical assistance or product support, please contact our dedicated
                                support team at</p>


                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 icon icon-soft-light icon-circle">
                                    <i class="bi-envelope-open-fill "></i>
                                </div>

                                <div class="flex-grow-1 ms-3 h4">
                                    <a class="" href="mailto:support@boondock.live">support@boondock.live</a>
                                </div>
                            </div>



                        </div>
                        <!-- <div class="border-top border-white-10 my-5"
                style="max-width: 10rem;"></div>
                <div class="card bg-soft-light px-5 py-5">
                  <h6 class="lead text-white">Monday to Friday</h6>
                  <h6 class="lead text-white">9:00 AM to 5:00 PM (CST).</h6>
                </div> -->
                        <!-- End col-->


                    </div>

                    <div class="col-md-10 col-lg-7 mb-9 mb-lg-0 content-space-1">
                        <!-- Card -->
                        <!-- Contact Form -->
                        <div class=" container-fluid">
                            <!-- <div class="w-md-75 w-lg-50 text-center mx-md-auto mb-5 mb-md-9" >
                      <h2 class="text-primary">Get in touch</h2>
                    </div> -->
                            <div class="row">

                                <div class="col-lg-12 ">
                                    <div class="ps-lg-5">
                                        <!-- Card -->
                                        <div class="card">
                                            <div class="card-header border-bottom text-center">
                                                <h3 class="card-header-title">Fill out the form and we'll
                                                    be in touch as soon as possible.</h3>
                                            </div>

                                            <div class="card-body">
                                                <!-- Form -->
                                                <form id="contactForm" action="{{ route('contacts.store') }}" method="POST">
                                                    @csrf
                                                    <div class="row gx-3">
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="hireUsFormFirstNameEg3">First name</label>
                                                                <input type="text" class="form-control form-control-lg"
                                                                    name="first_name" id="hireUsFormFirstNameEg3"
                                                                    placeholder="First name" aria-label="First name"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="hireUsFormLasttNameEg3">Last name</label>
                                                                <input type="text" class="form-control form-control-lg"
                                                                    name="last_name" id="hireUsFormLasttNameEg3"
                                                                    placeholder="Last name" aria-label="Last name">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row gx-3">
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="hireUsFormWorkEmailEg3">Email address</label>
                                                                <input type="email" class="form-control form-control-lg"
                                                                    name="email" id="hireUsFormWorkEmailEg3"
                                                                    placeholder="email@site.com"
                                                                    aria-label="email@site.com" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="hireUsFormPhoneEg3">Phone</label>
                                                                <input type="number" class="form-control form-control-lg"
                                                                    name="phone" id="phone"
                                                                    placeholder="+x(xxx)xxx-xx-xx"
                                                                    aria-label="+x(xxx)xxx-xx-xx">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label" for="hireUsFormDetails">Details</label>
                                                        <textarea class="form-control form-control-lg" name="description" id="hireUsFormDetails"
                                                            placeholder="Tell us about your inquiry..." aria-label="Tell us about your..." rows="4"></textarea>
                                                    </div>
                                                    <!-- Hidden fields for user information -->
                                                    <input type="hidden" name="ip_address" id="ipAddress">
                                                    <input type="hidden" name="region" id="region">
                                                    <input type="hidden" name="user_timezone" id="localTime">

                                                    <div class="d-grid">
                                                        <button id="sendInquiryButton" type="submit" class="btn btn-primary btn-lg">Send inquiry</button>
                                                        <button id="loadingSpinnerButton" type="button" class="btn btn-primary btn-lg" style="display: none;">
                                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                        </button>
                                                    </div>
                                                </form>

                                                <!-- Alert message -->

                                                <div id="responseMessage" class="alert alert-soft-success mt-5"
                                                    role="alert" style="display: none;"></div>

                                                <script>
                                                    const form = document.querySelector('#contactForm');
                                                    const responseMessage = document.querySelector('#responseMessage');
                                                    const ipAddressField = document.querySelector('#ipAddress');
                                                    const regionField = document.querySelector('#region');
                                                    const localTimeField = document.querySelector('#localTime');
                                                    const sendInquiryButton = document.querySelector('#sendInquiryButton');
                                                    const loadingSpinnerButton = document.querySelector('#loadingSpinnerButton');
                                                    // Function to show the loading spinner button and hide the "Send inquiry" button
                                                    function showLoadingSpinnerButton() {
                                                        sendInquiryButton.style.display = 'none';
                                                        loadingSpinnerButton.style.display = 'block';
                                                    }
                                                    // Function to hide the loading spinner button and show the "Send inquiry" button
                                                    function hideLoadingSpinnerButton() {
                                                        sendInquiryButton.style.display = 'block';
                                                        loadingSpinnerButton.style.display = 'none';
                                                    }
                                                    // Function to get the user's IP address, region, and local time
                                                    function getUserInfo() {
                                                        // Make a request to an IP geolocation API
                                                        fetch('https://ipapi.co/json/')
                                                            .then(response => response.json())
                                                            .then(data => {
                                                                // Set the values of the hidden fields
                                                                ipAddressField.value = data.ip;
                                                                regionField.value = data.region;
                                                                const localTime = new Date().toLocaleString();
                                                                localTimeField.value = localTime;
                                                            })
                                                            .catch(error => {
                                                                console.error(error);
                                                            });
                                                    }
                                                    // Get the user's information when the page loads
                                                    
                                                    getUserInfo();
                                                    form.addEventListener('submit', function(e) {
                                                        e.preventDefault();
                                                        const formData = new FormData(form);
                                                        showLoadingSpinnerButton(); // Show the loading spinner button
                                                        const appUrl = "{{ config('app.url') }}"; // Get the APP_URL from Laravel config
                                                        const submitUrl = `${appUrl}/api/contacts`;
                                                        fetch(submitUrl, {
                                                                method: 'POST',
                                                                body: formData
                                                            })
                                                            .then(response => response.json())
                                                            .then(data => {
                                                                console.log(data);
                                                                // Set the response message to the div element
                                                                responseMessage.textContent = data.message;
                                                                responseMessage.style.display = 'block'; // Show the alert message
                                                                // Hide the alert message after 10 seconds
                                                                setTimeout(function() {
                                                                    form.reset(); // Reset the form fields to their initial state
                                                                    getUserInfo(); // Refresh the user's information
                                                                }, 1000); // 10 seconds
                                                                setTimeout(function() {
                                                                    responseMessage.style.display = 'none';
                                                                }, 10000); // 10 seconds
                                                                hideLoadingSpinnerButton(); // Hide the loading spinner button
                                                            })
                                                            .catch(error => {
                                                                console.error(error);
                                                                // Handle errors, display error message, etc.
                                                                hideLoadingSpinnerButton(); // Hide the loading spinner button
                                                            });
                                                    });
                                                </script>

                                                <!-- End Form -->
                                            </div>
                                        </div>
                                        <!-- End Card -->
                                    </div>
                                </div>
                                <!-- End Col -->

                            </div>
                            <!-- End Row -->
                        </div>
                        <!-- End Contact Form -->
                    </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
@endsection
