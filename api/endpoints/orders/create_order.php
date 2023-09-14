<?php

require('api/config/database.php');
require('api/objects/order.php');

session_name("konsulent_huset");
session_start();

if (!in_array($_SESSION['rolesId'], [1, 2])) {
    header("Location: /konsulent-huset/404");
    exit();
}

// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate product object
$order = new Order($db);

// set product property values
$order->orderNumber = rand(1000, 9999);
$order->productId = $_POST["productId"];
$order->startDate = $_POST["startDate"];
$order->endDate = $_POST["endDate"];
$order->address = $_POST["address"];

if ($_SESSION['rolesId'] == 1) {
    $order->userId = $_SESSION['userId'];
} elseif ($_SESSION['rolesId'] == 2) {
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

    // set session success message
    $_SESSION['success_message'] = "Order was created";

    // set response code
    http_response_code(200);
    header("Location: /konsulent-huset/orders");
} // message if unable to create order
else {
    // set response code
    http_response_code(400);

    // set session error message
    $_SESSION['error_message'] = "Something went wrong: Unable to create order";

    // redirect to orders page
    header("Location: /konsulent-huset/orders");

    // log create order failed
    trigger_error("ID: " . $_SESSION['userId'] . " was unable to create order for user with id: " . $_SESSION['userId'], E_USER_WARNING);
}
