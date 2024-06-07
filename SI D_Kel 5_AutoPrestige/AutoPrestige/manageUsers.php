<?php

require_once "./config.php";

require_once "./utilities/helperFunctions.php";

$users = ""; 

// Cek apakah admin
if (!isAdmin()) {
    header("location: index.php");
    exit;
}

// Cek apakah parameter user_id dan enable tersedia dalam URL
if (isset($_GET['user_id']) && isset($_GET['enable'])) {
    $user_id = $_GET["user_id"];
    $enable = $_GET['enable'];

    // Cek apakah admin
    if (!($user_id == getUserId() && isAdmin())) {
        // Persiapkan pernyataan SQL
        $sql = "UPDATE users set enabled = ? where id = ?";

        // Persiapkan pernyataan SQL untuk dieksekusi
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $enable, $user_id);

        // Eksekusi pernyataan SQL yang telah dipersiapkan
        if ($stmt->execute()) {
            $users = $stmt->get_result(); 
        }
    }

    // Redirect ke halaman manageUsers.php setelah proses selesai
    header("location: manageUsers.php");
    exit;
}

//untuk mengambil data pengguna dari tabel users dan urutkan berdasarkan ID
$sql = "SELECT users.id, users.email, users.enabled FROM users ORDER BY users.id";

$stmt = $mysqli->prepare($sql);

// Eksekusi pernyataan SQL yang telah dipersiapkan
if ($stmt->execute()) {
    $users = $stmt->get_result(); 
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

		.table {
			margin: auto;
			width: 50% !important;
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
		<div class="container mt-0 text-white">
			<div class="text-center">
				<p>
					<h1 class="display-6">Manage Users</h1>
				</p>
			</div>
			<div class="row">
				<div class="table-responsive">
					<table class="table table-hover text-white">
						<thead>
						<tr>
                            <th scope="col">#</th> <!-- Kolom untuk nomor urutan -->
                            <th scope="col">User</th> <!-- Kolom untuk nama pengguna -->
                            <th scope="col">Status</th> <!-- Kolom untuk status (Enable/Disable) -->
                        </tr>
						</thead>
						<tbody>
							<?php
								if(empty($users) || $users->num_rows == 0)
								{
									echo "<tr><th scope=\"row\"> 1</th><td>No users found!</td><td></td></tr>"; // Tampilkan pesan jika tidak ada pengguna
								}
								else{
									$i=1;
									foreach($users as $user ) // Iterasi melalui data pengguna dari database
									{
										$enable = $user['enabled'] == 1 ? "Disable" : "Enable";
										$queryString = "user_id=". $user['id'] . "&enable=" . (($user['enabled'] == 0) ? "1" : "0"); // Bangun query string untuk toggle status
										echo "<tr><th scope=\"row\">" .$i ."</th><td>" . $user['email'] ."</td><td><a href=\"manageUsers.php?" . $queryString . "\">" . $enable . "</a></td></tr>"; // Tampilkan baris data pengguna dengan tombol Enable/Disable
										$i++;
									}
								}
							?>
						</tbody>
					</table>
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