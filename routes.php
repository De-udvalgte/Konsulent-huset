<?php

require_once __DIR__ . '/router.php';
// Home Page
get('/konsulent-huset', 'view/index.php');

// Products
// views:
get('/konsulent-huset/products', 'view/products/index.php');
get('/konsulent-huset/products/create', 'view/products/create.php');
get('/konsulent-huset/products/edit/$id', 'view/products/edit.php');
get('/konsulent-huset/products/page/$id', 'view/products/page.php');
// endpoints:
get('/konsulent-huset/api/products/$id', 'api/endpoints/products/get_by_id.php');
get('/konsulent-huset/api/products', 'api/endpoints/products/get_all.php');
post('/konsulent-huset/products/product', 'api/endpoints/products/create.php');
post('/konsulent-huset/products/edit/$id', 'api/endpoints/products/update.php');
get('/konsulent-huset/products/delete/$id', 'api/endpoints/products/delete.php');

// Login / Register / Logout
// views:
get('/konsulent-huset/login', 'view/login_page.php');
get('/konsulent-huset/register_page', 'view/register_page.php');
// endpoints:
post('/konsulent-huset/register_user', 'api/endpoints/auth/register.php');
post('/konsulent-huset/login_user', 'api/endpoints/auth/login.php');
get('/konsulent-huset/logout', 'api/endpoints/auth/logout.php');

// Users / Profile
// views:
get('/konsulent-huset/users', 'view/users/index.php');
get('/konsulent-huset/profile', 'view/profile/index.php');
get('/konsulent-huset/profile/edit', 'view/profile/edit.php');
get('/konsulent-huset/users/edit/$userId', 'view/profile/edit.php');
// endpoints:
get('/konsulent-huset/api/users', 'api/endpoints/users/get_all.php');
get('/konsulent-huset/api/users/$userId', 'api/endpoints/users/get_by_id.php');
post('/konsulent-huset/api/users/edit/$userId', 'api/endpoints/users/update.php'); //update user
get('/konsulent-huset/api/users/delete/$userId', 'api/endpoints/users/delete.php');
