<?php

require('api/config/database.php');
require('api/objects/user.php');

// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate product object
$user = new User($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set product property values
$user->userId = $userId;
$user->firstName = $_POST["firstName"];
$user->lastName = $_POST["lastName"];
$user->email = $_POST["email"];
$user->password = $_POST["password"];
$user->rolesId = $_POST["rolesId"];


if (
    !empty($user->userId) &&
    !empty($user->firstName) &&
    !empty($user->lastName) &&
    !empty($user->email) &&
    !empty($user->password) &&
    !empty($user->rolesId) &&
    $user->update()

) {

    // set response code
    http_response_code(200);
    header("Location: /konsulent-huset");
    // display message: user was updated
    echo json_encode(array("message" => "User was updated."));
}
// message if unable to update user
else {
    // set response code
    http_response_code(400);
    // display message: unable to update user
    echo json_encode(array("message" => "Unable to update user.", $user->email));
}
