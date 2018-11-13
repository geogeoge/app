<section class="content-header">
  <h1>
    Data Permintaan Alat
    <small>SoloNet</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel Permintaan Alat</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Tanggal Order</th>
              <th>No Nota</th>
              <th>ID User</th>
              <th>Nama User</th>
              <th>Alamat</th>
              <th>Kontak</th>
              <th>Marketing</th>
              <th>Teknisi</th>
              <th>Status</th>
              <th>Edit</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($select->select_data_permintaan_alat() as $data) {
              $pecah_alamat = explode("#", $data['alamat']);
              $alamat = $pecah_alamat['0']." RT. ".$pecah_alamat['1']."/".$pecah_alamat['2'].", ".$pecah_alamat['3'].", ".$pecah_alamat['4'].", ".$pecah_alamat['5'].", ".$pecah_alamat['6'];

              $id_marketing = $data['id_marketing'];
              $query_marketing = mysqli_query($koneksi,"select * from master_login where id_user='$id_marketing'");
              $data_marketing = mysqli_fetch_array($query_marketing);

              $id_teknisi = $data['id_teknisi'];
              $query_teknisi = mysqli_query($koneksi,"select * from master_login where id_user='$id_teknisi'");
              $data_teknisi = mysqli_fetch_array($query_teknisi);

              $status = $data['status'];
              if($status=="Close" or $status=="Hold"){
                $status = "Lunas";
              }
            ?>
            <tr>
              <td width="10" align="center"><?php echo date('d-m-Y', strtotime($data['tanggal_order_alat'])); ?></td>
              <td width="100" align="center"><?php echo $data['no_nota']; ?></td>
              <td width="10" align="center"><?php echo $data['id_register']; ?></td>
              <td align="left"><?php echo $data['nama_user']; ?></td>
              <td align="left"><?php echo $alamat; ?></td>
              <td align="center"><?php echo $data['telp']; ?></td>
              <td align="center"><?php echo $data_marketing['nama_user']; ?></td>
              <td align="center"><?php echo $data_teknisi['nama_user']; ?></td>
              <td align="center"><?php echo $status; ?></td>
              <td width="50" align="center">
                <a href="?page=page_menyiapkan_alat&id_register=<?php echo $data['id_register']; ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
              </td>
            </tr>
          <?php
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>Tanggal Order</th>
              <th>No Nota</th>
              <th>ID User</th>
              <th>Nama User</th>
              <th>Alamat</th>
              <th>Kontak</th>
              <th>Marketing</th>
              <th>Teknisi</th>
              <th>Status</th>
              <th>Edit</th>
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