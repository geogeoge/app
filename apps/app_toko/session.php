<?php
session_start();
if(!($_SESSION['level']=="TOKO")) {
	header('location:../../login/');
}
?>