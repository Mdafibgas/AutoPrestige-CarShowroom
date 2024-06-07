<?php
require_once './utilities/helperFunctions.php';
require_once "config.php";

// Cek apakah pengguna adalah admin, jika tidak, akan diarahkan ke halaman index.php
if(!isAdmin()){
    header("location: index.php");
    exit;
}

// Cek apakah metode yang digunakan adalah GET
if(isRequestMethodGet())
{
    // Perintah SQL untuk mengambil data mobil beserta gambar
    $sql = "SELECT car.car_id, car.price, car.year, car.manufacturer, 
                        car.model, car.colour, car_images.file_name, 
                        car_images.id AS image_id
            FROM `car` 
            LEFT OUTER JOIN car_images ON car_images.car_id = car.car_id ";
    
    $stmt = $mysqli->prepare($sql);

    if($stmt->execute()) // Eksekusi perintah SQL yang disiapkan
    {
        $cars = $stmt->get_result(); // Simpan hasil
    }

}

?>
<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="AutoPrestige - Temukan mobil terbaik untuk Anda!">
    <meta name="author" content="Muhammad Dafi Bagas">
    <title>AutoPrestige</title>
    <link href="css/autoprestige.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
    <link rel="icon" href="Logo AutoPrestige.ico">
    <meta name="theme-color" content="#7952b3">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>

    <style>
        @media (min-width: 768px) {
            .mt-0 {
                margin-top: 20px !important;
            }
        }

        .card {
            background-color: transparent; /* Set background menjadi transparan */
            border: none; /* Hapus border untuk membuatnya lebih terlihat transparan */
            box-shadow: none; /* Hapus shadow agar tidak terlihat */
        }

        .card-body {
            background-color: rgba(255, 255, 255, 0.8); /* Atur latar belakang transparan untuk konten kartu */
            border-radius: 10px; /* Tambahkan sedikit border radius untuk tampilan yang lebih halus */
        }
    </style>
</head>

<body>
    <header class="mt-0">
        <?php
        include './partials/navbar.php';
        ?>
    </header>
    <main>
        <div class="container mt-0">
            <div class="text-center">
                <p>
                    <h1 class="display-6 text-white">Kelola Mobil</h1>
                </p>
                <a class="btn btn-outline-light btn-lg" href="editCar.php" role="button">Tambah Mobil</a>
            </div>
            <?php 

            // Menampilkan pesan sukses atau error jika ada
            if(isset($_GET['msg'])) {
                if($_GET['msg'] == 'CarDeleted') {
                    echo "<div class=\"alert alert-success\" role=\"alert\">Mobil berhasil dihapus!</div>";
                } elseif($_GET['msg'] == 'ErrorDeletingCar') {
                    echo "<div class=\"alert alert-danger\" role=\"alert\">Terjadi kesalahan saat menghapus mobil!</div>";
                }
            }

            // Jika tidak ada mobil atau jumlah mobil dalam dataset adalah 0
            if(empty($cars) || $cars->num_rows == 0)
            {
                echo "<div class=\"row justify-content-center\"> <div class=\"col-4\"> <h1 class=\"display-4\">Tidak ada mobil yang ditemukan!</h1></div></div>"; // Tampilkan pesan bahwa tidak ada mobil yang ditemukan
            }
            else if ($cars->num_rows > 0)  // Jika jumlah mobil dalam dataset lebih dari 0
            {
                $i=0; // Inisialisasi counter
                
                foreach($cars as $car ) // Iterasi melalui dataset yang diperoleh dari database
                {
                    if($i == 0) // Inisialisasi counter
                        echo '<div class="row">';

                                // Menambahkan detail mobil
                                echo "<div class=\"col-sm-4\">
                                        <div class=\"card\">";
                                    
                                    $image_file_name = "image_not_found.png";

                                    if($car['file_name'])
                                        $image_file_name = $car['file_name'];

                                    echo "<img src=\"./images/" . $image_file_name . "\" class=\"card-img-top\" alt=\"...\" width=\"125\" height=\"250\">";// Tampilkan gambar mobil

                                    echo  "<div class=\"card-body\">
                                            <h5 class=\"card-title\">" . $car['year'] . " " . $car['manufacturer'] . " " . $car['model'] . " " .  $car['colour'] . "</h5>
                                            <p><strong>$" . $car['price'] . "</strong></p>
                                            <a href=\"editCar.php?car_id=" . $car['car_id']. "\" class=\"btn btn-primary btn-dark\">Edit Detail</a>
                                            <a href=\"managePhotos.php?car_id=" . $car['car_id']. "\" class=\"btn btn-primary justify-content-end btn-dark\">Edit Foto</a>
                                            <a href=\"deleteCar.php?car_id=" . $car['car_id']. "\" class=\"btn btn-danger justify-content-end btn-dark\">Hapus Mobil</a>
                                         </div>
                                    </div>
                                </div>";

                    if($i == 2)
                        echo '</div>';
                    
                    $i++; 
                    
                    if($i > 2) // Reset counter
                        $i=0;

                }

                // Tutup baris jika belum ditutup
                if($cars->num_rows % 3 <> 0){
                    echo '</div>';
                }
            }
             ?>
        </div>
        <!-- /.container -->
        <!-- FOOTER -->
        <footer class="container mt-0">
            <p class="float-end"><a href="#">Situs dirancang oleh SI D_Kel 5</a></p>
            <p>&copy; 2022 AutoPrest
