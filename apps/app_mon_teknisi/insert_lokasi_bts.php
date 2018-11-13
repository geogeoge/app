<?php
include "../../koneksi/koneksi.php";

$lokasi_bts = $_POST['lokasi_bts'];
$alamat_bts	= $_POST['alamat_bts'];
$parent_bts	= $_POST['parent_bts'];

mysqli_query($koneksi,"INSERT INTO mon_lokasibts
						(`id_lokasi_bts`, `lokasi_bts`, `alamat_bts`, `parent_bts`)
						VALUES
						(NULL, '$lokasi_bts', '$alamat_bts', '$parent_bts')");

header('Location:index.php?page=page_data_lokasi_bts');
?>