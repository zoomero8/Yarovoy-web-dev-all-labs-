<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root1');
define('DB_PASSWORD', ''); 
define('DB_NAME', 'web-dev_5'); 
$mysql = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);


if ($mysql == false) {
    print("Ошибка подключения: " . $mysql->connect_error);
}
?>