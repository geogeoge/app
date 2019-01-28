<?php
include "koneksi.php";
include "function.php";

// transaksi hawe itu Kas/Bank pada Piutang

if(isset($_POST['tombol_posting'])){
	$query = mysqli_query($koneksi,"SELECT `id_sampah`, `tanggal`, `tanggal_sementara`, `keterangan`, `debit`, `kredit` FROM `sampah_hw` WHERE `status`='belum'");
	while($data = mysqli_fetch_array($query)){
		$id_sampah = $data['id_sampah'];
		$tanggal = $data['tanggal'];
		$tanggal_sementara = $data['tanggal_sementara'];
		$keterangan = $data['keterangan'];
		$debit = $data['debit'];
		$kredit = $data['kredit'];
		$no_log_pembayaran = "";
		$id_account_1 = "3";
		$ekstra = "hardware";

		//iki nggo ngecek transaksi ne nominal e ning debit opo kredit
		//yen debit nominal e luweh soko 0 brrti kui transaksi debit
		if($debit>=1){
			$in_out = 'i';
			$nominal = $debit;
		} else {
			$in_out = 'o';
			$nominal = $kredit;
		}

		//melihat di keterangan ada selain nomor nota atau tidak
		$pecah_keterangan = explode(" ", $keterangan);

		//yen keterangan ana data selain nominor nota, data di lebok e ning data temp tok wae ben di proses manual
		if(isset($pecah_keterangan[1])){

			//cek apakah ada kata via di keterangan yang ada spasinya. kalau ada berarti itu transaksi lewat bank, jadi kita post langsung juga
			$pecah_via_keterangan = explode("via", $keterangan);
			$pecah_Via_keterangan = explode("Via", $keterangan);
			$pecah_VIa_keterangan = explode("VIa", $keterangan);
			$pecah_VIA_keterangan = explode("VIA", $keterangan);


			if(isset($pecah_via_keterangan[1]) or isset($pecah_Via_keterangan[1]) or isset($pecah_VIa_keterangan[1]) or isset($pecah_VIA_keterangan[1])){
				$id_account_1 = "2";
				$id_account_2 = "3";
				$status = "sudah";
				$keterangan = "Pembayaran ( ".$keterangan." )";
				$eksekusi->input_data_temp_posting($tanggal,$keterangan,$no_log_pembayaran,$nominal,$id_account_1,$in_out,$status,$ekstra,$id_account_2);
				$pengkondisian->rubah_status_sampah_hw($id_sampah);
			} else {
				$status = "belum";
				$id_account = "1";
				$eksekusi->input_data_temp($tanggal,$keterangan,$no_log_pembayaran,$nominal,$id_account,$in_out,$status,$ekstra);
				$pengkondisian->rubah_status_sampah_hw($id_sampah);
			}
		} else {
			//tapi yen semisal data nomor nota tok, langsung di lebok e data temp + posting
			if($in_out=='i'){
				$id_account_1 = "1";
				$id_account_2 = "3";
				$status = "sudah";
				$keterangan = "Pembayaran ( ".$keterangan." )";
				$eksekusi->input_data_temp_posting($tanggal,$keterangan,$no_log_pembayaran,$nominal,$id_account_1,$in_out,$status,$ekstra,$id_account_2);
				$pengkondisian->rubah_status_sampah_hw($id_sampah);
			} else {
				$status = "belum";
				$id_account = "1";
				$eksekusi->input_data_temp($tanggal,$keterangan,$no_log_pembayaran,$nominal,$id_account,$in_out,$status,$ekstra);
				$pengkondisian->rubah_status_sampah_hw($id_sampah);
			}
		}

	}
}

if(isset($_POST['tombol_buat_tanggal'])){
	$pengkondisian->input_tanggal();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Input hardware</title>
</head>
<body>
<form method="POST">
	<input type="submit" name="tombol_buat_tanggal" value="Buat Tanggal"></input><br>
	<input type="submit" name="tombol_posting" value="EKSEKUSI"></input><br>
</form>
</body>
</html>