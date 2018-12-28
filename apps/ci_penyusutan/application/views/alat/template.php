<?php 
    if ($this->session->userdata('sudah_login')!=1) {
        redirect(base_url('login'));
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Monitoring Sistem</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>bower_components/bootstrap/dist/css/bootstrap-toggle.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/Ionicons/css/ionicons.min.css">
  
  <link rel="stylesheet" href="<?=base_url()?>plugins/iCheck/all.css">
  <!-- Theme style -->
  
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
 <link rel="stylesheet" href="<?=base_url()?>plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/select2/dist/css/select2.min.css">
  
  <link rel="stylesheet" href="<?=base_url()?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url()?>dist/css/skins/_all-skins.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="icon" href="<?=base_url()?>dist/img/logo.ico">
  <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>"/>
  
  <style type="text/css">
    .pac-container{
      z-index: 9999;
    }
    .pagination>li:first-child>a, .pagination>li:first-child>span {
        margin-left: 0;
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
    }
    .pagination>li:last-child>a, .pagination>li:last-child>span {
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
    }
    .toggle.android { border-radius: 0px;}
    .toggle.android .toggle-handle { border-radius: 0px; }
    #notifications {
      cursor: pointer;
      position: fixed;
      right: 0px;
      z-index: 9999;
      bottom: 0px;
      margin-bottom: 0px;
      margin-right: 15px;
      min-width: 350px;
      max-width: 800px;  
      display: none;
    }
    .alert, .box{
      border-radius: 0px;
    }
    #mytable{
      width: 100%!important;
    }
    #map_canvas{
      width:100%; 
      height:390px!important;
      margin-bottom: 10px;
    }
    .dataTables_wrapper{
      width: 99.5%;
    }
   

    <?php if (isset($this->dts)) { ?>
    .box-body{
      overflow-y: auto;
    }
    <?php 
    }
    ?>
    
    <?php 
      if ($this->uri->segment(1)=='konfigurasi') {?>
          p{
              padding-left: 10px;
              font-size: 15px;
              font-weight: 600;
          }  
          td:nth-child(2){
            text-align: center;
          }
          .bootstrap-timepicker .dropdown-menu{
            min-width: 135px
          }
          .table{
            margin-bottom: 0px;
          }

    <?php 
      }
    ?>
  </style>
  <?php 
      if (isset($map)) {
          echo $map['js']; 
          ?>
          <script>
            function initialize() {

            var input = document.getElementById('address');
            var autocomplete = new google.maps.places.Autocomplete(input);
            }

            google.maps.event.addDomListener(window, 'load', initialize);
          </script>
        <?php 
      }
  ?>


