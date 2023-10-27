@extends('layouts.app1')
@section('content')


    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">

            @if (session('error'))
            <div class="position-fixed top-3 end-0 ms-n3 p-3" style="z-index: 1000;">
                <div class="alert alert-soft-danger alert-dismissible fade show" role="alert">
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
            </div>
            <script>
                setTimeout(function() {
                    $('.alert-soft-danger').fadeOut('slow');
                }, 10000); // 10 seconds
            </script>
            @endif
            
            @if (session('success'))
            <div class="position-fixed top-3 end-0 ms-n3 p-3" style="z-index: 1000;">
                <div class="alert alert-soft-success alert-dismissible fade show" role="alert">
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
            </div>
            <script>
                setTimeout(function() {
                    $('.alert-soft-success').fadeOut('slow');
                }, 10000); // 10 seconds
            </script>
            @endif
            
            
            <!-- Stats -->
            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Total Docks Register </h6>

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
                        <!-- Nav -->
                        <ul class="nav nav-lg">
                            {{-- <li class="nav-item">
                              
                                <div class="dropdown">
                                    <button type="button" class="btn btn-white btn-sm w-100" id="usersFilterDropdown"
                                        data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                        <i class="bi-filter me-1 icon-lg"></i><span
                                            class="badge bg-soft-dark text-dark rounded-circle ms-1"></span>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-sm-end dropdown-card card-dropdown-filter-centered"
                                        aria-labelledby="usersFilterDropdown" style="min-width: 22rem;">
                                       
                                        <div class="card">
                                            <div class="card-header card-header-content-between">
                                                <h5 class="card-header-title">Docks Per Page</h5>

                                             
                                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm ms-2">
                                                    <i class="bi-x-lg"></i>
                                                </button>
                                             
                                            </div>

                                            <div class="card-body">
                                                <form>


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
                                                           
                                                            <button class="btn btn-primary" type="submit">Filter</button>
                                                        </div>
                                                    </form>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                                
                            </li> --}}
                            <li class="nav-item mx-4">
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
                        <div class="col-sm-auto">
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createdock1"
                                href="#">
                                <i class="me-1">
                                    <img src="{{ asset('assets/img/front/dock.png') }}" alt="Icon"
                                        style="width: 22px; height: 22px;">
                                </i> Register New Boondock Echo
                            </a>
                        </div>

                        <!-- End Dropdown -->
                    </div>
                </div>
                <!-- End Header -->

                <!-- Table -->
                <div class="table-responsive datatable-custom position-relative ">
                    <table id="datatable"
                        class="table table-lg table-borderless table-thead-bordered table-align-middle card-table "
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
                                <th>License Type</th>
                                <th>Software<br> Version</th>
                                {{-- <th>Hardware</th> --}}
                                <th>Status</th>
                                <th>Address</th>
                                <th>Station</th>
                                {{-- <th>Portfolio</th> --}}
                                {{-- <th>all audio Received</th> --}}
                                <th>Audio Received</th>

                                <th> Actions</th>
                            </tr>
                        </thead>

                        <tbody class="text-dark">
                            {{-- @php
                               dd(auth()->id()); 
                            @endphp --}}
                            @foreach ($docks as $key => $dock)
                                @if ($dock->mac != auth()->id())
                                    <tr>

                                        <td data-label="Name">
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

                                        <td data-label="License type" class="h4">
                                              <!-- Button trigger modal -->

    <span class="badge bg-primary rounded-2 ms-1" data-bs-toggle="modal" data-bs-target="#exampleModalCenteredScrollableLicense{{ $dock->id}}">
        {{-- {{ $dock->license_code->code }} --}}
        @php
            $licenseType = $dock->license_code->license_type;
        @endphp
   
        @if ($licenseType === 1)
            Basic License
        @elseif ($licenseType === 2)
        Pro  License
        @elseif ($licenseType === 3)
       Advanced License
        @else
            Unknown License
        @endif
    </span>

  <!-- End  Button trigger modal -->
                                          
                                         
                                        </td>
                                    
  
 
                                        <td data-label="Software Version">
                                            <span class="d-block text-dark  text-inherit mb-0">
                                                {{ $dock->sw_version ?? 'Not Yet Set' }}</span>

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
                                            <span class="d-block text-dark  text-inherit mb-0">
                                                <span
                                                    class="legend-indicator {{ $dock->is_online == 1 ? 'bg-success' : 'bg-danger' }}"></span>{{ $dock->is_online == 1 ? 'Online' : 'Offline' }}</span>
                                        </td>
                                        {{-- <td>{{ $dock->state ?? 'Not Yet Set' }}</td> --}}
                                        <td data-label="State">
                                            <span class="d-block text-dark text-inherit mb-0">

                                                {{ $dock->city }}@if ($dock->state)
                                                    , {{ $dock->state }}
                                                @else
                                                    <span class="card-text">Not Found</span>
                                                @endif
                                            </span>
                                        </td>

                                        <td data-label="Stations">
                                            <span class="d-block text-dark text-inherit mb-0">
                                                @if (!empty($dock->station))
                                                    {{ $dock->station }}
                                                @else
                                                    <span class="card-text"> Station Not Found</span>
                                                @endif
                                                - {{ $dock->frequency }}


                                            </span>

                                            {{-- {{ !empty($dock->station) ? $dock->station : 'Station Not Found' }} -
                                            {{ $dock->frequency }} --}}
                                        </td>
                                        {{-- <td data-label="Received">
                                            {{ $totaldockaudio }}

                                        </td> --}}
                                        <td>
                                            <span class="text-dark"> {{ $dockAudioCounts[$dock->id] }}</span>
                                            <!-- Display audio count for this dock -->

                                        </td>
                                        <td data-label="Actions">
                                            {{-- <button type="button" class="btn btn-white btn-sm" href="{{ route('users.edit',$dock->id) }}" data-bs-toggle="modal" data-bs-target="#editUserModal">
                    <i class="bi-pencil-fill me-1"></i> Edit
                  </button> --}}
                                            {{-- <a class="btn btn-white btn-sm" id="{{ $dock->id }}" data-bs-toggle="modal"
                                            data-id="{{ $dock->id }}" data-bs-target=""> <i
                                                class="bi-sliders me-1"></i>Config</a> --}}
                                            <span class=" d-inline-flex">
                                                <a class="btn btn-white btn-sm text-dark    " id="set{{ $dock->id }}"
                                                    data-bs-toggle="modal" data-id="{{ $dock->id }}"
                                                    data-bs-target="#sett{{ $dock->id }}"> <i
                                                        class="bi-gear me-1"></i>Settings </a>


                                                {{-- <form method="POST" action="{{ route('mydocks.destroy', $dock->id) }}"
                                                style="display:inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm ms-2">
                                                    <i class="bi-trash me-1"></i> Delete
                                                </button>
                                            </form> --}}
                                                <!-- Button to trigger the modal -->
                                                <!-- Button to Trigger Modal -->
                                                <button type="button" class="btn btn-danger btn-sm ms-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalCenterdelete{{ $dock->id }}">
                                                    <i class="bi-trash me-1"></i> Delete All Audio
                                                </button>

                                                <!-- Modal for Deleting All Audio -->
                                                <div id="exampleModalCenterdelete{{ $dock->id }}" class="modal fade"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered " role="document">
                                                        <div class="modal-content text-center">
                                                            <div class="modal-body">
                                                                <p class="text-dark">Are you sure you want to delete all
                                                                    audio records received from <span
                                                                        class="text-danger">{{ $dock->name }}</span> ?
                                                                    This action cannot be undone.</p>
                                                                <button type="button" class="btn btn-soft-dark mx-4"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <!-- Form to handle the delete all action -->

                                                                <form method="POST"
                                                                    action="{{ route('mydocks.delete_alldockAudio', $dock->id) }}"
                                                                    style="display:inline">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-soft-danger">Yes, Delete
                                                                        All</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-danger btn-sm ms-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deletedock{{ $dock->id }}">
                                                    <i class="bi-trash me-1"></i> Delete Dock
                                                </button>

                                                <!-- Modal -->
                                                <div id="deletedock{{ $dock->id }}" class="modal fade"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered " role="document">
                                                        <div class="modal-content text-center">
                                                            <div class="modal-body">
                                                                <p class="text-dark">Do you really want to delete 
                                                                    <span class="text-danger">{{ $dock->name }}</span>
                                                                     This process cannot be undone.
                                                                </p>
                                                                <button type="button" class="btn btn-soft-dark mx-4"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <!-- Form to handle the delete action -->
                                                                <form method="POST"
                                                                    action="{{ route('mydocks.destroy', $dock->id) }}"
                                                                    style="display:inline">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-soft-danger">Yes, Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal -->


                                            </span>
                                        </td>
                                    </tr>
                                @endif
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
                                data-bs-target="#createdock1" href="#">
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

    <div class="modal fade" id="createdock" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
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
                            <div class="col-lg-12">
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
                                    <div id="addUserStepProfile" class=" card-lg active">
                                        {{-- card class has been removed from above div --}}
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
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label for="code" class="form-label mt-2">Code</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" name="code" class="form-control"
                                                            id="code-input">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-10">
                                                        <span class="text-danger" id="code-error"></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-10">
                                                        <span class="text-success" style="display: none"
                                                            id="code-success">Your Code is Valid</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-success mt-4"
                                                id="create-dock-btn">Validate</button>


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

                                    <div id="addUserStepBillingAddress" class="" style="display: none;">
                                        <!-- Body -->
                                        <div class="">
                                            <!-- Form -->

                                            <!-- End Form -->

                                            <!-- Form 1 -->
                                            <div id="success-message" class="d-none alert alert-success mt-4"></div>
                                            <div class="row mb-4">
                                                <div class="col-sm-3">
                                                    <label for="addressLine1Label" class="form-label">Name</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="name"
                                                        id="name" placeholder="Name Here" aria-label="name">
                                                </div>
                                            </div>
                                            <!-- End Form 1 -->

                                            <!-- Form 2 -->
                                            <div class="row mb-4">
                                                <div class="col-sm-3">
                                                    <label for="station" class="form-label">Station Name</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="station"
                                                        name="station">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-sm-3">
                                                    <label for="frequency" class="form-label">Frequency</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="float" class="form-control" id="frequency"
                                                        name="frequency">
                                                </div>
                                            </div>
                                            <!-- End Form 2 -->

                                            <!-- Form Check 1 -->
                                            <div class="row mb-4">
                                                <div class="col-sm-3">
                                                    <label for="rx_enabled" class="form-label">Receive Message</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="form-check form-check-inline">
                                                        <input type="checkbox" name="rx_enabled" value="0"
                                                            id="rx_enabled" class="form-check-input">
                                                        <label class="form-check-label" for="rx_enabled"
                                                            class="form-label">Yes</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Form Check 1 -->

                                            <!-- Form Check 2 -->
                                            <div class="row mb-4">
                                                <div class="col-sm-3">
                                                    <label for="formInlineCheck1" class="form-label">Transmit
                                                        Message</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="form-check form-check-inline">
                                                        <input type="checkbox" id="formInlineCheck1"
                                                            class="form-check-input">
                                                        <label class="form-check-label" for="formInlineCheck1"
                                                            class="form-label">Yes</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Form Check 2 -->

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

    {{-- Lisence update --}}
    <!-- Lisence update -->
    <div class="modal fade" id="createdock1" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
    
                <!-- Content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Register New Boondock Echo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="error-message" class="alert alert-danger mt-4 d-none"></div>
                        <div id="success-message" class="alert alert-success mt-4 d-none">Your License is Valid</div>
                        <form action="{{ route('mydocks.activation') }}" method="POST" id="activation-form">
                            @csrf
                            <div class="form-group">
                                <label for="code" class="form-label mt-2">Registration Code</label>
                                <input type="text" class="js-input-mask form-control" placeholder="XXXX-XXXX" name="code" class="form-control"  data-hs-mask-options='{
                                    "mask": "****-****"
                                  }'>
                              
                            </div>
                            <button type="submit" class="btn btn-success mt-4" id="license-activation">Validate</button>
                        </form>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
    





    {{-- new settings  --}}
    <!--  Modal mqtt -->
    @foreach ($docks as $key => $dock)
        <!--  Modal mqtt -->
        <div id="sett{{ $dock->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5> {{ $dock->name }} ({{ $dock->mac }})
                        </h5>


                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                        @php
                                            $matchingStation = null;
                                            
                                            foreach ($station as $stations) {
                                                if ($dock->station === $stations->station) {
                                                    $matchingStation = $stations;
                                                    break; // Stop the loop once a match is found
                                                }
                                            }
                                        @endphp
                                        <div class="tom-select-custom">
                                            <select id="station-select{{ $dock->id }}" class="js-select form-select"
                                                autocomplete="off"
                                                data-hs-tom-select-options='{
                                                        "placeholder": "Select Station..."
                                                        }'>
                                                @php
                                                    $hasStations = false;
                                                @endphp
                                                @foreach ($station as $stations)
                                                    @php
                                                        $hasStations = true;
                                                    @endphp
                                                    <option id="station-option-{{ $dock->id }}-{{ $loop->index }}"
                                                        data-station="{{ $stations->station }}"
                                                        data-frequency="{{ $stations->frequency }}"
                                                        data-description="{{ $stations->description }}"
                                                        {{ $dock->station === $stations->station ? 'selected' : '' }}>
                                                        {{ $stations->station }} - ({{ $stations->frequency }})
                                                        {{ $stations->description }}
                                                    </option>
                                                @endforeach
                                                @if (!$hasStations)
                                                    <option value="yes" selected>{{ $dock->station }} -
                                                        {{ $dock->frequency }}{{ $dock->description }}</option>
                                                @endif
                                                <option id="new-station-option{{ $dock->id }}" value="new-station"
                                                    data-bs-toggle="modal" data-bs-target="#add{{ $dock->id }}"
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
                                                        var description = selectedOption.data('description');
                                                        var optionId = selectedOption.attr('id');
                                                        var optionIndex = optionId.split('-')[
                                                            3]; // Extract the index from the option's id attribute

                                                        // Set the values in the modal fields
                                                        $('input[name="station"]').val(station);
                                                        $('input[name="frequency"]').val(frequency);

                                                        var optionValue = selectedOption.text();
                                                        // var description = optionValue.replace(/\(\d+\)\s*/, '').trim();
                                                        // var parts = description.split(' - ');
                                                        // if (parts.length > 1) {
                                                        //     description = parts[1].trim();
                                                        // }
                                                        $('input[name="description"]').val(description);
                                                    });



                                                    // Save changes when the Save button is clicked in the modal
                                                    $('#save-button{{ $dock->id }}').on('click', function() {
                                                        // Retrieve the values from the modal fields
                                                        var station = $('#station').val();
                                                        var frequency = $('input[name="frequency"]').val();
                                                        var description = $('input[name="description"]').val();
                                                        var category = $('input[name="category_id"]').val();
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
                                        <button id="add-btn{{ $dock->id }}" style="display: none" type="button"
                                            class="btn btn-primary" data-bs-toggle="modal" data-id=""
                                            data-bs-target="#add{{ $dock->id }}">ADD</button>
                                        <button id="remove-btn{{ $dock->id }}" style="display: none" type="button"
                                            class="btn btn-danger" data-bs-toggle="modal" data-id=""
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
                                            <input type="hidden" name="message" id="message1{{ $dock->id }}"
                                                value="0">

                                            <input type="range" class="me-2" name="slider"
                                                id="slider1{{ $dock->id }}" min="0" max="100"
                                                style="width: 50%" value="{{ $dock->setting_speaker_volume }}">

                                            <input type="hidden" name="topic" id="topic1{{ $dock->id }}"
                                                value="{{ $dock->mac }}/set/spkr_vol">
                                            <input id="slider-value1{{ $dock->id }}" class="border border-5"
                                                type="text" contenteditable="true" min="0" max="100"
                                                value="{{ $dock->setting_speaker_volume }}"
                                                style="border: 1px solid #ccc; padding: 1px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;"
                                                onchange="updateSliderValue{{ $dock->id }}()" maxlength="3">
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
                                                <input type="hidden" name="message" id="message12{{ $dock->id }}"
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
                                                <input type="hidden" name="topic" id="topicgain{{ $dock->id }}"
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
                                                id="recorderslider1{{ $dock->id }}" min="0" max="100"
                                                style="width: 50%" value="{{ $dock->line_in_min_db }}">

                                            <input type="hidden" name="topic" id="recordertopic1{{ $dock->id }}"
                                                value="{{ $dock->mac }}/set/line_min_db">
                                            <input id="recorderslider-value1{{ $dock->id }}" class="border border-5"
                                                contenteditable="true" value="{{ $dock->line_in_min_db }}"
                                                type="text"
                                                style="border: 1px solid #ccc; padding: 1px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;"
                                                onchange="updateSliderValue{{ $dock->id }}_1()" maxlength="3">

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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                    <div class="col">
                                        <label for="CallSignLabel" class="form-label ">Station/CallSign:</label>
                                        <!-- Select -->


                                        <div class="col-sm-9">
                                            <input type="text" class="form-control mb-2" name="station"
                                                {{-- id="station" --}} placeholder="callsign" aria-label="callsign"
                                                value="{{ old('station', $dock->station) }}">
                                            {{-- <button class="btn btn-secondary mx-2" id="save-button4286"><i
                                                            class="fa-solid fa-check"></i> &nbsp; Check </button> --}}
                                        </div>

                                    </div>


                                    <div class="col">

                                        <label for="FrequencyLabel" class="col form-label">Category</label>
                                        <!-- Dropdown -->
                                        <div class="tom-select-custom">
                                            <select name="category_id" {{-- id="category_id" --}}
                                                class="js-select form-select" autocomplete="off" data-form-type="other">
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
                                    <label for="Category" class="col-sm-3 col-form-label form-label">Frequency:</label>

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
                                                <label class="form-check-label" for="formInlineCheckReceived">Rx</label>

                                                <div class="form-check form-check-inline ms-5" style="margin-right: 50px">

                                                    <input type="hidden" name="tx_enabled" value="0">
                                                    <input type="checkbox" name="tx_enabled" value="1"
                                                        {{-- id="formInlineCheckTransmit" --}} class="form-check-input"
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
                                            {{-- id="description"  --}} placeholder="Description" aria-label="Description"
                                            value="{{ old('description', $dock->description) }}">
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
                                            <select name="category_id" {{-- id="category_id" --}}
                                                class="js-select form-select" autocomplete="off" data-form-type="other">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('category_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- frequency start --}}
                                <div class="row mb-3">
                                    <label for="Category" class="col-sm-3 col-form-label form-label">Frequency:</label>
                                    <div class="col">
                                        <div class="input-group input-group-sm-vertical">
                                            <input type="float" class="form-control" name="frequency"
                                                placeholder="Frequency" aria-label="" value="">
                                            <div class="form-check form-check-inline mx-2 mt-2">
                                                <input type="hidden" name="rx_enabled" value="0">
                                                <input type="checkbox" class="form-check-input" name="rx_enabled"
                                                    value="1">
                                                <label class="form-check-label" for="formInlineCheckReceived">Rx</label>
                                                <div class="form-check form-check-inline ms-5" style="margin-right: 50px">
                                                    <input type="hidden" name="tx_enabled" value="0">
                                                    <input type="checkbox" name="tx_enabled" value="1"
                                                        {{-- id="formInlineCheckTransmit" --}} class="form-check-input"
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
                                        <input type="text" class="form-control" id="description{{ $dock->id }}"
                                            name="description" placeholder="Description" aria-label="Description"
                                            value="">
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
                                            <label for="firstNameLabel" class="col-4 col-form-label form-label">Dock
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
                                                            <input type="number" class="form-control" name="lon"
                                                                id="dock_lon{{ $dock->id }}" placeholder="Longitude"
                                                                aria-label="Longitude"
                                                                value="{{ old('lon', $dock->lon) }}">
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="number" class="form-control" name="lat"
                                                                id="dock_lat{{ $dock->id }}"
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
                                    <label for="AddressLabel" class="col-sm-2 col-form-label form-label">Address</label>

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
                                                                    name="city" id="dock_city{{ $dock->id }}"
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
                                                                    name="zip" id="dock_zip{{ $dock->id }}"
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
                                            <input type="hidden" name="message" id="message111{{ $dock->id }}"
                                                value="{{ $dock->setting_speaker_volume }}">
                                            <input type="range" class="me-2" name="slider"
                                                id="slider111{{ $dock->id }}" min="0" max="100"
                                                value="{{ $dock->setting_speaker_volume }}">
                                            <input type="hidden" name="topic" id="topic111{{ $dock->id }}"
                                                value="{{ $dock->mac }}/set/spkr_vol">
                                            <input id="slider-value111{{ $dock->id }}" class="border border-5"
                                                type="text"
                                                style="border: 1px solid #ccc; padding: 2px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;"
                                                value="{{ $dock->setting_speaker_volume }}"
                                                onchange="updateSliderValue{{ $dock->id }}_2()" maxlength="3">
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
                                            <input type="hidden" name="message" id="message7{{ $dock->id }}"
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
                                                onchange="updateSliderValue{{ $dock->id }}_3()" maxlength="3">
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
                                            <input type="hidden" name="message" id="message17{{ $dock->id }}"
                                                value="{{ $dock->playback_vol }}">
                                            <input type="range" class="me-2" name="slider"
                                                id="slider17{{ $dock->id }}" min="0" max="100"
                                                value="{{ $dock->playback_vol }}">
                                            <input type="hidden" name="topic" id="topic17{{ $dock->id }}"
                                                value="{{ $dock->mac }}/set/playback_vol">
                                            <input type="text" id="slider-value17{{ $dock->id }}"
                                                class="border border-5" contenteditable="true"
                                                value="{{ $dock->playback_vol }}"
                                                style="border: 1px solid #ccc; padding: 2px; border-radius: 5px; display: inline-block; width: 50px; text-align: center;"
                                                onchange="updateSliderValue{{ $dock->mac }}_4()" maxlength="3">

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
                                        <input type="hidden" name="message" id="message3{{ $dock->id }}"
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
                                            onchange="updateSliderValue{{ $dock->id }}_5()" maxlength="3">

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
                                        <input type="hidden" name="message" id="message4{{ $dock->id }}"
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
                                            onchange="updateSliderValue{{ $dock->id }}_6()" maxlength="3">

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
                                        <input type="hidden" name="message" id="message5{{ $dock->id }}"
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
                                            onchange="updateSliderValue{{ $dock->id }}_7()" maxlength="3">

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
                                                id="{{ $dock->id }}start-recording-mic" data-bs-toggle="tooltip"
                                                aria-label="Start" data-bs-original-title="Start">
                                                <i class="bi bi-record-circle"></i>
                                            </a>
                                            <a class="btn btn-outline-success stop-recording-mic"
                                                id="{{ $dock->id }}stop-recording-mic" data-bs-toggle="tooltip"
                                                aria-label="Stop" data-bs-original-title="Stop">
                                                <i class="bi bi-stop-fill"></i>
                                            </a>
                                            <a class="btn btn-outline-success play-recording-mic"
                                                id="{{ $dock->id }}play-recording-mic" data-bs-toggle="tooltip"
                                                aria-label="Play" data-bs-original-title="Play">
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
                                                id="audio_auto_level{{ $dock->id }}"
                                                @if ($dock->auto_level == 1) checked @endif>
                                            <label class="form-check-label">On</label>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                // First Slider
                                                $('#audio_auto_level{{ $dock->id }}').on('change', function() {
                                                    var message = $(this).prop('checked') ? '1' : '0';
                                                    // var topic = '{{ $dock->mac }}/set/audiototext';
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
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '{{ route('mqtt.update', ['id' => $dock->id]) }}',
                                                        data: {
                                                            '_token': '{{ csrf_token() }}',
                                                            '_method': 'PUT',
                                                            'auto_level': message,

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
                                <div class="col-4">
                                    <div class="form-group">
                                        <!-- End Select -->
                                        <label class="label mb-2"><b> Noise Reduction </b></label>
                                        <div class="form-check form-switch form-switch-between mb-6">
                                            <label class="form-check-label">Off</label>
                                            <input type="checkbox" class="form-check-input"
                                                id="audio_noise_reduction{{ $dock->id }}"
                                                @if ($dock->noise_reduction == 1) checked @endif>
                                            <label class="form-check-label">On</label>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                // First Slider
                                                $('#audio_noise_reduction{{ $dock->id }}').on('change', function() {
                                                    var message = $(this).prop('checked') ? '1' : '0';
                                                    // var topic = '{{ $dock->mac }}/set/audiototext';
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
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '{{ route('mqtt.update', ['id' => $dock->id]) }}',
                                                        data: {
                                                            '_token': '{{ csrf_token() }}',
                                                            '_method': 'PUT',
                                                            'noise_reduction': message,

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
                            {{-- boondock ai end --}}

                            <div class="row ">

                                <div class="row mb-4 gx-3">

                                    <!-- End Col -->

                                    <div class="col-sm">
                                        <div class="d-grid">
                                            <button class="btn btn-info mx-2 " id="reboot-button{{ $dock->id }}">
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
        {{-- license modal detail strat --}}
 <!-- Modal -->
 @if (auth()->user()->hasRole('Super Admin'))
 @foreach ($docks as $key => $dock)
 @if ($dock->mac != auth()->id())
        <div id="exampleModalCenteredScrollableLicense{{ $dock->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredScrollableLicenseTitle" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenteredScrollableLicenseTitle">License Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                
                    <div class="row ">
                        <div class="col-lg-12">
                        <div class="d-grid gap-3 gap-lg-5">
                            <!-- Card -->
                            <div class="">
                            
                            <!-- Body -->
                            <div class="card-body">
                                <div class="row">
                                <div class="col-md mb-4 mb-md-0">
                            
                                    <div id="license-info" class="row my-1" style="{{ Auth::user()->license_status ? '' : 'display: none' }}">
                                        <div class="col-12 mb-3">
                                            <dl class="row text-uppercase">
                                                <dt class="col-sm-6 text-dark">Type</dt>
                                                <dd class="col-sm-6" id="type">
                                                    {{-- {{ Auth::user()->license_type }} --}}
                                                    <span class="badge bg-primary rounded-1" >
                                                        {{-- {{ $dock->license_code->code }} --}}
                                                        @php
                                                            $licenseType = $dock->license_code->license_type;
                                                        @endphp
                                                
                                                        @if ($licenseType === 1)
                                                            Basic License
                                                        @elseif ($licenseType === 2)
                                                        Pro  License
                                                        @elseif ($licenseType === 3)
                                                    Advanced License
                                                        @else
                                                            Unknown License
                                                        @endif
                                                    </span>
                                                </dd>
                                                {{-- <dt class="col-sm-6 text-dark">License Name</dt>
                                                <dd class="col-sm-6" id="licenseName">{{ Auth::user()->license_name }}</dd> --}}
                                                <dt class="col-sm-6 text-dark">License Code</dt>
                                                <dd class="col-sm-6" id="LicenseCode"> {{ $dock->license_code->code }}</dd>
                                                <dt class="col-sm-6 text-dark">Dock Name</dt>
                                                <dd class="col-sm-6" id="LicenseCode"> {{ $dock->name }}</dd>

                                                <dt class="col-sm-6 text-dark">Status</dt>
                                                <dd class="col-sm-6" id="status">{{ Auth::user()->license_status }}</dd>
                                    
                                                
                                                {{-- <dt class="col-sm-6 text-dark">Expiration</dt>
                                                <dd class="col-sm-6" id="expiration">{{ Auth::user()->license_expiration_date }}</dd>
                                                <dt class="col-sm-6"><span class="card-subtitle">Your plan (billed yearly):</span>
                                    <h3>March - April 2024</h3></dt>
                                                <dd class="col-sm-6" id="">                            <div class="d-grid d-sm-flex gap-3">
                                                    <a class="btn btn-white btn-sm" href="#">Cancel subscription</a>
                                                <a href="{{route( 'license.index', $dock->license_code->id)}}"> <button type="button" class="btn btn-primary w-100 w-sm-auto">Update plan</button></a>
                                                </div></dd> --}}
                                    
                                            
                                            </dl>
                                            <!-- End Row -->
                                        </div>
                                    </div>
                                
                                    {{-- license information details end --}}
                                    
                
                                    {{-- <div>
                                    <span class="card-subtitle">Total per year</span>
                                    <h1 class="text-primary">$264 USD</h1>
                                    </div> --}}
                                </div>
                                <!-- End Col -->
                
                                
                                <!-- End Col -->
                                </div>
                                <!-- End Row -->
                            </div>
                            <!-- End Body -->
                
                            {{-- <hr class="my-3"> --}}
                
                            
                            </div>
                            <!-- End Card -->
                
                        </div>
                        </div>
                        <!-- End Col -->
                    </div>
                </div>
            
            </div>
            </div>
        </div>
        @endif
        @endforeach
        @endif
  <!-- End Modal -->
  
{{-- license modal detail end --}}
        {{-- wifi settings start --}}
        <div id="wifi_set{{ $dock->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5> {{ $dock->name }} ({{ $dock->mac }})
                            <span class="badge bg-danger rounded-pill ms-1">Under Development</span>
                        </h5>


                        <button type="button" data-bs-toggle="modal" data-id="{{ $dock->id }}"
                            data-bs-target="#more_sett{{ $dock->id }}" class="btn btn-outline-dark">Back</button>
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
                                                <td data-label="WiFi SSID"><input class="form-control" type="text"
                                                        placeholder="SSID" id="ssid1{{ $dock->id }}"></td>
                                                <td data-label="Password"><input class="form-control" type="password"
                                                        placeholder="Password" id="password1{{ $dock->id }}"></td>
                                                <td data-label="Actions"><button class="btn btn-info"
                                                        id="update-button1{{ $dock->id }}">Update</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td data-label="No.">2</td>
                                                <td data-label="WiFi SSID"><input class="form-control" type="text"
                                                        placeholder="SSID" id="ssid2{{ $dock->id }}"></td>
                                                <td data-label="Password"><input class="form-control" type="password"
                                                        placeholder="Password" id="password2{{ $dock->id }}"></td>
                                                <td data-label="Actions"><button class="btn btn-info"
                                                        id="update-button2{{ $dock->id }}">Update</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td data-label="No.">3</td>
                                                <td data-label="WiFi SSID"><input class="form-control" type="text"
                                                        placeholder="SSID" id="ssid3{{ $dock->id }}"></td>
                                                <td data-label="Password"><input class="form-control" type="password"
                                                        placeholder="Password" id="password3{{ $dock->id }}"></td>
                                                <td data-label="Actions"><button class="btn btn-info"
                                                        id="update-button3{{ $dock->id }}">Update</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>


{{-- wifi settings end --}}



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


@endsection
