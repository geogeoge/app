<?php
session_start();
$host = 'localhost'; 
$user = 'appsolonetnet';     // ini berlaku di xampp
$pass = 'r4s4ht4k0kt4k0k';         // ini berlaku di xampp
$db = 'appsolon_app';

// Ini koneksi untuk maintenance
$host = 'localhost'; 
$user = 'root';     // ini berlaku di xampp
$pass = 'root';         // ini berlaku di xampp
$db = 'appsolon_app';
 
// melakukan koneksi ke database
$koneksi = new mysqli($host,$user,$pass,$db);
 
// cek koneksi yang kita lakukan berhasil atau tidak
if ($koneksi->connect_error) {
   // jika terjadi error, matikan proses dengan die() atau exit();
   die('Maaf koneksi gagal: '. $connect->connect_error);
}

//error_reporting(0);
?>
