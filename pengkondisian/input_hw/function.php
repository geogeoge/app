<?php
class pengkondisian {

	function input_tanggal(){
		include "koneksi.php";

		$query = mysqli_query($koneksi,"SELECT `id_sampah`, `tanggal`, `tanggal_sementara`, `keterangan`, `debit`, `kredit` FROM `sampah_hw`");
		while($data = mysqli_fetch_array($query)){
			$id_sampah = $data['id_sampah'];
			$tanggal = $data['tanggal'];
			$tanggal_sementara = $data['tanggal_sementara'];

			$pecah_spasi_tanggal_sementara = explode(" ", $tanggal_sementara);
			$pecah_strip_tanggal_sementara = explode("-", $tanggal_sementara);
			if(isset($pecah_spasi_tanggal_sementara[1])){
				$pecah_tanggal_sementara = $pecah_spasi_tanggal_sementara;
			} else {
				$pecah_tanggal_sementara = $pecah_strip_tanggal_sementara;
			}

			$bulan_sementara = $pecah_tanggal_sementara[1];
			switch ($bulan_sementara) {
				
				case 'Jan':
					$bulan_angka = "1";
					break;

				case 'jan':
					$bulan_angka = "1";
					break;

				case 'JAN':
					$bulan_angka = "1";
					break;

				default:
					$bulan_angka = "";
					mysqli_query($koneksi_baru,"update `$tabel_sementara` set status='belum' where `COL 1`='$id_sementara'");
					break;
			}

			echo $tanggal = "2019-".$bulan_angka."-".$pecah_tanggal_sementara['0'];

			mysqli_query($koneksi,"UPDATE `sampah_hw` SET `tanggal`='$tanggal' WHERE `id_sampah`='$id_sampah'");
		}
	}

	function rubah_status_sampah_hw($id_sampah){
		include "koneksi.php";

		mysqli_query($koneksi,"UPDATE `sampah_hw` SET `status`='sudah' WHERE `id_sampah`='$id_sampah'");
	}

}

class eksekusi {

	function posting($query_id_temp, $id_account_2) {
		include "koneksi.php";

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
		include "koneksi.php";

		mysqli_query($koneksi, "INSERT INTO `data_temp`(`tanggal`, `keterangan`, `no_log_pembayaran`, `nominal`, `id_account`, `in_out`, `status`, `ekstra`) VALUES ('$tanggal', '$keterangan', '$no_log_pembayaran', '$nominal', '$id_account', '$in_out', '$status', '$ekstra')") or die(mysqli_error());
	}

	function input_data_temp_posting($tanggal,$keterangan,$no_log_pembayaran,$nominal,$id_account_1,$in_out,$status,$ekstra,$id_account_2) {
		include "koneksi.php";

		mysqli_query($koneksi, "INSERT INTO `data_temp`(`tanggal`, `keterangan`, `no_log_pembayaran`, `nominal`, `id_account`, `in_out`, `status`, `ekstra`) VALUES ('$tanggal', '$keterangan', '$no_log_pembayaran', '$nominal', '$id_account_1', '$in_out', '$status', '$ekstra')") or die(mysqli_error());

		$query_temp_terakhir = mysqli_query($koneksi,"SELECT * FROM `data_temp` ORDER BY `id_temp` DESC LIMIT 1");
		$data_temp_terakhir = mysqli_fetch_array($query_temp_terakhir);
		$id_temp_terakhir = $data_temp_terakhir['id_temp'];

		$this->posting($id_temp_terakhir, $id_account_2);
	}
}

$pengkondisian = new pengkondisian;
$eksekusi = new eksekusi;
?>