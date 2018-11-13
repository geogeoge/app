<?php
include "session.php";
include "../../koneksi/koneksi.php";
include "function.php";

$login_id_teknisi = $_SESSION['id_user'];

$update = new update;
$select = new select;
$input = new input;
$dashboard = new dashboard;

$session_id_user = $_SESSION['id_user'];


if(isset($_POST['proses_penjadwalan'])) {
  $update->proses_penjadwalan();
  header('location:?page=page_permintaan_pemasangan');
}

if(isset($_POST['tombol_rubah_penjadwalan'])) {
  $update->proses_rubah_jadwal();
}

if(isset($_POST['tombol_konfirmasi_pemasangan_selesai'])) {
  $update->proses_konfirmasi_pemasangan_selesai();
}

if(isset($_POST['tombol_batalkan_pemasangan'])) {
  $update->proses_konfirmasi_pemasangan_batal();
}

if(isset($_POST['tombol_buat_jadwal_maintenance'])) {
  $update->proses_penjadwalan_maintenance();
}

if(isset($_POST['tombol_edit_data_maintenance'])) {
  $update->proses_edit_data_maintenance();
}

if(isset($_POST['tombol_konfirmasi_maintenance_selesai'])) {
  $update->proses_konfirmasi_maintenance_selesai();
}

if(isset($_POST['tombol_konfirmasi_maintenance_batal'])) {
  $update->proses_konfirmasi_maintenance_batal();
}

if(isset($_POST['tombol_input_komplen'])) {
  $input->proses_input_komplen();
  header('location:?page=page_permintaan_maintenance');
}

if(isset($_POST['tombol_edit_data_pemasangan'])) {
  $update->proses_edit_data_pemasangan($_POST['ip'], $_POST['id_bts'], $_POST['id_register']);
  header('location:?page=page_data_pemasangan');
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
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TEKNISI | SOLONET</title>

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
  <!-- fullCalendar -->
  <link rel="stylesheet" href="../asset/bootstrap/bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="../asset/bootstrap/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
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
<!-- jQuery 3 -->
<script src="../asset/bootstrap/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../asset/bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../asset/bootstrap/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Slimscroll -->
<script src="../asset/bootstrap/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../asset/bootstrap/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../asset/bootstrap/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../asset/bootstrap/dist/js/demo.js"></script>
<!-- fullCalendar -->
<script src="../asset/bootstrap/bower_components/moment/moment.js"></script>
<script src="../asset/bootstrap/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week : 'week',
        day  : 'day'
      },
      //Random default events
      events    : [
      <?php
        foreach($select->select_data_jadwal() as $data) {
          $bulan_sekarang = date('m');
          $data_bulan = date('m', strtotime($data['tanggal_penjadwalan']));
          $selisih_bulan = $data_bulan-1;
      ?>
        {
          title          : 'Pemasangan <?php $nama_user=explode(" ", $data['nama_user']); echo $nama_user['0']; ?>',
          start          : new Date(<?php echo date('Y', strtotime($data['tanggal_penjadwalan']));?>, <?php echo $selisih_bulan;?>, <?php echo date('d', strtotime($data['tanggal_penjadwalan']));?>),
          backgroundColor: '<?php echo $data['ekstra'];?>', //red
          borderColor    : '<?php echo $data['ekstra'];?>' //red
        },
      <?php
      }
      ?>

      <?php
        foreach($select->select_data_jadwal_partner() as $data) {
          $bulan_sekarang = date('m');
          $data_bulan = date('m', strtotime($data['tanggal_penjadwalan']));
          $selisih_bulan = $data_bulan-1;
      ?>
        {
          title          : 'Pemasangan <?php $nama_user=explode(" ", $data['nama_user']); echo $nama_user['0']; ?>',
          start          : new Date(<?php echo date('Y', strtotime($data['tanggal_penjadwalan']));?>, <?php echo $selisih_bulan;?>, <?php echo date('d', strtotime($data['tanggal_penjadwalan']));?>),
          backgroundColor: '<?php echo $data['ekstra'];?>', //red
          borderColor    : '<?php echo $data['ekstra'];?>' //red
        },
      <?php
      }
      ?>
      
      <?php
        foreach($select->select_data_jadwal_maintenance() as $data) {
          $bulan_sekarang = date('m');
          $data_bulan = date('m',  strtotime($data['tanggal_penjadwalan_maintenance']));
          $selisih_bulan = $data_bulan-1;
      ?>
        {
          title          : 'Maintenance <?php $nama_user=explode(" ", $data['nama_user']); echo $nama_user['0']; ?>',
          start          : new Date(<?php echo date('Y', strtotime($data['tanggal_penjadwalan_maintenance']));?>, <?php echo $selisih_bulan;?>, <?php echo date('d', strtotime($data['tanggal_penjadwalan_maintenance']));?>),
          backgroundColor: '<?php echo $data['ekstra'];?>', //red
          borderColor    : '<?php echo $data['ekstra'];?>' //red
        },
      <?php
      }
      ?>

      <?php
        foreach($select->select_data_jadwal_maintenance_partner() as $data) {
          $bulan_sekarang = date('m');
          $data_bulan = date('m',  strtotime($data['tanggal_penjadwalan_maintenance']));
          $selisih_bulan = $data_bulan-1;
      ?>
        {
          title          : 'Maintenance <?php $nama_user=explode(" ", $data['nama_user']); echo $nama_user['0']; ?>',
          start          : new Date(<?php echo date('Y', strtotime($data['tanggal_penjadwalan_maintenance']));?>, <?php echo $selisih_bulan;?>, <?php echo date('d', strtotime($data['tanggal_penjadwalan_maintenance']));?>),
          backgroundColor: '<?php echo $data['ekstra'];?>', //red
          borderColor    : '<?php echo $data['ekstra'];?>' //red
        },
      <?php
      }
      ?>
      ],
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      }
    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })
</script>
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
</script>
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
</html>
