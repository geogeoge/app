<?php
include "session.php";
include "../../koneksi/koneksi.php";
include "function.php";
require('../asset/fpdf/fpdf.php');
$id_po=$_GET['id_po'];

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

$bulan_romawi = array(
  '01' => 'I',
  '02' => 'II',
  '03' => 'III',
  '04' => 'IV',
  '05' => 'V',
  '06' => 'VI',
  '07' => 'VII',
  '08' => 'VIII',
  '09' => 'IX',
  '10' => 'X',
  '11' => 'XI',
  '12' => 'XII',
);
// ---------------- Deklarasi Data Di Tabel PO ------------- \\
$id_po=$_GET['id_po'];

$query_billing_po=mysqli_query($koneksi,"select * from billing_po where id_po='$id_po'");
$data_billing_po=mysqli_fetch_array($query_billing_po);
$id_register = $data_billing_po['id_register'];
$biaya_registrasi = $data_billing_po['biaya_registrasi'];
$tanggal_registrasi = $data_billing_po['tanggal_registrasi'];
$money_fee = $data_billing_po['money_fee'];
$biaya_ip_publik = $data_billing_po['biaya_ip_publik'];
$id_radio = $data_billing_po['id_radio'];
$status_radio = $data_billing_po['status_radio'];
$jumlah_radio = $data_billing_po['jumlah_radio'];
$harga_radio = $data_billing_po['harga_radio'];
$id_antena = $data_billing_po['id_antena'];
$status_antena = $data_billing_po['status_antena'];
$jumlah_antena = $data_billing_po['jumlah_antena'];
$harga_antena = $data_billing_po['harga_antena'];
$id_wifi = $data_billing_po['id_wifi'];
$status_wifi = $data_billing_po['status_wifi'];
$jumlah_wifi = $data_billing_po['jumlah_wifi'];
$harga_wifi = $data_billing_po['harga_wifi'];
$id_kabel = $data_billing_po['id_kabel'];
$status_kabel = $data_billing_po['status_kabel'];
$panjang_kabel = $data_billing_po['panjang_kabel'];
$harga_kabel = $data_billing_po['harga_kabel'];
$id_tower = $data_billing_po['id_tower'];
$status_tower = $data_billing_po['status_tower'];
$jumlah_tower = $data_billing_po['jumlah_tower'];
$harga_tower = $data_billing_po['harga_tower'];
$status = $data_billing_po['status,.'];

// ----------------// Deklarasi Data Di Tabel PO \\------------- \\

// ---------------- Proses Convert Data ------------- \\
//ID Invoice
$id_invoice = ":  A.".$id_register."/".$id_po."/01/".$bulan_romawi[date('m')]."/".date('Y');

#data register
$query_register=mysqli_query($koneksi,"select * from sale_register where id_register='$id_register'");
$data_register=mysqli_fetch_array($query_register);
$pecah_alamat = explode("#", $data_register['alamat']);
$destination_1=$data_register['nama_user'];
$destination_2=$data_register['nama_instansi'];
$destination_3="Telp / HP : ".$data_register['telp'];
if($data_register['nama_instansi']=="")
{
	$destination_2 = $pecah_alamat['3'].", ".$pecah_alamat['4'].", ".$pecah_alamat['5'];
}

//tanggal invoice
$tanggal = ":  ".date('d')." ".$bulan_indonesia[date('m')]." ".date('Y');

#data paket internet
$query_paket_internet=mysqli_query($koneksi,"select * from sale_register left join sale_paket_internet on sale_register.id_paket=sale_paket_internet.id_paket where sale_register.id_register='$id_register'");
$data_paket_internet=mysqli_fetch_array($query_paket_internet);
$nama_paket = $data_paket_internet['nama_paket'];
$harga = $data_paket_internet['harga'];
$diskripsi_paket_internet = "Biaya Internet (".$nama_paket.")";

#nominal money fee
$nominal_biaya_internet = number_format($money_fee,0,',','.');
if($money_fee==0) {
	$nominal_biaya_internet = "-";
}

