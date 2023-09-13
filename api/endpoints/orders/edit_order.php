<?php

require('api/config/database.php');
require('api/objects/order.php');

session_name("konsulent_huset");
session_start();

// get database connection
$database = new Database();
$db = $database->getConnection();

$order = new Order($db);

if ($order->edit($orderId, $order)){
    // set response code
    http_response_code(200);

    echo json_encode(array("message" => "Order was edited."));
}
// message if unable to edit order
else{
    // set response code
    http_response_code(400);
    // display message: unable to edit order
    echo json_encode(array("message" => "Unable to edite order."));

    // log edit order failed
    trigger_error( $_SESSION['userId'] . " was unable to edit order with id: " . $orderId, E_USER_WARNING);
}
