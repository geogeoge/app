<section class="content-header">
  <h1 class="">
    Proses Re-Closing User
    <small>SoloNet</small>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel User Hold</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Nama User</th>
              <th>Alamat</th>
              <th>Telp</th>
              <th>Catatan</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no=1;
            foreach($crud->select_data_user_hold() as $data) {
            $id_register=$data['id_register'];
            ?>
            <tr>
              <td align="center"><?php echo $no; ?></td>
              <td align="left"><?php echo date("d-m-Y", strtotime($data['tanggal_hold'])); ?></td>
              <td align="left"><?php echo $data['nama_user']; ?></td>
              <td align="left"><?php echo $data['alamat']; ?></td>
              <td align="center"><?php echo $data['telp']; ?></td>
              <td align="center"><?php echo $data['catatan']; ?></td>
              <td width="80" align="center">
                <a href="?page=page_reclose&id_register=<?php echo $data['id_register']; ?>" class="btn btn-info"><i class="icon-trash icon-large"></i>&nbsp;Re-Close</a>
              </td>
            </tr>
          <?php
          $no++;
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>User</th>
              <th>Tunggakan</th>
              <th>Nominal</th>
              <th>Sisa Pembayaran</th>
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

