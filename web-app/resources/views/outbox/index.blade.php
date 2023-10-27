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
</style>
{{-- style for table --}}
<style>
 

    table th,
    table td {
      padding: .625em;
      text-align: center;
    }
    
    table th {
      font-size: .85em;
      letter-spacing: .1em;
      text-transform: uppercase;
    }
    
    @media screen and (max-width: 600px) {
        tr.hide-in-mobile {
                display: none;
            }
      table {
        border: 0;
      }
    
      table caption {
        font-size: 1.3em;
      }
      
      table thead {
        border: none;
        clip: rect(0 0 0 0);
        height: 1px;
       
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
      }
      
      table tr {
        border-bottom: 1px solid #ddd;
        display: block;
       
      }
      
      table td {
        border-bottom: 1px solid #ddd;
        display: block;
        font-size: .8em;
        text-align: right;
      }
      
      table td::before {
        /*
        * aria-label has no advantage, it won't be read inside a table
        content: attr(aria-label);
        */
        content: attr(data-label);
        float: left;
        font-weight: bold;
        text-transform: uppercase;
      }
      
      table td:last-child {
        border-bottom: 0;
      }
    
      tr:nth-child(even) {
      background-color: rgba(250, 250, 250, 0.589);
    }
    }
    
    
        
    </style>

@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong>{{ $message }}</strong>
                </div>
            @endif

          

            <!-- Stats -->
            <div class="row">

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Total audioFiles</h6>

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
                            <h6 class="card-subtitle mb-2">Total Docks (active)</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span class="js-counter display-4 text-dark">
                                        {{ $totalActiveDocks }}
                                    </span>
                                    <span class="text-body fs-5 ms-1">from {{ $totalDocks }}</span>
                                </div>
                                <!-- End Col -->


                                <!-- End Col -->
                            </div>
                            <!-- End Row -->
                        </div>
                    </div>
                    <!-- End Card -->
                </div>

            </div>
            <!-- End Stats -->

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
                                <a class="btn btn-outline-danger btn-sm" href="javascript:;">
                                    <i class="bi-trash"></i> Delete
                                </a>
                            </div>
                        </div>
                        <!-- End Datatable Info -->

                        <!-- export -->

                        <!-- End Dropdown -->

                        <!-- filter -->
                        <!-- Dropdown -->
                        <div class="dropdown">
                            <button type="button" class="btn btn-white btn-sm w-100" id="usersFilterDropdown"
                                data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                <i class="bi-filter me-1"></i> Filter <span
                                    class="badge bg-soft-dark text-dark rounded-circle ms-1"></span>
                            </button>

                            <div class="dropdown-menu dropdown-menu-sm-end dropdown-card card-dropdown-filter-centered"
                                aria-labelledby="usersFilterDropdown" style="min-width: 22rem;">
                                <!-- Card -->
                                <div class="card">
                                    <div class="card-header card-header-content-between">
                                        <h5 class="card-header-title">Audios Per Page</h5>

                                        <!-- Toggle Button -->
                                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm ms-2">
                                            <i class="bi-x-lg"></i>
                                        </button>
                                        <!-- End Toggle Button -->
                                    </div>

                                    <div class="card-body">
                                        <form>


                                            <form class="form-inline my-2 my-lg-0 mb-4">
                                                <select name="per_page" class="form-control mr-sm-2">
                                                    {{-- <option value="2">2</option> --}}
                                                    <option value="5">5</option>
                                                    <option value="10">10</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                                {{-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Filter</button> --}}
                                                {{-- </form> --}}
                                                <!-- End Row -->

                                                <div class="d-grid mt-4">
                                                    {{-- <a class="btn btn-primary" type="submit" href="javascript:;">Apply</a> --}}
                                                    <button class="btn btn-primary" type="submit">Filter</button>
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
                   "pageLength": {{$per_page}},
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
                                <th>message</th>
                                {{-- <th>Portfolio</th> --}}
                                <th>Received</th>
                                <th> Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($audioFiles as $key => $audioFile)
                                <tr>
                                    <td class="table-column-pe-0">
                                        {{-- <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="datatableCheckAll1">
                                            <label class="form-check-label" for="datatableCheckAll1"></label>
                                        </div> --}}
                                        {{ $key + 1 + ($audioFiles->currentPage() - 1) * $audioFiles->perPage() }}
                                    </td>
                                    <td data-label="Station">
                                        <a class="d-flex align-items-center text-dark" href="#">
                                           
                                            <div class="flex-grow-1 ms-3">

                                                <span class="text-inherit">
                                                    {{ $audioFile->station ?? 'DOCK nOT fOUND' }}

                                                    ({{ $audioFile->frequency ?? 'DOCK nOT fOUND' }})
                                                </span>

                                            </div>
                                        </a>
                                    </td>

                                    <td data-label="Audio">
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
                                    <td data-label="Message">
                                            <a data-bs-toggle="tooltip" title="{{ $audioFile->transcribe_long }}">
                                                </b>
                                                @if (empty($audioFile->transcribe_long))
                                                    <a href="{{ route('transcribe-audio', $audioFile->id) }}"
                                                        id="transcribe-button-{{ $audioFile->id }}"
                                                        class="btn btn-outline-info me-1 mb-1">
                                                        <span class="spinner-border spinner-border-sm d-none"
                                                            role="status" aria-hidden="true"></span> Transcribe Audio </a>


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
                                    <td data-label="Actions">

                                        {{-- <form action="{{ route('inbox.delete', $audioFile->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"> <i
                                                    class="bi-trash me-1"></i> </button>

                                        </form> --}}

                                        {{-- <a class="btn btn-outline-info " id="send-button{{ $audioFile->id }}"> <i
                                                class="bi-send me-1"></i>Send

                                        </a> --}}

                                        {{-- <i
                                                class="bi-send-check me-1" style="font-size: 2rem; color: cornflowerblue;"></i> --}}

                                        {{-- model setting start --}}



                                        {{-- model setting end --}}
                                        <a class="btn btn-outline-success" id="play-button{{ $audioFile->id }}"> <i
                                            class="bi-play-circle me-2"></i>Play</a>
                                        {{-- <form method="POST" action="{{ route('inbox.delete', $audioFile->id) }}"
                                            style="display:inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger">
                                                <i class="bi-trash me-1"></i>
                                            </button>
                                        </form> --}}
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
                                            $(this).removeClass('btn-outline-info').addClass('btn-secondary').html('<i class="bi-check2-all me-1"></i> Sent');
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
                                                },
                                                error: function(error) {
                                                    console.log(error);
                                                }
                                            });
                                        });
                                        // play Cloud
                                        $('#play-button{{ $audioFile->id }}').on('click', function() {


                                            $(this).addClass('blink').html(
                                                    '<i class="bi-music-note-beamed me-1"></i> Playing..');

                                            // Remove the "blink" class from the button after 5 seconds
                                            setTimeout(function() {
                                                $('#play-button{{ $audioFile->id }}').removeClass('blink').removeClass(
                                                    'btn-outline-success').addClass('btn-outline-secondary').html(
                                                    '<i class="bi-arrow-clockwise me-1"></i>&nbsp; Replay &nbsp;');
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
                        </tbody>
                    </table>
                </div>
                <!-- Footer -->
                <div class="card-footer">
                    <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                        <div class="col-sm mb-2 mb-sm-0">
                            {!! $audioFiles->appends(['per_page' => $per_page])->render() !!} </div>
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


        </div>

    </main>
@endsection
