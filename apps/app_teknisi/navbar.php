<?php
include "../../koneksi/koneksi.php";
$sql="SELECT * FROM sale_register WHERE status_mon='BARU'";
    $query=mysqli_query($koneksi,$sql);  
    $data=mysqli_num_rows($query);
?>
<section class="sidebar">
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header" align="center"><font color="white">Menu Utama</font></li>
    <li><a href="?page=page_dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
    <li><a href="?page=page_kalender"><i class="fa fa-calendar"></i> <span>Kalender Jadwal</span></a></li>
    <li><a href="../../logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>

    <li class="header" align="center"><font color="white">Menu Pemasangan</font></li>
    <li><a href="?page=page_jadwal_pemasangan"><i class="fa fa-list-alt"></i> <span>Jadwal Pemasangan</span></a></li>
    <li><a href="?page=page_data_pemasangan"><i class="fa fa-book"></i> <span>Data Pemasangan</span></a></li>

    <li class="header" align="center"><font color="white">Menu Maintenance</font></li>
    <li><a href="?page=page_jadwal_maintenance&data=pribadi"><i class="fa fa-list-alt"></i> <span>Jadwal Maintenance</span></a></li>
    <li><a href="?page=page_data_maintenance"><i class="fa fa-book"></i> <span>Data Maintenance</span></a></li>
    
<!--     <li class="header" align="center"><font color="white">Menu Monitoring</font></li>
    <li><a href="../app_mon_teknisi/index.php?page=page_data_komplain"><i class="fa fa-edit"></i> <span>Data Komplain</span></a></li>
    <li><a href="../app_mon_teknisi/index.php?page=page_data_pelanggan"><i class="fa fa-users"></i> <span>Data Pelanggan</span></a></li>
    <li><a href="../app_mon_teknisi/index.php?page=page_data_bts"><i class="fa fa-wifi"></i> <span>Data BTS</span></a></li>
    <li><a href="../app_mon_teknisi/index.php?page=page_data_lokasi_bts"><i class="fa fa-map-marker"></i> <span>Data Lokasi BTS</span></a></li>
    <li>
    	<a href="../app_mon_teknisi/index.php?page=page_data_user_baru">
    		<i class="fa fa-user-plus"></i><span>Pelanggan Baru</span>
    		<span class="pull-right-container">
              <small class="label pull-right bg-red"><?php echo $data; ?></small>
            </span>
    	</a>
    </li> -->
  </ul>
</section>