<section class="content-header">
  <h1 class="">
    Data Pelanggan Khusus
    <small>SoloNet</small>
    <div class="tombol_tambah">
      <a href="?page=page_access_tambah_daftar_menu_tagihan_khusus" class="btn btn-primary"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;Tambah User</a>&nbsp;&nbsp;
    </div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel Data Pelanggan Khusus</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table  class="table table-bordered table-striped">
            <thead>
            <tr>
              <th width="10">No</th>
              <th>User</th>
              <th>Alamat</th>
              <th>Bulan Awal</th>
              <th>Periode</th>
              <th>Tagihan</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no=1;
            foreach($crud->select_register_menu_pelanggan_khusus() as $data) {
              $pecah_alamat=explode("#",$data['alamat']);
              $alamat = $pecah_alamat['0']." Rt. ".$pecah_alamat['1']."/".$pecah_alamat['2'].", ".$pecah_alamat['3'].", ".$pecah_alamat['4'].", ".$pecah_alamat['5'];
              $tunggakan = $data['billing_bulan_berjalan'] - $data['billing_bulan_terbayar'];

              $id_paket=$data['id_paket'];
              $query_paket = mysqli_query($koneksi,"select * from sale_paket_internet where id_paket='$id_paket'");
              $tampil_paket = mysqli_fetch_array($query_paket);
              $harga = $tampil_paket['harga'];

              $nominal_tunggakan = $tunggakan * $harga;
            ?>
            <tr>
              <td align="center" width="10"><?php echo $no; ?></td>
              <td align="left"><?php echo $data['nama_user']; ?></td>
              <td align="left"><?php echo $alamat; ?></td>
              <td align="center"><?php echo $data['pelanggan_khusus_bulan_awal']; ?></td>
              <td align="center"><?php echo $data['pelanggan_khusus_periode']; ?></td>
              <td align="right"><?php echo number_format($nominal_tunggakan,0,',','.'); ?></td>
              <td width="150" align="center">
                <a href="#edti<?php echo $data['id_register']; ?>" role="button" data-target="#edit<?php echo $data['id_register']; ?>" data-toggle="modal" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                <a href="#hapus<?php echo $data['id_register']; ?>" role="button" data-target="#hapus<?php echo $data['id_register']; ?>" data-toggle="modal" class="btn btn-danger"><i class="fa fa-close"></i></a>
              </td>
            </tr>
          <?php
          include "modal_access_konfirmasi_hapus_tagihan_khusus.php";
          include "modal_access_edit_tagihan_khusus.php";
          $no++;
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th width="10">No</th>
              <th>User</th>
              <th>Alamat</th>
              <th>Bulan Awal</th>
              <th>Periode</th>
              <th>Tagihan</th>
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

