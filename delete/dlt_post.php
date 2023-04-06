<?php

$json_data = file_get_contents('../json/post.json');
$data = json_decode($json_data, true);
$id = $_POST['id'];

if (isset($data[$id])) {
    unset($data[$id]);
    $json_data = json_encode(array_values($data));
    file_put_contents('../json/post.json', $json_data);
    $response = ['status' => 'success'];
} else {
    $response = ['status' => 'error'];
}

echo json_encode($response);

?>