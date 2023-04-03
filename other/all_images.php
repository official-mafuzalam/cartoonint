<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Friends It Ltd | cPanel</title>
    <link rel="stylesheet" href="../cssfile/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
    <div class="container text-center">
        <a class="text-decoration-none" href="../">
            <h2 class="fw-bold">Friends IT Ltd</h2>
        </a>
        <p class="fs-4">All Images.</p>
        <hr>
    </div>

    <div class="container text-center">

        <?php
        // Retrieve the names of all the uploaded files
        $uploaded_files = array_diff(scandir("../img_slider/"), array('.', '..'));

        ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="col">S_No</th>
                    <th class="col">Image</th>
                    <th class="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($uploaded_files as $file) { ?>
                    <tr>
                        <td>
                            <?php echo $i; ?>
                        </td>
                        <td>
                            <img class="rounded img-thumbnail" style="width:400px;" src="../img_slider/<?php echo $file; ?>"
                                alt="<?php echo $file; ?>" />
                        </td>
                        <td>
                            <button data-file="<?php echo $file; ?>" id="delete-<?php echo $i; ?>"
                                class="dlt-img">Delete</button>
                        </td>
                    </tr>
                    <?php
                    $i++;
                } ?>
            </tbody>
        </table>

    </div>
    <div class="text-center">
        <a href="../json_image/json_img_post.php"><button class="btn btn-info">All Images In Json</button></a>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.dlt-img').on('click', function () {
            // Get the image file name from the data attribute
            var fileName = $(this).data('file');
            // Send an AJAX request to the delete script
            $.ajax({
                url: '../delete/delete_image.php',
                type: 'POST',
                data: { file: fileName },
                success: function (response) {
                    // If the image was deleted successfully, remove the table row
                    if (response == 'success') {
                        $(this).closest('tr').remove();
                        alert("Selected Image Deleted");
                        location.reload();
                    }
                }
            });
        });

    </script>

    <!-- Bootstrap Script Link -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
        </script>

    <!-- Bootstrap Script Link -->
</body>

</html>