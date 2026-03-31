<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Login Admin</title>
    <link rel="stylesheet" href="css/admin.css">
    <script>
      const savedTheme = localStorage.getItem('theme') || 'light';
      document.documentElement.setAttribute('data-theme', savedTheme);
    </script>
    <style>
        .choice-container {
            display: flex;
            gap: 24px;
            justify-content: center;
            flex-wrap: wrap;
            padding: 40px 0;
        }

        .choice-card {
            background: var(--bg-surface);
            padding: 30px;
            width: 280px;
            text-align: center;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .choice-card:hover {
            transform: translateY(-8px);
            border-color: var(--primary);
        }

        .choice-card h2 {
            font-size: 1.25rem;
            margin-bottom: 12px;
        }

        .choice-card p {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .btn-property, .btn-sales {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            text-decoration: none;
            color: white;
            display: inline-block;
            font-weight: 600;
        }

        .btn-property { background: var(--primary); }
        .btn-sales { background: #1e3a8a; }
    </style>
</head>

<body>

<header style="background: var(--bg-navbar); border-bottom: 1px solid var(--border-color); padding: 12px 0;">
    <div class="container" style="margin: 0 auto; display: flex; justify-content: space-between; align-items: center;">
        <h1 style="font-size: 1.25rem;">Admin Panel</h1>
        <button id="theme-toggle" class="btn btn-sm btn-primary">☀️</button>
    </div>
</header>

<div class="container">
    <div class="choice-container">

        <!-- LOGIN PROPERTY -->
        <div class="choice-card">
            <h2>Dashboard Property</h2>
            <p>Kelola data properti</p>
            <a href="property/login.php" class="btn-property">
                Masuk
            </a>
        </div>

        <!-- LOGIN SALES -->
        <div class="choice-card">
            <h2>Dashboard Sales</h2>
            <p>Kelola data sales agents</p>
            <a href="sales_agents/login.php" class="btn-sales">
                Masuk
            </a>
        </div>

        <!-- LOGIN CUSTOMERS -->
        <div class="choice-card">
            <h2>Manage Customers</h2>
            <p>Lihat & kelola data customer</p>
            <a href="customers/login.php" class="btn-property">
                Masuk
            </a>
        </div>

        <!-- HOME -->
        <div class="choice-card">
            <h2>Home</h2>
            <p>Kembali ke halaman utama</p>
            <a href="../index.php" class="btn-property">
                Kembali
            </a>
        </div>

    </div>
</div>

<script src="js/admin_script.js"></script>
</body>

</html>