<?php

$bulan_indonesia = array(
  '01' => 'JANUARI',
  '02' => 'FEBRUARI',
  '03' => 'MARET',
  '04' => 'APRIL',
  '05' => 'MEI',
  '06' => 'JUNI',
  '07' => 'JULI',
  '08' => 'AGUSTUS',
  '09' => 'SEPTEMBER',
  '10' => 'OKTOBER',
  '11' => 'NOVEMBER',
  '12' => 'DESEMBER',
);

class crud {
	//----------------------------------------Function Select----------------------------------------\\
	function select_data_user_prospek($login_id_teknisi) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_user_prospek where id_marketing='$login_id_marketing' order by id_prospek DESC");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}
}

class dashboard {
  function select_tugas_pemasangan_hari_ini($login_id_teknisi) {
    include "../../koneksi/koneksi.php";
    $tanggal_ini = date('Y-m-d');;

    $query=mysqli_query($koneksi,"select * from sale_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing left join sale_paket_internet on sale_register.id_paket=sale_paket_internet.id_paket where tanggal_penjadwalan='$tanggal_ini' and id_teknisi='$login_id_teknisi' and tanggal_pemasangan='0000-00-00' or tanggal_penjadwalan='$tanggal_ini' and partner='$login_id_teknisi' and tanggal_pemasangan='0000-00-00'");
    
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function jumlah_tugas_pemasangan_hari_ini($login_id_teknisi) {
    include "../../koneksi/koneksi.php";
    $tanggal_ini = date('Y-m-d');;

    $query=mysqli_query($koneksi,"select * from sale_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing where tanggal_penjadwalan='$tanggal_ini' and id_teknisi='$login_id_teknisi' and tanggal_pemasangan='0000-00-00' or tanggal_penjadwalan='$tanggal_ini' and partner='$login_id_teknisi' and tanggal_pemasangan='0000-00-00'");
    $data = mysqli_num_rows($query);
    return $data;
  }

  function select_tugas_maintenance_hari_ini($login_id_teknisi) {
    include "../../koneksi/koneksi.php";
    $tanggal_ini = date('Y-m-d');;

    $query=mysqli_query($koneksi,"select * from teknisi_maintenance where teknisi_maintenance.tanggal_penjadwalan_maintenance='$tanggal_ini' and teknisi_maintenance.id_teknisi='$login_id_teknisi' and teknisi_maintenance.status='Antrian' or teknisi_maintenance.tanggal_penjadwalan_maintenance='$tanggal_ini' and teknisi_maintenance.partner='$login_id_teknisi' and teknisi_maintenance.status='Antrian'");
    
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function jumlah_tugas_maintenance_hari_ini($login_id_teknisi) {
    include "../../koneksi/koneksi.php";
    $tanggal_ini = date('Y-m-d');;

    $query=mysqli_query($koneksi,"select * from teknisi_maintenance left join sale_register on teknisi_maintenance.id_register=sale_register.id_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing where teknisi_maintenance.tanggal_penjadwalan_maintenance='$tanggal_ini' and teknisi_maintenance.id_teknisi='$login_id_teknisi' and teknisi_maintenance.status='Antrian' or teknisi_maintenance.tanggal_penjadwalan_maintenance='$tanggal_ini' and teknisi_maintenance.partner='$login_id_teknisi' and teknisi_maintenance.status='Antrian'");
    $data = mysqli_num_rows($query);
    return $data;
  }








  function select_permintaan_pemasangan() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = $_SESSION['id_user'];

    $query = mysqli_query($koneksi,"select * from sale_register where status='Penjadwalan'");
    $data = mysqli_num_rows($query);
    return $data;
  }

  function select_jadwal_pemasangan() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = $_SESSION['id_user'];

    $query = mysqli_query($koneksi,"select * from sale_register where id_teknisi='$login_id_teknisi' and status='Order Alat' or id_teknisi='$login_id_teknisi' and status='Alat Siap' or partner='$login_id_teknisi' and status='Order Alat' or partner='$login_id_teknisi' and status='Alat Siap'");
    $data = mysqli_num_rows($query);
    return $data;
  }

  function select_antrian_penagihan() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = $_SESSION['id_user'];