#Periode
$bulan_depan = date('Y-m', strtotime('+1 month', strtotime($tanggal_registrasi)));
$tanggal_satu_bulan_depan = $bulan_depan."-1";
$akhir_bulan = date('Y-m-d', strtotime('-1 days', strtotime($tanggal_satu_bulan_depan)));
$periode = "Periode (".date('d', strtotime($tanggal_registrasi))." ".$bulan_indonesia[date('m', strtotime($tanggal_registrasi))]." ".date('Y', strtotime($tanggal_registrasi))." s/d ".date('d', strtotime($akhir_bulan))." ".$bulan_indonesia[date('m', strtotime($akhir_bulan))]." ".date('Y', strtotime($akhir_bulan)).")";

#Diskripsi registrasi
$diskripsi_registrasi_instalasi = "Biaya Registrasi + Instalasi";

#diskripsi harga monye fee
$harga_registrasi_instalasi = number_format($biaya_registrasi,0,',','.');
if($biaya_registrasi==0) {
	$harga_registrasi_instalasi = "-";
}

#query radio
$query_radio = mysqli_query($koneksi,"select * from sale_radio where id_radio='$id_radio'");
$data_radio = mysqli_fetch_array($query_radio);
$nama_radio = $data_radio['nama_radio'];
$diskripsi_radio = $jumlah_radio." Unit Radio ".$nama_radio;

#harga radio
$tampil_harga_radio = number_format($harga_radio,0,',','.');
if($harga_radio==0) {
	$tampil_harga_radio = "-";
}

#query antena
$query_antena = mysqli_query($koneksi,"select * from sale_antena where id_antena='$id_antena'");
$data_antena = mysqli_fetch_array($query_antena);
$nama_antena = $data_antena['nama_antena'];
$diskripsi_antena = $jumlah_antena." Unit Antena ".$nama_antena;

#harga antena
$tampil_harga_antena = number_format($harga_antena,0,',','.');
if($harga_antena==0) {
	$tampil_harga_antena = "-";
}

#query wifi
$query_wifi = mysqli_query($koneksi,"select * from sale_wifi where id_wifi='$id_wifi'");
$data_wifi = mysqli_fetch_array($query_wifi);
$nama_wifi = $data_wifi['nama_wifi'];
$diskripsi_wifi = $jumlah_wifi." Unit Wifi ".$nama_wifi;

#harga wifi
$tampil_harga_wifi = number_format($harga_wifi,0,',','.');
if($harga_wifi==0) {
	$tampil_harga_wifi = "-";
}

#query tower
$query_tower = mysqli_query($koneksi,"select * from sale_tower where id_tower='$id_tower'");
$data_tower = mysqli_fetch_array($query_tower);
$nama_tower = $data_tower['nama_tower'];
$diskripsi_tower = $jumlah_tower." Stik ".$nama_tower;

#harga tower
$tampil_harga_tower = number_format($harga_tower,0,',','.');
if($harga_tower==0) {
	$tampil_harga_tower = "-";
}

#query kabel
$query_kabel = mysqli_query($koneksi,"select * from sale_kabel where id_kabel='$id_kabel'");
$data_kabel = mysqli_fetch_array($query_kabel);
$nama_kabel = $data_kabel['nama_kabel'];
$diskripsi_kabel = $panjang_kabel." Meter Kabel ".$nama_kabel;

#harga kabel
$tampil_harga_kabel = number_format($harga_kabel,0,',','.');
if($harga_kabel==0) {
	$tampil_harga_kabel = "-";
}

#subtotal
$subtotal = $money_fee + $biaya_registrasi + $harga_radio + $harga_antena + $harga_wifi + $harga_tower + $harga_kabel;

#ppn
$ppn = $subtotal / 10;
$status_ppn = $data_billing_po['ppn'];
if($status_ppn=="TIDAK") {
  $ppn = 0;
  $tampil_status_ppn = '<i class="fa fa-close"></i>';
  $update_status_ppn = "IYA";
}
$ppn = $ppn;

#total
$total = $subtotal + $ppn;

#harga
$harga = number_format($harga,0,',','.');

#perangkat yang di pinjami
$tampil_dipinjami_radio = "";
$tampil_dipinjami_antena = "";
$tampil_dipinjami_wifi = "";
$tampil_dipinjami_tower = "";
$tampil_dipinjami_kabel = "";

