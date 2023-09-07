<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsulent-Huset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./view/css/custom.css">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Konsulent-Huset</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="/konsulent-huset">Home</a>
                    <a class="nav-item nav-link" href="/konsulent-huset/products">Products</a>
                    <a class="nav-item nav-link" href="/konsulent-huset/create_product">Create Product</a>
                    <?php if (empty($_SESSION["userId"])){ ?>
                    <a class="nav-item nav-link" href="/konsulent-huset/login">Login</a>
                    <a class="nav-item nav-link" href="/konsulent-huset/register_page">Sign Up</a>
                    <?php } else {?>
                        <a class="nav-item nav-link" href="/konsulent-huset/logout">Logout</a>
                    <?php }?>

                    <!--
                    <a class="nav-item nav-link" href="#">Logout</a>
                    
                    -->
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">