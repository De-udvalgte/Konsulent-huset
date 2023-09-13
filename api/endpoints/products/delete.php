<?php

require('api/config/database.php');
require('api/objects/product.php');

// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate product object
$product = new Product($db);

// set product property values
$product->productId = $id;  // gets id from router 

// delete the product
if ($product->delete()) {
        // set response code - 200 ok
        http_response_code(200);

        // tell the user
        header("Location: /konsulent-huset/products");
        echo json_encode(array("message" => "Product was deleted."));
} else {
        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to delete product."));

        // log delete product failed
        trigger_error("ID: " . $_SESSION['userId'] . " was unable to delete product with id: " . $id, E_USER_WARNING);
}