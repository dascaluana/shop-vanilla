<?php

include ('config.php');

if(!isset($_SESSION)) {
    session_start();
}

$conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

