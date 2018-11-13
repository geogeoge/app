<?php
include "../../koneksi/koneksi.php";

$isi_data="";
if(isset($_GET['isi_data'])){
  $isi_data = $_GET['isi_data'];
}

$via="nama_user";
if(isset($_GET['via'])){
  $via = $_GET['via'];
}

$limit="10";
if(isset($_GET['limit'])){
  $limit = $_GET['limit'];
}

$tanggal_awal=date("Y-m-d");
if(isset($_GET['tanggal_awal'])){
  $tanggal_awal = $_GET['tanggal_awal'];
}

$tanggal_akir=date("Y-m-d");
if(isset($_GET['tanggal_akir'])){
  $tanggal_akir = $_GET['tanggal_akir'];
}


$pagination="1";
if(isset($_GET['pagination'])){
  $pagination = $_GET['pagination'];
}

$limit_awal = $limit * $pagination - $limit;

$limit_akhir=$limit;

$sql="SELECT  * FROM teknisi_maintenance LEFT JOIN sale_register on teknisi_maintenance.id_register=sale_register.id_register WHERE teknisi_maintenance.status='Selesai' AND teknisi_maintenance.tanggal_komplen BETWEEN '$tanggal_awal' AND '$tanggal_akir' AND $via like '%$isi_data%' LIMIT $limit_awal, $limit_akhir";
$query=mysqli_query($koneksi,$sql);   
?>
<section class="content-header">
  <h1>
    Data Log Trouble
    <small>
      SoloNet
    </small>
    <a href="#modal_tambah_bts" role="button"  data-target = "#modal_tambah_bts" data-toggle="modal" class="btn btn-primary pull-right">Tambah BTS</a>
  </h1>
