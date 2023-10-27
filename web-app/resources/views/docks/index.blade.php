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
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Docks</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Overview</li>
                            </ol>
                        </nav>

                        <h1 class="page-header-title">Docks</h1>
                    </div>
                   

                </div>
               
            </div> --}}
            <!-- End Page Header -->

            <!-- Stats -->
            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Total Docks</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span class="js-counter display-4 text-dark">
                                        @foreach ($docks as $key => $dock)
                                            @if ($loop->last)
                                                {{ $key + 1 }}
                                            @endif
                                        @endforeach
                                    </span>
                                    <span class="text-body fs-5 ms-1">from {{ $totalDocks }}</span>
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
                                    <span class="text-body fs-5 ms-1">from {{ $totalDocks }}</span>
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
                                <i class="bi-filter me-1"></i><span
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
    </li>
    <li class="mx-3">
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

                        <!-- button starts -->

                        <div class="col-sm-auto">
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal"
                                href="{{ route('add') }}">
                                <i class="bi-person-plus-fill me-1"></i> Add Docks
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
                        class="table table-lg table-borderless table-thead-bordered  table-align-middle card-table"
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
                                <th class="table-column-pe-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="datatableCheckAll">
                                        <label class="form-check-label" for="datatableCheckAll"></label>
                                    </div>
                                </th>
                                <th class="table-column-pe-0">Mac</th>
                                <th>Registration Code</th>
                                <th>Software</th>
                                <th>Hardware</th>
                                <th>Owner Name</th>
                                <th>Owner Email</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th> Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($docks as $key => $dock)
                             
                                <tr>
                                    <td class="table-column-pe-0">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="datatableCheckAll1">
                                            <label class="form-check-label" for="datatableCheckAll1"></label>
                                        </div>
                                    </td>
                                    <td class="table-column-pe-0" data-label="Mac">
                                        <a class="align-items-center" data-bs-toggle="modal"
                                            data-id="{{ $dock->id }}"
                                            data-bs-target="#editUserModal{{ $dock->id }}">

                                       
                                            <div class="ms-3">
                                                @isset($dock->mac)
                                                    <span class="d-block h5 text-inherit mb-0">{{ $dock->mac }}</span>
                                                @else
                                                    <span class="d-block text-inherit mb-0 text-muted">Not found</span>
                                                @endisset
                                            </div>
                                            
                                        </a>
                                    </td>
                                    <td data-label="Registration Code">
                                        @if (!empty($dock->code))
                                            <span class="d-block h5 text-inherit mb-0">{{ $dock->code }} </span>
                                        @else
                                            Not Yet Set
                                        @endif
                                        {{-- <span class="d-block h5 text-inherit mb-0"> {{ $dock->code ?? 'Not Yet Set' }} </span> --}}
                                    </td>
                                    <td data-label="Software" class="text-dark">
                                        {{ $dock->sw_version ?? 'Not Yet Set' }}
                                    </td>
                                    <td data-label="Hardware" class="text-dark">
                                        {{ $dock->hw_version ?? 'Not Yet Set' }}
                                    </td>
                                    <td data-label="Owner Name">
                                        @if ($dock->ownby)
                                            <span class="text-dark">{{ $dock->ownby->name }}</span>
                                        @else
                                            Not Yet Set
                                        @endif
                                    </td>
                                    <td data-label="Owner Email">
                                        @if ($dock->ownby)
                                            <span class="text-dark">{{ $dock->ownby->email }}</span>
                                        @else
                                            Not Yet Set
                                        @endif
                                    </td>
                                    
                                    {{-- <td data-label="Status">{{ $dock->state ?? 'Not Yet Set' }}</td> --}}
                                    <td  data-label="Status" >
                                        <span
                                            class="legend-indicator {{ $dock->is_online == 1 ? 'bg-success' : 'bg-danger' }}"></span>{{ $dock->is_online == 1 ? 'Online' : 'Offline' }}
                                    </td>

                                    <td data-label="Created">{{ $dock->created_at }}</td>
                                    <td class="hide-in-mobile" data-label="">

                                        {{-- <button type="button" class="btn btn-white btn-sm" href="{{ route('users.edit',$dock->id) }}" data-bs-toggle="modal" data-bs-target="#editUserModal">
                    <i class="bi-pencil-fill me-1"></i> Edit
                  </button> --}}  
                  <span class="d-inline-flex">
                    <a class="btn btn-white btn-sm me-1" id="btn-edit" data-bs-toggle="modal"
                    data-id="{{ $dock->id }}"
                    data-bs-target="#editUserModal{{ $dock->id }}"> <i
                        class="bi-pencil-fill me-1"></i>Edit
                    </a>
                   <!-- Button to trigger the modal -->
