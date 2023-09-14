<?php
include 'view/components/header.php';
require 'view/components/auth_modal.php';
$result = file_get_contents('http://localhost/konsulent-huset/api/products');
?>

<main role="main" class="container">
    <div class="row">
        <div class="col">

            <?php if (isset($success_message)) { ?>
                <div class="alert alert-success" role="alert">
                    <?php out($success_message) ?>
                </div>
            <?php } else if (isset($error_message)) { ?>
                    <div class="alert alert-danger" role="alert">
                    <?php out($error_message) ?>
                    </div>
            <?php } ?>

            <h1>Products</h1>
            <table class="table">

                <tr>
                    <?php if ($_SESSION["rolesId"] == 2) { ?>
                        <th>Id</th>
                    <?php } ?>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price / Hour</th>
                    <th>&nbsp;</th>
                    <?php if ($_SESSION["rolesId"] == 2) { ?>
                        <th>&nbsp;</th>

                    <?php } ?>
                </tr>
                <?php $x = 0; ?>
                <?php foreach (json_decode($result, true) as $product) { ?>
                    <?php $x++ ?>
                    <tr>
                        <?php if ($_SESSION["rolesId"] == 2) { ?>
                            <td>
                                <?php out($product["productId"]) ?>
                            </td>
                        <?php } ?>
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

                        <td><a class="me-1 btn btn-success" href="<?php out("products/page/" . $product['productId']) ?>"><i
                                    class="bi bi-info-circle"></i></a>
                            <?php if ($_SESSION["rolesId"] == 2) { ?>

                                <a class="me-1 btn btn-primary" href="<?php out("products/edit/" . $product['productId']) ?>"><i
                                        class="bi bi-pencil"></i></a>
                               
                                    <?php insertAuthModal($x, "Confirm product deletion", "btn btn-danger", '<i class="bi bi-trash3"></i>', "Delete product", "/konsulent-huset/products/delete/" . $product['productId'], "/konsulent-huset/products"); ?>
                            
                            <?php } ?>
                        </td>
                    </tr>
                    <?php
                }
                ;
                ?>
            </table>
        </div>
    </div>
</main>

<?php include 'view/components/footer.php'; ?>