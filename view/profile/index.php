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

            <a href="/konsulent-huset/profile/edit">
                <button class="btn btn-primary mt-3">Edit</button>
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
                </tr>
                <tr>
                    <td>
                        <?php echo htmlspecialchars($userId) ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($rolesId === 1 ? "User" : "Admin") ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($firstName) ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($lastName) ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($email) ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($created) ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($modified) ?>
                    </td>
                </tr>

            </table>
        </div>
    </div>
</main>
<?php include 'view/components/footer.php'; ?>