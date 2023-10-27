<!-- resources/views/news-admin/show.blade.php -->

@extends('layouts.app1')

@section('content')
    <main id="content" role="main" class="main">
      
        <div class="card px-5 rounded-0 py-5 shadow-none">
            <div class="page-header">
                <div class="row align-items-center mt-3 px-3">
                    <div class="col">
                        <h2 class="page-header-title">View : {{ $article->title }}</h2>
                    </div>
                    <div class="col-auto">
                    <a class="btn btn-primary " href="{{ route('news-admin.index') }}">Back</a>
                        <a href="{{ route('news-admin.edit', $article->id) }}"
                            class="btn btn-primary mx-2"><i class="bi bi-pencil-fill me-1"> </i>Edit</a>
                            <!-- Button to Trigger Modal for Deleting an Article -->
                      <button type="button" class="btn btn-danger " data-bs-toggle="modal"
                                              data-bs-target="#exampleModalCenterDeleteArticle{{ $article->id }}">
                                              <i class="bi-trash me-1"> </i>Delete
                                          </button>
                                  
                                          <!-- Modal for Deleting an Article -->
                                          <div id="exampleModalCenterDeleteArticle{{ $article->id }}" class="modal fade" tabindex="-1" role="dialog"
                                              aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                                  <div class="modal-content text-center">
                                                      <div class="modal-body">
                                                          <p class="text-dark">Are you sure you want to delete this article? <br>This action cannot be
                                                              undone.</p>
                                                          <button type="button" class="btn btn-soft-dark mx-4" data-bs-dismiss="modal">Cancel</button>
                                                          <!-- Form to handle the delete action -->
                                                          <form method="POST" action="{{ route('news-admin.destroy', $article->id) }}"
                                                              style="display:inline">
                                                              @method('DELETE')
                                                              @csrf
                                                              <button type="submit" class="btn btn-soft-danger">Yes, Delete</button>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                      
                    </div>
                </div>
            </div>
            <div class="container   content-space-b-2 ">
                <div class="bg-soft-primary content-space-1 content-space-lg-1  rounded-3" style="background-image: url(assets/svg/components/wave-pattern-light.svg);">
                    <div class="w-lg-100 mx-lg-auto">
                        <div class="row align-items-sm-center ms-5">
                            <div class="col-lg-8 col-sm-7 mb-4 mb-sm-0">
                                <div class="form-group col-md-12">
                                    <h1 class="h2 text-navy-blue">{{ $article->title }}</h1>
                                </div>
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
                {{-- <div class="w-lg-100 mx-lg-auto my-3">
                <p class="text-dark"> {!! $article->description !!}</p>


            </div> --}}
                <div class="w-md-85 w-lg-100 text-center mx-md-auto mb-5 mb-md-9 content-space-t-2">
                    <img class="img-fluid rounded" src="{{ asset('storage/' . $article->hero_image) }}" alt="Image" >
                </div>
        
                <div class="w-lg-100 mx-lg-auto ">
                    <p class="text-dark"> {!! $article->body !!}</p>
                </div>
            </div>
                <!-- Card Grid for Recent Posts -->
                <div class="container">
                    <div class="w-lg-100 border-top content-space-2 mx-lg-auto">
                       
        
                        <div class="row   border-bottom  content-space-2">
                           
                                <div class="col-md-6 card-transition  ">
                                    <!-- Card for Recent Post -->
                                 <p>Card Image will be display as </p>
                                    <div class="h-100 py-5 card">
                                        <div class="row justify-content-between px-2">
                                            <div class="col-6">
                                                <a class="text-cap text-navy-blue">{{$article->author->name }}</a>
                                                <div class="mb-0">
                                                    <p class="text-primary h4" >
                                                        {{ $article->title }}
                                                    </p>
                                                    
        
                                                    <p class="text-muted  small ">{{ Str::limit($article->description, 30) }}</p>
                                             
                                                    <p class="card-text small text-muted">{{$article->created_at->format('M j, Y') }}</p>  
                                                </div>
                                            </div>
                                            <!-- End Col -->
                                           
                                            <div class="col-5">
        
                                                <img class="card-img-top" src="{{ asset('storage/' .$article->card_image) }}"
                                                    alt="Image Description">
                                              
                                            </div>
                                            <!-- End Col -->
                                        </div>
                                        <!-- End Row -->
                                    </div>
                               
                                    <!-- End Card for Recent Post -->
                                </div>
                                <!-- End Col -->
                           
                        <!-- End Row -->
                    </div>
                </div>
                <!-- End Card Grid for Recent Posts -->
           
            <!-- <div class="row mb-2">
                <div class="col-md-12 d-inline-flex py-2">
                    <a href="{{ route('news-admin.edit', $article->id) }}" class="">
                        <button type="button" class="btn btn-primary me-3"> <i class="bi-pencil-fill me-1"> </i> Edit Article</button>
                    </a>
                      
                </div>
            </div> -->

        </div>
    </main>
@endsection
