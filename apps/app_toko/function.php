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

class posting{
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
}

class dashboard {
	function select_data_user_prospek() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_user_prospek where id_marketing='$login_id_marketing' order by id_prospek DESC");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}
}

class insert {
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

	function insert_radio() {
		include "../../koneksi/koneksi.php";

		$id_radio = $_POST['id_radio'];
		$nama_radio = $_POST['nama_radio'];

		$query=mysqli_query($koneksi,"insert into sale_radio values ('$id_radio', '$nama_radio')");
	}

	function insert_antena() {
		include "../../koneksi/koneksi.php";

		$id_antena = $_POST['id_antena'];
		$nama_antena = $_POST['nama_antena'];

		$query=mysqli_query($koneksi,"insert into sale_antena values ('$id_antena', '$nama_antena')");
	}

	function insert_wifi() {
		include "../../koneksi/koneksi.php";

		$id_wifi = $_POST['id_wifi'];
		$nama_wifi = $_POST['nama_wifi'];

		$query=mysqli_query($koneksi,"insert into sale_wifi values ('$id_wifi', '$nama_wifi')");
	}

	function insert_tower() {
		include "../../koneksi/koneksi.php";

		$id_tower = $_POST['id_tower'];
		$nama_tower = $_POST['nama_tower'];

		$query=mysqli_query($koneksi,"insert into sale_tower values ('$id_tower', '$nama_tower')");
	}

	function insert_kabel() {
		include "../../koneksi/koneksi.php";

		$id_kabel = $_POST['id_kabel'];
		$nama_kabel = $_POST['nama_kabel'];

		$query=mysqli_query($koneksi,"insert into sale_kabel values ('$id_kabel', '$nama_kabel')");
	}

	function insert_daily_masuk() {
		include "../../koneksi/koneksi.php";

		$tanggal = $_POST['tanggal']." ".date('H:i:m');
		$keterangan = $_POST['keterangan'];
		$tambahan = $_POST['tambahan'];
		$no_log_pembayaran = "";
		$nominal = $_POST['nominal'];
		$pecah_nominal = explode(".", $nominal);
		$nominal = implode("", $pecah_nominal);
		$id_account = $_POST['id_account'];
		$in_out = "i";
		$status = "belum";
		$ekstra = "hardware";

		if($id_account=="2") {
		    $id_account = "2";
		    $tambahan_keterangan = " | BCA";
		} else 
		if($id_account=="3") {
		    $id_account = "2";
		    $tambahan_keterangan = " | BNI";
		} else 
		if($id_account=="4") {
		    $id_account = "2";
		    $tambahan_keterangan = " | BRI";
		} else 
		if($id_account=="5") {
		    $id_account = "2";
		    $tambahan_keterangan = " | MANDIRI";
		} else 
		if($id_account=="6") {
		    $id_account = "2";
		    $tambahan_keterangan = " | BPD";
		} else {
		    $id_account = "1";
		    $tambahan_keterangan = "";
		}

		if($tambahan=="nota"){
		    $keterangan = "Pembayaran Nota (".$keterangan.")".$tambahan_keterangan;
		    $this->input_data_temp_posting($tanggal,$keterangan,$no_log_pembayaran,$nominal,$id_account,$in_out,$status,$ekstra,'37');
		} else {
			mysqli_query($koneksi,"INSERT INTO `data_temp`(`tanggal`, `keterangan`, `no_log_pembayaran`, `nominal`, `id_account`, `in_out`, `status`, `ekstra`) VALUES ('$tanggal', '$keterangan', '$no_log_pembayaran', '$nominal', '$id_account', '$in_out', '$status', '$ekstra')");
		}
	}

	function insert_daily_keluar() {
		include "../../koneksi/koneksi.php";

		$tanggal = $_POST['tanggal']." ".date('H:i:m');
		$keterangan = $_POST['keterangan'];
		$no_log_pembayaran = "";
		$nominal = $_POST['nominal'];
		$pecah_nominal = explode(".", $nominal);
		$nominal = implode("", $pecah_nominal);
		$id_account = $_POST['id_account'];
		$in_out = "o";
		$status = "belum";
		$ekstra = "hardware";

		mysqli_query($koneksi,"INSERT INTO `data_temp`(`tanggal`, `keterangan`, `no_log_pembayaran`, `nominal`, `id_account`, `in_out`, `status`, `ekstra`) VALUES ('$tanggal', '$keterangan', '$no_log_pembayaran', '$nominal', '$id_account', '$in_out', '$status', '$ekstra')");
	}
}

