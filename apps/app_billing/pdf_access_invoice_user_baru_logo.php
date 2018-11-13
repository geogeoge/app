<?php
include "session.php";
include "../../koneksi/koneksi.php";
include "function.php";
require('../asset/fpdf/fpdf.php');
$id_register=$_GET['id_register'];

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
$query_sale_register=mysqli_query($koneksi,"select * from sale_register where id_register='$id_register'");
$data_sale_register=mysqli_fetch_array($query_sale_register);
$id_register = $data_sale_register['id_register'];
$id_paket = $data_sale_register['id_paket'];
$tanggal_trial = $data_sale_register['tanggal_trial'];

$biaya_registrasi = $data_sale_register['biaya_registrasi'];
$monthly_fee = $data_sale_register['monthly_fee'];
$biaya_ip_publik = $data_sale_register['biaya_ip_publik'];
$id_radio = $data_sale_register['id_radio'];
$status_radio = $data_sale_register['status_radio'];
$jumlah_radio = $data_sale_register['jumlah_radio'];
$harga_radio = $data_sale_register['harga_radio'];
$id_antena = $data_sale_register['id_antena'];
$status_antena = $data_sale_register['status_antena'];
$jumlah_antena = $data_sale_register['jumlah_antena'];
$harga_antena = $data_sale_register['harga_antena'];
$id_wifi = $data_sale_register['id_wifi'];
$status_wifi = $data_sale_register['status_wifi'];
$jumlah_wifi = $data_sale_register['jumlah_wifi'];
$harga_wifi = $data_sale_register['harga_wifi'];
$id_kabel = $data_sale_register['id_kabel'];
$status_kabel = $data_sale_register['status_kabel'];
$panjang_kabel = $data_sale_register['panjang_kabel'];
$harga_kabel = $data_sale_register['harga_kabel'];
$id_tower = $data_sale_register['id_tower'];
$status_tower = $data_sale_register['status_tower'];
$jumlah_tower = $data_sale_register['jumlah_tower'];
$harga_tower = $data_sale_register['harga_tower'];
$status = $data_sale_register['status'];
$status = $data_sale_register['status'];

$tambahan_1=$data_sale_register['tambahan_1'];
$jumlah_tambahan_1=$data_sale_register['jumlah_tambahan_1'];
$status_tambahan_1=$data_sale_register['status_tambahan_1'];
$harga_tambahan_1=$data_sale_register['harga_tambahan_1'];
$tambahan_2=$data_sale_register['tambahan_2'];
$jumlah_tambahan_2=$data_sale_register['jumlah_tambahan_2'];
$status_tambahan_2=$data_sale_register['status_tambahan_2'];
$harga_tambahan_2=$data_sale_register['harga_tambahan_2'];


//------------------------------------------------- // DATA HEADER DO INVOICE \\ -------------------------------------------------\\
//data user di invoice
$pecah_alamat = explode("#", $data_sale_register['alamat']);
$destination_1=$data_sale_register['nama_user'];
$destination_2=$data_sale_register['nama_instansi'];
$destination_3="Telp / HP : ".$data_sale_register['telp'];

if($data_register['nama_instansi']=="")
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

//ID Invoice
$id_invoice = ":  A.".$id_register."/".date('d',strtotime($data_sale_register['tanggal_trial']))."/".$bulan_romawi[date('m')]."/".date('Y');

//tanggal invoice
$tanggal = ":  ".date('d',strtotime($data_sale_register['tanggal_trial']))." ".$bulan_indonesia[date('m',strtotime($data_sale_register['tanggal_trial']))]." ".date('Y',strtotime($data_sale_register['tanggal_trial']));

//------------------------------------------------- // ! DATA HEADER DI INVOICE ! \\ -------------------------------------------------\\

