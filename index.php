<?php

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}

$session_name = $_SESSION['name'];

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


    } elseif (isset($_POST['catArrayListN'])) {

    } elseif (isset($_POST['catArrayListNum'])) {

    } elseif (isset($_POST['sliderDelete'])) {

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
                    <h1 class="text-center fw-bold">Cartoon International Mobile App</h1>
                    <h2 class="text-center">Dashboard</h2>

                    <strong>
                        <p class="text-center fs-5" id="date">
                            <?php echo date("d-m-Y") . " " . date("l"); ?>
                        </p>
                    </strong>
                    <?php

                    // Image Slider Data
                    $json_data = file_get_contents("json/data_slider.json");
                    $data = json_decode($json_data, true);

                    // Category Data
                    $json_cat_data = file_get_contents('json/data_category.json');
                    $cat_data = json_decode($json_cat_data, true);

                    ?>

                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <div class="col-md-3">
                            <div class="card text-center bg-info bg-opacity-50">
                                <div class="card-body text-black">
                                    <h5 class="card-title">Image Slider</h5>
                                    <p class="card-text fs-3 fw-bold">
                                        <?php
                                        if (isset($data['sliderImageList']) && is_array($data['sliderImageList'])) {
                                            echo count($data['sliderImageList']);
                                        } else {
                                            echo "0";
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center bg-danger bg-opacity-50">
                                <div class="card-body text-black">
                                    <h5 class="card-title">Total Video Category</h5>
                                    <p class="card-text fs-3 fw-bold">
                                        <?php
                                        if (isset($cat_data['catArrayList']) && is_array($cat_data['catArrayList'])) {
                                            echo count($cat_data['catArrayList']);
                                        } else {
                                            echo "0";
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center bg-primary bg-opacity-50">
                                <div class="card-body text-black">
                                    <h5 class="card-title">Total Video</h5>
                                    <p class="card-text fs-3 fw-bold">
                                        <?php
                                        if (isset($cat_data['catArrayList']) && is_array($cat_data['catArrayList'])) {
                                            $total_videos = 0;
                                            foreach ($cat_data['catArrayList'] as $category) {
                                                if (isset($category['videoArrayList']) && is_array($category['videoArrayList'])) {
                                                    $total_videos += count($category['videoArrayList']);
                                                }
                                            }
                                            echo $total_videos;
                                        } else {
                                            echo "0";
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- TAB 2 -->
                <div id="Tab2" class="tabcontent">
                    <div class="container text-center">
                        <h3 class="text-center">Image Section</h3>
                    </div>

                    <hr>

                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <div class="col-md-3">
                            <div class="card text-center bg-info bg-opacity-75">
                                <a class="text-decoration-none" href="other/image_upload.php">
                                    <div class="card-body text-black">
                                        <i class="fs-4 bi-cloud-upload"></i>
                                        <h5 class="card-title">Upload Image</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center bg-primary bg-opacity-50">
                                <a class="text-decoration-none" href="other/image_all.php">
                                    <div class="card-body text-black">
                                        <i class="fs-4 bi-images"></i>
                                        <h5 class="card-title">All Images</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center bg-danger bg-opacity-50">
                                <a class="text-decoration-none" href="other/slider_add.php">
                                    <div class="card-body text-black">
                                        <i class="fs-4 bi-plus-circle-fill"></i>
                                        <h5 class="card-title">Slider Add</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center bg-warning bg-opacity-75">
                                <a class="text-decoration-none" href="other/slider_all.php">
                                    <div class="card-body text-black">
                                        <i class="fs-4 bi-table"></i>
                                        <h5 class="card-title">All Slider</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>



                <!-- TAB 4 -->
                <div id="Tab3" class="tabcontent">
                    <div class="container text-center">
                        <h3 class="text-center">Category Section</h3>
                    </div>

                    <hr>

                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <div class="col-md-3">
                            <div class="card text-center bg-warning bg-opacity-50">
                                <a class="text-decoration-none" href="other/category_add.php">
                                    <div class="card-body text-black">
                                        <i class="fs-4 bi-plus-circle-fill"></i>
                                        <h5 class="card-title">Add Category</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center bg-info bg-opacity-75">
                                <a class="text-decoration-none" href="other/category_all.php">
                                    <div class="card-body text-black">
                                        <i class="fs-4 bi-table"></i>
                                        <h5 class="card-title">All Category</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center bg-primary bg-opacity-25">
                                <a class="text-decoration-none" href="other/video_add.php">
                                    <div class="card-body text-black">
                                        <i class="fs-4 bi-plus-circle-fill"></i>
                                        <h5 class="card-title">Add Video</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center bg-danger bg-opacity-25">
                                <a class="text-decoration-none" href="other/video_all.php">
                                    <div class="card-body text-black">
                                        <i class="fs-4 bi-table"></i>
                                        <h5 class="card-title">All Video</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
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