<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'your_bluehost_db_username');
define('DB_PASSWORD', 'your_bluehost_db_password');
define('DB_NAME', 'your_bluehost_db_name');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
