@extends('layouts.app1')


@section('content')
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
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Users</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Overview</li>
                            </ol>
                        </nav>

                        <h1 class="page-header-title">Users</h1>
                    </div>
                    
                    <div class="col-sm-auto">
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal" href="#">
                            <i class="bi-person-plus-fill me-1"></i> Create user
                        </a>
                    </div>
                   
                </div>
                <!-- End Row -->
            
            </div> --}}
            <!-- End Page Header -->

            <!-- Stats -->
            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Total users</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span class="js-counter display-4 text-dark">
                                        @foreach ($data as $key => $user)
                                            @if ($loop->last)
                                                {{ $key + 1 }}
                                            @endif
                                        @endforeach
                                    </span>
                                    <span class="text-body fs-5 ms-1">from {{ $totalUsers }}</span>
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
                            <h6 class="card-subtitle mb-2">Active members</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span
                                        class="js-counter display-4 text-dark">{{ count($data->where('email_verified_at', '!=', null)) }}</span>
                                    <span class="text-body fs-5 ms-1">from {{ $totalUsers }}</span>
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
{{-- error --}}
                @if (count($errors) > 0)
                <div class="alert alert-soft-danger ">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            </div>
            <!-- End Stats -->

            <!-- Card -->
            <div class="card">
                <!-- Header -->
                <div class="card-header  d-flex justify-content-between align-items-center">
                    <!-- Nav -->
