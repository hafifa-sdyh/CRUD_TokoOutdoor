<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah session admin sudah ada
if (!isset($_SESSION['admin'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>