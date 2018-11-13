<?php
$jumlah_pemasangan_baru = $select->select_jumlah_pemasangan_user_baru_navbar();
$alert = "";
if($jumlah_pemasangan_baru>0){
  $alert = "<small class='label pull-right bg-red'>".$jumlah_pemasangan_baru."</small>";
}
?>
<section class="sidebar">
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header" align="center"><font color="white">Menu Utama</font></li>
    <li><a href="?page=page_daily"><i class="fa fa-book"></i> <span>Daily</span></a></li>
    <li><a href="?page=page_pemasangan_baru"><i class="fa fa-user"></i> <span>Permintaan Baru <?php echo $alert;?></span></a></li>
    <li><a href="?page=page_data_permintaan_alat"><i class="fa fa-user"></i> <span>Permintaan Yang Sudah Siap</span></a></li>
    <li><a href="../../logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
    <li class="header" align="center"><font color="white">Data Alat</font></li>
    <li><a href="?page=page_data_radio"><i class="fa fa-book"></i> <span>Data Radio</span></a></li>
    <li><a href="?page=page_data_antena"><i class="fa fa-book"></i> <span>Data Antena</span></a></li>
    <li><a href="?page=page_data_wifi"><i class="fa fa-book"></i> <span>Data Wifi</span></a></li>
    <li><a href="?page=page_data_tower"><i class="fa fa-book"></i> <span>Data Tower</span></a></li>
    <li><a href="?page=page_data_kabel"><i class="fa fa-book"></i> <span>Data Kabel</span></a></li>
  </ul>
</section>