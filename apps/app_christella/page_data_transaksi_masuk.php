<?php
//variable tanggal_hari_ini di dapat di halaman index
if(empty($_GET['tanggal'])) {
  $tanggal=$tanggal_hari_ini;
  $tanggal_awal=$tanggal;
  $tanggal_akhir=$tanggal;
  $nama_user="";
  $via="";
  $tampil_tanggal= date('d', strtotime($tanggal_awal))." ".$bulan_indonesia[date('m', strtotime($tanggal_awal))]." ".date('Y', strtotime($tanggal_awal));
}

if(isset($_GET['tanggal'])) {
  $tanggal=$_GET['tanggal'];
  $tanggal_awal=$tanggal;
  $tanggal_akhir=$tanggal;
  $nama_user="";
  $via="";
  $tampil_tanggal= date('d', strtotime($tanggal_awal))." ".$bulan_indonesia[date('m', strtotime($tanggal_awal))]." ".date('Y', strtotime($tanggal_awal));
}

if(isset($_GET['tanggal_awal'])) {
  $tanggal_awal=$_GET['tanggal_awal'];
  $tanggal_akhir=$_GET['tanggal_akhir'];
  $nama_user=$_GET['nama_user'];
  $via = $_GET['via'];
  $tampil_tanggal=date('d', strtotime($tanggal_awal))." ".$bulan_indonesia[date('m', strtotime($tanggal_awal))]." ".date('Y', strtotime($tanggal_awal))." - ".date('d', strtotime($tanggal_akhir))." ".$bulan_indonesia[date('m', strtotime($tanggal_akhir))]." ".date('Y', strtotime($tanggal_akhir));

  if($via=="") {
    $semua="selected='selected'";
    $bca="";
    $bni="";
    $bri="";
    $mandiri="";
    $bpd="";
    $tunai="";
  }
  if($via=="BCA") {
    $semua="";
    $bca="selected='selected'";
    $bni="";
    $bri="";
    $mandiri="";
    $bpd="";
    $tunai="";
  }
  if($via=="BNI") {
    $semua="";
    $bca="";
    $bni="selected='selected'";
    $bri="";
    $mandiri="";
    $bpd="";
    $tunai="";
  }
  if($via=="BRI") {
    $semua="";
    $bca="";
    $bni="";
    $bri="selected='selected'";
    $mandiri="";
    $bpd="";
    $tunai="";
  }
  if($via=="MANDIRI") {
    $semua="";
    $bca="";
    $bni="";
    $bri="";
    $mandiri="selected='selected'";
    $bpd="";
    $tunai="";
  }
  if($via=="BPD") {
    $semua="";
    $bca="";
    $bni="";
    $bri="";
    $mandiri="";
    $bpd="selected='selected'";
    $tunai="";
  }
  if($via=="TUNAI") {
    $semua="";
    $bca="";
    $bni="";
    $bri="";
    $mandiri="";
    $bpd="";
    $tunai="selected='selected'";
  }
}


