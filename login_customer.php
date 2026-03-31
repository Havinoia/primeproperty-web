<?php
session_start();
include "config/koneksi.php";

$success = "";
$error = "";

// Cek apakah ada pesan dari register
if (isset($_SESSION['register_success'])) {
    $success = $_SESSION['register_success'];
    unset($_SESSION['register_success']); // hapus agar tidak muncul lagi
}

if (isset($_POST['login'])) {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validasi kosong
    if (empty($username) || empty($password)) {
        $error = "Username dan password wajib diisi!";
    } else {

        // Ambil data dari tabel customers
        $stmt = mysqli_prepare($conn, "SELECT id, username, password FROM customers WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($data = mysqli_fetch_assoc($result)) {

            // Verifikasi password hash
            if (password_verify($password, $data['password'])) {

                session_regenerate_id(true);

                // Set session customer
                $_SESSION['customer'] = $data['username'];
                $_SESSION['customer_id'] = $data['id'];

                header("Location: index.php");
                exit;
            } else {
                $error = "Username atau password salah!";
            }
        } else {
            $error = "Username atau password salah!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login Customer</title>
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

        <h2>Login Customer</h2>

        <?php if (!empty($error)) : ?>
            <p style="color:red;">
                <?php echo $error; ?>
            </p>
        <?php endif; ?>

        <?php if (!empty($success)) : ?>
            <p style="color:green;">
                <?php echo $success; ?>
            </p>
        <?php endif; ?>

        <form method="POST">

            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit" name="login" class="btn-primary btn-sm" style="width: 100%; margin-top: 20px;">
                Login
            </button>

            <p style="margin-top: 20px; text-align: center; color: var(--text-muted);">
              Belum punya akun? <a href="register_customer.php" style="color: var(--primary); font-weight: 600;">Daftar Sekarang</a>
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



</div>

</body>

</html>