if($status_radio=="DIPINJAMI") {
	$tampil_dipinjami_radio = $nama_radio;
}
if($status_antena=="DIPINJAMI") {
	$tampil_dipinjami_antena = ", ".$nama_antena;
}
if($status_wifi=="DIPINJAMI") {
	$tampil_dipinjami_wifi = ", ".$nama_wifi;
}
if($status_tower=="DIPINJAMI") {
	$tampil_dipinjami_tower = ", ".$nama_tower;
}
if($status_kabel=="DIPINJAMI") {
	$tampil_dipinjami_kabel = ", ".$nama_kabel;
}
$perangkat_dipinjami = $tampil_dipinjami_radio.$tampil_dipinjami_antena.$tampil_dipinjami_wifi.$tampil_dipinjami_tower.$tampil_dipinjami_kabel;
// ----------------// Proses Convert Data \\------------- \\

// ------------------ Data Yang akan di tampilkan ----------------- \\
$tampil_id_invoice = $id_invoice;
$tampil_destination_1 = $destination_1;
$tampil_tanggal = $tanggal;
$tampil_destination_2 = $destination_2;
$tampil_destination_3 = $destination_3;
$tampil_diskripsi_paket_internet = $diskripsi_paket_internet;
$tampil_nominal_biaya_internet = $nominal_biaya_internet;
$tampil_periode = $periode;
$tampil_diskripsi_registrasi_instalasi = $diskripsi_registrasi_instalasi;
$tampil_harga_registrasi_instalasi = $harga_registrasi_instalasi;
$tampil_diskripsi_radio = $diskripsi_radio;
$tampil_harga_radio = $tampil_harga_radio;
$tampil_diskripsi_antena = $diskripsi_antena;
$tampil_harga_antena = $tampil_harga_antena;
$tampil_diskripsi_wifi = $diskripsi_wifi;
$tampil_harga_wifi = $tampil_harga_wifi;
$tampil_diskripsi_tower = $diskripsi_tower;
$tampil_harga_tower = $tampil_harga_tower;
$tampil_diskripsi_kabel = $diskripsi_kabel;
$tampil_harga_kabel = $tampil_harga_kabel;
$tampil_subtotal = number_format($subtotal,0,',','.');
$tampil_ppn = number_format($ppn,0,',','.');
$tampil_total = number_format($total,0,',','.');
$tampil_harga_paket = $harga;
$tampil_perangkat_dipinjami = $perangkat_dipinjami;

// ------------------// Data Yang akan di tampilkan \\----------------- \\


$pdf = new FPDF('L','mm',array(210,148));
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->image('../asset/img/logo_solonet.jpg',10,8,100,13);
$pdf->image('../asset/img/logo_pudar_solonet.jpg',20,50,170,50);
$pdf->image('../asset/img/logo_alamat_solonet.jpg',7,135,170,7);
$pdf->Cell(0,6,'',0, 1, 'R');

$pdf->Ln();
$pdf->SetFont('Times','',10);
$pdf->Cell(100,5,'Kepada Yth :',0, 0, 'L');
$pdf->Cell(40,5,'Invoice #',0, 0, 'L');
$pdf->Cell(50,5,$tampil_id_invoice,0, 1, 'L');

$pdf->Cell(100,5,$tampil_destination_1,0, 0, 'L');
$pdf->Cell(40,5,'Tanggal Tagihan',0, 0, 'L');
$pdf->Cell(50,5,$tampil_tanggal,0, 1, 'L');

$pdf->Cell(100,5,$tampil_destination_2,0, 0, 'L');
$pdf->Cell(40,5,'Pembayaran',0, 0, 'L');
$pdf->Cell(50,5,':  Cash',0, 1, 'L');

$pdf->Cell(100,5,$tampil_destination_3,0, 1, 'L');

$pdf->Ln();
$pdf->SetFont('Times','B',10);
$pdf->Cell(10,5,'','B', 0, 'L');
$pdf->Cell(130,5,'Diskripsi','B', 0, 'L');
$pdf->Cell(10,5,'','B', 0, 'L');
$pdf->Cell(40,5,'Total','B', 1, 'C');

$pdf->SetLineWidth(1);
$pdf->Line(10,53,200,53);
$pdf->Ln(2);

$pdf->SetLineWidth(0);

