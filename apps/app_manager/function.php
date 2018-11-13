<?php

$bulan_indonesia = array(
  '01' => 'JANUARI',
  '02' => 'FEBRUARI',
  '03' => 'MARET',
  '04' => 'APRIL',
  '05' => 'MEI',
  '06' => 'JUNI',
  '07' => 'JULI',
  '08' => 'AGUSTUS',
  '09' => 'SEPTEMBER',
  '10' => 'OKTOBER',
  '11' => 'NOVEMBER',
  '12' => 'DESEMBER',
);

class crud {
	//----------------------------------------Function Select----------------------------------------\\
	function select_data_user_prospek($login_id_teknisi) {
		include "../../koneksi/koneksi.php";

		$query=mysqli_query($koneksi,"select * from sale_user_prospek where id_marketing='$login_id_marketing' order by id_prospek DESC");
		while($tampil=mysqli_fetch_array($query))
		$data[]=$tampil;
		return $data;
	}
}

class select {
  function select_dashboard_omset($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = date('m');
    if($perulangan<=9) {
      $perulangan="0".$perulangan;
    }
    $query=mysqli_query($koneksi,"select * from billing_backup_log_user left join sale_paket_internet on billing_backup_log_user.id_paket=sale_paket_internet.id_paket where billing_backup_log_user.bulan between '2018-$perulangan-01' and '2018-$perulangan-31'");
    while($tampil=mysqli_fetch_array($query)){
      $harga = $tampil['harga'];
      $total_harga = $total_harga + $harga;
    }
    return $total_harga;
  }

  function select_dashboard_pemasangan($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = date('m');
    if($perulangan<=9) {
      $perulangan="0".$perulangan;
    }
    $query=mysqli_query($koneksi,"select * from sale_register where tanggal_pemasangan between '2018-$perulangan-01' and '2018-$perulangan-31'");
    $data=mysqli_num_rows($query);
    return $data;
  }

  function select_dashboard_tagihan_terbayar($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = date('m');
    $bulan_perulangan = date('m');
    $bulan = 1;
    $query = mysqli_query($koneksi,"select (sale_register.billing_bulan_berjalan - sale_register.billing_bulan_terbayar), sale_register.billing_bulan_berjalan, sale_register.status, sale_register.id_paket, sale_paket_internet.id_paket, sale_paket_internet.harga from sale_register left join sale_paket_internet on sale_register.id_paket=sale_paket_internet.id_paket where sale_register.status='Close' and (sale_register.billing_bulan_berjalan - sale_register.billing_bulan_terbayar)>='$bulan'");
    while($data=mysqli_fetch_array($query)){
      $piutang = $piutang + $data['harga'];
    }

    $query=mysqli_query($koneksi,"select * from billing_backup_log_user left join sale_paket_internet on billing_backup_log_user.id_paket=sale_paket_internet.id_paket where billing_backup_log_user.bulan between '2018-$perulangan-01' and '2018-$perulangan-31'");
    while($tampil=mysqli_fetch_array($query)){
      $harga = $tampil['harga'];
      $total_harga = $total_harga + $harga;
    }

    $jumlah_tagihan_terbayar = $total_harga - $piutang;
    $data_tagihan_terbayar[]=$jumlah_tagihan_terbayar;
    return $jumlah_tagihan_terbayar;
  }

  function select_dashboard_produk_200000($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = date('m');
    if($perulangan<=9) {
      $perulangan="0".$perulangan;
    }
    $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND billing_backup_log_user.id_paket =  'B001' OR billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND sale_paket_internet.harga <= '200000'  AND billing_backup_log_user.id_paket LIKE 'L0%'");
    while($tampil=mysqli_fetch_array($query)){
      $harga = $tampil['harga'];
      $total_harga = $total_harga + $harga;
    }
    return $total_harga;
  }

  function select_dashboard_produk_350000($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = date('m');
    if($perulangan<=9) {
      $perulangan="0".$perulangan;
    }
    $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN '2018-$perulangan-01' AND '2018-$perulangan-31' AND billing_backup_log_user.id_paket =  'B002' OR billing_backup_log_user.bulan BETWEEN '2018-$perulangan-01' AND '2018-$perulangan-31' AND sale_paket_internet.harga BETWEEN '200001' AND '350000' AND billing_backup_log_user.id_paket LIKE 'L0%'");
    while($tampil=mysqli_fetch_array($query)){
      $harga = $tampil['harga'];
      $total_harga = $total_harga + $harga;
    }

    return $total_harga;
  }

