<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', ''); 
define('DB_NAME', 'web-dev_5'); 
$mysql = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);


if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
    echo 'We dont have connection';}
?>