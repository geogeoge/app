'<?php
class crud {
	function posting($query_id_temp, $id_account_2) {
		include "../../koneksi/koneksi.php";

        $query_data_temp = mysqli_query($koneksi,"SELECT * FROM data_temp WHERE id_temp='$query_id_temp'");
        $data_temp = mysqli_fetch_array($query_data_temp);
        $tanggal = date('Y-m-d', strtotime($data_temp['tanggal']));
        $keterangan = $data_temp['keterangan'];
        $nominal = $data_temp['nominal'];
        $id_account_1 = $data_temp['id_account'];
        $ekstra = $data_temp['ekstra'];
        $in_out = $data_temp['in_out'];
        $pecah_tanggal = explode("-", $tanggal);
        $tanggal_gabung = implode("", $pecah_tanggal);

        if($in_out=='i'){
        	$debit = $id_account_1;
        	$kredit = $id_account_2;
        } else {
        	$debit = $id_account_2;
        	$kredit = $id_account_1;
        }

        $query_pencarian_dihari_yang_sama = mysqli_query($koneksi,"SELECT * FROM data_transaksi WHERE no_transaksi like '%$tanggal_gabung%' ORDER BY no_transaksi DESC LIMIT 1");
        $jumlah_pencarian_dihari_yang_sama = mysqli_num_rows($query_pencarian_dihari_yang_sama);
        if($jumlah_pencarian_dihari_yang_sama>=1){
          $data_pencarian_dihari_yang_sama = mysqli_fetch_array($query_pencarian_dihari_yang_sama);

          $no_transaksi_terakhir = $data_pencarian_dihari_yang_sama['no_transaksi'];
          $pecah_no_transaksi_terakhir = explode(".", $no_transaksi_terakhir);
          $id_pecah_no_transaksi_terakhir = $pecah_no_transaksi_terakhir['1'];
          $id_pecah_no_transaksi_terakhir = $id_pecah_no_transaksi_terakhir + 1;

          if($id_pecah_no_transaksi_terakhir<=9){
            $id_pecah_no_transaksi_terakhir = "000".$id_pecah_no_transaksi_terakhir;
          } else
          if($id_pecah_no_transaksi_terakhir<=99){
            $id_pecah_no_transaksi_terakhir = "00".$id_pecah_no_transaksi_terakhir;
          } else
          if($id_pecah_no_transaksi_terakhir<=999){
            $id_pecah_no_transaksi_terakhir = "0".$id_pecah_no_transaksi_terakhir;
          }
          $no_transaksi = $tanggal_gabung.".".$id_pecah_no_transaksi_terakhir;
        } else {
          $no_transaksi = $tanggal_gabung.".0000";
        }

        $printah_debit = mysqli_query($koneksi,"INSERT INTO `data_transaksi`(`no_transaksi`, `tanggal`, `keterangan`, `nominal`, `id_account`, `DK`, `id_temp`, `ekstra`) VALUES ('$no_transaksi', '$tanggal', '$keterangan', '$nominal', '$debit', 'D', '$query_id_temp', '$ekstra')");
        $printah_kredit = mysqli_query($koneksi,"INSERT INTO `data_transaksi`(`no_transaksi`, `tanggal`, `keterangan`, `nominal`, `id_account`, `DK`, `id_temp`, `ekstra`) VALUES ('$no_transaksi', '$tanggal', '$keterangan', '$nominal', '$kredit', 'K', '$query_id_temp', '$ekstra')");

        if($printah_kredit && $printah_debit){
          $printah_hapus = mysqli_query($koneksi,"UPDATE `data_temp` SET status='sudah' WHERE id_temp='$query_id_temp'");
        }
	}

	function input_data_temp($tanggal,$keterangan,$no_log_pembayaran,$nominal,$id_account,$in_out,$status,$ekstra) {
		include "../../koneksi/koneksi.php";

		mysqli_query($koneksi, "INSERT INTO `data_temp`(`tanggal`, `keterangan`, `no_log_pembayaran`, `nominal`, `id_account`, `in_out`, `status`, `ekstra`) VALUES ('$tanggal', '$keterangan', '$no_log_pembayaran', '$nominal', '$id_account', '$in_out', '$status', '$ekstra')") or die(mysqli_error());
	}

	function input_data_temp_posting($tanggal,$keterangan,$no_log_pembayaran,$nominal,$id_account_1,$in_out,$status,$ekstra,$id_account_2) {
		include "../../koneksi/koneksi.php";

		mysqli_query($koneksi, "INSERT INTO `data_temp`(`tanggal`, `keterangan`, `no_log_pembayaran`, `nominal`, `id_account`, `in_out`, `status`, `ekstra`) VALUES ('$tanggal', '$keterangan', '$no_log_pembayaran', '$nominal', '$id_account_1', '$in_out', '$status', '$ekstra')") or die(mysqli_error());

		$query_temp_terakhir = mysqli_query($koneksi,"SELECT * FROM `data_temp` ORDER BY `id_temp` DESC LIMIT 1");
		$data_temp_terakhir = mysqli_fetch_array($query_temp_terakhir);
		$id_temp_terakhir = $data_temp_terakhir['id_temp'];

		$this->posting($id_temp_terakhir, $id_account_2);
	}

