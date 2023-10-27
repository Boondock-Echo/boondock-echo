@extends('layouts.app1')
@section('content')

    <main id="content" role="main" class="main">
       


        <!-- Content -->
        <div class="">
            <!-- Page Header -->

            <!-- End Page Header -->

            <div class="card rounded-0">
                <!-- Header -->
                <div class="card-header d-flex justify-content-between align-items-center">
                    <!-- Nav -->
                    <ul class="nav nav-segment bg-light" id="navTab2" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="nav-resultTab2" href="#nav-result2" data-bs-toggle="pill"
                                data-bs-target="#nav-result2" role="tab" aria-controls="nav-result2"
                                aria-selected="true">All Captured</a>
                        </li>


                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="nav-htmlTab2" href="#nav-html2" data-bs-toggle="pill"
                                data-bs-target="#nav-html2" role="tab" aria-controls="nav-html2" aria-selected="false"
                                tabindex="-1"> Monitoring</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="nav-three-eg1-tab" href="#nav-three-eg1" data-bs-toggle="pill"
                                data-bs-target="#nav-three-eg1" role="tab" aria-controls="nav-three-eg1"
                                aria-selected="false">Favorite</a>
                        </li> --}}
                    </ul>
                    <!-- End Nav -->

                    <!-- Add Alert Button for add monitor strats-->
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                        data-bs-target="#exampleModalCenter">Add Monitor</button>

                    <!-- End Add Alert Button for add monitor ends -->
                </div>


                <!-- End Header -->

                <!-- Tab Content -->
                <div class="tab-content" id="navTabContent2">
                    <div class="tab-pane fade p-4 active show" id="nav-result2" role="tabpanel"
                        aria-labelledby="nav-resultTab2">

                        <div class=" container mb-3" role="alert">
                            {{-- no data caputered condition strats --}}
                            @if ($alerts->isEmpty()) 
                                <div class="text-center p-4">
                                    <img class="mb-3" src="{{ asset('assets/svg/illustrations/oc-error.svg') }}"
                                        alt="Image Description" style="width: 25%;" data-hs-theme-appearance="default">
                                    <img class="mb-3" src="{{ asset('assets/svg/illustrations-light/oc-error.svg') }}"
                                        alt="Image Description" style="width: 25%;" data-hs-theme-appearance="dark">
                                    <p class="mb-0">No data is captured.</p>

                                </div>
                            @else
                                @foreach ($alerts as $key => $alert)
                                    {{-- @if ($alert->alert_type == 'Audio') --}}
                                    <div class="row text-dark show-hide">

                                        <div class="col shadow-sm p-3 mb-5 bg-white rounded  mx-2 card-transition">

                                            <div class="d-flex">
                                                <i class="bi bi-heart me-2 text-primary"></i>
                                                <div class="flex-shrink-0 " id="heading{{ $alert->id }}" role="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $alert->id }}"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                    <!-- Check -->
                                                    {{-- <div class="icon-container">
                                                        <i class="bi bi-eye text-primary"></i>
                                                        
                                                    
                                                    </div> --}}

                                                    <!-- End Check -->

                                                </div>

                                                <div class="flex-grow-1 ms-2" id="heading{{ $alert->id }}" role="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $alert->id }}"
                                                    aria-expanded="true" aria-controls="collapse{{ $alert->id }}">
                                                    @isset($alert->dock)
                                                        {{-- Captured from dock <b>{{ $alert->dock->name }}</b> | --}}
                                                        {{-- Station/Call Sign :  --}}
                                                        <b>
                                                            @isset($alert->dock)
                                                                {{ $alert->dock->station }}
                                                            @else
                                                                Dock data not available
                                                            @endisset
                                                        </b>
                                                    @else
                                                        Captured without associated Dock or Station
                                                    @endisset

                                                    {{-- Handle the case if other data is not found --}}
                                                    @empty($alert->created_at)
                                                        <p>No timestamp available</p>
                                                    @endempty

                                                    {{-- Add more similar @empty checks for other data fields as needed --}}
                                                </div>

                                                <div class="d-flex ms-2 ">
                                                    <time datetime="{{ $alert->created_at->format('Y-m-d H:i:s') }}">
                                                        @isset($alert->created_at)
                                                            {{ $alert->created_at->format('jS F Y, l, H:i:s') }}
                                                        @else
                                                            No timestamp available
                                                        @endisset
                                                    </time>
                                                    {{-- <span class="day ms-1">
                                                            @isset($alert->created_at)
                                                                {{ $alert->created_at->format('D') }}
                                                            @else
                                                                N/A
                                                            @endisset
                                                        </span> --}}

                                                    <span class="mx-2 show-hide-icon "> |</span>



                                                  <a href="{{ route('alerts.destroy', $alert->id) }}"
                                                        onclick="event.preventDefault();
                                                                     if (confirm('Are you sure you want to delete this alert?')) {
                                                                         document.getElementById('delete-form-{{ $alert->id }}').submit();
                                                                     }"
                                                        class="">
                                                        <i class="bi-trash me-1 show-hide-icon"></i>
                                                    </a>

                                                    <form id="delete-form-{{ $alert->id }}"
                                                        action="{{ route('alerts.destroy', $alert->id) }}" method="POST"
                                                        style="">
                                                        @csrf
                                                        @method('DELETE')
                                                        
                                                    </form> 
                                                    {{-- <a href="#" onclick="event.preventDefault(); showConfirmationModal({{ $alert->id }});" class="">
                                                        <i class="bi-trash me-1 show-hide-icon"></i>
                                                    </a>
                                                    <!-- Modal -->
                                                    <div id="confirmationModal{{ $alert->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                                            <div class="modal-content text-center">
                                                                <div class="modal-body">
                                                                    <p class="text-dark">Are you sure you want to delete this task from history?</p>
                                                                    <button type="button" class="btn btn-soft-dark mx-4" data-bs-dismiss="modal">Cancel</button>
                                                                    <!-- Form to handle the delete action -->
                                                                    <form id="delete-form-{{ $alert->id }}" action="{{ route('alerts.destroy', $alert->id) }}" method="POST" style="display:inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-soft-danger">Yes, Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal -->
                                                    
                                                    <script>
                                                        function showConfirmationModal(alertId) {
                                                            var modalId = "confirmationModal" + alertId;
        var modalElement = document.getElementById(modalId);
        var deleteForm = document.getElementById('delete-form-' + alertId);
        
                                                            if (modalElement && deleteForm) {
                                                                modalElement.classList.add('show');
                                                                modalElement.style.display = 'block';
                                                                
                                                                var backdropElement = document.createElement('div');
                                                                backdropElement.classList.add('modal-backdrop', 'fade', 'show');
                                                                document.body.appendChild(backdropElement);
                                                                
                                                                modalElement.addEventListener('click', function (event) {
                                                                    if (event.target === modalElement) {
                                                                        modalElement.classList.remove('show');
                                                                        modalElement.style.display = 'none';
                                                                        backdropElement.remove();
                                                                    }
                                                                });
                                                                
                                                                var cancelBtn = modalElement.querySelector('[data-bs-dismiss="modal"]');
                                                                if (cancelBtn) {
                                                                    cancelBtn.addEventListener('click', function () {
                                                                        modalElement.classList.remove('show');
                                                                        modalElement.style.display = 'none';
                                                                        backdropElement.remove();
                                                                    });
                                                                }
                                                                
                                                                var confirmBtn = modalElement.querySelector('.btn-soft-danger');
                                                                if (confirmBtn) {
                                                                    confirmBtn.addEventListener('click', function () {
                                                                        deleteForm.submit();
                                                                    });
                                                                }
                                                            }
                                                        }
                                                    </script> --}}
                                                    

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div id="collapse{{ $alert->id }}"
                                            class="accordion-collapse collapse{{ $key === 0 ? ' show' : '' }}"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label">From Dock</label>
                                                    <div class="col-sm-9">
                                                        <h4 class="mt-2">
                                                            @isset($alert->dock)
                                                                {{ $alert->dock->name }}
                                                            @else
                                                                Dock data not available
                                                            @endisset
                                                        </h4>
                                                    </div>
                                                </div>
                                                {{-- end row --}}
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label">Station / Call Sign</label>
                                                    <div class="col-sm-9">
                                                        <h4 class="mt-2">
                                                            @isset($alert->dock)
                                                                {{ $alert->dock->station }}
                                                            @else
                                                                Dock data not available
                                                            @endisset
                                                        </h4>
                                                    </div>
                                                </div>
                                                {{-- end row --}}
                                                
                                        
                                                <div class="row mb-2">
                                                    <label class="col-sm-3 col-form-label">Matching Keyword(s)
                                                        <span class="mx-2 badge bg-primary">
                                                            @isset($alert->keywords)
                                                                {{ count(json_decode($alert->keywords)) }}
                                                            @else
                                                                0
                                                            @endisset
                                                        </span>
                                                    </label>
                                                    <div class="col-sm-9 h3 mt-2">
                                                        @isset($alert->keywords)
                                                            @foreach (json_decode($alert->keywords) as $keyword)
                                                                <span
                                                                    class="badge bg-soft-primary text-primary">{{ $keyword }}</span>
                                                            @endforeach
                                                        @else
                                                            No keywords available
                                                        @endisset
                                                    </div>
                                                </div>
                                                {{-- end row --}}
                                                <div class="row mb-2">
                                                    <label class="col-sm-3 col-form-label">Captured Audio</label>
                                                    <audio controls style="width: 300px; height: 30px;" class="mt-2">
                                                        <source src="{{ $alert->audio_url ?? '' }}">
                                                    </audio>
                                                </div>
                                                {{-- end row --}}
                                                {{-- <div class="row mb-2">
                                                    <label class="col-sm-3 col-form-label">Mail to</label>
                                                    <div class="col-sm-9">
                                                        <h4 class="mt-2">
                                                            @isset($alert->user->email)
                                                                <a href="mailto:{{ $alert->user->email }}"
                                                                    class="text-primary">{{ $alert->user->email }}</a>
                                                            @else
                                                                Email not available
                                                            @endisset
                                                        </h4>
                                                    </div>
                                                </div> --}}
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label">Message ( Transcirbed text
                                                        )</label>
                                                    <div class="col-sm-9">
                                                        <h4 class="mt-2">

                                                            @isset($alert->message_id)
                                                                {{ $alert->messageId->transcribe_long ?? 'Not found' }}
                                                            @else
                                                                data not available
                                                            @endisset
                                                        </h4>
                                                    </div>
                                                </div>
                                                {{-- end row --}}
                                                {{-- <div class="row">
                                                    <label class="col-sm-3 col-form-label">Received On</label>
                                                    <div class="col-sm-9">
                                                        <h4 class="mt-2">
                                                            <time
                                                                datetime="{{ $alert->created_at->format('Y-m-d H:i:s') }}">
                                                                @isset($alert->created_at)
                                                                    {{ $alert->created_at->format('jS F Y, l, H:i:s') }}
                                                                @else
                                                                    No timestamp available
                                                                @endisset
                                                            </time>
                                                        </h4>
                                                    </div>
                                                </div> --}}

                                                {{-- end row --}}
                                            </div>
                                        </div>

                                    </div>
                                    {{-- @else
                                <div class="row mt-2">
                                <div class="col alert alert-soft-primary mx-2 card-transition" role="alert">
                                    {!! $alert->message !!}
                                </div>
                                </div>
                                @endif --}}
                                @endforeach
                            @endif
                            {{-- no data caputered condition ends --}}
                        </div>