class select {
	function select_data_pemasangan_baru() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register where no_nota like '' and no_nota_investasi like ''");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_data_permintaan_alat() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register where no_nota not like ''");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_jumlah_pemasangan_user_baru_navbar() {
		include "../../koneksi/koneksi.php";

		$query = mysqli_query($koneksi,"select * from sale_register where no_nota like '' and no_nota_investasi like ''");
		$data = mysqli_num_rows($query); 
		return $data;
	}

	function select_menyiapkan_alat($id_register) {
		include "../../koneksi/koneksi.php";

		$query = mysqli_query($koneksi,"select * from sale_register where id_register='$id_register'");
		$data = mysqli_fetch_array($query); 
		return $data;
	}

	function select_data_radio() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_radio");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_id_radio_terakhir() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_radio order by id_radio DESC limit 1");
		$tampil=mysqli_fetch_array($query);
		$data=$tampil['id_radio'];
		$data++;
		return $data;
	}

	function select_data_antena() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_antena");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_id_antena_terakhir() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_antena order by id_antena DESC limit 1");
		$tampil=mysqli_fetch_array($query);
		$data=$tampil['id_antena'];
		$data++;
		return $data;
	}

	function select_data_wifi() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_wifi");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_id_wifi_terakhir() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_wifi order by id_wifi DESC limit 1");
		$tampil=mysqli_fetch_array($query);
		$data=$tampil['id_wifi'];
		$data++;
		return $data;
	}

	function select_data_tower() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_tower");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_id_tower_terakhir() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_tower order by id_tower DESC limit 1");
		$tampil=mysqli_fetch_array($query);
		$data=$tampil['id_tower'];
		$data++;
		return $data;
	}

	function select_data_kabel() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_kabel");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_id_kabel_terakhir() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_kabel order by id_kabel DESC limit 1");
		$tampil=mysqli_fetch_array($query);
		$data=$tampil['id_kabel'];
		$data++;
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

  function select_data_bts() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select * from label_gedung");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_data_temp_where($via, $dk, $tanggal_awal, $tanggal_akhir, $isi_data) {    
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"SELECT * FROM data_temp WHERE `id_account`='1' AND `keterangan` like '%$isi_data%' AND id_account like '%$via%' AND in_out like '%$dk%' AND tanggal BETWEEN '$tanggal_awal 00:00:00' AND '$tanggal_akhir 23:59:59' AND ekstra = 'hardware' OR `id_account`='2' AND `keterangan` like '%$isi_data%' AND id_account like '%$via%' AND in_out like '%$dk%' AND tanggal BETWEEN '$tanggal_awal 00:00:00' AND '$tanggal_akhir 23:59:59' AND ekstra = 'hardware' ORDER BY `tanggal` DESC, `id_temp` DESC");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function saldo_kas($tanggal_hari_ini) {
      include "../../koneksi/koneksi.php";
      
      $query_temp_in_kas = mysqli_query($koneksi,"SELECT SUM(`nominal`) as total FROM `data_temp` WHERE `tanggal` BETWEEN '0000-00-01 00:00:00' AND '$tanggal_hari_ini 23:59:59' AND `id_account`='1' AND `in_out`='i' AND `ekstra`='hardware'");
      $data_temp_in_kas = mysqli_fetch_array($query_temp_in_kas);
      
      $query_temp_out_kas = mysqli_query($koneksi,"SELECT SUM(`nominal`) as total FROM `data_temp` WHERE `tanggal` BETWEEN '0000-00-01 00:00:00' AND '$tanggal_hari_ini 23:59:59' AND `id_account`='1' AND `in_out`='o' AND `ekstra`='hardware'");
      $data_temp_out_kas = mysqli_fetch_array($query_temp_out_kas);
      
      $kas_masuk = $data_temp_in_kas['total'];
      $kas_keluar = $data_temp_out_kas['total'];
      
      return $kas_masuk - $kas_keluar;
  }
}

class update {
	function update_radio() {
		include "../../koneksi/koneksi.php";

		$id_radio = $_POST['id'];
		$nama_radio = $_POST['nama_radio'];

		$query=mysqli_query($koneksi,"update sale_radio set nama_radio='$nama_radio' where id_radio='$id_radio'");
	}

	function update_antena() {
		include "../../koneksi/koneksi.php";

		$id_antena = $_POST['id'];
		$nama_antena = $_POST['nama_antena'];

		$query=mysqli_query($koneksi,"update sale_antena set nama_antena='$nama_antena' where id_antena='$id_antena'");
	}

