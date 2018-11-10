<?php
include "../../koneksi/koneksi.php";
$sql="SELECT * FROM sale_register WHERE status_mon='BARU'";
    $query=mysqli_query($koneksi,$sql);  
    $data=mysqli_num_rows($query);
?>
<section class="sidebar">
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header" align="center"><font color="white">Menu Monitoring</font></li>
    <li>
        <a href="?page=page_data_komplain">
            <i class="fa fa-edit"></i><span>Data Komplain</span>
        <?php
        if($select->select_jumlah_teknisi_maintenance_where_status_kunjungan_belum()>=1) {
            ?>
            <span class="pull-right-container">
              <small class="label pull-right bg-red"><?php echo $select->select_jumlah_teknisi_maintenance_where_status_kunjungan_belum(); ?></small>
            </span>
            <?php
        }
        ?>
        </a>
    </li>
    <li><a href="?page=page_data_pelanggan"><i class="fa fa-users"></i> <span>Data Pelanggan</span></a></li>
    <li><a href="?page=page_data_bts"><i class="fa fa-wifi"></i> <span>Data BTS</span></a></li>
    <li><a href="?page=page_data_lokasi_bts"><i class="fa fa-map-marker"></i> <span>Data Lokasi BTS</span></a></li>
    <li><a href="../../logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
  </ul>
</section>