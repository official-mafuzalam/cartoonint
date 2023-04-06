<?php

$json_data = file_get_contents('../json/data_slider.json');
$data = json_decode($json_data, true);
$id = $_POST['id'];

if (isset($data['sliderImageList'][$id])) {
    unset($data['sliderImageList'][$id]);
    $data['sliderImageList'] = array_values($data['sliderImageList']);
    $json_data = json_encode($data);
    file_put_contents('../json/data_slider.json', $json_data);
    $response = ['status' => 'success'];
} else {
    $response = ['status' => 'error'];
}

echo json_encode($response);

?>