<!-- Pagination -->
<nav class="d-sm-flex justify-content-sm-between align-items-sm-center text-center" aria-label="Page navigation example">
    <ul class="pagination justify-content-center justify-content-sm-end">
      <li class="page-item {{ $alerts->currentPage() === 1 ? 'disabled' : '' }}">
        <a class="page-link" href="{{ $alerts->previousPageUrl() }}" tabindex="-1">Previous</a>
      </li>
      @for ($i = 1; $i <= $alerts->lastPage(); $i++)
        <li class="page-item {{ $i === $alerts->currentPage() ? 'active' : '' }}">
          <a class="page-link" href="{{ $alerts->url($i) }}">{{ $i }}</a>
        </li>
      @endfor
      <li class="page-item {{ !$alerts->hasMorePages() ? 'disabled' : '' }}">
        <a class="page-link" href="{{ $alerts->nextPageUrl() }}">Next</a>
      </li>
    </ul>
  
    <small class="text-muted">
      Showing {{ $alerts->firstItem() }} - {{ $alerts->lastItem() }} of {{ $alerts->total() }}
    </small>
  </nav>
  <!-- End Pagination -->
  
  
                    </div>



                    <div class="tab-pane fade p-4" id="nav-html2" role="tabpanel" aria-labelledby="nav-resultTab2">
                        {{-- no data found in monitoring condition strats --}}
                        @if ($audioAlerts->isEmpty())
                            <div class="text-center p-4">
                                <img class="mb-3" src="{{ asset('assets/svg/illustrations/oc-error.svg') }}"
                                    alt="Image Description" style="width: 25%;" data-hs-theme-appearance="default">
                                <img class="mb-3" src="{{ asset('assets/svg/illustrations-light/oc-error.svg') }}"
                                    alt="Image Description" style="width: 25%;" data-hs-theme-appearance="dark">
                                <div>
                                    <p class="mb-0 ">No data to show in the monitor.</p>
                                    <a class="" data-bs-toggle="collapse" href="#collapseExampleLearnMore"
                                        role="button" aria-expanded="false" aria-controls="collapseExampleLearnMore">
                                        Learn More.
                                    </a>

                                </div>
                                <div class="collapse" id="collapseExampleLearnMore">
                                    <div class="px-5 justify-content-center mt-3 ">

                                        <p>To view data in this section, please set up monitoring alerts as follows:</p>
                                        <p>1. Click on the "Add Monitor" button to create a new monitoring rule.</p>
                                        <p>2. Specify relevant keywords that you want to monitor in the audio received <br>
                                            (e.g., 'help', 'fire', 'emergency', 'sos'...).</p>
                                        <p>3. Configure the alert settings, selecting email notifications for immediate
                                            alerts.</p>
                                        <p>If the specified keywords are detected in the received audio, you will receive an
                                            email notification, indicating a potential emergency. This ensures that you stay
                                            informed and can take immediate action if necessary.</p>


                                    </div>
                                </div>


                            </div>
                        @else
                            <!-- Table -->

                            <div class="table-responsive datatable-custom position-relative">
                                <table class="table" id="datatable"
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
                                    "pageLength": 5,
                                    "isResponsive": false,
                                    "isShowPaging": false,
                                    "pagination": "datatableWithPaginationPagination"
                                    }'>
                                    <thead class="thead-light">
                                        <tr>

                                            <th>Track Keyword</th>
                                            <th>From Dock</th>
                                            <th>Email Alert</th>

                                            <th>Actions</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($audioAlerts as $audioAlert)
                                            <tr>
                                                @php
                                                    $audioArray = explode(',', $audioAlert->audio_array);
                                                @endphp

                                                <td data-label="Track Keyword">
                                                    <span class="h3">
                                                        @foreach ($audioArray as $item)
                                                            <span
                                                                class="badge bg-soft-primary text-primary">{{ $item }}</span>
                                                        @endforeach
                                                    </span>
                                                </td>
                                                <td data-label="From Dock" class="text-dark">
                                                    @if (isset($audioAlert->dock) && isset($audioAlert->dock->name))
                                                        {{ $audioAlert->dock->name }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>

                                                <td data-label="Email-alert" class="text-dark">
                                                    {{ $audioAlert->email_alert ? 'Yes' : 'No' }}</td>

                                                <td data-label="Actions">
                                                    {{-- <a href="{{ route('audio_alerts.edit', $audioAlert->id) }}" class="btn btn-primary">Edit</a> --}}

                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalCenterdelete"><i
                                                            class="bi bi-trash me-2"></i>Delete</button>


                                                    <!-- End Button trigger modal -->

                                                    <!-- Modal -->
                                                    <div id="exampleModalCenterdelete" class="modal fade" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-sm"
                                                            role="document">
                                                            <div class="modal-content text-center">
                                                                <div class="modal-body">
                                                                    <p class="text-dark">Do you really want to delete this
                                                                        record? This process cannot be undone.</p>
                                                                    <button type="button" class="btn btn-soft-dark mx-4"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                    <form
                                                                        action="{{ route('audio_alerts.destroy', $audioAlert->id) }}"
                                                                        method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-soft-danger">Yes,
                                                                            Delete</button>
                                                                    </form>

                                                                </div>



                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal -->
                                                </td>
                                                <td data-label="created at">
                                                    @if (isset($audioAlert->dock) && isset($audioAlert->created_at))
                                                        {{ $audioAlert->created_at }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>


                            </div>
                            <!-- Footer -->
                            <div class="card-footer">
                                <!-- Pagination -->
                                <div class="d-flex justify-content-center justify-content-sm-end">
                                    <nav id="datatableWithPaginationPagination" aria-label="Activity pagination"></nav>
                                </div>
                                <!-- End Pagination -->
                            </div>
                            <!-- End Footer -->
                        @endif{{-- no data found in monitoring condition end --}}
{{-- <!-- Pagination -->
<nav class="d-sm-flex justify-content-sm-between align-items-sm-center text-center" aria-label="Page navigation example">
    <ul class="pagination justify-content-center justify-content-sm-end">
      <li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1">Previous</a>
      </li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#">Next</a>
      </li>
    </ul>
  
    <small class="text-muted">Showing 1 -10 of 100 </small>
  </nav>
  <!-- End Pagination --> --}}

                    </div>
                    {{-- <div class="tab-pane fade" id="nav-three-eg1" role="tabpanel" aria-labelledby="nav-three-eg1-tab">
                        <p>Favorite here</p>
                    </div> --}}

                    <!-- End Tab Content -->

                </div>

            </div>
            <!-- Card -->

        </div>
        <!-- End Content -->



        <!-- Modal -->
        <div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">


                    <div id="notificationsSection" class="card container px-5 py-2">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">Keyword Monitor</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>


                        {{-- new modAL START --}}
                        <!-- Input Group -->

                        <form id="audioAlertForm" method="POST" action="{{ route('audio_alerts.store') }}">
                            @csrf

                            <!-- Enter Keywords -->
                            @if ($docks->count() > 0 && $docks->where('mac', '!=', auth()->id())->count() > 0)
                                <div class="row mb-3 my-5">
                                    <label for="keywordLabel" class="col-sm-3 col-form-label form-label">Enter
                                        keywords</label>

                                    <div class="col-sm-9">
                                        <div id="badgeContainer" class="badge-container">
                                            <input type="hidden" id="audioArrayInput" name="audio_array"
                                                value="">
                                            <input type="text" id="keywordInput" class="badge-input form-control"
                                                placeholder="Enter keywords separated by commas">
                                        </div>
                                        <div id="keywordMessage" class="mt-2 text-danger"></div>
                                        <div id="keywordList" class="mt-2"></div>
                                        @error('audio_array')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- End Enter Keywords -->

                                <!-- Select Dock -->
                                <div class="row mb-4">
                                    <label for="dockLabel" class="col-sm-3 col-form-label form-label">Dock</label>

                                    <div class="col-sm-9">
                                        <div class="input-group input-group-sm-vertical">
                                            <!-- Dropdown -->
                                            <div class="btn-group">
                                                <!-- Select -->
                                                <div class="tom-select-custom">
                                                    <select class="js-select form-select" autocomplete="on"
                                                        id="dock_state17691" name="dock_id"
                                                        data-hs-tom-select-options="{&quot;placeholder&quot;: Select Dock}">
                                                        @foreach ($docks as $dock)
                                                            @if ($dock->mac != auth()->id())
                                                                <option value="{{ $dock->id }}">{{ $dock->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- End Select -->
                                            </div>
                                            <!-- End Dropdown -->
                                            @error('dock_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- End Select Dock -->

                                <!-- Send Alert -->
                                <div class="row mb-2">
                                    <label class="col-sm-3 col-form-label form-label">Send Alert at</label>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-sm-vertical">
                                            <!-- Checkboxes -->
                                            <div class="row gx-5 mt-2">
                                                <div class="col-sm-12">
                                                    <!-- Form Check: Email -->
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label" for="formInlineCheck2">E-mail <i
                                                                class="bi-envelope-open mx-1"></i></label>
                                                        <input type="checkbox" id="emailalert" class="form-check-input"
                                                            name="email_alert" value="1" checked>
                                                    </div>
                                                    <!-- End Form Check: Email -->
                                                </div>
                                            </div>
                                            <!-- End Checkboxes -->
                                            @error('email_alert')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>



                                </div>
                                <!-- End Send Alert -->

                                <div class="alert alert-success alert-dismissible fade show" id="successAlert"
                                    role="alert" style="display: none;">
                                    <span class="fw-semibold">Success!</span> Audio alert created successfully.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                                <hr>


                                <div class="d-flex justify-content-center mb-3">
                                    <button id="submitBtn" type="submit" class="btn btn-primary btn-lg px-5">
                                        <span id="loadingIcon" class="spinner-border spinner-border-sm d-none mx-3"
                                            role="status" aria-hidden="true"></span>Save
                                    </button>
                                </div>
                                <!-- Add an HTML element for the loading icon within the "Save" button -->

                                <!-- JavaScript -->
                                <style>
                                    .keyword-container {
                                        display: inline-flex;
                                        align-items: center;
                                        margin-bottom: 0.5rem;
                                        padding: 0.25rem 0.5rem;
                                        background-color: #f8f9fa;
                                        border-radius: 0.25rem;
                                        margin-right: 0.4rem;
                                        color: #000;
                                    }

                                    .keyword-text {
                                        margin-right: 0.5rem;
                                    }

                                    .cancel-icon {
                                        cursor: pointer;
                                        color: #dc3545;
                                    }
                                </style>

                                <!-- End JavaScript -->

                                <!-- End Input Group -->

                                {{-- new modal end --}}
                            @else
                                <div class="row mt-4 text-center">

                                    <label for="dockLabel" class=" col-form-label form-label text-danger ">* No docks have
                                        Enable auto
                                        transcribe.* </label>
                                    <p>
                                        <a class="text-primary" data-bs-toggle="collapse" href="#collapseExample"
                                            role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Learn More.
                                        </a>

                                    </p>
                                    <div class="collapse" id="collapseExample">
                                        <div class="">
                                            <!-- Body -->
                                            <div class="">

                                                <!-- Alert -->
                                                <div class="alert alert-soft-dark card-alert text-center" role="alert">
                                                    For Keyword Monitoring, you must first enable Auto Transcription in <a
                                                        class="alert-link text-primary"
                                                        href="{{ route('mydocks.index') }}">Dock
                                                        Settings</a>.
                                                    <p class="card-text">Follow these steps: <br> My Docks -> Settings ->
                                                        More
                                                        Settings -> Audio to Text (enable).</p>
                                                </div>
                                                <!-- End Alert -->




                                            </div>
                                            <!-- End Body -->
                                        </div>
                                    </div>


                                </div>
                            @endif



                        </form>
                        <!-- JavaScript code -->
                        <script>
                            var keywordInput = document.getElementById('keywordInput');
                            var audioArrayInput = document.getElementById('audioArrayInput');
                            var keywordList = document.getElementById('keywordList');
                            var keywordCount = 0;
                            var keywordMessage = document.getElementById('keywordMessage');
                            var audioArray = []; // Array to store keywords

                            keywordInput.addEventListener('keydown', function(event) {
                                if (event.key === 'Enter' || event.key === ',') {
                                    event.preventDefault();
                                    var keyword = keywordInput.value.trim();

                                    if (keyword !== '') {
                                        if (keywordCount < 10) {
                                            var keywordContainer = document.createElement('div');
                                            keywordContainer.classList.add('keyword-container');

                                            var keywordElement = document.createElement('span');
                                            keywordElement.classList.add('keyword-text');
                                            keywordElement.textContent = keyword;

                                            var cancelIcon = document.createElement('i');
                                            cancelIcon.classList.add('cancel-icon', 'bi', 'bi-x');
                                            cancelIcon.addEventListener('click', function() {
                                                keywordCount--;
                                                keywordList.removeChild(keywordContainer);
                                                keywordMessage.textContent = '';
                                                audioArray = audioArray.filter(item => item !==
                                                    keyword); // Remove keyword from audioArray
                                                updateAudioArrayInput(); // Update the hidden input value
                                            });

                                            keywordContainer.appendChild(keywordElement);
                                            keywordContainer.appendChild(cancelIcon);
                                            keywordList.appendChild(keywordContainer);
                                            keywordCount++;

                                            audioArray.push(keyword); // Add keyword to audioArray
                                            updateAudioArrayInput(); // Update the hidden input value

                                            keywordInput.value = '';
                                            keywordInput.classList.remove('is-invalid');
                                            keywordMessage.textContent = '';
                                        } else {
                                            keywordMessage.textContent = 'Maximum limit of 10 keywords reached.';
                                        }
                                    } else {
                                        keywordInput.classList.add('is-invalid');
                                        keywordMessage.textContent = 'Invalid keyword. Please enter a valid keyword.';
                                    }
                                }
                            });

                            // Update the value of the hidden input with the comma-separated audioArray
                            function updateAudioArrayInput() {
                                audioArrayInput.value = audioArray.join(',');
                            }

                            var form = document.getElementById('audioAlertForm');
                            var submitBtn = document.getElementById('submitBtn');
                            var successAlert = document.getElementById('successAlert');
                            var loadingIcon = document.getElementById('loadingIcon');

                            submitBtn.addEventListener('click', function(event) {
                                event.preventDefault();

                                // Check if keywords and audioArray are valid
                                // var keywords = keywordInput.value.split(',');
                                // var invalidKeywords = keywords.filter(keyword => keyword.trim() === '');

                                // if (invalidKeywords.length > 0) {
                                //     keywordMessage.innerText = 'Invalid keywords. Please enter valid keywords separated by commas.';
                                //     successAlert.style.display = 'none';
                                //     return;
                                // }

                                if (audioArrayInput.value.trim() === '' && audioArray.length === 0) {
                                    keywordMessage.innerText =
                                        'Invalid input. Please enter at least one keyword by pressing Enter or separating with commas.';
                                    successAlert.style.display = 'none';
                                    setTimeout(function() {
                                        keywordMessage.textContent = '';
                                    }, 6000); // 6 seconds timeout
                                    return;
                                }

                                // Disable the submit button to prevent multiple submissions
                                submitBtn.disabled = true;

                                // Show the loading icon
                                loadingIcon.classList.remove('d-none');

                                // Create FormData object to collect form data
                                var formData = new FormData(form);

                                // Send the form data via AJAX using Fetch API
                                fetch(form.action, {
                                        method: 'POST',
                                        body: formData
                                    })
                                    .then(response => {
                                        submitBtn.disabled = false;

                                        if (response.ok) {
                                            // Hide the loading icon
                                            loadingIcon.classList.add('d-none');

                                            // Show the success alert
                                            form.reset();
                                            successAlert.style.display = 'block';

                                            // Reset the form after a delay
                                            setTimeout(function() {
                                                successAlert.style.display = 'none';
                                                // Reset keyword list and input field
                                                keywordList.innerHTML = '';
                                                keywordCount = 0;
                                                audioArray = [];
                                                updateAudioArrayInput();
                                                keywordInput.value = '';
                                            }, 5000); // 5 seconds timeout for success message
                                        } else {
                                            alert('An error occurred. Please try again.');
                                        }
                                    })
                                    .catch(error => {
                                        submitBtn.disabled = false;
                                        // Hide the loading icon
                                        loadingIcon.classList.add('d-none');
                                        alert('An error occurred. Please try again.');
                                    });
                            });
                        </script>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Modal -->

        <!-- End Footer -->
    </main>
@endsection