    $query = mysqli_query($koneksi,"select * from sale_register where id_teknisi='$login_id_teknisi' and status='Trial' or id_teknisi='$login_id_teknisi' and status='Pasca-Trial'");
    $data = mysqli_num_rows($query);
    return $data;
  }

  function select_antrian_penagihan_partner() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = $_SESSION['id_user'];

    $query = mysqli_query($koneksi,"select * from sale_register where partner='$login_id_teknisi' and status='Trial' or partner='$login_id_teknisi' and status='Pasca-Trial'");
    $data = mysqli_num_rows($query);
    return $data;
  }

  function select_data_pemasangan() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = $_SESSION['id_user'];

    $query = mysqli_query($koneksi,"select * from sale_register where id_teknisi='$login_id_teknisi' and status='Pasca-Trial' or id_teknisi='$login_id_teknisi' and status='Close' or id_teknisi='$login_id_teknisi' and status='Hold'");
    $data = mysqli_num_rows($query);
    return $data;
  }

  function select_data_pemasangan_partner() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = $_SESSION['id_user'];

    $query = mysqli_query($koneksi,"select * from sale_register where partner='$login_id_teknisi' and status='Close' or partner='$login_id_teknisi' and status='Hold'");
    $data = mysqli_num_rows($query);
    return $data;
  }

  function select_permintaan_maintenance() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = $_SESSION['id_user'];

    $query = mysqli_query($koneksi,"select * from teknisi_maintenance where status='Penjadwalan'");
    $data = mysqli_num_rows($query);
    return $data;
  }

  function select_jadwal_maintenance() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = $_SESSION['id_user'];

    $query = mysqli_query($koneksi,"select * from teknisi_maintenance where id_teknisi='$login_id_teknisi' and status='Antrian' or partner='$login_id_teknisi' and status='Antrian'");
    $data = mysqli_num_rows($query);
    return $data;
  }

  function select_data_maintenance() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = $_SESSION['id_user'];

    $query = mysqli_query($koneksi,"select * from teknisi_maintenance where id_teknisi='$login_id_teknisi' and status='Selesai'");
    $data = mysqli_num_rows($query);
    return $data;
  }

  function select_data_maintenance_partner() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = $_SESSION['id_user'];

    $query = mysqli_query($koneksi,"select * from teknisi_maintenance where partner='$login_id_teknisi' and status='Selesai'");
    $data = mysqli_num_rows($query);
    return $data;
  }
}

