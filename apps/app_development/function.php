<?php
class crud {
	function select_data_sale_paket() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_paket_internet where status_paket='BUKA'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_data_label_gedung() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from label_gedung");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_data_sale_radio() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_radio");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_data_sale_antena() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select * from sale_antena");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_data_sale_wifi() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select * from sale_wifi");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_data_sale_tower() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_tower");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_data_sale_kabel() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_kabel");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}
	
}

$crud = new crud;
?>