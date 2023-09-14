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


            <div id="alert-update" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none">
                <i class="bi bi-exclamation-triangle me-2"></i></i> Update failed.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>


            <form id="form-edit" action="<?php out("/konsulent-huset/api/users/edit/" . $userId) ?>" method="POST">
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

                <!-- <button class="btn btn-primary mt-3" type="submit">Save</button> -->
                <!-- Button trigger modal -->
                <a type="button" id="btn1" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modal1" onclick=>
                    Save changes
                </a>

                <!-- Modal -->
                <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">


                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm profile changes</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3 row">
                                    <label class="col-form-label">To confirm your action please enter your password.</label>
                                </div>
                                <div class="mb-3 row">
                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <div class="form-group password-needs-validation">
                                            <input class="form-control" type="password" id="password" name="password" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid password.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="modal-btn">Save changes</button>
                            </div>

                            <h1 id="hello"> </h1>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="row mt-5">
        <a class="link" href="/konsulent-huset/profile">Go Back</a>
    </div>
</main>
<script>
    const element = document.getElementById("modal-btn");
    element.addEventListener("click", function() {
        document.getElementById('form-edit').submit();
        <?php

        /* if (!is_csrf_valid()) { */
        // The form is forged
        // Code here
        /*   exit();
        } */

        require('api/config/database.php');
        require('api/objects/user.php');

        // get database connection
        $database = new Database();
        $db = $database->getConnection();

        // instantiate product object
        $user = new User($db);

        $user->email = $_SESSION["email"];
        $email_exists = $user->emailExists();
        ?>
        $pass = document.getElementById("password").value;
        <?php
        $pass = "document.getElementById('password').value";
        if ($email_exists && password_verify($pass, $user->password)) { ?>




        <?php } else { ?>

            /*    document.getElementById("alert-update").style.display = "block"; */
            document.getElementById("password").value = "";
            document.getElementById("btn-cancel").click();


        <?php } ?>
    })
</script>
<?php include 'view/components/footer.php'; ?>