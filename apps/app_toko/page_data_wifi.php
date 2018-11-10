<section class="content-header">
  <h1>
    Data wifi
    <small>SoloNet</small>
    <div class="tombol_tambah">
      <a href="#tambah_wifi" role="button"  data-target = "#tambah_wifi" data-toggle="modal" class="btn btn-primary">&nbsp;Tambah wifi</a>
    </div>
  </h1>
</section>
<?php include "modal_tambah_data_wifi.php"; ?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel wifi wifi</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Kode wifi</th>
              <th>Nama wifi</th>
              <th width="150" align="center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($select->select_data_wifi() as $data) {
            $id_wifi=$data['id_wifi'];
            ?>
            <tr>
              <td width="100" align="center"><?php echo $data['id_wifi']; ?></td>
              <td align="left"><?php echo $data['nama_wifi']; ?></td>
              <td width="150" align="center">
                <a href="#hapus_data_wifi<?php echo $id_wifi; ?>" role="button"  data-target = "#hapus_data_wifi<?php echo $id_wifi;?>"data-toggle="modal" class="btn btn-danger"><i class="icon-trash icon-large"></i>&nbsp;Delete</a>
                <a href="#edit_data_wifi<?php echo $id_wifi; ?>" role="button"  data-target = "#edit_data_wifi<?php echo $id_wifi; ?>"data-toggle="modal" class="btn btn-success"><i class="icon-trash icon-large"></i>&nbsp;Edit</a>
              </td>
              <?php
              include "modal_edit_data_wifi.php";
              include "modal_hapus_data_wifi.php";
              ?>
            </tr>
          <?php
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>Kode wifi</th>
              <th>Nama wifi</th>
              <th width="150" align="center">Action</th>
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