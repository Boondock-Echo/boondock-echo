
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <form id="myForm">
        @csrf
        <input type="text" name="name">
        <input type="text" name="station">
        <input type="text" name="code">
        <button type="submit" id="submitBtn">Submit</button>
    </form>
</body>

<script>
    $(document).ready(function () {
        $('#myForm').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '{{ route('mydocks.store') }}',
                data: $(this).serialize(),
                success: function (response) {
                    if(response.success) {
            alert(response.message);
        }
                },
                error: function (response) {
                    console.log(response);
                }
            });
        });
    });
</script>
</html>
