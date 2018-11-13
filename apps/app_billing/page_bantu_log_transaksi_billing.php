<?php

$isi_data = "";
if(isset($_GET['isi_data'])){
  $isi_data = $_GET['isi_data'];
}

?>
<section class="content-header">
  <h1>
    <strong>Transaksi Pengeluaran Rutin Billing Solonet</strong>
    <small>
      SoloNet
    </small>
    <div class="tombol_tambah">
      <a href="#modal_kas_keluar_rutin" role="button"  data-target = "#modal_kas_keluar_rutin" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Transaksi</a>
    </div>
  </h1>
</section>
<!-- Main content -->
<?php
include "modal_kas_masuk_rutin.php";
include "modal_kas_keluar_rutin.php";
?>

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
                  <label>
                    &nbsp;&nbsp;
                  </label>
              </div>
              <div class="col-sm-10">
                <div id="example1_filter" class="dataTables_filter">

                    &nbsp;&nbsp;
                  <label>
                    Data :
                  </label>
                  <label>
                    <input type="search" name="isi_data" class="form-control input-sm" value="<?php echo $isi_data;?>">
                  </label>
                  &nbsp
                  <label>
                    <button name="page" value="page_log_transaksi_billing" class="btn"><i class="fa fa-search"></i></button>
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
                      <th>No</th>
                      <th>Keterangan</th>
                      <th width="150">Nominal</th>
                      <th width="100">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                     foreach ($select->select_data_transaksi_rutin($isi_data) as $data) {
                    ?>
                    <tr>
                      <td align="center"><?php echo $no; ?></td>
                      <td align="left"><?php echo $data['keterangan']; ?></td>
                      <td align="left" hidden="hidden"><input type="text" id="inputku" class="form-control" name=keterangan[] value="<?php echo $data['keterangan']; ?>"></td>
                      <td align="center"><input type="text" id="inputku" class="form-control" name=nominal[] onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?php echo number_format($nominal_tunggakan,0,',','.');?>"></td>
                      <td align="center">
                        <a href="#modal_edit<?php echo $data['id_bantu_log_pembayaran_rutin']; ?>" role="button"  data-target = "#modal_edit<?php echo $data['id_bantu_log_pembayaran_rutin'];?>" data-toggle="modal" class="btn btn-xs btn-warning">&nbsp;<i class="fa fa-edit"></i>&nbsp;</a>
                        <a href="#modal_hapus<?php echo $data['id_bantu_log_pembayaran_rutin']; ?>" role="button"  data-target = "#modal_hapus<?php echo $data['id_bantu_log_pembayaran_rutin'];?>" data-toggle="modal" class="btn btn-xs btn-danger">&nbsp;<i class="fa fa-close"></i>&nbsp;</a>
                      </td>
                    </tr>
                    <?php
                      include "modal_edit_transaksi_rutin.php";
                      include "modal_konfirmasi_hapus.php";
                      $no++;
                    }
                    //ini tampil jika masih blm ada transaksi
                    if(!($select->select_data_transaksi_rutin($isi_data))) {
                      ?>
                      <tr class="odd">
                        <td valign="top" colspan="6" align="center" class="dataTables_empty">Maaf, Tidak ada data !</td>
                      </tr>
                      <?php
                    } else {
                      ?>
                      <tr>
                        <td colspan="4" align="right">
                        <a href="#konfirmasi" role="button"  data-target = "#konfirmasi" data-toggle="modal" class="btn btn-primary">POSTING</a>
                        </td>
                      </tr>
                      <?php
                      include "modal_konfirmasi_transaksi_rutin.php";
                    }
                    ?>
                  </tbody>
                </table>
              </form>
              </div>
            </div>

            <!-- Pageination -->
            <div class="row">
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

<?php include "modal_alert_saldo.php";?>