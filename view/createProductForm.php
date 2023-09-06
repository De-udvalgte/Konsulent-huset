<?php include 'components/header.php'; ?>
<h1>Products</h1>
<form action="product" method="POST">
    <div>
        <label for="productName">Name</label>
        <input type="text" id="productName" name="productName">
    </div>
    <div>
        <label for="productDesc">Description</label>
        <input type="text" id="productDesc" name="productDesc">
    </div>
    <div>
        <label for="productTitle">Title</label>
        <input type="text" id="productTitle" name="productTitle">
    </div>
    <div>
        <label for="price">Price</label>
        <input type="number" id="price" name="price">
    </div>

    <button type="submit">Create</button>
</form>

<?php include 'components/footer.php'; ?>