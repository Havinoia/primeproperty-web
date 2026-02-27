<?php session_start(); ?>
<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <title>Kontak Kami - PrimeProperty</title>
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <header>
    <div class="container">
      <h1>PrimeProperty</h1>
      <nav>
        <ul>
          <li><a href="index.php">Beranda</a></li>
          <li>
            <?php if (isset($_SESSION['customer'])): ?>
              <a href="properties.php">Properti</a>
          </li>
        <?php else: ?>
          <a href="login_customer.php">Properti</a></li>
        <?php endif; ?>
        </li>

        <li><a href="about.php">Tentang Kami</a></li>
        <li><a href="contact.php">Hubungi Kami</a></li>
        </ul>
      </nav>
      

      <ul>
        <div class="nav-cta">
          <?php if (isset($_SESSION['customer'])): ?>

            <!-- Jika sudah login -->
            <a href="logout_customer.php" class="btn-primary">Logout</a>

          <?php else: ?>

            <!-- Jika belum login -->
            <a href="login_customer.php" class="btn-primary">Login</a>
            <a href="register_customer.php" class="btn-primary">Register</a>

          <?php endif; ?>
        </div>
      </ul>
    </div>
  </header>

  <!-- ===== CONTACT SECTION ===== -->
  <section class="featured-properties">
    <div class="container">
      <h2>Hubungi Kami</h2>
      <p>
        Silakan kirim pesan kepada kami atau hubungi melalui sosial media di
        bawah ini.
      </p>

      <div class="contact-wrapper">
        <!-- FORM -->
        <div class="contact-form">
          <form action="#" method="post">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" required />

            <label>Email</label>
            <input type="email" name="email" required />

            <label>Pesan</label>
            <textarea name="pesan" rows="5" required></textarea>

            <button type="submit" class="btn-primary">Kirim Pesan</button>
          </form>
        </div>

        <!-- INFO -->
        <div class="contact-info">
          <h3>Informasi Kontak</h3>
          <p>📍 Jl. Sudirman No. 123, Jakarta</p>
          <p>📞 0812-3456-7890</p>
          <p>📧 info@primeproperty.com</p>

          <h3>Sosial Media</h3>

          <div class="social-links">
            <a
              href="https://wa.me/6281234567890"
              target="_blank"
              class="btn-secondary">WhatsApp</a>
            <a href="#" class="btn-secondary">Instagram</a>
            <a href="#" class="btn-secondary">Facebook</a>
            <a href="#" class="btn-secondary">TikTok</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <div class="container">
      <p>&copy; 2026 PrimeProperty</p>
    </div>
  </footer>
</body>

</html>