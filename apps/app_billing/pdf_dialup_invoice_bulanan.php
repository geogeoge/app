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

function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    $temp = "";
    if ($nilai < 12) {
      $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
      $temp = penyebut($nilai - 10). " Belas";
    } else if ($nilai < 100) {
      $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
      $temp = " Seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
      $temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
      $temp = " Seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
      $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
      $temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
      $temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
      $temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
  }
 
  function terbilang($nilai) {
    if($nilai<0) {
      $hasil = "minus ". trim(penyebut($nilai));
    } else {
      $hasil = trim(penyebut($nilai));
    }         
    return $hasil;
  }

// ------------------// Mengambil Data Dari Query \\----------------- \\
$costumer_id=$_GET['costumer_id'];


// ------------------// Data Yang akan di tampilkan \\----------------- \\
// ------------------// Data Yang akan di tampilkan \\----------------- \\
// ------------------// Data Yang akan di tampilkan \\----------------- \\


$pdf = new FPDF('L','mm',array(210,148));
$pdf->AddPage();

$pdf->image('../asset/img/logo_pudar_solonet.jpg',20,40,170,50);

$pdf->SetFont('Times','B',14);
$pdf->ln();
$pdf->Cell(190,5,'PT. SOLO JALA BUANA',0, 1, 'C');
$pdf->SetFont('Times','',10);
$pdf->Cell(190,5,'Jl. Arifin No. 129 Kepatihan Kulon Surakarta, Telp. 0271-657878',0, 1, 'C');
$pdf->SetFont('Times','B',12);
$pdf->Cell(190,5,'BUKTI PEMBAYARAN',0, 1, 'C');

$pdf->ln();
$pdf->ln();
$pdf->SetFont('Times','',10);
$pdf->Cell(40,5,'Costumer ID',0, 0, 'L');
$pdf->Cell(5,5,':',0, 0, 'C');
$pdf->Cell(50,5,'0022802151',0, 1, 'L');

$pdf->Cell(40,5,'Costumer Name',0, 0, 'L');
$pdf->Cell(5,5,':',0, 0, 'C');
$pdf->Cell(50,5,'Hartoyo',0, 1, 'L');


$pdf->Cell(40,5,'User ID',0, 0, 'L');
$pdf->Cell(5,5,':',0, 0, 'C');
$pdf->Cell(50,5,'adifurniture',0, 1, 'L');

$pdf->ln();
$pdf->ln();
$pdf->Cell(40,5,'Guna Bayar',0, 0, 'L');
$pdf->Cell(5,5,':',0, 0, 'C');
$pdf->SetFont('Times','B',10);
$pdf->Cell(50,5,'Monthly Fee Desember 2017',0, 0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(50,5,'Rp.',0, 0, 'R');
$pdf->Cell(40,5,' 22.000,-',0, 1, 'R');

$pdf->Cell(40,5,'',0, 0, 'L');
$pdf->Cell(5,5,'',0, 0, 'C');
$pdf->SetFont('Times','B',10);
$pdf->Cell(50,5,'Email-Q',0, 0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(50,5,'Rp.',0, 0, 'R');
$pdf->Cell(40,5,' 22.000,-',0, 1, 'R');

$pdf->Cell(40,5,'',0, 0, 'L');
$pdf->Cell(5,5,'',0, 0, 'C');
$pdf->SetFont('Times','B',10);
$pdf->Cell(50,5,'Biaya Penagihan',0, 0, 'L');
$pdf->SetFont('Times','',10);
$pdf->Cell(50,5,'Rp.',0, 0, 'R');
$pdf->Cell(40,5,' 22.000,-',0, 1, 'R');

$pdf->Line(145,70,200,70);

$pdf->Cell(40,5,'',0, 0, 'L');
$pdf->Cell(5,5,'',0, 0, 'C');
$pdf->SetFont('','B',10);
$pdf->Cell(50,5,'',0, 0, 'L');
$pdf->Cell(50,5,'Rp.',0, 0, 'R');
$pdf->Cell(40,5,' 22.000,-',0, 1, 'R');
$pdf->SetFont('Times','',10);

$pdf->ln();
$pdf->ln();

$pdf->Cell(40,5,'Terbilang',0, 0, 'L');
$pdf->Cell(5,5,':',0, 0, 'C');
$pdf->SetFont('','B',10);
$pdf->Cell(50,5,terbilang(101000).' Rupiah',0, 1, 'L');
$pdf->SetFont('Times','',10);

$pdf->ln();

$pdf->Cell(130,5,'',0, 0, 'L');
$pdf->Cell(40,5,'Surakarta, Desember 2017',0, 0, 'C');

$pdf->ln();
$pdf->ln();
$pdf->ln();
$pdf->ln();

$pdf->Cell(130,5,'',0, 0, 'L');
$pdf->Cell(40,5,'(                                               )',0, 0, 'C');

$pdf->Output();
?>