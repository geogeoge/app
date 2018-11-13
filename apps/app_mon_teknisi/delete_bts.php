<?php
include "../../koneksi/koneksi.php";
$no=$_GET['kd'];
mysqli_query($koneksi,"DELETE FROM mon_databts WHERE id_bts='$no'");
header('Location:index.php?page=page_data_bts');
?>