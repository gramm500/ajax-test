<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <title>Test form ^-^</title>
    <style type="text/css">

    </style>
</head>
<body>
    <div class="page" style="position:relative;">
        <div class="loader-handler">
            <div class="loader"></div>
        </div>

        <form id="myForm" action="/upload.php" method="post" enctype="multipart/form-data">
            <div class="form-group container-md">

                <input class="form-control" type="hidden" name="is_form" value="1">
                <label for="">your text</label>
                <input class="form-control" type="text" name="name" placeholder="enter text" value="">
                <label for="">your file</label>
                <input class="form-control" type="file" name="file">
                <button class="btn btn-primary" type="submit" class="submit">Upload form</button>
            </div>

        </form>
    </div>
</body>

<script>
    function hideShowForm(type) {
        let loader = $('.loader-handler');
        return type ? loader.addClass('active') : loader.removeClass('active')
    }

    $(document).ready(function (e) {
        $("#myForm").on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                data: new FormData(this),
                url: $('#myForm').attr('action'),
                dataType: 'json',
                contentType: false,
                processData: false,
                beforeSend: function () {
                    hideShowForm(true);
                },
                success: function (response) {
                    setTimeout(function () {
                        hideShowForm(false);
                        if (!response.success) {
                            alert('You did not : ' + response.message)
                        } else  {
                            alert('All good')
                        }
                    }, 600)
                }
            });
        });
    });
</script>

</html>

