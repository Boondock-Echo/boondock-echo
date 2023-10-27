@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Text to Speech</h1>
    
    <form method="post" action="{{ url('/generate-audio') }}">
        @csrf
        <div class="form-group">
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
@endsection
