<?php
include "../../koneksi/koneksi.php";

$id_register	= $_POST['id_register'];
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

// INSERT MON_PELANGGAN

$sql_update_mon_pelanggan ="INSERT INTO `mon_pelanggan` (`id_pelanggan`, `id_register`, `id_bts`, `nama_user`, `nik`, `nama_instansi`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `telp`, `email`, `koordinat`, `id_paket`, `status`, `ip_radio`, `ip_public`, `tgl_lahir`, `email_pelanggan`, `telp_pelanggan`) 
VALUES 
(NULL, '$id_register', '$id_bts', '$nama_user', '$nik', '$nama_instansi', '$jenis_kelamin', '$tempat_lahir', NULL, '$alamat', NULL, NULL, '', '$id_paket', 'SUDAH', '$ip_radio', '$ip_public', '$tanggal_lahir', '$email', '$telp')";


// UPDATE SALE REGISTER
$sql_update_sale_register="UPDATE sale_register SET status_mon='$status_mon' WHERE id_register='$id_register'";

mysqli_query($koneksi,$sql_update_mon_pelanggan);	
mysqli_query($koneksi,$sql_update_sale_register);

header("Location:index.php?page=page_data_user_baru_detail_sementara&id_register=$id_register");
//header("Location:index.php?page=page_data_pelanggan");



echo $id_register;
echo " / ";
echo $nama_user;
echo " / ";
echo $nik;
echo " / ";
echo $nama_instansi;
echo " / ";
echo $jenis_kelamin;
echo " / ";
echo $tempat_lahir;
echo " / ";
echo $tanggal_lahir;
echo " / ";
echo $alamat;
echo " / ";
echo $koordinat;
echo " / ";
echo $telp;
echo " / ";
echo $email;
echo " / ";
echo $id_paket;
echo " / ";
echo $id_bts;
echo " / ";
echo $ip_public;
echo " / ";
echo $ip_radio;
/*
$sql="SELECT * FROM sale_register WHERE id_register='$id'";
$query=mysqli_query($koneksi,$sql);
while ($data=mysqli_fetch_array($query)) {

$id_register	= $data['id_register'];
$nama_user		= $data['nama_user'];
$nik			= $data['nik'];
$nama_instansi	= $data['nama_instansi'];
$jenis_kelamin	= $data['jenis_kelamin'];
$tempat_lahir	= $data['tempat_lahir'];
$tanggal_lahir	= $data['tanggal_lahir'];
$alamat			= $data['alamat'];
$koordinat		= $data['koordinat'];
$telp 			= $data['telp'];
$email			= $data['email'];
$id_paket		= $data['id_paket'];

$sql_update_mon_pelanggan="INSERT INTO `mon_pelanggan`
(`id_pelanggan`, `id_register`, `id_bts`, `nama_user`, `nik`, `nama_instansi`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `telp`, `email`, `koordinat`, `id_paket`, `status`, `ip_radio`, `ip_public`)
VALUES
(NULL,'$id_register','$id_bts','$nama_user','$nik','$nama_instansi','$jenis_kelamin','$tempat_lahir','$tanggal_lahir','$alamat','$telp','$email','$koordinat','$id_paket','SUDAH','$ip_radio','$ip_public')";

mysqli_query($koneksi,$sql_update_mon_pelanggan);	
}
*/
?>