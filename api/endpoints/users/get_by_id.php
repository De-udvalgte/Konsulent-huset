<?php

require('api/config/database.php');
require('api/objects/user.php');

// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate product object
$user = new User($db);
$user->userId = $userId;

$stmt = $user->getById();

if ($stmt->rowCount() > 0) {
    $users_arr = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $user_item = array(
            "userId" => $userId,
            "firstName" => $firstName,
            "lastName" => $lastName,
            "email" => $email,
            "created" => $created,
            "modified" => $modified,
            "rolesId" => $rolesId,
        );

        array_push($users_arr, $user_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($users_arr);
} else {

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No users found.")
    );
}
