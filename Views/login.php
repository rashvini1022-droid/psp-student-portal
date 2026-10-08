<?php

session_start();

$error = $_SESSION["login_error"] ?? "";

unset($_SESSION["login_error"]);

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>PSP Student Portal</title>


    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">


    <!-- Page Style -->

    <style>

        body {

            min-height: 100vh;

            background-color: #f5f7fa;

            display: flex;

            align-items: center;

            justify-content: center;

        }


        .login-container {

            width: 100%;

            max-width: 450px;

            padding: 20px;

        }


        .login-card {

            border: none;

            border-radius: 15px;

        }


        .login-title {

            font-weight: bold;

            color: #0d6efd;

        }


        .login-button {

            border-radius: 8px;

            padding: 10px;

            font-weight: 500;

        }

    </style>

</head>


<body>


<div class="login-container">


    <!-- LOGIN CARD -->

    <div class="card shadow login-card">

        <div class="card-body p-4">


            <!-- TITLE -->

            <h2 class="text-center mb-4 login-title">

                PSP Student Portal

            </h2>


            <!-- ERROR MESSAGE -->

            <?php if (!empty($error)): ?>

                <div class="alert alert-danger">

                    <?= htmlspecialchars($error) ?>

                </div>

            <?php endif; ?>


            <!-- LOGIN FORM -->

            <form
                action="../controllers/AuthController.php"
                method="POST"
            >


                <!-- EMAIL -->

                <div class="mb-3">

                    <label
                        for="email"
                        class="form-label"
                    >

                        Email

                    </label>


                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        placeholder="Enter your email"
                        required
                    >

                </div>


                <!-- PASSWORD -->

                <div class="mb-3">

                    <label
                        for="password"
                        class="form-label"
                    >

                        Password

                    </label>


                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Enter your password"
                        required
                    >

                </div>


                <!-- LOGIN BUTTON -->

                <button
                    type="submit"
                    class="btn btn-primary w-100 login-button"
                >

                    Login

                </button>


            </form>


        </div>

    </div>


    <!-- FOOTER -->

    <p class="text-center text-muted mt-3">

        PSP Student Portal

    </p>


</div>


</body>

</html>