	//----------------------------------------Function Select----------------------------------------\\
	function select_detail_user_prospek($id_prospek) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_user_prospek where id_prospek='$id_prospek' order by id_prospek DESC");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_data_user_pasca_trial($login_id_marketing) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register where id_marketing='$login_id_marketing' and status='Pasca-Trial' order by status Desc, tanggal_register Asc, tanggal_trial");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_data_user_trial($login_id_marketing) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register where id_marketing='$login_id_marketing' and status='Trial' order by status Desc, tanggal_register Asc, tanggal_trial");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_data_user_trial_semua($login_id_marketing) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register where id_marketing='$login_id_marketing' and status='Penjadwalan' or id_marketing='$login_id_marketing' and status='Order Alat' or id_marketing='$login_id_marketing' and status='Alat Siap' or id_marketing='$login_id_marketing' and status='Trial' order by status Desc, tanggal_register Asc, tanggal_trial");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_data_user_alat_siap($login_id_marketing) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register where id_marketing='$login_id_marketing' and status='Alat Siap' order by status Desc, tanggal_register Asc, tanggal_trial");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_data_user_order_alat($login_id_marketing) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register where id_marketing='$login_id_marketing' and status='Order Alat' order by status Desc, tanggal_register Asc, tanggal_trial");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_data_user_penjadwalan($login_id_marketing) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register where id_marketing='$login_id_marketing' and status='Penjadwalan' order by tanggal_register Asc, tanggal_trial");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	// function select_data_user_order_alat($login_id_marketing) {
	// 	include "../../koneksi/koneksi.php";

	// 	$query=mysqli_query($koneksi,"select * from sale_register where id_marketing='$login_id_marketing' and status='Trial' or id_marketing='$login_id_marketing' and status='Order Alat' or id_marketing='$login_id_marketing' and status='Alat Siap' or id_marketing='$login_id_marketing' and status='Penjadwalan' order by status Desc, tanggal_register Asc, tanggal_trial");
	// 	while($tampil=mysqli_fetch_array($query))
	// 	$data[]=$tampil;
	// 	return $data;
	// }

	function select_detail_user_trial($id_register) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register where id_register='$id_register'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_data_user_close($login_id_marketing) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register left join sale_paket_internet on sale_register.id_paket=sale_paket_internet.id_paket where sale_register.id_marketing='$login_id_marketing' and sale_register.status='Close' order by sale_register.id_register DESC");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_data_user_hold($login_id_marketing) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register where sale_register.id_marketing='$login_id_marketing' and sale_register.status='Hold' order by sale_register.id_register DESC");
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

	function select_data_sale_paket() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_paket_internet where status_paket='BUKA'");
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

	function total_user_prospek($login_id_marketing) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"SElECT * FROM sale_user_prospek where id_marketing='$login_id_marketing'");
		$jumlah_query=mysqli_num_rows($query);
		return $jumlah_query;
	}

	function total_user_trial($login_id_marketing) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"SElECT * FROM sale_register where status='Trial' and id_marketing='$login_id_marketing'");
		$jumlah_query=mysqli_num_rows($query);
		return $jumlah_query;
	}

	function total_user_close($login_id_marketing) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"SElECT * FROM sale_register where status='Close' and id_marketing='$login_id_marketing'");
		$jumlah_query=mysqli_num_rows($query);
		return $jumlah_query;
	}

	function total_user_yang_harus_close($login_id_marketing) {
		include "../../koneksi/koneksi.php";

		$tanggal_hari_ini=date('Y-m-d');
		$query=mysqli_query($koneksi,"SELECT * FROM sale_register WHERE status='Trial' and id_marketing='$login_id_marketing' and tanggal_trial <= '$tanggal_hari_ini'");
		$menghitung_query=mysqli_num_rows($query);
		return $menghitung_query;
	}

	function total_user_hold_bulan_ini($login_id_marketing) {
		include "../../koneksi/koneksi.php";

		$tanggal_awal = date('Y-m-')."01";
		$tanggal_akhir = date('Y-m-')."31";
		$tanggal_hari_ini=date('Y-m-d');
		$query=mysqli_query($koneksi,"SELECT * FROM sale_register WHERE status='Hold' and id_marketing='$login_id_marketing' and tanggal_hold between '$tanggal_awal' and '$tanggal_akhir'");
		$menghitung_query=mysqli_num_rows($query);
		return $menghitung_query;
	}

	function data_user_yang_harus_close($login_id_marketing) {
		include "../../koneksi/koneksi.php";

		$tanggal_hari_ini=date('Y-m-d');
		$query=mysqli_query($koneksi,"SELECT * FROM sale_register WHERE status='Trial' and id_marketing='$login_id_marketing' and tanggal_trial <= '$tanggal_hari_ini'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function data_user_hold_bulan_ini($login_id_marketing) {
		include "../../koneksi/koneksi.php";

		$tanggal_awal = date('Y-m-')."01";
		$tanggal_akhir = date('Y-m-')."31";
		$tanggal_hari_ini=date('Y-m-d');
		$query=mysqli_query($koneksi,"SELECT * FROM sale_register WHERE status='Hold' and id_marketing='$login_id_marketing' and tanggal_hold between '$tanggal_awal' and '$tanggal_akhir'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}
	//--------------------------------------! Function Select !--------------------------------------\\
	//----------------------------------------Function Insert----------------------------------------\\
	function insert_user_prospek($login_id_marketing) {
		include "../../koneksi/koneksi.php";

		$nik=$_POST['nik'];
		$nama_user=strtoupper($_POST['nama_user']);
		$nama_instansi=$_POST['nama_instansi'];
		$telp=$_POST['telp'];
		$email=$_POST['email'];
		$alamat_1=$_POST['alamat_1'];
		$alamat_2=$_POST['alamat_2'];
		$alamat_3=$_POST['alamat_3'];
		$alamat_4=$_POST['alamat_4'];
		$alamat_5=$_POST['alamat_5'];
		$alamat_6=$_POST['alamat_6'];
		$alamat=$alamat_1."#".$alamat_2."#".$alamat_3."#".$alamat_4."#".$alamat_5."#".$alamat_6;
		$koordinat=addslashes($_POST['koordinat']);
		$id_marketing=$login_id_marketing;
		$catatan=$_POST['catatan'];
		$tanggal_prospek=date('Y-m-d');

		$query_user_prospek=mysqli_query($koneksi,"select * from sale_user_prospek order by id_prospek DESC limit 1");
		$tampil_user_prospek=mysqli_fetch_array($query_user_prospek);
		$id_prospek=$tampil_user_prospek['id_prospek'];
		if($id_prospek=="") {
			$id_prospek="P001";
		} else {
			$id_prospek++;
		}

		$query=mysqli_query($koneksi,"insert into sale_user_prospek (id_prospek, tanggal_prospek, nik, nama_user, nama_instansi, telp, email, alamat, koordinat, id_marketing, catatan) values ('$id_prospek', '$tanggal_prospek', '$nik', '$nama_user', '$nama_instansi', '$telp', '$email', '$alamat', '$koordinat', '$id_marketing', '$catatan')");
	}

	function insert_user_trial($login_id_marketing) {
		include "../../koneksi/koneksi.php";

		$query_sale_register=mysqli_query($koneksi,"select * from sale_register order by id_register DESC limit 1");
		$tampil_sale_register=mysqli_fetch_array($query_sale_register);
		$id_register=$tampil_sale_register['id_register'];
		if($id_register=="") {
		$id_register="U001";
		} else {
		$id_register++;
		}

		$id_prospek=$_POST['id_prospek'];
	    $nik=$_POST['nik'];
	    $nama_user=strtoupper($_POST['nama_user']);
	    $nama_instansi=$_POST['nama_instansi'];
	    $jenis_kelamin=$_POST['jenis_kelamin'];
	    $tempat_lahir=$_POST['tempat_lahir'];
	    $tanggal_lahir=$_POST['tanggal_lahir'];
	    $telp=$_POST['telp'];
	    $email=$_POST['email'];
	    $alamat_1=$_POST['alamat_1'];
	    $alamat_2=$_POST['alamat_2'];
	    $alamat_3=$_POST['alamat_3'];
	    $alamat_4=$_POST['alamat_4'];
	    $alamat_5=$_POST['alamat_5'];
	    $alamat_6=$_POST['alamat_6'];
	    $alamat=$alamat_1."#".$alamat_2."#".$alamat_3."#".$alamat_4."#".$alamat_5."#".$alamat_6;
	    $koordinat=addslashes($_POST['koordinat']);
	    $id_marketing=$login_id_marketing;
	    $status="Alat Siap";
	    $catatan=$_POST['catatan'];
	    $tanggal_register=date('Y-m-d');
	    
	    $id_paket=$_POST['id_paket'];
	    $ip_publik=$_POST['ip_publik'];
	    $biaya_registrasi=$_POST['biaya_registrasi'];

	    $id_bts=$_POST['id_bts'];

	    $id_radio=$_POST['id_radio'];
	    $jumlah_radio=$_POST['jumlah_radio'];
	    $status_radio=$_POST['status_radio'];
	    $harga_radio="0";

	    $id_antena=$_POST['id_antena'];
	    $jumlah_antena=$_POST['jumlah_antena'];
	    $status_antena=$_POST['status_antena'];
	    $harga_antena="0";

	    $id_wifi=$_POST['id_wifi'];
	    $jumlah_wifi=$_POST['jumlah_wifi'];
	    $status_wifi=$_POST['status_wifi'];
	    $harga_wifi="0";

		$id_tower=$_POST['id_tower'];
	    $jumlah_tower=$_POST['jumlah_tower'];
	    $status_tower=$_POST['status_tower'];
	    $harga_tower="0";

	    $id_kabel=$_POST['id_kabel'];
	    $panjang_kabel=$_POST['panjang_kabel'];
	    $status_kabel=$_POST['status_kabel'];
	    $harga_kabel="0";

	    $tambahan_1=$_POST['tambahan_1'];
	    $jumlah_tambahan_1=$_POST['jumlah_tambahan_1'];
	    $status_tambahan_1=$_POST['status_tambahan_1'];
	    $harga_tambahan_1="0";

	    $tambahan_2=$_POST['tambahan_2'];
	    $jumlah_tambahan_2=$_POST['jumlah_tambahan_2'];
	    $status_tambahan_2=$_POST['status_tambahan_2'];
	    $harga_tambahan_2="0";

	    mysqli_query($koneksi,"INSERT INTO `sale_register` (`ip_publik`, `id_register`, `nik`, `nama_user`, `nama_instansi`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `telp`, `email`, `alamat`, `koordinat`, `status`, `id_marketing`, `tanggal_register`, `id_paket`, `id_bts`, `id_radio`, `jumlah_radio`, `harga_radio`, `status_radio`, `id_antena`, `jumlah_antena`, `harga_antena`, `status_antena`, `id_wifi`, `jumlah_wifi`, `harga_wifi`, `status_wifi`, `id_kabel`, `panjang_kabel`, `harga_kabel`, `status_kabel`, `id_tower`, `jumlah_tower`, `harga_tower`, `status_tower`, `biaya_registrasi`, `billing_bulan_berjalan`, `billing_bulan_terbayar`, `billing_saldo`, `billing_total_bayar`, `billing_total_restitusi`, `tambahan_1`, `jumlah_tambahan_1`, `status_tambahan_1`, `harga_tambahan_1`, `tambahan_2`, `jumlah_tambahan_2`, `status_tambahan_2`, `harga_tambahan_2`) VALUES ('$ip_publik', '$id_register', '$nik', '$nama_user', '$nama_instansi', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$telp', '$email', '$alamat', '$koordinat', '$status', '$id_marketing', '$tanggal_register', '$id_paket', '$id_bts', '$id_radio', '$jumlah_radio', '$harga_radio', '$status_radio', '$id_antena', '$jumlah_antena', '$harga_antena', '$status_antena', '$id_wifi', '$jumlah_wifi', '$harga_wifi', '$status_wifi', '$id_kabel', '$panjang_kabel', '$harga_kabel', '$status_kabel', '$id_tower', '$jumlah_tower', '$harga_tower', '$status_tower', '$biaya_registrasi', '1', '1', '0', '0', '0', '$tambahan_1', '$jumlah_tambahan_1', '$status_tambahan_1', '$harga_tambahan_1', '$tambahan_2', '$jumlah_tambahan_2', '$status_tambahan_2', '$harga_tambahan_2')");

	    mysqli_query($koneksi,"DELETE FROM sale_user_prospek where id_prospek='$id_prospek'");

	    header('location:?page=page_data_user_trial_semua');
	}
	//--------------------------------------! Function Insert !--------------------------------------\\
	//----------------------------------------Function Hapus----------------------------------------\\
	function hapus_data_paket() {
		include "../../koneksi/koneksi.php";

		$id_paket=$_POST['id_paket'];

		mysqli_query($koneksi,"delete from paket_internet where id_paket='$id_paket'");
	}
	//--------------------------------------! Function Hapus !--------------------------------------\\
	//----------------------------------------Function Update----------------------------------------\\
	function update_user_trial() {
		include "../../koneksi/koneksi.php";

		$id_register=$_POST['id_register'];
	    $nik=$_POST['nik'];
	    $nama_user=strtoupper($_POST['nama_user']);
	    $nama_instansi=$_POST['nama_instansi'];
	    $jenis_kelamin=$_POST['jenis_kelamin'];
	    $tempat_lahir=$_POST['tempat_lahir'];
	    $tanggal_lahir=$_POST['tanggal_lahir'];
	    $telp=$_POST['telp'];
	    $email=$_POST['email'];
	    $alamat_1=$_POST['alamat_1'];
	    $alamat_2=$_POST['alamat_2'];
	    $alamat_3=$_POST['alamat_3'];
	    $alamat_4=$_POST['alamat_4'];
	    $alamat_5=$_POST['alamat_5'];
	    $alamat_6=$_POST['alamat_6'];
	    $alamat=$alamat_1."#".$alamat_2."#".$alamat_3."#".$alamat_4."#".$alamat_5."#".$alamat_6;
	    $koordinat=addslashes($_POST['koordinat']);
	    $id_marketing=$login_id_marketing;
	    $status="Trial";
	    $catatan=$_POST['catatan'];
	    
	    $id_paket=$_POST['id_paket'];
	    $ip_publik=$_POST['ip_publik'];
	    $biaya_registrasi=$_POST['biaya_registrasi'];

	    $id_bts=$_POST['id_bts'];

	    $id_radio=$_POST['id_radio'];
	    $jumlah_radio=$_POST['jumlah_radio'];
	    $status_radio=$_POST['status_radio'];
	    $harga_radio=$_POST['harga_radio'];

	    $id_antena=$_POST['id_antena'];
	    $jumlah_antena=$_POST['jumlah_antena'];
	    $status_antena=$_POST['status_antena'];
	    $harga_antena=$_POST['harga_antena'];

	    $id_wifi=$_POST['id_wifi'];
	    $jumlah_wifi=$_POST['jumlah_wifi'];
	    $status_wifi=$_POST['status_wifi'];
	    $harga_wifi=$_POST['harga_wifi'];

		$id_tower=$_POST['id_tower'];
	    $jumlah_tower=$_POST['jumlah_tower'];
	    $status_tower=$_POST['status_tower'];
	    $harga_tower=$_POST['harga_tower'];

	    $id_kabel=$_POST['id_kabel'];
	    $panjang_kabel=$_POST['panjang_kabel'];
	    $status_kabel=$_POST['status_kabel'];
	    $harga_kabel=$_POST['harga_kabel'];

	    mysqli_query($koneksi,"UPDATE `sale_register` SET `ip_publik`='$ip_publik', `nik`='$nik', `nama_user`='$nama_user', `nama_instansi`='$nama_instansi', `jenis_kelamin`='$jenis_kelamin', `tempat_lahir`='$tempat_lahir', `tanggal_lahir`='$tanggal_lahir', `telp`='$telp', `email`='$email', `alamat`='$alamat', `koordinat`='$koordinat', `status`='$status', `id_paket`='$id_paket', `id_bts`='$id_bts', `id_radio`='$id_radio', `jumlah_radio`='$jumlah_radio', `harga_radio`='$harga_radio', `status_radio`='$status_radio', `id_antena`='$id_antena', `jumlah_antena`='$jumlah_antena', `harga_antena`='$harga_antena', `status_antena`='$status_antena', `id_wifi`='$id_wifi', `jumlah_wifi`='$jumlah_wifi', `harga_wifi`='$harga_wifi', `status_wifi`='$status_wifi', `id_tower`='$id_tower', `jumlah_tower`='$jumlah_tower', `harga_tower`='$harga_tower', `status_tower`='$status_tower', `id_kabel`='$id_kabel', `panjang_kabel`='$panjang_kabel', `harga_kabel`='$harga_kabel', `status_kabel`='$status_kabel', biaya_registrasi='$biaya_registrasi' WHERE id_register='$id_register'");

	    header('location:?page=page_data_user_trial_semua');
	}

	function update_perpanjang_trial() {
		include "../../koneksi/koneksi.php";

		$id_register=$_POST['id_register'];
		$perpanjang=$_POST['perpanjang'];

		$query_register=mysqli_query($koneksi,"select * from sale_register where id_register='$id_register'");
		$tampil_register=mysqli_fetch_array($query_register);
		$tanggal_trial=$tampil_register['tanggal_trial'];
		$tanggal_trial_baru=date('Y-m-d', strtotime($perpanjang, strtotime($tanggal_trial)));

		

		mysqli_query($koneksi,"update sale_register set tanggal_trial='$tanggal_trial_baru' where id_register='$id_register'");
	}

	function update_closing_trial() {
		include "../../koneksi/koneksi.php";

		$id_register=$_POST['id_register'];
		$tanggal_close_baru=date('Y-m-d');

		//mengambil data PO dari data tabel register
		$query_register=mysqli_query($koneksi,"select * from sale_register where id_register='$id_register'");
		$data_register=mysqli_fetch_array($query_register);

		$tanggal_registrasi=date('Y-m-d');

		//---------------------------------Proses money_fee----------------------------------------\\
		$id_paket=$data_register['id_paket'];

		//mencari data harga paket
		$query_paket=mysqli_query($koneksi,"select * from sale_paket_internet where id_paket='$id_paket'");
		$data_paket=mysqli_fetch_array($query_paket);
		$harga_paket=$data_paket['harga'];

		//mencari selisih tanggal dari registrasi sampai akhir bulan
		$tanggal=$tanggal_registrasi;
		$tanggal_1=new datetime($tanggal);
		$bulan_ditambah_satu=date('Y-m', strtotime('+1 month', strtotime($tanggal)));
		$tanggal_satu_bulan_depan=$bulan_ditambah_satu."-1";
		$tanggal_akhir_bulan=date('Y-m-d', strtotime('-1 days', strtotime($tanggal_satu_bulan_depan)));
		$tanggal_2=new datetime($tanggal_akhir_bulan);
		$selisih = $tanggal_1->diff($tanggal_2);
		$selisih_hari=$selisih->days;

		//mecari pecahan harga paket perharinya
		$jumlah_tanggal_bulan_ini=date('d', strtotime($tanggal_akhir_bulan));
		$harga_paket_perhari=$harga_paket / $jumlah_tanggal_bulan_ini;

		$money_fee = $harga_paket_perhari * $selisih_hari;
		//--------------------------------// roses money_fee \\--------------------------------------\\
		//---------------------------------Proses IP_Publik----------------------------------------\\
		$ip_publik=$data_register['ip_publik'];

		$biaya_ip_publik = "100000";
		$biaya_ip_publik = $biaya_ip_publik / $jumlah_tanggal_bulan_ini;
		$biaya_ip_publik = $biaya_ip_publik * $selisih_hari;

		if($ip_publik=="TIDAK") {
			$biaya_ip_publik = "0";
		}
		//--------------------------------// roses IP_Publik \\--------------------------------------\\



	    
	    $biaya_registrasi=$data_register['biaya_registrasi'];

	    $id_bts=$data_register['id_bts'];

	    $id_radio=$data_register['id_radio'];
	    $jumlah_radio=$data_register['jumlah_radio'];
	    $status_radio=$data_register['status_radio'];
	    $harga_radio=$data_register['harga_radio'];

	    $id_antena=$data_register['id_antena'];
	    $jumlah_antena=$data_register['jumlah_antena'];
	    $status_antena=$data_register['status_antena'];
	    $harga_antena=$data_register['harga_antena'];

	    $id_wifi=$data_register['id_wifi'];
	    $jumlah_wifi=$data_register['jumlah_wifi'];
	    $status_wifi=$data_register['status_wifi'];
	    $harga_wifi=$data_register['harga_wifi'];

		$id_tower=$data_register['id_tower'];
	    $jumlah_tower=$data_register['jumlah_tower'];
	    $status_tower=$data_register['status_tower'];
	    $harga_tower=$data_register['harga_tower'];

	    $id_kabel=$data_register['id_kabel'];
	    $panjang_kabel=$data_register['panjang_kabel'];
	    $status_kabel=$data_register['status_kabel'];
	    $harga_kabel=$data_register['harga_kabel'];

	    $status="Belum";

	    //ini digunain waktu billing_po masih digunakan untuk mencatat user baru
	    //mysqli_query($koneksi,"INSERT INTO `billing_po`(`id_register`, `biaya_registrasi`, `tanggal_registrasi`, `money_fee`, `biaya_ip_publik`, `id_radio`, `status_radio`, `jumlah_radio`, `harga_radio`, `id_antena`, `status_antena`, `jumlah_antena`, `harga_antena`, `id_wifi`, `status_wifi`, `jumlah_wifi`, `harga_wifi`, `id_kabel`, `status_kabel`, `panjang_kabel`, `harga_kabel`, `id_tower`, `status_tower`, `jumlah_tower`, `harga_tower`, `status_po`) VALUES ('$id_register', '$biaya_registrasi', '$tanggal_registrasi', '$money_fee', '$biaya_ip_publik', '$id_radio', '$status_radio', '$jumlah_radio', '$harga_radio', '$id_antena', '$status_antena', '$jumlah_antena', '$harga_antena', '$id_wifi', '$status_wifi', '$jumlah_wifi', '$harga_wifi', '$id_kabel', '$status_kabel', '$panjang_kabel', '$harga_kabel', '$id_tower', '$status_tower', '$jumlah_tower', '$harga_tower', '$status')");

		mysqli_query($koneksi,"update sale_register set tanggal_close='$tanggal_registrasi', monthly_fee='$money_fee', biaya_ip_publik='$biaya_ip_publik', status='Pasca-Trial' where id_register='$id_register'");

		//query ini di pake saat database lama masih menggunakan table billing tagihan, tp sekarang sudah tidak pakai karena tagihan sudha jadi satu dengan table register
		//mysqli_query($koneksi,"update into billing_tagihan (id_register, bulan_berjalan, bulan_terbayar, piutang, total_bayar, total_restitusi) value ('$id_register', '1', '1', '0', '0', '0')");
		$waktu_pembayaran = date('Y-m-d H:m:i');
		//Pembayaran Registrasi
    	$keterangan_post = "Tagihan Registrasi ( ".$data_register['nama_user']." ) | ".$data_register['id_register'];
	    $this->input_data_temp_posting($waktu_pembayaran, $keterangan_post, '', $biaya_registrasi, '3', 'i', 'belum', 'access', '32');

		//Pembayaran Pro Rata
    	$keterangan_post = "Tagihan Prorata ( ".$data_register['nama_user']." ) | ".$data_register['id_register'];
	    $this->input_data_temp_posting($waktu_pembayaran, $keterangan_post, '', $money_fee, '3', 'i', 'belum', 'access', '34');
	}

	function update_cancel_trial() {
		include "../../koneksi/koneksi.php";

		$id_register=$_POST['id_register'];
		$catatan=$_POST['catatan'];

		$query_register=mysqli_query($koneksi,"SELECT * FROM sale_register WHERE id_register='$id_register'");
		$tampil_register=mysqli_fetch_array($query_register);
		$nik=$tampil_register['nik'];
		$nama_user=$tampil_register['nama_user'];
		$nama_instansi=$tampil_register['nama_instansi'];
		$telp=$tampil_register['telp'];
		$email=$tampil_register['email'];
		$alamat=$tampil_register['alamat'];
		$koordinat=$tampil_register['koordinat'];
		$id_marketing=$tampil_register['id_marketing'];
		$no_nota=$tampil_register['no_nota'];

		//utk mengauto increment id_prospek
		$query_user_prospek=mysqli_query($koneksi,"select * from sale_user_prospek order by id_prospek DESC limit 1");
		$tampil_user_prospek=mysqli_fetch_array($query_user_prospek);
		$id_prospek=$tampil_user_prospek['id_prospek'];
		if($id_prospek=="") {
			$id_prospek="P001";
		} else {
			$id_prospek++;
		}

		mysqli_query($koneksi,"INSERT INTO sale_user_prospek (id_prospek, nik, nama_user, nama_instansi, telp, email, alamat, koordinat, id_marketing, catatan, no_nota) VALUE ('$id_prospek', '$nik', '$nama_user', '$nama_instansi', '$telp', '$email', '$alamat', '$koordinat', '$id_marketing', '$catatan', '$no_nota')");

		mysqli_query($koneksi,"DELETE FROM sale_register WHERE id_register='$id_register'");
	}

	function update_user_close() {
		include "../../koneksi/koneksi.php";

		$id_register=$_POST['id_register'];
	    $nik=$_POST['nik'];
	    $nama_user=strtoupper($_POST['nama_user']);
	    $nama_instansi=$_POST['nama_instansi'];
	    $jenis_kelamin=$_POST['jenis_kelamin'];
	    $tempat_lahir=$_POST['tempat_lahir'];
	    $tanggal_lahir=$_POST['tanggal_lahir'];
	    $telp=$_POST['telp'];
	    $email=$_POST['email'];
	    $alamat_1=$_POST['alamat_1'];
	    $alamat_2=$_POST['alamat_2'];
	    $alamat_3=$_POST['alamat_3'];
	    $alamat_4=$_POST['alamat_4'];
	    $alamat_5=$_POST['alamat_5'];
	    $alamat_6=$_POST['alamat_6'];
	    $alamat=$alamat_1."#".$alamat_2."#".$alamat_3."#".$alamat_4."#".$alamat_5."#".$alamat_6;
	    $koordinat=addslashes($_POST['koordinat']);

	    mysqli_query($koneksi,"UPDATE `sale_register` SET `id_register`='$id_register', `nik`='$nik', `nama_user`='$nama_user', `nama_instansi`='$nama_instansi', `jenis_kelamin`='$jenis_kelamin', `tempat_lahir`='$tempat_lahir', `tanggal_lahir`='$tanggal_lahir', `telp`='$telp', `email`='$email', `alamat`='$alamat', `koordinat`='$koordinat' WHERE id_register='$id_register'");

	    header('location:?page=page_data_user_close');
	}
	//--------------------------------------! Function Update !--------------------------------------\\
}

class select {
	function select_data_user_prospek($login_id_marketing) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_user_prospek left join sale_marketing on sale_user_prospek.id_marketing=sale_marketing.id_marketing where sale_user_prospek.id_marketing='$login_id_marketing' order by id_prospek DESC");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_data_user_prospek_old($login_id_marketing) {
		include "../../koneksi/koneksi.php";
		$tanggal_hari_ini = date('Y-m-d');
		$tanggal_2_bulan_kemarin = date('Y-m-d', strtotime('-2 month', strtotime($tanggal_hari_ini)));
		$query=mysqli_query($koneksi,"select * from sale_user_prospek left join sale_marketing on sale_user_prospek.id_marketing=sale_marketing.id_marketing where sale_user_prospek.tanggal_prospek<='$tanggal_2_bulan_kemarin' order by id_prospek DESC");
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

   function jumlah_data_jadwal() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select * from master_login right join sale_register on sale_register.id_teknisi=master_login.id_user where sale_register.status='Order Alat' or sale_register.status='Alat Siap'");
	$jumlah=mysqli_num_rows($query);
    return $jumlah;
  }

  function jumlah_data_jadwal_partner() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select * from master_login right join sale_register on sale_register.partner=master_login.id_user where sale_register.status='Order Alat' or sale_register.status='Alat Siap'");
	$jumlah=mysqli_num_rows($query);
    return $jumlah;
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

  function jumlah_data_jadwal_maintenance() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select teknisi_maintenance.id_register, teknisi_maintenance.id_teknisi, teknisi_maintenance.tanggal_penjadwalan_maintenance, teknisi_maintenance.status, sale_register.id_register, sale_register.nama_user, master_login.id_user, master_login.ekstra from teknisi_maintenance left join sale_register on teknisi_maintenance.id_register=sale_register.id_register left join master_login on teknisi_maintenance.id_teknisi=master_login.id_user where teknisi_maintenance.status='Antrian'");
    $jumlah=mysqli_num_rows($query);
    return $jumlah;
  }

  function select_data_paket_internet() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select * from sale_paket_internet");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_data_user_seusai_paket_sesuai_marketing($login_id_marketing, $id_paket) {
    include "../../koneksi/koneksi.php";
    
    $bulan_ini = date('Y-m-');
    $query=mysqli_query($koneksi,"select * from billing_backup_log_user left join sale_register on billing_backup_log_user.id_register=sale_register.id_register where sale_register.id_marketing='$login_id_marketing' and sale_register.id_paket='$id_paket' and billing_backup_log_user.bulan like '%$bulan_ini%'");
    $jumlah=mysqli_num_rows($query);
    return $jumlah;
  }

  function select_data_reclose($id_register) {
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

  function select_data_subsidi_bulan_ini($id_marketing){
		include "../../koneksi/koneksi.php";
		$total = "0";
		$bulan_ini = date('Y-m-');
		$query=mysqli_query($koneksi,"select * from sale_subsidi_marketing where tanggal_subsidi like '%$bulan_ini%' and id_marketing='$id_marketing'");
		while($data=mysqli_fetch_array($query)){
			$harga=$data['nominal_subsidi'];
			$total = $total+$harga;
		}
		return $total;
	}

	function select_saldo_subsidi_marketing($id_marketing) {
	    include "../../koneksi/koneksi.php";

	  	$query = mysqli_query($koneksi,"select * from sale_subsidi_marketing where id_marketing='$id_marketing'");
	  	$total = 0;
	  	while($data = mysqli_fetch_array($query)){
	  		$nominal_subsidi = $data['nominal_subsidi'];

	  		$total = $total + $nominal_subsidi;
	  	}
	  	return $total;
	}

	function select_data_lokasi_bts(){
		include "../../koneksi/koneksi.php";

	  	$query=mysqli_query($koneksi,"SELECT * FROM mon_lokasibts");
	    while($tampil=mysqli_fetch_array($query))
	    $data[]=$tampil;
	    return $data;
	}
}

