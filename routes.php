<?php

require_once __DIR__ . '/router.php';
//Home Page
get('/konsulent-huset', 'view/index.php');
//Products
get('/konsulent-huset/products', 'view/products.php');
get('/konsulent-huset/create_product', 'view/createProductForm.php');
get('/konsulent-huset/api/products', 'api/endpoints/get_products.php');
post('/konsulent-huset/product', 'api/endpoints/create_product.php');
//Login
get('/konsulent-huset/login', 'view/login_page.php');
post('/konsulent-huset/register_user', 'api/endpoints/register_user.php');
get('/konsulent-huset/register_page', 'view/register_page.php');
post('/konsulent-huset/login_user', 'api/endpoints/login_user.php');
//Logout
get('/konsulent-huset/logout', 'api/endpoints/logout_user.php');
//Users
get('/konsulent-huset/users', 'view/users_page.php');

get('/konsulent-huset/api/users', 'api/endpoints/get_users.php');
