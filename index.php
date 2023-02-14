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

        // $catArrayListNum = $_POST['catArrayListNum'];
        $category_name2 = $_POST['category_name2'];

        $json_data = file_get_contents("json/data_category.json");
        $catArrayList = json_decode($json_data, true);

        $catArrayList2 = array(
            "catArrayList" => array(
                array(
                    "category_name" => $category_name2,
                    "img" => $_POST["img_url2"],
                    "videoArrayList" => array(
                        array(
                            "vdo_id" => $_POST["vdo_id2"],
                            "vdo_title" => $_POST["vdo_title2"],
                            "vdo_desciption" => $_POST["vdo_description2"]
                        )
                    )
                )
            )
        );

        $catArrayList = array_merge_recursive($catArrayList, $catArrayList2);


        // // Save the updated JSON object to the file
        file_put_contents('json/data_category.json', json_encode($catArrayList));

        echo "<script>alert('Successfully Submitted Category data');
            window.location.href = '../cartoonint';
            </script>";
    } elseif (isset($_POST['catArrayListNum'])) {

        $catArrayListNum = $_POST['catArrayListNum'];
        // $category_name2 = $_POST['category_name2'];

        $json_data = file_get_contents("json/data_category.json");
        $catArrayList = json_decode($json_data, true);

        $new_video = array(
            "vdo_id" => $_POST["vdo_id"],
            "vdo_title" => $_POST["vdo_title"],
            "vdo_desciption" => $_POST["vdo_description"]
        );

        array_unshift($catArrayList["catArrayList"][$catArrayListNum]["videoArrayList"], $new_video);

        // // Save the updated JSON object to the file
        file_put_contents('json/data_category.json', json_encode($catArrayList));

        echo "<script>alert('Successfully Submitted Video data');
            window.location.href = '../cartoonint';
            </script>";

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

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">
        <!-- Navigation tabs -->
        <div id="tabs">
            <button class="tab" onclick="openTab(event, 'Tab1')" id="defaultOpen">Home</button>
            <button class="tab" onclick="openTab(event, 'Tab2')">Img Slider</button>
            <button class="tab" onclick="openTab(event, 'Tab3')">Item Slider</button>
            <button class="tab" onclick="openTab(event, 'Tab4')">Cat Add</button>
            <button class="tab" onclick="openTab(event, 'Tab5')">Video Add</button>
            <!-- <button class="tab" href="upload.php">Image Upload</button> -->
        </div>
        <!-- <div id="tabs">
            <button class="tab" onclick="openTab(event, 'Tab5')">Hospital</button>
            <button class="tab" onclick="openTab(event, 'Tab6')">Daily News</button>
            <button class="tab" onclick="openTab(event, 'Tab7')">Community</button>
            <button class="tab" onclick="openTab(event, 'Tab8')">Sports</button>
            <button class="tab" onclick="openTab(event, 'Tab9')">E-Seba</button>
            <button class="tab" onclick="openTab(event, 'Tab10')">E-Commerce</button>
        </div> -->
    </div>





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
        <h1 class="text-center">Upload Image for Slider</h1>

        <div class="container text-center upload-section">

            <form action="index.php" method="post" enctype="multipart/form-data">
                <div class="input-group text-center">
                    <input type="file" class="form-control" id="file" name="photo_slider" aria-label="Upload" required>
                </div>
                <input class="btn btn-success" type="submit" value="Upload">

            </form>

            <!-- <div class="text-center" style="margin-top: 50px;">
                <a href="json_image/json_imgProduct.php"><button class="btn btn-info">All Product Images in
                        JSON</button></a>
            </div> -->
            <?php

            // Check if the form was submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Check if file was uploaded without errors
                if (isset($_FILES["photo_slider"]) && $_FILES["photo_slider"]["error"] == 0) {
                    $allowed = array("jpg" => "image/jpg", "JPG" => "image/JPG", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                    $filename = $_FILES["photo_slider"]["name"];
                    $filetype = $_FILES["photo_slider"]["type"];
                    $filesize = $_FILES["photo_slider"]["size"];

                    // Verify file extension
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    if (!array_key_exists($ext, $allowed))
                        die("Error: Please select a valid file format.");

                    // Verify file size - 5MB maximum
                    $maxsize = 5 * 1024 * 1024;
                    if ($filesize > $maxsize)
                        die("Error: File size is larger than the allowed limit.");

                    // Verify MYME type of the file
                    if (in_array($filetype, $allowed)) {
                        // Check whether file exists before uploading it
                        if (file_exists("img/img_slider/" . $_FILES["photo_slider"]["name"])) {
                            echo $_FILES["photo_slider"]["name"] . " is already exists.";
                        } else {
                            move_uploaded_file($_FILES["photo_slider"]["tmp_name"], "img/img_slider/" . $_FILES["photo_slider"]["name"]);
                            echo "<script>alert('Your Slider picture was uploaded successfully');
                            window.location.href = '../cartoonint';
                            </script>";
                        }
                    } else {
                        echo "Error: There was a problem uploading your file. Please try again.";
                    }
                } else {
                    // echo "Error: " . $_FILES["photo_slider"]["error"];
                }
            }

            // Retrieve the names of all the uploaded files
            $uploaded_files = array_diff(scandir("img/img_slider/"), array('.', '..'));

            // Display the images on the page
            foreach ($uploaded_files as $file) {

                echo '<div class="w-50 p-3">
                    <img class="img-fluid rounded img-thumbnail " src="img/img_slider/' . $file . '" alt="' . $file . '" />
                </div>';
            }

            ?>

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
                    <input class="form-control" type="text" name="slider_image" placeholder="Image URL" required>
                </div>
                <br>
                <div class="input-group">
                    <input class="form-control" type="text" name="slider_title" placeholder="Image Title" required>

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
    <div id="Tab4" class="tabcontent container text-center">
        <div class="container text-center">
            <h2 class="text-center">Item Category</h2>
        </div>
        <div class="container text-center upload-section">
            <form action="index.php" method="post">
                <div class="input-group">
                    <input class="form-control" type="number" id="catArrayList" name="catArrayListN"
                        placeholder="Cat. Array List number">
                </div>
                <br>
                <div class="input-group">
                    <input class="form-control" type="text" id="category_name" name="category_name2"
                        placeholder="Category Name" required>
                </div>
                <br>
                <div class="input-group">
                    <input class="form-control" type="url" id="img_url" name="img_url2" placeholder="Image Url"
                        required>
                </div>
                <br>
                <div class="input-group">
                    <input class="form-control" type="text" id="vdo_id" name="vdo_id2" placeholder="Video Id" required>
                </div>
                <br>
                <div class="input-group">
                    <input class="form-control" type="text" id="vdo_title" name="vdo_title2" placeholder="Video Title"
                        required>
                </div>
                <br>
                <div class="input-group">
                    <input class="form-control" type="text" id="vdo_description" name="vdo_description2"
                        placeholder="Video Description" required>
                </div>
                <br>
                <input class="btn btn-success" type="submit" value="Submit">
            </form>
            <hr>
            <div class="text-center">
                <a href="json/data_category.json"><button class="btn btn-info">All Slider in JSON</button></a>
            </div>
            <hr>
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


    <!-- TAB 5 -->
    <div id="Tab5" class="tabcontent container text-center">
        <div class="container text-center">
            <h2 class="text-center">Item Video</h2>
        </div>
        <div class="container text-center upload-section">
            <form action="index.php" method="post">
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
                <input class="btn btn-success" type="submit" value="Submit">
            </form>
            <hr>
            <div class="text-center">
                <a href="json/data_category.json"><button class="btn btn-info">All Slider in JSON</button></a>
            </div>
            <hr>
        </div>
        <hr>
        <!-- <div class="text-center">
            <form action="index.php" method="post">
                <div>
                    <input type="hidden" name="sliderDelete" value="1">
                    <input class="btn btn-danger" type="submit" value="Delete All Data">
                </div>
            </form>
        </div> -->
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