<?php
$result = file_get_contents('http://localhost/konsulent-huset/api/products');

?>

<?php include 'view/components/header.php'; ?>
<?php require 'view/components/auth_modal.php'; ?>
<main role="main" class="container">
    <div class="row">
        <div class="col">
            <h1>Products</h1>

            <table class="table">

                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price / Hour</th>
                    <th>&nbsp;</th>
                    <?php if ($_SESSION["rolesId"] == 2) { ?>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    <?php } ?>
                </tr>
                <?php $x = 0; ?>
                <?php foreach (json_decode($result, true) as $product) { ?>
                    <?php $x++ ?>
                    <tr>
                        <td>
                            <?php out($product["productId"]) ?>
                        </td>
                        <td>
                            <?php out($product["productName"]) ?>
                        </td>
                        <td>
                            <?php out($product["productTitle"]) ?>
                        </td>
                        <td>
                            <?php out($product["productDesc"]) ?>
                        </td>
                        <td>
                            <?php out($product["price"]) ?>
                        </td>

                        <td><a class="action" href="<?php out("products/page/" . $product['productId']) ?>">View</a></td>
                        <?php if ($_SESSION["rolesId"] == 2) { ?>
                            <td>
                                <a class="action" href="<?php out("products/edit/" . $product['productId']) ?>">Edit</a>
                            </td>
                            <td>
                                <?php insertAuthModal($x, "Confirm product deletion",  "btn btn-danger", '<i class="bi bi-trash3"></i>', "Delete product", "/konsulent-huset/products/delete/" . $product['productId'], "/konsulent-huset/products"); ?>
                            </td>
                        <?php } ?>
                    </tr>
                <?php
                };
                ?>
            </table>
        </div>
    </div>
</main>

<?php include 'view/components/footer.php'; ?>