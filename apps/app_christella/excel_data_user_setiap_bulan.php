<?php
include "session.php";
include "../../koneksi/koneksi.php";
include "function.php";

$crud = new crud;

$tahun = "2018";

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=tutorialweb-export.xls");


?>

<table border="1">
  <thead>
  <tr>
    <th width="10" rowspan="2">No</th>
    <th width="300" rowspan="2">Nama User</th>
    <th colspan="12"><?php echo $tahun; ?></th>
  </tr>
  <tr>
    <th width="100">Januari</th>
    <th width="100">Februari</th>
    <th width="100">Maret</th>
    <th width="100">April</th>
    <th width="100">Mei</th>
    <th width="100">Juni</th>
    <th width="100">Juli</th>
    <th width="100">Agustus</th>
    <th width="100">September</th>
    <th width="100">Oktober</th>
    <th width="100">November</th>
    <th width="100">Desember</th>
  </tr>
  </thead>
  <tbody>
  <?php
  $no = 1;
  $query = mysqli_query($koneksi,"select * from sale_register");
  while($data = mysqli_fetch_array($query)){
    $id_register = $data['id_register'];

    echo "<tr>";
    echo "<td>$no</td>";
    echo "<td>".$data['nama_user']."</td>";

    for ($i= 1; $i <= 12; $i++)
    { 
      if($i<10){
        $i = "0".$i;
      }
      $bulan = $tahun."-".$i;
      $query_log = mysqli_query($koneksi,"select * from billing_backup_log_user left join sale_paket_internet on billing_backup_log_user.id_paket=sale_paket_internet.id_paket where billing_backup_log_user.id_register='$id_register' and billing_backup_log_user.bulan like '%$bulan%'");
      $data_log = mysqli_fetch_array($query_log);
      echo "<td align='right'>".$data_log['harga']."</td>";
    }
    $no++;
    echo "</tr>";
  }
  ?>
  </tbody>
</table>