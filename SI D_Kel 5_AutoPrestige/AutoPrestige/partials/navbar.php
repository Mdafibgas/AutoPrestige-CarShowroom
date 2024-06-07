<?php

require_once ROOT_DIR."/utilities/helperFunctions.php";

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

// Memeriksa apakah admin
$logged_in = isLoggedIn();
$is_admin = isAdmin();
$role = "normal"; 

$car_manufacturers =""; // Variabel untuk menyimpan produsen mobil

if(isRequestMethodGet())
{
    // Menyiapkan pernyataan SQL untuk mengambil produsen mobil yang unik
    $sql = "SELECT DISTINCT car.manufacturer FROM car ORDER BY manufacturer ASC";
    $stmt = $mysqli->prepare($sql); // Menyiapkan pernyataan SQL

    if($stmt->execute()) 
    {
        // Menyimpan hasil dari pernyataan SQL
        $car_manufacturers = $stmt->get_result();
    }
}
?>


<nav class="navbar navbar-expand-md navbar-transparent justify-content-center text-white">
    <div class="d-flex">
        <a class="navbar-brand" href="."><img src="Logo AutoPrestige.ico" alt="" width="200" height="100" alt="Carland Motors"></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="nav nav-pills">
               
                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" href="./">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" href="./aboutUs.php">About Us</a>
                </li>
				
				<?php
				// Dropdown for Account if not logged in
				if(empty($logged_in))
				{
					echo '<li class="nav-item dropdown">
							<a class="nav-link text-white dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
							<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="./login.php">Login</a></li>
								<li><a class="dropdown-item" href="./register.php">Register</a></li>
							</ul>
						  </li>';
				}
 
				// Dropdown for Vehicles if manufacturers exist
				if(!empty($car_manufacturers)){
					echo '<li class="nav-item dropdown">
							<a class="nav-link  text-white dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Vehicles</a>
							<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">';
					
					foreach($car_manufacturers as $manufacturer)
					{
						echo "<li><a class=\"dropdown-item\" href=\"./search.php?car=" .$manufacturer['manufacturer'] . "\">". $manufacturer['manufacturer'] . "</a></li>";
					}
					echo '	</ul>
						  </li>';
				}
				

				// Wishlist link if logged in
				if(!empty($logged_in))
				{
					echo '<li class="nav-item"> <a class="nav-link text-white" href="wishList.php">Wish list</a></li>';
				}

				// Admin Dropdown if user is an admin
				if($is_admin)
				{
					echo '<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false">Admin</a>
							<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="./manageUsers.php">Manage Users</a></li>
								<li><a class="dropdown-item" href="./manageCars.php">Manage Cars</a></li>
							</ul>
						  </li>';
				}
				?>

				<li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" href="./contact.php">Contact</a>
                </li>
                
                <li class="nav-item">
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search Cars" aria-label="Search" id="searchCarsTxtBx">
                        <button class="btn btn-outline-success btn-outline-light" type="submit" id="searchCars">Search</button>
                    </form>
                </li>

				<?php
				// Logout Link if logged in
				if(!empty($logged_in))
				{
					echo '<li class="nav-item"> <a class="nav-link text-white" href="logout.php">Logout</a></li>';
				}
				?>
			</ul>
		</div>
	</div>
</nav>
	<script type="text/javascript" src="./js/autoprestige.js">
	$(document).ready(function () {
    // Search cars
    $('#searchCars').on('click', function (event) {
        event.preventDefault();
        console.log("Button clicked");

        var searchString = $('#searchCarsTxtBx').val();
        console.log("Search string: " + searchString);

        if (searchString && searchString.length != 0) {
            console.log("Redirecting to search.php");
            location.href = "search.php?searchString=" + searchString;
        } else {
            console.log("Search string is empty");
        }
    });
});</script>