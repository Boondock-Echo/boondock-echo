@extends('layouts.app1')
<script src="https://unpkg.com/wavesurfer.js@beta"></script>
<script src="https://unpkg.com/wavesurfer.js@beta/dist/plugins/timeline.js"></script>
<style>
    #timeline-wrapper {
        position: relative;
    }

    #play-pause-button {
        background: none;
        border: none;
        cursor: pointer;
        padding: 5px;
        display: flex;
        align-items: center;
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
    }

    #play-pause-button i {
        font-size: 20px;
    }

    #waveform {
        margin-left: 40px;
        overflow-x: auto;
        white-space: nowrap;

    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">

            <!-- Stats -->
            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Received</h6>

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

                                <div class="col-auto">
                                    <span class="icon icon-xlg ">
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>


                                    {{-- <span class="badge bg-soft-success text-success p-1">
                                        {{ request('date_range') == 'today' ? 'Today' : '' }}
                                        {{ request('date_range') == '7_days' ? 'Last 7 Days' : '' }}
                                        {{ request('date_range') == '30_days' ? 'Last 30 Days' : '' }}
                                        {{ request('date_range') == '60_days' ? 'Last 60 Days' : '' }}
                                        {{ request('date_range') == 'all' ? 'Everything' : '' }}

                                        @if (!empty($dockNameFilter))
                                            from {{ $dockNameFilter }}
                                        @else
                                            From All docks
                                        @endif
                                    </span> --}}
                                </div>
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
                            <h6 class="card-subtitle mb-2">Sent</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span class="js-counter display-4 text-dark">{{ $sentfile }}</span>
                                    <span class="text-body fs-5 ms-1">from {{ $totalaudioFiles }}</span>
                                </div>

                                <div class="col-auto">
                                    <span class="icon icon-xlg">
                                        <i class="fa-solid fa-paper-plane"></i>
                                    </span>
                                    {{-- <span class="badge bg-soft-success text-success p-1">
                                        {{ request('date_range') == 'today' ? 'Today' : '' }}
                                        {{ request('date_range') == '7_days' ? 'Last 7 Days' : '' }}
                                        {{ request('date_range') == '30_days' ? 'Last 30 Days' : '' }}
                                        {{ request('date_range') == '60_days' ? 'Last 60 Days' : '' }}
                                        {{ request('date_range') == 'all' ? 'Everything' : '' }}

                                        @if (!empty($dockNameFilter))
                                            from {{ $dockNameFilter }}
                                        @else
                                            From All docks
                                        @endif
                                    </span> --}}
                                </div>
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
                            <h6 class="card-subtitle mb-2">Online</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span class="js-counter display-4 text-dark">
                                        {{ $totalActiveDocks }}
                                    </span>
                                    <span class="text-body fs-5 ms-1">from {{ $totalDocks }}</span>
                                </div>
                                <!-- End Col -->
                                <div class="col-auto">
                                    <span class="icon icon-xlg ">
                                        <i>
                                            <img src="{{ asset('assets/img/front/dock1.png') }}" alt="Icon"
                                                style="width: 32px; height: 32px;">
                                        </i>
                                        {{-- <i class="fa-solid fa-walkie-talkie"></i> --}}
                                    </span>
                                </div>

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
                            <h6 class="card-subtitle mb-2">Activity</h6>

                            <div class="row align-items-center gx-2">
                                <script>
                                    const authUserId = "{{ Auth::user()->id }}";
                                </script>
                                <div id="message-container">Welcome {{ Auth::user()->name }}!</div>






                                <!-- Add an HTML element to display the response message -->




                                <!-- End Col -->


                                <!-- End Col -->
                            </div>
                            <!-- End Row -->
                        </div>
                    </div>
                    <!-- End Card -->
                </div>

                <!-- End Stats -->







            </div>


            <div class="card">
                <div class="card-header card-header-content-md-between">
                    <div class="mb-2 mb-md-0">

                        {{-- <form>
                            <!-- Search -->
                            <div class="input-group input-group-merge input-group-flush">
                                <div class="input-group-prepend input-group-text">
                                    <i class="bi-search"></i>
                                </div>
                                <input id="datatableSearch" type="search" class="form-control"
                                    placeholder="Search Messages" aria-label="Search Messages">
                            </div>
                            <!-- End Search -->
                        </form> --}}
                    </div>
                   
                    <div class="d-grid d-sm-flex justify-content-md-end align-items-sm-center gap-2">
                        <!-- Datatable Info -->
                        <div id="datatableCounterInfo" style="display: none;">
                            <div class="d-flex align-items-center">
                                <span class="fs-5 me-3">
                                    <span id="datatableCounter">0</span>
                                    Selected
                                </span>
                                <button type="button" class="btn btn-outline-danger" id="deleteSelectedBtn">
                                    Delete selected audio files
                                </button>
                            </div>
                        </div>
                        <!-- End Datatable Info -->

                        <!-- export -->

                        <!-- End Dropdown -->

                        <!-- filter -->
                        <label>
                            <input type="checkbox" checked="${loop}" />
                            Loop regions on click
                        </label>
    
                        <label style="margin-left: 2em">
                            Zoom: <input type="range" min="10" max="1000" value="10" />
                        </label>


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
                                        <h5 class="card-header-title">Filter Docks</h5>

                                        <!-- Toggle Button -->
                                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm ms-2">
                                            <i class="bi-x-lg"></i>
                                        </button>
                                        <!-- End Toggle Button -->
                                    </div>

                                    <div class="card-body">



                                        <form class="form-inline my-2 my-lg-0 mb-4" method="GET"
                                            action="{{ route('timeline.index', ['filter' => true]) }}">
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
                                                    <option class="option" value="500"
                                                        {{ $per_page == 500 ? 'selected' : '' }}>500</option>
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
                                            <div class="form-group mr-2">

                                                <span class="dropdown-header">Filter by date:</span>
                                                <select
                                                    class="form-select form-select-sm focus input-active dropdown-active"
                                                    name="date_range" id="date_range">
                                                    <option value="today"
                                                        {{ request('date_range') == 'today' ? 'selected' : '' }}>Today
                                                    </option>
                                                    <option value="7_days"
                                                        {{ request('date_range') == '7_days' ? 'selected' : '' }}>Last
                                                        7
                                                        days</option>
                                                    <option value="30_days"
                                                        {{ request('date_range') == '30_days' ? 'selected' : '' }}>Last
                                                        30
                                                        days</option>
                                                    <option value="60_days"
                                                        {{ request('date_range') == '60_days' ? 'selected' : '' }}>Last
                                                        60
                                                        days</option>
                                                    <option value="all"
                                                        {{ request('date_range') == 'all' ? 'selected' : '' }}>
                                                        Everything
                                                    </option>
                                                </select>
                                            </div>
                                            <input type="hidden" name="page"
                                                value="{{ $audioFiles->currentPage() }}">
                                            <div class="d-grid mt-4">
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

                <script>
                    const audioPath1 = "{{ url('/proxy-audio') }}";
                  
                </script>
              <div class="card-body">
             
              <div id="waveform-container"></div>

              </div>
                
                <script type="module">
                        // Regions plugin

                import WaveSurfer from 'https://unpkg.com/wavesurfer.js@beta'
                import RegionsPlugin from 'https://unpkg.com/wavesurfer.js@beta/dist/plugins/regions.js'
                import TimelinePlugin from 'https://unpkg.com/wavesurfer.js@beta/dist/plugins/timeline.js'
                import Minimap from 'https://unpkg.com/wavesurfer.js@beta/dist/plugins/minimap.js'

