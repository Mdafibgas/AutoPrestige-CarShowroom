<?php

date_default_timezone_set('Pacific/Auckland');
// mulai
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

/* Database.  */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'autoprestige');
define('ROOT_DIR', __DIR__);
 
/* menghubungkan ke database MySQL */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

//  unggah gambar produk
define('PRODUCT_IMG_DIR', 'c:/xampp/htdocs/SI D_KEL 5_AUTOPRESTIGE/images/');



//menampilkan gambar pada web
define('IMAGE_UPLOAD_PATH', 'images/');