  function select_dashboard_produk_500000($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = date('m');
    if($perulangan<=9) {
      $perulangan="0".$perulangan;
    }
    $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND billing_backup_log_user.id_paket =  'B004' OR billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND sale_paket_internet.harga BETWEEN '350001' AND '500000' AND billing_backup_log_user.id_paket LIKE 'L0%'");
    while($tampil=mysqli_fetch_array($query)){
      $harga = $tampil['harga'];
      $total_harga = $total_harga + $harga;
    }
    return $total_harga;
  }

  function select_dashboard_produk_750000($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = date('m');
    if($perulangan<=9) {
      $perulangan="0".$perulangan;
    }
    $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND billing_backup_log_user.id_paket =  'B003' OR billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND sale_paket_internet.harga BETWEEN '500001' AND '750000' AND billing_backup_log_user.id_paket LIKE 'L0%'");
    while($tampil=mysqli_fetch_array($query)){
      $harga = $tampil['harga'];
      $total_harga = $total_harga + $harga;
    }
    return $total_harga;
  }
  
  function select_dashboard_produk_1000000($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = date('m');
    if($perulangan<=9) {
      $perulangan="0".$perulangan;
    }
    $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND billing_backup_log_user.id_paket =  'B009' OR billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND sale_paket_internet.harga BETWEEN '750001' AND '1000000' AND billing_backup_log_user.id_paket LIKE 'L0%'");
    while($tampil=mysqli_fetch_array($query)){
      $harga = $tampil['harga'];
      $total_harga = $total_harga + $harga;
    }
    return $total_harga;
  }

  function select_dashboard_produk_kostume($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = date('m');
    if($perulangan<=9) {
      $perulangan="0".$perulangan;
    }
    $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND billing_backup_log_user.id_paket LIKE  'L0%' AND sale_paket_internet.harga >=  '1000001'");
    while($tampil=mysqli_fetch_array($query)){
      $harga = $tampil['harga'];
      $total_harga = $total_harga + $harga;
    }
    return $total_harga;
  }

  function select_dashboard_produk_khusus($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = date('m');
    if($perulangan<=9) {
      $perulangan="0".$perulangan;
    }
    $query=mysqli_query($koneksi,"select * from billing_backup_log_user left join sale_paket_internet on billing_backup_log_user.id_paket=sale_paket_internet.id_paket where billing_backup_log_user.bulan between '2018-$perulangan-01' and '2018-$perulangan-31' and billing_backup_log_user.id_paket not like 'L0%' and billing_backup_log_user.id_paket not like 'B00%'");
    while($tampil=mysqli_fetch_array($query)){
      $harga = $tampil['harga'];
      $total_harga = $total_harga + $harga;
    }
    return $total_harga;
  }
  
  function select_dashboard_pengguna_produk_200000($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = date('m');
    if($perulangan<=9) {
      $perulangan="0".$perulangan;
    }
    $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND billing_backup_log_user.id_paket =  'B001' OR billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND sale_paket_internet.harga <= '200000'  AND billing_backup_log_user.id_paket LIKE 'L0%'");
    $data=mysqli_num_rows($query);
    return $data;
  }

  function select_dashboard_pengguna_produk_350000($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = date('m');
    if($perulangan<=9) {
      $perulangan="0".$perulangan;
    }
    $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN '2018-$perulangan-01' AND '2018-$perulangan-31' AND billing_backup_log_user.id_paket =  'B002' OR billing_backup_log_user.bulan BETWEEN '2018-$perulangan-01' AND '2018-$perulangan-31' AND sale_paket_internet.harga BETWEEN '200001' AND '350000' AND billing_backup_log_user.id_paket LIKE 'L0%'");
    $data=mysqli_num_rows($query);

    return $data;
  }

  function select_dashboard_pengguna_produk_500000($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = date('m');
    if($perulangan<=9) {
      $perulangan="0".$perulangan;
    }
    $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND billing_backup_log_user.id_paket =  'B004' OR billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND sale_paket_internet.harga BETWEEN '350001' AND '500000' AND billing_backup_log_user.id_paket LIKE 'L0%'");
    $data=mysqli_num_rows($query);
    return $data;
  }

