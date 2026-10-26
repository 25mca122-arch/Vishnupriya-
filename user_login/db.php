
<?php
$host = "localhost";
$dbname = "userlogin_db";
$dbuser = "root";
$dbpass = ""; 

$conn = new mysqli($host, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Database connection failed.");
}

$conn->set_charset("utf8mb4");
?>
