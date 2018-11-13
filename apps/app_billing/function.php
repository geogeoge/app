<?php
class crud {
	function tanggal_hari_ini() {
		include "../../koneksi/koneksi.php";
		$query_tanggal_hari_ini=mysqli_query($koneksi,"select * from billing_simulasi_tanggal where id='1'");
		$tampil_tanggal_hari_ini=mysqli_fetch_array($query_tanggal_hari_ini);
		$tanggal_hari_ini=date('Y-m-d');
		return $tanggal_hari_ini;
	}

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

		$catatan=$_POST['catatan'];
		
		$keterangan="A";
		
		$tambahan_keterangan = "";
		if($via=="2") {
		    $via = "2";
		    $tambahan_keterangan = " | BCA";
		} else 
		if($via=="3") {
		    $via = "2";
		    $tambahan_keterangan = " | BNI";
		} else 
		if($via=="4") {
		    $via = "2";
		    $tambahan_keterangan = " | BRI";
		} else 
		if($via=="5") {
		    $via = "2";
		    $tambahan_keterangan = " | MANDIRI";
		} else 
		if($via=="6") {
		    $via = "2";
		    $tambahan_keterangan = " | BPD";
		} else {
		    $via = "1";
		    $tambahan_keterangan = "";
		}


		//proses ke log pembayaran
		mysqli_query($koneksi, "insert into billing_log_pembayaran (waktu_pembayaran, keterangan, id_register, via, bayar, restitusi, catatan_pembayaran) value ('$waktu_pembayaran', '$keterangan', '$id_register', '$via', '$bayar', '$restitusi', '$catatan')") or die(mysqli_error());

		$query_billing_log = mysqli_query($koneksi,"SELECT * FROM `billing_log_pembayaran` ORDER BY no DESC LIMIT 1");
		$data_billing_log = mysqli_fetch_array($query_billing_log);
		$no_log_pembayaran = $data_billing_log['no'];

		$query_sale_register_where_id_register = mysqli_query($koneksi,"SELECT * FROM sale_register WHERE id_register='$id_register'");
		$data_sale_register_where_id_register = mysqli_fetch_array($query_sale_register_where_id_register);
		$nama_user = $data_sale_register_where_id_register['nama_user'];

		$keterangan_data_temp = "Pembayaran Internet ( ".$nama_user." )";
		$id_account = $via;
		$in_out = "i";
		$status = "belum";
		$ekstra = "access";
		
		if($_POST['penagih']=="eko"){
			    $tambahan_keterangan = " | Pak Eko".$tambahan_keterangan;
        }
                
        $keterangan_data_temp_restitusi = "Restitusi Internet ( ".$nama_user." ( ".$catatan." ) )";
		
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


		if($billing_saldo>=1){
			$katerangan_post = "Sisa Pembayaran Sebelumnya ( ".$nama_user." )";
			$id_account_billing_saldo = '23';
		    $this->input_data_temp_posting($waktu_pembayaran, $katerangan_post, $no_log_pembayaran,$billing_saldo, $id_account, 'o', 'belum', 'access', $id_account_billing_saldo);
		}
		
		if($restitusi>=1){
			$katerangan_post = "Restitusi Internet ( ".$nama_user." (".$catatan.") )";
		    $this->input_data_temp_posting($waktu_pembayaran, $katerangan_post, $no_log_pembayaran, $restitusi, $id_account, 'o', 'belum', 'access', '58');
		}


