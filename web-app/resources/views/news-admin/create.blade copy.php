@extends('layouts.app1')

@section('content')
<main id="content" role="main" class="main">
    <div class="card px-5 rounded-0 py-5">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-header-title">Create New Article</h2>
                </div>
                <div class="col-auto">
                    
                    <a class="btn btn-primary" href="{{ route('news-admin.index') }}">Back</a>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('news-admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-4 mt-3">
                <div class="form-group col-md-2 text-dark">
                    <label for="title">Title</label>
                </div>
                <div class="form-group  col-md-10">
                    <input type="text" value="{{old('title')}}" name="title" id="title" class="form-control" required>
                </div>
            </div>
            <div class="row mb-4">
                <div class="form-group col-md-2 text-dark">
                    <label for="description">Description</label>
                </div>
                <div class="form-group col-md-10">
                    <textarea name="description" value="{{old('description')}}" id="description" class="form-control" rows="2" maxlength="80" required></textarea>

                </div>
            </div>
            <div class="row mb-6">
                <div class="form-group col-md-2 text-dark">
                    <label for="body">Body</label>
                </div>
                <div class="form-group col-md-10">
                    <textarea name="body" value="{{old('body')}}" id="body" class="form-control" rows="20"></textarea>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-2 form-group text-dark">
                    <label for="hero_image">Hero Image</label>
                </div>
                <div class="col-sm-4 form-group">
                    <input type="file" name="hero_image" id="hero_image" class="form-control mb-3" accept="image/*" onchange="previewImage(this, 'hero_image_preview')">
                    <img id="hero_image_preview"  >
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-2 form-group text-dark">
                    <label for="card_image">Card Image</label>
                </div>
                <div class="form-group col-sm-4">
                    <input type="file" name="card_image" id="card_image" class="form-control mb-3" accept="image/*" onchange="previewImage(this, 'card_image_preview')" >
                    <img id="card_image_preview" >
                </div>
            </div>
            
          
          
            {{-- <div class="row mb-4">
                <div class="col-sm-2 form-group text-dark">
                    <label for="">Published</label>
                </div>
                <div class="form-group col-sm-4">
                    <div class="form-check custom-switch form-switch mx-2">
                        <input name="published" value="0" type="checkbox" class="form-check-input is-valid" id="published">
                        
                    </div>
                </div>
            </div> --}}
            
             
            <button type="submit" class="btn btn-primary">Save Article</button>
        </form>
    </div>
</main>

<script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
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
{{-- for display choosen image of card and hero --}}
<script>
    function previewImage(input, previewId) {
        var preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "#";
        }
    }
</script>
{{-- for published check button --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



@endsection
