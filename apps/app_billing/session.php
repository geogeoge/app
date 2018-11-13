<?php
session_start();
if(!($_SESSION['level']=="BILLING")) {
	header('location:../../login/');
}
?>