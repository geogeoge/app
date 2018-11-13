<section class="content-header">
  <h1>
    Data User
    <small>SoloNet</small>
    <div class="tombol_tambah">
      <a href="#tambah_user" role="button"  data-target = "#tambah_user" data-toggle="modal" class="btn btn-primary">&nbsp;Tambah User</a>
    </div>
  </h1>
</section>
<?php include "modal_tambah_data_user.php"; ?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel Data User</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Level</th>
              <th width="80" align="center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no="1";
            foreach($crud->select_user() as $data) {
            $username=$data['username'];
            if($data['level']==1) {
              $level="Administrator";
            } else {
              $level="Operator";
            }
            ?>
            <tr>
              <td width="10" align="center"><?php echo $no; ?></td>
              <td align="center"><?php echo $username; ?></td>
              <td align="center"><?php echo $level; ?></td>
              <td width="80" align="center">
                <a href="#hapus_data_user<?php echo $username; ?>" role="button"  data-target = "#hapus_data_user<?php echo $username;?>"data-toggle="modal" class="btn btn-danger"><i class="icon-trash icon-large"></i>&nbsp;Delete</a>
              </td>
              <?php
              include "modal_hapus_data_user.php";
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
              <th>Username</th>
              <th>Level</th>
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