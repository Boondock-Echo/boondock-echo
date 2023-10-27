<table class="js-datatable-checkboxes table  table-borderless table-thead-bordered table-nowrap table-align-center "
    data-hs-datatables-options='{
                 "columnDefs": [{
                    "targets": [0],
                    "orderable": false
                 }],
                 "order": []
               }'>
    <thead class="thead-light">
        <tr>
            <th class="table-column-me-1">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="datatableWithCheckboxSelectAll">
                    <label class="form-check-label" for="datatableWithCheckboxSelectAll"></label>
                </div>
            </th>
            <th class="table-column-ps-0">Dock Name</th>
            <th>Receive</th>
            <th>Transmit</th>
            <th>Playback</th>
        </tr>
    </thead>

    <tbody id="data-table">

        @foreach ($dock_in_use as $dock)
            <form id="available-docks-form" method="POST" action="{{ route('update_available_docks') }}">
                @csrf

                <input type="hidden" name="dock_id" value="{{ $dock->id }}">
                <tr>
                    <td class="table-column-pe-0">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input dock-checkbox"
                                id="usersDataCheck{{ $dock->id }}" name="dock_ids[]" value="{{ $dock->id }}">
                            <label class="form-check-label" for="usersDataCheck{{ $dock->id }}"></label>
                        </div>
                    </td>

                    <td class="table-column-ps-0">
                        <a class="d-flex align-items-center" href="#">

                            <div class="ms-0">
                                <span class="d-block text-inherit mb-0">{{ $dock->name }}
                                </span>

                            </div>
                        </a>
                    </td>
                    <td>

                        <label class="switch switch-green">
                            <input name="rx_enabled" type="checkbox" id="receive{{ $dock->id }}" class="rx-enabled-checkbox switch-input" {{ $dock->rx_enabled == 1 ? 'checked' : '' }}>
                             <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>

                        {{-- <span class="d-block fs-5">Human resources</span> --}}
                    </td>

                    <td>

                        <label class="switch switch-green">
                            <input name="tx_enabled" type="checkbox" id="transmit{{ $dock->id }}" class="tx-enabled-checkbox switch-input" {{ $dock->tx_enabled == 1 ? 'checked' : '' }}>
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>

                        {{-- <span class="d-block fs-5">Human resources</span> --}}
                    </td>
                    <td>

                        <label class="switch switch-green">
                            <input type="checkbox" class="switch-input" checked>
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>

                        {{-- <span class="d-block fs-5">Human resources</span> --}}
                    </td>

                </tr>
            </form>

<script>
   $('#receive{{ $dock->id }}').on('change', function() {
    var isChecked = $(this).prop('checked');
    var rxEnabled = isChecked ? 1 : 0;

    // Save to Database
    $.ajax({
        type: 'PUT',
        url: '{{ route('dock_enable', ['id' => $dock->id]) }}',
        data: {
            '_token': '{{ csrf_token() }}',
            '_method': 'PUT',
            'rx_enabled': rxEnabled,
        },
        success: function(response) {
            console.log(response);
        },
        error: function(error) {
            console.log(error);
        }
    });
});
   $('#transmit{{ $dock->id }}').on('change', function() {
    var isChecked = $(this).prop('checked');
    var txEnabled = isChecked ? 1 : 0;

    // Save to Database
    $.ajax({
        type: 'PUT',
        url: '{{ route('dock_enable', ['id' => $dock->id]) }}',
        data: {
            '_token': '{{ csrf_token() }}',
            '_method': 'PUT',
            'tx_enabled': txEnabled,
        },
        success: function(response) {
            console.log(response);
        },
        error: function(error) {
            console.log(error);
        }
    });
});
</script>
            @endforeach

    </tbody>
</table>

<div class="col-sm mb-2 mb-sm-0 mt-2">
    <div class="d-grid">
        <button class="btn btn-warning mx-2" type="button" id="Remove-button" data-dashlane-rid="d64f21caaacee0d1"> <i
                class="bi bi-box-arrow-right"></i>&nbsp;&nbsp;Remove</button>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#Remove-button').click(function() {
            // get all checked checkboxes
            var checkboxes = $('.dock-checkbox:checked');
            var dock_ids = [];
            checkboxes.each(function() {
                dock_ids.push($(this).val());
            });
            if (dock_ids.length > 0) {
                // send AJAX request to update in_use column
                $.ajax({
                    url: '{{ route('update_available_docks') }}',
                    type: 'POST',
                    data: {
                        dock_ids: dock_ids,
                        in_use: 0,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // reload page or do something else on success
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });
        // Add a click event listener to the "Remove" button to reload the data
        $('#Remove-button').click(function() {
            $.ajax({
                url: '{{ route('get-data') }}',
                method: 'GET',
                success: function(data) {
                    $('#table-container').html(data);
                }
            });
            $.ajax({
                url: '{{ route('available_docks') }}',
                method: 'GET',
                success: function(data) {
                    $('#available_docks').html(data);
                }
            });
        });
    });
</script>

