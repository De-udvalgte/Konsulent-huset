<?php include 'view/components/header.php'; ?>
<main role="main" class="container">
    <div class="row">
        <div class="col pt-5">
            <h1 class="pt-5">Products</h1>
            <form action="product" method="POST">
                <?php set_csrf() ?>
                <div class="form-group">
                    <label for="productName">Name</label>
                    <input class="form-control" type="text" id="productName" name="productName">
                </div>
                <div class="form-group">
                    <label for="productDesc">Description</label>
                    <input class="form-control" type="text" id="productDesc" name="productDesc">
                </div>
                <div class="form-group">
                    <label for="productTitle">Title</label>
                    <input class="form-control" type="text" id="productTitle" name="productTitle">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input class="form-control" type="number" id="price" name="price">
                </div>

                <button class="btn btn-primary mt-3" type="submit">Create</button>
            </form>
        </div>
    </div>
</main>

<?php include 'view/components/footer.php'; ?>