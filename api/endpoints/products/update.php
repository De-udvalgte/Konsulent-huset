<?php

session_name("konsulent_huset");
session_start();

if (!is_csrf_valid()) {
    // The form is forged
    // Code here
    exit();
}

// include database and object files
require('api/config/database.php');
require('api/objects/product.php');

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$product = new Product($db);

// set ID property of product to be edited
$product->productId = $id;

// set product property values
$product->productName = filter_input(INPUT_POST, 'productName', FILTER_SANITIZE_STRING);
$product->productDesc = filter_input(INPUT_POST, 'productDesc', FILTER_SANITIZE_STRING);
$product->productTitle = filter_input(INPUT_POST, 'productTitle', FILTER_SANITIZE_STRING);
$product->price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT);

// update the product
if (
    !empty($product->productName) &&
    !empty($product->productDesc) &&
    !empty($product->productTitle) &&
    !empty($product->price) &&
    $product->update()
) {
    // set response code - 200 ok
    http_response_code(200);

    // set session success message
    $_SESSION['success_message'] = "Product was updated";

    // redirect to products page
    header("Location: /konsulent-huset/products");

}

// if unable to update the product, tell the user
else {

    // set response code - 503 service unavailable
    http_response_code(503);

    // set session error message
    $_SESSION['error_message'] = "Unable to update product";

    header("Location: /konsulent-huset/products");

    // log update product failed
    trigger_error("ID: " . $_SESSION['userId'] . " was unable to update product with id: " . $id, E_USER_WARNING);
}
?>