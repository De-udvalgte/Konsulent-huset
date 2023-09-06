<?php

require_once __DIR__.'/router.php';

get('/konsulent-huset', 'view/index.php');
get('/konsulent-huset/products', 'view/products.php');

?>