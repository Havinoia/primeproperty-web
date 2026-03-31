<?php
session_start();
include "config/koneksi.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$query = mysqli_query($conn, "SELECT * FROM properties WHERE id=$id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Properti tidak ditemukan";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?php echo $data['title']; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <script>
      const savedTheme = localStorage.getItem('theme') || 'light';
      document.documentElement.setAttribute('data-theme', savedTheme);
    </script>
</head>

<body>
    <header>
      <div class="container">
        <div class="logo">
          <h1>PrimeProperty</h1>
        </div>
        <button id="menu-toggle" class="menu-toggle" aria-label="Toggle Navigation">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <nav>
          <ul>
            <li><a href="index.php">Beranda</a></li>
            <li><a href="properties.php">Properti</a></li>
            <li><a href="about.php">Tentang Kami</a></li>
            <li><a href="contact.php">Hubungi Kami</a></li>
          </ul>
        </nav>
        <div class="nav-cta">
          <button id="theme-toggle" class="theme-toggle" title="Ubah Tema">☀️</button>
          <?php if (isset($_SESSION['customer'])): ?>
            <a href="logout_customer.php" class="btn-primary">Logout</a>
          <?php else: ?>
            <a href="login_customer.php" class="btn-primary">Login</a>
          <?php endif; ?>
        </div>
      </div>
    </header>

    <div class="detail-container">

        <div class="detail-card">

            <img src="images/<?php echo $data['image']; ?>" class="detail-image">

            <div class="detail-content">

                <h2><?php echo $data['title']; ?></h2>

                <p><strong>📍 Lokasi:</strong> <?php echo $data['location']; ?></p>

                <p><strong>💰 Harga:</strong> <?php echo $data['price']; ?></p>

                <p>
                    <strong>Status:</strong>
                </p>

                <span class="status <?php echo $data['status']; ?>">
                    <?php echo strtoupper($data['status']); ?>
                </span>

                <p class="description">
                    <?php echo nl2br($data['description']); ?>
                </p>

                <div class="button-group">

                    <a href="javascript:history.back()" class="btn-back">
                        ← Kembali
                    </a>

                    <?php if (isset($_SESSION['customer'])): ?>

                        <?php if ($data['status'] == 'available'): ?>
                            <a href="#" class="btn-contact">
                                Hubungi Sales
                            </a>
                        <?php else: ?>
                            <button class="btn-sold" disabled>
                                Sudah Terjual
                            </button>
                        <?php endif; ?>

                    <?php else: ?>
                        <a href="login_customer.php" class="btn-contact">
                            Login Untuk Kontak
                        </a>
                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

    <footer>
      <div class="container">
        <p>&copy; 2026 PrimeProperty</p>
      </div>
    </footer>
    <script src="js/script.js"></script>
</body>

</html>