//------------------------------------------------- // DATA BODY DI INVOICE \\ -------------------------------------------------\\
//data paket internet
$query_paket_internet=mysqli_query($koneksi,"select * from sale_paket_internet where id_paket='$id_paket'");
$data_paket_internet=mysqli_fetch_array($query_paket_internet);
$nama_paket = $data_paket_internet['nama_paket'];
$harga = $data_paket_internet['harga'];
$diskripsi_paket_internet = "Biaya Internet (".$nama_paket.")";

#nominal money fee
$nominal_biaya_internet = number_format($monthly_fee,0,',','.');
if($monthly_fee==0) {
  $nominal_biaya_internet = "-";
}

#Periode
$bulan_depan = date('Y-m', strtotime('+1 month', strtotime($tanggal_trial)));
$tanggal_satu_bulan_depan = $bulan_depan."-1";
$akhir_bulan = date('Y-m-d', strtotime('-1 days', strtotime($tanggal_satu_bulan_depan)));
$periode = "Periode (".date('d', strtotime($tanggal_trial))." ".$bulan_indonesia[date('m', strtotime($tanggal_trial))]." ".date('Y', strtotime($tanggal_trial))." s/d ".date('d', strtotime($akhir_bulan))." ".$bulan_indonesia[date('m', strtotime($akhir_bulan))]." ".date('Y', strtotime($akhir_bulan)).")";

#Diskripsi registrasi
$diskripsi_registrasi_instalasi = "Biaya Registrasi + Instalasi";

#diskripsi biaya registrasi dan instalasi
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

$diskripsi_tambahan_1 = $jumlah_tambahan_1." Unit ". $tambahan_1;
$tampil_harga_tambahan_1 = number_format($harga_tambahan_1,0,',','.');

$diskripsi_tambahan_2 = $jumlah_tambahan_2." Unit ". $tambahan_2;
$tampil_harga_tambahan_2 = number_format($harga_tambahan_2,0,',','.');


//------------------------------------------------- // ! DATA BODY DI INVOICE ! \\ -------------------------------------------------\\

// ------------------ Data Yang akan di tampilkan ----------------- \\
$tampil_id_invoice = $id_invoice;
$tampil_destination_1 = $destination_1;
$tampil_tanggal = $tanggal;
$tampil_destination_2 = $destination_2;
$tampil_destination_3 = $destination_3;

$bintang_paket_internet = "*";
$tampil_diskripsi_paket_internet = $diskripsi_paket_internet;
$tampil_nominal_biaya_internet = $nominal_biaya_internet;
$tampil_periode = $periode;

$bintang_registrasi_instalasi = "*";
$tampil_diskripsi_registrasi_instalasi = $diskripsi_registrasi_instalasi;
$tampil_harga_registrasi_instalasi = $harga_registrasi_instalasi;

$bintang_radio = "*";
$tampil_diskripsi_radio = $diskripsi_radio;
$tampil_harga_radio = $tampil_harga_radio;

$bintang_antena = "*";
$tampil_diskripsi_antena = $diskripsi_antena;
$tampil_harga_antena = $tampil_harga_antena;

$bintang_wifi = "*";
$tampil_diskripsi_wifi = $diskripsi_wifi;
$tampil_harga_wifi = $tampil_harga_wifi;

$bintang_tower = "*";
$tampil_diskripsi_tower = $diskripsi_tower;
$tampil_harga_tower = $tampil_harga_tower;

$bintang_kabel = "*";
$tampil_diskripsi_kabel = $diskripsi_kabel;
$tampil_harga_kabel = $tampil_harga_kabel;

$bintang_tambahan_1 = "*";
$tampil_diskripsi_tambahan_1 = $diskripsi_tambahan_1;
$tampil_harga_tambahan_1 = $harga_tambahan_1;

$bintang_tambahan_2 = "*";
$tampil_diskripsi_tambahan_2 = $diskripsi_tambahan_2;
$tampil_harga_tambahan_2 = $harga_tambahan_2;


$tampil_perangkat_dipinjami = $perangkat_dipinjami;

//------------------------------------------------- // URUTAN DATA YANG AKAN DI TAMPILKAN \\ -------------------------------------------------\\

