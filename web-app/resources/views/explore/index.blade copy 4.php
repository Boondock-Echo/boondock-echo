@extends('layouts.app1')

@section('content')
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="main">
        <div class="container content px-3">
            <div class="row">
                <div class="col-6">
                    <div class="mb-4">
                        <input type="text" id="search-input" class="form-control"
                            placeholder="Search  an address , state, zip..." />
                    </div>

                </div>
                <div class="col-2">
                    <button id="locate-button" class="btn btn-ghost-primary btn-sm" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Near Me"><img class="avatar avatar-xs avatar-4x3"
                            src="assets/img/front/user.png" alt="user location"></button>
                </div>
                <div class="col-2">
                    <!-- Select -->
                    <div class="tom-select-custom">
                        <select id="filter-select" class="js-select form-select" autocomplete="off"
                            data-hs-tom-select-options='{
                                  "placeholder": "Sort By ",
                                  "hideSearch": true
                                }'>
                            <option value="">Sort By </option>
                            <option value="all" class="my-2">All</option>
                            <option value="OPEN" class="my-2">OPEN</option>
                            <option value="CLOSED" class="my-2">CLOSED</option>
                            <option value="fire_station" class="my-2">Fire station</option>
                            <option value="PRIVATE" class="my-2">PRIVATE</option>

                        </select>
                    </div>
                    <!-- End Select -->


                </div>
                <div class="col-2">
                    <button id="reset-button" class="btn btn-outline-primary  ">Reset</button>
                </div>
              
            </div>
           
            <div class="row">
                <div class="col-3">
                 
                    <select id="distance-filter">
                        <option value="5">5 km</option>
                        <option value="10">10 km</option>
                        <!-- Add more distance options as needed -->
                      </select>
                      <script>
                        
                      </script>
                      
                    <!-- Add a new list for nearby  stations -->
                    <ol class="list-group  " id="stationlist">
                        <!-- List items for nearby  stations will be added here -->
                    </ol>

                </div>
                <div class="col-9">
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

        

            // Request the user's location when the page opens
            if ('geolocation' in navigator) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const userLocation = {
                            lat: 34.0522, // Latitude of Los Angeles
                        lng: -118.2437, // Longitude of Los Angeles
                            //  lat: position.coords.latitude,
                            // lng: position.coords.longitude,
                           
                        };
                        
                     
// Create a user location marker with a custom icon
const userLocationMarker = new google.maps.Marker({
                position: userLocation,
                map: map,
                title: 'Your Location',
                icon: {
                            url: 'assets/img/front/user.png',// Icon URL for fire stations
                            scaledSize: new google.maps.Size(40, 40),
                        }
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
                                icon: 'assets/img/front/user.png',
                            };

                            // Center the map on the user's location and zoom in
                            map.setCenter(userLocation);

                            map.setZoom(11);

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
                    suggestions.innerHTML = '';
                    predictions.forEach(prediction => {
                        const suggestionItem = document.createElement('a');
                        suggestionItem.classList.add('list-group-item', 'list-group-item-action');
                        suggestionItem.href = '#';
                        suggestionItem.textContent = prediction.description;
                        suggestionItem.addEventListener('click', () => {
                            searchInput.value = prediction.description;
                            searchInput.focus();
                        });
                        suggestions.appendChild(suggestionItem);
                    });
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


            // Function to display nearby fire stations in the list and on the map with icons
            function allstationdisplay(userLocation) {
                
                // Use the data from PHP loop
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
                    icon: 'assets/img/front/dock5.png',
                }));
                 
                // Clear existing markers
                markers.forEach(marker => marker.setMap(null));
                markers = [];

                // Clear existing list items
                const nearbyallstationsList = document.getElementById('stationlist');
                nearbyallstationsList.innerHTML = '';

                // Create markers for nearby fire stations on the map
                nearbyallstations.forEach((station, index) => {
                    const marker = new google.maps.Marker({
                        position: new google.maps.LatLng(station.lat, station.lng),
                        map: map,
                        title: station.name,
                        icon: {
                            url: station.icon, // Icon URL for fire stations
                            scaledSize: new google.maps.Size(40, 40),
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
            <span class="text-dark fw-semibold">  ${station.location} </span> <br>  ${station.county}   Frequency: (${station.frequency}) 
        `;

                    function getStationInfo(station) {
                        return `
                <h6> ${station.location} </h6>
                <p>Type: ${station.type}</p>
                  <p>OP Status: ${station.opstatus}</p>
                <p>Frequency: ${station.frequency}</p>
                <p>Call Sign: ${station.callSign}</p>
                <p>Distance from {{ Auth::user()->name }}: ${calculateDistance(userLocation, station)} km</p>
            `;
                    }
                    // <p>Status: <span style="color: ${station.online ? 'green' : 'red'}">${station.online ? 'Online' : 'Offline'}</span></p>

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

                    // Append the name div to the list item
                    listItem.appendChild(nameDiv);

                    nearbyallstationsList.appendChild(listItem);
                });
            }
            // Inside the initMap function
            console.log('Initializing the map');

            // Inside the allstationdisplay function
            console.log('Displaying nearby stations', exploreData);

            // Check for errors in the browser's console


        }

</script>
@endsection