	function update_wifi() {
		include "../../koneksi/koneksi.php";

		$id_wifi = $_POST['id'];
		$nama_wifi = $_POST['nama_wifi'];

		$query=mysqli_query($koneksi,"update sale_wifi set nama_wifi='$nama_wifi' where id_wifi='$id_wifi'");
	}

	function update_tower() {
		include "../../koneksi/koneksi.php";

		$id_tower = $_POST['id'];
		$nama_tower = $_POST['nama_tower'];

		$query=mysqli_query($koneksi,"update sale_tower set nama_tower='$nama_tower' where id_tower='$id_tower'");
	}

	function update_kabel() {
		include "../../koneksi/koneksi.php";

		$id_kabel = $_POST['id'];
		$nama_kabel = $_POST['nama_kabel'];

		$query=mysqli_query($koneksi,"update sale_kabel set nama_kabel='$nama_kabel' where id_kabel='$id_kabel'");
	}

	function proses_konfirmasi_alat_siap() {
		include "../../koneksi/koneksi.php";

		$id_register = $_POST['id_register'];

		$no_nota = $_POST['no_nota'];
		$no_nota_investasi = $_POST['no_nota_investasi'];

		$id_radio = $_POST['id_radio'];
		$status_radio = "TIDAK PAKAI";
		if(isset($_POST['status_radio'])) {
			$status_radio = $_POST['status_radio'];
		}
		$jumlah_radio = $_POST['jumlah_radio'];
		$harga_radio = $_POST['harga_radio'];
		$pecah_harga_radio = explode(".", $harga_radio);
		$harga_radio = implode("", $pecah_harga_radio);


		$id_antena = $_POST['id_antena'];
		$status_antena = "TIDAK PAKAI";
		if(isset($_POST['status_antena'])) {
			$status_antena = $_POST['status_antena'];
		}
		$jumlah_antena = $_POST['jumlah_antena'];
		$harga_antena = $_POST['harga_antena'];
		$pecah_harga_antena = explode(".", $harga_antena);
		$harga_antena = implode("", $pecah_harga_antena);


		$id_wifi = $_POST['id_wifi'];
		$status_wifi = "TIDAK PAKAI";
		if(isset($_POST['status_wifi'])) {
			$status_wifi = $_POST['status_wifi'];
		}
		$jumlah_wifi = $_POST['jumlah_wifi'];
		$harga_wifi = $_POST['harga_wifi'];
		$pecah_harga_wifi = explode(".", $harga_wifi);
		$harga_wifi = implode("", $pecah_harga_wifi);


		$id_tower = $_POST['id_tower'];
		$status_tower = "TIDAK PAKAI";
		if(isset($_POST['status_tower'])) {
			$status_tower = $_POST['status_tower'];
		}
		$jumlah_tower = $_POST['jumlah_tower'];
		$harga_tower = $_POST['harga_tower'];
		$pecah_harga_tower = explode(".", $harga_tower);
		$harga_tower = implode("", $pecah_harga_tower);


		$id_kabel = $_POST['id_kabel'];
		$status_kabel = "TIDAK PAKAI";
		if(isset($_POST['status_kabel'])) {
			$status_kabel = $_POST['status_kabel'];
		}
		$panjang_kabel = $_POST['panjang_kabel'];
		$harga_kabel = $_POST['harga_kabel'];
		$pecah_harga_kabel = explode(".", $harga_kabel);
		$harga_kabel = implode("", $pecah_harga_kabel);
		
		$tambahan_1 = $_POST['tambahan_1'];
		$status_tambahan_1 = "TIDAK PAKAI";
		if(isset($_POST['status_tambahan_1'])) {
			$status_tambahan_1 = $_POST['status_tambahan_1'];
		}
		$jumlah_tambahan_1 = $_POST['jumlah_tambahan_1'];
		$harga_tambahan_1 = $_POST['harga_tambahan_1'];
		$pecah_harga_tambahan_1 = explode(".", $harga_tambahan_1);
		$harga_tambahan_1 = implode("", $pecah_harga_tambahan_1);

		$tanggal_order_alat = date('Y-m-d');


		$query=mysqli_query($koneksi,"update sale_register set id_radio='$id_radio', no_nota_investasi='$no_nota_investasi', status_radio='$status_radio', jumlah_radio='$jumlah_radio', harga_radio='$harga_radio', id_antena='$id_antena', status_antena='$status_antena', jumlah_antena='$jumlah_antena', harga_antena='$harga_antena', id_wifi='$id_wifi', status_wifi='$status_wifi', jumlah_wifi='$jumlah_wifi', harga_wifi='$harga_wifi', id_tower='$id_tower', status_tower='$status_tower', jumlah_tower='$jumlah_tower', harga_tower='$harga_tower', id_kabel='$id_kabel', status_kabel='$status_kabel', panjang_kabel='$panjang_kabel', harga_kabel='$harga_kabel', no_nota='$no_nota', tanggal_order_alat='$tanggal_order_alat', tambahan_1='$tambahan_1', status_tambahan_1='$status_tambahan_1', status_tambahan_1='$status_tambahan_1', harga_tambahan_1='$harga_tambahan_1' where id_register='$id_register'");
	}