<button type="button" class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#exampleModalCenterdelete{{$dock->id}}">
    <i class="bi-trash me-1"></i> Delete
</button>



                    @if ($dock->owner === null)
                    <a class="btn btn-success btn-sm" id="btn-assign" data-bs-toggle="modal"
                        data-id="{{ $dock->id }}"
                        data-bs-target="#assignModal{{ $dock->id }}"> <i
                            class="bi bi-person"></i>Assign Owner</a>
                @else
                    <a class="btn btn-secondary btn-sm" id="btn-assign" data-bs-toggle="modal"
                        data-id="{{ $dock->id }}"
                        data-bs-target="#chnageModal{{ $dock->id }}"> <i
                            class="bi bi-person"></i>Change Owner</a>
                @endif
                  </span>
                                       
                                        {{-- model start --}}
                                        <div class="modal fade" id="editUserModal{{ $dock->id }}" tabindex="-1"
                                            aria-labelledby="editUserModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
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
                                                        <form action="{{ route('docks.update', $dock->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="">
                                                                <div class="row mb-4">
                                                                    <div class="col-3 mt-1">
                                                                        <div class="form-group">
                                                                            <label for="dock_name">Dock Name</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-9">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="name" name="name" value="{{ $dock->name }}" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            
                                                                <div class="row">
                                                                    <div class="col-3">
                                                                        <div class="form-group">
                                                                            <label for="location" >Mac</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-9">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="mac" name="mac" value="{{ $dock->mac }}" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            
                                                                <div class="row">
                                                                    <div class="col-12 text-center">
                                                                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
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

<!-- Modal for delete -->
<div id="exampleModalCenterdelete{{$dock->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content text-center">
            <div class="modal-body">
                <p class="text-dark">Do you really want to delete this record? This process cannot be undone.</p>
                <button type="button" class="btn btn-soft-dark mx-4" data-bs-dismiss="modal">Cancel</button>
                <!-- Form to handle the delete action -->
                <form method="POST" action="{{ route('docks.destroy', $dock->id) }}" style="display:inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-soft-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal for delete-->
                                       
                                        {{-- for assigning owner --}}
                                        <div class="modal fade" id="assignModal{{ $dock->id }}" tabindex="-1"
                                            aria-labelledby="assignModalLabel" aria-hidden="true">
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
                                                            <form action="{{ route('docks.update', $dock->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <label for="dock_name " class="mt-3 text-dark">Assign Owner</label>
                                                                        </div>
                                                                        <div class="col-8">
                                                                            <select class="form-control " id="active"
                                                                            name="owner">
                                                                            <option value="">Selected None</option>
                                                                            @foreach ($users as $user)
                                                                                <option value="{{ $user->id }}">
                                                                                    {{ $user->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        </div>

                                                                    </div>
                                                                
                                                                
                                                                </div>



                                                                <button type="submit"
                                                                    class="btn btn-primary mt-4">Submit</button>
                                                            </form>
                                                        <!-- End Step Form -->
                                                    </div>
                                                    <!-- End Body -->
                                                </div>
                                            </div>
                                        </div>
                                        {{-- for changing owner --}}
                                        <div class="modal fade" id="chnageModal{{ $dock->id }}" tabindex="-1"
                                            aria-labelledby="chnageModalLabel" aria-hidden="true">
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
                                                        <form action="{{ route('docks.update', $dock->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-4"> <label for="dock_name" class="mt-2 text-dark">Change Owner</label></div>
                                                               <div class="col-8">
                                                                <select class="form-control" id="active"
                                                                    name="owner">
                                                                    <option value="">Select None</option>
                                                                    @foreach ($users as $user)
                                                                        <option value="{{ $user->id }}"
                                                                            {{ $dock->owner == $user->id ? 'selected' : '' }}>
                                                                            {{ $user->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                               </div>
                                                                
                                                            </div>
                                                            </div>



                                                            <button type="submit"
                                                                class="btn btn-primary mt-4 justify-content-center">Submit</button>
                                                        </form>
                                                        <!-- End Step Form -->
                                                    </div>
                                                    <!-- End Body -->
                                                </div>
                                            </div>
                                        </div>

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
                            {!! $docks->render() !!} </div>
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
                    <form action="{{ route('docks.store') }}" method="POST">
                        @csrf
                        <div class="container">
                            <div class="row mb-4">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="dock_name">Dock Name</label>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $dock->name }}">
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="location">Mac</label>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="mac" name="mac" value="{{ $dock->mac }}">
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
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
    <!-- Edit user -->



@endsection
