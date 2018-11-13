<?php
include "session.php";
include "../../koneksi/koneksi.php";
include "function.php";
require('../asset/fpdf/fpdf.php');

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

// ---------------- Proses Convert Data ------------- \\
$id_register = $_GET['id_register'];
$query_tagihan_register = mysqli_query($koneksi,"select * from sale_register left join sale_paket_internet on sale_register.id_paket=sale_paket_internet.id_paket where sale_register.id_register='$id_register'");
$tampil_tagihan_register = mysqli_fetch_array($query_tagihan_register);
$nama_user = $tampil_tagihan_register['nama_user'];
$nama_instansi = $tampil_tagihan_register['nama_instansi'];
$alamat = $tampil_tagihan_register['alamat'];
$pecah_alamat = explode("#", $alamat);
$telp = $tampil_tagihan_register['telp'];
$nama_paket = $tampil_tagihan_register['nama_paket'];
$harga = $tampil_tagihan_register['harga'];
$ip_publik = $tampil_tagihan_register['ip_publik'];
$sisa_pembayaran = $tampil_tagihan_register['billing_saldo'];
$bulan_berjalan = $tampil_tagihan_register['billing_bulan_berjalan'];
$bulan_terbayar = $tampil_tagihan_register['billing_bulan_terbayar'];
$tunggakan = $bulan_berjalan - $bulan_terbayar;

#id_invoice
$id_invoice = ":  ".$id_register."/".$bulan_romawi[date('m')]."/".date('Y');

#destination 1
$destination_1 = ":  ".$nama_user;

#tanggal hari ini
$tanggal = ": ".date('d')." ".$bulan_indonesia[date('m')]." ".date('Y');

//data user di invoice
$pecah_alamat = explode("#", $tampil_tagihan_register['alamat']);
$destination_1=$tampil_tagihan_register['nama_user'];
$destination_2=$tampil_tagihan_register['nama_instansi'];
$destination_3="Telp / HP : ".$tampil_tagihan_register['telp'];

if($tampil_tagihan_register['nama_instansi']=="" or $tampil_tagihan_register['nama_instansi']==" ")
{
  $destination_2 = $pecah_alamat['3'].", ".$pecah_alamat['4'].", ".$pecah_alamat['5'];
  if($pecah_alamat['3']=="" or $pecah_alamat['3']==" "){
    $destination_2 = $pecah_alamat['4'].", ".$pecah_alamat['5'];
  }
  if($pecah_alamat['4']=="" or $pecah_alamat['4']==" "){
    $destination_2 = $pecah_alamat['5'];
  }
  if($pecah_alamat['5']=="" or $pecah_alamat['5']==" "){
    $destination_2 = $destination_3;
    $destination_3 = "";
  }
}

#deskripsi tagihan
$deskripsi_tagihan = "Biaya Internet Bulanan (".$nama_paket.")";

#nominal tagihan 
$nominal_tagihan = $harga;

#periode sing paling angel
//mencari tanggal akir bulan
$bulan_depan = date('Y-m', strtotime('+1 month'));
$tanggal_satu_bulan_depan = $bulan_depan."-1";
$akhir_bulan = date('Y-m-d', strtotime('-1 days', strtotime($tanggal_satu_bulan_depan)));

//mencari periode awal tunggakan
$tunggakan_kurang_satu = $tunggakan - 1;
$variable_pengurangan_bulan_tunggakan = "-".$tunggakan_kurang_satu." month";
$bulan_awal_tunggakan = date('Y-m', strtotime($variable_pengurangan_bulan_tunggakan));

//ini dia periodenya
$periode = "Periode : 1 ".$bulan_indonesia[date('m', strtotime($bulan_awal_tunggakan))]." ".date('Y', strtotime($bulan_awal_tunggakan))." - ".date('d', strtotime($akhir_bulan))." ".$bulan_indonesia[date('m')]." ".date('Y');

#nominal_tunggakan
$nominal_tagihan = $tunggakan * $harga;

#sewa ip publik
$point_ip_publik = "";
$diskripsi_ip_publik = "";
$rupiah_ip_publik = "";
$nominal_ip_publik = "";
$harga_ip_publik = "";
if($ip_publik=="IYA") {
  $point_ip_publik = "*";
  $diskripsi_ip_publik = "Biaya sewa IP Publik";
  $rupiah_ip_publik = "Rp.";
  $nominal_ip_publik = "100.000";
  $harga_ip_publik = "100000";
}

$harga_ip_publik = $harga_ip_publik * $tunggakan;

#subtotal
$subtotal = $nominal_tagihan + $harga_ip_publik;

#sisa pembayaran
$sisa_pembayaran = $sisa_pembayaran;

#total
$total = $subtotal - $sisa_pembayaran;

#harga paket
$harga_paket = number_format($harga,0,',','.');
// ----------------// Proses Convert Data \\------------- \\

// ------------------ Data Yang akan di tampilkan ----------------- \\
$tampil_id_invoice = $id_invoice;
$tampil_destination_1 = $nama_user;
$tampil_tanggal = ":  ".date('d')." ".$bulan_indonesia[date('m')]." ".date('Y');
$tampil_destination_2 = $destination_2;
$tampil_destination_3 = $destination_3;
$tampil_diskripsi_tagihan = "Biaya Internet Bulanan (".$nama_paket.")";
$tampil_nominal_tagihan = number_format($nominal_tagihan,0,',','.');
$tampil_periode = $periode;
$tampil_point_ip_publik = $point_ip_publik;
$tampil_diskripsi_ip_publik = $diskripsi_ip_publik;
$tampil_rupiah_ip_publik = $rupiah_ip_publik;
$tampil_nominal_ip_publik = number_format($harga_ip_publik,0,',','.');
$tampil_subtotal = number_format($subtotal,0,',','.');
$tampil_sisa_pembayaran = number_format($sisa_pembayaran,0,',','.');
$tampil_total = number_format($total,0,',','.');
$tampil_harga_paket = $harga_paket;

