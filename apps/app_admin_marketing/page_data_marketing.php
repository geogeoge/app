<?php
$query = mysqli_query($koneksi,"select * from master_login where level='MARKETING' order by id_user DESC limit 1");
$tampil = mysqli_fetch_array($query);
$id_terakir=$tampil['id_user'];
$id_terakir++;
?>
<section class="content-header">
  <h1>
    Data Marketing
    <small>SoloNet</small>
    <div class="tombol_tambah">
      <a href="#tambah_data_marketing" role="button"  data-target = "#tambah_data_marketing" data-toggle="modal" class="btn btn-primary">&nbsp;Tambah Marketing</a>
    </div>
  </h1>
</section>
<?php include "modal_tambah_data_marketing.php"; ?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel Data Marketing</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID Marketing</th>
              <th>Nama Marketing</th>
              <th>Username</th>
              <th>Level</th>
              <th width="80" align="center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no="1";
            foreach($data_marketing->select_data_marketing() as $data) {
              $id_data_marketing=$data['id_user'];
            ?>
            <tr>
              <td width="100" align="center"><?php echo $data['id_user']; ?></td>
              <td align="left"><?php echo $data['nama_user']; ?></td>
              <td align="center"><?php echo $data['username']; ?></td>
              <td align="center"><?php echo $data['level']; ?></td>
              <td width="150" align="center">
                <a href="#edit_data_data_marketing<?php echo $id_data_marketing; ?>" role="button"  data-target = "#edit_data_data_marketing<?php echo $id_data_marketing;?>"data-toggle="modal" class="btn btn-info"><i class="icon-trash icon-large"></i>&nbsp;Edit</a>
                <a href="#hapus_data_data_marketing<?php echo $id_data_marketing; ?>" role="button"  data-target = "#hapus_data_data_marketing<?php echo $id_data_marketing;?>"data-toggle="modal" class="btn btn-danger"><i class="icon-trash icon-large"></i>&nbsp;Delete</a>
              </td>
              <?php
              include "modal_hapus_data_marketing.php";
              include "modal_edit_data_marketing.php";
              $no++;
              ?>
            </tr>
          <?php
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Username</th>
              <th width="80" align="center">Action</th>
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