@extends('layouts.app1')
@section('content')

    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-sm mb-2 mb-sm-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-no-gutter">
                                {{-- <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Pages</a></li> --}}
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">My Docks </a></li>
                                <li class="breadcrumb-item active" aria-current="page">Overview</li>
                            </ol>
                        </nav>

                        <h1 class="page-header-title">My Docks</h1>
                    </div>
                    <!-- End Col -->

                    {{-- <div class="col-sm-auto">
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal" href="#">
                            <i class="bi-person-plus-fill me-1"></i> Add Docks
                        </a>
                    </div> --}}
                    <div class="col-sm-auto">
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal22" href="#">
                            <i class="me-1">
                                <img src="{{ asset('assets/img/front/dock.png') }}" alt="Icon"
                                    style="width: 22px; height: 22px;">
                            </i> Register new Boondock Echo
                        </a>
                    </div>
                    {{-- <div class="col-sm-auto">
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"
                            href="#">
                            <i class="bi-person-plus-fill me-1"></i> Dock Setting
                        </a>
                    </div> --}}

                    {{-- <div class="col-sm-auto">
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal11" href="#">
                            <i class="bi-person-plus-fill me-1"></i> Add Docks
                        </a>
                    </div> --}}
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
            <!-- End Page Header -->
            @if (session('error'))
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5 alert alert-soft-danger alert-dismissible fade show"
                    role="alert">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi-exclamation-triangle-fill"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif
            @if (session('success'))
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5 alert alert-soft-success alert-dismissible fade show"
                    role="alert">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi-check-square-fill"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif
            <!-- Stats -->
            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Total Docks Register</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span class="js-counter display-4 text-dark">
                                        @foreach ($docks as $key => $dock)
                                            @if ($loop->last)
                                                {{ $key + 1 }}
                                            @endif
                                        @endforeach
                                    </span>
                                    {{-- <span class="text-body fs-5 ms-1">from {{ $totalDocks }}</span> --}}
                                </div>
                                <!-- End Col -->

                                {{-- <div class="col-auto">
                  <span class="badge bg-soft-success text-success p-1">
                    <i class="bi-graph-up"></i> 15.0%
                  </span>
                </div> --}}
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
                            <h6 class="card-subtitle mb-2">Docks Online</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span
                                        class="js-counter display-4 text-dark">{{ count($docks->where('is_online', '!=', null)) }}</span>
                                    {{-- <span class="text-body fs-5 ms-1">from {{ $totalDocks }}</span> --}}
                                </div>

                                {{-- <div class="col-auto">
                  <span class="badge bg-soft-success text-success p-1">
                    <i class="bi-graph-up"></i> 1.2%
                  </span>
                </div> --}}
                            </div>
                            <!-- End Row -->
                        </div>
                    </div>
                    <!-- End Card -->
                </div>


            </div>
            <!-- End Stats -->

            <!-- Card -->
            <div class="card">
                <!-- Header -->
                <div class="card-header card-header-content-md-between">
                    <div class="mb-2 mb-md-0">
                        <form>
                            <!-- Search -->
                            <div class="input-group input-group-merge input-group-flush">
                                <div class="input-group-prepend input-group-text">
                                    <i class="bi-search"></i>
                                </div>
                                <input id="datatableSearch" type="search" class="form-control" placeholder="Search docks"
                                    aria-label="Search Docks">
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
                                        <h5 class="card-header-title">Docks Per Page</h5>

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
                <!-- End Header -->

                <!-- Table -->
                <div class="table-responsive datatable-custom position-relative">
                    <table id="datatable"
                        class="table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                        data-hs-datatables-options='{
                   "columnDefs": [{
                      "targets": [0, 7],
                      "orderable": false
                    }],
                   "order": [],
                   "info": {
                     "totalQty": "#datatableWithPaginationInfoTotalQty"
                   },
                   "search": "#datatableSearch",
                   "entries": "#datatableEntries",
                   "pageLength": 15,
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatablePagination"
                 }'>
                        <thead class="thead-light">
                            <tr>

                                <th>Name</th>
                                <th>Code</th>
                                <th>Software Version</th>
                                {{-- <th>Hardware</th> --}}
                                <th>Status</th>
                                <th>Address</th>
                                <th>Station</th>
                                {{-- <th>Portfolio</th> --}}
                                {{-- <th>Created</th> --}}
                                <th> Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($docks as $key => $dock)
                                <tr>

                                    <td>
                                        <a class="d-flex align-items-center" data-bs-toggle="modal" data-id="30"
                                            data-bs-target="#sett{{ $dock->id }}">
                                            {{ $dock->name ?? 'Not Yet Set' }}
                                        </a>

                                        {{-- <a class="d-flex align-items-center" data-bs-toggle="modal" data-id="30" data-bs-target="#editUserModal30">


                                                <div class="ms-3">
                                                    <span class="d-block h5 text-inherit mb-0">Suraj<span class="badge bg-info rounded-pill ms-1"></span>

                                                    </span>
                                                    <span class="d-block fs-5 text-body">stiwari@boondock.live</span>
                                                </div>
                                            </a> --}}

                                    </td>

                                    <td>
                                        @if (!empty($dock->code))
                                            <span class="d-block h5 text-inherit mb-0">{{ $dock->code }} </span>
                                        @else
                                            Not Yet Set
                                        @endif
                                        {{-- <span class="d-block h5 text-inherit mb-0"> {{ $dock->code ?? 'Not Yet Set' }} </span> --}}
                                    </td>
                                    <td>
                                        {{ $dock->sw_version ?? 'Not Yet Set' }}
                                    </td>
                                    {{-- <td>
                                        {{ $dock->hw_version ?? 'Not Yet Set' }}
                                    </td> --}}
                                    {{-- <td>
                                        @foreach ($users as $user)
                                            @if ($user->id == $dock->owner)
                                                {{ $user->name ?? 'Not Yet Set' }}
                                            @endif
                                        @endforeach
                                        @if ($dock->owner === null)
                                            Not Yet Set
                                        @endif
                                    </td> --}}
                                    <td>
                                        <span
                                            class="legend-indicator {{ $dock->is_online == 1 ? 'bg-success' : 'bg-danger' }}"></span>{{ $dock->is_online == 1 ? 'Online' : 'Offline' }}
                                    </td>
                                    {{-- <td>{{ $dock->state ?? 'Not Yet Set' }}</td> --}}
                                    <td>
                                        {{ $dock->city }}@if ($dock->state)
                                            , {{ $dock->state }}
                                        @endif
                                    </td>

                                    <td>{{ !empty($dock->station) ? $dock->station : 'Station Not Found' }} -
                                        {{ $dock->frequency }}</td>
                                    <td>
                                        {{-- <button type="button" class="btn btn-white btn-sm" href="{{ route('users.edit',$dock->id) }}" data-bs-toggle="modal" data-bs-target="#editUserModal">
                    <i class="bi-pencil-fill me-1"></i> Edit
                  </button> --}}
                                        <a class="btn btn-white btn-sm" id="{{ $dock->id }}" data-bs-toggle="modal"
                                            data-id="{{ $dock->id }}" data-bs-target="#sett{{ $dock->id }}"> <i
                                                class="bi-gear me-1"></i>Setting</a>
                                        {{-- model setting start --}}


                                        {{-- model setting end --}}
                                        <a class="btn btn-white btn-sm" id="set{{ $dock->id }}"
                                            data-bs-toggle="modal" data-id="{{ $dock->id }}"
                                            data-bs-target="#editUserModal{{ $dock->id }}"> <i
                                                class="bi-pencil-fill me-1"></i>Edit</a>
                                        {{-- model start --}}

                                        <div class="modal fade" id="editUserModal{{ $dock->id }}" tabindex="-1"
                                            aria-labelledby="editUserModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">

                                                    <!-- Body -->
                                                    <div class="modal-body">
                                                        @if (count($errors) > 0)
                                                            <div class="alert alert-danger">
                                                                <strong>Whoops!</strong> There were some problems with your
                                                                input.<br><br>
                                                                <ul>
                                                                    @foreach ($errors->all() as $error)
                                                                        <li>{{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif
                                                        <form action="{{ route('mydocks.update', $dock->id) }}"
                                                            method="POST" class="js-step-form py-md-5"
                                                            data-hs-step-form-options='{
                                                    "progressSelector": "#addUserStepFormProgress",
                                                    "stepsSelector": "#addUserStepFormContent",
                                                    "endSelector": "#addUserFinishBtn",
                                                    "isValidate": false
                                                  }'>
                                                            @csrf
                                                            @method('PUT')
                                                            @if (count($errors) > 0)
                                                                <div class="alert alert-danger">
                                                                    <strong>Whoops!</strong> There were some problems with
                                                                    your
                                                                    input.<br><br>
                                                                    <ul>
                                                                        @foreach ($errors->all() as $error)
                                                                            <li>{{ $error }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @endif

                                                            <div class="row justify-content-lg-center">
                                                                <div class="col-lg-8">
                                                                    <!-- Step -->
                                                                    <ul id="addUserStepFormProgress"
                                                                        class="js-step-progress step step-sm step-icon-sm step step-inline step-item-between mb-3 mb-md-5">

                                                                        <li class="step-item">
                                                                            <a class="step-content-wrapper"
                                                                                href="javascript:;"
                                                                                data-hs-step-form-next-options='{
                                                          "targetSelector": "#addUserStepProfile"
                                                        }'>
                                                                                <span
                                                                                    class="step-icon step-icon-soft-dark">1</span>
                                                                                <div class="step-content">
                                                                                    <span class="step-title">Code
                                                                                        Verification</span>
                                                                                </div>
                                                                            </a>
                                                                        </li>

                                                                        <li class="step-item">
                                                                            <a class="step-content-wrapper"
                                                                                href="javascript:;"
                                                                                data-hs-step-form-next-options='{
                                                          "targetSelector": "#addUserStepBillingAddress"
                                                        }'>
                                                                                <span
                                                                                    class="step-icon step-icon-soft-dark">2</span>
                                                                                <div class="step-content">
                                                                                    <span
                                                                                        class="step-title">Settings</span>
                                                                                </div>
                                                                            </a>
                                                                        </li>

                                                                        <li class="step-item">
                                                                            <a class="step-content-wrapper"
                                                                                href="javascript:;"
                                                                                data-hs-step-form-next-options='{
                                                          "targetSelector": "#addUserStepConfirmation"
                                                        }'>
                                                                                <span
                                                                                    class="step-icon step-icon-soft-dark">3</span>
                                                                                <div class="step-content">
                                                                                    <span
                                                                                        class="step-title">Location</span>
                                                                                </div>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                    <!-- End Step -->

                                                                    <!-- Content Step Form -->
                                                                    <div id="addUserStepFormContent">
                                                                        <!-- Card -->
                                                                        <div id="addUserStepProfile"
                                                                            class="card card-lg active">
                                                                            <!-- Body -->
                                                                            <!-- Body -->
                                                                            <div class="modal-body">
                                                                                @if (count($errors) > 0)
                                                                                    <div class="alert alert-danger">
                                                                                        <strong>Whoops!</strong> There were
                                                                                        some problems with your
                                                                                        input.<br><br>
                                                                                        <ul>
                                                                                            @foreach ($errors->all() as $error)
                                                                                                <li>{{ $error }}
                                                                                                </li>
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    </div>
                                                                                @endif


                                                                                <div class="form-group">
                                                                                    <label for="location">Code:</label>
                                                                                    {{-- <input type="text" name="code" value="{{ $dock->code }}" class="form-control"
                                                                                        id="code-input" disabled> --}}
                                                                                </div>
                                                                                {{-- <button type="submit" class="btn btn-success mt-4" data-hs-step-form-next-options='{
                                                                                    "targetSelector": "#addUserStepBillingAddress"
                                                                                  }'>validate</button> --}}

                                                                                <!-- End Step Form -->
                                                                            </div>
                                                                            <!-- End Body -->
                                                                            <!-- End Body -->

                                                                            <!-- Footer -->
                                                                            <div
                                                                                class="card-footer d-flex justify-content-end align-items-center">
                                                                                <button type="button"
                                                                                    class="btn btn-primary"
                                                                                    data-hs-step-form-next-options='{
                                                                  "targetSelector": "#addUserStepBillingAddress"
                                                                }'>
                                                                                    Next <i class="bi-chevron-right"></i>
                                                                                </button>
                                                                            </div>
                                                                            <!-- End Footer -->
                                                                        </div>
                                                                        <!-- End Card -->

                                                                        <div id="addUserStepBillingAddress"
                                                                            class="card card-lg" style="display: none;">
                                                                            <!-- Body -->
                                                                            <div class="card-body">
                                                                                <!-- Form -->

                                                                                <!-- End Form -->

                                                                                <!-- Form -->
                                                                                <div class="row mb-4">
                                                                                    <label for="addressLine1Label"
                                                                                        class="col-sm-3 col-form-label form-label">Name</label>

                                                                                    <div class="col-sm-9">
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="name" id="name"
                                                                                            value="{{ $dock->name }}"
                                                                                            placeholder="Lombard Fire and Rescue"
                                                                                            aria-label="name" required>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- End Form -->

                                                                                <!-- Form -->
                                                                                <div class="form-group mb-4">
                                                                                    <div class="mb-2">
                                                                                        <label for="location">Station
                                                                                            Name:</label>
                                                                                        <input type="text"
                                                                                            value="{{ $dock->station }}"
                                                                                            class="form-control"
                                                                                            id="station" name="station">
                                                                                    </div>
                                                                                    <div>
                                                                                        <label
                                                                                            for="location">Frequency:</label>
                                                                                        <input type="float"
                                                                                            value="{{ $dock->frequency }}"
                                                                                            class="form-control"
                                                                                            id="frequency"
                                                                                            name="frequency">
                                                                                    </div>
                                                                                </div>

                                                                                <!-- Form Check -->


                                                                                <div class="form-group form-check-inline">
                                                                                    <input type="checkbox"
                                                                                        name="rx_enabled" id="rx_enabled"
                                                                                        value=""
                                                                                        class="form-check-input"
                                                                                        @if ($dock->rx_enabled) checked @endif>
                                                                                    <label class="form-check-label"
                                                                                        for="formInlineCheck1">Receive
                                                                                        Message</label>
                                                                                </div>
                                                                                <!-- End Form Check -->
                                                                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                                                                <script>
                                                                                    $(document).ready(function() {
                                                                                        // get the current value of rx_enabled
                                                                                        var currentVal = $('#rx_enabled').val();

                                                                                        // set the initial checkbox state based on the current value of rx_enabled
                                                                                        if (currentVal == 1) {
                                                                                            $('#rx_enabled').prop('checked', true);
                                                                                        } else {
                                                                                            $('#rx_enabled').prop('checked', false);
                                                                                        }

                                                                                        // update the value of rx_enabled when the checkbox is clicked
                                                                                        $('#rx_enabled').on('click', function() {
                                                                                            if ($(this).prop('checked')) {
                                                                                                $(this).val(1);
                                                                                            } else {
                                                                                                $(this).val(0);
                                                                                            }
                                                                                        });
                                                                                    });
                                                                                </script>

                                                                                <!-- Form Check -->
                                                                                <div class="form-group form-check-inline">
                                                                                    <input type="checkbox"
                                                                                        id="formInlineCheck1"
                                                                                        class="form-check-input">
                                                                                    <label class="form-check-label"
                                                                                        for="formInlineCheck1">Transmit
                                                                                        Message</label>
                                                                                </div>
                                                                                <!-- End Form Check -->

                                                                                <!-- End Form -->


                                                                            </div>
                                                                            <!-- End Body -->

                                                                            <!-- Footer -->
                                                                            <div
                                                                                class="card-footer d-flex align-items-center">
                                                                                <button type="button"
                                                                                    class="btn btn-ghost-secondary"
                                                                                    data-hs-step-form-prev-options='{
                                                             "targetSelector": "#addUserStepProfile"
                                                           }'>
                                                                                    <i class="bi-chevron-left"></i>
                                                                                    Previous step
                                                                                </button>

                                                                                <div class="ms-auto">
                                                                                    <button type="button"
                                                                                        class="btn btn-primary"
                                                                                        data-hs-step-form-next-options='{
                                                                    "targetSelector": "#addUserStepConfirmation"
                                                                  }'>
                                                                                        Next <i
                                                                                            class="bi-chevron-right"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <!-- End Footer -->
                                                                        </div>

                                                                        <div id="addUserStepConfirmation"
                                                                            class="card card-lg" style="display: none;">
                                                                            <!-- Profile Cover -->


                                                                            <!-- Footer -->
                                                                            <div
                                                                                class="card-footer d-sm-flex align-items-sm-center">
                                                                                <button type="button"
                                                                                    class="btn btn-ghost-secondary mb-2 mb-sm-0"
                                                                                    data-hs-step-form-prev-options='{
                                                             "targetSelector": "#addUserStepBillingAddress"
                                                           }'>
                                                                                    <i class="bi-chevron-left"></i>
                                                                                    Previous step
                                                                                </button>

                                                                                <div class="ms-auto">
                                                                                    {{-- <button type="button" class="btn btn-white me-2">Save in drafts</button> --}}
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary">Update
                                                                                        Dock</button>
                                                                                    {{-- <button id="addUserFinishBtn" type="submit" class="btn btn-primary">Add
                                                                                        user</button> --}}
                                                                                </div>
                                                                            </div>
                                                                            <!-- End Footer -->
                                                                        </div>
                                                                    </div>
                                                                    <!-- End Content Step Form -->

                                                                    <!-- Message Body -->
                                                                    <div id="successMessageContent" style="display:none;">
                                                                        <div class="text-center">
                                                                            <img class="img-fluid mb-3"
                                                                                src="./assets/svg/illustrations/oc-hi-five.svg"
                                                                                alt="Image Description"
                                                                                data-hs-theme-appearance="default"
                                                                                style="max-width: 15rem;">
                                                                            <img class="img-fluid mb-3"
                                                                                src="./assets/svg/illustrations-light/oc-hi-five.svg"
                                                                                alt="Image Description"
                                                                                data-hs-theme-appearance="dark"
                                                                                style="max-width: 15rem;">

                                                                            <div class="mb-4">
                                                                                <h2>Successful!</h2>
                                                                                <p>New <span
                                                                                        class="fw-semibold text-dark">Ella
                                                                                        Lauda</span> user has been
                                                                                    successfully created.</p>
                                                                            </div>

                                                                            <div class="d-flex justify-content-center">
                                                                                <a class="btn btn-white me-3"
                                                                                    href="./users.html">
                                                                                    <i class="bi-chevron-left ms-1"></i>
                                                                                    Back to users
                                                                                </a>
                                                                                <a class="btn btn-primary"
                                                                                    href="./users-add-user.html">
                                                                                    <i
                                                                                        class="bi-person-plus-fill me-1"></i>
                                                                                    Add new user
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End Message Body -->
                                                                </div>
                                                            </div>
                                                            <!-- End Row -->

                                                        </form>
                                                        <!-- End Step Form -->
                                                    </div>
                                                    <!-- End Body -->
                                                </div>
                                            </div>
                                        </div>


                                        {{-- model end --}}

                                        <form method="POST" action="{{ route('mydocks.destroy', $dock->id) }}"
                                            style="display:inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi-trash me-1"></i> Delete
                                            </button>
                                        </form>


                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{-- {!! $docks->render() !!} --}}
                </div>
                <!-- End Table -->

                <!-- Footer -->
                <div class="card-footer">
                    <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                        <div class="col-sm mb-2 mb-sm-0">
                            {{-- {!! $docks->render() !!} </div> --}}
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
                </div>
                <!-- End Footer -->
            </div>
            <!-- End Card -->
        </div>
        <!-- End Content -->

        <!-- Footer -->

        <div class="footer">
            <div class="row justify-content-between align-items-center">
                <div class="col">
                    {{-- <p class="fs-6 mb-0">&copy; Front. <span class="d-none d-sm-inline-block">2022 Htmlstream.</span></p> --}}
                </div>
                <!-- End Col -->


                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>

        <!-- End Footer -->
    </main>



    <!-- create user -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <!-- Body -->
                <div class="modal-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('mydocks.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Dock Name:</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="location">Mac:</label>
                            <input type="text" class="form-control" id="code" name="code">
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </form>
                    <!-- End Step Form -->
                </div>
                <!-- End Body -->


            </div>
        </div>
    </div>
    <!-- Edit user -->
    <!-- create user -->
    <div class="modal fade" id="editUserModal22" tabindex="-1" aria-labelledby="editUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <!-- Body -->
                <!-- Card -->
                <div id="deleteAccountSection" class="card">
                    <div class="modal-header">
                        <h4 class="card-title">Register New Boondock Echo</h4><span
                            class="badge bg-danger rounded-pill ms-1">Under Development</span>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Body -->
                    <div class="modal-body">
                        <strong>
                            <p>Before we Begin, Please Connect Your Boondock Echo To Internet</p>
                        </strong>

                        <div class="mb-4">
                            <!-- Form Check -->
                            <div class="form-check">
                                <strong> <input class="form-check-input" type="checkbox" value=""
                                        id="confirm"></strong>
                                <label class="form-check-label" for="deleteAccountCheckbox">
                                    My Boondock Echo Is Connected and in Pairing Mode
                                </label>
                            </div>
                            <!-- End Form Check -->
                        </div>

                        <div class="d-flex justify-content-end gap-3">
                            <a class="btn btn-white" href="#">Learn more</a>
                            {{-- <button type="submit" class="btn btn-primary">Next</button> --}}
                            <a class="btn btn-secondary disabled" id="nextButton" data-bs-toggle="modal"
                                data-bs-target="#editUserModal11" href="#">
                                {{-- <i class="bi-person-plus-fill me-1"></i> --}}
                                Next
                            </a>
                        </div>
                    </div>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $('#confirm').click(function() {
                            if ($(this).prop("checked")) {
                                $('#nextButton').removeClass('disabled').removeClass('btn-secondary').addClass('btn-primary');
                            } else {
                                $('#nextButton').addClass('disabled').removeClass('btn-primary').addClass('btn-secondary');
                            }
                        });
                    </script>
                    <!-- End Body -->
                </div>
                <!-- End Card -->
                <!-- End Body -->


            </div>
        </div>
    </div>
    <!-- Edit user -->
    <!-- create user -->
    <div class="modal fade" id="editUserModal11" tabindex="-1" aria-labelledby="editUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <!-- Content -->
                <div class="content container-fluid">
                    <!-- Step Form -->
                    <form action="{{ route('mydocks.updatenewdock') }}" method="POST" class="js-step-form py-md-5"
                        data-hs-step-form-options='{
                "progressSelector": "#addUserStepFormProgress",
                "stepsSelector": "#addUserStepFormContent",
                "endSelector": "#addUserFinishBtn",
                "isValidate": false
              }'>
                        @csrf
                        @method('PUT')
                        <div class="row justify-content-lg-center">
                            <div class="col-lg-8">
                                <!-- Step -->
                                <ul id="addUserStepFormProgress"
                                    class="js-step-progress step step-sm step-icon-sm step step-inline step-item-between mb-3 mb-md-5">

                                    <li class="step-item">
                                        <a class="step-content-wrapper" href="javascript:;"
                                            data-hs-step-form-next-options='{
                      "targetSelector": "#addUserStepProfile"
                    }'>
                                            <span class="step-icon step-icon-soft-dark">1</span>
                                            <div class="step-content">
                                                <span class="step-title">Code Verification</span>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="step-item">
                                        <a class="step-content-wrapper" href="javascript:;"
                                            data-hs-step-form-next-options='{
                      "targetSelector": "#addUserStepBillingAddress"
                    }'>
                                            <span class="step-icon step-icon-soft-dark">2</span>
                                            <div class="step-content">
                                                <span class="step-title">Settings</span>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="step-item">
                                        <a class="step-content-wrapper" href="javascript:;"
                                            data-hs-step-form-next-options='{
                      "targetSelector": "#addUserStepConfirmation"
                    }'>
                                            <span class="step-icon step-icon-soft-dark">3</span>
                                            <div class="step-content">
                                                <span class="step-title">Location</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <!-- End Step -->

                                <!-- Content Step Form -->
                                <div id="addUserStepFormContent">
                                    <!-- Card -->
                                    <div id="addUserStepProfile" class="card card-lg active">
                                        <!-- Body -->
                                        <!-- Body -->
                                        <div class="modal-body">
                                            @if (count($errors) > 0)
                                                <div class="alert alert-danger">
                                                    <strong>Whoops!</strong> There were some problems with your
                                                    input.<br><br>
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif


                                            <div id="error-message" class="d-none alert alert-success mt-4"></div>
                                            <div class="form-group">
                                                <label for="location">Code:</label>
                                                <input type="text" name="code" class="form-control"
                                                    id="code-input">
                                                <span class="text-danger" id="code-error"></span>
                                                <span class="text-success" style="display: none" id="code-success">Your
                                                    Code is Valid </span>
                                            </div>

                                            <button type="submit" class="btn btn-success mt-4" id="create-dock-btn">
                                                Validate</button>


                                            <!-- End Step Form -->
                                        </div>
                                        <!-- End Body -->
                                        <!-- End Body -->

                                        <!-- Footer -->
                                        <div class="card-footer d-flex justify-content-end align-items-center">
                                            {{-- <button id="create-dock-btn" type="submit" class="btn btn-primary">
                                                Next <i class="bi-chevron-right"></i>
                                            </button> --}}
                                            <button id="nextform" style="display: none" type="button"
                                                class="btn btn-primary"
                                                data-hs-step-form-next-options="{
                                                &quot;targetSelector&quot;: &quot;#addUserStepBillingAddress&quot;
                                              }">
                                                Next <i class="bi-chevron-right"></i>
                                            </button>

                                        </div>
                                        <!-- End Footer -->
                                    </div>
                                    <!-- End Card -->

                                    <div id="addUserStepBillingAddress" class="card card-lg" style="display: none;">
                                        <!-- Body -->
                                        <div class="card-body">
                                            <!-- Form -->

                                            <!-- End Form -->

                                            <!-- Form -->
                                            <div id="success-message" class="d-none alert alert-success mt-4"></div>
                                            <div class="row mb-4">
                                                <label for="addressLine1Label"
                                                    class="col-sm-3 col-form-label form-label">Name</label>

                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="name"
                                                        id="name" placeholder="Lombard Fire and Rescue"
                                                        aria-label="name">
                                                </div>
                                            </div>
                                            <!-- End Form -->

                                            <!-- Form -->
                                            <div class="form-group mb-4">
                                                <div class="mb-2">
                                                    <label for="location">Station Name:</label>
                                                    <input type="text" class="form-control" id="station"
                                                        name="station">
                                                </div>
                                                <div>
                                                    <label for="location">Frequency:</label>
                                                    <input type="float" class="form-control" id="frequency"
                                                        name="frequency">
                                                </div>
                                            </div>

                                            <!-- Form Check -->


                                            <div class="form-group form-check-inline">
                                                <input type="checkbox" name="rx_enabled" value="0" id="rx_enabled"
                                                    class="form-check-input">
                                                <label class="form-check-label" for="formInlineCheck1">Recive
                                                    Message</label>
                                            </div>
                                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                            <script>
                                                $(document).ready(function() {
                                                    $('#rx_enabled').on('change', function() {
                                                        if ($(this).prop('checked')) {
                                                            $('#rx_enabled').val('1');
                                                        } else {
                                                            $('#rx_enabled').val('0');
                                                        }
                                                    });
                                                });
                                            </script>
                                            <!-- End Form Check -->

                                            <!-- Form Check -->
                                            <div class="form-group form-check-inline">
                                                <input type="checkbox" id="formInlineCheck1" class="form-check-input">
                                                <label class="form-check-label" for="formInlineCheck1">Transmit
                                                    Message</label>
                                            </div>
                                            <!-- End Form Check -->

                                            <!-- End Form -->


                                        </div>
                                        <!-- End Body -->

                                        <!-- Footer -->
                                        <div class="card-footer d-flex align-items-center">
                                            <button type="button" class="btn btn-ghost-secondary"
                                                data-hs-step-form-prev-options='{
                         "targetSelector": "#addUserStepProfile"
                       }'>
                                                <i class="bi-chevron-left"></i> Previous step
                                            </button>

                                            <div class="ms-auto">
                                                <button type="button" class="btn btn-primary"
                                                    data-hs-step-form-next-options='{
                                "targetSelector": "#addUserStepConfirmation"
                              }'>
                                                    Next <i class="bi-chevron-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- End Footer -->
                                    </div>

                                    <div id="addUserStepConfirmation" class="card card-lg" style="display: none;">
                                        <!-- Profile Cover -->


                                        <!-- Footer -->
                                        <div class="card-footer d-sm-flex align-items-sm-center">
                                            <button type="button" class="btn btn-ghost-secondary mb-2 mb-sm-0"
                                                data-hs-step-form-prev-options='{
                         "targetSelector": "#addUserStepBillingAddress"
                       }'>
                                                <i class="bi-chevron-left"></i> Previous step
                                            </button>

                                            <div class="ms-auto">
                                                {{-- <button type="button" class="btn btn-white me-2">Save in drafts</button> --}}
                                                <button type="submit" class="btn btn-primary">Add
                                                    Dock</button>
                                                {{-- <button id="addUserFinishBtn" type="submit" class="btn btn-primary">Add
                                                    user</button> --}}
                                            </div>
                                        </div>
                                        <!-- End Footer -->
                                    </div>
                                </div>
                                <!-- End Content Step Form -->

                                <!-- Message Body -->
                                <div id="successMessageContent" style="display:none;">
                                    <div class="text-center">
                                        <img class="img-fluid mb-3" src="./assets/svg/illustrations/oc-hi-five.svg"
                                            alt="Image Description" data-hs-theme-appearance="default"
                                            style="max-width: 15rem;">
                                        <img class="img-fluid mb-3" src="./assets/svg/illustrations-light/oc-hi-five.svg"
                                            alt="Image Description" data-hs-theme-appearance="dark"
                                            style="max-width: 15rem;">

                                        <div class="mb-4">
                                            <h2>Successful!</h2>
                                            <p>New <span class="fw-semibold text-dark">Ella Lauda</span> user has been
                                                successfully created.</p>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <a class="btn btn-white me-3" href="./users.html">
                                                <i class="bi-chevron-left ms-1"></i> Back to users
                                            </a>
                                            <a class="btn btn-primary" href="./users-add-user.html">
                                                <i class="bi-person-plus-fill me-1"></i> Add new user
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Message Body -->
                            </div>
                        </div>
                        <!-- End Row -->
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                // reboot
                                $('#create-dock-btn').on('click', function(e) {
                                    e.preventDefault();
                                    var code = $('#code-input').val();

                                    $.ajax({
                                        type: 'POST',
                                        url: '{{ route('mydocks.store') }}',
                                        data: {
                                            '_token': '{{ csrf_token() }}',
                                            'code': code,

                                        },
                                        success: function(response) {
                                            // Update success message div with success message
                                            $('#success-message').removeClass('d-none').html(response.message);
                                            //  Set the ID of the button to "editUserModal{dockId}"
                                            // var dockId = response.dock.id;
                                            $('#create-dock-btn').css('display', 'none');
                                            $('#nextform').css('display', '');
                                            $('#code-error').css('display', 'none');
                                            $('#code-success').css('display', '');
                                            // $('#code-input').prop('disabled', true);

                                            // Add data-bs-toggle and data-bs-target attributes to the button
                                            // $('#editUserModal' + dockId).attr('data-hs-step-form-next-options', '{"targetSelector": "#addUserStepBillingAddress"}').attr('type', 'button');

                                        },
                                        error: function(error) {
                                            $('#code-error').html('Error: ' + error.responseJSON.message);
                                        }
                                    });
                                });

                            });
                        </script>
                    </form>
                    <!-- End Step Form -->
                </div>
                <!-- End Content -->

            </div>
        </div>
    </div>
    <!-- Edit user -->

    <!-- Modal -->
    <!-- Modal -->
    {{-- @foreach ($docks as $key => $dock) --}}
    {{-- <div id="more_set{{ $dock->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Boondock: KC's BoonDock</h5>


                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <h2>Speaker Settings</h2>
                                <div class="form-group mb-4">
                                    <style>
                                        progress {
                                            width: 100%;
                                            height: 30px;
                                        }
                                    </style>
                                    <form method="post" action="{{ route('mqtt.publish') }}">
                                        @csrf
                                        <label for="message1">Speaker Volume:</label>
                                        <input type="hidden" name="message" id="message1" value="0">
                                        <input type="range" name="slider" id="slider1" min="0"
                                            max="100" value="0">
                                        <input type="hidden" name="topic" id="topic1"
                                            value="C4DEE21C40D8/config/dock/spkr_vol">
                                        <span id="slider-value1">0</span>
                                    </form>

                                </div>
                                <div class="form-group">

                                    <label class="label mb-1">Speaker Default:</label>
                                    <div class="form-check form-switch form-switch-between mb-6">
                                        <label class="form-check-label">Off</label>
                                        <input type="checkbox" class="form-check-input">
                                        <label class="form-check-label">On</label>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <h2>Recorder Settings</h2>

                                <form method="post" action="{{ route('mqtt.publish') }}">
                                    @csrf
                                    <label for="message2">Auto Record Sound Level (db):</label>
                                    <input type="hidden" name="message" id="message2" value="0">
                                    <input type="range" name="slider" id="slider2" min="0" max="5.0"
                                        value="0">
                                    <input type="hidden" name="topic" id="topic2"
                                        value="C4DEE21C40D8/config/recorder/lin_min_db">
                                    <span id="slider-value2">0</span>
                                </form>
                                <br>

                                <form method="post" action="{{ route('mqtt.publish') }}">
                                    @csrf
                                    <label for="message2">Minimum Record Size (ms):</label>
                                    <input type="hidden" name="message" id="message3" value="0">
                                    <input type="range" name="slider" id="slider3" min="0" max="30000"
                                        value="0">
                                    <input type="hidden" name="topic" id="topic3"
                                        value="C4DEE21C40D8/config/recorder/min_rec_sec​">
                                    <span id="slider-value3">0</span>
                                </form>
                                <br>

                                <form method="post" action="{{ route('mqtt.publish') }}">
                                    @csrf
                                    <label for="message4">Maximum Record Size (ms):</label>
                                    <input type="hidden" name="message" id="message4" value="0">
                                    <input type="range" name="slider" id="slider4" min="0" max="60000"
                                        value="0">
                                    <input type="hidden" name="topic" id="topic4"
                                        value="C4DEE21C40D8/config/recorder/max_rec_sec​">
                                    <span id="slider-value4">0</span>
                                </form>
                                <br>

                                <form method="post" action="{{ route('mqtt.publish') }}">
                                    @csrf
                                    <label for="message5">Silence Trigger Stop (ms):</label>
                                    <input type="hidden" name="message" id="message5" value="0">
                                    <input type="range" name="slider" id="slider5" min="0" max="10000"
                                        value="0">
                                    <input type="hidden" name="topic" id="topic5"
                                        value="C4DEE21C40D8/config/recorder/audio_stop_silence​">
                                    <span id="slider-value5">0</span>
                                </form>

                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                    $(document).ready(function() {

                                        $('#slider1').on('change', function() {
                                            var message = $(this).val();
                                            var topic = $('#topic1').val();
                                            $('#message1').val(message);
                                            $('#slider-value1').html(message);
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

                                        $('#slider2').on('change', function() {
                                            var message = $(this).val();
                                            var topic = $('#topic2').val();
                                            $('#message2').val(message);
                                            $('#slider-value2').html(message);
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

                                        $('#slider3').on('change', function() {
                                            var message = $(this).val();
                                            var topic = $('#topic3').val();
                                            $('#message3').val(message);
                                            $('#slider-value3').html(message);
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

                                        $('#slider4').on('change', function() {
                                            var message = $(this).val();
                                            var topic = $('#topic4').val();
                                            $('#message4').val(message);
                                            $('#slider-value4').html(message);
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

                                        $('#slider5').on('change', function() {
                                            var message = $(this).val();
                                            var topic = $('#topic5').val();
                                            $('#message5').val(message);
                                            $('#slider-value5').html(message);
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
                        <div class="row mt-4 mr-2">
                            <div class="col-md-12 text-center mb-2  mp-4 mr-2">
                                <button class="btn btn-primary mx-2">Reboot</button>
                                <button class="btn btn-primary mx-2">Identify</button>
                                <button class="btn btn-primary mx-2">Record</button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> --}}

    <!-- Setting Model -->
    @foreach ($docks as $key => $dock)
        <!--  Modal mqtt -->
        <div id="sett{{ $dock->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5> {{ $dock->name }} ({{ $dock->mac }})</h5>


                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
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
                                        <form method="post" action="{{ route('mqtt.publish') }}">
                                            @csrf
                                            <label for="message1{{ $dock->id }}"><b> Speaker Volume </b></label>
                                            <input type="hidden" name="message" id="message1{{ $dock->id }}"
                                                value="0">
                                            <input type="range" class="me-2" name="slider" id="slider1{{ $dock->id }}"
                                                min="0" max="100" value="0">
                                            <input type="hidden" name="topic" id="topic1{{ $dock->id }}"
                                                value="{{ $dock->mac }}/config/dock/spkr_vol">
                                            <span id="slider-value1{{ $dock->id }}" class="border border-5" contenteditable="true"
                                                style="border: 1px solid #ccc; padding: 5px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;"></span>
                                        </form>
                                        <br>
                                        {{-- <form method="post" action="{{ route('mqtt.publish') }}">
                                            @csrf
                                            <label for="message6{{ $dock->id }}">System Volume:</label>
                                            <input type="hidden" name="message" id="message6{{ $dock->id }}"
                                                value="0">
                                            <input type="range" name="slider" id="slider6{{ $dock->id }}"
                                                min="0" max="100" value="50">
                                            <input type="hidden" name="topic" id="topic6{{ $dock->id }}"
                                                value="{{ $dock->mac }}/config/recorder/playback_vol​">
                                            <span id="slider-value6{{ $dock->id }}">50</span>
                                        </form> --}}

                                        <form method="post" action="{{ route('mqtt.publish') }}">
                                            @csrf
                                            <label for="message7{{ $dock->id }}"><b> Transmit Volume</b></label>
                                            <input type="hidden" name="message" id="message7{{ $dock->id }}"
                                                value="0">
                                            <input type="range" class="me-2" name="slider" id="slider7{{ $dock->id }}"
                                                min="0" max="100" value="50">
                                            <input type="hidden" name="topic" id="topic7{{ $dock->id }}"
                                                value="{{ $dock->mac }}/config/recorder/tx_vol">
                                            <span id="slider-value7{{ $dock->id }}" class="border border-5" contenteditable="true"
                                                style="border: 1px solid #ccc; padding: 5px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">50</span>
                                        </form>

                                    </div>
                                    <div class="form-group">
                                        <!-- <label class="label">Default:</label> -->

                                        <!-- Switch -->
                                        <label class="label mb-1"><b> Speaker </b> </label>
                                        <div class="form-check form-switch form-switch-between mb-4">
                                            <label class="form-check-label">Off</label>
                                            <input type="checkbox" class="form-check-input"
                                                id="speaker-switch{{ $dock->id }}">
                                            <label class="form-check-label">On</label>
                                        </div>
                                        <label class="label mb-1"><b> Notifications </b></label>
                                        <div class="form-check form-switch form-switch-between mb-6">
                                            <label class="form-check-label">Off</label>
                                            <input type="checkbox" class="form-check-input"
                                                id="speaker-switch{{ $dock->id }}">
                                            <label class="form-check-label">On</label>
                                        </div>
                                        <!-- End Switch -->
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <h2 class="mb-4">Recorder Settings</h2>
                                    {{-- <label for="progress-range1">Auto Record Sound Level (db):</label>
                 <input id="progress-range1" type="range" min="0" max="5.0" value="0">

                 <label for="progress-value1"></label>
                 <span id="progress-value1">0</span> --}}
                                    <form method="post" action="{{ route('mqtt.publish') }}">
                                        @csrf
                                        <label for="message2{{ $dock->id }}"><b> Auto Record Sound Level (db)</b></label>
                                        <input type="hidden" name="message" id="message2{{ $dock->id }}"
                                            value="0">
                                        <input type="range" class="me-2" name="slider" id="slider2{{ $dock->id }}"
                                            min="0" max="5.0" value="2.0">
                                        <input type="hidden" name="topic" id="topic2{{ $dock->id }}"
                                            value="{{ $dock->mac }}/config/recorder/lin_min_db">
                                        <span id="slider-value2{{ $dock->id }}"class="border border-5" contenteditable="true"
                                            style="border: 1px solid #ccc; padding: 5px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">2.0</span>
                                    </form>
                                    <br>

                                    <form method="post" action="{{ route('mqtt.publish') }}">
                                        @csrf
                                        <label for="message3{{ $dock->id }}"><b> Minimum Record Size (sec)</b></label>
                                        <input type="hidden" name="message" id="message3{{ $dock->id }}"
                                            value="0">
                                        <input type="range" class="me-1" name="slider" id="slider3{{ $dock->id }}"
                                            min="0" max="30000" value="15000">
                                        <input type="hidden" name="topic" id="topic3{{ $dock->id }}"
                                            value="{{ $dock->mac }}/config/recorder/min_rec_sec​">
                                        <span id="slider-value3{{ $dock->id }}" class="border border-5" contenteditable="true"
                                            style="border: 1px solid #ccc; padding: 5px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">15</span>
                                    </form>
                                    <br>

                                    <form method="post" action="{{ route('mqtt.publish') }}">
                                        @csrf
                                        <label for="message4{{ $dock->id }}"><b> Maximum Record Size (sec)</b></label>
                                        <input type="hidden" name="message" id="message4{{ $dock->id }}"
                                            value="0">
                                        <input type="range" class="me-1" name="slider" id="slider4{{ $dock->id }}"
                                            min="0" max="60000" value="45000">
                                        <input type="hidden" name="topic" id="topic4{{ $dock->id }}"
                                            value="{{ $dock->mac }}/config/recorder/max_rec_sec​">
                                        <span id="slider-value4{{ $dock->id }}" class="border border-5" contenteditable="true"
                                            style="border: 1px solid #ccc; padding: 5px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">45</span>
                                    </form>
                                    <br>

                                    <form method="post" action="{{ route('mqtt.publish') }}">
                                        @csrf
                                        <label for="message5{{ $dock->id }}"><b> Silence Trigger Stop (sec)</b></label>
                                        <input type="hidden" name="message" id="message5{{ $dock->id }}"
                                            value="0">
                                        <input type="range" class="me-1" name="slider" id="slider5{{ $dock->id }}"
                                            min="0" max="10000" value="5000">
                                        <input type="hidden" name="topic" id="topic5{{ $dock->id }}"
                                            value="{{ $dock->mac }}/config/recorder/audio_stop_silence​">
                                        <span id="slider-value5{{ $dock->id }}" class="border border-5" contenteditable="true"
                                            style="border: 1px solid #ccc; padding: 5px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">5.1</span>
                                    </form>



                                </div>
                            </div>
                            <div class="row mt-4 mr-2">
                                {{-- <div class="col-md-12 text-center mb-4  mp-4 mr-2">
                                    <button class="btn btn-primary mx-2" id="default-button{{ $dock->id }}">Set
                                        Default</button>
                                    <button class="btn btn-primary mx-2"
                                        id="reboot-button{{ $dock->id }}">Reboot</button>
                                    <button class="btn btn-primary mx-2"
                                        id="beep-button{{ $dock->id }}">Identify</button>
                                </div> --}}
                                {{-- <div class="col-md-12 text-center mb-2  mp-4 mr-2">


                                    <button id="start-recording-btn{{ $dock->id }}"
                                        class="btn btn-success mx-2">Start Recording</button>
                                    <button id="stop-recording-btn{{ $dock->id }}" class="btn btn-danger mx-2"
                                        disabled>Stop Recording</button>
                                </div> --}}
                                <div class="row mb-4 gx-3">
                                    <div class="col-sm mb-2 mb-sm-0">
                                        <div class="d-grid">
                                            <button class="btn btn-primary mx-2" id="default-button{{ $dock->id }}">Default</button>
                                        </div>
                                    </div>
                                    <!-- End Col -->

                                    <div class="col-sm">
                                        <div class="d-grid">
                                            <button class="btn btn-primary mx-2"
                                            id="reboot-button{{ $dock->id }}">Reboot</button>
                                        </div>
                                    </div>

                                    <!-- End Col -->
                                </div>
                                <div class="row mb-4 gx-3">
                                    <div class="col-sm mb-2 mb-sm-0">
                                        <div class="d-grid">
                                            <button class="btn btn-primary mx-2"
                                            id="beep-button{{ $dock->id }}">Identify</button>
                                        </div>
                                    </div>
                                    <!-- End Col -->



                                    <div class="col-sm">
                                        <div class="d-grid">
                                            <button class="btn btn-primary mx-2">Save</button>
                                        </div>
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <div class="row gx-3">
                                    <div id="start-recording-btn{{ $dock->id }}" class="col-sm mb-2 mb-sm-0">
                                        <div class="d-grid">
                                            <button id="start-recording-btn{{ $dock->id }}"
                                                class="btn btn-success mx-2">Start Recording</button>
                                        </div>
                                    </div>
                                    <!-- End Col -->

                                    <div class="col-sm" id="stop-recording-btn{{ $dock->id }}"  style="display: none">
                                        <div class="d-grid">
                                            <button id="stop-recording-btn{{ $dock->id }}"
                                                class="btn btn-danger mx-2" >Stop Recording</button>
                                        </div>
                                    </div>
                                    <div class="col-sm"  >
                                        <div class="d-grid">
                                            <button
                                                class="btn btn-secondary mx-2" data-bs-toggle="modal"
                                                data-id="more{{ $dock->id }}" data-bs-target="#more_set{{ $dock->id }}" >More settings</button>
                                        </div>
                                    </div>
                                    <!-- End Col -->
                                </div>

                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                    $(document).ready(function() {
                                        // First Slider
                                        $('#slider1{{ $dock->id }}').on('change', function() {
                                            var message = $(this).val();
                                            var topic = $('#topic1{{ $dock->id }}').val();
                                            $('#message1{{ $dock->id }}').val(message);
                                            $('#slider-value1{{ $dock->id }}').html(message);
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

                                        // Update slider when span value changes
                                        $('#slider-value1{{ $dock->id }}').on('input', function() {
                                            var message = $(this).html();
                                            var topic = $('#topic1{{ $dock->id }}').val();
                                            $('#message1{{ $dock->id }}').val(message);
                                            $('#slider1{{ $dock->id }}').val(message);
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
                                        // Second Slider
                                        $('#slider2{{ $dock->id }}').on('change', function() {
                                            var message = $(this).val();
                                            var topic = $('#topic2{{ $dock->id }}').val();
                                            $('#message2{{ $dock->id }}').val(message);
                                            $('#slider-value2{{ $dock->id }}').html(message);
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

                                        // Update slider when span value changes
                                        $('#slider-value2{{ $dock->id }}').on('input', function() {
                                            var message = $(this).html();
                                            var topic = $('#topic2{{ $dock->id }}').val();
                                            $('#message2{{ $dock->id }}').val(message);
                                            $('#slider2{{ $dock->id }}').val(message);
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

                                        // minimum rec sec
                                        $('#slider3{{ $dock->id }}').on('change', function() {
                                            var message = $(this).val();
                                            var topic = $('#topic3{{ $dock->id }}').val();
                                            $('#message3{{ $dock->id }}').val(message);
                                            $('#slider-value3{{ $dock->id }}').html((message / 1000).toFixed(1));
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
                                        // maximum rec sec
                                        $('#slider4{{ $dock->id }}').on('change', function() {
                                            var message = $(this).val();
                                            var topic = $('#topic4{{ $dock->id }}').val();
                                            $('#message4{{ $dock->id }}').val(message);
                                            $('#slider-value4{{ $dock->id }}').html((message / 1000).toFixed(1));
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
                                        // Audio Silence Trigger
                                        $('#slider5{{ $dock->id }}').on('change', function() {
                                            var message = $(this).val();
                                            var topic = $('#topic5{{ $dock->id }}').val();
                                            $('#message5{{ $dock->id }}').val(message);
                                            $('#slider-value5{{ $dock->id }}').html((message / 1000).toFixed(1));
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
                                        // system Settings
                                        $('#slider6{{ $dock->id }}').on('change', function() {
                                            var message = $(this).val();
                                            var topic = $('#topic6{{ $dock->id }}').val();
                                            $('#message6{{ $dock->id }}').val(message);
                                            $('#slider-value6{{ $dock->id }}').html(message);
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
                                        // transmit Settings
                                        $('#slider7{{ $dock->id }}').on('change', function() {
                                            var message = $(this).val();
                                            var topic = $('#topic7{{ $dock->id }}').val();
                                            $('#message7{{ $dock->id }}').val(message);
                                            $('#slider-value7{{ $dock->id }}').html(message);
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
                                        $('#beep-button{{ $dock->id }}').on('click', function() {
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
                                <script>
                                    $(document).ready(function() {
                                        $('#speaker-switch{{ $dock->id }}').on('change', function() {
                                            var message = $(this).prop('checked') ? '1' : '0';
                                            var topic = '{{ $dock->mac }}/config/dock/spkr_on';
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
        </div>
        {{-- setting model  --}}
     {{-- more setting  --}}
     <div id="more_set{{ $dock->id }}" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5> {{ $dock->name }} ({{ $dock->mac }})</h5>


                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">

                    </div>
                </div>

            </div>
        </div>
    </div>
       {{-- end more setting  --}}
    @endforeach

    <script>
        const checkbox = document.getElementById('formInlineCheck1');
        const rx_enabled = document.getElementsByName('rx_enabled')[0];

        checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
                rx_enabled.value = '1';
            } else {
                rx_enabled.value = '';
            }
        });
    </script>
@endsection