$pdf->SetFont('Times','',10);
$pdf->Cell(10,5,'*','0', 0, 'L');
$pdf->Cell(130,5,$tampil_diskripsi_paket_internet,'0', 0, 'L');
$pdf->Cell(10,5,'Rp.','0', 0, 'C');
$pdf->Cell(40,5,$tampil_nominal_biaya_internet,'0', 1, 'R');

$pdf->SetFont('Times','',8);
$pdf->Cell(10,5,'','0', 0, 'L');
$pdf->Cell(130,5,$tampil_periode,'0', 0, 'L');
$pdf->Cell(10,5,'','0', 0, 'C');
$pdf->Cell(40,5,'','0', 1, 'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(10,5,'*','0', 0, 'L');
$pdf->Cell(130,5,$tampil_diskripsi_registrasi_instalasi,'0', 0, 'L');
$pdf->Cell(10,5,'Rp.','0', 0, 'C');
$pdf->Cell(40,5,$tampil_harga_registrasi_instalasi,'0', 1, 'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(10,5,'*','0', 0, 'L');
$pdf->Cell(130,5,$tampil_diskripsi_radio,'0', 0, 'L');
$pdf->Cell(10,5,'Rp.','0', 0, 'C');
$pdf->Cell(40,5,$tampil_harga_radio,'0', 1, 'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(10,5,'*','0', 0, 'L');
$pdf->Cell(130,5,$tampil_diskripsi_antena,'0', 0, 'L');
$pdf->Cell(10,5,'Rp.','0', 0, 'C');
$pdf->Cell(40,5,$tampil_harga_antena,'0', 1, 'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(10,5,'*','0', 0, 'L');
$pdf->Cell(130,5,$tampil_diskripsi_wifi,'0', 0, 'L');
$pdf->Cell(10,5,'Rp.','0', 0, 'C');
$pdf->Cell(40,5,$tampil_harga_wifi,'0', 1, 'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(10,5,'*','0', 0, 'L');
$pdf->Cell(130,5,$tampil_diskripsi_tower,'0', 0, 'L');
$pdf->Cell(10,5,'Rp.','0', 0, 'C');
$pdf->Cell(40,5,$tampil_harga_tower,'0', 1, 'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(10,5,'*','0', 0, 'L');
$pdf->Cell(130,5,$tampil_diskripsi_kabel,'0', 0, 'L');
$pdf->Cell(10,5,'Rp.','0', 0, 'C');
$pdf->Cell(40,5,$tampil_harga_kabel,'0', 1, 'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(90,5,'','0', 0, 'L');
$pdf->Cell(50,5,'Sub Total','0', 0, 'L');
$pdf->Cell(10,5,'Rp.','T', 0, 'C');
$pdf->Cell(40,5,$tampil_subtotal,'T', 1, 'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(90,5,'','0', 0, 'L');
$pdf->Cell(50,5,'PPN 10%','0', 0, 'L');
$pdf->Cell(10,5,'Rp.','0', 0, 'C');
$pdf->Cell(40,5,$tampil_ppn,'0', 1, 'R');

$pdf->SetLineWidth(1);

$pdf->SetFont('Times','B',10);
$pdf->Cell(90,7,'','0', 0, 'L');
$pdf->Cell(50,7,'TOTAL','0', 0, 'L');
$pdf->Cell(10,7,'Rp.','T', 0, 'C');
$pdf->Cell(40,7,$tampil_total,'T', 1, 'R');

$pdf->SetLineWidth(0);

$pdf->SetFont('Times','',8);
$pdf->Cell(10,4,'*)','0', 0, 'L');
$pdf->Cell(130,4,'Pembayaran biaya langganan bulanan berikutnya, dibayarkan dimuka','0', 1, 'L');
$pdf->Cell(10,4,'','0', 0, 'L');
$pdf->Cell(130,4,'selambat-lambatnya pada setiap tanggal 10 bulan berjalan Sebesar Rp. '.$tampil_harga_paket,'0', 1, 'L');
$pdf->Cell(10,4,'*)','0', 0, 'L');
$pdf->Cell(130,4,'Perangkat di bawah ini merupakan INVESTASI (DIPINJAMI) dari Solonet :','0', 1, 'L');
$pdf->Cell(10,4,'','0', 0, 'L');
$pdf->Cell(130,4,$tampil_perangkat_dipinjami,'0', 1, 'L');

$pdf->Output();
?>