@extends('layouts.app1')


@section('content')

    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
           

            <!-- Stats -->
            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Total Roles</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span class="js-counter display-4 text-dark">@foreach ($roles as $key => $role)

                                        @if ($loop->last)
                                          {{ $key + 1 }}
                                        @endif
                                      @endforeach</span>
                                    <span class="text-body fs-5 ms-1">from {{ $totalRoles }}</span>
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




            </div>
            <!-- End Stats -->

            <!-- Card -->
            <div class="card">
                <!-- Header -->
                <div class="card-header d-flex justify-content-between align-items-center">
                    <!-- Nav -->
<ul class="nav">
    <li class="">
        <!-- filter -->
                        <!-- Dropdown -->
                        <div class="dropdown">
                            <button type="button" class="btn btn-white btn-sm w-100" id="usersFilterDropdown"
                                data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                <i class="bi-filter me-1"></i><span
                                    class="badge bg-soft-dark text-dark rounded-circle ms-1"></span>
                            </button>

                            <div class="dropdown-menu dropdown-menu-sm-end dropdown-card card-dropdown-filter-centered"
                                aria-labelledby="usersFilterDropdown" style="min-width: 22rem;">
                                <!-- Card -->
                                <div class="card">
                                    <div class="card-header card-header-content-between">
                                        <h5 class="card-header-title">Roles Per Page</h5>

                                        <!-- Toggle Button -->
                                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm ms-2">
                                            <i class="bi-x-lg"></i>
                                        </button>
                                        <!-- End Toggle Button -->
                                    </div>

                                    
                                </div>
                                <!-- End Card -->
                            </div>
                        </div>
                        <!-- End Dropdown -->
    </li>
    <li class="mx-3">
        <form>
            <!-- Search -->
            <div class="input-group input-group-merge input-group-flush">
                <div class="input-group-prepend input-group-text">
                    <i class="bi-search"></i>
                </div>
                <input id="datatableSearch" type="search" class="form-control" placeholder="Search users"
                    aria-label="Search users">
            </div>
            <!-- End Search -->
        </form>
    </li>
  
  </ul>
  <!-- End Nav -->
                   
                    <div class="d-grid d-sm-flex justify-content-md-end align-items-sm-center gap-2">
                        <!-- Datatable Info -->
                        {{-- <div id="datatableCounterInfo" style="display: none;">
                            <div class="d-flex align-items-center">
                                <span class="fs-5 me-3">
                                    <span id="datatableCounter">0</span>
                                    Selected
                                </span>
                                <a class="btn btn-outline-danger btn-sm" href="javascript:;">
                                    <i class="bi-trash"></i> Delete
                                </a>
                            </div>
                        </div> --}}
                        <!-- End Datatable Info -->

                        <!-- export -->

                        <!-- button strats -->
                        <div class="col-sm-auto">
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal"
                                href="{{ route('add') }}">
                                <i class="bi-people me-1"></i> Add role
                            </a>
                        </div>
                        <!-- End Col -->
                      
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
                                {{-- <th class="table-column-pe-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="datatableCheckAll">
                                        <label class="form-check-label" for="datatableCheckAll"></label>
                                    </div>
                                </th> --}}
                                <th class="table-column-ps-2">Name</th>
                                {{-- <th>Account Name</th> --}}
                                {{-- <th>State</th> --}}
                                {{-- <th>Status</th> --}}
                                {{-- <th>Portfolio</th> --}}
                                <th>Created</th>
                                <th> Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($roles as $key => $role)
                                <tr>
                                    {{-- <td class="table-column-pe-0" data-label="">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="datatableCheckAll1">
                                            <label class="form-check-label" for="datatableCheckAll1"></label>
                                        </div>
                                    </td> --}}
                                    <td class="table-column-pe-0" data-label="Name">
                                        <a class="align-items-center" data-bs-toggle="modal"
                                            data-id="{{ $role->id }}"
                                            data-bs-target="#editUserModal{{ $role->id }}">

                                            {{-- <div class="avatar avatar-circle">
                      <img class="avatar-img" src="{{ $user->profile_picture }}" alt="Image Description">
                    </div> --}}
                                            <div class="ms-3">
                                                <span class="d-block h5 text-inherit mb-0">{{ $role->name }}
                                                    {{-- <i class="bi-patch-check-fill text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Top endorsed"></i> --}}
                                                </span>
                                                <span class="d-block fs-5 text-body"></span>
                                            </div>
                                        </a>
                                    </td>


                                    <td data-label="Created">{{ $role->created_at }}</td>
                                    <td data-label="Actions">
                                        {{-- <button type="button" class="btn btn-white btn-sm" href="{{ route('users.edit',$user->id) }}" data-bs-toggle="modal" data-bs-target="#editUserModal">
                    <i class="bi-pencil-fill me-1"></i> Edit
                  </button> --}}
                                        <a class="btn btn-white btn-sm" id="btn-edit" data-bs-toggle="modal"
                                            data-id="{{ $role->id }}"
                                            data-bs-target="#editUserModal{{ $role->id }}"> <i
                                                class="bi-pencil-fill me-1"></i>Edit</a>
                                        {{-- model start --}}
                                        <div class="modal fade" id="editUserModal{{ $role->id }}" tabindex="-1"
                                            aria-labelledby="editUserModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered ">
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
                                                        <form method="POST" action="{{ route('roles.update', $role->id) }}">
                                                            @method('PATCH')
                                                            @csrf
                                                            <div class="row mb-2">
                                                                <div class="col-sm-3">
                                                                    <div class="form-group">
                                                                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <div class="form-group">
                                                                        <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $role->name }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="row mb-2">
                                                                <div class="col-sm-3">
                                                                    <div class="form-group">
                                                                        <label for="Permission" class="col-sm-3 col-form-label">Permission</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <div class="form-group">
                                                                        <br />
                                                                        @foreach ($permission as $value)
                                                                            <label>
                                                                                <input type="checkbox" name="permission[]" value="{{ $value->id }}" class="name" {{ in_array($value->id, $rolePermissions[$role->id]) ? 'checked' : '' }}>
                                                                                {{ $value->name }}
                                                                            </label>
                                                                            <br />
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="row mb-2">
                                                                <div class="col-sm-12 text-center">
                                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        
                                                        <!-- End Step Form -->
                                                    </div>
                                                    <!-- End Body -->
                                                </div>
                                            </div>
                                        </div>


                                        {{-- model end --}}

                                        <!-- Button to trigger the modal -->
