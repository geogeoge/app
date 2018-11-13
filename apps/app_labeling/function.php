<?php
include "../../../koneksi/koneksi.php";
class crud {
	//---------------------------------Data BTS---------------------------------\\
	function insert_bts() {
		include "../../../koneksi/koneksi.php";

		$select = "select * from label_gedung order by id DESC LIMIT 1";
		$query = mysqli_query($koneksi, $select);
		$tampil = mysqli_fetch_array($query);
		$id = $tampil['id'];
		$id++;
		if (empty($tampil)) $value_id="0".$id; else $value_id= $id;
		mysqli_query($koneksi, "insert into label_gedung (id, nama_gedung, kode_gedung, jumlah_lantai, alamat, koordinat) values ($value_id, '$_POST[nama_gedung]', '$_POST[kode_gedung]', '$_POST[jumlah_lantai]', '$_POST[alamat]', '$_POST[koordinat]')") or die(mysqli_error());
	}

	function select_bts() {
		include "../../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from label_gedung");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function update_bts() {
		include "../../../koneksi/koneksi.php";

		$update="update label_gedung set 
		nama_gedung='$_POST[nama_gedung]',
		kode_gedung='$_POST[kode_gedung]',
		jumlah_lantai='$_POST[jumlah_lantai]',
		alamat='$_POST[alamat]',
		koordinat='$_POST[koordinat]'
		where
		id='$_POST[id]'";
		mysqli_query($koneksi,$update)or die(mysqli_error());

	}

	function delete_bts() {
		include "../../../koneksi/koneksi.php";

		mysqli_query($koneksi,"DELETE FROM label_gedung WHERE id='$_POST[id]'");

	}
	//-------------------------------! Data BTS !-------------------------------\\
	//---------------------------------Data Room---------------------------------\\
	function insert_ruang() {
		include "../../../koneksi/koneksi.php";

		$select = "select * from label_ruang ORDER BY id DESC LIMIT 1";
		$query = mysqli_query($koneksi, $select);
		$tampil = mysqli_fetch_array($query);
		$id = $tampil['id'];
		$id++;
		if (empty($tampil)) $value_id="000".$id; else $value_id= $id;
		mysqli_query($koneksi, "insert into label_ruang values ($value_id, '$_POST[nama_ruang]', '$_POST[kode_ruang]')");
	}

	function select_ruang() {
		include "../../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from label_ruang");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function update_ruang() {
		include "../../../koneksi/koneksi.php";

		$update="update label_ruang set 
		nama_ruang='$_POST[nama_ruang]',
		kode_ruang='$_POST[kode_ruang]'
			where
			id='$_POST[id]'";
		mysqli_query($koneksi,$update) or die (mysql_error());

	}

	function delete_ruang() {
		include "../../../koneksi/koneksi.php";

		mysqli_query($koneksi,"DELETE FROM label_ruang WHERE id='$_POST[id]'");

	}
	//-------------------------------! Data Room !-------------------------------\\
	//---------------------------------Data Rak---------------------------------\\
	function insert_rak() {
		include "../../../koneksi/koneksi.php";

		$select = "select * from label_rak ORDER BY id DESC LIMIT 1";
		$query = mysqli_query($koneksi, $select);
		$tampil = mysqli_fetch_array($query);
		$id = $tampil['id'];
		$id++;
		if (empty($tampil)) $value_id="0".$id; else $value_id= $id;
		mysqli_query($koneksi, "insert into label_rak values ($value_id, '$_POST[nama_rak]', '$_POST[kode_rak]', '$_POST[jumlah_unit]', '$_POST[jenis_rak]')");
		
	}

	function select_rak() {
		include "../../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from label_rak");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function update_rak() {
		include "../../../koneksi/koneksi.php";

		$update="update label_rak set 
		nama_rak='$_POST[nama_rak]',
		kode_rak='$_POST[kode_rak]',
		jumlah_unit='$_POST[jumlah_unit]',
		jenis_rak='$_POST[jenis_rak]'
		where
		id='$_POST[id]'";
		mysqli_query($koneksi,$update)or die(mysqli_error());

	}

	function delete_rak() {
		include "../../../koneksi/koneksi.php";

		mysqli_query($koneksi,"DELETE FROM label_rak WHERE id='$_POST[id]'");

	}
	//-------------------------------! Data Rak !-------------------------------\\
	//---------------------------------Data Device---------------------------------\\
	function insert_device() {
		include "../../../koneksi/koneksi.php";

		$select = "select * from label_device ORDER BY id DESC LIMIT 1";
		$query = mysqli_query($koneksi, $select);
		$tampil = mysqli_fetch_array($query);
		$id = $tampil['id'];
		$id++;
		if (empty($tampil)) $value_id="000".$id; else $value_id= $id;
		mysqli_query($koneksi, "INSERT into label_device VALUES ('$value_id','$_POST[nama_device]','$_POST[kode_device]','$_POST[jenis_device]','$_POST[type_device]','$_POST[jumlah_port]')");
		
	}

