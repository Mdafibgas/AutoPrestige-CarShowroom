<?php
// Memuat fungsi bantu
require_once './utilities/helperFunctions.php';

// Memuat koneksi ke database
require_once "config.php";
$car ="";

// Memeriksa jika metode permintaan adalah GET dan car_id telah diset di URL
if(isRequestMethodGet() && isset($_GET['car_id'])){
    $car_id = $_GET['car_id'];

    // Memeriksa apakah pengguna sudah login
    if(isLoggedIn()) {
        // Query SQL untuk memilih detail mobil termasuk informasi wishlist jika pengguna sudah login
        $sql = "SELECT car.car_id, car.price, car.year, car.manufacturer, 
                       car.model, car.colour, car.mileage, car.fuel_type, car.transmission_type, car.description,
                       car_images.file_name, 
                       car_images.id AS image_id, wishlist.id AS wishlist_id, wishlist.user_id 
                FROM `car` 
                LEFT OUTER JOIN car_images ON car_images.car_id = car.car_id
                LEFT OUTER JOIN (SELECT wishlist.id, wishlist.car_id, wishlist.user_id 
                                 FROM wishlist 
                                 WHERE wishlist.user_id = " . getUserId() . ") AS wishlist ON wishlist.car_id = car.car_id
                WHERE car.car_id = $car_id
                ORDER BY car.car_id";
    } else {
        // Query SQL untuk memilih detail mobil jika pengguna belum login
        $sql = "SELECT car.car_id, car.price, car.year, car.manufacturer, 
                       car.model, car.colour, car.mileage, car.fuel_type, car.transmission_type, car.description,
                       car_images.file_name, 
                       car_images.id AS image_id
                FROM `car` 
                LEFT OUTER JOIN car_images ON car_images.car_id = car.car_id 
                WHERE car.car_id = $car_id";
    }

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute()) { // Jalankan SQL yang telah dipersiapkan
        $cars = $stmt->get_result(); // Simpan hasil query
        $carDetails = $cars->fetch_assoc(); // Ambil detail mobil
    }
} else {
    header("location: index.php"); // Redirect ke halaman utama jika car_id tidak diset
    exit;
}
?>

<!doctype html>

<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="AutoPrestige - Find the best car for you!">
	<meta name="author" content="Muhammad Dafi Bagas">
	<title>AutoPrestige</title>
	<link href="css/autoprestige.css" rel="stylesheet">
	<!-- Bootstrap core CSS -->
	<link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
	 crossorigin="anonymous">

	<link rel="icon" href="favicon.ico">
	<meta name="theme-color" content="#7952b3">


	<!--Carousel css and js-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">


	
</head>

<body>
	<header class="mt-0">
		<?php
		include './partials/navbar.php';
		?>
	</header>
	<main>
		<div class="container mt-0 text-white">
			<div class="row">
				<!--menampilkan tahun, produsen, model, dan warna mobil -->
				<div class="col-sm-8 col-md-8 col-lg-8 display-6">
					<?php echo $carDetails['year'] . " " . $carDetails['manufacturer'] . " " . $carDetails['model'] . " " . $carDetails['colour']; ?>
				</div>
				<!-- Kolom untuk menampilkan harga mobil -->
				<div class="col-sm-4 col-md-4 col-lg-4 align-self-end display-6">
					<?php echo "$" .$carDetails['price']; ?>
				</div>
			</div>
			<div class="row border-top pt-4">
				<div class="col-sm-8">
					<div class="row">
						<div class="col-sm-12">
							<!--  menampilkan gambar mobil (slide) -->
							<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
								<!--indikator gambar slide -->
								<ol class="carousel-indicators ">
									<?php 
										$i=0;
										$active = " active";
										foreach($cars as $car)
										{
											if($i <> 0)
												$active ="";
											echo "<li data-bs-target=\"#myCarousel\" data-bs-slide-to=\"" . $i . "\" class=\"" . $active . "\"></li>";
											$i++;
										}
									?>
								</ol>

								<!-- Wrapper for carousel items -->
								<div class="carousel-inner ">
									<?php 
										$i = 0;
										$active = " active";
										foreach($cars as $car)
										{
											if($i <> 0)
												$active ="";
											  
											echo "<div class=\"carousel-item" . $active ."\">
													<img src=\"" . IMAGE_UPLOAD_PATH . $car['file_name'] . "\" class=\"d-block w-100\" alt=\"Slide " . $i ."\">
													</div>";

											$i++;
										}
									
									?>
								</div>

								<!-- kontrol untuk slide gambar -->
								<a class="carousel-control-prev" href="#myCarousel" data-bs-slide="prev">
                            	<span class="carousel-control-prev-icon"></span>
                        		</a>
								<a class="carousel-control-next" href="#myCarousel" data-bs-slide="next">
                            	<span class="carousel-control-next-icon"></span>
                        		</a>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<?php 
								echo $carDetails['description'];
							?>

							<p>Terawat secara profesional. Jarak tempuh telah diverifikasi oleh Odometer Inspection Services. </p>
							<p>Kendaraan telah menjalani pemeriksaan dan mendapatkan satu tahun pemeriksaan. Jaminan mekanikal selama 1, 2, dan 3 tahun tersedia dengan biaya tambahan.</p>

							<p>Pilihan pembiayaan tersedia tanpa deposit. </p>
							<p>TUKAR-TAMBAH Selalu Diterima. </p>
							<p>Pemeriksaan kendaraan independen selalu dipersilakan.</p>
							<p> EKSTRA - Tersedia dengan biaya tambahan:
								<ul>
									<li>Tow bar</li>
									<li>Kaca film </li>
									<li>Stereo </li>
									<li>Sensor parkir</li>
									<li> Bluetooth</li>
							</p>
						</div>
					</div>
				</div>
				<div class="col-sm-4 border-white">
					<div class="row border-top ">
						<div class="col-sm-6 border-end">Engine</div>
						<div class="col-sm-6 ">4960cc, Hybrid</div>
					</div>
					<div class="row border-top">
						<div class="col-sm-6 border-end">Body</div>
						<div class="col-sm-6 ">5 Door, Sedan</div>
					</div>
					<div class="row border-top">
						<div class="col-sm-6 border-end">Odometer</div>
						<div class="col-sm-6 ">
							<?php echo $car['mileage']?>km
						</div>
					</div>
					<div class="row border-top">
						<div class="col-sm-6 border-end">Ext Colour</div>
						<div class="col-sm-6 ">
							<?php echo $car['colour']?>
						</div>

					</div>
					<div class="row border-top">
						<div class="col-sm-6 border-end">Interior</div>
						<div class="col-sm-6 ">Black, 5 Seats (Fabric)</div>
					</div>
					<div class="row border-top">
						<div class="col-sm-6 border-end">Transmission</div>
						<div class="col-sm-6 ">
							<?php echo $car['transmission_type']?>
						</div>
					</div>
					<div class="row border-top"></div>
				</div>
			</div>
		</div>
		<!-- /.container -->
		<!-- FOOTER -->
		<footer class="container mt-0 ">
			<p class="float-end"><a href="#">Site designed by SI D_Kel 5</a></p>
			<p>&copy; 2022 AutoPrestige Inc. </p>
		</footer>
	</main>
	<script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js " integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM "
	 crossorigin="anonymous "></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
	 crossorigin="anonymous"></script>
	<script type="text/javascript " src="./js/carland.js "></script>
</body>

</html>