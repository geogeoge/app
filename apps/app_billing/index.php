<?php
include "session.php";
include "../../koneksi/koneksi.php";
include "function.php";

$query_user_baru = mysqli_query($koneksi,"select * from billing_po where status_po='Belum Print'");
$jumlah_user_baru = mysqli_num_rows($query_user_baru);
if($jumlah_user_baru>=3){
  if(!($_GET['page']=='page_access_invoice_user_baru')){
    header('location:?page=page_access_invoice_user_baru');
  }
}

$crud = new crud;
$select = new select;
$insert = new insert;
$update = new update;
$delete = new delete;

//----------------------------------------Proses Update Tagihan Bulanan------------------------------------------\\
 $tanggal_hari_ini=date('Y-m-d',strtotime($crud->tanggal_hari_ini()));
 $query_log_aktifitas_bulanan=mysqli_query($koneksi,"select * from billing_aktifitas_harian where waktu='$tanggal_hari_ini'");
 $jumlah_data_log=mysqli_num_rows($query_log_aktifitas_bulanan); if($jumlah_data_log<=0) {
   //$crud->update_user_tagihan();
  
   
   $tanggal=date(d, strtotime($tanggal_hari_ini));
   if($tanggal=="01") {
     $crud->update_tagihan_bulanan();
     $crud->backup_log_user();
   }

   mysqli_query($koneksi,"insert into billing_aktifitas_harian (waktu) value ('$tanggal_hari_ini')");
 }
//--------------------------------------/ Proses Update Tagihan Bulanan \----------------------------------------\\

if(isset($_POST['proses_transaksi_bulanan'])) {
  $crud->insert_pembayaran_access_bulanan();
  header('location:?page=page_access_tagihan_bulanan');
}

if(isset($_POST['proses_transaksi_user_baru'])) {
  $crud->insert_pembayaran_access_user_baru();
  header('location:?page=page_access_invoice_user_baru');
}

if(isset($_POST['batal_posting'])){
  $id_temp = $_POST['id_temp'];
  $crud->batal_posting($id_temp);
}

if(isset($_POST['validasi'])) {
  $crud->insert_pemabayaran_tiket();
}

if(isset($_POST['update_teknisi'])) {
  $crud->teknisi_update_tunggakan();
}

if(isset($_POST['tombol_holding_user'])) {
  $id_register=$_POST['id_register'];
  $catatan = $_POST['catatan'];
  $crud->update_holding_user($id_register, $catatan);
}

if(isset($_POST['tombol_reclossing'])) {
  $crud->update_data_register_user();
  $crud->update_reclossing_user();
  header('location:?page=page_access_invoice_user_baru');
}

if(isset($_GET['update_status_ppn'])){
  $id_register = $_GET['id_register'];
  $update_status_ppn = $_GET['update_status_ppn'];
  $crud->update_status_ppn($update_status_ppn, $id_register);
}

if(isset($_POST['simpan_pembayaran_tidak_terdeteksi'])) {
  $crud->insert_pembayaran_tidak_terdeteksi();
}

if(isset($_GET['proses_pembayaran_tidak_terdeteksi'])) {
  $crud->insert_proses_pembayaran_tidak_terdeteksi();
}

if($_GET['hapus_transaksi_tidak_teridentifikasi']=="ya"){
  $id_pembayaran = $_GET['id_pembayaran'];
  $crud->hapus_transaksi_tidak_teridentifikasi($id_pembayaran);
}

if($_GET['proses_hapus_daftar_cetak_invoice']=="ya"){
  $id_register = $_GET['id_register'];
  $crud->hapus_daftar_cetak_invoice($id_register);
  header('location:?page=page_access_menu_cetak_invoice');
}

if($_GET['proses_hapus_daftar_download_invoice']=="ya"){
  $id_register = $_GET['id_register'];
  $crud->hapus_daftar_download_invoice($id_register);
  header('location:?page=page_access_menu_download_invoice');
}

