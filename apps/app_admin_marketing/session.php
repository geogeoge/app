<?php
session_start();
if(!($_SESSION['level']=="ADMIN_MARKETING")) {
	header('location:../../login/');
}
?>