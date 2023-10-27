@extends('layouts.app1')
@section('content')
   
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
       
        
            <!-- Card -->
            <div class="card">
                <!-- Header -->
                <div class="card-header card-header-content-md-between">
                    <div class="mb-2 mb-md-0">
                         <!-- Filter -->
                         <form>
                            <!-- Search -->
                            <div class="input-group input-group-merge input-group-flush">
                                <div class="input-group-prepend input-group-text">
                                    <i class="bi-search"></i>
                                </div>
                                <input id="datatableSearch" type="search" class="form-control"
                                    placeholder="Search Contacts" aria-label="Search Messages">
                            </div>
                            <!-- End Search -->
                        </form>
          <!-- End Filter -->
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
                      
                    </div>
                   
                
                </div>
                <!-- End Header -->

                <!-- Table -->
                <div class="table-responsive datatable-custom position-relative">
                    <table id="datatable"
                    class="table table-lg table-borderless table-thead-bordered table-align-middle card-table"
                    data-hs-datatables-options='{
                            "columnDefs": [{
                                "targets": [0, 5],
                                "orderable": false
                                }],
                            "order": [],
                            "info": {
                                "totalQty": "#datatableWithPaginationInfoTotalQty"
                            },
                            "search": "#datatableSearch",
                            "entries": "#datatableEntries",
                            "pageLength": 20,
                            "isResponsive": false,
                            "isShowPaging": false,
                            "pagination": "datatablePagination"
                            }'>
                    <thead class="thead-light">
                    <tr>
                     
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                    <th>Region</th>
                        <th>More</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            {{-- <td>{{ $contact->id }}</td> --}}
                            <td data-label="First Name" class="text-dark"><span class="h5">{{ $contact->first_name }}</span></td>
                            <td data-label="Last Name" class="text-dark">
                                @if($contact->last_name)
                                    {{ $contact->last_name }}
                                @else
                                    -
                                @endif
                            </td>
                            <td data-label="Email" class="text-dark">
                                @if($contact->email)
                                    {{ $contact->email }}
                                @else
                                    -
                                @endif
                            </td>
                            <td data-label="Phone" class="text-dark">
                                @if($contact->phone)
                                    {{ $contact->phone }}
                                @else
                                    -
                                @endif
                            </td>
                            <td data-label="Region" class="text-dark">
                                @if($contact->region)
                                    {{ $contact->region }}
                                @else
                                    -
                                @endif
                            </td>
                            
                
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenterExtendInsights{{ $contact->id }}">
                                    Extend Insights
                                </button>
                                <!-- End Button trigger modal -->
                
                                <!-- Modal -->
                                <div id="exampleModalCenterExtendInsights{{ $contact->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterExtendInsightsTitle{{ $contact->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterExtendInsightsTitle{{ $contact->id }}"><span class="h5">{{ $contact->first_name }}'s Extend Insights</span></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="">
                                                    <div id="license-info" class="row my-1" style="">
                                                        <div class="col-12 mb-3">
                                                            <dl class="row text-uppercase">
                                                                <dt class="col-sm-3">Description</dt>
                                                                <dd class="col-sm-9">
                                                                    @if($contact->description)
                                                                        {{ $contact->description }}
                                                                    @else
                                                                        No data found
                                                                    @endif
                                                                </dd>
                                                            
                                                                <dt class="col-sm-3">Region</dt>
                                                                <dd class="col-sm-9">
                                                                    @if($contact->region)
                                                                        {{ $contact->region }}
                                                                    @else
                                                                        No data found
                                                                    @endif
                                                                </dd>
                                                            
                                                                <dt class="col-sm-3">User Timezone</dt>
                                                                <dd class="col-sm-9">
                                                                    @if($contact->user_timezone)
                                                                        {{ $contact->user_timezone }}
                                                                    @else
                                                                        No data found
                                                                    @endif
                                                                </dd>
                                                            
                                                                <dt class="col-sm-3">Ip Address</dt>
                                                                <dd class="col-sm-9">
                                                                    @if($contact->ip_address)
                                                                        {{ $contact->ip_address }}
                                                                    @else
                                                                        No data found
                                                                    @endif
                                                                </dd>
                                                            
                                                                <dt class="col-sm-3">Created At</dt>
                                                                <dd class="col-sm-9">
                                                                    @if($contact->created_at)
                                                                        {{ $contact->created_at }}
                                                                    @else
                                                                        No data found
                                                                    @endif
                                                                </dd>
                                                            
                                                                <dt class="col-sm-3">Updated At</dt>
                                                                <dd class="col-sm-9">
                                                                    @if($contact->updated_at)
                                                                        {{ $contact->updated_at }}
                                                                    @else
                                                                        No data found
                                                                    @endif
                                                                </dd>
                                                            
                                                                <!-- Add more rows if needed -->
                                                            </dl>
                                                                
                                                            <!-- End Row -->
                                                        </div>
                                                    </div>
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
                {{-- {!! $contacts->render() !!} --}}
            </div>
            <!-- End Table -->

            <!-- Footer -->
            <div class="card-footer">
                <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                    <div class="col-sm mb-2 mb-sm-0">
                        {{-- {!! $contacts->render() !!} </div> --}}
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

      
        <!-- End Footer -->
    </main>




@endsection
