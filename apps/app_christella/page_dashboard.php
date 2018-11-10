<section class="content-header">
  <h1>
    <?php echo $bulan_indonesia[date('m', strtotime($tanggal_hari_ini))]; ?>
    <small>Dashboard</small>
    <div class="tombol_tambah">
      <a href="?page=page_access_menu_download_invoice" class="btn btn-primary"><i class="fa fa-download"></i>&nbsp;&nbsp;<span>Download Invoice</span></a>
      <a href="?page=page_access_menu_cetak_invoice" class="btn btn-primary"><i class="fa fa-print"></i>&nbsp;&nbsp;<span>Cetak Invoice</span></a>
    </div>
  </h1>

</section>

    <!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">

    <div class="col-md-4 col-sm-12 col-xs-12">
      <?php
      $piutang_tak_tertagih = $crud->select_dashboard_piutang_bulan_berjalan();
      $total_tagihan = $crud->select_dashboard_total_semua_tagihan();

      $rasio_piutang_tak_terbayar = ($piutang_tak_tertagih * 100) / $total_tagihan;
      if($rasio_piutang_tak_terbayar>50){
        $warna_kotak = "red";
      } else 
      if($rasio_piutang_tak_terbayar>20) {
        $warna_kotak = "yellow";
      } else
      if($rasio_piutang_tak_terbayar>0) {
        $warna_kotak = "aqua";
      } else {
        $warna_kotak = "green";
      }
      ?>
      <div class="info-box bg-<?php echo $warna_kotak; ?>">
        <span class="info-box-icon"><i class="fa fa-wifi"></i></span>
        
        <div class="info-box-content">
          <span class="info-box-text">Piutang Access</span>
          <span class="info-box-number">Rp. <?php echo number_format($piutang_tak_tertagih,0,',','.'); ?></span>

          <div class="progress">
            <div class="progress-bar" style="width: <?php echo number_format($rasio_piutang_tak_terbayar,2); ?>%"></div>
          </div>
              <span class="progress-description">
                <strong><?php echo number_format($rasio_piutang_tak_terbayar,2); ?>%</strong> Dari Pendapatan <strong>Rp. <?php echo number_format($total_tagihan,0,',','.');?></strong>
              </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="info-box bg-aqua">
        <span class="info-box-icon"><i class="ion ion-person-add"></i></span>
        
        <div class="info-box-content">
          <span class="info-box-text"><strong>Invoice User Baru</strong></span>
          <span class="info-box-number"><h2><?php echo $crud->select_dashboard_tagihan_user_baru(); ?></h2></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <div class="col-md-4 col-sm-12 col-xs-12">
      <?php
      $piutang_tak_tertagih = 0;
      $total_tagihan = 0;

      $rasio_piutang_tak_terbayar = ($piutang_tak_tertagih * 100) / $total_tagihan;
      if($rasio_piutang_tak_terbayar>50){
        $warna_kotak = "red";
      } else 
      if($rasio_piutang_tak_terbayar>20) {
        $warna_kotak = "yellow";
      } else
      if($rasio_piutang_tak_terbayar>0) {
        $warna_kotak = "aqua";
      } else {
        $warna_kotak = "green";
      }
      ?>
      <div class="info-box bg-<?php echo $warna_kotak; ?>">
        <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>
        
        <div class="info-box-content">
          <span class="info-box-text">Piutang Dial Up</span>
          <span class="info-box-number">Rp. <?php echo number_format($piutang_tak_tertagih,0,',','.'); ?></span>

          <div class="progress">
            <div class="progress-bar" style="width: <?php echo number_format($rasio_piutang_tak_terbayar,2); ?>%"></div>
          </div>
              <span class="progress-description">
                <strong><?php echo number_format($rasio_piutang_tak_terbayar,2); ?>%</strong> Dari Pendapatan <strong>Rp. <?php echo number_format($total_tagihan,0,',','.');?></strong>
              </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

  </div>

  <div class="row">
    <div class="col-lg-6 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-blue">
        <div class="inner">
          <center><h4><strong>TOTAL PIUTANG ACCESS</strong></h4></center>
          <center><h3>Rp. <?php echo number_format($crud->select_dashboard_total_piutang(),0,',','.'); ?></h3></center>
          <center><h4>Dari <strong><?php echo $crud->select_dashboard_tagihan_bulanan_access(); ?></strong> Orang</h4></center>
          <hr>
          <h4>Piutang Sampai Bulan Kemarin : <strong> Rp. <?php echo number_format($crud->select_dashboard_total_piutang()-$crud->select_dashboard_piutang_bulan_berjalan(),0,',','.') ?></strong></h4>
          <h4>Piutang Bulan Berjalan : <strong> Rp. <?php echo number_format($crud->select_dashboard_piutang_bulan_berjalan(),0,',','.') ?></strong></h4>
        </div>
        <a href="?page=page_access_detail_piutang_perbulan&tanggal=<?php echo date('Y'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-6 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-blue">
        <div class="inner">
          <center><h4><strong>TOTAL PIUTANG DIAL UP</strong></h4></center>
          <center><h3>Rp. <?php echo number_format(0,0,',','.'); ?></h3></center>
          <center><h4>Dari <strong><?php echo "0"; ?></strong> Orang</h4></center>
          <hr>
          <h4>Piutang Sampai Bulan Kemarin : <strong> Rp. <?php echo number_format(0,0,',','.') ?></strong></h4>
          <h4>Piutang Bulan Berjalan : <strong> Rp. <?php echo number_format(0,0,',','.') ?></strong></h4>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row -->

  <div class="row"><center>
    <div class="col-lg-12 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>Rp. <?php echo number_format($crud->select_dashboard_total_pembayaran_tidak_terdeteksi(),0,',','.'); ?></h3>

          <p>Dari <strong><?php echo number_format($crud->select_dashboard_jumlah_pembayaran_tidak_terdeteksi(),0,',','.'); ?></strong> Transaksi</p>
          <p><strong>Data Transaksi Yang Belum Terindentifikasi</strong></p>
        </div>
        <div class="icon">
          <i class="fa fa-bitbucket"></i>
        </div>
        <a href="?page=page_access_data_transaksi_tidak_terdeteksi" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div></center>
    <!-- ./col -->
  </div>

</section>
