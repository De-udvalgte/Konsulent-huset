<?php include 'view/components/header.php';
require 'view/components/auth_modal.php';

$result = file_get_contents('http://localhost/konsulent-huset/api/users');

if (!in_array($_SESSION['rolesId'], [2])) {
    header("Location: /konsulent-huset/404");
    exit();
}

if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
?>
<main role="main" class="container">
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
            <h1>Users</h1>

            <a href="/konsulent-huset/register_page">

                <button class="btn btn-success mt-3">Create new</button>
            </a>
            <table class="table">
                <tr>
                    <th>Id</th>
                    <th>Type</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Created</th>
                    <th>Last modified</th>
                    <th></th>
                </tr>
                <?php $x = 0; ?>
                <?php foreach (json_decode($result, true) as $user) { ?>
                    <?php $x++ ?>
                    <tr>
                        <td>
                            <?php out($user["userId"]) ?>
                        </td>
                        <td>
                            <?php out($user["rolesId"] == 1 ? "User" : "Admin") ?>
                        </td>
                        <td>
                            <?php out($user["firstName"]) ?>
                        </td>
                        <td>
                            <?php out($user["lastName"]) ?>
                        </td>
                        <td>
                            <?php out($user["email"]) ?>
                        </td>
                        <td>
                            <?php out($user["created"]) ?>
                        </td>
                        <td>
                            <?php out($user["modified"]) ?>
                        </td>
                        <td>
                            <a class="me-1 btn btn-primary" href="<?php out("/konsulent-huset/users/edit/" . $user['userId']) ?>"><i class="bi bi-pencil"></i></a>
                            <?php insertAuthModal($x, "Confirm user deletion",  "btn btn-danger", '<i class="bi bi-trash3"></i>', "Delete user", "/konsulent-huset/api/users/delete/" . $user['userId'], "/konsulent-huset/users"); ?>

                        </td>
                    </tr>
                <?php
                };
                ?>
            </table>
        </div>
    </div>
</main>

<?php include 'view/components/footer.php'; ?>