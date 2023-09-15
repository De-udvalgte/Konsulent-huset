<?php

/*if (!is_csrf_valid()) {
    // The form is forged
    // Code here
    exit();
}
*/

session_name("konsulent_huset");
session_start();

require('api/config/database.php');
require('api/objects/user.php');

// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate product object
$user = new User($db);


// set product property values
$user->email = $_SESSION["email"];
$email_exists = $user->emailExists();


if ($email_exists && password_verify($_POST["password"], $user->password)) {
    //set response code
    http_response_code(200);
    header("Location: " . $_POST["action_href"]);
    echo json_encode(array("message" => "Successfully verification."));
}
// login failed
else {
    // set response code
    http_response_code(401);

    // tell the user login failed
    header("Location: " . $_POST["prev_dir"]);
    echo json_encode(array("message" => "Verification failed."));
}
