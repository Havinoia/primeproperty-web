<?php
session_start();
include "config/koneksi.php";

$error = "";
$success = "";

if (isset($_POST['register'])) {

    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    // Validasi kosong
    if (empty($username) || empty($password) || empty($confirm)) {
        $error = "Semua field wajib diisi!";
    }
    // Validasi password sama
    elseif ($password !== $confirm) {
        $error = "Password tidak sama!";
    } else {

        // Cek username sudah ada di tabel customers
        $stmt = mysqli_prepare($conn, "SELECT id FROM customers WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_fetch_assoc($result)) {
            $error = "Username sudah digunakan!";
        } else {

            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert ke tabel customers
            $stmt = mysqli_prepare($conn, "INSERT INTO customers (username, password) VALUES (?, ?)");
            mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);

            if (mysqli_stmt_execute($stmt)) {
                // Redirect ke halaman login
                $_SESSION['register_success'] = "Registrasi berhasil. Silakan login.";
                header("Location: login_customer.php");
                exit;
            } else {
                $error = "Terjadi kesalahan saat registrasi.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Register Customer</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
      const savedTheme = localStorage.getItem('theme') || 'light';
      document.documentElement.setAttribute('data-theme', savedTheme);
    </script>
</head>

<body>
    <header>
      <div class="container">
        <div class="logo">
          <h1>PrimeProperty</h1>
        </div>
        <button id="menu-toggle" class="menu-toggle" aria-label="Toggle Navigation">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <div class="nav-cta">
          <button id="theme-toggle" class="theme-toggle" title="Ubah Tema">☀️</button>
          <a href="index.php" class="btn-secondary">Beranda</a>
        </div>
      </div>
    </header>

    <div class="container" style="max-width: 500px; margin-top: 60px;">
      <div class="contact-form reveal">

        <h2>Register Customer</h2>

        <?php if ($error): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p style="color:green;"><?php echo $success; ?></p>
        <?php endif; ?>

        <form method="POST">

            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Konfirmasi Password</label>
            <input type="password" name="confirm_password" required>

            <button type="submit" name="register" class="btn-primary btn-sm" style="width: 100%; margin-top: 20px;">
                Daftar Sekarang
            </button>

            <p style="margin-top: 20px; text-align: center; color: var(--text-muted);">
              Sudah punya akun? <a href="login_customer.php" style="color: var(--primary); font-weight: 600;">Login Disini</a>
            </p>
        </form>
      </div>
    </div>

    <footer>
      <div class="container">
        <p>&copy; 2026 PrimeProperty</p>
      </div>
    </footer>
    <script src="js/script.js"></script>
</body>

</html>