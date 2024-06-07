<?php
//koneksi database
require_once "config.php";

// Jika metode permintaan adalah POST
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $message = $_POST['Message'];

    $mailTo = "dafibagas583@gmail.com"; // Alamat email tujuan

    $headers = "From: " . $mailTo; // Header email (pengirim)
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
	<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/carousel/">
	<!-- Bootstrap core CSS -->
	<link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
	 crossorigin="anonymous">
	<link rel="icon" href="Logo AutoPrestige.ico">
	<meta name="theme-color" content="#7952b3">
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	
</head>

<body>
	<header class="mt-0">
		<?php
		include './partials/navbar.php';
		?>
	</header>
	<main>

		<div class="container mt-3">
			<section id="contact">
				<div class="container">
					 <!-- Bagian header kontak -->
					<div class="well well-sm text-white">
						<h3><strong>Contact Us</strong></h3>
					</div>

					<div class="row">
						 <!-- Bagian peta Google Maps -->
						<div class="col-md-7">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1067.
								6984379142052!2d112.72547990620869!3d-7.313653639913182!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!
								1m2!1s0x2dd7fb7a12000981%3A0x29bec54b13972b2!2sDanau%20UNESA%20Ketintang!5e0!3m2!1sid!2sid!4v1709713416160!5m2!1sid!2sid" 
							 width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
						</div>
						
						<div class="col-md-5 text-white">
							<h4><strong>Get in Touch</strong></h4>
							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
								<div class=" form-group ">
									<label>Name</label>
									<input type="text " class="form-control " name=" Name" value=" " placeholder="Name ">
								</div>
								<div class="form-group ">
									<label>Email</label>
									<input type="email " class="form-control " name="Email" value=" " placeholder="Email ">
								</div>
								<div class="form-group ">
									<label>Phone</label>
									<input type="tel " class="form-control " name="Phone" value=" " placeholder="Phone ">
								</div>

								<div class="form-group ">
									<label>Message</label>
									<textarea class="form-control " name="Message" rows="3 " placeholder="Message "></textarea>
								</div>
								
								<button class="btn btn-dark " type="submit " name="Submit">
                                            <i class="fa fa-paper-plane-o " aria-hidden="true "></i> Submit</button>
							</form>
						</div>
					</div>
				</div>
			</section>

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
</body>

</html>