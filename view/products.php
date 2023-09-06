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

<table class="table">

    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Title</th>
        <th>Description</th>
        <th>Price</th>
    </tr>

    <?php foreach (json_decode($result, true) as $product) { ?>

        <tr>
            <td><?php echo htmlspecialchars($product["productId"]) ?></td>
            <td><?php echo htmlspecialchars($product["productName"]) ?></td>
            <td><?php echo htmlspecialchars($product["productTitle"]) ?></td>
            <td><?php echo htmlspecialchars($product["productDesc"]) ?></td>
            <td><?php echo htmlspecialchars($product["price"]) ?></td>
        </tr>
    <?php
    };
    ?>
</table>

<?php include 'components/footer.php'; ?>