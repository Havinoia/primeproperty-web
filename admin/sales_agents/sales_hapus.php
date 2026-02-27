<?php
include "../../config/koneksi.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM sales_agents WHERE id=$id");

header("Location: sales_dashboard.php");
