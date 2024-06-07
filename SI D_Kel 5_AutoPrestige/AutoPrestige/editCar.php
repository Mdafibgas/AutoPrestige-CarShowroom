<?php
//load helper functions
require_once './utilities/helperFunctions.php';

//load database connections
require_once "config.php";

// Pengecekan apakah pengguna adalah admin
if(!isAdmin()){
    header("location: index.php");
    exit;
}

$car="";
$editCar = false;
$addCar = false;                                                                        
if(isRequestMethodGet() && isset($_GET['car_id']))
{
    $editCar = true;
    $car_id = $_GET['car_id'];
    // Persiapkan statement SQL untuk mengambil detail mobil yang akan diedit
    $sql = "SELECT car.car_id, car.price, car.year, car.manufacturer, car.registration, car.car_condition,
                        car.model, car.colour, car.mileage, car.fuel_type, car.transmission_type, car.description, car.category_id,
                        car_images.file_name, 
                        car_images.id AS image_id
                FROM `car_images` 
                INNER JOIN car ON car.car_id = car_images.car_id 
                WHERE car.car_id =" . $car_id;

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute()) //execute prepared sql
    {
        $car = $stmt->get_result(); // store result
        $car = $car->fetch_assoc();
    }

}
else if(isRequestMethodGet())
{
    $addCar = true;
}
else if(isRequestMethodPost())
{
     // Ambil nilai-nilai dari form
    $updateMode             = $_POST['updateMode'];

    if($updateMode == 'edit')
        $car_id                 = $_POST['carId'];
    
    $price                  = $_POST['carPrice'];
    $model                  = $_POST['carModel'];    
    $manufacturer           = $_POST['carManufacturer'];    
    $fuel_type              = $_POST['carFuelType'];    
    $registration           = $_POST['carRegistration'];    
    $year                   = $_POST['carYear'];    
    $colour                 = $_POST['carColour'];    
    $transmission_type      = $_POST['carTransmissionType'];    
    $description            = $_POST['carDescription'];    
    $car_condition          = $_POST['carCondition'];    
    $mileage                = $_POST['carMileage'];    
    $category_id            = $_POST['carCategory'];

    // Persiapkan statement SQL untuk update atau insert data mobil
    if($updateMode == 'edit')
    {
        $sql = "UPDATE   car 
                    SET car.price               = ?,
                        car.model               = ?,
                        car.manufacturer        = ?,
                        car.fuel_type           = ?,
                        car.registration        = ?,
                        car.year                = ?,
                        car.colour              = ?,
                        car.transmission_type   = ?,
                        car.description         = ?,
                        car.car_condition       = ?,
                        car.mileage             = ?,
                        car.category_id         = ?
                WHERE   car.car_id              = ?";
                    

        $stmt = $mysqli->prepare($sql);    
        $stmt->bind_param("dssssissssiii", $price, $model, $manufacturer, $fuel_type, $registration, $year, $colour, $transmission_type, $description, $car_condition, $mileage, $category_id, $car_id);

        $stmt->execute();
    }
    else{
        $sql = "INSERT INTO car (price, model, manufacturer, fuel_type, registration, year, colour, transmission_type, description, car_condition, mileage, category_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
          // Persiapkan dan eksekusi statement SQL menggunakan prepared statement
        $stmt = $mysqli->prepare($sql);    
        $stmt->bind_param("dssssissssii", $price, $model, $manufacturer, $fuel_type, $registration, $year, $colour, $transmission_type, $description, $car_condition, $mileage, $category_id);

        $stmt->execute();
    }

     // Redirect ke halaman manajemen mobil setelah proses selesai
    header("location: manageCars.php");
    exit;
}
else{
    header("location: index.php");
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
                <h1 class="display-6 text-white">
                        <?php echo $editCar ? "Edit Car" : "Add Car"; ?>
                    </h1>
                </p>
            </div>
            <div class="row justify-content-center">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class=" row mb-3 ">
                        <label for="inputManufacturer " class="col-sm-5 col-form-label text-end ">Manufacturer</label>
                        <div class="col-sm-7 ">
                            <?php
                            // Menampilkan input untuk nama produsen mobil
                                if($editCar)
                                {
                                    echo "<input type=\"hidden\" name=\"updateMode\" value=\"edit\">" ; 
                                    echo "<input type=\"hidden\" name=\"carId\" value=\"" . $car[ 'car_id'] . "\">" ; 
                                    echo "<input type=\"text\" class=\"form-control\" id=\"inputManufacturer\" name=\"carManufacturer\" value=\"" . $car[ 'manufacturer'] . "\"\>"; 
                                } 
                                    
                                if($addCar) 
                                { 
                                    echo "<input type=\"hidden\" name=\"updateMode\" value=\"add\">" ;
                                    echo "<input type=\"text\" class=\"form-control\" id=\"inputManufacturer\" name=\"carManufacturer\">"; 
                                } 
                            ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputModel" class="col-sm-5 col-form-label text-end">Model</label>
                        <div class="col-sm-7">
                            <?php 
                                if($editCar)
                                {
                                    echo "<input type=\"text\" class=\"form-control\" id=\"inputModel\" name=\"carModel\" value=\"" . $car['model'] . "\">"; 
                                }

                                if($addCar)
                                {
                                    echo "<input type=\"text\" class=\"form-control\" id=\"inputModel\" name=\"carModel\">"; 
                                }
                                ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputColour" class="col-sm-5 col-form-label text-end">Colour</label>
                        <div class="col-sm-7">

                            <?php 
                                if($editCar)
                                {
                                    echo "<input type=\"text\" class=\"form-control\" id=\"inputColour\" name=\"carColour\" value=\"" . $car['colour'] ."\">"; 
                                }

                                if($addCar)
                                {
                                    echo "<input type=\"text\" class=\"form-control\" id=\"inputColour\" name=\"carColour\">"; 
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputYear" class="col-sm-5 col-form-label text-end">Year</label>
                        <div class="col-sm-7">
                            <?php 
                                if($editCar)
                                {
                                    echo "<input type=\"text\" class=\"form-control\" id=\"inputYear\" name=\"carYear\" value=\"" . $car['year'] . "\">"; 
                                }

                                if($addCar)
                                {
                                    echo "<input type=\"text\" class=\"form-control\" id=\"inputYear\" name=\"carYear\">"; 
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputMileage" class="col-sm-5 col-form-label text-end">Mileage</label>
                        <div class="col-sm-7">
                            <?php 
                                if($editCar)
                                {
                                    echo "<input type=\"text\" class=\"form-control\" id=\"inputMileage\" name=\"carMileage\" value=\"" . $car['mileage'] . "\">";
                                }

                                if($addCar)
                                {
                                    echo "<input type=\"text\" class=\"form-control\" id=\"inputMileage\" name=\"carMileage\">";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputRegistration" class="col-sm-5 col-form-label text-end">Registration</label>
                        <div class="col-sm-7">
                            <?php 
                                if($editCar)
                                {
                                    echo "<input type=\"text\" class=\"form-control\" id=\"inputRegistration\" name=\"carRegistration\" value=\"" . $car['registration'] . "\">";
                                }

                                if($addCar)
                                {
                                    echo "<input type=\"text\" class=\"form-control\" id=\"inputRegistration\" name=\"carRegistration\">";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputFuelType" class="col-sm-5 col-form-label text-end">Fuel Type</label>
                        <div class="col-sm-7">
                            <?php 
                                if($editCar)
                                {
                                    echo "<input type=\"text\" class=\"form-control\" id=\"inputFuelType\" name=\"carFuelType\" value=\"" . $car['fuel_type'] . "\">";
                                }

                                if($addCar)
                                {
                                    echo "<input type=\"text\" class=\"form-control\" id=\"inputFuelType\" name=\"carFuelType\">";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputTransmissionType" class="col-sm-5 col-form-label text-end">Transmission Type</label>
                        <div class="col-sm-7">
                            <?php 
                                if($editCar)
                                {
                                    echo "<input type=\"text\" class=\"form-control\" id=\"inputTransmissionType\" name=\"carTransmissionType\" value=\"" . $car['transmission_type'] . "\">";
                                }

                                if($addCar)
                                {
                                    echo "<input type=\"text\" class=\"form-control\" id=\"inputTransmissionType\" name=\"carTransmissionType\">";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputDescription" class="col-sm-5 col-form-label text-end">Description</label>
                        <div class="col-sm-7">
                            <?php 
                                if($editCar)
                                {
                                    echo "<textarea class=\"form-control\" id=\"inputDescription\" name=\"carDescription\" rows=\"3\">" . $car['description'] . "</textarea>";
                                }

                                if($addCar)
                                {
                                    echo "<textarea class=\"form-control\" id=\"inputDescription\" name=\"carDescription\" rows=\"3\"></textarea>";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputCondition" class="col-sm-5 col-form-label text-end">Condition</label>
                        <div class="col-sm-7">
                            <?php 
                                if($editCar)
                                {
                                    echo "<input type=\"text\" class=\"form-control\" id=\"inputCondition\" name=\"carCondition\" value=\"" . $car['car_condition'] . "\">";
                                }

                                if($addCar)
                                {
                                    echo "<input type=\"text\" class=\"form-control\" id=\"inputCondition\" name=\"carCondition\">";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPrice" class="col-sm-5 col-form-label text-end">Price</label>
                        <div class="col-sm-7">
                            <?php 
                                if($editCar)
                                {
                                    echo "<input type=\"text\" class=\"form-control\" id=\"inputPrice\" name=\"carPrice\" value=\"" . $car['price'] . "\">";
                                }

                                if($addCar)
                                {
                                    echo "<input type=\"text\" class=\"form-control\" id=\"inputPrice\" name=\"carPrice\">";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputCategory" class="col-sm-5 col-form-label text-end">Category</label>
                        <div class="col-sm-7">
                            <select class="form-select" aria-label="Car Category" name="carCategory">
                                <option value="1" <?php if ($editCar && $car['category_id'] == 1) echo 'selected'; ?>>Luxury</option>
                                <option value="2" <?php if ($editCar && $car['category_id'] == 2) echo 'selected'; ?>>Family</option>
                                <option value="3" <?php if ($editCar && $car['category_id'] == 3) echo 'selected'; ?>>Sports</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-primary justify-content-center btn-dark">
                            <?php echo $editCar ? "Update Car" : "Add Car"; ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
		<footer class="container mt-0">
			<p class="float-end"><a href="#">Site designed by SI D_Kel 5</a></p>
			<p>&copy; 2022 AutoPrestige Inc. </p>
		</footer>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
