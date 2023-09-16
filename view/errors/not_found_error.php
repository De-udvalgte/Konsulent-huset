<?php include 'view/components/header.php';

// Check if user tried to access unauthorized page
if (isset($_SESSION["unauthorized"])) {
  $unauthorized = $_SESSION["unauthorized"];
  unset($_SESSION["unauthorized"]);
}
else {
  $unauthorized = false;
}

// log not found error
if (isset($_SESSION["userId"])) {
  if ($unauthorized == true) {
    trigger_error(getClientIP() . " || ID: " . $_SESSION['userId'] . " tried to access a page with 401 status code || ", E_USER_WARNING);
  } else {
    trigger_error(getClientIP() . " || ID: " . $_SESSION['userId'] . " tried to access a page with 404 status code || ", E_USER_WARNING);
  }
} else {
  if ($unauthorized == true) {
    trigger_error(getClientIP() . " || An unknown user tried to access a page with 401 status code || ", E_USER_WARNING);
  } else {
    trigger_error(getClientIP() . " || An unknown user tried to access a page with 404 status code || ", E_USER_WARNING);
  }
}


?>
<div class="mt-4 p-5 bg-info text-muted rounded">
  <div class="container">
    <h1 style="text-align: center;">Page Not Found</h1>
    <h5 style="text-align: center;">Hmm... We could not find this page.</h5>
  </div>
</div>
<?php include 'view/components/footer.php'; ?>