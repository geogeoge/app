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
	function select_data_user_prospek($login_id_marketing) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_user_prospek where id_marketing='$login_id_marketing' order by id_prospek DESC");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}
}

class dashboard {
  function select_jadwal_pemasangan_lewat_tangal() {
    include "../../koneksi/koneksi.php";
    $tanggal_ini = date('Y-m-d');;

    $query=mysqli_query($koneksi,"select * from sale_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing where tanggal_penjadwalan not like '0000-00-00' and tanggal_penjadwalan<'$tanggal_ini' and status='Order Alat' or tanggal_penjadwalan not like '0000-00-00' and tanggal_penjadwalan<'$tanggal_ini' and status='Alat Siap'");
    
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function jumlah_jadwal_pemasangan_lewat_tangal() {
    include "../../koneksi/koneksi.php";
    $tanggal_ini = date('Y-m-d');;

    $query=mysqli_query($koneksi,"select * from sale_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing where tanggal_penjadwalan not like '0000-00-00' and tanggal_penjadwalan<'$tanggal_ini' and status='Order Alat' or tanggal_penjadwalan not like '0000-00-00' and tanggal_penjadwalan<'$tanggal_ini' and status='Alat Siap'");
    $data = mysqli_num_rows($query);
    return $data;
  }

}

class select {
  function salect_permintaan_pemasangan() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select * from sale_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing where sale_register.tanggal_penjadwalan='0000-00-00' order by sale_register.tanggal_register");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function jumlah_permintaan_pemasangan() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select * from sale_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing where sale_register.tanggal_penjadwalan='0000-00-00' order by sale_register.tanggal_register");
    $data = mysqli_num_rows($query);
    return $data;
  }

  function jumlah_permintaan_maintenance() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select * from teknisi_maintenance where status='Penjadwalan'");
    $data = mysqli_num_rows($query);
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

    $query=mysqli_query($koneksi,"select * from sale_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing where tanggal_penjadwalan not like '0000-00-00' and status='Order Alat' or tanggal_penjadwalan not like '0000-00-00' and status='Alat Siap'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_data_pemasangan() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = $_SESSION['id_user'];

    $query=mysqli_query($koneksi,"select * from sale_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing where tanggal_pemasangan not like '0000-00-00'");
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

    $query=mysqli_query($koneksi,"select * from label_gedung");
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
    $login_id_teknisi = $_SESSION['id_user'];

    $query=mysqli_query($koneksi,"select * from teknisi_maintenance left join sale_register on teknisi_maintenance.id_register=sale_register.id_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing where teknisi_maintenance.status='Antrian'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_data_maintenance() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = $_SESSION['id_user'];

    $query=mysqli_query($koneksi,"select * from teknisi_maintenance left join sale_register on teknisi_maintenance.id_register=sale_register.id_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing where teknisi_maintenance.status='Selesai'");
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
  function proses_penjadwalan($id_register, $tanggal_penjadwalan, $id_teknisi, $partner) {
    include "../../koneksi/koneksi.php";

    mysqli_query($koneksi, "update sale_register set tanggal_penjadwalan='$tanggal_penjadwalan', id_teknisi='$id_teknisi', partner='$partner' where id_register='$id_register'");
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
    $partner=$_POST['partner'];
    $tanggal_pemasangan=date('Y-m-d');
    $tanggal_trial=date('Y-m-d', strtotime('+3 days', strtotime($tanggal_pemasangan)));

    $tanggal_trial;
    mysqli_query($koneksi,"update sale_register set ip='$ip', id_bts='$id_bts', partner='$partner', status='Trial', tanggal_pemasangan='$tanggal_pemasangan', tanggal_trial='$tanggal_trial' where id_register='$id_register'");
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
    $id_teknisi = $_POST['teknisi'];
    $partner = $_POST['partner'];
    
    $id_maintenance = $_POST['id_maintenance'];
    $kerusakan = $_POST['kerusakan'];
    $tanggal_penjadwalan_maintenance = $_POST['tanggal_penjadwalan_maintenance'];
    $solusi = $_POST['solusi'];
    
    mysqli_query($koneksi, "update teknisi_maintenance set tanggal_penjadwalan_maintenance='$tanggal_penjadwalan_maintenance', status='Antrian', id_teknisi='$id_teknisi', partner='$partner', kerusakan='$kerusakan', solusi='$solusi' where id_maintenance='$id_maintenance'");
  }

  function proses_edit_data_maintenance() {
    include "../../koneksi/koneksi.php";
    
    $id_maintenance = $_POST['id_maintenance'];
    $kerusakan = $_POST['kerusakan'];
    $tanggal_penjadwalan_maintenance = $_POST['tanggal_penjadwalan_maintenance'];
    $solusi = $_POST['solusi'];
    $id_teknisi = $_POST['teknisi'];
    $partner = $_POST['partner'];
    
    mysqli_query($koneksi, "update teknisi_maintenance set tanggal_penjadwalan_maintenance='$tanggal_penjadwalan_maintenance', status='Antrian', id_teknisi='$id_teknisi', partner='$partner', kerusakan='$kerusakan', solusi='$solusi' where id_maintenance='$id_maintenance'");
  }

  function proses_konfirmasi_maintenance_selesai() {
    include "../../koneksi/koneksi.php";
    $login_id_teknisi = $_SESSION['id_user'];
    
    $id_maintenance = $_POST['id_maintenance'];
    $kerusakan = $_POST['kerusakan'];
    $partner = $_POST['partner'];
    $solusi = $_POST['solusi'];
    $tanggal_penanganan_maintenance = date('Y-m-d');
    
    mysqli_query($koneksi, "update teknisi_maintenance set partner='$partner', tanggal_penanganan_maintenance='$tanggal_penanganan_maintenance', status='Selesai', id_teknisi='$login_id_teknisi', kerusakan='$kerusakan', solusi='$solusi' where id_maintenance='$id_maintenance'");
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

class delete {
    function delete_permintaan_maintenance(){
        include "../../koneksi/koneksi.php";
        
        $id_maintenance=$_POST['id_maintenance'];
        mysqli_query($koneksi,"delete from teknisi_maintenance where id_maintenance='$id_maintenance'");
    }
}
?>