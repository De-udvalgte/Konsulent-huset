<?php

require('api/config/database.php');
require('api/objects/order.php');

session_name("konsulent_huset");
session_start();

if (!in_array($_SESSION['rolesId'], [1, 2])) {
    $_SESSION['unauthorized'] = true;
    header("Location: /konsulent-huset/404");
    exit();
}

// get database connection
$database = new Database();
$db = $database->getConnection();

$order = new Order($db);
$stmt = "";
$authorized = false;

// Authorize and figure out whether its "get all", "get by userId" or "get by orderId"
if (isset($userId)) {
    // Get by userId
    if ($_SESSION['userId'] == $userId || $_SESSION['rolesId'] == 2) {
        $stmt = $order->getById($userId);
        $authorized = true;
    }

} else if (isset($orderId) && isset($_SESSION['userId'])) {
    // Get by orderId
    if ($order->ownsOrder($orderId, $_SESSION['userId']) || $_SESSION['rolesId'] == 2) {
        $stmt = $order->getByOrderId($orderId);
        $authorized = true;
    }

} else {
    // Get all
    if ($_SESSION['rolesId'] == 2) {
        $stmt = $order->getAll();
        $authorized = true;
    }
}

if (!$authorized) {
    http_response_code(401);

    echo json_encode(
        array("message" => "Unauthorized")
    );

    die();
} else {

    // Continue request if authorized
    if ($stmt->rowCount() > 0) {

        $orders_arr = "";

        if ($stmt->rowCount() > 1){
            $orders_arr = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

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
        } else {
            $orders_arr = $stmt->fetch(PDO::FETCH_ASSOC);
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

        // log no orders found
        trigger_error(getClientIP() . " || ID: " . $_SESSION['userId'] . " was unable to find any orders. || ", E_USER_WARNING);
    }
}
