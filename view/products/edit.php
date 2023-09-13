<?php
$result = json_decode(file_get_contents('http://localhost/konsulent-huset/api/products/' . $id));

$productName = $result->productName;
$productDesc = $result->productDesc;
$productTitle = $result->productTitle;
$price = $result->price;

?>



<?php include 'view/components/header.php'; ?>
<main role="main" class="container">
    <div class="row">
        <div class="col">
            <h1>Edit Product</h1>
            <form action="<?php echo "/konsulent-huset/products/edit/" . $id ?>" method="POST">
                <?php set_csrf() ?>
                <div class="form-group">
                    <label for="productName">Name</label>
                    <input class="form-control" type="text" id="productName" name="productName"
                        value="<?php out($productName) ?>">
                </div>
                <div class="form-group">
                    <label for="productDesc">Description</label>
                    <input class="form-control" type="text" id="productDesc" name="productDesc"
                        value="<?php out($productDesc) ?>">
                </div>
                <div class="form-group">
                    <label for="productTitle">Title</label>
                    <input class="form-control" type="text" id="productTitle" name="productTitle"
                        value="<?php out($productTitle) ?>">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input class="form-control" type="number" step="any" id="price" name="price" value="<?php out($price) ?>">
                </div>

                <button class="btn btn-primary mt-3" type="submit">Update</button>
            </form>
        </div>
    </div>
</main>
<?php include 'view/components/footer.php'; ?>