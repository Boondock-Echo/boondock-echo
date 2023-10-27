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
<style>
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

        /* audio {
            width: 20px;
        } */



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
                <div class="toast toast-show fade show" role="alert" aria-live="assertive" aria-atomic="true"
                    style="top: 20px; right: 20px; z-index: 1000;">
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

                <!-- End Toast -->
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

                                <script src="{{ asset('js/mqtt_messages.js') }}"></script>

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
                                    {{-- <span class="fs-5 me-3">
                                        <span id="datatableCounter">0</span>
                                        Selected
                                    </span> --}}
                                    <button type="button" class="btn btn-outline-danger" id="deleteSelectedBtn">
                                        Delete <span id="datatableCounter">0</span> selected audio files
                                    </button>
                                </div>
                            </div>
                            <!-- End Datatable Info -->

                            <!-- export -->

                            <!-- End Dropdown -->

                            <!-- filter -->

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
                                                action="{{ route('pack', $id, ['filter' => true]) }}">
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
                                            <input class="form-check-input" type="checkbox" value=""
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
                                                <input class="form-check-input" type="checkbox"
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
                                                            <i class="fa-solid fa-paper-plane text-success"></i>
                                                        @else
                                                            <i class="fa-solid fa-envelope text-primary"></i>
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

                                           <!-- Button to Trigger Modal for Deleting an Audio File -->
<button type="button" class="btn btn-outline-danger"
data-bs-toggle="modal"
data-bs-target="#exampleModalCenterDeleteAudio{{ $audioFile->id }}">
<i class="bi-trash me-1"></i>
</button>

<!-- Modal for Deleting an Audio File -->
<div id="exampleModalCenterDeleteAudio{{ $audioFile->id }}" class="modal fade"
tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-sm"
    role="document">
    <div class="modal-content text-center">
        <div class="modal-body">
            <p class="text-dark">Are you sure you want to delete this audio file? <br>This action cannot be undone.</p>
            <!-- "Yes, Delete" button -->
            <form method="POST"
                action="{{ route('inbox.delete', $audioFile->id) }}"
                style="display:inline">
                @method('DELETE')
                @csrf
                <button type="submit"
                    class="btn btn-soft-danger mt-2">
                    Yes, Delete
                </button>
            </form>
            <!-- "Cancel" button -->
            <button type="button"
                class="btn btn-soft-dark mt-2 mx-4"
                data-bs-dismiss="modal">
                Cancel
            </button>
        </div>
    </div>
