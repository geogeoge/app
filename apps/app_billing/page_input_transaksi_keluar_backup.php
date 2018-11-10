<?php

?>
<section class="content-header">
  <h1>
    Data Kas Keluar
    <small>SoloNet</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">      
    <div class="col-md-12">
      <!-- Horizontal Form -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Form Input Transaksi Kas Keluar</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="POST" class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Keterangan</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="keterangan" rows="3"></textarea>  
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nominal</label>
              <div class="col-sm-10">
                <input type="text" id="inputku" class="form-control" name="bayar" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?php echo number_format($nominal_tunggakan,0,',','.');?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Via</label>
              <div class="col-sm-6">
                <select class="form-control" name="via" required="required">
                  <option selected="selected" disabled="disabled"></option>
                  <option>TUNAI</option>
                  <option>BCA</option>
                  <option>BNI</option>
                  <option>BRI</option>
                  <option>MANDIRI</option>
                  <option>BPD</option>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Tanggal</label>
              <div class="col-sm-2">
                <input type="date" id="inputku" class="form-control" name="tanggal" value="<?php echo date('Y-m-d'); ?>">
              </div>
            </div>
          </div>
          <?php include "modal_access_konfirmasi_input_kas_keluar.php"; ?>
          <!-- /.box-body -->
          <div class="box-footer">
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

?>