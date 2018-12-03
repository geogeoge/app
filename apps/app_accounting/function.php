<?php
class select {
  function select_master_jenis_account() {    
  	include "../../koneksi/koneksi.php";

  	$query=mysqli_query($koneksi,"SELECT * FROM master_jenis_account");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_jenis_account() {    
  	include "../../koneksi/koneksi.php";

  	$query=mysqli_query($koneksi,"SELECT * FROM jenis_account");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_jenis_account_where_id_master_jenis_account($id_master_jenis_account) {    
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"SELECT * FROM jenis_account WHERE id_master_jenis_account='$id_master_jenis_account'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_account() {    
  	include "../../koneksi/koneksi.php";

  	$query=mysqli_query($koneksi,"SELECT * FROM account ORDER BY nama_account");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }
  
  function select_account_posting($id_jenis_account) {    
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"SELECT * FROM account WHERE id_jenis_account='$id_jenis_account' ORDER BY nama_account");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_account_left_join_jenis_account() {    
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"SELECT * FROM account LEFT JOIN jenis_account ON account.id_jenis_account=jenis_account.id_jenis_account ORDER BY account.nama_account");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_account_where_id_jenis_account($id_jenis_account) {    
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"SELECT * FROM account WHERE id_jenis_account='$id_jenis_account'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_data_transaksi() {    
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"SELECT * FROM data_transaksi");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_jumlah_nominal_per_account_debit($id_account, $tanggal_awal, $tanggal_akhir) {    
    include "../../koneksi/koneksi.php";

    $total_nominal = 0;
    $query=mysqli_query($koneksi,"SELECT * FROM `data_transaksi` WHERE `id_account`='$id_account' AND tanggal BETWEEN '$tanggal_awal 00:00:00' AND '$tanggal_akhir 23:59:59'");
    while($tampil=mysqli_fetch_array($query)){
      $nominal=$tampil['nominal'];
      $DK=$tampil['DK'];

      if($DK=='D'){
        $nominal_debit = $nominal_debit + $nominal;
      } else {
        $nominal_kredit = $nominal_kredit + $nominal;
      }
    }

    $total_nominal = $nominal_debit - $nominal_kredit;
    return $total_nominal;
  }

  function select_jumlah_nominal_per_account_debit_access($id_account, $tanggal_awal, $tanggal_akhir) {    
    include "../../koneksi/koneksi.php";

    $total_nominal = 0;
    $query=mysqli_query($koneksi,"SELECT * FROM `data_transaksi` WHERE `id_account`='$id_account' AND tanggal BETWEEN '$tanggal_awal 00:00:00' AND '$tanggal_akhir 23:59:59' AND `ekstra`='access'");
    while($tampil=mysqli_fetch_array($query)){
      $nominal=$tampil['nominal'];
      $DK=$tampil['DK'];

      if($DK=='D'){
        $nominal_debit = $nominal_debit + $nominal;
      } else {
        $nominal_kredit = $nominal_kredit + $nominal;
      }
    }

    $total_nominal = $nominal_debit - $nominal_kredit;
    return $total_nominal;
  }

  function select_jumlah_nominal_per_account_debit_hardware($id_account, $tanggal_awal, $tanggal_akhir) {    
    include "../../koneksi/koneksi.php";

    $total_nominal = 0;
    $query=mysqli_query($koneksi,"SELECT * FROM `data_transaksi` WHERE `id_account`='$id_account' AND tanggal BETWEEN '$tanggal_awal 00:00:00' AND '$tanggal_akhir 23:59:59' AND `ekstra`='hardware'");
    while($tampil=mysqli_fetch_array($query)){
      $nominal=$tampil['nominal'];
      $DK=$tampil['DK'];

      if($DK=='D'){
        $nominal_debit = $nominal_debit + $nominal;
      } else {
        $nominal_kredit = $nominal_kredit + $nominal;
      }
    }

    $total_nominal = $nominal_debit - $nominal_kredit;
    return $total_nominal;
  }

  function select_jumlah_nominal_per_account_debit_overhead($id_account, $tanggal_awal, $tanggal_akhir) {    
    include "../../koneksi/koneksi.php";

    $total_nominal = 0;
    $query=mysqli_query($koneksi,"SELECT * FROM `data_transaksi` WHERE `id_account`='$id_account' AND tanggal BETWEEN '$tanggal_awal 00:00:00' AND '$tanggal_akhir 23:59:59' AND `ekstra`=''");
    while($tampil=mysqli_fetch_array($query)){
      $nominal=$tampil['nominal'];
      $DK=$tampil['DK'];

      if($DK=='D'){
        $nominal_debit = $nominal_debit + $nominal;
      } else {
        $nominal_kredit = $nominal_kredit + $nominal;
      }
    }

    $total_nominal = $nominal_debit - $nominal_kredit;
    return $total_nominal;
  }

  function select_jumlah_nominal_per_account_kredit($id_account, $tanggal_awal, $tanggal_akhir) {    
    include "../../koneksi/koneksi.php";

    $total_nominal = 0;
    $query=mysqli_query($koneksi,"SELECT * FROM `data_transaksi` WHERE `id_account`='$id_account' AND tanggal BETWEEN '$tanggal_awal 00:00:00' AND '$tanggal_akhir 23:59:59'");
    while($tampil=mysqli_fetch_array($query)){
      $nominal=$tampil['nominal'];
      $DK=$tampil['DK'];

      if($DK=='D'){
        $nominal_debit = $nominal_debit + $nominal;
      } else {
        $nominal_kredit = $nominal_kredit + $nominal;
      }
    }

    $total_nominal = $nominal_kredit - $nominal_debit;
    return $total_nominal;
  }

  function select_jumlah_nominal_per_account_kredit_access($id_account, $tanggal_awal, $tanggal_akhir) {    
    include "../../koneksi/koneksi.php";

    $total_nominal = 0;
    $query=mysqli_query($koneksi,"SELECT * FROM `data_transaksi` WHERE `id_account`='$id_account' AND tanggal BETWEEN '$tanggal_awal 00:00:00' AND '$tanggal_akhir 23:59:59' AND `ekstra`='access'");
    while($tampil=mysqli_fetch_array($query)){
      $nominal=$tampil['nominal'];
      $DK=$tampil['DK'];

      if($DK=='D'){
        $nominal_debit = $nominal_debit + $nominal;
      } else {
        $nominal_kredit = $nominal_kredit + $nominal;
      }
    }

    $total_nominal = $nominal_kredit - $nominal_debit;
    return $total_nominal;
  }

  function select_jumlah_nominal_per_account_kredit_hardware($id_account, $tanggal_awal, $tanggal_akhir) {    
    include "../../koneksi/koneksi.php";

    $total_nominal = 0;
    $query=mysqli_query($koneksi,"SELECT * FROM `data_transaksi` WHERE `id_account`='$id_account' AND tanggal BETWEEN '$tanggal_awal 00:00:00' AND '$tanggal_akhir 23:59:59' AND `ekstra`='hardware'");
    while($tampil=mysqli_fetch_array($query)){
      $nominal=$tampil['nominal'];
      $DK=$tampil['DK'];

      if($DK=='D'){
        $nominal_debit = $nominal_debit + $nominal;
      } else {
        $nominal_kredit = $nominal_kredit + $nominal;
      }
    }

    $total_nominal = $nominal_kredit - $nominal_debit;
    return $total_nominal;
  }

  function select_jumlah_nominal_per_account_kredit_overhead($id_account, $tanggal_awal, $tanggal_akhir) {    
    include "../../koneksi/koneksi.php";

    $total_nominal = 0;
    $query=mysqli_query($koneksi,"SELECT * FROM `data_transaksi` WHERE `id_account`='$id_account' AND tanggal BETWEEN '$tanggal_awal 00:00:00' AND '$tanggal_akhir 23:59:59' AND `ekstra`=''");
    while($tampil=mysqli_fetch_array($query)){
      $nominal=$tampil['nominal'];
      $DK=$tampil['DK'];

      if($DK=='D'){
        $nominal_debit = $nominal_debit + $nominal;
      } else {
        $nominal_kredit = $nominal_kredit + $nominal;
      }
    }

    $total_nominal = $nominal_kredit - $nominal_debit;
    return $total_nominal;
  }

  function select_data_temp_where($id_account, $in_out, $tanggal_awal, $tanggal_akhir, $limit, $status) {    
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"SELECT * FROM data_temp WHERE status='$status' AND in_out='$in_out' AND tanggal BETWEEN '$tanggal_awal 00:00:00' AND '$tanggal_akhir 23:59:59' LIMIT $limit");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  //-------------------------------------------------------- JURNAL UMUM --------------------------------------------------------\\
  function select_pertransaksi($tanggal_awal, $tanggal_akhir, $via, $isi_data) {    
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"SELECT DISTINCT (`no_transaksi`), `no_transaksi`, `keterangan`, `tanggal`, `id_temp`, `nominal` FROM `data_transaksi` WHERE `tanggal` BETWEEN '$tanggal_awal 00:00:00' AND '$tanggal_akhir 23:59:59' AND `$via` like '%$isi_data%'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_pertransaksi_detail($no_transaksi, $dk) {    
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"SELECT * FROM `data_transaksi` LEFT JOIN `account` ON data_transaksi.id_account=account.id_account WHERE data_transaksi.no_transaksi='$no_transaksi' AND data_transaksi.DK='$dk'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  //-------------------------------------------------------- BUKU BESAR --------------------------------------------------------\\

  function select_detail_buku_besar($tanggal_awal, $tanggal_akhir, $id_account) {    
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"SELECT * FROM `data_transaksi` WHERE `tanggal` BETWEEN '$tanggal_awal 00:00:00' AND '$tanggal_akhir 23:59:59' AND `id_account`='$id_account'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  //-------------------------------------------------------- LABA RUGI --------------------------------------------------------\\
}

class insert {
  function post_jurnal_umum() {
    include "../../koneksi/koneksi.php";

    $keterangan = $_POST['keterangan'];
    $debit = $_POST['debit'];
    $kredit = $_POST['kredit'];
    $nominal = $_POST['nominal'];
    $tanggal = $_POST['tanggal'];
    $ekstra = $_POST['ekstra'];
    $pecah_tanggal = explode("-", $tanggal);
    $tanggal_gabung = implode("", $pecah_tanggal);

    $query_pencarian_dihari_yang_sama = mysqli_query($koneksi,"SELECT * FROM data_transaksi WHERE no_transaksi like '%$tanggal_gabung%' ORDER BY no_transaksi DESC");
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

    $printah_debit = mysqli_query($koneksi,"INSERT INTO `data_transaksi`(`no_transaksi`, `tanggal`, `keterangan`, `nominal`, `id_account`, `DK`, `ekstra`) VALUES ('$no_transaksi', '$tanggal', '$keterangan', '$nominal', '$debit', 'D', '$ekstra')");
    $printah_kredit = mysqli_query($koneksi,"INSERT INTO `data_transaksi`(`no_transaksi`, `tanggal`, `keterangan`, `nominal`, `id_account`, `DK`, `ekstra`) VALUES ('$no_transaksi', '$tanggal', '$keterangan', '$nominal', '$kredit', 'K', '$ekstra')");
  }

  function posting_kas_keluar(){
    include "../../koneksi/koneksi.php";

    $data_debit = $_POST['data_debit'];
    $id_temp = $_POST['id_temp'];

    for ($i=0; $i < count($data_debit); $i++) { 
      
      if(!($data_debit[$i]=="xxx")){
        $query_id_temp = $id_temp[$i];
        $query_data_temp = mysqli_query($koneksi,"SELECT * FROM data_temp  WHERE id_temp='$query_id_temp'");
        $data_temp = mysqli_fetch_array($query_data_temp);
        $tanggal = date('Y-m-d', strtotime($data_temp['tanggal']));
        $keterangan = $data_temp['keterangan'];
        $nominal = $data_temp['nominal'];
        $kredit = $data_temp['id_account'];
        $ekstra = $data_temp['ekstra'];
        $debit = $data_debit[$i];
        $pecah_tanggal = explode("-", $tanggal);
        $tanggal_gabung = implode("", $pecah_tanggal);

        $query_pencarian_dihari_yang_sama = mysqli_query($koneksi,"SELECT * FROM data_transaksi WHERE no_transaksi like '%$tanggal_gabung%' ORDER BY no_transaksi DESC");
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
    }
  }

  function posting_kas_masuk(){
    include "../../koneksi/koneksi.php";

    $data_kredit = $_POST['data_kredit'];
    $id_temp = $_POST['id_temp'];

    for ($i=0; $i < count($data_kredit); $i++) { 
      
      if(!($data_kredit[$i]=="xxx")){
        $query_id_temp = $id_temp[$i];
        $query_data_temp = mysqli_query($koneksi,"SELECT * FROM data_temp  WHERE id_temp='$query_id_temp'");
        $data_temp = mysqli_fetch_array($query_data_temp);
        $tanggal = date('Y-m-d', strtotime($data_temp['tanggal']));
        $keterangan = $data_temp['keterangan'];
        $nominal = $data_temp['nominal'];
        $debit = $data_temp['id_account'];
        $ekstra = $data_temp['ekstra'];
        $kredit = $data_kredit[$i];
        $pecah_tanggal = explode("-", $tanggal);
        $tanggal_gabung = implode("", $pecah_tanggal);

        $query_pencarian_dihari_yang_sama = mysqli_query($koneksi,"SELECT * FROM data_transaksi WHERE no_transaksi like '%$tanggal_gabung%' ORDER BY no_transaksi DESC");
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
    }
  }
}

class edit {
  function edit_jurnal_umum() {
    include "../../koneksi/koneksi.php";
     
    $id_transaksi_debit = $_POST['id_transaksi_debit'];
    $id_transaksi_kredit = $_POST['id_transaksi_kredit'];
    $keterangan = $_POST['keterangan'];
    $debit = $_POST['debit'];
    $kredit = $_POST['kredit'];
    $nominal = $_POST['nominal'];
    $tanggal = $_POST['tanggal'];

    $printah_debit = mysqli_query($koneksi,"UPDATE `data_transaksi` SET `tanggal`='$tanggal',`keterangan`='$keterangan',`nominal`='$nominal',`id_account`='$debit' WHERE `id_transaksi`='$id_transaksi_debit'");
    $printah_kredit = mysqli_query($koneksi,"UPDATE `data_transaksi` SET `tanggal`='$tanggal',`keterangan`='$keterangan',`nominal`='$nominal',`id_account`='$kredit' WHERE `id_transaksi`='$id_transaksi_kredit'");
 }
 
 function edit_account_buku_besar() {
    include "../../koneksi/koneksi.php";
    
    $id_transaksi = $_POST['id_transaksi']."|";
    $id_account = $_POST['id_account'];
    
    $printah_debit = mysqli_query($koneksi,"UPDATE `data_transaksi` SET `id_account`='$id_account' WHERE `id_transaksi`='$id_transaksi'");
 }
}

class delete {
  function batal_posting(){
    include "../../koneksi/koneksi.php";

    $no_transaksi = $_POST['no_transaksi'];
    $id_temp = $_POST['id_temp'];

    $data_transaksi = mysqli_query($koneksi,"DELETE FROM `data_transaksi` WHERE no_transaksi='$no_transaksi'");
    $data_temp = mysqli_query($koneksi,"UPDATE `data_temp` SET status='belum' WHERE id_temp='$id_temp'");
  }
}

$select = new select;
$insert = new insert;
$edit = new edit;
$delete = new delete;
?>