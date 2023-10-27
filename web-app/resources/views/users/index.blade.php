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
                            <h6 class="card-subtitle mb-2">Total users</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span class="js-counter display-4 text-dark">@foreach ($data as $key => $user)   @if ($loop->last)
                                        {{ $key + 1 }}
                                      @endif @endforeach</span>
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
                                <i class="bi-filter me-1"></i> Filter <span
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

                        <!-- button strats-->
                        <div class="col-sm-auto">
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal"
                                href="{{ route('add') }}">
                                <i class="bi-person-plus-fill me-1"></i> Add user
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
                                <th class="table-column-pe-0">Name</th>
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
                                    {{-- <td class="table-column-pe-0">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="datatableCheckAll1">
                                            <label class="form-check-label" for="datatableCheckAll1"></label>
                                        </div>
                                    </td> --}}
                                    <td class="table-column-p-0" data-label="Name">
                                        <a class="d-block align-items-center" data-bs-toggle="modal"
                                            data-id="{{ $user->id }}"
                                            data-bs-target="#editUserModal{{ $user->id }}">

                                            {{-- <div class="avatar avatar-circle">
                      <img class="avatar-img" src="{{ $user->profile_picture }}" alt="Image Description">
                    </div> --}}
                                            <div class="ms-3">
                                                <span
                                                    class="d-block h5 text-inherit mb-0">{{ $user->name }}<span class="badge bg-info rounded-pill ms-1">{{ implode(',', $user->roles->pluck('name')->toArray()) }}</span>
                                                    {{-- <i class="bi-patch-check-fill text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Top endorsed"></i> --}}
                                                </span>
                                                <span class="d-block fs-5 text-body">{{ $user->email }}</span>
                                                <a href="{{ route('user_activity.show', $user->id) }}"><span class="badge bg-success rounded-pill ms-1">more</span></a>
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
                                    <td data-label="Status">
                                        <span
                                            class="legend-indicator {{ $user->email_verified_at ? 'bg-success' : 'bg-danger' }}"></span>{{ $user->email_verified_at ? 'Active' : 'Inactive' }}
                                    </td>

                                    <td data-label="Created">{{ $user->created_at }}</td>
                                    <td data-label="Actions">
                                        {{-- <button type="button" class="btn btn-white btn-sm" href="{{ route('users.edit',$user->id) }}" data-bs-toggle="modal" data-bs-target="#editUserModal">
                    <i class="bi-pencil-fill me-1"></i> Edit
                  </button> --}}
                                         <div>
                                                <a class="btn btn-white btn-sm" id="btn-edit" data-bs-toggle="modal"
                                                    data-id="{{ $user->id }}"
                                                    data-bs-target="#editUserModal{{ $user->id }}"> <i
                                                        class="bi-pencil-fill me-1"></i>Edit</a>
                                                {{-- model start --}}
                                        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
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
                                                        <form method="POST" action="{{ route('users.update', $user->id) }}">
                                                            @method('PATCH')
                                                            @csrf
                                                            <div class="row mb-3">
                                                                <div class="col-sm-3">
                                                                    <div class="form-group">
                                                                        <label for="name" class="col-form-label">Name</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <div class="form-group">
                                                                        <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $user->name }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="row mb-3">
                                                                <div class="col-sm-3">
                                                                    <div class="form-group">
                                                                        <label for="email" class="col-form-label">Email</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <div class="form-group">
                                                                        <input type="text" name="email" placeholder="Email" class="form-control" value="{{ $user->email }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="row mb-3">
                                                                <div class="col-sm-3">
                                                                    <div class="form-group">
                                                                        <label for="password" class="col-form-label">Password</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <div class="form-group">
                                                                        <input type="password" name="password" placeholder="Password" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="row mb-3">
                                                                <div class="col-sm-3">
                                                                    <div class="form-group">
                                                                        <label for="confirm-password" class="col-form-label">Confirm Password</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <div class="form-group">
                                                                        <input type="password" name="confirm-password" placeholder="Confirm Password" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="row mb-3">
                                                                <div class="col-sm-3">
                                                                    <div class="form-group">
                                                                        <label for="company" class="col-form-label">Account</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <div class="form-group">
                                                                        <select name="company" class="form-control">
                                                                            <option value="">Select an Account</option>
                                                                            @foreach ($accounts as $account)
                                                                                <option value="{{ $account->id }}" {{ $account->id == $user->company ? 'selected' : '' }}>
                                                                                    {{ $account->account_name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="row mb-3">
                                                                <div class="col-sm-3">
                                                                    <div class="form-group">
                                                                        <label for="roles" class="col-form-label">Role</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <div class="form-group">
                                                                        <select name="roles[]" class="form-control" multiple>
                                                                            <option value="">Remove All Roles</option>
                                                                            @foreach ($roles as $role)
                                                                                <option value="{{ $role }}" {{ in_array($role, $userRole[$user->id]) ? 'selected' : '' }}>
                                                                                    {{ $role }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="row mb-3">
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
<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalCenterdelete{{$user->id}}">
    <i class="bi-trash me-1"></i> Delete
</button>

<!-- Modal -->
<div id="exampleModalCenterdelete{{$user->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content text-center">
            <div class="modal-body">
                <p class="text-dark">Do you really want to delete this record?<br> This process cannot be undone.</p>
                <button type="button" class="btn btn-soft-dark mx-4" data-bs-dismiss="modal">Cancel</button>
                <!-- Form to handle the delete action -->
                <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
                    @method('DELETE')
                    @csrf
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
                    <form method="POST" action="{{ route('users.store') }}" class="js-step-form py-md-5">
                        @csrf

                        <div class="row ">
                            <div class="col-lg-12">
                                <!-- Step -->
                                <ul id="addUserStepFormProgress"
                                    class="js-step-progress step step-sm step-icon-sm step step-inline step-item-between mb-3 mb-md-5">


                                    <li class="step-item">
                                        <a class="step-content-wrapper" href=""
                                            data-hs-step-form-next-options='{
                    "targetSelector": "#addUserStepBillingAddress"
                  }'>
                                            {{-- <span class="step-icon step-icon-soft-dark">2</span> --}}
                                            <div class="step-content">
                                                <span class="step-title">Create User</span>
                                            </div>
                                        </a>
                                    </li>


                                </ul>
                                <!-- End Step -->

                                <!-- Content Step Form -->
                                <div id="addUserStepFormContent">
                                    <!-- Card -->
                                    <div id="addUserStepProfile" class="    ">
                                        <!-- Body -->
                                        <div class="">
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
                                            {{-- <div class="row mb-4">
                    <label for="addressLine2Label"
                        class="col-sm-3 col-form-label form-label">Role</label>

                    <div class="col-sm-9">
                        <select class="form-control" name="roles[]" multiple>
                            @foreach ($roles as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                          @endforeach
                          </select>
                    </div>
                </div> --}}

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
                                            <!-- End Form -->

                                            <!-- Form -->
                                            {{-- <div class="js-add-field row mb-4" data-hs-add-field-options='{
                          "template": "#addPhoneFieldTemplate",
                          "container": "#addPhoneFieldContainer",
                          "defaultCreated": 0
                        }'>
                    <label for="phoneLabel" class="col-sm-3 col-form-label form-label">Phone <span class="form-label-secondary">(Optional)</span></label>

                    <div class="col-sm-9">
                      <div class="input-group input-group-sm-vertical">
                        <input type="text" class="js-input-mask form-control" name="phone" id="phoneLabel" placeholder="+x(xxx)xxx-xx-xx" aria-label="+x(xxx)xxx-xx-xx" data-hs-mask-options='{
                                 "mask": "+0(000)000-00-00"
                               }'>

                        <!-- Select -->
                        <div class="tom-select-custom tom-select-custom-end">
                          <select class="js-select form-select" autocomplete="off" data-hs-tom-select-options='{
                                    "searchInDropdown": false,
                                    "hideSearch": true,
                                    "dropdownWidth": "8rem"
                                  }'>
                            <option value="Mobile" selected>Mobile</option>
                            <option value="Home">Home</option>
                            <option value="Work">Work</option>
                            <option value="Fax">Fax</option>
                            <option value="Direct">Direct</option>
                          </select>
                        </div>
                        <!-- End Select -->
                      </div>

                      <!-- Container For Input Field -->
                      <div id="addPhoneFieldContainer"></div>

                      <a class="js-create-field form-link" href="javascript:;">
                        <i class="bi-plus"></i> Add phone
                      </a>
                    </div>
                  </div> --}}
                                            <!-- End Form -->

                                            <!-- Add Phone Input Field -->
                                            {{-- <div id="addAddressFieldTemplate" style="display: none;">
                    <div class="input-group-add-field">
                      <input type="text" class="form-control" data-name="addressLine" placeholder="Your address" aria-label="Your address">

                      <a class="js-delete-field input-group-add-field-delete" href="javascript:;">
                        <i class="bi-x-lg"></i>
                      </a>
                    </div>
                  </div> --}}
                                            <!-- End Add Phone Input Field -->

                                            <!-- Add Phone Input Field -->
                                            {{-- <div id="addPhoneFieldTemplate" class="input-group-add-field" style="display: none;">
                    <div class="input-group input-group-sm-vertical align-items-center">
                      <input type="text" class="js-input-mask form-control" data-name="additionlPhone" placeholder="+x(xxx)xxx-xx-xx" aria-label="+x(xxx)xxx-xx-xx" data-hs-mask-options='{
                               "mask": "+0(000)000-00-00"
                             }'>

                      <div class="input-group-append">
                        <!-- Select -->
                        <div class="tom-select-custom tom-select-custom-end">
                          <select class="js-select-dynamic form-select" autocomplete="off" data-name="phoneSelect" data-hs-tom-select-options='{
                                    "searchInDropdown": false,
                                    "hideSearch": true,
                                    "dropdownWidth": "8rem"
                                  }'>
                            <option value="Mobile" selected>Mobile</option>
                            <option value="Home">Home</option>
                            <option value="Work">Work</option>
                            <option value="Fax">Fax</option>
                            <option value="Direct">Direct</option>
                          </select>
                        </div>
                        <!-- End Select -->
                      </div>
                    </div>

                    <a class="js-delete-field input-group-add-field-delete" href="javascript:;">
                      <i class="bi-x-lg"></i>
                    </a>
                  </div> --}}
                                            <!-- End Add Phone Input Field -->

                                            <!-- Form -->
                                            <div class="row mb-4">
                                                <label for="organizationLabel"
                                                    class="col-sm-3 col-form-label form-label">Company
                                                    <span class="form-label-secondary">(Optional)</span></label>

                                                <div class="col-sm-9">

                                                                        <select name="company" class="form-control">
                                                                            <option value="">Select an Account</option>
                                                                            @foreach ($accounts as $account)
                                                                                <option value="{{ $account->id }}" {{ $account->account_name == $user->company ? 'selected' : '' }}>
                                                                                    {{ $account->account_name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                </div>
                                            </div>
                                            <!-- End Form -->

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
                                                        data-hs-mask-options='{
        "mask": "AA0 0AA"
        }'>
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



@endsection