//                 const topTimeline = TimelinePlugin.create({
//   height: 40,
//   insertPosition: 'beforebegin',
//   timeInterval: 0.2,
//   primaryLabelInterval: 5,
//   secondaryLabelInterval: 1,
//   style: {
//     fontSize: '20px',
//     color: '#2D5B88',
//   },
// })
const minimap =  Minimap.create({
      height: 45,
      waveColor: '#999',
      progressColor: '#636161',
      // the Minimap takes all the same options as the WaveSurfer itself
    })
// Create a second timeline
const bottomTimline = TimelinePlugin.create({
  height: 20,
  timeInterval: 0.1,
  primaryLabelInterval: 1,
  style: {
    fontSize: '10px',
    color: '#6A3274',
  },
})


                // Create an instance of WaveSurfer
                const ws = WaveSurfer.create({
                container: document.querySelector('#waveform-container'),
                waveColor: 'rgb(200, 0, 200)',
                progressColor: 'rgb(100, 0, 100)',
                url: audioPath1,
                plugins: [bottomTimline , minimap],
                hideScrollbar: true,
                // autoCenter: false,
                })

                // ws.registerPlugin(TimelinePlugin.create())
                // Initialize the Regions plugin
                const wsRegions = ws.registerPlugin(RegionsPlugin.create())

                // Give regions a random color when they are created
                const random = (min, max) => Math.random() * (max - min) + min
                const randomColor = () => `rgba(${random(0, 255)}, ${random(0, 255)}, ${random(0, 255)}, 0.5)`

                // Function to extract silence regions
    const extractRegions = (audioData, duration) => {
        const minValue = 0.01
        const minSilenceDuration = 0.5
        const mergeDuration = 0.2
        const scale = duration / audioData.length
        const silentRegions = []

        // Find all silent regions longer than minSilenceDuration
        let start = 0
        let end = 0
        let isSilent = false
        for (let i = 0; i < audioData.length; i++) {
            if (audioData[i] < minValue) {
                if (!isSilent) {
                    start = i
                    isSilent = true
                }
            } else if (isSilent) {
                end = i
                isSilent = false
                if (scale * (end - start) > minSilenceDuration) {
                    silentRegions.push({
                        start: scale * start,
                        end: scale * end,
                    })
                }
            }
        }

        // Merge silent regions that are close together
        const mergedRegions = []
        let lastRegion = null
        for (let i = 0; i < silentRegions.length; i++) {
            if (lastRegion && silentRegions[i].start - lastRegion.end < mergeDuration) {
                lastRegion.end = silentRegions[i].end
            } else {
                lastRegion = silentRegions[i]
                mergedRegions.push(lastRegion)
            }
        }

        // Find regions that are not silent
        const regions = []
        let lastEnd = 0
        for (let i = 0; i < mergedRegions.length; i++) {
            regions.push({
                start: lastEnd,
                end: mergedRegions[i].start,
            })
            lastEnd = mergedRegions[i].end
        }

        return regions
    }

    // Create regions for each non-silent part of the audio
    ws.on('decode', (duration) => {
        const decodedData = ws.getDecodedData()
        if (decodedData) {
            const regions = extractRegions(decodedData.getChannelData(0), duration)

            // Add regions to the waveform
            regions.forEach((region, index) => {
                wsRegions.addRegion({
                    start: region.start,
                    end: region.end,
                    content: index.toString(),
                    drag: false,
                    resize: false,
                })
            })
        }
    })
                // Create some regions at specific time ranges
                ws.on('decode', () => {
                // Regions
                // wsRegions.addRegion({
                //     start: 4,
                //     end: 7,
                //     content: 'Custom region',
                //     color: randomColor(),
                // })
                // wsRegions.addRegion({
                //     start: 9,
                //     end: 15,
                //     content: 'Middle region',
                //     color: randomColor(),
                // })
                // wsRegions.addRegion({
                //     start: 12,
                //     end: 17,
                //     content: 'Last region',
                //     color: randomColor(),
                // })

                // Markers (zero-length regions)
                // wsRegions.addRegion({
                //     start: 19,
                //     content: 'Marker',
                //     color: randomColor(),
                // })
                // wsRegions.addRegion({
                //     start: 20,
                //     content: 'Second marker',
                //     color: randomColor(),
                // })
                })

                wsRegions.enableDragSelection({
                color: 'rgba(255, 0, 0, 0.1)',
                })

                wsRegions.on('region-updated', (region) => {
                console.log('Updated region', region)
                })

                // Loop a region on click
                let loop = true
                let activeRegion = null

                wsRegions.on('region-clicked', (region, e) => {
                e.stopPropagation() // prevent triggering a click on the waveform
                activeRegion = region
                region.play()
                region.setOptions({ color: randomColor() })
                })

                // Track the time
                ws.on('timeupdate', (currentTime) => {
                // When the end of the region is reached
                if (activeRegion && ws.isPlaying() && currentTime >= activeRegion.end) {
                    if (loop) {
                    // If looping, jump to the start of the region
                    ws.setTime(activeRegion.start)
                    } else {
                    // Otherwise, exit the region
                    activeRegion = null
                    }
                }
                })

                ws.on('interaction', () => (activeRegion = null))

                document.querySelector('input[type="checkbox"]').onclick = (e) => {
  loop = e.target.checked
}

