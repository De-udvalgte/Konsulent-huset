<?php $result = file_get_contents('http://localhost/konsulent-huset/api/products'); ?>

<?php include 'view/components/header.php'; ?>
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
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>

                <?php foreach (json_decode($result, true) as $product) { ?>

                    <tr>
                        <td>
                            <?php echo htmlspecialchars($product["productId"]) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($product["productName"]) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($product["productTitle"]) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($product["productDesc"]) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($product["price"]) ?>
                        </td>
                        <td><a class="action" href="">View</a></td>
                        <td><a class="action" href="">Edit</a></td>
                        <td><a class="action" href="">Delete</a></td>
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