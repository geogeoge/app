<?php
$id_register=$_GET['id_register'];
foreach($crud->select_tagihan_peruser($id_register) as $data) {
  $id_register=$data['id_register'];
  $id_paket=$data['id_paket'];
  $ip_publik=$data['ip_publik'];
  $tunggakan=$data['billing_bulan_berjalan']-$data['billing_bulan_terbayar'];
  $harga=$data['harga'];
  if($ip_publik=="IYA"){
    $harga=$harga+100000;
  }
  $nominal_tunggakan=$harga*$tunggakan;
  $nominal_tunggakan=$nominal_tunggakan-$data['billing_saldo'];
?>
<section class="content-header">
  <h1>
    Data Transaksi
    <small>Input</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">      
    <div class="col-md-12">
      <!-- Horizontal Form -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Form Input Transaksi Pembayaran</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="POST" class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nama User</label>
              <div class="col-sm-10">
                <input type="text" name="nana_user" class="form-control" id="inputPassword3" value="<?php echo $data['nama_user'];?>" readonly="readonly">
                <input type="text" name="id_register" hidden="hidden" id="inputPassword3" value="<?php echo $data['id_register'];?>"  readonly="readonly">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Via</label>
              <div class="col-sm-6">
                <select class="form-control" name="via" required="required">
                  <option selected="selected" disabled="disabled"></option>
                  <option value="1">TUNAI</option>
                  <option value="2">BCA</option>
                  <option value="3">BNI</option>
                  <option value="4">BRI</option>
                  <option value="5">MANDIRI</option>
                  <option value="6">BPD</option>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Tanggal</label>
              <div class="col-sm-2">
                <input type="date" id="inputku" class="form-control" name="tanggal" value="<?php echo date('Y-m-d'); ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nominal Bayar</label>
              <div class="col-sm-10">
                <input type="text" id="inputku" class="form-control" name="bayar" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?php echo number_format($nominal_tunggakan,0,',','.');?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Restitusi</label>
              <div class="col-sm-10">
                <input type="text" id="inputku" class="form-control" name="restitusi" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="0">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Catatan</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="catatan" rows="3"></textarea>  
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">&nbsp;</label>
              <div class="col-sm-10">
                <input type="checkbox" name="penagih" value="eko"> &nbsp;<label for="dewey">Pak Eko</label>&nbsp;&nbsp;&nbsp;  
              </div>
		    </div>
          </div>
          <?php include "modal_access_konfirmasi_pembayaran_tagihan_bulanan.php"; ?>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="?page=page_access_tagihan_bulanan" class="btn btn-default">Cancel</a>
            <a href="#konfirmasi_pembayaran" role="button"  data-target = "#konfirmasi_pembayaran" data-toggle="modal" class="btn btn-primary pull-right">Bayar</a>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<?php
}
?>