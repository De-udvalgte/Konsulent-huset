<?php include 'components/header.php'; ?>

<style>
    /* Change the built-in styling standard for bootstrap validation form
    instead of the standard valid style (green with checkmark) 
    we change to the normal (blue) style for the inputs when a inputfield is valid
    */
    .form-control.is-valid,
    .was-validated .form-control:valid {
        background-image: inherit !important;
        border-color: #dee2e6;
    }

    .form-control.is-valid,
    .was-validated .form-control:valid:focus {
        background-image: inherit !important;
        color: #212529;
        background-color: #FFF;
        border-color: #86B7FE;
        outline: 0;
        box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .25);
    }
</style>

<main role="main" class="container">
    <div class="row">
        <div class="col">
            <h1>Login</h1>
            <?php if (isset($_SESSION["login_attempt"]) && !empty($_SESSION["login_attempt"]["hasFailed"]) && $_SESSION["login_attempt"]["hasFailed"] === true) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i></i> Login failed. Invalid email or password.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>

            <form action="login_user" method="POST" class="<?php if (isset($_SESSION["login_attempt"])) {
                                                                echo "was-validated";
                                                            } else {
                                                                echo "needs-validation";
                                                            } ?>" novalidate>
                <?php set_csrf() ?>
                <div class="form-group email-needs-validation">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" type="email" id="email" name="email" value="<?php if (isset($_SESSION["login_attempt"]["email"])) {
                                                                                                echo $_SESSION["login_attempt"]["email"];
                                                                                            } ?>" required>
                    <div class="invalid-feedback">
                        Please provide a valid email.
                    </div>
                </div>

                <div class="form-group password-needs-validation2">
                    <label for="password" class="form-label">Password</label>
                    <input class="form-control password" type="password" id="password" name="password" required>
                    <div class="invalid-feedback">
                        Please provide a valid password.
                    </div>
                </div>

                <button class="btn btn-primary mt-3" type="submit">Login</button>
            </form>
        </div>
    </div>
</main>
<script>
    // for disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        // Loop over them and prevent submission
        Array.from(document.querySelectorAll('.email-needs-validation')).forEach(form => {
            form.addEventListener('keypress', event => {
                form.classList.add('was-validated')
            }, false)
        })
        Array.from(document.querySelectorAll('.password-needs-validation2')).forEach(form => {
            form.addEventListener('keypress', event => {
                form.classList.add('was-validated')
            }, false)
        })

    })()
</script>
<?php include 'components/footer.php'; ?>