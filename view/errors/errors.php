<?php

/* $error = $_SERVER["REDIRECT_STATUS"];

$error_title = '';
$error_message = '';

if($error == 400){
    $error_title = '400 bad request';
    $error_message = 'I understood nothing';

} */

/* $status = $_SERVER['REDIRECT_STATUS'];
$codes = array(
    400 => array('400 Forbidden', 'Something went wrong'),
    401 => array('401 Forbidden', 'Something went wrong'),
    403 => array('403 Forbidden', 'Something went wrong'),
    500 => array('500 Forbidden', 'Something went wrong'),
);

$title = $codes[$status][0];
$message = $codes[$status][1];
if ($title == false || strlen($status) != 3) {
    $message = 'Please supply valid status code';
} */
?>

<?php include 'view/components/header.php'; ?>
<div>
<h1 style="text-align: center;">Page Not Found</h1>
     <h5 style="text-align: center;">Hmm... We could not find this page.</h5>
        
</div>
<?php include 'view/components/footer.php'; ?>