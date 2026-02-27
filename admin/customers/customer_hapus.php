<?php
include "../../config/koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: customer_dashboard.php");
    exit;
}

$id = $_GET['id'];

// Hapus data dengan prepared statement
$stmt = mysqli_prepare($conn, "DELETE FROM customers WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: customer_dashboard.php");
    exit;
} else {
    echo "Gagal menghapus data!";
}
?>