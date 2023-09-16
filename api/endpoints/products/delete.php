<?php

require('api/config/database.php');
require('api/objects/product.php');

session_name("konsulent_huset");
session_start();

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

        // set session success message
        $_SESSION['success_message'] = "Product was deleted";

        // log delete product success
        trigger_error(getClientIP() . " || ID: " . $_SESSION['userId'] . " deleted product with id: " . $id . " || ", E_USER_NOTICE);
        
        header("Location: /konsulent-huset/products");
        
} else {
        // set response code - 503 service unavailable
        http_response_code(503);
        
        // set session error message
        $_SESSION['error_message'] = "Unable to delete product";

        // log delete product failed
        trigger_error(getClientIP() . " || ID: " . $_SESSION['userId'] . " was unable to delete product with id: " . $id . " || ", E_USER_WARNING);
        
        header("Location: /konsulent-huset/products");
}
