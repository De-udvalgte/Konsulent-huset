<?php

require_once __DIR__.'/router.php';

get('/konsulent-huset', 'view/index.php');
get('/konsulent-huset/products', 'view/products.php');
get('/konsulent-huset/create_product', 'view/createProductForm.php');
get('/konsulent-huset/api/products', 'api/endpoints/get_products.php');
post('/konsulent-huset/product', 'api/endpoints/create_product.php');


?>