@extends('layouts.app1')

@section('content')
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="main">
        <div class="container px-lg-3 px-2 mb-3">
            <div class="row  mt-2">
                <div class="col-lg-5 col-md-10 mb-2 col-sm-12">
                <div class="row">
                    <div class="col-lg-12 col-md-10 col-sm-12">
                        <div class="input-group">
                            <input type="text" id="search-input" class="form-control border-dark border-1 border"
                                placeholder="Search an address, state, zip..." />
                            <button id="locate-button" class="btn btn-ghost-primary btn-sm" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Near Me">
                                <img class="avatar avatar-xs avatar-4x3" src="assets/img/front/user.png" alt="user location">
                            </button>
                        </div>
                    </div>
                </div>
               </div>
                <div class="col-lg-4 ">
                    <form class="" method="GET" action="{{ route('explore.index', ['filter' => true]) }}">
                        <div class="row  mb-2">
                            <div class=" col-lg-9 col-md-10 col-sm-12">
                                <div class="tom-select-custom ">

                                    <select name="zoom" class="border-dark border-1 border focus input-active dropdown-active js-select form-select"
                                        autocomplete="off"
                                        data-hs-tom-select-options='{
                                      "placeholder": "By Distance ",
                                      "hideSearch": true
                                    }'>
                                        <option value="">By Distance </option>
                                         <option value="">By Distance</option>
    <option class="option" value="13">1 mile</option>
    <option class="option" value="12" {{ $userzoomfilter == 12 ? 'selected' : '' }}>
        2 miles</option>
    <option class="option" value="11" {{ $userzoomfilter == 11 ? 'selected' : '' }}>
        5 miles</option>
    <option class="option" value="10" {{ $userzoomfilter == 10 ? 'selected' : '' }}>
        10 miles</option>
        <option class="option" value="9" {{ $userzoomfilter == 9 ? 'selected' : '' }}>
            50 miles</option> 
                                        {{-- <option class="option" value="2" {{ $userzoomfilter == 2 ? 'selected' : '' }}>
                                            All </option> --}}

                                    </select>

                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <button class="btn btn-outline-primary" type="submit">Apply</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-9 ">
                    <div class="row  mb-2">
                        <div class="col-lg-10 col-md-10 col-sm-12">
                            <div class="scrollable-content">
                                <div class="tom-select-custom">
                                    <select id="filter-select" class="border-dark border-1 border js-select form-select"
                                        autocomplete="off" data-hs-tom-select-options='{
                                        "placeholder": "Sort By ",
                                        "hideSearch": true
                                        }'>
                                        <option value="">Sort By </option>
                                        <option value="all" class="my-2">All</option>
                                        <option value="all" class="my-2">Boondock</option>
                                        <option value="all" class="my-2">Repeater</option>
                                        <option value="all" class="my-2">Police</option>
                                        <option value="all" class="my-2">EMS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12">
                            <div class="scrollable-content">
                                <button id="reset-button" class="btn btn-outline-primary d-none d-md-block">Reset</button>
                            </div>
                        </div>
                    </div>
                    
            </div>

            <div class="row mt-3">
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <!-- Card -->
                    <div class="card-body card rounded-2 mb-2 py-1 card-dashed shadow-none">
                        <div id="station-count" class="ps-3 text-dark">Total Stations Found: 0</div>
                    </div>
                    <!-- End Card -->

                    <!-- Add a new list for nearby stations -->
                    <ol class="list-group" id="stationlist">
                        <!-- List items for nearby stations will be added here -->
                    </ol>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-12">
                    <!-- Map Container -->
                    <div id="map" style="height: 500px;"></div>
                </div>
            </div>
        </div>
    </main>

    <!-- Include Google Maps JavaScript API -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{$mapapi}}&libraries=places&callback=initMap" async
        defer></script>

    <script>
        let markers = [];
        let userLocation = null;

        function initMap() {
           
    const map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: 39.5501,
            lng: -105.7821
        },
        zoom: 5,
    });

    // Function to create and display the user's info window with location name
