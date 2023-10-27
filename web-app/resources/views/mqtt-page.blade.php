@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            MQTT Page
        </div>
        <div class="card-body">
            <h6 class="card-subtitle mb-2">Activity</h6>
            <div id="message-container">
                @foreach ($receivedMessages as $message)
                    <p>Received message on topic [{{ $message['topic'] }}]: {{ $message['message'] }}</p>
                @endforeach
            </div>
        </div>
    </div>
@endsection
