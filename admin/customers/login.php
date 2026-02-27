<?php
session_start();
include "../../config/koneksi.php";

$error = "";

if (isset($_POST['login'])) {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Cegah jika kosong
    if (empty($username) || empty($password)) {
        $error = "Username dan password wajib diisi!";
    } else {

        // Prepared Statement
        $stmt = mysqli_prepare($conn, "SELECT id, username, password FROM admin WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($data = mysqli_fetch_assoc($result)) {

            // Verifikasi password hash
            if (password_verify($password, $data['password'])) {

                session_regenerate_id(true);

                $_SESSION['admin'] = $data['username'];
                $_SESSION['admin_id'] = $data['id'];

                header("Location: customer_dashboard.php");
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
    <title>Login Admin</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<div class="container">

    <h2>Login Admin</h2>

    <?php if (!empty($error)) : ?>
        <p style="color:red;">
            <?php echo $error; ?>
        </p>
    <?php endif; ?>

    <form method="POST">

        Username:<br>
        <input type="text" name="username" required><br><br>

        Password:<br>
        <input type="password" name="password" required><br><br>

        <button type="submit" name="login">
            Login
        </button>

    </form>

</div>

</body>
</html>