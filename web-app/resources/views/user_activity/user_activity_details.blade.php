@extends('layouts.app1')


@section('content')
    <style>
        @media (max-width: 576px) {

            tr.hide-in-mobile {
                display: none;
            }

            

        .nowrap-td {
            white-space: nowrap;
        }
    }
    </style>

    <main id="content" role="main" class="main">


        {{-- single user deatail page starts --}}
        <div class="content container-fluid">
            <div class="row justify-content-lg-center">
                <div class="col-lg-12">


                    <div class="row">
                        <div class="col-lg-4">

                            <!-- Sticky Block Start Point -->
                            <div id="accountSidebarNav" style=""></div>

                            <!-- Card -->
                            <div class="js-sticky-block card mb-3 mb-lg-5"
                                data-hs-sticky-block-options="{
                        parentSelector :  #accountSidebarNav ,
                        breakpoint :  lg ,
                        startPoint :  #accountSidebarNav ,
                        endPoint :  #stickyBlockEndPoint ,
                        stickyOffsetTop : 20
                    }"
                                            style="">
                                <!-- Header -->
                                <div class="card-header">
                                    <h4 class="card-header-title">Profile</h4>
                                </div>
                                <!-- End Header -->

                                <!-- Body -->
                                <div class="card-body">
                                    <ul class="list-unstyled list-py-2 text-dark mb-0">
                                        <li class="pb-0"><span class="card-subtitle">About</span></li>
                                        @if(isset($user->name) && isset($user->last_name))
                                            <li><i class="bi-person dropdown-item-icon"></i> {{ $user->name }} {{ $user->last_name }}</li>
                                        @else
                                            <li><i class="bi-person dropdown-item-icon"></i> Name not available</li>
                                        @endif
                                
                                        <li class="pt-4 pb-0"><span class="card-subtitle">Docks</span></li>
                                        <li>
                                            <i class="bi-cassette dropdown-item-icon"></i>
                                            @if($docks->count() > 0)
                                                @foreach ($docks as $dock)
                                                    <span class="badge bg-soft-primary text-primary">{{ $dock->name }}</span>
                                                @endforeach
                                            @else
                                                <span>No docks found.</span>
                                            @endif
                                        </li>
                                
                                        {{-- <li><i class="bi-building dropdown-item-icon"></i> Location</li> --}}
                                
                                        <li class="pt-4 pb-0"><span class="card-subtitle">Contacts</span></li>
                                        @if(isset($user->email))
                                            <li><i class="bi-at dropdown-item-icon"></i> {{ $user->email }}</li>
                                        @else
                                            <li><i class="bi-at dropdown-item-icon"></i> Email not available</li>
                                        @endif
                                
                                        {{-- <li><i class="bi-phone dropdown-item-icon"></i> +1 (609) 972-22-22</li> --}}
                                        @if(isset($user->address) && isset($user->city) && isset($user->state))
                                            <li><i class="bi-house-door dropdown-item-icon"></i> {{ $user->address }}, {{ $user->city }}, {{ $user->state }}</li>
                                        @else
                                            <li><i class="bi-house-door dropdown-item-icon"></i> Address not available</li>
                                        @endif
                                
                                        <li class="pt-4 pb-0"><span class="card-subtitle">Teams</span></li>
                                        @if(isset($user->account->account_name))
                                            <li><i class="bi-people dropdown-item-icon"></i>{{ $user->account->account_name }}</li>
                                        @else
                                            <li><i class="bi-people dropdown-item-icon"></i> No team assigned.</li>
                                        @endif
                                
                                        <li>
                                            <i class="bi-cassette-fill dropdown-item-icon"></i>
                                            @if($docks->count() > 0)
                                                {{ $docks->count() }} active docks
                                            @else
                                                No active docks.
                                            @endif
                                        </li>
                                
                                        <li>
                                            <p><i class="bi bi-clock-history dropdown-item-icon"></i>Average active session</p>
                                
                                            <!-- Progress -->
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="progress flex-grow-1">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 82%" aria-valuenow="82"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <span class="ms-4">82%</span>
                                            </div>
                                            <!-- End Progress -->
                                        </li>
                                    </ul>
                                </div>
                                
                                
                                <!-- End Body -->
                            </div>
                            <!-- End Card -->

                        </div>

                        <div class="col-lg-8">
                            <div class="d-grid gap-3 gap-lg-5">
                                <!-- Card -->
                                <div class="card">
                                    <!-- Header -->
                                    <div class="card-header card-header-content-between">
                                        <h4 class="card-header-title">Activity stream</h4>

                                      
                                    </div>
                                    <!-- End Header -->

                                    <!-- Body -->
                                    <div class="card-body card-body-height" style="height: 26rem;">
                                        <!-- Step -->
                                        <ul class="step step-icon-xs mb-0">

                                            <!-- Step Item -->
                                            @if ($docklogs->isEmpty())
                                                <div class="text-center p-4">
                                                    <img class="mb-3"
                                                        src="{{ asset('assets/svg/illustrations/oc-error.svg') }}"
                                                        alt="Image Description" style="width: 50%;"
                                                        data-hs-theme-appearance="default">
                                                    <img class="mb-3"
                                                        src="{{ asset('assets/svg/illustrations-light/oc-error.svg') }}"
                                                        alt="Image Description" style="width: 50%;"
                                                        data-hs-theme-appearance="dark">
                                                    <p class="mb-0">No data to show</p>

                                                </div>
                                            @else
                                                @foreach ($docklogs->take(10)  as $docklog)
                                                    <li class="step-item show-hide">
                                                        <div class="step-content-wrapper">
                                                            {{-- <span
                                                                class="step-icon step-icon-pseudo step-icon-soft-dark"></span> --}}


                                                            <span class="step-icon step-icon-pseudo @if ($docklog->description === 'deleted') step-icon-soft-danger @elseif ($docklog->description === 'updated') step-icon-soft-primary text-white @else step-icon-soft-success text-white @endif"></span>

                                                            <div class="step-content">
                                                                <!-- Card -->
                                                                <div class="  bg-light bg-opacity-50  rounded-1 border border-1 @if ($docklog->description === 'deleted') border border-danger  @elseif ($docklog->description === 'updated') border border-primary @else border border-success @endif ">
                                                                  
                                                                   
                                                                    
                                                                    <div class="card-pinned">
                                                                        <span class="card-pinned-top-end">
                                                                            <span class="text-small">
                                                                                <span class="badge @if ($docklog->description === 'deleted') bg-soft-danger text-danger @elseif ($docklog->description === 'updated') bg-primary text-white @else bg-success text-white @endif"
                                                                                    name="event" >
                                                                                    {{ $docklog->description }}
                                                                                </span>
                                                                                <i class="show-hide-icon bi bi-trash-fill text-danger"></i> <!-- Add the delete icon here -->
                                                                                |
                                                                                <span class="text-muted">{{ \Carbon\Carbon::parse($docklog->updated_at)->timezone(Auth::user()->timezone)->diffForHumans() }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                    
                                                                    
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">    
                                                                            <span class="text-dark small ">
                                                                                Dock :
                                                                                @php
                                                                                    // Assuming $docklog->subject_id contains the ID of the dock
                                                                                    $dockId = $docklog->subject_id;
                                                                                    
                                                                                    // Retrieve the dock record from the database
                                                                                    $dock = \App\Models\Dock::find($dockId);
                                                                                @endphp
                                                                                @if ($dock)
                                                                                    {{ $dock->name }}
                                                                                @else
                                                                                    Dock not found
                                                                                @endif
                                                                            </span>

                                                                        </h4>
                                                                        <div class="  justify-content text-black">
                                                                            {{-- show about activity info start --}}
                                                                            <ul class="list-inline">
                                                                                @if ($docklog->description === 'updated')
                                                                                    @php
                                                                                        $properties = json_decode($docklog->properties);
                                                                                        $oldData = $properties->old;
                                                                                        $newData = $properties->attributes;
                                                                                    @endphp
                                                                                    <li class="list-inline-item d-inline-flex align-items-center">
                                                                                        @foreach ($oldData as $field => $value)
                                                                                            {{ $field }} :
                                                                                            {{ $value }}
                                                                                        @endforeach
                                                                                    </li>
                                                                                    <li class="list-inline-item d-inline-flex align-items-center">
                                                                                        <span class="">updated to</span>
                                                                                    </li>
                                                                                    <li class="list-inline-item d-inline-flex align-items-center">
                                                                                        <span class="me-2">
                                                                                            @foreach ($newData as $field => $value)
                                                                                                {{ $field }} :
                                                                                                @if ($value !== null)
                                                                                                    <span class="text-primary">{{ $value }}</span>
                                                                                                @else
                                                                                                    <span class="text-danger">null</span>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </span>
                                                                                    </li>
                                                                                @elseif ($docklog->description === 'deleted')
                                                                                    @php
                                                                                        // Assuming $docklog->causer_id contains the ID of the user
                                                                                        $userId = $docklog->causer_id;
                                                                                        // Retrieve the user record from the database
                                                                                        $user = \App\Models\User::find($userId);
                                                                                    @endphp
                                                                                    @if ($user)
                                                                                        <li class="list-inline-item d-inline-flex align-items-center">
                                                                                            <span class="text-muted small">Deleted by: {{ $user->name }}</span>
                                                                                        </li>
                                                                                    @else
                                                                                        <li class="list-inline-item d-inline-flex align-items-center">
                                                                                            <span class="text-muted small">User not found</span>
                                                                                        </li>
                                                                                    @endif
                                                                                @endif
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    {{-- card footer --}}
                                                                    {{-- <div class="card-pinned mt-2">
                                                                 <span class="card-pinned-bottom-end">
                                                                    <span class="text-muted">{{ \Carbon\Carbon::parse($docklog->updated_at)->timezone(Auth::user()->timezone)->diffForHumans() }}</span>    
                                                                </span>
                                                              </div> --}}
                                                                </div>
                                                                <!-- End Card -->

                                                            </div>
                                                        </div>

                                                    </li>
                                                @endforeach
                                            @endif
                                            <!-- End Step Item -->

                                        </ul>
                                        <!-- End Step -->
                                    </div>
                                    <!-- End Body -->

                                    <!-- Footer -->
                                    <div class="card-footer">
                                        <a class="text-primary"
                                            href="#Viewmore"
                                           >
                                           View more
                                            {{-- <span class="link-collapse-active text-primary">View less</span> --}}
                                        </a>
                                        <!-- Card -->


                                        <!-- End Card -->
                                    </div>
                                    <!-- End Footer -->
                                </div>
                                <!-- End Card -->


                            </div>


                            <!-- Sticky Block End Point -->
                            <div id="stickyBlockEndPoint"></div>
                        </div>
                    </div>

                    <!-- End Row -->
                </div>
                <!-- End Col -->
            </div>
        </div>
        {{-- single user detail page ends --}}
        <!-- Content -->
            <!-- End Row -->
           
     
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h1 class="page-header-title">{{ $user->name }} Activity details</h1>
                    </div>
                    <!-- End Col -->


                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
            <!-- End Page Header -->




            {{-- analytics of 3 strats --}}

            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>



            <div class="container mt-2">
                {{-- <h1>Analytics Dashboard</h1> --}}

                <div class="row">
                    <div class="col-md-6">
                        @if ($user)
                            <h4>{{ $user->name }} Login Locations</h4>
                            <div id="usersLocationChart" style="width: 360px"></div>
                        @else
                        <div class="text-center p-4">
                            <img class="mb-3"
                                src="{{ asset('assets/svg/illustrations/oc-error.svg') }}"
                                alt="Image Description" style="width: 50%;"
                                data-hs-theme-appearance="default">
                            <img class="mb-3"
                                src="{{ asset('assets/svg/illustrations-light/oc-error.svg') }}"
                                alt="Image Description" style="width: 50%;"
                                data-hs-theme-appearance="dark">
                            <p class="mb-0">No data to show</p>

                        </div>
                        @endif
                    </div>
                    
                    {{-- <div class="col-md-4">
                        <h2>Browser Usage</h2>
                        <div id="browserUsageChart"></div>
                    </div> --}}
                    <div class="col-md-6">
                        @if ($user)
                            <h4>{{ $user->name }} Page View & Time Spent</h4>
                            <div id="pageViewChart" style="width: 360px"></div>
                        @else

                        <div class="text-center p-4">
                            <img class="mb-3"
                                src="{{ asset('assets/svg/illustrations/oc-error.svg') }}"
                                alt="Image Description" style="width: 50%;"
                                data-hs-theme-appearance="default">
                            <img class="mb-3"
                                src="{{ asset('assets/svg/illustrations-light/oc-error.svg') }}"
                                alt="Image Description" style="width: 50%;"
                                data-hs-theme-appearance="dark">
                            <p class="mb-0">No data to show</p>

                        </div>
                        @endif
                    </div>
                    
                </div>
                <div id="map" style="width: auto; height: 400px;" class=" mb-5"></div>

                <div class="row">
                    <div class="col-md-12">
                        <h2>{{ $user->name }} Logged in Details</h2>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-success">
                                {{ session('error') }}
                            </div>
                        @endif
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
                                            "pageLength": 10,
                                            "isResponsive": false,
                                            "isShowPaging": false,
                                            "pagination": "datatablePagination"
                                          }'>
                                <thead class="thead-light">
                                    <tr class="hide-in-mobile">
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>IP</th>
                                        <th>Device</th>
                                        {{-- <th>Browser</th> --}}
                                        <th>Login Time</th>
                                        {{-- <th>Action</th> --}}


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loginusers->take(5) as $loginuser)
                                        @php
                                            $user = \App\Models\User::find($loginuser->causer_id);
                                            $loginProperties = json_decode($loginuser->properties);
                                            // $ipAddress = isset($loginProperties->ip_address) ? $loginProperties->ip_address : 'Unknown IP';
                                        @endphp
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $loginProperties->city }},{{ $loginProperties->state }},{{ $loginProperties->country }}
                                            </td>
                                            <td>{{ $loginProperties->ip_address }}</td>
                                            <td>
                                                {{ $loginProperties->device ?? 'No data' }}
                                            </td>

                                            {{-- <td>{{ $loginProperties->user_agent }}</td> --}}
                                            <td>{{ \Carbon\Carbon::parse($loginuser->updated_at)->timezone(Auth::user()->timezone)->format('d M H:i A') }}
                                            </td>



                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>



                <script>
                    @php
                        $loginStates = []; // Initialize an array to store state names and their counts
                        $deviceCounts = []; // Initialize an empty array to store device names and their counts
                    @endphp

                    @foreach ($loginusers as $loginuser)
                        @php
                            $loginProperties = json_decode($loginuser->properties);
                            $state = $loginProperties->state;
                            $country = $loginProperties->country;
                            $device = $loginProperties->device;
                        @endphp

                        @if (!empty($state) && $country === 'US')
                            {{-- Check if state is not empty and country is 'US' --}}
                            @if (isset($loginStates[$state]))
                                @php
                                    $loginStates[$state] += 1; // Increment count if state already exists in the array
                                @endphp
                            @else
                                @php
                                    $loginStates[$state] = 1; // Initialize count if state is encountered for the first time
                                @endphp
                            @endif
                        @endif

                        @if (!empty($device))
                            @if (isset($deviceCounts[$device]))
                                @php
                                    $deviceCounts[$device] += 1; // Increment count if device already exists in the array
                                @endphp
                            @else
                                @php
                                    $deviceCounts[$device] = 1; // Initialize count if device is encountered for the first time
                                @endphp
                            @endif
                        @endif
                    @endforeach

                    // Sample data for charts and all data
                    const usersLocationData = {
                        labels: [
                            @foreach ($loginStates as $state => $count)
                                '{{ $state }}',
                            @endforeach
                        ],
                        series: [
                            @foreach ($loginStates as $state => $count)
                                {{ $count }},
                            @endforeach
                        ]
                    };

                    const browserUsageData = {
                        labels: [
                            @foreach ($deviceCounts as $device => $count)
                                '{{ $device }}',
                            @endforeach
                        ],
                        series: [
                            @foreach ($deviceCounts as $device => $count)
                                {{ $count }},
                            @endforeach
                        ]
                    };

                    const pageViewData = {
                        labels: ['Page 1', 'Page 2', 'Page 3'],
                        series: [40, 30, 30]
                    };

                    // const allData = [
                    //   @foreach ($loginusers as $loginuser)

                    //   { userId: '{{ $loginuser->causer_id }}', location: 'Location A', browser: 'Chrome', loginTime: '2023-06-29 09:00:00', logoutTime: '2023-06-29 09:30:00', pageView: 'Page 1', timeSpent: '30 minutes', status: 'Inactive' },
                    //   @endforeach

                    // ];

                    // Render users location chart
                    const usersLocationChart = new ApexCharts(document.querySelector("#usersLocationChart"), {
                        chart: {
                            type: 'donut'
                        },
                        series: usersLocationData.series,
                        labels: usersLocationData.labels,
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: {
                                    width: 200
                                },
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }]
                    });
                    usersLocationChart.render();

                    // Render browser usage chart
                    const browserUsageChart = new ApexCharts(document.querySelector("#browserUsageChart"), {
                        chart: {
                            type: 'pie'
                        },
                        series: browserUsageData.series,
                        labels: browserUsageData.labels,
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: {
                                    width: 200
                                },
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }]
                    });
                    browserUsageChart.render();

                    // Render page view chart
                    const pageViewChart = new ApexCharts(document.querySelector("#pageViewChart"), {
                        chart: {
                            type: 'bar'
                        },
                        series: [{
                            name: 'Views',
                            data: pageViewData.series
                        }],
                        xaxis: {
                            categories: pageViewData.labels
                        }
                    });
                    pageViewChart.render();

                    // Display all data
                    const allDataTable = document.getElementById("allData");
                    allData.forEach(data => {
                        const row = document.createElement("tr");
                        row.innerHTML =
                            `<td>${data.userId}</td><td>${data.location}</td><td>${data.browser}</td><td>${data.loginTime}</td><td>${data.logoutTime}</td><td>${data.pageView}</td><td>${data.timeSpent}</td><td>${data.status}</td>`;
                        allDataTable.appendChild(row);
                    });
                </script> {{-- analytics of 3 ends --}}

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
                <script src="https://www.gstatic.com/charts/loader.js"></script>
                <script>
                    google.charts.load('current', {
                        'packages': ['geochart']
                    });
                    google.charts.setOnLoadCallback(drawMap);

                    function drawMap() {
                        // Dummy data for customer locations and demographics
                        var customerData = [
                            ['State', 'Users'],
                            @foreach ($loginStates as $state => $count)
                                ['{{ $state }}', {{ $count }}],
                            @endforeach
                        ];

                        // Create the data table
                        var data = google.visualization.arrayToDataTable(customerData);

                        // Set chart options
                        var options = {
                            region: 'US',
                            resolution: 'provinces',
                            colorAxis: {
                                colors: ['#87CEEB', '#0000FF']
                            },
                            backgroundColor: '#f7f7f7',
                            datalessRegionColor: '#cccccc',
                            defaultColor: '#87CEEB', // Set the default color to sky blue
                            tooltip: {
                                textStyle: {
                                    color: '#444444'
                                }
                            }
                        };

                        // Instantiate and draw the chart
                        var chart = new google.visualization.GeoChart(document.getElementById('map'));

                        // Event listener for hover over state
                        google.visualization.events.addListener(chart, 'onmouseover', function(e) {
                            var stateName = data.getValue(e.row, 0);
                            var stateCustomers = data.getValue(e.row, 1);
                            console.log(stateName + ': ' + stateCustomers + ' customers'); // Replace with your desired logic
                        });

                        chart.draw(data, options);
                    }
                </script>

                {{-- all data table starts --}}
                <!-- Card -->

                <!-- End Card -->
                {{-- all data table ends --}}

                {{-- user details starts --}}
                <div class="card">
                    {{-- header --}}
                    <div class="card-header card-header-content-between " >
                        <h4 class="card-header-title" id="Viewmore"> 
                            @if ($user)
                            {{ $user->name }}
                        
                        @endif Activity Stream</h4>
                        
                     


                          
                               <!-- Dropdown -->
                        <div class="dropdown">
                            <!-- Select Filter -->
                                <select class="form-select" id="actionFilter">
                                    <option value="all" selected>All Actions</option>
                                    <option value="created">Created</option>
                                    <option value="updated">Updated</option>
                                    <option value="deleted">Deleted</option>
                                </select>
                                <!-- End Select Filter -->
                           
                            </div>
                        
                        <!-- End Dropdown -->
                    </div>
                    {{-- header end --}}
                    <div class="card-body">
                        @php
                            use Carbon\Carbon;
                            // Assuming you have already imported the Carbon class at the top of your file.
                        @endphp

                        @foreach ($docklogs->take(10) as $docklog)
                            @php
                                // Assuming $docklog->causer_id contains the ID of the user
                                $userId = $docklog->causer_id;
                                // Retrieve the user record from the database
                                $user = \App\Models\User::find($userId);
                                
                                // Assuming $docklog->subject_id contains the ID of the dock
                                $dockId = $docklog->subject_id;
                                // Retrieve the dock record from the database
                                $dock = \App\Models\Dock::find($dockId);
                                
                                // Get the action label based on the description
                                $actionLabel = '';
            switch ($docklog->description) {
                case 'updated':
                    $actionLabel = 'Updated';
                    break;
                case 'deleted':
                    $actionLabel = 'Deleted';
                    break;
                case 'created':
                    $actionLabel = 'Created';
                    break;
            }
                                // Get the dock name from the properties column
                                $properties = json_decode($docklog->properties, true);
                                $dockName = $properties['attributes']['name'] ?? '';
                                // Get the old dock name if available for 'updated' action
                                $oldDockName = $properties['old']['name'] ?? '';
                            @endphp

                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3 me-lg-4 mt-1">
                                    <div>
                                        <span class="legend-indicator @if ($docklog->description === 'deleted')  bg-danger @elseif ($docklog->description === 'updated') bg-primary @else bg-success  @endif "> </span>
                                        
                                        {{-- @if ($user)
                                            {{ $user->name }}
                                        @else
                                            User not found
                                        @endif --}}

                                        </div>
                                </div>

                                <div class="flex-grow-1 ms-3">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <div class="text-dark h4">
                                                <span class="badge h5
                                                @if ($docklog->description === 'deleted')
                                                    bg-soft-danger text-danger
                                                @elseif ($docklog->description === 'updated')
                                                    bg-primary text-white
                                                @elseif ($docklog->description === 'created')
                                                    bg-success text-white
                                                @endif"
                                                name="event"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user->name }}">
                                                    {{ $actionLabel }}
                                                </span>
                                                @if ($docklog->description === 'updated')
                                                    <span class="">
                                                        @if ($dock)
                                                        <span class="text-dark small">   {{ $dock->name }} </span>
                                                        @else
                                                        <span class="text-muted small">      Dock not found</span>
                                                        @endif
                                                        from {{ $oldDockName }} to {{ $dockName }}
                                                    </span>
                                                @else
                                                    <span class="">
                                                        @if ($dock)
                                                        <span class="text-dark small">   {{ $dock->name }} </span>
                                                        @else
                                                        <span class="text-muted small">      Dock not found</span>
                                                        @endif
                                                        {{ $dockName }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-3  d-md-flex justify-content-md-end ms-n3">
                                            <p class="text-muted">   @php
                                                // Format the updated_at timestamp using Carbon
                                                $updatedAt = Carbon::parse($docklog->updated_at);
                                                $formattedUpdatedAt = $updatedAt->diffForHumans();
                                            @endphp
                                          <i class="bi bi-trash-fill text-danger"></i><span class="mx-2">|</span>{{ $formattedUpdatedAt }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="divider-end text-body mb-3"></span>
                            
                        @endforeach
                        {{ $docklogs->links() }}

                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const actionFilter = document.getElementById('actionFilter');
                            actionFilter.addEventListener('change', function () {
                                const selectedValue = this.value;
                                const currentURL = new URL(window.location.href);
                                currentURL.searchParams.set('filter', selectedValue);
                    
                                // Check if the URL already contains an anchor, and remove it
                                if (currentURL.hash) {
                                    currentURL.hash = '';
                                }
                    
                                currentURL.hash = 'Viewmore'; // Set the anchor
                    
                                window.location.href = currentURL.href;
                            });
                        });
                    </script>
                    
                    
                    
                </div>

                {{-- user details ends --}}

    </main>
@endsection
