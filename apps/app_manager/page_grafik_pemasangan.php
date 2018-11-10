<div class="container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      TARGET PEMASANGAN
      <small>SoloNET</small>
    </h1>
    <!--     <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Layout</a></li>
      <li class="active">Top Navigation</li>
    </ol> -->
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
        text: 'Grafik Target Pemasangan'
    },
    subtitle: {
        text: 'PT. Solo Jala Buana <br> (2018)'
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        title: {
            text: 'Pemasangan (Dalam Satuan)'
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
    series: [{
        name: 'Permintaan Pemasangan',
        data: [
                <?php
                  foreach($select->select_permintaan_pemasangan('2018') as $data) {
                    echo $data.",";
                  }
                ?>
              ]
    }, {
        name: 'Realisasi Pemasangan',
        data: [
                <?php
                  foreach($select->select_realita_pemasangan('2018') as $data) {
                    echo $data.",";
                  }
                ?>
              ]
    }]
});
</script>