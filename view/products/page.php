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
            <h1 class="pt-5">
                <?php echo $productName; ?>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h5>
                <?php echo $productTitle; ?>
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h5>
                <?php echo "$" . $price . " / hour" ?>
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p>
                <?php echo $productDesc; ?>
            </p>
        </div>
    </div>
    <a class="link" href="/konsulent-huset/products">Go Back</a>

</main>
<?php include 'view/components/footer.php'; ?>