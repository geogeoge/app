<?php
session_start();
$level = $_SESSION['level'];
if($level=="BILLING") {
	header('location:../app_billing');
} else
if($level=="MARKETING") {
	header('location:../app_marketing');
} else
if($level=="LABELING_ADMIN") {
	header('location:admin');
} else
if($level=="LABELING_TEKNISI") {
	header('location:teknisi');
} else
if($level=="ACCOUNTING") {
	header('location:../app_accounting/accounting');
} else
if($level=="ACCOUNTING_ADMIN") {
	header('location:../app_accounting/admin');
} else
if($level=="ACCOUNTING_KASIR") {
	header('location:../app_accounting/kasir');
} else {
	header('location:../../login');
}
?>