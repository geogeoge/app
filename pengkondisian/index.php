<?php
include 'koneksi.php';

?>
<hr>
<form method="POST">
	<center>Pengkondisian App Accounting</center>
	<br>
	Tombol ini untuk menghapus table dari account lama di database baru
	<input type="Submit" name="hapus_table_lama" value="Hapus Table">
	<br>
	<br>
	Tombol di bawah ini berfungsi untuk mengimport sistem akuntansi yang baru
	<input type="Submit" name="import" value="Import Sistem Baru">
	<br>
	<br>
	Tombol di bawah ini berfungsi untuk mengetest account app lama sudah sama dengan app baru atau belum
	<input type="Submit" name="test_account" value="Test Account">
	<br>
	<br>
	Tombol ini untuk mengeksekusi konversi dari app lama ke app baru
	<input type="Submit" name="eksekusi" value="Execute">
</form>
<hr>
<?php
if(isset($_POST['test_account'])){
	?>
	<table border="1">
		<tr>
			<td>No</td>
			<td>ID Lama</td>
			<td>Akun Lama</td>
			<td>ID Baru</td>
		</tr>
	<?php
	$no = 0;
	$query_account_lama = mysqli_query($koneksi_lama,"SELECT * FROM `account`");
	while($data_account_lama = mysqli_fetch_array($query_account_lama)){
		$no_account = $data_account_lama['no_account'];
		$nama_account = $data_account_lama['nama_account'];

		$query_account_baru = mysqli_query($koneksi_baru,"SELECT * FROM `account` WHERE nama_account='$nama_account'");
		$data_account_baru = mysqli_fetch_array($query_account_baru);
		$id_account = $data_account_baru['id_account'];
		?>
		<tr>
			<td><?php echo $no;?></td>
			<td><?php echo $no_account;?></td>
			<td><?php echo $nama_account;?></td>
			<td><?php echo $id_account;?></td>
		</tr>
		<?php
		$no++;
	}
	?>
	</table>
	<?php
}

if(isset($_POST['eksekusi'])){
	$jumlah_record = 0;
	$query_account_lama = mysqli_query($koneksi_lama,"SELECT * FROM `account`");
	while($data_account_lama = mysqli_fetch_array($query_account_lama)){
		$nama_account_lama = $data_account_lama['nama_account'];

		$query_account_baru = mysqli_query($koneksi_baru,"SELECT * FROM `account` WHERE nama_account='$nama_account_lama'");
		$data_account_baru = mysqli_fetch_array($query_account_baru);
		$id_account = $data_account_baru['id_account'];

		$query_table_lama = mysqli_query($koneksi_lama,"SELECT * FROM `$nama_account_lama`");
		while($data_table_lama = mysqli_fetch_array($query_table_lama)){
			$no_transaksi = $data_table_lama['no_transaksi'];
			$bukti_transaksi = $data_table_lama['bukti_transaksi'];
			$tanggal = $data_table_lama['tanggal'];
			$keterangan = $data_table_lama['keterangan'];
			$debit = $data_table_lama['debit'];
			$kredit = $data_table_lama['kredit'];

			if($debit>=1){
				$nominal = $debit;
				$DK="D";
			} else {
				$nominal = $kredit;
				$DK="K";
			}


			$proses_inputan = mysqli_query($koneksi_baru,"INSERT INTO `data_transaksi`(`no_transaksi`, `tanggal`, `keterangan`, `nominal`, `id_account`, `DK`) VALUES ('$no_transaksi', '$tanggal', '$keterangan', '$nominal', '$id_account', '$DK')");

			if($proses_inputan){
				$jumlah_record = $jumlah_record + 1;
			}
		}
	}

	echo "Jumlah Data Yang tersimpan :".$jumlah_record;
}

