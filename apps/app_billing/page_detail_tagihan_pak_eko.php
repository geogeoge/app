<?php

$tanggal_awal = date('Y-m-')."01";
if(isset($_GET['tanggal_awal'])){
  $tanggal_awal = $_GET['tanggal_awal'];
}

$tanggal_akhir = date('Y-m-d');
if(isset($_GET['tanggal_akhir'])){
  $tanggal_akhir = $_GET['tanggal_akhir'];
}

?>
<section class="content-header">
  <h1>
    <strong>Data Tagihan Pak Eko</strong>
    <small>
      SoloNet
    </small>
    <div class="tombol_tambah">
      <a href="?page=page_log_transaksi_billing" class="btn btn-primary"><i class="fa fa-prev"></i>&nbsp;&nbsp;Kembali</a>
    </div>
  </h1>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body scroll">
          <div class="dataTables_wrapper dt-bootstrap">
            <div class="row">
              <div class="col-sm-6"></div>
              <div class="col-sm-6"></div>
            </div>

            <!-- Bagian Pencarian -->
            <div class="row">
              <form method="GET" action="?page=page_data_pelanggan">
              <div class="col-sm-2">
              </div>
              <div class="col-sm-10">
                <div id="example1_filter" class="dataTables_filter">

                  &nbsp;
                  <label>
                    Tanggal :
                    <input type="date" name="tanggal_awal" class="form-control input-sm" value="<?php echo $tanggal_awal;?>">
                    &nbsp; S/D
                    <input type="date" name="tanggal_akhir" class="form-control input-sm" value="<?php echo $tanggal_akhir;?>">
                  </label>
                    &nbsp;&nbsp;
                  <label>
                    <button name="page" value="page_detail_tagihan_pak_eko" class="btn"><i class="fa fa-search"></i></button>
                  </label>

                </div>
              </div>
              </form>
            </div>

            <!-- body table -->
            <div class="row">
              <div class="col-sm-12">
              <form method="POST">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="80">No</th>
                      <th>Jenis Tagihan</th>
                      <th width="100">Jumlah</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td align="center">1</td>
                      <td align="left">Tagihan Internet</td>
                      <td align="center"><a href="?data_yang_dicari=Pembayaran+Internet+&tanggal_awal=<?php echo $tanggal_awal;?>&tanggal_akhir=<?php echo $tanggal_akhir;?>&page=page_tampil_detail_tagihan_pak_eko" style="color: black;"><?php echo $select->select_data_temp_tagihan_pak_eko($tanggal_awal, $tanggal_akhir, 'Pembayaran Internet '); ?></a></td>
                    </tr>
                    <tr>
                      <td align="center">2</td>
                      <td align="left">Tagihan Dial Up</td>
                      <td align="center"><a href="?data_yang_dicari=Pembayaran+Dial+Up+&tanggal_awal=<?php echo $tanggal_awal;?>&tanggal_akhir=<?php echo $tanggal_akhir;?>&page=page_tampil_detail_tagihan_pak_eko" style="color: black;"><?php echo $select->select_data_temp_tagihan_pak_eko($tanggal_awal, $tanggal_akhir, 'Pembayaran Dial Up '); ?></a></td>
                    </tr>
                    <tr>
                      <td align="center">3</td>
                      <td align="left">Tagihan User Baru</td>
                      <td align="center"><a href="?data_yang_dicari=Pembayaran+User+Baru+&tanggal_awal=<?php echo $tanggal_awal;?>&tanggal_akhir=<?php echo $tanggal_akhir;?>&page=page_tampil_detail_tagihan_pak_eko" style="color: black;"><?php echo $select->select_data_temp_tagihan_pak_eko($tanggal_awal, $tanggal_akhir, 'Registrasi User Baru '); ?></a></td>
                    </tr>
                    <tr>
                      <td align="center">4</td>
                      <td align="left">Tagihan Web & Hosting</td>
                      <td align="center"><a href="?data_yang_dicari=Pembayaran+WEB+&tanggal_awal=<?php echo $tanggal_awal;?>&tanggal_akhir=<?php echo $tanggal_akhir;?>&page=page_tampil_detail_tagihan_pak_eko" style="color: black;"><?php echo $select->select_data_temp_tagihan_pak_eko($tanggal_awal, $tanggal_akhir, 'Pembayaran WEB & Hosting '); ?></a></td>
                    </tr>
                  </tbody>
                </table>
              </form>
              </div>
            </div>
            
            
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