</div>
</div>

                                        </td>
                                        <td data-label="Message">
                                            <a data-bs-toggle="tooltip" title="{{ $audioFile->transcribe_long }}">
                                                </b>
                                                @if (empty($audioFile->transcribe_long))
                                                    <a href="{{ route('transcribe-audio', $audioFile->id) }}"
                                                        id="transcribe-button-{{ $audioFile->id }}"
                                                        class="btn btn-outline-info me-1 mb-1">
                                                        <span class="spinner-border spinner-border-sm d-none"
                                                            role="status" aria-hidden="true"></span>
                                                        Transcribe Audio
                                                    </a>


                                                    {{-- <span class="legend-indicator bg-danger"></span>  No transcribe found  <a href="{{ route('transcribe-audio', $audioFile->id) }}" class="btn btn-outline-info me-1 mb-1">Transcribe Audio</a> --}}
                                                @elseif(strlen($audioFile->transcribe_long) <= 30)
                                                    <b>{{ $audioFile->transcribe_long }}</b>
                                                @else
                                                    <span id="transcription-truncated{{ $audioFile->id }}">
                                                        <b>{{ substr($audioFile->transcribe_long, 0, 30) . '...' }}</b>
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


                {{-- <form action="{{ route('inboxstore') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="inputFile">File:</label>
                        <input type="file" name="file" id="inputFile"
                            class="form-control @error('file') is-invalid @enderror">

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
                                        <label for="CallSignLabel" class="form-label"><b>Station/CallSign:</b></label>
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
                                                            <option data-station="{{ $stations->station }}"
                                                                data-frequency="{{ $stations->frequency }}">
                                                                {{ $stations->station }} - ({{ $stations->frequency }})
                                                                {{ $stations->description }}
                                                            </option>
                                                        @endforeach
                                                        <option id="new-station-option{{ $dock->id }}"
                                                            value="new-station"
                                                            style="color: blue; text-decoration: underline;">
                                                            Add new station
                                                        </option>

                                                    </select>
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

                                            </div>
                                            <script>
                                                $(document).ready(function() {
                                                    $('#station-select{{ $dock->id }}').change(function() {
                                                        if ($(this).val() === 'new-station') {
                                                            $('#manage-btn{{ $dock->id }}').hide();
                                                            $('#add-btn{{ $dock->id }}').show();
                                                        } else {
                                                            $('#manage-btn{{ $dock->id }}').show();
                                                            $('#add-btn{{ $dock->id }}').hide();
                                                        }
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
                                                        type="number" contenteditable="true"
                                                        value="{{ $dock->setting_speaker_volume }}"
                                                        style="border: 1px solid #ccc; padding: 1px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">
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
                                                            var message = $(this).val();
                                                            var topic = $('#topic1{{ $dock->id }}').val();

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

                                        </div>

                                        <div class="row">

                                            <div class="col-6">
                                                <div class="form-group">

                                                    <form method="post" action="{{ route('mqtt.publish') }}">
                                                        @csrf
                                                        <label class="mx-2" for="message12{{ $dock->id }}"><b>
                                                                Gain
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                                                        <input type="hidden" name="message"
                                                            id="message12{{ $dock->id }}"
                                                            value="{{ $dock->line_in_gain }}">
                                                        {{-- <input type="range" class="me-2" name="slider"
                                                                id="slider12{{ $dock->id }}" min="0" max="100"
                                                                value="{{ $dock->line_in_gain }}"> --}}
                                                        <select class="form-select" name="select"
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
                                                    <label for="message1{{ $dock->id }}"><b>Recorder senstivity
                                                        </b></label>
                                                    <input type="hidden" name="message"
                                                        id="recordermessage1{{ $dock->id }}" value="0">

                                                    <input type="range" class="me-2" name="slider"
                                                        id="recorderslider1{{ $dock->id }}" min="0"
                                                        max="100" style="width: 50%"
                                                        value="{{ $dock->line_in_min_db }}">

                                                    <input type="hidden" name="topic"
                                                        id="recordertopic1{{ $dock->id }}"
                                                        value="{{ $dock->mac }}/set/line_min_db">
                                                    <input id="recorderslider-value1{{ $dock->id }}"
                                                        class="border border-5" contenteditable="true"
                                                        value="{{ $dock->line_in_min_db }}" type="number"
                                                        style="border: 1px solid #ccc; padding: 1px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">
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
                                                        $('#recorderslider-value1{{ $dock->id }}').on('input', function() {
                                                            var message = $(this).val();
                                                            var topic = $('#recordertopic1{{ $dock->id }}').val();
                                                            $('#recordermessage1{{ $dock->id }}').val(message);
                                                            $('#recorderslider1{{ $dock->id }}').val(message);
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

                {{-- manage  --}}
                <div id="manage{{ $dock->id }}" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="badge bg-danger rounded-pill">Under Development</span>



                                <button type="button" data-bs-toggle="modal" data-bs-target="#sett{{ $dock->id }}"
                                    class="btn btn-outline-dark">Back</button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <form id="station-form{{ $dock->id }}" method="POST">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="CallSignLabel" class="form-label ">Station/CallSign:</label>
                                                <!-- Select -->


                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control mb-2" name="station"
                                                          {{--id="station" --}} placeholder="callsign" aria-label="callsign"
                                                        value="{{ old('station', $dock->station) }}">
                                                    {{-- <button class="btn btn-secondary mx-2" id="save-button4286"><i
                                                            class="fa-solid fa-check"></i> &nbsp; Check </button> --}}
                                                </div>

                                            </div>


                                            <div class="col">

                                                <label for="FrequencyLabel" class="col form-label">Category</label>
                                                <!-- Dropdown -->
                                                <div class="tom-select-custom">
                                                    <select name="category_id"  {{-- id="category_id" --}}
                                                        class="js-select form-select" autocomplete="off"
                                                        data-form-type="other">
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
                                                class="col-sm-3 col-form-label form-label">Frequency:</label>

                                            <div class="col">
                                                <div class="input-group input-group-sm-vertical">
                                                    <!-- Dropdown -->
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
                                                                {{--id="formInlineCheckTransmit"--}}  class="form-check-input"
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
                                                    placeholder="Description" aria-label="Description" value="">
                                            </div>
                                        </div>
                                        {{-- description end --}}
                                        {{-- save button start --}}
                                        <div class="col-sm mb-2 mb-sm-0">
                                            <div class="d-grid">
                                                <button class="btn btn-success mx-2" type="button"
                                                    id="save-button{{ $dock->id }}"><i
                                                        class="fa-solid fa-floppy-disk"></i> &nbsp; Save</button>
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
                                    $('#message{{ $dock->id }}').html('Dock Updaated successfully')
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
                                <span class="badge bg-danger rounded-pill">Under Development</span>



                                <button type="button" data-bs-toggle="modal" data-bs-target="#sett{{ $dock->id }}"
                                    class="btn btn-outline-dark">Back</button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <form id="station-form-add{{ $dock->id }}" method="POST">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="CallSignLabel" class="form-label ">Station/CallSign:</label>
                                                <!-- Select -->


                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control mb-2" name="station"
                                                        {{--id="station" --}}placeholder="callsign" aria-label="callsign"
                                                        value="">
                                                    <button class="btn btn-secondary mx-2" id="save-button4286"><i
                                                            class="fa-solid fa-check"></i> &nbsp; Check </button>
                                                </div>

                                            </div>


                                            <div class="col">

                                                <label for="FrequencyLabel" class="col form-label">Category</label>
                                                <!-- Dropdown -->
                                                <div class="tom-select-custom">
                                                    <select name="category_id"  {{-- id="category_id" --}}
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
                                                class="col-sm-3 col-form-label form-label">Frequency:</label>

                                            <div class="col">
                                                <div class="input-group input-group-sm-vertical">
                                                    <!-- Dropdown -->
                                                    <input type="float" class="form-control" name="frequency"
                                                        placeholder="Frequency" aria-label="" value="">


                                                    <!-- Form Check -->
                                                    <div class="form-check form-check-inline mx-2  mt-2">

                                                        <input type="hidden" name="rx_enabled" value="0">
                                                        <input type="checkbox" class="form-check-input" name="rx_enabled"
                                                            value="1">
                                                        <label class="form-check-label"
                                                            for="formInlineCheckReceived">Rx</label>

                                                        <div class="form-check form-check-inline ms-5"
                                                            style="margin-right: 50px">

                                                            <input type="hidden" name="tx_enabled" value="0">
                                                            <input type="checkbox" name="tx_enabled" value="1"
                                                     {{--id="formInlineCheckTransmit"--}}  class="form-check-input"
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
                                                    placeholder="Description" aria-label="Description" value="">
                                            </div>
                                        </div>
                                        {{-- description end --}}
                                        {{-- save button start --}}
                                        <div class="col-sm mb-2 mb-sm-0">
                                            <div class="d-grid">
                                                <button class="btn btn-success mx-2" type="button"
                                                    id="save-button-add{{ $dock->id }}"><i
                                                        class="fa-solid fa-floppy-disk"></i> &nbsp; Save1</button>
                                            </div>
                                        </div>
                                        {{-- save button 2 end --}}
                                    </form>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(function() {
                        $('#save-button-add{{ $dock->id }}').click(function() {
                            var form = $('#station-form-add{{ $dock->id }}');

                            $.ajax({
                                type: 'POST',
                                url: '{{ route('station.store') }}',
                                data: form.serialize(),
                                success: function(response) {
                                    $('#message_add{{ $dock->id }}').html(
                                            'Station Updaated successfully')
                                        .removeClass('error').addClass('success');
                                    form.trigger('reset');
                                },
                                error: function(response) {
                                    console.log(response);
                                    var errors = response.responseJSON.errors;
                                    var errorMessage = '';
                                    for (var key in errors) {
                                        errorMessage += '<p>' + errors[key][0] + '</p>';
                                    }
                                    $('#message_add{{ $dock->id }}').html(errorMessage).removeClass(
                                        'success').addClass('error');
                                }
                            });
                            $.ajax({
                                type: 'PUT',
                                url: '{{ route('stationdockupdate', ['id' => $dock->id]) }}',
                                data: form.serialize(),
                                success: function(response) {
                                    $('#message_add{{ $dock->id }}').html(
                                            'Dock Updaated successfully')
                                        .removeClass('error').addClass('success');
                                    form.trigger('reset');
                                },
                                error: function(response) {
                                    console.log(response);
                                    var errors = response.responseJSON.errors;
                                    var errorMessage = '';
                                    for (var key in errors) {
                                        errorMessage += '<p>' + errors[key][0] + '</p>';
                                    }
                                    $('#message_add{{ $dock->id }}').html(errorMessage).removeClass(
                                        'success').addClass('error');
                                }
                            });
                        });
                    });
                </script>
                {{-- end add station  --}}

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
                                        <div class="row mb-3">
                                            <label for="firstNameLabel" class="col-sm-2 col-form-label form-label">Dock
                                                Name</label>

                                            <div class="col-sm-10">
                                                <div class="input-group input-group-sm-vertical">
                                                    <input type="text" class="form-control"
                                                        id="dock_name{{ $dock->id }}" name="name"
                                                        placeholder="Name" aria-label="FirstName"
                                                        value="{{ old('name', $dock->name) }}" required>

                                                    {{-- <input type="text" class="form-control" name="lastName" id="lastNameLabel" placeholder="Last Name" aria-label="LastName"> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Form -->



                                        <!-- End Form -->

                                        <!-- End Add Phone Input Field -->

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
                                            <div class="col-sm-9">
                                                <div class="row mb-4 gx-3">

                                                    <div class="col-sm mb-2 mb-sm-0">
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

                                                    <div class="col-sm-5 mb-2 mb-sm-0">
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
                                                                                    <option value="">
                                                                                        Select State
                                                                                    </option>
                                                                                    <option value="4">
                                                                                        Thomas
                                                                                        Edison
                                                                                    </option>
                                                                                    <option value="1">
                                                                                        Illinois
                                                                                    </option>
                                                                                    <option value="3">
                                                                                        Nikola Tesla
                                                                                    </option>
                                                                                    <option value="5">
                                                                                        Arnold
                                                                                        Schwarzenegger
                                                                                    </option>

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


                                                    <div class="col-sm">
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


                                        <!-- Form -->
                                        <div class="row mb-2">
                                            <label class="col-sm-2 col-form-label form-label">Location</label>

                                            <div class="col-sm-4">
                                                <div class="input-group input-group-sm-vertical">
                                                    <!--  Check -->
                                                    <div class="row mb-5 me-3">


                                                        <div class="col-sm-17">
                                                            <input type="number" class="form-control" name="lon"
                                                                id="dock_lon{{ $dock->id }}" placeholder="Longitude"
                                                                aria-label="Longitude"
                                                                value="{{ old('lon', $dock->lon) }}">
                                                        </div>

                                                    </div>
                                                    <!-- End  Check -->


                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="input-group input-group-sm-vertical">


                                                    <!--  Check -->
                                                    <div class="row mb-5 ms-3">


                                                        <div class="col-sm-17">
                                                            <input type="number" class="form-control" name="lat"
                                                                id="dock_lat{{ $dock->id }}" placeholder="Latitude"
                                                                aria-label="Latitude"
                                                                value="{{ old('lat', $dock->lat) }}">
                                                        </div>
                                                    </div>
                                                    <!-- End  Check -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Form -->
                                        {{-- buttons start --}}


                                        {{-- button end --}}
                                    </form>
                                    <hr class="my-2">
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
                                                    <label for="message111{{ $dock->id }}"><b> Speaker
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
                                                        class="border border-5" type="number"
                                                        style="border: 1px solid #ccc; padding: 2px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;"
                                                        value="{{ $dock->setting_speaker_volume }}">
                                                </form>



                                                <form method="post" action="{{ route('mqtt.publish') }}">
                                                    @csrf
                                                    <label for="message7{{ $dock->id }}"><b> Transmit</b></label>
                                                    <input type="hidden" name="message"
                                                        id="message7{{ $dock->id }}"
                                                        value="{{ $dock->setting_speaker_out }}">
                                                    <input type="range" class="me-2" name="slider"
                                                        id="slider7{{ $dock->id }}" min="0" max="100"
                                                        value="{{ $dock->setting_speaker_out }}">
                                                    <input type="hidden" name="topic" id="topic7{{ $dock->id }}"
                                                        value="{{ $dock->mac }}/set/tx_vol">
                                                    <input id="slider-value7{{ $dock->id }}" type="number"
                                                        class="border border-5" contenteditable="true"
                                                        value="{{ $dock->setting_speaker_out }}"
                                                        style="border: 1px solid #ccc; padding: 2px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">
                                                </form>

                                                <form method="post" action="{{ route('mqtt.publish') }}">
                                                    @csrf
                                                    <label for="message17{{ $dock->id }}"><b>
                                                            Notification</b></label>
                                                    <input type="hidden" name="message"
                                                        id="message17{{ $dock->id }}"
                                                        value="{{ $dock->playback_vol }}">
                                                    <input type="range" class="me-2" name="slider"
                                                        id="slider17{{ $dock->id }}" min="0" max="100"
                                                        value="{{ $dock->playback_vol }}">
                                                    <input type="hidden" name="topic"
                                                        id="topic17{{ $dock->id }}"
                                                        value="{{ $dock->mac }}/set/playback_vol">
                                                    <input type="number" id="slider-value17{{ $dock->id }}"
                                                        class="border border-5" contenteditable="true"
                                                        value="{{ $dock->playback_vol }}"
                                                        style="border: 1px solid #ccc; padding: 2px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">
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
                                                <input type="hidden" name="message" id="message3{{ $dock->id }}"
                                                    value="{{ $dock->setting_min_recording }}">
                                                <input type="range" class="me-1" name="slider"
                                                    id="slider3{{ $dock->id }}" min="0" max="30000"
                                                    value="{{ $dock->setting_min_recording }}">
                                                <input type="hidden" name="topic" id="topic3{{ $dock->id }}"
                                                    value="{{ $dock->mac }}/set/min_rec_sec">
                                                <input type="number" id="slider-value3{{ $dock->id }}"
                                                    class="border border-5" contenteditable="true"
                                                    value="{{ number_format($dock->setting_min_recording / 1000, 1) }}"
                                                    style="border: 1px solid #ccc; padding: 2px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">
                                            </form>


                                            <form method="post" action="{{ route('mqtt.publish') }}">
                                                @csrf
                                                <label for="message4{{ $dock->id }}"><b> Maximum Size
                                                        (sec)</b></label>
                                                <input type="hidden" name="message" id="message4{{ $dock->id }}"
                                                    value="{{ $dock->setting_max_recording }}">
                                                <input type="range" class="me-1" name="slider"
                                                    id="slider4{{ $dock->id }}" min="0" max="60000"
                                                    value="{{ $dock->setting_max_recording }}">
                                                <input type="hidden" name="topic" id="topic4{{ $dock->id }}"
                                                    value="{{ $dock->mac }}/set/max_rec_sec">
                                                <input id="slider-value4{{ $dock->id }}" class="border border-5"
                                                    type="number" contenteditable="true"
                                                    value="{{ number_format($dock->setting_max_recording / 1000, 1) }}"
                                                    style="border: 1px solid #ccc; padding: 2px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">
                                            </form>


                                            <form method="post" action="{{ route('mqtt.publish') }}">
                                                @csrf
                                                <label for="message5{{ $dock->id }}"><b> Silence (sec)</b></label>
                                                <input type="hidden" name="message" id="message5{{ $dock->id }}"
                                                    value="{{ $dock->setting_silence }}">
                                                <input type="range" class="me-1" name="slider"
                                                    id="slider5{{ $dock->id }}" min="0" max="10000"
                                                    value="{{ $dock->setting_silence }}">
                                                <input type="hidden" name="topic" id="topic5{{ $dock->id }}"
                                                    value="{{ $dock->mac }}/set/audio_stop_silence​">
                                                <input id="slider-value5{{ $dock->id }}" class="border border-5"
                                                    type="number" contenteditable="true"
                                                    value="{{ number_format($dock->setting_silence / 1000, 1) }}"
                                                    style="border: 1px solid #ccc; padding: 2px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">
                                            </form>



                                        </div>
                                    </div>
                                    {{-- <hr class="my-2">
                                    <div class="row">
                                        <h2 class="mb-4">Boondock AI&ZeroWidthSpace;</h2>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <!-- <label class="label">Default:</label> -->

                                                <!-- Switch -->
                                                <label class="label mb-2"><b> Audio to text</b> </label>
                                                <div class="form-check form-switch form-switch-between mb-6">
                                                    <label class="form-check-label">Off</label>
                                                    <input type="checkbox" class="form-check-input"
                                                        id="audiototext{{ $dock->id }}"
                                                        @if ($dock->audiototext == 1) checked @endif>
                                                    <label class="form-check-label">On</label>
                                                </div>


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


                                    </div> --}}
                                    <hr class="my-2">
                                    <div class="row mt-4 mr-2">

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
                                                        data-id="" data-bs-target="#wifi_set{{ $dock->id }}"><i
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
                                                    $('#slider111{{ $dock->id }}').val('5');
                                                    $('#slider-value111{{ $dock->id }}').html(5);

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
                                    <div class="" role="alert" id="notificationadv{{ $dock->id }}"></div>


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




    </main>
@endsection
