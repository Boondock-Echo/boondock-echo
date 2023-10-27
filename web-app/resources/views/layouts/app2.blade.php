<!DOCTYPE html>
<html lang="en" dir>

  <head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="robots" content="noindex">

    <!-- Title -->
    <title>Boondock Echo</title>

    <!-- Favicon -->

    <link rel="shortcut icon" href="{{asset('front_asset/img/MiniLogo-boondock.svg')}}">

    <!-- Font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap"
      rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{asset('front_asset/css/vendor.min.css')}}">
    <link rel="stylesheet"
      href="{{asset('front_asset/vendor/bootstrap-icons/font/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('front_asset/vendor/aos/dist/aos.css')}}">

    <!-- CSS Boondock Template -->
    <link rel="stylesheet" href="{{asset('front_asset/css/theme.minc619.css?v=1.0')}}">

    <!-- contact form css -->
    <link rel="stylesheet" href="{{asset('front_asset/css/leaflet.css')}}" />

    <!-- <script type="text/javascript">
    window.$crisp = [];
    window.CRISP_WEBSITE_ID = "42fea79f-e3b3-439b-b73f-2b014a53677f";
    (function() {
      d = document;
      s = d.createElement("script");
      s.src = "https://client.crisp.chat/l.js";
      s.async = 1;
      d.getElementsByTagName("head")[0].appendChild(s);
    })();
  </script>
    <style>
    .crisp-1jrl {
      display: none !important;
    }
  
    .icon-large {
      font-size: 35px;
    }
 
    .sticky-heading{
      position: sticky;
      top: 0;
      background-color: rgb(255, 255, 255);
      z-index: 999;
    }
  </style> -->
<style>
  .icon-large {
    font-size: 35px;
  }

  .sticky-heading{
    position: sticky;
    top: 0;
    background-color: rgb(255, 255, 255);
    z-index: 999;
  }
