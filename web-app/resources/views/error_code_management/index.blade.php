@extends('layouts.app1')

@section('content')

    <main id="content" role="main" class="main">
        <div class="container-fluid">
            <div class="container">
                <h1 class="mb-4 mt-4">Text to Speech </h1>
                
                <form method="post" action="{{ url('/generate-audio') }}">
                    @csrf
                    <div class="form-group mb-4">
                        <textarea name="text" rows="4" cols="50" class="form-control" placeholder="Enter text...">{{ old('audioText') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Generate Audio</button>
                </form>
                
                @if(session()->has('audioText'))
                <div class="alert alert-success mt-4">
                    <strong>Generated Text:</strong> {{ session('audioText') }}
                </div>
                @endif
            
                @if (file_exists(public_path('test.wav')))
                <div class="mt-4">
                    <audio controls>
                        <source src="{{ asset('test.wav') }}" type="audio/wav">
                        Your browser does not support the audio element.
                    </audio>
                </div>
                @endif
            </div>
            <!-- Create error code form -->
            <form method="post" action="{{ route('error_code_management.store') }}" class="mb-4">
                @csrf
                <h2 class="mb-4 mt-4 text-center ">Event code Management</h2>
                
                <div class="row">
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label for="text"> <b>Text</b></label>
                        <input type="text" name="text" value="{{old('text')}}" id="text" class="form-control" placeholder="Text" required>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-3">
                        <label for="event_code"><b>Event Code</b></label>
                        <input type="text" name="event_code" value="{{old('event_code')}}" id="event_code" class="form-control" placeholder="Event Code" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="event_description"><b>Event Description</b></label>
                        <input type="text" name="event_description" value="{{old('event_description')}}"  id="event_description" class="form-control" placeholder="Event Description" required>
                    </div>
                    <div class="col-md-6 mb-3 mt-6">
                        <div class="form-check">
                            <input type="checkbox" name="system" class="form-check-input" id="systemCheckbox">
                            <label class="form-check-label" for="systemCheckbox"><b>System File</b><span>  ( if Checkmarked then audio file will store in {{config('app.cdn_server')}}/system  )</span></label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
            
            

            <!-- Display Validation Errors -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Play</th>
                        <th>Text</th>
                        <th>Event Code</th>
                        <th>Event Description</th>
                        <th>Action</th>
                        <th>System</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($errorCodes as $errorCode)
                        <tr>
                            <td>{{ $errorCode->name }}</td>
                            <td>
                                <audio controls class="processed-audio my-2" style="width: 100px; height: 30px;">
                                    @if ($errorCode->system)
                                        <source src="{{config('app.cdn_server')}}/system/{{ $errorCode->name }}.wav">
                                    @else
                                        <source src="{{config('app.cdn_server')}}/audio_files/{{ $errorCode->name }}.wav">
                                    @endif
                                </audio>
                            </td>
                            <td>{{ $errorCode->text }}</td>
                            <td>{{ $errorCode->event_code }}</td>
                            <td>{{ $errorCode->event_description }}</td>
                            <td>
                                <form method="post" action="{{ route('error_code_management.destroy', $errorCode->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                            <td>
                                <input type="checkbox" {{ $errorCode->system ? 'checked' : '' }} disabled>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

@endsection
