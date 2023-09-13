<?php
session_name("konsulent_huset");
session_start();
if (!isset($_SESSION["userId"])) {
    $_SESSION["rolesId"] = 1;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsulent-Huset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/konsulent-huset/view/css/custom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <div class="logo">
                <a href="#" title="logo"></a>
                <img src="/konsulent-huset/images/KHLOGO.png" alt="site logo" class="img-responsive">
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="/konsulent-huset">Home</a>
                    <a class="nav-item nav-link" href="/konsulent-huset/products">Products</a>
                    <?php if (empty($_SESSION["userId"])) { ?>
                        <a class="nav-item nav-link" href="/konsulent-huset/login">Login</a>
                        <a class="nav-item nav-link" href="/konsulent-huset/register_page">Sign Up</a>
                    <?php } else { ?>
                        <a class="nav-item nav-link" href="/konsulent-huset/orders">Orders</a>
                        <?php if ($_SESSION["rolesId"] === "2") { ?>
                            <a class="nav-item nav-link" href="/konsulent-huset/products/create">Create Product</a>
                            <a class="nav-item nav-link" href="/konsulent-huset/users">Users</a>
                        <?php } ?>
                        <a class="nav-item nav-link" href="/konsulent-huset/profile">Profile</a>
                        <a class="nav-item nav-link" href="/konsulent-huset/logout">Logout</a>
                    <?php } ?>

                    <!--
                    <a class="nav-item nav-link" href="#">Logout</a>
                    
                    -->
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">