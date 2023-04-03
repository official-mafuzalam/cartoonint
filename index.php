<?php

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if file was uploaded without errors
    if (isset($_POST['form0'])) {
        // (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        // $allowed = array("jpg" => "image/jpg", "JPG" => "image/JPG", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        // $filename = $_FILES["photo"]["name"];
        // $filetype = $_FILES["photo"]["type"];
        // $filesize = $_FILES["photo"]["size"];

        // // Verify file extension
        // $ext = pathinfo($filename, PATHINFO_EXTENSION);
        // if (!array_key_exists($ext, $allowed))
        //     die("Error: Please select a valid file format.");

        // // Verify file size - 5MB maximum
        // $maxsize = 5 * 1024 * 1024;
        // if ($filesize > $maxsize)
        //     die("Error: File size is larger than the allowed limit.");

        // // Verify MYME type of the file
        // if (in_array($filetype, $allowed)) {
        //     // Check whether file exists before uploading it
        //     if (file_exists("upload/" . $_FILES["photo"]["name"])) {
        //         echo $_FILES["photo"]["name"] . " is already exists.";
        //     } else {
        //         move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $_FILES["photo"]["name"]);
        //         echo "<script>alert('Your file was uploaded successfully');</script>";
        //     }
        // } else {
        //     echo "Error: There was a problem uploading your file. Please try again.";
        // }
    } elseif (isset($_POST['slider_image'])) {

        $slider_image = $_POST['slider_image'];
        $slider_title = $_POST['slider_title'];

        // Read the existing JSON object from the file
        $json_data = file_get_contents("json/data_slider.json");
        $data = json_decode($json_data, true);

        // Add the new data to the existing array
        $data['sliderImageList'][] = array(
            'slider_image' => $slider_image,
            'slider_title' => $slider_title
        );

        // Save the updated JSON object to the file
        file_put_contents('json/data_slider.json', json_encode($data));

        echo "<script>alert('Successfully Submitted Slider data');
            window.location.href = '../cartoonint';
            </script>";
    } elseif (isset($_POST['catArrayListN'])) {

    } elseif (isset($_POST['catArrayListNum'])) {

    } elseif (isset($_POST['sliderDelete'])) {

        $file = fopen('json/data_slider.json', 'w');
        fseek($file, 0);
        ftruncate($file, 0);
        fwrite($file, '[]');
        fclose($file);

        echo "<script>alert('Successfully Deleted all Slider data!');
        window.location.href = '../cartoonint';
        </script>";
    } elseif (isset($_POST['catDelete'])) {

        $file = fopen('json/data_category.json', 'w');
        fseek($file, 0);
        ftruncate($file, 0);
        fwrite($file, '[]');
        fclose($file);

        echo "<script>alert('Successfully Deleted all Category data!');
        window.location.href = '../cartoonint';
        </script>";

    }

}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cartoon INT | cPannel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php
    include 'inc/navbar.php';
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li class="nav-item">
                            <a class="tab nav-link" onclick="openTab(event, 'Tab1')" id="defaultOpen">
                                <i class="fs-4 bi-grid"></i>
                                <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a class="tab nav-link" onclick="openTab(event, 'Tab2')">
                                <i class="fs-4 bi-images"></i>
                                <span class="ms-1 d-none d-sm-inline">Img Upload</span>
                            </a>
                        </li>
                        <li>
                            <a class="tab nav-link" onclick="openTab(event, 'Tab3')">
                                <i class="fs-4 bi-images"></i>
                                <span class="ms-1 d-none d-sm-inline">Slider Item</span>
                            </a>
                        </li>
                        <li>
                            <a class="tab nav-link" onclick="openTab(event, 'Tab4')">
                                <i class="fs-4 bi-play-btn"></i>
                                <span class="ms-1 d-none d-sm-inline">Category</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col py-3">
                <!-- Tab content -->
                <div id="Tab1" class="tabcontent">
                    <p class="text-center fs-4 fw-bold">Cartoon International Mobile Apps</p>
                    <h2 class="text-center">Dashboard</h2>
                    <?php

                    // Image Slider Data
                    $json_data = file_get_contents("json/data_slider.json");
                    $data = json_decode($json_data, true);

                    echo "<p class='text-center fs-3'>Server have Image Slider data: <span class='text-center fs-3 fw-bold'>" . count($data) . "</span></p>";

                    ?>
                </div>

                <!-- TAB 2 -->
                <div id="Tab2" class="tabcontent">
                <div class="container text-center">
                        <h3 class="text-center">Notice Section</h3>
                    </div>

                    <hr>

                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <div class="col-md-3">
                            <div class="card text-center bg-warning bg-opacity-75">
                                <a class="text-decoration-none" href="other/image_upload.php">
                                    <div class="card-body text-black">
                                        <i class="fs-4 bi-cloud-upload"></i>
                                        <h5 class="card-title">Upload Image</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center bg-warning bg-opacity-75">
                                <a class="text-decoration-none" href="other/video_add.php">
                                    <div class="card-body text-black">
                                        <i class="fs-4 bi-images"></i>
                                        <h5 class="card-title">All Images</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center bg-warning bg-opacity-75">
                                <a class="text-decoration-none" href="other/video_add.php">
                                    <div class="card-body text-black">
                                        <i class="fs-4 bi-images"></i>
                                        <h5 class="card-title">Slider Category</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <form action="index.php" method="post">
                            <div>
                                <input type="hidden" name="catDelete" value="1">
                                <input class="btn btn-danger" type="submit" value="Delete All Data">
                            </div>
                        </form>
                    </div>

                </div>


                <!-- TAB 3 -->
                <div id="Tab3" class="tabcontent container text-center">
                    <div class="container text-center">
                        <h2 class="text-center">Image Slider</h2>
                    </div>
                    <div class="container text-center upload-section">
                        <form action="index.php" method="post">
                            <div class="input-group">
                                <input class="form-control" type="text" name="slider_image" placeholder="Image URL"
                                    required>
                            </div>
                            <br>
                            <div class="input-group">
                                <input class="form-control" type="text" name="slider_title" placeholder="Image Title"
                                    required>

                            </div>
                            <br>
                            <input class="btn btn-success" type="submit" value="Submit">
                        </form>
                        <hr>
                        <div class="text-center">
                            <a href="json/data_slider.json"><button class="btn btn-info">All Slider in JSON</button></a>
                        </div>
                        <hr>
                    </div>
                    <hr>
                    <div class="text-center">
                        <form action="index.php" method="post">
                            <div>
                                <input type="hidden" name="sliderDelete" value="1">
                                <input class="btn btn-danger" type="submit" value="Delete All Data">
                            </div>
                        </form>
                    </div>
                </div>

                <!-- TAB 4 -->
                <div id="Tab4" class="tabcontent">
                    <div class="container text-center">
                        <h3 class="text-center">Notice Section</h3>
                    </div>

                    <hr>

                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <div class="col-md-3">
                            <div class="card text-center bg-warning bg-opacity-75">
                                <a class="text-decoration-none" href="other/category_add.php">
                                    <div class="card-body text-black">
                                        <i class="fs-4 bi-plus-circle-fill"></i>
                                        <h5 class="card-title">Add Category</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center bg-warning bg-opacity-75">
                                <a class="text-decoration-none" href="other/video_add.php">
                                    <div class="card-body text-black">
                                        <i class="fs-4 bi-plus-circle-fill"></i>
                                        <h5 class="card-title">Add Video</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <form action="index.php" method="post">
                            <div>
                                <input type="hidden" name="catDelete" value="1">
                                <input class="btn btn-danger" type="submit" value="Delete All Data">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>








    <script>
        function openTab(evt, tabName) {
            // Get all elements with class="tabcontent" and hide them
            let tabcontent = document.getElementsByClassName("tabcontent");
            for (let i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tab" and remove the class "active"
            let tablinks = document.getElementsByClassName("tab");
            for (let i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Open the default tab (Tab 1)
        document.getElementById("defaultOpen").click();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>