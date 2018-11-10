<section class="content-header">
  <h1>
    <?php echo $bulan_indonesia[date('m')]; ?>
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

    <!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <?php
    if($crud->total_user_yang_harus_close($login_id_marketing)>'0') {
    ?>
    <div class="col-md-12">
      <div class="box box-warning box-solid">
        <div class="box-header with-border">
          <a href="?page=page_data_user_trial"><h3 class="box-title">Ada <?php echo $crud->total_user_yang_harus_close($login_id_marketing);?> User Yang Harus Anda CLOSE</h3></a>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php
          foreach($crud->data_user_yang_harus_close($login_id_marketing) as $data) {          
          ?>
          ~ <?php echo $data['nama_user']; ?><br>
          <?php
          }
          ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <?php
    }
    ?>
  </div>

  <div class="row">
    <?php
    if($crud->total_user_hold_bulan_ini($login_id_marketing)>'0') {
    ?>
    <div class="col-md-12">
      <div class="box box-danger box-solid">
        <div class="box-header with-border">
          <a href="?page=page_data_user_trial"><h3 class="box-title">Ada <?php echo $crud->total_user_hold_bulan_ini($login_id_marketing);?> User Yang HOLD bulan ini</h3></a>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php
          foreach($crud->data_user_hold_bulan_ini($login_id_marketing) as $data) {          
          ?>
          ~ <?php echo $data['nama_user']; ?><br>
          &nbsp; &nbsp; &nbsp; <b>Keterangan : </b></b><?php echo $data['catatan']; ?><br><br>
          <?php
          }
          ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <?php
    }
    ?>
  </div>

  <div class="row">

    <div class="col-lg-4 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-blue">
        <div class="inner">
          <h3><?php echo $crud->total_user_prospek($login_id_marketing); ?></h3>

          <p>Jumlah User <strong>PROSPEK</strong></p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="?page=page_data_user_prospek" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-4 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?php echo $crud->total_user_trial($login_id_marketing); ?></h3>

          <p>Jumlah User <strong>TRIAL</strong></p>
        </div>
        <div class="icon">
          <i class="fa fa-thumbs-up"></i>
        </div>
        <a href="?page=page_data_user_trial" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-4 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?php echo $crud->total_user_close($login_id_marketing); ?></h3>

          <p>Jumlah User <strong>CLOSE</strong></p>
        </div>
        <div class="icon">
          <i class="fa fa-check"></i>
        </div>
        <a href="?page=page_detail_user_close" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

  </div>

  <div class="row">
    <div class="col-md-12">
      <!-- Bar chart -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <i class="fa fa-bar-chart-o"></i>

          <h3 class="box-title">Grafik Jumlah User CLOSE Setiap Marketing</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div id="bar-chart" style="height: 300px;"></div>
        </div>
        <!-- /.box-body-->
      </div>
      <!-- /.box -->
    </div>

  <!-- /.row -->
  <!--
  <div class="row">
    <section class="col-lg-12 connectedSortable">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs pull-right">
          <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
          <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
          <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
        </ul>
        <div class="tab-content no-padding">
          <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
        </div>
      </div>
    </section>
   </div>
   -->
  <!-- /.row (main row) -->
</section>