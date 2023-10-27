@extends('layouts.app1')


@section('content')
<style>

    @media (max-width: 576px) {

    
        tr.hide-in-mobile {

            display: none;

        }


    }
    .nowrap-td {

        white-space: nowrap;

    }

</style>

    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h1 class="page-header-title">Application Analytics</h1>
                    </div>
                    <!-- End Col -->


                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
            <!-- End Page Header -->

            <!-- Stats -->
            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="#">
                        <div class="card-body">
                            <h6 class="card-subtitle">Total Users Logged in</h6>

                            <div class="row align-items-center gx-2 mb-1">
                                <div class="col-6">
                                    <h2 class="card-title text-inherit">{{ $loginusers->count() }}</h2>

                                </div>
                                <!-- End Col -->

                                <div class="col-6">
                                    <!-- Chart -->
                                    <div class="chartjs-custom" style="height: 3rem;">
                                        <canvas class="js-chart"
                                            data-hs-chartjs-options="{
                           type :  line ,
                           data : {
                              labels : [ 1 May , 2 May , 3 May , 4 May , 5 May , 6 May , 7 May , 8 May , 9 May , 10 May , 11 May , 12 May , 13 May , 14 May , 15 May , 16 May , 17 May , 18 May , 19 May , 20 May , 21 May , 22 May , 23 May , 24 May , 25 May , 26 May , 27 May , 28 May , 29 May , 30 May , 31 May ],
                              datasets : [{
                               data : [21,20,24,20,18,17,15,17,18,30,31,30,30,35,25,35,35,40,60,90,90,90,85,70,75,70,30,30,30,50,72],
                               backgroundColor : [ rgba(55, 125, 255, 0) ,  rgba(255, 255, 255, 0) ],
                               borderColor :  #377dff ,
                               borderWidth : 2,
                               pointRadius : 0,
                               pointHoverRadius : 0
                            }]
                          },
                           options : {
                              scales : {
                                y : {
                                  display : false
                               },
                                x : {
                                  display : false
                               }
                             },
                             hover : {
                               mode :  nearest ,
                               intersect : false
                            },
                             plugins : {
                               tooltip : {
                                 postfix :  k ,
                                 hasIndicator : true,
                                 intersect : false
                              }
                            }
                          }
                        }"
                                            width="202" height="96"
                                            style="display: block; box-sizing: border-box; height: 48px; width: 101px;">
                                        </canvas>
                                    </div>
                                    <!-- End Chart -->
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->

                            <span class="text-body fs-6 ms-1">from {{ $totalUsers }}</span>
                        </div>
                    </a>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="#">
                        <div class="card-body">
                            <h6 class="card-subtitle">Total Logged in User</h6>
                            @php
                                $percentage = ($loginusers->count() / $totalUsers) * 100;
                            @endphp
                            <div class="row align-items-center gx-2 mb-1">
                                <div class="col-6">
                                    <h2 class="card-title text-inherit">{{ number_format($percentage, 1) }}%</h2>
                                </div>
                                <!-- End Col -->

                                <div class="col-6">
                                    <!-- Chart -->
                                    <div class="chartjs-custom" style="height: 3rem;">
                                        <canvas class="js-chart"
                                            data-hs-chartjs-options="{
                           type :  line ,
                           data : {
                              labels : [ 1 May , 2 May , 3 May , 4 May , 5 May , 6 May , 7 May , 8 May , 9 May , 10 May , 11 May , 12 May , 13 May , 14 May , 15 May , 16 May , 17 May , 18 May , 19 May , 20 May , 21 May , 22 May , 23 May , 24 May , 25 May , 26 May , 27 May , 28 May , 29 May , 30 May , 31 May ],
                              datasets : [{
                               data : [21,20,24,20,18,17,15,17,30,30,35,25,18,30,31,35,35,90,90,90,85,100,120,120,120,100,90,75,75,75,90],
                               backgroundColor : [ rgba(55, 125, 255, 0) ,  rgba(255, 255, 255, 0) ],
                               borderColor :  #377dff ,
                               borderWidth : 2,
                               pointRadius : 0,
                               pointHoverRadius : 0
                            }]
                          },
                           options : {
                              scales : {
                                y : {
                                  display : false
                               },
                                x : {
                                  display : false
                               }
                             },
                             hover : {
                               mode :  nearest ,
                               intersect : false
                            },
                             plugins : {
                               tooltip : {
                                 postfix :  k ,
                                 hasIndicator : true,
                                 intersect : false
                              }
                            }
                          }
                        }"
                                            width="202" height="96"
                                            style="display: block; box-sizing: border-box; height: 48px; width: 101px;">
                                        </canvas>
                                    </div>
                                    <!-- End Chart -->
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->

                           
                            <span class="text-body fs-6 ms-1">from {{ $totalUsers }}</span>
                        </div>
                    </a>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="#">
                        <div class="card-body">
                            <h6 class="card-subtitle">Total active docks</h6>

                            <div class="row align-items-center gx-2 mb-1">
                                <div class="col-6">
                                    <h2 class="card-title text-inherit">{{ $totalActiveDocks }}</h2>
                                </div>
                                <!-- End Col -->

                                <div class="col-6">
                                    <!-- Chart -->
                                    <div class="chartjs-custom" style="height: 3rem;">
                                        <canvas class="js-chart"
                                            data-hs-chartjs-options="{
                           type :  line ,
                           data : {
                              labels : [ 1 May , 2 May , 3 May , 4 May , 5 May , 6 May , 7 May , 8 May , 9 May , 10 May , 11 May , 12 May , 13 May , 14 May , 15 May , 16 May , 17 May , 18 May , 19 May , 20 May , 21 May , 22 May , 23 May , 24 May , 25 May , 26 May , 27 May , 28 May , 29 May , 30 May , 31 May ],
                              datasets : [{
                               data : [25,18,30,31,35,35,60,60,60,75,21,20,24,20,18,17,15,17,30,120,120,120,100,90,75,90,90,90,75,70,60],
                               backgroundColor : [ rgba(55, 125, 255, 0) ,  rgba(255, 255, 255, 0) ],
                               borderColor :  #377dff ,
                               borderWidth : 2,
                               pointRadius : 0,
                               pointHoverRadius : 0
                            }]
                          },
                           options : {
                              scales : {
                                y : {
                                  display : false
                               },
                                x : {
                                  display : false
                               }
                             },
                             hover : {
                               mode :  nearest ,
                               intersect : false
                            },
                             plugins : {
                               tooltip : {
                                 postfix :  k ,
                                 hasIndicator : true,
                                 intersect : false
                              }
                            }
                          }
                        }"
                                            width="202" height="96"
                                            style="display: block; box-sizing: border-box; height: 48px; width: 101px;">
                                        </canvas>
                                    </div>
                                    <!-- End Chart -->
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->

                          
                            <span class="text-body fs-6 ms-1">from {{$totalDocks}}</span>
                        </div>
                    </a>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="#">
                        <div class="card-body">
                            <h6 class="card-subtitle">Avg. session duration</h6>

                            <div class="row align-items-center gx-2 mb-1">
                                <div class="col-6">
                                    <h2 class="card-title text-inherit">92,913</h2>
                                </div>
                                <!-- End Col -->

                                <div class="col-6">
                                    <!-- Chart -->
                                    <div class="chartjs-custom" style="height: 3rem;">
                                        <canvas class="js-chart"
                                            data-hs-chartjs-options="{
                           type :  line ,
                           data : {
                              labels : [ 1 May , 2 May , 3 May , 4 May , 5 May , 6 May , 7 May , 8 May , 9 May , 10 May , 11 May , 12 May , 13 May , 14 May , 15 May , 16 May , 17 May , 18 May , 19 May , 20 May , 21  May , 22 May , 23 May , 24 May , 25 May , 26 May , 27 May , 28 May , 29 May , 30 May , 31 May ],
                              datasets : [{
                               data : [21,20,24,15,17,30,30,35,35,35,40,60,12,90,90,85,70,75,43,75,90,22,120,120,90,85,100,92,92,92,92],
                               backgroundColor : [ rgba(55, 125, 255, 0) ,  rgba(255, 255, 255, 0) ],
                               borderColor :  #377dff ,
                               borderWidth : 2,
                               pointRadius : 0,
                               pointHoverRadius : 0
                            }]
                          },
                           options : {
                              scales : {
                                y : {
                                  display : false
                               },
                                x : {
                                  display : false
                               }
                             },
                             hover : {
                               mode :  nearest ,
                               intersect : false
                            },
                             plugins : {
                               tooltip : {
                                 postfix :  k ,
                                 hasIndicator : true,
                                 intersect : false
                              }
                            }
                          }
                        }"
                                            width="202" height="96"
                                            style="display: block; box-sizing: border-box; height: 48px; width: 101px;">
                                        </canvas>
                                    </div>
                                    <!-- End Chart -->
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->

                            <span class="badge bg-soft-secondary text-body">0.0%</span>
                            <span class="text-body fs-6 ms-1">from 2,913</span>
                        </div>
                    </a>
                    <!-- End Card -->
                </div>
            </div>
            <!-- End Stats -->


            {{-- analytics of 3 strats --}}

            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>



            <div class="container mt-2">
                {{-- <h1>Analytics Dashboard</h1> --}}

                <div class="row">
                    <div class="col-md-4">
                        <h2>Users Location</h2>
                        <div id="usersLocationChart"></div>
                    </div>
                    <div class="col-md-4">
                        <h2>Browser Usage</h2>
                        <div id="browserUsageChart"></div>
                    </div>
                    <div class="col-md-4">
                        <h2>Page View & Time Spent</h2>
                        <div id="pageViewChart"></div>
                    </div>
                </div>
                <div id="map" style="width: auto; height: 400px;" class=" mb-5"></div>

                <div class="row">
                  <div class="col-md-12">
                      <h2>Logged in Users</h2>
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
                                      <th>Action</th>


                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($loginusers as $loginuser)
                                      @php
                                          $user = \App\Models\User::find($loginuser->causer_id);
                                          $loginProperties = json_decode($loginuser->properties);
                                          // $ipAddress = isset($loginProperties->ip_address) ? $loginProperties->ip_address : 'Unknown IP';
                                      @endphp
                                      <tr>
                                        <td>{{ $user->name ?? 'Unknown User' }}</td>
                                          <td>{{ $loginProperties->city }},{{ $loginProperties->state }},{{ $loginProperties->country }}
                                          </td>
                                          <td>{{ $loginProperties->ip_address }}</td>
                                          <td>
                                              {{ $loginProperties->device ?? 'No data' }}
                                          </td>

                                          {{-- <td>{{ $loginProperties->user_agent }}</td> --}}
                                          <td>{{ \Carbon\Carbon::parse($loginuser->updated_at)->timezone(Auth::user()->timezone)->format('d M H:i A') }}
                                          </td>
                                          <td class="nowrap-td">  @if ($user)
                                            <a class="btn btn-white btn-sm" href="{{ route('user_activity.show', $user->id) }}">
                                                <i class="bi-gear me-1"></i>View User logs
                                            </a>
                                        @else
                                            <span>User not found</span>
                                        @endif
                                              {{-- model start --}}





                                              {{-- model end --}}

                                              <!-- Button to trigger the modal -->
<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalCenterdelete{{$loginuser->id}}">
    <i class="bi-trash me-1"></i> Delete
</button>

<!-- Modal -->
<div id="exampleModalCenterdelete{{$loginuser->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content text-center">
            <div class="modal-body">
                <p class="text-dark">Do you really want to delete this record?<br>This process cannot be undone.</p>
                <button type="button" class="btn btn-soft-dark mx-4" data-bs-dismiss="modal">Cancel</button>
                <!-- Form to handle the delete action -->
                <form method="POST" action="{{ route('user_activity.destroy', $loginuser->id) }}" style="display:inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-soft-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

                                              {{-- <form method="POST" action="{{ route('force_logout', $user->id) }}" style="display:inline">
                                              @csrf
                                              <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="bi-box-arrow-right me-1"></i> Logout
                                              </button>
                                            </form> --}}
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

            
    </main>
@endsection
