<?php
session_start();
if(!($_SESSION['level']=="LABELING_ADMIN")) {
	header('location:../../../login/');
}
?>