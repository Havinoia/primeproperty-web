<?php
session_start();
include "config/koneksi.php";
?>

<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PrimeProperty - Temukan Rumah Impian Anda</title>
  <meta
    name="description"
    content="Temukan rumah, apartemen, dan properti terbaik dengan harga terbaik hanya di PrimeProperty." />
  <link rel="stylesheet" href="css/style.css" />

</head>

<body>
  <!-- ===== HEADER / NAVBAR ===== -->
  <header>
    <div class="container">
      <div class="logo">
        <h1>PrimeProperty</h1>
      </div>
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


    </div>
  </header>

  <!-- ===== HERO SECTION ===== -->
  <section class="hero">
    <div class="container">
      <h2>Temukan Properti Impian Anda</h2>
      <p>
        Rumah, apartemen, dan investasi properti terbaik dengan lokasi
        strategis.
      </p>
      <div>
        <?php if (isset($_SESSION['customer'])): ?>
          <a href="properties.php" class="btn-primary">Lihat Properti</a></li>
        <?php else: ?>
          <a href="login_customer.php" class="btn-primary">Lihat Properti</a></li>
        <?php endif; ?>
      </div>

    </div>
  </section>

  <!-- ===== PAGE TITLE ===== -->
  <section class="featured-properties">
    <div class="container">

      <h2>Properti Terbaru</h2>

      <!-- BLUR AKTIF JIKA BELUM LOGIN -->
      <div class="property-grid <?php echo isset($_SESSION['customer']) ? '' : 'blur'; ?>">

        <?php
        $query = mysqli_query($conn, "
          SELECT * FROM properties 
          ORDER BY id DESC 
          LIMIT 3
      ");

        if (mysqli_num_rows($query) > 0):

          while ($row = mysqli_fetch_assoc($query)):
        ?>

            <article class="property-card reveal">

              <img src="images/<?php echo $row['image']; ?>" alt="">

              <h3><?php echo $row['title']; ?></h3>

              <p>📍 <?php echo $row['location']; ?></p>

              <span class="price">
                💰 <?php echo $row['price']; ?>
              </span>

              <?php if (isset($_SESSION['customer'])): ?>
                <a href="property_detail.php?id=<?php echo $row['id']; ?>"
                  class="btn-secondary">
                  Lihat Detail
                </a>
              <?php else: ?>
                <a href="login_customer.php" class="btn-secondary">
                  Login Untuk Detail
                </a>
              <?php endif; ?>

            </article>

        <?php
          endwhile;
        endif;
        ?>

      </div>

    </div>
  </section>

  <!-- ===== ABOUT SECTION ===== -->
  <section class="about">
    <div class="container">
      <h2>Mengapa Memilih Kami?</h2>
      <p>
        Kami menyediakan properti terbaik dengan harga kompetitif dan proses
        transaksi yang aman.
      </p>
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

  <!-- ===== CALL TO ACTION ===== -->
  <section class="cta">
    <div class="container">
      <h2>Siap Menemukan Properti Impian?</h2>
      <a href="contact.php" class="btn-primary">Hubungi Kami Sekarang</a>
    </div>
  </section>

  <!-- ===== FOOTER ===== -->
  <footer>
    <div class="container">
      <p>&copy; 2026 PrimeProperty. All Rights Reserved.</p>
    </div>
  </footer>
  <script src="js/script.js"></script>
</body>

</html>