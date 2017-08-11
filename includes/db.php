<?php

// METHOD 1 easiest way to connect 
//$connection = mysqli_connect('localhost', 'root', '', 'cms');
//if($connection) {
//    echo "connected";
//}

// METHOD 2  
$db['db_host'] = 'localhost';
$db['db_user'] = 'root';
$db['db_pass'] = ''; // do not put space in between quotes, becomes value YES 
$db['db_name'] = 'cms';

foreach($db as $key => $value) {
    define(strtoupper($key), $value);
} 
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
//if($connection) {
//    echo "Database connected";
//}

?>