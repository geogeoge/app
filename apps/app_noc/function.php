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

    $query=mysqli_query($koneksi,"SELECT * FROM mon_databts ORDER BY nama_bts");
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

  function select_data_jadwal() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select * from master_login right join sale_register on sale_register.id_teknisi=master_login.id_user where sale_register.status='Order Alat' or sale_register.status='Alat Siap'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_data_jadwal_partner() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select * from master_login right join sale_register on sale_register.partner=master_login.id_user where sale_register.status='Order Alat' or sale_register.status='Alat Siap'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_data_jadwal_maintenance() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select teknisi_maintenance.id_register, teknisi_maintenance.id_teknisi, teknisi_maintenance.tanggal_penjadwalan_maintenance, teknisi_maintenance.status, sale_register.id_register, sale_register.nama_user, master_login.id_user, master_login.ekstra from teknisi_maintenance left join sale_register on teknisi_maintenance.id_register=sale_register.id_register left join master_login on teknisi_maintenance.id_teknisi=master_login.id_user where teknisi_maintenance.status='Antrian'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_data_jadwal_maintenance_partner() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select teknisi_maintenance.id_register, teknisi_maintenance.partner, teknisi_maintenance.tanggal_penjadwalan_maintenance, teknisi_maintenance.status, sale_register.id_register, sale_register.nama_user, master_login.id_user, master_login.ekstra from teknisi_maintenance left join sale_register on teknisi_maintenance.id_register=sale_register.id_register left join master_login on teknisi_maintenance.partner=master_login.id_user where teknisi_maintenance.status='Antrian'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }
}

$select = new select;
?>