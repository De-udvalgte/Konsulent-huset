<?php include 'view/components/header.php'; ?>
<main role="main" class="container">
    <div class="row">
        <div class="col pt-5">
            <h1 class="pt-5">Edit profile</h1>


            <form action=<?php echo "/konsulent-huset/profile/edit/" . $_SESSION["userId"] ?> method="POST">
                <input type="hidden" id="rolesId" name="rolesId" value=<?php echo $_SESSION["rolesId"] ?>>

                <div class="form-group">
                    <label for="firstName">First name</label>
                    <input class="form-control" type="text" id="firstName" name="firstName" value=<?php echo $_SESSION["firstName"] ?>>
                </div>

                <div class="form-group">
                    <label for="lastName">Last name</label>
                    <input class="form-control" type="text" id="lastName" name="lastName" value=<?php echo $_SESSION["lastName"] ?>>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" id="email" name="email" value=<?php echo $_SESSION["email"] ?>>
                </div>
                
                <button class="btn btn-primary mt-3" type="submit">Save</button>
            </form>
        </div>
    </div>
</main>
<?php include 'view/components/footer.php'; ?>