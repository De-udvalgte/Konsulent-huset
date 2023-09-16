<?php

require('api/config/database.php');
require('api/objects/user.php');
require('api/objects/order.php');

session_name("konsulent_huset");
session_start();

if ($_SESSION['rolesId'] != 2) {
    $_SESSION['unauthorized'] = true;
    header("Location: /konsulent-huset/404");
    exit();
}

// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate user object
$user = new User($db);
$order = new Order($db);

// set user property values
$user->userId = $userId; // gets id from router 

// delete the user
if ($order->deleteByUserId($user->userId) && $user->delete()) {
    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    if ($_SESSION["userId"] == $userId) {
        header("Location: /konsulent-huset/logout");
    } else {
        header("Location: /konsulent-huset/users");
    }
    echo json_encode(array("message" => "User was deleted."));
} else {
    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to delete user."));

    // log delete user failed
    if ($_SESSION["userId"] == $userId) {
        trigger_error(getClientIP() . " || ID: " . $_SESSION['userId'] . " was unable to delete account || ", E_USER_WARNING);
    } else {
        trigger_error(getClientIP() . " || ID: " . $_SESSION['userId'] . " was unable to delete user with id: " . $userId . " || ", E_USER_WARNING);
    }
}