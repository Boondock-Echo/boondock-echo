@extends('layouts.app2')


@section('content')
  <!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main">
    <!-- Hero -->
    <div class="container content-space-t-3 content-space-t-lg-4 content-space-b-1 content-space-b-md-2">
      <div class="w-md-75 w-lg-50 text-center mx-md-auto">
        
            <h1 class="display-4 text-navy-blue">News</h1>
      
        <p class="lead text-primary">Latest updates and insights</p>
      </div>
    </div>
    <!-- End Hero -->

    <!-- Card Grid -->
    <div class="container content-space-b-2 content-space-b-lg-3">
 
     
      <div class="row mb-7">
      @if($articles->isEmpty())
    <div class="text-center p-4">
        <img class="mb-3" src="{{ asset('assets/svg/illustrations/oc-browse.svg') }}" alt="Image Description" style="width: 25%;" data-hs-theme-appearance="default">
        <!-- <img class="mb-3" src="{{ asset('assets/svg/illustrations-light/oc-error.svg') }}" alt="Image Description" style="width: 25%;" data-hs-theme-appearance="dark"> -->
        <p class="mb-0">No data to show</p>
        
      </div>

  @else
        @foreach ($articles as $article)
    
        <div class="col-sm-6 col-lg-4 mb-4 card-transition" >
          <!-- Card -->
          <a href="{{ route('newsroom.news_detail', ['id' => $article->id]) }}">
          <div class="card h-100">
            <div class="shape-container">
              <img class="card-img-top" src="{{ asset('storage/' . $article->card_image) }}" alt="Image" style="width: 350px; height: 300px;">
              <!-- Replace 300px and 200px with your desired width and height -->
              <!-- Shape -->
              <div class="shape shape-bottom zi-1" style="margin-bottom: -.25rem">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1920 100.1">
                  <path fill="#fff" d="M0,0c0,0,934.4,93.4,1920,0v100.1H0L0,0z"></path>
                </svg>
              </div>
              <!-- End Shape -->
            </div>
            

            <!-- Card Body -->
            <div class="card-body">
              <h3 class="card-title">
                <a class="text-navy-blue" href="{{ route('newsroom.news_detail', ['id' => $article->id]) }}">{{ $article->title }}</a>
              </h3>

              <p class="card-text">{{ \Illuminate\Support\Str::limit($article->description, 60) }}</p>

            </div>
            <!-- End Card Body -->

            <!-- Card Footer -->
              <!-- Card Footer -->
              <div class="card-footer">
                <div class="d-flex align-items-center">
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <a class="avatar avatar-circle" href="blog-author-profile.html">
                        @if ( $article->author->profile_picture !== url('/storage'))
                        <img class="avatar-img"  src="{{ $article->author->profile_picture }}" alt="Image Description">
                        @else
                        <img class="avatar-img" src="{{ asset('default.jpg') }}" alt="Image Description">
                        @endif
                      </a>
                    </div>
                      <div class="flex-grow-1 mt-1 ms-3">
                        <a class="card-link link-dark" >{{ $article->author->name }}</a>
                        <p class="card-text small">{{ $article->created_at->format('M j, Y') }}</p>
                      </div>
                    </div>
  
                  <div class="flex-grow-1">
                    <div class="d-flex justify-content-end">
                      <a href="{{ route('newsroom.news_detail', ['id' => $article->id]) }}">

                      <p class="card-link link-dark text-primary">Read more <i class="bi-chevron-right small ms-1"></i></p></a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Card Footer -->
            <!-- End Card Footer -->
          </div>
        </a>
          <!-- End Card -->
        </div>
     
        <!-- End Col -->
        @endforeach

        @endif
      
      </div>
      <!-- End Row -->

  <!-- Pagination -->
<nav aria-label="Page navigation">
  <ul class="pagination justify-content-end">
      {{-- Previous Page Link --}}
      @if ($articles->onFirstPage())
          <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
              <span class="page-link" aria-hidden="true">
                  <i class="bi-chevron-double-left small"></i>
              </span>
          </li>
      @else
          <li class="page-item">
              <a class="page-link" href="{{ $articles->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                  <i class="bi-chevron-double-left small"></i>
              </a>
          </li>
      @endif

      {{-- Page Numbers --}}
      @for ($i = 1; $i <= $articles->lastPage(); $i++)
          <li class="page-item {{ $i === $articles->currentPage() ? 'active' : '' }}">
              <a class="page-link" href="{{ $articles->url($i) }}">{{ $i }}</a>
          </li>
      @endfor

      {{-- Next Page Link --}}
      @if ($articles->hasMorePages())
          <li class="page-item">
              <a class="page-link" href="{{ $articles->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                  <i class="bi-chevron-double-right small"></i>
              </a>
          </li>
      @else
          <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
              <span class="page-link" aria-hidden="true">
                  <i class="bi-chevron-double-right small"></i>
              </span>
          </li>
      @endif
  </ul>
</nav>
<!-- End Pagination -->


    </div>
    <!-- End Card Grid -->
  </main>
  <!-- ========== END MAIN CONTENT ========== -->



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
 



@endsection
