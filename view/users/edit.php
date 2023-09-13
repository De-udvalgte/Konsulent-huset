<?php include 'view/components/header.php'; ?>
<?php

if (isset($userId)) {
    $result = json_decode(file_get_contents('http://localhost/konsulent-huset/api/users/' . $userId));
    $firstName = $result->firstName;
    $lastName = $result->lastName;
    $email = $result->email;
    $rolesId = $result->rolesId;
} else {
    $userId = $_SESSION["userId"];
    $firstName = $_SESSION["firstName"];
    $lastName = $_SESSION["lastName"];
    $email = $_SESSION["email"];
    $rolesId = $_SESSION["rolesId"];
}
?>

<main role="main" class="container">
    <div class="row">
        <div class="col pt-5">
            <h1 class="pt-5">Edit profile</h1>


            <form action="<?php echo "/konsulent-huset/api/users/edit/" . $userId ?>" method="POST">
                <?php set_csrf() ?>
                <?php if ($_SESSION["rolesId"] == 2) { ?>
                    <div class="form-group">
                        <label for="rolesId">Change status</label>
                        <div class="dropdown">
                            <select class="form-control" id="rolesId" name="rolesId">
                                <option value="1" <?php if ($rolesId == 1) echo "selected" ?>>User</option>
                                <option value="2" <?php if ($rolesId == 2) echo "selected" ?>>Admin</option>
                            </select>
                        </div>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <label for="firstName">First name</label>
                    <input class="form-control" type="text" id="firstName" name="firstName" value=<?php out($firstName) ?>>
                </div>

                <div class="form-group">
                    <label for="lastName">Last name</label>
                    <input class="form-control" type="text" id="lastName" name="lastName" value=<?php out($lastName) ?>>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" id="email" name="email" value=<?php out($email) ?>>
                </div>

                <button class="btn btn-primary mt-3" type="submit">Update</button>
            </form>
        </div>
    </div>
</main>
<?php include 'view/components/footer.php'; ?>