</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?=base_url()?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>M</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>MON</b>SISTEM</span>
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
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=base_url()?>dist/img/<?php if($this->session->userdata('jk_pengguna')=='L'){echo 'avatar5.png';}else{echo 'avatar2.png';} ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=$this->session->userdata('nama_lengkap_pengguna')?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=base_url()?>dist/img/<?php if($this->session->userdata('jk_pengguna')=='L'){echo 'avatar5.png';}else{echo 'avatar2.png';} ?>" class="img-circle" alt="User Image">

                <p>
                  <?=$this->session->userdata('nama_lengkap_pengguna')?> - <?=ucwords($this->session->userdata('level_pengguna'))?>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?=base_url('pengguna/profil')?>" class="btn btn-flat btn-default btn-flat">Profil</a>
                </div>
                <div class="pull-right">
                  <a href="<?=base_url('logout')?>" class="btn btn-flat btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url()?>dist/img/<?php if($this->session->userdata('jk_pengguna')=='L'){echo 'avatar5.png';}else{echo 'avatar2.png';} ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Hi, <?=explode(' ',$this->session->userdata('nama_lengkap_pengguna'))[0]?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class=""><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li>
        <li class="treeview <?php if($this->uri->segment(1)=='bts' || $this->uri->segment(1)=='lokasi') echo 'active'; ?>">
          <a href="#">
            <i class="fa fa-signal"></i> <span>BTS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($this->uri->segment(1)=='bts') echo 'active'; ?>"><a href="<?=base_url('bts')?>"><i class="fa fa-circle-o"></i> Data BTS</a></li>
            <li class="<?php if($this->uri->segment(1)=='lokasi') echo 'active'; ?>"><a href="<?=base_url('lokasi')?>"><i class="fa fa-circle-o"></i> Lokasi BTS</a></li>
          </ul>
        </li>
        <li class="<?php if($this->uri->segment(1)=='pelanggan') echo 'active'; ?>"><a href="<?=base_url('pelanggan')?>"><i class="fa fa-users"></i> <span>Pelanggan</span></a></li>
        <li class="treeview <?php if($this->uri->segment(1)=='wireless' || $this->uri->segment(1)=='antena' || $this->uri->segment(1)=='nonwireless' || $this->uri->segment(1)=='merek') echo 'active'; ?>">
          <a href="#">
            <i class="fa fa-gears"></i> <span>Perangkat</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($this->uri->segment(1)=='antena') echo 'active'; ?>"><a href="<?=base_url('antena')?>"><i class="fa fa-circle-o"></i> Data Antena</a></li>

            <?php 
              if ($this->session->userdata('level_pengguna')=='admin') {
            ?>
            <li class="<?php if($this->uri->segment(1)=='merek') echo 'active'; ?>"><a href="<?=base_url('merek')?>"><i class="fa fa-circle-o"></i> Data Merek</a></li>
          <?php } ?>
            <li class="<?php if($this->uri->segment(1)=='nonwireless') echo 'active'; ?>"><a href="<?=base_url('nonwireless')?>"><i class="fa fa-circle-o"></i> Data Nonwireless</a></li>
            <li class="<?php if($this->uri->segment(1)=='wireless') echo 'active'; ?>"><a href="<?=base_url('wireless')?>"><i class="fa fa-circle-o"></i> Data Wireless</a></li>
          </ul>
        </li>
         <?php 
          if ($this->session->userdata('level_pengguna')=='admin') {
        ?>
        <li class="<?php if($this->uri->segment(1)=='paket') echo 'active'; ?>"><a href="<?=base_url('paket')?>"><i class="fa fa-archive"></i> <span>Paket</span></a></li>
        <li class="<?php if($this->uri->segment(1)=='pengguna') echo 'active'; ?>"><a href="<?=base_url('pengguna')?>"><i class="fa fa-user"></i> <span>Pengguna</span></a></li>
        <?php 
          }
         ?>
        <li class="<?php if($this->uri->segment(1)=='log') echo 'active'; ?>"><a href="<?=base_url('log')?>"><i class="fa fa-history"></i> <span>Log</span></a></li>
        <li class="<?php if($this->uri->segment(1)=='alat') echo 'active'; ?>"><a href="<?=base_url('alat')?>"><i class="fa fa-wrench"></i> <span>Alat</span></a></li>
        <?php 
          if ($this->session->userdata('level_pengguna')=='admin') {
        ?>
        <li class="<?php if($this->uri->segment(1)=='konfigurasi') echo 'active'; ?>"><a href="<?=base_url('konfigurasi')?>"><i class="fa fa-gear"></i> <span>Konfigurasi</span></a></li>
        <?php 
          }
         ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php 
          if ($this->uri->segment(1)==null || $this->uri->segment(1)=='beranda') {
            echo "Beranda";
          }elseif($this->uri->segment(1)=='bts'){
            echo strtoupper($this->uri->segment(1));
          }else{
            echo ucwords($this->uri->segment(1));
          }
        ?>
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <?php 
          if($this->uri->segment(1) && $this->uri->segment(2)){
              echo '<li><a href="'.base_url().'"><i class="fa fa-dashboard"></i> Beranda</a></li>';
              echo '<li><a href="'.base_url($this->uri->segment(1)).'">'.ucwords($this->uri->segment(1)).'</a></li>';
              if ($this->uri->segment(2)=='create' || $this->uri->segment(2)=='create_action') {
                echo '<li class="active">Tambah</li>';
              }elseif($this->uri->segment(2)=='update' || $this->uri->segment(2)=='update_action'){
                echo '<li class="active">Ubah</li>';
              }elseif($this->uri->segment(2)=='profil'){
                echo '<li class="active">Profil</li>';
              }elseif($this->uri->segment(2)=='read'){
                echo '<li class="active">Detail</li>';
              }
          }elseif($this->uri->segment(1)=='beranda'){
              echo '<li><a href="'.base_url().'"><i class="fa fa-dashboard"></i> Beranda</a></li>';
          }elseif ($this->uri->segment(1)) {
              echo '<li><a href="'.base_url().'"><i class="fa fa-dashboard"></i> Beranda</a></li>';
              echo '<li class="active">'.ucwords($this->uri->segment(1)).'</li>';
          }else{
              echo '<li><a href="'.base_url().'"><i class="fa fa-dashboard"></i> Beranda</a></li>';
          }
        ?>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div id="notifications">
        <?php 
          if ($this->session->flashdata('message')!=null) {
            echo $this->session->flashdata('message');
            $this->session->unset_userdata('message');
          }
        ?>
      </div>
      <?php
        // This is the main content partial
        echo $contents;
      ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>