		if($total_dana>=$total_tunggakan) {
			//iki yen duit e turah soko tunggakan
			$update_billing_saldo=$total_dana-$total_tunggakan;
			$update_bulan_terbayar=$billing_bulan_berjalan;
			$proses_update=mysqli_query($koneksi,"update sale_register set billing_saldo='$update_billing_saldo', billing_bulan_terbayar='$update_bulan_terbayar', billing_total_bayar=billing_total_bayar+'$bayar', billing_total_restitusi=billing_total_restitusi+'$restitusi' where id_register='$id_register'");


			//Bagian Akuntansi
			$pembayaran_internet = $total_tunggakan - $tunggakan_ip_publik;

			//Pendapatan Internet Pada Piutang
			if($pembayaran_internet>=1){
				$katerangan_post = "Pembayaran Internet ( ".$nama_user." )".$tambahan_keterangan;
				$this->input_data_temp_posting($waktu_pembayaran, $katerangan_post, $no_log_pembayaran, $pembayaran_internet, $id_account, 'i', 'belum', 'access', '3');
			}

			//Pembayaran IP Public
			if($tunggakan_ip_publik>=1){
				$katerangan_post = "Pembayaran IP Public ( ".$nama_user." )";
			    $this->input_data_temp_posting($waktu_pembayaran, $katerangan_post, $no_log_pembayaran, $tunggakan_ip_publik, $id_account, 'i', 'belum', 'access', '36');
			}

			//jika ada sisa
			if($update_billing_saldo>=1){
				$katerangan_post = "Saldo Internet ( ".$nama_user." )";
			    $this->input_data_temp_posting($waktu_pembayaran, $katerangan_post, $no_log_pembayaran, $update_billing_saldo, $id_account, 'i', 'belum', 'access', '58');
			}
		} else {
			if($total_dana>=$harga_dan_ip_publik) {
				$update_billing_saldo=$total_dana%$harga_dan_ip_publik;
				$total_dana=$total_dana-$update_billing_saldo;
				$update_bulan_terbayar=$total_dana/$harga_dan_ip_publik;
				$proses_update=mysqli_query($koneksi,"update sale_register set billing_saldo='$update_billing_saldo', billing_bulan_terbayar=billing_bulan_terbayar+'$update_bulan_terbayar', billing_total_bayar=billing_total_bayar+'$bayar', billing_total_restitusi=billing_total_restitusi+'$restitusi' where id_register='$id_register'");

				//Bagian Akuntansi
				$tunggakan_ip_publik = $harga_ip_publik * $update_bulan_terbayar;
				$pembayaran_internet = $total_dana - $tunggakan_ip_publik;

				//Pendapatan Internet Pada Piutang
				$katerangan_post = "Pembayaran Internet ( ".$nama_user." )".$tambahan_keterangan;
				$this->input_data_temp_posting($waktu_pembayaran, $katerangan_post, $no_log_pembayaran, $pembayaran_internet, $id_account, 'i', 'belum', 'access', '3');

				if($tunggakan_ip_publik>=1){
					$katerangan_post = "Pembayaran IP Public ( ".$nama_user." )";
				    $this->input_data_temp_posting($waktu_pembayaran, $katerangan_post, $no_log_pembayaran, $tunggakan_ip_publik, $id_account, 'i', 'belum', 'access', '36');
				}

				//jika ada sisa
				if($update_billing_saldo>=1){
					$katerangan_post = "Saldo Internet ( ".$nama_user." )";
				    $this->input_data_temp_posting($waktu_pembayaran, $katerangan_post, $no_log_pembayaran, $update_billing_saldo, $id_account, 'i', 'belum', 'access', '58');
				}
			} else {
				$update_billing_saldo=$total_dana;
				$proses_update=mysqli_query($koneksi,"update sale_register set billing_saldo=billing_saldo+'$update_billing_saldo', billing_total_bayar=billing_total_bayar+'$bayar', billing_total_restitusi=billing_total_restitusi+'$restitusi' where id_register='$id_register'");

				$katerangan_post = "Saldo Internet ( ".$nama_user." )".$tambahan_keterangan;
				$this->input_data_temp_posting($waktu_pembayaran, $katerangan_post, $no_log_pembayaran, $update_billing_saldo, $id_account, 'i', 'belum', 'access', '58');
			}
		}
		
	}

	function insert_pembayaran_access_user_baru() {
		include "../../koneksi/koneksi.php";

		$id_register=$_POST['id_register'];
		$via=$_POST['via'];
		$waktu_pembayaran=$_POST['tanggal']." ". date("h:i:sa");

		$nominal_restitusi=$_POST['restitusi'];
		$pecah_rastitasi=explode(".", $nominal_restitusi);
		$restitusi=implode("", $pecah_rastitasi);

		$nominal_bayar=$_POST['bayar'];
		$pecah_bayar=explode(".", $nominal_bayar);
		$bayar=implode("", $pecah_bayar);

		$catatan=$_POST['catatan'];
		
		$keterangan="B";

		$tanggal_close = date('Y-m-d');
		//proses ke log pembayaran
		
		
		if($via=="2") {
		    $via = "2";
		    $tambahan_keterangan = " | BCA";
		} else 
		if($via=="3") {
		    $via = "2";
		    $tambahan_keterangan = " | BNI";
		} else 
		if($via=="4") {
		    $via = "2";
		    $tambahan_keterangan = " | BRI";
		} else 
		if($via=="5") {
		    $via = "2";
		    $tambahan_keterangan = " | MANDIRI";
		} else 
		if($via=="6") {
		    $via = "2";
		    $tambahan_keterangan = " | BPD";
		} else {
		    $via = "1";
		    $tambahan_keterangan = "";
		}
		

		//melihat data user
		$query_register=mysqli_query($koneksi,"select * from sale_register where id_register='$id_register'");
		$tampil_register=mysqli_fetch_array($query_register);
		$id_register=$tampil_register['id_register'];
		$id_paket=$tampil_register['id_paket'];
		$ip_publik=$tampil_register['ip_publik'];
		$bulan_berjalan=$tampil_register['billing_bulan_berjalan'];
		$bulan_terbayar=$tampil_register['billing_bulan_terbayar'];

		//data paket
		$query_paket = mysqli_query($koneksi,"select * from sale_paket_internet where id_paket='$id_paket'");
		$data_paket = mysqli_fetch_array($query_paket);
		$harga_paket = $data_paket['harga'];

		if($ip_publik=="IYA"){
			$harga_paket = $harga_paket + 100000;
		}

		$biaya_registrasi = $tampil_register['biaya_registrasi'];
		$monthly_fee = $tampil_register['monthly_fee'];
		$nominal_po = $biaya_registrasi + $monthly_fee;

		if($tampil_register['status_radio']=="BELI") {
			$nominal_po = $nominal_po + $tampil_register['harga_radio'];
			$hutang_hardware = $hutang_hardware + $tampil_register['harga_radio'];
		}
		if($tampil_register['status_antena']=="BELI") {
			$nominal_po = $nominal_po + $tampil_register['harga_antena'];
			$hutang_hardware = $hutang_hardware + $tampil_register['harga_antena'];
		}
		if($tampil_register['status_wifi']=="BELI") {
			$nominal_po = $nominal_po + $tampil_register['harga_wifi'];
			$hutang_hardware = $hutang_hardware + $tampil_register['harga_wifi'];
		}
		if($tampil_register['status_kabel']=="BELI") {
			$nominal_po = $nominal_po + $tampil_register['harga_kabel'];
			$hutang_hardware = $hutang_hardware + $tampil_register['harga_kabel'];
		}
		if($tampil_register['status_tower']=="BELI") {
			$nominal_po = $nominal_po + $tampil_register['harga_tower'];
			$harga_tower = $nominal_po + $tampil_register['harga_tower'];
		}

		$ppn = 0;
		$tampil_status_ppn = '<i class="fa fa-close"></i>';
		$update_status_ppn = "IYA";

		$status_ppn = $tampil_register['ppn'];
		if($status_ppn=="IYA") {
		$ppn = $nominal_po / 10;
		$tampil_status_ppn = '<i class="fa fa-check"></i>';
		$update_status_ppn = "TIDAK";
		}
		$total_po = $nominal_po + $ppn;
		$total_po = floor($total_po);

        $sisa_pembayaran=$tampil_register['billing_saldo'];


        //proses log di aplikasi lama
        mysqli_query($koneksi, "insert into billing_log_pembayaran (waktu_pembayaran, keterangan, id_register, via, bayar, restitusi, catatan_pembayaran) value ('$waktu_pembayaran', '$keterangan', '$id_register', '$via', '$bayar', '$restitusi', '$catatan')") or die(mysqli_error());

		$query_billing_log = mysqli_query($koneksi,"SELECT * FROM `billing_log_pembayaran` ORDER BY no DESC LIMIT 1");
		$data_billing_log = mysqli_fetch_array($query_billing_log);
		$no_log_pembayaran = $data_billing_log['no'];

		$query_sale_register_where_id_register = mysqli_query($koneksi,"SELECT * FROM sale_register WHERE id_register='$id_register'");
		$data_sale_register_where_id_register = mysqli_fetch_array($query_sale_register_where_id_register);
		$nama_user = $data_sale_register_where_id_register['nama_user'];

		if($_POST['penagih']=="eko"){
		    $tambahan_keterangan = $tambahan_keterangan." | Pak Eko";
		}




		//eksekusi
		$total_dana=$bayar+$sisa_pembayaran+$restitusi;
		//proses akuntansi
		if($sisa_pembayaran>=1){
			$katerangan_post = "Sisa Pembayaran Sebelumnya ( ".$nama_user." )";
			$id_account_billing_saldo = '23';
		    $this->input_data_temp_posting($waktu_pembayaran, $katerangan_post, $no_log_pembayaran,$sisa_pembayaran, $via, 'o', 'belum', 'access', $id_account_billing_saldo);
		}
		
		if($restitusi>=1){
			$katerangan_post = "Restitusi User Baru ( ".$nama_user." (".$catatan.") )";
		    $this->input_data_temp_posting($waktu_pembayaran, $katerangan_post, $no_log_pembayaran, $restitusi, $via, 'o', 'belum', 'access', '58');
		}

		//cek total dana lebih besar dari tagihan atau tidak
		if($total_dana>=$total_po) {
			//jika total dana lebih besar maka melihar berapa uang sisanya
			$update_sisa_pembayaran = $total_dana-$total_po;

			//data yang dirubah : billing_saldo, billing_total_bayar, billing_restitusi, status, tanggal_close
			mysqli_query($koneksi,"update sale_register set billing_saldo='$update_sisa_pembayaran', billing_total_bayar=billing_total_bayar+'$bayar', billing_total_restitusi=billing_total_restitusi+'$restitusi', status='Close', tanggal_close='$tanggal_close', billing_saldo='$update_sisa_pembayaran' where id_register='$id_register'");
			
		    $bulan=date('Y-m-d');

            mysqli_query($koneksi, "insert into billing_backup_log_user (id_register, id_paket, bulan) values ('$id_register', '$id_paket', '$bulan')");
			
            //Pembayaran Registrasi
        	$keterangan_post = "Registrasi User Baru ( ".$nama_user." )";
		    $this->input_data_temp_posting($waktu_pembayaran, $keterangan_post, $no_log_pembayaran, $biaya_registrasi, $via, 'i', 'belum', 'access', '3');

			//Pembayaran Pro Rata
        	$keterangan_post = "Pembayaran Prorata ( ".$nama_user." )".$tambahan_keterangan;
		    $this->input_data_temp_posting($waktu_pembayaran, $keterangan_post, $no_log_pembayaran, $monthly_fee, $via, 'i', 'belum', 'access', '3');

		    //Pembayaran Pipa
		    if($harga_tower>=1){
	        	$keterangan_post = "Pembayaran Pipa ( ".$nama_user." )";
			    $this->input_data_temp_posting($waktu_pembayaran, $keterangan_post, $no_log_pembayaran, $harga_tower, $via, 'i', 'belum', 'access', '36');
			}

		    //Pembayaran Alat
        	$keterangan_post = "Pembayaran Alat ( ".$nama_user." )";
		    $this->input_data_temp_posting($waktu_pembayaran, $keterangan_post, $no_log_pembayaran, $hutang_hardware, $via, 'i', 'belum', 'access', '67');
		    
		    //Jika ada sisa pembayaran
		    if($update_sisa_pembayaran>=1){
				$katerangan_post = "Saldo User Baru ( ".$nama_user." )";
			    $this->input_data_temp_posting($waktu_pembayaran, $katerangan_post, $no_log_pembayaran, $update_sisa_pembayaran, $via, 'i', 'belum', 'access', '23');
			}


		} else {
			//jika total dana lebih kecil dari tagihan, maka uangnya cukup di masukan kedalam billing_saldo
			//nha untuk billing saldo posisinya langsung digantikan ya, tidak di jumlah dengan billing_saldo
			$update_sisa_pembayaran = $total_dana;
			mysqli_query($koneksi,"update sale_register set billing_saldo='$update_sisa_pembayaran', billing_total_bayar=billing_total_bayar+'$bayar', billing_total_restitusi='$restitusi' where id_register='$id_register'");

			if($update_sisa_pembayaran>=1){
				$katerangan_post = "Saldo User Baru ( ".$nama_user." )";
			    $this->input_data_temp_posting($waktu_pembayaran, $katerangan_post, $no_log_pembayaran, $update_sisa_pembayaran, $via, 'i', 'belum', 'access', '23');
			}
		}  

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
		$billing_saldo = $data_register['billing_saldo'];

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
			if($billing_saldo>=$total_dana) {
				$sisa_pembayaran = $total_dana;
				mysqli_query($koneksi,"update sale_register set billing_saldo=billing_saldo-'$sisa_pembayaran' where id_register='$id_register'");
				mysqli_query($koneksi,"delete from billing_log_pembayaran where no='$no'");
			} else {
				$sisa_pembayaran = $harga-$total_dana;
				mysqli_query($koneksi,"update sale_register set billing_bulan_terbayar=billing_bulan_terbayar-'1', billing_saldo=billing_saldo+'$sisa_pembayaran' where id_register='$id_register'");
				mysqli_query($koneksi,"delete from billing_log_pembayaran where no='$no'");
			}
		}
	}

	function batal_transaksi_user_baru($no) {
		include "../../koneksi/koneksi.php";
		$query_transaksi = mysqli_query($koneksi,"select * from billing_log_pembayaran where billing_log_pembayaran.no='$no'");
		$data_transaksi = mysqli_fetch_array($query_transaksi);
		$id_register = $data_transaksi['id_register'];
		$bayar = $data_transaksi['bayar'];
		$restitusi = $data_transaksi['restitusi'];

		$query_sale_register = mysqli_query($koneksi,"select * from sale_register where id_register='$id_register' limit 1");
		$data_sale_register = mysqli_fetch_array($query_sale_register);
		$id_po = $data_sale_register['id_po'];
		$billing_saldo = $data_sale_register['billing_saldo'];
		$id_paket = $data_sale_register['id_paket'];
		$status = $data_sale_register['status'];
		$ip_publik = $data_sale_register['ip_publik'];

	    $nominal_po = $data_sale_register['biaya_registrasi'] + $data_sale_register['monthly_fee'];

	    if($data_sale_register['status_radio']=="BELI") {
	      $nominal_po = $nominal_po + $data_sale_register['harga_radio'];
	    }
	    if($data_sale_register['status_antena']=="BELI") {
	      $nominal_po = $nominal_po + $data_sale_register['harga_antena'];
	    }
	    if($data_sale_register['status_wifi']=="BELI") {
	      $nominal_po = $nominal_po + $data_sale_register['harga_wifi'];
	    }
	    if($data_sale_register['status_kabel']=="BELI") {
	      $nominal_po = $nominal_po + $data_sale_register['harga_kabel'];
	    }
	    if($data_sale_register['status_tower']=="BELI") {
	      $nominal_po = $nominal_po + $data_sale_register['harga_tower'];
	    }

	    $ppn = 0;
	    $tampil_status_ppn = '<i class="fa fa-close"></i>';
	    $update_status_ppn = "IYA";

	    $status_ppn = $data_sale_register['ppn'];
	    if($status_ppn=="IYA") {
	      $ppn = $nominal_po / 10;
	      $tampil_status_ppn = '<i class="fa fa-check"></i>';
	      $update_status_ppn = "TIDAK";
	    }
	    $total_po = $nominal_po + $ppn;

		$total_dana = $bayar+$restitusi;
		//cek dulu apakah total dana yang mau dikembalikan lebih besar dari tagihan?
		if($total_dana>$total_po){
			//jika lebih besar kita cek dulu berapa sisa dari total dana dikurangi tagihan 
			echo $sisa_uang = $total_dana-$total_po;

			//cek dulu apakah sisa  total dana lebih besar dari sisa saldo?
			if($billing_saldo>=$sisa_uang){
				//jika iya sisa lebih banyak dari uang sisa, maka tinggal kita kurangkan saja sisa nya
				mysqli_query($koneksi,"update sale_register set status='Pasca-Trial', billing_saldo=billing_saldo-'$sisa_uang' where id_register='$id_register'");
			} else {
				//jika lebih kecil, kita ambil uang dari pembayaran bulanan kemarin, jadi kita lihat dulu paketannya berapa?
				$query_paket = mysqli_query($koneksi,"select * from sale_paket_internet where id_paket='$id_paket'");
				$data_paket = mysqli_fetch_array($query_paket);
				$harga_paket = $data_paket['harga'];
				if($ip_publik=="IYA") {
					$harga_paket = $harga_paket + 100000;
				}

				//cek lagi apakah uang sisanya itu lebih besar dari harga paket?
				if($sisa_uang>$harga_paket){
					//jika iya kita akan menghitung berapa uang paket yang bisa kita ambil
					$selisih_harga_dan_sisa_uang = $sisa_uang%$harga_paket;
					$sisa_uang_untuk_dibagi = $sisa_uang-$selisih_harga_dan_sisa_uang;
					$sisa_uang_dibagi_harga = $sisa_uang_untuk_dibagi/$harga_paket;

					mysqli_query($koneksi,"update sale_register set billing_bulan_terbayar=billing_bulan_terbayar-'$sisa_uang_dibagi_harga', billing_saldo=billing_saldo-'$selisih_harga_dan_sisa_uang', status='Pasca-Trial' where id_register='$id_register'");
				} else {
					//jika sisa paket tidak lebih dari harga satu paket, maka kita tinggal ambil satu paket aja kemudian uang saldonya kita tambah dari harga paket yang telah kita potong tadi.
					$update_billing_saldo = $billing_saldo + $harga_paket - $sisa_uang;

					mysqli_query($koneksi,"update sale_register set billing_bulan_terbayar=billing_bulan_terbayar-'1', billing_saldo='$update_billing_saldo', status='Pasca-Trial' where id_register='$id_register'");
				}
			}
			mysqli_query($koneksi,"delete from billing_log_pembayaran where no='$no'");
		}
		#cek apakah total dana sama dengan total po tagihan
		if($total_dana==$total_po){
			//jika iya kita cek lagi apakah sisa saldo lebih dari total PO yang mau di batalkan
			if($billing_saldo>=$total_dana){
				//jika saldo lebih banyak dari uang yang mau di kembalikan, kita potong aja saldo dari uangnya
				mysqli_query($koneksi,"update sale_register set billing_saldo=billing_saldo-'$total_dana' where id_register='$id_register'");
			} else {
				//jika uang sisanya tidak lebih dari total dana yang di kembalikan, mau tidak mau harus merubah status user
				mysqli_query($koneksi,"update sale_register set status='Pasca-Trial' where id_register='$id_register'");
			}
			mysqli_query($koneksi,"delete from billing_log_pembayaran where no='$no'");
		}
		if($total_dana<$total_po){
			if($billing_saldo>=$total_dana){
				//jika saldo lebih banyak dari uang yang mau di kembalikan, kita potong aja saldo dari uangnya
				mysqli_query($koneksi,"update sale_register set billing_saldo=billing_saldo-'$total_dana' where id_register='$id_register'");
			} else {
				//jika uang sisanya tidak lebih dari total dana yang di kembalikan, mau tidak mau harus merubah status user
				$update_billing_saldo = $total_po - $total_dana;
				mysqli_query($koneksi,"update sale_register set status='Pasca-Trial', billing_saldo=billing_saldo+'$update_billing_saldo' where id_register='$id_register'");
			}
			mysqli_query($koneksi,"delete from billing_log_pembayaran where no='$no'");
		}
	}

	function batal_posting($id_temp){
		include "../../koneksi/koneksi.php";

		$query_temp_where_id_temp = mysqli_query($koneksi,"SELECT * FROM data_temp WHERE id_temp='$id_temp'");
		$data_temp_where_id_temp = mysqli_fetch_array($query_temp_where_id_temp);
		$keterangan = $data_temp_where_id_temp['keterangan'];
		$no_log_pembayaran = $data_temp_where_id_temp['no_log_pembayaran'];
		$pecah_keterangan = explode(" ", $keterangan);

		if($pecah_keterangan['1']=="Internet") {
			$this->batal_transaksi_acces($no_log_pembayaran);
		}

		if($pecah_keterangan['1']=="User") {
			$this->batal_transaksi_user_baru($no_log_pembayaran);
		}
		
		//iki gur nggo ngamane ben data e ora ilang kabeh
		if($no_log_pembayaran==""){
			$no_log_pembayaran = "xxxxxxx";
		}

		mysqli_query($koneksi,"DELETE FROM `data_temp` WHERE id_temp='$id_temp'");
		mysqli_query($koneksi,"DELETE FROM `data_transaksi` WHERE id_temp='$id_temp'");

		$query_cek_data_temp = mysqli_query($koneksi,"SELECT * FROM data_temp WHERE no_log_pembayaran='$no_log_pembayaran'");
		$jumlah_cek_data_temp = mysqli_num_rows($query_cek_data_temp);
		if($jumlah_cek_data_temp>=2){
			while($data_cek_data_temp = mysqli_fetch_array($query_cek_data_temp)){
				$id_temp = $data_cek_data_temp['id_temp'];
				$keterangan = $data_cek_data_temp['keterangan'];
				$no_log_pembayaran = $data_cek_data_temp['no_log_pembayaran'];
				$pecah_keterangan = explode(" ", $keterangan);

				if($pecah_keterangan['1']=="Internet") {
					$this->batal_transaksi_acces($no_log_pembayaran);
				}

				if($pecah_keterangan['1']=="User") {
					$this->batal_transaksi_user_baru($no_log_pembayaran);
				}

				mysqli_query($koneksi,"DELETE FROM `data_temp` WHERE id_temp='$id_temp'");
				mysqli_query($koneksi,"DELETE FROM `data_transaksi` WHERE id_temp='$id_temp'");
			}
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

	function insert_daily_masuk() {
		include "../../koneksi/koneksi.php";

		$tanggal = $_POST['tanggal']." ".date('H:i:m');
		$keterangan = $_POST['keterangan'];
		$no_log_pembayaran = "";
		$nominal = $_POST['nominal'];
		$pecah_nominal = explode(".", $nominal);
		$nominal = implode("", $pecah_nominal);
		$id_account = $_POST['id_account'];
		$in_out = "i";
		$status = "belum";
		$ekstra = "access";
		$tambahan = $_POST['tambahan'];
		$penagih = $_POST['penagih'];
		
		if($tambahan=="internet"){
		    $keterangan = "Pembayaran Internet ( ".$keterangan.")";
		}
		if($tambahan=="dialup"){
		    $keterangan = "Pembayaran Dial Up ( ".$keterangan.")";
		}
		if($tambahan=="userbaru"){
		    $keterangan = "Pembayaran User Baru ( ".$keterangan.")";
		}
		if($tambahan=="alat"){
		    $keterangan = "Pembayaran Alat ( ".$keterangan.")";
		}
		if($tambahan=="webhosting"){
		    $keterangan = "Pembayaran WEB & Hosting ( ".$keterangan.")";
		}
		
		if($penagih=="eko") {
		    $keterangan = $keterangan." | Pak Eko";
		}
		
		
		if($id_account=="2") {
		    $id_account = "2";
		    $keterangan = $keterangan." | BCA";
		} else 
		if($id_account=="3") {
		    $id_account = "2";
		    $keterangan = $keterangan." | BNI";
		} else 
		if($id_account=="4") {
		    $id_account = "2";
		    $keterangan = $keterangan." | BRI";
		} else 
		if($id_account=="5") {
		    $id_account = "2";
		    $keterangan = $keterangan." | MANDIRI";
		} else 
		if($id_account=="6") {
		    $id_account = "2";
		    $keterangan = $keterangan." | BPD";
		} else {
		    $id_account = "1";
		    $keterangan = $keterangan;
		}



		mysqli_query($koneksi,"INSERT INTO `data_temp`(`tanggal`, `keterangan`, `no_log_pembayaran`, `nominal`, `id_account`, `in_out`, `status`, `ekstra`) VALUES ('$tanggal', '$keterangan', '$no_log_pembayaran', '$nominal', '$id_account', '$in_out', '$status', '$ekstra')");
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
		$ekstra = "access";

		mysqli_query($koneksi,"INSERT INTO `data_temp`(`tanggal`, `keterangan`, `no_log_pembayaran`, `nominal`, `id_account`, `in_out`, `status`, `ekstra`) VALUES ('$tanggal', '$keterangan', '$no_log_pembayaran', '$nominal', '$id_account', '$in_out', '$status', '$ekstra')");
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

		$query=mysqli_query($koneksi,"select sale_register.id_register, sale_register.id_marketing, sale_marketing.nama_marketing, sale_marketing.id_marketing, sale_register.alamat, sale_register.nama_user, sale_register.nama_instansi, sale_register.billing_saldo, sale_register.ip_publik, sale_register.id_paket, sale_register.telp, (sale_register.billing_bulan_berjalan-sale_register.billing_bulan_terbayar) from sale_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing order by (sale_register.billing_bulan_berjalan-sale_register.billing_bulan_terbayar) DESC");
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

	function select_register_menu_pelanggan_khusus() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing where sale_register.pelanggan_khusus_periode not like '0'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_register_tambah_daftar_menu_cetak_invoice() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing where sale_register.status='Close'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_register_tambah_daftar_menu_pelanggan_khusus() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register left join sale_marketing on sale_register.id_marketing=sale_marketing.id_marketing where sale_register.pelanggan_khusus_periode='0' and sale_register.status='Close'");
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

		$query=mysqli_query($koneksi,"select * from sale_register left join sale_paket_internet on sale_register.id_paket=sale_paket_internet.id_paket where sale_register.status not like 'Hold' or sale_register.status not like 'Alat Siap'");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}

	function select_data_user_hold() {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register where status='Hold' ORDER BY `tanggal_hold` DESC");
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

	function select_tagihan_user_baru($id_register) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_register where id_register='$id_register'");
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
        
        $tanggal=date('Y-m-d');
		mysqli_query($koneksi,"update sale_register set status='Hold', tanggal_hold='$tanggal', catatan='$catatan' where id_register='$id_register'");
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

	    		echo $data_register['biaya_registrasi'];

	    echo $data_register['id_bts'];

	    echo $data_register['id_radio'];
	    echo $data_register['jumlah_radio'];
	    echo $data_register['status_radio'];
	    echo $data_register['harga_radio'];

	    echo $data_register['id_antena'];
	    echo $data_register['jumlah_antena'];
	    echo $data_register['status_antena'];
	    echo $data_register['harga_antena'];

	    echo $data_register['id_wifi'];
	    echo $data_register['jumlah_wifi'];
	    echo $data_register['status_wifi'];
	    echo $data_register['harga_wifi'];

		echo $data_register['id_tower'];
	    echo $data_register['jumlah_tower'];
	    echo $data_register['status_tower'];
	    echo $data_register['harga_tower'];

	    echo $data_register['id_kabel'];
	    echo $data_register['panjang_kabel'];
	    echo $data_register['status_kabel'];
	    echo $data_register['harga_kabel'];

	    mysqli_query($koneksi,"INSERT INTO `billing_po`(`id_register`, `biaya_registrasi`, `tanggal_registrasi`, `money_fee`, `biaya_ip_publik`, `id_radio`, `status_radio`, `jumlah_radio`, `harga_radio`, `id_antena`, `status_antena`, `jumlah_antena`, `harga_antena`, `id_wifi`, `status_wifi`, `jumlah_wifi`, `harga_wifi`, `id_kabel`, `status_kabel`, `panjang_kabel`, `harga_kabel`, `id_tower`, `status_tower`, `jumlah_tower`, `harga_tower`, `status`) VALUES ('$id_register', '$biaya_registrasi', '$tanggal_registrasi', '$money_fee', '$biaya_ip_publik', '$id_radio', '$status_radio', '$jumlah_radio', '$harga_radio', '$id_antena', '$status_antena', '$jumlah_antena', '$harga_antena', '$id_wifi', '$status_wifi', '$jumlah_wifi', '$harga_wifi', '$id_kabel', '$status_kabel', '$panjang_kabel', '$harga_kabel', '$id_tower', '$status_tower', '$jumlah_tower', '$harga_tower', '$status')");

		mysqli_query($koneksi,"update sale_register set tanggal_close='$tanggal_close_baru', status='Close' where id_register='$id_register'");
	}
	
	function update_status_ppn($status, $id_po) {
		include "../../koneksi/koneksi.php";

		mysqli_query($koneksi,"update sale_register set ppn='$status' where id_register='$id_po'");
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
			$ip_publik=$data['ip_publik'];
			$nama_user=$data['nama_user'];
			$id_paket=$data['id_paket'];
			$bulan=date('Y-m-d');


			mysqli_query($koneksi, "insert into billing_backup_log_user (id_register, id_paket, bulan) values ('$id_register', '$id_paket', '$bulan')");

			$query_paket_internet = mysqli_query($koneksi,"SELECT * FROM `sale_paket_internet` WHERE `id_paket`='$id_paket'");
			$data_paket_internet = mysqli_fetch_array($query_paket_internet);
			$harga_paket = $data_paket_internet['harga'];

			$waktu_pembayaran=date('Y-m-d H:m:i');
			$keterangan_post = "Tagihan Internet ( ".$nama_user." )";
		    $this->input_data_temp_posting($waktu_pembayaran, $keterangan_post, '', $harga_paket, '3', 'i', 'belum', 'access', '34');

		    if($ip_publik=='IYA'){
		    	$waktu_pembayaran=date('Y-m-d H:m:i');
				$keterangan_post = "Tagihan IP Public ( ".$nama_user." )";
			    $this->input_data_temp_posting($waktu_pembayaran, $keterangan_post, '', '100000', '3', 'i', 'belum', 'access', '36');
		    }

		}

		mysqli_query($koneksi, "DELETE FROM `data_temp` WHERE `tanggal` LIKE '$bulan%' AND `keterangan` LIKE 'Tagihan Internet%' OR `tanggal` LIKE '$bulan%' AND `keterangan` LIKE 'Tagihan IP Public%'");

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
}

class select {
  function select_data_reclose($id_register) {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select * from sale_register where sale_register.id_register='$id_register'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_data_transaksi_rutin($isi_data) {    
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"SELECT * FROM `billing_bantu_log_pembayaran_rutin` WHERE `keterangan` like '%$isi_data%'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_data_temp_where($via, $dk, $tanggal_awal, $tanggal_akhir, $isi_data) {    
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"SELECT * FROM data_temp WHERE `id_account`='1' AND `keterangan` like '%$isi_data%' AND id_account like '%$via%' AND in_out like '%$dk%' AND tanggal BETWEEN '$tanggal_awal 00:00:00' AND '$tanggal_akhir 23:59:59' AND ekstra = 'access' OR `id_account`='2' AND `keterangan` like '%$isi_data%' AND id_account like '%$via%' AND in_out like '%$dk%' AND tanggal BETWEEN '$tanggal_awal 00:00:00' AND '$tanggal_akhir 23:59:59' AND ekstra = 'access' ORDER BY `tanggal` DESC, `id_temp` DESC");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_data_kas_kecil_in() {    
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"SELECT sum(nominal) as jumlah FROM data_temp WHERE in_out = 'i' AND ekstra = 'kas_kecil'");
    $tampil=mysqli_fetch_array($query);
    $jumlah=$tampil['jumlah'];
    return $jumlah;
  }

  function select_data_kas_kecil_out() {    
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"SELECT sum(nominal) as jumlah FROM data_temp WHERE in_out='o' AND ekstra = 'kas_kecil'");
    $tampil=mysqli_fetch_array($query);
    $jumlah=$tampil['jumlah'];
    return $jumlah;
  }
  
  function saldo_kas($tanggal_hari_ini) {
      include "../../koneksi/koneksi.php";
      
      $query_temp_in_kas = mysqli_query($koneksi,"SELECT SUM(`nominal`) as total FROM `data_temp` WHERE `tanggal` BETWEEN '0000-00-01 00:00:00' AND '$tanggal_hari_ini 23:59:59' AND `id_account`='1' AND `in_out`='i' AND `ekstra`='access'");
      $data_temp_in_kas = mysqli_fetch_array($query_temp_in_kas);
      
      $query_temp_out_kas = mysqli_query($koneksi,"SELECT SUM(`nominal`) as total FROM `data_temp` WHERE `tanggal` BETWEEN '0000-00-01 00:00:00' AND '$tanggal_hari_ini 23:59:59' AND `id_account`='1' AND `in_out`='o' AND `ekstra`='access'");
      $data_temp_out_kas = mysqli_fetch_array($query_temp_out_kas);
      
      $kas_masuk = $data_temp_in_kas['total'];
      $kas_keluar = $data_temp_out_kas['total'];
      
      return $kas_masuk - $kas_keluar;
  }
  
  function select_data_temp_tagihan_pak_eko($tanggal_awal, $tanggal_akhir, $data_yang_dicari) {
      include "../../koneksi/koneksi.php";
    
      $jumlah_data = 0;
      $query_data_temp_where = mysqli_query($koneksi,"SELECT * FROM `data_temp` WHERE `tanggal` BETWEEN '$tanggal_awal 00:00:00' AND '$tanggal_akhir 23:59:59' AND `keterangan` like '%| Pak Eko%'");
      while($data_temp_where = mysqli_fetch_array($query_data_temp_where)){
          $keterangan = $data_temp_where['keterangan'];
          $pecah_keterangan = explode("(", $keterangan);
          $syntak = $pecah_keterangan['0'];
          
          if($syntak==$data_yang_dicari){
              $jumlah_data = $jumlah_data+1;
          }
      }
      
      return $jumlah_data;
  }
  
  function select_detail_data_temp_where($tanggal_awal, $tanggal_akhir, $data_yang_dicari) {    
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"SELECT * FROM `data_temp` WHERE `tanggal` BETWEEN '$tanggal_awal 00:00:00' AND '$tanggal_akhir 23:59:59' AND `keterangan` like '%| Pak Eko%' AND `keterangan` like '%$data_yang_dicari%'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }
  
  function total_user_hold_bulan_ini() {
		include "../../koneksi/koneksi.php";

		$tanggal_awal = date('Y-m-')."01";
		$tanggal_akhir = date('Y-m-')."31";
		$tanggal_hari_ini=date('Y-m-d');
		$query=mysqli_query($koneksi,"SELECT * FROM sale_register WHERE status='Hold' and tanggal_hold between '$tanggal_awal' and '$tanggal_akhir'");
		$menghitung_query=mysqli_num_rows($query);
		return $menghitung_query;
  }
  
  function data_user_hold_bulan_ini() {
		include "../../koneksi/koneksi.php";

		$tanggal_awal = date('Y-m-')."01";
		$tanggal_akhir = date('Y-m-')."31";
		$tanggal_hari_ini=date('Y-m-d');
		$query=mysqli_query($koneksi,"SELECT * FROM sale_register WHERE status='Hold' and tanggal_hold between '$tanggal_awal' and '$tanggal_akhir'");
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
	    $koordinat=$_POST['koordinat'];
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
	    $koordinat=$_POST['koordinat'];
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
	    $koordinat=$_POST['koordinat'];
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

	function update_monthly_fee($monthly_fee, $tanggal_close, $biaya_registrasi, $id_register) {
		include "../../koneksi/koneksi.php";

		mysqli_query($koneksi,"update sale_register set monthly_fee='$monthly_fee', tanggal_trial='$tanggal_close', biaya_registrasi='$biaya_registrasi' where id_register='$id_register'");


		//Transaksi Monthlu Fee
		mysqli_query($koneksi,"UPDATE `data_temp` SET `nominal`='$monthly_fee' WHERE `keterangan` like 'Tagihan Prorata%' AND `keterangan` like '%$id_register%'");

		mysqli_query($koneksi,"UPDATE `data_transaksi` SET `nominal`='$monthly_fee' WHERE `keterangan` like 'Tagihan Prorata%' AND `keterangan` like '%$id_register%'");

		mysqli_query($koneksi,"UPDATE `data_temp` SET `nominal`='$biaya_registrasi' WHERE `keterangan` like 'Tagihan Registrasi%' AND `keterangan` like '%$id_register%'");

		mysqli_query($koneksi,"UPDATE `data_transaksi` SET `nominal`='$biaya_registrasi' WHERE `keterangan` like 'Tagihan Registrasi%' AND `keterangan` like '%$id_register%'");
	}
	
	function edit_log_pembyaran() {
	    include "../../koneksi/koneksi.php";
	    
	    $id_temp = $_POST['id_temp'];
	    $no_log_pembayaran = $_POST['no_log_pembayaran'];
	    $tanggal = $_POST['tanggal']." ".date("H:m:i");
	    $keterangan = $_POST['keterangan'];
	    $tambahan = $_POST['tambahan'];
	    $in_out = $_POST['in_out'];
	    $penagih = $_POST['penagih'];
	    $nominal = $_POST['nominal'];
	    $id_account = $_POST['id_account'];
	    $pecah_nominal = explode(".", $nominal);
	    $nominal = implode("", $pecah_nominal);
	    
	    if($tambahan=="internet"){
		    $keterangan = "Pembayaran Internet ( ".$keterangan.")";
		}
		if($tambahan=="dialup"){
		    $keterangan = "Pembayaran Dial Up ( ".$keterangan.")";
		}
		if($tambahan=="userbaru"){
		    $keterangan = "Pembayaran User Baru ( ".$keterangan.")";
		}
		if($tambahan=="alat"){
		    $keterangan = "Pembayaran Alat ( ".$keterangan.")";
		}
		if($tambahan=="webhosting"){
		    $keterangan = "Pembayaran WEB & Hosting ( ".$keterangan.")";
		}
		
		if($penagih=="eko") {
		    $keterangan = $keterangan." | Pak Eko";
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
		
	    mysqli_query($koneksi,"UPDATE `data_temp` SET `keterangan`='$keterangan', `nominal`='$nominal', `tanggal`='$tanggal' WHERE `id_temp`='$id_temp'");
	    mysqli_query($koneksi,"UPDATE `data_transaksi` SET `keterangan`='$keterangan', `nominal`='$nominal', `tanggal`='$tanggal' WHERE `id_temp`='$id_temp'");

	    if($in_out=="i"){
	    	mysqli_query($koneksi,"UPDATE `data_transaksi` SET `id_account`='$id_account' WHERE `id_temp`='$id_temp' AND `DK`='D'");
	    } else {
	    	mysqli_query($koneksi,"UPDATE `data_transaksi` SET `id_account`='$id_account' WHERE `id_temp`='$id_temp' AND `DK`='K'");
	    }
	}
	
	function update_register() {
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

	    $tambahan_1=$_POST['tambahan_1'];
	    $jumlah_tambahan_1=$_POST['jumlah_tambahan_1'];
	    $status_tambahan_1=$_POST['status_tambahan_1'];
	    $harga_tambahan_1=$_POST['harga_tambahan_1'];

	    $tambahan_2=$_POST['tambahan_2'];
	    $jumlah_tambahan_2=$_POST['jumlah_tambahan_2'];
	    $status_tambahan_2=$_POST['status_tambahan_2'];
	    $harga_tambahan_2=$_POST['harga_tambahan_2'];

	    mysqli_query($koneksi,"UPDATE `sale_register` SET `ip_publik`='$ip_publik', `nik`='$nik', `nama_user`='$nama_user', `nama_instansi`='$nama_instansi', `jenis_kelamin`='$jenis_kelamin', `tempat_lahir`='$tempat_lahir', `tanggal_lahir`='$tanggal_lahir', `telp`='$telp', `email`='$email', `alamat`='$alamat', `koordinat`='$koordinat', `id_paket`='$id_paket', `id_bts`='$id_bts', `id_radio`='$id_radio', `jumlah_radio`='$jumlah_radio', `harga_radio`='$harga_radio', `status_radio`='$status_radio', `id_antena`='$id_antena', `jumlah_antena`='$jumlah_antena', `harga_antena`='$harga_antena', `status_antena`='$status_antena', `id_wifi`='$id_wifi', `jumlah_wifi`='$jumlah_wifi', `harga_wifi`='$harga_wifi', `status_wifi`='$status_wifi', `id_tower`='$id_tower', `jumlah_tower`='$jumlah_tower', `harga_tower`='$harga_tower', `status_tower`='$status_tower', `id_kabel`='$id_kabel', `panjang_kabel`='$panjang_kabel', `harga_kabel`='$harga_kabel', `status_kabel`='$status_kabel', biaya_registrasi='$biaya_registrasi',`tambahan_1`='$tambahan_1',`jumlah_tambahan_1`='$jumlah_tambahan_1',`status_tambahan_1`='$status_tambahan_1',`harga_tambahan_1`='$harga_tambahan_1',`tambahan_2`='$tambahan_2',`jumlah_tambahan_2`='$jumlah_tambahan_2',`status_tambahan_2`='$status_tambahan_2',`harga_tambahan_2`='$harga_tambahan_2' WHERE id_register='$id_register'");
	}
}

class insert {

  function posting_transaksi_rutin(){
    include "../../koneksi/koneksi.php";

    $post_tanggal = $_POST['tanggal']." ".date('H:m:i');
    $post_keterangan = $_POST['keterangan'];
    $post_nominal = $_POST['nominal'];

    for($i=0; $i < count($post_keterangan); $i++) { 
      
		if(!($post_nominal[$i]=='0')){
			$keterangan = $post_keterangan[$i];
			$nominal = $post_nominal[$i];
			$pecah_nominal = explode(".", $nominal);
			$nominal = implode("", $pecah_nominal);


			mysqli_query($koneksi,"INSERT INTO `data_temp`(`tanggal`, `keterangan`, `no_log_pembayaran`, `nominal`, `id_account`, `in_out`, `status`, `ekstra`) VALUES ('$post_tanggal', '$keterangan', '0', '$nominal', '1', 'i', 'belum', 'access')");
		}
    }
  }

  function insert_transaksi_rutin() {
    include "../../koneksi/koneksi.php";

  	$keterangan = $_POST['keterangan'];

  	mysqli_query($koneksi,"INSERT INTO `billing_bantu_log_pembayaran_rutin`(`keterangan`, `nominal`, `in_out`, `ekstra`) VALUES ('$keterangan', '0', 'o', 'access')");
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