class update {
	function proses_reclose_teknisi() {
		include "../../koneksi/koneksi.php";

		$id_register=$_POST['id_register'];
	    $nik=$_POST['nik'];
	    $nama_user=strtoupper($_POST['nama_user']);
	    $nama_instansi=$_POST['nama_instansi'];
	    $jenis_kelamin=$_POST['jenis_kelamin'];
	    $tempat_lahir=$_POST['tempat_lahir'];
	    $tanggal_lahir=$_POST['tanggal_lahir'];
	    $telp=$_POST['telp'];
	    $email=$_POST['email'];
	    $alamat_1=$_POST['alamat_1'];
	    $alamat_2=$_POST['alamat_2'];
	    $alamat_3=$_POST['alamat_3'];
	    $alamat_4=$_POST['alamat_4'];
	    $alamat_5=$_POST['alamat_5'];
	    $alamat_6=$_POST['alamat_6'];
	    $alamat=$alamat_1."#".$alamat_2."#".$alamat_3."#".$alamat_4."#".$alamat_5."#".$alamat_6;
	    $koordinat=addslashes($_POST['koordinat']);
	    $id_marketing=$login_id_marketing;
	    $status="Penjadwalan";
	    $tanggal_register=date('Y-m-d');
	    $catatan=$_POST['catatan'];
	    
	    $id_paket=$_POST['id_paket'];
	    $ip_publik=$_POST['ip_publik'];
	    $biaya_registrasi=$_POST['biaya_registrasi'];

	    $id_bts=$_POST['id_bts'];

	    $id_radio=$_POST['id_radio'];
	    $jumlah_radio=$_POST['jumlah_radio'];
	    $status_radio=$_POST['status_radio'];
	    $harga_radio=$_POST['harga_radio'];

	    $id_antena=$_POST['id_antena'];
	    $jumlah_antena=$_POST['jumlah_antena'];
	    $status_antena=$_POST['status_antena'];
	    $harga_antena=$_POST['harga_antena'];

	    $id_wifi=$_POST['id_wifi'];
	    $jumlah_wifi=$_POST['jumlah_wifi'];
	    $status_wifi=$_POST['status_wifi'];
	    $harga_wifi=$_POST['harga_wifi'];

		$id_tower=$_POST['id_tower'];
	    $jumlah_tower=$_POST['jumlah_tower'];
	    $status_tower=$_POST['status_tower'];
	    $harga_tower=$_POST['harga_tower'];

	    $id_kabel=$_POST['id_kabel'];
	    $panjang_kabel=$_POST['panjang_kabel'];
	    $status_kabel=$_POST['status_kabel'];
	    $harga_kabel=$_POST['harga_kabel'];

	    mysqli_query($koneksi,"UPDATE `sale_register` SET `ip_publik`='$ip_publik', tanggal_register='$tanggal_register', `nik`='$nik', `nama_user`='$nama_user', `nama_instansi`='$nama_instansi', `jenis_kelamin`='$jenis_kelamin', `tempat_lahir`='$tempat_lahir', `tanggal_lahir`='$tanggal_lahir', `telp`='$telp', `email`='$email', `alamat`='$alamat', `koordinat`='$koordinat', `status`='$status', `id_paket`='$id_paket', `id_bts`='$id_bts', `id_radio`='$id_radio', `jumlah_radio`='$jumlah_radio', `harga_radio`='$harga_radio', `status_radio`='$status_radio', `id_antena`='$id_antena', `jumlah_antena`='$jumlah_antena', `harga_antena`='$harga_antena', `status_antena`='$status_antena', `id_wifi`='$id_wifi', `jumlah_wifi`='$jumlah_wifi', `harga_wifi`='$harga_wifi', `status_wifi`='$status_wifi', `id_tower`='$id_tower', `jumlah_tower`='$jumlah_tower', `harga_tower`='$harga_tower', `status_tower`='$status_tower', `id_kabel`='$id_kabel', `panjang_kabel`='$panjang_kabel', `harga_kabel`='$harga_kabel', `status_kabel`='$status_kabel', biaya_registrasi='$biaya_registrasi' WHERE id_register='$id_register'");
	}

