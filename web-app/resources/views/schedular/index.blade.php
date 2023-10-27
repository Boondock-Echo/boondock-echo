@extends('layouts.app1')


@section('content')

    <main id="content" role="main" class="main">
        {{-- scheduler starts here --}}
        <!-- Card -->
        <div class="card mx-4 my-4">
            <div class="card-header card-header-content-md-between">


                <!-- Nav -->
                <div class="card-header-title">
                    <ul class="nav nav-segment bg-light" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="nav-one-eg1-tab" href="#nav-one-eg1" data-bs-toggle="pill"
                                data-bs-target="#nav-one-eg1" role="tab" aria-controls="nav-one-eg1"
                                aria-selected="true">Task List </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-two-eg1-tab" href="#nav-two-eg1" data-bs-toggle="pill"
                                data-bs-target="#nav-two-eg1" role="tab" aria-controls="nav-two-eg1"
                                aria-selected="false">History</a>
                        </li>

                    </ul>
                </div>
                <!-- End Nav -->
                <!-- Button trigger modal -->
                <small class="text-muted"><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModalScrollable">
                        <i class="bi bi-plus-circle mx-2"></i>Create New Schedule
                    </button></small>
                <!-- End Button trigger modal -->

                <!-- Modal -->
                <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog " role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalScrollableTitle">Audio Recording Scheduler</h5>
                                <!-- Nav -->
                                <ul class="" role="tablist">
                                   
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                
                                </ul>
                                <!-- End Nav -->
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('schedular.store') }}">
                                    @csrf
                                <!-- Tab Content -->
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="nav-one-eg2" role="tabpanel"
                                        aria-labelledby="nav-one-eg2-tab">
                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif


                                        <!-- Form -->
                                        <div class="row mb-4">
                                            <label for="organizationLabel" class="col-sm-3 col-form-label form-label">Dock
                                                Name</label>

                                            <div class="col-sm-9">
                                                <!-- Select -->
                                                <div class="tom-select-custom">
                                                    <select name="dock_id" class="js-select form-select" autocomplete="off"
                                                        data-hs-tom-select-options='{
                                                                    "placeholder": "Select Dock...",
                                                                    "hideSearch": true
                                                                }' required>
                                                        <option value="" aria-placeholder="">Select a Dock
                                                        </option>
                                                        @foreach ($docks as $dock)
                                                        @if ($dock->mac != auth()->id())
                                                        <option value="{{ $dock->id }}" {{ old('dock_id') == $dock->id ? 'selected' : '' }}>
                                                            {{ $dock->name }}
                                                        </option>
                                                        @endif
                                                    @endforeach
                                                    </select>
                                                </div>
                                                <!-- End Select -->
                                            </div>
                                        </div>
                                        <!-- End Form -->




                                        <!-- Form -->
                                        <div class="row">
                                            <div id="timeForm">
                                                <div class="row mb-3">
                                                    <div class="col-3">
                                                        <label for="type"
                                                            class="text-black  col-form-label form-label">Duration</label>
                                                    </div>
                                                    <div class="col-9">
                                                        <select name="type" class="form-control" id="type" onchange="handleChange()">
                                                            <option value="daily" {{ old('type') == 'daily' ? 'selected' : '' }}>Daily</option>
                                                            <option value="weekly" {{ old('type') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                                            <option value="monthly" {{ old('type') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                                            <option value="custom" {{ old('type') == 'custom' ? 'selected' : '' }}>Once</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row" id="weekdays" style="display: none;">
                                                    <div class="col-sm-3 mb-2">
                                                        <label for="week_day">Select Weekday:</label>
                                                    </div>
                                                    <div class="col-sm-9 mb-2">
                                                        <select name="week_day" class="form-control" id="week_day">
                                                            <option value="">-- None --</option>
                                                            <option value="Monday">Monday</option>
                                                            <option value="Tuesday">Tuesday</option>
                                                            <option value="Wednesday">Wednesday</option>
                                                            <option value="Thursday">Thursday</option>
                                                            <option value="Friday">Friday</option>
                                                            <option value="Saturday">Saturday</option>
                                                            <option value="Sunday">Sunday</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row" id="dayOfMonth" style="display: none;">
                                                    <div class="col-sm-3 mb-2">
                                                        <label for="day_of_month">Select day of the month:</label>
                                                    </div>
                                                    <div class="col-sm-9 mb-2">
                                                        <select class="form-control" name="day_of_month"
                                                            id="day_of_month">
                                                            <option value="">-- None --</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                            <option value="13">13</option>
                                                            <option value="14">14</option>
                                                            <option value="15">15</option>
                                                            <option value="16">16</option>
                                                            <option value="17">17</option>
                                                            <option value="18">18</option>
                                                            <option value="19">19</option>
                                                            <option value="20">20</option>
                                                            <option value="21">21</option>
                                                            <option value="22">22</option>
                                                            <option value="23">23</option>
                                                            <option value="24">24</option>
                                                            <option value="25">25</option>
                                                            <option value="26">26</option>
                                                            <option value="27">27</option>
                                                            <option value="28">28</option>
                                                            <option value="29">29</option>
                                                            <option value="30">30</option>
                                                            <option value="31">31</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row" id="customDate" style="display: none;">
                                                    <div class="col-sm-3 mb-2">
                                                        <label for="date"></label>
                                                    </div>
                                                    <div class="col-sm-9 mb-2">
                                                        <input type="date" class="form-control" name='date'
                                                            id="date">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-3">
                                                        <label for="startTime" class="col-form-label form-label">
                                                            Time</label>
                                                    </div>
                                                    <div class="col-9">
                                                        <input type="time" class="form-control" name="time" id="time"
                                                        value="{{ old('time') }}" required>
                                                    </div>
                                                </div>

                                                <div class="row" id="result" style="display: none;">
                                                    <div class="col-3">
                                                        <label for="details" class="col-form-label form-label"></label>
                                                    </div>
                                                    <div class="col-9">
                                                        <p id="details"></p>


                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Form -->
                                            <div class="row mb-4">
                                                <label for="task" class="col-sm-3 col-form-label form-label">Task</label>
                                    
                                                <div class="col-sm-9">
                                                    <select class="form-select"  name="task">
                                                        <option value="reboot" {{ old('task') == 'Restart' ? 'selected' : '' }}>Restart</option>
                                                        <option value="record_line_in_on" {{ old('task') == 'record_line_in' ? 'selected' : '' }}>
                                                            Enable Recording
                                                        </option>
                                                        <option value="record_line_in_off" {{ old('task') == 'DisableRecording' ? 'selected' : '' }}>
                                                            Disable Recording
                                                        </option>
                                                        <option value="set_speaker_on" {{ old('task') == 'set_speaker_on' ? 'selected' : '' }}>Speaker On
                                                        </option>
                                                        <option value="set_speaker_off" {{ old('task') == 'set_speaker_off' ? 'selected' : '' }}>Speaker Off
                                                        </option>
                                                        <option value="upload_on" {{ old('task') == 'upload_on' ? 'selected' : '' }}>Upload On
                                                        </option>
                                                        <option value="upload_off" {{ old('task') == 'upload_off' ? 'selected' : '' }}>Upload Off
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="description" class="col-sm-3 col-form-label form-label">Description</label>
                                    
                                                <div class="col-sm-9">
                                                    <textarea id="description" class="form-control" name="description" placeholder="Description"
                                                        rows="1">{{ old('description') }}</textarea>
                                                </div>
                                            </div>

                                            <!-- End Form -->
                                        </div>

                                        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                                        <script>
                                            function handleChange() {
                                                var type = $('#type').val();

                                                if (type === 'daily') {
                                                    $('#weekdays').hide();
                                                    $('#dayOfMonth').hide();
                                                    $('#customDate').hide();
                                                    updateDetails();
                                                } else if (type === 'weekly') {
                                                    $('#weekdays').show();
                                                    $('#dayOfMonth').hide();
                                                    $('#customDate').hide();
                                                    updateDetails();
                                                } else if (type === 'monthly') {
                                                    $('#weekdays').hide();
                                                    $('#dayOfMonth').show();
                                                    $('#customDate').hide();
                                                    updateDetails();
                                                } else if (type === 'custom') {
                                                    $('#weekdays').hide();
                                                    $('#dayOfMonth').hide();
                                                    $('#customDate').show();
                                                    updateDetails();
                                                }
                                            }

                                            function updateDetails() {
                                                var type = $('#type').val();
                                                var time = $('#time').val();
                                                var details = '';

                                                if (type === 'daily') {
                                                    details += 'Daily - Time: ' + time;
                                                } else if (type === 'weekly') {
                                                    var week_day = $('#week_day').val();
                                                    details += 'Weekly - week_day: ' + week_day + ' Time: ' + time;
                                                } else if (type === 'monthly') {
                                                    var day_of_month = $('#day_of_month').val();
                                                    details += 'Every Month - Day: ' + day_of_month + ' Time: ' + time;
                                                } else if (type === 'custom') {
                                                    var date = $('#date').val();
                                                    details += 'Once - Date: ' + date + ' Time: ' + time;
                                                }

                                                $('#details').text(details);
                                                $('#result').show();
                                            }

                                            $(document).ready(function() {
                                                handleChange(); // Call handleChange() initially to set up the form
                                            });

                                            $('#timeForm').change(function() {
                                                updateDetails();
                                            });
                                        </script>

                                        <!-- End Form -->

                                    </div>

                                    {{-- <div class="tab-pane fade" id="nav-two-eg2" role="tabpanel"
                                        aria-labelledby="nav-two-eg2-tab">
                                        <p>Second tab content...</p>
                                    </div> --}}

                                    {{-- <div class="tab-pane fade" id="nav-three-eg2" role="tabpanel" aria-labelledby="nav-three-eg2-tab">
                                        <p>Third tab content...</p>
                                        </div> --}}
                                </div>
                                <!-- End Tab Content -->
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                {{-- <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button> --}}
                                <button type="submit" class="btn btn-primary d-flex justify-content-center">Save Changes</button>
                                
                            </div>
                        </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-body">


                <!-- Tab Content -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="nav-one-eg1" role="tabpanel"
                        aria-labelledby="nav-one-eg1-tab">
                        <!-- Table -->
                        <div class="">
                            <!-- Header -->
                            <div class="card-header">
                                <div class="row justify-content-between align-items-center flex-grow-1">
                                    <div class="col-12 col-md">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-header-title">List of schedulars</h5>
                                        </div>
                                    </div>
                                    <div class="col-auto">

                                       
                                        <!-- Select -->
                                        <div class="tom-select-custom">
                                          <select class="js-select js-datatable-filter form-select form-select-sm form-select-borderless" autocomplete="off"
                                                  data-target-column-index="1"
                                                  data-target-table="datatable"
                                                  data-hs-tom-select-options='{
                                                  "searchInDropdown": false,
                                                  "hideSearch": true,
                                                  "dropdownWidth": "10rem"
                                                }'>
                                            <option value="null" selected>All</option>
                                            <option value="Daily">Daily</option>
                                            <option value="Weekly">Weekly</option>
                                            <option value="Monthly">Monthly</option>
                                            <option value="Once">Once</option>
                                            
                                          </select>
                                        </div>
                                        <!-- End Select -->
                                      </div>

                                    <div class="col-auto">
                                        <!-- Filter -->
                                        <form>
                                            <!-- Search -->
                                            <div class="input-group input-group-merge input-group-flush">
                                                <div class="input-group-prepend input-group-text">
                                                    <i class="bi-search"></i>
                                                </div>
                                                <input id="datatableSearch" type="search" class="form-control"
                                                    placeholder="Search schedule" aria-label="Search schedule ">
                                            </div>
                                            <!-- End Search -->
                                        </form>
                                        <!-- End Filter -->
                                    </div>
                                </div>
                            </div>
                            <!-- End Header -->

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
                           "pageLength": 10,
                           "isResponsive": false,
                           "isShowPaging": false,
                           "pagination": "datatablePagination"
                         }'>
                                    <thead class="thead-light">
                                        <tr class="hide-in-mobile">
 
                                            <th class="sorting text-dark ">Dock Name</th>
                                            <th class="sorting text-dark">Scheduled <br>Dates</th>
                                            <th class="sorting text-dark">Enabled</th>
                                            <th class="sorting text-dark">Task</th>
                                          
                                            <th class="sorting text-dark">Description</th>
                                            <th class="sorting text-dark">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($schedules as $schedule)
                                        <tr>
                                            <td class="table-column-p-0" data-label="Dock Name">
                                                @isset($schedule->dock)
                                                    <span class="d-block h5 text-inherit mb-0">{{ $schedule->dock->name }}</span>
                                                @else
                                                    <span class="d-block h5 text-inherit mb-0">Dock not available</span>
                                                @endisset
                                            </td>
                                            
                                            <td class="table-column-p-0" data-label="Schedule Date">
                                                <span class="d-block text-dark text-inherit mb-0">
                                                    @if($schedule->type == 'weekly')
                                                        {{ ucfirst($schedule->type) }} - {{ $schedule->week_day }} - {{ substr($schedule->time, 0, 5) }}
                                                    @elseif($schedule->type == 'monthly')
                                                        {{ ucfirst($schedule->type) }} - {{ $schedule->day_of_month }} - {{ substr($schedule->time, 0, 5) }}
                                                    @elseif($schedule->type == 'daily')
                                                        {{ ucfirst($schedule->type) }} - {{ substr($schedule->time, 0, 5) }}
                                                    @elseif($schedule->type == 'custom')
                                                        {{ ucfirst($schedule->type) }} - {{ $schedule->date }} - {{ substr($schedule->time, 0, 5) }}
                                                    @else
                                                        Unknown schedule type
                                                    @endif
                                                </span>
                                                
                                            </td>
                                            
                                            
                                            <td class="table-column-p-0" data-label="Enabled">
                                                <span class="badge {{ isset($schedule->is_enabled) && $schedule->is_enabled ? 'bg-success' : 'bg-secondary' }}">
                                                    @isset($schedule->is_enabled)
                                                        {{ $schedule->is_enabled ? 'Active' : 'Inactive' }}
                                                    @else
                                                        Status not available
                                                    @endisset
                                                </span>
                                            </td>
                                            
                                            
                                            <td class="table-column-p-0" data-label="Task">
                                                <span class="d-block text-dark text-inherit mb-0">@if ($schedule->task === 'upload_off')
                                                    Uploading off
                                                    @elseif ($schedule->task === 'upload_on')
                                                    Uploading On
                                                    @elseif ($schedule->task === 'record_line_in_off')
                                                    Recording Off
                                                    @elseif ($schedule->task === 'record_line_in_on')
                                                    Recording On
                                                    @elseif ($schedule->task === 'set_speaker_on')
                                                    Speaker On
                                                    @elseif ($schedule->task === 'set_speaker_off')
                                                    Speaker Off
                                                    @elseif ($schedule->task === 'reboot')
                                                    Restart
                                                @else
                                                {{$schedule->task}}
                                                @endif
                                            </span>
                                            </td>
                                          
                                            <td class="table-column-p-0" data-label="Description">
                                                @if ($schedule->description)
                                                    <span class="d-block  text-inherit mb-0">{{ $schedule->description }}</span>
                                                @else
                                                    <span class="d-block  text-inherit mb-0">-</span>
                                                @endif
                                            </td>
                                            <td class="table-column-p-0" data-label="">
                                                <div style="display: flex; gap: 5px;">
                                                    @if ($schedule->is_enabled)
                                                        <form action="{{ route('schedular.disable', $schedule->id) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-outline-secondary btn-sm" style="width: 120px;">
                                                                <i class="bi-toggle-off me-1"></i>Deactivate
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('schedular.activate', $schedule->id) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-outline-primary btn-sm" style="width: 120px;">
                                                                <i class="bi-toggle-on me-1"></i>Activate
                                                            </button>
                                                        </form>
                                                    @endif
                                            
                                                    {{-- <form action="{{ route('schedular.destroy', $schedule->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="bi-trash me-1"></i>Delete
                                                        </button>
                                                    </form>
                                                     --}}
                                                     <!-- Button to trigger the modal -->
<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalCenterdelete{{$schedule->id}}">
    <i class="bi-trash me-1"></i>Delete
</button>

<!-- Modal -->
<div id="exampleModalCenterdelete{{$schedule->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content text-center">
            <div class="modal-body">
                <p class="text-dark">Do you really want to delete this record? This process cannot be undone.</p>
                <button type="button" class="btn btn-soft-dark mx-4" data-bs-dismiss="modal">Cancel</button>
                <!-- Form to handle the delete action -->
                <form action="{{ route('schedular.destroy', $schedule->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-soft-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

                                                </div>
                                            </td>
                                                                                        
                                                                                        
                                        </tr>
                                        
                                        @endforeach
                                        

                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table -->

                            <!-- Footer -->
                            <div class="card-footer">
                                <!-- Pagination -->
                                <div class="d-flex justify-content-center justify-content-sm-end">
                                    <nav id="datatableWithSearchPagination" aria-label="Activity pagination"></nav>
                                </div>
                                <!-- End Pagination -->
                            </div>
                            <!-- End Footer -->
                        </div>
                        <!-- End Table -->
                    </div>

                    <div class="tab-pane fade" id="nav-two-eg1" role="tabpanel" aria-labelledby="nav-two-eg1-tab">

                    {{-- schedular history strat --}}
                   <!-- Card -->
<div class="">
    {{-- <div class="card-header card-header-content-md-between mb-3">
      <h3 class="card-header-title">History List</h3>
      <form>
      
        <div class="input-group input-group-merge input-group-flush">
            <div class="input-group-prepend input-group-text">
                <i class="bi-search"></i>
            </div>
            <input id="datatableSearch" type="search" class="form-control" placeholder="Search schedule" aria-label="Search schedule">
        </div>
    
    </form>
    </div> --}}
        <style>
            .hover-content .date-time {
                visibility: visible;
            }
        
            .hover-content:hover .date-time {
                visibility: hidden;
            }
        
            .hover-content .delete-btn {
                visibility: hidden;
            }
        
            .hover-content:hover .delete-btn {
                visibility: visible;
            }
        </style>
  @if($schedulerLogs->isEmpty())
    <div class="text-center p-4">
        <img class="mb-3" src="{{ asset('assets/svg/illustrations/oc-error.svg') }}" alt="Image Description" style="width: 25%;" data-hs-theme-appearance="default">
        <img class="mb-3" src="{{ asset('assets/svg/illustrations-light/oc-error.svg') }}" alt="Image Description" style="width: 25%;" data-hs-theme-appearance="dark">
        <p class="mb-0">No data to show</p>
        
      </div>

  @else
    @foreach($schedulerLogs as $log)
        <div class="row my-2 show-hide" >
            @if($log->schedule)
                <div class="col-lg-3 col-sm-12 col-md-3" >
                    <div class="d-flex align-items-center ms-lg-3">
                        {{-- <input type="checkbox" id="" class="form-check-input me-3"> --}}
                        <span class="text-dark"
                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $log->id }}" aria-expanded="true" aria-controls="collapseOne">
                      @isset($log->schedule)
                          @isset($log->schedule->dock)
                              {{ $log->schedule->dock->name }}
                          @else
                              Dock name not available
                          @endisset
                      @else
                          Schedule data not available
                      @endisset
                  </span>
                  
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-6"
     data-bs-toggle="collapse" data-bs-target="#collapse{{ $log->id }}" aria-expanded="true" aria-controls="collapseOne">
    <p class="text-dark">
        @isset($log->schedule)
            @isset($log->schedule->type)
                @if($log->schedule->type === 'monthly')
                    <span class="badge bg-soft-primary text-primary me-1">Monthly</span>
                    on {{ $log->schedule->day_of_month }}
                @elseif($log->schedule->type === 'weekly')
                    <span class="badge bg-soft-primary text-primary me-1">Weekly</span>
                    on {{ $log->schedule->week_day }}
                @else
                    <span class="badge bg-soft-primary text-primary me-1">Daily</span>
                @endif
            @else
                <span class="badge bg-soft-primary text-primary me-1">Type not available</span>
            @endisset

            recording for
            <span class="h5">
                @isset($log->schedule->task)
                    @if($log->schedule->task === 'record_line_in_on')
                        <span class="h5 text-dark"> Recording On</span>
                        {{ $log->schedule->day_of_month }}
                    @elseif($log->schedule->task === 'record_line_in_off')
                        <span class="h5 text-dark"> Recording Off</span>
                    @elseif($log->schedule->task === 'set_speaker_on')
                        <span class="h5 text-dark"> Speaker On</span>
                    @elseif($log->schedule->task === 'set_speaker_off')
                        <span class="h5 text-dark"> Speaker Off</span>
                    @elseif($log->schedule->task === 'upload_on')
                        <span class="h5 text-dark">Uploading On</span>
                    @elseif($log->schedule->task === 'upload_off')
                        <span class="h5 text-dark">Uploading Off</span>
                    @else
                        <span class="h5 text-dark">Restart</span>
                    @endif
                @else
                    <span class="h5 text-dark">Task not available</span>
                @endisset
            </span> task.
        @else
            Schedule data not available
        @endisset
    </p>
