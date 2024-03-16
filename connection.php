<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "";
$db = "fantagita";

$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error)
    die("DB failure ".$conn->connect_error);