<?php

$tanggal_hari_ini = date('Y-m-d');


$tanggal_awal = date('Y-m-d');
if(isset($_GET['tanggal_awal'])){
  $tanggal_awal = $_GET['tanggal_awal'];
}

$tanggal_akhir = date('Y-m-d');
if(isset($_GET['tanggal_akhir'])){
  $tanggal_akhir = $_GET['tanggal_akhir'];
}

$data_yang_dicari = "";
if(isset($_GET['data_yang_dicari'])){
  $data_yang_dicari = $_GET['data_yang_dicari'];
}


?>
<section class="content-header">
  <h1>
    <strong>Tampil Data </strong>
    <small>
      SoloNet
    </small>
    <div class="tombol_tambah">
        <a href="?tanggal_awal=<?php echo $tanggal_awal;?>&tanggal_akhir=<?php echo $tanggal_akhir;?>&page=page_detail_tagihan_pak_eko" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp;&nbsp;Kembali</a>
    </div>
  </h1>
</section>
<!-- Main content -->

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
                    
                  </label>
              </div>
              <div class="col-sm-10">
                <div id="example1_filter" class="dataTables_filter">

                  <label>
                    Data Tagihan :
                  </label>
                  &nbsp;
                  <label>
                    <select name="data_yang_dicari" class="form-control input-sm">
                      <?php
                      if($data_yang_dicari==""){
                        $selected_semua='selected="selected"';
                        $selected_1='';
                        $selected_2='';
                        $selected_3='';
                        $selected_4='';
                      } else if($data_yang_dicari=="Pembayaran Internet "){
                        $selected_semua='';
                        $selected_1='selected="selected"';
                        $selected_2='';
                        $selected_3='';
                        $selected_4='';
                      } else 
                      if($data_yang_dicari=="Pembayaran Dial Up "){
                        $selected_semua='';
                        $selected_1='';
                        $selected_2='selected="selected"';
                        $selected_3='';
                        $selected_4='';
                      } else
                      if($data_yang_dicari=="Pembayaran User Baru "){
                        $selected_semua='';
                        $selected_1='';
                        $selected_2='';
                        $selected_3='selected="selected"';
                        $selected_4='';
                      } else
                      if($data_yang_dicari=="Pembayaran WEB "){
                        $selected_semua='';
                        $selected_1='';
                        $selected_2='';
                        $selected_3='';
                        $selected_4='selected="selected"';
                      }
                      ?>
                      <option value="" <?php echo $selected_semua;?>>Semua</option>
                      <option value="Pembayaran Internet " <?php echo $selected_1;?>>Internet</option>
                      <option value="Pembayaran Dial Up " <?php echo $selected_2;?>>Dial Up</option>
                      <option value="Pembayaran User Baru " <?php echo $selected_3;?>>User Baru</option>
                      <option value="Pembayaran WEB " <?php echo $selected_4;?>>WEB & Hosting</option>
                    </select> 
                  </label>
                  &nbsp;
                  <label>
                    Tanggal :
                    <input type="date" name="tanggal_awal" class="form-control input-sm" value="<?php echo $tanggal_awal;?>">
                    &nbsp; S/D
                    <input type="date" name="tanggal_akhir" class="form-control input-sm" value="<?php echo $tanggal_akhir;?>">
                  </label>
                    &nbsp;&nbsp;
                  <label>
                    <button name="page" value="page_tampil_detail_tagihan_pak_eko" class="btn"><i class="fa fa-search"></i></button>
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
                      <th width="150">Tanggal</th>
                      <th>Keterangan</th>
                      <th width="150">Debit</th>
                      <th width="150">Kredit</th>
                      <th width="150">Via</th>
                      <th width="80">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                     foreach ($select->select_detail_data_temp_where($tanggal_awal, $tanggal_akhir, $data_yang_dicari) as $data) {
                        $in_out=$data['in_out'];
                        $id_account=$data['id_account'];
                        $keterangan = $data['keterangan'];
                        $pecah_ketarangan_pak_eko = explode("| Pak Eko", $keterangan);
                        $pecah_keterangan_kedua = explode("|", $keterangan);
                        
                        //-------------------\\
                        $pecah_keterangan_1 = explode("(", $keterangan);
                	    $pecah_keterangan_2 = explode(")", $pecah_keterangan_1['1']);
                	    
                	    if(isset($pecah_keterangan_2['3'])){
                	        $inti_keterangan = $pecah_keterangan_2['2'];
                	    } else
                	    if(isset($pecah_keterangan_2['2'])){
                	        $inti_keterangan = $pecah_keterangan_2['1'];
                	    } else
                	    if(isset($pecah_keterangan_2['1'])){
                	        $inti_keterangan = $pecah_keterangan_2['0'];
                	    } else {
                	        $inti_keterangan = $pecah_keterangan_2['0'];
                	    }
                	    
                	    if(empty($pecah_keterangan_1['1'])){
                	        $inti_keterangan = $pecah_keterangan_1['0'];
                	    }
                        
                        if($pecah_keterangan_1['0'] == "Pembayaran Internet "){
                            $checked_kosongan = "";
                            $checked_internet = "checked";
                            $checked_dialup = "";
                            $checked_userbaru = "";
                            $checked_alat = "";
                            $checked_webhosting = "";
                        } else
                        if($pecah_keterangan_1['0'] == "Pembayaran Dial Up "){
                            $checked_kosongan = "";
                            $checked_internet = "";
                            $checked_dialup = "checked";
                            $checked_userbaru = "";
                            $checked_alat = "";
                            $checked_webhosting = "";
                        } else
                        if($pecah_keterangan_1['0'] == "Pembayaran User Baru "){
                            $checked_kosongan = "";
                            $checked_internet = "";
                            $checked_dialup = "";
                            $checked_userbaru = "checked";
                            $checked_alat = "";
                            $checked_webhosting = "";
                        } else
                        if($pecah_keterangan_1['0'] == "Pembayaran Alat "){
                            $checked_kosongan = "";
                            $checked_internet = "";
                            $checked_dialup = "";
                            $checked_userbaru = "";
                            $checked_alat = "checked";
                            $checked_webhosting = "";
                        } else
                        if($pecah_keterangan_1['0'] == "Pembayaran WEB & Hosting "){
                            $checked_kosongan = "";
                            $checked_internet = "";
                            $checked_dialup = "";
                            $checked_userbaru = "";
                            $checked_alat = "";
                            $checked_webhosting = "checked";
                        } else {
                            $checked_kosongan = "checked";
                            $checked_internet = "";
                            $checked_dialup = "";
                            $checked_userbaru = "";
                            $checked_alat = "";
                            $checked_webhosting = "";
                        }
                        
                        if(isset($pecah_keterangan_kedua['1'])) {
                            $data_bank = $pecah_keterangan_kedua['1'];
                        }
                        if(isset($pecah_keterangan_kedua['2'])) {
                            $data_bank = $pecah_keterangan_kedua['2'];
                        }
                        if(isset($pecah_keterangan_kedua['3'])) {
                            $data_bank = $pecah_keterangan_kedua['4'];
                        }
                        
                        if($data_bank == " BCA") {
                            $selected_1 = "";
                            $selected_2 = "selected='selected'";
                            $selected_3 = "";
                            $selected_4 = "";
                            $selected_5 = "";
                            $selected_6 = "";
                        } else if($data_bank == " BNI") {
                            $selected_1 = "";
                            $selected_2 = "";
                            $selected_3 = "selected='selected'";
                            $selected_4 = "";
                            $selected_5 = "";
                            $selected_6 = "";
                        } else if($data_bank == " BRI") {
                            $selected_1 = "";
                            $selected_2 = "";
                            $selected_3 = "";
                            $selected_4 = "selected='selected'";
                            $selected_5 = "";
                            $selected_6 = "";
                        } else if($data_bank == " MANDIRI") {
                            $selected_1 = "";
                            $selected_2 = "";
                            $selected_3 = "";
                            $selected_4 = "";
                            $selected_5 = "selected='selected'";
                            $selected_6 = "";
                        } else if($data_bank == " BPD") {
                            $selected_1 = "";
                            $selected_2 = "";
                            $selected_3 = "";
                            $selected_4 = "";
                            $selected_5 = "";
                            $selected_6 = "selected='selected'";
                        } else {
                            $selected_1 = "selected='selected'";
                            $selected_2 = "";
                            $selected_3 = "";
                            $selected_4 = "";
                            $selected_5 = "";
                            $selected_6 = "";
                        }

                        $query_account = mysqli_query($koneksi,"SELECT * FROM account WHERE id_account='$id_account'");
                        $data_account = mysqli_fetch_array($query_account);
                        $nama_account = $data_account['nama_account'];
                    ?>
                    <tr>
                      <td align="center"><?php echo date('d-m-Y', strtotime($data['tanggal'])); ?></td>
                      <td align="left"><a href="#edit<?php echo $data['id_temp']; ?>" role="button"  data-target = "#edit<?php echo $data['id_temp'];?>" data-toggle="modal" style="color: black;"><?php echo $data['keterangan']; ?></a></td>
                      <?php
                        if($in_out=="i"){
                          $total_debit = $total_debit + $data['nominal'];
                        ?>
                        <td align="right"><?php echo number_format($data['nominal'],0,',','.'); ?></td>
                        <td align="right"><?php echo "-"; ?></td>
                        <?php
                        } else {
                          $total_kredit = $total_kredit + $data['nominal'];
                        ?>
                        <td align="right"><?php echo "-"; ?></td>
                        <td align="right"><?php echo number_format($data['nominal'],0,',','.'); ?></td>
                        <?php
                        }
                        ?>
                        <td align="center"><?php echo $nama_account;?></td>
                        <td align="center">
                          <a href="#modal_batal_transaksi<?php echo $data['id_temp']; ?>" role="button"  data-target = "#modal_batal_transaksi<?php echo $data['id_temp'];?>" data-toggle="modal" class="btn btn-xs btn-danger">&nbsp;<i class="fa fa-close"></i>&nbsp;</a>
                        </td>
                    </tr>
                    <?php
                      include "modal_hapus_data_temp.php";
                      include "modal_edit_log_pembayaran.php";
                    }
                    //ini tampil jika masih blm ada transaksi
                    if(!($select->select_detail_data_temp_where($tanggal_awal, $tanggal_akhir, $data_yang_dicari))) {
                      ?>
                      <tr class="odd">
                        <td valign="top" colspan="6" align="center" class="dataTables_empty">Maaf, Tidak ada data !</td>
                      </tr>
                      <?php
                    } else  {
                      ?>
                      <tr>
                        <td colspan="2"><center><strong>Total</strong></center></td>
                        <td align="right"><strong><?php echo number_format($total_debit,0,',','.'); ?></strong></td>
                        <td align="right"><strong><?php echo number_format($total_kredit,0,',','.'); ?></strong></td>
                        <td colspan="2"></td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </form>
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
                    <li class="paginate_button previous" id="example2_previous"><a href="?page=page_log_transaksi_billing&tanggal_awal=<?php echo $tanggal_page?>&tanggal_akhir=<?php echo $tanggal_page?>&limit=<?php echo $limit?>" aria-controls="example2" data-dt-idx="0" tabindex="0">Awal Bulan</a></li>
                    <?php
                    //agar tnaggal paginatin rapi
                    $tanggal_hari_ini_kurangi_6=date('Y-m-d', strtotime('-5 days', strtotime($tanggal_hari_ini)));
                    if($tanggal_akhir>=$tanggal_hari_ini_kurangi_6){

                      $tanggal_page=date('Y-m-d', strtotime('-6 days', strtotime($tanggal_hari_ini)));
                      for ($i= 1; $i <= 7; $i++) {
                        
                        $tanggal_tok=date('d', strtotime($tanggal_page));
                        if($tanggal_akhir==$tanggal_page) {
                          $active="active";
                        } else {
                          $active="";
                        }
                        ?>
                        <li class="paginate_button <?php echo $active; ?>"><a href="?page=page_log_transaksi_billing&tanggal_awal=<?php echo $tanggal_page; ?>&tanggal_akhir=<?php echo $tanggal_page; ?>&limit=<?php echo $limit?>" aria-controls="example2" data-dt-idx="1" tabindex="0"><?php echo $tanggal_tok; ?></a></li>
                        <?php
                        $tanggal_page=date('Y-m-d', strtotime('+1 days', strtotime($tanggal_page)));
                      }
                      
                    } else {

                      $tanggal_page=date('Y-m-d', strtotime('-3 days', strtotime($tanggal_akhir)));
                      for ($i= 1; $i <= 7; $i++) {
                        $tanggal_tok=date('d', strtotime($tanggal_page));
                        if($tanggal_akhir==$tanggal_page) {
                          $active="active";
                        } else {
                          $active="";
                        }
                        ?>
                        <li class="paginate_button <?php echo $active; ?>"><a href="?page=page_log_transaksi_billing&tanggal_awal=<?php echo $tanggal_page; ?>&tanggal_akhir=<?php echo $tanggal_page; ?>&limit=<?php echo $limit?>" aria-controls="example2" data-dt-idx="1" tabindex="0"><?php echo $tanggal_tok; ?></a></li>
                        <?php
                        $tanggal_page=date('Y-m-d', strtotime('+1 days', strtotime($tanggal_page)));
                      }

                    }
                    ?>

                    <li class="paginate_button next" id="example2_next"><a href="?page=page_log_transaksi_billing" aria-controls="example2" data-dt-idx="7" tabindex="0">Hari Ini</a></li>
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

<?php include "modal_alert_saldo.php";?>