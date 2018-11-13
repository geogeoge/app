<?php

include "session.php";
include "function.php";
include "../../koneksi/koneksi.php";

$session_id_user = $_SESSION['id_user'];

if(isset($_POST['tombol_konfirmasi_komplain_selesai'])){
  $id_maintenance = $_POST['id_maintenance'];
  $kerusakan = $_POST['kerusakan'];
  $solusi = $_POST['solusi'];
  $tanggal = date("Y-m-d");
  mysqli_query($koneksi,"UPDATE teknisi_maintenance SET kerusakan='$kerusakan', solusi='$solusi', id_teknisi='$session_id_user', status='Selesai', status_kunjungan='REMOTE', tanggal_penanganan_maintenance='$tanggal' WHERE id_maintenance='$id_maintenance'");
}

if(isset($_POST['tombol_konfirmasi_ajukan_kunjungan'])){
  $id_maintenance = $_POST['id_maintenance'];
  mysqli_query($koneksi,"UPDATE teknisi_maintenance SET status='Penjadwalan' WHERE id_maintenance='$id_maintenance'");
}

if(isset($_POST['tombol_konfirmasi_hapus_komplain'])){
  $id_maintenance = $_POST['id_maintenance'];
  mysqli_query($koneksi,"DELETE FROM teknisi_maintenance WHERE id_maintenance='$id_maintenance'");
}

if(isset($_POST['pindah_teknisi'])){
  $_SESSION['level']='TEKNISI';
  header('location:../../');
  //mysqli_query($koneksi,"update master_login set level='TEKNISI' where id_user='$session_id_user'");
}

if(isset($_POST['pindah_monitoring'])){
  $_SESSION['level']='MONITORING';
  header('location:../../');
  //mysqli_query($koneksi,"update master_login set level='MONITORING' where id_user='$session_id_user'");
}

if(isset($_POST['tombol_input_komplen'])) {
  $id_register = $_POST['id_register'];
  $kerusakan = $_POST['kerusakan'];
  $penerima_komplen = $session_id_user;
  $tanggal_komplen = date("Y-m-d H:i:s");
  mysqli_query($koneksi,"insert into teknisi_maintenance (id_register, tanggal_komplen, kerusakan, penerima_komplen) value ('$id_register', '$tanggal_komplen', '$kerusakan', '$penerima_komplen')");
}

if(isset($_POST['tombol_konfirmasi_komplain_update'])) {
  $id_maintenance = $_POST['id_maintenance'];
  $kerusakan = $_POST['kerusakan'];

  $solusi = $_POST['solusi']." (".$_SESSION['nama_user'].")\r\n";
  mysqli_query($koneksi,"UPDATE teknisi_maintenance SET kerusakan='$kerusakan', solusi='$solusi' WHERE id_maintenance='$id_maintenance'");
}

if(isset($_POST['tombol_tambah_bts'])){
  $nama_bts = $_POST['nama_bts'];
  $lokasi = $_POST['lokasi'];
  $kontak = $_POST['kontak'];
  $id_parent = $_POST['id_parent'];
  $ip_bts = $_POST['ip_bts'];
  $kapasitas_bts = $_POST['kapasitas_bts'];

  mysqli_query($koneksi,"INSERT INTO `mon_databts`(`nama_bts`, `lokasi`, `kontak`, `id_parent`, `ip_bts`, `kapasitas_bts`) VALUES ('$nama_bts', '$lokasi', '$kontak', '$id_parent', '$ip_bts', '$kapasitas_bts')");
}

if(isset($_POST['tombol_edit_bts'])){
  $id_bts = $_POST['id_bts'];
  $nama_bts = $_POST['nama_bts'];
  $lokasi = $_POST['lokasi'];
  $kontak = $_POST['kontak'];
  $id_parent = $_POST['id_parent'];
  $ip_bts = $_POST['ip_bts'];
  $kapasitas_bts = $_POST['kapasitas_bts'];

  mysqli_query($koneksi,"UPDATE `mon_databts` SET `nama_bts`='$nama_bts', `lokasi`='$lokasi', `kontak`='$kontak', `id_parent`='$id_parent', `ip_bts`='$ip_bts', `kapasitas_bts`='$kapasitas_bts' WHERE `id_bts`='$id_bts'");
}

if(isset($_POST['tombol_hapus_bts'])){
  $id_bts = $_POST['id_bts'];

  mysqli_query($koneksi,"DELETE FROM `mon_databts` WHERE `id_bts`='$id_bts'");
}

if(isset($_POST['tombol_tambah_lokasi_bts'])){
  $lokasi_bts = $_POST['lokasi_bts'];
  $alamat_bts = $_POST['alamat_bts'];
  $telp = $_POST['telp'];
  $koordinat = addslashes($_POST['koordinat']);

  mysqli_query($koneksi,"INSERT INTO `mon_lokasibts` (`lokasi_bts`, `alamat_bts`, `telp`, `koordinat`) VALUES ('$lokasi_bts', '$alamat_bts', '$telp', '$koordinat')");
}

if(isset($_POST['tombol_edit_lokasi_bts'])){
  $id_lokasi_bts = $_POST['id_lokasi_bts'];
  $lokasi_bts = $_POST['lokasi_bts'];
  $alamat_bts = $_POST['alamat_bts'];
  $telp = $_POST['telp'];
  $koordinat = addslashes($_POST['koordinat']);

  mysqli_query($koneksi,"UPDATE `mon_lokasibts` SET `lokasi_bts`='$lokasi_bts',`alamat_bts`='$alamat_bts',`telp`='$telp',`koordinat`='$koordinat' WHERE `id_lokasi_bts`='$id_lokasi_bts'");
}

if(isset($_POST['tombol_hapus_lokasi_bts'])){
  $id_lokasi_bts = $_POST['id_lokasi_bts'];

  mysqli_query($koneksi,"DELETE FROM `mon_lokasibts` WHERE `id_lokasi_bts`='$id_lokasi_bts'");
}

if(isset($_POST['tombol_edit_sale_register'])){
  
  $id_register = $_POST['id_register'];
  $nama_user = $_POST['nama_user'];
  $telp = $_POST['telp'];
  $ip = $_POST['ip'];
  $data_ip_publik = $_POST['data_ip_publik'];
  $id_bts = $_POST['id_bts'];

  mysqli_query($koneksi,"UPDATE `sale_register` SET `nama_user`='$nama_user', `telp`='$telp', `ip`='$ip', `data_ip_publik`='$data_ip_publik', `id_bts`='$id_bts' WHERE `id_register`='$id_register'");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MONITORING | SOLONET</title>
  
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
  <!-- Select2 -->
  <link rel="stylesheet" href="../asset/bootstrap/bower_components/select2/dist/css/select2.min.css">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#modal_pindah_app" role="button"  data-target = "#modal_pindah_app" data-toggle="modal" class="logo">
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
              <span class="hidden-xs"><?php echo $_SESSION['nama_user']; ?></span>
            </div>
          </li>
          <!-- /.User Account -->
        </ul>
      </div>
    </nav>
  </header>
  <?php include "modal_pindah_app.php";?>
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
<script src="../asset/bootstrap/bower_components/Flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="../asset/bootstrap/bower_components/Flot/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="../asset/bootstrap/bower_components/Flot/jquery.flot.pie.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="../asset/bootstrap/bower_components/Flot/jquery.flot.categories.js"></script>
<!-- Select2 -->
<script src="../asset/bootstrap/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</body>
</html>