if(isset($_POST['tambah_daftar_cetak'])){
  $id_register = $_POST['checked_id'];
  foreach ($id_register as $data) {
    mysqli_query($koneksi,"update sale_register set billing_print_invoice='IYA' where id_register='$data'");
  }
  header('location:?page=page_access_menu_cetak_invoice');
}

if(isset($_POST['tambah_daftar_download'])){
  $id_register = $_POST['checked_id'];
  foreach ($id_register as $data) {
    mysqli_query($koneksi,"update sale_register set billing_download_invoice='IYA' where id_register='$data'");
  }
  header('location:?page=page_access_menu_download_invoice');
}

if(isset($_POST['tambah_daftar_pelanggan_khusus'])){
  $id_register = $_POST['checked_id'];
  $date = date("Y-m-d");
  foreach ($id_register as $data) {
    mysqli_query($koneksi,"update sale_register set pelanggan_khusus_periode='1', pelanggan_khusus_bulan_awal='$date' where id_register='$data'");
  }
  header('location:?page=page_access_menu_tagihan_khusus');
}

if(isset($_POST['tombol_rubah_paket'])) {
  $crud->edit_paket_internet();
}

if($_GET['download_multi_invoice']=="ya") {
  $query=mysqli_query($koneksi,"select * from sale_register where billing_download_invoice='IYA'");
  while($tampil_query=mysqli_fetch_array($query)) {
    array("url" => APP_URL.'/report_own.php',"target" => '_blank');
  }
  echo "asdfas";
}

if(isset($_POST['update_data_user'])) {
  $crud->update_alamat_user();
}

if(isset($_GET['update_biaya_penagihan'])) {
  $costumer_id=$_GET['costumer_id'];
  $update_biaya_penagihan=$_GET['update_biaya_penagihan'];
  $crud->update_biaya_penagihan($update_biaya_penagihan, $costumer_id);
}

if(isset($_POST['update_tagihan_dialup'])){
  $crud->update_tagihan_dialup();
}

if(isset($_GET['batal_transaksi'])) {
  if($_GET['kode_transaksi']=='A'){
    $crud->batal_transaksi_acces($_GET['no_transaksi']);
  }
  if($_GET['kode_transaksi']=='B'){
    $crud->batal_transaksi_user_baru($_GET['no_transaksi']);
  }
}

if(isset($_POST['proses_transaksi_kas_keluar'])){
  //ini untuk traksaksi kas keluar
}

if(isset($_POST['proses_reclose_teknisi'])) {
  $update->proses_reclose_teknisi();
  header('location:?page=page_data_user_trial_semua');
}

if(isset($_POST['proses_reclose_trial'])) {
  $update->proses_reclose_trial();
  header('location:?page=page_data_user_trial_semua');
}

if(isset($_POST['proses_reclose_biling'])) {
  $update->proses_reclose_billing();
  header('location:?page=page_data_user_trial_semua');
}

if(isset($_POST['tombol_edit_monthly_fee'])) {
  $update->update_monthly_fee($_POST['monthly_fee'], $_POST['tanggal_close'], $_POST['biaya_registrasi'], $_POST['id_register']);
  header('location:?page=page_access_invoice_user_baru');
}

if(isset($_GET['proses_hapus_daftar_tagihan_khusus'])){
  $id_register = $_GET['id_register'];

  mysqli_query($koneksi,"update sale_register set pelanggan_khusus_periode='0' where id_register='$id_register'");
}

if(isset($_POST['tombol_edit_tagihan_khusus'])){
  $id_register = $_POST['id_register'];
  $pelanggan_khusus_bulan_awal = $_POST['pelanggan_khusus_bulan_awal'];
  $pelanggan_khusus_periode = $_POST['pelanggan_khusus_periode'];

  mysqli_query($koneksi,"update sale_register set pelanggan_khusus_bulan_awal='$pelanggan_khusus_bulan_awal', pelanggan_khusus_periode='$pelanggan_khusus_periode' where id_register='$id_register'");
}

