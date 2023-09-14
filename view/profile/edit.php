<?php include 'view/components/header.php';

if (!in_array($_SESSION['rolesId'], [1, 2])) {
    header("Location: /konsulent-huset/404");
    exit();
}

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
        <div class="col pt-5">
            <?php if (isset($success_message)) { ?>
                <div class="alert alert-success" role="alert">
                    <?php out($success_message) ?>
                </div>
            <?php } else if (isset($error_message)) { ?>
                    <div class="alert alert-danger" role="alert">
                    <?php out($error_message) ?>
                    </div>
            <?php } ?>
            <h1 class="pt-5">Edit profile</h1>

            <form action="<?php echo "/konsulent-huset/api/users/edit/" . $userId ?>" method="POST">
                <?php set_csrf() ?>
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
    <div class="row mt-5">
        <a class="link" href="/konsulent-huset/profile">Go Back</a>
    </div>
</main>
<?php include 'view/components/footer.php'; ?>