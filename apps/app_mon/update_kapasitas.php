<?php
include "../../koneksi/koneksi.php";

$id_bts		= $_GET['id_bts'];

$kapasitas	= $_POST['kapasitas'];

$query= "UPDATE mon_databts SET
				kapasitas_bts 	= '$kapasitas'
		WHERE   id_bts 	        = '$id_bts'
		";

mysqli_query($koneksi,$query);

header('Location:index.php?page=page_data_bts');
?>