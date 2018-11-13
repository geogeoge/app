<?php
class crud {
	function tanggal_hari_ini() {
		include "../../koneksi/koneksi.php";
		$query_tanggal_hari_ini=mysqli_query($koneksi,"select * from billing_simulasi_tanggal where id='1'");
		$tampil_tanggal_hari_ini=mysqli_fetch_array($query_tanggal_hari_ini);
		$tanggal_hari_ini=date('Y-m-d');
		return $tanggal_hari_ini;
	}

	function insert_pembayaran_access_bulanan() {
		include "../../koneksi/koneksi.php";

		$id_register=$_POST['id_register'];
		$via=$_POST['via'];
		$waktu_pembayaran=$_POST['tanggal']." ". date('H:m:i');

		$nominal_restitusi=$_POST['restitusi'];
		$pecah_rastitasi=explode(".", $nominal_restitusi);
		$restitusi=implode("", $pecah_rastitasi);

		$nominal_bayar=$_POST['bayar'];
		$pecah_bayar=explode(".", $nominal_bayar);
		$bayar=implode("", $pecah_bayar);
		
		$keterangan="A";


		//proses ke log pembayaran
		mysqli_query($koneksi, "insert into billing_log_pembayaran (waktu_pembayaran, keterangan, id_register, via, bayar, restitusi) value ('$waktu_pembayaran', '$keterangan', '$id_register', '$via', '$bayar', '$restitusi')") or die(mysqli_error());

		//melihat data user
		$query_user=mysqli_query($koneksi,"select * from sale_register where id_register='$id_register'");
		$tampil_user=mysqli_fetch_array($query_user);
		$ip_publik=$tampil_user['ip_publik'];
		$id_paket=$tampil_user['id_paket'];
		$billing_bulan_berjalan=$tampil_user['billing_bulan_berjalan'];
		$billing_bulan_terbayar=$tampil_user['billing_bulan_terbayar'];
		$billing_saldo=$tampil_user['billing_saldo'];
		$billing_total_bayar=$tampil_user['billing_total_bayar'];
		$billing_total_restitusi=$tampil_user['billing_total_restitusi'];

		//melihat data id paket
		$query_paket=mysqli_query($koneksi,"select * from sale_paket_internet where id_paket='$id_paket'");
		$tampil_paket=mysqli_fetch_array($query_paket);
		$harga=$tampil_paket['harga'];

		$harga_ip_publik=0;
		if($ip_publik=="IYA") {
			$harga_ip_publik=100000;
		}

		$tunggakan=$billing_bulan_berjalan-$billing_bulan_terbayar;

		$tunggakan_paket=$tunggakan*$harga;

		$tunggakan_ip_publik=$tunggakan*$harga_ip_publik;

		$harga_dan_ip_publik=$harga+$harga_ip_publik;

		$total_tunggakan=$tunggakan_paket+$tunggakan_ip_publik;

		//eksekusi
		$total_dana=$bayar+$restitusi+$billing_saldo;

		if($total_dana>=$total_tunggakan) {
			//iki yen duit e turah soko tunggakan
			$update_billing_saldo=$total_dana-$total_tunggakan;
			$update_bulan_terbayar=$billing_bulan_berjalan;
			$proses_update=mysqli_query($koneksi,"update sale_register set billing_saldo='$update_billing_saldo', billing_bulan_terbayar='$update_bulan_terbayar', billing_total_bayar=billing_total_bayar+'$bayar', billing_total_restitusi=billing_total_restitusi+'$restitusi' where id_register='$id_register'");
		} else {
			if($total_dana>=$harga_dan_ip_publik) {
				$update_billing_saldo=$total_dana%$harga_dan_ip_publik;
				$total_dana=$total_dana-$update_billing_saldo;
				$update_bulan_terbayar=$total_dana/$harga_dan_ip_publik;
				$proses_update=mysqli_query($koneksi,"update sale_register set billing_saldo='$update_billing_saldo', billing_bulan_terbayar=billing_bulan_terbayar+'$update_bulan_terbayar', billing_total_bayar=billing_total_bayar+'$bayar', billing_total_restitusi=billing_total_restitusi+'$restitusi' where id_register='$id_register'");
			} else {
				$update_billing_saldo=$total_dana;
				$proses_update=mysqli_query($koneksi,"update sale_register set billing_saldo=billing_saldo+'$update_billing_saldo', billing_total_bayar=billing_total_bayar+'$bayar', billing_total_restitusi=billing_total_restitusi+'$restitusi' where id_register='$id_register'");
			}
		}
		
	}

	function insert_pembayaran_access_user_baru() {
		include "../../koneksi/koneksi.php";

		$id_po=$_POST['id_po'];
		$via=$_POST['via'];

		$nominal_restitusi=$_POST['restitusi'];
		$pecah_rastitasi=explode(".", $nominal_restitusi);
		$restitusi=implode("", $pecah_rastitasi);

		$nominal_bayar=$_POST['bayar'];
		$pecah_bayar=explode(".", $nominal_bayar);
		$bayar=implode("", $pecah_bayar);
		
		$keterangan="B";

		//proses ke log pembayaran
		

		//melihat data user
		$query_po=mysqli_query($koneksi,"select * from billing_po where id_po='$id_po'");
		$tampil_po=mysqli_fetch_array($query_po);
		$id_register=$tampil_po['id_register'];
		$nominal_po = $tampil_po['biaya_registrasi'] + $tampil_po['money_fee'] + $tampil_po['biaya_ip_publik'] + $tampil_po['harga_radio'] + $tampil_po['harga_antena'] + $tampil_po['harga_wifi'] + $tampil_po['harga_kabel'] + $tampil_po['harga_tower'] ;
        $ppn = $nominal_po / 10;

        $status_ppn = $tampil_po['ppn'];
	    if($status_ppn=="TIDAK") {
	      $ppn = 0;
	      $tampil_status_ppn = '<i class="fa fa-close"></i>';
	      $update_status_ppn = "IYA";
	    }
        $total_po = $nominal_po + $ppn;

        //Melihat data Tagihan
        $query_tagihan=mysqli_query($koneksi,"select * from sale_register where id_register='$id_register'");
        $tampil_tagihan=mysqli_fetch_array($query_tagihan);
        $sisa_pembayaran=$tampil_tagihan['sisa_pembayaran'];

		//eksekusi
		$total_dana=$bayar+$sisa_pembayaran+$restitusi;
		if($total_dana>=floor($total_po)) {
			$update_sisa_pembayaran = $total_dana-$total_po;
			mysqli_query($koneksi,"update sale_register set billing_saldo='$update_sisa_pembayaran', billing_total_bayar=billing_total_bayar+'$bayar', billing_total_restitusi=billing_total_restitusi+'$restitusi' where id_register='$id_register'");
			mysqli_query($koneksi,"update billing_po set status_po='Sudah' where id_po='$id_po'");
		} else {
			$update_sisa_pembayaran = $total_dana;
			mysqli_query($koneksi,"update sale_register set billing_saldo='$update_sisa_pembayaran', billing_total_bayar=billing_total_bayar+'$bayar', billing_total_restitusi=billing_total_restitusi+'$restitusi' where id_register='$id_register'");
		}  

		mysqli_query($koneksi, "insert into billing_log_pembayaran (keterangan, id_register, via, bayar, restitusi) value ('$keterangan', '$id_register', '$via', '$bayar', '$restitusi')") or die(mysqli_error());
	}

