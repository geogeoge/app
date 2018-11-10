<?php

include "session.php";
include "function.php";
include "../../koneksi/koneksi.php";

// ---------------------------------------------- MENU TAMBAH ---------------------------------------------- \\

if(isset($_POST['tambah_master_login'])){
  $id_user=$_POST['id_user'];
  $nama_user=$_POST['nama_user'];
  $username=$_POST['username'];
  $password=$_POST['password'];
  $level=$_POST['level'];
  $ekstra=$_POST['ekstra'];

  mysqli_query($koneksi,"INSERT INTO master_login VALUES ('$id_user', '$nama_user', '$username', '$password', '$level', '$ekstra')");
}

if(isset($_POST['tambah_sale_register'])){
  $query_sale_register=mysqli_query($koneksi,"select * from sale_register order by id_register DESC limit 1");
  $tampil_sale_register=mysqli_fetch_array($query_sale_register);
  $id_register=$tampil_sale_register['id_register'];
  if($id_register=="") {
  $id_register="U001";
  } else {
  $id_register++;
  }

  $id_prospek=$_POST['id_prospek'];
  $nik=$_POST['nik'];
  $nama_user=strtoupper($_POST['nama_user']);
  $nama_instansi=$_POST['nama_instansi'];
  $jenis_kelamin=$_POST['jenis_kelamin'];
  $tempat_lahir=$_POST['tempat_lahir'];
  $tanggal_lahir=$_POST['tanggal_lahir'];
  $telp=$_POST['telp'];
  $email=$_POST['email'];
  $alamat_1=$_POST['alamat_1'];
  $alamat_2=$_POST['alamat_2'];
  $alamat_3=$_POST['alamat_3'];
  $alamat_4=$_POST['alamat_4'];
  $alamat_5=$_POST['alamat_5'];
  $alamat_6=$_POST['alamat_6'];
  $alamat=$alamat_1."#".$alamat_2."#".$alamat_3."#".$alamat_4."#".$alamat_5."#".$alamat_6;
  $koordinat=addslashes($_POST['koordinat']);
  $id_marketing=$login_id_marketing;
  $status="Alat Siap";
  $catatan=$_POST['catatan'];
  $tanggal_register=date('Y-m-d');

  $id_paket=$_POST['id_paket'];
  $ip_publik=$_POST['ip_publik'];
  $biaya_registrasi=$_POST['biaya_registrasi'];

  $id_bts=$_POST['id_bts'];

  $id_radio=$_POST['id_radio'];
  $jumlah_radio=$_POST['jumlah_radio'];
  $status_radio=$_POST['status_radio'];
  $harga_radio="0";

  $id_antena=$_POST['id_antena'];
  $jumlah_antena=$_POST['jumlah_antena'];
  $status_antena=$_POST['status_antena'];
  $harga_antena="0";

  $id_wifi=$_POST['id_wifi'];
  $jumlah_wifi=$_POST['jumlah_wifi'];
  $status_wifi=$_POST['status_wifi'];
  $harga_wifi="0";

  $id_tower=$_POST['id_tower'];
  $jumlah_tower=$_POST['jumlah_tower'];
  $status_tower=$_POST['status_tower'];
  $harga_tower="0";

  $id_kabel=$_POST['id_kabel'];
  $panjang_kabel=$_POST['panjang_kabel'];
  $status_kabel=$_POST['status_kabel'];
  $harga_kabel="0";

  $tambahan_1=$_POST['tambahan_1'];
  $jumlah_tambahan_1=$_POST['jumlah_tambahan_1'];
  $status_tambahan_1=$_POST['status_tambahan_1'];
  $harga_tambahan_1="0";

  $tambahan_2=$_POST['tambahan_2'];
  $jumlah_tambahan_2=$_POST['jumlah_tambahan_2'];
  $status_tambahan_2=$_POST['status_tambahan_2'];
  $harga_tambahan_2="0";

  mysqli_query($koneksi,"INSERT INTO `sale_register` (`ip_publik`, `id_register`, `nik`, `nama_user`, `nama_instansi`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `telp`, `email`, `alamat`, `koordinat`, `status`, `id_marketing`, `tanggal_register`, `id_paket`, `id_bts`, `id_radio`, `jumlah_radio`, `harga_radio`, `status_radio`, `id_antena`, `jumlah_antena`, `harga_antena`, `status_antena`, `id_wifi`, `jumlah_wifi`, `harga_wifi`, `status_wifi`, `id_kabel`, `panjang_kabel`, `harga_kabel`, `status_kabel`, `id_tower`, `jumlah_tower`, `harga_tower`, `status_tower`, `biaya_registrasi`, `billing_bulan_berjalan`, `billing_bulan_terbayar`, `billing_saldo`, `billing_total_bayar`, `billing_total_restitusi`, `tambahan_1`, `jumlah_tambahan_1`, `status_tambahan_1`, `harga_tambahan_1`, `tambahan_2`, `jumlah_tambahan_2`, `status_tambahan_2`, `harga_tambahan_2`) VALUES ('$ip_publik', '$id_register', '$nik', '$nama_user', '$nama_instansi', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$telp', '$email', '$alamat', '$koordinat', '$status', '$id_marketing', '$tanggal_register', '$id_paket', '$id_bts', '$id_radio', '$jumlah_radio', '$harga_radio', '$status_radio', '$id_antena', '$jumlah_antena', '$harga_antena', '$status_antena', '$id_wifi', '$jumlah_wifi', '$harga_wifi', '$status_wifi', '$id_kabel', '$panjang_kabel', '$harga_kabel', '$status_kabel', '$id_tower', '$jumlah_tower', '$harga_tower', '$status_tower', '$biaya_registrasi', '1', '1', '0', '0', '0', '$tambahan_1', '$jumlah_tambahan_1', '$status_tambahan_1', '$harga_tambahan_1', '$tambahan_2', '$jumlah_tambahan_2', '$status_tambahan_2', '$harga_tambahan_2')");
}

