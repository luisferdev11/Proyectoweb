<?php
session_start();

function checkSessionAndRole($requiredRole) {
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role'])) {
        header("Location: /public/auth/login.php");
        exit();
    }

    if ($_SESSION['user_role'] !== $requiredRole) {
        header("Location: /public/auth/login.php");
        exit();
    }
}
?>