	function insert_pemabayaran_tiket() {
		include "../../koneksi/koneksi.php";

		$id_register=$_POST['tiket_id_register'];
		$via=$_POST['tiket_via'];
		$bayar=$_POST['tiket_bayar'];
		$restitusi=$_POST['tiket_restitusi'];
		
		//proses ke log pembayaran
		mysqli_query($koneksi, "insert into billing_log_pembayaran (id_register, via, bayar, restitusi) value ('$id_register', '$via', '$bayar', '$restitusi')") or die(mysqli_error());

		//melihat data user
		$query_user=mysqli_query($koneksi,"select * from sale_register where id_register='$id_register'");
		$tampil_user=mysqli_fetch_array($query_user);
		$id_paket=$tampil_user['id_paket'];

		//melihat data id paket
		$query_paket=mysqli_query($koneksi,"select * from sale_paket_internet where id_paket='$id_paket'");
		$tampil_paket=mysqli_fetch_array($query_paket);
		$harga=$tampil_paket['harga'];

		//melihat data table billing_tagihan
		$query_tagihan=mysqli_query($koneksi,"select * from billing_tagihan where id_register='$id_register'");
		$tampil_tagihan=mysqli_fetch_array($query_tagihan);
		$bulan_berjalan=$tampil_tagihan['bulan_berjalan'];
		$bulan_terbayar=$tampil_tagihan['bulan_terbayar'];
		$piutang=$tampil_tagihan['piutang'];
		$sisa_pembayaran=$tampil_tagihan['sisa_pembayaran'];
		$total_bayar=$tampil_tagihan['total_bayar'];
		$total_restitusi=$tampil_tagihan['total_restitusi'];


		//eksekusi
		$total_dana=$bayar+$restitusi+$sisa_pembayaran;
		if($total_dana>=$piutang) {
			$update_piutang="0";
			$update_sisa_pembayaran=$total_dana-$piutang;
			$update_bulan_terbayar=$bulan_berjalan;
			$proses_update=mysqli_query($koneksi,"update billing_tagihan set piutang='$update_piutang', sisa_pembayaran='$update_sisa_pembayaran', bulan_terbayar='$update_bulan_terbayar', total_bayar=total_bayar+'$bayar', total_restitusi=total_restitusi+'$restitusi' where id_register='$id_register'");
		} else {
			if($total_dana>=$harga) {
				$update_sisa_pembayaran=$total_dana%$harga;
				$total_dana=$total_dana-$update_sisa_pembayaran;
				$update_piutang=$piutang-$total_dana;
				$update_bulan_terbayar=$total_dana/$harga;
				$proses_update=mysqli_query($koneksi,"update billing_tagihan set piutang='$update_piutang', sisa_pembayaran='$update_sisa_pembayaran', bulan_terbayar=bulan_terbayar+'$update_bulan_terbayar', total_bayar=total_bayar+'$bayar', total_restitusi=total_restitusi+'$restitusi' where id_register='$id_register'");
			} else {
				$update_sisa_pembayaran=$total_dana;
				$proses_update=mysqli_query($koneksi,"update billing_tagihan set sisa_pembayaran=sisa_pembayaran+'$update_sisa_pembayaran', total_bayar=total_bayar+'$bayar', total_restitusi=total_restitusi+'$restitusi' where id_register='$id_register'");
			}
		}
	}

	function batal_transaksi_acces($no) {
		include "../../koneksi/koneksi.php";
		
		$query_transaksi = mysqli_query($koneksi,"select * from billing_log_pembayaran where billing_log_pembayaran.no='$no'");
		$data_transaksi = mysqli_fetch_array($query_transaksi);
		$id_register = $data_transaksi['id_register'];
		$bayar = $data_transaksi['bayar'];
		$restitusi = $data_transaksi['restitusi'];
		
		$query_register = mysqli_query($koneksi,"select * from sale_register where id_register='$id_register'");
		$data_register = mysqli_fetch_array($query_register);
		$id_paket = $data_register['id_paket'];

		$query_paket = mysqli_query($koneksi,"select * from sale_paket_internet where id_paket='$id_paket'");
		$data_paket = mysqli_fetch_array($query_paket);
		$harga = $data_paket['harga'];

		$total_dana = $bayar+$restitusi;
		if($total_dana>=$harga) {
			$sisa_pembayaran = $total_dana%$harga;
			$update_total_dana = $total_dana - $sisa_pembayaran;
			$update_bulan = $update_total_dana/$harga;

			mysqli_query($koneksi,"update sale_register set billing_bulan_terbayar=billing_bulan_terbayar-'$update_bulan', billing_saldo=billing_saldo-'$sisa_pembayaran' where id_register='$id_register'");

			mysqli_query($koneksi,"delete from billing_log_pembayaran where no='$no'");
		} else {
			$sisa_pembayaran = $total_dana;

			mysqli_query($koneksi,"update sale_register set billing_saldo=billing_saldo-'$sisa_pembayaran' where id_register='$id_register'");
			mysqli_query($koneksi,"delete from billing_log_pembayaran where no='$no'");
		}
	}

