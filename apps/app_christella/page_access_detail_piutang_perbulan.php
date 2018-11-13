<?php
//variable tanggal_hari_ini di dapat di halaman index
$tanggal=$tanggal_hari_ini;
$tanggal_sekarang=$tanggal;
if(isset($_GET['tanggal'])) {
  $tanggal=$_GET['tanggal']."-12-01";
}

?>
<section class="content-header">
  <h1 class="">
    Data Detail Piutang Access Setiap Bulan
    <small>SoloNet</small>
    <div class="tombol_tambah">
      <a href="?page=page_dashboard" class="btn btn-primary">&nbsp;Kembali</a>
    </div>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tahun : <strong><?php echo date('Y', strtotime($tanggal)); ?></strong> </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
              <div class="col-sm-6"></div>
              <div class="col-sm-6"></div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                  <thead>
                    <tr>
                      <th width="10">No</th>
                      <th width="50%">Bulan</th>
                      <th>Total Piutang</th>
                      <th>Jumlah User</th>
                      <th width="50">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $tambahan='0';
                    if(!($_GET['tanggal']==date('Y'))){
                        $tambahan='12';
                    }
                    
                  for ($i= 1; $i <= 12; $i++)
                  {
                    
                    
                    $bulan_sekarang=date('m',strtotime($tanggal_sekarang));
                    $selisih=$bulan_sekarang-$i+$tambahan;
                    
                    $selisih=$selisih+1;
                    
                    if($selisih<=0){
                        $selisih='99';
                    }
                    
                    if($i<10){
                        $i="0".$i;
                    }
                  ?>
                    <tr>
                      <td align="center"><?php echo $i;?></td>
                      <td align="left"><?php echo $bulan_indonesia[$i]; ?></td>
                      <td align="right"><?php echo number_format($crud->select_detail_piutang_access_setiap_bulan($selisih),0,',','.'); ?></td>
                      <td align="right"><?php echo $crud->select_detail_piutang_access_setiap_bulan_jumlah_user($selisih); ?></td>
                      <td width="150" align="center">
                        <a href="?page=page_access_detail_piutang_jumlah_user&tunggakan=<?php echo $selisih; ?>&bulan_ini=<?php echo $i; ?>" class="btn btn-info"><i class="icon-trash icon-large"></i>&nbsp;Detail</a>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-5">
                <div class="dataTables_info" id="example2_info" role="status" aria-live="polite"></div>
              </div>
              <div class="col-sm-7">
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                  <ul class="pagination">
                    <li class="paginate_button previous" id="example2_previous"><a href="?page=page_access_detail_piutang_perbulan&tanggal=<?php echo date('Y')-1; ?>" aria-controls="example2" data-dt-idx="0" tabindex="0">Previous</a></li>
                    <?php
                    //agar tnaggal paginatin rapi
                    $tahun=date('Y')-1;
                    for ($i= 1; $i <= 2; $i++) {
                        ?>
                        <li class="paginate_button <?php echo $active; ?>"><a href="?page=page_access_detail_piutang_perbulan&tanggal=<?php echo $tahun; ?>" aria-controls="example2" data-dt-idx="1" tabindex="0"><?php echo $tahun; ?></a></li>
                        <?php
                            $tahun=$tahun+1;
                    }
                      
                    ?>

                    <li class="paginate_button next" id="example2_next"><a href="?page=page_access_transaksi_tahunan&tanggal=<?php echo $tahun_ini; ?>-01-01" aria-controls="example2" data-dt-idx="7" tabindex="0">Tahun Ini</a></li>
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

