<?php session_start(); ?>
<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <title>Tentang Kami - PrimeProperty</title>
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

  <!-- ===== ABOUT COMPANY ===== -->
  <section class="about">
    <div class="container">
      <h2>Tentang PrimeProperty</h2>
      <p>
        PrimeProperty adalah agen properti profesional yang berfokus pada
        penjualan rumah, apartemen, dan investasi properti premium di berbagai
        kota besar Indonesia.
      </p>
      <p>
        Dengan pengalaman lebih dari 10 tahun di industri properti, kami telah
        membantu ratusan klien menemukan hunian impian dan investasi terbaik
        mereka.
      </p>
    </div>
  </section>

  <!-- ===== SALES TEAM ===== -->
  <?php
  include "config/koneksi.php";
  $query = mysqli_query($conn, "SELECT * FROM sales_agents ORDER BY id DESC");
  ?>

  <section class="featured-properties">
    <div class="container">
      <h2>Tim Sales Kami</h2>

      <div class="property-grid">

        <?php while ($row = mysqli_fetch_assoc($query)) { ?>

          <article class="property-card reveal">
            <img src="images/<?php echo $row['image']; ?>" alt="">
            <h3><?php echo $row['name']; ?></h3>
            <p><?php echo $row['position']; ?></p>
            <span class="price">📞 <?php echo $row['phone']; ?></span>
            <a href="tel:<?php echo $row['phone']; ?>" class="btn-secondary">
              Hubungi Sekarang
            </a>
          </article>

        <?php } ?>

      </div>
    </div>
  </section>

  <!-- ===== TESTIMONIALS ===== -->
  <section class="testimonials">
    <div class="container">
      <h2>Testimoni Klien Kami</h2>

      <div class="property-grid">
        <div class="testimonial-card reveal">
          <p>
            "Pelayanan Havin sangat profesional dan cepat dalam membantu
            proses KPR. Saya sangat puas dengan PrimeProperty."
          </p>
          <h4>- Budi Santoso, Jakarta</h4>
        </div>

        <div class="testimonial-card reveal">
          <p>
            "Saya berhasil mendapatkan apartemen dengan harga terbaik. Tim
            PrimeProperty sangat transparan dan terpercaya."
          </p>
          <h4>- Sinta Maharani, Surabaya</h4>
        </div>

        <div class="testimonial-card reveal">
          <p>
            "Investasi villa di Bali melalui PrimeProperty sangat
            menguntungkan. Prosesnya mudah dan aman."
          </p>
          <h4>- Michael Tan, Bali</h4>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <div class="container">
      <p>&copy; 2026 PrimeProperty</p>
    </div>
  </footer>
  <script src="js/script.js"></script>
</body>

</html>