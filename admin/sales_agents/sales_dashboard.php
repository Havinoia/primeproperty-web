<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include "../../config/koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Sales</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>

<div class="container">

    <h2>Dashboard Admin Sales</h2>
    <a href="../logout.php" class="btn btn-danger">Logout</a>

    <a href="sales_tambah.php" class="btn btn-primary">
        + Tambah Sales
    </a>

    <br><br>

    <table>

        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Posisi</th>
            <th>Phone</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        $query = mysqli_query($conn, "SELECT * FROM sales_agents ORDER BY id DESC");

        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
        ?>

        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['position']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td>
                <img src="../../images/<?php echo $row['image']; ?>" width="80">
            </td>
            <td>
                <a href="sales_edit.php?id=<?php echo $row['id']; ?>" 
                   class="btn btn-warning">
                   Edit
                </a>

                <a href="sales_hapus.php?id=<?php echo $row['id']; ?>" 
                   class="btn btn-danger"
                   onclick="return confirm('Yakin hapus data ini?')">
                   Hapus
                </a>
            </td>
        </tr>

        <?php
            }
        } else {
            echo "<tr><td colspan='6' style='text-align:center;'>Belum ada data sales.</td></tr>";
        }
        ?>

    </table>

</div>

</body>
</html>