function displayUserLocationInfo(map, userLocationMarker) {
    const geocoder = new google.maps.Geocoder();

    // Get the user's coordinates from the marker
    const userCoordinates = userLocationMarker.getPosition();

    // Use the geocoder to convert coordinates into a location name
    geocoder.geocode({ location: userCoordinates }, (results, status) => {
        if (status === 'OK') {
            if (results[0]) {
                const locationName = results[0].formatted_address;

                const contentString = `<div>Your Location: ${locationName}</div>`;

                const infowindow = new google.maps.InfoWindow({
                    content: contentString,
                });

                infowindow.open(map, userLocationMarker);
           // Set a timer to close the info window after 10 seconds (10000 milliseconds)
           setTimeout(() => {
                    infowindow.close();
                }, 10000); // Adjust the duration as needed (in milliseconds)
            } else {
                console.error('No results found');
            }
        } else {
            console.error('Geocoder failed due to: ' + status);
        }
    });

}
    // Request the user's location when the page opens
    if ('geolocation' in navigator) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const userLocation = {
//                      lat: 34.0522, // Latitude of Los Angeles
//   lng: -118.2437, // Longitude of Los Angeles
lat: 41.8800, // Latitude of Lombard, Illinois
  lng: -88.0078, // Longitude of Lombard, Illinois
                       // lat: position.coords.latitude,
                            // lng: position.coords.longitude,

                };

                // Create a user location marker with a custom icon
                const userLocationMarker = new google.maps.Marker({
                    position: userLocation,
                    map: map,
                    title: 'Your Location',
                    icon: {
                        url: 'assets/img/front/location-pin.png', // Icon URL for user location
                        scaledSize: new google.maps.Size(65, 65),
                    },
                });

                // Add a click event listener to the user icon marker
                userLocationMarker.addListener('click', () => {
                    displayUserLocationInfo(map, userLocationMarker);
                });

                // Center the map on the user's location and zoom in
                map.setCenter(userLocation);
                map.setZoom({{ $userzoomfilter }}); 

                // Display nearby fire stations
                allstationdisplay(userLocation);
            },
            (error) => {
                if (error.code === 1) {
                    // User denied location access, prompt for manual input
                    alert('Please enter your location manually in the search bar.');
                } else {
                    console.error('Error getting location:', error.message);
                }
            }
        );
    } else {
        alert('Geolocation is not supported in your browser.');
    }

    // Add click event handler for the "Locate Me" button
