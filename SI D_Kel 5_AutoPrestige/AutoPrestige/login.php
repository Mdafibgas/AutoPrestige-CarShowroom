<?php
require_once './utilities/helperFunctions.php';

// Jika pengguna sudah login, arahkan ke halaman utama
if(isLoggedIn()){
    header("location: index.php");
    exit;
}

//koneksi
require_once "config.php";

// Mendeklarasikan variabel error
	$userEmail_error = $userPassword_error = $login_error =  "";

if(isRequestMethodPost()){

	// Mendeklarasikan variabel untuk email dan password pengguna
	$userEmail = $userPassword = "";

	//validasi email oengguna
	if(empty(trim($_POST["userEmail"]))){
        $userEmail_error = "Please enter username.";
    } else{
        $userEmail = trim($_POST["userEmail"]);
    }

	//validasi pass
	if(empty(trim($_POST["userPassword"]))){
        $userPassword_error = "Please enter your password.";
    } else{
        $userPassword = trim($_POST["userPassword"]);
    }

	//validasi email dan pass
	if(empty($userEmail_error) && empty($userPassword_error ))
	{
		$sql = "SELECT id, email, password FROM users WHERE email = ?";
		if($stmt = $mysqli-> prepare($sql))
		{
			// Query SQL untuk mendapatkan data pengguna berdasarkan email
			$stmt -> bind_param("s",$param_userEmail);
			$param_userEmail = $userEmail;

			if($stmt->execute())
			{
				$stmt->store_result();

				if($stmt -> num_rows == 1){
					$stmt -> bind_result($id,$userEmail, $userPassword_hash);
					if($stmt->fetch())
					{
						if(password_verify($userPassword, $userPassword_hash)){

							$isAdmin = false;
							if($userEmail == 'dafibagas2307@gmail.com')
								$isAdmin = true;

							//set session variables
							setupUserSession($id, $userEmail, $isAdmin);

							header("location: index.php");
							exit;
						}
						else{
							$login_error = "Wrong user name or password!";
						}
					}
				}
				else{
					$login_error = "Wrong user name or password";
				}
			}
			else{
				echo "There was an unrecognized and unhandled error!";
			}
			$stmt->close();
		}
	}
	$mysqli->close();
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
	<style>
		@media (min-width: 768px) {
			.mt-0 {
				margin-top: 20px !important;
			}
		}

		.error {
			color: red;
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
				<form class="col-sm-4 shadow p-3 mb-5 bg-body rounded" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
				 method="POST">
					<div class="col text-center">
						<div class="mb-3">Log into your account</div>
					</div>
					<div class="mb-3">
						<label for="userEmail" class="form-label">Email address</label>
						<input type="email" class="form-control" id="userEmail" name="userEmail" aria-describedby="emailHelp">
						<span class="error">
						<?php echo $userEmail_error; ?>
						</span>
					</div>
					<div class="mb-3">
						<label for="userPassword" class="form-label">Password</label>
						<input type="password" class="form-control" id="userPassword" name="userPassword">
						<span class="error">
						<?php echo $userPassword_error; ?>
						</span>
					</div>
					<div class="col text-center">
						<button type="submit" class="btn btn-primary justify-content-center btn-dark">Submit</button>
					</div>
					<span class="error">
					<?php echo $login_error; ?>
					</span>
				</form>
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