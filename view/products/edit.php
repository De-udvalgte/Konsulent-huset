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
        <div class="col pt-5">
            <h1 class="pt-5">Edit Product</h1>
            <form action="<?php echo "/konsulent-huset/products/edit/" . $id ?>" method="POST">
                <div class="form-group">
                    <label for="productName">Name</label>
                    <input class="form-control" type="text" id="productName" name="productName" value="<?php echo $productName; ?>">
                </div>
                <div class="form-group">
                    <label for="productDesc">Description</label>
                    <input class="form-control" type="text" id="productDesc" name="productDesc" value="<?php echo $productDesc; ?>">
                </div>
                <div class="form-group">
                    <label for="productTitle">Title</label>
                    <input class="form-control" type="text" id="productTitle" name="productTitle" value="<?php echo $productTitle; ?>">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input class="form-control" type="number" id="price" name="price" value="<?php echo $price; ?>">
                </div>

                <button class="btn btn-primary mt-3" type="submit">Update</button>
            </form>
        </div>
    </div>
</main>
<?php include 'view/components/footer.php'; ?>