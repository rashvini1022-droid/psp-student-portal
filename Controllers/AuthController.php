<?php

session_start();

require_once "../config/Database.php";
require_once "../models/User.php";


// Connect to database

$database = new Database();

$connection = $database->connect();


// Create User object

$userModel = new User($connection);


// Check if login form was submitted

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";


    // Try to login

    $user = $userModel->login(
        $email,
        $password
    );


    // Login successful

    if ($user) {

        $_SESSION["user_id"] = $user["id"];

        header("Location: ../views/dashboard.php");

        exit;
    }


    // Login failed

    $_SESSION["login_error"] =
        "Invalid email or password.";

    header("Location: ../views/login.php");

    exit;
}


// If someone opens AuthController directly

header("Location: ../views/login.php");

exit;

?>