	function proses_reclose_trial() {
		include "../../koneksi/koneksi.php";

		$id_register=$_POST['id_register'];
	    $nik=$_POST['nik'];
	    $nama_user=strtoupper($_POST['nama_user']);
	    $nama_instansi=$_POST['nama_instansi'];
	    $jenis_kelamin=$_POST['jenis_kelamin'];
	    $tempat_lahir=$_POST['tempat_lahir'];
	    $tanggal_lahir=$_POST['tanggal_lahir'];
	    $telp=$_POST['telp'];
	    $email=$_POST['email'];
	    $alamat_1=$_POST['alamat_1'];
	    $alamat_2=$_POST['alamat_2'];
	    $alamat_3=$_POST['alamat_3'];
	    $alamat_4=$_POST['alamat_4'];
	    $alamat_5=$_POST['alamat_5'];
	    $alamat_6=$_POST['alamat_6'];
	    $alamat=$alamat_1."#".$alamat_2."#".$alamat_3."#".$alamat_4."#".$alamat_5."#".$alamat_6;
	    $koordinat=addslashes($_POST['koordinat']);
	    $id_marketing=$login_id_marketing;
	    $status="Trial";
	    $tanggal_register=date('Y-m-d');
	    $tanggal_pemasangan=date('Y-m-d');
	    $tanggal_trial=date('Y-m-d', strtotime('+3 days', strtotime($tanggal_pemasangan)));
	    $catatan=$_POST['catatan'];
	    
	    $id_paket=$_POST['id_paket'];
	    $ip_publik=$_POST['ip_publik'];
	    $biaya_registrasi=$_POST['biaya_registrasi'];

	    $id_bts=$_POST['id_bts'];

	    $id_radio=$_POST['id_radio'];
	    $jumlah_radio=$_POST['jumlah_radio'];
	    $status_radio=$_POST['status_radio'];
	    $harga_radio=$_POST['harga_radio'];

	    $id_antena=$_POST['id_antena'];
	    $jumlah_antena=$_POST['jumlah_antena'];
	    $status_antena=$_POST['status_antena'];
	    $harga_antena=$_POST['harga_antena'];

	    $id_wifi=$_POST['id_wifi'];
	    $jumlah_wifi=$_POST['jumlah_wifi'];
	    $status_wifi=$_POST['status_wifi'];
	    $harga_wifi=$_POST['harga_wifi'];

		$id_tower=$_POST['id_tower'];
	    $jumlah_tower=$_POST['jumlah_tower'];
	    $status_tower=$_POST['status_tower'];
	    $harga_tower=$_POST['harga_tower'];

	    $id_kabel=$_POST['id_kabel'];
	    $panjang_kabel=$_POST['panjang_kabel'];
	    $status_kabel=$_POST['status_kabel'];
	    $harga_kabel=$_POST['harga_kabel'];

	    mysqli_query($koneksi,"UPDATE `sale_register` SET `ip_publik`='$ip_publik', `tanggal_register`='$tanggal_register', `tanggal_pemasangan`='$tanggal_pemasangan', `tanggal_trial`='$tanggal_trial', `nik`='$nik', `nama_user`='$nama_user', `nama_instansi`='$nama_instansi', `jenis_kelamin`='$jenis_kelamin', `tempat_lahir`='$tempat_lahir', `tanggal_lahir`='$tanggal_lahir', `telp`='$telp', `email`='$email', `alamat`='$alamat', `koordinat`='$koordinat', `status`='$status', `id_paket`='$id_paket', `id_bts`='$id_bts', `id_radio`='$id_radio', `jumlah_radio`='$jumlah_radio', `harga_radio`='$harga_radio', `status_radio`='$status_radio', `id_antena`='$id_antena', `jumlah_antena`='$jumlah_antena', `harga_antena`='$harga_antena', `status_antena`='$status_antena', `id_wifi`='$id_wifi', `jumlah_wifi`='$jumlah_wifi', `harga_wifi`='$harga_wifi', `status_wifi`='$status_wifi', `id_tower`='$id_tower', `jumlah_tower`='$jumlah_tower', `harga_tower`='$harga_tower', `status_tower`='$status_tower', `id_kabel`='$id_kabel', `panjang_kabel`='$panjang_kabel', `harga_kabel`='$harga_kabel', `status_kabel`='$status_kabel', biaya_registrasi='$biaya_registrasi' WHERE id_register='$id_register'");
	}

