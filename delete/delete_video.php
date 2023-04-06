<?php

$json_data = file_get_contents('../json/data_category.json');
$data = json_decode($json_data, true);
$cat_id = $_POST['cat_id'];
$vdo_id = $_POST['vdo_id'];

if (isset($data['catArrayList'][$cat_id]['videoArrayList'][$vdo_id])) {
    unset($data['catArrayList'][$cat_id]['videoArrayList'][$vdo_id]);
    $data['catArrayList'][$cat_id]['videoArrayList'] = array_values($data['catArrayList'][$cat_id]['videoArrayList']);
    $json_data = json_encode($data);
    file_put_contents('../json/data_category.json', $json_data);
    $response = ['status' => 'success'];
} else {
    $response = ['status' => 'error'];
}

echo json_encode($response);

?>