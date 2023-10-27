@extends('layouts.app1')
@section('content')

    <style>
        .switch {
            position: relative;
            display: inline-block;
            vertical-align: top;
            width: 56px;
            height: 20px;
            padding: 3px;
            background-color: white;
            border-radius: 18px;
            box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
            cursor: pointer;
            background-image: -webkit-linear-gradient(top, #eeeeee, white 25px);
            background-image: -moz-linear-gradient(top, #eeeeee, white 25px);
            background-image: -o-linear-gradient(top, #eeeeee, white 25px);
            background-image: linear-gradient(to bottom, #eeeeee, white 25px);
        }

        .switch-input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        .switch-label {
            position: relative;
            display: block;
            height: inherit;
            font-size: 10px;
            text-transform: uppercase;
            background: #eceeef;
            border-radius: inherit;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
            -webkit-transition: 0.15s ease-out;
            -moz-transition: 0.15s ease-out;
            -o-transition: 0.15s ease-out;
            transition: 0.15s ease-out;
            -webkit-transition-property: opacity background;
            -moz-transition-property: opacity background;
            -o-transition-property: opacity background;
            transition-property: opacity background;
        }

        .switch-label:before,
        .switch-label:after {
            position: absolute;
            top: 50%;
            margin-top: -.5em;
            line-height: 1;
            -webkit-transition: inherit;
            -moz-transition: inherit;
            -o-transition: inherit;
            transition: inherit;
        }

        .switch-label:before {
            content: attr(data-off);
            right: 11px;
            color: #aaa;
            text-shadow: 0 1px rgba(255, 255, 255, 0.5);
        }

        .switch-label:after {
            content: attr(data-on);
            left: 11px;
            color: white;
            text-shadow: 0 1px rgba(0, 0, 0, 0.2);
            opacity: 0;
        }

        .switch-input:checked~.switch-label {
            background: #47a8d8;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
        }

        .switch-input:checked~.switch-label:before {
            opacity: 0;
        }

        .switch-input:checked~.switch-label:after {
            opacity: 1;
        }

        .switch-handle {
            position: absolute;
            top: 4px;
            left: 4px;
            width: 18px;
            height: 18px;
            background: white;
            border-radius: 10px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
            background-image: -webkit-linear-gradient(top, white 40%, #f0f0f0);
            background-image: -moz-linear-gradient(top, white 40%, #f0f0f0);
            background-image: -o-linear-gradient(top, white 40%, #f0f0f0);
            background-image: linear-gradient(to bottom, white 40%, #f0f0f0);
            -webkit-transition: left 0.15s ease-out;
            -moz-transition: left 0.15s ease-out;
            -o-transition: left 0.15s ease-out;
            transition: left 0.15s ease-out;
        }

        .switch-handle:before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            margin: -6px 0 0 -6px;
            width: 12px;
            height: 12px;
            background: #f9f9f9;
            border-radius: 6px;
            box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
            background-image: -webkit-linear-gradient(top, #eeeeee, white);
            background-image: -moz-linear-gradient(top, #eeeeee, white);
            background-image: -o-linear-gradient(top, #eeeeee, white);
            background-image: linear-gradient(to bottom, #eeeeee, white);
        }

        .switch-input:checked~.switch-handle {
            left: 40px;
            box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
        }

        .switch-green>.switch-input:checked~.switch-label {
            background: #4fb845;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            {{-- <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-sm mb-2 mb-sm-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-no-gutter">
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Pages</a></li>
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">My Dock Packs </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Overview</li>
                            </ol>
                        </nav>

                        <h1 class="page-header-title">My Dock Packs</h1>
                    </div>
                    
                </div>
               
            </div> --}}
            <!-- End Page Header -->
            {{-- @if (session('error'))
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
            @endif --}}
            <!-- Stats -->
            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Total Dock Packs Register</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span class="js-counter display-4 text-dark">
                                        @foreach ($dockpacks as $key => $dock)
                                            @if ($loop->last)
                                                {{ $key + 1 }}
                                            @endif
                                        @endforeach
                                    </span>
                                    {{-- <span class="text-body fs-5 ms-1">from {{ $totalDocks }}</span> --}}
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
                            <h6 class="card-subtitle mb-2">Docks Online</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span
                                        class="js-counter display-4 text-dark">{{ count($dockpacks->where('is_online', '!=', null)) }}</span>
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

                <!-- strat bot Col -->
                @if ($message = Session::get('success'))
                    <!-- Toast -->

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
                @if ($errors->any())
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
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- End bot Col -->
            </div>
            <!-- End Stats -->

            <!-- Card -->
            <div class="card">
                <!-- Header -->
                <div class="card-header  d-flex justify-content-between align-items-center">
                    <!-- Nav -->
                    <ul class="nav" role="">
                        {{-- <li class="" >
                                   
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-white btn-sm " id="usersFilterDropdown"
                                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                            <i class="bi-filter icon-lg"></i><span
                                                class="badge bg-soft-dark text-dark rounded-circle ms-1"></span>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-sm-end dropdown-card card-dropdown-filter-centered"
                                            aria-labelledby="usersFilterDropdown" style="min-width: 22rem;">
                                           
                                            <div class="card">
                                                <div class="card-header card-header-content-between">
                                                    <h5 class="card-header-title">Docks Per Page</h5>

                                                    
                                                    <button type="button"
                                                        class="btn btn-ghost-secondary btn-icon btn-sm ms-2">
                                                        <i class="bi-x-lg"></i>
                                                    </button>
                                                   
                                                </div>

                                                <div class="card-body">
                                                    <form class="form-inline my-2 my-lg-0 mb-4">
                                                        <select name="per_page" class="form-control mr-sm-2">
                                                            <option value="5">5</option>
                                                            <option value="10">10</option>
                                                            <option value="20">20</option>
                                                            <option value="25">25</option>
                                                            <option value="50">50</option>
                                                            <option value="100">100</option>
                                                        </select>

                                                        <div class="d-grid mt-4">
                                                            <button class="btn btn-primary" type="button">Filter</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                    </li> --}}

                        <li class="mx-3">
                            <form>
                                <!-- Search -->
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend input-group-text">
                                        <i class="bi-search"></i>
                                    </div>
                                    <input id="datatableSearch" type="search" class="form-control"
                                        placeholder="Search docks" aria-label="Search Docks">
                                </div>
                                <!-- End Search -->
                            </form>
                        </li>
                    </ul>
                    <!-- End Nav -->




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


                        <!-- Register new Dock Pack button-->
                        <div class="col-sm-auto">
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createdockpack"
                                href="#">
                                <i class="bi-box"></i> &nbsp; Register new Dock Pack
                            </a>
                        </div>


                        <!-- End Dropdown -->
                    </div>
                </div>
                <!-- End Header -->

                <!-- Table -->
                <div class="table-responsive datatable-custom position-relative">
                    <table id="datatable"
                        class="table table-lg table-borderless table-thead-bordered table-align-middle card-table"
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
                                <th>Description</th>
                                <th>Number Of docks</th>
                                {{-- <th>Hardware</th> --}}
                                <th>Transmit Enabled</th>
                                <th>Receive Enabled</th>
                                <th>Online</th>
                                <th>Updated</th>
                                {{-- <th>Created</th> --}}
                                <th> Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($dockpacks as $key => $dockpack)
                                <tr>

                                    <td data-label="Name">
                                        <a class="d-flex align-items-center" data-bs-toggle="modal" data-id="30"
                                            data-bs-target="#editUserModal{{ $dockpack->id }}">
                                            <b> {{ $dockpack->name ?? 'Not Yet Set' }} </b>
                                        </a>



                                    </td>

                                    <td data-label="Decription">
                                        @if (!empty($dockpack->description))
                                            @php
                                                $description_words = str_word_count($dockpack->description);
                                                $max_words = 4;
                                            @endphp
                                            @if ($description_words > $max_words)
                                                <div class="description-text">
                                                    <span
                                                        class="d-block h5 text-inherit mb-0">{{ implode(' ', array_slice(str_word_count($dockpack->description, 1), 0, $max_words)) }}...</span>
                                                    {{-- <a href="#" class="toggle-description">More</a> --}}
                                                    <a class="toggle-description" href="#" data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ $dockpack->description }}">Show more
                                                        ?</a>
                                                    <span
                                                        class="full-description d-none">{{ $dockpack->description }}</span>
                                                    <a href="#" class="toggle-description d-none"> <br> Show
                                                        Less</a>
                                                </div>
                                            @else
                                                <span
                                                    class="d-block h5 text-inherit mb-0">{{ $dockpack->description }}</span>
                                            @endif
                                        @else
                                            Not Description
                                        @endif

                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                        <script>
                                            $('.toggle-description').click(function(e) {
                                                e.preventDefault();
                                                $('.description-text .toggle-description').toggleClass('d-none');
                                                $('.description-text .full-description').toggleClass('d-none');
                                                $('.description-text .h5').toggleClass('d-none');
                                            });
                                        </script>


                                    </td>
                                    <td data-label="No. of  Docks">
                                        <span
                                            class="text-dark">{{ $dockcount->where('dock_pack_id', $dockpack->id)->count() }}</span>
                                    </td>

                                    <td data-label="Transmit Enabled">
                                        <span
                                            class="text-dark">{{ $dockcount->where('dock_pack_id', $dockpack->id)->where('tx_enabled', 1)->count() }}</span>

                                    </td>
                                    {{-- <td>{{ $dockpack->state ?? 'Not Yet Set' }}</td> --}}
                                    <td data-label="Receive Enabled">
                                        <span class="text-dark">
                                            {{ $dockcount->where('dock_pack_id', $dockpack->id)->where('rx_enabled', 1)->count() }}</span>

                                    </td>
                                    <td data-label="Updated">
                                        <span
                                            class="legend-indicator {{ $dockpack->is_online == 1 ? 'bg-success' : 'bg-danger' }}"></span><span
                                            class="text-dark">{{ $dockpack->is_online == 1 ? 'Online' : 'Offline' }}
                                    </td></span>
                                    <td data-label="Updated">


                                        <span class="text-dark">
                                            {{ \Carbon\Carbon::parse($dockpack->updated_at)->format('M d Y h:i A') }}
                                    </td>
                                    </span>
                                    <td>

                                        {{-- model setting end --}}
                                        <span class=" d-inline-flex text-dark">
                                            <a class="btn btn-white btn-sm text-dark" id="set{{ $dockpack->id }}"
                                                data-bs-toggle="modal" data-id="{{ $dockpack->id }}"
                                                data-bs-target="#editUserModal{{ $dockpack->id }}"> <i
                                                    class="bi-gear me-1"></i>Settings</a>
                                            <!-- Button to trigger the modal -->
                                            <button type="button" class="btn btn-danger btn-sm ms-1"
                                                data-bs-toggle="modal"
                                                data-bs-target="#exampleModalCenterdelete{{ $dockpack->id }}">
                                                <i class="bi-trash me-1"></i> Delete
                                            </button>

                                            <!-- Modal -->
                                            <div id="exampleModalCenterdelete{{ $dockpack->id }}" class="modal fade"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                                    <div class="modal-content text-center">
                                                        <div class="modal-body">
                                                            <p class="text-dark">Do you really want to delete this record?
                                                                This process cannot be undone.</p>
                                                            <button type="button" class="btn btn-soft-dark mx-4"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <!-- Form to handle the delete action -->
                                                            <form method="POST"
                                                                action="{{ route('dockpack.destroy', $dockpack->id) }}"
                                                                style="display:inline">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="btn btn-soft-danger">Yes,
                                                                    Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal -->

                                            {{-- <form method="POST" action="{{ route('dockpack.destroy', $dockpack->id) }}"
                                                style="display:inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm ms-1">
                                                    <i class="bi-trash me-1"></i> Delete
                                                </button>
                                            </form> --}}
                                        </span>

                                        {{-- model start --}}

                                        <div class="modal fade" id="editUserModal{{ $dockpack->id }}" tabindex="-1"
                                            aria-labelledby="editUserModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="card-title">{{ $dockpack->name }}</h4>
                                                        {{-- <span class="badge bg-danger rounded-pill ms-1">Under Development</span> --}}
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="modal-content">

                                                            <form method="POST"
                                                                action="{{ route('dockpack.update', ['dockpack' => $dockpack->id]) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <!-- Form -->
                                                                <div class="row mb-4">
                                                                    <label for="DocksNameLabel"
                                                                        class="col-sm-2 col-form-label form-label">
                                                                        Name</label>

                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control"
                                                                            name="name" id="DocksNameLabel"
                                                                            placeholder="Dock pack's Name"
                                                                            value="{{ $dockpack->name }}"
                                                                            aria-label="Dock's Name">

                                                                    </div>
                                                                </div>


                                                                <div class="row mb-4">
                                                                    <label for="DescriptionLabel"
                                                                        class="col-sm-2 col-form-label form-label">Description</label>

                                                                    <div class="col-sm-9">
                                                                        <textarea class="form-control" name="description" placeholder="Description">{{ old('description', $dockpack->description) }}</textarea>
                                                                        {{-- <textarea name="description" id="description">{{ old('description', $dock->description) }}</textarea> --}}
                                                                    </div>
                                                                </div>
                                                                {{-- </form> --}}
                                                                <span class="divider-center">My Dock Settings</span>

                                                                {{-- Dock select table start --}}

                                                                {{-- <div class="modal-body"> --}}
                                                                {{-- <div class="container"> --}}


                                                                <div class="row">
                                                                    <div class="col-md-9">
                                                                        <h5 class="mb-4 mt-3">Docks</h5>
                                                                        <div class="form-group mb-4">
                                                                            <div class="col-sm-12`">
                                                                                <div class="card">


                                                                                    <!-- Table -->
                                                                                    <div
                                                                                        class="table-responsive datatable-custom">


                                                                                        <div
                                                                                            id="dockpacksett_container{{ $dockpack->id }}">
                                                                                        </div>


                                                                                    </div>
                                                                                    <!-- End Table -->


                                                                                    {{-- <button id="load-data-btn">Load Data</button> --}}

                                                                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                                                                                    <script>
                                                                                        $(document).ready(function() {
                                                                                            // Load the data initially
                                                                                            $.ajax({
                                                                                                url: '{{ route('dockpacksett_container', ['id' => $dockpack->id]) }}',
                                                                                                method: 'GET',
                                                                                                success: function(data) {
                                                                                                    $('#dockpacksett_container{{ $dockpack->id }}').html(data);
                                                                                                }
                                                                                            });


                                                                                        });
                                                                                    </script>
                                                                                </div>

                                                                            </div>

                                                                            <!-- End Switch -->
                                                                        </div>




                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <h5 class="mb-4 mt-3">Available Dock</h5>


                                                                        {{-- available dock table start --}}
                                                                        <div class="col-sm-12">
                                                                            <!-- List Group -->

                                                                            <div class="form-group">
                                                                                
                                                                                <div
                                                                                    id="available_docksett{{ $dockpack->id }}">
                                                                                </div>


                                                                                <script>
                                                                                    $(document).ready(function() {
                                                                                        // Load the data initially
                                                                                        $.ajax({
                                                                                            url: '{{ route('available_docksett', ['id' => $dockpack->id]) }}',
                                                                                            method: 'GET',
                                                                                            success: function(data) {
                                                                                                $('#available_docksett{{ $dockpack->id }}').html(data);
                                                                                            }
                                                                                        });


                                                                                    });
                                                                                </script>


                                                                            </div>
                                                                            <!-- End List Group -->
                                                                            {{-- <div class="col-sm mb-2 mb-sm-0 mt-2">
                                                                                <div class="d-grid">
                                                                                    <button class="btn btn-info mx-2" id="Add-button1"
                                                                                        data-dashlane-rid="1d9bdab14eeddf61"><i
                                                                                            class="bi bi-box-arrow-in-left"></i> &nbsp;Add</button>
                                                                                </div>
                                                                            </div> --}}


                                                                            {{-- <div class="col-sm mb-2 mb-sm-0 mt-2">
                                                                            <div class="d-grid">
                                                                                <button class="btn btn-warning mx-2" id="Remove-button"
                                                                                    data-dashlane-rid="d64f21caaacee0d1"> <i
                                                                                        class="bi bi-box-arrow-right"></i>&nbsp;&nbsp;Remove</button>
                                                                            </div>
                                                                        </div> --}}



                                                                        </div>

                                                                        {{-- available dock table start --}}



                                                                    </div>

                                                                </div>

                                                                {{-- </div>  container div close --}}
                                                                {{-- </div> modal bidy div close --}}





                                                                {{-- button start --}}
                                                                <div class="row mt-3">
                                                                    <div class="row mb-4 gx-3 " style="font-weight: 300">

                                                                        <div class="col-sm mb-2 mb-sm-0">
                                                                            <div class="d-grid">
                                                                                <button class="btn btn-success mx-2"
                                                                                    type="submit><i class="bi
                                                                                    bi-check2-square"></i>
                                                                                    &nbsp; Save</button>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                {{-- button end --}}
                                                            </form>
                                                        </div>
                                                        {{-- Dock select table end --}}


                                                        <!-- End Form -->


                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        {{-- model end --}}




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
    <div class="modal fade" id="createdockpack" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="card-title">Register New Dock Pack</h4><span
                        class="badge bg-danger rounded-pill ms-1">Under Development</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->

                <!-- End Body -->

                {{-- New register modal start --}}

                <div class="modal-body">
                    <div class="modal-content">

                        <form method="POST" action="{{ route('dockpack.store') }}">
                            @csrf
                            <!-- Form -->
                            <div class="row mb-4">
                                <label for="DocksNameLabel" class="col-sm-2 col-form-label form-label"> Name</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" id="DocksNameLabel"
                                        placeholder="Dock pack's Name" aria-label="Dock's Name">

                                </div>
                            </div>


                            <div class="row mb-4">
                                <label for="DescriptionLabel"
                                    class="col-sm-2 col-form-label form-label">Description</label>

                                <div class="col-sm-9">
                                    <textarea class="form-control" name="description" placeholder="Description"></textarea>
                                    {{-- <textarea name="description" id="description">{{ old('description', $dock->description) }}</textarea> --}}
                                </div>
                            </div>
                            {{-- </form> --}}
                            <span class="divider-center">My Dock Settings</span>

                            {{-- Dock select table start --}}

                            {{-- <div class="modal-body"> --}}
                            {{-- <div class="container"> --}}


                            <div class="row">
                                <div class="col-md-9">
                                    <h5 class="mb-4 mt-3">Docks</h5>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12`">
                                            <div class="card">


                                                <!-- Table -->
                                                <div class="table-responsive datatable-custom">


                                                    <div id="table-container"></div>


                                                </div>
                                                <!-- End Table -->


                                                {{-- <button id="load-data-btn">Load Data</button> --}}

                                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                                                <script>
                                                    $(document).ready(function() {
                                                        // Load the data initially
                                                        $.ajax({
                                                            url: '{{ route('get-data') }}',
                                                            method: 'GET',
                                                            success: function(data) {
                                                                $('#table-container').html(data);
                                                            }
                                                        });


                                                    });
                                                </script>
                                            </div>

                                        </div>

                                        <!-- End Switch -->
                                    </div>




                                </div>
                                <div class="col-md-3">
                                    <h5 class="mb-4 mt-3">Available Dock</h5>


                                    {{-- available dock table start --}}
                                    <div class="col-sm-12">
                                        <!-- List Group -->

                                        <div class="form-group">
                                            <div id="available_docks"></div>


                                            <script>
                                                $(document).ready(function() {
                                                    // Load the data initially
                                                    $.ajax({
                                                        url: '{{ route('available_docks') }}',
                                                        method: 'GET',
                                                        success: function(data) {
                                                            $('#available_docks').html(data);
                                                        }
                                                    });


                                                });
                                            </script>


                                        </div>
                                        <!-- End List Group -->
                                        {{-- <div class="col-sm mb-2 mb-sm-0 mt-2">
                                            <div class="d-grid">
                                                <button class="btn btn-info mx-2" id="Add-button1"
                                                    data-dashlane-rid="1d9bdab14eeddf61"><i
                                                        class="bi bi-box-arrow-in-left"></i> &nbsp;Add</button>
                                            </div>
                                        </div> --}}


                                        {{-- <div class="col-sm mb-2 mb-sm-0 mt-2">
                                        <div class="d-grid">
                                            <button class="btn btn-warning mx-2" id="Remove-button"
                                                data-dashlane-rid="d64f21caaacee0d1"> <i
                                                    class="bi bi-box-arrow-right"></i>&nbsp;&nbsp;Remove</button>
                                        </div>
                                    </div> --}}



                                    </div>

                                    {{-- available dock table start --}}



                                </div>

                            </div>

                            {{-- </div>  container div close --}}
                            {{-- </div> modal bidy div close --}}





                            {{-- button start --}}
                            <div class="row mt-3">
                                <div class="row mb-4 gx-3 " style="font-weight: 300">

                                    <div class="col-sm mb-2 mb-sm-0">
                                        <div class="d-grid">
                                            <button class="btn btn-success mx-2" type="submit><i class="bi
                                                bi-check2-square"></i>
                                                &nbsp; Save</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{-- button end --}}
                        </form>
                    </div>
                    {{-- Dock select table end --}}


                    <!-- End Form -->


                </div>

            </div>
            {{-- New register modal end --}}



        </div>
    </div>
    </div>
@endsection
