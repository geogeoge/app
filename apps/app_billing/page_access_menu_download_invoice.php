<section class="content-header">
  <h1 class="">
    Data Yang Akan Didownload
    <small>Per-User</small>
    <div class="tombol_tambah">
      <a href="?page=page_access_tambah_daftar_menu_download_invoice" class="btn btn-primary"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;Tambah User</a>&nbsp;&nbsp;
    </div>
  </h1>
</section>

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
          <table  class="table table-bordered table-striped">
            <thead>
            <tr>
              <th width="10">No</th>
              <th>User</th>
              <th>Alamat</th>
              <th>Marketing</th>
              <th>Tungakan</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no=1;
            foreach($crud->select_register_menu_download_invoice() as $data) {
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
              <td align="center"><?php echo $data['nama_marketing']; ?></td>
              <td align="center"><?php echo number_format($nominal_tunggakan,0,',','.'); ?></td>
              <td width="150" align="center">
                <a href="pdf_access_invoice_bulanan_baru.php?id_register=<?php echo $data['id_register']; ?>" class="btn btn-success" target="_blank"><i class="fa fa-download"></i></a>
                <a href="#edit_download<?php echo $data['id_register']; ?>" role="button" data-target="#edit_download<?php echo $data['id_register']; ?>" data-toggle="modal" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                <a href="#hapus_download<?php echo $data['id_register']; ?>" role="button" data-target="#hapus_download<?php echo $data['id_register']; ?>" data-toggle="modal" class="btn btn-danger"><i class="fa fa-close"></i></a>
              </td>
            </tr>
          <?php
          include "modal_access_konfirmasi_hapus_menu_download_invoice.php";
          include "modal_access_edit_data_user_download.php";
          $no++;
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th width="10">No</th>
              <th>User</th>
              <th>Alamat</th>
              <th>Marketing</th>
              <th>Tunggakan</th>
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