  function select_dashboard_pengguna_produk_750000($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = date('m');
    if($perulangan<=9) {
      $perulangan="0".$perulangan;
    }
    $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND billing_backup_log_user.id_paket =  'B003' OR billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND sale_paket_internet.harga BETWEEN '500001' AND '750000' AND billing_backup_log_user.id_paket LIKE 'L0%'");
    $data=mysqli_num_rows($query);
    return $data;
  }
  
  function select_dashboard_pengguna_produk_1000000($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = date('m');
    if($perulangan<=9) {
      $perulangan="0".$perulangan;
    }
    $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND billing_backup_log_user.id_paket =  'B009' OR billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND sale_paket_internet.harga BETWEEN '750001' AND '1000000' AND billing_backup_log_user.id_paket LIKE 'L0%'");
    $data=mysqli_num_rows($query);
    return $data;
  }

  function select_dashboard_pengguna_produk_kostume($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = date('m');
    if($perulangan<=9) {
      $perulangan="0".$perulangan;
    }
    $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND billing_backup_log_user.id_paket LIKE  'L0%' AND sale_paket_internet.harga >=  '1000001'");
    $data=mysqli_num_rows($query);
    return $data;
  }

  function select_dashboard_pengguna_produk_khusus($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = date('m');
    if($perulangan<=9) {
      $perulangan="0".$perulangan;
    }
    $query=mysqli_query($koneksi,"select * from billing_backup_log_user left join sale_paket_internet on billing_backup_log_user.id_paket=sale_paket_internet.id_paket where billing_backup_log_user.bulan between '2018-$perulangan-01' and '2018-$perulangan-31' and billing_backup_log_user.id_paket not like 'L0%' and billing_backup_log_user.id_paket not like 'B00%'");
    $data=mysqli_num_rows($query);
    return $data;
  }