<ul class="nav">
    <li class="nav-item">
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
                                        <h5 class="card-header-title">Users Per Page</h5>

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

                        <!-- button strat -->

                        <div class="col-sm-auto">
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal2" href="#">
                                <i class="bi-person-plus-fill me-1"></i> Invite user
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
                            <tr>
                                <th class="table-column-pe-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="datatableCheckAll">
                                        <label class="form-check-label" for="datatableCheckAll"></label>
                                    </div>
                                </th>
                                <th class="table-column-ps-0">Name</th>
                                <th>Account Name</th>
                                {{-- <th>State</th> --}}
                                <th>Status</th>
                                {{-- <th>Portfolio</th> --}}
                                <th>Created</th>
                                <th> Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $key => $user)
                                <tr>
                                    <td class="table-column-pe-0">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="datatableCheckAll1">
                                            <label class="form-check-label" for="datatableCheckAll1"></label>
                                        </div>
                                    </td>
                                    <td class="table-column-ps-0"  >
                                        <a class="d-flex align-items-center" data-bs-toggle="modal"
                                            data-id="{{ $user->id }}"
                                            data-bs-target="#editUserModal{{ $user->id }}">

                                            {{-- <div class="avatar avatar-circle">
                                            <img class="avatar-img" src="{{ $user->profile_picture }}" alt="Image Description">
                                            </div> --}}
                                            <div class="ms-3">
                                                <span class="d-block h5 text-inherit mb-0">{{ $user->name }}<span
                                                        class="badge bg-info rounded-pill ms-1">{{ implode(',', $user->roles->pluck('name')->toArray()) }}</span>
                                                    {{-- <i class="bi-patch-check-fill text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Top endorsed"></i> --}}
                                                </span>
                                                <span class="d-block fs-5 text-body">{{ $user->email }}</span>
                                            </div>
                                        </a>
                                    </td>
                                    <td data-label="Account Name">
                                        {{-- {{ $user->company ?? 'Not Yet Set' }} --}}
                                        @if ($user->company)
                                            {{ \App\Models\Account::find($user->company)->account_name ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    {{-- <td>{{ $user->state ?? 'Not Yet Set' }}</td> --}}
                                    <td  data-label="Status">
                                        <span
                                            class="legend-indicator {{ $user->email_verified_at ? 'bg-success' : 'bg-danger' }}"></span>{{ $user->email_verified_at ? 'Active' : 'Inactive' }}
                                    </td>

                                    <td  data-label="Created">{{ $user->created_at }}</td>
                                    <td  data-label="Actions">
                                        {{-- <button type="button" class="btn btn-white btn-sm" href="{{ route('users.edit',$user->id) }}" data-bs-toggle="modal" data-bs-target="#editUserModal">
                    <i class="bi-pencil-fill me-1"></i> Edit
                  </button> --}}
                                        <a class="btn btn-white btn-sm" id="btn-edit" data-bs-toggle="modal"
                                            data-id="{{ $user->id }}"
                                            data-bs-target="#editUserModal{{ $user->id }}"> <i
                                                class="bi-pencil-fill me-1"></i>Edit</a>
                                        {{-- model start --}}
                                        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
                                            aria-labelledby="editUserModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">

                                                    <!-- Body -->
                                                    <div class="modal-body">
                                                        @if (count($errors) > 0)
                                                            <div class="alert alert-soft-danger">
                                                                <strong>Whoops!</strong> There were some problems with your
                                                                input.<br><br>
                                                                <ul>
                                                                    @foreach ($errors->all() as $error)
                                                                        <li>{{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif
                                                        <form method="POST"
                                                            action="{{ route('useradmin.update', $user->id) }}">
                                                            @method('PATCH')
                                                            @csrf
                                                            <div class="container">
                                                                <div class="row mb-3">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="name" class="col-form-label form-label">Name</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">    
                                                                            <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $user->name }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            
                                                                <div class="row mb-3">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="email" class="col-form-label form-label">Email</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <input type="text" name="email" placeholder="Email" class="form-control" value="{{ $user->email }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            
                                                                <div class="row mb-3">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="password" class="col-form-label form-label">Password</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <input type="password" name="password" placeholder="Password" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            
                                                                <div class="row mb-3">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="confirm-password" class="col-form-label form-label">Confirm Password</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <input type="password" name="confirm-password" placeholder="Confirm Password" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            
                                                                <div class="row mb-3">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="roles" class="col-form-label form-label">Role</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <select name="roles[]" class="form-control" multiple>
                                                                                <option value="">Remove Role</option>
                                                                                @foreach ($roles as $role)
                                                                                    <option value="{{ $role }}" {{ in_array($role, $userRole[$user->id]) ? 'selected' : '' }}>
                                                                                        {{ $role }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            
                                                                <div class="row">
                                                                    <div class="col-md-12 text-center">
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </div>
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

                                        <form method="POST" action="{{ route('useradmin.destroy', $user->id) }}"
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
                    {{-- {!! $data->render() !!} --}}
                </div>
                <!-- End Table -->

                <!-- Footer -->
                <div class="card-footer">
                    <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                        <div class="col-sm mb-2 mb-sm-0">
                            {!! $data->render() !!} </div>
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


                {{-- Invite User  --}}
                <div class="modal-dialog modal-dialog-centered">

                  </div>
                {{-- Invite User End  --}}
                <!-- Body -->
                <div class="modal-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-soft-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('useradmin.store') }}" class="js-step-form py-md-5">
                        @csrf

                        <div class="row justify-content-lg-center">
                            <div class="col-lg-8">
                                <!-- Step -->
                                <ul id="addUserStepFormProgress"
                                    class="js-step-progress step step-sm step-icon-sm step step-inline step-item-between mb-3 mb-md-5">


                                    <li class="step-item">
                                        <a class="step-content-wrapper" href="javascript:;"
                                            data-hs-step-form-next-options='{ "targetSelector": "#addUserStepBillingAddress" }'>
                                            {{-- <span class="step-icon step-icon-soft-dark">2</span> --}}
                                            <div class="step-content">
                                                <span class="step-title"> Or Create User</span>
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
                                        <div class="card-body">
                                            <!-- Form -->

                                            <!-- End Form -->

                                            <!-- Form -->
                                            <div class="row mb-4">
                                                <label for="firstNameLabel"
                                                    class="col-sm-3 col-form-label form-label">Full name * <i
                                                        class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Displayed on public forums, such as Front."></i></label>

                                                <div class="col-sm-9">
                                                    <div class="input-group input-group-sm-vertical">
                                                        <input type="text" class="form-control" name="name"
                                                            id="firstNameLabel" placeholder="Clarice"
                                                            aria-label="Clarice">
                                                        <input type="text" class="form-control" name="last_name"
                                                            id="lastNameLabel" placeholder="Boone" aria-label="Boone">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Form -->

                                            <div class="row mb-4">
                                                <label for="addressLine2Label"
                                                    class="col-sm-3 col-form-label form-label">NickName<span
                                                        class="form-label-secondary">(Optional)</span></label>

                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="nick_name"
                                                        id="nick_name" placeholder="Set Nickname" aria-label="Your City"
                                                        value="">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="addressLine2Label"
                                                    class="col-sm-3 col-form-label form-label">Password</label>

                                                <div class="col-sm-9">
                                                    <input type="password" name="password" placeholder="Password"
                                                        class="form-control">
                                                </div>
                                            </div>


                                            <!-- Form -->
                                            <div class="row mb-4">
                                                <label for="emailLabel" class="col-sm-3 col-form-label form-label">Email
                                                    *</label>

                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control" name="email"
                                                        id="emailLabel" placeholder="clarice@site.com"
                                                        aria-label="clarice@site.com">
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="company" id="company"
                                                value="{{ auth()->user()->company }}" placeholder="Htmlstream"
                                                aria-label="Htmlstream" hidden>



                                            <!-- Form -->
                                            <div class="row mb-4">
                                                <label for="addressLine1Label"
                                                    class="col-sm-3 col-form-label form-label">Address
                                                </label>

                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="address"
                                                        id="address" placeholder="Your address"
                                                        aria-label="Your address" value="">
                                                </div>
                                            </div>
                                            <!-- End Form -->

                                            <!-- Form -->
                                            <div class="row mb-4">
                                                <label for="addressLine2Label"
                                                    class="col-sm-3 col-form-label form-label">City
                                                </label>

                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="city"
                                                        id="city" placeholder="Your City" aria-label="Your City"
                                                        value="">
                                                </div>
                                            </div>
                                            <!-- End Form -->
                                            <!-- Form -->
                                            <div class="row mb-4">
                                                <label for="addressLine2Label"
                                                    class="col-sm-3 col-form-label form-label">State
                                                </label>

                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="state"
                                                        id="state" placeholder="Your address" aria-label="Your State"
                                                        value="">
                                                </div>
                                            </div>
                                            <!-- End Form -->

                                            <!-- Form -->
                                            <div class="row mb-4">
                                                <label for="zipCodeLabel" class="col-sm-3 col-form-label form-label">Zip
                                                    code <i class="bi-question-circle text-body ms-1"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="You can find your code in a postal address."></i></label>

                                                <div class="col-sm-9">
                                                    <input type="number" class="js-input-mask form-control"
                                                        name="zip" id="zip" placeholder="Your zip code"
                                                        aria-label="Your zip code" value=""
                                                        data-hs-mask-options='{  "mask": "AA0 0AA" }'>
                                                </div>
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
                                                Add User <i class="bi-chevron-right"></i>
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
    <!-- Invite user -->
    <div class="modal fade" id="editUserModal2" tabindex="-1" aria-labelledby="editUserModal2Label" aria-hidden="true">

                {{-- Invite User  --}}
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="inviteUserModalLabel">Invite users</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <!-- Body -->
                      <div class="modal-body">
                        <!-- Form -->
                        @if(session('success'))
                        <div class="alert alert-soft-success">
                            {{ session('success') }}
                        </div>
                    @endif
                        @if ($errors->any())
                        <div class="alert alert-soft-danger">
                           
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            
                        </div>
                    @endif

                        <form method="POST" action="{{ route('invite.create') }}">
                            @csrf
                        <div class="mb-4">
                          <div class="input-group mb-2 mb-sm-0">
                            <input type="email" name="email" class="form-control"  placeholder="Enter email" aria-label="Search name or emails">
                            <input type="text" name="company" value="{{Auth()->user()->company}}" hidden>
                            <div class="input-group-append input-group-append-last-sm-down-none">


                              {{-- <a class="btn btn-primary d-none d-sm-inline-block" href="javascript:;">Invite</a> --}}
                              <button type="submit" class="btn btn-primary d-none d-sm-inline-block">Send Invitation</button>
                            </div>
                          </div>

                          {{-- <a type="submit" class="btn btn-primary w-100 d-sm-none" >Invite</a> --}}

                        </div>
                        <!-- End Form -->
                    </form>


                        <hr class="mt-2">


                      </div>
                      <!-- End Body -->


                    </div>
                  </div>
                {{-- Invite User End  --}}

    </div>
    <!-- Edit user -->



@endsection
