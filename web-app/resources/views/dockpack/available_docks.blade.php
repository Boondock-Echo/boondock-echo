<form method="POST" action="{{ route('update_in_use') }}">
    @csrf
    <select name="dock_names" class="form-control" multiple="">
        @foreach ($available_docks as $dock)
        @if ($dock->mac != auth()->id())
            <option value="{{ $dock->name }}">{{ $dock->name }}</option>
            @endif
        @endforeach
    </select>
    <div class="col-sm mb-2 mb-sm-0 mt-2">
        <div class="d-grid">
            <button type="submit" class="btn btn-info mx-2" id="Add-button">
                <i class="bi bi-box-arrow-in-left"></i> &nbsp;Add
            </button>
        </div>
    </div>
    <input type="hidden" name="selected_docks" id="selected-docks"
        value="">
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#Add-button').click(function(event) {
            event.preventDefault();

            var selectedDocks = $('select[name="dock_names"]').val();
            $('#selected-docks').val(selectedDocks.join(','));

            var form = $(this).closest('form');
            var url = form.attr('action');
            var method = form.attr('method');
            var data = form.serialize();

            $.ajax({
                url: url,
                method: method,
                data: data,
                success: function(response) {
                    // handle success response
                },
                error: function(xhr) {
                    // handle error response
                }
            });
        });
        $('#Add-button').click(function() {
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
