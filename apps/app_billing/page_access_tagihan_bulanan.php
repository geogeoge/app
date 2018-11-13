<section class="content-header">
  <h1 class="">
    Data Tagihan
    <small>Per-User</small>
    <div class="tombol_tambah">
      <a href="#tambah_pembayaran" role="button"  data-target = "#tambah_pembayaran" data-toggle="modal" class="btn btn-primary">&nbsp;Transaksi Tidak Teridentifikasi</a>
    </div>
  </h1>
</section>
<?php include "modal_access_tambah_pembayaran_tidak_terdeteksi.php"; ?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel Data Tagihan</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th width="10">No</th>
              <th>User</th>
              <th>Tunggakan</th>
              <th>Nominal</th>
              <th>Sisa Pembayaran</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no=1;
            foreach($crud->select_tagihan() as $data) {
            $id_register=$data['id_register'];
            $id_paket=$data['id_paket'];
            $ip_publik=$data['ip_publik'];
            $tunggakan=$data['(sale_register.billing_bulan_berjalan-sale_register.billing_bulan_terbayar)'];
            $query_paket=mysqli_query($koneksi,"select * from sale_paket_internet where id_paket='$id_paket'");
            $tampil_paket=mysqli_fetch_array($query_paket);
            $harga=$tampil_paket['harga'];
            if($ip_publik=="IYA"){
              $harga=$harga+100000;
            }
            
            $nama_user = $data['nama_user'];
            $nama_instansi = $data['nama_instansi'];
            
            $nama = $nama_user;
            if(!($nama_instansi=="")){
                $nama = $nama_instansi." <b>(".$nama_user.")</b>";
                
            }
            
            $pecah_alamat=explode("#",$data['alamat']);
              $alamat = $pecah_alamat['0']." Rt. ".$pecah_alamat['1']."/".$pecah_alamat['2'].", ".$pecah_alamat['3'].", ".$pecah_alamat['4'].", ".$pecah_alamat['5'];
            
            $nominal_tunggakan=$harga*$tunggakan;
            ?>
            <tr>
              <td align="center" width="10"><?php echo $no; ?></td>
              <td align="left"><a href="#edit_download<?php echo $data['id_register']; ?>" role="button" data-target="#edit_download<?php echo $data['id_register']; ?>" data-toggle="modal"><font color="black"><?php echo $nama; ?></font></a></td>
              <td align="center"><?php echo $tunggakan; ?></td>
              <td align="right"><?php echo number_format($nominal_tunggakan,0,',','.'); ?></td>
              <td align="right"><?php echo number_format($data['billing_saldo'],0,',','.'); ?></td>
              <td width="200" align="center">
                <a href="?page=page_access_input_pembayaran_bulanan&id_register=<?php echo $id_register; ?>" class="btn btn-success"><i class="icon-trash icon-large"></i>&nbsp;Bayar</a>
                <a href="pdf_access_invoice_bulanan_baru.php?id_register=<?php echo $id_register; ?>" class="btn btn-info" target="_blank"><i class="fa fa-print"></i></a>
                <a href="pdf_access_invoice_bulanan.php?id_register=<?php echo $id_register; ?>" class="btn btn-default" target="_blank"><i class="fa fa-print"></i></a>
                <a href="#modal_input_komplen<?php echo $data['id_register']; ?>" role="button"  data-target = "#modal_input_komplen<?php echo $data['id_register']; ?>" data-toggle="modal" class="btn btn-warning"><i class="fa fa-warning"></i></a>
              </td>
            </tr>
          <?php
          include "modal_access_edit_data_user_download.php";
          include "modal_input_komplen.php";

          $no++;
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th width="10">No</th>
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

