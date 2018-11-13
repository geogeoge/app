<?php
session_start();
if(!($_SESSION['level']=="LABELING_TEKNISI")) {
	header('location:../../../login/');
}
?>