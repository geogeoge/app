<div class="container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data User Non-Aktif
      <small>SoloNET</small>

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Tabel User Non-Aktif</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body scroll">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th width="100">Tanggal</th>
                <th>Nama User</th>
                <th>Alamat</th>
                <th>Telp</th>
                <th>Catatan</th>
              </tr>
              </thead>
              <tbody>
              <?php
              $no=1;
              foreach($select->select_data_user_hold() as $data) {
              $id_register=$data['id_register'];
              ?>
              <tr>
                <td align="center"><?php echo date('d-m-Y',strtotime($data['tanggal_hold'])); ?></td>
                <td align="left"><?php echo $data['nama_user']; ?></td>
                <td align="left"><?php echo $data['alamat']; ?></td>
                <td align="center"><?php echo $data['telp']; ?></td>
                <td align="left"><?php echo $data['catatan']; ?></td>
              </tr>
            <?php
            $no++;
            }
            ?>
              </tbody>
              <tfoot>
              <tr>
                <th>Tanggal</th>
                <th>Nama User</th>
                <th>Alamat</th>
                <th>Telp</th>
                <th>Catatan</th>
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
  <!-- /.content -->
</div>




























