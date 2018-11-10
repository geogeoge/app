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
	}else {
		header('location:login');
	}
}

//ini rauting
?>