	function batal_transaksi_user_baru($no) {
		include "../../koneksi/koneksi.php";
		$query_transaksi = mysqli_query($koneksi,"select * from billing_log_pembayaran where billing_log_pembayaran.no='$no'");
		$data_transaksi = mysqli_fetch_array($query_transaksi);
		$id_register = $data_transaksi['id_register'];
		$bayar = $data_transaksi['bayar'];
		$restitusi = $data_transaksi['restitusi'];

		$query_billing_po = mysqli_query($koneksi,"select * from billing_po where id_register='$id_register' limit 1");
		$data_billing_po = mysqli_fetch_array($query_billing_po);
		$id_po = $data_billing_po['id_po'];
		$nominal_po = $data_billing_po['biaya_registrasi'] + $data_billing_po['money_fee'] + $data_billing_po['biaya_ip_publik'] + $data_billing_po['harga_radio'] + $data_billing_po['harga_antena'] + $data_billing_po['harga_wifi'] + $data_billing_po['harga_kabel'] + $data_billing_po['harga_tower'] ;
		$ppn = $nominal_po / 10;
  
	   $status_ppn = $data_billing_po['ppn'];
	   if($status_ppn=="TIDAK") {
	     $ppn = 0;
	   }

       $total_po = $nominal_po + $ppn;
	   $total_po = $total_po - $sisa_pembayaran;

		$total_dana = $bayar+$restitusi;
		if($total_dana>=$total_po){
			$sisa_pembayaran = $total_dana-$total_po;
			mysqli_query($koneksi,"update sale_register set billing_saldo=billing_saldo-'$sisa_pembayaran' where id_register='$id_register'");
			mysqli_query($koneksi,"update billing_po set status_po='Belum' where id_po='$id_po'");
			mysqli_query($koneksi,"delete from billing_log_pembayaran where no='$no'");
		} else {
			$sisa_pembayaran=$total_dana;
			mysqli_query($koneksi,"update sale_register set billing_saldo=billing_saldo-'$sisa_pembayaran' where id_register='$id_register'");
			mysqli_query($koneksi,"delete from billing_log_pembayaran where no='$no'");
		}

		
	}

	function insert_pembayaran_tidak_terdeteksi() {
		include "../../koneksi/koneksi.php";

		$waktu_pembayaran = $_POST['tanggal']." ".$_POST['waktu'];
		$bank = $_POST['bank'];
		$keterangan = $_POST['keterangan'];
		$nominal_bayar=$_POST['nominal'];
		$pecah_bayar=explode(".", $nominal_bayar);
		$bayar=implode("", $pecah_bayar);
		$nominal_bayar=$bayar;
		$pecah_bayar=explode(",", $nominal_bayar);
		$nominal=implode("", $pecah_bayar);

		mysqli_query($koneksi,"insert into billing_pembayaran_tidak_terdeteksi (waktu_pembayaran, bank, keterangan, nominal) value ('$waktu_pembayaran', '$bank', '$keterangan', '$nominal')");
	}

	function insert_proses_pembayaran_tidak_terdeteksi() {
		include "../../koneksi/koneksi.php";

		$id_pembayaran=$_GET['id_pembayaran'];
		$id_register=$_GET['id_register'];

		$query_data_pembayaran_unknown=mysqli_query($koneksi,"select * from billing_pembayaran_tidak_terdeteksi where id_pembayaran_tidak_terdeteksi='$id_pembayaran'");
		$tampil_data_pembayaran_unknown=mysqli_fetch_array($query_data_pembayaran_unknown);
		$via=$tampil_data_pembayaran_unknown['bank'];
		$bayar=$tampil_data_pembayaran_unknown['nominal'];
		$waktu_pembayaran=$tampil_data_pembayaran_unknown['waktu_pembayaran'];

		$restitusi=0;
		$keterangan="A";


		//proses ke log pembayaran
		mysqli_query($koneksi, "insert into billing_log_pembayaran (waktu_pembayaran, keterangan, id_register, via, bayar, restitusi) value ('$waktu_pembayaran', '$keterangan', '$id_register', '$via', '$bayar', '$restitusi')") or die(mysqli_error());

		//melihat data user
		$query_user=mysqli_query($koneksi,"select * from sale_register where id_register='$id_register'");
		$tampil_user=mysqli_fetch_array($query_user);
		$ip_publik=$tampil_user['ip_publik'];
		$id_paket=$tampil_user['id_paket'];
		$billing_bulan_berjalan=$tampil_user['billing_bulan_berjalan'];
		$billing_bulan_terbayar=$tampil_user['billing_bulan_terbayar'];
		$billing_saldo=$tampil_user['billing_saldo'];
		$billing_total_bayar=$tampil_user['billing_total_bayar'];
		$billing_total_restitusi=$tampil_user['billing_total_restitusi'];

		//melihat data id paket
		$query_paket=mysqli_query($koneksi,"select * from sale_paket_internet where id_paket='$id_paket'");
		$tampil_paket=mysqli_fetch_array($query_paket);
		$harga=$tampil_paket['harga'];

		$harga_ip_publik=0;
		if($ip_publik=="IYA") {
			$harga_ip_publik=100000;
		}

		$tunggakan=$billing_bulan_berjalan-$billing_bulan_terbayar;

		$tunggakan_paket=$tunggakan*$harga;

		$tunggakan_ip_publik=$tunggakan*$harga_ip_publik;

		$harga_dan_ip_publik=$harga+$harga_ip_publik;

		$total_tunggakan=$tunggakan_paket+$tunggakan_ip_publik;

		//eksekusi
		$total_dana=$bayar+$restitusi+$billing_saldo;

		if($total_dana>=$total_tunggakan) {
			//iki yen duit e turah soko tunggakan
			$update_billing_saldo=$total_dana-$total_tunggakan;
			$update_bulan_terbayar=$billing_bulan_berjalan;
			$proses_update=mysqli_query($koneksi,"update sale_register set billing_saldo='$update_billing_saldo', billing_bulan_terbayar='$update_bulan_terbayar', billing_total_bayar=billing_total_bayar+'$bayar', billing_total_restitusi=billing_total_restitusi+'$restitusi' where id_register='$id_register'");
		} else {
			if($total_dana>=$harga_dan_ip_publik) {
				$update_billing_saldo=$total_dana%$harga_dan_ip_publik;
				$total_dana=$total_dana-$update_billing_saldo;
				$update_bulan_terbayar=$total_dana/$harga_dan_ip_publik;
				$proses_update=mysqli_query($koneksi,"update sale_register set billing_saldo='$update_billing_saldo', billing_bulan_terbayar=billing_bulan_terbayar+'$update_bulan_terbayar', billing_total_bayar=billing_total_bayar+'$bayar', billing_total_restitusi=billing_total_restitusi+'$restitusi' where id_register='$id_register'");
			} else {
				$update_billing_saldo=$total_dana;
				$proses_update=mysqli_query($koneksi,"update sale_register set billing_saldo=billing_saldo+'$update_billing_saldo', billing_total_bayar=billing_total_bayar+'$bayar', billing_total_restitusi=billing_total_restitusi+'$restitusi' where id_register='$id_register'");
			}
		}
		mysqli_query($koneksi,"delete from billing_pembayaran_tidak_terdeteksi where id_pembayaran_tidak_terdeteksi='$id_pembayaran'");
	}

