<?php
$db = mysqli_connect("localhost", "root", "");
mysqli_set_charset($db, "utf8");
$site_url = "localhost";
$create_db = mysqli_query($db, "CREATE DATABASE IF NOT EXISTS mychat CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
mysqli_select_db($db, 'mychat');

$create_user = mysqli_query($db, "CREATE TABLE IF NOT EXISTS user(
    id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
    password varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
    name varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$create_message = mysqli_query($db, "CREATE TABLE IF NOT EXISTS message(
    id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id int(10) NOT NULL,
    message text COLLATE utf8mb4_unicode_ci NOT NULL,
    time datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
?>