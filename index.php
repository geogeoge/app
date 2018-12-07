<?php
include "koneksi/koneksi.php";
$maintenance = "0";
if($maintenance=="1"){
	include "maintenance.php";
} else {
	$level = $_SESSION['level'];
	if($level=="BILLING") {
	header('location:apps/app_billing');
	} else
	if($level=="MARKETING") {
		header('location:apps/app_marketing');
	} else
	if($level=="LABELING_ADMIN") {
		header('location:apps/app_labeling/admin');
	} else
	if($level=="LABELING_TEKNISI") {
		header('location:apps/app_labeling/teknisi');
	} else
	if($level=="ACCOUNTING") {
		header('location:apps/app_accounting/');
	} else
	if($level=="ACCOUNTING_ADMIN") {
		header('location:apps/app_admin_accounting/');
	} else
	if($level=="ACCOUNTING_KASIR") {
		header('location:apps/app_accounting/kasir/?page=content');
	} else
	if($level=="TOKO") {
		header('location:apps/app_toko');
	} else
	if($level=="CHRISTELLA") {
	  header('location:apps/app_christella');
	} else
	if($level=="ADMIN_MARKETING") {
	  header('location:apps/app_admin_marketing');
	} else
	if($level=="TEKNISI") {
	  header('location:apps/app_teknisi');
	}  else 
	if($level=="PENJADWALAN") {
	  header('location:apps/app_penjadwalan');
	}  else 
	if($level=="MONITORING") {
	  header('location:apps/app_mon_teknisi');
	}  else 
	if($level=="MANAGEMEN") {
	  header('location:apps/app_manager');
	}  else 
	if($level=="DEVELOPMENT") {
	  header('location:apps/app_development');
	} else 
	if($level=="NOC") {
	  header('location:apps/app_noc');
	}else 
	if($level=="PENYUSUTAN") {

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL,"http://localhost/project/Appsolonet/apps/ci_penyusutan/login/login_api");
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, "username=" .$_SESSION['username']. "&level=" .$level. "&id_user=" .$id_user);
	  	header('location:apps/ci_penyusutan/');
	}else {
		header('location:login');
	}
}

?>

