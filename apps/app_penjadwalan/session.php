<?php
session_start();
if(!($_SESSION['level']=="PENJADWALAN")) {
	header('location:../../login/');
}
?>