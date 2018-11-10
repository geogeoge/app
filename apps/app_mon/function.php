<?php
class select {
	function select_teknisi_maintenance_where_status_kunjungan_belum() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from teknisi_maintenance left join sale_register on teknisi_maintenance.id_register=sale_register.id_register where teknisi_maintenance.status='Baru'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_jumlah_teknisi_maintenance_where_status_kunjungan_belum() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from teknisi_maintenance left join sale_register on teknisi_maintenance.id_register=sale_register.id_register where teknisi_maintenance.status='Baru'");
		$data=mysqli_num_rows($query);
		return $data;
	}

	function select_data_bts() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"SELECT * FROM mon_databts");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_data_lokasi_bts() {    
  	include "../../koneksi/koneksi.php";

  	$query=mysqli_query($koneksi,"SELECT * FROM mon_lokasibts");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }
}

$select = new select;
?>