// ---------------------------------------------- MENU EDTI ---------------------------------------------- \\

if(isset($_POST['edit_master_login'])){
  $id_user=$_POST['id_user'];
  $nama_user=$_POST['nama_user'];
  $username=$_POST['username'];
  $password=$_POST['password'];
  $level=$_POST['level'];
  $ekstra=$_POST['ekstra'];

  mysqli_query($koneksi,"UPDATE master_login SET `id_user`='$id_user', `nama_user`='$nama_user', `username`='$username', `password`='$password', `level`='$level', `ekstra`='$ekstra' WHERE  `id_user`='$id_user'");
}

if(isset($_POST['edit_sale_register'])){
  $id_register=$_POST['id_register'];
  $nik=$_POST['nik'];
  $nama_user=strtoupper($_POST['nama_user']);
  $nama_instansi=$_POST['nama_instansi'];
  $jenis_kelamin=$_POST['jenis_kelamin'];
  $tempat_lahir=$_POST['tempat_lahir'];
  $tanggal_lahir=$_POST['tanggal_lahir'];
  $telp=$_POST['telp'];
  $email=$_POST['email'];
  $alamat_1=$_POST['alamat_1'];
  $alamat_2=$_POST['alamat_2'];
  $alamat_3=$_POST['alamat_3'];
  $alamat_4=$_POST['alamat_4'];
  $alamat_5=$_POST['alamat_5'];
  $alamat_6=$_POST['alamat_6'];
  $alamat=$alamat_1."#".$alamat_2."#".$alamat_3."#".$alamat_4."#".$alamat_5."#".$alamat_6;
  $koordinat=addslashes($_POST['koordinat']);
  $id_marketing=$login_id_marketing;
  $status="Trial";
  $catatan=$_POST['catatan'];
  
  $id_paket=$_POST['id_paket'];
  $ip_publik=$_POST['ip_publik'];
  $biaya_registrasi=$_POST['biaya_registrasi'];

  $id_bts=$_POST['id_bts'];

  $id_radio=$_POST['id_radio'];
  $jumlah_radio=$_POST['jumlah_radio'];
  $status_radio=$_POST['status_radio'];
  $harga_radio=$_POST['harga_radio'];

  $id_antena=$_POST['id_antena'];
  $jumlah_antena=$_POST['jumlah_antena'];
  $status_antena=$_POST['status_antena'];
  $harga_antena=$_POST['harga_antena'];

  $id_wifi=$_POST['id_wifi'];
  $jumlah_wifi=$_POST['jumlah_wifi'];
  $status_wifi=$_POST['status_wifi'];
  $harga_wifi=$_POST['harga_wifi'];

  $id_tower=$_POST['id_tower'];
  $jumlah_tower=$_POST['jumlah_tower'];
  $status_tower=$_POST['status_tower'];
  $harga_tower=$_POST['harga_tower'];

  $id_kabel=$_POST['id_kabel'];
  $panjang_kabel=$_POST['panjang_kabel'];
  $status_kabel=$_POST['status_kabel'];
  $harga_kabel=$_POST['harga_kabel'];

  mysqli_query($koneksi,"UPDATE `sale_register` SET `ip_publik`='$ip_publik', `nik`='$nik', `nama_user`='$nama_user', `nama_instansi`='$nama_instansi', `jenis_kelamin`='$jenis_kelamin', `tempat_lahir`='$tempat_lahir', `tanggal_lahir`='$tanggal_lahir', `telp`='$telp', `email`='$email', `alamat`='$alamat', `koordinat`='$koordinat', `status`='$status', `id_paket`='$id_paket', `id_bts`='$id_bts', `id_radio`='$id_radio', `jumlah_radio`='$jumlah_radio', `harga_radio`='$harga_radio', `status_radio`='$status_radio', `id_antena`='$id_antena', `jumlah_antena`='$jumlah_antena', `harga_antena`='$harga_antena', `status_antena`='$status_antena', `id_wifi`='$id_wifi', `jumlah_wifi`='$jumlah_wifi', `harga_wifi`='$harga_wifi', `status_wifi`='$status_wifi', `id_tower`='$id_tower', `jumlah_tower`='$jumlah_tower', `harga_tower`='$harga_tower', `status_tower`='$status_tower', `id_kabel`='$id_kabel', `panjang_kabel`='$panjang_kabel', `harga_kabel`='$harga_kabel', `status_kabel`='$status_kabel', biaya_registrasi='$biaya_registrasi' WHERE id_register='$id_register'");

  header('location:?page=page_data_sale_register');
}

// ---------------------------------------------- MENU HAPUS ---------------------------------------------- \\
if(isset($_POST['hapus_master_login'])){
  $id_user=$_POST['id_user'];

  mysqli_query($koneksi,"DELETE FROM master_login WHERE `id_user`='$id_user'");
}

if(isset($_POST['hapus_sale_register'])){
  $id_register=$_POST['id_register'];

  mysqli_query($koneksi,"DELETE FROM sale_register WHERE `id_register`='$id_register'");
}
// ---------------------------------------------- MENU TAMBAHAN ---------------------------------------------- \\
if(isset($_POST['pindah_penjadwalan'])){
  $_SESSION['level']='PENJADWALAN';
  header('location:../../');
}

if(isset($_POST['pindah_monitoring'])){
  $_SESSION['level']='MONITORING';
  header('location:../../');
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DEV | SOLONET</title>
  
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
  <?php include "modal_pindah_app.php"; ?>
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
      <b>Version</b> Infinity
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