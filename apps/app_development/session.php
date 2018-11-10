<?php
session_start();
if(!($_SESSION['level']=="DEVELOPMENT")) {
	header('location:../../login/');
}
?>