<?php

$json_data = file_get_contents('../json/data_category.json');
$data = json_decode($json_data, true);
$id = $_POST['id'];

if (isset($data['catArrayList'][$id])) {
    unset($data['catArrayList'][$id]);
    $data['catArrayList'] = array_values($data['catArrayList']);
    $json_data = json_encode($data);
    file_put_contents('../json/data_category.json', $json_data);
    $response = ['status' => 'success'];
} else {
    $response = ['status' => 'error'];
}

echo json_encode($response);

?>
