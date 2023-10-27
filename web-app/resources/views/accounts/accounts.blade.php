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
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Accounts</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Overview</li>
                            </ol>
                        </nav>

                        <h1 class="page-header-title">Accounts</h1>
                    </div>
                    <!-- End Col -->

                    <div class="col-sm-auto">
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal"
                            href="">
                            <i class="bi-person-plus-fill me-1"></i> Add Accounts
                        </a>
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
            <!-- End Page Header -->

            <!-- Stats -->
            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Total Accounts</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span class="js-counter display-4 text-dark">@foreach ($accounts as $key => $account)   @if ($loop->last)
                                        {{ $key + 1 }}
                                      @endif @endforeach</span>
                                    <span class="text-body fs-5 ms-1">from {{ $totalAccount }}</span>
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
                            <h6 class="card-subtitle mb-2">Active Accounts</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span
                                        class="js-counter display-4 text-dark">{{ count($accounts->where('active', '!=', null)) }}</span>
                                    <span class="text-body fs-5 ms-1">from {{ $totalAccount }}</span>
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
                                <input id="datatableSearch" type="search" class="form-control" placeholder="Search Accounts"
                                    aria-label="Search Accounts">
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
                                        <h5 class="card-header-title">Accounts Per Page</h5>

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
                                <th class="table-column-pe-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="datatableCheckAll">
                                        <label class="form-check-label" for="datatableCheckAll"></label>
                                    </div>
                                </th>
                                <th class="table-column-ps-0">Account Name</th>
                                <th>Owner Name</th>
                                <th>Owner Email</th>
                                <th>Billing Address</th>
                                <th>Status</th>
                                {{-- <th>Portfolio</th> --}}
                                <th>Created</th>
                                <th> Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($accounts as $key => $account)
                                <tr>
                                    <td class="table-column-pe-0">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="datatableCheckAll1">
                                            <label class="form-check-label" for="datatableCheckAll1"></label>
                                        </div>
                                    </td>
                                    <td class="table-column-ps-0">
                                        <a class="d-flex align-items-center" data-bs-toggle="modal"
                                            data-id="{{ $account->id }}"
                                            data-bs-target="#editUserModal{{ $account->id }}">

                                            {{-- <div class="avatar avatar-circle">
                      <img class="avatar-img" src="{{ $account->profile_picture }}" alt="Image Description">
                    </div> --}}
                                            <div class="ms-3">
                                                <span
                                                    class="d-block h5 text-inherit mb-0">{{ $account->account_name }}<span class="badge bg-info rounded-pill ms-1"></span>
                                                    {{-- <i class="bi-patch-check-fill text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Top endorsed"></i> --}}
                                                </span>

                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        {{ $account->owner ?? 'Not Yet Set' }}
                                    </td>
                                    <td>
                                        {{ $account->owner ?? 'Not Yet Set' }}
                                    </td>
                                    <td>
                                        {{ $account->billing_address ?? 'Not Yet Set' }}
                                    </td>
                                    {{-- <td>{{ $account->state ?? 'Not Yet Set' }}</td> --}}
                                    <td>
                                        <span
                                            class="legend-indicator {{ $account->active == 1 ? 'bg-success' : 'bg-danger' }}"></span>{{ $account->active == 1 ? 'Active' : 'Inactive' }}
                                    </td>

                                    <td>{{ $account->created_at }}</td>
                                    <td>
                                        {{-- <button type="button" class="btn btn-white btn-sm" href="{{ route('users.edit',$account->id) }}" data-bs-toggle="modal" data-bs-target="#editUserModal">
                    <i class="bi-pencil-fill me-1"></i> Edit
                  </button> --}}
                                        <a class="btn btn-white btn-sm" id="btn-edit" data-bs-toggle="modal"
                                            data-id="{{ $account->id }}"
                                            data-bs-target="#editUserModal{{ $account->id }}"> <i
                                                class="bi-pencil-fill me-1"></i>Edit</a>
                                        {{-- model start --}}
                                        <div class="modal fade" id="editUserModal{{ $account->id }}" tabindex="-1"
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
                                                        <form action="{{ route('accounts.update', $account->id) }}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                        
                                                            <div class="form-group mt-4 mb-4">
                                                                <div class="row">
                                                                    <label for="account_name" class="col-sm-3 col-form-label form-label">Account Name</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="account_name" name="account_name" value="{{ $account->account_name }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="form-group mt-4 mb-4">
                                                                <div class="row">
                                                                    <label for="billing_address" class="col-sm-3 col-form-label form-label">Billing Address</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="billing_address" name="billing_address" value="{{ $account->billing_address }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="form-group mt-4 mb-4">
                                                                <div class="row">
                                                                    <label for="billing_city" class="col-sm-3 col-form-label form-label">Billing City</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="billing_city" name="billing_city" value="{{ $account->billing_city }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="form-group mt-4 mb-4">
                                                                <div class="row">
                                                                    <label for="billing_state" class="col-sm-3 col-form-label form-label">Billing State</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="billing_state" name="billing_state" value="{{ $account->billing_state }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="form-group mt-4 mb-4">
                                                                <div class="row">
                                                                    <label for="billing_zip" class="col-sm-3 col-form-label form-label">Billing Zip</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="billing_zip" name="billing_zip" value="{{ $account->billing_zip }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="form-group mt-4 mb-4">
                                                                <div class="row">
                                                                    <label for="billing_amount" class="col-sm-3 col-form-label form-label">Billing Amount</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="billing_amount" name="billing_amount" value="{{ $account->billing_amount }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="form-group mt-4 mb-4">
                                                                <div class="row">
                                                                    <label for="active" class="col-sm-3 col-form-label form-label">Active</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="checkbox" id="active" name="active" {{ $account->active ? 'checked' : '' }}>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="row">
                                                                <div class="col-md-12 text-center">
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

                                        <form method="POST" action="{{ route('accounts.destroy', $account->id) }}"
                                            style="display:inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi-pencil-fill me-1"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{-- {!! $account->render() !!} --}}
                </div>
                <!-- End Table -->

                <!-- Footer -->
                <div class="card-footer">
                    <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                        <div class="col-sm mb-2 mb-sm-0">
                            {!! $accounts->render() !!} </div>
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
                    <form action="{{ route('accounts.store') }}" method="post">
                        @csrf
                    
                        <div class="form-group mt-4 mb-4">
                            <div class="row">
                                <label for="account_name" class="col-sm-3 col-form-label form-label">Account Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="account_name" name="account_name" required>
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group mt-4 mb-4">
                            <div class="row">
                                <label for="owner" class="col-sm-3 col-form-label form-label">Owner</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="owner" name="owner">
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group mt-4 mb-4">
                            <div class="row">
                                <label for="billing_address" class="col-sm-3 col-form-label form-label">Billing Address</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="billing_address" name="billing_address">
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group mt-4 mb-4">
                            <div class="row">
                                <label for="billing_city" class="col-sm-3 col-form-label form-label">Billing City</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="billing_city" name="billing_city">
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group mt-4 mb-4">
                            <div class="row">
                                <label for="billing_state" class="col-sm-3 col-form-label form-label">Billing State</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="billing_state" name="billing_state">
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group mt-4 mb-4">
                            <div class="row">
                                <label for="billing_zip" class="col-sm-3 col-form-label form-label">Billing Zip</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="billing_zip" name="billing_zip">
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group mt-4 mb-4">
                            <div class="row">
                                <label for="billing_amount" class="col-sm-3 col-form-label form-label">Billing Amount</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="billing_amount" name="billing_amount">
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group mt-4 mb-4">
                            <div class="row">
                                <label for="active" class="col-sm-3 col-form-label form-label">Active</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="active" name="active">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    
                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-primary">Create Account</button>
                        </div>
                    </form>
                    
                   
                      <!-- End Step Form -->
                </div>
                <!-- End Body -->
            </div>
        </div>
    </div>
    <!-- Edit user -->



@endsection
