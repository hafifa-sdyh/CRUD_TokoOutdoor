<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($koneksi, trim($_POST['username']));
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username dan password wajib diisi!";
        header("Location: login.php");
        exit;
    }

    $query  = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // Cek pencocokan password (mendukung teks 'admin123' maupun enkripsi hash)
        $is_password_correct = ($password === $user['password']) || password_verify($password, $user['password']);

        if ($is_password_correct) {
            $_SESSION['admin'] = [
                'id'           => $user['id'],
                'username'     => $user['username'],
                'nama_lengkap' => $user['nama_lengkap'],
                'role'         => $user['role']
            ];

            header("Location: ../admin/index.php");
            exit;
        } else {
            $_SESSION['error'] = "Password yang Anda masukkan salah!";
            header("Location: login.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "Username tidak ditemukan!";
        header("Location: login.php");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}