<section class="content-header">
  <h1>
    Data antena
    <small>SoloNet</small>
    <div class="tombol_tambah">
      <a href="#tambah_antena" role="button"  data-target = "#tambah_antena" data-toggle="modal" class="btn btn-primary">&nbsp;Tambah antena</a>
    </div>
  </h1>
</section>
<?php include "modal_tambah_data_antena.php"; ?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel antena antena</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Kode antena</th>
              <th>Nama antena</th>
              <th width="150" align="center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($select->select_data_antena() as $data) {
            $id_antena=$data['id_antena'];
            ?>
            <tr>
              <td width="100" align="center"><?php echo $data['id_antena']; ?></td>
              <td align="left"><?php echo $data['nama_antena']; ?></td>
              <td width="150" align="center">
                <a href="#hapus_data_antena<?php echo $id_antena; ?>" role="button"  data-target = "#hapus_data_antena<?php echo $id_antena;?>"data-toggle="modal" class="btn btn-danger"><i class="icon-trash icon-large"></i>&nbsp;Delete</a>
                <a href="#edit_data_antena<?php echo $id_antena; ?>" role="button"  data-target = "#edit_data_antena<?php echo $id_antena; ?>"data-toggle="modal" class="btn btn-success"><i class="icon-trash icon-large"></i>&nbsp;Edit</a>
              </td>
              <?php
              include "modal_edit_data_antena.php";
              include "modal_hapus_data_antena.php";
              ?>
            </tr>
          <?php
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>Kode antena</th>
              <th>Nama antena</th>
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