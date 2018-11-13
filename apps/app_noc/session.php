<?php
session_start();
if(!($_SESSION['level']=="NOC")) {
	header('location:../../login/');
}
?>