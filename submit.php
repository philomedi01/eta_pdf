<?php

// DB Connection
$hostname = "localhost";
$username = "samsum";
$password = "tkatjsDB1@";
$dbname = "samsun";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$mysqli = new mysqli($hostname, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_errno) {
    die("Failed to connect to MariaDB: " . $mysqli->connect_error);
}

// Get data
$name = $_POST['name'];
$phone = $_POST['phone'];
$agree = $_POST['agree'];
$date = date("Y-m-d H:i:s");

// Perform query
$stmt = $mysqli->prepare("INSERT INTO `landing_02` (`Name`, `Phone`, `PrivacyPolicy`, `Date`) VALUES (?, ?, ?, ?)");

if ($stmt) {
    $stmt->bind_param("ssss", $name, $phone, $agree, $date);
    if ($stmt->execute()) {
        echo "<script>alert('제출해주셔서 감사합니다.');</script>";
    } else {
        die("Query failed: " . $stmt->error);
    }
} else {
    die("Query failed: " . $mysqli->error);
}

$stmt->close();

header('Location: index.html#registerForm');
