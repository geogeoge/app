<?php
$tahun = "2019";
?>
<div class="container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Menu Utama
      <small>SoloNET</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
        <div class="col-lg-12 col-xs-12">
          <!-- small box -->
          <a href="?page=page_grafik_omset"  class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo number_format($select->select_dashboard_omset($tahun),0,',','.');?></h3>

              <p><b>Omset</b> Bulan Berjalan</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
          </a>
        </div>
        <!-- ./col -->

        <div class="col-lg-6 col-xs-12">
          <!-- small box -->
          <a href="?page=page_grafik_tagihan" class="small-box bg-green">
            <div class="inner">
              <h3><?php echo number_format($select->select_dashboard_tagihan_terbayar($tahun),0,',','.');?></h3>

              <p><b>Tagihan Terbayar</b> Bulan Berjalan</p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
          </a>
        </div>
        <!-- ./col -->

        <div class="col-lg-6 col-xs-12">
          <!-- small box -->
          <a href="?page=page_grafik_pemasangan" class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo number_format($select->select_dashboard_pemasangan($tahun),0,',','.');?></h3>

              <p><b>Pemasangan</b> Bulan Berjalan</p>
            </div>
            <div class="icon">
              <i class="fa fa-wrench"></i>
            </div>
          </a>
        </div>
        <!-- ./col -->
    </div>
      <!-- /.row -->
    <div class="row">
      <!-- Line chart -->
          <div class="box box-primary">
            <a href="?page=page_grafik_pengguna_produk" class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title"><font color="black">Grafik Pengguna dan Nilai Produk</font></h3>

              <!-- <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div> -->
            </a>
            <div class="box-body">
              <div class="row">
                <a href="?page=page_grafik_pengguna_produk" class="col-md-6 col-sm-6">
                    <div id="container"></div>
                </a>
                <a href="?page=page_grafik_nilai_produk" class="col-md-6 col-sm-6">
                    <div id="container_2"></div>
                </a>
              </div>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.container -->


<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script type="text/javascript">
  
// Build the chart
Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Grafik Presentasi <b>PENGGUNA</b> Produk'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [{
            name: 'Paket Costume',
            y: <?php echo $select->select_dashboard_pengguna_produk_kostume($tahun);?>,
            // sliced: true,
            // selected: true
        }, {
            name: 'Paket Khusus',
            y: <?php echo $select->select_dashboard_pengguna_produk_khusus($tahun);?>
        }, {
            name: 'Rp. 200.000',
            y: <?php echo $select->select_dashboard_pengguna_produk_200000($tahun);?>
        }, {
            name: 'Rp. 350.000',
            y: <?php echo $select->select_dashboard_pengguna_produk_350000($tahun);?>
        }, {
            name: 'Rp. 500.000',
            y: <?php echo $select->select_dashboard_pengguna_produk_500000($tahun);?>
        }, {
            name: 'Rp. 750.000',
            y: <?php echo $select->select_dashboard_pengguna_produk_750000($tahun);?>
        }, {
            name: 'Rp. 1.000.000',
            y: <?php echo $select->select_dashboard_pengguna_produk_1000000($tahun);?>
        }]
    }]
});
</script>

<script type="text/javascript">
  
// Build the chart
Highcharts.chart('container_2', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Grafik Presentasi <b>NILAI</b> Produk'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [{
            name: 'Paket Costume',
            y: <?php echo $select->select_dashboard_produk_kostume($tahun);?>,
            // sliced: true,
            // selected: true
        }, {
            name: 'Paket Khusus',
            y: <?php echo $select->select_dashboard_produk_khusus($tahun);?>
        }, {
            name: 'Rp. 200.000',
            y: <?php echo $select->select_dashboard_produk_200000($tahun);?>
        }, {
            name: 'Rp. 350.000',
            y: <?php echo $select->select_dashboard_produk_350000($tahun);?>
        }, {
            name: 'Rp. 500.000',
            y: <?php echo $select->select_dashboard_produk_500000($tahun);?>
        }, {
            name: 'Rp. 750.000',
            y: <?php echo $select->select_dashboard_produk_750000($tahun);?>
        }, {
            name: 'Rp. 1.000.000',
            y: <?php echo $select->select_dashboard_produk_1000000($tahun);?>
        }]
    }]
});
</script>