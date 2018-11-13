<?php
include "session.php";
include "../../../koneksi/koneksi.php";
include "../function.php";
$crud = new crud;
//---------------------------------Data BTS---------------------------------\\
if(isset($_POST['simpan_data_bts'])) {
  $crud->insert_bts();
}
if(isset($_POST['update_data_bts'])) {
  $crud->update_bts();
}
if(isset($_POST['hapus_data_bts'])) {
  $crud->delete_bts();
}
//-------------------------------! Data BTS !-------------------------------\\
//---------------------------------Data Room---------------------------------\\
if(isset($_POST['simpan_data_ruang'])) {
  $crud->insert_ruang();
}
if(isset($_POST['update_data_ruang'])) {
  $crud->update_ruang();
}
if(isset($_POST['hapus_data_ruang'])) {
  $crud->delete_ruang();
}
//-------------------------------! Data Room !-------------------------------\\
//---------------------------------Data Rak---------------------------------\\
if(isset($_POST['simpan_data_rak'])) {
  $crud->insert_rak();
}
if(isset($_POST['update_data_rak'])) {
  $crud->update_rak();
}
if(isset($_POST['hapus_data_rak'])) {
  $crud->delete_rak();
}
//-------------------------------! Data Rak !-------------------------------\\
//---------------------------------Data Device---------------------------------\\
if(isset($_POST['simpan_data_device'])) {
  $crud->insert_device();
}
if(isset($_POST['update_data_device'])) {
  $crud->update_device();
}
if(isset($_POST['hapus_data_device'])) {
  $crud->delete_device();
}
//-------------------------------! Data Device !-------------------------------\\
//---------------------------------Data Label---------------------------------\\
if(isset($_POST['simpan_data_label'])) {
  $crud->insert_label();
}
if(isset($_POST['update_data_label'])) {
  $crud->update_label();
}
if(isset($_POST['hapus_data_label'])) {
  $crud->delete_label();
}
//-------------------------------! Data Label !-------------------------------\\
//---------------------------------Data User---------------------------------\\
if(isset($_POST['simpan_data_user'])) {
  $crud->insert_user();
}
if(isset($_POST['update_data_user'])) {
  $crud->update_user();
}
if(isset($_POST['hapus_data_user'])) {
  $crud->delete_user();
}
//-------------------------------! Data User !-------------------------------\\

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SoloNet</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../asset/bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../asset/bootstrap/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../asset/bootstrap/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../asset/bootstrap/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../asset/bootstrap/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../../asset/bootstrap/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../../asset/bootstrap/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../../asset/bootstrap/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../asset/bootstrap/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../../asset/bootstrap/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- data table -->
  <link rel="stylesheet" href="../../asset/bootstrap/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- css custom buatan sendiri sesuai selera -->
  <link rel="stylesheet" href="../../asset/bootstrap/custom-style.css">

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
              <img src="../../asset/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Administrator</span>
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
<script src="../../asset/bootstrap/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../asset/bootstrap/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../../asset/bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="../../asset/bootstrap/bower_components/raphael/raphael.min.js"></script>
<script src="../../asset/bootstrap/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="../../asset/bootstrap/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../../asset/bootstrap/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../../asset/bootstrap/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../asset/bootstrap/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../asset/bootstrap/bower_components/moment/min/moment.min.js"></script>
<script src="../../asset/bootstrap/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../../asset/bootstrap/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../../asset/bootstrap/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../../asset/bootstrap/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../asset/bootstrap/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../asset/bootstrap/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../asset/bootstrap/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../asset/bootstrap/dist/js/demo.js"></script>
<!-- table -->
<script src="../../asset/bootstrap/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../asset/bootstrap/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
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
</html>
