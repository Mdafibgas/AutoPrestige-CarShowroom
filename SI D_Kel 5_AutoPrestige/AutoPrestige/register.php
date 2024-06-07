<?php
require_once './utilities/helperFunctions.php';

require_once "config.php";

$userEmail = $userPassword = $userConfirmPassword = "";
$userEmail_err = $userPassword_err = $userConfirmPassword_err = "";

// Proses - cek apakah formulir telah diposting
if(isRequestMethodPost()){

    // Validasi
    if(empty(trim($_POST["userEmail"]))){
        $userEmail_err = "Please enter a user email.";
    } else{
        // Ambil data pengguna dari database
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("s", $param_userEmail);
            
            $param_userEmail = trim($_POST["userEmail"]);
            
            if($stmt->execute()){
                // Simpan hasil
                $stmt->store_result();
                
                if($stmt->num_rows == 1)
				{
                    $userEmail_err = "This user email already exists";
                } 
				else
				{
                    $userEmail = trim($_POST["userEmail"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            $stmt->close();
        }
    }
    
    // Validasi password
    if(empty(trim($_POST["userPassword"]))){
        $userPassword_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["userPassword"])) < 6){
        $userPassword_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["userPassword"]);
    }
    
    // Validasi konfirmasi password
    if(empty(trim($_POST["userConfirmPassword"]))){
        $userConfirmPassword_err = "Please confirm password.";     
    } else{
        $userConfirmPassword = trim($_POST["userConfirmPassword"]);
        if(empty($userPassword_err) && ($password != $userConfirmPassword)){
            $userConfirmPassword_err = "Password did not match.";
        }
    }
    
    // Periksa kesalahan input
    if(empty($userEmail_err) && empty($userPassword_err) && empty($userConfirmPassword_err)){
        
        // Persiapkan pernyataan insert
        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
         
        if($stmt = $mysqli->prepare($sql)){
            // Bind variabel ke pernyataan yang telah disiapkan sebagai parameter
            $stmt->bind_param("ss", $param_userEmail, $param_password);
            
            // Set parameter
            $param_userEmail = $userEmail;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Buat hash password
            // eksekusi pernyataan yang telah disiapkan
            if($stmt->execute()){
                // Redirect ke halaman login
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
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

				<div class="row d-flex justify-content-center align-items-center h-100">
					<div class="col-lg-12 col-xl-11">
						<div class="card text-black" style="border-radius: 25px;">
							<div class="card-body p-md-5">
								<div class="row justify-content-center">
									<div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

										<p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

										<form class="mx-1 mx-md-4" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
										 method="post">
											<div class="d-flex flex-row align-items-center mb-4">
												<i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
												<div class="form-outline flex-fill mb-0">
													<input type="email" id="userEmail" class="form-control" name="userEmail" />
													<label class="form-label" for="userEmail">Email</label>
												</div>
											</div>

											<div class="d-flex flex-row align-items-center mb-4">
												<i class="fas fa-lock fa-lg me-3 fa-fw"></i>
												<div class="form-outline flex-fill mb-0">
													<input type="password" id="userPassword" class="form-control" name="userPassword" />
													<label class="form-label" for="userPassword">Password</label>
												</div>
											</div>

											<div class="d-flex flex-row align-items-center mb-4">
												<i class="fas fa-key fa-lg me-3 fa-fw"></i>
												<div class="form-outline flex-fill mb-0">
													<input type="password" id="userConfirmPassword" class="form-control" name="userConfirmPassword" />
													<label class="form-label" for="userConfirmPassword">Confirm your password</label>
												</div>
											</div>
											<div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
												<button type="submit" class="btn btn-primary btn-lg btn-dark">Register</button>
											</div>
											<div class="d-flex flex-row align-items-center mb-4">
												<div class="form-outline flex-fill mb-0">
													<i class="fas fa-lock fa-lg me-3 fa-fw"></i>
													<label class="form-label">Already have an account? Login <a href="login.php"> here</a></label>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
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