<?php include 'components/header.php'; ?>
<main role="main" class="container">
    <div class="row">
        <div class="col">
            <h1>Create User</h1>
            <form action="register_user" method="POST">

                <div class="form-group">
                    <label for="firstName">First name</label>
                    <input class="form-control" type="text" id="firstName" name="firstName">
                </div>

                <div class="form-group">
                    <label for="lastName">Last name</label>
                    <input class="form-control" type="text" id="lastName" name="lastName">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" id="email" name="email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" id="password" name="password">
                </div>

                <button class="btn btn-primary mt-3" type="submit">Signup</button>
            </form>
        </div>
    </div>
</main>

<?php include 'components/footer.php'; ?>