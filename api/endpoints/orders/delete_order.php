<?php

require('api/config/database.php');
require('api/objects/order.php');

session_name("konsulent_huset");
session_start();

// get database connection
$database = new Database();
$db = $database->getConnection();

$order = new Order($db);

if ($order->delete($orderId)){
    // set response code
    http_response_code(200);

    echo json_encode(array("message" => "Product was deleted."));
}
// message if unable to create product
else{
    // set response code
    http_response_code(400);
    // display message: unable to create product
    echo json_encode(array("message" => "Unable to delete product."));
}
