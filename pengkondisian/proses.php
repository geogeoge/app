<?php
$host_1 = 'localhost'; 
$user_1 = 'appsolonetnet';     // ini berlaku di xampp
$pass_1 = 'r4s4ht4k0kt4k0k';         // ini berlaku di xampp
$db_1 = 'appsolon_app';
 
// melakukan koneksi ke database
$koneksi_1 = new mysqli($host_1,$user_1,$pass_1,$db_1);

if ($koneksi_1->connect_error) {
   // jika terjadi error, matikan proses dengan die() atau exit();
   die('Maaf koneksi gagal: '. $connect->connect_error);
}

// $host_2 = 'localhost'; 
// $user_2 = 'root';     // ini berlaku di xampp
// $pass_2 = 'root';         // ini berlaku di xampp
// $db_2 = 'percobaan_appsolonet';
 
// // melakukan koneksi ke database
// $koneksi_2 = new mysqli($host_2,$user_2,$pass_2,$db_2);

// if ($koneksi_2->connect_error) {
//   // jika terjadi error, matikan proses dengan die() atau exit();
//   die('Maaf koneksi gagal: '. $connect->connect_error);
// }


// $query_data_transaksi_app_lama = mysqli_query($koneksi_1, "SELECT `id_transaksi`, `no_transaksi`, `tanggal`, `keterangan`, `nominal`, `id_account`, `DK`, `id_temp`, `ekstra` FROM `data_transaksi`");
// while($data_transaksi_app_lama = mysqli_fetch_array($query_data_transaksi_app_lama)){
// 	$no_transaksi = $data_transaksi_app_lama['no_transaksi'];
// 	$tanggal = $data_transaksi_app_lama['tanggal'];
// 	$keterangan = $data_transaksi_app_lama['keterangan'];
// 	$nominal = $data_transaksi_app_lama['nominal'];
// 	$id_account = $data_transaksi_app_lama['id_account'];
// 	$DK = $data_transaksi_app_lama['DK'];
// 	$id_temp = $data_transaksi_app_lama['id_temp'];
// 	$ekstra = $data_transaksi_app_lama['ekstra'];

// 	mysqli_query($koneksi_2,"INSERT INTO `data_transaksi`(`no_transaksi`, `tanggal`, `keterangan`, `nominal`, `id_account`, `DK`, `id_temp`, `ekstra`) VALUE ('$no_transaksi', '$tanggal', '$keterangan', '$nominal', '$id_account', '$DK', '$id_temp', '$ekstra')") or die(mysqli_error());
// }

$query_data_transaksi = mysqli_query($koneksi_1, "SELECT * FROM `data_transaksi`");
while($data_transaksi = mysqli_fetch_array($query_data_transaksi)){
	$id_transaksi = $data_transaksi['id_transaksi'];
	$no_transaksi = $data_transaksi['no_transaksi'];
	$pecah_no_transaksi = explode(".", $no_transaksi);
	$kode_transaksi = $pecah_no_transaksi[1] + 0;
	if($kode_transaksi<=9){
		$no_transaksi = $pecah_no_transaksi[0].".000".$kode_transaksi;
	} else 
	if($kode_transaksi<=99){
		$no_transaksi = $pecah_no_transaksi[0].".00".$kode_transaksi;
	} else 
	if($kode_transaksi<=999){
		$no_transaksi = $pecah_no_transaksi[0].".0".$kode_transaksi;
	} else {
		$no_transaksi = $no_transaksi;
	}

	mysqli_query($koneksi_1,"UPDATE `data_transaksi` SET `no_transaksi`='$no_transaksi' WHERE `id_transaksi`='$id_transaksi'");
}
?>
