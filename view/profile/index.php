<?php include 'view/components/header.php'; ?>
<?php
$result = json_decode(file_get_contents('http://localhost/konsulent-huset/api/users/' . $_SESSION["userId"]));
$userId = $result->userId;
$firstName = $result->firstName;
$lastName = $result->lastName;
$email = $result->email;
$created = $result->created;
$modified = $result->modified;
$rolesId = $result->rolesId;

?>
<main role="main" class="container">
    <div class="row">
        <div class="col">
            <h1>Profile</h1>

            <a class="btn btn-primary mt-3" href="/konsulent-huset/profile/edit">Edit</a>
            <a class="btn btn-danger mt-3" href=<?php echo "/konsulent-huset/api/users/delete/" .  $userId ?>>Delete</a>
            <table class="table">

                <tr>
                    <th>Id</th>
                    <th>Type</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Created</th>
                    <th>Last modified</th>
                </tr>
                <tr>
                    <td>
                        <?php out($userId) ?>
                    </td>
                    <td>
                        <?php out($rolesId ==  1 ? "User" : "Admin") ?>
                    </td>
                    <td>
                        <?php out($firstName) ?>
                    </td>
                    <td>
                        <?php out($lastName) ?>
                    </td>
                    <td>
                        <?php out($email) ?>
                    </td>
                    <td>
                        <?php out($created) ?>
                    </td>
                    <td>
                        <?php out($modified) ?>
                    </td>
                </tr>

            </table>
        </div>
    </div>
</main>
<?php include 'view/components/footer.php'; ?>