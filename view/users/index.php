<?php $result = file_get_contents('http://localhost/konsulent-huset/api/users'); ?>

<?php include 'view/components/header.php'; ?>
<main role="main" class="container">
    <div class="row">
        <div class="col">
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

                <?php foreach (json_decode($result, true) as $user) { ?>

                    <tr>
                        <td>
                            <?php echo htmlspecialchars($user["userId"]) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($user["rolesId"] === 1 ? "User" : "Admin") ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($user["firstName"]) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($user["lastName"]) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($user["email"]) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($user["created"]) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($user["modified"]) ?>
                        </td>
                        <td>
                            <form action="/konsulent-huset/profile/edit" method="GET">
                                <input type="hidden" id="userId" name="userId" value=<?php echo $user["userId"] ?>>
                                <input type="hidden" id="firstName" name="firstName" value=<?php echo $user["firstName"] ?>>
                                <input type="hidden" id="lastName" name="lastName" value=<?php echo $user["lastName"] ?>>
                                <input type="hidden" id="email" name="email" value=<?php echo $user["email"] ?>>
                                <input type="hidden" id="rolesId" name="rolesId" value=<?php echo $user["rolesId"] ?>>
                                <button class="me-1 btn btn-primary active"><i class="bi bi-pencil"></i></button>
                            </form>
                            <a class="btn btn-danger" href="<?php echo "/konsulent-huset/api/users/delete/" . $user['userId']; ?>"><i class="bi bi-trash3"></i></a>
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