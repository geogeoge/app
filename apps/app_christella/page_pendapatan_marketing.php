<section class="content-header">
  <h1 class="">
    Data Gaji Marketing
    <small>Per-User</small>
    <div class="tombol_tambah">
      <!-- <a href="#tambah_pembayaran" role="button"  data-target = "#tambah_pembayaran" data-toggle="modal" class="btn btn-primary">&nbsp;Transaksi Tidak Teridentifikasi</a> -->
    </div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel Gaji Marketing</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th width="10">No</th>
              <th>Marketing</th>
              <th>Tanggal<br> Bergabung</th>
              <th>Prestasi Bulan Ini</th>
              <th>Subsidi Bulan Ini</th>
              <th>Gaji Bulan Ini</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no=1;
            foreach($select->select_data_marketing() as $data) {
            $saldo_subsidi="0";
            $id_marketing=$data['id_marketing'];

            $prestasi = $select->select_data_user_close_di_table_backup($id_marketing);
            $subsidi = $select->select_data_subsidi_bulan_ini($id_marketing);
            $gaji = $prestasi+$subsidi;
          include "modal_edit_subsidi_bulan_ini.php";

            ?>
            <tr>
              <td align="center" width="10"><?php echo $id_marketing; ?></td>
              <td align="left" width="200"><?php echo $data['nama_marketing']; ?></td>
              <td align="center" width="100"><?php echo $data['tanggal_bergabung']; ?></td>
              <td align="right"><?php echo number_format($prestasi,0,',','.'); ?></td>
              <td align="right"><a href="#edit_subsidi<?php echo $id_marketing; ?>" role="button"  data-target = "#edit_subsidi<?php echo $id_marketing; ?>" data-toggle="modal"><font color="black"><?php echo number_format($subsidi,0,',','.'); ?></font></a></td>
              
              <td align="right"><?php echo number_format($gaji,0,',','.'); ?></td>
              <td width="50" align="center">
                <a href="?page=page_detail_gaji_marketing&id_marketing=<?php echo $id_marketing; ?>" class="btn btn-info"><i class="fa fa-search"></i></a>
              </td>
            </tr>
          <?php
          $no++;
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th width="10">No</th>
              <th>Marketing</th>
              <th>Tanggal<br> Bergabung</th>
              <th>Prestasi Bulan Ini</th>
              <th>Subsidi Bulan Ini</th>
              <th>Gaji Bulan Ini</th>
              <th>Action</th>
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

