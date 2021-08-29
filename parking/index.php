<?php
include_once('interfaces.php');
include_once('classes.php');
include_once('helpers.php');

$floorListCode = $_REQUEST['floor_list'];
$carListCode = $_REQUEST['car_list'];
if (!$floorListCode && !$carListCode) {
    echo 'Сформируйте строку запроса в виде: /?floor_list=3 3 5&car_list=c c t c c c t';
    exit();
}

$parking = HelperParking::createParking($floorListCode);
$cars = HelperCars::CreateCarList($carListCode);
$resultArr = [];

foreach ($cars as $item) {
    $resultArr[] = $parking->takeCar($item) ? 'y' : 'n';
}

$resultStr = implode(' ', $resultArr);

var_dump($resultStr);

//var_dump($parking);
//var_dump($cars);
