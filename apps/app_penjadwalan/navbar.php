<?php
$jumlah_pemasangan_baru = $select->jumlah_permintaan_pemasangan();
$alert = "";
if($jumlah_pemasangan_baru>0){
  $alert = "<small class='label pull-right bg-red'>".$jumlah_pemasangan_baru."</small>";
}

$jumlah_maintenance_baru = $select->jumlah_permintaan_maintenance();
$alert_2 = "";
if($jumlah_maintenance_baru>0){
  $alert_2 = "<small class='label pull-right bg-red'>".$jumlah_maintenance_baru."</small>";
}
?>
<section class="sidebar">
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header" align="center"><font color="white">Menu Utama</font></li>
    <li><a href="?page=page_dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
    <li><a href="../../logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>

    <li class="header" align="center"><font color="white">Penjadwalan Pemasangan</font></li>
    <li><a href="?page=page_permintaan_pemasangan"><i class="fa fa-user"></i> <span>Permintaan Pemasangan <?php echo $alert;?></span></a></li>
    <li><a href="?page=page_jadwal_pemasangan"><i class="fa fa-list-alt"></i> <span>Jadwal Pemasangan</span></a></li>
    <li><a href="?page=page_data_pemasangan"><i class="fa fa-book"></i> <span>Data Pemasangan</span></a></li>

    <li class="header" align="center"><font color="white">Penjadwalan Maintenance</font></li>
    <li><a href="?page=page_permintaan_maintenance"><i class="fa fa-user"></i> <span>Permintaan Maintenance <?php echo $alert_2;?></span></a></li>
    <li><a href="?page=page_jadwal_maintenance"><i class="fa fa-list-alt"></i> <span>Jadwal Maintenance</span></a></li>
    <li><a href="?page=page_data_maintenance"><i class="fa fa-book"></i> <span>Data Maintenance</span></a></li>
  </ul>
</section>