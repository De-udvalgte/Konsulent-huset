<?php

require('api/config/database.php');
require('api/objects/order.php');

session_name("konsulent_huset");
session_start();

// get database connection
$database = new Database();
$db = $database->getConnection();

$order = "";
$stmt = "";

// Authorize and figure out whether its "find all" or "find by ID"
if (isset($userId) && ($_SESSION['userId'] == $userId || $_SESSION['rolesId'] == 2)) {
    $order = new Order($db);
    $stmt = $order->getById($userId);

} else if (!isset($userId) && $_SESSION['rolesId'] == 2) {
    $order = new Order($db);
    $stmt = $order->getAll();

} else {
    http_response_code(401);

    echo json_encode(
        array("message" => "Unauthorized")
    );

    die();
}

// Continue request if authorized
if ($stmt->rowCount() > 0) {

    $orders_arr = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $productName = $order->getProdNameByOrderId($orderId);

        $order_item = array(
            "orderId" => $orderId,
            "orderNumber" => $orderNumber,
            "productId" => $productId,
            "userId" => $userId,
            "orderDate" => $orderDate,
            "startDate" => $startDate,
            "endDate" => $endDate,
            "address" => $address,
            "productName" => $productName
        );

        array_push($orders_arr, $order_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show orders data in json format
    echo json_encode($orders_arr);
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no orders found
    echo json_encode(
        array("message" => "No orders found.")
    );
}
