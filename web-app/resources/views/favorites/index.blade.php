@extends('layouts.app1')
<style>
    @keyframes blink {
        0% {
            background-color: transparent;
            transform: scale(1);
        }

        50% {
            background-color: #ffc107;
            transform: scale(1.1);
        }

        100% {
            background-color: transparent;
            transform: scale(1);
        }
    }

    .blink {
        animation: blink 1s ease-in-out 5;
    }

    .nowrap-td {
        white-space: nowrap;
    }
</style>
{{-- <style>
    @media (max-width: 576px) {
        .table-responsive {
            overflow-x: auto;
        }

        tr.hide-in-mobile {
            display: none;
        }

        .table td,
        .table th {
            display: block;
            text-align: center;
        }

        .table td:before {
            content: attr(data-label);
            float: left;
            font-weight: bold;
            text-transform: uppercase;
        }

        .table td:last-child {
            text-align: center;
        }

        .table td,
        .table th {
            width: 100%;
        }

        audio {
            width: 20px;
        }



    }
</style> --}}
<style>
    @import 'https://fonts.googleapis.com/icon?family=Material+Icons|Roboto';



    .recorder_wrapper {
        width: 100%;
        display: -webkit-flex;
        display: -moz-flex;
        display: -ms-flex;
        display: -o-flex;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }

    .recorder {
        display: inline-block;
        text-align: center;
        width: 500px;
        max-width: 100%;
    }

    .record_btn {
        width: 100px;
        height: 100px;
        font-family: 'Material Icons';
        font-size: 48px;
        color: #e74c3c;
        background: none;
        border: 2px solid #e74c3c;
        border-radius: 50%;
        cursor: pointer;
        transition: 0.15s linear;
    }

    .record_btn:hover {
        transition: 0.15s linear;
        transform: scale(1.05);
    }

    .record_btn:active {
        background: #f5f5f5;
    }

    .record_btn:after {
        content: '\E029';
    }

    .record_btn[disabled] {
        border: 2px solid #ccc;
    }

    .record_btn[disabled]:after {
        content: '\E02B';
        color: #ccc;
    }

    .record_btn[disabled]:hover {
        transition: 0.15s linear;
        transform: none;
    }

    .record_btn[disabled]:active {
        background: none;
    }

    .recording {
        animation: recording 2s infinite ease-in-out;
        position: relative;
    }

    .recording:before {
        content: '';
        display: inline-block;
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0px;
        height: 0px;
        margin: 0px;
        border-radius: 50%;
        background: rgba(0, 0, 0, 0.05);
        animation: recording_before 2s infinite ease-in-out;
    }

    .record_btn.recording {
        color: #2ecc71;
        border-color: #2ecc71;
    }

    @keyframes recording {
        from {
            transform: scale(1.1);
        }

        50% {
            transform: none;
        }

        to {
            transform: scale(1.1);
        }
    }

    @keyframes recording_before {
        80% {
            width: 200px;
            height: 200px;
            margin: -100px;
            opacity: 0;
        }

        to {
            opacity: 0;
        }
    }

    .record_canvas {
        width: 60px;
        height: 100px;
        display: inline-block;

    }

    .txt_btn {
        color: #000;
        text-decoration: none;
        transition: 0.15s linear;
        animation: text_btn 0.3s ease-in-out;
    }
</style>
<style>
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 1;
        pointer-events: none;
        /* Allow interaction with elements behind the toast */
        transition: opacity 0.5s ease-in-out;
        /* Smooth transition for opacity */
    }

    .toast-container.toast-fade-out {
        opacity: 0;
    }

    .toast-container .toast {
        background-color: rgba(255, 255, 255, 0.8);
        /* Semi-transparent background color */
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        /* Box shadow for a nice effect */
    }

    .toast-container .toast-header {
        background-color: rgba(255, 255, 255, 0.9);
        /* Semi-transparent background color for the header */
        border-bottom: none;
        /* Remove the bottom border */
    }

    .toast-container .toast-body {
        padding: 10px 0;
        /* Add some padding to the toast body */
    }
</style>