const locateButton = document.getElementById('locate-button');
locateButton.addEventListener('click', () => {
    // Check if the browser supports geolocation
    if ('geolocation' in navigator) {
        // Request the user's location
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                // Center the map on the user's location and zoom in
                map.setCenter(userLocation);
                map.setZoom({{ $userzoomfilter }});

                // Create a user location marker with a custom icon
                const userLocationMarker = new google.maps.Marker({
                    position: userLocation,
                    map: map,
                    title: 'Your Location',
                    icon: {
                        url: 'assets/img/front/location-pin.png', // Icon URL for user location
                        scaledSize: new google.maps.Size(60, 60),
                    },
                });

                // Add a click event listener to the user icon marker
                userLocationMarker.addListener('click', () => {
                    displayUserLocationInfo(map, userLocationMarker);
                });

                // Display nearby fire stations
                allstationdisplay(userLocation);
            },
            (error) => {
                if (error.code === 1) {
                    // User denied location access, prompt for manual input
                    alert('Please enter your location manually in the search bar.');
                } else {
                    console.error('Error getting location:', error.message);
                }
            }
        );
    } else {
        alert('Geolocation is not supported in your browser.');
    }
});

            // Function to filter markers based on type
            function filterMarkersByType(type) {
                markers.forEach(marker => {
                    if (type === 'all' || marker.type === type) {
                        marker.setVisible(true);
                    } else {
                        marker.setVisible(false);
                    }
                });
            }

            // Handle filter selection
            const filterSelect = document.getElementById('filter-select');
            filterSelect.addEventListener('change', function() {
                const selectedType = filterSelect.value;
                filterMarkersByType(selectedType);
            });

            // Handle reset button
            const resetButton = document.getElementById('reset-button');
            resetButton.addEventListener('click', function() {
                filterMarkersByType('all');
            });


            // Initialize the Google Places Autocomplete service
            const searchInput = document.getElementById('search-input');
            const suggestions = document.getElementById('suggestions');
            const autocomplete = new google.maps.places.Autocomplete(searchInput);


            // Handle place selection from the autocomplete suggestions
            autocomplete.addListener('place_changed', () => {
                const place = autocomplete.getPlace();
                if (!place.geometry) {
                    console.error('No place data available');
                    return;
                }

                // Center the map on the selected place
                map.setCenter(place.geometry.location);
                map.setZoom(12); // You can adjust the zoom level as needed
            });

            // Handle input changes to show suggestions
            searchInput.addEventListener('input', () => {
                const query = searchInput.value;
                if (!query) {
                    suggestions.innerHTML = '';
                    return;
                }

                // Use the Places API to fetch suggestions
                const service = new google.maps.places.AutocompleteService();
                service.getPlacePredictions({
                    input: query
                }, (predictions, status) => {
                    if (status !== google.maps.places.PlacesServiceStatus.OK) {
                        console.error('Place prediction error:', status);
                        return;
                    }

                    // Display the suggestions as links
                    // suggestions.innerHTML = '';
                    // predictions.forEach(prediction => {
                    //     const suggestionItem = document.createElement('a');
                    //     suggestionItem.classList.add('list-group-item', 'list-group-item-action');
                    //     suggestionItem.href = '#';
                    //     suggestionItem.textContent = prediction.description;
                    //     suggestionItem.addEventListener('click', () => {
                    //         searchInput.value = prediction.description;
                    //         searchInput.focus();
                    //     });
                    //     suggestions.appendChild(suggestionItem);
                    // });
                });
            });


            function calculateDistance(userLocation, station) {
                const userLat = userLocation.lat;
                const userLng = userLocation.lng;
                const stationLat = station.lat;
                const stationLng = station.lng;

                // Radius of the Earth in kilometers
                const earthRadius = 6371;

                // Convert latitude and longitude from degrees to radians
                const userLatRad = toRadians(userLat);
                const userLngRad = toRadians(userLng);
                const stationLatRad = toRadians(stationLat);
                const stationLngRad = toRadians(stationLng);

                // Haversine formula
                const dLat = stationLatRad - userLatRad;
                const dLng = stationLngRad - userLngRad;

                const a =
                    Math.sin(dLat / 2) ** 2 +
                    Math.cos(userLatRad) * Math.cos(stationLatRad) * Math.sin(dLng / 2) ** 2;

                const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

                // Calculate the distance in kilometers
                const distance = earthRadius * c;

                // Convert distance to miles if needed
                // const distanceInMiles = distance * 0.621371;

                return distance.toFixed(2); // Return distance rounded to 2 decimal places
            }

            function toRadians(degrees) {
                return (degrees * Math.PI) / 180;
            }


            // Pass the data from PHP loop to JavaScript as JSON
            const exploreData = {!! json_encode($exploreData) !!};


            // Function to display nearby fire stations within a 10km radius from the user's location
            function allstationdisplay(userLocation) {
                // Use the data from PHP loop
                // Assuming you have a variable called 'data' that holds the data
                const nearbyallstations = exploreData.map(item => ({
                    location: item.Location,
                    county: item.County,
                    lat: parseFloat(item.Lat),
                    lng: parseFloat(item.Long),
                    frequency: item.Output_Freq,
                    callSign: item.Call,
                    opstatus: item.Op_Status,
                    online: item.Op_Status === 'Online',
                    type: item.Use,
                    icon: 'assets/img/front/repeater2.png',
                }));

                // Calculate distances and sort the stations by distance
                nearbyallstations.forEach(station => {
                    station.distance = calculateDistance(userLocation, station);
                });
                nearbyallstations.sort((a, b) => a.distance - b.distance);

                // Clear existing markers
                markers.forEach(marker => marker.setMap(null));
                markers = [];

                // Clear existing list items
                const nearbyallstationsList = document.getElementById('stationlist');
                nearbyallstationsList.innerHTML = '';

                // Create a set to keep track of unique station locations
                const uniqueLocations = new Set();
                let stationCount = 0;

                // Flag to check if any nearby stations were found
                let stationsFound = false;
 

                // Create markers and list items for nearby fire stations in sorted order
                nearbyallstations.forEach((station, index) => {
                    // Calculate the distance between the user and the station
                    const distance = calculateDistance(userLocation, station);

                    // Check if the station is within a 10km radius from the user's location
                    if (distance <= {{ $distance }}) {
                        stationsFound = true; // Nearby stations found

                        // Check if the station location is already in the set (duplicate check)
                        if (!uniqueLocations.has(station.location)) {
                            const marker = new google.maps.Marker({
    position: new google.maps.LatLng(station.lat, station.lng),
    map: map,
    title: `${station.location} (${station.distance} km)`, // Combine location and distance
    icon: {
        url: station.icon, // Icon URL for fire stations
        scaledSize: new google.maps.Size(40, 45),
    },
    type: station.type, // Add a type for filtering
});

                            markers.push(marker);

                            // Create a list item for the nearby fire station
                            const listItem = document.createElement('li');
                            listItem.classList.add('list-group-item', 'd-flex', 'justify-content-between',
                                'align-items-start');
                            listItem.dataset.locationIndex = index; // Store the marker index for reference

                            // Create a div to hold the station name
                            const nameDiv = document.createElement('div');
                            nameDiv.classList.add('ms-2', 'me-auto');
                            nameDiv.innerHTML = `
                <span class="legend-indicator ${station.online ? 'bg-success' : 'bg-danger'}" data-toggle="tooltip" data-placement="top" title="${station.online ? 'Online' : 'Offline'}"></span>
                <span class="text-dark fw-semibold">  ${station.location} - ${station.county}  <br>( ${station.distance} km away ) </span>     <br>  Frequency : ${station.frequency} 
            `;

                            function getStationInfo(station) {
                                return `
                    <h6> ${station.location} ( ${station.callSign} )</h6>
                    <p>Type : ${station.type}</p>
                    <p>Band : - </p>
                    <p>Frequency : ${station.frequency}</p>
                    <p>Distance : ${station.distance} km</p>
                `;
                            }

                            // Add click event listener to zoom to the location on the map and display the name and details
                            listItem.addEventListener('click', () => {
                                const markerIndex = listItem.dataset.locationIndex;
                                const clickedMarker = markers[markerIndex];
                                map.setCenter(clickedMarker.getPosition());
                                map.setZoom(13); // Adjust zoom level as needed

                                // Display the station name and details when the marker is clicked
                                const infoWindow = new google.maps.InfoWindow({
                                    content: getStationInfo(station),
                                });
                                infoWindow.open(map, clickedMarker);
                            });

                            // Add click event listener to the marker to display the info window and select the list item
                            marker.addListener('click', () => {
                                // Display the station name and details when the marker is clicked
                                const infoWindow = new google.maps.InfoWindow({
                                    content: getStationInfo(station),
                                });
                                infoWindow.open(map, marker);

                                // Select the corresponding list item
                                listItem.click();
                            });

// Define variables to keep track of the currently selected station and marker
let selectedStation = null;
let selectedMarker = null;
// Function to handle the click event for the station
function handleStationClick() {
    // Unhighlight the previously selected station (if any)
    unhighlightSelectedStation();

    // Set the marker and info window for the clicked station
    const clickedMarker = marker; // Assuming marker is defined in the current scope
    const infoWindow = new google.maps.InfoWindow({
        content: getStationInfo(station),
    });

    // Highlight the selected marker (e.g., change its icon)
    clickedMarker.setIcon({
        url: 'assets/img/front/repeater2.png', // Adjust the highlighted icon URL
        scaledSize: new google.maps.Size(60, 65),
    });

    // Open the info window for the clicked station
    infoWindow.open(map, clickedMarker);

    // Set a timer to close the info window after 10 seconds (10000 milliseconds)
    setTimeout(() => {
        infoWindow.close();
        // Clear the highlight from the marker
        clickedMarker.setIcon({
            url: 'assets/img/front/repeater2.png', // Adjust the original icon URL
            scaledSize: new google.maps.Size(40, 45),
        });

        // Unhighlight the corresponding list item after 10 seconds
        listItem.classList.remove('active-light');
    }, 10000);

    // Store the currently selected station and marker
    selectedStation = station;
    selectedMarker = clickedMarker;

    // Highlight the corresponding list item with the custom class for a lighter color
    listItem.classList.add('active-light');
}

// Function to unhighlight the previously selected station
function unhighlightSelectedStation() {
    if (selectedStation && selectedMarker) {
        // Restore the original icon for the previously selected marker
        selectedMarker.setIcon({
            url: 'assets/img/front/repeater2.png', // Adjust the original icon URL
            scaledSize: new google.maps.Size(40, 45),
        });

        // Unhighlight the corresponding list item and remove the custom class
        const selectedIndex = listItem.dataset.locationIndex;
        const previouslySelectedListItem = document.querySelector(`[data-location-index="${selectedIndex}"]`);
        if (previouslySelectedListItem) {
            previouslySelectedListItem.classList.remove('active-light');
        }

        // Clear the selected station and marker variables
        selectedStation = null;
        selectedMarker = null;
    }
}


// Add click event listener to the list item to zoom to the location on the map and display the name and details
listItem.addEventListener('click', handleStationClick);

// Add click event listener to the marker to display the info window and select the list item
marker.addListener('click', handleStationClick);

                            // Append the name div to the list item
                            listItem.appendChild(nameDiv);

                            // Add the location to the set to mark it as added
                            uniqueLocations.add(station.location);

                            // Add the list item to the list and increment station count
                            nearbyallstationsList.appendChild(listItem);
                            stationCount++;

                            // Add a scrollbar to the list if there are more than 10 stations
                            if (stationCount > 5) {
                                nearbyallstationsList.style.overflowY = 'scroll';
                                nearbyallstationsList.style.maxHeight =
                                '450px'; // Adjust the maximum height as needed
                            }
                        }
                    }
                });
// Update the total station count
document.getElementById('station-count').textContent = `Total Stations Found: ${stationCount}`;
              // Check if no nearby stations were found and display "No data found" message
                if (!stationsFound) {
                    const noDataMessageCard = document.createElement('div');
                    noDataMessageCard.classList.add('card' ); // Add Bootstrap card class and margin-top
                    nearbyallstationsList.appendChild(noDataMessageCard);

                    const noDataMessageCardBody = document.createElement('div');
                    noDataMessageCardBody.classList.add('card-body'); // Add Bootstrap card-body class
                    noDataMessageCard.appendChild(noDataMessageCardBody);

                    const noDataMessageText = document.createElement('p');
                    noDataMessageText.classList.add('card-text', 'lead'); // Add Bootstrap card-text class
                    noDataMessageText.textContent = 'No stations found in this area. Modify your search parameters by expanding your search radius.';
                    noDataMessageCardBody.appendChild(noDataMessageText);
                }


            }

            // Inside the initMap function
            console.log('Initializing the map');

            // // Inside the allstationdisplay function
            // console.log('Displaying nearby stations', exploreData);



        }
    </script>
    <style>
        /* Custom CSS class for lighter highlight color */
.list-group-item.active-light {
    background-color: #dbdbdb; /* Change this color to your desired lighter color */
    border-color: #dee2e6; /* Change this color to match your design */
    color: #333; /* Change the text color to ensure visibility */
}

    </style>
@endsection