	function proses_reclose_billing() {
		include "../../koneksi/koneksi.php";

		$id_register=$_POST['id_register'];
	    $nik=$_POST['nik'];
	    $nama_user=strtoupper($_POST['nama_user']);
	    $nama_instansi=$_POST['nama_instansi'];
	    $jenis_kelamin=$_POST['jenis_kelamin'];
	    $tempat_lahir=$_POST['tempat_lahir'];
	    $tanggal_lahir=$_POST['tanggal_lahir'];
	    $telp=$_POST['telp'];
	    $email=$_POST['email'];
	    $alamat_1=$_POST['alamat_1'];
	    $alamat_2=$_POST['alamat_2'];
	    $alamat_3=$_POST['alamat_3'];
	    $alamat_4=$_POST['alamat_4'];
	    $alamat_5=$_POST['alamat_5'];
	    $alamat_6=$_POST['alamat_6'];
	    $alamat=$alamat_1."#".$alamat_2."#".$alamat_3."#".$alamat_4."#".$alamat_5."#".$alamat_6;
	    $koordinat=addslashes($_POST['koordinat']);
	    $id_marketing=$login_id_marketing;
	    $status="Pasca-Trial";
	    $tanggal_register=date('Y-m-d');
	    $tanggal_pemasangan=date('Y-m-d');
	    $tanggal_trial=date('Y-m-d');
	    $catatan=$_POST['catatan'];
	    
	    $id_paket=$_POST['id_paket'];
	    $ip_publik=$_POST['ip_publik'];
	    $biaya_registrasi=$_POST['biaya_registrasi'];

	    $id_bts=$_POST['id_bts'];

	    $id_radio=$_POST['id_radio'];
	    $jumlah_radio=$_POST['jumlah_radio'];
	    $status_radio=$_POST['status_radio'];
	    $harga_radio=$_POST['harga_radio'];

	    $id_antena=$_POST['id_antena'];
	    $jumlah_antena=$_POST['jumlah_antena'];
	    $status_antena=$_POST['status_antena'];
	    $harga_antena=$_POST['harga_antena'];

	    $id_wifi=$_POST['id_wifi'];
	    $jumlah_wifi=$_POST['jumlah_wifi'];
	    $status_wifi=$_POST['status_wifi'];
	    $harga_wifi=$_POST['harga_wifi'];

		$id_tower=$_POST['id_tower'];
	    $jumlah_tower=$_POST['jumlah_tower'];
	    $status_tower=$_POST['status_tower'];
	    $harga_tower=$_POST['harga_tower'];

	    $id_kabel=$_POST['id_kabel'];
	    $panjang_kabel=$_POST['panjang_kabel'];
	    $status_kabel=$_POST['status_kabel'];
	    $harga_kabel=$_POST['harga_kabel'];

	    //---------------------------------Proses money_fee----------------------------------------\\
		//mencari data harga paket
		$query_paket=mysqli_query($koneksi,"select * from sale_paket_internet where id_paket='$id_paket'");
		$data_paket=mysqli_fetch_array($query_paket);
		$harga_paket=$data_paket['harga'];

		//mencari selisih tanggal dari registrasi sampai akhir bulan
		$tanggal=date('Y-m-d');
		$tanggal_1=new datetime($tanggal);
		$bulan_ditambah_satu=date('Y-m', strtotime('+1 month', strtotime($tanggal)));
		$tanggal_satu_bulan_depan=$bulan_ditambah_satu."-1";
		$tanggal_akhir_bulan=date('Y-m-d', strtotime('-1 days', strtotime($tanggal_satu_bulan_depan)));
		$tanggal_2=new datetime($tanggal_akhir_bulan);
		$selisih = $tanggal_1->diff($tanggal_2);
		$selisih_hari=$selisih->days;

		//mecari pecahan harga paket perharinya
		$jumlah_tanggal_bulan_ini=date('d', strtotime($tanggal_akhir_bulan));
		$harga_paket_perhari=$harga_paket / $jumlah_tanggal_bulan_ini;

		$money_fee = $harga_paket_perhari * $selisih_hari;
		//--------------------------------// roses money_fee \\--------------------------------------\\

	    mysqli_query($koneksi,"UPDATE `sale_register` SET `ip_publik`='$ip_publik', `tanggal_register`='$tanggal_register', `tanggal_pemasangan`='$tanggal_pemasangan', `tanggal_trial`='$tanggal_trial', `nik`='$nik', `nama_user`='$nama_user', `nama_instansi`='$nama_instansi', `jenis_kelamin`='$jenis_kelamin', `tempat_lahir`='$tempat_lahir', `tanggal_lahir`='$tanggal_lahir', `telp`='$telp', `email`='$email', `alamat`='$alamat', `koordinat`='$koordinat', `status`='$status', `id_paket`='$id_paket', `id_bts`='$id_bts', `id_radio`='$id_radio', `jumlah_radio`='$jumlah_radio', `harga_radio`='$harga_radio', `status_radio`='$status_radio', `id_antena`='$id_antena', `jumlah_antena`='$jumlah_antena', `harga_antena`='$harga_antena', `status_antena`='$status_antena', `id_wifi`='$id_wifi', `jumlah_wifi`='$jumlah_wifi', `harga_wifi`='$harga_wifi', `status_wifi`='$status_wifi', `id_tower`='$id_tower', `jumlah_tower`='$jumlah_tower', `harga_tower`='$harga_tower', `status_tower`='$status_tower', `id_kabel`='$id_kabel', `panjang_kabel`='$panjang_kabel', `harga_kabel`='$harga_kabel', `status_kabel`='$status_kabel', biaya_registrasi='$biaya_registrasi', monthly_fee='$money_fee' WHERE id_register='$id_register'");
	}

