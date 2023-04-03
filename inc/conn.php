<?php

$hostname = 'localhost'; // specify host domain or IP, i.e. 'localhost' or '127.0.0.1' or server IP 'xxx.xxxx.xxx.xxx'
$database = 'friendsi_db_sipi'; // specify database name
$db_user = 'root'; // specify username
$db_pass = ''; // specify password

// $hostname = 'localhost'; // specify host domain or IP, i.e. 'localhost' or '127.0.0.1' or server IP 'xxx.xxxx.xxx.xxx'
// $database = 'friendsi_db_sipi'; // specify database name
// $db_user = 'friendsi_user_1'; // specify username
// $db_pass = 'friendsi_user_1'; // specify password


$con = mysqli_connect("$hostname", "$db_user", "$db_pass", "$database");

if (mysqli_connect_errno())
    echo "Couldn't connect to Database! <br>";

?>