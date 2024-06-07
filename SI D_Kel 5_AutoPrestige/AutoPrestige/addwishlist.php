<?php
require_once './utilities/helperFunctions.php'; // Memuat file fungsi bantu
include "config.php"; // Memuat file konfigurasi database

// Periksa apakah pengguna telah login
if (!isLoggedIn()) {
    header("Location: login.php"); // Redirect ke halaman login jika belum login
} else {
    // Ambil ID mobil dari URL
    $car_id = $_GET["car_id"];
    $action = $_GET['action'];
    $user_id = $_SESSION['user_id']; // Ambil ID pengguna dari sesi
    $return_url = isset($_GET['returnUrl']) ? $_GET['returnUrl'] : NULL;

    $sql = "";
    if ($action == 'add') {
        $sql = "INSERT INTO wishlist (car_id, user_id) VALUES (?,?)"; // SQL untuk menambahkan mobil ke wishlist
    } else {
        $sql = "DELETE FROM wishlist WHERE car_id = ? and user_id = ?"; // SQL untuk menghapus mobil dari wishlist
    }

    $stmt = $mysqli->prepare($sql); // Persiapkan statement SQL
    $stmt->bind_param("ss", $car_id, $user_id); // Bind parameter ke statement SQL

    $stmt->execute(); // Jalankan statement SQL

    if ($return_url && $return_url == "wishlist") {
        header("Location: wishlist.php"); // Redirect ke halaman wishlist jika returnUrl diset
        exit;
    }

    header("Location: index.php"); // Redirect ke halaman utama
    exit;
} // Akhir dari blok if
