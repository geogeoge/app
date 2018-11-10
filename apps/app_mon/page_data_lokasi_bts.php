<?php
include "../../koneksi/koneksi.php";

$isi_data="";
if(isset($_GET['isi_data'])){
  $isi_data = $_GET['isi_data'];
}

$via="lokasi_bts";
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

$sql="SELECT * FROM mon_lokasibts WHERE $via like '%$isi_data%' LIMIT $limit_awal, $limit_akhir";
$query=mysqli_query($koneksi,$sql);   
?>
<section class="content-header">
  <h1>
    Data Lokasi BTS
    <small>
      SoloNet
    </small>
    <a href="#lokasi_bts" role="button"  data-target = "#lokasi_bts" data-toggle="modal" class="btn btn-primary pull-right">Tambah Lokasi BTS</a>
  </h1>
</section>
<?php include "modal_tambah_lokasi_bts.php";?>
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
              <form method="GET" action="?page=page_data_lokasi_bts">
              <div class="col-sm-2">
                
              </div>
              <div class="col-sm-10">
                <div id="example1_filter" class="dataTables_filter">

                  <label>
                    <select name="via" class="form-control input-sm">
                      <?php
                      if($via=="lokasi_bts"){
                        $selected_lokasi_bts='selected="selected"';
                        $selected_alamat_bts='';
                        $selected_telp='';
                      } else
                      if($via=="alamat_bts"){
                        $selected_lokasi_bts='';
                        $selected_alamat_bts='selected="selected"';
                        $selected_telp='';
                      } else 
                      if($via=="telp"){
                        $selected_lokasi_bts='';
                        $selected_alamat_bts='';
                        $selected_telp='selected="selected"';
                      }
                      ?>
                      <option value="lokasi_bts" <?php echo $selected_lokasi_bts;?>>Lokasi BTS</option>
                      <option value="alamat_bts" <?php echo $selected_alamat_bts;?>>Alamat BTS</option>
                      <option value="telp" <?php echo $selected_telp;?>>Telp</option>
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
                    <button name="page" value="page_data_lokasi_bts" class="btn"><i class="fa fa-search"></i></button>
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
                      <th style="text-align: center;" hidden="hidden">ID Lokasi BTS</th>
                      <th style="text-align: center;">Lokasi BTS</th>
                      <th style="text-align: center;">Alamat</th>
                      <th style="text-align: center;">Telp</th>
                      <th style="text-align: center;">Koordinat</th>
                      <th style="text-align: center;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                     while($data=mysqli_fetch_array($query)){
                    ?>
                    <tr>
                      <td align="left" hidden="hidden"><?php echo $data['id_lokasi_bts']; ?></td>

                      <td align="left"><?php echo $data['lokasi_bts']; ?></td>

                      <td align="left"><?php echo $data['alamat_bts']; ?></td>

                      <td align="center"><?php echo $data['telp']; ?></td>

                      <td align="center"><?php echo $data['koordinat']; ?></td>

                      <td width="120" align="center">
                        <a href="#modal_edit_lokasi_bts<?php echo $data['id_lokasi_bts']; ?>" role="button"  data-target = "#modal_edit_lokasi_bts<?php echo $data['id_lokasi_bts']; ?>" data-toggle="modal" class="btn btn-info">&nbsp;<i class="fa fa-search"></i></a>
                        <a href="#modal_konfirmasi_hapus_lokasi_bts<?php echo $data['id_lokasi_bts']; ?>" role="button"  data-target = "#modal_konfirmasi_hapus_lokasi_bts<?php echo $data['id_lokasi_bts']; ?>" data-toggle="modal" class="btn btn-danger">&nbsp;<i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php
                    include "modal_edit_lokasi_bts.php";
                    include "modal_konfirmasi_hapus_lokasi_bts.php";
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
                    <li class="paginate_button previous" id="example2_previous"><a href="?via=<?php echo $via;?>&isi_data=<?php echo $isi_data;?>&limit=<?php echo $limit;?>&page=page_data_lokasi_bts&pagination=1" aria-controls="example2" data-dt-idx="0" tabindex="0">Halaman Awal</a></li>
                    
                    <?php
                    $query_pagination = mysqli_query($koneksi,"SELECT * FROM mon_lokasibts WHERE $via like '%$isi_data%'");
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
                      <li class="paginate_button <?php echo $active; ?>"><a href="?via=<?php echo $via;?>&isi_data=<?php echo $isi_data;?>&limit=<?php echo $limit;?>&page=page_data_lokasi_bts&pagination=<?php echo $i; ?>" aria-controls="example2" data-dt-idx="2" tabindex="0"><?php echo $i; ?></a></li>
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
                        <li class="paginate_button <?php echo $active; ?>"><a href="?via=<?php echo $via;?>&isi_data=<?php echo $isi_data;?>&limit=<?php echo $limit;?>&page=page_data_lokasi_bts&pagination=<?php echo $i; ?>" aria-controls="example2" data-dt-idx="2" tabindex="0"><?php echo $i; ?></a></li>
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
                        <li class="paginate_button <?php echo $active; ?>"><a href="?via=<?php echo $via;?>&isi_data=<?php echo $isi_data;?>&limit=<?php echo $limit;?>&page=page_data_lokasi_bts&pagination=<?php echo $i; ?>" aria-controls="example2" data-dt-idx="2" tabindex="0"><?php echo $i; ?></a></li>
                        <?php
                        }
                      } else {
                        for ($i=$pagination-4; $i <= $pagination+4 ; $i++) {
                          $active="";
                          if($pagination==$i){
                            $active="active";
                          }
                        ?>
                        <li class="paginate_button <?php echo $active; ?>"><a href="?via=<?php echo $via;?>&isi_data=<?php echo $isi_data;?>&limit=<?php echo $limit;?>&page=page_data_lokasi_bts&pagination=<?php echo $i; ?>" aria-controls="example2" data-dt-idx="2" tabindex="0"><?php echo $i; ?></a></li>
                        <?php
                        }
                      }

                    }
                    ?>

                    <li class="paginate_button next" id="example2_next"><a href="?via=<?php echo $via;?>&isi_data=<?php echo $isi_data;?>&limit=<?php echo $limit;?>&page=page_data_lokasi_bts&pagination=<?php echo $jumlah_page; ?>" aria-controls="example2" data-dt-idx="7" tabindex="0">Halaman Akhir</a></li>
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