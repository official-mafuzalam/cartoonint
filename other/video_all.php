<?php

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
}

$session_name = $_SESSION['name'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if file was uploaded without errors
    if (isset($_POST['delete_slider'])) {

        $file = fopen('../json/data_category.json', 'w');
        fseek($file, 0);
        ftruncate($file, 0);
        fwrite($file, '[]');
        fclose($file);

        echo "<script>alert('Successfully Deleted all Slider data!');
        window.location.href = '../';
        </script>";

    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cartoon International</title>
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
        <p class="fs-4">All Video Item.</p>
        <hr>
    </div>

    <div class="container text-center">
        <?php
        $json_data = file_get_contents('../json/data_category.json');
        $data = json_decode($json_data, true);
        ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="col">S No</th>
                    <th class="col">Title</th>
                    <th class="col">Item</th>
                    <th class="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($data['catArrayList']) && is_array($data['catArrayList'])) {
                    $i = 0;
                    foreach ($data['catArrayList'] as $catIndex => $row) {
                        foreach ($row['videoArrayList'] as $vdoIndex => $video) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td>
                                    <?php echo $row['category_name']; ?>
                                </td>
                                <td>
                                    <?php echo $video['vdo_title']; ?>
                                </td>
                                <td>
                                    <button id="delete-<?php echo $catIndex . '-' . $vdoIndex; ?>" class="dlt-video">Delete</button>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                    }
                }
                ?>
            </tbody>
        </table>
        <hr>
    </div>

    <!-- Post Item Delete -->
    <script>
        var deleteButtons = document.getElementsByClassName("dlt-video");
        for (var i = 0; i < deleteButtons.length; i++) {
            deleteButtons[i].onclick = function () {
                var ids = this.id.split("-"); // Splitting category and video IDs
                var catId = ids[0];
                var vdoId = ids[1];
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "../delete/delete_video.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.status === "success") {
                            alert("Selected item deleted successfully");
                            location.reload();
                        } else {
                            alert("Error deleting item");
                        }
                    }
                };
                xhr.send("cat_id=" + catId + "&vdo_id=" + vdoId);
            };
        }
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