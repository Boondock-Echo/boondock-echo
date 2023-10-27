@extends('layouts.app1')

@section('content')
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="main">

        <div class="container content px-3">

            <div class="row">
                <div class="col-3">
                    <div class="px-2">
                        <div class="position-relative w-md-100 z-index-2">
                            <div class="row">
                                <div class="col-9">
                                    <div class="mb-4">
                                        <input type="text" id="search-input" class="form-control"
                                            placeholder="Search  an address , state, zip..." />
                                    </div>

                                </div>
                                <div class="col-3">
                                    <button id="locate-button" class="btn btn-ghost-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="My Current Location"><img
                                            class="avatar avatar-xs avatar-4x3" src="assets/img/front/user.png"
                                            alt="Image Description"></button>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-9">
                                    <!-- Select -->
                                    <div class="tom-select-custom">
                                        <select id="filter-select" class="js-select form-select" autocomplete="off"
                                            data-hs-tom-select-options='{
                                                "placeholder": "Sort By ",
                                                "hideSearch": true
                                              }'>
                                            <option value="">Sort By </option>
                                            <option value="all" class="my-2">All</option>
                                            <option value="dock" class="my-2">Dock</option>
                                            <option value="FM radio" class="my-2">FM Radio</option>

                                        </select>
                                    </div>
                                    <!-- End Select -->


                                </div>
                                <div class="col-3">
                                    <button id="reset-button" class="btn btn-outline-primary btn-sm">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="location-list-container">



                        <ol class="list-group  my-3 " id="location-list">
                            <li class="list-group-item d-flex justify-content-between align-items-start">

                                <div class="ms-2 me-auto">

                                    <div class="fw-semibold"><span class="legend-indicator bg-success"></span>
                                        {{-- display station name here with icon --}}
                                    </div>
                                    Frequency : 123.12 Mhz
                                </div>
                                <i class="bi-heart-fill text-danger list-group-icon"></i>
                                {{-- <span class="badge bg-primary rounded-pill">14</span> --}}
                            </li>

                        </ol>
                    </div>
                    <!-- Add a new list for nearby fire stations -->
                    <ol class="list-group my-3" id="nearby-fire-stations-list">
                        <!-- List items for nearby fire stations will be added here -->
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
    <script src="https://maps.googleapis.com/maps/api/js?key={{ $mapapi }}&libraries=places&callback=initMap" async
        defer></script>

    <script>
        let markers = [];
        let userLocation = null;
        // Dock station and FM station data
        const dockStations = [{
                name: 'Dock Station Colorado',
                lat: 39.7392,
                lng: -104.9903,
                type: 'dock',
                icon: 'assets/img/front/dock5.png',
                frequency: '123.45 MHz',
                callSign: 'ABCD123',
                online: true,
            },
            {
                name: 'FM Radio Station Utah',
                lat: 40.7608,
                lng: -111.8910,
                type: 'FM radio',
                icon: 'assets/img/front/fm2.png',
                frequency: '456.78 MHz',
                callSign: 'MNOP1011',
                online: false,
            },
            {
                name: 'Dock Station New York',
                lat: 40.7128,
                lng: -74.0060,
                type: 'dock',
                icon: 'assets/img/front/dock5.png',
                frequency: '234.56 MHz',
                callSign: 'WXYZ789',
                online: true,
            },
            {
                name: 'Dock Station California',
                lat: 34.0522,
                lng: -118.2437,
                type: 'Dock Station',
                icon: 'assets/img/front/dock5.png',
                frequency: '567.89 MHz',
                callSign: 'EFGH456',
                online: true,
            },
        ];


        function initMap() {
            const map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: 39.5501,
                    lng: -105.7821
                }, // Colorado, USA
                zoom: 4,
            });

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
                            map.setZoom(11);

                            // Display nearby fire stations
                            displayNearbyFireStations(userLocation);
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
            // Function to display nearby fire stations
            function displayNearbyFireStations(location) {
                // You can use the Google Places API to search for nearby fire stations
                // Replace the following code with your API call to retrieve nearby fire stations
                // Example:
                const request = {
                    location: location,
                    radius: 5000, // You can adjust the radius as needed
                    keyword: 'fire station',
                };

                const placesService = new google.maps.places.PlacesService(map);

                placesService.nearbySearch(request, function(results, status) {
                    if (status === google.maps.places.PlacesServiceStatus.OK) {
                        // Clear existing markers
                        markers.forEach(marker => marker.setMap(null));
                        markers = [];

                        // Add markers for nearby fire stations
                        results.forEach(place => {
                            const marker = new google.maps.Marker({
                                position: place.geometry.location,
                                map: map,
                                title: place.name,
                                icon: {
                                    url: 'assets/img/front/fire-station.png',
                                    scaledSize: new google.maps.Size(30, 30),
                                },
                                type: 'fire_station', // Add a type for filtering
                            });

                            markers.push(marker);

                            // Add an info window for each marker if you want to display additional information
                            const infoWindow = new google.maps.InfoWindow({
                                content: `
              <h6>${place.name}</h6>
              <p>Address: ${place.vicinity}</p>
              <p>Rating: ${place.rating}</p>
            `,
                            });

                            marker.addListener('click', () => {
                                infoWindow.open(map, marker);
                            });
                        });
                    } else {
                        console.error('Error fetching nearby fire stations:', status);
                    }
                });
            }
            // Function to determine marker icon based on online status
            function getMarkerIcon(online) {
                const iconUrl = online ?
                    'assets/img/front/green-marker.png' :
                    'assets/img/front/red-marker.png';

                return {
                    url: iconUrl,
                    scaledSize: new google.maps.Size(30, 30),
                };
            }

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

            // Add markers for dock stations
            dockStations.forEach(station => {
                const marker = new google.maps.Marker({
                    position: {
                        lat: station.lat,
                        lng: station.lng
                    },
                    map: map,
                    title: station.name,
                    icon: {
                        url: station.icon,
                        scaledSize: new google.maps.Size(50, 50),
                    },
                    type: station.type,
                });

                markers.push(marker);

                // Add an info window for each marker if you want to display additional information
                const infoWindow = new google.maps.InfoWindow({
                    content: `
            <h6>${station.name}</h6>
            <p>Frequency: ${station.frequency}</p>
            <p>Call Sign: ${station.callSign}</p>
            <p>Status: <span style="color: ${station.online ? 'green' : 'red'}">${station.online ? 'Online' : 'Offline'}</span></p>
          `,
                });

                marker.addListener('click', () => {
                    infoWindow.open(map, marker);
                });
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

            // Function to populate the list with station names
            function populateLocationList(locations) {
                const locationList = document.getElementById('location-list');

                // Clear existing list items
                locationList.innerHTML = '';

                // Create list items for each location
                locations.forEach(location => {
                    const listItem = document.createElement('li');
                    listItem.classList.add('list-group-item', 'd-flex', 'justify-content-between',
                        'align-items-start');

                    // Create a div to hold the station name and frequency
                    const nameDiv = document.createElement('div');
                    nameDiv.classList.add('ms-2', 'me-auto', 'fw-semibold');
                    nameDiv.innerHTML = `
  <span class="legend-indicator bg-success"></span>
  ${location.name}
  <br>
  Frequency: ${location.frequency} 
`;


                    // Add click event listener to zoom to the location on the map
                    listItem.addEventListener('click', () => {
                        map.setCenter(new google.maps.LatLng(location.lat, location.lng));
                        map.setZoom(12); // Adjust zoom level as needed
                    });

                    // Append the name div to the list item
                    listItem.appendChild(nameDiv);

                    locationList.appendChild(listItem);
                });
            }

            // ...

            // Populate the location list with dock stations
            populateLocationList(dockStations);

            // ...
            // Function to create and display a marker with an icon
            function createMarkerWithIcon(location) {
                const marker = new google.maps.Marker({
                    position: new google.maps.LatLng(location.lat, location.lng),
                    map: map,
                    title: location.name,
                    icon: {
                        url: location.icon,
                        scaledSize: new google.maps.Size(30, 30),
                    },
                    type: location.type, // You can add a type for filtering
                });

                // Add an info window for the marker if you want to display additional information
                const infoWindow = new google.maps.InfoWindow({
                    content: `
      <h6>${location.name}</h6>
      <p>Frequency: ${location.frequency}</p>
      <p>Call Sign: ${location.callSign}</p>
      <p>Status: <span style="color: ${location.online ? 'green' : 'red'}">${location.online ? 'Online' : 'Offline'}</span></p>
    `,
                });

                marker.addListener('click', () => {
                    infoWindow.open(map, marker);
                });

                return marker;
            }

            // Function to zoom to a location and display an icon on the map
            function zoomToLocationWithIcon(location) {
                const marker = createMarkerWithIcon(location);
                map.setCenter(new google.maps.LatLng(location.lat, location.lng));
                map.setZoom(12); // Adjust zoom level as needed
            }



            // Add click event listener to list items to zoom to the location on the map
            listItems.forEach(listItem => {
                listItem.addEventListener('click', () => {
                    const locationIndex = listItem.dataset.locationIndex;
                    const location = dockStations[locationIndex];
                    zoomToLocationWithIcon(location);
                });
            });


            // Function to display nearby fire stations in the list and on the map with icons
            function displayNearbyFireStations(userLocation) {
                // Replace this example with your logic to fetch nearby fire stations
                // For now, let's assume you have an array of nearby fire stations
                const nearbyFireStations = [{
                        name: 'Fire Station 1',
                        lat: userLocation.lat + 0.01,
                        lng: userLocation.lng + 0.01,
                        frequency: '123.45 MHz',
                        callSign: 'ABC123',
                        online: true,
                    },
                    {
                        name: 'Fire Station 2',
                        lat: userLocation.lat - 0.02,
                        lng: userLocation.lng - 0.02,
                        frequency: '234.56 MHz',
                        callSign: 'DEF456',
                        online: false,
                    },
                    {
                        name: 'Fire Station 3',
                        lat: userLocation.lat + 0.03,
                        lng: userLocation.lng - 0.03,
                        frequency: '345.67 MHz',
                        callSign: 'GHI789',
                        online: true,
                    },
                    {
                        name: 'Fire Station 4',
                        lat: userLocation.lat - 0.04,
                        lng: userLocation.lng + 0.04,
                        frequency: '456.78 MHz',
                        callSign: 'JKL1011',
                        online: false,
                    },
                ];


                // Clear existing markers
                markers.forEach(marker => marker.setMap(null));
                markers = [];

                // Clear existing list items
                const nearbyFireStationsList = document.getElementById('nearby-fire-stations-list');
                nearbyFireStationsList.innerHTML = '';

                // Create markers for nearby fire stations on the map
                nearbyFireStations.forEach((station, index) => {
                    const marker = new google.maps.Marker({
                        position: new google.maps.LatLng(station.lat, station.lng),
                        map: map,
                        title: station.name,
                        icon: {
                            url: 'assets/img/front/fire-station.png', // Icon URL for fire stations
                            scaledSize: new google.maps.Size(40, 40),
                        },
                        type: 'fire_station', // Add a type for filtering
                    });

                    markers.push(marker);

                    // Create a list item for the nearby fire station
                    const listItem = document.createElement('li');
                    listItem.classList.add('list-group-item', 'd-flex', 'justify-content-between',
                        'align-items-start');
                    listItem.dataset.locationIndex = index; // Store the marker index for reference

                    // Create a div to hold the station name
                    const nameDiv = document.createElement('div');
                    nameDiv.classList.add('ms-2', 'me-auto', 'fw-semibold');
                    nameDiv.innerHTML = `
      <span class="legend-indicator bg-success"></span>
      ${station.name}
    `;

                    function getStationInfo(station) {
                        return `
    <h6>${station.name}</h6>
    <p>Frequency: ${station.frequency}</p>
    <p>Call Sign: ${station.callSign}</p>
    <p>Status: <span style="color: ${station.online ? 'green' : 'red'}">${station.online ? 'Online' : 'Offline'}</span></p>
  `;
                    }

                    // Add click event listener to zoom to the location on the map and display the name and details
                    listItem.addEventListener('click', () => {
                        const markerIndex = listItem.dataset.locationIndex;
                        const clickedMarker = markers[markerIndex];
                        map.setCenter(clickedMarker.getPosition());
                        map.setZoom(12); // Adjust zoom level as needed

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

                    nearbyFireStationsList.appendChild(listItem);
                });
            }


        }
    </script>
@endsection
