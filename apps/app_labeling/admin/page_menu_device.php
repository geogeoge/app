<section class="content-header">
  <h1>
    Data Device
    <small>SoloNet</small>
    <div class="tombol_tambah">
      <a href="#tambah_device" role="button"  data-target = "#tambah_device" data-toggle="modal" class="btn btn-primary">&nbsp;Tambah Device</a>
    </div>
  </h1>
</section>
<?php include "modal_tambah_data_device.php"; ?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel Data Device</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID</th>
              <th>Nama Device</th>
              <th>Kode Device</th>
              <th>Jenis Device</th>
              <th>Type Device</th>
              <th>Jumlah Port</th>
              <th width="150" align="center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($crud->select_device() as $data) {
            $id_device=$data['id'];
            ?>
            <tr>
              <td width="10" align="center"><?php echo $data['id']; ?></td>
              <td align="left"><?php echo $data['nama_device']; ?></td>
              <td align="center"><?php echo $data['kode_device']; ?></td>
              <td align="center"><?php echo $data['jenis_device']; ?></td>
              <td align="center"><?php echo $data['type_device']; ?></td>
              <td align="center"><?php echo $data['jumlah_port']; ?></td>
              <td width="150" align="center">
                <a href="#hapus_data_device<?php echo $id_rak; ?>" role="button"  data-target = "#hapus_data_device<?php echo $id_device;?>"data-toggle="modal" class="btn btn-danger"><i class="icon-trash icon-large"></i>&nbsp;Delete</a>
                <a href="#edit_data_device<?php echo $id_rak; ?>" role="button"  data-target = "#edit_data_device<?php echo $id_device; ?>"data-toggle="modal" class="btn btn-success"><i class="icon-trash icon-large"></i>&nbsp;Edit</a>
              </td>
              <?php
              include "modal_edit_data_device.php";
              include "modal_hapus_data_device.php";
              ?>
            </tr>
          <?php
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>ID</th>
              <th>Nama Device</th>
              <th>Kode Device</th>
              <th>Jenis Device</th>
              <th>Type Device</th>
              <th>Jumlah Port</th>
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