	//----------------------------------------Function Select----------------------------------------\\
	function select_log_pembayaran_perhari($tanggal_awal,$tanggal_akhir,$via,$nama_user) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from billing_log_pembayaran left join sale_register on billing_log_pembayaran.id_register=sale_register.id_register where billing_log_pembayaran.waktu_pembayaran between '$tanggal_awal 00:00:00' and  '$tanggal_akhir 23:59:59' and billing_log_pembayaran.via like '%$via%' and sale_register.nama_user like '%$nama_user%'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_tagihan() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select id_register, alamat, nama_user, nama_instansi, billing_saldo, ip_publik, id_paket, (billing_bulan_berjalan-billing_bulan_terbayar) from sale_register order by (billing_bulan_berjalan-billing_bulan_terbayar) DESC");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_register_menu_cetak_invoice() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing where sale_register.billing_print_invoice='IYA'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_register_menu_download_invoice() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing where sale_register.billing_download_invoice='IYA'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_register_tambah_daftar_menu_cetak_invoice() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing where sale_register.billing_print_invoice='TIDAK' and sale_register.status='Close'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_register_tambah_daftar_menu_download_invoice() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing where sale_register.billing_download_invoice='TIDAK' and sale_register.status='Close'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_billing_po($where) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing $where");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_pembayaran_tidak_terdeteksi($bank) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from billing_pembayaran_tidak_terdeteksi where bank='$bank' order by waktu_pembayaran DESC");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_proses_pembayaran_tidak_terdeteksi($id_pembayaran) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from billing_pembayaran_tidak_terdeteksi where id_pembayaran_tidak_terdeteksi='$id_pembayaran'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}


	function select_register_orderby_nama() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register where status='Close' order by nama_user");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_data_user_close() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register left join sale_paket_internet on sale_register.id_paket=sale_paket_internet.id_paket where sale_register.status='Close'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_data_user_hold() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register where status='Hold'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_tagihan_peruser($id_register) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register left join sale_paket_internet on sale_register.id_paket=sale_paket_internet.id_paket where sale_register.id_register='$id_register'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_tagihan_dialup_peruser($costumer_id) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from billing_tagihan_dialup where costumer_id='$costumer_id'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_tagihan_user_baru($id_po) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from billing_po where id_po='$id_po'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}
	
	function select_detail_user_trial($id_register) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register where id_register='$id_register'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}
	
	function select_dashboard_tagihan_user_baru() {
		include "../../koneksi/koneksi.php";

		$query_po=mysqli_query($koneksi,"select * from billing_po where status_po like '%Belum%'");
		$jumlah_po=mysqli_num_rows($query_po);
		return $jumlah_po;
	}
	
	function select_dashboard_tagihan_bulanan_access() {
		include "../../koneksi/koneksi.php";

		$query_tagihan=mysqli_query($koneksi,"select * from sale_register");
		$jumlah_tagihan_bulanan_access = 0;
		while($tampil_tagihan=mysqli_fetch_array($query_tagihan)) {
			$bulan_berjalan=$tampil_tagihan['billing_bulan_berjalan'];
			$bulan_terbayar=$tampil_tagihan['billing_bulan_terbayar'];
			$tunggakan=$bulan_berjalan - $bulan_terbayar;
			if($tunggakan>=1) {
				$jumlah_tagihan_bulanan_access = $jumlah_tagihan_bulanan_access + 1;
			}
		}
		return $jumlah_tagihan_bulanan_access;
	}

	function select_dashboard_total_user_close() {
		include "../../koneksi/koneksi.php";

		$query_register=mysqli_query($koneksi,"select * from sale_register where status='Close'");
		$jumlah_register=mysqli_num_rows($query_register);
		return $jumlah_register;
	}

	function select_dashboard_total_semua_tagihan() {
		include "../../koneksi/koneksi.php";

		$query_register=mysqli_query($koneksi,"select * from sale_register left join sale_paket_internet on sale_register.id_paket=sale_paket_internet.id_paket where sale_register.status='Close'");
		$total_tagihan="0";
		while($tampil_register=mysqli_fetch_array($query_register)){
			$total_tagihan=$total_tagihan+$tampil_register['harga'];
		}
		return $total_tagihan;
	}

	function select_dashboard_total_log_pembayaran_bulan_ini($tanggal_hari_ini) {
		include "../../koneksi/koneksi.php";

		$bulan=date('Y-m', strtotime($tanggal_hari_ini));
		$query_log_pembayaran=mysqli_query($koneksi,"select sum(bayar) from billing_log_pembayaran where waktu_pembayaran between '$bulan-01 00:00:00' and  '$bulan-31 23:59:59'");
		$tampil_log_pembayaran=mysqli_fetch_array($query_log_pembayaran);
		$jumlah_log_pembayaran=$tampil_log_pembayaran['sum(bayar)'];
		return $jumlah_log_pembayaran;
	}

	function select_dashboard_total_piutang() {
		include "../../koneksi/koneksi.php";

		$piutang = 0;
		$query_tagihan = mysqli_query($koneksi,"select id_register,(billing_bulan_berjalan-billing_bulan_terbayar) from sale_register where (billing_bulan_berjalan-billing_bulan_terbayar)>='1'");
		while($tampil_tagihan = mysqli_fetch_array($query_tagihan)){
			$id_register = $tampil_tagihan['id_register'];
			$tunggakan = $tampil_tagihan['(billing_bulan_berjalan-billing_bulan_terbayar)'];

			$query_register_paket = mysqli_query($koneksi,"select * from sale_register left join sale_paket_internet on sale_register.id_paket=sale_paket_internet.id_paket where sale_register.id_register='$id_register'");
			$tampil_register_paket = mysqli_fetch_array($query_register_paket);
			$harga = $tampil_register_paket['harga'] * $tunggakan;
			$piutang = $piutang + $harga;

		}
		return $piutang;
	}

	function select_dashboard_total_restitusi($tanggal_hari_ini) {
		include "../../koneksi/koneksi.php";

		$bulan=date('Y-m', strtotime($tanggal_hari_ini));
		$query_log_pembayaran=mysqli_query($koneksi,"select sum(restitusi) from billing_log_pembayaran where waktu_pembayaran between '$bulan-01 00:00:00' and  '$bulan-31 23:59:59'");
		$tampil_log_pembayaran=mysqli_fetch_array($query_log_pembayaran);
		$jumlah_log_pembayaran=$tampil_log_pembayaran['sum(restitusi)'];
		return $jumlah_log_pembayaran;
	}

	function select_dashboard_total_sisa_pembayaran() {
		include "../../koneksi/koneksi.php";

		$query_sisa_pembayaran=mysqli_query($koneksi,"select sum(sisa_pembayaran) from billing_tagihan");
		$tampil_sisa_pembayaran=mysqli_fetch_array($query_sisa_pembayaran);
		$jumlah_sisa_pembayaran=$tampil_sisa_pembayaran['sum(sisa_pembayaran)'];
		return $jumlah_sisa_pembayaran;
	}

	function select_dashboard_total_pembayaran_tidak_terdeteksi() {
		include "../../koneksi/koneksi.php";

		$query_sisa_pembayaran=mysqli_query($koneksi,"select sum(nominal) from billing_pembayaran_tidak_terdeteksi");
		$tampil_sisa_pembayaran=mysqli_fetch_array($query_sisa_pembayaran);
		$jumlah_sisa_pembayaran=$tampil_sisa_pembayaran['sum(nominal)'];
		return $jumlah_sisa_pembayaran;
	}

	function select_dashboard_jumlah_pembayaran_tidak_terdeteksi() {
		include "../../koneksi/koneksi.php";

		$query_sisa_pembayaran=mysqli_query($koneksi,"select * from billing_pembayaran_tidak_terdeteksi");
		$tampil_sisa_pembayaran=mysqli_num_rows($query_sisa_pembayaran);
		return $tampil_sisa_pembayaran;
	}

	function select_dashboard_piutang_bulan_berjalan() {
		include "../../koneksi/koneksi.php";

		$piutang = 0;
		$query_tagihan = mysqli_query($koneksi,"select id_register,(billing_bulan_berjalan-billing_bulan_terbayar) from sale_register where (billing_bulan_berjalan-billing_bulan_terbayar)>='1'");
		while($tampil_tagihan = mysqli_fetch_array($query_tagihan)){
			$id_register = $tampil_tagihan['id_register'];

			$query_register_paket = mysqli_query($koneksi,"select * from sale_register left join sale_paket_internet on sale_register.id_paket=sale_paket_internet.id_paket where sale_register.id_register='$id_register'");
			$tampil_register_paket = mysqli_fetch_array($query_register_paket);
			$harga = $tampil_register_paket['harga'];
			$piutang = $piutang + $harga;

		}
		return $piutang;
	}

	function select_data_sale_paket() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_paket_internet");
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

	function select_detail_piutang_access_setiap_bulan($bulan) {
		include "../../koneksi/koneksi.php";

		$piutang = 0;
		$query_tagihan = mysqli_query($koneksi,"select id_register,(billing_bulan_berjalan-billing_bulan_terbayar) from sale_register where (billing_bulan_berjalan-billing_bulan_terbayar)>='$bulan'");
		while($tampil_tagihan = mysqli_fetch_array($query_tagihan)){
			$id_register = $tampil_tagihan['id_register'];

			$query_register_paket = mysqli_query($koneksi,"select * from sale_register left join sale_paket_internet on sale_register.id_paket=sale_paket_internet.id_paket where sale_register.id_register='$id_register'");
			$tampil_register_paket = mysqli_fetch_array($query_register_paket);
			$harga = $tampil_register_paket['harga'];
			$piutang = $piutang + $harga;

		}
		return $piutang;
	}

	function select_detail_piutang_access_setiap_bulan_jumlah_user($bulan) {
		include "../../koneksi/koneksi.php";

		$query_tagihan = mysqli_query($koneksi,"select id_register,(billing_bulan_berjalan-billing_bulan_terbayar) from sale_register where (billing_bulan_berjalan-billing_bulan_terbayar)>='$bulan'");
		$jumlah_query = mysqli_num_rows($query_tagihan);
		return $jumlah_query;
	}

	function select_tagihan_bulan($bulan) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select id_register, nama_instansi, alamat, nama_user, billing_saldo, ip_publik, id_paket, (billing_bulan_berjalan-billing_bulan_terbayar) from sale_register where (billing_bulan_berjalan-billing_bulan_terbayar)>='$bulan'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_tagihan_dialup() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from billing_tagihan_dialup");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_tagihan_dialup_close() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from billing_tagihan_dialup where status='Close'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function update_holding_user($id_register, $catatan) {
		include "../../koneksi/koneksi.php";

		mysqli_query($koneksi,"update sale_register set status='Hold', catatan='$catatan' where id_register='$id_register'");
		header('location:?page=page_access_data_user_close');
	}

	function update_data_register_user() {
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
	    $koordinat=$_POST['koordinat'];
	    $id_marketing=$login_id_marketing;
	    $status="Close";
	    $catatan=$_POST['catatan'];
	    $tanggal_trial=date('Y-m-d');
	    $tanggal_close=date('Y-m-d', strtotime('+5 days', strtotime($tanggal_trial))); // iki tanggal close
	    
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

	    mysqli_query($koneksi,"UPDATE `sale_register` SET `id_register`='$id_register', `nik`='$nik', `nama_user`='$nama_user', `nama_instansi`='$nama_instansi', `jenis_kelamin`='$jenis_kelamin', `tempat_lahir`='$tempat_lahir', `tanggal_lahir`='$tanggal_lahir', `telp`='$telp', `email`='$email', `alamat`='$alamat', `koordinat`='$koordinat', `status`='$status', `tanggal_trial`='$tanggal_trial', `tanggal_close`='$tanggal_close', `id_paket`='$id_paket', `id_bts`='$id_bts', `id_radio`='$id_radio', `jumlah_radio`='$jumlah_radio', `harga_radio`='$harga_radio', `status_radio`='$status_radio', `id_antena`='$id_antena', `jumlah_antena`='$jumlah_antena', `harga_antena`='$harga_antena', `status_antena`='$status_antena', `id_wifi`='$id_wifi', `jumlah_wifi`='$jumlah_wifi', `harga_wifi`='$harga_wifi', `status_wifi`='$status_wifi', `id_tower`='$id_tower', `jumlah_tower`='$jumlah_tower', `harga_tower`='$harga_tower', `status_tower`='$status_tower', `id_kabel`='$id_kabel', `panjang_kabel`='$panjang_kabel', `harga_kabel`='$harga_kabel', `status_kabel`='$status_kabel', biaya_registrasi='$biaya_registrasi' WHERE id_register='$id_register'");
	}

	function update_reclossing_user() {
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

	    mysqli_query($koneksi,"INSERT INTO `billing_po`(`id_register`, `biaya_registrasi`, `tanggal_registrasi`, `money_fee`, `biaya_ip_publik`, `id_radio`, `status_radio`, `jumlah_radio`, `harga_radio`, `id_antena`, `status_antena`, `jumlah_antena`, `harga_antena`, `id_wifi`, `status_wifi`, `jumlah_wifi`, `harga_wifi`, `id_kabel`, `status_kabel`, `panjang_kabel`, `harga_kabel`, `id_tower`, `status_tower`, `jumlah_tower`, `harga_tower`, `status`) VALUES ('$id_register', '$biaya_registrasi', '$tanggal_registrasi', '$money_fee', '$biaya_ip_publik', '$id_radio', '$status_radio', '$jumlah_radio', '$harga_radio', '$id_antena', '$status_antena', '$jumlah_antena', '$harga_antena', '$id_wifi', '$status_wifi', '$jumlah_wifi', '$harga_wifi', '$id_kabel', '$status_kabel', '$panjang_kabel', '$harga_kabel', '$id_tower', '$status_tower', '$jumlah_tower', '$harga_tower', '$status')");

		mysqli_query($koneksi,"update sale_register set tanggal_close='$tanggal_close_baru', status='Close' where id_register='$id_register'");
	}
	
	function update_status_ppn($status, $id_po) {
		include "../../koneksi/koneksi.php";

		mysqli_query($koneksi,"update billing_po set ppn='$status' where id_po='$id_po'");
	}

	function update_biaya_penagihan($update_biaya_penagihan, $costumer_id) {
		include "../../koneksi/koneksi.php";

		mysqli_query($koneksi,"update billing_tagihan_dialup set billing_biaya_penagihan='$update_biaya_penagihan' where costumer_id='$costumer_id'");
	}

	//--------------------------------------! Function Select !--------------------------------------\\
	function update_tagihan_bulanan() {
		include "../../koneksi/koneksi.php";
		$query_tagihan=mysqli_query($koneksi,"select * from sale_register left join sale_paket_internet on sale_register.id_paket=sale_paket_internet.id_paket where sale_register.status='Close'");
		while($tampil_tagihan=mysqli_fetch_array($query_tagihan)) {
			$id_register=$tampil_tagihan['id_register'];
			$sisa_pembayaran=$tampil_tagihan['billing_saldo'];
			$harga=$tampil_tagihan['harga'];
			//proses update billing_tagihan bulanan
			mysqli_query($koneksi,"update sale_register set billing_bulan_berjalan=billing_bulan_berjalan+'1' where id_register='$id_register'");

			$query_user=mysqli_query($koneksi,"select * from sale_register where id_register='$id_register'");
			$tampil_user=mysqli_fetch_array($query_user);
			$id_paket=$tampil_user['id_paket'];
			$ip_publik=$tampil_user['ip_publik'];
			$harga_ip_publik=0;
			if($ip_publik=="IYA") {
				$harga_ip_publik=100000;
			}

			//melihat data id paket
			$query_paket=mysqli_query($koneksi,"select * from sale_paket_internet where id_paket='$id_paket'");
			$tampil_paket=mysqli_fetch_array($query_paket);
			$harga=$tampil_paket['harga'];

			$harga_dan_ip_publik=$harga+$harga_ip_publik;

			//melihat data table billing_tagihan
			$query_tagihan_1=mysqli_query($koneksi,"select * from sale_register where id_register='$id_register'");
			$tampil_tagihan_1=mysqli_fetch_array($query_tagihan_1);
			$billing_bulan_berjalan=$tampil_tagihan_1['billing_bulan_berjalan'];
			$billing_bulan_terbayar=$tampil_tagihan_1['billing_bulan_terbayar'];
			$tunggakan=$billing_bulan_berjalan-$billing_bulan_terbayar;
			$piutang=$harga_dan_ip_publik*$tunggakan;
			$sisa_pembayaran=$tampil_tagihan_1['billing_saldo'];
			$total_bayar=$tampil_tagihan_1['billing_total_bayar'];
			$total_restitusi=$tampil_tagihan_1['billing_total_restitusi'];


			$total_dana=$sisa_pembayaran;
			if($total_dana>=$piutang) {
			//iki yen duit e turah soko tunggakan
			$update_billing_saldo=$total_dana-$piutang;
			$update_bulan_terbayar=$billing_bulan_berjalan;
			$proses_update=mysqli_query($koneksi,"update sale_register set billing_saldo='$update_billing_saldo', billing_bulan_terbayar='$update_bulan_terbayar' where id_register='$id_register'");
			} else {
				if($total_dana>=$harga_dan_ip_publik) {
					$update_billing_saldo=$total_dana%$harga_dan_ip_publik;
					$total_dana=$total_dana-$update_billing_saldo;
					$update_bulan_terbayar=$total_dana/$harga_dan_ip_publik;
					$proses_update=mysqli_query($koneksi,"update sale_register set billing_saldo='$update_billing_saldo', billing_bulan_terbayar=billing_bulan_terbayar+'$update_bulan_terbayar' where id_register='$id_register'");
				} else {
					$update_billing_saldo=$total_dana;
					$proses_update=mysqli_query($koneksi,"update sale_register set billing_saldo=billing_saldo+'$update_billing_saldo' where id_register='$id_register'");
				}
			}
		}
	}

	function backup_log_user() {
		include "../../koneksi/koneksi.php";

		$query = mysqli_query($koneksi, "select * from sale_register where status='Close'");
		while($data = mysqli_fetch_array($query)) {
			$id_register=$data['id_register'];
			$id_paket=$data['id_paket'];
			$bulan=date('Y-m-d');

			mysqli_query($koneksi, "insert into billing_backup_log_user (id_register, id_paket, bulan) values ('$id_register', '$id_paket', '$bulan')");
		}
	}

	function update_user_tagihan() {
		include "../../koneksi/koneksi.php";

		$query_user=mysqli_query($koneksi,"select * from sale_register where status='Close'");
		while($menampilkan_user=mysqli_fetch_array($query_user)) {
			$id_register=$menampilkan_user['id_register'];

			$query_tagihan=mysqli_query($koneksi,"select * from billing_tagihan where id_register='$id_register'");
			$jumlah_tagihan=mysqli_num_rows($query_tagihan);
			if($jumlah_tagihan==0) {
				mysqli_query($koneksi,"insert into billing_tagihan (id_register, bulan_berjalan, bulan_terbayar, piutang, total_bayar, total_restitusi) value ('$id_register', '1', '1', '0', '0', '0')");
			}
		}
	}

	function update_tagihan_dialup() {
		include "../../koneksi/koneksi.php";

		$costumer_id=$_POST['costumer_id'];
		$billing_monthly_fee=$_POST['billing_monthly_fee'];
		$billing_email=$_POST['billing_email'];

		mysqli_query($koneksi,"update billing_tagihan_dialup set billing_monthly_fee='$billing_monthly_fee', billing_email='$billing_email' where costumer_id='$costumer_id'");
	}

	function edit_paket_internet() {
		include "../../koneksi/koneksi.php";

		$id_register = $_POST['id_register'];
		$id_paket = $_POST['id_paket'];
		mysqli_query($koneksi,"update sale_register set id_paket='$id_paket' where id_register='$id_register'");
	}

	function teknisi_update_tunggakan() {
		$id_register=$_GET['id_register'];
		$tunggakan=$_GET['tunggakan'];

		$query_register=mysqli_query($koneksi,"select * from sale_register left join sale_paket_internet on sale_register.id_paket=sale_paket_internet.id_paket where sale_register.nama_user='$nama_user_tunggakan'");
		$tampil_register=mysqli_fetch_array($query_register);
		$harga=$tampil_register['harga'];

		$piutang=$tunggakan * $harga;
		$bulan_berjalan=$tunggakan+1;
		mysqli_query($koneksi,"update billing_tagihan set bulan_berjalan='$bulan_berjalan', bulan_terbayar='1', piutang='$piutang' where id_register='$id_register'");
	}

	function select_paket_internet() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_paket_internet");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}


	//----------------------------------! TEKNISI !-----------------------------------------\\
	function select_teknisi_register() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register left join billing_tagihan on billing_tagihan.id_register=sale_register.id_register");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function teknisi_update_piutang($id_register) {
		include "../../koneksi/koneksi.php";

		$query_register=mysqli_query($koneksi,"select * from billing_tagihan left join sale_register on billing_tagihan.id_register=sale_register.id_register left join sale_paket_internet on sale_register.id_paket=sale_paket_internet.id_paket where sale_register.id_register='$id_register'");

		while($tampil_tagihan=mysqli_fetch_array($query_register)) {
			$id_register=$tampil_tagihan['id_register'];
			$sisa_pembayaran=$tampil_tagihan['sisa_pembayaran'];
			$harga=$tampil_tagihan['harga'];
			$bulan_berjalan=$tampil_tagihan['bulan_berjalan'];
			$bulan_terbayar=$tampil_tagihan['bulan_terbayar'];

			$tunggakan=$bulan_berjalan-$bulan_terbayar;

			$piutang=$tunggakan*$harga;
			//proses update billing_tagihan bulanan
			mysqli_query($koneksi,"update billing_tagihan set piutang='$piutang', total_bayar='$harga' where id_register='$id_register'");		
		}
	}

	function teknisi_edit_data_register() {
		include "../../koneksi/koneksi.php";

		$id_register=$_POST['id_register'];
		$nama_user=$_POST['nama_user'];
		$nik=$_POST['nik'];
		$telp=$_POST['telp'];
		$email=$_POST['email'];
		$id_paket=$_POST['id_paket'];
		$tunggakan=$_POST['tunggakan'];

		$bulan_berjalan=$tunggakan+1;

		$piutang=$tampil_paket['harga'] * $tunggakan;

		mysqli_query($koneksi,"update sale_register set nama_user='$nama_user', nik='$nik', telp='$telp', email='$email', id_paket='$id_paket' where id_register='$id_register'");
		mysqli_query($koneksi,"update billing_tagihan set bulan_berjalan='$bulan_berjalan', bulan_terbayar='1' where id_register='$id_register'");

		//header('location:index.php');
	}

	function hapus_data_paket() {
		include "../../koneksi/koneksi.php";

		$id_paket=$_POST['id_paket'];

		mysqli_query($koneksi,"delete from sale_paket_internet where id_paket='$id_paket'");
	}

	function hapus_transaksi_tidak_teridentifikasi($id_pembayaran) {
		include "../../koneksi/koneksi.php";

		mysqli_query($koneksi,"delete from billing_pembayaran_tidak_terdeteksi where id_pembayaran_tidak_terdeteksi='$id_pembayaran'");
	}

	function hapus_daftar_cetak_invoice($id_register) {
		include "../../koneksi/koneksi.php";

		mysqli_query($koneksi,"update sale_register set billing_print_invoice='TIDAK' where id_register='$id_register'");
	}

	function hapus_daftar_download_invoice($id_register) {
		include "../../koneksi/koneksi.php";

		mysqli_query($koneksi,"update sale_register set billing_download_invoice='TIDAK' where id_register='$id_register'");
	}

	function insert_data_paket() {
		include "../../koneksi/koneksi.php";

		$id_paket=$_POST['id_paket'];
		$nama_paket=$_POST['nama_paket'];
		$harga=$_POST['harga'];

		mysqli_query($koneksi,"insert into sale_paket_internet (id_paket, nama_paket, harga) value ('$id_paket', '$nama_paket', '$harga')");
	}

	function update_paket_internet() {
		include "../../koneksi/koneksi.php";

		$id_paket=$_POST['id_paket'];
		$nama_paket=$_POST['nama_paket'];
		$harga=$_POST['harga'];

		mysqli_query($koneksi,"update sale_paket_internet set nama_paket='$nama_paket', harga='$harga' where id_paket='$id_paket'");
	}

	function update_alamat_user() {
		include "../../koneksi/koneksi.php";

		
		$nama_user = $_POST['nama_user'];
		$nama_instansi = $_POST['nama_instansi'];
		$id_register = $_POST['id_register'];

		$alamat_1 = $_POST['alamat_1'];
		$alamat_2 = $_POST['alamat_2'];
		$alamat_3 = $_POST['alamat_3'];
		$alamat_4 = $_POST['alamat_4'];
		$alamat_5 = $_POST['alamat_5'];
		$alamat_6 = $_POST['alamat_6'];
		$alamat = $alamat_1."#".$alamat_2."#".$alamat_3."#".$alamat_4."#".$alamat_5."#".$alamat_6;

		$telp = $_POST['telp'];

		mysqli_query($koneksi,"update sale_register set nama_user='$nama_user', nama_instansi='$nama_instansi',  alamat='$alamat', telp='$telp' where id_register='$id_register'");
	}

	// -------------------------------------------! ADMIN !------------------------------------------------ \\
	function select_access_rekap_transaksi_bulanan($bank, $tahun, $bulan) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from billing_log_pembayaran where keterangan='Tagihan Bulanan Access' and waktu_pembayaran between '$tahun-$bulan-1 00:00:00' and '$tahun-$bulan-31 23:59:59' and via='$bank'");
		$data=0;
		while($tampil=mysqli_fetch_array($query)) {
			$bayar=$tampil['bayar'];
			$data=$data+$bayar;
		}
		return $data;
	}

	function select_access_transaksi_bulanan($bank, $tahun_bulan, $i) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from billing_log_pembayaran where keterangan='Tagihan Bulanan Access' and waktu_pembayaran between '$tahun_bulan-$i 00:00:00' and '$tahun_bulan-$i 23:59:59' and via='$bank'");
		$data=0;
		while($tampil=mysqli_fetch_array($query)) {
			$bayar=$tampil['bayar'];
			$data=$data+$bayar;
		}
		return $data;
	}

	// -------------------------------------------! ADMIN !------------------------------------------------ \\

	function cek_total_log($bulan, $tahun){
		include "../../koneksi/koneksi.php";

		$bulan = $tahun."-".$bulan;
		$total = 0;
		$query=mysqli_query($koneksi,"select * from billing_backup_log_user left join sale_paket_internet on billing_backup_log_user.id_paket=sale_paket_internet.id_paket where billing_backup_log_user.bulan like '%$bulan%'");
		while($tampil=mysqli_fetch_array($query)){
			$harga = $tampil['harga'];
			$total = $total + $harga;
		}
		return $total;
	}
}

