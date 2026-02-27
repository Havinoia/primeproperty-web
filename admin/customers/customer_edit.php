<?php
include "../../config/koneksi.php";

$id = $_GET['id'];
$error = "";

// Ambil data lama
$stmt = mysqli_prepare($conn, "SELECT * FROM customers WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data tidak ditemukan!");
}

if (isset($_POST['update'])) {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username)) {
        $error = "Username wajib diisi!";
    } else {

        // Jika password diisi → hash ulang
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = mysqli_prepare($conn, "UPDATE customers SET username=?, password=? WHERE id=?");
            mysqli_stmt_bind_param($stmt, "ssi", $username, $hashed_password, $id);
        } 
        // Jika password kosong → tidak diubah
        else {
            $stmt = mysqli_prepare($conn, "UPDATE customers SET username=? WHERE id=?");
            mysqli_stmt_bind_param($stmt, "si", $username, $id);
        }

        if (mysqli_stmt_execute($stmt)) {
            header("Location: customer_dashboard.php");
            exit;
        } else {
            $error = "Gagal mengupdate data!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<div class="container">
    <h2>Edit Customer</h2>

    <?php if($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST">

        Username:<br>
        <input type="text" name="username"
               value="<?php echo $data['username']; ?>" required><br><br>

        Password Baru (kosongkan jika tidak ingin mengubah):<br>
        <input type="password" name="password"><br><br>

        <button type="submit" name="update" class="btn btn-warning">
            Update
        </button>

    </form>
</div>

</body>
</html>