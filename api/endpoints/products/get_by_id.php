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

// set ID property of record to read
$product->productId = $id;

// read the details of product to be edited
$product->get_by_id();

if ($product != null) {
    $products_arr = array(
        "productId" => $product->productId,
        "productName" => $product->productName,
        "productDesc" => $product->productDesc,
        "productTitle" => $product->productTitle,
        "price" => $product->price,
    );

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($products_arr);
} else {

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );

    // log no products found
    trigger_error(getClientIP() . " || User was unable to find product by Id: " . $id . " || ", E_USER_WARNING);
}