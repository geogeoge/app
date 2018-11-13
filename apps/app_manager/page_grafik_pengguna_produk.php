<div class="container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Grafik Pengguna Produk
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
        text: 'Grafik Total <b>PENGGUNA</b> Produk'
    },
    subtitle: {
        text: 'PT. Solo Jala Buana <br> (2018)'
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        title: {
            text: 'Dalam Satuan'
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
        name: 'Paket Costume',
        data: [
                <?php
                  foreach($select->select_nilai_produk_kostume('2018') as $data) {
                    $data_omset = $data;
                    echo $data_omset.",";
                  }
                ?>
              ]
    }, {
        name: 'Paket Khusus',
        data: [
                <?php
                  foreach($select->select_nilai_produk_khusus('2018') as $data) {
                    $data_omset = $data;
                    echo $data_omset.",";
                  }
                ?>
              ]
    }, {
        name: 'Rp. 200.000',
        data: [
                <?php
                  foreach($select->select_nilai_produk_200000('2018') as $data) {
                    $data_omset = $data;
                    echo $data_omset.",";
                  }
                ?>
              ]
    }, {
        name: 'Rp. 350.000',
        data: [
                <?php
                  foreach($select->select_nilai_produk_350000('2018') as $data) {
                    $data_omset = $data;
                    echo $data_omset.",";
                  }
                ?>
              ]
    }, {
        name: 'Rp. 500.000',
        data: [
                <?php
                  foreach($select->select_nilai_produk_500000('2018') as $data) {
                    $data_omset = $data;
                    echo $data_omset.",";
                  }
                ?>
              ]
    }, {
        name: 'Rp. 750.000',
        data: [
                <?php
                  foreach($select->select_nilai_produk_750000('2018') as $data) {
                    $data_omset = $data;
                    echo $data_omset.",";
                  }
                ?>
              ]
    }, {
        name: 'Rp. 1.000.000',
        data: [
                <?php
                  foreach($select->select_nilai_produk_1000000('2018') as $data) {
                    $data_omset = $data;
                    echo $data_omset.",";
                  }
                ?>
              ]
    }]
});
</script>