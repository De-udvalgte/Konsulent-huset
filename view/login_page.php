<?php include 'components/header.php'; ?>
<main role="main" class="container">
    <div class="row">
        <div class="col">
            <h1>Login</h1>
            <form action="login" method="POST">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" id="email" name="email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" id="password" name="password">
                </div>

                <button class="btn btn-primary mt-3" type="submit">Login</button>
            </form>
        </div>
    </div>
</main>

<?php include 'components/footer.php'; ?>