#subtotal
$subtotal = $monthly_fee + $biaya_registrasi;


if($status_radio=="BELI"){
  $tampil_bintang[] = "*";
  $tampil_diskripsi[] = $tampil_diskripsi_radio;
  $tampil_harga[] = $tampil_harga_radio;
  $tampil_rp[] = "Rp. ";
  $subtotal = $subtotal+$harga_radio;
}
if($status_antena=="BELI"){
  $tampil_bintang[] = "*";
  $tampil_diskripsi[] = $tampil_diskripsi_antena;
  $tampil_harga[] = $tampil_harga_antena;
  $tampil_rp[] = "Rp. ";
  $subtotal = $subtotal+$harga_antena;
}
if($status_wifi=="BELI"){
  $tampil_bintang[] = "*";
  $tampil_diskripsi[] = $tampil_diskripsi_wifi;
  $tampil_harga[] = $tampil_harga_wifi;
  $tampil_rp[] = "Rp. ";
  $subtotal = $subtotal+$harga_wifi;
}
if($status_tower=="BELI"){
  $tampil_bintang[] = "*";
  $tampil_diskripsi[] = $tampil_diskripsi_tower;
  $tampil_harga[] = $tampil_harga_tower;
  $tampil_rp[] = "Rp. ";
  $subtotal = $subtotal+$harga_tower;
}
if($status_kabel=="BELI"){
  $tampil_bintang[] = "*";
  $tampil_diskripsi[] = $tampil_diskripsi_kabel;
  $tampil_harga[] = $tampil_harga_kabel;
  $tampil_rp[] = "Rp. ";
  $subtotal = $subtotal+$harga_kabel;
}
if($status_tambahan_1=="BELI"){
  $tampil_bintang[] = "*";
  $tampil_diskripsi[] = $tampil_diskripsi_tambahan_1;
  $tampil_harga[] = $tampil_harga_tambahan_1;
  $tampil_rp[] = "Rp. ";
  $subtotal = $subtotal+$tampil_harga_tambahan_1;
}
if($status_tambahan_2=="BELI"){
  $tampil_bintang[] = "*";
  $tampil_diskripsi[] = $tampil_diskripsi_tambahan_2;
  $tampil_harga[] = $tampil_harga_tambahan_2;
  $tampil_rp[] = "Rp. ";
  $subtotal = $subtotal+$tampil_harga_tambahan_2;
}

if($status_radio=="DIPINJAMI"){
  $alat_dipinjami[] = $nama_radio; 
}
if($status_antena=="DIPINJAMI"){
  $alat_dipinjami[] = $nama_antena; 
}
if($status_wifi=="DIPINJAMI"){
  $alat_dipinjami[] = $nama_wifi; 
}
if($status_tower=="DIPINJAMI"){
  $alat_dipinjami[] = $nama_tower; 
}
if($status_kabel=="DIPINJAMI"){
  $alat_dipinjami[] = $nama_kabel; 
}
if($status_tambahan_1=="DIPINJAMI"){
  $alat_dipinjami[] = $tambahan_1; 
}
if($status_tambahan_2=="DIPINJAMI"){
  $alat_dipinjami[] = $tambahan_2; 
} else {
  $alat_dipinjami[] = ""; 
}

$tampil_perangkat_dipinjami = implode(", ", $alat_dipinjami);

#ppn
$ppn = $subtotal / 10;
$status_ppn = $data_sale_register['ppn'];
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

$tampil_subtotal = number_format($subtotal,0,',','.');
$tampil_ppn = number_format($ppn,0,',','.');
$tampil_total = number_format($total,0,',','.');
$tampil_harga_paket = $harga;

//------------------------------------------------- // ! URUTAN DATA YANG AKAN DI TAMPILKAN ! \\ -------------------------------------------------\\

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

