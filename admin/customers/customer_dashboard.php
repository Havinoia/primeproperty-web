<?php
include "../../config/koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Customers</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<div class="container">
    <h2>Data Customers</h2>

    <a href="../logout.php" class="btn btn-danger">Logout</a>

    <a href="customer_tambah.php" class="btn btn-primary">+ Tambah Customer</a>
    <br><br>

    <table>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        $query = mysqli_query($conn, "SELECT * FROM customers ORDER BY id DESC");

        while ($row = mysqli_fetch_assoc($query)) {
        ?>

        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td>
                <a href="customer_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                <a href="customer_hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"
                   onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>

        <?php } ?>

    </table>
</div>

</body>
</html>