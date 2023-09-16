<?php

session_name("konsulent_huset");
session_start();

if (!is_csrf_valid()) {
    // The form is forged
    trigger_error(getClientIP() . " || CSRF token not valid on new Signup with email: " . $_POST["email"] . " || ", E_USER_WARNING);
    exit();
}

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
$user->firstName = $_POST["firstName"];
$user->lastName = $_POST["lastName"];
$user->email = $_POST["email"];
$user->password = $_POST["password"];


if (
    !empty($user->firstName) &&
    !empty($user->lastName) &&
    !empty($user->email) &&
    !empty($user->password) &&
    $user->create()

) {

    // set response code
    http_response_code(200);

    if (
        !empty($_SESSION["rolesId"]) && $_SESSION["rolesId"] == 2
    ) {
        header("Location: users"); // redirects back to admins users page after registered a new user
    } else {
        header("Location: login");
    }
    ;
    // display message: user was created
    echo json_encode(array("message" => "User was created."));
}
// message if unable to create user
else {
    // set response code
    http_response_code(400);
    // display message: unable to create user
    echo json_encode(array("message" => "Unable to create user.", $user->email));

    // log register failed
    trigger_error(getClientIP() . " || Register user failed for email: " . $_POST["email"] . " || ", E_USER_WARNING);
}