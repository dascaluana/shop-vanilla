<?php

include ('config.php');
include ('trans.php');

if (!isset($_SESSION)) {
    session_start();
}

$conn = new PDO("mysql:host=" . SERVER_NAME . ";dbname=" . DB, USER_NAME, PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

