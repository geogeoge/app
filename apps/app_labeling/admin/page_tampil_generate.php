<?php
$id=$_GET['id'];
$query=mysqli_query($koneksi,"select * from label_proses where id='$id'");
$data_label=mysqli_fetch_array($query);
$id_label=$data_label['id'];
//-----------------kode_a----------------------\\
$query_1_a=mysqli_query($koneksi,"select * from label_gedung where nama_gedung='$data_label[nama_gedung_a]'");
$tampil_1_a=mysqli_fetch_array($query_1_a);
$kode_1_a=$tampil_1_a['kode_gedung'];

$kode_2_a=$data_label['no_lantai_a'];

$query_3_a=mysqli_query($koneksi,"select * from label_ruang where nama_ruang='$data_label[nama_ruang_a]'");
$tampil_3_a=mysqli_fetch_array($query_3_a);
$kode_3_a=$tampil_3_a['kode_ruang'];

$query_4_a=mysqli_query($koneksi,"select * from label_rak where nama_rak='$data_label[nama_rak_a]'");
$tampil_4_a=mysqli_fetch_array($query_4_a);
$kode_4_a=$tampil_4_a['kode_rak'];

$kode_5_a=$data_label['no_rak_a'];

$query_6_a=mysqli_query($koneksi,"select * from label_device where nama_device='$data_label[nama_device_a]'");
$tampil_6_a=mysqli_fetch_array($query_6_a);
$kode_6_a=$tampil_6_a['kode_device'];

$kode_7_a=$data_label['no_port_a'];

$kode_a=$kode_1_a.$kode_2_a."/".$kode_3_a."/".$kode_4_a.$kode_5_a."/".$kode_6_a.":".$kode_7_a;
//---------------! kode_a !--------------------\\
//-----------------kode_t----------------------\\
$query_1_a=mysqli_query($koneksi,"select * from label_gedung where nama_gedung='$data_label[nama_gedung_a]'");
$tampil_1_a=mysqli_fetch_array($query_1_a);
$kode_1_a=$tampil_1_a['kode_gedung'];

$kode_2_a=$data_label['no_lantai_a'];

$query_3_a=mysqli_query($koneksi,"select * from label_ruang where nama_ruang='$data_label[nama_ruang_a]'");
$tampil_3_a=mysqli_fetch_array($query_3_a);
$kode_3_a=$tampil_3_a['kode_ruang'];

$query_4_a=mysqli_query($koneksi,"select * from label_rak where nama_rak='$data_label[nama_rak_a]'");
$tampil_4_a=mysqli_fetch_array($query_4_a);
$kode_4_a=$tampil_4_a['kode_rak'];

$kode_5_a=$data_label['no_rak_a'];

$query_6_a=mysqli_query($koneksi,"select * from label_device where nama_device='$data_label[nama_device_a]'");
$tampil_6_a=mysqli_fetch_array($query_6_a);
$kode_6_a=$tampil_6_a['kode_device'];

$kode_7_a=$data_label['no_port_a'];

$kode_a=$kode_1_a.$kode_2_a."/".$kode_3_a."/".$kode_4_a.$kode_5_a."/".$kode_6_a.":".$kode_7_a;
//---------------! kode_a !--------------------\\
//-----------------kode_t----------------------\\
$query_1_t=mysqli_query($koneksi,"select * from label_gedung where nama_gedung='$data_label[nama_gedung_t]'");
$tampil_1_t=mysqli_fetch_array($query_1_t);
$kode_1_t=$tampil_1_t['kode_gedung'];

$kode_2_t=$data_label['no_lantai_t'];

$query_3_t=mysqli_query($koneksi,"select * from label_ruang where nama_ruang='$data_label[nama_ruang_t]'");
$tampil_3_t=mysqli_fetch_array($query_3_t);
$kode_3_t=$tampil_3_t['kode_ruang'];

$query_4_t=mysqli_query($koneksi,"select * from label_rak where nama_rak='$data_label[nama_rak_t]'");
$tampil_4_t=mysqli_fetch_array($query_4_t);
$kode_4_t=$tampil_4_t['kode_rak'];

$kode_5_t=$data_label['no_rak_t'];

$query_6_t=mysqli_query($koneksi,"select * from label_device where nama_device='$data_label[nama_device_t]'");
$tampil_6_t=mysqli_fetch_array($query_6_t);
$kode_6_t=$tampil_6_t['kode_device'];

$kode_7_t=$data_label['no_port_t'];

$kode_t=$kode_1_t.$kode_2_t."/".$kode_3_t."/".$kode_4_t.$kode_5_t."/".$kode_6_t.":".$kode_7_t;
//---------------! kode_t !--------------------\\
?>
<section class="content-header">
  <h1>
    Data Label
    <small>SoloNet</small>
    <div class="tombol_tambah">
      <a href="?page=page_menu_label" role="button" class="btn btn-primary">&nbsp;Kembali</a>
    </div>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header" align="center">
          <h3 class="box-title"><strong>Tabel Detail Label</strong></h3>
        </div>
        
        <!-- /.box-header -->
         <div class="box-body scroll">
          <table class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Posisi</th>
              <th>Nama BTS</th>
              <th>No Lantai</th>
              <th>Nama Ruang</th>
              <th>Nama Rak</th>
              <th>No Rak</th>
              <th>Nama Device</th>
              <th>No Port</th>
            </tr>
            </thead>
            <tbody>
           
            <tr>
              <td align="center">Asal</td>
              <td align="center"><?php echo $data_label['nama_gedung_a']; ?></td>
              <td align="center"><?php echo $data_label['no_lantai_a']; ?></td>
              <td align="center"><?php echo $data_label['nama_ruang_a']; ?></td>
              <td align="center"><?php echo $data_label['nama_rak_a']; ?></td>
              <td align="center"><?php echo $data_label['no_rak_a']; ?></td>
              <td align="center"><?php echo $data_label['nama_device_a']; ?></td>
              <td align="center"><?php echo $data_label['no_port_a']; ?></td>
            </tr>
            <tr>
              <td align="center">Tujuan</td>
              <td align="center"><?php echo $data_label['nama_gedung_t']; ?></td>
              <td align="center"><?php echo $data_label['no_lantai_t']; ?></td>
              <td align="center"><?php echo $data_label['nama_ruang_t']; ?></td>
              <td align="center"><?php echo $data_label['nama_rak_t']; ?></td>
              <td align="center"><?php echo $data_label['no_rak_t']; ?></td>
              <td align="center"><?php echo $data_label['nama_device_t']; ?></td>
              <td align="center"><?php echo $data_label['no_port_t']; ?></td>
            </tr>
            </tbody>
          </table>
        </div>


        </br>
        <div class="box-header" align="center">
          <h3 class="box-title"><strong>Data Label</strong></h3>
        </div>
        <div class="box-body scroll">
          <table class="table table-bordered table-striped">
            <thead>
            <tr>
              <th width="100">Posisi</th>
              <th>Label</th>
            </tr>
            </thead>
            <tbody>
           
            <tr>
              <td align="center"><strong>Asal</strong></td>
              <td align="center"><strong><?php echo $kode_a; ?></strong></td>
            </tr>
            <tr>
              <td align="center"><strong>Tujuan</strong></td>
              <td align="center"><strong><?php echo $kode_t; ?></strong></td>
            </tr>

            </tbody>
          </table>
        </div>

        </br>

        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>