<?php

session_start();

if (isset($_SESSION["user_id"])) {
    header("Location: Views/dashboard.php");
    exit;
}

header("Location: Views/login.php");
exit;

?>