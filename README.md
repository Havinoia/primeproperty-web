# PrimeProperty 🏠

PrimeProperty adalah aplikasi web Property Management sederhana yang dibangun menggunakan Native PHP dan MySQL.  
Project ini dibuat sebagai portfolio untuk menunjukkan pemahaman dasar pengembangan web backend seperti sistem CRUD, autentikasi, manajemen session, serta deployment ke live hosting.

---

## 🔗 Live Demo

https://primeproperty.infinityfreeapp.com/

---

## ✨ Fitur Utama

- Sistem Login Admin
- CRUD Properti (Create, Read, Update, Delete)
- Halaman Detail Properti
- Fitur filter propery & pencarian
- Pagination / nomor halaman
- Status Properti (Available / Sold)
- Tampilan status berwarna (Hijau untuk Available, Merah untuk Sold)
- Tombol dinamis berdasarkan status
- Session-based Authentication
- Validasi dasar form
- Deployment ke hosting live

---

## 🛠 Teknologi yang Digunakan

- PHP Native
- MySQL
- HTML5
- CSS3
- XAMPP (Local Development)
- InfinityFree (Web Hosting)

---

## ⚙ Cara Menjalankan di Localhost

1. Clone repository ini:git clone https://github.com/YOUR_USERNAME/primeproperty-php.git

2. Pindahkan folder project ke dalam folder `htdocs` (jika menggunakan XAMPP).

3. Buat database baru di phpMyAdmin dengan nama:primeproperty

4. Import file `database.sql` ke dalam database tersebut.

5. Masuk ke folder `config` lalu rename file:koneksi.example.php menjadi koneksi.php

6. Sesuaikan konfigurasi database jika diperlukan.

7. Jalankan di browser:http://localhost/primeproperty

---

## 🔐 Keamanan

File `config/koneksi.php` tidak diupload ke repository karena berisi konfigurasi database.  
File `koneksi.example.php` disediakan sebagai template konfigurasi untuk menjalankan project secara lokal.

---

## 🚀 Deployment

Project ini telah berhasil di-deploy menggunakan layanan hosting InfinityFree dan dapat diakses melalui:

https://primeproperty.infinityfreeapp.com/

---

## 📈 Pengembangan Selanjutnya

Beberapa peningkatan yang dapat dilakukan:

- Menggunakan Prepared Statement untuk keamanan query
- Meningkatkan desain UI/UX
- Menambahkan validasi upload gambar
- Mengimplementasikan sistem role (Admin & User)

---

## 👨‍💻 Developer

Dikembangkan sebagai portfolio project untuk menunjukkan kemampuan dasar pengembangan web menggunakan PHP Native dan MySQL.

GitHub:
https://github.com/Havinoia