</style>
  </head>

  <body>
    <!-- ========== HEADER ========== -->
    <header id="header"
      class="navbar navbar-expand-lg navbar-end navbar-absolute-top navbar-light navbar-show-hide"
      data-hs-header-options='{
            "fixMoment": 1000,
            "fixEffect": "slide"
          }'>

      <div class="container">
        <nav class="js-mega-menu navbar-nav-wrap">
          <!-- Default Logo -->
          <a class="navbar-brand" href="{{url('/')}}" aria-label="Boondock">
            <img class="navbar-brand-logo" src="{{asset('front_asset/img/logo-boondock1.png')}}"
              alt="Logo">
          </a>
          <!-- End Default Logo -->

          <!-- Toggler -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-default">
              <i class="bi-list"></i>
            </span>
            <span class="navbar-toggler-toggled">
              <i class="bi-x"></i>
            </span>
          </button>
          <!-- End Toggler -->

          <!-- Collapse -->
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <div class="navbar-absolute-top-scroller">
              <!-- Nav -->
              <ul class="nav justify-content-end nav-sm">
                <li class="nav-item">
                  <a class="nav-link " href="{{url('/')}}">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/#about')}}">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/#services')}}">Services</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/#team')}}">Team</a>
                </li> 
                <li class="nav-item">
                  <a class="nav-link" href="{{asset('https://docs.boondockecho.com/')}}" target="_blank">Documentation</a>
              </li>
              
                <li class="nav-item">
                  <a class="nav-link" href="{{route('newsroom.index')}}">News</a>
                </li> 
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/#contact')}}">Contact</a>
                </li>

                <li class="nav-item">
                  @if(Auth::check())
                  <!-- User is already logged in, show the Dashboard with the user's name -->
                  <a href="{{ route('inbox') }}" type="button" class="btn btn-primary btn-sm px-4">Welcome, {{ auth()->user()->name }}</a>
              @else
                  <!-- User is not logged in, show the "Sign In" button -->
                  <a href="{{ route('login') }}" type="button" class="btn btn-primary btn-sm px-4">Sign In</a>
              @endif
              

                </li>
             
              </ul>
              <!-- End Nav -->
            </div>
          </div>
          <!-- End Collapse -->
        </nav>
      </div>
    </header>
    <style>
      .nav-link {
        position: relative;
        color: #000; /* Set your default text color */
        text-decoration: none;
      }
    
      .nav-link:hover {
        color: #f60; /* Set your hover text color */
      }
    
      .nav-link:hover::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px; /* Set the thickness of the underline */
        background-color: #f60; /* Set your desired underline color */
        
      }
    </style>
    
    
    <!-- ========== END HEADER ========== -->
         
      @yield('content')
    
  
    <!-- ========== END HEADER ========== -->
        <!-- ========== FOOTER ========== -->
        <footer class>
            <div class=" content-space-2 gradient-y-gray px-lg-10 card-centered">
              <div class="row mb-1">
                <div class="col-lg-4 mb-3 mb-lg-0 col-md-6 col-sm-12 col-md-12">
                  <!-- Logo -->
                  <a href="{{route('home')}}" aria-label="Boondock-logo">
                    <img class="navbar-brand-logo-footer"
                      src="{{asset('front_asset/img/boondock-logo2.png')}}" alt="Logo"
                      style="margin-top: -90px;">
                     
                  </a>
                  <!-- End Logo -->
                 
                </div>
                <!-- End Col -->
  
                <div class="col-6 col-md-6 col-lg-3 mb-5 mb-md-0 px-sm-3 col-sm-6">
                   <h4 class="text-primary mb-2 mx-5">Reach Us</h4>
  
                  <!-- Links -->
                  <ul class="list-unstyled list-py-1 mb-0">
                    <!-- <div class="d-flex mb-2">
                      <img class="avatar mx-3" src="{{asset('front_asset/img/MiniLogo-boondock.svg')}}" alt="Logo">
                        <p class="text-white">Our professional support team is available Monday-Friday, 9 AM-5 PM (CST) to assist you.</p>
                        
                    </div> -->
                    <!-- <li class="d-flex mb-2">
                      <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                          <i class="bi bi-geo-alt text-primary"></i>
                        </div>
            
                        <div class="flex-grow-1 ms-3">
                          <a
                            href="https://www.google.com/maps?q=A18 XYZ Street New York 53022 United States"
                            class="text-black">A18 XYZ Street
                            <br> New York 53022, <br> United States
                          </a>
                        </div>
                      </div>
                     
                    </li> -->
  
                    <li class="d-flex mt-5">
                     
                      <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                          <i class="bi bi-envelope text-primary"></i> 
                        </div>
            
                        <div class="flex-grow-1 ms-3 text-center">
                          <a class="nav-link text-black" href="mailto:info@boondock.live">info@boondock.live</a>
                        </div>
                      </div>
                    </li>
  
                    <li class="d-flex mb-2 mt-3">
                    
                        <div class="d-flex ">
                          <div class="flex-shrink-0">
                            <i class="bi bi-telephone text-primary"></i>
                          </div>
              
                          <div class="flex-grow-1 ms-3 text-center">
                            <a class="nav-link text-black" href="tel:+1 7084062226">+1 7084062226</a>
                          </div>
                        </div>
                    </li>
                    <li class="d-flex mb-2 mt-3">
                    
                      <div class="d-flex ">
                        <div class="flex-shrink-0">
                          <i class="bi bi-file-earmark-text text-primary"></i>
                       
                        </div>
            
                        <div class="flex-grow-1 ms-3 text-center">
                          <a class="nav-link text-black" href="{{asset('https://docs.boondockecho.com/')}}" target="_blank">Documentation</a>
                        </div>
                      </div>
                  </li>
                   
                  </ul>
                  <!-- End Links -->
                </div>
                <!-- End Col -->
  
                <div class="col-6 col-md-6 col-lg-2 mb-5 mb-md-0 col-sm-6">
                  <h4 class="text-primary mb-5">Quick Link</h4>
  
                  <!-- Nav Links -->
                  <ul class="list-unstyled list-py-1 mb-0">
                    <!-- <li><a class="" href="#home">Home</a></li> -->
                    <li><a class="text-black " href="{{url('/#about')}}">About</a></li>
                    <li><a class="text-black" href="{{url('/#services')}}">Services</a></li>
                    <li><a class="text-black" href="{{url('/#team')}}">Team</a></li>
                    <!-- <li><a class="text-black" href="{{url('/#about')}}">Pricing</a></li> -->
                    <li><a class="text-black" href="{{url('/#contact')}}">Contact</a></li>
  
                  </ul>
                  <!-- End Nav Links -->
                </div>
                <!-- End Col -->
  
                <div class="col-md-6 col-lg-3 col-sm-12">
                  <!-- Form -->
                  <form
                    action="https://gmail.us21.list-manage.com/subscribe/post?u=060302782cfc046680b45032b&id=cc194562d4&f_id=007a5ae1f0"
                    method="post" id="mc-embedded-subscribe-form"
                    name="mc-embedded-subscribe-form" class="validate"
                    target="_blank" novalidate>
                    <h5 class="text-primary ">Stay up to date</h5>
  
                    <!-- Input Card -->
                    <div class="input-card mt-5">
                      <div class="input-card-form">
                        <input type="email" value name="EMAIL" id="mce-EMAIL"
                          class="form-control required email"
                          placeholder="Enter email" aria-label="Enter email">
                        <span id="mce-EMAIL-HELPERTEXT" class="helper_text"></span>
                      </div>
                      <button type="submit" value="Subscribe" name="subscribe"
                        id="mc-embedded-subscribe" class="btn btn-primary">Submit</button>
                    </div>
                    <!-- End Input Card -->
                  </form>
                  <!-- End Form -->
                  <div id="mce-responses" class="clear foot">
                    <div class="response" id="mce-error-response"
                      style="display:none"></div>
                    <div class="response" id="mce-success-response"
                      style="display:none"></div>
                  </div>
                  <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
  
                  <script type='text/javascript'
                    src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script
                    type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
                  <!--End mc_embed_signup-->
  
                  <p class="form-text text-black-70">Let's get connect anytime -
                    anywhere .</p>
                    <div class="col-auto mt-3">
                      <!-- Socials -->
                      {{-- <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                          <a class="btn btn-ghost-primary btn-sm btn-icon" href="#">
                            <i class="bi-facebook"></i>
                          </a>
                        </li>
      
                        <li class="list-inline-item">
                          <a class="btn btn-ghost-primary btn-sm btn-icon" href="#">
                            <i class="bi-google"></i>
                          </a>
                        </li>
      
                        <li class="list-inline-item">
                          <a class="btn btn-ghost-primary btn-sm btn-icon" href="#">
                            <i class="bi-twitter"></i>
                          </a>
                        </li>
      
                        <li class="list-inline-item">
                          <a class="btn btn-ghost-primary btn-sm btn-icon" href="#">
                            <i class="bi-github"></i>
                          </a>
                        </li>
      
                        <li class="list-inline-item">
                          <a class="btn btn-ghost-primary btn-sm btn-icon" href="#">
                            <i class="bi-linkedin"></i>
                          </a>
                        </li>
                      </ul> --}}
                      <!-- End Socials -->
                    </div>
                    <!-- End Col -->
                  <!-- icon -->
  
                  <!-- <h4 class="mb-3 mt-3">Get our application</h4>
  
                  <div class="d-flex gap-3">
                    <a class="btn btn-dark btn-icon rounded-circle" href="#">
                      <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24">
                        <path
                          d="M11.76,6.69a.52.52,0,0,1-.59-.52,4.37,4.37,0,0,1,1-2.61A4.82,4.82,0,0,1,14.64,2a.51.51,0,0,1,.63.51,4.66,4.66,0,0,1-1,2.63A4.07,4.07,0,0,1,11.76,6.69Zm5.42,5.82c0-2.72,2-3.33,2-3.92s-1.73-1.91-3.56-1.91-2.54.86-3.78.86-2.25-.86-3.79-.86A5.16,5.16,0,0,0,3.89,9.21,6.64,6.64,0,0,0,3,12.75C3,17.14,6.15,22,8.47,22c1.3,0,1.63-.85,3.42-.85S14,22,15.22,22c2.52,0,4.62-5,4.62-5.07a.51.51,0,0,0-.3-.46A4.44,4.44,0,0,1,17.18,12.51Z" />
                      </svg>
                    </a>
  
                    <a class="btn btn-dark btn-icon rounded-circle" href="#">
                      <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24">
                        <path
                          d="M12.3 4.11104L20.7 3.01094C21.4 2.91094 22 3.51102 22 4.21102V11.211H12.3V4.11104V4.11104ZM10.3 11.311V4.41097L3.10001 5.31099C2.50001 5.41099 2 5.91094 2 6.51094V11.311H10.3ZM12.3 13.311V20.5109L20.7 21.611C21.4 21.711 22 21.111 22 20.411V13.411H12.3V13.311ZM10.3 13.311H2V18.111C2 18.711 2.50001 19.211 3.10001 19.311L10.3 20.211V13.311V13.311Z"
                          fill="#"></path>
                      </svg>
  
                    </a>
  
                  </div> -->
                  <!-- end icon -->
                </div>
                <!-- End Col -->
              </div>
              <!-- End Row -->
  
               <div class="row align-items-center">
                <div class="col text-center">
                  <p class="text-black-70 small mb-0">2023 © Boondock. All rights
                    reserved.</p>
                </div>
               
  
                <!-- <div class="col-auto">
               
                  <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                      <a class="btn btn-ghost-primary btn-sm btn-icon" href="#">
                        <i class="bi-facebook"></i>
                      </a>
                    </li>
  
                    <li class="list-inline-item">
                      <a class="btn btn-ghost-primary btn-sm btn-icon" href="#">
                        <i class="bi-google"></i>
                      </a>
                    </li>
  
                    <li class="list-inline-item">
                      <a class="btn btn-ghost-primary btn-sm btn-icon" href="#">
                        <i class="bi-twitter"></i>
                      </a>
                    </li>
  
                    <li class="list-inline-item">
                      <a class="btn btn-ghost-primary btn-sm btn-icon" href="#">
                        <i class="bi-github"></i>
                      </a>
                    </li>
  
                    <li class="list-inline-item">
                      <a class="btn btn-ghost-primary btn-sm btn-icon" href="#">
                        <i class="bi-linkedin"></i>
                      </a>
                    </li>
                  </ul>
                  
                </div> -->
               
              </div>
              
            </div>
          </footer>
          <!-- ========== END FOOTER ========== -->
          <!-- ========== END FOOTER ========== -->
  
          <!-- ========== SECONDARY CONTENTS ========== -->
       
  
          <!-- Go To -->
          <a class="js-go-to go-to position-fixed" href="javascript:;"
            style="visibility: hidden;" data-hs-go-to-options='{
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
          <script src="{{asset('front_asset/js/vendor.min.js')}}"></script>
          <script src="{{asset('front_asset/vendor/aos/dist/aos.js')}}"></script>
  
          <!-- JS Boondock -->
          <script src="{{asset('front_asset/js/theme.min.js')}}"></script>
  
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
                .forEach($progress => $progress.style.transitionDuration = `${swiper.params.autoplay.delay}ms`)
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
          <script src="{{asset('front_asset/vendor/hs-nav-scroller/dist/hs-nav-scroller.min.js')}}"></script>
  
          <!-- JS Plugins Init. -->
          <script>
      (function() {
        // INITIALIZATION OF NAV SCROLLER
        // =======================================================
        new HsNavScroller('.js-nav-scroller')
      })()
    </script>
  
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
         
    
  
  
        </body>
  
      </html>
