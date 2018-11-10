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

$pagination="1";
if(isset($_GET['pagination'])){
  $pagination = $_GET['pagination'];
}

$limit_awal = $limit * $pagination - $limit;

$limit_akhir=$limit;

$sql="SELECT * FROM sale_register LEFT JOIN mon_databts ON sale_register.id_bts=mon_databts.id_bts WHERE sale_register.$via like '%$isi_data%' ORDER BY sale_register.status ASC LIMIT $limit_awal, $limit_akhir";
$query=mysqli_query($koneksi,$sql);   
?>
<section class="content-header">
  <h1>
    Data User
    <small>
      SoloNet
    </small>
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
                
              </div>
              <div class="col-sm-10">
                <div id="example1_filter" class="dataTables_filter">

                  <label>
                    <select name="via" class="form-control input-sm">
                      <?php
                      if($via=="nama_user"){
                        $selected_nama_user='selected="selected"';
                        $selected_ip_radio='';
                        $selected_telp='';
                      } else
                      if($via=="ip"){
                        $selected_nama_user='';
                        $selected_ip_radio='selected="selected"';
                        $selected_telp='';
                      } else 
                      if($via=="telp"){
                        $selected_nama_user='';
                        $selected_ip_radio='';
                        $selected_telp='selected="selected"';
                      }
                      ?>
                      <option value="nama_user" <?php echo $selected_nama_user;?>>Nama User</option>
                      <option value="ip" <?php echo $selected_ip_radio;?>>IP</option>
                      <option value="telp" <?php echo $selected_telp;?>>Telepone</option>
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
                      if($limit=="10"){
                        $selected_10='selected="selected"';
                        $selected_20='';
                        $selected_50='';
                        $selected_100='';
                      } else 
                      if($limit=="20"){
                        $selected_10='';
                        $selected_20='selected="selected"';
                        $selected_50='';
                        $selected_100='';
                      } else
                      if($limit=="50"){
                        $selected_10='';
                        $selected_20='';
                        $selected_50='selected="selected"';
                        $selected_100='';
                      } else
                      if($limit=="100"){
                        $selected_10='';
                        $selected_20='';
                        $selected_50='';
                        $selected_100='selected="selected"';
                      } 
                      ?>
                      <option value="10" <?php echo $selected_10;?>>10</option>
                      <option value="20" <?php echo $selected_20;?>>20</option>
                      <option value="50" <?php echo $selected_50;?>>50</option>
                      <option value="100" <?php echo $selected_100;?>>100</option>
                    </select> 
                  </label>
                  &nbsp
                  <label>
                    <button name="page" value="page_data_pelanggan" class="btn"><i class="fa fa-search"></i></button>
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
                      <th style="text-align: center;" hidden="hidden">ID Pelangan</th>
                      <th style="text-align: center;">Nama Pelangan</th>
                      <th style="text-align: center;">Telepon</th>
                      <th style="text-align: center;">IP Radio</th>
                      <!-- <th style="text-align: left;">IP Public</th> -->
                      <th style="text-align: center;">BTS</th>
                      <th style="text-align: center;">Status</th>
                      <th style="text-align: center;">Action</th>
                      <!-- <th style="text-align: center;">Detail</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                     while($data=mysqli_fetch_array($query)){
                      $id_register=$data['id_register'];
                      $tampil_status_user = '<i class="fa fa-check blue"></i>';
                      $update_status_user = "BELUM";

                      $status_user = $data['status'];
                      if($status_user=="Hold") {
                        $tampil_status_user = '<i class="fa fa-close red"></i>';
                        $update_status_user = "SUDAH";
                      }
                    ?>
                    <tr>
                      <td align="left" hidden="hidden"><?php echo $data['id_register']; ?></td>

                      <td align="left"><a href="?page=page_data_user_detail_sementara&id_pelanggan=<?php echo $data['id_register']; ?>" style="color: black;"><?php echo $data['nama_user']; ?></a></td>

                      <td align="left"><a href="?page=page_data_user_detail_sementara&id_pelanggan=<?php echo $data['id_register']; ?>" style="color: black;"><?php echo $data['telp']; ?></a></td>

                      <td align="left"><a href="?page=page_data_user_detail_sementara&id_pelanggan=<?php echo $data['id_register']; ?>" style="color: black;"><?php echo $data['ip']; ?></a></td>

                      <!-- <td align="left"><?php echo $data['ip_public']; ?></td> -->

                      <td align="left"><a href="#modal_detail_ip_bts<?php echo $data['id_register']; ?>" role="button"  data-target = "#modal_detail_ip_bts<?php echo $data['id_register']; ?>" data-toggle="modal" style="color: black;"><?php echo $data['nama_bts']; ?></a></td>

                      <td align="center"><?php echo $tampil_status_user; ?></td>
                      <td width="150" align="center">
                        <a href="#modal_input_komplen<?php echo $data['id_register']; ?>" role="button"  data-target = "#modal_input_komplen<?php echo $data['id_register']; ?>" data-toggle="modal" class="btn btn-warning">&nbsp;<i class="fa fa-warning"></i></a>
                        <a href="#modal_edit_data_pelanggan<?php echo $data['id_register']; ?>" role="button"  data-target = "#modal_edit_data_pelanggan<?php echo $data['id_register']; ?>" data-toggle="modal" class="btn btn-primary">&nbsp;<i class="fa fa-edit"></i></a>
                      </td>
                    </tr>
                    <?php
                      include "modal_input_komplain.php";
                      include "modal_detail_ip_bts.php";
                      include "modal_edit_data_pelanggan.php";
                    }
                    //ini tampil jika masih blm ada transaksi
                    if(mysqli_num_rows($query)<=0) {
                      ?>
                      <tr class="odd">
                        <td valign="top" colspan="6" class="dataTables_empty">Maaf, Data yang kamu cari tidak ada gan !</td>
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
                    <li class="paginate_button previous" id="example2_previous"><a href="?via=<?php echo $via;?>&isi_data=<?php echo $isi_data;?>&limit=<?php echo $limit;?>&page=page_data_pelanggan&pagination=1" aria-controls="example2" data-dt-idx="0" tabindex="0">Halaman Awal</a></li>
                    
                    <?php
                    $query_pagination = mysqli_query($koneksi,"SELECT * FROM sale_register LEFT JOIN mon_databts ON sale_register.id_bts=mon_databts.id_bts WHERE sale_register.$via like '%$isi_data%'");
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
                      <li class="paginate_button <?php echo $active; ?>"><a href="?via=<?php echo $via;?>&isi_data=<?php echo $isi_data;?>&limit=<?php echo $limit;?>&page=page_data_pelanggan&pagination=<?php echo $i; ?>" aria-controls="example2" data-dt-idx="2" tabindex="0"><?php echo $i; ?></a></li>
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
                        <li class="paginate_button <?php echo $active; ?>"><a href="?via=<?php echo $via;?>&isi_data=<?php echo $isi_data;?>&limit=<?php echo $limit;?>&page=page_data_pelanggan&pagination=<?php echo $i; ?>" aria-controls="example2" data-dt-idx="2" tabindex="0"><?php echo $i; ?></a></li>
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
                        <li class="paginate_button <?php echo $active; ?>"><a href="?via=<?php echo $via;?>&isi_data=<?php echo $isi_data;?>&limit=<?php echo $limit;?>&page=page_data_pelanggan&pagination=<?php echo $i; ?>" aria-controls="example2" data-dt-idx="2" tabindex="0"><?php echo $i; ?></a></li>
                        <?php
                        }
                      } else {
                        for ($i=$pagination-4; $i <= $pagination+4 ; $i++) {
                          $active="";
                          if($pagination==$i){
                            $active="active";
                          }
                        ?>
                        <li class="paginate_button <?php echo $active; ?>"><a href="?via=<?php echo $via;?>&isi_data=<?php echo $isi_data;?>&limit=<?php echo $limit;?>&page=page_data_pelanggan&pagination=<?php echo $i; ?>" aria-controls="example2" data-dt-idx="2" tabindex="0"><?php echo $i; ?></a></li>
                        <?php
                        }
                      }

                    }
                    ?>

                    <li class="paginate_button next" id="example2_next"><a href="?via=<?php echo $via;?>&isi_data=<?php echo $isi_data;?>&limit=<?php echo $limit;?>&page=page_data_pelanggan&pagination=<?php echo $jumlah_page; ?>" aria-controls="example2" data-dt-idx="7" tabindex="0">Halaman Akhir</a></li>
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