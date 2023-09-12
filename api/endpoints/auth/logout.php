<?php
session_name("konsulent_huset");
session_start();
unset($_SESSION["userId"]);
unset($_SESSION["firstName"]);
unset($_SESSION["lastName"]);
unset($_SESSION["email"]);
unset($_SESSION["rolesId"]);

echo 'You have cleaned session';
header('Location: /konsulent-huset');
