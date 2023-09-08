<?php

require_once __DIR__ . '/router.php';
//Home Page
get('/konsulent-huset', 'view/index.php');

//Products
// views:
get('/konsulent-huset/products', 'view/products/index.php');
get('/konsulent-huset/products/create', 'view/products/create_product.php');
// api:
get('/konsulent-huset/api/products', 'api/endpoints/products/get_all.php');
post('/konsulent-huset/products/product', 'api/endpoints/products/create.php');
get('/konsulent-huset/products/delete/$id', 'api/endpoints/products/delete.php');

//Login
get('/konsulent-huset/login', 'view/login_page.php');
post('/konsulent-huset/register_user', 'api/endpoints/register_user.php');
get('/konsulent-huset/register_page', 'view/register_page.php');
post('/konsulent-huset/login_user', 'api/endpoints/login_user.php');

//Logout
get('/konsulent-huset/logout', 'api/endpoints/logout_user.php');

//Users
get('/konsulent-huset/users', 'view/users_page.php');
get('/konsulent-huset/profile', 'view/profile_page.php');
get('/konsulent-huset/profile/edit', 'view/edit_profile_page.php');

get('/konsulent-huset/api/users', 'api/endpoints/get_users.php');
get('/konsulent-huset/api/users/$userId', 'api/endpoints/get_user_by_id.php');
post('/konsulent-huset/api/users/$userId', 'api/endpoints/update_user.php'); //update user
