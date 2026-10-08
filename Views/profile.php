<?php

session_start();

require_once "../config/Database.php";
require_once "../models/User.php";


// Check login

if (!isset($_SESSION["user_id"])) {

    header("Location: ../controllers/AuthController.php");
    exit;
}


// Get messages

$uploadError = $_SESSION["upload_error"] ?? null;
$uploadSuccess = $_SESSION["upload_success"] ?? null;


// Remove messages after reading

unset($_SESSION["upload_error"]);
unset($_SESSION["upload_success"]);


// Connect database

$database = new Database();
$connection = $database->connect();


// Create User object

$userModel = new User($connection);


// Get current user

$user = $userModel->getUserById(
    $_SESSION["user_id"]
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>My Profile - PSP Student Portal</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>


<body>


<!-- NAVBAR -->

<nav class="navbar navbar-dark bg-primary">

    <div class="container">

        <a
            class="navbar-brand"
            href="dashboard.php"
        >
            PSP Student Portal
        </a>


        <div>

            <a
                href="dashboard.php"
                class="btn btn-light btn-sm"
            >
                Dashboard
            </a>


            <a
                href="../controllers/LogoutController.php"
                class="btn btn-danger btn-sm"
            >
                Logout
            </a>

        </div>

    </div>

</nav>



<!-- MAIN CONTENT -->

<div class="container mt-5">


    <h2 class="mb-4">
        My Profile
    </h2>



    <!-- SUCCESS MESSAGE -->

    <?php if ($uploadSuccess): ?>

        <div class="alert alert-success">

            <?php echo htmlspecialchars($uploadSuccess); ?>

        </div>

    <?php endif; ?>



    <!-- ERROR MESSAGE -->

    <?php if ($uploadError): ?>

        <div class="alert alert-danger">

            <?php echo htmlspecialchars($uploadError); ?>

        </div>

    <?php endif; ?>



    <div class="row">


        <!-- PROFILE PICTURE -->

        <div class="col-md-4 text-center">

            <?php if (
                !empty($user["profile_picture"])
            ): ?>

                <img
                    src="../uploads/<?php
                        echo htmlspecialchars(
                            $user["profile_picture"]
                        );
                    ?>"
                    alt="Profile Picture"
                    class="img-thumbnail"
                    style="
                        width: 200px;
                        height: 200px;
                        object-fit: cover;
                    "
                >

            <?php else: ?>

                <div
                    class="border rounded p-5 text-muted"
                    style="width: 200px; margin: auto;"
                >
                    No Profile Picture
                </div>

            <?php endif; ?>

        </div>



        <!-- STUDENT INFORMATION -->

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">

                    <h5 class="mb-0">
                        Student Information
                    </h5>

                </div>


                <div class="card-body">

                    <p>
                        <strong>Student ID:</strong>

                        <?php
                        echo htmlspecialchars(
                            $user["student_id"]
                        );
                        ?>

                    </p>


                    <p>
                        <strong>Name:</strong>

                        <?php
                        echo htmlspecialchars(
                            $user["name"]
                        );
                        ?>

                    </p>


                    <p>
                        <strong>Email:</strong>

                        <?php
                        echo htmlspecialchars(
                            $user["email"]
                        );
                        ?>

                    </p>


                    <p>
                        <strong>Block:</strong>

                        <?php
                        echo htmlspecialchars(
                            $user["block"]
                        );
                        ?>

                    </p>

                </div>

            </div>

        </div>

    </div>



    <!-- UPLOAD SECTION -->

    <div class="card mt-4">

        <div class="card-header">

            <h5 class="mb-0">
                Upload Profile Picture
            </h5>

        </div>


        <div class="card-body">

            <form
                action="../controllers/ProfileController.php"
                method="POST"
                enctype="multipart/form-data"
            >


                <label
                    for="profile_picture"
                    class="form-label"
                >
                    Choose Profile Picture
                </label>


                <input
                    type="file"
                    name="profile_picture"
                    id="profile_picture"
                    class="form-control mb-2"
                    accept=".jpg,.jpeg,.png"
                    required
                >


                <small class="text-muted">

                    Allowed: JPG, JPEG, PNG |
                    Maximum size: 2 MB

                </small>


                <br><br>


                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Upload Picture
                </button>


                <a
                    href="dashboard.php"
                    class="btn btn-secondary"
                >
                    Back to Dashboard
                </a>


            </form>

        </div>

    </div>


</div>



<!-- FOOTER -->

<footer class="text-center mt-5 mb-4 text-muted">

    <p>
        PSP Student Portal
    </p>

</footer>


</body>

</html>