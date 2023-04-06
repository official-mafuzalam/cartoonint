<?php

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
}

$session_name = $_SESSION['name'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['submit_video'])) {

        $catArrayListNum = $_POST['catArrayListNum'];
        // $category_name2 = $_POST['category_name2'];

        $json_data = file_get_contents("../json/data_category.json");
        $catArrayList = json_decode($json_data, true);

        $new_video = array(
            "vdo_id" => $_POST["vdo_id"],
            "vdo_title" => $_POST["vdo_title"],
            "vdo_desciption" => $_POST["vdo_description"]
        );

        array_unshift($catArrayList["catArrayList"][$catArrayListNum]["videoArrayList"], $new_video);

        // // Save the updated JSON object to the file
        file_put_contents('../json/data_category.json', json_encode($catArrayList));

        echo "<script>alert('Successfully Submitted Video data');
            window.location.href = '../index.php';
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
                <input class="form-control" type="number" id="catArrayList" name="catArrayListNum"
                    placeholder="Category Array List No:" required>
            </div>
            <br>
            <div class="input-group">
                <input class="form-control" type="text" id="vdo_id" name="vdo_id" placeholder="Video Id" required>

            </div>
            <br>
            <div class="input-group">
                <input class="form-control" type="text" id="vdo_title" name="vdo_title" placeholder="Video Title"
                    required>

            </div>
            <br>
            <div class="input-group">
                <input class="form-control" type="text" id="vdo_description" name="vdo_description"
                    placeholder="Video Description" required>

            </div>
            <br>
            <input class="btn btn-success" name="submit_video" type="submit" value="Submit">
        </form>
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