<?php

require('api/config/database.php');
require('api/objects/user.php');

// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate user object
$user = new User($db);

// set user property values
$user->userId = $userId;  // gets id from router 

// delete the user
if ($user->delete()) {
    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    header("Location: /konsulent-huset/users");
    echo json_encode(array("message" => "User was deleted."));
} else {
    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to delete user."));
}
