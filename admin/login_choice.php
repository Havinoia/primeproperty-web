<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pilih Login Admin</title>
    <link rel="stylesheet" href="css/admin.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f4f6f9;
        }

        .choice-container {
            display: flex;
            gap: 40px;
        }

        .choice-card {
            background: white;
            padding: 40px;
            width: 300px;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
        }

        .choice-card:hover {
            transform: translateY(-8px);
        }

        .choice-card h2 {
            margin-bottom: 20px;
        }

        .choice-card a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            color: white;
        }

        .btn-property {
            background: #2c3e50;
        }

        .btn-sales {
            background: #1e3a8a;
        }

        .btn-property:hover {
            background: #1a252f;
        }

        .btn-sales:hover {
            background: #162c66;
        }

        @media(max-width: 768px) {
            .choice-container {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

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
    

</body>

</html>