<?php
include "session.php";
include "../../koneksi/koneksi.php";
include "function.php";

$login_id_marketing = $_SESSION['id_user'];

$crud = new crud;
$dashboard = new dashboard;
$paket_internet = new paket_internet;
$data_marketing = new data_marketing;
$data_user_close = new data_user_close;

if(isset($_POST['simpan_data_marketing'])) {
  $id_user = $_POST['id_user'];
  $nama_user = $_POST['nama_user'];
  $username = $_POST['username'];
  $password1 = $_POST['password1'];
  $password2 = $_POST['password2'];
  $level = $_POST['level'];

  $data_marketing->insert_data_marketing($id_user, $nama_user, $username, $password1, $password2, $level);
}

if(isset($_POST['edit_data_marketing'])){
  $id_user = $_POST['id_user'];
  $nama_user = $_POST['nama_user'];
  $username = $_POST['username'];
  $password1 = $_POST['password1'];
  $password2 = $_POST['password2'];
  $level = $_POST['level'];

  $data_marketing->update_data_marketing($id_user, $nama_user, $username, $password1, $password2, $level);
}

if(isset($_POST['hapus_data_marketing'])) {
  $id_user = $_POST['id_user'];
  
  $data_marketing->delete_data_marketing($id_user);
}

if(isset($_POST['simpan_paket_internet'])) {
  $id_paket = $_POST['id_paket'];
  $nama_paket = $_POST['nama_paket'];
  $harga = $_POST['harga'];

  $paket_internet->insert_data_paket($id_paket, $nama_paket, $harga);
}

if(isset($_POST['update_paket_internet'])) {
  $id_paket = $_POST['id_paket'];
  $nama_paket = $_POST['nama_paket'];
  $harga = $_POST['harga'];

  $paket_internet->update_data_internet($id_paket, $nama_paket, $harga);
}

if(isset($_GET['update_status_paket'])) {
  $id_paket = $_GET['id_paket'];
  $update_status_paket = $_GET['update_status_paket'];

  $paket_internet->update_status_paket($id_paket, $update_status_paket);
}

if(isset($_POST['modal_edit_tanggal_clossing'])){
  $id_register = $_POST['id_register'];
  $tanggal_close = $_POST['tanggal_close'];

  mysqli_query($koneksi,"UPDATE sale_register SET tanggal_close='$tanggal_close' WHERE id_register='$id_register'");
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
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SoloNet</title>

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
              <span class="hidden-xs"><?php echo $_SESSION['nama_user']; ?></span>
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
<script src="../asset/bootstrap/bower_components/Flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="../asset/bootstrap/bower_components/Flot/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="../asset/bootstrap/bower_components/Flot/jquery.flot.pie.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="../asset/bootstrap/bower_components/Flot/jquery.flot.categories.js"></script>
<script>
/*
 * BAR CHART
 * ---------
 */

var bar_data = {
  data :  [
    <?php
    $query_marketing=mysqli_query($koneksi,"SELECT * FROM sale_marketing");
    while($data_marketing=mysqli_fetch_array($query_marketing)) {
      $id_marketing=$data_marketing['id_marketing'];
      $query_marketing_satu=mysqli_query($koneksi,"SELECT * FROM sale_marketing WHERE id_marketing='$id_marketing'");
      $tampil_marketing_satu=mysqli_fetch_array($query_marketing_satu);
      $query_register_marketing=mysqli_query($koneksi,"SELECT * FROM sale_register WHERE id_marketing='$id_marketing'");
      $jumlah_register_marketing=mysqli_num_rows($query_register_marketing);
      ?>
      ['<?php echo $tampil_marketing_satu['nama_marketing'];?>', <?php echo $jumlah_register_marketing;?>],
      <?php
      }
      ?>
          ],
  color: '#3c8dbc'
}
$.plot('#bar-chart', [bar_data], {
  grid  : {
    borderWidth: 1,
    borderColor: '#f3f3f3',
    tickColor  : '#f3f3f3'
  },
  series: {
    bars: {
      show    : true,
      barWidth: 0.5,
      align   : 'center'
    }
  },
  xaxis : {
    mode      : 'categories',
    tickLength: 0
  }
})
/* END BAR CHART */

// $('#tambah_data_marketing').modal('show');
</script>
</body>
</html>
