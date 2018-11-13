<section class="content-header">
  <h1>
    P E M A S A N G A N
    <small>Dashboard</small>
  </h1>
</section>

    <!-- Main content -->
<section class="content">

  <div class="row">

  <div class="col-lg-4 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?php echo $dashboard->select_permintaan_pemasangan(); ?></h3>

          <p>Permintaan <strong>PEMASANGAN</strong></p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="?page=page_permintaan_pemasangan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-4 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?php echo $dashboard->select_jadwal_pemasangan(); ?></h3>

          <p>Jadwal <strong>PEMASANGAN</strong></p>
        </div>
        <div class="icon">
          <i class="fa fa-calendar"></i>
        </div>
        <a href="?page=page_jadwal_pemasangan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-4 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-blue">
        <div class="inner">
          <h3><?php echo $dashboard->select_antrian_penagihan()+$dashboard->select_antrian_penagihan_partner(); ?></h3>

          <p>Antrian <strong>Penagihan</strong></p>
        </div>
        <div class="icon">
          <i class="fa fa-money"></i>
        </div>
        <a href="?page=page_data_pemasangan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-12 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?php echo $dashboard->select_data_pemasangan()+$dashboard->select_data_pemasangan_partner(); ?></h3>

          <p>PEMASANGAN Bulan <strong><?php echo $bulan_indonesia[date('m')];?></strong></p>
        </div>
        <div class="icon">
          <i class="fa fa-check"></i>
        </div>
        <a href="?page=page_data_pemasangan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
</section>

<section class="content-header">
  <h1>
    M A I N T E N A N C E
    <small>Dashboard</small>
  </h1>
</section>
<section class="content-header">
  <div class="row">

    <div class="col-lg-6 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?php echo $dashboard->select_permintaan_maintenance(); ?></h3>

          <p>Permintaan <strong>MAINTENANCE</strong></p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="?page=page_permintaan_maintenance" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-6 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-blue">
        <div class="inner">
          <h3><?php echo $dashboard->select_jadwal_maintenance(); ?></h3>

          <p>Jadwal <strong>MAINTENANCE</strong></p>
        </div>
        <div class="icon">
          <i class="fa fa-calendar"></i>
        </div>
        <a href="?page=page_jadwal_maintenance" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-12 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?php echo $dashboard->select_data_maintenance()+$dashboard->select_data_maintenance_partner(); ?></h3>

          <p>MAINTENANCE Bulan <strong><?php echo $bulan_indonesia[date('m')];?></strong></p>
        </div>
        <div class="icon">
          <i class="fa fa-check"></i>
        </div>
        <a href="?page=page_data_maintenance" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
</section>