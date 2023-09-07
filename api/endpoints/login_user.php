<?php

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

if($email_exists && password_verify($_POST["password"], $user->password )){
    //set response code
    http_response_code(200);
    // generate session 
    session_start();
    echo json_encode(array("message" => "Successful login."));
}
// login failed
else{
    // set response code
    http_response_code(401);
    // tell the user login failed
    echo json_encode(array("message" => "Login failed."));

}