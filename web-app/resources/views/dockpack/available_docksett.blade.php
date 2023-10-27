<form method="POST" action="{{ route('update_in_usesett', ['id' =>  $id ])}}">
    @csrf

    <select name="dock_names{{ $id }}" class="form-control" multiple="">
        @foreach ($available_docks as $dock)
        @if ($dock->mac != auth()->id())
            <option value="{{ $dock->name }}">{{ $dock->name }}</option>
            @endif
        @endforeach
    </select>
    <div class="col-sm mb-2 mb-sm-0 mt-2">
        <div class="d-grid">
            <button type="button" class="btn btn-info mx-2" id="SettAdd-button{{ $id }}">
                <i class="bi bi-box-arrow-in-left"></i> &nbsp;Add
            </button>
        </div>
    </div>
    <input type="hidden" name="selected_docks" id="selected-docks{{ $id }}"
        value="">
    <input type="hidden" name="dock_pack_id" value="{{ $id }}">
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#SettAdd-button{{ $id }}').click(function(event) {
            event.preventDefault();

            var selectedDocks = $('select[name="dock_names{{ $id }}"]').val();
            $('#selected-docks{{ $id }}').val(selectedDocks.join(','));

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
        $('#SettAdd-button{{$id}}').click(function() {
            $.ajax({
                url: '{{ route('dockpacksett_container', ['id' =>  $id ]) }}',
                method: 'GET',
                success: function(data) {
                    $('#dockpacksett_container{{$id}}').html(data);
                }
            });
            $.ajax({
                url: '{{ route('available_docksett', ['id' => $id]) }}',
                method: 'GET',
                success: function(data) {
                    $('#available_docksett{{$id}}').html(data);
                }
            });
        });
    });
</script>
