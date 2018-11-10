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
    <li><a href="?page=page_data_log_upgrade"><i class="fa fa-upload"></i> <span>Data Log Upgrade App</span></a></li>
    <li><a href="?page=page_data_master_login"><i class="fa fa-users"></i> <span>Data Master Login</span></a></li>
    <li><a href="?page=page_data_sale_register"><i class="fa fa-user"></i> <span>Data Sale User</span></a></li>
    <li><a href="../../logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
  </ul>
</section>