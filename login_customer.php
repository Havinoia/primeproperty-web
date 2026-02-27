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
</head>

<body>

    <div class="container">

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

            Username:<br>
            <input type="text" name="username" required><br><br>

            Password:<br>
            <input type="password" name="password" required><br><br>

            <button type="submit" name="login" class="btn-primary">
                Login
            </button>

            <a href="register_customer.php">Belum punya akun? Daftar</a>
        </form>


    </div>

</body>

</html>



</div>

</body>

</html>