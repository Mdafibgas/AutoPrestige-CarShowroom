<?php

// Fungsi untuk memeriksa apakah pengguna sudah login
function isLoggedIn()
{
    if(isset($_SESSION) && isset($_SESSION['logged_in']))
        return $_SESSION['logged_in'];

    return false;
}

// Fungsi untuk memeriksa apakah pengguna adalah admin
function isAdmin()
{
    if(isLoggedIn() && isset($_SESSION['is_admin']) && $_SESSION['is_admin'])
        return $_SESSION['is_admin'];

    return false;
}

// Fungsi untuk mendapatkan ID pengguna yang sudah login
function getUserId()
{
    if(isset($_SESSION) && isset($_SESSION['user_id']))
        return  $_SESSION['user_id']; 

    return NULL;
}

// Fungsi untuk memeriksa metode permintaan GET
function isRequestMethodGet()
{
    if($_SERVER["REQUEST_METHOD"] == "GET")
        return true;
    return false;
}

// Fungsi untuk memeriksa metode permintaan POST
function isRequestMethodPost()
{
    if($_SERVER["REQUEST_METHOD"] == "POST")
        return true;
    return false;
}

// Fungsi untuk mendapatkan nilai dari permintaan POST
function getPostRequestValue(string $postString)
{
    if(isset($_POST[$postString]))
        return $_POST[$postString];

    return NULL;
}

// Fungsi untuk mendapatkan nilai dari permintaan GET
function getGetRequestValue(string $getString)
{
    if(isset($_GET[$getString]))
        return $_GET[$getString];

    return NULL;
}

// Fungsi untuk mendapatkan nilai dari sesi
function getSessionValue(string $sessString)
{
    if(isset($_SESSION) && isset($_SESSION[$sessString]))
        return $_SESSION[$sessString];
    
    return NULL;
}

// Fungsi untuk mengatur sesi pengguna setelah login
function setupUserSession(string $id, string $userEmail, $isAdmin = false)
{
    $_SESSION["logged_in"] = true;
	$_SESSION["user_id"] = $id;
	$_SESSION["user_email"] = $userEmail;
    $_SESSION["is_admin"] = $isAdmin;
}

?>