	function edit_log_pembyaran() {
	    include "../../koneksi/koneksi.php";
	    
	    $id_temp = $_POST['id_temp'];
	    $no_log_pembayaran = $_POST['no_log_pembayaran'];
	    $tanggal = $_POST['tanggal']." ".date("H:m:i");
	    $keterangan = $_POST['keterangan'];
	    $tambahan = $_POST['tambahan'];
	    $in_out = $_POST['in_out'];
	    $nominal = $_POST['nominal'];
	    $id_account = $_POST['id_account'];
	    $pecah_nominal = explode(".", $nominal);
	    $nominal = implode("", $pecah_nominal);
	    
	    if($tambahan=="nota"){
		    $keterangan = "Pembayaran Nota ( ".$keterangan.")";
		}
		
		if($id_account=="2") {
		    $id_account = "2";
		    $tambahan_keterangan = " | BCA";
		} else 
		if($id_account=="3") {
		    $id_account = "2";
		    $tambahan_keterangan = " | BNI";
		} else 
		if($id_account=="4") {
		    $id_account = "2";
		    $tambahan_keterangan = " | BRI";
		} else 
		if($id_account=="5") {
		    $id_account = "2";
		    $tambahan_keterangan = " | MANDIRI";
		} else 
		if($id_account=="6") {
		    $id_account = "2";
		    $tambahan_keterangan = " | BPD";
		} else {
		    $id_account = "1";
		    $tambahan_keterangan = "";
		}
		
		$keterangan = $keterangan.$tambahan_keterangan;
		
	    mysqli_query($koneksi,"UPDATE `data_temp` SET `keterangan`='$keterangan', `nominal`='$nominal', `tanggal`='$tanggal', `id_account`='$id_account' WHERE `id_temp`='$id_temp'");
	    mysqli_query($koneksi,"UPDATE `data_transaksi` SET `keterangan`='$keterangan', `nominal`='$nominal', `tanggal`='$tanggal' WHERE `id_temp`='$id_temp'");

	    if($in_out=="i"){
	    	mysqli_query($koneksi,"UPDATE `data_transaksi` SET `id_account`='$id_account' WHERE `id_temp`='$id_temp' AND `DK`='D'");
	    } else {
	    	mysqli_query($koneksi,"UPDATE `data_transaksi` SET `id_account`='$id_account' WHERE `id_temp`='$id_temp' AND `DK`='K'");
	    }
	    
	}
}

class delete {
	function delete_radio() {
		include "../../koneksi/koneksi.php";

		$id_radio = $_POST['id'];

		$query=mysqli_query($koneksi,"delete from sale_radio where id_radio='$id_radio'");
	}

	function delete_antena() {
		include "../../koneksi/koneksi.php";

		$id_antena = $_POST['id'];

		$query=mysqli_query($koneksi,"delete from sale_antena where id_antena='$id_antena'");
	}

	function delete_wifi() {
		include "../../koneksi/koneksi.php";

		$id_wifi = $_POST['id'];

		$query=mysqli_query($koneksi,"delete from sale_wifi where id_wifi='$id_wifi'");
	}

	function delete_tower() {
		include "../../koneksi/koneksi.php";

		$id_tower = $_POST['id'];

		$query=mysqli_query($koneksi,"delete from sale_tower where id_tower='$id_tower'");
	}

	function delete_kabel() {
		include "../../koneksi/koneksi.php";

		$id_kabel = $_POST['id'];

		$query=mysqli_query($koneksi,"delete from sale_kabel where id_kabel='$id_kabel'");
	}

	function batal_posting() {
		include "../../koneksi/koneksi.php";

		$id_temp = $_POST['id_temp'];
		
		mysqli_query($koneksi,"DELETE FROM `data_temp` WHERE id_temp='$id_temp'");
		mysqli_query($koneksi,"DELETE FROM `data_transaksi` WHERE id_temp='$id_temp'");
	}
}

?>