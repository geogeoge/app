<section class="content-header">
  <h1>
    Data Room
    <small>SoloNet</small>
    <div class="tombol_tambah">
      <a href="#tambah_room" role="button"  data-target = "#tambah_room" data-toggle="modal" class="btn btn-primary">&nbsp;Tambah Room</a>
    </div>
  </h1>
</section>
<?php include "modal_tambah_data_room.php"; ?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel Data Room</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID</th>
              <th>Nama BTS</th>
              <th>Kode BTS</th>
              <th width="150" align="center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($crud->select_ruang() as $data) {
            $id_ruang=$data['id'];
            ?>
            <tr>
              <td width="10" align="center"><?php echo $data['id']; ?></td>
              <td align="center"><?php echo $data['nama_ruang']; ?></td>
              <td align="center"><?php echo $data['kode_ruang']; ?></td>
              <td width="150" align="center">
                <a href="#hapus_data_ruang<?php echo $id_ruang; ?>" role="button"  data-target = "#hapus_data_ruang<?php echo $id_ruang;?>"data-toggle="modal" class="btn btn-danger"><i class="icon-trash icon-large"></i>&nbsp;Delete</a>
                <a href="#edit_data_ruang<?php echo $id_ruang; ?>" role="button"  data-target = "#edit_data_ruang<?php echo $id_ruang; ?>"data-toggle="modal" class="btn btn-success"><i class="icon-trash icon-large"></i>&nbsp;Edit</a>
              </td>
              <?php
              include "modal_edit_data_room.php";
              include "modal_hapus_data_room.php";
              ?>
            </tr>
          <?php
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>ID</th>
              <th>Nama Room</th>
              <th>Kode Room</th>
              <th>Action</th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>