class select {
	function select_data_marketing(){
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_marketing");
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

	function select_data_user_close_di_table_backup($id_marketing){
		include "../../koneksi/koneksi.php";
		$total = "0";
		$bulan_awal = date('Y-m-')."1";
		$bulan_akhir = date('Y-m-')."31";
		$query=mysqli_query($koneksi,"select * from billing_backup_log_user left join sale_register on billing_backup_log_user.id_register=sale_register.id_register left join sale_paket_internet on sale_paket_internet.id_paket=sale_register.id_paket where billing_backup_log_user.bulan between '$bulan_awal' and '$bulan_akhir' and sale_register.id_marketing='$id_marketing'");
		while($data=mysqli_fetch_array($query)){
			$harga=$data['bonus_marketing'];
			$total = $total+$harga;
		}
		return $total;
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
}

class update {
	function rubah_subsidi_marketing($id_marketing, $nominal_subsidi) {
		include "../../koneksi/koneksi.php";

		//cek sudah ada belum data subsidi untuk user tersebut di bulan tersebut
		$bulan_ini = date('Y-m-');
		$tanggal_ini = date('Y-m-d');

		echo $nominal_subsidi;

		$query = mysqli_query($koneksi,"select * from sale_subsidi_marketing where id_marketing='$id_marketing' and tanggal_subsidi like '%$bulan_ini%'");
		$data_query = mysqli_fetch_array($query);
		$jumlah_query = mysqli_num_rows($query);
		if($jumlah_query>0){
			echo $id_sale_subsidi_marketing = $data_query['id_sale_subsidi_marketing'];
			mysqli_query($koneksi,"update sale_subsidi_marketing set nominal_subsidi='$nominal_subsidi' where id_sale_subsidi_marketing='$id_sale_subsidi_marketing'");
		} else {
			mysqli_query($koneksi,"insert into sale_subsidi_marketing (tanggal_subsidi, id_marketing, nominal_subsidi) value ('$tanggal_ini', '$id_marketing', '$nominal_subsidi')");
		}
	}
}

class login {
	function proses_login() {
		$username=$_POST['username'];
		$password=$_POST['password'];

		if($username=="teknisi" and $password="teknisi") {
			$_SESSION['username_teknisi']="teknisi";
		} else
		if($username=="atik" and $password="atik") {
			$_SESSION['username_billing']="billing";
		}
	}
}
?>