<?php 
// if (!$this->session->has_userdata('status')) {
//     redirect(base_url('login'));
// }
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Penyusutan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>bower_components/jquery-ui/themes/ui-lightness/jquery-ui.css">

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
    .select2{
      width: 100%!important;
    }
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

            var .tipe-user = document.getElementById('address');
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
      <span class="logo-mini"><b>P</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>APL</b> PENYUSUTAN</span>
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
              <img src="<?=base_url()?>dist/img/<?php echo 'avatar5.png'; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=ucwords($this->session->userdata('username'))?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=base_url()?>dist/img/avatar5.png" class="img-circle" alt="User Image">

                <p>
                  <?=ucwords($this->session->userdata('username'))?>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                
                <div class="pull-right">
                  <a href="<?=base_url('login/logout')?>" class="btn btn-flat btn-default btn-flat">Keluar</a>
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
          <img src="<?=base_url()?>dist/img/<?php echo 'avatar5.png';?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Hi, <?=ucwords($this->session->userdata('username'))?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?php if($this->uri->segment(1)=='data_pemasangan_alat') echo 'active'; ?>"><a href="<?=base_url('data_pemasangan_alat')?>"><i class="fa fa-book"></i> <span>Data Pemasangan Alat</span></a></li>
        <li class="<?php if($this->uri->segment(1)=='data_penghapusan_pemasangan') echo 'active'; ?>"><a href="<?=base_url('data_penghapusan_pemasangan')?>"><i class="fa fa-book"></i> <span>Data Penghapusan</span></a></li>
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
          }else{
            echo ucwords(str_replace('_', ' ', $this->uri->segment(1)));
          }
        ?>
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <?php 
          if($this->uri->segment(1) && $this->uri->segment(2)){
              echo '<li><a href="'.base_url().'"><i class="fa fa-dashboard"></i> Beranda</a></li>';
              echo '<li><a href="'.base_url($this->uri->segment(1)).'">'.ucwords(str_replace('_', ' ', $this->uri->segment(1))).'</a></li>';
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
              echo '<li class="active">'.ucwords(str_replace('_', ' ', $this->uri->segment(1))).'</li>';
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
<?php if (isset($this->dts)) { ?>
  <script src="<?php echo base_url('assets/datatables/jquery.dataTables.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
  <?php 
    echo $this->dts;
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
<script src="<?=base_url()?>bower_components/moment/moment-with-locales.js"></script>
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
$(document).ready(function(){
  // $( "#notifications" ).click(function() {
  //   $( "#notifications" ).slideUp( "slow" );
  // });    
  $('#notifications').fadeIn(1000).delay(2500).slideUp('slow');  
});
</script>
    <script type="text/javascript">
                $(document).ready(function(){
                            
                });
            </script>
    <script>
  $(function () {
    $('.select2').select2({width:'100%'});
    $('#datepicker').datepicker({
       format: 'yyyy-mm-dd',
       autoclose: true,
    });
    $('[data-mask]').inputmask(); 
    $('input[type="radio"]').each(function(){
      var self = $(this),
        label = self.next(),
        label_text = label.text();

      label.remove();
      self.iCheck({
        checkboxClass: 'icheckbox_line-blue',
        radioClass: 'iradio_line-blue',
        insert: '<div class="icheck_line-icon"></div>' + label_text,
      });
    }); 
<?php if ($this->uri->segment(2)) { 
        if ($type_user=='BTS') {

    ?>    
                            $.ajax({
                                type : 'POST',
                                url : '<?=base_url('data_pemasangan_alat/get_bts')?>',
                                success: function (data) {
                                        $('#id_user').empty().trigger("change");
                                        $.each(JSON.parse(data),function(key, value){
                                                $("#id_user").append('<option value="">Pilih User</option>');
                                                $("#id_user").append('<option value="' + value.id_bts + '">' + value.nama_bts + '</option>');
                                        });
                                         $('#id_user').val('<?=$id_user?>'); // Select the option with a value of '1'
                                                $('#id_user').trigger('change'); // Notify any JS components that the value changed
                                },
                                error: function(data){
                                  console.log('data');
                                }
                            });
      <?php 
        }else{
          ?>
           $.ajax({
                                type : 'POST',
                                url : '<?=base_url('data_pemasangan_alat/get_client')?>',
                                success: function (data) {
                                        $('#id_user').empty().trigger("change");
                                        $.each(JSON.parse(data),function(key, value){
                                                $("#id_user").append('<option value="">Pilih User</option>');
                                                $("#id_user").append('<option value="' + value.id_register + '">' + value.nama_user + '</option>');
                                        });
                                        $('#id_user').val('<?=$id_user?>'); // Select the option with a value of '1'
                                                $('#id_user').trigger('change'); // Notify any JS components that the value changed
                                },
                                error: function(data){
                                  console.log('data');
                                }
                            });
      <?php
        }

       ?>

    $('.tipe-user').on('ifChecked', function (event){
                            $.ajax({
                                type : 'POST',
                                url : '<?=base_url('data_pemasangan_alat/get_bts')?>',
                                success: function (data) {
                                        $('#id_user').empty().trigger("change");
                                        $.each(JSON.parse(data),function(key, value){
                                                $("#id_user").append('<option value="">Pilih BTS</option>');
                                                $("#id_user").append('<option value="' + value.id_bts + '">' + value.nama_bts + '</option>');
                                        });
                                },
                                error: function(data){
                                  console.log('data');
                                }
                            });      
    });
    $('.tipe-user').on('ifUnchecked', function (event) {
        $.ajax({
                                type : 'POST',
                                url : '<?=base_url('data_pemasangan_alat/get_client')?>',
                                success: function (data) {
                                        $('#id_user').empty().trigger("change");
                                        $.each(JSON.parse(data),function(key, value){
                                                $("#id_user").append('<option value="">Pilih User</option>');
                                                $("#id_user").append('<option value="' + value.id_register + '">' + value.nama_user + '</option>');
                                        });

                                },
                                error: function(data){
                                  console.log('data');
                                }
                            });      
    });
<?php 
}
 ?>
  });
 
</script>
<?php if ($this->uri->segment(2)=='update' || $this->uri->segment(2)=='create_action' || $this->uri->segment(2)=='update_action') {
?>
<script type="text/javascript">
                $(document).ready(function(){
                        var nota = "<?=$nota?>";
                            $.ajax({
                                type : 'POST',
                                url : '<?php echo base_url('data_pemasangan_alat/get_nota');?>',
                                data :  {'nota' : nota},
                                success: function (data) {
                                         $.each(JSON.parse(data),function(key, value){
                                                $('#id_alat').empty().trigger("change");
                                                $("#id_alat").append('<option value="">Pilih Alat</option>');
                                                $("#id_alat").append('<option value="' + value.kode + '"">' + value.nama + '</option>');
                                                
                                        });
                                        $('#id_alat').val('<?=$id_alat?>'); // Select the option with a value of '1'
                                        $('#id_alat').trigger('change'); // Notify any JS components that the value changed
                                        
                                },
                                error: function(data){
                                  console.log('data');
                                }
                            });
                         var nota = "<?=$nota?>";
                        var id_alat = "<?=$id_alat?>";
                        $.ajax({
                                        type : 'POST',
                                        url : '<?php echo base_url('data_pemasangan_alat/get_alat');?>',
                                        data :  {'nota' : nota,'id_alat' : id_alat},
                                        success: function (data) {
                                                $.each(JSON.parse(data),function(key, value){
                                                  document.getElementById("jumlah_alat").max = parseInt(value.qty);
                                                });

                                        },
                                        error: function(data){
                                          console.log(data);
                                        }
                                    });

                });
            </script>
<?php 
}
 ?>
<script type="text/javascript">
        $(document).ready(function(){
            $('#nota').select2({
              ajax: {
                url: '<?php echo base_url('data_pemasangan_alat/get_autocomplete');?>',
                dataType: 'json',
                data: function (params) {
                  return {
                    nota: params.term // search term
                  };
                },
                processResults: function (response) {
                   return {
                      results: response
                   };
                 },
                 cache: true
                // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
              }
            });
            $('#nota').on("change", function(e) { 
               var data = $("#nota option:selected").val();
               $.ajax({
                                type : 'POST',
                                url : '<?php echo base_url('data_pemasangan_alat/get_nota');?>',
                                data :  {'nota' : data},
                                success: function (data) {
                                        $.each(JSON.parse(data),function(key, value){
                                                $('#id_alat').empty().trigger("change");
                                                $("#id_alat").append('<option value="">Pilih Alat</option>');
                                                $("#id_alat").append('<option value="' + value.kode + '"">' + value.nama + '</option>');
                                                $('#harga').val('');
                                                
                                        });
                                },
                                error: function(data){
                                  console.log(data);
                                }
                            });
            });
            
            $('#id_alat').on('select2:select', function (e) {
                // alert($('#id_alat').val());
                var nota = $("#nota option:selected").val();
                var id_alat = $("#id_alat option:selected").val();
                $.ajax({
                                type : 'POST',
                                url : '<?php echo base_url('data_pemasangan_alat/get_alat');?>',
                                data :  {'nota' : nota,'id_alat' : id_alat},
                                success: function (data) {
                                        $.each(JSON.parse(data),function(key, value){
                                          console.log(parseInt(value.harga, 10));
                                          $('#harga').val(parseInt(value.harga, 10));
                                          document.getElementById("jumlah_alat").max = parseInt(value.qty);
                                        });

                                },
                                error: function(data){
                                  console.log(data);
                                }
                            });
            });

        });

    </script>
</body>
</html>
