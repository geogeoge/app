<?php
include "../../koneksi/koneksi.php";

$lokasi_bts = $_POST['lokasi_bts'];
$nama_bts	= $_POST['nama_bts'];
$ip_bts		= $_POST['ip_bts'];
$ssid		= $_POST['ssid'];
$telp 		= $_POST['telp'];
$parent_bts	= $_POST['parent_bts'];

mysqli_query($koneksi,"INSERT INTO mon_databts
						(id_bts,nama_bts,lokasi,kontak,telepon_bts,id_parent,ipbts)
						VALUES
						(NULL,'$nama_bts','$lokasi_bts','$ssid','$telp','$parent_bts','$ip_bts')");

header('Location:index.php?page=page_data_bts');
?>