<?php 
if (($this->uri->segment(1)=='lokasi' || $this->uri->segment(1)=='pengguna' || $this->uri->segment(1)=='pelanggan') && ($this->uri->segment(2)=='create' || $this->uri->segment(2)=='create_action')) {
?>
            <script type="text/javascript">
                $(document).ready(function(){
                  $('#provinsi').on('change',function() {
                        var provinsi = $('#provinsi').val();
                            $.ajax({
                                type : 'POST',
                                url : '<?=base_url()?>lokasi/getkota',
                                data :  {'provinsi' : provinsi},
                                success: function (data) {
                                        $('#kota').empty().trigger("change");
                                        $("#kota").append('<option>Pilih Kota</option>');
                                        $.each(JSON.parse(data),function(key, value){
                                                $("#kota").append('<option value="' + value + '">' + value + '</option>');
                                                //var newOption = new Option(data.text, data.id, false, false);
                                                //$('#mySelect2').append(newOption).trigger('change');
                                        });
                                },
                                error: function(data){
                                  console.log('data');
                                }
                            });
                  });

                });
            </script>
<?php 
            }elseif($this->uri->segment(1)=='konfigurasi'){?>
              <script type="text/javascript">
                $(document).ready(function(){
                  $('#provinsi').on('change',function() {
                        var provinsi = $('#provinsi').val();
                            $.ajax({
                                type : 'POST',
                                url : '<?=base_url()?>lokasi/getkota',
                                data :  {'provinsi' : provinsi},
                                success: function (data) {
                                        $('#kota').empty().trigger("change");
                                        $("#kota").append('<option>Pilih Kota</option>');
                                        $.each(JSON.parse(data),function(key, value){
                                                $("#kota").append('<option value="' + value + '">' + value + '</option>');
                                                //var newOption = new Option(data.text, data.id, false, false);
                                                //$('#mySelect2').append(newOption).trigger('change');
                                        });
                                },
                                error: function(data){
                                  console.log('data');
                                }
                            });
                  });

                });
            </script>

<?php 
            }

            if (($this->uri->segment(1)=='lokasi' || $this->uri->segment(1)=='pengguna' || $this->uri->segment(1)=='pelanggan') && ($this->uri->segment(2)=='update' || $this->uri->segment(2)=='update_action' || $this->uri->segment(2)=='create_action' || $this->uri->segment(2)=='profil' || $this->uri->segment(2)=='ubah_profil' || $this->uri->segment(2)=='ubah_password')) {
?>
            <script type="text/javascript">
                $(document).ready(function(){
                        var provinsi = $('#provinsi').val();
                            $.ajax({
                                type : 'POST',
                                url : '<?=base_url()?>lokasi/getkota',
                                data :  {'provinsi' : provinsi},
                                success: function (data) {
                                        $.each(JSON.parse(data),function(key, value){
                                                $("#kota").append('<option value="' + value + '"">' + value + '</option>');
                                                
                                        });
                                        $('#kota').val('<?=${"kota_".$this->uri->segment(1)}?>'); // Select the option with a value of '1'
                                        $('#kota').trigger('change'); // Notify any JS components that the value changed
                                },
                                error: function(data){
                                  console.log('data');
                                }
                            });
                });
            </script>
<?php
            }elseif($this->uri->segment(1)=='konfigurasi'){?>
              <script type="text/javascript">
                $(document).ready(function(){
                        var provinsi = $('#provinsi').val();
                            $.ajax({
                                type : 'POST',
                                url : '<?=base_url()?>lokasi/getkota',
                                data :  {'provinsi' : provinsi},
                                success: function (data) {
                                        $.each(JSON.parse(data),function(key, value){
                                                $("#kota").append('<option value="' + value + '"">' + value + '</option>');
                                                
                                        });
                                        $('#kota').val('<?=$kota_lokasi?>'); // Select the option with a value of '1'
                                        $('#kota').trigger('change'); // Notify any JS components that the value changed
                                },
                                error: function(data){
                                  console.log('data');
                                }
                            });
                });
            </script>
<?php
            }
 ?>
