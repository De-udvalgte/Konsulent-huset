<?php

require('api/config/database.php');
require('api/objects/order.php');

session_name("konsulent_huset");
session_start();

// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate product object
$order = new Order($db);

// get posted data
//$data = json_decode(file_get_contents("php://input"));

// set product property values
$order->orderNumber = rand(1000,9999);
$order->productId = $_POST["productId"];
$order->startDate = $_POST["startDate"];
$order->endDate = $_POST["endDate"];
$order->address = $_POST["address"];

if ($_SESSION['rolesId'] === 1){
    $order->userId = $_SESSION['userId'];
} elseif ($_SESSION['rolesId'] === 2){
    $order->userId = $_POST["userId"];
}

// create the product
if (
    !empty($order->productId) &&
    !empty($order->userId) &&
    !empty($order->startDate) &&
    !empty($order->endDate) &&
    !empty($order->address) &&
    $order->create()
) {
    // set response code
    http_response_code(200);
    header("Location: /konsulent-huset/orders");
    // display message: product was created
    echo json_encode(array("message" => "Order was created."));
} // message if unable to create product
else {
    // set response code
    http_response_code(400);
    // display message: unable to create product
    echo json_encode(array("message" => "Unable to create order."));
}