// ------------------// Data Yang akan di tampilkan \\----------------- \\


$pdf = new FPDF('L','mm',array(210,148));
$pdf->AddPage();
$pdf->SetTextColor(0,0,115);
$pdf->SetFont('Arial','B',22);
$pdf->image('../asset/img/logo_solonet.jpg',10,8,100,13);
$pdf->image('../asset/img/logo_pudar_solonet.jpg',20,50,170,50);
$pdf->image('../asset/img/logo_pembayaran.jpg',10,118,70,17);
$pdf->image('../asset/img/logo_alamat_solonet.jpg',7,135,170,7);
$pdf->Cell(190,12,'I N V O I C E',0, 1, 'R');

$pdf->SetTextColor(0,0,0);
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

$pdf->Ln(2);
$pdf->SetFont('Times','B',10);
$pdf->Cell(10,5,'','B', 0, 'L');
$pdf->Cell(130,5,'Diskripsi','B', 0, 'L');
$pdf->Cell(10,5,'','B', 0, 'L');
$pdf->Cell(40,5,'Total','B', 1, 'C');

$pdf->SetLineWidth(1);
$pdf->Line(10,50,200,50);
$pdf->Ln(2);

$pdf->SetLineWidth(0);

$pdf->SetFont('Times','',10);
$pdf->Cell(10,5,'*','0', 0, 'L');
$pdf->Cell(130,5,$tampil_diskripsi_tagihan,'0', 0, 'L');
$pdf->Cell(10,5,'Rp.','0', 0, 'C');
$pdf->Cell(40,5,$tampil_nominal_tagihan,'0', 1, 'R');

$pdf->SetFont('Times','',8);
$pdf->Cell(10,5,'','0', 0, 'L');
$pdf->Cell(130,5,$tampil_periode,'0', 0, 'L');
$pdf->Cell(10,5,'','0', 0, 'C');
$pdf->Cell(40,5,'','0', 1, 'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(10,5,$tampil_point_ip_publik,'0', 0, 'L');
$pdf->Cell(130,5,$tampil_diskripsi_ip_publik,'0', 0, 'L');
$pdf->Cell(10,5,$tampil_rupiah_ip_publik,'0', 0, 'C');
$pdf->Cell(40,5,$tampil_nominal_ip_publik,'0', 1, 'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(10,5,'','0', 0, 'L');
$pdf->Cell(130,5,'','0', 0, 'L');
$pdf->Cell(10,5,'','0', 0, 'C');
$pdf->Cell(40,5,'','0', 1, 'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(10,5,'','0', 0, 'L');
$pdf->Cell(130,5,'','0', 0, 'L');
$pdf->Cell(10,5,'','0', 0, 'C');
$pdf->Cell(40,5,'','0', 1, 'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(10,5,'','0', 0, 'L');
$pdf->Cell(130,5,'','0', 0, 'L');
$pdf->Cell(10,5,'','0', 0, 'C');
$pdf->Cell(40,5,'','0', 1, 'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(10,5,'','0', 0, 'L');
$pdf->Cell(130,5,'','0', 0, 'L');
$pdf->Cell(10,5,'','0', 0, 'C');
$pdf->Cell(40,5,'','0', 1, 'R');



$pdf->SetFont('Times','',10);
$pdf->Cell(90,5,'','0', 0, 'L');
$pdf->Cell(50,5,'Sub Total','0', 0, 'L');
$pdf->Cell(10,5,'Rp.','T', 0, 'C');
$pdf->Cell(40,5,$tampil_subtotal,'T', 1, 'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(90,5,'','0', 0, 'L');
$pdf->Cell(50,5,'Sisa Pembayaran ','0', 0, 'L');
$pdf->Cell(10,5,'Rp.','0', 0, 'C');
$pdf->Cell(40,5,$tampil_sisa_pembayaran,'0', 1, 'R');

$pdf->SetLineWidth(1);

$pdf->SetFont('Times','B',10);
$pdf->Cell(90,7,'','0', 0, 'L');
$pdf->Cell(50,7,'TOTAL','0', 0, 'L');
$pdf->Cell(10,7,'Rp.','T', 0, 'C');
$pdf->Cell(40,7,$tampil_total,'T', 1, 'R');

$pdf->SetLineWidth(0);

$pdf->SetFont('Times','',8);
$pdf->Cell(10,4,'*)','0', 0, 'L');
$pdf->Cell(130,4,'Untuk harga paket Rp. '.$tampil_harga_paket.' sudah termasuk PPN 10%','0', 1, 'L');
$pdf->Cell(10,4,'*)','0', 0, 'L');
$pdf->Cell(130,4,'Pembayaran biaya langganan bulanan, dibayarkan dimuka','0', 1, 'L');
$pdf->Cell(10,4,'','0', 0, 'L');
$pdf->Cell(130,4,'selambat-lambatnya pada setiap tanggal 10 bulan berjalan Sebesar Rp. '.$tampil_harga_paket,'0', 1, 'L');

$pdf->Output($nama_user."__".$bulan_indonesia[date('m')].".pdf",'i');
?>