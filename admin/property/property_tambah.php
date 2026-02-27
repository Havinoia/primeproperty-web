<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

include "../../config/koneksi.php";

if (isset($_POST['simpan'])) {

    $title = $_POST['title'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $image = $_FILES['image']['name'];
    $tmp   = $_FILES['image']['tmp_name'];

    // upload ke folder images utama
    move_uploaded_file($tmp, "../../images/" . $image);

    mysqli_query($conn, "INSERT INTO properties 
(title, location, price, description, status, image)
VALUES 
('$title', '$location', '$price', '$description', '$status', '$image')");

    header("Location: property_dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Properti</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>

    <div class="container">
        <h2>Tambah Properti</h2>

        <form method="POST" enctype="multipart/form-data">

            Judul:<br>
            <input type="text" name="title" required><br><br>

            Lokasi:<br>
            <input type="text" name="location" required><br><br>

            Harga:<br>
            <input type="text" name="price" required><br><br>

            Deskripsi:<br>
            <textarea name="description" required></textarea><br><br>

            Status:<br>
            <select name="status">
                <option value="available">Available</option>
                <option value="sold">Sold</option>
            </select><br><br>

            Gambar:<br>
            <input type="file" name="image" required><br><br>

            <button type="submit" name="simpan">
                Simpan
            </button>

        </form>
    </div>

</body>

</html>