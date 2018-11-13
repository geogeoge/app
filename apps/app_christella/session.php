<?php
session_start();
if(!($_SESSION['level']=="CHRISTELLA")) {
	header('location:../../login/');
}
?>