<?php
include 'view/components/header.php';

if (!in_array($_SESSION['rolesId'], [1, 2])) {
    $_SESSION['unauthorized'] = true;
    header("Location: /konsulent-huset/404");
    exit();
}

$context = stream_context_create([
    'http' => [
        'header' => 'Cookie: ' . session_name() . '=' . session_id(),
    ],
]);

session_write_close();


$result = json_decode(file_get_contents('http://localhost/konsulent-huset/api/order/' . $orderId, false, $context));

?>

<main role="main" class="container">
    <div class="row">
        <div class="col">
            <h1 class="text-center">Edit order</h1>
            <br>
            <form action="<?php out("/konsulent-huset/api/order/edit/" . $orderId); ?>" method="POST">
                <div class="form-group">
                    <label for="productId">Product ID</label>
                    <input class="form-control" type="number" id="productId" name="productId"
                        value="<?php out($result->productId); ?>">
                </div>
                <br>
                <div class="form-group">
                    <label for="startDate">Start date</label>
                    <input class="form-control" type="datetime-local" id="startDate" name="startDate"
                        value="<?php out($result->startDate); ?>">
                </div>
                <br>
                <div class="form-group">
                    <label for="endDate">End date</label>
                    <input class="form-control" type="datetime-local" id="endDate" name="endDate"
                        value="<?php out($result->endDate); ?>">
                </div>
                <br>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input class="form-control" type="text" id="address" name="address"
                        value="<?php out($result->address); ?>">
                </div>
                <button class="btn btn-primary mt-3" type="submit">Update</button>
            </form>
        </div>
        <div class="row mt-5">
            <a class="link" href="/konsulent-huset/orders">Go Back</a>
        </div>
    </div>
</main>

<?php include 'view/components/footer.php'; ?>