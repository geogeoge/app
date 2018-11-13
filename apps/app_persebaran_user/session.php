<?php
session_start();
if(!($_SESSION['level']=="MARKETING")) {
	header('location:../../login/');
}
?>