if(isset($_POST['tombol_input_komplen'])) {
  $id_register = $_POST['id_register'];
  $kerusakan = $_POST['kerusakan'];
  $penerima_komplen = $login_id_marketing;
  $tanggal_komplen = date("Y-m-d H:i:s");
  mysqli_query($koneksi,"insert into teknisi_maintenance (id_register, tanggal_komplen, kerusakan, penerima_komplen) value ('$id_register', '$tanggal_komplen', '$kerusakan', '$penerima_komplen')");
}

if(isset($_POST['update_register'])){
    $update->update_register();
}

if(isset($_POST['insert_daily_keluar'])) {
  $crud->insert_daily_keluar();
}

if(isset($_POST['insert_daily_masuk'])) {
  $crud->insert_daily_masuk();
}

if(isset($_POST['edit_log_pembyaran'])) {
  $update->edit_log_pembyaran();
}

if(isset($_POST['posting_transaksi_rutin'])) {
  $insert->posting_transaksi_rutin();
}

if(isset($_POST['insert_transaksi_rutin'])) {
  $insert->insert_transaksi_rutin();
}

if(isset($_POST['edit_transaksi_rutin'])) {
  $update->edit_transaksi_rutin();
}

if(isset($_POST['hapus_transaksi_rutin'])) {
  $delete->hapus_transaksi_rutin();
}


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

$query_tagihan_khusus = mysqli_query($koneksi,"select nama_user, (billing_bulan_berjalan-billing_bulan_terbayar), pelanggan_khusus_periode from sale_register where pelanggan_khusus_periode not like '0' and (billing_bulan_berjalan-billing_bulan_terbayar)>=pelanggan_khusus_periode");

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SoloNet | Billing</title>

  <link rel="icon" href="../asset/img/favicon.ico">

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../asset/bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../asset/bootstrap/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../asset/bootstrap/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../asset/bootstrap/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../asset/bootstrap/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../asset/bootstrap/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../asset/bootstrap/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../asset/bootstrap/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../asset/bootstrap/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../asset/bootstrap/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- data table -->
  <link rel="stylesheet" href="../asset/bootstrap/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- css custom buatan sendiri sesuai selera -->
  <link rel="stylesheet" href="../asset/bootstrap/custom-style.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- Convert rupiah -->
  <script type="text/javascript" src="../asset/my.js"></script>
  
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><font size="6"><strong>S</strong></font></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><font size="6"><strong>SOL<i class="fa fa-globe"></i><i>NET</i></strong></font></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <div class="session_user">
              <img src="../asset/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Billing</span>
            </div>
          </li>
          <!-- /.User Account -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <?php include "navbar.php"; ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php include "content.php"; ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.0.0
    </div>
    <strong>Copyright &copy; 2018 <a href="https://solonet.net.id">SoloNet</a>.</strong> 
  </footer>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../asset/bootstrap/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../asset/bootstrap/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../asset/bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="../asset/bootstrap/bower_components/raphael/raphael.min.js"></script>
<script src="../asset/bootstrap/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="../asset/bootstrap/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../asset/bootstrap/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../asset/bootstrap/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../asset/bootstrap/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../asset/bootstrap/bower_components/moment/min/moment.min.js"></script>
<script src="../asset/bootstrap/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../asset/bootstrap/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../asset/bootstrap/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../asset/bootstrap/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../asset/bootstrap/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../asset/bootstrap/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../asset/bootstrap/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../asset/bootstrap/dist/js/demo.js"></script>
<!-- table -->
<script src="../asset/bootstrap/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../asset/bootstrap/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
<?php
if(mysqli_num_rows($query_tagihan_khusus)>=1){
?>
<script>
$('#myModal').modal('show');
</script>
<?php
}
?>
</html>