@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">


            {{-- @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong>{{ $message }}</strong>
                </div>
            @endif --}}
            {{-- <div class="page-header">
                <div class="row align-items-end"> --}}
            {{-- <div class="col-sm mb-2 mb-sm-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-no-gutter">

                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Received </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Overview</li>
                            </ol>
                        </nav>

                        <h1 class="page-header-title">Received</h1>
                    </div> --}}







            <!-- End Col -->
            {{-- </div>
                <!-- End Row -->
            </div> --}}
            @if ($message = Session::get('success'))
                <div class="toast-container">
                    <div class="toast toast-show fade show" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <div class="d-flex align-items-center flex-grow-1">
                                {{-- <div class="flex-shrink-0">
                                    <img class="avatar avatar-sm avatar-circle" src="../assets/img/160x160/img4.jpg"
                                        alt="Image description">
                                </div> --}}
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-0">Dock Bot</h5>
                                    <small class="ms-auto">Just Now</small>
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn-close" data-bs-dismiss="toast"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                        <div class="toast-body">
                            {{ $message }}
                        </div>
                    </div>
                </div>
                <script>
                    // Remove the toast after 3 seconds
                    setTimeout(function() {
                        document.querySelector('.toast-container').classList.add('toast-fade-out');
                    }, 3000);
                </script>
            @endif
            @if ($errors->any())
                <div class="toast-container">
                    <div class="toast toast-show fade show" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <div class="d-flex align-items-center flex-grow-1">
                                {{-- <div class="flex-shrink-0">
                                    <img class="avatar avatar-sm avatar-circle" src="../assets/img/160x160/img4.jpg"
                                        alt="Image description">
                                </div> --}}
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-0">Dock Bot</h5>
                                    <small class="ms-auto">Just Now</small>
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn-close" data-bs-dismiss="toast"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                        <div class="toast-body">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    </div>
                </div>
                <script>
                    // Remove the toast after 3 seconds
                    setTimeout(function() {
                        document.querySelector('.toast-container').classList.add('toast-fade-out');
                    }, 3000);
                </script>
            @endif





            <!-- Stats -->
            <div class="row">
                <div class="col-sm-6 col-lg-2 mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Received</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span class="js-counter display-4 text-dark">
                                        @foreach ($audioFiles as $key => $dock)
                                            @if ($loop->last)
                                                {{ $key + 1 }}
                                            @endif
                                        @endforeach
                                    </span>
                                    <span class="text-body fs-5 ms-1">from {{ $totalaudioFiles }}</span>
                                </div>
                                <!-- End Col -->

                                <div class="col-auto">
                                    <span class="icon icon-xlg ">
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>


                                    {{-- <span class="badge bg-soft-success text-success p-1">
                                        {{ request('date_range') == 'today' ? 'Today' : '' }}
                                        {{ request('date_range') == '7_days' ? 'Last 7 Days' : '' }}
                                        {{ request('date_range') == '30_days' ? 'Last 30 Days' : '' }}
                                        {{ request('date_range') == '60_days' ? 'Last 60 Days' : '' }}
                                        {{ request('date_range') == 'all' ? 'Everything' : '' }}

                                        @if (!empty($dockNameFilter))
                                            from {{ $dockNameFilter }}
                                        @else
                                            From All docks
                                        @endif
                                    </span> --}}
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->
                        </div>
                    </div>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-2 mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Sent</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span class="js-counter display-4 text-dark">{{ $sentfile }}</span>
                                    <span class="text-body fs-5 ms-1">from {{ $totalaudioFiles }}</span>
                                </div>

                                <div class="col-auto">
                                    <span class="icon icon-xlg">
                                        <i class="fa-solid fa-paper-plane"></i>
                                    </span>
                                    {{-- <span class="badge bg-soft-success text-success p-1">
                                        {{ request('date_range') == 'today' ? 'Today' : '' }}
                                        {{ request('date_range') == '7_days' ? 'Last 7 Days' : '' }}
                                        {{ request('date_range') == '30_days' ? 'Last 30 Days' : '' }}
                                        {{ request('date_range') == '60_days' ? 'Last 60 Days' : '' }}
                                        {{ request('date_range') == 'all' ? 'Everything' : '' }}

                                        @if (!empty($dockNameFilter))
                                            from {{ $dockNameFilter }}
                                        @else
                                            From All docks
                                        @endif
                                    </span> --}}
                                </div>
                            </div>
                            <!-- End Row -->
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <div class="col-sm-6 col-lg-2 mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Online</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span class="js-counter display-4 text-dark">
                                        {{ $totalActiveDocks }}
                                    </span>
                                    <span class="text-body fs-5 ms-1">from {{ $totalDocks }}</span>
                                </div>
                                <!-- End Col -->
                                <div class="col-auto">
                                    <span class="icon icon-xlg ">
                                        <i>
                                            <img src="{{ asset('assets/img/front/dock1.png') }}" alt="Icon"
                                                style="width: 32px; height: 32px;">
                                        </i>
                                        {{-- <i class="fa-solid fa-walkie-talkie"></i> --}}
                                    </span>
                                </div>

                                <!-- End Col -->
                            </div>
                            <!-- End Row -->
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                {{-- <div class="col-sm-6 col-lg-2 mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100">
                        <div class="card-body">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d472426.7992239763!2d73.173086!3d22.322103!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395fc8ab91a3ddab%3A0xac39d3bfe1473fb8!2sVadodara%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1681815367882!5m2!1sen!2sin"
                                width="100%" height="80" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade" 4f0></iframe>
                        </div>
                    </div>
                    <!-- End Card -->
                </div> --}}
                <div class="col-sm-6 col-lg-6 mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Activity</h6>
                            <div id="reloadButton" type="" class="card-pinned-top-end h4" onclick="reloadPage()" style="display: none;">
                                {{-- <i class="bi bi-arrow-clockwise"></i> Reload --}}
                                <span id="newMessagesCount" class="badge bg-primary"></span>
                            </div>
                           
                            <script>
                                function reloadPage() {
                                    location.reload();
                                }

                                function updateNewMessagesCount() {
                                    var lastViewedTime = '{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}';

                                    $.ajax({
                                        url: "{{ url('get-new-messages-count') }}/" + lastViewedTime,
                                        method: "GET",
                                        success: function(response) {
                                            var newMessagesCount = response.newMessagesCount;
                                            var newMessagesText = newMessagesCount + " New message" + (newMessagesCount !== 1 ? "s" : "");
                            
                                           if (newMessagesCount > 0 && $('#livemode').is(':checked')) {
                                            $("#reloadButton").show();

                                            // Reload the page after 15 seconds
                                            setTimeout(function() {
                                                location.reload();
                                            }, 15000);
                                        } else {
                                            if (newMessagesCount > 0) {
                                                $("#reloadButton").show();
                                            } else {
                                                $("#reloadButton").hide();
                                            }
                                            }
                            
                                            $("#newMessagesCount").text(newMessagesText);
                                        },
                                        error: function(xhr, status, error) {
                                            console.log(xhr.responseText);
                                        }
                                    });
                                }

                                // Call the updateNewMessagesCount function every 5 seconds (adjust the interval as needed)
                                setInterval(updateNewMessagesCount, 5000);
                            </script>
                            <div class="row align-items-center gx-2">
                                <script>
                                    const authUserId = "{{ Auth::user()->id }}";
                                </script>
                                {{-- <div id="message-container">Welcome {{ Auth::user()->name }}!</div> --}}
                                <ul id="mqtt-messages-list">
                                    {{-- Messages will be dynamically loaded here --}}
                                </ul>
                                <span class="card-pinned-bottom-start ">
                                    <a href="{{ route('activity.index') }}" class="transition-link" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View More Activity Stream">
                                        More <i class="bi bi-chevron-double-right me-5"></i>
                                        
                                    </a>
                                    
                                </span>
                          <style>
                            .transition-link {
                                    position: relative;
                                    display: inline-block;
                                    overflow: hidden;
                                    }

                                    .transition-link i {
                                    display: inline-block;
                                    animation: push 3s infinite linear;
                                    }

                                    @keyframes push {
                                    0% {
                                        transform: translateX(0);
                                    }
                                    30% {
                                        transform: translateX(30%);
                                    }
                                    }

                          </style>
                                <script src="{{ asset('js/mqtt_messages.js') }}"></script>




                                <!-- Add an HTML element to display the response message -->




                                <!-- End Col -->


                                <!-- End Col -->
                            </div>
                            <!-- End Row -->
                        </div>
                    </div>
                    <!-- End Card -->
                </div>

                <!-- End Stats -->

                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
                <div class="card">
                    <div class="card-header card-header-content-md-between">
                        <div class="mb-2 mb-md-0">

                            <form>
                                <!-- Search -->
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend input-group-text">
                                        <i class="bi-search"></i>
                                    </div>
                                    <input id="datatableSearch" type="search" class="form-control"
                                        placeholder="Search Messages" aria-label="Search Messages">
                                </div>
                                <!-- End Search -->
                            </form>
                        </div>

                        <div class="d-grid d-sm-flex justify-content-md-end align-items-sm-center gap-2">
                            <!-- Datatable Info -->
                            <div id="datatableCounterInfo" style="display: none;">
                                <div class="d-flex align-items-center">
                                    <span class="fs-5 me-3">
                                        <span id="datatableCounter">0</span>
                                        Selected
                                    </span>
                                    <button type="button" class="btn btn-outline-danger" id="deleteSelectedBtn">
                                        Delete selected audio files
                                    </button>
                                </div>
                            </div>
                            <!-- End Datatable Info -->

                            {{-- RECORDER START --}}
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-soft-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModaLMic">
                                <i id="recordIcon" class="bi bi-mic-fill"></i>
                            </button>
                            <!-- End Button trigger modal -->

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalMic" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabelMic" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabelMic">Record Audio Here</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Dropzone -->
                                            <div id="modalDropzone" class="js-dropzone row dz-dropzone dz-dropzone-card">
                                                <div class="dz-message">
                                                    <div class="recorder_wrapper">
                                                        <div class="recorder">
                                                            <button class="record_btn my-3" id="button"></button>
                                                            <p id="msg_box"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Dropzone -->
                                        </div>
                                        <div class="modal-footer">
                                           
                                                <button type="button" class="btn btn-white"
                                                    data-bs-dismiss="modal">Close</button>
                                                <form action="{{ route('inboxstore') }}" method="POST"
                                                    enctype="multipart/form-data" id="myForm">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <input type="file" name="file" accept="audio/*" id="inputFile"
                                                            class="form-control @error('file') is-invalid @enderror" required
                                                            hidden>
                                                        @error('file')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="resetRecording()">Reset</button>
                                                        <button type="button" class="btn btn-success"
                                                            onclick="upload()">Upload</button>
                                                    </div>
                                                 
                                           
                                           
                                            {{-- <form action="{{ route('inboxstore') }}" method="POST"
                                                enctype="multipart/form-data" id="myForm">
                                                @csrf
                                                <div class="mb-3">
                                                    <input type="file" name="file" accept="audio/*" 
                                                        class="form-control @error('file') is-invalid @enderror" required
                                                        hidden>
                                                    @error('file')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <button type="button" class="btn btn-success"
                                                        onclick="upload()">Upload</button>
                                                </div>
                                            </form> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

                            <script>
                                var msg_box = document.getElementById('msg_box'),
                                    button = document.getElementById('button'),
                                    canvas = document.getElementById('canvas'),
                                    lang = {
                                        'mic_error': 'Error accessing the microphone',
                                        'press_to_start': 'Tap to start recording',
                                        'recording': 'Recording audio',
                                        'play': 'Play',
                                        'stop': 'Stop',
                                        'download': 'Download',
                                        'use_https': 'This application in not working over insecure connection. Try to use HTTPS'
                                    },
                                    time;


                                msg_box.innerHTML = lang.press_to_start;

                                if (navigator.mediaDevices === undefined) {
                                    navigator.mediaDevices = {};
                                }


                                if (navigator.mediaDevices.getUserMedia === undefined) {
                                    navigator.mediaDevices.getUserMedia = function(constrains) {
                                        var getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia
                                        if (!getUserMedia) {
                                            return Promise.reject(new Error('getUserMedia is not implemented in this browser'));
                                        }

                                        return new Promise(function(resolve, reject) {
                                            getUserMedia.call(navigator, constrains, resolve, reject);
                                        });
                                    }
                                }


                                if (navigator.mediaDevices.getUserMedia) {
                                    var btn_status = 'inactive',
                                        mediaRecorder,
                                        chunks = [],
                                        audio = new Audio(),
                                        mediaStream,
                                        audioSrc,
                                        type = {
                                            'type': 'audio/ogg,codecs=opus'
                                        },
                                        ctx,
                                        analys,
                                        blob;

                                    button.onclick = function() {
                                        if (btn_status == 'inactive') {
                                            start();
                                        } else if (btn_status == 'recording') {
                                            stop();
                                        }
                                    }

                                    function parseTime(sec) {
                                        var h = parseInt(sec / 3600);
                                        var m = parseInt(sec / 60);
                                        var sec = sec - (h * 3600 + m * 60);

                                        h = h == 0 ? '' : h + ':';
                                        sec = sec < 10 ? '0' + sec : sec;

                                        return h + m + ':' + sec;
                                    }


                                    function start() {
                                        navigator.mediaDevices.getUserMedia({
                                            'audio': true
                                        }).then(function(stream) {
                                            mediaRecorder = new MediaRecorder(stream);
                                            mediaRecorder.start();

                                            button.classList.add('recording');
                                            btn_status = 'recording';

                                            msg_box.innerHTML = lang.recording;

                                            if (navigator.vibrate) navigator.vibrate(150);

                                            time = Math.ceil(new Date().getTime() / 1000);


                                            mediaRecorder.ondataavailable = function(event) {
                                                chunks.push(event.data);
                                            }

                                            mediaRecorder.onstop = function() {
                                                stream.getTracks().forEach(function(track) {
                                                    track.stop()
                                                });

                                                blob = new Blob(chunks, type);
                                                audioSrc = window.URL.createObjectURL(blob);

                                                audio.src = audioSrc;

                                                chunks = [];
                                            }



                                        }).catch(function(error) {
                                            if (location.protocol != 'https:') {
                                                msg_box.innerHTML = lang.mic_error + '<br>' + lang.use_https;
                                            } else {
                                                msg_box.innerHTML = lang.mic_error;
                                            }
                                            button.disabled = true;
                                        });
                                    }

                                    function stop() {
                                        mediaRecorder.stop();
                                        button.classList.remove('recording');
                                        btn_status = 'inactive';

                                        if (navigator.vibrate) navigator.vibrate([200, 100, 200]);

                                        var now = Math.ceil(new Date().getTime() / 1000);

                                        var t = parseTime(now - time);

                                        msg_box.innerHTML =
                                            '<a href="#" type="button" onclick="play(); return false;" class="btn btn-outline-success">' + lang
                                            .play + ' (' + t +
                                            's)</a>'
                                           
                                    }



                                    function play() {
                                        audio.play();
                                        msg_box.innerHTML =
                                            '<a  href="#" onclick="pause(); return false;" class="btn btn-outline-success">' + lang.stop +
                                            '</a><br>';
                                    }


                                    function pause() {
                                        audio.pause();
                                        audio.currentTime = 0;
                                        msg_box.innerHTML = '<a href="#" onclick="play(); return false;" class="btn btn-outline-success">' + lang
                                            .play +
                                            '</a><br>'
                                    }

                                    function roundedRect(ctx, x, y, width, height, radius, fill) {
                                        ctx.beginPath();
                                        ctx.moveTo(x, y + radius);
                                        ctx.lineTo(x, y + height - radius);
                                        ctx.quadraticCurveTo(x, y + height, x + radius, y + height);
                                        ctx.lineTo(x + width - radius, y + height);
                                        ctx.quadraticCurveTo(x + width, y + height, x + width, y + height - radius);
                                        ctx.lineTo(x + width, y + radius);
                                        ctx.quadraticCurveTo(x + width, y, x + width - radius, y);
                                        ctx.lineTo(x + radius, y);
                                        ctx.quadraticCurveTo(x, y, x, y + radius);

                                        ctx.fillStyle = fill;
                                        ctx.fill();
                                    }

                                    function save() {
                                        var a = document.createElement('a');
                                        a.download = 'record.wav';
                                        a.href = audioSrc;
                                        document.body.appendChild(a);
                                        a.click();

                                        document.body.removeChild(a);
                                    }

                                    function upload() {
                                        var formData = new FormData();
                                        formData.append('file', blob, 'record.wav');

                                        var progressBar = document.createElement('div');
                                        progressBar.className = 'progress';
                                        var progressBarInner = document.createElement('div');
                                        progressBarInner.className = 'progress-bar';
                                        progressBarInner.setAttribute('role', 'progressbar');
                                        progressBarInner.setAttribute('aria-valuemin', '0');
                                        progressBarInner.setAttribute('aria-valuemax', '100');
                                        progressBarInner.style.width = '0%';
                                        progressBar.appendChild(progressBarInner);
                                        msg_box.appendChild(progressBar);

                                        axios.post('{{ route('inboxstore') }}', formData, {
                                                onUploadProgress: function(progressEvent) {
                                                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                                                    progressBarInner.style.width = percentCompleted + '%';
                                                    progressBarInner.setAttribute('aria-valuenow', percentCompleted);
                                                    progressBarInner.innerHTML = percentCompleted + '%';
                                                }
                                            })
                                            .then(function(response) {
                                                console.log(response.data);
                                                // Redirect or perform any other actions on success
                                                window.location.href = "{{ route('favorites.index') }}";
                                            })
                                            .catch(function(error) {
                                                console.error(error);
                                                // Handle the error
                                            });
                                    }





                                } else {
                                    if (location.protocol != 'https:') {
                                        msg_box.innerHTML = lang.mic_error + '<br>' + lang.use_https;
                                    } else {
                                        msg_box.innerHTML = lang.mic_error;
                                    }
                                    button.disabled = true;
                                }
                            </script>
                            <!-- End Modal -->
                            {{-- RECORDER END --}}
                            {{-- recoredr mic end --}}
                            {{-- upload files start --}}
                            <button type="button" class="btn btn-soft-primary " data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="bi bi-upload"></i>
                            </button>
                            {{-- <form action="{{ route('inboxstore') }}" method="POST" enctype="multipart/form-data">
                                @csrf --}}


                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Dropzone</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <!-- Dropzone -->
                                            <div id="modalDropzone" class="js-dropzone row dz-dropzone dz-dropzone-card">
                                                <div class="dz-message">
                                                    <img class="avatar avatar-xl avatar-4x3 mb-3"
                                                        src="../assets/svg/illustrations/oc-browse.svg"
                                                        alt="Image Description">
                                                    <h5>Drag and drop your audio files here</h5>
                                                    <p class="mb-2">or</p>

                                                    <form action="{{ route('inboxstore') }}" method="POST"
                                                        enctype="multipart/form-data" id="myForm_id">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <input type="file" name="file" accept="audio/*"
                                                                id="inputFile"
                                                                class="form-control @error('file') is-invalid @enderror"
                                                                required>
                                                            @error('file')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <button type="submit" class="btn btn-success">Upload</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- End Dropzone -->
                                        </div>

                                        <script>
                                            // Add an event listener to the Dropzone container
                                            document.getElementById('modalDropzone').addEventListener('drop', handleDrop, false);
                                            document.getElementById('modalDropzone').addEventListener('dragover', handleDragOver, false);

                                            // Prevent default behavior when dragging over the Dropzone container
                                            function handleDragOver(event) {
                                                event.stopPropagation();
                                                event.preventDefault();
                                                event.dataTransfer.dropEffect = 'copy';
                                            }

                                            // Handle the dropped files
                                            function handleDrop(event) {
                                                event.stopPropagation();
                                                event.preventDefault();

                                                var files = event.dataTransfer.files;
                                                var fileInput = document.getElementById('inputFile');
                                                fileInput.files = files;
                                                document.getElementById('myForm_id').submit();
                                            }
                                        </script>



                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                            {{-- </form> --}}
                            {{-- upload files end --}}

                            <!-- Dropdown -->

                            <div class="dropdown">
                                <button type="button" class="btn btn-white btn-sm w-100" id="usersFilterDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi-filter me-1"></i>All Filter <span
                                        class="badge bg-soft-dark text-dark rounded-circle ms-1">2</span>
                                </button>

                                <div class="dropdown-menu dropdown-menu-sm-end dropdown-card card-dropdown-filter-centered"
                                    aria-labelledby="usersFilterDropdown" style="min-width: 22rem;">
                                    <!-- Card -->
                                    <div class="card">
                                        <div class="card-header card-header-content-between">
                                            <h5 class="card-header-title">Filter Docks</h5>

                                            <!-- Toggle Button -->
                                            <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm ms-2">
                                                <i class="bi-x-lg"></i>
                                            </button>
                                            <!-- End Toggle Button -->
                                        </div>

                                        <div class="card-body">



                                            <form class="form-inline my-2 my-lg-0 mb-4" method="GET"
                                                action="{{ route('favorites.index', ['filter' => true]) }}">
                                                <div class="form-group mr-2">
                                                    <span class="dropdown-header">Audios Per Page</span>
                                                    <select name="per_page"
                                                        class="form-select form-select-sm focus input-active dropdown-active">
                                                        <option class="option" value="5">5</option>
                                                        <option class="option" value="10"
                                                            {{ $per_page == 10 ? 'selected' : '' }}>10</option>
                                                        <option class="option" value="20"
                                                            {{ $per_page == 20 ? 'selected' : '' }}>20</option>
                                                        <option class="option" value="25"
                                                            {{ $per_page == 25 ? 'selected' : '' }}>25</option>
                                                        <option class="option" value="50"
                                                            {{ $per_page == 50 ? 'selected' : '' }}>50</option>
                                                        <option class="option" value="100"
                                                            {{ $per_page == 100 ? 'selected' : '' }}>100</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mr-2">
                                                    {{-- <label for="dock_name">Filter by dock:</label> --}}
                                                    <span class="dropdown-header">Filter by dock:</span>
                                                    <select
                                                        class="form-select form-select-sm focus input-active dropdown-active"
                                                        name="dock_name" id="dock_name">
                                                        <option value="">All docks</option>
                                                        @foreach ($activeDocks as $dock)
                                                            <option value="{{ $dock->name }}"
                                                                @if (request('dock_name') == $dock->name) selected @endif>
                                                                {{ $dock->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group mr-2">
                                                    <span class="dropdown-header">Filter by date:</span>
                                                    <select
                                                        class="form-select form-select-sm focus input-active dropdown-active"
                                                        name="date_range" id="date_range">
                                                        <option value="today"
                                                            {{ request('date_range') == 'today' ? 'selected' : '' }}>Today
                                                        </option>
                                                        <option value="7_days"
                                                            {{ request('date_range') == '7_days' ? 'selected' : '' }}>Last
                                                            7
                                                            days</option>
                                                        <option value="30_days"
                                                            {{ request('date_range') == '30_days' ? 'selected' : '' }}>Last
                                                            30
                                                            days</option>
                                                        <option value="60_days"
                                                            {{ request('date_range') == '60_days' ? 'selected' : '' }}>Last
                                                            60
                                                            days</option>
                                                        <option value="all"
                                                            {{ request('date_range') == 'all' ? 'selected' : '' }}>
                                                            Everything
                                                        </option>
                                                    </select>
                                                </div>
                                                <input type="hidden" name="page"
                                                    value="{{ $audioFiles->currentPage() }}">
                                                <div class="d-grid mt-4">
                                                    <button class="btn btn-primary" type="submit">Apply</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <!-- End Card -->
                                </div>
                            </div>
                            <!-- End Dropdown -->
                            <!-- End Dropdown -->
                        </div>
                    </div>
                    <!-- Table -->
                 
                    <div class="table-responsive datatable-custom position-relative">
                        <table id="datatable"
                            class="table table-lg table-borderless table-thead-bordered table-align-middle card-table"
                            data-hs-datatables-options='{
                   "columnDefs": [{
                      "targets": [0, 5],
                      "orderable": false
                    }],
                   "order": [],
                   "info": {
                     "totalQty": "#datatableWithPaginationInfoTotalQty"
                   },
                   "search": "#datatableSearch",
                   "entries": "#datatableEntries",
                   "pageLength": {{ $per_page }},
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatablePagination"
                 }'>
                            <thead class="thead-light">
                                <tr class="hide-in-mobile">
                                    <th class="table-column-pe-0">
                                        <div class="form-check">
                                            <input class="form-check-input is-invalid" type="checkbox" value=""
                                                id="datatableCheckAll">
                                            <label class="form-check-label" for="datatableCheckAll"></label>
                                        </div>
                                    </th>
                                    {{-- <th class="table-column-pe-0">
                                    No.
                                </th> --}}
                                    <th>station / Callsign</th>
                                    <th>Description</th>
                                    <th>Audio</th>
                                    {{-- <th>State</th> --}}
                                    <th> Actions</th>

                                    {{-- <th>Portfolio</th> --}}
                                    <th>Received</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($audioFiles as $key => $audioFile)
                                    <tr>
                                        <td class="table-column-pe-0">
                                            <div class="form-check">
                                                <input class="form-check-input is-invalid" type="checkbox"
                                                    value="{{ $audioFile->id }}" id="audioFile_{{ $audioFile->id }}"
                                                    name="audioFiles[]">
                                                <label class="form-check-label" for="datatableCheckAll1"></label>
                                            </div>
                                        </td>
                                        {{-- <td data-label="No." class="table-column-pe-0"> --}}
                                        {{-- <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="datatableCheckAll1">
                                            <label class="form-check-label" for="datatableCheckAll1"></label>
                                        </div> --}}
                                        {{-- {{ $key + 1 + ($audioFiles->currentPage() - 1) * $audioFiles->perPage() }} --}}
                                        {{-- </td> --}}
                                        <td data-label="Station">
                                            <a class=" text-dark" href="#">
                                                <div class="d-inline-flex align-items-center">
                                                    <span class="icon  mb-1">
                                                        @if ($audioFile->audio_type == 3)
                                                            <i class="fa-solid fa-upload text-primary"></i>
                                                        @elseif ($audioFile->audio_type == 2)
                                                            <i data-bs-original-title="Favorite"
                                                                class="fa-solid fa-heart text-danger"></i>
                                                        @endif

                                                    </span>
                                                

                                                    <span class="text-inherit"
                                                        @foreach ($activeDocks as $dock)
                                                            @if ($dock->mac == $audioFile->mac)
                                                                title="Dock Name : {{ $dock->name }}"
                                                                data-bs-toggle="modal"  data-id="{{ $dock->id }}"
                                                                data-bs-target="#sett{{ $dock->id }}"
                                                                @elseif($audioFile->mac == auth()->user()->id)  data-bs-toggle="modal"  data-id="{{ $dock->id }}"
                                                                data-bs-target="#info{{ $dock->id }}"  @endif @endforeach>

                                                        @if ($audioFile->mac == auth()->user()->id)
                                                            @if (!empty(auth()->user()->call_sign))
                                                                {{ auth()->user()->call_sign }}
                                                            @else
                                                                {{ auth()->user()->name }}
                                                            @endif
                                                        @else
                                                            {{ $audioFile->station ?? 'DOCK nOT fOUND' }}

                                                            ({{ $audioFile->frequency ?? 'DOCK nOT fOUND' }})
                                                        @endif


                                                    </span>

                                                </div>
                                            </a>
                                        </td>
                                        {{-- <td data-label="Station">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <i class="fa-regular fa-envelope"></i>
                                                </div>
                                                <div class=" ms-3">
                                                    @foreach ($activeDocks as $dock)
                                                        @if ($dock->mac == $audioFile->mac)
                                                            {{ $dock->station ?? 'DOCK nOT fOUND' }}

                                                            ({{ $dock->frequency ?? 'DOCK nOT fOUND' }})
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </td> --}}
                                        {{-- <td data-label="Dock Name">
                                        @foreach ($activeDocks as $dock)
                                            @if ($dock->mac == $audioFile->mac)
                                                {{ $dock->name ?? 'DOCK nOT fOUND' }}
                                            @endif
                                        @endforeach
                                    </td> --}}
                                        <td data-label="Description">
                                            @if (!empty($audioFile->description))
                                                {{ $audioFile->description }}
                                            @else
                                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                                    data-id="{{ $audioFile->id }}"
                                                    data-bs-target="#description{{ $audioFile->id }}">Add
                                                    Description</button>
                                            @endif
                                            <div id="description{{ $audioFile->id }}" class="modal fade" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5> Description
                                                            </h5>


                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container">
                                                                <form
                                                                    action="{{ route('favorites.description', ['id' => $audioFile->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <textarea class="form-control my-3" name="description" placeholder="Write Description Here" style="height: 107px;"
                                                                        name="description" rows="4" cols="50" maxlength="50" required>{{ $audioFile->description }}</textarea>
                                                                    @error('description')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror


                                                                    <button type="submit"
                                                                        class="btn btn-outline-primary">Update</button>

                                                                </form>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                        </td>

                                        <td data-label="Audio">
                                            {{-- @if (str_contains($audioFile->file_name, 'uploads')) --}}
                                            <span><audio controls style="width: 240px; height:30px;">
                                                    <source
                                                        src="{{config('app.cdn_server')}}/uploads/{{ $audioFile->mac }}/{{ $audioFile->file_name }}">
                                                </audio></span>

                                            {{-- <span class="text-inherit">  {{ \Carbon\Carbon::parse($audioFile->added)->format('m-j-Y') }} </span> --}}
                                            {{-- @else
                                                <audio controls="mini"
                                                    src="{{ asset('storage/uploads/' . $audioFile->mac . '/' . $audioFile->file_name) }}"></audio>
                                            @endif --}}

                                        </td>
                                        <td class="nowrap-td" data-label="Actions">

                                            {{-- <form action="{{ route('inbox.delete', $audioFile->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"> <i
                                                    class="bi-trash me-1"></i> </button>

                                        </form> --}}
                                            @if (in_array($audioFile->id, $sentMessageIds))
                                                <a class="btn btn-secondary btn-sm" data-bs-toggle="tooltip" title='Transmited'
                                                    id="send-button{{ $audioFile->id }}"> <i
                                                        class="bi-check2-all me-1"></i></a>
                                            @else
                                                <a class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip"
                                                    title='Transmit' id="send-button{{ $audioFile->id }}">
                                                    <i class="fa-solid fa-tower-broadcast"></i></a>
                                            @endif
                                            {{-- <i
                                                class="bi-send-check me-1" style="font-size: 2rem; color: cornflowerblue;"></i> --}}

                                            {{-- model setting start --}}



                                            {{-- model setting end --}}
                                            <a class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" title='Play'
                                                id="play-button{{ $audioFile->id }}"> <i
                                                    class="fa-solid fa-radio"></i></a>
                                                    <!-- Button to trigger the modal -->
<button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalCenterdelete{{$audioFile->id}}">
    <i class="bi-trash me-1"></i>
</button>

<!-- Modal -->
<div id="exampleModalCenterdelete{{$audioFile->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content text-center">
            <div class="modal-body">
                <p class="text-dark">Do you really want to delete this item? <br>This process cannot be undone.</p>
                <button type="button" class="btn btn-soft-dark mx-4" data-bs-dismiss="modal">Cancel</button>
                <!-- Form to handle the delete action -->
                <form method="POST" action="{{ route('favorites.destroy', $audioFile->id) }}" style="display:inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-soft-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->


                                            {{-- <form method="POST"
                                                action="{{ route('favorites.destroy', $audioFile->id) }}"
                                                style="display:inline"
                                                onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    <i class="bi-trash me-1"></i>
                                                </button>
                                            </form> --}}

                                        </td>



                                        {{-- <td data-label="Recieved">
                                            <a>
                                                {{ \Carbon\Carbon::parse($audioFile->added)->diffForHumans(\Carbon\Carbon::now(), ['short' => true]) < 48 ? (\Carbon\Carbon::parse($audioFile->added)->isToday() ? 'Today ' . \Carbon\Carbon::parse($audioFile->added)->format('h:i:s A') : (\Carbon\Carbon::parse($audioFile->added)->isYesterday() ? 'Yesterday ' . \Carbon\Carbon::parse($audioFile->added)->format('h:i:s A') : \Carbon\Carbon::parse($audioFile->added)->isoFormat('ddd h:mm:ss A', \Carbon\Carbon::now(), 'en', $noSuffix = true))) : \Carbon\Carbon::parse($audioFile->added)->format('M d, h:i:s A') }}



                                            </a>
                                        </td> --}}
                                        <td data-label="Received">
                                            <a>
                                                @php
                                                    $added = \Carbon\Carbon::parse($audioFile->added);
                                                    if (!empty(auth()->user()->timezone)) {
                                                        $userTimezone = auth()->user()->timezone;
                                                        $added->setTimezone($userTimezone);
                                                    }
                                                    $diffForHumans = $added->diffForHumans(\Carbon\Carbon::now(), ['short' => true]);
                                                    
                                                    if ($added->isToday()) {
                                                        $formattedTime = $added->format('h:i:s A');
                                                    } elseif ($added->isYesterday()) {
                                                        $formattedTime = 'Yesterday ' . $added->format('h:i:s A');
                                                    } else {
                                                        $formattedTime = $added->isoFormat('ddd h:mm:ss A');
                                                    }
                                                @endphp

                                                {{ $formattedTime }}
                                            </a>
                                        </td>

                                    </tr>
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                    @php
                                        $filename = str_replace('uploads/', '', $audioFile->file_name);
                                    @endphp

                                    <script>
                                        $(document).ready(function() {

                                            // transmit
                                            $('#send-button{{ $audioFile->id }}').on('click', function() {
                                                $(this).removeClass('btn-outline-success').addClass('btn-secondary').html(
                                                    '<i class="bi-check2-all me-1"></i>');
                                                var topic = '{{ $audioFile->mac }}/set/play_transmit​';
                                                var message = '{{ $filename }}';

                                                $.ajax({
                                                    type: 'POST',
                                                    url: '{{ route('mqtt.publish') }}',
                                                    data: {
                                                        '_token': '{{ csrf_token() }}',
                                                        'topic': topic,
                                                        'message': message
                                                    },
                                                    success: function(response) {
                                                        console.log(response);

                                                        // create a new record in the "outbox" table
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: '{{ route('outbox.store') }}',
                                                            data: {
                                                                '_token': '{{ csrf_token() }}',
                                                                'message_id': '{{ $audioFile->id }}'
                                                            },
                                                            success: function(response) {
                                                                console.log(response);
                                                            },
                                                            error: function(error) {
                                                                console.log(error);
                                                            }
                                                        });
                                                    },
                                                    error: function(error) {
                                                        console.log(error);
                                                    }
                                                });
                                            });
                                            // play Cloud
                                            $('#play-button{{ $audioFile->id }}').on('click', function() {


                                                $(this).addClass('blink').html(
                                                    '<i class="bi-music-note-beamed me-1"></i>');

                                                // Remove the "blink" class from the button after 5 seconds
                                                setTimeout(function() {
                                                    $('#play-button{{ $audioFile->id }}').removeClass('blink').removeClass(
                                                        'btn-outline-success').addClass('btn-outline-secondary').html(
                                                        '<i class="bi-arrow-clockwise me-1"></i>');
                                                }, 5000);

                                                var topic = '{{ $audioFile->mac }}/set/play_cloud​';
                                                var message = '{{ $filename }}';

                                                $.ajax({
                                                    type: 'POST',
                                                    url: '{{ route('mqtt.publish') }}',
                                                    data: {
                                                        '_token': '{{ csrf_token() }}',
                                                        'topic': topic,
                                                        'message': message
                                                    },
                                                    success: function(response) {
                                                        console.log(response);
                                                    },
                                                    error: function(error) {
                                                        console.log(error);
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                @endforeach
                                <script>
                                    // Get the delete button and attach a click event listener
                                    document.getElementById('deleteSelectedBtn').addEventListener('click', function() {
                                        // Get all the checkboxes
                                        var checkboxes = Array.from(document.querySelectorAll('input[name="audioFiles[]"]:checked'));
                                        // Get an array of IDs of checked checkboxes
                                        var selectedIds = checkboxes.map(function(checkbox) {
                                            return checkbox.value;
                                        });
                                        // If no checkboxes are checked, do nothing
                                        if (selectedIds.length === 0) {
                                            return;
                                        }
                                        // Send a POST request to the server to delete the selected audio files
                                        fetch('{{ route('favorites.deleteSelected') }}', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            body: JSON.stringify({
                                                selectedIds: selectedIds
                                            })
                                        }).then(function() {
                                            // Reload the page after successful deletion
                                            location.reload();
                                        });
                                    });
                                </script>
                            </tbody>
                        </table>
                    </div>
                    <!-- Footer -->
                    <div class="card-footer">
                        <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                            <div class="col-sm mb-2 mb-sm-0">
                                {!! $audioFiles->appends(['per_page' => $per_page, 'dock_name' => request('dock_name'), 'date_range' => request('date_range')])->render() !!} </div>
                        </div>
                        <!-- End Col -->

                        <div class="col-sm-auto">
                            <div class="d-flex justify-content-center justify-content-sm-end">
                                <!-- Pagination -->
                                <nav id="datatablePagination" aria-label="Activity pagination"></nav>
                            </div>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                    {{-- {!! $audioFiles->appends(['per_page' => $per_page])->render() !!} --}}
                </div>


                {{-- <form action="{{ route('inboxstore') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="inputFile">File:</label>
                        <input type="file" name="file" id="inputFile"
                            class="form-control @error('file') is-invalid @enderror" required>

                        @error('file')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>



                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>

                </form> --}}




            </div>
            @foreach ($activeDocks as $dock)
                <!--  Modal mqtt -->
                <div id="sett{{ $dock->id }}" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5> {{ $dock->name }} ({{ $dock->mac }})
                                </h5>


                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="" role="alert" id="notification{{ $dock->id }}"></div>
                                    <div class="success" role="alert" id="response-message{{ $dock->id }}"></div>

                                    <div class="mb-4">
                                        <label for="CallSignLabel" class="form-label"><b>Station/CallSign</b></label>
                                        <!-- Select -->
                                        <div class="row mb-4">
                                            <div class="col-8">

                                                <div class="tom-select-custom">
                                                    <select id="station-select{{ $dock->id }}"
                                                        class="js-select form-select" autocomplete="off"
                                                        data-hs-tom-select-options='{
                                                    "placeholder": "Select user..."
                                                    }'>
                                                        <option value="">{{ $dock->station }} -
                                                            {{ $dock->frequency }}{{ $dock->description }}</option>
                                                        @foreach ($station as $stations)
                                                            <option
                                                                id="station-option-{{ $dock->id }}-{{ $loop->index }}"
                                                                data-station="{{ $stations->station }}"
                                                                data-frequency="{{ $stations->frequency }}">
                                                                {{ $stations->station }} - ({{ $stations->frequency }})
                                                                {{ $stations->description }}
                                                            </option>
                                                        @endforeach
                                                        <option id="new-station-option{{ $dock->id }}"
                                                            value="new-station" data-bs-toggle="modal"
                                                            data-bs-target="#add{{ $dock->id }}"
                                                            style="color: blue; text-decoration: underline;">
                                                            Add new station
                                                        </option>
                                                        <option id="remove-station-option{{ $dock->id }}"
                                                            value="remove-station" data-bs-toggle="modal"
                                                            data-bs-target="#remove{{ $dock->id }}"
                                                            style="color: red; text-decoration: underline;">
                                                            Remove station
                                                        </option>
                                                    </select>

                                                    <script>
                                                        $(document).ready(function() {
                                                            $('#station-select{{ $dock->id }}').on('change', function() {
                                                                var selectedOption = $(this).find('option:selected');
                                                                var station = selectedOption.data('station');
                                                                var frequency = selectedOption.data('frequency');
                                                                var optionId = selectedOption.attr('id');
                                                                var optionIndex = optionId.split('-')[
                                                                    3]; // Extract the index from the option's id attribute

                                                                // Set the values in the modal fields
                                                                $('#station').val(station);
                                                                $('input[name="frequency"]').val(frequency);

                                                                var optionValue = selectedOption.text();
                                                                var description = optionValue.replace(/\(\d+\)\s*/, '').trim();
                                                                var parts = description.split(' - ');
                                                                if (parts.length > 1) {
                                                                    description = parts[1].trim();
                                                                }
                                                                $('#description').val(description);
                                                            });



                                                            // Save changes when the Save button is clicked in the modal
                                                            $('#save-button{{ $dock->id }}').on('click', function() {
                                                                // Retrieve the values from the modal fields
                                                                var station = $('#station').val();
                                                                var frequency = $('input[name="frequency"]').val();
                                                                var description = $('input[name="description"]').val();
                                                                var category = $('#category_id').val();
                                                                var url = '{{ route('stationdockupdate', ['id' => $dock->id]) }}';

                                                                // Perform the AJAX request to update the station
                                                                $.ajax({
                                                                    type: 'PUT',
                                                                    url: url,
                                                                    data: {
                                                                        '_token': '{{ csrf_token() }}',
                                                                        station: station,
                                                                        frequency: frequency,
                                                                        description: description,
                                                                        category_id: category
                                                                    },
                                                                    success: function(response) {
                                                                        console.log(response);
                                                                        $('#message{{ $dock->id }}').html(response.message).addClass(
                                                                            'mb-2');
                                                                    },
                                                                    error: function(error) {
                                                                        console.log(error);
                                                                    }
                                                                });
                                                            });
                                                        });
                                                    </script>

                                                    <script>
                                                        $(document).ready(function() {
                                                            $('#station-select{{ $dock->id }}').on('change', function() {
                                                                var selectedOption = $(this).find('option:selected');
                                                                var station = selectedOption.data('station');
                                                                var frequency = selectedOption.data('frequency');
                                                                var url = '{{ route('stationdockupdate', ['id' => $dock->id]) }}';


                                                                $.ajax({
                                                                    type: 'PUT',
                                                                    url: url,
                                                                    data: {
                                                                        '_token': '{{ csrf_token() }}',
                                                                        station: station,
                                                                        frequency: frequency
                                                                    },
                                                                    success: function(response) {
                                                                        console.log(response);
                                                                        $('#response-message{{ $dock->id }}').html(response.message)
                                                                            .addClass('mb-2');
                                                                        // setTimeout(function() {
                                                                        //     $('#response-message{{ $dock->id }}').html(response.message)
                                                                        //     .addClass('mb-2').fadeOut('fast');
                                                                        // }, 4000);
                                                                    },
                                                                    error: function(error) {
                                                                        console.log(error);
                                                                    }
                                                                });
                                                            });
                                                        });
                                                    </script>

                                                </div>


                                            </div>
                                            <div class="col-4">
                                                <button id="manage-btn{{ $dock->id }}" type="button"
                                                    class="btn btn-primary" data-bs-toggle="modal" data-id=""
                                                    data-bs-target="#manage{{ $dock->id }}">Manage</button>
                                                <button id="add-btn{{ $dock->id }}" style="display: none"
                                                    type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-id="" data-bs-target="#add{{ $dock->id }}">ADD</button>
                                                <button id="remove-btn{{ $dock->id }}" style="display: none"
                                                    type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-id=""
                                                    data-bs-target="#remove{{ $dock->id }}">Remove</button>
                                            </div>

                                            <script>
                                                $(document).ready(function() {
                                                    $('#station-select{{ $dock->id }}').change(function() {
                                                        if ($(this).val() === 'new-station') {

                                                            $('#remove-btn{{ $dock->id }}').hide();
                                                            $('#station-select{{ $dock->id }}').val(
                                                                ''); // Reset the select value to avoid confusion
                                                            $('#sett{{ $dock->id }}').modal('hide');
                                                            $('#remove{{ $dock->id }}').modal('hide');
                                                            $('#add{{ $dock->id }}').modal(
                                                                'show'); // Show the modal window for adding a new station
                                                        } else if ($(this).val() === 'remove-station') {
                                                            // $('#manage-btn{{ $dock->id }}').hide();
                                                            // $('#remove-btn{{ $dock->id }}').show();
                                                            $('#station-select{{ $dock->id }}').val(
                                                                ''); // Reset the select value to avoid confusion
                                                            $('#sett{{ $dock->id }}').modal('hide');
                                                            $('#remove{{ $dock->id }}').modal('show');
                                                            $('#add{{ $dock->id }}').modal('hide');
                                                        } else {
                                                            // $('#manage-btn{{ $dock->id }}').show();
                                                            $('#remove-btn{{ $dock->id }}').hide();
                                                        }
                                                    });

                                                    // Handle the click event of the "Remove" button
                                                    $('#remove-btn{{ $dock->id }}').click(function() {
                                                        var dockId = $(this).data('id');
                                                        // Perform the necessary actions to remove the selected station using the dockId
                                                        // ...
                                                    });
                                                });
                                            </script>

                                        </div>


                                        <h2 class="mb-3">Dock&ZeroWidthSpace;</h2>
                                        <div class="row mb-1">

                                            {{-- speaker  --}}
                                            <div class="col-6">



                                                <!-- <label class="label">Default:</label> -->

                                                <!-- Switch -->
                                                <label class="label mb-2"><b> Speaker </b> </label>
                                                <div class="form-check form-switch form-switch-between mb-6">
                                                    <label class="form-check-label">Off</label>
                                                    <input type="checkbox" class="form-check-input"
                                                        id="speaker-switch{{ $dock->id }}"
                                                        @if ($dock->speaker == 1) checked @endif>
                                                    <label class="form-check-label">On</label>
                                                </div>

                                                <script>
                                                    $(document).ready(function() {
                                                        // First Slider
                                                        $('#speaker-switch{{ $dock->id }}').on('change', function() {
                                                            var message = $(this).prop('checked') ? '1' : '0';
                                                            var topic = '{{ $dock->mac }}/set/spkr_on';
                                                            $.ajax({
                                                                type: 'POST',
                                                                url: '{{ route('mqtt.publish') }}',
                                                                data: {
                                                                    '_token': '{{ csrf_token() }}',
                                                                    'topic': topic,
                                                                    'message': message
                                                                },
                                                                success: function(response) {
                                                                    console.log(response);
                                                                },
                                                                error: function(error) {
                                                                    console.log(error);
                                                                }
                                                            });
                                                            $.ajax({
                                                                type: 'POST',
                                                                url: '{{ route('mqtt.update', ['id' => $dock->id]) }}',
                                                                data: {
                                                                    '_token': '{{ csrf_token() }}',
                                                                    '_method': 'PUT',
                                                                    'speaker': message,

                                                                    // 'notification': message9,
                                                                },
                                                                success: function(response) {
                                                                    console.log(response);
                                                                },
                                                                error: function(error) {
                                                                    console.log(error);
                                                                }
                                                            });
                                                        });

                                                    });
                                                </script>


                                            </div>
                                            {{-- speker vol  --}}
                                            <div class="col-6 ">
                                                <form method="post" action="{{ route('mqtt.publish') }}">
                                                    @csrf
                                                    <label for="message1{{ $dock->id }}"><b> Speaker Volume
                                                        </b></label>
                                                    <input type="hidden" name="message"
                                                        id="message1{{ $dock->id }}" value="0">

                                                    <input type="range" class="me-2" name="slider"
                                                        id="slider1{{ $dock->id }}" min="0" max="100"
                                                        style="width: 50%" value="{{ $dock->setting_speaker_volume }}">

                                                    <input type="hidden" name="topic" id="topic1{{ $dock->id }}"
                                                        value="{{ $dock->mac }}/set/spkr_vol">
                                                    <input id="slider-value1{{ $dock->id }}" class="border border-5"
                                                        type="text" contenteditable="true" min="0"
                                                        max="100" value="{{ $dock->setting_speaker_volume }}"
                                                        style="border: 1px solid #ccc; padding: 1px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;"
                                                        onchange="updateSliderValue{{ $dock->id }}()"
                                                        maxlength="3">
                                                    <script>
                                                        function updateSliderValue{{ $dock->id }}() {
                                                            var slider = document.getElementById("slider-value1{{ $dock->id }}");
                                                            var sliderValue = slider.value.trim(); // Remove leading/trailing white spaces

                                                            // Remove any non-digit characters
                                                            sliderValue = sliderValue.replace(/\D/g, '');

                                                            // Restrict the input to three digits
                                                            if (sliderValue.length > 3) {
                                                                sliderValue = sliderValue.slice(0, 3);
                                                            }

                                                            // Parse the value as an integer
                                                            var numericValue = parseInt(sliderValue);

                                                            // Check if the numeric value is within the valid range
                                                            if (numericValue > 100) {
                                                                numericValue = 100;
                                                                sliderValue = "100"; // Update the displayed value as well
                                                            } else if (numericValue < 0) {
                                                                numericValue = 0;
                                                            }

                                                            // Update the input value
                                                            slider.value = sliderValue;

                                                            // Store the sliderValue in a variable or perform any other desired actions
                                                            console.log(numericValue);

                                                            // Update the value in the database

                                                        }
                                                    </script>


                                                </form>
                                                <script>
                                                    $(document).ready(function() {
                                                        // First Slider
                                                        $('#slider1{{ $dock->id }}').on('change', function() {
                                                            var message = $(this).val();
                                                            var topic = $('#topic1{{ $dock->id }}').val();
                                                            $('#message1{{ $dock->id }}').val(message);
                                                            $('#slider-value1{{ $dock->id }}').val(message);
                                                            $.ajax({
                                                                type: 'POST',
                                                                url: '{{ route('mqtt.publish') }}',
                                                                data: {
                                                                    '_token': '{{ csrf_token() }}',
                                                                    'topic': topic,
                                                                    'message': message
                                                                },
                                                                success: function(response) {
                                                                    console.log(response);
                                                                },
                                                                error: function(error) {
                                                                    console.log(error);
                                                                }
                                                            });
                                                            $.ajax({
                                                                type: 'POST',
                                                                url: '{{ route('mqtt.update', ['id' => $dock->id]) }}',
                                                                data: {
                                                                    '_token': '{{ csrf_token() }}',
                                                                    '_method': 'PUT',
                                                                    'setting_speaker_volume': message,

                                                                    // 'notification': message9,
                                                                },
                                                                success: function(response) {
                                                                    console.log(response);
                                                                },
                                                                error: function(error) {
                                                                    console.log(error);
                                                                }
                                                            });
                                                        });

                                                        // Update slider when span value changes
                                                        $('#slider-value1{{ $dock->id }}').on('input', function() {
                                                            var message = $(this).val();
                                                            var topic = $('#topic1{{ $dock->id }}').val();
                                                            $('#message1{{ $dock->id }}').val(message);
                                                            $('#slider1{{ $dock->id }}').val(message);
                                                            // $.ajax({
                                                            //     type: 'POST',
                                                            //     url: '{{ route('mqtt.publish') }}',
                                                            //     data: {
                                                            //         '_token': '{{ csrf_token() }}',
                                                            //         'topic': topic,
                                                            //         'message': message
                                                            //     },
                                                            //     success: function(response) {
                                                            //         console.log(response);
                                                            //     },
                                                            //     error: function(error) {
                                                            //         console.log(error);
                                                            //     }
                                                            // });
                                                        });
                                                        $('#slider-value1{{ $dock->id }}').on('input', function() {
                                                            var value = parseInt($(this).val());
                                                            var topic = $('#topic1{{ $dock->id }}').val();

                                                            var message = value;
                                                            if (value > 100) {
                                                                message = 100;
                                                            }

                                                            $.ajax({
                                                                type: 'POST',
                                                                url: '{{ route('mqtt.publish') }}',
                                                                data: {
                                                                    '_token': '{{ csrf_token() }}',
                                                                    'topic': topic,
                                                                    'message': message
                                                                },
                                                                success: function(response) {
                                                                    console.log(response);
                                                                },
                                                                error: function(error) {
                                                                    console.log(error);
                                                                }
                                                            });
                                                            $.ajax({
                                                                type: 'POST',
                                                                url: '{{ route('mqtt.update', ['id' => $dock->id]) }}',
                                                                data: {
                                                                    '_token': '{{ csrf_token() }}',
                                                                    '_method': 'PUT',
                                                                    'setting_speaker_volume': message,

                                                                    // 'notification': message9,
                                                                },
                                                                success: function(response) {
                                                                    console.log(response);
                                                                },
                                                                error: function(error) {
                                                                    console.log(error);
                                                                }
                                                            });
                                                        });


                                                    });
                                                </script>
                                            </div>



                                        </div>

                                        <div class="row">
                                            {{-- notification  --}}
                                            <div class="col-6">


                                                <div class="form-group">
                                                    <label class="label mb-2"><b> Notifications </b></label>
                                                    <div class="form-check form-switch form-switch-between mb-6">
                                                        <label class="form-check-label">Off</label>
                                                        <input type="checkbox" class="form-check-input"
                                                            id="notify{{ $dock->id }}"@if ($dock->notification == 1) checked @endif>
                                                        <label class="form-check-label">On</label>
                                                    </div>
                                                    <!-- End Switch -->

                                                    <script>
                                                        $(document).ready(function() {
                                                            // First Slider
                                                            $('#notify{{ $dock->id }}').on('change', function() {
                                                                var message = $(this).prop('checked') ? '1' : '0';
                                                                var topic = '{{ $dock->mac }}/set/notify_on';
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: '{{ route('mqtt.publish') }}',
                                                                    data: {
                                                                        '_token': '{{ csrf_token() }}',
                                                                        'topic': topic,
                                                                        'message': message
                                                                    },
                                                                    success: function(response) {
                                                                        console.log(response);
                                                                    },
                                                                    error: function(error) {
                                                                        console.log(error);
                                                                    }
                                                                });
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: '{{ route('mqtt.update', ['id' => $dock->id]) }}',
                                                                    data: {
                                                                        '_token': '{{ csrf_token() }}',
                                                                        '_method': 'PUT',
                                                                        'notification': message,

                                                                        // 'notification': message9,
                                                                    },
                                                                    success: function(response) {
                                                                        console.log(response);
                                                                    },
                                                                    error: function(error) {
                                                                        console.log(error);
                                                                    }
                                                                });
                                                            });

                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                            {{-- transmit --}}
                                            <div class="col-6">


                                                <div class="form-group">
                                                    <label class="label mb-2"><b> Transmit </b></label>
                                                    <div class="form-check form-switch form-switch-between mb-6">
                                                        <label class="form-check-label">Off</label>
                                                        <input type="checkbox" class="form-check-input"
                                                            id="transmit{{ $dock->id }}"@if ($dock->tx_enabled == 1) checked @endif>
                                                        <label class="form-check-label">On</label>
                                                    </div>
                                                    <!-- End Switch -->

                                                    <script>
                                                        $(document).ready(function() {
                                                            // First Slider
                                                            $('#transmit{{ $dock->id }}').on('change', function() {
                                                                var message = $(this).prop('checked') ? '1' : '0';
                                                                var topic = '{{ $dock->mac }}/set/tx_on';
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: '{{ route('mqtt.publish') }}',
                                                                    data: {
                                                                        '_token': '{{ csrf_token() }}',
                                                                        'topic': topic,
                                                                        'message': message
                                                                    },
                                                                    success: function(response) {
                                                                        console.log(response);
                                                                    },
                                                                    error: function(error) {
                                                                        console.log(error);
                                                                    }
                                                                });
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: '{{ route('mqtt.update', ['id' => $dock->id]) }}',
                                                                    data: {
                                                                        '_token': '{{ csrf_token() }}',
                                                                        '_method': 'PUT',
                                                                        'tx_enabled': message,

                                                                        // 'notification': message9,
                                                                    },
                                                                    success: function(response) {
                                                                        console.log(response);
                                                                    },
                                                                    error: function(error) {
                                                                        console.log(error);
                                                                    }
                                                                });
                                                            });

                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-2">
                                        <!-- row 2 -->
                                        <div class="row">
                                            <h2 class="mb-3">Recorder&ZeroWidthSpace;</h2>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <!-- <label class="label">Default:</label> -->

                                                    <!-- Switch -->
                                                    <label class="label mb-2"><b> Record RX Audio</b> </label>
                                                    <div class="form-check form-switch form-switch-between mb-6">
                                                        <label class="form-check-label">Off</label>
                                                        <input type="checkbox" class="form-check-input"
                                                            id="record_line_in{{ $dock->id }}"
                                                            @if ($dock->record_line_in == 1) checked @endif>
                                                        <label class="form-check-label">On</label>
                                                    </div>
                                                    <script>
                                                        $(document).ready(function() {
                                                            // First Slider
                                                            $('#record_line_in{{ $dock->id }}').on('change', function() {
                                                                var message = $(this).prop('checked') ? '1' : '0';
                                                                var topic = '{{ $dock->mac }}/set/record_line_in';
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: '{{ route('mqtt.publish') }}',
                                                                    data: {
                                                                        '_token': '{{ csrf_token() }}',
                                                                        'topic': topic,
                                                                        'message': message
                                                                    },
                                                                    success: function(response) {
                                                                        console.log(response);
                                                                    },
                                                                    error: function(error) {
                                                                        console.log(error);
                                                                    }
                                                                });
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: '{{ route('mqtt.update', ['id' => $dock->id]) }}',
                                                                    data: {
                                                                        '_token': '{{ csrf_token() }}',
                                                                        '_method': 'PUT',
                                                                        'record_line_in': message,

                                                                        // 'notification': message9,
                                                                    },
                                                                    success: function(response) {
                                                                        console.log(response);
                                                                    },
                                                                    error: function(error) {
                                                                        console.log(error);
                                                                    }
                                                                });
                                                            });

                                                        });
                                                    </script>


                                                </div>


                                            </div>


                                            <div class="col-6">
                                                <div class="form-group">
                                                    <!-- End Select -->
                                                    <label class="label mb-2"><b> Record TX Audio </b></label>
                                                    <div class="form-check form-switch form-switch-between mb-6">
                                                        <label class="form-check-label">Off</label>
                                                        <input type="checkbox" class="form-check-input"
                                                            id="save_ptt_recording{{ $dock->id }}"
                                                            @if ($dock->save_ptt_recording == 1) checked @endif>
                                                        <label class="form-check-label">On</label>
                                                    </div>
                                                    <script>
                                                        $(document).ready(function() {
                                                            // First Slider
                                                            $('#save_ptt_recording{{ $dock->id }}').on('change', function() {
                                                                var message = $(this).prop('checked') ? '1' : '0';
                                                                var topic = '{{ $dock->mac }}/set/save_ptt_recording';
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: '{{ route('mqtt.publish') }}',
                                                                    data: {
                                                                        '_token': '{{ csrf_token() }}',
                                                                        'topic': topic,
                                                                        'message': message
                                                                    },
                                                                    success: function(response) {
                                                                        console.log(response);
                                                                    },
                                                                    error: function(error) {
                                                                        console.log(error);
                                                                    }
                                                                });
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: '{{ route('mqtt.update', ['id' => $dock->id]) }}',
                                                                    data: {
                                                                        '_token': '{{ csrf_token() }}',
                                                                        '_method': 'PUT',
                                                                        'save_ptt_recording': message,

                                                                        // 'notification': message9,
                                                                    },
                                                                    success: function(response) {
                                                                        console.log(response);
                                                                    },
                                                                    error: function(error) {
                                                                        console.log(error);
                                                                    }
                                                                });
                                                            });

                                                        });
                                                    </script>
                                                    <!-- End Switch -->

                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <!-- <label class="label">Default:</label> -->

                                                    <!-- Switch -->
                                                    <label class="label mb-2"><b> Upload RX Audio</b> </label>
                                                    <div class="form-check form-switch form-switch-between mb-6">
                                                        <label class="form-check-label">Off</label>
                                                        <input type="checkbox" class="form-check-input"
                                                            id="upload_line_in{{ $dock->id }}"
                                                            @if ($dock->upload_line_in == 1) checked @endif>
                                                        <label class="form-check-label">On</label>
                                                    </div>
                                                    <script>
                                                        $(document).ready(function() {
                                                            // First Slider
                                                            $('#upload_line_in{{ $dock->id }}').on('change', function() {
                                                                var message = $(this).prop('checked') ? '1' : '0';
                                                                var topic = '{{ $dock->mac }}/set/upload_line_in';
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: '{{ route('mqtt.publish') }}',
                                                                    data: {
                                                                        '_token': '{{ csrf_token() }}',
                                                                        'topic': topic,
                                                                        'message': message
                                                                    },
                                                                    success: function(response) {
                                                                        console.log(response);
                                                                    },
                                                                    error: function(error) {
                                                                        console.log(error);
                                                                    }
                                                                });
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: '{{ route('mqtt.update', ['id' => $dock->id]) }}',
                                                                    data: {
                                                                        '_token': '{{ csrf_token() }}',
                                                                        '_method': 'PUT',
                                                                        'upload_line_in': message,

                                                                        // 'notification': message9,
                                                                    },
                                                                    success: function(response) {
                                                                        console.log(response);
                                                                    },
                                                                    error: function(error) {
                                                                        console.log(error);
                                                                    }
                                                                });
                                                            });

                                                        });
                                                    </script>


                                                </div>


                                            </div>


                                            <div class="col-6">
                                                <div class="form-group">
                                                    <!-- End Select -->
                                                    <label class="label mb-2"><b> Upload TX Audio </b></label>
                                                    <div class="form-check form-switch form-switch-between mb-6">
                                                        <label class="form-check-label">Off</label>
                                                        <input type="checkbox" class="form-check-input"
                                                            id="upload_ptt_recording{{ $dock->id }}"
                                                            @if ($dock->upload_ptt_recording == 1) checked @endif>
                                                        <label class="form-check-label">On</label>
                                                    </div>
                                                    <script>
                                                        $(document).ready(function() {
                                                            // First Slider
                                                            $('#upload_ptt_recording{{ $dock->id }}').on('change', function() {
                                                                var message = $(this).prop('checked') ? '1' : '0';
                                                                var topic = '{{ $dock->mac }}/set/upload_ptt_recording';
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: '{{ route('mqtt.publish') }}',
                                                                    data: {
                                                                        '_token': '{{ csrf_token() }}',
                                                                        'topic': topic,
                                                                        'message': message
                                                                    },
                                                                    success: function(response) {
                                                                        console.log(response);
                                                                    },
                                                                    error: function(error) {
                                                                        console.log(error);
                                                                    }
                                                                });
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: '{{ route('mqtt.update', ['id' => $dock->id]) }}',
                                                                    data: {
                                                                        '_token': '{{ csrf_token() }}',
                                                                        '_method': 'PUT',
                                                                        'upload_ptt_recording': message,

                                                                        // 'notification': message9,
                                                                    },
                                                                    success: function(response) {
                                                                        console.log(response);
                                                                    },
                                                                    error: function(error) {
                                                                        console.log(error);
                                                                    }
                                                                });
                                                            });

                                                        });
                                                    </script>
                                                    <!-- End Switch -->

                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-6">
                                                <div class="form-group">

                                                    <form method="post" action="{{ route('mqtt.publish') }}">
                                                        @csrf
                                                        <label class="mx-2" for="message12{{ $dock->id }}"><b>
                                                                Gain
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                                                        <input type="hidden" name="message"
                                                            id="message12{{ $dock->id }}"
                                                            value="{{ $dock->line_in_gain }}">
                                                        {{-- <input type="range" class="me-2" name="slider"
                                                            id="slider12{{ $dock->id }}" min="0" max="100"
                                                            value="{{ $dock->line_in_gain }}"> --}}
                                                        <select class="form-select" style="width: 60%" name="select"
                                                            id="gain12{{ $dock->id }}">
                                                            @foreach ([-1, 0, 3, 6, 9, 12, 15, 18, 21, 24] as $value)
                                                                <option value="{{ $value }}"
                                                                    {{ $dock->line_in_gain == $value ? 'selected' : '' }}>
                                                                    {{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" name="topic"
                                                            id="topicgain{{ $dock->id }}"
                                                            value="{{ $dock->mac }}/set/line_in_gain">
                                                        {{-- <span id="slider-value12{{ $dock->id }}" class="border border-5"
                                                            contenteditable="true"
                                                            style="border: 1px solid #ccc; padding: 2px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">{{ $dock->line_in_gain }}</span> --}}
                                                    </form>
                                                    <script>
                                                        $(document).ready(function() {
                                                            // First Slider
                                                            $('#gain12{{ $dock->id }}').on('change', function() {
                                                                var message = $('#gain12{{ $dock->id }}').val();
                                                                var topic = $('#topicgain{{ $dock->id }}').val();
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: '{{ route('mqtt.publish') }}',
                                                                    data: {
                                                                        '_token': '{{ csrf_token() }}',
                                                                        'topic': topic,
                                                                        'message': message
                                                                    },
                                                                    success: function(response) {
                                                                        console.log(response);
                                                                    },
                                                                    error: function(error) {
                                                                        console.log(error);
                                                                    }
                                                                });
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: '{{ route('mqtt.update', ['id' => $dock->id]) }}',
                                                                    data: {
                                                                        '_token': '{{ csrf_token() }}',
                                                                        '_method': 'PUT',
                                                                        'line_in_gain': message,

                                                                        // 'notification': message9,
                                                                    },
                                                                    success: function(response) {
                                                                        console.log(response);
                                                                    },
                                                                    error: function(error) {
                                                                        console.log(error);
                                                                    }
                                                                });
                                                            });

                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="col-6 ">
                                                <form method="post" action="{{ route('mqtt.publish') }}">
                                                    @csrf
                                                    <label for="message1{{ $dock->id }}"><b>Recorder
                                                            Senstivity</b></label>
                                                    <input type="hidden" name="message"
                                                        id="recordermessage1{{ $dock->id }}" value="0">

                                                    <input type="range" class="my-3" name="slider"
                                                        id="recorderslider1{{ $dock->id }}" min="0"
                                                        max="100" style="width: 50%"
                                                        value="{{ $dock->line_in_min_db }}">

                                                    <input type="hidden" name="topic"
                                                        id="recordertopic1{{ $dock->id }}"
                                                        value="{{ $dock->mac }}/set/line_min_db">
                                                    <input id="recorderslider-value1{{ $dock->id }}"
                                                        class="border border-5" contenteditable="true"
                                                        value="{{ $dock->line_in_min_db }}" type="text"
                                                        style="border: 1px solid #ccc; padding: 1px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;"
                                                        onchange="updateSliderValue{{ $dock->id }}_1()"
                                                        maxlength="3">

                                                    <script>
                                                        function updateSliderValue{{ $dock->id }}_1() {
                                                            var slider = document.getElementById("recorderslider-value1{{ $dock->id }}");
                                                            var sliderValue = slider.value.trim(); // Remove leading/trailing white spaces

                                                            // Remove any non-digit characters
                                                            sliderValue = sliderValue.replace(/\D/g, '');

                                                            // Restrict the input to three digits
                                                            if (sliderValue.length > 3) {
                                                                sliderValue = sliderValue.slice(0, 3);
                                                            }

                                                            // Parse the value as an integer
                                                            var numericValue = parseInt(sliderValue);

                                                            // Check if the numeric value is within the valid range
                                                            if (numericValue > 100) {
                                                                numericValue = 100;
                                                            } else if (numericValue < 0) {
                                                                numericValue = 0;
                                                            }

                                                            // Update the input value
                                                            slider.value = numericValue;

                                                            // Store the sliderValue in a variable or perform any other desired actions
                                                            console.log(numericValue);
                                                        }
                                                    </script>

                                                </form>
                                                <script>
                                                    $(document).ready(function() {
                                                        // First Slider
                                                        $('#recorderslider1{{ $dock->id }}').on('change', function() {
                                                            var message = $(this).val();
                                                            var topic = $('#recordertopic1{{ $dock->id }}').val();
                                                            $('#recordermessage1{{ $dock->id }}').val(message);
                                                            $('#recorderslider-value1{{ $dock->id }}').val(message);
                                                            $.ajax({
                                                                type: 'POST',
                                                                url: '{{ route('mqtt.publish') }}',
                                                                data: {
                                                                    '_token': '{{ csrf_token() }}',
                                                                    'topic': topic,
                                                                    'message': message
                                                                },
                                                                success: function(response) {
                                                                    console.log(response);
                                                                },
                                                                error: function(error) {
                                                                    console.log(error);
                                                                }
                                                            });
                                                            $.ajax({
                                                                type: 'POST',
                                                                url: '{{ route('mqtt.update', ['id' => $dock->id]) }}',
                                                                data: {
                                                                    '_token': '{{ csrf_token() }}',
                                                                    '_method': 'PUT',
                                                                    'line_in_min_db': message,

                                                                    // 'notification': message9,
                                                                },
                                                                success: function(response) {
                                                                    console.log(response);
                                                                },
                                                                error: function(error) {
                                                                    console.log(error);
                                                                }
                                                            });
                                                        });

                                                        // Update slider when span value changes
                                                        // Update slider when span value changes
                                                        $('#recorderslider-value1{{ $dock->id }}').on('input', function() {
                                                            var message = $(this).val();
                                                            var topic = $('#topic1{{ $dock->id }}').val();
                                                            $('#recordermessage1{{ $dock->id }}').val(message);
                                                            $('#recorderslider1{{ $dock->id }}').val(message);
                                                            // $.ajax({
                                                            //     type: 'POST',
                                                            //     url: '{{ route('mqtt.publish') }}',
                                                            //     data: {
                                                            //         '_token': '{{ csrf_token() }}',
                                                            //         'topic': topic,
                                                            //         'message': message
                                                            //     },
                                                            //     success: function(response) {
                                                            //         console.log(response);
                                                            //     },
                                                            //     error: function(error) {
                                                            //         console.log(error);
                                                            //     }
                                                            // });
                                                        });
                                                        $('#recorderslider-value1{{ $dock->id }}').on('input', function() {
                                                            var value = parseInt($(this).val());
                                                            var topic = $('#topic1{{ $dock->id }}').val();

                                                            var message = value;
                                                            if (value > 100) {
                                                                message = 100;
                                                            }

                                                            $.ajax({
                                                                type: 'POST',
                                                                url: '{{ route('mqtt.publish') }}',
                                                                data: {
                                                                    '_token': '{{ csrf_token() }}',
                                                                    'topic': topic,
                                                                    'message': message
                                                                },
                                                                success: function(response) {
                                                                    console.log(response);
                                                                },
                                                                error: function(error) {
                                                                    console.log(error);
                                                                }
                                                            });
                                                            $.ajax({
                                                                type: 'POST',
                                                                url: '{{ route('mqtt.update', ['id' => $dock->id]) }}',
                                                                data: {
                                                                    '_token': '{{ csrf_token() }}',
                                                                    '_method': 'PUT',
                                                                    'setting_speaker_volume': message,

                                                                    // 'notification': message9,
                                                                },
                                                                success: function(response) {
                                                                    console.log(response);
                                                                },
                                                                error: function(error) {
                                                                    console.log(error);
                                                                }
                                                            });
                                                        });

                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <hr class="my-2">

                                        {{-- button start --}}
                                        <div class="row mb-4 gx-3">
                                            <div class="col-sm mb-2 mb-sm-0">
                                                <div class="d-grid">
                                                    <button class="btn btn-info mx-2 bi bi-window-dock"
                                                        id="beep-button{{ $dock->id }}">&nbsp; Identify</button>
                                                </div>
                                            </div>
                                            <script>
                                                // beep
                                                $('#beep-button{{ $dock->id }}').on('click', function() {
                                                    $(this).prop('disabled', true);
                                                    setTimeout(function() {
                                                        $('#beep-button{{ $dock->id }}').prop('disabled', false);
                                                    }, 5000);
                                                    setTimeout(function() {
                                                        $('#notification{{ $dock->id }}').text('Signal is sent.')
                                                            .removeClass('alert-info').addClass('alert-success').addClass('d-flex');
                                                    }, 5000);

                                                    $('#notification{{ $dock->id }}').text(
                                                        'Identifying Signals Is sending, please wait...').addClass('d-flex').addClass(
                                                        'alert alert-info').append(
                                                        '<div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>');
                                                    var topic = '{{ $dock->mac }}/set/beep';
                                                    var message = '5';

                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '{{ route('mqtt.publish') }}',
                                                        data: {
                                                            '_token': '{{ csrf_token() }}',
                                                            'topic': topic,
                                                            'message': message
                                                        },
                                                        success: function(response) {
                                                            console.log(response);
                                                        },
                                                        error: function(error) {
                                                            console.log(error);
                                                        }
                                                    });
                                                });
                                            </script>
                                            <!-- End Col -->




                                            <div class="col-sm">
                                                <div class="d-grid">
                                                    <button class="btn btn-secondary mx-2"
                                                        id="more_setting_btn{{ $dock->id }}"data-bs-toggle="modal"
                                                        data-id="" data-bs-target="#more_sett{{ $dock->id }}"><i
                                                            class="fa-solid fa-floppy-disk"></i> &nbsp; More
                                                        Settings</button>
                                                </div>
                                            </div>
                                            <!-- End Col -->
                                        </div>
                                        {{-- button end --}}
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- remove  --}}
                <!-- Modal for managing stations -->
                <div class="modal fade" id="remove{{ $dock->id }}" tabindex="-1"
                    aria-labelledby="manageModal{{ $dock->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="manageModal{{ $dock->id }}">Manage Stations</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <label>
                                                    <input type="checkbox" id="select-all-stations{{ $dock->id }}">
                                                </label>
                                            </th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <!-- Add more table headers if needed -->
                                        </tr>
                                    </thead>
                                    <tbody id="station-list{{ $dock->id }}">
                                        @foreach ($station as $stations)
                                            <tr>
                                                <td>
                                                    <label>
                                                        <input type="checkbox" class="station-checkbox"
                                                            value="{{ $stations->id }}">
                                                    </label>
                                                </td>
                                                <td>{{ $stations->station }}</td>
                                                <td>{{ $stations->description }}</td>
                                                <!-- Add more table cells if needed -->
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>




                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#sett{{ $dock->id }}">Close</button>
                                <button id="delete-stations-btn{{ $dock->id }}" type="button"
                                    class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        // Handle the click event of the "Select All" checkbox
                        $('#select-all-stations{{ $dock->id }}').click(function() {
                            var isChecked = $(this).prop('checked');
                            $('.station-checkbox').prop('checked', isChecked);
                        });

                        // Handle the click event of the "Delete" button within the modal
                        $('#delete-stations-btn{{ $dock->id }}').click(function() {
                            var selectedStations = []; // Array to store the selected station IDs

                            // Find all the checked station checkboxes within the modal
                            $('#station-list{{ $dock->id }} .station-checkbox:checked').each(function() {
                                selectedStations.push($(this).val()); // Add the station ID to the array
                            });

                            if (selectedStations.length === 0) {
                                alert('Please select at least one station to delete.');
                                return;
                            }

                            // Perform the AJAX request to delete the selected stations
                            $.ajax({
                                type: 'POST',
                                url: '{{ route('station.delete') }}',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                data: {
                                    stationIds: selectedStations
                                },
                                success: function(response) {
                                    // Handle the success response
                                    console.log(response);
                                    location.reload();
                                },
                                error: function(error) {
                                    console.log(error);
                                }
                            });
                        });
                    });
                </script>

                {{-- end remove --}}

                {{-- manage  --}}
                <div id="manage{{ $dock->id }}" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">


                                <h4>Edit Station</h4>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#sett{{ $dock->id }}"
                                    class="btn btn-outline-dark">Back</button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <form id="station-form{{ $dock->id }}" method="POST">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label for="CallSignLabel" class="form-label ">Station/CallSign:</label>
                                                <!-- Select -->


                                                <div class="col">
                                                    <input type="text" class="form-control mb-2" name="station"
                                                         placeholder="callsign" aria-label="callsign" id="{{ old('station', $dock->station) }}"
                                                        value="{{ old('station', $dock->station) }}">
                                                    {{-- <button class="btn btn-secondary mx-2" id="save-button4286"><i
                                                        class="fa-solid fa-check"></i> &nbsp; Check </button> --}}
                                                </div>

                                            </div>


                                            <div class="col-6">

                                                <label for="FrequencyLabel" class="col form-label">Category</label>
                                                <!-- Dropdown -->
                                                <div class="tom-select-custom">
                                                    <select name="category_id"  
                                                        class="js-select form-select" autocomplete="off"
                                                        data-dashlane-rid="83946aedd25e1b6c" data-form-type="other">
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>



                                                <!-- End Dropdown -->



                                            </div>
                                        </div>
                                        {{-- frequency strat --}}
                                        <div class="row mb-3">
                                            <label for="Category"
                                                class="col-sm-3 col-form-label form-label">Frequency</label>

                                            <div class="col">
                                                <div class="input-group input-group-sm-vertical">
                                                   
                                                    <input type="float" class="form-control" name="frequency"
                                                        placeholder="Frequency" aria-label=""
                                                        value="{{ old('frequency', $dock->frequency) }}">


                                                    <!-- Form Check -->
                                                    <div class="form-check form-check-inline mx-2  mt-2">

                                                        <input type="hidden" name="rx_enabled" value="0">
                                                        <input type="checkbox" class="form-check-input" name="rx_enabled"
                                                            value="1" {{ $dock->rx_enabled == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="formInlineCheckReceived">Rx</label>

                                                        <div class="form-check form-check-inline ms-5"
                                                            style="margin-right: 50px">

                                                            <input type="hidden" name="tx_enabled" value="0">
                                                            <input type="checkbox" name="tx_enabled" value="1"
                                                                class="form-check-input"
                                                                {{ $dock->tx_enabled == 1 ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="formInlineCheckTransmit">Tx</label>
                                                        </div>


                                                    </div>
                                                    <!-- End Form Check -->



                                                </div>
                                                <!-- End Dropdown -->

                                            </div>




                                        </div>
                                        {{-- frequency end --}}
                                        {{-- description start --}}
                                        <div class="row mb-3">
                                            <label for="DescriptionLabel"
                                                class="col-sm-3 col-form-label form-label">Description</label>

                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="description"
                                                    id="description{{ old('station', $dock->station) }}" placeholder="Description" aria-label="Description"
                                                    value="">
                                            </div>
                                        </div>
                                        {{-- description end --}}
                                        {{-- save button start --}}
                                        <div class="col-sm mb-2 mb-sm-0">
                                            <div class="d-grid">

                                                <button class="btn btn-success mx-2" type="button"
                                                    id="save-button{{ $dock->id }}">
                                                    <i class="fa-solid fa-floppy-disk"></i> &nbsp; Save
                                                </button>
                                            </div>
                                        </div>

                                        {{-- save button 2 end --}}
                                    </form>
                                    <div id="message{{ $dock->id }}"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        // ...

                        // Handle the click event of the "Delete" button within the modal
                        $('#delete-stations-btn{{ $dock->id }}').click(function() {
                            var selectedStations = []; // Array to store the selected station IDs

                            // Find all the checked station checkboxes within the modal
                            $('#station-list{{ $dock->id }} input[type="checkbox"]:checked').each(function() {
                                selectedStations.push($(this).val()); // Add the station ID to the array
                            });

                            if (selectedStations.length === 0) {
                                alert('Please select at least one station to delete.');
                                return;
                            }

                            // Perform the AJAX request to delete the selected stations
                            $.ajax({
                                type: 'POST',
                                url: '{{ route('station.delete') }}',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                data: {
                                    stationIds: selectedStations
                                },
                                success: function(response) {
                                    // Handle the success response
                                    console.log(response);
                                },
                                error: function(error) {
                                    console.log(error);
                                }
                            });
                        });
                    });
                </script>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


                <script>
                    $(function() {
                        $('#save-button{{ $dock->id }}').click(function() {
                            var form = $('#station-form{{ $dock->id }}');

                            $.ajax({
                                type: 'POST',
                                url: '{{ route('station.store') }}',
                                data: form.serialize(),
                                success: function(response) {
                                    $('#message{{ $dock->id }}').html('Station Updaated successfully')
                                        .removeClass('error').addClass('success');
                                    form.trigger('reset');
                                },
                                error: function(response) {
                                    var errors = response.responseJSON.errors;
                                    var errorMessage = '';
                                    for (var key in errors) {
                                        errorMessage += '<p>' + errors[key][0] + '</p>';
                                    }
                                    $('#message{{ $dock->id }}').html(errorMessage).removeClass(
                                        'success').addClass('error');
                                }
                            });
                            $.ajax({
                                type: 'PUT',
                                url: '{{ route('stationdockupdate', ['id' => $dock->id]) }}',
                                data: form.serialize(),
                                success: function(response) {
                                    $('#message{{ $dock->id }}').html('Dock Updated successfully')
                                        .removeClass('error').addClass('success');
                                    form.trigger('reset');
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000); // 1000 milliseconds = 1 second
                                },
                                error: function(response) {
                                    var errors = response.responseJSON.errors;
                                    var errorMessage = '';
                                    for (var key in errors) {
                                        errorMessage += '<p>' + errors[key][0] + '</p>';
                                    }
                                    $('#message{{ $dock->id }}').html(errorMessage).removeClass(
                                        'success').addClass('error');
                                }
                            });
                        });
                    });
                </script>
                {{-- end manage  --}}
                {{-- add station  --}}
                <div id="add{{ $dock->id }}" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4> Add New Station</h4>



                                <button type="button" data-bs-toggle="modal" data-bs-target="#sett{{ $dock->id }}"
                                    class="btn btn-outline-dark">Back</button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <form id="station-form-add{{ $dock->id }}" method="POST">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="CallSignLabel" class="form-label">Station/CallSign:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control mb-2" name="station"
                                                        id="station{{ $dock->id }}" placeholder="callsign"
                                                        aria-label="callsign" value="">
                                                    <div class="loader-container">
                                                        <button type="button" class="btn btn-secondary mx-2"
                                                            id="check-button{{ $dock->id }}"><i
                                                                class="fa-solid fa-magnifying-glass"></i> &nbsp;
                                                            Check</button>
                                                        <div id="loader{{ $dock->id }}" class="loader"></div>
                                                    </div>
                                                </div>
                                                @error('station')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col">
                                                <label for="FrequencyLabel" class="col form-label">Category</label>
                                                <div class="tom-select-custom">
                                                    <select name="category_id" {{--id="category_id_{{ $category->id }}"--}} 
                                                        class="js-select form-select" autocomplete="off"
                                                        data-dashlane-rid="83946aedd25e1b6c" data-form-type="other">
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('{{ $category->id }}')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- frequency start --}}
                                        <div class="row mb-3">
                                            <label for="Category"
                                                class="col-sm-3 col-form-label form-label">Frequency:</label>
                                            <div class="col">
                                                <div class="input-group input-group-sm-vertical">
                                                    <input type="float" class="form-control" name="frequency"
                                                        placeholder="Frequency" aria-label="" value="">
                                                    <div class="form-check form-check-inline mx-2 mt-2">
                                                        <input type="hidden" name="rx_enabled" value="0">
                                                        <input type="checkbox" class="form-check-input" name="rx_enabled"
                                                            value="1">
                                                        <label class="form-check-label"
                                                            for="formInlineCheckReceived">Rx</label>
                                                        <div class="form-check form-check-inline ms-5"
                                                            style="margin-right: 50px">
                                                            <input type="hidden" name="tx_enabled" value="0">
                                                            <input type="checkbox" name="tx_enabled" value="1"
                                                                class="form-check-input"
                                                                {{ $dock->tx_enabled == 1 ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="formInlineCheckTransmit">Tx</label>
                                                        </div>
                                                    </div>
                                                    @error('frequency')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        {{-- frequency end --}}
                                        {{-- description start --}}
                                        <div class="row mb-3">
                                            <label for="DescriptionLabel"
                                                class="col-sm-3 col-form-label form-label">Description</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"
                                                    id="description{{ $dock->id }}" name="description"
                                                    placeholder="Description" aria-label="Description" value="">
                                                @error('description')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- description end --}}
                                        {{-- save button start --}}
                                        <div class="col-sm mb-2 mb-sm-0">
                                            <div class="d-grid">
                                                <button class="btn btn-success mx-2" type="button"
                                                    id="save-button-add{{ $dock->id }}"><i
                                                        class="fa-solid fa-floppy-disk"></i> &nbsp; Save</button>
                                            </div>
                                        </div>
                                        {{-- save button 2 end --}}
                                        <div id="error-message-add{{ $dock->id }}"></div>
                                        <div id="message_add{{ $dock->id }}"></div>
                                    </form>
                                    <div id="error-message-add{{ $dock->id }}" class="alert alert-danger"
                                        style="display: none;"></div>
                                    <div id="error-message-add1{{ $dock->id }}" class="alert alert-danger"
                                        style="display: none;"></div>



                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#check-button{{ $dock->id }}').click(function() {
                            var searchValue = $('#station{{ $dock->id }}').val();
                            var loader = $('#loader{{ $dock->id }}');

                            // Show the loader
                            loader.show();

                            $.ajax({
                                type: 'GET',
                                url: '/fcccheck',
                                data: {
                                    'searchValue': searchValue
                                },
                                success: function(response) {
                                    console.log(response);
                                    var description = response.Licenses.License[0].licName;
                                    $('#description{{ $dock->id }}').val(description);

                                    // Hide the loader
                                    loader.hide();
                                },
                                error: function() {
                                    // Handle error

                                    // Hide the loader
                                    loader.hide();
                                }
                            });
                        });
                    });
                </script>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(function() {
                        $('#save-button-add{{ $dock->id }}').click(function() {
                            var form = $('#station-form-add{{ $dock->id }}');
                            var errorDiv = $('#error-message-add{{ $dock->id }}');
                            var errorDiv1 = $('#error-message-add1{{ $dock->id }}');

                            $.ajax({
                                type: 'POST',
                                url: '{{ route('station.store') }}',
                                data: form.serialize(),
                                success: function(response) {
                                    $('#message_add{{ $dock->id }}').html(
                                            'Station updated successfully')
                                        .removeClass('error').addClass('success');
                                    form.trigger('reset');
                                    errorDiv.hide(); // Hide the error message

                                },
                                error: function(response) {
                                    console.log(response);
                                    var errors = response.responseJSON.errors;
                                    var errorMessage = '<ul>'; // Start an unordered list
                                    for (var key in errors) {
                                        errorMessage += '<li>' + errors[key] +
                                            '</li>'; // Wrap each error message in a list item
                                    }
                                    errorMessage += '</ul>'; // Close the unordered list
                                    errorDiv.html(errorMessage).show();
                                    errorDiv.removeClass('success').addClass('error');
                                }
                            });

                            $.ajax({
                                type: 'PUT',
                                url: '{{ route('stationdockupdate', ['id' => $dock->id]) }}',
                                data: form.serialize(),
                                success: function(response) {
                                    $('#message_add{{ $dock->id }}').html('Dock updated successfully')
                                        .removeClass('error').addClass('success');
                                    form.trigger('reset');
                                    errorDiv1.hide(); // Hide the error message
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000); // 1000 milliseconds = 1 second
                                },
                                error: function(response) {
                                    console.log(response);

                                }
                            });
                        });
                    });
                </script>


                {{-- end add station  --}}

                {{-- more settings strat --}}
                <div id="more_sett{{ $dock->id }}" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    {{ $dock->name }} ({{ $dock->mac }})</h5>
                                <button type="button" data-bs-toggle="modal" data-id="{{ $dock->id }}"
                                    data-bs-target="#sett{{ $dock->id }}" class="btn btn-outline-dark">Back</button>
                            </div>
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="" role="alert" id="notification_more_sett{{ $dock->id }}">
                                    </div>
                                    <form method="POST" action="{{ route('mydocks.update', $dock->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <!-- Form -->

                                        <div class="row mb-sm-2">
                                            <div class="col-6">
                                                <div class="row mb-3">
                                                    <label for="firstNameLabel"
                                                        class="col-4 col-form-label form-label">Dock
                                                        Name</label>

                                                    <div class="col-8">
                                                        <div class="input-group input-group-sm-vertical">
                                                            <input type="text" class="form-control"
                                                                id="dock_name{{ $dock->id }}" name="name"
                                                                placeholder="Name" aria-label="FirstName"
                                                                value="{{ old('name', $dock->name) }}" required>

                                                            {{-- <input type="text" class="form-control" name="lastName" id="lastNameLabel" placeholder="Last Name" aria-label="LastName"> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <!-- Form -->
                                                <div class="row mb-2">
                                                    <label class="col-sm-3 col-form-label form-label">Location</label>

                                                    <div class="col-sm-9">
                                                        <div class="input-group input-group-sm-vertical">
                                                            <!--  Check -->
                                                            <div class="row">


                                                                <div class="col-6">
                                                                    <input type="number" class="form-control"
                                                                        name="lon" id="dock_lon{{ $dock->id }}"
                                                                        placeholder="Longitude" aria-label="Longitude"
                                                                        value="{{ old('lon', $dock->lon) }}">
                                                                </div>
                                                                <div class="col-6">
                                                                    <input type="number" class="form-control"
                                                                        name="lat" id="dock_lat{{ $dock->id }}"
                                                                        placeholder="Latitude" aria-label="Latitude"
                                                                        value="{{ old('lat', $dock->lat) }}">
                                                                </div>
                                                            </div>
                                                            <!-- End  Check -->


                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- End Form -->
                                            </div>
                                        </div>
                                        <!-- End Form -->

                                        <!-- Form -->

                                        <div class="row mb-4">
                                            <label for="AddressLabel"
                                                class="col-sm-2 col-form-label form-label">Address</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"
                                                    id="dock_address{{ $dock->id }}" name="address"
                                                    placeholder="Address" aria-label="Address"
                                                    value="{{ old('address', $dock->address) }}">
                                            </div>
                                        </div>
                                        <!-- End Form -->


                                        {{-- City state zip in row start --}}

                                        <div class="row mb-2">
                                            <label for="AddressLabel" class="col-sm-2 col-form-label form-label"></label>
                                            <div class="col-sm-10">
                                                <div class="row mb-3 gx-3">

                                                    <div class="col-sm-4 mb-2 mb-sm-0">
                                                        <div class="d-grid">
                                                            <!-- Form -->
                                                            <div class="row mb-1">
                                                                <label for="CityLabel"
                                                                    class="col-sm-3 col-form-label form-label">City</label>

                                                                <div class="col-sm-9">
                                                                    <div class="input-group input-group-sm-vertical">

                                                                        <input type="text" class="form-control"
                                                                            name="city"
                                                                            id="dock_city{{ $dock->id }}"
                                                                            placeholder="City" aria-label="City"
                                                                            value="{{ old('city', $dock->city) }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Form -->
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4 mb-2 mb-sm-0">
                                                        <div class="d-grid">
                                                            <!-- Form -->
                                                            <div class="row mb-1">
                                                                <label for="StateLabel"
                                                                    class="col-sm-3 col-form-label form-label">State</label>

                                                                <div class="col-sm-9">
                                                                    <div class="input-group input-group-sm-vertical">
                                                                        <!-- Dropdown -->
                                                                        <div class="btn-group">

                                                                            <!-- Select -->
                                                                            <div class="tom-select-custom">
                                                                                <select class="js-select form-select"
                                                                                    autocomplete="on"
                                                                                    id="dock_state{{ $dock->id }}"
                                                                                    data-hs-tom-select-options='{"placeholder": "Select State"}'
                                                                                    value="{{ old('state', $dock->state) }}">
                                                                                    <option value="">Select State
                                                                                    </option>
                                                                                    <?php
                                                                                    $usStates = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'];
                                                                                    
                                                                                    foreach ($usStates as $state) {
                                                                                        $selected = $state === $dock->state ? 'selected' : '';
                                                                                        echo '<option value="' . htmlspecialchars($state) . '" ' . $selected . '>' . htmlspecialchars($state) . '</option>';
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>

                                                                            <!-- End Select -->
                                                                            <!-- End Select -->

                                                                        </div>
                                                                        <!-- End Dropdown -->



                                                                    </div>


                                                                </div>


                                                            </div>
                                                            <!-- End Form -->
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-4">
                                                        <div class="d-grid">
                                                            <div class="row mb-1">
                                                                <label for="ZipLabel"
                                                                    class="col-sm-3 col-form-label form-label">Zip</label>

                                                                <div class="col-sm-9">
                                                                    <div class="input-group input-group-sm-vertical">

                                                                        <input type="number" class="form-control"
                                                                            name="zip"
                                                                            id="dock_zip{{ $dock->id }}"
                                                                            placeholder="Zip" aria-label="Zip"
                                                                            value="{{ old('zip', $dock->zip) }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>


                                            </div>

                                        </div>
                                        {{-- city state zipin a row end --}}



                                        {{-- buttons start --}}


                                        {{-- button end --}}
                                    </form>
                                    {{-- player settins start --}}
                                    <hr class="my-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h2 class="mb-4">Player Settings</h2>

                                            <div class="form-group mb-4">
                                                <style>
                                                    progress {
                                                        width: 100%;
                                                        height: 30px;
                                                    }
                                                </style>

                                                {{-- <label class="label mb-1"><b> Use Custom Volume levels</b> </label>
                                                <div class="form-check form-switch form-switch-between mb-2 mx-5">
                                                    <label class="form-check-label">Off</label>
                                                    <input type="checkbox" class="form-check-input"
                                                        id="custom_level_sound{{ $dock->id }}" checked>
                                                    <label class="form-check-label">On</label>
                                                </div> --}}


                                                <form method="post" action="{{ route('mqtt.publish') }}">
                                                    @csrf
                                                    <label for="message111{{ $dock->id }}" class="pe-4"><b>
                                                            Speaker
                                                        </b></label>
                                                    <input type="hidden" name="message"
                                                        id="message111{{ $dock->id }}"
                                                        value="{{ $dock->setting_speaker_volume }}">
                                                    <input type="range" class="me-2" name="slider"
                                                        id="slider111{{ $dock->id }}" min="0" max="100"
                                                        value="{{ $dock->setting_speaker_volume }}">
                                                    <input type="hidden" name="topic"
                                                        id="topic111{{ $dock->id }}"
                                                        value="{{ $dock->mac }}/set/spkr_vol">
                                                    <input id="slider-value111{{ $dock->id }}"
                                                        class="border border-5" type="text"
                                                        style="border: 1px solid #ccc; padding: 2px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;"
                                                        value="{{ $dock->setting_speaker_volume }}"
                                                        onchange="updateSliderValue{{ $dock->id }}_2()"
                                                        maxlength="3">
                                                    <script>
                                                        function updateSliderValue{{ $dock->id }}_2() {
                                                            var slider = document.getElementById("slider-value111{{ $dock->id }}");
                                                            var sliderValue = slider.value.trim(); // Remove leading/trailing white spaces

                                                            // Remove any non-digit characters
                                                            sliderValue = sliderValue.replace(/\D/g, '');

                                                            // Restrict the input to three digits
                                                            if (sliderValue.length > 3) {
                                                                sliderValue = sliderValue.slice(0, 3);
                                                            }

                                                            // Parse the value as an integer
                                                            var numericValue = parseInt(sliderValue);

                                                            // Check if the numeric value is within the valid range
                                                            if (numericValue > 100) {
                                                                numericValue = 100;
                                                            } else if (numericValue < 0) {
                                                                numericValue = 0;
                                                            }

                                                            // Update the input value
                                                            slider.value = numericValue;

                                                            // Store the sliderValue in a variable or perform any other desired actions
                                                            console.log(numericValue);
                                                        }
                                                    </script>
                                                </form>



                                                <form method="post" action="{{ route('mqtt.publish') }}">
                                                    @csrf
                                                    <label for="message7{{ $dock->id }}" class="pe-4"><b>
                                                            Transmit</b></label>
                                                    <input type="hidden" name="message"
                                                        id="message7{{ $dock->id }}"
                                                        value="{{ $dock->setting_speaker_out }}">
                                                    <input type="range" class="me-2" name="slider"
                                                        id="slider7{{ $dock->id }}" min="0" max="100"
                                                        value="{{ $dock->setting_speaker_out }}">
                                                    <input type="hidden" name="topic" id="topic7{{ $dock->id }}"
                                                        value="{{ $dock->mac }}/set/tx_vol">
                                                    <input id="slider-value7{{ $dock->id }}" type="text"
                                                        class="border border-5" contenteditable="true"
                                                        value="{{ $dock->setting_speaker_out }}"
                                                        style="border: 1px solid #ccc; padding:2px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;"
                                                        onchange="updateSliderValue{{ $dock->id }}_3()"
                                                        maxlength="3">
                                                    <script>
                                                        function updateSliderValue{{ $dock->id }}_3() {
                                                            var slider = document.getElementById("slider-value7{{ $dock->id }}");
                                                            var sliderValue = slider.value.trim(); // Remove leading/trailing white spaces

                                                            // Remove any non-digit characters
                                                            sliderValue = sliderValue.replace(/\D/g, '');

                                                            // Restrict the input to three digits
                                                            if (sliderValue.length > 3) {
                                                                sliderValue = sliderValue.slice(0, 3);
                                                            }

                                                            // Parse the value as an integer
                                                            var numericValue = parseInt(sliderValue);

                                                            // Check if the numeric value is within the valid range
                                                            if (numericValue > 100) {
                                                                numericValue = 100;
                                                            } else if (numericValue < 0) {
                                                                numericValue = 0;
                                                            }

                                                            // Update the input value
                                                            slider.value = numericValue;

                                                            // Store the sliderValue in a variable or perform any other desired actions
                                                            console.log(numericValue);
                                                        }
                                                    </script>
                                                </form>

                                                <form method="post" action="{{ route('mqtt.publish') }}">
                                                    @csrf
                                                    <label for="message17{{ $dock->id }}" class="pe"><b>
                                                            Notification &nbsp;</b></label>
                                                    <input type="hidden" name="message"
                                                        id="message17{{ $dock->id }}"
                                                        value="{{ $dock->playback_vol }}">
                                                    <input type="range" class="me-2" name="slider"
                                                        id="slider17{{ $dock->id }}" min="0" max="100"
                                                        value="{{ $dock->playback_vol }}">
                                                    <input type="hidden" name="topic"
                                                        id="topic17{{ $dock->id }}"
                                                        value="{{ $dock->mac }}/set/playback_vol">
                                                    <input type="text" id="slider-value17{{ $dock->id }}"
                                                        class="border border-5" contenteditable="true"
                                                        value="{{ $dock->playback_vol }}"
                                                        style="border: 1px solid #ccc; padding: 2px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;"
                                                        onchange="updateSliderValue{{ $dock->mac }}_4()"
                                                        maxlength="3">

                                                    <script>
                                                        function updateSliderValue{{ $dock->mac }}_4() {
                                                            var slider = document.getElementById("slider-value17{{ $dock->id }}");
                                                            var sliderValue = slider.value.trim(); // Remove leading/trailing white spaces

                                                            // Remove any non-digit characters
                                                            sliderValue = sliderValue.replace(/\D/g, '');

                                                            // Restrict the input to three digits
                                                            if (sliderValue.length > 3) {
                                                                sliderValue = sliderValue.slice(0, 3);
                                                            }

                                                            // Parse the value as an integer
                                                            var numericValue = parseInt(sliderValue);

                                                            // Check if the numeric value is within the valid range
                                                            if (numericValue > 100) {
                                                                numericValue = 100;
                                                            } else if (numericValue < 0) {
                                                                numericValue = 0;
                                                            }

                                                            // Update the input value
                                                            slider.value = numericValue;

                                                            // Store the sliderValue in a variable or perform any other desired actions
                                                            console.log(numericValue);
                                                        }
                                                    </script>
                                                </form>

                                                {{-- <button id="save-button{{ $dock->id }}"> Save</button> --}}
                                            </div>
                                            {{-- <div class="form-group">
                                                <!-- <label class="label">Default:</label> -->
        
                                                <!-- Switch -->
                                              
                                                <label class="label mb-1"><b> Notifications </b></label>
                                                <div class="form-check form-switch form-switch-between mb-2">
                                                    <label class="form-check-label">Off</label>
                                                    <input type="checkbox" class="form-check-input"
                                                        id="notify{{ $dock->id }}"@if ($dock->notification == 1) checked @endif>
                                                    <label class="form-check-label">On</label>
                                                </div>
                                                <!-- End Switch -->
                                            </div> --}}

                                        </div>
                                        <div class="col-md-6">
                                            <h2 class="mb-4">Recorder Settings</h2>

                                            {{-- <form method="post" action="{{ route('mqtt.publish') }}">
                                                @csrf
                                                <label for="message2{{ $dock->id }}"><b> Trigger Recording
        
                                                    </b></label>
                                                <input type="hidden" name="message" id="message2{{ $dock->id }}"
                                                    value="{{ $dock->auto_rec_sound_lv }}">
                                                <input type="range" class="me-2" name="slider"
                                                    id="slider2{{ $dock->id }}" min="1" max="10"
                                                     value="{{ $dock->auto_rec_sound_lv }}">
                                                <input type="hidden" name="topic" id="topic2{{ $dock->id }}"
                                                    value="{{ $dock->mac }}/set/line_min_db">
                                                <span id="slider-value2{{ $dock->id }}"class="border border-5"
                                                    contenteditable="true"
                                                    style="border: 1px solid #ccc; padding: 2px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">{{ $dock->auto_rec_sound_lv }}</span>
                                            </form>
                                            <br> --}}

                                            <form method="post" action="{{ route('mqtt.publish') }}">
                                                @csrf
                                                <label for="message3{{ $dock->id }}"><b> Minimum Size
                                                        (sec)
                                                    </b></label>
                                                <input type="hidden" name="message"
                                                    id="message3{{ $dock->id }}"
                                                    value="{{ $dock->setting_min_recording }}">
                                                <input type="range" class="me-1" name="slider"
                                                    id="slider3{{ $dock->id }}" min="0" max="30000"
                                                    value="{{ $dock->setting_min_recording }}">
                                                <input type="hidden" name="topic" id="topic3{{ $dock->id }}"
                                                    value="{{ $dock->mac }}/set/min_rec_sec">
                                                <input type="text" id="slider-value3{{ $dock->id }}"
                                                    class="border border-5" contenteditable="true"
                                                    value="{{ number_format($dock->setting_min_recording / 1000, 1) }}"
                                                    style="border: 1px solid #ccc; padding: 2px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;"
                                                    onchange="updateSliderValue{{ $dock->id }}_5()"
                                                    maxlength="3">

                                                <script>
                                                    function updateSliderValue{{ $dock->id }}_5() {
                                                        var slider = document.getElementById("slider-value3{{ $dock->id }}");
                                                        var sliderValue = slider.value.trim(); // Remove leading/trailing white spaces

                                                        // Remove any non-digit characters
                                                        sliderValue = sliderValue.replace(/\D/g, '');

                                                        // Restrict the input to three digits
                                                        if (sliderValue.length > 2) {
                                                            sliderValue = sliderValue.slice(0, 2);
                                                        }

                                                        // Parse the value as an integer
                                                        var numericValue = parseInt(sliderValue);

                                                        // Check if the numeric value is within the valid range
                                                        if (numericValue > 30) {
                                                            numericValue = 30;
                                                        } else if (numericValue < 0) {
                                                            numericValue = 0;
                                                        }

                                                        // Update the input value
                                                        slider.value = numericValue;

                                                        // Store the sliderValue in a variable or perform any other desired actions
                                                        console.log(numericValue);
                                                    }
                                                </script>

                                            </form>


                                            <form method="post" action="{{ route('mqtt.publish') }}">
                                                @csrf
                                                <label for="message4{{ $dock->id }}"><b> Maximum Size
                                                        (sec)</b></label>
                                                <input type="hidden" name="message"
                                                    id="message4{{ $dock->id }}"
                                                    value="{{ $dock->setting_max_recording }}">
                                                <input type="range" class="me-1" name="slider"
                                                    id="slider4{{ $dock->id }}" min="0" max="180000"
                                                    value="{{ $dock->setting_max_recording }}">
                                                <input type="hidden" name="topic" id="topic4{{ $dock->id }}"
                                                    value="{{ $dock->mac }}/set/max_rec_sec">
                                                <input id="slider-value4{{ $dock->id }}" class="border border-5"
                                                    type="text" contenteditable="true"
                                                    value="{{ number_format($dock->setting_max_recording / 1000, 1) }}"
                                                    style="border: 1px solid #ccc; padding: 2px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;"
                                                    onchange="updateSliderValue{{ $dock->id }}_6()"
                                                    maxlength="3">

                                                <script>
                                                    function updateSliderValue{{ $dock->id }}_6() {
                                                        var slider = document.getElementById("slider-value4{{ $dock->id }}");
                                                        var sliderValue = slider.value.trim(); // Remove leading/trailing white spaces

                                                        // Remove any non-digit characters
                                                        sliderValue = sliderValue.replace(/\D/g, '');

                                                        // Restrict the input to three digits
                                                        if (sliderValue.length > 3) {
                                                            sliderValue = sliderValue.slice(0, 3);
                                                        }

                                                        // Parse the value as an integer
                                                        var numericValue = parseInt(sliderValue);

                                                        // Check if the numeric value is within the valid range
                                                        if (numericValue > 180) {
                                                            numericValue = 180;
                                                        } else if (numericValue < 0) {
                                                            numericValue = 0;
                                                        }

                                                        // Update the input value
                                                        slider.value = numericValue;

                                                        // Store the sliderValue in a variable or perform any other desired actions
                                                        console.log(numericValue);
                                                    }
                                                </script>

                                            </form>


                                            <form method="post" action="{{ route('mqtt.publish') }}">
                                                @csrf
                                                <label for="message5{{ $dock->id }}" class="me-7"><b> Silence
                                                        (sec)</b></label>
                                                <input type="hidden" name="message"
                                                    id="message5{{ $dock->id }}"
                                                    value="{{ $dock->setting_silence }}">
                                                <input type="range" class="me-1" name="slider"
                                                    id="slider5{{ $dock->id }}" min="0" max="10000"
                                                    value="{{ $dock->setting_silence }}">
                                                <input type="hidden" name="topic" id="topic5{{ $dock->id }}"
                                                    value="{{ $dock->mac }}/set/audio_stop_silence​">
                                                <input id="slider-value5{{ $dock->id }}" class="border border-5"
                                                    type="text" contenteditable="true"
                                                    value="{{ number_format($dock->setting_silence / 1000, 1) }}"
                                                    style="border: 1px solid #ccc; padding: 2px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;"
                                                    onchange="updateSliderValue{{ $dock->id }}_7()"
                                                    maxlength="3">

                                                <script>
                                                    function updateSliderValue{{ $dock->id }}_7() {
                                                        var slider = document.getElementById("slider-value5{{ $dock->id }}");
                                                        var sliderValue = slider.value.trim(); // Remove leading/trailing white spaces

                                                        // Remove any non-digit characters
                                                        sliderValue = sliderValue.replace(/\D/g, '');

                                                        // Restrict the input to three digits
                                                        if (sliderValue.length > 2) {
                                                            sliderValue = sliderValue.slice(0, 2);
                                                        }

                                                        // Parse the value as an integer
                                                        var numericValue = parseInt(sliderValue);

                                                        // Check if the numeric value is within the valid range
                                                        if (numericValue > 10) {
                                                            numericValue = 10;
                                                        } else if (numericValue < 0) {
                                                            numericValue = 0;
                                                        }

                                                        // Update the input value
                                                        slider.value = numericValue;

                                                        // Store the sliderValue in a variable or perform any other desired actions
                                                        console.log(numericValue);
                                                    }
                                                </script>
                                            </form>



                                        </div>
                                    </div>
                                    {{-- player settings end --}}
                                    {{-- Test Recording start --}}
                                    <hr class="my-2">
                                    <div class="row my-3">
                                        <h2 class="mb-4">Test Recording&ZeroWidthSpace;</h2>
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label class="label mt-2"><b> Record Line In</b> </label>
                                                </div>
                                                <div class="col-8">
                                                    <a class="btn btn-outline-success start-recording-line-in"
                                                        id="{{ $dock->id }}start-recording-line-in"
                                                        data-bs-toggle="tooltip" aria-label="Start"
                                                        data-bs-original-title="Start">
                                                        <i class="bi bi-record-circle"></i>
                                                    </a>
                                                    <a class="btn btn-outline-success stop-recording-line-in"
                                                        id="{{ $dock->id }}stop-recording-line-in"
                                                        data-bs-toggle="tooltip" aria-label="Stop"
                                                        data-bs-original-title="Stop">
                                                        <i class="bi bi-stop-fill"></i>
                                                    </a>
                                                    <a class="btn btn-outline-success play-recording-line-in"
                                                        id="{{ $dock->id }}play-recording-line-in"
                                                        data-bs-toggle="tooltip" aria-label="Play"
                                                        data-bs-original-title="Play">
                                                        <i class="bi bi-play-fill"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label class="label mt-2"><b> Record Mic</b> </label>
                                                </div>
                                                <div class="col-8">
                                                    <a class="btn btn-outline-success start-recording-mic"
                                                        id="{{ $dock->id }}start-recording-mic"
                                                        data-bs-toggle="tooltip" aria-label="Start"
                                                        data-bs-original-title="Start">
                                                        <i class="bi bi-record-circle"></i>
                                                    </a>
                                                    <a class="btn btn-outline-success stop-recording-mic"
                                                        id="{{ $dock->id }}stop-recording-mic"
                                                        data-bs-toggle="tooltip" aria-label="Stop"
                                                        data-bs-original-title="Stop">
                                                        <i class="bi bi-stop-fill"></i>
                                                    </a>
                                                    <a class="btn btn-outline-success play-recording-mic"
                                                        id="{{ $dock->id }}play-recording-mic"
                                                        data-bs-toggle="tooltip" aria-label="Play"
                                                        data-bs-original-title="Play">
                                                        <i class="bi bi-play-fill"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <script>
                                        $(document).ready(function() {
                                            // Recording Line In
                                            $('#{{ $dock->id }}start-recording-line-in').on('click', function() {
                                                publishMqttMessage('{{ $dock->mac }}/set/start_rec_king', '1');
                                            });

                                            $('#{{ $dock->id }}stop-recording-line-in').on('click', function() {
                                                publishMqttMessage('{{ $dock->mac }}/set/stop_rec_king', '1');
                                            });

                                            $('#{{ $dock->id }}play-recording-line-in').on('click', function() {
                                                publishMqttMessage('{{ $dock->mac }}/set/play_rec_king', '1');
                                            });

                                            // Recording Mic
                                            $('#{{ $dock->id }}start-recording-mic').on('click', function() {
                                                publishMqttMessage('{{ $dock->mac }}/set/start_rec_queen', '1');
                                            });

                                            $('#{{ $dock->id }}stop-recording-mic').on('click', function() {
                                                publishMqttMessage('{{ $dock->mac }}/set/stop_rec_queen', '1');
                                            });

                                            $('#{{ $dock->id }}play-recording-mic').on('click', function() {
                                                publishMqttMessage('{{ $dock->mac }}/set/play_rec_queen', '1');
                                            });

                                            function publishMqttMessage(topic, message) {
                                                $.ajax({
                                                    type: 'POST',
                                                    url: '{{ route('mqtt.publish') }}',
                                                    data: {
                                                        '_token': '{{ csrf_token() }}',
                                                        'topic': topic,
                                                        'message': message
                                                    },
                                                    success: function(response) {
                                                        console.log(response);
                                                    },
                                                    error: function(error) {
                                                        console.log(error);
                                                    }
                                                });
                                                // Update the auto_transcribe value in the database
                                                $.ajax({
                                                    type: 'POST',
                                                    url: '{{ route('mqtt.update', ['id' => $dock->id]) }}',
                                                    data: {
                                                        '_token': '{{ csrf_token() }}',
                                                        '_method': 'PUT',
                                                        'auto_transcribe': message,
                                                    },
                                                    success: function(response) {
                                                        console.log(response);
                                                    },
                                                    error: function(error) {
                                                        console.log(error);
                                                    }
                                                });
                                            }
                                        });
                                    </script>
                                    {{-- Test Recording end --}}
                                    {{-- boondock ai strat --}}
                                    <hr class="my-2">
                                    <div class="row my-3">
                                        <h2 class="mb-3">Boondock AI&ZeroWidthSpace;</h2>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <!-- <label class="label">Default:</label> -->

                                                <!-- Switch -->
                                                <label class="label mb-2"><b> Audio to text</b> </label>
                                                <div class="form-check form-switch form-switch-between mb-6">
                                                    <label class="form-check-label">Off</label>
                                                    <input type="checkbox" class="form-check-input"
                                                        id="audiototext{{ $dock->id }}"
                                                        @if ($dock->auto_transcribe == 1) checked @endif>
                                                    <label class="form-check-label">On</label>
                                                </div>

                                                <script>
                                                    $(document).ready(function() {
                                                        // First Slider
                                                        $('#audiototext{{ $dock->id }}').on('change', function() {
                                                            var message = $(this).prop('checked') ? '1' : '0';
                                                            var topic = '{{ $dock->mac }}/set/audiototext';
                                                            $.ajax({
                                                                type: 'POST',
                                                                url: '{{ route('mqtt.publish') }}',
                                                                data: {
                                                                    '_token': '{{ csrf_token() }}',
                                                                    'topic': topic,
                                                                    'message': message
                                                                },
                                                                success: function(response) {
                                                                    console.log(response);
                                                                },
                                                                error: function(error) {
                                                                    console.log(error);
                                                                }
                                                            });
                                                            $.ajax({
                                                                type: 'POST',
                                                                url: '{{ route('mqtt.update', ['id' => $dock->id]) }}',
                                                                data: {
                                                                    '_token': '{{ csrf_token() }}',
                                                                    '_method': 'PUT',
                                                                    'auto_transcribe': message,

                                                                    // 'notification': message9,
                                                                },
                                                                success: function(response) {
                                                                    console.log(response);
                                                                },
                                                                error: function(error) {
                                                                    console.log(error);
                                                                }
                                                            });
                                                        });

                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <!-- End Select -->
                                                <label class="label mb-2"><b> Auto Level Audio </b></label>
                                                <div class="form-check form-switch form-switch-between mb-6">
                                                    <label class="form-check-label">Off</label>
                                                    <input type="checkbox" class="form-check-input"
                                                        id="audiototext{{ $dock->id }}"
                                                        @if ($dock->audiototext == 1) checked @endif>
                                                    <label class="form-check-label">On</label>
                                                </div>

                                                <!-- End Switch -->

                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <!-- End Select -->
                                                <label class="label mb-2"><b> Noise Reduction </b></label>
                                                <div class="form-check form-switch form-switch-between mb-6">
                                                    <label class="form-check-label">Off</label>
                                                    <input type="checkbox" class="form-check-input"
                                                        id="audiototext{{ $dock->id }}"
                                                        @if ($dock->audiototext == 1) checked @endif>
                                                    <label class="form-check-label">On</label>
                                                </div>


                                            </div>
                                        </div>


                                    </div>
                                    {{-- boondock ai end --}}

                                    <div class="row ">

                                        <div class="row mb-4 gx-3">

                                            <!-- End Col -->

                                            <div class="col-sm">
                                                <div class="d-grid">
                                                    <button class="btn btn-info mx-2 "
                                                        id="reboot-button{{ $dock->id }}">
                                                        <i class="bi bi-arrow-clockwise"></i> &nbsp; Reboot</button>
                                                </div>
                                            </div>
                                            <div class="col-sm mb-2 mb-sm-0">
                                                <div class="d-grid">
                                                    <button class="btn btn-info mx-2 bi bi-window-dock"
                                                        id="beep-button_more_sett{{ $dock->id }}">&nbsp;
                                                        Identify</button>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="d-grid">
                                                    <button class="btn btn-success mx-2"
                                                        id="save_button_more_sett{{ $dock->id }}"><i
                                                            class="fa-solid fa-floppy-disk"></i> &nbsp; Save</button>
                                                </div>
                                            </div>
                                            <!-- End Col -->
                                        </div>
                                        <div class="row mb-4 gx-3">
                                            <div class="col-sm mb-2 mb-sm-0">
                                                <div class="d-grid">
                                                    <button class="btn btn-danger mx-2"
                                                        id="default-button_more_sett{{ $dock->id }}"> <i
                                                            class="fa-solid fa-gears"></i> &nbsp; Set Default</button>
                                                </div>
                                            </div>
                                            <!-- End Col -->

                                            <div class="col-sm">
                                                <div class="d-grid">
                                                    <button class="btn btn-danger mx-2"
                                                        id="factory-button{{ $dock->id }}"><i
                                                            class="bi bi-arrow-clockwise"></i> &nbsp; Factory
                                                        Reset</button>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="d-grid">
                                                    <button class="btn btn-success mx-2"
                                                        id="factory-button{{ $dock->id }}" data-bs-toggle="modal"
                                                        data-id=""
                                                        data-bs-target="#wifi_set{{ $dock->id }}"><i
                                                            class="bi bi-wifi"></i> &nbsp; Wifi Network</button>
                                                </div>
                                            </div>

                                            <!-- End Col -->
                                        </div>

                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                        <script>
                                            $(document).ready(function() {
                                                // First Slider
                                                $('#slider111{{ $dock->id }}').on('change', function() {
                                                    var message = $(this).val();
                                                    var topic = $('#topic1{{ $dock->id }}').val();
                                                    $('#message111{{ $dock->id }}').val(message);
                                                    $('#slider-value111{{ $dock->id }}').val(message);

                                                });

                                                // Update slider when span value changes
                                                $('#slider-value111{{ $dock->id }}').on('input', function() {
                                                    var message = $(this).val();
                                                    var topic = $('#topic111{{ $dock->id }}').val();
                                                    $('#message111{{ $dock->id }}').val(message);
                                                    $('#slider111{{ $dock->id }}').val(message);

                                                });
                                                // Second Slider
                                                $('#slider2{{ $dock->id }}').on('change', function() {
                                                    var message = $(this).val();
                                                    var topic = $('#topic2{{ $dock->id }}').val();
                                                    $('#message2{{ $dock->id }}').val(message);
                                                    $('#slider-value2{{ $dock->id }}').val(message);

                                                });


                                                // Update slider when span value changes
                                                $('#slider-value2{{ $dock->id }}').on('input', function() {
                                                    var message = $(this).val();
                                                    var topic = $('#topic2{{ $dock->id }}').val();
                                                    $('#message2{{ $dock->id }}').val(message);
                                                    $('#slider2{{ $dock->id }}').val(message);
                                                });

                                                // minimum rec sec
                                                $('#slider3{{ $dock->id }}').on('change', function() {
                                                    var message = $(this).val();
                                                    var topic = $('#topic3{{ $dock->id }}').val();
                                                    $('#message3{{ $dock->id }}').val(message);
                                                    $('#slider-value3{{ $dock->id }}').val((message / 1000).toFixed(1));

                                                });
                                                // Update slider when span value changes
                                                $('#slider-value3{{ $dock->id }}').on('input', function() {
                                                    var message = $(this).val();
                                                    var topic = $('#topic3{{ $dock->id }}').val();
                                                    $('#message3{{ $dock->id }}').val(message * 1000);
                                                    $('#slider3{{ $dock->id }}').val(message * 1000);
                                                });
                                                // maximum rec sec
                                                $('#slider4{{ $dock->id }}').on('change', function() {
                                                    var message = $(this).val();
                                                    var topic = $('#topic4{{ $dock->id }}').val();
                                                    $('#message4{{ $dock->id }}').val(message);
                                                    $('#slider-value4{{ $dock->id }}').val((message / 1000).toFixed(1));

                                                });
                                                $('#slider-value4{{ $dock->id }}').on('input', function() {
                                                    var message = $(this).val();
                                                    var topic = $('#topic4{{ $dock->id }}').val();
                                                    $('#message4{{ $dock->id }}').val(message * 1000);
                                                    $('#slider4{{ $dock->id }}').val(message * 1000);
                                                });
                                                // Audio Silence Trigger
                                                $('#slider5{{ $dock->id }}').on('change', function() {
                                                    var message = $(this).val();
                                                    var topic = $('#topic5{{ $dock->id }}').val();
                                                    $('#message5{{ $dock->id }}').val(message);
                                                    $('#slider-value5{{ $dock->id }}').val((message / 1000).toFixed(1));

                                                });
                                                $('#slider-value5{{ $dock->id }}').on('input', function() {
                                                    var message = $(this).val();
                                                    var topic = $('#topic5{{ $dock->id }}').val();
                                                    $('#message5{{ $dock->id }}').val(message * 1000);
                                                    $('#slider5{{ $dock->id }}').val(message * 1000);
                                                });
                                                // system Settings
                                                // $('#slider6{{ $dock->id }}').on('change', function() {
                                                //     var message = $(this).val();
                                                //     var topic = $('#topic6{{ $dock->id }}').val();
                                                //     $('#message6{{ $dock->id }}').val(message);
                                                //     $('#slider-value6{{ $dock->id }}').html(message);
                                                //     // $.ajax({
                                                //     //     type: 'POST',
                                                //     //     url: '{{ route('mqtt.publish') }}',
                                                //     //     data: {
                                                //     //         '_token': '{{ csrf_token() }}',
                                                //     //         'topic': topic,
                                                //     //         'message': message
                                                //     //     },
                                                //     //     success: function(response) {
                                                //     //         console.log(response);
                                                //     //     },
                                                //     //     error: function(error) {
                                                //     //         console.log(error);
                                                //     //     }
                                                //     // });
                                                // });
                                                // $('#slider-value5{{ $dock->id }}').on('input', function() {
                                                //     var message = $(this).html();
                                                //     var topic = $('#topic5{{ $dock->id }}').val();
                                                //     $('#message5{{ $dock->id }}').val(message);
                                                //     $('#slider5{{ $dock->id }}').val(message);
                                                // });
                                                // transmit Settings
                                                $('#slider7{{ $dock->id }}').on('change', function() {
                                                    var message = $(this).val();
                                                    var topic = $('#topic7{{ $dock->id }}').val();
                                                    $('#message7{{ $dock->id }}').val(message);
                                                    $('#slider-value7{{ $dock->id }}').val(message);

                                                });
                                                $('#slider-value7{{ $dock->id }}').on('input', function() {
                                                    var message = $(this).val();
                                                    var topic = $('#topic7{{ $dock->id }}').val();
                                                    $('#message7{{ $dock->id }}').val(message);
                                                    $('#slider7{{ $dock->id }}').val(message);
                                                });
                                                $('#slider17{{ $dock->id }}').on('change', function() {
                                                    var message = $(this).val();
                                                    var topic = $('#topic17{{ $dock->id }}').val();
                                                    $('#message17{{ $dock->id }}').val(message);
                                                    $('#slider-value17{{ $dock->id }}').val(message);

                                                });
                                                $('#slider-value17{{ $dock->id }}').on('input', function() {
                                                    var message = $(this).val();
                                                    var topic = $('#topic17{{ $dock->id }}').val();
                                                    $('#message17{{ $dock->id }}').val(message);
                                                    $('#slider17{{ $dock->id }}').val(message);
                                                });
                                                $('#speaker-switch{{ $dock->id }}').on('change', function() {
                                                    var message = $(this).prop('checked') ? '1' : '0';
                                                    var topic = '{{ $dock->mac }}/set/spkr_on';

                                                });
                                                $('#notify{{ $dock->id }}').on('change', function() {
                                                    var message = $(this).prop('checked') ? '1' : '0';
                                                    var topic = '{{ $dock->mac }}/set/notify_on';

                                                });
                                                $('#save_button_more_sett{{ $dock->id }}').on('click', function() {
                                                    $(this).prop('disabled', true);
                                                    setTimeout(function() {
                                                        $('#save_button_more_sett{{ $dock->id }}').prop('disabled', false);
                                                    }, 4000);
                                                    $('#notification_more_sett{{ $dock->id }}').text(
                                                        'Your setting is being updating, please wait...').addClass('d-flex').addClass(
                                                        'alert alert-info').append(
                                                        '<div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>');
                                                    var topic111 = $('#topic111{{ $dock->id }}').val();
                                                    var message111 = $('#message111{{ $dock->id }}').val();
                                                    var topic2 = $('#topic2{{ $dock->id }}').val();
                                                    var message2 = $('#message2{{ $dock->id }}').val();
                                                    var topic3 = $('#topic3{{ $dock->id }}').val();
                                                    var message3 = $('#message3{{ $dock->id }}').val();
                                                    var topic4 = $('#topic4{{ $dock->id }}').val();
                                                    var message4 = $('#message4{{ $dock->id }}').val();
                                                    var topic5 = $('#topic5{{ $dock->id }}').val();
                                                    var message5 = $('#message5{{ $dock->id }}').val();
                                                    var topic7 = $('#topic7{{ $dock->id }}').val();
                                                    var message7 = $('#message7{{ $dock->id }}').val();
                                                    var topic17 = $('#topic17{{ $dock->id }}').val();
                                                    var message17 = $('#message17{{ $dock->id }}').val();
                                                    var message8 = $('#speaker-switch{{ $dock->id }}').prop('checked') ? '1' : '0';
                                                    var topic8 = '{{ $dock->mac }}/set/spkr_on';
                                                    var message9 = $('#notify{{ $dock->id }}').prop('checked') ? '1' : '0';
                                                    var topic9 = '{{ $dock->mac }}/set/notify_on';
                                                    // data 
                                                    var dock_name = $('#dock_name{{ $dock->id }}').val();
                                                    var dock_address = $('#dock_address{{ $dock->id }}').val();
                                                    var dock_city = $('#dock_city{{ $dock->id }}').val();
                                                    var dock_state = $('#dock_state{{ $dock->id }}').val();
                                                    var dock_zip = $('#dock_zip{{ $dock->id }}').val();
                                                    var dock_lat = $('#dock_lat{{ $dock->id }}').val();
                                                    var dock_lon = $('#dock_lon{{ $dock->id }}').val();

                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '{{ route('mqtt.publish') }}',
                                                        data: {
                                                            '_token': '{{ csrf_token() }}',
                                                            'topic': topic111,
                                                            'message': message111
                                                        },
                                                        success: function(response) {
                                                            console.log(response);
                                                        },
                                                        error: function(error) {
                                                            console.log(error);
                                                        }
                                                    });

                                                    // Save to Database
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '{{ route('mqtt.update', ['id' => $dock->id]) }}',
                                                        data: {
                                                            '_token': '{{ csrf_token() }}',
                                                            '_method': 'PUT',
                                                            'setting_speaker_volume': message111,
                                                            'auto_rec_sound_lv': message2,
                                                            'setting_min_recording': message3,
                                                            'setting_max_recording': message4,
                                                            'setting_silence': message5,
                                                            'setting_speaker_out': message7,
                                                            'playback_vol': message17,
                                                            'speaker': message8,
                                                            'notification': message9,
                                                            'name': dock_name,
                                                            'address': dock_address,
                                                            'city': dock_city,
                                                            'state': dock_state,
                                                            'zip': dock_zip,
                                                            'lat': dock_lat,
                                                            'lon': dock_lon,
                                                            // 'notification': message9,
                                                        },
                                                        success: function(response) {
                                                            console.log(response);
                                                        },
                                                        error: function(error) {
                                                            console.log(error);
                                                        }
                                                    });

                                                    setTimeout(function() {
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: '{{ route('mqtt.publish') }}',
                                                            data: {
                                                                '_token': '{{ csrf_token() }}',
                                                                'topic': topic2,
                                                                'message': message2
                                                            },
                                                            success: function(response) {
                                                                console.log(response);
                                                            },
                                                            error: function(error) {
                                                                console.log(error);
                                                            }
                                                        });
                                                    }, 500);

                                                    setTimeout(function() {
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: '{{ route('mqtt.publish') }}',
                                                            data: {
                                                                '_token': '{{ csrf_token() }}',
                                                                'topic': topic3,
                                                                'message': message3
                                                            },
                                                            success: function(response) {
                                                                console.log(response);
                                                            },
                                                            error: function(error) {
                                                                console.log(error);
                                                            }
                                                        });
                                                    }, 1000);
                                                    setTimeout(function() {
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: '{{ route('mqtt.publish') }}',
                                                            data: {
                                                                '_token': '{{ csrf_token() }}',
                                                                'topic': topic4,
                                                                'message': message4
                                                            },
                                                            success: function(response) {
                                                                console.log(response);
                                                            },
                                                            error: function(error) {
                                                                console.log(error);
                                                            }
                                                        });
                                                    }, 1500);
                                                    setTimeout(function() {
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: '{{ route('mqtt.publish') }}',
                                                            data: {
                                                                '_token': '{{ csrf_token() }}',
                                                                'topic': topic5,
                                                                'message': message5
                                                            },
                                                            success: function(response) {
                                                                console.log(response);
                                                            },
                                                            error: function(error) {
                                                                console.log(error);
                                                            }
                                                        });
                                                    }, 2000);
                                                    setTimeout(function() {
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: '{{ route('mqtt.publish') }}',
                                                            data: {
                                                                '_token': '{{ csrf_token() }}',
                                                                'topic': topic7,
                                                                'message': message7
                                                            },
                                                            success: function(response) {
                                                                console.log(response);
                                                            },
                                                            error: function(error) {
                                                                console.log(error);
                                                            }
                                                        });
                                                    }, 2500);
                                                    setTimeout(function() {
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: '{{ route('mqtt.publish') }}',
                                                            data: {
                                                                '_token': '{{ csrf_token() }}',
                                                                'topic': topic17,
                                                                'message': message17
                                                            },
                                                            success: function(response) {
                                                                console.log(response);
                                                            },
                                                            error: function(error) {
                                                                console.log(error);
                                                            }
                                                        });
                                                    }, 2600);
                                                    setTimeout(function() {
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: '{{ route('mqtt.publish') }}',
                                                            data: {
                                                                '_token': '{{ csrf_token() }}',
                                                                'topic': topic8,
                                                                'message': message8
                                                            },
                                                            success: function(response) {
                                                                console.log(response);
                                                            },
                                                            error: function(error) {
                                                                console.log(error);
                                                            }
                                                        });
                                                    }, 3000);
                                                    setTimeout(function() {
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: '{{ route('mqtt.publish') }}',
                                                            data: {
                                                                '_token': '{{ csrf_token() }}',
                                                                'topic': topic9,
                                                                'message': message9
                                                            },
                                                            success: function(response) {
                                                                console.log(response);
                                                            },
                                                            error: function(error) {
                                                                console.log(error);
                                                            }
                                                        });
                                                    }, 3500);
                                                    setTimeout(function() {
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: '{{ route('mqtt.publish') }}',
                                                            data: {
                                                                '_token': '{{ csrf_token() }}',
                                                                'topic': '{{ $dock->mac }}/set/user_id',
                                                                'message': '{{ auth()->user()->id }}'
                                                            },
                                                            success: function(response) {
                                                                console.log(response);
                                                            },
                                                            error: function(error) {
                                                                console.log(error);
                                                            }
                                                        });
                                                    }, 3500);
                                                    setTimeout(function() {
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: '{{ route('mqtt.publish') }}',
                                                            data: {
                                                                '_token': '{{ csrf_token() }}',
                                                                'topic': '{{ $dock->mac }}/set/name',
                                                                'message': '{{ $dock->name }}'
                                                            },
                                                            success: function(response) {
                                                                console.log(response);
                                                            },
                                                            error: function(error) {
                                                                console.log(error);
                                                            }
                                                        });
                                                    }, 3500);
                                                    setTimeout(function() {
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: '{{ route('mqtt.publish') }}',
                                                            data: {
                                                                '_token': '{{ csrf_token() }}',
                                                                'topic': '{{ $dock->mac }}/set/save',
                                                                // 'message': message9
                                                            },
                                                            success: function(response) {
                                                                console.log(response);
                                                            },
                                                            error: function(error) {
                                                                console.log(error);
                                                            }
                                                        });
                                                    }, 4000);
                                                    setTimeout(function() {
                                                        $('#notification_more_sett{{ $dock->id }}').text('Your setting is saved.')
                                                            .removeClass('alert-info').addClass('alert-success');
                                                    }, 4000);

                                                });
                                                $('#default-button_more_sett{{ $dock->id }}').on('click', function() {
                                                    $(this).prop('disabled', true);
                                                    $('#slider1{{ $dock->id }}').val('25');
                                                    $('#slider-value1{{ $dock->id }}').val(25);
                                                    $('#slider111{{ $dock->id }}').val('25');
                                                    $('#slider-value111{{ $dock->id }}').val(25);
                                                    $('#slider2{{ $dock->id }}').val('25');
                                                    $('#slider-value2{{ $dock->id }}').val(25);
                                                    $('#slider17{{ $dock->id }}').val('25');
                                                    $('#slider-value17{{ $dock->id }}').val(25);
                                                    $('#slider3{{ $dock->id }}').val('5000');
                                                    $('#slider-value3{{ $dock->id }}').val(5);
                                                    $('#slider4{{ $dock->id }}').val('10000');
                                                    $('#slider-value4{{ $dock->id }}').val(10);
                                                    $('#slider5{{ $dock->id }}').val('1000');
                                                    $('#slider-value5{{ $dock->id }}').val(1.0);

                                                    setTimeout(function() {
                                                        $('#default-button_more_sett{{ $dock->id }}').prop('disabled', false);
                                                    }, 4000);
                                                    // setTimeout(function() {
                                                    //     location.reload();
                                                    // }, 4500);
                                                    $('#notification_more_sett{{ $dock->id }}').text(
                                                        'Default setting is being updating, please wait...').addClass('d-flex').addClass(
                                                        'alert alert-info').append(
                                                        '<div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>');
                                                    // var topic11 = $('#topic1{{ $dock->id }}').val();
                                                    // var message1 = '25';
                                                    var topic111 = $('#topic111{{ $dock->id }}').val();
                                                    var message111 = '25';
                                                    var topic2 = $('#topic2{{ $dock->id }}').val();
                                                    var message2 = '1.0';
                                                    var topic3 = $('#topic3{{ $dock->id }}').val();
                                                    var message3 = '5000';
                                                    var topic4 = $('#topic4{{ $dock->id }}').val();
                                                    var message4 = '10000';
                                                    var topic5 = $('#topic5{{ $dock->id }}').val();
                                                    var message5 = '1000';
                                                    var topic7 = $('#topic7{{ $dock->id }}').val();
                                                    var message7 = '25';
                                                    var topic17 = $('#topic7{{ $dock->id }}').val();
                                                    var message7 = '25';
                                                    var topic8 = '{{ $dock->mac }}/set/spkr_on';
                                                    var message8 = '1';
                                                    var topic9 = '{{ $dock->mac }}/set/notify_on';
                                                    var message9 = '1';
                                                    var set_default = 'set_default';

                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '{{ route('mqtt.publish') }}',
                                                        data: {
                                                            '_token': '{{ csrf_token() }}',
                                                            'topic': set_default,

                                                        },
                                                        success: function(response) {
                                                            console.log(response);
                                                        },
                                                        error: function(error) {
                                                            console.log(error);
                                                        }
                                                    });
                                                    // Save to Database
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '{{ route('mqtt.update', ['id' => $dock->id]) }}',
                                                        data: {
                                                            '_token': '{{ csrf_token() }}',
                                                            '_method': 'PUT',
                                                            'setting_speaker_volume': message111,
                                                            'auto_rec_sound_lv': message2,
                                                            'setting_min_recording': message3,
                                                            'setting_max_recording': message4,
                                                            'setting_silence': message5,
                                                            'setting_speaker_out': message7,
                                                            'speaker': message8,
                                                            'notification': message9,
                                                            // 'notification': message9,
                                                        },
                                                        success: function(response) {
                                                            console.log(response);
                                                        },
                                                        error: function(error) {
                                                            console.log(error);
                                                        }
                                                    });


                                                    setTimeout(function() {
                                                        $('#notification_more_sett{{ $dock->id }}').text('Your setting is saved.')
                                                            .removeClass('alert-info').addClass('alert-success');
                                                    }, 4000);

                                                });
                                                $('#factory-button{{ $dock->id }}').on('click', function() {
                                                    $(this).prop('disabled', true);
                                                    setTimeout(function() {
                                                        $('#factory-button{{ $dock->id }}').prop('disabled', false);
                                                    }, 5000);
                                                    setTimeout(function() {
                                                        $('#notification_more_sett{{ $dock->id }}').text(
                                                                'Factory Reset Successfully.')
                                                            .removeClass('alert-info').addClass('alert-success');
                                                    }, 5000);
                                                    $('#notification_more_sett{{ $dock->id }}').text(
                                                        'Factory resetting, please wait...').addClass('d-flex').addClass(
                                                        'alert alert-info').append(
                                                        '<div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>');
                                                    var topic = '{{ $dock->mac }}/set/factory_reset';
                                                    var message = '';

                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '{{ route('mqtt.publish') }}',
                                                        data: {
                                                            '_token': '{{ csrf_token() }}',
                                                            'topic': topic,
                                                            'message': message
                                                        },
                                                        success: function(response) {
                                                            console.log(response);
                                                        },
                                                        error: function(error) {
                                                            console.log(error);
                                                        }
                                                    });
                                                });
                                            });
                                        </script>
                                        <script>
                                            $(document).ready(function() {
                                                // reboot
                                                $('#reboot-button{{ $dock->id }}').on('click', function() {
                                                    $(this).prop('disabled', true);
                                                    setTimeout(function() {
                                                        $('#reboot-button{{ $dock->id }}').prop('disabled', false);
                                                    }, 5000);
                                                    setTimeout(function() {
                                                        $('#notification_more_sett{{ $dock->id }}').text('Reboot Succusfully.')
                                                            .removeClass('alert-info').addClass('alert-success');
                                                    }, 5000);
                                                    $('#notification_more_sett{{ $dock->id }}').text(
                                                        'Rebooting, please wait...').addClass('d-flex').addClass(
                                                        'alert alert-info').append(
                                                        '<div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>');
                                                    var topic = '{{ $dock->mac }}/set/reboot';
                                                    var message = '1';

                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '{{ route('mqtt.publish') }}',
                                                        data: {
                                                            '_token': '{{ csrf_token() }}',
                                                            'topic': topic,
                                                            'message': message
                                                        },
                                                        success: function(response) {
                                                            console.log(response);
                                                        },
                                                        error: function(error) {
                                                            console.log(error);
                                                        }
                                                    });
                                                });
                                                // beep
                                                $('#beep-button_more_sett{{ $dock->id }}').on('click', function() {
                                                    $(this).prop('disabled', true);
                                                    setTimeout(function() {
                                                        $('#beep-button_more_sett{{ $dock->id }}').prop('disabled', false);
                                                    }, 5000);
                                                    setTimeout(function() {
                                                        $('#notification_more_sett{{ $dock->id }}').text('Signal is sent.')
                                                            .removeClass('alert-info').addClass('alert-success');
                                                    }, 5000);
                                                    $('#notification_more_sett{{ $dock->id }}').text(
                                                        'Identifying Signals Is sending, please wait...').addClass('d-flex').addClass(
                                                        'alert alert-info').append(
                                                        '<div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>');
                                                    var topic = '{{ $dock->mac }}/set/beep';
                                                    var message = '5';

                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '{{ route('mqtt.publish') }}',
                                                        data: {
                                                            '_token': '{{ csrf_token() }}',
                                                            'topic': topic,
                                                            'message': message
                                                        },
                                                        success: function(response) {
                                                            console.log(response);
                                                        },
                                                        error: function(error) {
                                                            console.log(error);
                                                        }
                                                    });
                                                });
                                            });
                                        </script>
                                        {{-- <script>
                                            $(document).ready(function() {
                                                $('#speaker-switch{{ $dock->id }}').on('change', function() {
                                                    var message = $(this).prop('checked') ? '1' : '0';
                                                    var topic = '{{ $dock->mac }}/set/spkr_on';
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '{{ route('mqtt.publish') }}',
                                                        data: {
                                                            '_token': '{{ csrf_token() }}',
                                                            'topic': topic,
                                                            'message': message
                                                        },
                                                        success: function(response) {
                                                            console.log(response);
                                                        },
                                                        error: function(error) {
                                                            console.log(error);
                                                        }
                                                    });
                                                });
                                            });
                                        </script> --}}
                                        {{-- RECORD SCRIPT  --}}

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
{{-- more settings end --}}
                <div id="wifi_set{{ $dock->id }}" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5> {{ $dock->name }} ({{ $dock->mac }}) <span
                                        class="badge bg-danger rounded-pill ms-1">Under Development</span></h5>


                                <button type="button" data-bs-toggle="modal" data-id="{{ $dock->id }}"
                                    data-bs-target="#more_sett{{ $dock->id }}"
                                    class="btn btn-outline-dark">Back</button>
                                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="" role="alert" id="notificationadv{{ $dock->id }}">
                                    </div>


                                    <span class="divider-center">Wifi Connections</span>
                                    <div class="row mt-4 mr-2">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr class="hide-in-mobile">
                                                        <th scope="col">No.</th>
                                                        <th scope="col">WiFi SSID</th>
                                                        <th scope="col">Password</th>
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td data-label="No.">1</td>
                                                        <td data-label="WiFi SSID"><input class="form-control"
                                                                type="text" placeholder="SSID"
                                                                id="ssid1{{ $dock->id }}"></td>
                                                        <td data-label="Password"><input class="form-control"
                                                                type="password" placeholder="Password"
                                                                id="password1{{ $dock->id }}"></td>
                                                        <td data-label="Actions"><button class="btn btn-info"
                                                                id="update-button1{{ $dock->id }}">Update</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td data-label="No.">2</td>
                                                        <td data-label="WiFi SSID"><input class="form-control"
                                                                type="text" placeholder="SSID"
                                                                id="ssid2{{ $dock->id }}"></td>
                                                        <td data-label="Password"><input class="form-control"
                                                                type="password" placeholder="Password"
                                                                id="password2{{ $dock->id }}"></td>
                                                        <td data-label="Actions"><button class="btn btn-info"
                                                                id="update-button2{{ $dock->id }}">Update</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td data-label="No.">3</td>
                                                        <td data-label="WiFi SSID"><input class="form-control"
                                                                type="text" placeholder="SSID"
                                                                id="ssid3{{ $dock->id }}"></td>
                                                        <td data-label="Password"><input class="form-control"
                                                                type="password" placeholder="Password"
                                                                id="password3{{ $dock->id }}"></td>
                                                        <td data-label="Actions"><button class="btn btn-info"
                                                                id="update-button3{{ $dock->id }}">Update</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>





                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


                                        <script>
                                            $(document).ready(function() {
                                                $('#update-button1{{ $dock->id }}').prop('disabled', true);
                                                $('#ssid1{{ $dock->id }}, #password1{{ $dock->id }}').keyup(function() {
                                                    if ($('#ssid1{{ $dock->id }}').val() != '' && $('#password1{{ $dock->id }}')
                                                        .val() != '') {
                                                        $('#update-button1{{ $dock->id }}').prop('disabled', false);
                                                    } else {
                                                        $('#update-button1{{ $dock->id }}').prop('disabled', true);
                                                    }
                                                });
                                                $('#update-button1{{ $dock->id }}').on('click', function() {


                                                    var ssid1 = '{{ $dock->mac }}/wifi_ssid';
                                                    var ssidval1 = $('#ssid1{{ $dock->id }}').val();
                                                    var pass1 = '{{ $dock->mac }}/wifi_password';
                                                    var passval1 = $('#password1{{ $dock->id }}').val();

                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '{{ route('mqtt.publish') }}',
                                                        data: {
                                                            '_token': '{{ csrf_token() }}',
                                                            'topic': ssid1,
                                                            'message': ssidval1
                                                        },
                                                        success: function(response) {
                                                            console.log(response);
                                                        },
                                                        error: function(error) {
                                                            console.log(error);
                                                        }
                                                    });
                                                    setTimeout(function() {
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: '{{ route('mqtt.publish') }}',
                                                            data: {
                                                                '_token': '{{ csrf_token() }}',
                                                                'topic': pass1,
                                                                'message': passval1
                                                            },
                                                            success: function(response) {
                                                                console.log(response);
                                                            },
                                                            error: function(error) {
                                                                console.log(error);
                                                            }
                                                        });
                                                    }, 2000);
                                                });
                                                $('#update-button2{{ $dock->id }}').prop('disabled', true);
                                                $('#ssid2{{ $dock->id }}, #password2{{ $dock->id }}').keyup(function() {
                                                    if ($('#ssid2{{ $dock->id }}').val() != '' && $('#password2{{ $dock->id }}')
                                                        .val() != '') {
                                                        $('#update-button2{{ $dock->id }}').prop('disabled', false);
                                                    } else {
                                                        $('#update-button2{{ $dock->id }}').prop('disabled', true);
                                                    }
                                                });
                                                $('#update-button2{{ $dock->id }}').on('click', function() {


                                                    var ssid2 = '{{ $dock->mac }}/wifi_ssid1';
                                                    var ssidval2 = $('#ssid2{{ $dock->id }}').val();
                                                    var pass2 = '{{ $dock->mac }}/wifi_password1';
                                                    var passval2 = $('#password2{{ $dock->id }}').val();

                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '{{ route('mqtt.publish') }}',
                                                        data: {
                                                            '_token': '{{ csrf_token() }}',
                                                            'topic': ssid2,
                                                            'message': ssidval2
                                                        },
                                                        success: function(response) {
                                                            console.log(response);
                                                        },
                                                        error: function(error) {
                                                            console.log(error);
                                                        }
                                                    });
                                                    setTimeout(function() {
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: '{{ route('mqtt.publish') }}',
                                                            data: {
                                                                '_token': '{{ csrf_token() }}',
                                                                'topic': pass2,
                                                                'message': passval2
                                                            },
                                                            success: function(response) {
                                                                console.log(response);
                                                            },
                                                            error: function(error) {
                                                                console.log(error);
                                                            }
                                                        });
                                                    }, 2000);
                                                });
                                                $('#update-button3{{ $dock->id }}').prop('disabled', true);
                                                $('#ssid3{{ $dock->id }}, #password3{{ $dock->id }}').keyup(function() {
                                                    if ($('#ssid3{{ $dock->id }}').val() != '' && $('#password3{{ $dock->id }}')
                                                        .val() != '') {
                                                        $('#update-button3{{ $dock->id }}').prop('disabled', false);
                                                    } else {
                                                        $('#update-button3{{ $dock->id }}').prop('disabled', true);
                                                    }
                                                });
                                                $('#update-button3{{ $dock->id }}').on('click', function() {


                                                    var ssid3 = '{{ $dock->mac }}/wifi_ssid2';
                                                    var ssidval3 = $('#ssid3{{ $dock->id }}').val();
                                                    var pass3 = '{{ $dock->mac }}/wifi_password2';
                                                    var passval3 = $('#password3{{ $dock->id }}').val();

                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '{{ route('mqtt.publish') }}',
                                                        data: {
                                                            '_token': '{{ csrf_token() }}',
                                                            'topic': ssid3,
                                                            'message': ssidval3
                                                        },
                                                        success: function(response) {
                                                            console.log(response);
                                                        },
                                                        error: function(error) {
                                                            console.log(error);
                                                        }
                                                    });
                                                    setTimeout(function() {
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: '{{ route('mqtt.publish') }}',
                                                            data: {
                                                                '_token': '{{ csrf_token() }}',
                                                                'topic': pass3,
                                                                'message': passval3
                                                            },
                                                            success: function(response) {
                                                                console.log(response);
                                                            },
                                                            error: function(error) {
                                                                console.log(error);
                                                            }
                                                        });
                                                    }, 2000);
                                                });
                                            });
                                        </script>
                                        {{-- <script>
                                        $(document).ready(function() {
                                            $('#speaker-switch{{ $dock->id }}').on('change', function() {
                                                var message = $(this).prop('checked') ? '1' : '0';
                                                var topic = '{{ $dock->mac }}/set/spkr_on';
                                                $.ajax({
                                                    type: 'POST',
                                                    url: '{{ route('mqtt.publish') }}',
                                                    data: {
                                                        '_token': '{{ csrf_token() }}',
                                                        'topic': topic,
                                                        'message': message
                                                    },
                                                    success: function(response) {
                                                        console.log(response);
                                                    },
                                                    error: function(error) {
                                                        console.log(error);
                                                    }
                                                });
                                            });
                                        });
                                    </script> --}}
                                        {{-- RECORD SCRIPT  --}}
                                        <script>
                                            $(document).ready(function() {
                                                var startRecordBtn{{ $dock->id }} = $('#start-recording-btn{{ $dock->id }}');
                                                var stopRecordBtn{{ $dock->id }} = $('#stop-recording-btn{{ $dock->id }}');

                                                // Start recording button click event handler
                                                startRecordBtn{{ $dock->id }}.on('click', function() {
                                                    // Hide start recording button
                                                    startRecordBtn{{ $dock->id }}.css('display', 'none');

                                                    // Disable start recording button
                                                    // startRecordBtn.prop('disabled', true);
                                                    // Publish message to start recording
                                                    var topic = '{{ $dock->mac }}/set/start_rec_king';
                                                    var message = '';
                                                    publishMessage(topic, message);
                                                    // Enable stop recording button
                                                    stopRecordBtn{{ $dock->id }}.css('display', '');
                                                });

                                                // Stop recording button click event handler
                                                stopRecordBtn{{ $dock->id }}.on('click', function() {
                                                    // Disable stop recording button
                                                    stopRecordBtn{{ $dock->id }}.css('display', 'none');
                                                    // Publish message to stop recording
                                                    var topic = '{{ $dock->mac }}/set/stop_rec_king';
                                                    var message = '';
                                                    publishMessage(topic, message);
                                                    // Enable start recording button
                                                    startRecordBtn{{ $dock->id }}.css('display', '');
                                                });

                                                function publishMessage(topic, message) {
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '{{ route('mqtt.publish') }}',
                                                        data: {
                                                            '_token': '{{ csrf_token() }}',
                                                            'topic': topic,
                                                            'message': message
                                                        },
                                                        success: function(response) {
                                                            console.log(response);
                                                        },
                                                        error: function(error) {
                                                            console.log(error);
                                                        }
                                                    });
                                                }
                                            });
                                        </script>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    {{-- test  --}}
                </div>
            @endforeach
            @foreach ($activeDocks as $dock)
            <div id="info{{ $dock->id }}" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5> Virtual Dock
                            </h5>


                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">

<h6>This is virtual dock You can not edit this Dock <a href="http://">Learn More.</a> <br> If you want edit call sign click <a href="{{route('profile')}}">here</a> </h6>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            @endforeach

 
    </main>
@endsection
