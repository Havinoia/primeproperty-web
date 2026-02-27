<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

include "../../config/koneksi.php";

/* Validasi ID */
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header("Location: property_dashboard.php");
    exit;
}

/* Ambil data lama */
$result = mysqli_query($conn, "SELECT * FROM properties WHERE id=$id");
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Data tidak ditemukan";
    exit;
}

/* Jika tombol update ditekan */
if (isset($_POST['update'])) {

    $title       = $_POST['title'];
    $location    = $_POST['location'];
    $price       = $_POST['price'];
    $description = $_POST['description'];
    $status      = $_POST['status'];

    $query = mysqli_query($conn, "
        UPDATE properties SET
            title='$title',
            location='$location',
            price='$price',
            description='$description',
            status='$status'
        WHERE id=$id
    ");

    if ($query) {
        header("Location: property_dashboard.php");
        exit;
    } else {
        echo "Gagal update data";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Properti</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<div class="container">
    <h2>Edit Properti</h2>

    <form method="POST">

        Judul:<br>
        <input type="text" name="title"
            value="<?php echo htmlspecialchars($data['title']); ?>" required>
        <br><br>

        Lokasi:<br>
        <input type="text" name="location"
            value="<?php echo htmlspecialchars($data['location']); ?>" required>
        <br><br>

        Harga:<br>
        <input type="text" name="price"
            value="<?php echo htmlspecialchars($data['price']); ?>" required>
        <br><br>

        Deskripsi:<br>
        <textarea name="description" rows="5" required><?php echo htmlspecialchars($data['description']); ?></textarea>
        <br><br>

        Status:<br>
        <select name="status" required>
            <option value="available"
                <?php if ($data['status'] == 'available') echo 'selected'; ?>>
                Available
            </option>

            <option value="sold"
                <?php if ($data['status'] == 'sold') echo 'selected'; ?>>
                Sold
            </option>
        </select>
        <br><br>

        <button type="submit" name="update">
            Update
        </button>

    </form>
</div>

</body>
</html>