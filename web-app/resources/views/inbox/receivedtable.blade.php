   <!-- Stats -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <div class="row">
    <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
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
                            <i class="fa-solid fa-envelope "></i>
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

    <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
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
    <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
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
    <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
        <!-- Card -->
        <div class="card h-100">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Activity</h6>

                <div class="row align-items-center gx-2">
                    <script>
                        const authUserId = "{{ Auth::user()->id }}";
                    </script>
                    <div id="message-container">Welcome {{ Auth::user()->name }}!</div>






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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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

                <!-- export -->

                <!-- End Dropdown -->

                <!-- filter -->
                {{-- recorder mic start --}}

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
                                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                                <form action="{{ route('inboxstore') }}" method="POST" enctype="multipart/form-data" id="myForm">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="file" name="file" accept="audio/*" id="inputFile" class="form-control @error('file') is-invalid @enderror" required hidden>
                                        @error('file')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-danger" onclick="resetRecording()">Reset</button>
                                        <button type="button" class="btn btn-success" onclick="upload()">Upload</button>
                                    </div>
                                </form>
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


                        function resetRecording() {
                            // Reset the recorded audio and clear the file input
                            var audio = document.getElementsByTagName('audio')[0];
                            var inputFile = document.getElementById('inputFile');

                            if (audio) {
                                audio.pause();
                                audio.currentTime = 0;
                                audio.src = '';

                                if (inputFile) {
                                    inputFile.value = '';
                                }

                                var msg_box = document.getElementById('msg_box');
                                msg_box.innerHTML = lang.press_to_start;
                            }
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
                                            enctype="multipart/form-data" id="myForm">
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
                                    document.getElementById('myForm').submit();
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
                                    action="{{ route('inbox', ['filter' => true]) }}">
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
                                            <option class="option" value="500"
                                                {{ $per_page == 500 ? 'selected' : '' }}>500</option>
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
                        {{-- <th>Dock Name</th> --}}
                        <th>Audio</th>
                        {{-- <th>State</th> --}}
                        <th> Actions</th>
                        <th>message</th>
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
                                <a class="d-flex align-items-center text-dark" href="#">
                                    <div class="flex-shrink-0">
                                        <span class="icon  mb-1">
                                            @if (in_array($audioFile->id, $sentMessageIds))
                                                <i class="fa-solid fa-paper-plane "></i>
                                            @else
                                                <i class="fa-solid fa-envelope "></i>
                                            @endif

                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">

                                        <span class="text-inherit"
                                            @foreach ($activeDocks as $dock)
                                                @if ($dock->mac == $audioFile->mac)
                                                    title="Dock Name : {{ $dock->name }}"
                                                    data-bs-toggle="modal"  data-id="{{ $dock->id }}"
                                                    data-bs-target="#sett{{ $dock->id }}"   @endif @endforeach>
                                            {{ $audioFile->station ?? 'DOCK nOT fOUND' }}

                                            ({{ $audioFile->frequency ?? 'DOCK nOT fOUND' }})
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

                            <td>
                                {{-- @if (str_contains($audioFile->file_name, 'uploads')) --}}
                                <span><audio controls style="width: 240px; height:30px;">
                                        <source
                                            src="https://cdn.boondockdev.com/uploads/{{ $audioFile->mac }}/{{ $audioFile->file_name }}">
                                    </audio></span>

                                {{-- <span class="text-inherit">  {{ \Carbon\Carbon::parse($audioFile->added)->format('m-j-Y') }} </span> --}}
                                {{-- @else
                                    <audio controls="mini"
                                        src="{{ asset('storage/uploads/' . $audioFile->mac . '/' . $audioFile->file_name) }}"></audio>
                                @endif --}}

                            </td>
                            <td class="nowrap-td">

                                {{-- <form action="{{ route('inbox.delete', $audioFile->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"> <i
                                        class="bi-trash me-1"></i> </button>

                            </form> --}}
                                @if (auth()->user()->hasRole('Super Admin'))
                                    @if (empty($audioFile->audio_type))
                                        <a class="btn btn-outline-success" data-bs-toggle="tooltip"
                                            title='Tag as a Favorite' id="fav-button{{ $audioFile->id }}">
                                            <i class="bi-heart me-1"></i></a>
                                    @else
                                        <a class="btn btn-outline-danger" data-bs-toggle="tooltip"
                                            title='Favorite'
                                            id="fav-button_after{{ $audioFile->id }}{{ $audioFile->id }}"> <i
                                                class="fa-solid fa-heart"></i></a>
                                    @endif
                                @endif

                                <script>
                                    $(document).ready(function() {

                                        // transmit
                                        $('#fav-button{{ $audioFile->id }}').on('click', function() {
                                            var messageId = {{ $audioFile->id }};
                                            $(this).removeClass('btn-outline-success').addClass('btn-outline-danger').html(
                                                ' <i class="fa-solid fa-heart"></i>');


                                            $.ajax({
                                                type: 'POST',
                                                url: '{{ route('favorites.add') }}',
                                                data: {
                                                    '_token': '{{ csrf_token() }}',
                                                    'message_id': messageId
                                                },
                                                success: function(response) {
                                                    console.log(response);

                                                    // create a new record in the "outbox" table

                                                },
                                                error: function(error) {
                                                    console.log(error);
                                                }
                                            });
                                        });


                                    });
                                </script>
                                @if (in_array($audioFile->id, $sentMessageIds))
                                    <a class="btn btn-secondary " data-bs-toggle="tooltip" title='Transmited'
                                        id="send-button{{ $audioFile->id }}"> <i
                                            class="bi-check2-all me-1"></i></a>
                                @else
                                    <a class="btn btn-outline-success " data-bs-toggle="tooltip"
                                        title='Transmit' id="send-button{{ $audioFile->id }}">
                                        <i class="fa-solid fa-tower-broadcast"></i></a>
                                @endif
                                {{-- <i
                                    class="bi-send-check me-1" style="font-size: 2rem; color: cornflowerblue;"></i> --}}

                                {{-- model setting start --}}



                                {{-- model setting end --}}
                                <a class="btn btn-outline-success" data-bs-toggle="tooltip" title='Play'
                                    id="play-button{{ $audioFile->id }}"> <i
                                        class="fa-solid fa-radio"></i></a>

                                <form method="POST" action="{{ route('inbox.delete', $audioFile->id) }}"
                                    style="display:inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="bi-trash me-1"></i>
                                    </button>
                                </form>
                            </td>
                            <td data-label="Message">
                                <a data-bs-toggle="tooltip" title="{{ $audioFile->transcribe_long }}">
                                    </b>
                                    @if (empty($audioFile->transcribe_long))
                                        <a href="{{ route('transcribe-audio', $audioFile->id) }}"
                                            id="transcribe-button-{{ $audioFile->id }}"
                                            class="btn btn-outline-info">
                                            <span class="spinner-border spinner-border-sm d-none"
                                                role="status" aria-hidden="true"></span> Transcribe Audio
                                        </a>


                                        {{-- <span class="legend-indicator bg-danger"></span>  No transcribe found  <a href="{{ route('transcribe-audio', $audioFile->id) }}" class="btn btn-outline-info me-1 mb-1">Transcribe Audio</a> --}}
                                    @elseif(strlen($audioFile->transcribe_long) <= 30)
                                        <b>{{ $audioFile->transcribe_long }}</b>
                                    @else
                                        <span id="transcription-truncated{{ $audioFile->id }}">
                                            <b>{{ substr($audioFile->transcribe_long, 0, 20) . '...' }}</b>
                                            <button class="btn btn-ghost-secondary"
                                                onclick="expandTranscription{{ $audioFile->id }}()">
                                                more</button>
                                        </span>
                                        <span id="transcription-full{{ $audioFile->id }}"
                                            style="display:none">
                                            @foreach (str_split($audioFile->transcribe_long, 30) as $line)
                                                {{ $line }}<br>
                                            @endforeach
                                        </span>
                                    @endif
                                    <script>
                                        function expandTranscription{{ $audioFile->id }}() {
                                            // Hide the truncated text and show the full text
                                            document.getElementById('transcription-truncated{{ $audioFile->id }}').style.display = 'none';
                                            document.getElementById('transcription-full{{ $audioFile->id }}').style.display = 'inline';
                                        }
                                    </script>
                                </a>
                                <script>
                                    $(document).ready(function() {
                                        $('a[id^="transcribe-button-"]').on('click', function(event) {
                                            event.preventDefault();
                                            var buttonId = $(this).attr('id');
                                            var messageId = buttonId.split('-')[2];
                                            var url = $(this).attr('href');
                                            var spinner = $('#' + buttonId + ' span');
                                            spinner.removeClass('d-none'); // Show the spinner
                                            $.ajax({
                                                url: url,
                                                type: 'GET',
                                                success: function(data) {
                                                    var truncatedTranscription = data.transcription.split(' ').splice(0, 12)
                                                        .join(' ');
                                                    $('#' + buttonId).replaceWith('<span>' + truncatedTranscription + (data
                                                            .transcription.split(' ').length > 50 ? '...' : '') +
                                                        '</span>');
                                                },
                                                error: function() {
                                                    alert('Error transcribing audio.');
                                                },
                                                complete: function() {
                                                    spinner.addClass('d-none'); // Hide the spinner
                                                }
                                            });
                                        });
                                    });
                                </script>



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
                                            $formattedTime = $added->isoFormat('Do MMMM YYYY, h:mm:ss A');
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
                            fetch('{{ route('inbox.deleteSelected') }}', {
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


    <form action="{{ route('inboxstore') }}" method="POST" enctype="multipart/form-data">
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

    </form>




</div>