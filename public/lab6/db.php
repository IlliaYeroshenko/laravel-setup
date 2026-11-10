<?php

$host = "mysql";
$user = "root";
$password = "root";
$database = "users_db";

$conn = mysqli_connect(
    $host,
    $user,
    $password,
    $database
);

if (!$conn) {
    die("Помилка підключення до бази даних: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

?>
