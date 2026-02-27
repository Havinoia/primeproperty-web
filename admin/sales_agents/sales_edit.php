<head>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<?php
include "../../config/koneksi.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM sales_agents WHERE id=$id"));

if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $position = $_POST['position'];
    $phone = $_POST['phone'];

    mysqli_query($conn, "UPDATE sales_agents SET
        name='$name',
        position='$position',
        phone='$phone'
        WHERE id=$id");

    header("Location: sales_dashboard.php");
}
?>

<div class="container">
    <h2>Edit Properti</h2>

    <form method="POST">
        Judul:<br>
        <input type="text" name="name" value="<?php echo $data['name']; ?>"><br><br>

        Lokasi:<br>
        <input type="text" name="position" value="<?php echo $data['position']; ?>"><br><br>

        Harga:<br>
        <input type="text" name="phone" value="<?php echo $data['phone']; ?>"><br><br>

        <button type="submit" name="update">Update</button>
    </form>
</div>