<?php if (isset($this->dts)) { ?>
  <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
  <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
  <?php 
    echo $this->dts;
    if (isset($this->dts1)) {
      echo $this->dts1;
    }elseif (isset($this->dts2)) {
      echo $this->dts2;
    }elseif (isset($this->dts3)) {
      echo $this->dts3;
    }
  ?>
<?php } ?>
<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url()?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>bower_components/bootstrap/dist/js/bootstrap-toggle.min.js"></script>
<script src="<?=base_url()?>bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- ChartJS -->
<script src="<?=base_url()?>bower_components/chart.js/Chart.js"></script>
<script src="<?=base_url()?>assets/code/highcharts.js"></script>
<script src="<?=base_url()?>assets/code/modules/exporting.js"></script>
<script src="<?=base_url()?>assets/code/modules/export-data.js"></script>
<!-- Sparkline -->
<script src="<?=base_url()?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?=base_url()?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- InputMask -->
<script src="<?=base_url()?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?=base_url()?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="<?=base_url()?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?=base_url()?>plugins/input-mask/jquery.inputmask.numeric.extensions.js"></script>
<!-- daterangepicker -->
<script src="<?=base_url()?>bower_components/moment/min/moment.min.js"></script>
<script src="<?=base_url()?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?=base_url()?>bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?=base_url()?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- datepicker -->
<script src="<?=base_url()?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?=base_url()?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?=base_url()?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?=base_url()?>plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url()?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?=base_url()?>dist/js/pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({width:'100%'})
    //Datemask dd/mm/yyyy
    
    $('#datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
    //Money Euro
    $('[data-mask]').inputmask()
    //Date range picker
    $('#range-tanggal').daterangepicker({
      ranges: {
        'Hari ini': [moment(), moment()],
        'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
        '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
        'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
        'Bulan Kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
       "maxDate": moment(),
       <?php 
          if (isset($tanggal_mulai) && isset($tanggal_selesai)) {?>
        "startDate": "<?=$tanggal_mulai?>",
        "endDate": "<?=$tanggal_selesai?>",
      <?php 
          }
        ?>
    });
    $('#range-tanggal').on('apply.daterangepicker', function(ev, picker) {
        $("#tanggal-range").submit();
    });
   
    //Date picker
    $('#datepicker').datepicker({
       format: 'yyyy-mm-dd',
       autoclose: true,
    })
    <?php 
      if (isset($tanggal_mulai) && isset($tanggal_selesai)) {
      ?>
        $('#datepickerlog').datepicker({
            autoclose: true,
            fautoclose: true,
            startDate: new Date('<?=$tanggal_mulai?>'),
            endDate: new Date('<?=$tanggal_selesai?>'),
            calendarWeeks:true,
        });

        <?php 
            if ($this->session->has_userdata('tanggal_bts')) {
        ?>
            $('#datepickerlog').datepicker('setDate', '<?=$this->session->userdata('tanggal_bts')?>');
        <?php 
            }else{
         ?>
            $('#datepickerlog').datepicker('setDate', '<?=$tanggal_mulai?>');
    <?php
        } 
        ?>
        $('#datepickerlog').on('changeDate', function () {
          $("#grafik-bts").submit();
        })
    <?php 
      }
    ?>
    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false,
      // showSeconds: true,
      showMeridian: false,
      // secondStep: 10,
      minuteStep: 1,
      defaultTime:'00:05',
      disableFocus: true,
    })

  })
</script>
<script>
$(document).ready(function(){
  <?php 
    if ($this->uri->segment(1)=='konfigurasi' && $this->uri->segment(2)=='ubah_pusat_bts') {
        echo "$('#modal-default').modal('show');";
    }
  ?>
  $('#notifications').fadeIn(1000).delay(3000).slideUp('slow');      
  $('input[type="radio"]').each(function(){
    var self = $(this),
      label = self.next(),
      label_text = label.text();

    label.remove();
    self.iCheck({
      checkboxClass: 'icheckbox_line-blue',
      radioClass: 'iradio_line-blue',
      insert: '<div class="icheck_line-icon"></div>' + label_text
    });
  });
  <?php 
    if (isset($notifikasi_email)) {
      if ($notifikasi_email=='off') {
         echo "
         $('#notifikasi_email_menit').attr('disabled','disabled');
         ";
      }
    }
  ?>
  $('#notifikasi_email').change(function() {
    if ($('#notifikasi_email').is(':checked')) {
      $('#notifikasi_email_menit').removeAttr('disabled');
    }else{
      $('#notifikasi_email_menit').attr('disabled','disabled');

    }
  })
  $("#reset").click(function(){
        $('#id_pelanggan').val('Pilih Pelanggan').trigger('change');
    });
});
</script>
<?php 
  if ($this->uri->segment(1)=='log') {
    echo $this->chart;
  }
?>
</body>
</html>
