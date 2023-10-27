<!-- station.index.blade.php -->
@foreach ($activeDocks as $dock)
<div class="modal fade" id="remove{{ $dock->id }}" tabindex="-1" aria-labelledby="manageModal{{ $dock->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manageModal{{ $dock->id }}">Manage Stations</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <label>
                                    <input type="checkbox" id="select-all-stations{{ $dock->id }}">
                                </label>
                            </th>
                            <th>Name</th>
                            <th>Description</th>
                            <!-- Add more table headers if needed -->
                        </tr>
                    </thead>
                    <tbody id="station-list{{ $dock->id }}">
                        @foreach ($station as $stations)
                        <tr>
                            <td>
                                <label>
                                    <input type="checkbox" class="station-checkbox" value="{{ $stations->id }}">
                                </label>
                            </td>
                            <td>{{ $stations->station }}</td>
                            <td>{{ $stations->description }}</td>
                            <!-- Add more table cells if needed -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
           
            

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="delete-stations-btn{{ $dock->id }}" type="button"
                    class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Handle the click event of the "Select All" checkbox
        $('#select-all-stations{{ $dock->id }}').click(function() {
            var isChecked = $(this).prop('checked');
            $('.station-checkbox').prop('checked', isChecked);
        });

        // Handle the click event of the "Delete" button within the modal
        $('#delete-stations-btn{{ $dock->id }}').click(function() {
            var selectedStations = []; // Array to store the selected station IDs

            // Find all the checked station checkboxes within the modal
            $('#station-list{{ $dock->id }} .station-checkbox:checked').each(function() {
                selectedStations.push($(this).val()); // Add the station ID to the array
            });

            if (selectedStations.length === 0) {
                alert('Please select at least one station to delete.');
                return;
            }

            // Perform the AJAX request to delete the selected stations
            $.ajax({
                type: 'POST',
                url: '{{ route('station.delete') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    stationIds: selectedStations
                },
                success: function(response) {
                    // Handle the success response
                    console.log(response);
                    // Reload the station.index view using AJAX
                    loadStationIndex();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        // Function to reload the station.index view using AJAX
        function loadStationIndex() {
            $.ajax({
                type: 'GET',
                url: '{{ route('station.index') }}',
                success: function(response) {
                    // Update the content of the station-component-container div
                    $('#station-component-container').html(response);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    });
</script>

@endforeach