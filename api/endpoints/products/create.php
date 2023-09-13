<?php

session_name("konsulent_huset");
session_start();

if (!is_csrf_valid()) {
    // The form is forged
    // Code here
    exit();
}

require('api/config/database.php');
require('api/objects/product.php');

// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate product object
$product = new Product($db);

// get posted data
//$data = json_decode(file_get_contents("php://input"));

// set product property values
$product->productName = $_POST["productName"];
$product->productDesc = $_POST["productDesc"];
$product->productTitle = $_POST["productTitle"];
$product->price = $_POST["price"];


// create the product
if (
    !empty($product->productName) &&
    !empty($product->productDesc) &&
    !empty($product->productTitle) &&
    !empty($product->price) &&
    $product->create()
) {
    // set response code
    http_response_code(200);
   
     // set session success message
     $_SESSION['success_message'] = "Product was created";
   
    header("Location: /konsulent-huset/products");
   
}
// message if unable to create product
else {
    // set response code
    http_response_code(400);
    
    // set session error message
    $_SESSION['error_message'] = "Unable to create product";

    // log create product failed
    trigger_error("ID: " . $_SESSION['userId'] . " was unable to create product with name: " . $product->productName, E_USER_WARNING);
}