<?php
include "../../config/koneksi.php";

$error = "";

if (isset($_POST['simpan'])) {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Semua field wajib diisi!";
    } else {

        // Cek username sudah ada
        $stmt = mysqli_prepare($conn, "SELECT id FROM customers WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_fetch_assoc($result)) {
            $error = "Username sudah digunakan!";
        } else {

            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert ke database
            $stmt = mysqli_prepare($conn, "INSERT INTO customers (username, password) VALUES (?, ?)");
            mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: customer_dashboard.php");
                exit;
            } else {
                $error = "Gagal menambahkan customer!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Customer</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<div class="container">
    <h2>Tambah Customer</h2>

    <?php if($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST">

        Username:<br>
        <input type="text" name="username" required><br><br>

        Password:<br>
        <input type="password" name="password" required><br><br>

        <button type="submit" name="simpan" class="btn btn-primary">
            Simpan
        </button>

    </form>
</div>

</body>
</html>