<?php

session_start();

require_once "../config/Database.php";
require_once "../models/User.php";


// Check if user is logged in

if (!isset($_SESSION["user_id"])) {

    header("Location: AuthController.php");
    exit;
}


// Connect to database

$database = new Database();
$connection = $database->connect();

$userModel = new User($connection);


// Check if form was submitted

if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && isset($_FILES["profile_picture"])
) {

    $file = $_FILES["profile_picture"];


    // ==========================================
    // 1. CHECK UPLOAD ERROR
    // ==========================================

    if ($file["error"] !== UPLOAD_ERR_OK) {

        $_SESSION["upload_error"] =
            "Upload failed. Please try again.";

        header("Location: ../views/profile.php");
        exit;
    }


    // ==========================================
    // 2. CHECK FILE SIZE
    // Maximum = 2 MB
    // ==========================================

    $maxFileSize = 2 * 1024 * 1024;

    if ($file["size"] > $maxFileSize) {

        $_SESSION["upload_error"] =
            "File size must not exceed 2 MB.";

        header("Location: ../views/profile.php");
        exit;
    }


    // ==========================================
    // 3. GET FILE EXTENSION
    // ==========================================

    $fileExtension = strtolower(
        pathinfo(
            $file["name"],
            PATHINFO_EXTENSION
        )
    );


    // ==========================================
    // 4. CHECK FILE EXTENSION
    // ONLY JPG, JPEG AND PNG
    // ==========================================

    $allowedExtensions = [
        "jpg",
        "jpeg",
        "png"
    ];


    if (
        !in_array(
            $fileExtension,
            $allowedExtensions,
            true
        )
    ) {

        $_SESSION["upload_error"] =
            "Only JPG, JPEG and PNG files are allowed.";

        header("Location: ../views/profile.php");
        exit;
    }


    // ==========================================
    // 5. CHECK ACTUAL MIME TYPE
    // ==========================================

    $finfo = finfo_open(FILEINFO_MIME_TYPE);

    $mimeType = finfo_file(
        $finfo,
        $file["tmp_name"]
    );

    finfo_close($finfo);


    // ONLY JPEG AND PNG

    $allowedMimeTypes = [
        "image/jpeg",
        "image/png"
    ];


    if (
        !in_array(
            $mimeType,
            $allowedMimeTypes,
            true
        )
    ) {

        $_SESSION["upload_error"] =
            "Only JPG, JPEG and PNG image files are allowed.";

        header("Location: ../views/profile.php");
        exit;
    }


    // ==========================================
    // 6. CREATE UNIQUE FILE NAME
    // ==========================================

    $newFileName =
        uniqid("profile_", true)
        . "."
        . $fileExtension;


    // ==========================================
    // 7. SET UPLOAD LOCATION
    // ==========================================

    $uploadPath =
        "../uploads/"
        . $newFileName;


    // ==========================================
    // 8. MOVE FILE TO UPLOADS FOLDER
    // ==========================================

    if (
        !move_uploaded_file(
            $file["tmp_name"],
            $uploadPath
        )
    ) {

        $_SESSION["upload_error"] =
            "Failed to upload the profile picture.";

        header("Location: ../views/profile.php");
        exit;
    }


    // ==========================================
    // 9. SAVE FILE NAME INTO DATABASE
    // ==========================================

    $userModel->updateProfilePicture(
        $_SESSION["user_id"],
        $newFileName
    );


    // ==========================================
    // 10. SUCCESS MESSAGE
    // ==========================================

    $_SESSION["upload_success"] =
        "Profile picture uploaded successfully.";


    header("Location: ../views/profile.php");
    exit;
}

?>