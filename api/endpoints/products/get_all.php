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

$stmt = $product->read();

if ($stmt->rowCount() > 0) {
    $products_arr = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $product_item = array(
            "productId" => $productId,
            "productName" => $productName,
            "productDesc" => $productDesc,
            "productTitle" => $productTitle,
            "price" => $price
        );

        array_push($products_arr, $product_item);
    }

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
    trigger_error(getClientIP() . " || User was unable to find any products || ", E_USER_WARNING);
}

