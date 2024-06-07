<?php

//load database connections
require_once "config.php";
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
	<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/carousel/">
	<!-- Bootstrap core CSS -->
	<link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
	 crossorigin="anonymous">
	<link rel="icon" href="Logo AutoPrestige.ico">
	<meta name="theme-color" content="#7952b3">
	
</head>

<body>
	<header class="mt-0">
		<?php
		include './partials/navbar.php';
		?>
	</header>
	<main>

		<div class="container mt-3 text-white">
			<h2></h2>
			<div>
				<h1>About AutoPrestige </h1>
				<p>AutoPrestige - The most valueble dealership in town.</p>
				<p>Welcome to AutoPrestige - where excellence meets reliability. We are your premier destination for finding your dream car with the best quality and unmatched service.
				At AutoPrestige, we are committed to delivering an exceptional customer experience. With knowledgeable and experienced staff, we are ready to assist you in every step of your journey to find the perfect car.
				We understand that every customer has their own unique needs. That's why we offer a wide range of high-quality car options, from classic models to the most cutting-edge, tailored to your preferences and budget.
					<p>We take pride in our reputation for providing honest, transparent, and quality service. With AutoPrestige, you can have confidence that every car purchase is a smart and satisfying investment.
					Feel free to contact us for more information or to schedule a test drive. We look forward to helping you find your dream car at AutoPrestige.</p>
				</p>
				<p>Opening Hours
					<p> Monday-Friday : 8am to 5pm
						<p>
							<p>Saturday: 9am to 5pm</p>
							<p> Sunday: 10am to 4pm</p>
						</p>
						<img src="./images/TestDrive.jpeg">
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
</body>

</html>