</section>
<?php include "modal_tambah_bts.php";?>
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
              <form method="GET" action="?page=page_data_log_trouble">
              <div class="col-sm-2">
                
              </div>
              <div class="col-sm-10">
                <div id="example1_filter" class="dataTables_filter">

                  <label>
                    <input type="date" name="tanggal_awal" class="form-control input-sm" value="<?php echo $tanggal_awal;?>">
                    &nbsp
                    S/D
                    <input type="date" name="tanggal_akir" class="form-control input-sm" value="<?php echo $tanggal_akir;?>">
                  </label>
                  &nbsp
                  <label>
                    <select name="via" class="form-control input-sm">
                      <?php
                      if($via=="nama_user"){
                        $selected_nama_user='selected="selected"';
                        $selected_kerusakan='';
                      } else
                      if($via=="kerusakan"){
                        $selected_nama_user='';
                        $selected_kerusakan='selected="selected"';
                      }
                      ?>
                      <option value="sale_register.nama_user" <?php echo $selected_nama_user;?>>Nama User</option>
                      <option value="teknisi_maintenance.kerusakan" <?php echo $selected_kerusakan;?>>Trouble</option>
                    </select> 
                  </label>
                    &nbsp
                  <label>
                    Data :
                    <input type="search" name="isi_data" class="form-control input-sm" value="<?php echo $isi_data;?>">
                    <input type="search" name="pagination" class="form-control input-sm" value="1" style="display: none;">
                  </label>
                    &nbsp
                  <label>
                    <select name="limit" class="form-control input-sm">
                      <?php
                      if($limit=="5"){
                        $selected_5='selected="selected"';
                        $selected_10='';
                        $selected_20='';
                        $selected_50='';
                        $selected_100='';
                      } else 
                      if($limit=="10"){
                        $selected_5='';
                        $selected_10='selected="selected"';
                        $selected_20='';
                        $selected_50='';
                        $selected_100='';
                      } else 
                      if($limit=="20"){
                        $selected_5='';
                        $selected_10='';
                        $selected_20='selected="selected"';
                        $selected_50='';
                        $selected_100='';
                      } else
                      if($limit=="50"){
                        $selected_5='';
                        $selected_10='';
                        $selected_20='';
                        $selected_50='selected="selected"';
                        $selected_100='';
                      } else
                      if($limit=="100"){
                        $selected_5='';
                        $selected_10='';
                        $selected_20='';
                        $selected_50='';
                        $selected_100='selected="selected"';
                      } 
                      ?>
                      <option value="5" <?php echo $selected_5;?>>5</option>
                      <option value="10" <?php echo $selected_10;?>>10</option>
                      <option value="20" <?php echo $selected_20;?>>20</option>
                      <option value="50" <?php echo $selected_50;?>>50</option>
                      <option value="100" <?php echo $selected_100;?>>100</option>
                    </select> 
                  </label>
                  &nbsp
                  <label>
                    <button name="page" value="page_data_log_trouble" class="btn"><i class="fa fa-search"></i></button>
                  </label>

                </div>
              </div>
              </form>
            </div>

            <!-- body table -->
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="text-align: center;" hidden="hidden">ID</th>
                      <th style="text-align: center;">Komple</th>
                      <th style="text-align: center;">Nama User</th>
                      <th style="text-align: center;">Kerusakan</th>
                      <th style="text-align: center;">Status</th>
                      <th style="text-align: center;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                     while($data=mysqli_fetch_array($query)){
                      $id_maintenance=$data['id_maintenance'];
                      $query_maintenance = mysqli_query($koneksi,"select * from teknisi_maintenance where id_maintenance='$id_maintenance'");
                      $tampil_maintenance = mysqli_fetch_array($query_maintenance);

                      $id_teknisi=$tampil_maintenance['id_teknisi'];
                      $query_teknisi = mysqli_query($koneksi,"select * from master_login where id_user='$id_teknisi'");
                      $data_teknisi = mysqli_fetch_array($query_teknisi);
                      $nama_teknisi = $data_teknisi['nama_user'];
                      $pecah_nama_teknisi = explode(" ", $nama_teknisi);

                      $partner=$tampil_maintenance['partner'];
                      $query_partner=mysqli_query($koneksi,"select * from master_login where id_user='$partner'");
                      $jumlah_query_partner=mysqli_num_rows($query_partner);
                      if($jumlah_query_partner>=1){
                        $tampil_partner=mysqli_fetch_array($query_partner);
                        $data_partner=$tampil_partner['nama_user'];
                      } else {
                        $data_partner=$data['partner'];
                      }
                      $pecah_data_partner = explode(" ", $data_partner);

                      $teknisi = $pecah_nama_teknisi['0']." & ".$pecah_data_partner['0'];
                      if(empty($data_partner)){
                        $teknisi = $pecah_nama_teknisi['0'];
                      }
                    ?>
                    <tr>
                      <td align="left" hidden="hidden"><?php echo $data['id_maintenance']; ?></td>

                      <td align="center" width="100"><?php echo $data['tanggal_komplen']; ?></td>

                      <td align="left"><?php echo $data['nama_user']; ?></td>

                      <td align="left"><?php echo $data['kerusakan']; ?></td>

                      <td align="left"><?php echo $data['status']; ?></td>
                      
                      <td width="80" align="center">
                        <a href="#modal_detail_log_trouble<?php echo $data['id_maintenance']; ?>" role="button"  data-target = "#modal_detail_log_trouble<?php echo $data['id_maintenance']; ?>" data-toggle="modal" class="btn btn-info">&nbsp;<i class="fa fa-search"></i></a>
                      </td>
                    </tr>
                    <?php
                    include "modal_detail_log_trouble.php";
                    }
                    //ini tampil jika masih blm ada transaksi
                    if(mysqli_num_rows($query)<=0) {
                      ?>
                      <tr class="odd">
                        <td valign="top" colspan="6" class="dataTables_empty"><center>Maaf, Data yang kamu cari tidak ada gan !</center></td>
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
                    <li class="paginate_button previous" id="example2_previous"><a href="?via=<?php echo $via;?>&isi_data=<?php echo $isi_data;?>&limit=<?php echo $limit;?>&page=page_data_log_trouble&pagination=1" aria-controls="example2" data-dt-idx="0" tabindex="0">Halaman Awal</a></li>
                    
                    <?php
                    $query_pagination = mysqli_query($koneksi,"SELECT  * FROM teknisi_maintenance LEFT JOIN sale_register on teknisi_maintenance.id_register=sale_register.id_register WHERE teknisi_maintenance.status='Selesai' AND teknisi_maintenance.tanggal_komplen BETWEEN '$tanggal_awal' AND '$tanggal_akir' AND $via like '%$isi_data%'");
                    $jumlah_data = mysqli_num_rows($query_pagination);
                    $mod_page = $jumlah_data % $limit;
                    $jumlah_page = ($jumlah_data - $mod_page) / $limit + 1;

                    $tiga_page_dari_belakang = $jumlah_page - 3;
                    if($jumlah_page<=9){
                      //batas if yes
                      for ($i=1; $i <= $jumlah_page ; $i++) {
                        $active="";
                        if($pagination==$i){
                          $active="active";
                        }
                      ?>
                      <li class="paginate_button <?php echo $active; ?>"><a href="?via=<?php echo $via;?>&isi_data=<?php echo $isi_data;?>&limit=<?php echo $limit;?>&page=page_data_log_trouble&pagination=<?php echo $i; ?>&tanggal_awal=<?php echo $tanggal_awal; ?>&tanggal_akir=<?php echo $tanggal_akir; ?>" aria-controls="example2" data-dt-idx="2" tabindex="0"><?php echo $i; ?></a></li>
                      <?php
                      }

                    } else {
                      //batas if yang tidak setuju
                      if($pagination<=3){
                        //if sing nggo golek iki active e ning tengah opo ning pinggir
                        for ($i=1; $i <= 9 ; $i++) {
                          $active="";
                          if($pagination==$i){
                            $active="active";
                          }
                        ?>
                      <li class="paginate_button <?php echo $active; ?>"><a href="?via=<?php echo $via;?>&isi_data=<?php echo $isi_data;?>&limit=<?php echo $limit;?>&page=page_data_log_trouble&pagination=<?php echo $i; ?>&tanggal_awal=<?php echo $tanggal_awal; ?>&tanggal_akir=<?php echo $tanggal_akir; ?>" aria-controls="example2" data-dt-idx="2" tabindex="0"><?php echo $i; ?></a></li>
                        <?php
                        }
                      } else
                      if($pagination>=$tiga_page_dari_belakang){
                        for ($i=$jumlah_page-9; $i <= $jumlah_page ; $i++) {
                          $active="";
                          if($pagination==$i){
                            $active="active";
                          }
                        ?>
                      <li class="paginate_button <?php echo $active; ?>"><a href="?via=<?php echo $via;?>&isi_data=<?php echo $isi_data;?>&limit=<?php echo $limit;?>&page=page_data_log_trouble&pagination=<?php echo $i; ?>&tanggal_awal=<?php echo $tanggal_awal; ?>&tanggal_akir=<?php echo $tanggal_akir; ?>" aria-controls="example2" data-dt-idx="2" tabindex="0"><?php echo $i; ?></a></li>
                        <?php
                        }
                      } else {
                        for ($i=$pagination-4; $i <= $pagination+4 ; $i++) {
                          $active="";
                          if($pagination==$i){
                            $active="active";
                          }
                        ?>
                      <li class="paginate_button <?php echo $active; ?>"><a href="?via=<?php echo $via;?>&isi_data=<?php echo $isi_data;?>&limit=<?php echo $limit;?>&page=page_data_log_trouble&pagination=<?php echo $i; ?>&tanggal_awal=<?php echo $tanggal_awal; ?>&tanggal_akir=<?php echo $tanggal_akir; ?>" aria-controls="example2" data-dt-idx="2" tabindex="0"><?php echo $i; ?></a></li>
                        <?php
                        }
                      }

                    }
                    ?>

                    <li class="paginate_button next" id="example2_next"><a href="?via=<?php echo $via;?>&isi_data=<?php echo $isi_data;?>&limit=<?php echo $limit;?>&page=page_data_log_trouble&pagination=<?php echo $jumlah_page; ?>" aria-controls="example2" data-dt-idx="7" tabindex="0">Halaman Akhir</a></li>
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