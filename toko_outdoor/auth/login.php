<?php
session_start();

// Jika admin sudah login, langsung arahkan ke dashboard admin
if (isset($_SESSION['admin'])) {
    header("Location: ../admin/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - AdventureGear</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #0f172a;
        }

        .login-card {
            background: #ffffff;
            width: 100%;
            max-width: 380px;
            padding: 40px 30px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a3322;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .login-header h2 {
            font-size: 1.3rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .login-header p {
            font-size: 0.875rem;
            color: #64748b;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 11px 14px;
            font-size: 0.925rem;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            transition: all 0.2s ease;
            background-color: #f8fafc;
        }

        .form-group input:focus {
            background-color: #ffffff;
            border-color: #1a3322;
            box-shadow: 0 0 0 3px rgba(26, 51, 34, 0.12);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: #1a3322;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
            margin-top: 8px;
        }

        .btn-login:hover {
            background-color: #2d5a3c;
        }

        .alert-error {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 24px;
            font-size: 0.85rem;
            color: #64748b;
            text-decoration: none;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #1a3322;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <a href="../index.php" class="brand">🏕️ AdventureGear</a>
        
        <div class="login-header">
            <h2>Login Admin</h2>
            <p>Masuk untuk mengelola produk &amp; toko</p>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert-error">
                <?= htmlspecialchars($_SESSION['error']); ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="proses_login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn-login">Masuk ke Dashboard</button>
        </form>

        <a href="../index.php" class="back-link">&larr; Kembali ke Beranda Utama</a>
    </div>

</body>
</html>