<?php

include "../koneksi/koneksi.php";
$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($koneksi,"SELECT * FROM master_login WHERE username = '$username' AND password = '$password'") or die(mysql_error());
$menampilkan_query = mysqli_fetch_array($query);
$menghitung_query = mysqli_num_rows($query);
if ($menghitung_query > 0)
{		
	$data_respone = array(
		'username' => $username,
		'status' => 'Sukses'
	);

} else {
	$data_respone = array('status' => 'Gagal');
}

//header('Content-Type: application/json');
echo json_encode($data_respone,TRUE);

?>