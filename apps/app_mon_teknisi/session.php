<?php
session_start();
if(!($_SESSION['level']=="MONITORING")) {
	header('location:../../login/');
}
?>