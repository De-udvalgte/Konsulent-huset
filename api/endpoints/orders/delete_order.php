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

$order = new Order($db);

if ($order->delete($orderId)){
    // set response code
    http_response_code(200);

    // set session success message
    $_SESSION['success_message'] = "Order was deleted";

    // redirect to orders page
    header("Location: /konsulent-huset/orders");
}
// message if unable to delete order
else{
    // set response code
    http_response_code(400);
    
    // set session error message
    $_SESSION['error_message'] = "Something went wrong: Unable to delete order";

    // redirect to orders page
    header("Location: /konsulent-huset/orders");

    // log delete order failed
    trigger_error( $_SESSION['userId'] . " was unable to delete order with id: " . $orderId, E_USER_WARNING);

}