class select {
  function salect_permintaan_pemasangan() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select * from sale_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing where sale_register.status='Penjadwalan' order by sale_register.tanggal_register");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_page_penjadwalan($id_register) {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select * from sale_register where sale_register.id_register='$id_register'");
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

  function select_data_sale_antena() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select * from sale_antena");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_data_sale_cpe() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select * from sale_cpe");
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

  function select_data_sale_radio() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select * from sale_radio");
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

  function select_jadwal_pemasangan() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = $_SESSION['id_user'];

    $query = mysqli_query($koneksi,"select * from sale_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing where id_teknisi='$login_id_teknisi' and status='Order Alat' or id_teknisi='$login_id_teknisi' and status='Alat Siap' or partner='$login_id_teknisi' and status='Order Alat' or partner='$login_id_teknisi' and status='Alat Siap'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_data_pemasangan() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = $_SESSION['id_user'];

    $query=mysqli_query($koneksi,"select * from sale_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing left join label_gedung on sale_register.id_bts=label_gedung.id where sale_register.id_teknisi='$login_id_teknisi' and sale_register.status='Trial' or sale_register.id_teknisi='$login_id_teknisi' and sale_register.status='Close' or sale_register.id_teknisi='$login_id_teknisi' and sale_register.status='Pasca-Trial' or sale_register.id_teknisi='$login_id_teknisi' and sale_register.status='Hold' or sale_register.partner='$login_id_teknisi' and sale_register.status='Trial' or sale_register.partner='$login_id_teknisi' and sale_register.status='Close' or sale_register.partner='$login_id_teknisi' and sale_register.status='Pasca-Trial' or sale_register.partner='$login_id_teknisi' and sale_register.status='Hold'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_data_teknisi() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = $_SESSION['id_user'];

    $query=mysqli_query($koneksi,"select * from master_login where level='TEKNISI'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_data_bts() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"SELECT * FROM mon_databts ORDER BY nama_bts");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_data_permintaan_maintenance() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = $_SESSION['id_user'];

    $query=mysqli_query($koneksi,"select * from teknisi_maintenance left join sale_register on teknisi_maintenance.id_register=sale_register.id_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing where teknisi_maintenance.status='Penjadwalan'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_jadwal_maintenance() {
    include "../../koneksi/koneksi.php";
      $login_id_teknisi = "";

    if($_GET['data']=="pribadi") {
      $login_id_teknisi = $_SESSION['id_user'];
    }

    $query=mysqli_query($koneksi,"select * from teknisi_maintenance left join sale_register on teknisi_maintenance.id_register=sale_register.id_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing where teknisi_maintenance.status='Antrian' and teknisi_maintenance.id_teknisi like '%$login_id_teknisi%' or teknisi_maintenance.status='Antrian' and teknisi_maintenance.partner like '%$login_id_teknisi%'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_data_maintenance() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = $_SESSION['id_user'];

    $query=mysqli_query($koneksi,"select * from teknisi_maintenance left join sale_register on teknisi_maintenance.id_register=sale_register.id_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing where teknisi_maintenance.status='Selesai' and teknisi_maintenance.id_teknisi='$login_id_teknisi' or teknisi_maintenance.status='Selesai' and teknisi_maintenance.partner='$login_id_teknisi'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_user_input_komplen() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select * from sale_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_data_teknisi_untuk_kalender() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select * from master_login where level='TEKNISI'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }
}

class update {
  function proses_penjadwalan() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = $_SESSION['id_user'];
    
    $id_register = $_POST['id_register'];
    $tanggal_penjadwalan = $_POST['tanggal_penjadwalan'];
    $id_radio = $_POST['id_radio'];
    $jumlah_radio = $_POST['jumlah_radio'];
    $status_radio = $_POST['status_radio'];

    $id_antena = $_POST['id_antena'];
    $jumlah_antena = $_POST['jumlah_antena'];
    $status_antena = $_POST['status_antena'];

    $id_wifi = $_POST['id_wifi'];
    $jumlah_wifi = $_POST['jumlah_wifi'];
    $status_wifi = $_POST['status_wifi'];

    $id_tower = $_POST['id_tower'];
    $jumlah_tower = $_POST['jumlah_tower'];
    $status_tower = $_POST['status_tower'];

    $id_kabel = $_POST['id_kabel'];
    $panjang_kabel = $_POST['panjang_kabel'];
    $status_kabel = $_POST['status_kabel'];

    mysqli_query($koneksi, "update sale_register set tanggal_penjadwalan='$tanggal_penjadwalan', id_radio='$id_radio', jumlah_radio='$jumlah_radio', status_radio='$status_radio', id_antena='$id_antena', jumlah_antena='$jumlah_antena', status_antena='$status_antena', id_wifi='$id_wifi', jumlah_wifi='$jumlah_wifi', status_wifi='$status_wifi', id_tower='$id_tower', jumlah_tower='$jumlah_tower', status_tower='$status_tower', id_kabel='$id_kabel', panjang_kabel='$panjang_kabel', status_kabel='$status_kabel', status='Order Alat', id_teknisi='$login_id_teknisi' where id_register='$id_register'");
  }

  function proses_rubah_jadwal() {
    include "../../koneksi/koneksi.php";

    $id_register=$_POST['id_register'];
    $tanggal_penjadwalan=$_POST['tanggal_penjadwalan'];

    mysqli_query($koneksi,"Update sale_register set tanggal_penjadwalan='$tanggal_penjadwalan' where id_register='$id_register'");
  }

  function proses_konfirmasi_pemasangan_selesai() {
    include "../../koneksi/koneksi.php";

    $id_register=$_POST['id_register'];
    $ip=$_POST['ip'];
    $id_bts=$_POST['id_bts'];
    $ip_public=$_POST['ip_public'];
    $tanggal_pemasangan=date('Y-m-d');
    $tanggal_trial=date('Y-m-d', strtotime('+3 days', strtotime($tanggal_pemasangan)));

    $tanggal_trial;
    mysqli_query($koneksi,"update sale_register set ip='$ip', id_bts='$id_bts', data_ip_publik='$ip_public', status='Trial', tanggal_pemasangan='$tanggal_pemasangan', tanggal_trial='$tanggal_trial' where id_register='$id_register'");
  }

  function proses_konfirmasi_pemasangan_batal() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = "";
    
    $id_register = $_POST['id_register'];
    $tanggal_penjadwalan = "0000-00-00";
    
    mysqli_query($koneksi, "update sale_register set tanggal_penjadwalan='$tanggal_penjadwalan', status='Penjadwalan', id_teknisi='$login_id_teknisi' where id_register='$id_register'");
  }

  function proses_penjadwalan_maintenance() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = $_SESSION['id_user'];
    
    $id_maintenance = $_POST['id_maintenance'];
    $kerusakan = $_POST['kerusakan'];
    $tanggal_penjadwalan_maintenance = $_POST['tanggal_penjadwalan_maintenance'];
    $solusi = $_POST['solusi'];
    
    mysqli_query($koneksi, "update teknisi_maintenance set tanggal_penjadwalan_maintenance='$tanggal_penjadwalan_maintenance', status='Antrian', id_teknisi='$login_id_teknisi', kerusakan='$kerusakan', solusi='$solusi' where id_maintenance='$id_maintenance'");
  }

  function proses_edit_data_maintenance() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = $_SESSION['id_user'];
    
    $id_maintenance = $_POST['id_maintenance'];
    $kerusakan = $_POST['kerusakan'];
    $tanggal_penjadwalan_maintenance = $_POST['tanggal_penjadwalan_maintenance'];
    $solusi = $_POST['solusi'];
    
    mysqli_query($koneksi, "update teknisi_maintenance set tanggal_penjadwalan_maintenance='$tanggal_penjadwalan_maintenance', status='Antrian', id_teknisi='$login_id_teknisi', kerusakan='$kerusakan', solusi='$solusi' where id_maintenance='$id_maintenance'");
  }

  function proses_konfirmasi_maintenance_selesai() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = $_SESSION['id_user'];
    
    $id_maintenance = $_POST['id_maintenance'];
    $kerusakan = $_POST['kerusakan'];
    $solusi = $_POST['solusi']." (".$_SESSION['nama_user'].")\r\n";
    $tanggal_penanganan_maintenance = date('Y-m-d');
    
    mysqli_query($koneksi, "update teknisi_maintenance set tanggal_penanganan_maintenance='$tanggal_penanganan_maintenance', status='Selesai', id_teknisi='$login_id_teknisi', kerusakan='$kerusakan', solusi='$solusi', status_kunjungan='KUNJUNGAN' where id_maintenance='$id_maintenance'");
  }

  function proses_konfirmasi_maintenance_batal() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = "";
    
    $id_maintenance = $_POST['id_maintenance'];
    $tanggal_penjadwalan_maintenance = "0000-00-00";
    $login_id_teknisi = "";
    
    mysqli_query($koneksi, "update teknisi_maintenance set tanggal_penjadwalan_maintenance='$tanggal_penjadwalan_maintenance', status='Penjadwalan', id_teknisi='$login_id_teknisi' where id_maintenance='$id_maintenance'");
  }

  function proses_edit_data_pemasangan($ip, $id_bts, $id_register) {
    include "../../koneksi/koneksi.php";

    mysqli_query($koneksi,"update sale_register set ip='$ip', id_bts='$id_bts' where id_register='$id_register'");
  }
}

class input {
  function proses_input_komplen() {
    include "../../koneksi/koneksi.php";

    $id_register = $_POST['id_register'];
    $kerusakan = $_POST['kerusakan'];
    $tanggal_komplen = date('Y-m-d');

    mysqli_query($koneksi,"insert into teknisi_maintenance (id_register, kerusakan, status, tanggal_komplen) values ('$id_register', '$kerusakan', 'Penjadwalan', '$tanggal_komplen')");
  }
}
?>