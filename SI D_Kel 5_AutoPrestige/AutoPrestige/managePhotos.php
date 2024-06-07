<?php
// Memuat fungsi bantu dari file helperFunctions.php
require_once './utilities/helperFunctions.php';

// Memuat koneksi database dari file config.php
require_once "config.php";

// Inisialisasi variabel $cars
$cars = "";

// Cek apakah pengguna adalah admin; jika tidak, arahkan ke halaman index.php
if (!isAdmin()) {
	header("location: index.php");
	exit;
}

// metode yang digunakan adalah GET dan ada parameter car_id di URL
if (isRequestMethodGet() && isset($_GET['car_id'])) {
    $car_id = $_GET['car_id'];

	// Persiapkan pernyataan SQL untuk mengambil data mobil berdasarkan car_id
	$sql = "SELECT car.car_id, car.price,car.year, car.manufacturer, 
						car.model, car.colour, car_images.file_name, 
						car_images.id AS image_id
				FROM `car` 
				LEFT OUTER JOIN car_images ON car_images.car_id = car.car_id 
                WHERE car.car_id =" . $car_id;
	
	// Persiapkan pernyataan SQL untuk dieksekusi
	$stmt = $mysqli->prepare($sql);

	// Jika pernyataan SQL dieksekusi dengan sukses
	if ($stmt->execute()) {
        $cars = $stmt->get_result(); // Simpan hasil eksekusi pernyataan SQL ke dalam variabel $cars
	}
} 
// Jika metode yang digunakan adalah POST
else if (isRequestMethodPost()) {
    $updateMode = getPostRequestValue('updateMode'); // Ambil nilai updateMode dari POST
    $car_id = getPostRequestValue('carId'); // Ambil nilai carId dari POST

    if ($updateMode == 'addImage') { // Jika mode update adalah 'addImage'
        if(isset($_FILES['carPhotosUpload'])) // Jika ada file yang diunggah
        {   
            $uploadFileCount = count($_FILES['carPhotosUpload']['name']); // Hitung jumlah file yang diunggah
            $query = "INSERT INTO car_images (car_id,file_name) VALUES "; // Persiapkan query untuk menambahkan data gambar mobil
            $valuesSql = ""; // Inisialisasi nilai untuk menyimpan nilai-nilai SQL

            // Iterasi melalui setiap file yang diunggah
            for($x = 0; $x < $uploadFileCount; $x++ )
            {
                $fileToBeUploaded = $_FILES['carPhotosUpload']['name'][$x]; // Ambil nama file yang diunggah
                if(preg_match('/[.](jpg)|(jpeg)|(png)|(gif)$/', $fileToBeUploaded)) // Validasi tipe file
                {
                    $fileToBeUploadedTmp = $_FILES['carPhotosUpload']['tmp_name'][$x]; // Ambil nama sementara file yang diunggah
                    $targetFile = "image_" . $x . "_" . time() . "." . pathinfo($fileToBeUploaded)['extension']; // Buat nama file target baru
                    $fileCopied = move_uploaded_file($fileToBeUploadedTmp, IMAGE_UPLOAD_PATH . $targetFile); // Pindahkan file ke lokasi upload

                    if($fileCopied)
                       $valuesSql .=  "(" . $car_id . ",\"" . $targetFile . "\"),"; // Tambahkan nilai untuk dimasukkan ke dalam database  
                }
            }

            $valuesSql = substr($valuesSql, 0, strlen($valuesSql) - 1); // Hapus koma terakhir dari nilai SQL

            if($valuesSql <> "")
            {
                $stmt = $mysqli->prepare($query . $valuesSql); // Persiapkan pernyataan SQL untuk dieksekusi
                $stmt->execute(); // Eksekusi pernyataan SQL
            }
        }
        else
        {
            die(); //validasi yang lebih baik dan penanganan kesalahan
        }
    } 
    else if ($updateMode == 'deleteImage') { // Jika mode update adalah 'deleteImage'
        $image_id = getPostRequestValue('imageId'); // Ambil nilai imageId dari POST
        $image_file_name = getPostRequestValue('imageFileName'); // Ambil nama file gambar dari POST

        // Persiapkan pernyataan SQL untuk menghapus data gambar dari database
        $sql = "DELETE FROM car_images where id = " . $image_id;

        // Persiapkan pernyataan SQL untuk dieksekusi
        $stmt = $mysqli->prepare($sql);
        $stmt->execute(); // Eksekusi pernyataan SQL

        // Hapus file gambar dari server
        $file_unlink_result = unlink(IMAGE_UPLOAD_PATH . $image_file_name);
    } 
    else // Jika mode update tidak dikenali
    {
        die();
    }

    header("location: managePhotos.php?car_id=" . $car_id); // Redirect kembali ke halaman managePhotos.php setelah proses selesai
    exit;
} 
else // Jika tidak ada car_id di URL atau tidak ada metode POST
{
	header("location: manageCars.php"); // Redirect ke halaman manageCars.php
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
			<div class="row justify-content-center">
				<div class="col-auto display-6">
					<?php 
                        $car = $cars->fetch_assoc(); // Mengambil data mobil dari hasil query sebelumnya
                        echo "<a href=\"carDetails.php?car_id=" . $car['car_id'] . "\">" . $car['year'] . " " . $car['manufacturer'] . " " . $car['model'] . " " . $car['colour'] . "</a>"; ?> 
				</div>
			</div>
			<div class="row justify-content-center">
				<h3 class="display-6 text-center"> Add Photos</h3>
				<div class="col-auto">
					<form enctype="multipart/form-data" action="<?php print $_SERVER['PHP_SELF']?>"
					 method="POST" class="row g-3">
						<div class="col-auto">
							<?php echo "<input type=\"hidden\" name=\"updateMode\" value=\"addImage\"> 
                                       <input type=\"hidden\" name=\"carId\" value=\"" . $car[ 'car_id'] . "\">" ; ?>
							<input type="file" class="form-control" id="inputCarPhotos" name="carPhotosUpload[]" multiple> <!-- Input untuk mengunggah foto mobil -->
						</div>
						<div class="col-auto">
							<button type="submit" class="btn btn-primary mb-3">Upload</button>
						</div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 text-center">
					<p>
						<h1 class="display-6">Delete Photos</h1>
					</p>
				</div>
				<div class="row">

					<?php
								if(($cars) && $cars->num_rows > 0 )
								{
                                    $i=1;
                                    foreach($cars as $car ) 
                                    {
                                        
                                        if($car['file_name'])
                                        {
											// Tampilkan gambar mobil
                                            echo "<div class=\"col-sm-2 text-end\">" .$i ."</div><div class=\"col-sm-8 text-center\">";
                                            echo "<img src=\"./images/" . $car['file_name']. "\" class=\"\" alt=\"...\" width=\"400\" height=\"300\">";

                                            echo "</div><div class=\"col-sm-2 text-start\">";
                                            echo "<form action=\"" . $_SERVER['PHP_SELF']. "\" method=\"POST\">";
                                             echo "    <input type=\"hidden\" name=\"updateMode\" value=\"deleteImage\">
                                                       <input type=\"hidden\" name=\"carId\" value=\"" . $car[ 'car_id'] . "\">
                                                       <input type=\"hidden\" name=\"imageId\" value=\"" . $car['image_id'] . "\">
                                                       <input type=\"hidden\" name=\"imageFileName\" value=\"" . $car['file_name'] . "\">
                                                       <button type=\"submit\" class=\"btn btn-primary justify-content-center\">Delete</button
                                                  </form></div>";
                                        }
                                        else{
                                            echo "<div class=\"row justify-content-center\"> <div class=\"col-4\"> <h1 class=\"display-4\">No images found!</h1></div></div>";
                                        }
                                        $i++;
                                            
                                    }
									
								}
							?>
				</div>
			</div>


		</div>
		<!-- /.container -->
		<!-- FOOTER -->
		<footer class="container mt-0">
			<p class="float-end"><a href="#">Site designed by SI D_Kel 5</a></p>
			<p>&copy; 2022 AutoPrestige Inc. </p>
		</footer>
	</main>
	<script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
	 crossorigin="anonymous"></script>
	<script type="text/javascript" src="./js/carland.js"></script>
</body>

</html>