  // --------------------------------------------------------------------------------------------------------------- \\
  function select_target_omset($tahun) {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select * from manajemen_target_omset where tanggal_target_omset between '2018-01-01' and '2018-12-31'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_grafik_user_hold($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = 1;
    $bulan = date('m');
    for($perulangan=1;$perulangan<=$bulan;$perulangan++){
      if($perulangan<=9) {
        $perulangan="0".$perulangan;
      }
      $query=mysqli_query($koneksi,"select * from sale_register left join sale_paket_internet on sale_register.id_paket=sale_paket_internet.id_paket where sale_register.tanggal_hold between '2018-$perulangan-01' and '2018-$perulangan-31' and sale_register.status='Hold'");
      $jumlah_user_hold = mysqli_num_rows($query);
      $data[]=$jumlah_user_hold;
    }
    return $data;
  }

  function select_realita_omset($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = 1;
    $bulan = date('m');
    for($perulangan=1;$perulangan<=$bulan;$perulangan++){
      if($perulangan<=9) {
        $perulangan="0".$perulangan;
      }
      $query=mysqli_query($koneksi,"select * from billing_backup_log_user left join sale_paket_internet on billing_backup_log_user.id_paket=sale_paket_internet.id_paket where billing_backup_log_user.bulan between '2018-$perulangan-01' and '2018-$perulangan-31'");
      while($tampil=mysqli_fetch_array($query)){
        $harga = $tampil['harga'];
        $total_harga = $total_harga + $harga;
      }
      $data[]=$total_harga;
      $total_harga=0;
    }
    return $data;
  }

  function select_permintaan_pemasangan($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = 1;
    $bulan = date('m');
    for($perulangan=1;$perulangan<=$bulan;$perulangan++){
      if($perulangan<=9) {
        $perulangan="0".$perulangan;
      }
      $query=mysqli_query($koneksi,"select * from sale_register where tanggal_register between '2018-$perulangan-01' and '2018-$perulangan-31'");
      $jumlah_1=mysqli_num_rows($query);

      $query=mysqli_query($koneksi,"select * from sale_register where tanggal_register between '2018-01-01' and '2018-$perulangan-31' and tanggal_pemasangan='0000-00-00'");
      $jumlah_2=mysqli_num_rows($query);
      $data[]=$jumlah_1+$jumlah_2;
    }
    return $data;
  }

  function select_realita_pemasangan($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = 1;
    $bulan = date('m');
    for($perulangan=1;$perulangan<=$bulan;$perulangan++){
      if($perulangan<=9) {
        $perulangan="0".$perulangan;
      }
      $query=mysqli_query($koneksi,"select * from sale_register where tanggal_pemasangan between '2018-$perulangan-01' and '2018-$perulangan-31'");
      $jumlah=mysqli_num_rows($query);
      $data[]=$jumlah;
    }
    return $data;
  }

  function select_realita_tagihan_terbayar($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = 1;
    $bulan_perulangan = date('m');
    $bulan = date('m');
    for($perulangan=1;$perulangan<=$bulan_perulangan;$perulangan++){
      $query = mysqli_query($koneksi,"select (sale_register.billing_bulan_berjalan - sale_register.billing_bulan_terbayar), sale_register.billing_bulan_berjalan, sale_register.status, sale_register.id_paket, sale_paket_internet.id_paket, sale_paket_internet.harga from sale_register left join sale_paket_internet on sale_register.id_paket=sale_paket_internet.id_paket where sale_register.status='Close' and (sale_register.billing_bulan_berjalan - sale_register.billing_bulan_terbayar)>='$bulan'");
      while($data=mysqli_fetch_array($query)){
        $piutang = $piutang + $data['harga'];
      }

      $query=mysqli_query($koneksi,"select * from billing_backup_log_user left join sale_paket_internet on billing_backup_log_user.id_paket=sale_paket_internet.id_paket where billing_backup_log_user.bulan between '2018-$perulangan-01' and '2018-$perulangan-31'");
      while($tampil=mysqli_fetch_array($query)){
        $harga = $tampil['harga'];
        $total_harga = $total_harga + $harga;
      }

      $jumlah_tagihan_terbayar = $total_harga - $piutang;
      $data_tagihan_terbayar[]=$jumlah_tagihan_terbayar;
      $piutang = 0;
      $total_harga = 0;
      $bulan = $bulan-1;
    }
    return $data_tagihan_terbayar;
  }

  function select_tagihan_tak_terbayar($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = 1;
    $bulan_perulangan = date('m');
    $bulan = date('m');
    for($perulangan=1;$perulangan<=$bulan_perulangan;$perulangan++){
      $query = mysqli_query($koneksi,"select (sale_register.billing_bulan_berjalan - sale_register.billing_bulan_terbayar), sale_register.billing_bulan_berjalan, sale_register.status, sale_register.id_paket, sale_paket_internet.id_paket, sale_paket_internet.harga from sale_register left join sale_paket_internet on sale_register.id_paket=sale_paket_internet.id_paket where sale_register.status='Close' and (sale_register.billing_bulan_berjalan - sale_register.billing_bulan_terbayar)>='$bulan'");
      while($data=mysqli_fetch_array($query)){
        $piutang = $piutang + $data['harga'];
      }
      $data_piutang[]=$piutang;
      $piutang = 0;
      $bulan = $bulan-1;
    }
    return $data_piutang;
  }

  function select_pengguna_produk_200000($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = 1;
    $bulan = date('m');
    for($perulangan=1;$perulangan<=$bulan;$perulangan++){
      if($perulangan<=9) {
        $perulangan="0".$perulangan;
      }
      $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND billing_backup_log_user.id_paket =  'B001' OR billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND sale_paket_internet.harga <= '200000'  AND billing_backup_log_user.id_paket LIKE 'L0%'");
      while($tampil=mysqli_fetch_array($query)){
        $harga = $tampil['harga'];
        $total_harga = $total_harga + $harga;
      }
      $data[]=$total_harga;
      $total_harga=0;
    }
    return $data;
  }

  function select_pengguna_produk_350000($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = 1;
    $bulan = date('m');
    for($perulangan=1;$perulangan<=$bulan;$perulangan++){
      if($perulangan<=9) {
        $perulangan="0".$perulangan;
      }
      $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN '2018-$perulangan-01' AND '2018-$perulangan-31' AND billing_backup_log_user.id_paket =  'B002' OR billing_backup_log_user.bulan BETWEEN '2018-$perulangan-01' AND '2018-$perulangan-31' AND sale_paket_internet.harga BETWEEN '200001' AND '350000' AND billing_backup_log_user.id_paket LIKE 'L0%'");
      while($tampil=mysqli_fetch_array($query)){
        $harga = $tampil['harga'];
        $total_harga = $total_harga + $harga;
      }
      $data[]=$total_harga;
      $total_harga=0;
    }
    return $data;
  }

  function select_pengguna_produk_500000($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = 1;
    $bulan = date('m');
    for($perulangan=1;$perulangan<=$bulan;$perulangan++){
      if($perulangan<=9) {
        $perulangan="0".$perulangan;
      }
      $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND billing_backup_log_user.id_paket =  'B004' OR billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND sale_paket_internet.harga BETWEEN '350001' AND '500000' AND billing_backup_log_user.id_paket LIKE 'L0%'");
      while($tampil=mysqli_fetch_array($query)){
        $harga = $tampil['harga'];
        $total_harga = $total_harga + $harga;
      }
      $data[]=$total_harga;
      $total_harga=0;
    }
    return $data;
  }

  function select_pengguna_produk_750000($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = 1;
    $bulan = date('m');
    for($perulangan=1;$perulangan<=$bulan;$perulangan++){
      if($perulangan<=9) {
        $perulangan="0".$perulangan;
      }
      $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND billing_backup_log_user.id_paket =  'B003' OR billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND sale_paket_internet.harga BETWEEN '500001' AND '750000' AND billing_backup_log_user.id_paket LIKE 'L0%'");
      while($tampil=mysqli_fetch_array($query)){
        $harga = $tampil['harga'];
        $total_harga = $total_harga + $harga;
      }
      $data[]=$total_harga;
      $total_harga=0;
    }
    return $data;
  }
  
  function select_pengguna_produk_1000000($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = 1;
    $bulan = date('m');
    for($perulangan=1;$perulangan<=$bulan;$perulangan++){
      if($perulangan<=9) {
        $perulangan="0".$perulangan;
      }
      $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND billing_backup_log_user.id_paket =  'B009' OR billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND sale_paket_internet.harga BETWEEN '750001' AND '1000000' AND billing_backup_log_user.id_paket LIKE 'L0%'");
      while($tampil=mysqli_fetch_array($query)){
        $harga = $tampil['harga'];
        $total_harga = $total_harga + $harga;
      }
      $data[]=$total_harga;
      $total_harga=0;
    }
    return $data;
  }

  function select_pengguna_produk_kostume($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = 1;
    $bulan = date('m');
    for($perulangan=1;$perulangan<=$bulan;$perulangan++){
      if($perulangan<=9) {
        $perulangan="0".$perulangan;
      }
      $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND billing_backup_log_user.id_paket LIKE  'L0%' AND sale_paket_internet.harga >=  '1000001'");
      while($tampil=mysqli_fetch_array($query)){
        $harga = $tampil['harga'];
        $total_harga = $total_harga + $harga;
      }
      $data[]=$total_harga;
      $total_harga=0;
    }
    return $data;
  }

  function select_pengguna_produk_khusus($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = 1;
    $bulan = date('m');
    for($perulangan=1;$perulangan<=$bulan;$perulangan++){
      if($perulangan<=9) {
        $perulangan="0".$perulangan;
      }
      $query=mysqli_query($koneksi,"select * from billing_backup_log_user left join sale_paket_internet on billing_backup_log_user.id_paket=sale_paket_internet.id_paket where billing_backup_log_user.bulan between '2018-$perulangan-01' and '2018-$perulangan-31' and billing_backup_log_user.id_paket not like 'L0%' and billing_backup_log_user.id_paket not like 'B00%'");
      while($tampil=mysqli_fetch_array($query)){
        $harga = $tampil['harga'];
        $total_harga = $total_harga + $harga;
      }
      $data[]=$total_harga;
      $total_harga=0;
    }
    return $data;
  }
  
  function select_nilai_produk_200000($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = 1;
    $bulan = date('m');
    for($perulangan=1;$perulangan<=$bulan;$perulangan++){
      if($perulangan<=9) {
        $perulangan="0".$perulangan;
      }
      $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND billing_backup_log_user.id_paket =  'B001' OR billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND sale_paket_internet.harga <= '200000'  AND billing_backup_log_user.id_paket LIKE 'L0%'");
      $tampil=mysqli_num_rows($query);
      $data[]=$tampil;
    }
    return $data;
  }

  function select_nilai_produk_350000($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = 1;
    $bulan = date('m');
    for($perulangan=1;$perulangan<=$bulan;$perulangan++){
      if($perulangan<=9) {
        $perulangan="0".$perulangan;
      }
      $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN '2018-$perulangan-01' AND '2018-$perulangan-31' AND billing_backup_log_user.id_paket =  'B002' OR billing_backup_log_user.bulan BETWEEN '2018-$perulangan-01' AND '2018-$perulangan-31' AND sale_paket_internet.harga BETWEEN '200001' AND '350000' AND billing_backup_log_user.id_paket LIKE 'L0%'");
      $tampil=mysqli_num_rows($query);
      $data[]=$tampil;
    }
    return $data;
  }

  function select_nilai_produk_500000($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = 1;
    $bulan = date('m');
    for($perulangan=1;$perulangan<=$bulan;$perulangan++){
      if($perulangan<=9) {
        $perulangan="0".$perulangan;
      }
      $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND billing_backup_log_user.id_paket =  'B004' OR billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND sale_paket_internet.harga BETWEEN '350001' AND '500000' AND billing_backup_log_user.id_paket LIKE 'L0%'");
      $tampil=mysqli_num_rows($query);
      $data[]=$tampil;
    }
    return $data;
  }

  function select_nilai_produk_750000($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = 1;
    $bulan = date('m');
    for($perulangan=1;$perulangan<=$bulan;$perulangan++){
      if($perulangan<=9) {
        $perulangan="0".$perulangan;
      }
      $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND billing_backup_log_user.id_paket =  'B003' OR billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND sale_paket_internet.harga BETWEEN '500001' AND '750000' AND billing_backup_log_user.id_paket LIKE 'L0%'");
      $tampil=mysqli_num_rows($query);
      $data[]=$tampil;
    }
    return $data;
  }
  
  function select_nilai_produk_1000000($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = 1;
    $bulan = date('m');
    for($perulangan=1;$perulangan<=$bulan;$perulangan++){
      if($perulangan<=9) {
        $perulangan="0".$perulangan;
      }
      $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND billing_backup_log_user.id_paket =  'B009' OR billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND sale_paket_internet.harga BETWEEN '750001' AND '1000000' AND billing_backup_log_user.id_paket LIKE 'L0%'");
      $tampil=mysqli_num_rows($query);
      $data[]=$tampil;
    }
    return $data;
  }

  function select_nilai_produk_kostume($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = 1;
    $bulan = date('m');
    for($perulangan=1;$perulangan<=$bulan;$perulangan++){
      if($perulangan<=9) {
        $perulangan="0".$perulangan;
      }
      $query=mysqli_query($koneksi,"SELECT * FROM billing_backup_log_user LEFT JOIN sale_paket_internet ON billing_backup_log_user.id_paket = sale_paket_internet.id_paket WHERE billing_backup_log_user.bulan BETWEEN  '2018-$perulangan-01' AND  '2018-$perulangan-31' AND billing_backup_log_user.id_paket LIKE  'L0%' AND sale_paket_internet.harga >=  '1000001'");
      $tampil=mysqli_num_rows($query);
      $data[]=$tampil;
    }
    return $data;
  }

  function select_nilai_produk_khusus($tahun) {
    include "../../koneksi/koneksi.php";

    $perulangan = 1;
    $bulan = date('m');
    for($perulangan=1;$perulangan<=$bulan;$perulangan++){
      if($perulangan<=9) {
        $perulangan="0".$perulangan;
      }
      $query=mysqli_query($koneksi,"select * from billing_backup_log_user left join sale_paket_internet on billing_backup_log_user.id_paket=sale_paket_internet.id_paket where billing_backup_log_user.bulan between '2018-$perulangan-01' and '2018-$perulangan-31' and billing_backup_log_user.id_paket not like 'L0%' and billing_backup_log_user.id_paket not like 'B00%'");
      $tampil=mysqli_num_rows($query);
      $data[]=$tampil;
    }
    return $data;
  }

  function select_data_user_hold() {
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"select * from sale_register where status='Hold' order by tanggal_hold DESC");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }
  
}


$select = new select;
?>