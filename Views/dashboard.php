<?php

session_start();

require_once "../config/Database.php";
require_once "../models/User.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ../controllers/AuthController.php");
    exit;
}

$database = new Database();
$connection = $database->connect();

$userModel = new User($connection);

$user = $userModel->getUserById($_SESSION["user_id"]);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PSP Student Portal</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body>

<!-- NAVBAR -->

<nav class="navbar navbar-dark bg-primary">

    <div class="container">

        <a class="navbar-brand fw-bold" href="dashboard.php">
            PSP Student Portal
        </a>

        <div>

            <a
                href="profile.php"
                class="btn btn-light btn-sm">
                My Profile
            </a>

            <a
                href="../controllers/LogoutController.php"
                class="btn btn-danger btn-sm">
                Logout
            </a>

        </div>

    </div>

</nav>


<!-- MAIN CONTENT -->

<div class="container mt-5">

    <div class="text-center mb-5">

        <h1>
            Welcome, <?= htmlspecialchars($user["name"]) ?>! 👋
        </h1>

        <p class="text-muted">
            Welcome to the PSP Student Portal
        </p>

    </div>


    <!-- STUDENT INFORMATION -->

    <div class="row mb-4">

        <div class="col-md-6 mb-3">

            <div class="card shadow">

                <div class="card-body">

                    <h5 class="card-title">
                        Student Information
                    </h5>

                    <hr>

                    <p>
                        <strong>Student ID:</strong>
                        <?= htmlspecialchars($user["student_id"]) ?>
                    </p>

                    <p>
                        <strong>Name:</strong>
                        <?= htmlspecialchars($user["name"]) ?>
                    </p>

                    <p>
                        <strong>Email:</strong>
                        <?= htmlspecialchars($user["email"]) ?>
                    </p>

                    <p>
                        <strong>Block:</strong>
                        <?= htmlspecialchars($user["block"]) ?>
                    </p>

                    <a
                        href="profile.php"
                        class="btn btn-primary">
                        View Profile
                    </a>

                </div>

            </div>

        </div>


        <!-- ACCOUNT -->

        <div class="col-md-6 mb-3">

            <div class="card shadow">

                <div class="card-body">

                    <h5 class="card-title">
                        Account
                    </h5>

                    <hr>

                    <p>
                        Your student account is active.
                    </p>

                    <p>
                        You can view your profile and profile picture.
                    </p>

                    <a
                        href="profile.php"
                        class="btn btn-primary">
                        View Profile
                    </a>

                </div>

            </div>

        </div>

    </div>


    <!-- QUICK ACCESS -->

    <h3 class="mb-3">
        Quick Access
    </h3>


    <div class="row">


        <!-- PROFILE -->

        <div class="col-md-6 mb-3">

            <div class="card shadow h-100">

                <div class="card-body text-center">

                    <h4>👤</h4>

                    <h5>
                        My Profile
                    </h5>

                    <p class="text-muted">
                        View your student information and profile picture.
                    </p>

                    <a
                        href="profile.php"
                        class="btn btn-primary">
                        Open Profile
                    </a>

                </div>

            </div>

        </div>


        <!-- LOGOUT -->

        <div class="col-md-6 mb-3">

            <div class="card shadow h-100">

                <div class="card-body text-center">

                    <h4>🚪</h4>

                    <h5>
                        Logout
                    </h5>

                    <p class="text-muted">
                        Sign out from your account.
                    </p>

                    <a
                        href="../controllers/LogoutController.php"
                        class="btn btn-danger">
                        Logout
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- FOOTER -->

<footer class="text-center mt-5 mb-3">

    <p class="text-muted">
        © 2026 PSP Student Portal
    </p>

</footer>


</body>

</html>