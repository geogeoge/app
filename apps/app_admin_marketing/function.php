<?php
class crud {
	//----------------------------------------Function Select----------------------------------------\\
	function select_data_user_prospek($login_id_marketing) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_user_prospek where id_marketing='$login_id_marketing' order by id_prospek DESC");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	//--------------------------------------! Function Update !--------------------------------------\\
}

class dashboard {
	function data_user_prospek_all() {
		include "../../koneksi/koneksi.php";

		$query = mysqli_query($koneksi,"SELECT * FROM sale_user_prospek");
		$jumlah = mysqli_num_rows($query);

		return $jumlah;
	}

	function data_user_trial_all() {
		include "../../koneksi/koneksi.php";

		$query = mysqli_query($koneksi,"SELECT * FROM sale_register WHERE status='Trial'");
		$jumlah = mysqli_num_rows($query);

		return $jumlah;
	}

	function data_user_close_all() {
		include "../../koneksi/koneksi.php";

		$query = mysqli_query($koneksi,"SELECT * FROM sale_register WHERE status='Close'");
		$jumlah = mysqli_num_rows($query);

		return $jumlah;
	}

	function data_user_hold_all() {
		include "../../koneksi/koneksi.php";

		$query = mysqli_query($koneksi,"SELECT * FROM sale_register WHERE status='Hold'");
		$jumlah = mysqli_num_rows($query);

		return $jumlah;
	}

	function data_marketing() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from master_login where level='MARKETING'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function data_user_prospek_per_marketing($id_marketing) {
		include "../../koneksi/koneksi.php";

		$query = mysqli_query($koneksi,"SELECT * FROM sale_user_prospek WHERE id_marketing='$id_marketing'");
		$jumlah = mysqli_num_rows($query);

		return $jumlah;
	}

	function data_user_trial_per_marketing($id_marketing) {
		include "../../koneksi/koneksi.php";

		$query = mysqli_query($koneksi,"SELECT * FROM sale_register WHERE id_marketing='$id_marketing' AND status='Trial'");
		$jumlah = mysqli_num_rows($query);

		return $jumlah;
	}

	function data_user_close_per_marketing($id_marketing) {
		include "../../koneksi/koneksi.php";

		$query = mysqli_query($koneksi,"SELECT * FROM sale_register WHERE id_marketing='$id_marketing' AND status='Close'");
		$jumlah = mysqli_num_rows($query);

		return $jumlah;
	}

	function data_user_hold_per_marketing($id_marketing) {
		include "../../koneksi/koneksi.php";

		$query = mysqli_query($koneksi,"SELECT * FROM sale_register WHERE id_marketing='$id_marketing' AND status='Hold'");
		$jumlah = mysqli_num_rows($query);

		return $jumlah;
	}
}

class paket_internet {
	function select_data_paket_internet() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_paket_internet");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function insert_data_paket($id_paket, $nama_paket, $harga) {
		include "../../koneksi/koneksi.php";

		//cek password sudah sama atau belum?
		mysqli_query($koneksi,"INSERT INTO `sale_paket_internet`(`id_paket`, `nama_paket`, `harga`, `status_paket`) VALUES ('$id_paket', '$nama_paket', '$harga', 'BUKA')");
	}

	function update_data_internet($id_paket, $nama_paket, $harga) {
		include "../../koneksi/koneksi.php";

		//cek password sudah sama atau belum?
		mysqli_query($koneksi,"UPDATE `sale_paket_internet` SET `nama_paket`='$nama_paket', `harga`='$harga' where `id_paket`='$id_paket'");
	}

	function update_status_paket($id_paket, $update_status_paket) {
		include "../../koneksi/koneksi.php";

		//cek password sudah sama atau belum?
		mysqli_query($koneksi,"UPDATE `sale_paket_internet` SET `status_paket`='$update_status_paket' where `id_paket`='$id_paket'");
	}
}

class data_marketing {
	function select_data_marketing() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from master_login where level='MARKETING' or level='ADMIN_MARKETING'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function insert_data_marketing($id_user, $nama_user, $username, $password1, $password2, $level) {
		include "../../koneksi/koneksi.php";

		//cek password sudah sama atau belum?
		if($password1==$password2) {
			mysqli_query($koneksi,"INSERT INTO `master_login` (`id_user`, `nama_user`, `username`, `password`, `level`) VALUES ('$id_user', '$nama_user', '$username', '$password1', '$level')");
		}

	}

	function update_data_marketing($id_user, $nama_user, $username, $password1, $password2, $level) {
		include "../../koneksi/koneksi.php";

		//cek password sudah sama atau belum?
		if($password1==$password2) {
			mysqli_query($koneksi,"UPDATE `master_login` SET `nama_user`='$nama_user', `username`='$username', `password`='$password', `level`='$level' WHERE `id_user`='$id_user'");
		}

	}

	function delete_data_marketing($id_user) {
		include "../../koneksi/koneksi.php";

		//cek password sudah sama atau belum?
		if($password1==$password2) {
			mysqli_query($koneksi,"DELETE FROM master_login WHERE `id_user`='$id_user'");
		}

	}
}

class data_user_close {
	function select_data_marketing() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from master_login where level='MARKETING'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_data_user_close_per_marketing($id_marketing) {
		include "../../koneksi/koneksi.php";

		$where = "and sale_register.id_marketing='$id_marketing'";
		if($id_marketing=="SEMUA"){
			$where="";
		}
		$query=mysqli_query($koneksi,"select * from sale_register left join sale_paket_internet on sale_register.id_paket=sale_paket_internet.id_paket where sale_register.status='Close' $where");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_data_user_trial_per_marketing($id_marketing) {
		include "../../koneksi/koneksi.php";

		$where = "and sale_register.id_marketing='$id_marketing'";
		if($id_marketing=="SEMUA"){
			$where="";
		}
		$query=mysqli_query($koneksi,"select * from sale_register left join sale_paket_internet on sale_register.id_paket=sale_paket_internet.id_paket where sale_register.status='Trial' $where");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_data_user_hold_per_marketing($id_marketing) {
		include "../../koneksi/koneksi.php";

		$where = "and sale_register.id_marketing='$id_marketing'";
		if($id_marketing=="SEMUA"){
			$where="";
		}
		$query=mysqli_query($koneksi,"select * from sale_register left join sale_paket_internet on sale_register.id_paket=sale_paket_internet.id_paket where sale_register.status='Hold' $where");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_data_user_prospek_per_marketing($id_marketing) {
		include "../../koneksi/koneksi.php";

		$where = "where id_marketing='$id_marketing'";
		if($id_marketing=="SEMUA"){
			$where="";
		}
		$query=mysqli_query($koneksi,"select * from sale_user_prospek $where");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}
}
?>