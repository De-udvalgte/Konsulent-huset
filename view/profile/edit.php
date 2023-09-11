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
                <input type="hidden" id="rolesId" name="rolesId" value=<?php out($rolesId) ?>>

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

                <button class="btn btn-primary mt-3" type="submit">Save</button>
            </form>
        </div>
    </div>
</main>
<?php include 'view/components/footer.php'; ?>