</div>

                <div class="col-lg-3 col-sm-12 col-md-3">
                    <div class="d-flex align-items-center justify-content-end">
                        <span class="date-time">{{ $log->schedule->scheduled_datetime }}
                        <span class="show-hide-icon mx-1">|</span>
                        
                            {{-- <i class="bi-trash show-hide-icon text-danger"></i> --}}
 
                            {{-- <a href="{{ route('scdeularLog_delete', $log->id) }}"
                                onclick="event.preventDefault();
                                         if (confirm('Are you sure you want to delete this schedule from history?')) {
                                             document.getElementById('delete-form-{{ $log->id }}').submit();
                                         }"
                                class="">
                                
                                 <i class="bi-trash me-1 show-hide-icon"></i>
                             </a>
                             
                             <form id="delete-form-{{ $log->id }}" action="{{ route('scdeularLog_delete', $log->id) }}" method="POST" style="display: none;">
                                 @csrf
                                 @method('DELETE')
                             </form> --}}
                             <!-- Button to trigger the modal -->
<a href="#" onclick="event.preventDefault(); showConfirmationModal({{ $log->id }});" class="">
    <i class="bi-trash me-1 show-hide-icon"></i>
</a>

<!-- Modal -->
<div id="confirmationModal{{ $log->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content text-center">
            <div class="modal-body">
                <p class="text-dark">Are you sure you want to delete this task from history?</p>
                <button type="button" class="btn btn-soft-dark mx-4" data-bs-dismiss="modal">Cancel</button>
                <!-- Form to handle the delete action -->
                <form id="delete-form-{{ $log->id }}" action="{{ route('scdeularLog_delete', $log->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-soft-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<script>
    function showConfirmationModal(logId) {
        var modalId = "confirmationModal" + logId;
        var modalElement = document.getElementById(modalId);
        var deleteForm = document.getElementById('delete-form-' + logId);
        
        if (modalElement && deleteForm) {
            modalElement.classList.add('show');
            modalElement.style.display = 'block';
            
            var backdropElement = document.createElement('div');
            backdropElement.classList.add('modal-backdrop', 'fade', 'show');
            document.body.appendChild(backdropElement);
            
            modalElement.addEventListener('click', function (event) {
                if (event.target === modalElement) {
                    modalElement.classList.remove('show');
                    modalElement.style.display = 'none';
                    backdropElement.remove();
                }
            });
            
            var cancelBtn = modalElement.querySelector('[data-bs-dismiss="modal"]');
            if (cancelBtn) {
                cancelBtn.addEventListener('click', function () {
                    modalElement.classList.remove('show');
                    modalElement.style.display = 'none';
                    backdropElement.remove();
                });
            }
            
            var confirmBtn = modalElement.querySelector('.btn-soft-danger');
            if (confirmBtn) {
                confirmBtn.addEventListener('click', function () {
                    deleteForm.submit();
                });
            }
        }
    }