?>
<section class="content-header">
  <h1 class="">
    Data Transaksi
    <small>Tagihan</small>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Transaksi Tanggal : <strong><?php echo $tampil_tanggal ?> </strong></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
              <div class="col-sm-6"></div>
              <div class="col-sm-6"></div>
            </div>

            <!-- Bagian Pencarian -->
            <div class="row">
              <form method="GET" action="?page=page_data_transaksi_masuk">
              <div class="col-sm-4">
                
              </div>
              <div class="col-sm-8">
                <div id="example1_filter" class="dataTables_filter">

                  <label>
                    Tanggal :
                    <input type="date" name="tanggal_awal" class="form-control input-sm" value="<?php echo $tanggal_awal;?>">
                    &nbsp
                    s/d
                    <input type="date" name="tanggal_akhir" class="form-control input-sm" value="<?php echo $tanggal_akhir;?>">
                  </label>
                  &nbsp
                  <label>
                    VIA :
                    <select name="via" aria-controls="example1" class="form-control input-sm">
                      <option <?php echo $semua;?>></option>
                      <option <?php echo $tunai;?>>TUNAI</option>
                      <option <?php echo $bca;?>>BCA</option>
                      <option <?php echo $bni;?>>BNI</option>
                      <option <?php echo $bri;?>>BRI</option>
                      <option <?php echo $mandiri;?>>MANDIRI</option>
                      <option <?php echo $bpd;?>>BPD</option>
                    </select> 
                  </label>
                  &nbsp
                  </label>
                  <label>
                    Nama :
                    <input type="search" name="nama_user" class="form-control input-sm" value="<?php echo $nama_user;?>">
                    &nbsp
                    <button name="page" value="page_data_transaksi_masuk" class="form-control input-sm"><i class="fa fa-search"></i></button>
                  </label>

                </div>
              </div>
              </form>
            </div>

            <!-- body table -->
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                  <thead>
                    <tr>
                      <th width="10">Waktu</th>
                      <th>User</th>
                      <th>Keterangan</th>
                      <th>Via</th>
                      <th>Restitusi</th>
                      <th>Nominal</th>
                      <th width="10">Action</th>
                      <!--
                      <th>Action</th>
                      -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $total=0;
                    foreach($crud->select_log_pembayaran_perhari($tanggal_awal,$tanggal_akhir,$via,$nama_user) as $data) {
                      $no=$data['no'];
                      
                      $kode_keterangan=$data['keterangan'];
                      if($kode_keterangan=="A"){
                        $keterangan="Tagihan bulanan access";
                      }
                      if($kode_keterangan=="B"){
                        $keterangan="Tagihan user baru";
                      }
                      ?>
                    <tr>
                      <td align="center" width="100"><?php echo date('d-m-Y',strtotime($data['waktu_pembayaran']))."<br>".date('H:i',strtotime($data['waktu_pembayaran'])); ?></td>
                      <td align="left"><?php echo $data['nama_user']; ?></td>
                      <td align="left"><?php echo $keterangan; ?></td>
                      <td align="center"><?php echo $data['via']; ?></td>
                      <td align="right"><a href="#data_catatan<?php echo $no; ?>" role="button"  data-target = "#data_catatan<?php echo $no; ?>" data-toggle="modal"><font color="black"><?php echo number_format($data['restitusi'],0,',','.'); ?></font></a></td>
                      <td align="right"><?php echo number_format($data['bayar'],0,',','.'); ?></td>
                      <td align="center"><a href="#konfirmasi_pembayaran<?php echo $no; ?>" role="button"  data-target = "#konfirmasi_pembayaran<?php echo $no; ?>" data-toggle="modal" class="btn btn-danger">Cancel</a></td>
                    </tr>
                    <?php
                      $total=$total+$data['bayar'];
                      include "modal_access_data_catatan_transaksi.php";
                      include "modal_access_konfirmasi_cancel_transaksi.php";
                    }
                    //ini tampil jika masih blm ada transaksi
                    if(empty($crud->select_log_pembayaran_perhari($tanggal_awal,$tanggal_akhir,$via,$nama_user))) {
                      ?>
                      <tr class="odd">
                        <td valign="top" colspan="6" class="dataTables_empty">Maaf, Tidak Ada Transaksi Hari Ini Mbak/Mas !</td>
                      </tr>
                      <?php
                    } else {
                      ?>
                      <tr>
                        <td colspan="5"><strong>Total transaksi hari ini</strong></td>
                        <td align="right" width="100"><strong><?php echo number_format($total,0,',','.'); ?></strong></td>
                        <td></td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Pageination -->
            <div class="row">
              <div class="col-sm-5">
                <div class="dataTables_info" id="example2_info" role="status" aria-live="polite"></div>
              </div>
              <div class="col-sm-7">
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                  <ul class="pagination">
                    <?php
                    $bulan_ini=date('Y-m', strtotime($tanggal_hari_ini));
                    $tanggal_page=$bulan_ini."-01";
                    ?>
                    <li class="paginate_button previous" id="example2_previous"><a href="?page=page_data_transaksi_masuk&tanggal=<?php echo $tanggal_page?>" aria-controls="example2" data-dt-idx="0" tabindex="0">Awal Bulan</a></li>
                    <?php
                    //agar tnaggal paginatin rapi
                    $tanggal_hari_ini_kurangi_6=date('Y-m-d', strtotime('-5 days', strtotime($tanggal_hari_ini)));
                    if($tanggal>=$tanggal_hari_ini_kurangi_6){

                      $tanggal_page=date('Y-m-d', strtotime('-6 days', strtotime($tanggal_hari_ini)));
                      for ($i= 1; $i <= 7; $i++) {
                        
                        $tanggal_tok=date('d', strtotime($tanggal_page));
                        if($tanggal==$tanggal_page) {
                          $active="active";
                        } else {
                          $active="";
                        }
                        ?>
                        <li class="paginate_button <?php echo $active; ?>"><a href="?page=page_data_transaksi_masuk&tanggal=<?php echo $tanggal_page; ?>" aria-controls="example2" data-dt-idx="1" tabindex="0"><?php echo $tanggal_tok; ?></a></li>
                        <?php
                        $tanggal_page=date('Y-m-d', strtotime('+1 days', strtotime($tanggal_page)));
                      }
                      
                    } else {

                      $tanggal_page=date('Y-m-d', strtotime('-3 days', strtotime($tanggal)));
                      for ($i= 1; $i <= 7; $i++) {
                        $tanggal_tok=date('d', strtotime($tanggal_page));
                        if($tanggal==$tanggal_page) {
                          $active="active";
                        } else {
                          $active="";
                        }
                        ?>
                        <li class="paginate_button <?php echo $active; ?>"><a href="?page=page_data_transaksi_masuk&tanggal=<?php echo $tanggal_page; ?>" aria-controls="example2" data-dt-idx="1" tabindex="0"><?php echo $tanggal_tok; ?></a></li>
                        <?php
                        $tanggal_page=date('Y-m-d', strtotime('+1 days', strtotime($tanggal_page)));
                      }

                    }
                    ?>

                    <li class="paginate_button next" id="example2_next"><a href="?page=page_data_transaksi_masuk&tanggal=<?php echo $tanggal_hari_ini; ?>" aria-controls="example2" data-dt-idx="7" tabindex="0">Hari Ini</a></li>
                  </ul>
                </div>
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

