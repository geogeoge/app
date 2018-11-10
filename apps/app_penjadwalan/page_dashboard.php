<section class="content-header">
  <h1>
    K A L E N D E R
    <small>Dashboard</small>
  </h1>
</section>
<section class="content">

  <div class="row">
    <?php
    if($dashboard->jumlah_jadwal_pemasangan_lewat_tangal()>'0') {
    ?>
    <div class="col-md-12">
      <div class="box box-warning box-solid">
        <div class="box-header with-border">
          <a href="?page=page_jadwal_pemasangan"><h3 class="box-title">Ada <?php echo $dashboard->jumlah_jadwal_pemasangan_lewat_tangal();?> Pemasangan yang telah lewat jadwal</h3></a>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php
          foreach($dashboard->select_jadwal_pemasangan_lewat_tangal() as $data) {          
          ?>
          ~ <?php echo "<b>".$data['nama_user']."</b> (".date('m-d-Y', strtotime($data['tanggal_penjadwalan'])).")"; ?><br>
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
    <!-- /.col -->
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body no-padding">
          <!-- THE CALENDAR -->
          <div id="calendar"></div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /. box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid collapsed-box">
        <div class="box-header with-border">
          <h4 class="box-title">Data Teknisi</h4>
          <!-- tools box -->
            <div class="pull-right box-tools">
              <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-plus"></i></button>
              <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip"
                      title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
            <!-- /. tools -->
        </div>
        <div class="box-body">
          <!-- the events -->
          <div id="external-events">
          <?php
          foreach($select->select_data_teknisi_untuk_kalender() as $data) {
          ?>
          <div class="external-event ui-draggable ui-draggable-handle" style="background-color: <?php echo $data['ekstra'];?>; border-color: rgb(0, 31, 63); color: rgb(255, 255, 255); position: relative;"><?php echo $data['nama_user'];?></div>
          <?php
          }
          ?>
          </div>

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /. box -->
    </div>
  </div>
  <!-- /.row -->
</section>