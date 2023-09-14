<?php

include 'view/components/header.php';

if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}


$result = "";

$context = stream_context_create([
    'http' => [
        'header' => 'Cookie: ' . session_name() . '=' . session_id(),
    ],
]);

session_write_close();

$result = array();

if ($_SESSION['rolesId'] == 1) {
    $result = file_get_contents('http://localhost/konsulent-huset/api/orders/' . $_SESSION['userId'], false, $context);
} elseif ($_SESSION['rolesId'] == 2) {
    $result = file_get_contents('http://localhost/konsulent-huset/api/orders', false, $context);
}

//$result = file_get_contents('http://localhost/konsulent-huset/api/orders/2', false, $context);

?>


<main role="main" class="container">
    <div id="response"></div>
    <div id="content">
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


                <h1 class="text-center">Create order</h1>
                <form class="mt-3" action="api/order" method="POST">
                    <div class="form-group">
                        <label for="productId">Product ID</label>
                        <input class="form-control" type="number" id="productId" name="productId">
                    </div>
                    <br>
                    <?php if ($_SESSION['rolesId'] == 2) { ?>
                        <div class="form-group">
                            <label for="userId">User ID</label>
                            <input class="form-control" type="number" id="userId" name="userId">
                        </div>
                        <br>
                    <?php } ?>
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
                </form>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">

                <h1 class="text-center">Orders</h1>
                <table class="table mt-4">

                    <tr>
                        <?php if ($_SESSION['rolesId'] == 2) {
                            echo "<th>ID</th>" .
                                "<th>User ID</th>" .
                                "<th>Product ID</th>";
                        } ?>
                        <th>Order number</th>
                        <th>Product name</th>
                        <th>Order date</th>
                        <th>Start date</th>
                        <th>End date</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>

                    <?php foreach (json_decode($result, true) as $order) { ?>

                        <tr>
                            <?php if ($_SESSION['rolesId'] == 2) {
                                echo "<td>" . htmlspecialchars($order["orderId"]) . "</td>" .
                                    "<td>" . htmlspecialchars($order["userId"]) . "</td>" .
                                    "<td>" . htmlspecialchars($order["productId"]) . "</td>";
                            } ?>
                            <td>
                                <?php out($order["orderNumber"]) ?>
                            </td>
                            <td>
                                <?php out($order["productName"]) ?>
                            </td>
                            <td>
                                <?php out($order["orderDate"]) ?>
                            </td>
                            <td>
                                <?php out($order["startDate"]) ?>
                            </td>
                            <td>
                                <?php out($order["endDate"]) ?>
                            </td>
                            <td>
                                <?php out($order["address"]) ?>
                            </td>

                            <td>
                                <a class="me-1 btn btn-primary" href="<?php out("/konsulent-huset/edit_order_page/" . $order['orderId']) ?>"><i class="bi bi-pencil"></i></a>
                                <a class="btn btn-danger" href="<?php out("/konsulent-huset/api/order/delete/" . $order['orderId']) ?>"><i class="bi bi-trash3"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

</main>

<?php include 'view/components/footer.php'; ?>