<?php
include "session.php";
include "../../koneksi/koneksi.php";
include "function.php";

$bulan_indonesia = array(
  '01' => 'JAN',
  '02' => 'FEB',
  '03' => 'MAR',
  '04' => 'APR',
  '05' => 'MEI',
  '06' => 'JUNI',
  '07' => 'JULI',
  '08' => 'AGUS',
  '09' => 'SEPT',
  '10' => 'OKT',
  '11' => 'NOV',
  '12' => 'DES',
);

$login_id_marketing = $_SESSION['id_user'];

header('Content-type: application/vnd-ms-axcel');

header('Content-Disposition: attachment; filename='.date('dmY').'.xls');
?>
<table border="1">
	<tr>
		<td align="center"><b>Tanggal Close</b></td>
		<td align="center"><b>Nama</b></td>
		<td align="center"><b>Instansi</b></td>
		<td align="center"><b>Alamat</b></td>
		<td align="center"><b>No HP</b></td>
		<td align="center"><b>Tunggakan</b></td>
		<td align="center"><b>Harga</b></td>
	</tr>
	<?php
		$query=mysqli_query($koneksi,"select * from sale_register left join sale_paket_internet on sale_register.id_paket=sale_paket_internet.id_paket where sale_register.id_marketing='$login_id_marketing' and sale_register.status='Close' order by sale_register.tanggal_close DESC");
		while($data=mysqli_fetch_array($query)){
		    $id_register=$data['id_register'];
            $tunggakan=$data['billing_bulan_berjalan']-$data['billing_bulan_terbayar'];

			$pecah_alamat=explode("#", $data['alamat']);
            $alamat=$pecah_alamat['0']." RT ".$pecah_alamat['1']."/".$pecah_alamat['2'].", ".$pecah_alamat['3'].", ".$pecah_alamat['4'].", ".$pecah_alamat['5'];
            
            $query_po = mysqli_query($koneksi,"select * from billing_po where id_register='$id_register' and status_po='belum' or status_po='Belum Print'");
            $jumlah_query_po = mysqli_num_rows($query_po);
            if($jumlah_query_po==0){
			?>
		<tr>
			<td align="center"><?php echo $bulan_indonesia[date('m', strtotime($data['tanggal_close']))]." ".date('y', strtotime($data['tanggal_close'])); ?></td>
			<td align="left"><?php echo $data['nama_user']; ?></td>
			<td align="left"><?php echo $data['nama_instansi']; ?></td>
			<td align="left"><?php echo $alamat; ?></td>
			<td align="center"><?php echo $data['telp']; ?></td>
			<td align="center"><?php echo $tunggakan; ?></td>
			<td align="center"><?php echo $data['harga']; ?></td>
		</tr>
			<?php
            }
		}
	?>
</table>