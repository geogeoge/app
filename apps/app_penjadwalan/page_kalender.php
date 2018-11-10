<section class="content-header">
  <h1>
    Jadwal Pemasangan Dan Maintenance
    <small>SoloNet</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">

  <div class="col-md-3">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h4 class="box-title">Data Teknisi</h4>
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

    <!-- /.col -->
    <div class="col-md-9">
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
</section>
<!-- /.content -->