	function select_device() {
		include "../../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from label_device");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function update_device() {
		include "../../../koneksi/koneksi.php";

		$update="update label_device set
		nama_device='$_POST[nama_device]',
		kode_device='$_POST[kode_device]',
		jenis_device='$_POST[jenis_device]',
		type_device='$_POST[type_device]',
		jumlah_port='$_POST[jumlah_port]'
			where
			id='$_POST[id]'";
		$edit=mysqli_query($koneksi,$update) or die (mysql_error());
	}

	function delete_device() {
		include "../../../koneksi/koneksi.php";
		
	}
	//-------------------------------! Data Device !-------------------------------\\
	//---------------------------------Data Label---------------------------------\\
	function insert_label() {
		include "../../../koneksi/koneksi.php";

		$sql ="select * from label_proses ORDER BY id DESC LIMIT 1";
		$edit = mysqli_query($koneksi,$sql) or die (mysqli_error());
		$r = mysqli_fetch_array($edit);
		$a = $r['id'];
		$a++ ;
		if(empty($r))
			$isi="D000".$a;
		else
		$isi=$a;
		$gedung = $_POST['nama_gedung_a'];
		$lantai = $_POST['no_lantai_a'];
		$ruang = $_POST['nama_ruang_a'];
		$rak = $_POST['nama_rak_a'];
		$norak = $_POST['no_rak_a'];
		$device = $_POST['nama_device_a'];
		$port = $_POST['no_port_a'];
		$nama_radio=" ";

		$gedung1 = $_POST['nama_gedung_t'];
		$lantai1 = $_POST['no_lantai_t'];
		$ruang1 = $_POST['nama_ruang_t'];
		$rak1 = $_POST['nama_rak_t'];
		$norak1 = $_POST['no_rak_t'];
		$device1 = $_POST['nama_device_t'];
		$port1 = $_POST['no_port_t'];
		$nama_radio1=" ";

		$in="INSERT into label_proses VALUES ('$isi','$gedung','$lantai','$ruang','$rak','$norak','$device','$port', '$nama_radio', '$gedung1','$lantai1','$ruang1','$rak1','$norak1','$device1','$port1', '$nama_radio1')";
		mysqli_query($koneksi,$in) or die (mysqli_error());

		//header('location:?page=page_tampil_generate&id='.$isi);
	}

	function select_label() {
		include "../../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from label_proses");
		while($tampil=mysqli_fetch_array($query))
		$data_label[]=$tampil;
		return $data_label;
	}

	function update_label() {
		include "../../../koneksi/koneksi.php";

		$id = $_POST['id'];
		$gedung = $_POST['nama_gedung_a'];
		$lantai = $_POST['no_lantai_a'];
		$ruang = $_POST['nama_ruang_a'];
		$rak = $_POST['nama_rak_a'];
		$norak = $_POST['no_rak_a'];
		$device = $_POST['nama_device_a'];
		$port = $_POST['no_port_a'];

		$gedung1 = $_POST['nama_gedung_t'];
		$lantai1 = $_POST['no_lantai_t'];
		$ruang1 = $_POST['nama_ruang_t'];
		$rak1 = $_POST['nama_rak_t'];
		$norak1 = $_POST['no_rak_t'];
		$device1 = $_POST['nama_device_t'];
		$port1 = $_POST['no_port_t'];

		$in="UPDATE label_proses set nama_gedung_a='$gedung',no_lantai_a='$lantai',nama_ruang_a='$ruang',nama_rak_a='$rak',no_rak_a='$norak',nama_device_a='$device',no_port_a='$port',nama_gedung_t='$gedung1',no_lantai_t='$lantai1',nama_ruang_t='$ruang1',nama_rak_t='$rak1',no_rak_t='$norak1',nama_device_t='$device1',no_port_t='$port1' where id='$id'";
		mysqli_query($koneksi,$in);
		//$up="UPDATE temp set nama_gedung_a='$gedung',no_lantai_a='$lantai',nama_ruang_a='$ruang',nama_rak_a='$rak',no_rak_a='$norak',nama_device_a='$device',no_port_a='$port',nama_gedung_t='$gedung1',no_lantai_t='$lantai1',nama_ruang_t='$ruang1',nama_rak_t='$rak1',no_rak_t='$norak1',nama_device_t='$device1',no_port_t='$port1' where id='$id'";
		//mysqli_query($koneksi,$up);;
	}

	function delete_label() {
		include "../../../koneksi/koneksi.php";
		
		mysqli_query($koneksi,"DELETE FROM label_proses WHERE id='$_POST[id]'");
	}
	//-------------------------------! Data Label !-------------------------------\\
	//---------------------------------Data User---------------------------------\\
	function insert_user() {
		include "../../../koneksi/koneksi.php";

		$username=$_POST['username'];
		$password_1=$_POST['password_1'];
		$password_2=$_POST['password_2'];
		$level=$_POST['level'];
		if($password_1==$password_2) {
			mysqli_query($koneksi, "INSERT into label_user VALUES ('$username', '$password_1', '$level')");
		}

	}

	function select_user() {
		include "../../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from label_user");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function delete_user() {
		include "../../../koneksi/koneksi.php";
		
		$username=$_POST['username'];
		mysqli_query($koneksi,"DELETE FROM label_user WHERE username='$username'");
	}
	//-------------------------------! Data User !-------------------------------\\
}
?>