$pdf->SetFont('Times','B',10);
$pdf->Cell(10,5,'','B', 0, 'L');
$pdf->Cell(130,5,'Diskripsi','B', 0, 'L');
$pdf->Cell(10,5,'','B', 0, 'L');
$pdf->Cell(40,5,'Total','B', 1, 'C');

$pdf->SetLineWidth(1);
$pdf->Line(10,48,200,48);
$pdf->Ln(2);

$pdf->SetLineWidth(0);

$pdf->SetFont('Times','',10);
$pdf->Cell(10,5,$bintang_paket_internet,'0', 0, 'L');
$pdf->Cell(130,5,$tampil_diskripsi_paket_internet,'0', 0, 'L');
$pdf->Cell(10,5,'Rp.','0', 0, 'C');
$pdf->Cell(40,5,$tampil_nominal_biaya_internet,'0', 1, 'R');

$pdf->SetFont('Times','',8);
$pdf->Cell(10,5,'','0', 0, 'L');
$pdf->Cell(130,5,$tampil_periode,'0', 0, 'L');
$pdf->Cell(10,5,'','0', 0, 'C');
$pdf->Cell(40,5,'','0', 1, 'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(10,4,$bintang_registrasi_instalasi,'0', 0, 'L');
$pdf->Cell(130,4,$tampil_diskripsi_registrasi_instalasi,'0', 0, 'L');
$pdf->Cell(10,4,'Rp.','0', 0, 'C');
$pdf->Cell(40,4,$tampil_harga_registrasi_instalasi,'0', 1, 'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(10,4,$tampil_bintang['0'],'0', 0, 'L');
$pdf->Cell(130,4,$tampil_diskripsi['0'],'0', 0, 'L');
$pdf->Cell(10,4,$tampil_rp['0'],'0', 0, 'C');
$pdf->Cell(40,4,$tampil_harga['0'],'0', 1, 'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(10,4,$tampil_bintang['1'],'0', 0, 'L');
$pdf->Cell(130,4,$tampil_diskripsi['1'],'0', 0, 'L');
$pdf->Cell(10,4,$tampil_rp['1'],'0', 0, 'C');
$pdf->Cell(40,4,$tampil_harga['1'],'0', 1, 'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(10,4,$tampil_bintang['2'],'0', 0, 'L');
$pdf->Cell(130,4,$tampil_diskripsi['2'],'0', 0, 'L');
$pdf->Cell(10,4,$tampil_rp['2'],'0', 0, 'C');
$pdf->Cell(40,4,$tampil_harga['2'],'0', 1, 'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(10,4,$tampil_bintang['3'],'0', 0, 'L');
$pdf->Cell(130,4,$tampil_diskripsi['3'],'0', 0, 'L');
$pdf->Cell(10,4,$tampil_rp['3'],'0', 0, 'C');
$pdf->Cell(40,4,$tampil_harga['3'],'0', 1, 'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(10,4,$tampil_bintang['4'],'0', 0, 'L');
$pdf->Cell(130,4,$tampil_diskripsi['4'],'0', 0, 'L');
$pdf->Cell(10,4,$tampil_rp['4'],'0', 0, 'C');
$pdf->Cell(40,4,$tampil_harga['4'],'0', 1, 'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(10,4,$tampil_bintang['5'],'0', 0, 'L');
$pdf->Cell(130,4,$tampil_diskripsi['5'],'0', 0, 'L');
$pdf->Cell(10,4,$tampil_rp['5'],'0', 0, 'C');
$pdf->Cell(40,4,$tampil_harga['5'],'0', 1, 'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(10,4,$tampil_bintang['6'],'0', 0, 'L');
$pdf->Cell(130,4,$tampil_diskripsi['6'],'0', 0, 'L');
$pdf->Cell(10,4,$tampil_rp['6'],'0', 0, 'C');
$pdf->Cell(40,4,$tampil_harga['6'],'0', 1, 'R');

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
$pdf->SetFont('Arial','B',8);
$pdf->Cell(130,4,$tampil_perangkat_dipinjami,'0', 1, 'L');

$pdf->Output();
?>