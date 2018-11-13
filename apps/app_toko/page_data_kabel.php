<section class="content-header">
  <h1>
    Data kabel
    <small>SoloNet</small>
    <div class="tombol_tambah">
      <a href="#tambah_kabel" role="button"  data-target = "#tambah_kabel" data-toggle="modal" class="btn btn-primary">&nbsp;Tambah kabel</a>
    </div>
  </h1>
</section>
<?php include "modal_tambah_data_kabel.php"; ?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel kabel kabel</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Kode kabel</th>
              <th>Nama kabel</th>
              <th width="150" align="center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($select->select_data_kabel() as $data) {
            $id_kabel=$data['id_kabel'];
            ?>
            <tr>
              <td width="100" align="center"><?php echo $data['id_kabel']; ?></td>
              <td align="left"><?php echo $data['nama_kabel']; ?></td>
              <td width="150" align="center">
                <a href="#hapus_data_kabel<?php echo $id_kabel; ?>" role="button"  data-target = "#hapus_data_kabel<?php echo $id_kabel;?>"data-toggle="modal" class="btn btn-danger"><i class="icon-trash icon-large"></i>&nbsp;Delete</a>
                <a href="#edit_data_kabel<?php echo $id_kabel; ?>" role="button"  data-target = "#edit_data_kabel<?php echo $id_kabel; ?>"data-toggle="modal" class="btn btn-success"><i class="icon-trash icon-large"></i>&nbsp;Edit</a>
              </td>
              <?php
              include "modal_edit_data_kabel.php";
              include "modal_hapus_data_kabel.php";
              ?>
            </tr>
          <?php
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>Kode kabel</th>
              <th>Nama kabel</th>
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