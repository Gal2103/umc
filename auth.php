<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Role-based access control
function checkRole($roles) {
    if (!in_array($_SESSION['role'], $roles)) {
        header("Location: ../login.php");
        exit();
    }
}
?>
