<?php
$host = 'localhost'; 
$user = 'root';     // ini berlaku di xampp
$pass = 'root';         // ini berlaku di xampp
$db = 'sampah_input_hw';

$koneksi = new mysqli($host,$user,$pass,$db) or die ('Koneksi Lama Bermasalah');
?>