<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['file'])) {
    $fileName = $_POST['file'];
    $filePath = '../img_slider/' . $fileName;
    // Check if the file exists
    if (file_exists($filePath)) {
        // Attempt to delete the file
        if (unlink($filePath)) {
            // Return a success response
            echo 'success';
        } else {
            // Return an error response
            echo 'error';
        }
    } else {
        // Return an error response if the file doesn't exist
        echo 'error';
    }
}


?>