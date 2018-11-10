<?php
session_start();
if(!($_SESSION['level']=="MANAGEMEN")) {
	header('location:../../login/');
}
?>