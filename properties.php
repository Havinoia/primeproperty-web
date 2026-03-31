<?php
session_start();
include "config/koneksi.php";

/* =========================
   GET PARAMETER
========================= */

$limit = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$search   = $_GET['search'] ?? '';
$location = $_GET['location'] ?? '';
$sort     = $_GET['sort'] ?? 'newest';

/* =========================
   COUNT TOTAL DATA
========================= */

$count_sql = "SELECT COUNT(*) as total FROM properties WHERE 1=1";

if ($search != '') {
  $count_sql .= " AND title LIKE '%$search%'";
}

if ($location != '') {
  $count_sql .= " AND location = '$location'";
}

$count_query = mysqli_query($conn, $count_sql);
$total_data  = mysqli_fetch_assoc($count_query);

$total_pages = max(1, ceil($total_data['total'] / $limit));

/* =========================
   MAIN QUERY
========================= */

$sql = "SELECT * FROM properties WHERE 1=1";

if ($search != '') {
  $sql .= " AND title LIKE '%$search%'";
}

if ($location != '') {
  $sql .= " AND location = '$location'";
}

if ($sort == "price_low") {
  $sql .= " ORDER BY price+0 ASC";
} elseif ($sort == "price_high") {
  $sql .= " ORDER BY price+0 DESC";
} else {
  $sql .= " ORDER BY id DESC";
}

$sql .= " LIMIT $limit OFFSET $offset";

$query = mysqli_query($conn, $sql);
?>
<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Properti - PrimeProperty</title>
  <link rel="stylesheet" href="css/style.css">
  <script>
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);
  </script>
</head>

<body>

  <!-- ===== HEADER ===== -->
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

  <!-- ===== PAGE TITLE ===== -->
  <section class="featured-properties">
    <div class="container">
      <h2>Daftar Properti Tersedia</h2>
      <!-- SEARCH & FILTER -->
      <form method="GET" style="margin-bottom:30px; text-align:center;">

        <input type="text"
          name="search"
          placeholder="Cari properti..."
          value="<?php echo $search; ?>">

        <select name="location">
          <option value="">Semua Lokasi</option>
          <option value="Jakarta" <?php if ($location == "Jakarta") echo "selected"; ?>>Jakarta</option>
          <option value="Surabaya" <?php if ($location == "Surabaya") echo "selected"; ?>>Surabaya</option>
          <option value="Bali" <?php if ($location == "Bali") echo "selected"; ?>>Bali</option>
        </select>

        <select name="sort">
          <option value="newest" <?php if ($sort == "newest") echo "selected"; ?>>Terbaru</option>
          <option value="price_low" <?php if ($sort == "price_low") echo "selected"; ?>>Harga Termurah</option>
          <option value="price_high" <?php if ($sort == "price_high") echo "selected"; ?>>Harga Termahal</option>
        </select>

        <button type="submit" class="btn-primary">Filter</button>

      </form>

      <div class="property-grid">

        <?php if (mysqli_num_rows($query) > 0): ?>

          <?php while ($row = mysqli_fetch_assoc($query)): ?>

            <article class="property-card reveal">
              <img src="images/<?php echo $row['image']; ?>">
              <h3><?php echo $row['title']; ?></h3>
              <p><?php echo $row['location']; ?></p>
              <span class="price"><?php echo $row['price']; ?></span>
              <a href="property_detail.php?id=<?php echo $row['id']; ?>"
                  class="btn-secondary">
                  Lihat Detail
                </a>
            </article>

          <?php endwhile; ?>

        <?php else: ?>

          <p style="grid-column:1/-1; text-align:center;">
            Tidak ada properti ditemukan.
          </p>

        <?php endif; ?>

      </div>

      <div style="text-align:center; margin-top:30px;">

        <?php
        $params = [
          'search'   => $search,
          'location' => $location,
          'sort'     => $sort
        ];

        ?>

        <div style="text-align:center; margin-top:30px;">

          <?php for ($i = 1; $i <= $total_pages; $i++): ?>

            <?php
            $params['page'] = $i;
            ?>

            <a href="?<?php echo http_build_query($params); ?>"
              style="margin:5px; padding:8px 12px; background:#1e3a8a; color:white; border-radius:6px; text-decoration:none;">

              <?php echo $i; ?>

            </a>

          <?php endfor; ?>

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