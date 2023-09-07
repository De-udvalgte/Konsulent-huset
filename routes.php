<?php

require_once __DIR__.'/router.php';
//Home Page
get('/konsulent-huset', 'view/index.php');
//Products
get('/konsulent-huset/products', 'view/products.php');
get('/konsulent-huset/create_product', 'view/createProductForm.php');
get('/konsulent-huset/api/products', 'api/endpoints/get_products.php');
post('/konsulent-huset/product', 'api/endpoints/create_product.php');
//Login
get('/konsulent-huset/login', 'view/login_page.php');


?>