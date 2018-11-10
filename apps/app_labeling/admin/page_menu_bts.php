<section class="content-header">
  <h1 class="">
    Data BTS
    <small>SoloNet</small>
    <div class="tombol_tambah">
      <a href="#tambah_bts" role="button"  data-target = "#tambah_bts" data-toggle="modal" class="btn btn-primary">&nbsp;Tambah BTS</a>
    </div>
  </h1>
</section>
<?php include "modal_tambah_data_bts.php"; ?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel Data BTS</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th width="10">ID</th>
              <th>Nama BTS</th>
              <th>Kode BTS</th>
              <th>Jumlah Lantai</th>
              <th>Alamat</th>
              <th>Koordinat</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($crud->select_bts() as $data) {
            $id_bts=$data['id'];
            ?>
            <tr>
              <td align="center"><?php echo $data['id']; ?></td>
              <td align="center"><?php echo $data['nama_gedung']; ?></td>
              <td align="center"><?php echo $data['kode_gedung']; ?></td>
              <td align="center"><?php echo $data['jumlah_lantai']; ?></td>
              <td><?php echo $data['alamat']; ?></td>
              <td align="center"><?php echo $data['koordinat']; ?></td>
              <td width="150" align="center">
                <a href="#hapus_data_bts<?php echo $id_bts; ?>" role="button"  data-target = "#hapus_data_bts<?php echo $id_bts;?>"data-toggle="modal" class="btn btn-danger"><i class="icon-trash icon-large"></i>&nbsp;Delete</a>
                <a href="#edit_data_bts<?php echo $id_bts; ?>" role="button"  data-target = "#edit_data_bts<?php echo $id_bts; ?>"data-toggle="modal" class="btn btn-success"><i class="icon-trash icon-large"></i>&nbsp;Edit</a>
              </td>
              <?php
              include "modal_edit_data_bts.php";
              include "modal_hapus_data_bts.php";
              ?>
            </tr>
          <?php
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>ID</th>
              <th>Nama BTS</th>
              <th>Kode BTS</th>
              <th>Jumlah Lantai</th>
              <th>Alamat</th>
              <th>Koordinat</th>
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

