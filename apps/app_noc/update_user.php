<?php
include "../../koneksi/koneksi.php";

$id_register	= $_POST['id_register'];
$id_pelanggan	= $_POST['id_pelanggan'];
$nama_user		= $_POST['nama_user'];
$nik			= $_POST['nik'];
$nama_instansi	= $_POST['nama_instansi'];
$jenis_kelamin	= $_POST['jenis_kelamin'];
$tempat_lahir	= $_POST['tempat_lahir'];
$tanggal_lahir	= $_POST['tanggal_lahir'];
$alamat			= $_POST['alamat'];
$koordinat		= $_POST['koordinat'];
$telp 			= $_POST['telp'];
$email			= $_POST['email'];
$id_paket		= $_POST['id_paket'];
$id_bts			= $_POST['id_bts'];
$ip_public		= $_POST['ip_public'];
$ip_radio		= $_POST['ip_radio'];
$status_mon		= "SUDAH";

// UPDATE MON_PELANGGAN
$sql_update_mon_pelanggan="UPDATE mon_pelanggan SET id_register		= '$id_register',
													id_bts			= '$id_bts',
													nama_user		= '$nama_user',
													nik 			= '$nik',
													nama_instansi	= '$nama_instansi',
													jenis_kelamin	= '$jenis_kelamin',
													tempat_lahir	= '$tempat_lahir',
													alamat			= '$alamat',
													koordinat		= '$koordinat',
													telp 			= '$telp',
													email 			= '$email',
													id_paket		= '$id_paket', 
													status 			= '$status_mon',
													ip_radio 		= '$ip_radio',
													ip_public 		= '$ip_public'
													WHERE
													id_pelanggan	= '$id_pelanggan'";

// UPDATE IP PUBLIC
$sql_update_ip_public="UPDATE mon_ippublik SET ip_public = '$ip_public' WHERE id_pelanggan='$id_pelanggan'";

// UPDATE IP RADIO		
$sql_update_ip_radio="UPDATE mon_ipradio SET ip_radio = '$ip_radio' WHERE id_pelanggan='$id_pelanggan'";

// UPDATE SALE REGISTER
$sql_update_sale_register="UPDATE sale_register SET status_mon='$status_mon' WHERE id_register='$id_register'";

mysqli_query($koneksi,$sql_update_mon_pelanggan);
mysqli_query($koneksi,$sql_update_ip_public);
mysqli_query($koneksi,$sql_update_ip_radio);
mysqli_query($koneksi,$sql_update_sale_register);

header("Location:index.php?page=page_data_user_detail_sementara&id_pelanggan=$id_pelanggan");

?>