<?php
$host = 'mysql-db';
$user = 'appuser';
$password = 'appuserpassword';
$database = 'vulnerable_app_db';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>