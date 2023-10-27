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
                <form action="{{ route('news-admin.update', $article->id) }}" method="POST" class="text-dark"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-4">
                        <div class="form-group col-md-2 text-dark">
                            <label for="title">Title</label>
                        </div>
                        <div class="form-group col-md-10">
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ $article->title }}" required>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="form-group col-md-2 text-dark">
                            <label for="description">Description</label>
                        </div>
                        <div class="form-group col-md-10">
                            <textarea name="description" id="description" class="form-control" rows="4" required>{{ $article->description }}</textarea>
                        </div>
                    </div>

                    <!-- Repeat the pattern for other form elements -->

                    <div class="row mb-4">
                        <div class="form-group col-md-2 text-dark">
                            <label for="body">Body</label>
                        </div>
                        <div class="form-group col-md-10">
                            <textarea name="body" id="body" class="form-control" rows="13" required>{!! $article->body !!}</textarea>
                        </div>
                    </div>

                    <!-- Repeat the pattern for other form elements -->
                    <div class="row mb-4">
                        <div class="form-group col-md-2 text-dark">
                            <label for="card_image">Card Image</label>
                        </div>
                        <div class="form-group col-md-10">
                            <input type="file" name="card_image" id="card_image" class="form-control" accept="image/*"
                                onchange="loadImage('card_image', 'card_image_preview', 'card_image_cropper')">
                            <div>
                                <img src="{{ asset('storage/' . $article->card_image) }}" alt="Card Image"
                                    class="img-fluid rounded my-3" style="width: 200px; height: 200px; object-fit: cover;"
                                    id="card_image_preview" style="display: none; ">
                            </div>
                            <div class="cropper-container img-fluid rounded my-3">
                                <img src="{{ asset('storage/' . $article->card_image) }}" alt="Card Image"
                                    id="card_image_cropper" style="display: none;">
                            </div>
                            <div id="card_cropped_preview" style="display: none;" class="my-2"></div>
                            <button type="button" class="btn btn-primary" onclick="updateCardImage()">Update Cropped Card
                                Image </button>
                        </div>
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

                    <!-- Your other form fields -->

                    <button type="submit" class="btn btn-primary">Update Article  </button>
                </form>

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