	function update_user_prospek($login_id_marketing) {
		include "../../koneksi/koneksi.php";

		$id_prospek=$_POST['id_prospek'];
		$nik=$_POST['nik'];
		$nama_user=strtoupper($_POST['nama_user']);
		$nama_instansi=$_POST['nama_instansi'];
		$telp=$_POST['telp'];
		$email=$_POST['email'];
		$alamat_1=$_POST['alamat_1'];
		$alamat_2=$_POST['alamat_2'];
		$alamat_3=$_POST['alamat_3'];
		$alamat_4=$_POST['alamat_4'];
		$alamat_5=$_POST['alamat_5'];
		$alamat_6=$_POST['alamat_6'];
		$alamat=$alamat_1."#".$alamat_2."#".$alamat_3."#".$alamat_4."#".$alamat_5."#".$alamat_6;
		$koordinat=addslashes($_POST['koordinat']);
		$id_marketing=$login_id_marketing;
		$catatan=$_POST['catatan'];
		$tanggal_prospek=date('Y-m-d');

		$query=mysqli_query($koneksi,"update sale_user_prospek set nik='$nik', nama_user='$nama_user', nama_instansi='$nama_instansi', telp='$telp', email='$email', alamat='$alamat', koordinat='$koordinat', catatan='$catatan' where id_prospek='$id_prospek'");
	}
}

class delete {
	function hapus_user_prospek() {
		include "../../koneksi/koneksi.php";

		$id_prospek=$_POST['id_prospek'];

		mysqli_query($koneksi,"delete from sale_user_prospek where id_prospek='$id_prospek'");
	}
}
?>