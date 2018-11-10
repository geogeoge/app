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

    <div class="col-lg-3 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-gray">
        <div class="inner">
          <h3><?php echo $dashboard->data_user_prospek_all(); ?></h3>

          <p>Jumlah User <strong>PROSPEK</strong></p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="?page=page_data_user_prospek" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?php echo $dashboard->data_user_trial_all(); ?></h3>

          <p>Jumlah User <strong>TRIAL</strong></p>
        </div>
        <div class="icon">
          <i class="fa fa-exclamation-circle"></i>
        </div>
        <a href="?page=page_data_user_trial" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?php echo $dashboard->data_user_close_all(); ?></h3>

          <p>Jumlah User <strong>CLOSE</strong></p>
        </div>
        <div class="icon">
          <i class="fa fa-thumbs-up"></i>
        </div>
        <a href="?page=page_data_user_close" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?php echo $dashboard->data_user_hold_all(); ?></h3>

          <p>Jumlah User <strong>HOLD</strong></p>
        </div>
        <div class="icon">
          <i class="fa fa fa-close"></i>
        </div>
        <a href="?page=page_data_user_hold" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>

  <!-- /.row -->
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
  </div>

  <?php
  foreach($dashboard->data_marketing() as $data) {
  ?>
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-solid box-default collapsed-box">
        <div class="box-header">
          <i class="fa fa-bar-chart-o"></i>

          <h3 class="box-title">Detail Data : <?php echo $data['nama_user'] ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
            <button type="button" class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <!-- ./col -->
            <div class="col-xs-6 col-md-3 text-center">
              <input type="text" class="knob" value="<?php echo $dashboard->data_user_prospek_per_marketing($data['id_user']); ?>" data-skin="tron" data-thickness="0.2" data-width="120" data-height="120" data-fgColor="#001F3F" readonly="readonly">

              <div class="knob-label">USER PROSPEK</div>
            </div>
            <!-- ./col -->

            <div class="col-xs-6 col-md-3 text-center">
              <input type="text" class="knob" value="<?php echo $dashboard->data_user_trial_per_marketing($data['id_user']); ?>" data-skin="tron" data-thickness="0.2" data-width="120" data-height="120" data-fgColor="#f39c12" readonly="readonly">

              <div class="knob-label">USER TRIAL</div>
            </div>
            <!-- ./col -->

            <div class="col-xs-6 col-md-3 text-center">
              <input type="text" class="knob" value="<?php echo $dashboard->data_user_close_per_marketing($data['id_user']); ?>" data-skin="tron" data-thickness="0.2" data-width="120" data-height="120" data-fgColor="#00a65a" readonly="readonly">

              <div class="knob-label">USER CLOSE</div>
            </div>
            <!-- ./col -->

            <div class="col-xs-6 col-md-3 text-center">
              <input type="text" class="knob" value="<?php echo $dashboard->data_user_hold_per_marketing($data['id_user']); ?>" data-skin="tron" data-thickness="0.2" data-width="120" data-height="120" data-fgColor="#f56954" readonly="readonly">

              <div class="knob-label">USER HOLD</div>
            </div>
            <!-- ./col -->
            
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <?php
  }
  ?>

  <!-- /.row -->
<!-- /.row (main row) -->
</section>