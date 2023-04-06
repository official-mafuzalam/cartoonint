<?php

// Set the timezone to Bangladesh
// date_default_timezone_set('Asia/Dhaka');
// include '../inc/conn.php';
// session_start();

// // Check if user is logged in, otherwise redirect to login page
// if (!isset($_SESSION['w_type'])) {
//     header('Location: ../login.php');
//     exit();
// }

// $session_user_id = $_SESSION['user_id'];
// $session_user_name = $_SESSION['username'];
// $session_technology = $_SESSION['technology'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['submit_slider'])) {

        $slider_image = $_POST['slider_image'];
        $slider_title = $_POST['slider_title'];

        // Read the existing JSON object from the file
        $json_data = file_get_contents("../json/data_slider.json");
        $data = json_decode($json_data, true);

        // Add the new data to the existing array
        $data['sliderImageList'][] = array(
            'slider_image' => $slider_image,
            'slider_title' => $slider_title
        );

        // Save the updated JSON object to the file
        file_put_contents('../json/data_slider.json', json_encode($data));

        echo "<script>alert('Successfully Submitted Slider data');
            window.location.href = '../';
            </script>";
    }
}

?>

<!-- HTML File -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cartoon INT | cPannel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <?php
    include '../inc/navbar.php';
    ?>

    <div class="container text-center">
        <a class="text-decoration-none" href="../">
            <h2 class="fw-bold">Cartoon International</h2>
        </a>
        <p class="fs-4">Fill the form for add a new Video.</p>
        <hr>
    </div>


    <div class="container text-center">
        <form action="" method="post">
            <div class="input-group">
                <input class="form-control" type="text" name="slider_image" placeholder="Image URL" required>
            </div>
            <br>
            <div class="input-group">
                <input class="form-control" type="text" name="slider_title" placeholder="Image Title" required>

            </div>
            <br>
            <input class="btn btn-success" name="submit_slider" type="submit" value="Save">
        </form>
    </div>
    <br>
    <div class="text-center">
        <a href="../json/data_slider.json"><button class="btn btn-info">All Slider in JSON</button></a>
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