if(isset($_POST['hapus_table_lama'])){
	$query_table = mysqli_query($koneksi_baru,"show tables");
	while($data_table = mysqli_fetch_array($query_table)){
		echo $nama_table = $data_table['Tables_in_baru_solonet_app']."<br>";

		$query_account_baru = mysqli_query($koneksi_baru,"SELECT * FROM `account` where nama_account='$nama_table'");
		$jumlah_account_baru = mysqli_num_rows($query_account_baru);
		if($jumlah_account_baru>=1){
			echo $nama_table."<br>";
	 		mysqli_query($koneksi_baru,"DROP TABLE `$nama_table`") ;
		}
	}

	mysqli_query($koneksi_baru,"DROP TABLE `account`, `accounting_user`, `jenis_account`, `jenis_bank`, `jurnal_bank_BCA`, `jurnal_bank_BNI`, `jurnal_bank_BRI`, `jurnal_bank_MANDIRI`, `jurnal_kas`, `jurnal_umum`, `temp`, `temp_BCA`, `temp_BNI`, `temp_BRI`, `temp_MANDIRI`");
}

if(isset($_POST['import'])){
	mysqli_query($koneksi_baru,"
		CREATE TABLE `account` (
		  `id_account` int(7) NOT NULL AUTO_INCREMENT,
		  `nama_account` varchar(50) NOT NULL,
		  `id_jenis_account` varchar(50) NOT NULL,
		  `english` varchar(100) NOT NULL,
		  PRIMARY KEY (`id_account`)
		);
		INSERT INTO `account` VALUES (1,'Kas','1','Cash and Cash Equivalents'),(2,'Bank','1','Bank'),(3,'Piutang Dagang','1','Account Receivable'),(4,'Biaya Dibayar Dimuka','1','Prepaid Expense'),(5,'Ppn Masukan','1','Income Ppn'),(6,'Persediaan','1','Stock'),(7,'Piutang Karyawan','1','Employee Receivables'),(8,'Tanah','2','Land'),(9,'Gedung','2','Building'),(10,'Akumulasi Depresiasi Gedung','2','Accumulated Depreciation of Building'),(11,'Mesin-mesin','2','Machines'),(12,'Akumulasi Depresiasi Mesin-mesin','2','Accumulated Depreciation of Machines'),(13,'Inventaris','2','Inventory'),(14,'Akumulasi Depresiasi Inventaris','2','Accumulated Depreciation of Inventory'),(15,'Kendaraan','2','Vehicles'),(16,'Akumulasi Depresiasi Kendaraan','2','Accumulated Depreciation of Vehicles'),(17,'Hutang Biaya','3','Expense Payable'),(18,'Hutang Biaya Bandwith','3','Bandwith Expense Payable'),(19,'Hutang Gaji','3','Salary Payable'),(20,'Hutang Connectsi','3','Connectsi Payable'),(21,'Hutang Dagang','3','Sales Payable'),(22,'Hutang Ppn','3','Ppn Payable'),(23,'Pendapatan Dimuka','8','Other Payable'),(24,'Hutang Internal','3','Intern Payable'),(25,'Hutang Hardware','3','Hardware Payable'),(26,'Hutang Biaya Bunga','3','Interest Rate Payable'),(27,'Hutang Fee','3','Fee Payable'),(28,'Hutang Office','3','Office Payable'),(29,'Hutang Bank','4','Bank Payable'),(30,'Modal','5','Capital'),(31,'Laba (Rugi) Tahun Berjalan','8','Net Income'),(32,'Registrasi','6','Register'),(33,'Pendapatan Dial Up','6','Dial Up Revenues'),(34,'Pendapatan Internet','6','Internet Revenues'),(35,'Pendapatan Web & Domain','6','Web & Domain Revenues'),(36,'Pendapatan Lain-lain','6','Others Revenues'),(37,'Pendapatan Hardware','6','Hardware Revenues'),(38,'Pendapatan Bank','7','Bank Revenues'),(39,'Biaya Bank','8','Bank Charges'),(40,'Biaya Bandwith','8','Bandwith Cost'),(41,'Biaya Lain-lain','8','Others Cost'),(42,'Biaya Overhead','8','Overhead Cost'),(43,'Potongan Penjualan','8','Sales Discounts'),(44,'Biaya Bunga Hutang','3','Interest Rate of Debt'),(45,'Biaya Web & Domain','8','Web & Domain Cost'),(46,'PPh ps 23','8','PPh ps 23'),(47,'PPN','8','PPN'),(48,'Biaya Hak Penggunaan & USO','8','Usage Rights & USO Charges'),(49,'Biaya Penyusutan Gedung','8','Depreciation Cost Building'),(50,'Biaya Maintenance','8','Maintenance Cost'),(51,'Biaya Penyusutan Mesin-mesin','8','Depreciation Cost of Machines'),(52,'Biaya Penyusutan Inventaris','8','Depreciation Cost of Inventory'),(53,'Biaya Penyusutan Sewa BTS','8','Depreciation Cost of BTS Rent'),(54,'Biaya Operasional Kantor','8','Office Operational Cost'),(55,'Biaya Rumah Tangga Kantor','8','Household Office Cost'),(56,'Fee Marketing','8',''),(57,'Biaya Sewa','8',''),(58,'Biaya Penjualan','8',''),(59,'Cadangan THR','8',''),(60,'Biaya Utilities','8','Utilities Cost'),(61,'Biaya Telepon','8','Telephone Cost'),(62,'Salary','8','Salary'),(63,'Biaya Office Supplies','8','Office Supplies Cost'),(64,'Biaya Travel','8','Travel Cost'),(65,'Biaya Marketing','8','Marketing Cost'),(66,'Biaya Asuransi','8','Insurance Cost');

		CREATE TABLE `data_temp` (
		  `id_temp` int(11) NOT NULL AUTO_INCREMENT,
		  `tanggal` date NOT NULL,
		  `keterangan` text NOT NULL,
		  `nominal` int(11) NOT NULL,
		  `id_account` varchar(225) NOT NULL,
		  `in_out` enum('i','o') NOT NULL,
		  `status` enum('belum','sudah') NOT NULL,
		  `ekstra` varchar(225) NOT NULL,
		  PRIMARY KEY (`id_temp`)
		) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

		CREATE TABLE `data_transaksi` (
		  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
		  `no_transaksi` varchar(225) NOT NULL,
		  `tanggal` date NOT NULL,
		  `keterangan` text NOT NULL,
		  `nominal` int(11) NOT NULL,
		  `id_account` text NOT NULL,
		  `DK` enum('D','K') NOT NULL,
		  `id_temp` varchar(225) NOT NULL,
		  `ekstra` text NOT NULL,
		  PRIMARY KEY (`id_transaksi`)
		) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

		CREATE TABLE `jenis_account` (
		  `id_jenis_account` int(3) NOT NULL AUTO_INCREMENT,
		  `jenis_account` varchar(50) NOT NULL,
		  `id_master_jenis_account` varchar(225) NOT NULL,
		  PRIMARY KEY (`id_jenis_account`),
		  KEY `jenis_account` (`jenis_account`)
		) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
		INSERT INTO `jenis_account` VALUES (1,'ASET LANCAR','1'),(2,'ASET TETAP','1'),(3,'KEWAJIBAN LANCAR','2'),(4,'KEWAJIBAN JANGKA PANJANG','2'),(5,'EKUITAS','3'),(6,'PENDAPATAN USAHA','4'),(7,'PENDAPATAN LAIN LAIN','4'),(8,'BIAYA','5');

		CREATE TABLE `master_jenis_account` (
		  `id_master_jenis_account` int(11) NOT NULL AUTO_INCREMENT,
		  `master_jenis_account` varchar(225) NOT NULL,
		  PRIMARY KEY (`id_master_jenis_account`)
		) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
		INSERT INTO `master_jenis_account` VALUES (1,'ASSET'),(2,'KEWAJIBAN'),(3,'EKUITAS'),(4,'PENDAPATAN'),(5,'BIAYA');

		ALTER TABLE  `data_temp` CHANGE  `tanggal`  `tanggal` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;

		ALTER TABLE  `data_temp` ADD  `id_register` VARCHAR( 225 ) NOT NULL AFTER  `keterangan` ;

		") or die(mysqli_error($koneksi_baru));

		
}
?>