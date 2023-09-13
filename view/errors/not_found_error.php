<?php include 'view/components/header.php';
// log not found error
if (isset($_SESSION["userId"])) {
  trigger_error("ID: " . $_SESSION['userId'] . " tried to access a page that does not exist", E_USER_WARNING);
} else {
  trigger_error("A user tried to access a page that does not exist", E_USER_WARNING);
}
?>
<div class="mt-4 p-5 bg-info text-muted rounded">
  <div class="container">
    <h1 style="text-align: center;">Page Not Found</h1>
    <h5 style="text-align: center;">Hmm... We could not find this page.</h5>
  </div>
</div>
<?php include 'view/components/footer.php'; ?>