<head>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<?php
include "../../config/koneksi.php";

if (isset($_POST['simpan'])) {

    $name = $_POST['name'];
    $position = $_POST['position'];
    $phone = $_POST['phone'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "../../images/" . $image);

    mysqli_query($conn, "INSERT INTO sales_agents 
        (name, position, phone, image)
        VALUES ('$name', '$position', '$phone', '$image')");

    header("Location: sales_dashboard.php");
}
?>

<div class="container">
    <h2>Tambah Properti</h2>

    <form method="POST" enctype="multipart/form-data">
        nama:<br>
        <input type="text" name="name" required><br><br>

        posisi:<br>
        <input type="text" name="position" required><br><br>

        phone:<br>
        <input type="text" name="phone" required><br><br>

        Gambar:<br>
        <input type="file" name="image" required><br><br>

        <button type="submit" name="simpan">Simpan</button>
    </form>
</div>