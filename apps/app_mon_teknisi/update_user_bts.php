<?php
include "../../koneksi/koneksi.php";

$id		= $_GET['id'];

$id_bts	= $_POST['id_bts'];
$ip_public = $_POST['ip_public'];
$ip_radio = $_POST['ip_radio'];

$query= "UPDATE mon_pelanggan SET
				id_bts 	= '$kapasitas',
				ip_public = '$ip_public',
				ip_radio = '$ip_radio'
		WHERE   id_pelanggan    = '$id'
		";

mysqli_query($koneksi,$query);

header('Location:index.php?page=page_data_pelanggan');
?>