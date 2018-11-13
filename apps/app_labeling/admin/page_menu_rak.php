<section class="content-header">
  <h1>
    Data Rak
    <small>SoloNet</small>
    <div class="tombol_tambah">
      <a href="#tambah_rak" role="button"  data-target = "#tambah_rak" data-toggle="modal" class="btn btn-primary">&nbsp;Tambah Rak</a>
    </div>
  </h1>
</section>
<?php include "modal_tambah_data_rak.php"; ?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel Rak Rak</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID</th>
              <th>Nama Rak</th>
              <th>Kode Rak</th>
              <th>Jumlah Unit</th>
              <th>Jenis Rak</th>
              <th width="150" align="center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($crud->select_rak() as $data) {
            $id_rak=$data['id'];
            ?>
            <tr>
              <td width="10" align="center"><?php echo $data['id']; ?></td>
              <td align="left"><?php echo $data['nama_rak']; ?></td>
              <td align="center"><?php echo $data['kode_rak']; ?></td>
              <td align="center"><?php echo $data['jumlah_unit']; ?></td>
              <td align="center"><?php echo $data['jenis_rak']; ?></td>
              <td width="150" align="center">
                <a href="#hapus_data_rak<?php echo $id_rak; ?>" role="button"  data-target = "#hapus_data_rak<?php echo $id_rak;?>"data-toggle="modal" class="btn btn-danger"><i class="icon-trash icon-large"></i>&nbsp;Delete</a>
                <a href="#edit_data_rak<?php echo $id_rak; ?>" role="button"  data-target = "#edit_data_rak<?php echo $id_rak; ?>"data-toggle="modal" class="btn btn-success"><i class="icon-trash icon-large"></i>&nbsp;Edit</a>
              </td>
              <?php
              include "modal_edit_data_rak.php";
              include "modal_hapus_data_rak.php";
              ?>
            </tr>
          <?php
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>ID</th>
              <th>Nama Rak</th>
              <th>Kode Rak</th>
              <th>Jumlah Unit</th>
              <th>Jenis Rak</th>
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