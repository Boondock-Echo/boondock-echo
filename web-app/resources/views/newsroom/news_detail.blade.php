@extends('layouts.app2')


@section('content')
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="main">
        <!-- Article Description -->

        <div class="container content-space-t-3  content-space-t-lg-4 content-space-b-2 ">
            <div class="bg-soft-primary content-space-1 content-space-lg-1  rounded-3" style="background-image: url(assets/svg/components/wave-pattern-light.svg);">
                <div class="w-lg-100 mx-lg-auto">


                    <div class="row align-items-sm-center ms-5">
                        <div class="col-lg-8 col-sm-7 mb-4 mb-sm-0">

                            <h1 class="h2 text-navy-blue">{{ $article->title }}</h1>

                        </div>
                        <div class="col-lg-4 col-sm-7 mb-4 mb-sm-0">
                            <!-- Media -->
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <a class="avatar avatar-circle" href="blog-author-profile.html">
                                        @if ($article->author->profile_picture !== url('/storage'))
                                            <img class="avatar-img" src="{{ $article->author->profile_picture }}"
                                                alt="Image Description">
                                        @else
                                            <img class="avatar-img" src="{{ asset('default.jpg') }}"
                                                alt="Image Description">
                                        @endif
                                    </a>
                                </div>
                                <div class="flex-grow-1 mt-1 ms-3">
                                    <a class="text-primary">{{ $article->author->name }}</a>
                                    <p class="card-text small text-navy-blue    ">{{ $article->created_at->format('M j, Y') }}</p>
                                </div>
                            </div>
                            <!-- End Media -->
                        </div>
                        <!-- End Col -->

                        <!-- End Col -->
                    </div>
                    <!-- End Row -->

                </div>
            </div>
            {{-- <div class="w-lg-100 mx-lg-auto ">
                <p class="text-dark"> {!! $article->description !!}</p>


            </div> --}}
            <div class="w-md-85 w-lg-100 text-center mx-md-auto mb-5 mb-md-9 content-space-t-2">
                <img class="img-fluid rounded" src="{{ asset('storage/' . $article->hero_image) }}" alt="Image" style="">
            </div>

            <div class="w-lg-100 mx-lg-auto ">
                <p class="text-dark"> {!! $article->body !!}</p>


            </div>

        </div>
        <!-- End Article Description -->



        <!-- Card Grid for Recent Posts -->
        @if($recentPosts->isEmpty())
    <div class="text-center p-4">
        <!-- <img class="mb-3" src="{{ asset('assets/svg/illustrations/oc-browse.svg') }}" alt="Image Description" style="width: 25%;" data-hs-theme-appearance="default"> -->
        <!-- <img class="mb-3" src="{{ asset('assets/svg/illustrations-light/oc-error.svg') }}" alt="Image Description" style="width: 25%;" data-hs-theme-appearance="dark"> -->
        <!-- <p class="mb-0">No recent data to show</p> -->
        
      </div>

  @else
        <div class="container">
            <div class="w-lg-100 border-top content-space-2 mx-lg-auto">
                <!-- Heading for Recent Posts -->
                <div class="text-center mx-md-auto mb-5 mb-md-3 sticky-heading">
                  <span class="text-cap text-muted">Grab more insights</span>
                  <h6 class="display-6 text-navy-blue">Our<span class="display-5 text-primary "> Recent Articles</span></h6>
      
                
                  
                </div>
                {{-- <div class="mb-3 mb-sm-5">
                    <h2>Recent articles</h2>
                </div> --}}
                <!-- End Heading -->

                <div class="row   border-bottom  content-space-2">
                    @foreach ($recentPosts as $post)
                        <div class="col-md-6 card-transition mb-3 ">
                            <!-- Card for Recent Post -->
                          
                            <div class="h-100 py-5 card">
                                <div class="row justify-content-between px-2">
                                    <div class="col-6">
                                        <a class="text-cap text-navy-blue">{{ $post->author->name }}</a>
                                        <div class="mb-0">
                                            <a class="text-primary h4" href="{{ route('newsroom.news_detail', $post->id) }}">
                                                {{ $post->title }}
                                            </a>
                                            <a href="{{ route('newsroom.news_detail', $post->id) }}">

                                            <p class="text-muted  small ">{{ Str::limit($post->description, 30) }}</p>
                                          </a>
                                            <p class="card-text small text-muted">{{ $post->created_at->format('M j, Y') }}</p>  
                                        </div>
                                    </div>
                                    <!-- End Col -->

                                    <div class="col-5">
                                      <a class="text-primary h4" href="{{ route('newsroom.news_detail', $post->id) }}">

                                        <img class="card-img-top" src="{{ asset('storage/' . $post->card_image) }}"
                                            alt="Image Description">
                                      </a>
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Row -->
                            </div>
                       
                            <!-- End Card for Recent Post -->
                        </div>
                        <!-- End Col -->
                    @endforeach
                </div>
                <!-- End Row -->
            </div>
        </div>
        @endif
        <!-- End Card Grid for Recent Posts -->



    </main>
    <!-- ========== END MAIN CONTENT ========== -->



    <!-- ========== SECONDARY CONTENTS ========== -->

    <!-- Go To -->
    <a class="js-go-to go-to position-fixed" href="javascript:;" style="visibility: hidden;"
        data-hs-go-to-options='{
 "offsetTop": 700,
 "position": {
   "init": {
     "right": "2rem"
   },
   "show": {
     "bottom": "2rem"
   },
   "hide": {
     "bottom": "-2rem"
   }
 }
}'>
        <i class="bi-chevron-up"></i>
    </a>
    <!-- ========== END SECONDARY CONTENTS ========== -->

    <!-- JS Implementing Plugins -->
    <script src="{{ asset('front_asset/js/vendor.min.js') }}"></script>
    <script src="{{ asset('front_asset/vendor/aos/dist/aos.js') }}"></script>

    <!-- JS Boondock -->
    <script src="{{ asset('front_asset/js/theme.min.js') }}"></script>

    <!-- JS Plugins Init. -->
    <script>
        (function() {
            // INITIALIZATION OF HEADER
            // =======================================================
            new HSHeader('#header').init()
            // INITIALIZATION OF MEGA MENU
            // =======================================================
            new HSMegaMenu('.js-mega-menu', {
                desktop: {
                    position: 'left'
                }
            })
            // INITIALIZATION OF SHOW ANIMATIONS
            // =======================================================
            new HSShowAnimation('.js-animation-link')
            // INITIALIZATION OF BOOTSTRAP VALIDATION
            // =======================================================
            HSBsValidation.init('.js-validate', {
                onSubmit: data => {
                    data.event.preventDefault()
                    alert('Submited')
                }
            })
            // INITIALIZATION OF BOOTSTRAP DROPDOWN
            // =======================================================
            HSBsDropdown.init()
            // INITIALIZATION OF GO TO
            // =======================================================
            new HSGoTo('.js-go-to')
            // INITIALIZATION OF AOS
            // =======================================================
            AOS.init({
                duration: 650,
                once: true
            });
            // INITIALIZATION OF TEXT ANIMATION (TYPING)
            // =======================================================
            HSCore.components.HSTyped.init('.js-typedjs')
            // INITIALIZATION OF SWIPER
            // =======================================================
            var sliderThumbs = new Swiper('.js-swiper-thumbs', {
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
                history: false,
                breakpoints: {
                    480: {
                        slidesPerView: 2,
                        spaceBetween: 15,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 15,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 15,
                    },
                },
                on: {
                    'afterInit': function(swiper) {
                        swiper.el.querySelectorAll('.js-swiper-pagination-progress-body-helper')
                            .forEach($progress => $progress.style.transitionDuration =
                                `${swiper.params.autoplay.delay}ms`)
                    }
                }
            });
            var sliderMain = new Swiper('.js-swiper-main', {
                effect: 'fade',
                autoplay: true,
                loop: true,
                thumbs: {
                    swiper: sliderThumbs
                }
            })
        })()
    </script>

    <!-- about us slider tab js -->
    <!-- JS Implementing Plugins -->
    <script src="{{ asset('front_asset/vendor/hs-nav-scroller/dist/hs-nav-scroller.min.js') }}"></script>

    <!-- JS Plugins Init. -->
    <script>
        (function() {
            // INITIALIZATION OF NAV SCROLLER
            // =======================================================
            new HsNavScroller('.js-nav-scroller')
        })()
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
