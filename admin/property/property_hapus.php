<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

include "../../config/koneksi.php";

$id = $_GET['id'];

// Hapus data
mysqli_query($conn, "DELETE FROM properties WHERE id=$id");

// Kembali ke dashboard property
header("Location: property_dashboard.php");
exit;