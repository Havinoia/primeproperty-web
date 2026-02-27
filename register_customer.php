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
</head>

<body>

    <div class="container">

        <h2>Register Customer</h2>

        <?php if ($error): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p style="color:green;"><?php echo $success; ?></p>
        <?php endif; ?>

        <form method="POST">

            Username:<br>
            <input type="text" name="username" required><br><br>

            Password:<br>
            <input type="password" name="password" required><br><br>

            Konfirmasi Password:<br>
            <input type="password" name="confirm_password" required><br><br>

            <button type="submit" name="register" class="btn-primary">
                Register
            </button>

        </form>

        <br>
        <a href="login_customer.php">Sudah punya akun? Login</a>

    </div>

</body>

</html>