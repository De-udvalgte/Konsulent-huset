<?php
require("api/config/database.php");
require("api/objects/product.php");

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$result = $product->read();

?>
<?php include 'components/header.php'; ?>
<h1>Products</h1>

<?php
print_r($result);
?>
<?php include 'components/footer.php'; ?>