<div class="container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      TARGET OMSET
      <small>SoloNET</small>
      
    </h1>
        <ol class="breadcrumb">
      <!-- <li><a href="#modal_edit_target_omset" role="button"  data-target = "#modal_edit_target_omset" data-toggle="modal"><i class="fa fa-edit"></i> Edit Omset</a></li> -->
      <li><a href="?page=page_grafik_user_hold"><i class="fa fa-bar-chart"></i> Grafik User Non-Aktif</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
          <!-- Custom tabs (Charts with tabs)-->
          <div id="container"></div>

        </section>

      </div>
      <!-- /.row (main row) -->
  </section>
  <!-- /.content -->
</div>
<!-- /.container -->

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Grafik Target dan Omset'
    },
    subtitle: {
        text: 'PT. Solo Jala Buana <br> (2018)'
    },
    xAxis: {
        // categories: ['<a href="#modal_edit_target_omset" role="button"  data-target = "#modal_edit_target_omset" data-toggle="modal">Jan</a>', 'Feb', 'Mar ', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        categories: [
                      <?php
                      $bulan_indonesia = array(
                        '1' => 'Jan',
                        '2' => 'Feb',
                        '3' => 'Mar',
                        '4' => 'Apr',
                        '5' => 'May',
                        '6' => 'Jun',
                        '7' => 'Jul',
                        '8' => 'Aug',
                        '9' => 'Sep',
                        '10' => 'Oct',
                        '11' => 'Nov',
                        '12' => 'Dec',
                      );

                      for($perulangan=1;$perulangan<=12;$perulangan++){
                        echo "'".$bulan_indonesia[$perulangan]."',";
                      }
                      ?>
                    ]
    },
    yAxis: {
        title: {
            text: 'Omset (Dalam Rupiah)'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [
    // {
    //     name: 'Target',
    //     data: [
    //             <?php
    //               foreach($select->select_target_omset($tahun) as $data) {
    //                 $data_target = $data['nominal_target_omset'];
    //                 echo $data_target.",";
    //               }
    //             ?>
    //           ]
    // },
     {
        name: 'Realisasi Omset',
        data: [
                <?php
                  foreach($select->select_realita_omset($tahun) as $data) {
                    $data_omset = $data;
                    echo $data_omset.",";
                  }
                ?>
              ]
    }]
});
</script>
  <?php
  include "modal_edit_target_omset.php";
  ?>