</script>

                             
                     </span>
                    </div>
                </div>
                <div class="col-12 collapse me-4" id="collapse{{ $log->id }}">
                   <!-- Card -->
                   <div class="card-body">
                    <div class="card-text">
                       
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    {{-- <p>Recording Task: Enable Recording</p> --}}
                                </div>
                                <div class="flex-grow-1 ms-5">
                                    @if(empty($description))
                                        <p>No data to show</p>
                                    @else
                                        <p>{{ old('$description') }}</p>
                                    @endif
                                </div>
                                
                                <div class="d-flex align-items-center">
                                    {{-- <button type="submit" class="btn btn-link delete-btn">
                                        <i class="bi-trash me-1"></i>
                                    </button> --}}
                                </div>
                            </div>
                           
                     
                    </div>
                </div>
                
                 <!-- End Card -->
                </div>
            @else
                <div class="col-12">
                    <p>Schedule Not Found</p>
                </div>
            @endif

            <span class="divider-end"></span>
        </div>
       
    @endforeach
    @endif
    <!-- Pagination -->
   {{ $schedulerLogs->links() }}
  <!-- Pagination -->
        {{-- <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
            <li class="page-item disabled" id="previous">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#" onclick="changePage(1)">1</a></li>
            <li class="page-item"><a class="page-link" href="#" onclick="changePage(2)">2</a></li>
            <li class="page-item"><a class="page-link" href="#" onclick="changePage(3)">3</a></li>
            <li class="page-item" id="next">
                <a class="page-link" href="#" onclick="changePage(2)">Next</a>
            </li>
            </ul>
        </nav> --}}
  <!-- End Pagination -->

  
  </div>
 
                    {{-- schedular history end --}}
        
                    </div>
                    
                    
                    
                    </div>
                    
                    

                    {{-- <div class="tab-pane fade" id="nav-three-eg1" role="tabpanel" aria-labelledby="nav-three-eg1-tab">
                        <p>Third tab content...</p>
                    </div> --}}
                </div>
                <!-- End Tab Content -->


            </div>
        </div>
        <!-- End Card -->
        {{-- scheduler ends here --}}

    </main>
@endsection