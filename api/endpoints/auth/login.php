<?php

if (!is_csrf_valid()) {
    // The form is forged
    // Code here
    exit();
}

require('api/config/database.php');
require('api/objects/user.php');

// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate product object
$user = new User($db);

// set product property values
$user->email = $_POST["email"];
$email_exists = $user->emailExists();

if ($email_exists && password_verify($_POST["password"], $user->password)) {
    //set response code
    http_response_code(200);

    session_name("konsulent_huset");
    session_start();
    $_SESSION["userId"] = $user->userId;
    $_SESSION["firstName"] = $user->firstName;
    $_SESSION["lastName"] = $user->lastName;
    $_SESSION["email"] = $user->email;
    $_SESSION["rolesId"] = $user->rolesId;
    unset($_SESSION["login_attempt"]);
    header("Location: /konsulent-huset");
    echo json_encode(array("message" => "Successful login."));
}
// login failed
else {
    // set response code
    http_response_code(401);
    $_SESSION["login_attempt"] = array("hasFailed" => true, "email" => $_POST["email"]);
    header("Location: /konsulent-huset/login");

    // tell the user login failed
    echo json_encode(array("message" => "Login failed."));
}
