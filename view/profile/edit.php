<?php include 'view/components/header.php'; ?>
<?php $result = file_get_contents('http://localhost/konsulent-huset/api/users/' . $_SESSION["userId"]) ?>
<main role="main" class="container">
    <div class="row">
        <div class="col pt-5">
            <h1 class="pt-5">Edit profile</h1>


            <form action=<?php echo "/konsulent-huset/profile/edit/" . $_SESSION["userId"] ?> method="POST">
                <input type="hidden" id="rolesId" name="rolesId" value=<?php echo $_SESSION["rolesId"] ?>>

                <div class="form-group">
                    <label for="firstName">First name</label>
                    <input class="form-control" type="text" id="firstName" name="firstName">
                </div>

                <div class="form-group">
                    <label for="lastName">Last name</label>
                    <input class="form-control" type="text" id="lastName" name="lastName" value=<?php echo $_SESSION["lastName"] ?>>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" id="email" name="email" value=<?php echo $_SESSION["email"] ?>>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" id="password" name="password">
                </div>

                <!-- TODO: repeat password and check password -->
                <!-- <div class="form-group">
                    <label for="password1">Repeat password</label>
                    <input class="form-control" type="password1" id="password1" name="password1">
                </div> -->
                <button class="btn btn-primary mt-3" type="submit">Save</button>
            </form>
        </div>
    </div>
</main>
<script>
    var btn = document.getElementById('editBtn');
    btn.addEventListener('click', function () {
        document.location.href = 'http://localhost/konsulent-huset/profile/edit';
    });
</script>
<?php include 'view/components/footer.php'; ?>