<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalCenterdelete{{$role->id}}">
    <i class="bi-trash me-1"></i> Delete
</button>

<!-- Modal -->
<div id="exampleModalCenterdelete{{$role->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content text-center">
            <div class="modal-body">
                <p class="text-dark">Do you really want to delete this record? <br>This process cannot be undone.</p>
                <button type="button" class="btn btn-soft-dark mx-4" data-bs-dismiss="modal">Cancel</button>
                <!-- Form to handle the delete action -->
                <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display:inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-soft-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
                <!-- End Table -->

                <!-- Footer -->
                <div class="card-footer">
                    <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                        <div class="col-sm mb-2 mb-sm-0">
                            {!! $roles->render() !!} </div>
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
        <div class="modal-dialog modal-dialog-centered">
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
                    <form method="POST" action="{{ route('roles.store') }}" class="js-step-form py-md-5">
                        @csrf

                        <div class="row justify-content-lg-center">
                            <div class="col-lg-12">
                                <!-- Step -->
                                <ul id="addUserStepFormProgress"
                                    class="js-step-progress step step-sm step-icon-sm step step-inline step-item-between mb-3 mb-md-5">


                                    <li class="step-item">
                                        <a class="step-content-wrapper" href="javascript:;"
                                            data-hs-step-form-next-options='{
                    "targetSelector": "#addUserStepBillingAddress"
                  }'>
                                            {{-- <span class="step-icon step-icon-soft-dark">2</span> --}}
                                            <div class="step-content">
                                                <span class="step-title">Create Roles</span>
                                            </div>
                                        </a>
                                    </li>


                                </ul>
                                <!-- End Step -->

                                <!-- Content Step Form -->
                                <div id="addUserStepFormContent">
                                    <!-- Card -->
                                    <div id="addUserStepProfile" class="">
                                        <!-- Body -->
                                        <div class="card-body">
                                            <!-- Form -->

                                            <!-- End Form -->

                                            <!-- Form -->
                                            <div class="row mb-4">
                                                <label for="firstNameLabel"
                                                    class="col-sm-3 col-form-label form-label">Role Name <i
                                                        class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Create role name which is used to Assign User Later"></i></label>

                                                <div class="col-sm-9">
                                                    <div class="input-group input-group-sm-vertical">
                                                        <input type="text" class="form-control" name="name"
                                                            id="firstNameLabel" placeholder="Clarice"
                                                            aria-label="Clarice">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="form-group">
                                                    <strong>Permission:</strong>
                                                    <br />
                                                    @foreach ($permission as $value)
                                                        <label>
                                                            <input type="checkbox" name="permission[]"
                                                                value="{{ $value->id }}" class="name">
                                                            {{ $value->name }}
                                                        </label>
                                                        <br />
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!-- End Form -->


                                        </div>
                                        <!-- End Form -->
                                    </div>
                                    <!-- End Body -->

                                    <!-- Footer -->
                                    <div class="card-footer d-flex justify-content-end align-items-center">
                                        <button type="submit" class="btn btn-primary"
                                            data-hs-step-form-next-options='{
                            "targetSelector": "#addUserStepBillingAddress"
                          }'>
                                            Add Roles <i class="bi-chevron-right"></i>
                                        </button>
                                    </div>
                                    <!-- End Footer -->
                                </div>
                                <!-- End Card -->




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
                                            successfully
                                            created.</p>
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
                </form>
                <!-- End Step Form -->
            </div>
            <!-- End Body -->
        </div>
    </div>
    </div>
    <!-- Edit user -->



@endsection
