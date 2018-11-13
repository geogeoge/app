<?php
session_start();
if(!($_SESSION['level']=="TEKNISI")) {
	header('location:../../login/');
}
?>