<?php

require_once './utilities/helperFunctions.php';

require_once "config.php";

$cars = ""; // Inisialisasi variabel $cars untuk menyimpan data mobil

// Proses jika metode HTTP adalah POST
if(isRequestMethodPost())
{
	// SQL untuk mengambil data mobil dari database
	$sql = "SELECT car.price, car.year, car.manufacturer, car.model, car.colour, car_images.file_name 
			FROM `car_images` 
			INNER JOIN car ON car.car_id = car_images.car_id";

	$stmt = $mysqli->prepare($sql);

	if($stmt->execute())
	{
		// Simpan hasil dari pernyataan SQL ke variabel $cars
        $cars = $stmt->get_result();
	}
}

// Proses jika metode HTTP adalah GET
if(isRequestMethodGet())
{
    $car_array = ""; // Variabel untuk menyimpan data dari query string
    parse_str($_SERVER["QUERY_STRING"], $car_array); 

    // Persiapkan pernyataan SQL untuk mengambil data mobil dari database
	$sql = "SELECT car.price, car.year, car.manufacturer, car.model, car.colour, car_images.file_name 
			FROM `car_images` 
			INNER JOIN car ON car.car_id = car_images.car_id";

    // Cek apakah query string tidak kosong
    if(!empty($car_array))
    {
        // Cek apakah parameter 'car' ada dalam query string
        if(isset($car_array['car']))
            $sql .= " WHERE car.manufacturer LIKE '%" . htmlentities($car_array['car']) . "%'";

        // Cek apakah parameter 'searchString' ada dalam query string
        if(isset($car_array['searchString']))
        {
            $searchString = htmlentities($car_array['searchString']);
            $sql .= " WHERE car.manufacturer LIKE '%" . $searchString . "%' 
                        OR car.year LIKE '%" . $searchString . "%' 
                        OR car.model LIKE '%" . $searchString . "%' 
                        OR car.colour LIKE '%" . $searchString . "%' 
                        OR car.price LIKE '%" . $searchString . "%'";
        }     
    }

	$stmt = $mysqli->prepare($sql);

	if($stmt->execute())
	{
		// Simpan hasil dari pernyataan SQL ke variabel $cars
        $cars = $stmt->get_result();
	}
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
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
	 crossorigin="anonymous"></script>
	<link rel="icon" href="Logo AutoPrestige.ico">
	<meta name="theme-color" content="#7952b3">

	<style>
		@media (min-width: 768px) {
			.mt-0 {
				margin-top: 20px !important;
			}
		}

		.wishListDiv span {
			display: none;
			position: absolute;
			bottom: 0;
			left: 0;
			right: 0;
		}

		.wishListDiv:hover span {
			display: block;
			position: relative;
			right: 5px;
			font-size: 12px;
		}

		.card {
        background-color: transparent; 
        border: none; 
        box-shadow: none; 
    }

    .card-body {
        background-color: rgba(255, 255, 255, 0.8); 
        border-radius: 10px; 
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
			<?php
			if($cars->num_rows == 0)
			{
				// Tampilkan pesan jika tidak ada mobil yang ditemukan
				echo "<div class=\"row justify-content-center\"> <div class=\"col-4\"> <h1 class=\"display-4\">No cars found!</h1></div></div>";
			}

			else if ($cars->num_rows > 0){
				$i=0;

				// Iterasi dataset yang diperoleh dari database
				foreach($cars as $car )
				{
					if($i == 0) 
						echo '<div class="row">';

					// Tambahkan detail mobil
					echo "<div class=\"col-sm-4\">
							<div class=\"card\">
								<div class=\"wishListDiv\">
									<a href=\"#\" class=\"wishListAnchor\">
										<img src=\"./images/addedToWishlist.png\" class=\"float-end\" alt=\"add to wishlist\" width=\"25px\" height=\"25px\">
										<span class=\"float-end\">Add To Wishlist</span>
									</a>
								</div>
					   	 		<img src=\"./images/" . $car['file_name'] . "\" class=\"card-img-top\" alt=\"...\" width=\"125\" height=\"250\">
					 	 		<div class=\"card-body\">
						 			<h5 class=\"card-title\">" . $car['year'] . " " . $car['manufacturer'] . " " . $car['model'] . " " .  $car['colour'] . "</h5>
						 			<p><strong>$" . $car['price'] . "</strong></p>
						 			<a href=\"#\" class=\"btn btn-primary btn-dark\">More Info</a>
								</div>
							</div>
						 </div>";

					if($i == 2)
						echo '</div>';

					$i++;

					if($i > 2)
						$i=0;

				}

				if($cars->num_rows % 3 <> 0){
					echo '</div>';
				}
			}
		 ?>
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
	<script type="text/javascript" src="./js/autoprestige.js"></script>
</body>

</html>