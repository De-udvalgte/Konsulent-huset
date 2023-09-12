<?php

include 'view/components/header.php';
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
                    <h1 class="text-center">Create order</h1>
                    <br>
                    <form action="api/order" method="POST">
                        <div class="form-group">
                            <label for="productId">Product ID</label>
                            <input class="form-control" type="number" id="productId" name="productId">
                        </div>
                        <br>
                        <?php if ($_SESSION['rolesId'] === 2) { ?>
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

            <br><br>

            <div class="row">
                <h1 class="text-center">Orders</h1>
                <br><br><br>
                <table class="table">

                    <tr>
                        <?php if ($_SESSION['rolesId'] === 2) {
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
                            <?php if ($_SESSION['rolesId'] === 2) {
                                echo "<td>" . htmlspecialchars($order["orderId"]) . "</td>" .
                                    "<td>" . htmlspecialchars($order["userId"]) . "</td>" .
                                    "<td>" . htmlspecialchars($order["productId"]) . "</td>";
                            } ?>
                            <td>
                                <?php echo htmlspecialchars($order["orderNumber"]) ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($order["productName"]) ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($order["orderDate"]) ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($order["startDate"]) ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($order["endDate"]) ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($order["address"]) ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm"
                                        name="delete-order" <?php echo "data-item-id='" . htmlspecialchars($order["orderId"]) . "'" ?>>
                                    Delete
                                </button>
                                <button type="button" class="btn btn-warning btn-sm"
                                        name="edit-order" <?php echo "data-item-id='" . htmlspecialchars($order["orderId"]) . "'" ?>>
                                    Edit
                                </button>
                            </td>
                        </tr>
                        <?php
                    };
                    ?>
                </table>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Get all buttons with the name "delete-order"
                const deleteButtons = document.querySelectorAll('button[name="delete-order"]');
                // const editButtons = document.querySelectorAll('button[name="edit-order"]');

                // Add click event listeners to each delete button
                deleteButtons.forEach(function (button) {
                    button.addEventListener("click", function () {
                        // Get the item ID from the button's data attribute
                        const orderId = button.getAttribute("data-item-id");

                        fetch(`api/order/${orderId}`, {
                            method: "DELETE",
                        })
                            .then((response) => {
                                if (response.ok) {
                                    // Successful deletion, update the UI or show a message
                                    window.location.reload();
                                } else {
                                    // Handle the error or show an error message
                                    document.getElementById("response").innerHTML = "<div class='alert alert-success'>Failed to delete order</div>";
                                }
                            })
                            .catch((error) => {
                                console.error("Error:", error);
                            });
                    });
                });
            });

        </script>
    </main>

<?php include 'view/components/footer.php'; ?>