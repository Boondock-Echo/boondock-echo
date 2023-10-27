@extends('layouts.app1')


@section('content')
   
    <main id="content" role="main" class="main">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-sm mb-2 mb-sm-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-no-gutter">
                                {{-- <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Pages</a></li> --}}
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Received</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Overview</li>
                            </ol>
                        </nav>

                        <h1 class="page-header-title">All Received</h1>
                    </div>


                </div>
                <!-- End Row -->
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong>{{ $message }}</strong>
                </div>
            @endif



            <!-- Stats -->
            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Total AudioFiles</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span class="js-counter display-4 text-dark">
                                        @foreach ($audioFiles as $key => $dock)
                                            @if ($loop->last)
                                                {{ $key + 1 }}
                                            @endif
                                        @endforeach
                                    </span>
                                    <span class="text-body fs-5 ms-1">from {{ $totalaudioFiles }}</span>
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
                            <h6 class="card-subtitle mb-2">AudioFiles Sent</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span
                                        class="js-counter display-4 text-dark">{{ count($audioFiles->where('is_online', '!=', null)) }}</span>
                                    <span class="text-body fs-5 ms-1">from {{ $totalaudioFiles }}</span>
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
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Total Docks (active)</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span class="js-counter display-4 text-dark">
                                        {{ $totalActiveDocks }}
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

            </div>
            <!-- End Stats -->

            <div class="card">
                <div class="card-header card-header-content-md-between">
                    <div class="mb-2 mb-md-0">
                        <form>
                            <!-- Search -->
                            <div class="input-group input-group-merge input-group-flush">
                                <div class="input-group-prepend input-group-text">
                                    <i class="bi-search"></i>
                                </div>
                                <input id="datatableSearch" type="search" class="form-control" placeholder="search Audio"
                                    aria-label="search Docks">
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
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi-filter me-1"></i>All Filter <span
                                    class="badge bg-soft-dark text-dark rounded-circle ms-1">2</span>
                            </button>

                            <div class="dropdown-menu dropdown-menu-sm-end dropdown-card card-dropdown-filter-centered"
                                aria-labelledby="usersFilterDropdown" style="min-width: 22rem;">
                                <!-- Card -->
                                <div class="card">
                                    <div class="card-header card-header-content-between">
                                        <h5 class="card-header-title">Filter users</h5>

                                        <!-- Toggle Button -->
                                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm ms-2">
                                            <i class="bi-x-lg"></i>
                                        </button>
                                        <!-- End Toggle Button -->
                                    </div>

                                    <div class="card-body">
                                        <form class="form-inline my-2 my-lg-0 mb-4" method="GET"
                                            action="{{ route('allinbox.index') }}">
                                            <div class="form-group mr-2">
                                                <span class="dropdown-header">Audios Per Page</span>
                                                <select name="per_page"
                                                    class="form-select form-select-sm focus input-active dropdown-active">
                                                    <option class="option" value="5">5</option>
                                                    <option class="option" value="10"
                                                        {{ $per_page == 10 ? 'selected' : '' }}>10</option>
                                                    <option class="option" value="20"
                                                        {{ $per_page == 20 ? 'selected' : '' }}>20</option>
                                                    <option class="option" value="25"
                                                        {{ $per_page == 25 ? 'selected' : '' }}>25</option>
                                                    <option class="option" value="50"
                                                        {{ $per_page == 50 ? 'selected' : '' }}>50</option>
                                                    <option class="option" value="100"
                                                        {{ $per_page == 100 ? 'selected' : '' }}>100</option>
                                                </select>
                                            </div>
                                            <div class="form-group mr-2">
                                                {{-- <label for="dock_name">Filter by dock:</label> --}}
                                                <span class="dropdown-header">Filter by dock:</span>
                                                <select
                                                    class="form-select form-select-sm focus input-active dropdown-active"
                                                    name="dock_name" id="dock_name">
                                                    <option value="">All docks</option>
                                                    @foreach ($activeDocks as $dock)
                                                        <option value="{{ $dock->name }}"
                                                            @if (request('dock_name') == $dock->name) selected @endif>
                                                            {{ $dock->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="hidden" name="page"
                                                value="{{ $audioFiles->currentPage() }}">
                                            <div class="d-grid mt-4">
                                                {{-- <a class="btn btn-primary" type="submit" href="javascript:;">Apply</a> --}}
                                                <button class="btn btn-primary" type="submit">Apply</button>
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
                                            <th> No.</th>
                                            <th>Station</th>
                                            <th>Dock Name</th>
                                            <th>Audio</th>
                                            {{-- <th>State</th> --}}
                                            <th>Message</th>
                                            {{-- <th>Portfolio</th> --}}
                                            <th>Received</th>
                                            <th> Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($audioFiles as $key => $audioFile)
                                <tr>
                                    <td  data-label="No.">
                                        {{-- <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="datatableCheckAll1">
                                            <label class="form-check-label" for="datatableCheckAll1"></label>
                                        </div> --}}
                                        {{ $key + 1 + ($audioFiles->currentPage() - 1) * $audioFiles->perPage() }}
                                    </td>
                                
                                    <td data-label="Station">
                                        Station Test - 1
                                    </td>
                                     
                                    <td data-label="Dock Name">
                                        @foreach ($activeDocks as $dock)
                                        @if ($dock->mac == $audioFile->mac)
                                            {{ $dock->name ?? 'DOCK nOT fOUND' }}
                                        @endif
                                    @endforeach
                                    </td>

                                    <td>
                                        {{-- @if (str_contains($audioFile->file_name, 'uploads')) --}}
                                            <span><audio controls="mini"
                                                    src="https://cdn.boondockdev.com/uploads/{{ $audioFile->mac }}/{{ $audioFile->file_name }}"></audio></span>

                                            {{-- <span class="text-inherit">  {{ \Carbon\Carbon::parse($audioFile->added)->format('m-j-Y') }} </span> --}}
                                        {{-- @else
                                            <audio controls="mini"
                                                src="{{ asset('storage/uploads/' . $audioFile->mac . '/' . $audioFile->file_name) }}"></audio>
                                        @endif --}}

                                    </td>
                                    <td data-label="Message">
                                        {{-- {{ $audioFile->file_name }} --}}
                                    </td>


                                    <td data-label="Received">
                                        {{ \Carbon\Carbon::parse($audioFile->added)->diffForHumans() }}
                                    </td>
                                    <td data-label="Actions">
                                        {{-- <a class="btn btn-outline-info " id="" data-bs-toggle="modal"
                                        data-id="" data-bs-target="#sett"> <i
                                            class="bi-send me-1" ></i>Send

                                        </a> --}}

                                            {{-- <i
                                            class="bi-send-check me-1" style="font-size: 2rem; color: cornflowerblue;"></i> --}}

                                    {{-- model setting start --}}



                                    {{-- model setting end --}}
                                    {{-- <a class="btn btn-outline-info" id="set"
                                        data-bs-toggle="modal" data-id=""
                                        data-bs-target="#editUserModal"> <i
                                            class="bi-play-circle me-1"></i>Play</a> --}}
                                           <!-- Button to trigger the modal -->
<button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModalCenterdelete{{$audioFile->id}}">
    <i class="bi-trash me-1"></i>
</button>

<!-- Modal -->
<div id="exampleModalCenterdelete{{$audioFile->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content text-center">
            <div class="modal-body">
                <p class="text-dark">Do you really want to delete this record? This process cannot be undone.</p>
                <button type="button" class="btn btn-soft-dark mx-4" data-bs-dismiss="modal">Cancel</button>
                <!-- Form to handle the delete action -->
                <form method="POST" action="{{ route('inbox.delete', $audioFile->id) }}" style="display:inline">
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
                <!-- Footer -->
                <div class="card-footer">
                    <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                        <div class="col-sm mb-2 mb-sm-0">
                            {!! $audioFiles->appends(['per_page' => $per_page, 'dock_name' => request('dock_name')])->render() !!} </div>
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
            </div>
        </div>
    </main>
@endsection
