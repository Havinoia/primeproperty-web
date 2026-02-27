<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <?php
    session_start();

    if (!isset($_SESSION['admin'])) {
        header("Location: ../login.php");
        exit;
    }

    include "../../config/koneksi.php";
    ?>

    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <title>Dashboard Admin Property</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>

        <div class="container">

            <h2>Dashboard Admin Property</h2>

            <a href="../logout.php" class="btn btn-danger">Logout</a>

            <a href="property_tambah.php" class="btn btn-primary">
                + Tambah Properti
            </a>

            <br><br>

            <table>

                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Lokasi</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>

                <?php
                $no = 1;
                $query = mysqli_query($conn, "SELECT * FROM properties ORDER BY id DESC");

                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                ?>

                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['location']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td>
                                <img src="../../images/<?php echo $row['image']; ?>" width="80">
                            </td>
                            <td>
                                <a href="property_edit.php?id=<?php echo $row['id']; ?>"
                                    class="btn btn-warning">
                                    Edit
                                </a>

                                <a href="property_hapus.php?id=<?php echo $row['id']; ?>"
                                    class="btn btn-danger"
                                    onclick="return confirm('Yakin hapus data ini?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>

                <?php
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center;'>Belum ada data properti.</td></tr>";
                }
                ?>

            </table>

        </div>

    </html>