// Update the zoom level on slider change
ws.once('decode', () => {
  document.querySelector('input[type="range"]').oninput = (e) => {
    const minPxPerSec = Number(e.target.value)
    ws.zoom(minPxPerSec)
  }
})

                     
    // Toggle looping with a checkbox
    document.querySelector('input[type="checkbox"]').onclick = (e) => {
        loop = e.target.checked
    }

    const playButton = document.querySelector('#play-button');
const pauseButton = document.querySelector('#pause-button');

// Play button click event
playButton.addEventListener('click', () => {
    ws.play();
    playButton.disabled = true;
    pauseButton.disabled = false;
});

// Pause button click event
pauseButton.addEventListener('click', () => {
    ws.pause();
    pauseButton.disabled = true;
    playButton.disabled = false;
});

// Enable/disable buttons based on the playback state
ws.on('play', () => {
    playButton.disabled = true;
    pauseButton.disabled = false;
});

ws.on('pause', () => {
    pauseButton.disabled = true;
    playButton.disabled = false;
});
</script>

                {{-- <div style="margin-bottom: 2em">
                    <label>
                        <input type="checkbox" checked="${loop}" />
                        Loop regions on click
                    </label>

                    <label style="margin-left: 2em">
                        Zoom: <input type="range" min="10" max="1000" value="10" />
                    </label>
                </div> --}}


               

                {{-- <script src="main.mjs" type="module"></script> --}}
                <!-- Footer -->
                <div class="card-footer">
                    <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                        <div class="col-sm mb-2 mb-sm-0 text-center">
                            <div id="waveform-controls">
                                <button id="play-button" class="btn btn-primary btn-icon" ><i class="fa fa-play"></i></button>
                                <button id="pause-button" class="btn btn-primary btn-icon" disabled><i class="fa fa-pause"></i></button>
                            </div>
                        </div>
                
                     
                    </div>
                    <!-- End Row -->
                
                    <div class="col-sm-auto">
                        <div class="d-flex justify-content-center justify-content-sm-end">
                            <!-- Pagination -->
                            <nav id="datatablePagination" aria-label="Activity pagination"></nav>
                        </div>
                    </div>
                    <!-- End Col -->
                </div>
                
                <!-- End Row -->
                {{-- {!! $audioFiles->appends(['per_page' => $per_page])->render() !!} --}}
            </div>


    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js"></script>


    <script src="{{ asset('js/mqtt-subscribe.js') }}"></script>
@endsection
