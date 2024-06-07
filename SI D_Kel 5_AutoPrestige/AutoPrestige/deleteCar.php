<?php
require_once './utilities/helperFunctions.php';
require_once "config.php";

// Periksa apakah pengguna adalah admin
if (!isAdmin()) {
    header("location: index.php");
    exit;
}

// Periksa apakah car_id diatur
if (isset($_GET['car_id'])) {
    $car_id = $_GET['car_id'];

    // Persiapkan pernyataan SQL untuk mengambil sale_id yang terkait dengan car_id
    $get_sales_sql = "SELECT sales_id FROM sales WHERE car_id = ?";
    $stmt_get_sales = $mysqli->prepare($get_sales_sql);
    $stmt_get_sales->bind_param("i", $car_id);
    $stmt_get_sales->execute();
    $result_sales = $stmt_get_sales->get_result();

    // Hapus entri di tabel invoice yang terkait dengan setiap sales_id yang ditemukan
    while ($row_sales = $result_sales->fetch_assoc()) {
        $sales_id = $row_sales['sales_id'];

        $delete_invoice_sql = "DELETE FROM invoice WHERE sale_id = ?";
        $stmt_delete_invoice = $mysqli->prepare($delete_invoice_sql);
        $stmt_delete_invoice->bind_param("i", $sales_id);
        $stmt_delete_invoice->execute();
    }

    // Hapus entri di tabel sales yang terkait dengan car_id
    $delete_sales_sql = "DELETE FROM sales WHERE car_id = ?";
    $stmt_delete_sales = $mysqli->prepare($delete_sales_sql);
    $stmt_delete_sales->bind_param("i", $car_id);

    // Jalankan pernyataan untuk menghapus entri terkait dari tabel sales
    if ($stmt_delete_sales->execute()) {
        // Persiapkan pernyataan SQL untuk menghapus entri dari tabel car_images yang terkait dengan car_id
        $delete_images_sql = "DELETE FROM car_images WHERE car_id = ?";
        $stmt_delete_images = $mysqli->prepare($delete_images_sql);
        $stmt_delete_images->bind_param("i", $car_id);

        // Jalankan pernyataan untuk menghapus entri terkait dari tabel car_images
        if ($stmt_delete_images->execute()) {
            // Setelah menghapus entri terkait dari tabel car_images, lakukan penghapusan dari tabel car
            $delete_car_sql = "DELETE FROM car WHERE car_id = ?";
            $stmt_delete_car = $mysqli->prepare($delete_car_sql);
            $stmt_delete_car->bind_param("i", $car_id);

            if ($stmt_delete_car->execute()) {
                // Redirect ke halaman manage cars dengan pesan sukses setelah mobil berhasil dihapus
                header("location: manageCars.php?msg=CarDeleted");
                exit;
            } else {
                // Jika terjadi kesalahan saat menghapus mobil dari tabel car, redirect ke halaman manage cars dengan pesan error
                header("location: manageCars.php?msg=ErrorDeletingCar");
                exit;
            }
        } else {
            // Jika terjadi kesalahan saat menghapus entri terkait dari tabel car_images, redirect ke halaman manage cars dengan pesan error
            header("location: manageCars.php?msg=ErrorDeletingCarImages");
            exit;
        }
    } else {
        // Jika terjadi kesalahan saat menghapus entri terkait dari tabel sales, redirect ke halaman manage cars dengan pesan error
        header("location: manageCars.php?msg=ErrorDeletingSales");
        exit;
    }
} else {
    // Jika car_id tidak diatur, redirect ke halaman manage cars dengan pesan error
    header("location: manageCars.php?msg=CarIdNotSet");
    exit;
}
?>
