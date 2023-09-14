<?php

require('api/config/database.php');
require('api/objects/order.php');

session_name("konsulent_huset");
session_start();

// get database connection
$database = new Database();
$db = $database->getConnection();

$order = new Order($db);

if (!$order->ownsOrder($orderId, $_SESSION["userId"]) && !$_SESSION["rolesId"] == 2){
    http_response_code(401);
    header("Location: /404");
    die();
}

$order->productId = filter_input(INPUT_POST, 'productId', FILTER_SANITIZE_STRING);
$order->startDate = filter_input(INPUT_POST, 'startDate', FILTER_SANITIZE_STRING);
$order->endDate = filter_input(INPUT_POST, 'endDate', FILTER_SANITIZE_STRING);
$order->address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);

if (
    !empty($order->productId) &&
    !empty($order->startDate) &&
    !empty($order->endDate) &&
    !empty($order->address) &&
    $order->edit($orderId, $order)
) {
    // set response code
    http_response_code(200);

    // set session success message
    $_SESSION['success_message'] = "Order was edited";

    // redirect to orders page
    header("Location: /konsulent-huset/orders");

    
}
// message if unable to edit order
else{
    // set response code
    http_response_code(400);
    
    // set session error message
    $_SESSION['error_message'] = "Something went wrong: Unable to edit order";

    // redirect to orders page
    header("Location: /konsulent-huset/orders");
    
    // log edit order failed
    trigger_error( $_SESSION['userId'] . " was unable to edit order with id: " . $orderId, E_USER_WARNING);
}
