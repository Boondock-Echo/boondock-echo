@extends('layouts.app1')
@section('content')
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
        }
    </style>
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
                            <tr class="hide-in-mobile">

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
                                            data-bs-target="#editUserModal{{ $dock->id }}">
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

                                    <td data-label="Code">
                                        @if (!empty($dock->code))
                                            <span class="d-block h5 text-inherit mb-0">{{ $dock->code }} </span>
                                        @else
                                            Not Yet Set
                                        @endif
                                        {{-- <span class="d-block h5 text-inherit mb-0"> {{ $dock->code ?? 'Not Yet Set' }} </span> --}}
                                    </td>
                                    <td data-label="Software Version">
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
                                    <td data-label="Status">
                                        <span
                                            class="legend-indicator {{ $dock->is_online == 1 ? 'bg-success' : 'bg-danger' }}"></span>{{ $dock->is_online == 1 ? 'Online' : 'Offline' }}
                                    </td>
                                    {{-- <td>{{ $dock->state ?? 'Not Yet Set' }}</td> --}}
                                    <td data-label="State">
                                        {{ $dock->city }}@if ($dock->state)
                                            , {{ $dock->state }}
                                        @endif
                                    </td>

                                    <td data-label="Stations">
                                        {{ !empty($dock->station) ? $dock->station : 'Station Not Found' }} -
                                        {{ $dock->frequency }}</td>
                                    <td>
                                        {{-- <button type="button" class="btn btn-white btn-sm" href="{{ route('users.edit',$dock->id) }}" data-bs-toggle="modal" data-bs-target="#editUserModal">
                    <i class="bi-pencil-fill me-1"></i> Edit
                  </button> --}}
                                        <a class="btn btn-white btn-sm" id="{{ $dock->id }}" data-bs-toggle="modal"
                                            data-id="{{ $dock->id }}" data-bs-target="#sett{{ $dock->id }}"> <i
                                                class="bi-sliders me-1"></i>Config</a>
                                        {{-- model setting start --}}


                                        {{-- model setting end --}}
                                        <a class="btn btn-white btn-sm" id="set{{ $dock->id }}"
                                            data-bs-toggle="modal" data-id="{{ $dock->id }}"
                                            data-bs-target="#editUserModal{{ $dock->id }}"> <i
                                                class="bi-gear me-1"></i>Settings</a>
                                        {{-- model start --}}

                                        <div class="modal fade" id="editUserModal{{ $dock->id }}" tabindex="-1"
                                            aria-labelledby="editUserModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            {{ $dock->name }} ({{ $dock->mac }})</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-body">
                                                            <form method="POST"
                                                                action="{{ route('mydocks.update', $dock->id) }}">
                                                                @csrf
                                                                @method('PUT')

                                                                <!-- Form -->
                                                                <div class="row mb-3">
                                                                    <label for="firstNameLabel"
                                                                        class="col-sm-3 col-form-label form-label">Dock
                                                                        Name</label>

                                                                    <div class="col-sm-9">
                                                                        <div class="input-group input-group-sm-vertical">
                                                                            <input type="text" class="form-control"
                                                                                name="name" placeholder="Name"
                                                                                aria-label="FirstName"
                                                                                value="{{ old('name', $dock->name) }}"
                                                                                required>
                                                                            {{-- <input type="text" class="form-control" name="lastName" id="lastNameLabel" placeholder="Last Name" aria-label="LastName"> --}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- End Form -->

                                                                <!-- Form -->
                                                                <div class="row mb-4">
                                                                    <label for="StationLabel"
                                                                        class="col-sm-3 col-form-label form-label">Station</label>

                                                                    <div class="col-sm-9">
                                                                        <input type="Station" class="form-control"
                                                                            name="station" placeholder="Station"
                                                                            aria-label=""
                                                                            value="{{ old('station', $dock->station) }}">
                                                                    </div>
                                                                </div>
                                                                <!-- End Form -->

                                                                <!-- Form -->
                                                                <div class="row mb-4">
                                                                    <label for="FrequencyLabel"
                                                                        class="col-sm-3 col-form-label form-label">Category</label>

                                                                    {{-- <div class="col-sm-9">
                                                                    <input type="float" class="form-control"
                                                                        name="frequency" id="FrequencyLabel"
                                                                        placeholder="Frequency" aria-label=""
                                                                        value="{{ old('frequency', $dock->frequency) }}" >
                                                                </div> --}}
                                                                    <div class="col-sm-9">

                                                                        <!-- Dropdown -->
                                                                        <div class="tom-select-custom">
                                                                            <select name="category" id="category"
                                                                                class="js-select form-select"
                                                                                autocomplete="off">
                                                                                @foreach ($categories as $category)
                                                                                    <option value="{{ $category->id }}"
                                                                                        {{ $dock->category == $category->id ? 'selected' : '' }}>
                                                                                        {{ $category->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>




                                                                        <!-- End Dropdown -->

                                                                    </div>
                                                                </div>
                                                                <!-- End Form -->

                                                                <!-- Form -->
                                                                <div class="row mb-4">
                                                                    <label for="Category"
                                                                        class="col-sm-3 col-form-label form-label">Frequency:</label>

                                                                    <div class="col-sm-9">
                                                                        <div class="input-group input-group-sm-vertical">
                                                                            <!-- Dropdown -->
                                                                            <input type="float" class="form-control"
                                                                                name="frequency" placeholder="Frequency"
                                                                                aria-label=""
                                                                                value="{{ old('frequency', $dock->frequency) }}">

                                                                            {{-- <div class="input-group input-group-sm-vertical ms-5 mt-2"> --}}
                                                                            <!-- Form Check -->
                                                                            <div
                                                                                class="form-check form-check-inline mx-5  mt-2">
                                                                                <input type="hidden" name="rx_enabled"
                                                                                    value="0">
                                                                                <input type="checkbox"
                                                                                    class="form-check-input"
                                                                                    name="rx_enabled" value="1"
                                                                                    {{ $dock->rx_enabled == 1 ? 'checked' : '' }}>
                                                                                <label class="form-check-label"
                                                                                    for="formInlineCheckReceived">Received</label>

                                                                                <div class="form-check form-check-inline ms-5"
                                                                                    style="margin-right: 50px">
                                                                                    <input type="hidden" name="tx_enabled"
                                                                                    value="0">
                                                                                    <input type="checkbox"
                                                                                        name="tx_enabled" value="1"
                                                                                        id="formInlineCheckTransmit"
                                                                                        class="form-check-input"
                                                                                        {{ $dock->tx_enabled == 1 ? 'checked' : '' }}>
                                                                                    <label class="form-check-label"
                                                                                        for="formInlineCheckTransmit">Transmit</label>
                                                                                </div>


                                                                            </div>
                                                                            <!-- End Form Check -->


                                                                            {{-- </div>   --}}
                                                                        </div>
                                                                        <!-- End Dropdown -->

                                                                    </div>




                                                                </div>



                                                                <!-- End Form -->

                                                                <!-- End Add Phone Input Field -->

                                                                <!-- Form -->

                                                                <div class="row mb-4">
                                                                    <label for="AddressLabel"
                                                                        class="col-sm-3 col-form-label form-label">Address</label>

                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control"
                                                                            name="address" placeholder="Address"
                                                                            aria-label="Address"
                                                                            value="{{ old('address', $dock->address) }}">
                                                                    </div>
                                                                </div>
                                                                <!-- End Form -->


                                                                {{-- City state zip in row start --}}

                                                                <div class="row mb-2">
                                                                    <label for="AddressLabel"
                                                                        class="col-sm-3 col-form-label form-label"></label>
                                                                    <div class="col-sm-9">
                                                                        <div class="row mb-4 gx-3">

                                                                            <div class="col-sm mb-2 mb-sm-0">
                                                                                <div class="d-grid">
                                                                                    <!-- Form -->
                                                                                    <div class="row mb-1">
                                                                                        <label for="CityLabel"
                                                                                            class="col-sm-3 col-form-label form-label">City</label>

                                                                                        <div class="col-sm-9">
                                                                                            <div
                                                                                                class="input-group input-group-sm-vertical">

                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    name="city"
                                                                                                    id="city"
                                                                                                    placeholder="City"
                                                                                                    aria-label="City"
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
                                                                                            <div
                                                                                                class="input-group input-group-sm-vertical">
                                                                                                <!-- Dropdown -->
                                                                                                <div class="btn-group">

                                                                                                    <!-- Select -->
                                                                                                    <div
                                                                                                        class="tom-select-custom">
                                                                                                        <select
                                                                                                            class="js-select form-select"
                                                                                                            autocomplete="on"
                                                                                                            data-hs-tom-select-options='{"placeholder": "Select State"}'
                                                                                                            value="{{ old('state', $dock->state) }}">
                                                                                                            <option
                                                                                                                value="">
                                                                                                                Select State
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="4">
                                                                                                                Thomas
                                                                                                                Edison
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="1">
                                                                                                                Illinois
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="3">
                                                                                                                Nikola Tesla
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="5">
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
                                                                                            <div
                                                                                                class="input-group input-group-sm-vertical">

                                                                                                <input type="number"
                                                                                                    class="form-control"
                                                                                                    name="zip"
                                                                                                    id="ZipLabel"
                                                                                                    placeholder="Zip"
                                                                                                    aria-label="Zip"
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
                                                                <div class="row mb-3">
                                                                    <label
                                                                        class="col-sm-3 col-form-label form-label">Location</label>

                                                                    <div class="col-sm-4">
                                                                        <div class="input-group input-group-sm-vertical">
                                                                            <!--  Check -->
                                                                            <div class="row mb-5 me-3">


                                                                                <div class="col-sm-17">
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        name="lon"
                                                                                        placeholder="Longitude"
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
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        name="lat"
                                                                                        placeholder="Latitude"
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

                                                                <div class="row">
                                                                    <div class="row mb-4 gx-3 " style="font-weight: 300">
                                                                        <div class="col-sm mb-2 mb-sm-0">
                                                                            <div class="d-grid">
                                                                                <button class="btn btn-warning mx-2"
                                                                                    type="button" data-bs-toggle="modal"
                                                                                    data-id="{{ $dock->id }}"
                                                                                    data-bs-target="#sett{{ $dock->id }}"><i
                                                                                        class="bi bi-record-circle"></i>
                                                                                    &nbsp;Recorder</button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm mb-2 mb-sm-0">
                                                                            <div class="d-grid">
                                                                                <button class="btn btn-success mx-2"
                                                                                    type="submit"><i
                                                                                        class="fa-solid fa-floppy-disk"></i>
                                                                                    &nbsp;
                                                                                    Save</button>
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-sm">
                                                                            <div class="d-grid">
                                                                                <button class="btn btn-info mx-2"> <i
                                                                                        class="bi bi-window-dock"></i>
                                                                                    &nbsp;
                                                                                    Identify</button>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                </div>

                                                                {{-- button end --}}
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                </div>



                {{-- model end --}}

                <form method="POST" action="{{ route('mydocks.destroy', $dock->id) }}" style="display:inline">
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
                                data-bs-target="#createdock" href="#">
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
    <div class="modal fade" id="createdock" tabindex="-1" aria-labelledby="editUserModalLabel"
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
                            <div class="" role="alert" id="notification{{ $dock->id }}"></div>

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
                                                value="{{ $dock->setting_speaker_volume }}">
                                            <input type="range" class="me-2" name="slider"
                                                id="slider1{{ $dock->id }}" min="0" max="100"
                                                value="{{ $dock->setting_speaker_volume }}">
                                            <input type="hidden" name="topic" id="topic1{{ $dock->id }}"
                                                value="{{ $dock->mac }}/set/spkr_vol">
                                            <span id="slider-value1{{ $dock->id }}" class="border border-5"
                                                contenteditable="true"
                                                style="border: 1px solid #ccc; padding: 5px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">{{ $dock->setting_speaker_volume }}</span>
                                        </form>
                                        <br>


                                        <form method="post" action="{{ route('mqtt.publish') }}">
                                            @csrf
                                            <label for="message7{{ $dock->id }}"><b> Transmit Volume</b></label>
                                            <input type="hidden" name="message" id="message7{{ $dock->id }}"
                                                value="{{ $dock->setting_speaker_out }}">
                                            <input type="range" class="me-2" name="slider"
                                                id="slider7{{ $dock->id }}" min="0" max="100"
                                                value="{{ $dock->setting_speaker_out }}">
                                            <input type="hidden" name="topic" id="topic7{{ $dock->id }}"
                                                value="{{ $dock->mac }}/set/tx_vol">
                                            <span id="slider-value7{{ $dock->id }}" class="border border-5"
                                                contenteditable="true"
                                                style="border: 1px solid #ccc; padding: 5px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">{{ $dock->setting_speaker_out }}</span>
                                        </form>

                                        {{-- <button id="save-button{{ $dock->id }}"> Save</button> --}}
                                    </div>
                                    <div class="form-group">
                                        <!-- <label class="label">Default:</label> -->

                                        <!-- Switch -->
                                        <label class="label mb-1"><b> Speaker </b> </label>
                                        <div class="form-check form-switch form-switch-between mb-6">
                                            <label class="form-check-label">Off</label>
                                            <input type="checkbox" class="form-check-input"
                                                id="speaker-switch{{ $dock->id }}"
                                                @if ($dock->speaker == 1) checked @endif>
                                            <label class="form-check-label">On</label>
                                        </div>
                                        <label class="label mb-1"><b> Notifications </b></label>
                                        <div class="form-check form-switch form-switch-between mb-6">
                                            <label class="form-check-label">Off</label>
                                            <input type="checkbox" class="form-check-input"
                                                id="notify{{ $dock->id }}"@if ($dock->notification == 1) checked @endif>
                                            <label class="form-check-label">On</label>
                                        </div>
                                        <!-- End Switch -->
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <h2 class="mb-4">Recorder Settings</h2>

                                    <form method="post" action="{{ route('mqtt.publish') }}">
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
                                            style="border: 1px solid #ccc; padding: 5px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">{{ $dock->auto_rec_sound_lv }}</span>
                                    </form>
                                    <br>

                                    <form method="post" action="{{ route('mqtt.publish') }}">
                                        @csrf
                                        <label for="message3{{ $dock->id }}"><b> Minimum Record Size (sec)</b></label>
                                        <input type="hidden" name="message" id="message3{{ $dock->id }}"
                                            value="{{ $dock->setting_min_recording }}">
                                        <input type="range" class="me-1" name="slider"
                                            id="slider3{{ $dock->id }}" min="0" max="30000"
                                            value="{{ $dock->setting_min_recording }}">
                                        <input type="hidden" name="topic" id="topic3{{ $dock->id }}"
                                            value="{{ $dock->mac }}/set/min_rec_sec">
                                        <span id="slider-value3{{ $dock->id }}" class="border border-5"
                                            contenteditable="true"
                                            style="border: 1px solid #ccc; padding: 5px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">{{ number_format($dock->setting_min_recording / 1000, 1) }}</span>
                                    </form>
                                    <br>

                                    <form method="post" action="{{ route('mqtt.publish') }}">
                                        @csrf
                                        <label for="message4{{ $dock->id }}"><b> Maximum Record Size (sec)</b></label>
                                        <input type="hidden" name="message" id="message4{{ $dock->id }}"
                                            value="{{ $dock->setting_max_recording }}">
                                        <input type="range" class="me-1" name="slider"
                                            id="slider4{{ $dock->id }}" min="0" max="60000"
                                            value="{{ $dock->setting_max_recording }}">
                                        <input type="hidden" name="topic" id="topic4{{ $dock->id }}"
                                            value="{{ $dock->mac }}/set/max_rec_sec">
                                        <span id="slider-value4{{ $dock->id }}" class="border border-5"
                                            contenteditable="true"
                                            style="border: 1px solid #ccc; padding: 5px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">{{ number_format($dock->setting_max_recording / 1000, 1) }}</span>
                                    </form>
                                    <br>

                                    <form method="post" action="{{ route('mqtt.publish') }}">
                                        @csrf
                                        <label for="message5{{ $dock->id }}"><b> Silence Trigger Stop
                                                (sec)</b></label>
                                        <input type="hidden" name="message" id="message5{{ $dock->id }}"
                                            value="{{ $dock->setting_silence }}">
                                        <input type="range" class="me-1" name="slider"
                                            id="slider5{{ $dock->id }}" min="0" max="10000"
                                            value="{{ $dock->setting_silence }}">
                                        <input type="hidden" name="topic" id="topic5{{ $dock->id }}"
                                            value="{{ $dock->mac }}/set/audio_stop_silence​">
                                        <span id="slider-value5{{ $dock->id }}" class="border border-5"
                                            contenteditable="true"
                                            style="border: 1px solid #ccc; padding: 5px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">{{ number_format($dock->setting_silence / 1000, 1) }}</span>
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
                                            <button class="btn btn-warning mx-2"
                                                id="default-button{{ $dock->id }}"><i class="fa-solid fa-gears"></i>
                                                &nbsp; Set Default</button>
                                        </div>
                                    </div>
                                    <!-- End Col -->

                                    <div class="col-sm">
                                        <div class="d-grid">
                                            <button class="btn btn-warning mx-2 " id="reboot-button{{ $dock->id }}">
                                                <i class="bi bi-arrow-clockwise"></i> &nbsp; Reboot</button>
                                        </div>
                                    </div>

                                    <!-- End Col -->
                                </div>
                                <div class="row mb-4 gx-3">
                                    <div class="col-sm mb-2 mb-sm-0">
                                        <div class="d-grid">
                                            <button class="btn btn-info mx-2 bi bi-window-dock"
                                                id="beep-button{{ $dock->id }}">&nbsp; Identify</button>
                                        </div>
                                    </div>
                                    <!-- End Col -->




                                    <div class="col-sm">
                                        <div class="d-grid">
                                            <button class="btn btn-success mx-2" id="save-button{{ $dock->id }}"><i
                                                    class="fa-solid fa-floppy-disk"></i> &nbsp; Save</button>
                                        </div>
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <div class="row gx-3">
                                    <div id="start-recording-btn{{ $dock->id }}" style="display: none"
                                        class="col-sm mb-2 mb-sm-0">
                                        <div class="d-grid">
                                            <button id="start-recording-btn{{ $dock->id }}"
                                                class="btn btn-success mx-2">Start Recording</button>
                                        </div>
                                    </div>
                                    <!-- End Col -->

                                    <div class="col-sm" id="stop-recording-btn{{ $dock->id }}"
                                        style="display: none">
                                        <div class="d-grid">
                                            <button id="stop-recording-btn{{ $dock->id }}"
                                                class="btn btn-danger mx-2">Stop Recording</button>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-grid">
                                            <button class="btn btn-secondary mx-2" data-bs-toggle="modal"
                                                data-id="more{{ $dock->id }}"
                                                data-bs-target="#more_set{{ $dock->id }}">More settings</button>
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

                                        });

                                        // Update slider when span value changes
                                        $('#slider-value1{{ $dock->id }}').on('input', function() {
                                            var message = $(this).html();
                                            var topic = $('#topic1{{ $dock->id }}').val();
                                            $('#message1{{ $dock->id }}').val(message);
                                            $('#slider1{{ $dock->id }}').val(message);

                                        });
                                        // Second Slider
                                        $('#slider2{{ $dock->id }}').on('change', function() {
                                            var message = $(this).val();
                                            var topic = $('#topic2{{ $dock->id }}').val();
                                            $('#message2{{ $dock->id }}').val(message);
                                            $('#slider-value2{{ $dock->id }}').html(message);

                                        });


                                        // Update slider when span value changes
                                        $('#slider-value2{{ $dock->id }}').on('input', function() {
                                            var message = $(this).html();
                                            var topic = $('#topic2{{ $dock->id }}').val();
                                            $('#message2{{ $dock->id }}').val(message);
                                            $('#slider2{{ $dock->id }}').val(message);
                                        });

                                        // minimum rec sec
                                        $('#slider3{{ $dock->id }}').on('change', function() {
                                            var message = $(this).val();
                                            var topic = $('#topic3{{ $dock->id }}').val();
                                            $('#message3{{ $dock->id }}').val(message);
                                            $('#slider-value3{{ $dock->id }}').html((message / 1000).toFixed(1));

                                        });
                                        // Update slider when span value changes
                                        $('#slider-value3{{ $dock->id }}').on('input', function() {
                                            var message = $(this).html();
                                            var topic = $('#topic3{{ $dock->id }}').val();
                                            $('#message3{{ $dock->id }}').val(message * 1000);
                                            $('#slider3{{ $dock->id }}').val(message * 1000);
                                        });
                                        // maximum rec sec
                                        $('#slider4{{ $dock->id }}').on('change', function() {
                                            var message = $(this).val();
                                            var topic = $('#topic4{{ $dock->id }}').val();
                                            $('#message4{{ $dock->id }}').val(message);
                                            $('#slider-value4{{ $dock->id }}').html((message / 1000).toFixed(1));

                                        });
                                        $('#slider-value4{{ $dock->id }}').on('input', function() {
                                            var message = $(this).html();
                                            var topic = $('#topic4{{ $dock->id }}').val();
                                            $('#message4{{ $dock->id }}').val(message * 1000);
                                            $('#slider4{{ $dock->id }}').val(message * 1000);
                                        });
                                        // Audio Silence Trigger
                                        $('#slider5{{ $dock->id }}').on('change', function() {
                                            var message = $(this).val();
                                            var topic = $('#topic5{{ $dock->id }}').val();
                                            $('#message5{{ $dock->id }}').val(message);
                                            $('#slider-value5{{ $dock->id }}').html((message / 1000).toFixed(1));

                                        });
                                        $('#slider-value5{{ $dock->id }}').on('input', function() {
                                            var message = $(this).html();
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
                                            $('#slider-value7{{ $dock->id }}').html(message);

                                        });
                                        $('#slider-value7{{ $dock->id }}').on('input', function() {
                                            var message = $(this).html();
                                            var topic = $('#topic7{{ $dock->id }}').val();
                                            $('#message7{{ $dock->id }}').val(message);
                                            $('#slider7{{ $dock->id }}').val(message);
                                        });
                                        $('#speaker-switch{{ $dock->id }}').on('change', function() {
                                            var message = $(this).prop('checked') ? '1' : '0';
                                            var topic = '{{ $dock->mac }}/set/spkr_on';

                                        });
                                        $('#notify{{ $dock->id }}').on('change', function() {
                                            var message = $(this).prop('checked') ? '1' : '0';
                                            var topic = '{{ $dock->mac }}/set/notify_on';

                                        });
                                        $('#save-button{{ $dock->id }}').on('click', function() {
                                            $(this).prop('disabled', true);
                                            setTimeout(function() {
                                                $('#save-button{{ $dock->id }}').prop('disabled', false);
                                            }, 4000);
                                            $('#notification{{ $dock->id }}').text(
                                                'Your setting is being updating, please wait...').addClass('d-flex').addClass(
                                                'alert alert-info').append(
                                                '<div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>');
                                            var topic1 = $('#topic1{{ $dock->id }}').val();
                                            var message1 = $('#message1{{ $dock->id }}').val();
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
                                            var message8 = $('#speaker-switch{{ $dock->id }}').prop('checked') ? '1' : '0';
                                            var topic8 = '{{ $dock->mac }}/set/spkr_on';
                                            var message9 = $('#notify{{ $dock->id }}').prop('checked') ? '1' : '0';
                                            var topic9 = '{{ $dock->mac }}/set/notify_on';

                                            $.ajax({
                                                type: 'POST',
                                                url: '{{ route('mqtt.publish') }}',
                                                data: {
                                                    '_token': '{{ csrf_token() }}',
                                                    'topic': topic1,
                                                    'message': message1
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
                                                    'setting_speaker_volume': message1,
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
                                                $('#notification{{ $dock->id }}').text('Your setting is saved.')
                                                    .removeClass('alert-info').addClass('alert-success');
                                            }, 4000);

                                        });
                                        $('#default-button{{ $dock->id }}').on('click', function() {
                                            $(this).prop('disabled', true);
                                            setTimeout(function() {
                                                $('#default-button{{ $dock->id }}').prop('disabled', false);
                                            }, 4000);
                                            // setTimeout(function() {
                                            //     location.reload();
                                            // }, 4500);
                                            $('#notification{{ $dock->id }}').text(
                                                'Default setting is being updating, please wait...').addClass('d-flex').addClass(
                                                'alert alert-info').append(
                                                '<div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>');
                                            var topic1 = $('#topic1{{ $dock->id }}').val();
                                            var message1 = '25';
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

                                            $.ajax({
                                                type: 'POST',
                                                url: '{{ route('mqtt.publish') }}',
                                                data: {
                                                    '_token': '{{ csrf_token() }}',
                                                    'topic': topic1,
                                                    'message': message1
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
                                                    'setting_speaker_volume': message1,
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
                                            }, 700);
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
                                            }, 1000);
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
                                            }, 1500);
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
                                            }, 2000);
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
                                            }, 2500);
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
                                            }, 3000);
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
                                                $('#notification{{ $dock->id }}').text('Your setting is saved.')
                                                    .removeClass('alert-info').addClass('alert-success');
                                            }, 4000);

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
                                            $(this).prop('disabled', true);
                                            setTimeout(function() {
                                                $('#beep-button{{ $dock->id }}').prop('disabled', false);
                                            }, 5000);
                                            setTimeout(function() {
                                                $('#notification{{ $dock->id }}').text('Signal is sent.')
                                                    .removeClass('alert-info').addClass('alert-success');
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
        </div>
        {{-- setting model  --}}
        {{-- more setting  --}}
        <div id="more_set{{ $dock->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5> {{ $dock->name }} ({{ $dock->mac }}) <span
                                class="badge bg-danger rounded-pill ms-1">Under Development</span></h5>


                        <button type="button" data-bs-toggle="modal" data-id="{{ $dock->id }}"
                            data-bs-target="#sett{{ $dock->id }}" class="btn btn-outline-dark">Back</button>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="" role="alert" id="notificationadv{{ $dock->id }}"></div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h2 class="mb-4">Trigger Recording​</h2>
                                    <div class="form-group mb-4">
                                        <!-- <label class="label">Default:</label> -->

                                        <!-- Switch -->
                                        {{-- <label class="label mb-1"><b> Speaker </b> </label> --}}
                                        {{-- <div class="form-check form-switch form-switch-between mb-4">
                                            <label class="form-check-label">Mono</label>
                                            <input type="checkbox" class="form-check-input"
                                                id="line_in_stereo{{ $dock->id }}"
                                                @if ($dock->line_in_stereo == 1) checked @endif>
                                            <label class="form-check-label">Stereo</label>

                                        </div> --}}
                                        <div class="input-group input-group-sm-vertical mb-4">
                                            <!-- Radio Check -->
                                            <label class="form-control" for="line_in_stereo1{{ $dock->id }}">
                                                <span class="form-check">
                                                    <input type="radio" class="form-check-input"
                                                        name="line_in_stereo1{{ $dock->id }}" value="0"
                                                        id="line_in_stereo1{{ $dock->id }}"
                                                        @if ($dock->line_in_stereo != 1) checked @endif>
                                                    <span class="form-check-label">Mono</span>
                                                </span>
                                            </label>
                                            <!-- End Radio Check -->

                                            <!-- Radio Check -->
                                            <label class="form-control" for="line_in_stereo11{{ $dock->id }}">
                                                <span class="form-check">
                                                    <input type="radio" class="form-check-input"
                                                        name="line_in_stereo11{{ $dock->id }}" value="1"
                                                        id="line_in_stereo11{{ $dock->id }}"
                                                        @if ($dock->line_in_stereo == 1) checked @endif>
                                                    <span class="form-check-label">Stereo</span>
                                                </span>
                                            </label>
                                            <script>
                                                $('#line_in_stereo11{{ $dock->id }}').on('change', function() {
                                                    if ($(this).prop('checked')) {
                                                        $('#line_in_stereo1{{ $dock->id }}').prop('checked', false);
                                                    }
                                                });

                                                $('#line_in_stereo1{{ $dock->id }}').on('change', function() {
                                                    if ($(this).prop('checked')) {
                                                        $('#line_in_stereo11{{ $dock->id }}').prop('checked', false);
                                                    }
                                                });
                                            </script>
                                            <!-- End Radio Check -->
                                        </div>

                                        {{-- <label class="label mb-1"><b> Notifications </b></label> --}}
                                        {{-- <div id="linechannel{{ $dock->id }}"
                                            class="form-check form-switch form-switch-between mb-4">
                                            <label class="form-check-label me-2">Left</label>
                                            <input type="checkbox" class="form-check-input"
                                                id="line_in_channel{{ $dock->id }}"@if ($dock->line_in_channel == 1) checked @endif>
                                            <label class="form-check-label">Right</label>
                                        </div> --}}
                                        <div id="linechannel{{ $dock->id }}"
                                            class="input-group input-group-sm-vertical mb-4">
                                            <!-- Radio Check -->
                                            <label class="form-control" for="line_in_channel1{{ $dock->id }}">
                                                <span class="form-check">
                                                    <input type="radio" class="form-check-input"
                                                        name="line_in_channel1{{ $dock->id }}" value="0"
                                                        id="line_in_channel1{{ $dock->id }}"
                                                        @if ($dock->line_in_channel != 1) checked @endif>
                                                    <span class="form-check-label">Left</span>
                                                </span>
                                            </label>
                                            <!-- End Radio Check -->

                                            <!-- Radio Check -->
                                            <label class="form-control" for="line_in_channel11{{ $dock->id }}">
                                                <span class="form-check">
                                                    <input type="radio" class="form-check-input"
                                                        name="line_in_channel11{{ $dock->id }}" value="1"
                                                        id="line_in_channel11{{ $dock->id }}"
                                                        @if ($dock->line_in_channel == 1) checked @endif>
                                                    <span class="form-check-label">Right</span>
                                                </span>
                                            </label>
                                            <script>
                                                $('#line_in_stereo11{{ $dock->id }}').on('change', function() {
                                                    if ($(this).prop('checked')) {
                                                        $('#line_in_stereo1{{ $dock->id }}').prop('checked', false);
                                                    }
                                                });

                                                $('#line_in_stereo1{{ $dock->id }}').on('change', function() {
                                                    if ($(this).prop('checked')) {
                                                        $('#line_in_stereo11{{ $dock->id }}').prop('checked', false);
                                                    }
                                                });
                                                $('#line_in_channel11{{ $dock->id }}').on('change', function() {
                                                    if ($(this).prop('checked')) {
                                                        $('#line_in_channel1{{ $dock->id }}').prop('checked', false);
                                                    }
                                                });

                                                $('#line_in_channel1{{ $dock->id }}').on('change', function() {
                                                    if ($(this).prop('checked')) {
                                                        $('#line_in_channel11{{ $dock->id }}').prop('checked', false);
                                                    }
                                                });
                                            </script>
                                            <!-- End Radio Check -->
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                // Initially hide the line-in-channel div if the line_in_stereo checkbox is not checked
                                                if (!$('#line_in_stereo1{{ $dock->id }}').is(':checked')) {
                                                    $('#linechannel{{ $dock->id }}').hide();
                                                }

                                                // Show/hide the line-in-channel div when the line_in_stereo checkbox is clicked
                                                $('#line_in_stereo11{{ $dock->id }}').click(function() {
                                                    if ($(this).is(':checked')) {
                                                        $('#linechannel{{ $dock->id }}').hide();
                                                    } else {
                                                        $('#linechannel{{ $dock->id }}').show();
                                                    }
                                                });
                                                $('#line_in_stereo1{{ $dock->id }}').click(function() {
                                                    if ($(this).is(':checked')) {
                                                        $('#linechannel{{ $dock->id }}').show();
                                                    } else {
                                                        $('#linechannel{{ $dock->id }}').hide();
                                                    }
                                                });
                                            });
                                        </script>
                                        <!-- End Switch -->
                                    </div>

                                    <div class="form-group mb-4">
                                        <style>
                                            progress {
                                                width: 100%;
                                                height: 30px;
                                            }
                                        </style>
                                        <form method="post" action="{{ route('mqtt.publish') }}">
                                            @csrf
                                            <label class="mx-2" for="message11{{ $dock->id }}"><b> Trigger Level
                                                    (db) </b></label>
                                            <input type="hidden" name="message" id="message11{{ $dock->id }}"
                                                value="{{ $dock->line_in_min_db }}">
                                            <input type="range" class="me-2" name="slider"
                                                id="slider11{{ $dock->id }}" min="0.0" max="5.0"
                                                step="0.1" value="{{ $dock->line_in_min_db }}">
                                            <input type="hidden" name="topic" id="topic11{{ $dock->id }}"
                                                value="{{ $dock->mac }}/set/line_in_min_db">
                                            <span id="slider-value11{{ $dock->id }}" class="border border-5"
                                                contenteditable="true"
                                                style="border: 1px solid #ccc; padding: 5px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">{{ $dock->line_in_min_db }}</span>
                                        </form>
                                        <br>


                                        <form method="post" action="{{ route('mqtt.publish') }}">
                                            @csrf
                                            <label class="mx-2" for="message12{{ $dock->id }}"><b> Gain
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                                            <input type="hidden" name="message" id="message12{{ $dock->id }}"
                                                value="{{ $dock->line_in_gain }}">
                                            {{-- <input type="range" class="me-2" name="slider"
                                                id="slider12{{ $dock->id }}" min="0" max="100"
                                                value="{{ $dock->line_in_gain }}"> --}}
                                            <select class="form-select" name="select"
                                                id="slider12{{ $dock->id }}">
                                                @foreach ([-1, 0, 3, 6, 9, 12, 15, 18, 21, 24] as $value)
                                                    <option value="{{ $value }}"
                                                        {{ $dock->line_in_gain == $value ? 'selected' : '' }}>
                                                        {{ $value }}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="topic" id="topic12{{ $dock->id }}"
                                                value="{{ $dock->mac }}/set/line_in_gain">
                                            {{-- <span id="slider-value12{{ $dock->id }}" class="border border-5"
                                                contenteditable="true"
                                                style="border: 1px solid #ccc; padding: 5px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">{{ $dock->line_in_gain }}</span> --}}
                                        </form>

                                        {{-- <button id="save-button{{ $dock->id }}"> Save</button> --}}
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <h2 class="mb-4">PTT Recording</h2>
                                    <div class="form-group mb-4">
                                        <!-- <label class="label">Default:</label> -->

                                        <!-- Switch -->
                                        {{-- <label class="label mb-1"><b> Speaker </b> </label> --}}
                                        {{-- <div class="form-check form-switch form-switch-between mb-4">
                                            <label class="form-check-label">Mono</label>
                                            <input type="checkbox" class="form-check-input"
                                                id="ptt_stereo{{ $dock->id }}"
                                                @if ($dock->ptt_stereo == 1) checked @endif>
                                            <label class="form-check-label">Stereo</label>
                                        </div> --}}
                                        <div class="input-group input-group-sm-vertical mb-4">
                                            <!-- Radio Check -->
                                            <label class="form-control" for="ptt_stereo1{{ $dock->id }}">
                                                <span class="form-check">
                                                    <input type="radio" class="form-check-input"
                                                        name="ptt_stereo1{{ $dock->id }}" value="0"
                                                        id="ptt_stereo1{{ $dock->id }}"
                                                        @if ($dock->ptt_stereo != 1) checked @endif>
                                                    <span class="form-check-label">Mono</span>
                                                </span>
                                            </label>
                                            <!-- End Radio Check -->

                                            <!-- Radio Check -->
                                            <label class="form-control" for="ptt_stereo11{{ $dock->id }}">
                                                <span class="form-check">
                                                    <input type="radio" class="form-check-input"
                                                        name="ptt_stereo11{{ $dock->id }}" value="1"
                                                        id="ptt_stereo11{{ $dock->id }}"
                                                        @if ($dock->ptt_stereo == 1) checked @endif>
                                                    <span class="form-check-label">Stereo</span>
                                                </span>
                                            </label>
                                            <script>
                                                $('#ptt_stereo11{{ $dock->id }}').on('change', function() {
                                                    if ($(this).prop('checked')) {
                                                        $('#ptt_stereo1{{ $dock->id }}').prop('checked', false);
                                                    }
                                                });

                                                $('#ptt_stereo1{{ $dock->id }}').on('change', function() {
                                                    if ($(this).prop('checked')) {
                                                        $('#ptt_stereo11{{ $dock->id }}').prop('checked', false);
                                                    }
                                                });
                                            </script>
                                            <!-- End Radio Check -->
                                        </div>
                                        {{-- <label class="label mb-1"><b> Notifications </b></label> --}}
                                        {{-- <div id="pttchannel{{ $dock->id }}"
                                            class="form-check form-switch form-switch-between mb-4">
                                            <label class="form-check-label me-2">Left</label>
                                            <input type="checkbox" class="form-check-input"
                                                id="ptt_channel{{ $dock->id }}"@if ($dock->ptt_channel == 1) checked @endif>
                                            <label class="form-check-label">Right</label>
                                        </div> --}}
                                        <div id="pttchannel{{ $dock->id }}"
                                            class="input-group input-group-sm-vertical mb-4">
                                            <!-- Radio Check -->
                                            <label class="form-control" for="ptt_channel1{{ $dock->id }}">
                                                <span class="form-check">
                                                    <input type="radio" class="form-check-input"
                                                        name="ptt_channel1{{ $dock->id }}" value="0"
                                                        id="ptt_channel1{{ $dock->id }}"
                                                        @if ($dock->ptt_channel != 1) checked @endif>
                                                    <span class="form-check-label">Left</span>
                                                </span>
                                            </label>
                                            <!-- End Radio Check -->

                                            <!-- Radio Check -->
                                            <label class="form-control" for="ptt_channel11{{ $dock->id }}">
                                                <span class="form-check">
                                                    <input type="radio" class="form-check-input"
                                                        name="ptt_channel11{{ $dock->id }}" value="1"
                                                        id="ptt_channel11{{ $dock->id }}"
                                                        @if ($dock->ptt_channel == 1) checked @endif>
                                                    <span class="form-check-label">Right</span>
                                                </span>
                                            </label>
                                            <script>
                                                $('#ptt_stereo11{{ $dock->id }}').on('change', function() {
                                                    if ($(this).prop('checked')) {
                                                        $('#ptt_stereo1{{ $dock->id }}').prop('checked', false);
                                                    }
                                                });

                                                $('#ptt_stereo1{{ $dock->id }}').on('change', function() {
                                                    if ($(this).prop('checked')) {
                                                        $('#ptt_stereo11{{ $dock->id }}').prop('checked', false);
                                                    }
                                                });
                                                $('#ptt_channel11{{ $dock->id }}').on('change', function() {
                                                    if ($(this).prop('checked')) {
                                                        $('#ptt_channel1{{ $dock->id }}').prop('checked', false);
                                                    }
                                                });

                                                $('#ptt_channel1{{ $dock->id }}').on('change', function() {
                                                    if ($(this).prop('checked')) {
                                                        $('#ptt_channel11{{ $dock->id }}').prop('checked', false);
                                                    }
                                                });
                                            </script>
                                            <!-- End Radio Check -->
                                        </div>

                                        <!-- End Switch -->
                                        <script>
                                            $(document).ready(function() {
                                                // Initially hide the line-in-channel div if the line_in_stereo checkbox is not checked
                                                if (!$('#ptt_stereo1{{ $dock->id }}').is(':checked')) {
                                                    $('#pttchannel{{ $dock->id }}').hide();
                                                }

                                                // Show/hide the ptt-in-channel div when the ptt_in_stereo checkbox is clicked
                                                $('#ptt_stereo11{{ $dock->id }}').click(function() {
                                                    if ($(this).is(':checked')) {
                                                        $('#pttchannel{{ $dock->id }}').hide();
                                                    } else {
                                                        $('#pttchannel{{ $dock->id }}').show();
                                                    }
                                                });
                                                $('#ptt_stereo1{{ $dock->id }}').click(function() {
                                                    if ($(this).is(':checked')) {
                                                        $('#pttchannel{{ $dock->id }}').show();
                                                    } else {
                                                        $('#pttchannel{{ $dock->id }}').hide();
                                                    }
                                                });
                                            });
                                        </script>
                                    </div>

                                    <div class="form-group mb-4">
                                        <style>
                                            progress {
                                                width: 100%;
                                                height: 30px;
                                            }
                                        </style>
                                        <form method="post" action="{{ route('mqtt.publish') }}">
                                            @csrf
                                            <label class="mx-2" for="message13{{ $dock->id }}"><b> Trigger Level
                                                    (db) </b></label>
                                            <input type="hidden" name="message" id="message13{{ $dock->id }}"
                                                value="{{ $dock->ptt_min_db }}">
                                            <input type="range" class="me-2" name="slider"
                                                id="slider13{{ $dock->id }}" min="0.0" max="5.0"
                                                step="0.1" value="{{ $dock->ptt_min_db }}">
                                            <input type="hidden" name="topic" id="topic13{{ $dock->id }}"
                                                value="{{ $dock->mac }}/set/ptt_min_db">
                                            <span id="slider-value13{{ $dock->id }}" class="border border-5"
                                                contenteditable="true"
                                                style="border: 1px solid #ccc; padding: 5px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">{{ $dock->ptt_min_db }}</span>
                                        </form>
                                        <br>


                                        <form method="post" action="{{ route('mqtt.publish') }}">
                                            @csrf
                                            <label class="mx-2" for="message14{{ $dock->id }}"><b> Gain
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                                            <input type="hidden" name="message" id="message14{{ $dock->id }}"
                                                value="{{ $dock->ptt_gain }}">
                                            {{-- <input type="range" class="me-2" name="slider"
                                                id="slider14{{ $dock->id }}" min="0" max="100"
                                                value="{{ $dock->ptt_gain }}"> --}}
                                            <select class="form-select" name="select"
                                                id="slider14{{ $dock->id }}">
                                                @foreach ([-1, 0, 3, 6, 9, 12, 15, 18, 21, 24] as $value)
                                                    <option value="{{ $value }}"
                                                        {{ $dock->ptt_gain == $value ? 'selected' : '' }}>
                                                        {{ $value }}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="topic" id="topic14{{ $dock->id }}"
                                                value="{{ $dock->mac }}/set/ptt_gain">
                                            {{-- <span id="slider-value14{{ $dock->id }}" class="border border-5"
                                                contenteditable="true"
                                                style="border: 1px solid #ccc; padding: 5px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;">{{ $dock->ptt_gain }}</span> --}}
                                        </form>

                                        {{-- <button id="save-button{{ $dock->id }}"> Save</button> --}}
                                    </div>


                                </div>
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
                                                <td data-label="WiFi SSID"><input class="form-control" type="text"
                                                        placeholder="SSID" id="ssid1{{ $dock->id }}"></td>
                                                <td data-label="Password"><input class="form-control" type="password"
                                                        placeholder="Password" id="password1{{ $dock->id }}"></td>
                                                <td data-label="Actions"><button class="btn btn-info"
                                                        id="update-button1{{ $dock->id }}">Update</button></td>
                                            </tr>
                                            <tr>
                                                <td data-label="No.">2</td>
                                                <td data-label="WiFi SSID"><input class="form-control" type="text"
                                                        placeholder="SSID" id="ssid2{{ $dock->id }}"></td>
                                                <td data-label="Password"><input class="form-control" type="password"
                                                        placeholder="Password" id="password2{{ $dock->id }}"></td>
                                                <td data-label="Actions"><button class="btn btn-info"
                                                        id="update-button2{{ $dock->id }}">Update</button></td>
                                            </tr>
                                            <tr>
                                                <td data-label="No.">3</td>
                                                <td data-label="WiFi SSID"><input class="form-control" type="text"
                                                        placeholder="SSID" id="ssid3{{ $dock->id }}"></td>
                                                <td data-label="Password"><input class="form-control" type="password"
                                                        placeholder="Password" id="password3{{ $dock->id }}"></td>
                                                <td data-label="Actions"><button class="btn btn-info"
                                                        id="update-button3{{ $dock->id }}">Update</button></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                                <span class="divider-center mb-4">Settings</span>
                                <div class="row mb-4 gx-3">

                                    <div class="col-sm mb-2 mb-sm-0">
                                        <div class="d-grid"><button class="btn btn-info mx-2"
                                                id="rebootadv-button{{ $dock->id }}"><i
                                                    class="bi bi-arrow-clockwise"></i> &nbsp;Reboot</button>

                                        </div>
                                    </div>
                                    <!-- End Col -->




                                    <div class="col-sm">
                                        <div class="d-grid">
                                            <button class="btn btn-success mx-2"
                                                id="save-buttonadvance{{ $dock->id }}"><i
                                                    class="fa-solid fa-floppy-disk"></i> &nbsp; Save</button>
                                        </div>
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <div class="row mb-4 gx-3">
                                    <div class="col-sm mb-2 mb-sm-0">
                                        <div class="d-grid">
                                            <button class="btn btn-danger mx-2"
                                                id="defaultadv-button{{ $dock->id }}"> <i
                                                    class="fa-solid fa-gears"></i> &nbsp; Set Default</button>
                                        </div>
                                    </div>
                                    <!-- End Col -->

                                    <div class="col-sm">
                                        <div class="d-grid">
                                            <button class="btn btn-danger mx-2"
                                                id="factory-button{{ $dock->id }}"><i
                                                    class="bi bi-arrow-clockwise"></i> &nbsp; Factory Reset</button>
                                        </div>
                                    </div>

                                    <!-- End Col -->
                                </div>



                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                    $(document).ready(function() {
                                        // First Slider
                                        $('#slider11{{ $dock->id }}').on('change', function() {
                                            var message = $(this).val();
                                            var topic = $('#topic11{{ $dock->id }}').val();
                                            $('#message11{{ $dock->id }}').val(message);
                                            $('#slider-value11{{ $dock->id }}').html(message);

                                        });

                                        // Update slider when span value changes
                                        $('#slider-value11{{ $dock->id }}').on('input', function() {
                                            var message = $(this).html();
                                            var topic = $('#topic11{{ $dock->id }}').val();
                                            $('#message11{{ $dock->id }}').val(message);
                                            $('#slider11{{ $dock->id }}').val(message);

                                        });
                                        // Second Slider
                                        $('#slider12{{ $dock->id }}').on('change', function() {
                                            var message = $(this).val();
                                            var topic = $('#topic12{{ $dock->id }}').val();
                                            $('#message12{{ $dock->id }}').val(message);
                                            $('#slider-value12{{ $dock->id }}').html(message);

                                        });


                                        // Update slider when span value changes
                                        $('#slider-value12{{ $dock->id }}').on('input', function() {
                                            var message = $(this).html();
                                            var topic = $('#topic12{{ $dock->id }}').val();
                                            $('#message12{{ $dock->id }}').val(message);
                                            $('#slider12{{ $dock->id }}').val(message);
                                        });

                                        // minimum rec sec
                                        $('#slider13{{ $dock->id }}').on('change', function() {
                                            var message = $(this).val();
                                            var topic = $('#topic13{{ $dock->id }}').val();
                                            $('#message13{{ $dock->id }}').val(message);
                                            $('#slider-value13{{ $dock->id }}').html(message);

                                        });
                                        // Update slider when span value changes
                                        $('#slider-value13{{ $dock->id }}').on('input', function() {
                                            var message = $(this).html();
                                            var topic = $('#topic13{{ $dock->id }}').val();
                                            $('#message13{{ $dock->id }}').val(message);
                                            $('#slider13{{ $dock->id }}').val(message);
                                        });
                                        // maximum rec sec
                                        $('#slider14{{ $dock->id }}').on('change', function() {
                                            var message = $(this).val();
                                            var topic = $('#topic14{{ $dock->id }}').val();
                                            $('#message14{{ $dock->id }}').val(message);
                                            $('#slider-value14{{ $dock->id }}').html(message);

                                        });
                                        $('#slider-value14{{ $dock->id }}').on('input', function() {
                                            var message = $(this).html();
                                            var topic = $('#topic14{{ $dock->id }}').val();
                                            $('#message14{{ $dock->id }}').val(message);
                                            $('#slider14{{ $dock->id }}').val(message);
                                        });

                                        $('#line_in_stereo11{{ $dock->id }}').on('change', function() {
                                            var message = $(this).prop('checked') ? '1' : '0';
                                            var topic = '{{ $dock->mac }}/set/line_in_stereo';

                                        });
                                        $('#line_in_channel11{{ $dock->id }}').on('change', function() {
                                            var message = $(this).prop('checked') ? '1' : '0';
                                            var topic = '{{ $dock->mac }}/set/line_in_channel';

                                        });
                                        $('#ptt_stereo11{{ $dock->id }}').on('change', function() {
                                            var message = $(this).prop('checked') ? '1' : '0';
                                            var topic = '{{ $dock->mac }}/set/ptt_stereo';

                                        });
                                        $('#ptt_channel11{{ $dock->id }}').on('change', function() {
                                            var message = $(this).prop('checked') ? '1' : '0';
                                            var topic = '{{ $dock->mac }}/set/ptt_channel';

                                        });
                                        $('#save-buttonadvance{{ $dock->id }}').on('click', function() {
                                            $(this).prop('disabled', true);
                                            setTimeout(function() {
                                                $('#save-buttonadvance{{ $dock->id }}').prop('disabled', false);
                                            }, 4000);
                                            $('#notificationadv{{ $dock->id }}').text(
                                                'Your setting is being updating, please wait...').addClass('d-flex').addClass(
                                                'alert alert-info').append(
                                                '<div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>');
                                            var topic11 = $('#topic11{{ $dock->id }}').val();
                                            var message11 = $('#message11{{ $dock->id }}').val();
                                            var topic12 = $('#topic12{{ $dock->id }}').val();
                                            var message12 = $('#message12{{ $dock->id }}').val();
                                            var topic13 = $('#topic13{{ $dock->id }}').val();
                                            var message13 = $('#message13{{ $dock->id }}').val();
                                            var topic14 = $('#topic14{{ $dock->id }}').val();
                                            var message14 = $('#message14{{ $dock->id }}').val();

                                            var message18 = $('#line_in_stereo11{{ $dock->id }}').prop('checked') ? '1' : '0';
                                            var topic18 = '{{ $dock->mac }}/set/line_in_stereo';
                                            var message19 = $('#line_in_channel11{{ $dock->id }}').prop('checked') ? '1' : '0';
                                            var topic19 = '{{ $dock->mac }}/set/line_in_channel';
                                            var message20 = $('#ptt_stereo11{{ $dock->id }}').prop('checked') ? '1' : '0';
                                            var topic20 = '{{ $dock->mac }}/set/ptt_stereo';
                                            var message21 = $('#ptt_channel11{{ $dock->id }}').prop('checked') ? '1' : '0';
                                            var topic21 = '{{ $dock->mac }}/set/ptt_channel';

                                            $.ajax({
                                                type: 'POST',
                                                url: '{{ route('mqtt.publish') }}',
                                                data: {
                                                    '_token': '{{ csrf_token() }}',
                                                    'topic': topic11,
                                                    'message': message11
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
                                                    'line_in_min_db': message11,
                                                    'line_in_gain': message12,
                                                    'ptt_min_db': message13,
                                                    'ptt_gain': message14,
                                                    'line_in_stereo': message18,
                                                    'line_in_channel': message19,
                                                    'ptt_stereo': message20,
                                                    'ptt_channel': message21,
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
                                                        'topic': topic12,
                                                        'message': message12
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
                                                        'topic': topic13,
                                                        'message': message13
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
                                                        'topic': topic14,
                                                        'message': message14
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
                                                        'topic': topic18,
                                                        'message': message18
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
                                                        'topic': topic19,
                                                        'message': message19
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
                                                        'topic': topic20,
                                                        'message': message20
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
                                                        'topic': topic21,
                                                        'message': message21
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
                                            }, 3600);
                                            setTimeout(function() {
                                                $('#notificationadv{{ $dock->id }}').text('Your setting is saved.')
                                                    .removeClass('alert-info').addClass('alert-success');
                                            }, 4000);

                                        });
                                        $('#defaultadv-button{{ $dock->id }}').on('click', function() {
                                            $(this).prop('disabled', true);
                                            setTimeout(function() {
                                                $('#defaultadv-button{{ $dock->id }}').prop('disabled', false);
                                            }, 4000);
                                            // setTimeout(function() {
                                            //     location.reload();
                                            // }, 5000);
                                            $('#notificationadv{{ $dock->id }}').text(
                                                'Default setting is being updating, please wait...').addClass('d-flex').addClass(
                                                'alert alert-info').append(
                                                '<div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>');
                                            var topic11 = $('#topic11{{ $dock->id }}').val();
                                            var message11 = '1.0';
                                            var topic12 = $('#topic12{{ $dock->id }}').val();
                                            var message12 = '3';
                                            var topic13 = $('#topic13{{ $dock->id }}').val();
                                            var message13 = '1.0';
                                            var topic14 = $('#topic14{{ $dock->id }}').val();
                                            var message14 = '3';

                                            var message18 = '0';
                                            var topic18 = '{{ $dock->mac }}/set/line_in_stereo';
                                            var message19 = '0';
                                            var topic19 = '{{ $dock->mac }}/set/line_in_channel';
                                            var message20 = '0';
                                            var topic20 = '{{ $dock->mac }}/set/ptt_stereo';
                                            var message21 = '1';
                                            var topic21 = '{{ $dock->mac }}/set/ptt_channel';

                                            $.ajax({
                                                type: 'POST',
                                                url: '{{ route('mqtt.publish') }}',
                                                data: {
                                                    '_token': '{{ csrf_token() }}',
                                                    'topic': topic11,
                                                    'message': message11
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
                                                    'line_in_min_db': message11,
                                                    'line_in_gain': message12,
                                                    'ptt_min_db': message13,
                                                    'ptt_gain': message14,
                                                    'line_in_stereo': message18,
                                                    'line_in_channel': message19,
                                                    'ptt_stereo': message20,
                                                    'ptt_channel': message21,
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
                                                        'topic': topic12,
                                                        'message': message12
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
                                                        'topic': topic13,
                                                        'message': message13
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
                                                        'topic': topic14,
                                                        'message': message14
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
                                                        'topic': topic18,
                                                        'message': message18
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
                                                        'topic': topic19,
                                                        'message': message19
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
                                                        'topic': topic20,
                                                        'message': message20
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
                                                        'topic': topic21,
                                                        'message': message21
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
                                            }, 3600);
                                            setTimeout(function() {
                                                $('#notificationadv{{ $dock->id }}').text('Your setting is saved.')
                                                    .removeClass('alert-info').addClass('alert-success');
                                            }, 4000);

                                        });

                                    });
                                </script>
                                <script>
                                    $(document).ready(function() {
                                        // reboot
                                        $('#rebootadv-button{{ $dock->id }}').on('click', function() {
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
                                        $('#factory-button{{ $dock->id }}').on('click', function() {
                                            $(this).prop('disabled', true);
                                            setTimeout(function() {
                                                $('#factory-button{{ $dock->id }}').prop('disabled', false);
                                            }, 5000);
                                            setTimeout(function() {
                                                $('#notificationadv{{ $dock->id }}').text('Factory Reset Successfully.')
                                                    .removeClass('alert-info').addClass('alert-success');
                                            }, 5000);
                                            $('#notificationadv{{ $dock->id }}').text(
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
