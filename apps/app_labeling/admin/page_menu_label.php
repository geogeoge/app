<section class="content-header">
  <h1>
    Data Label
    <small>SoloNet</small>
    <div class="tombol_tambah">
      <a href="#tambah_label" role="button"  data-target = "#tambah_label" data-toggle="modal" class="btn btn-primary">&nbsp;Tambah Label</a>
    </div>
  </h1>
</section>
<?php include "modal_tambah_data_label.php"; ?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel Data Label</h3>
        </div>
        
        <!-- /.box-header -->
         <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Posisi</th>
              <th>Nama BTS</th>
              <th>No Lantai</th>
              <th>Nama Ruang</th>
              <th>Nama Rak</th>
              <th>No Rak</th>
              <th>Nama Device</th>
              <th>No Port</th>
              <th>Kode</th>
              <th width="230" align="center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no="1";
            foreach($crud->select_label() as $data_label) {
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
            <tr>
              <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php echo $no; ?></td>
              <td width="10" align="center">Asal</td>
              <td align="left"><?php echo $data_label['nama_gedung_a']; ?></td>
              <td align="center"><?php echo $data_label['no_lantai_a']; ?></td>
              <td align="center"><?php echo $data_label['nama_ruang_a']; ?></td>
              <td align="center"><?php echo $data_label['nama_rak_a']; ?></td>
              <td align="center"><?php echo $data_label['no_rak_a']; ?></td>
              <td align="left"><?php echo $data_label['nama_device_a']; ?></td>
              <td align="center"><?php echo $data_label['no_port_a']; ?></td>
              <td align="center"><?php echo $kode_a; ?></td>
              <td rowspan="2" style="vertical-align: middle; width: 150px;" width="230" align="center">
                <a href="#hapus_data_label<?php echo $id_label; ?>" role="button"  data-target = "#hapus_data_label<?php echo $id_label;?>" data-toggle="modal" class="btn btn-danger"><i class="icon-trash icon-large"></i>&nbsp;Delete</a>
                <a href="#edit_data_label<?php echo $id_label; ?>" role="button"  data-target = "#edit_data_label<?php echo $id_label; ?>" data-toggle="modal" class="btn btn-success"><i class="icon-trash icon-large"></i>&nbsp;Edit</a>
                <a href="?page=page_tampil_generate&id=<?php echo $id_label; ?>" class="btn btn-info"><i class="icon-trash icon-large"></i>&nbsp;Tampil</a>
              </td>
            </tr>
            <tr>
              <td>Tujuan</td>
              <td align="left"><?php echo $data_label['nama_gedung_t']; ?></td>
              <td align="center"><?php echo $data_label['no_lantai_t']; ?></td>
              <td align="center"><?php echo $data_label['nama_ruang_t']; ?></td>
              <td align="center"><?php echo $data_label['nama_rak_t']; ?></td>
              <td align="center"><?php echo $data_label['no_rak_t']; ?></td>
              <td align="left"><?php echo $data_label['nama_device_t']; ?></td>
              <td align="center"><?php echo $data_label['no_port_t']; ?></td>
              <td align="center"><?php echo $kode_t; ?></td>
              <?php
              include "modal_edit_data_label.php";
              include "modal_hapus_data_label.php";
              $no++
              ?>
            </tr>
          <?php
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>No</th>
              <th>Posisi</th>
              <th>Nama BTS</th>
              <th>No Lantai</th>
              <th>Nama Ruang</th>
              <th>Nama Rak</th>
              <th>No Rak</th>
              <th>Nama Device</th>
              <th>No Port</th>
              <th>Kode</th>
              <th width="230" align="center">Action</th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>