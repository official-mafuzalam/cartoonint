<?php

// check if the form has been submitted

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if file was uploaded without errors
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {

        // Define the target directory for the uploaded image
        $target_dir = "../img_slider/";

        // Generate a unique name for the image
        $file_name = uniqid() . "." . pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);

        // Define the target path for the image
        $target_path = $target_dir . $file_name;

        // Check if file was uploaded without errors
        if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $file_type = $_FILES["photo"]["type"];
            $file_size = $_FILES["photo"]["size"];

            // Verify file size - 5MB maximum
            $max_size = 5 * 1024 * 1024;
            if ($file_size > $max_size) {
                die("Error: File size is larger than the allowed limit.");
            }

            // Verify MYME type of the file
            if (in_array($file_type, $allowed)) {
                // Check whether file exists before uploading it
                if (file_exists($target_path)) {
                    echo $file_name . " is already exists.";
                } else {
                    // Move the uploaded file to the target directory
                    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_path);
                    // echo "Your file was uploaded successfully and saved as " . $file_name;

                    echo "<script>alert('Your Picture was uploaded successfully');
                    window.location.href = 'all_images.php';
                    </script>";

                    // // Save the description in a text file with the same name as the image, but with a .txt extension
                    // $description = $_POST["description"];
                    // $description_file_path = $target_dir . $file_name . ".txt";
                    // file_put_contents($description_file_path, $description);
                }
            } else {
                echo "Error: There was a problem uploading your file. Please try again.";
            }
        } else {
            echo "Error: " . $_FILES["photo"]["error"];
        }
    }

}


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cartoon International</title>
    <link rel="stylesheet" href="cssfile/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>

    <?php
    include '../inc/navbar.php';
    ?>

    <div class="container text-center">
        <a class="text-decoration-none" href="../">
            <h2 class="fw-bold">Cartoon International</h2>
        </a>
        <p class="fs-4">Image Upload for Cartoon International</p>
        <hr>
    </div>

    <div class="container text-center">

        <form action="" method="post" enctype="multipart/form-data">
            <div class="input-group text-center">
                <input type="file" class="form-control" id="file" name="photo" aria-label="Upload" required>
            </div>
            <br>
            <input class="btn btn-success" type="submit" value="Upload">
        </form>
        <br>
        <div class="text-center">
            <a href="all_images.php"><button class="btn btn-info">All Images</button></a>
        </div>

    </div>

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