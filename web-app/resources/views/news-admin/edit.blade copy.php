@extends('layouts.app1')

@section('content')
    <main id="content" role="main" class="main">
        <div class="card px-5 rounded-0 py-5">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-header-title">Edit Article</h2>
                    </div>
                    <!-- End Col -->
                    <div class=" col-auto form-check custom-switch form-switch mx-2">
                        <input type="checkbox" class="form-check-input is-valid" id="published"
                            {{ $article->published == 1 ? 'checked' : '' }}>
                        <label class="form-check-valid">Publish</label>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('news-admin.show', $article->id) }}" class="btn btn-info ms-2 bi bi-eye"></a>
                
                        <a class="btn btn-primary" href="{{ route('news-admin.index') }}">
                            Back
                        </a>
                    </div>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                    <script>
                        $(document).ready(function() {
                            // Listen for changes in the checkbox
                            $('#published').change(function() {
                                var isChecked = $(this).is(':checked');
                                var postId = {{ $article->id }};

                                // Send an AJAX request to update the published value
                                $.ajax({
                                    url: '{{ route('postpublish') }}',
                                    method: 'POST',
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        postId: postId,
                                        published: isChecked ? 1 : 0
                                    },
                                    success: function(response) {
                                        console.log('Updated successfully.');
                                    },
                                    error: function(xhr) {
                                        console.error('An error occurred while Publishing.');
                                    }
                                });
                            });
                        });
                    </script>

                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>

            <div>   
                
                <form action="{{ route('news-admin.updatedata', $article->id) }}" method="POST" class="text-dark"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="bg-soft-primary content-space-1 content-space-lg-1  rounded-3" style="background-image: url(assets/svg/components/wave-pattern-light.svg);">
                    <div class="w-lg-100 mx-lg-auto">
                        <div class="row align-items-sm-center ms-5">
                            <div class="col-lg-8 col-sm-7 mb-4 mb-sm-0">
                                <div class="form-group col-md-12">
                                    <!-- Article Title - Display -->
                <div id="titleDisplay">
                    <h1 class="h2 text-navy-blue">{{ $article->title }}
                    <button type="button" id="editTitleButton" class="btn btn-primary"><i class="bi bi-pencil-fill me-1"></i></button></h1>
                </div>
                  <!-- Article Title - Edit (Initially Hidden) -->
                  <div id="titleEdit" style="display: none;">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $article->title }}" required>
                    </div>
                    <button type="button" id="cancelTitleButton" class="btn btn-secondary">Cancel</button>
                    <button type="button" id="saveTitleButton" class="btn btn-primary">Save</button>
                </div>
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
               
        
              
        
                <!-- Hero Image - Display -->
                <div id="heroImageDisplay" class="w-md-85 w-lg-100 text-center mx-md-auto mb-5 mb-md-9 content-space-t-2">
                    <img class="img-fluid rounded" src="{{ asset('storage/' . $article->hero_image) }}" alt="Hero Image">
                    <button type="button" id="editHeroImageButton" class="btn btn-primary"><i class="bi bi-pencil-fill me-1"></i></button>
                </div>
        
                <!-- Hero Image - <i class="bi bi-pencil-fill me-1"></i> (Initially Hidden) -->
                <div id="heroImageEdit" style="display: none;">
                    <div class="form-group">
                        <label for="hero_image">Hero Image</label>
                        {{-- <input type="file" name="hero_image" id="hero_image" class="form-control" accept="image/*"> --}}
                    </div>
                    <div class="row mb-4">
                        <div class="form-group col-md-2 text-dark">
                            <label for="hero_image">Hero Image</label>
                        </div>
                        <div class="form-group col-md-10">
                            <input type="file" name="hero_image" id="hero_image" class="form-control" accept="image/*"
                                onchange="loadImage('hero_image', 'hero_image_preview', 'hero_image_cropper')">
                            <div>
                                <img src="{{ asset('storage/' . $article->hero_image) }}" alt="Hero Image"
                                    class="img-fluid rounded my-3" style="width: 400px; height: 200px; object-fit: cover;"
                                    id="hero_image_preview" style="display: none;">
                            </div>
                            <div class="cropper-container">
                                <img src="{{ asset('storage/' . $article->hero_image) }}" alt="Hero Image"
                                    id="hero_image_cropper" style="display: none;">
                            </div>
                            <div id="hero_cropped_preview" style="display: none;" class="my-2"></div>
                            <button type="button" class="btn btn-primary" onclick="updateHeroImage()">Update Cropped Hero
                                Image</button>
                        </div>
                    </div>
                    {{-- <button type="button" id="cancelHeroImageButton" class="btn btn-secondary">Cancel</button>
                    <button type="button" id="saveHeroImageButton" class="btn btn-primary">Save</button> --}}
                </div>
         <!-- JavaScript function for displaying selected images -->
         <script>
            function loadImage(inputId, previewId, cropperId, aspectRatio) {
                const input = document.getElementById(inputId);
                const preview = document.getElementById(previewId);
                const cropperImage = document.getElementById(cropperId);
        
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
        
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        cropperImage.src = e.target.result;
        
                        // Initialize Cropper.js for the selected image
                        const cropper = new Cropper(cropperImage, {
                            aspectRatio: aspectRatio, // Adjust aspect ratio based on your requirements
                            viewMode: 1, // Adjust the view mode as needed
                        });
        
                        // Show the preview and cropper elements
                        preview.style.display = 'block';
                        cropperImage.style.display = 'block';
                    };
        
                    reader.readAsDataURL(input.files[0]);
                }
            }
        
            // Function to manually update the cropped image for card image
            function updateCardImage() {
                const cropper = document.getElementById('card_image_cropper').cropper;
        
                if (cropper) {
                    cropper.getCroppedCanvas().toBlob((blob) => {
                        const formData = new FormData();
                        formData.append('card_image', blob);
        
                        // Send the cropped card image to the server using AJAX or form submission
                        // Example using fetch API:
                        fetch('{{ route('news-admin.updateImage', [$article->id, 'card']) }}', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                },
                            })
                            .then((response) => response.json())
                            .then((data) => {
                                // Hide the cropper and show the cropped image preview
                                document.getElementById('card_image_cropper').style.display = 'none';
                                const croppedPreview = document.getElementById('card_cropped_preview');
                                croppedPreview.innerHTML = ''; // Clear previous content
                                const croppedImg = document.createElement('img');
                                croppedImg.src = URL.createObjectURL(blob);
                                croppedImg.alt = 'Cropped Card Image';
                                croppedPreview.appendChild(croppedImg);
                                croppedPreview.style.display = 'block';
        
                                // Handle the response here (e.g., show success message)
                                console.log(data);
                            })
                            .catch((error) => {
                                console.error(error);
                            });
                    });
                }
            }
        
            // Function to manually update the cropped image for hero image
            function updateHeroImage() {
                const cropper = document.getElementById('hero_image_cropper').cropper;
        
                if (cropper) {
                    cropper.getCroppedCanvas().toBlob((blob) => {
                        const formData = new FormData();
                        formData.append('hero_image', blob);
        
                        // Send the cropped hero image to the server using AJAX or form submission
                        // Example using fetch API:
                        fetch('{{ route('news-admin.updateImage', [$article->id, 'hero']) }}', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                },
                            })
                            .then((response) => response.json())
                            .then((data) => {
                                // Hide the cropper and show the cropped image preview
                                document.getElementById('hero_image_cropper').style.display = 'none';
                                const croppedPreview = document.getElementById('hero_cropped_preview');
                                croppedPreview.innerHTML = ''; // Clear previous content
                                const croppedImg = document.createElement('img');
                                croppedImg.src = URL.createObjectURL(blob);
                                croppedImg.alt = 'Cropped Hero Image';
                                croppedPreview.appendChild(croppedImg);
                                croppedPreview.style.display = 'block';
        
                                // Handle the response here (e.g., show success message)
                                console.log(data);
                            })
                            .catch((error) => {
                                console.error(error);
                            });
                    });
                }
            }
        </script>
        
        <!-- JavaScript function for displaying selected images -->
                <!-- Article Body - Display -->
                <div id="bodyDisplay"  class="w-lg-100 mx-lg-auto ">
                    <button type="button" id="editBodyButton" class="btn btn-primary"><i class="bi bi-pencil-fill me-1"></i></button>
                    <p class="text-dark">{!! $article->body !!}</p>
                   
                </div>
        
                <!-- Article Body - Edit (Initially Hidden) -->
                <div id="bodyEdit" style="display: none;">
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="body" id="body" class="form-control" rows="13" required>{!! $article->body !!}</textarea>
                    </div>
                    <button type="button" id="cancelBodyButton" class="btn btn-secondary">Cancel</button>
                    <button type="button" id="saveBodyButton" class="btn btn-primary">Save</button>
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
                                                    <a class="text-primary h4" href="{{ route('newsroom.news_detail',$article->id) }}">
                                                        {{ $article->title }}
                                                    </a>
                                                    <a href="{{ route('newsroom.news_detail',$article->id) }}">
        
                                                    <p class="text-muted  small ">{{ Str::limit($article->description, 30) }}</p>
                                                  </a>
                                                    <p class="card-text small text-muted">{{$article->created_at->format('M j, Y') }}</p>  
                                                </div>
                                            </div>
                                            <!-- End Col -->
                                           
                                            <div class="col-5">
                                                <!-- Card Image - Display -->
                <div id="cardImageDisplay">
                    <img class="img-fluid rounded" src="{{ asset('storage/' . $article->card_image) }}" alt="Card Image">
                    <button type="button" id="editCardImageButton" class="btn btn-primary"><i class="bi bi-pencil-fill me-1"></i></button>
                </div>
        
                <!-- Card Image - Edit (Initially Hidden) -->
                <div id="cardImageEdit" style="display: none;">
                    <div class="form-group">
                        <label for="card_image">Card Image</label>
                        <input type="file" name="card_image" id="card_image" class="form-control" accept="image/*">
                    </div>
                    <button type="button" id="cancelCardImageButton" class="btn btn-secondary">Cancel</button>
                    <button type="button" id="saveCardImageButton" class="btn btn-primary">Save</button>
                </div>
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
              
        
                <!-- JavaScript to toggle between display and edit modes for each field -->
                <script>
                    function toggleEditMode(field, displayId, editId) {
                        document.getElementById(displayId).style.display = 'none';
                        document.getElementById(editId).style.display = 'block';
                    }
        
                    function toggleDisplayMode(field, displayId, editId) {
                        document.getElementById(displayId).style.display = 'block';
                        document.getElementById(editId).style.display = 'none';
                    }
        
                    // Title
                    document.getElementById('editTitleButton').addEventListener('click', function () {
                        toggleEditMode('title', 'titleDisplay', 'titleEdit');
                    });
        
                    document.getElementById('cancelTitleButton').addEventListener('click', function () {
                        toggleDisplayMode('title', 'titleDisplay', 'titleEdit');
                    });
        
                    document.getElementById('saveTitleButton').addEventListener('click', function () {
                        // Submit the form when the save button is clicked
                        document.getElementById('saveButton').click();
                    });
        
                    // Hero Image
                    document.getElementById('editHeroImageButton').addEventListener('click', function () {
                        toggleEditMode('hero_image', 'heroImageDisplay', 'heroImageEdit');
                    });
        
                    document.getElementById('cancelHeroImageButton').addEventListener('click', function () {
                        toggleDisplayMode('hero_image', 'heroImageDisplay', 'heroImageEdit');
                    });
        
                    document.getElementById('saveHeroImageButton').addEventListener('click', function () {
                        // Submit the form when the save button is clicked
                        document.getElementById('saveButton').click();
                    });
        
                    // Body
                    document.getElementById('editBodyButton').addEventListener('click', function () {
                        toggleEditMode('body', 'bodyDisplay', 'bodyEdit');
                    });
        
                    document.getElementById('cancelBodyButton').addEventListener('click', function () {
                        toggleDisplayMode('body', 'bodyDisplay', 'bodyEdit');
                    });
        
                    document.getElementById('saveBodyButton').addEventListener('click', function () {
                        // Submit the form when the save button is clicked
                        document.getElementById('saveButton').click();
                    });
        
                    // Card Image
                    document.getElementById('editCardImageButton').addEventListener('click', function () {
                        toggleEditMode('card_image', 'cardImageDisplay', 'cardImageEdit');
                    });
        
                    document.getElementById('cancelCardImageButton').addEventListener('click', function () {
                        toggleDisplayMode('card_image', 'cardImageDisplay', 'cardImageEdit');
                    });
        
                    document.getElementById('saveCardImageButton').addEventListener('click', function () {
                        // Submit the form when the save button is clicked
                        document.getElementById('saveButton').click();
                    });
                </script>
                <!-- End JavaScript -->
                
                <!-- Save Button (Initially Hidden) -->
                <button type="submit" id="saveButton" class="btn btn-primary" >Save Changes</button>

                <button type="submit" class="btn btn-primary">Update Article</button>
                <a href="{{ route('news-admin.show', $article->id) }}" class="btn btn-info mx-2 bi bi-eye">View</a>
            </form>
               




                
            </div>
        </div>

    </main>
    <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            ClassicEditor
                .create(document.querySelector('#body'))
                .then(editor => {
                    // Add CKEditor instance-based required validation
                    editor.editing.view.change(writer => {
                        writer.setStyle('display', 'block', editor.editing.view.document.getRoot());
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endsection
