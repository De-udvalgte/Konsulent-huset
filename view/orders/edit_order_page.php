<?php

include 'view/components/header.php';
//$result = "";
//
//$context = stream_context_create([
//    'http' => [
//        'header' => 'Cookie: ' . session_name() . '=' . session_id(),
//    ],
//]);
//
//session_write_close();
//
//$result = array();
//
//if ($_SESSION['rolesId'] == 1) {
//    $result = file_get_contents('http://localhost/konsulent-huset/api/orders/' . $_SESSION['userId'], false, $context);
//} elseif ($_SESSION['rolesId'] == 2) {
//    $result = file_get_contents('http://localhost/konsulent-huset/api/orders', false, $context);
//}

//$result = file_get_contents('http://localhost/konsulent-huset/api/orders/2', false, $context);

?>
    <div id="response"></div>
    <div id="content">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Edit order</h1>
                <br>

                <div class="form-group">
                    <label for="productId">Product ID</label>
                    <input class="form-control" type="number" id="productId" name="productId">
                </div>
                <br>
                <div class="form-group">
                    <label for="startDate">Start date</label>
                    <input class="form-control" type="datetime-local" id="startDate" name="startDate">
                </div>
                <br>
                <div class="form-group">
                    <label for="endDate">End date</label>
                    <input class="form-control" type="datetime-local" id="endDate" name="endDate">
                </div>
                <br>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input class="form-control" type="text" id="address" name="address">
                </div>

                <button class="btn btn-primary mt-3" type="submit">Create</button>
            </div>
        </div>
    </div>

<?php include 'view/components/footer.php'; ?>