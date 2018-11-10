<?php
$where = "where status='Pasca-Trial'";
$active_belum = "Class='active'";
$active_sudah = "";
if(isset($_GET['terbayar'])) {
  $where = "where status='Close' or status='Hold'";
  $active_belum = "";
  $active_sudah = "Class='active'";
}
?>
<section class="content-header">
  <h1 class="">
    Data User Baru
    <small>SoloNet</small>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="nav-tabs-custom">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs pull-right">
      <li <?php echo $active_belum;?>><a href="?page=page_access_invoice_user_baru">BELUM TERBAYAR</a></li>
      <li <?php echo $active_sudah;?>><a href="?page=page_access_invoice_user_baru&terbayar=sudah">SUDAH TERBAYAR</a></li>
      <li class="pull-left header">Tagihan User Baru</li>
    </ul>
    <div class="tab-content no-padding">
      <!-- Morris chart - Sales -->
      <div class="tab-pane active" style="position: relative; ">
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th width="100">No Nota</th>
              <th>User</th>
              <th>Tanggal Clossing</th>
              <th>Marketing</th>
              <th>Nominal</th>
              <th width="10">PPN</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no=1;
            foreach($crud->select_billing_po($where) as $data) {
              $id_register = $data['id_register'];
              $nominal_po = $data['biaya_registrasi'] + $data['monthly_fee'];

            if($data['status_radio']=="BELI") {
              $nominal_po = $nominal_po + $data['harga_radio'];
            }
            if($data['status_antena']=="BELI") {
              $nominal_po = $nominal_po + $data['harga_antena'];
            }
            if($data['status_wifi']=="BELI") {
              $nominal_po = $nominal_po + $data['harga_wifi'];
            }
            if($data['status_kabel']=="BELI") {
              $nominal_po = $nominal_po + $data['harga_kabel'];
            }
            if($data['status_tower']=="BELI") {
              $nominal_po = $nominal_po + $data['harga_tower'];
            }
            if($data['status_tambahan_1']=="BELI") {
              $nominal_po = $nominal_po + $data['harga_tambahan_1'];
            }
            if($data['status_tambahan_2']=="BELI") {
              $nominal_po = $nominal_po + $data['harga_tambahan_2'];
            }

            $ppn = 0;
            $tampil_status_ppn = '<i class="fa fa-close"></i>';
            $update_status_ppn = "IYA";

            $status_ppn = $data['ppn'];
            if($status_ppn=="IYA") {
              $ppn = $nominal_po / 10;
              $tampil_status_ppn = '<i class="fa fa-check"></i>';
              $update_status_ppn = "TIDAK";
            }
            $total_po = $nominal_po + $ppn;
            ?>
            <tr>
              <td align="center"><?php echo $data['no_nota']; ?></td>
              <td align="left"><?php echo $data['nama_user']; ?></td>
              <td align="center"><?php echo date('d-m-Y', strtotime($data['tanggal_close'])); ?></td>
              <td align="center"><?php echo $data['nama_marketing']; ?></td>             
              <td align="right"><a href="#edit_monthly_fee<?php echo $id_register; ?>" role="button"  data-target = "#edit_monthly_fee<?php echo $id_register; ?>" data-toggle="modal" style="color:black;"><?php echo number_format($total_po,0,',','.'); ?></a></td>
              <td align="center"><a href="?page=page_access_invoice_user_baru&update_status_ppn=<?php echo $update_status_ppn; ?>&id_register=<?php echo $id_register; ?>" class="btn btn-default">&nbsp;<?php echo $tampil_status_ppn; ?></a></td>
              <td width="200" align="center">
              <?php
              if(empty($_GET['terbayar'])) {
              ?>
                <a href="?page=page_access_input_pembayaran_registasi&id_register=<?php echo $id_register; ?>" class="btn btn-success"><i class="icon-trash icon-large"></i>&nbsp;Bayar</a>
              <?php
              }
              ?>
                <a href="pdf_access_invoice_user_baru_logo.php?id_register=<?php echo $id_register; ?>" class="btn btn-info" target="_blank"><i class="fa fa-print"></i></a>
                <a href="pdf_access_invoice_user_baru.php?id_register=<?php echo $id_register; ?>" class="btn btn-default" target="_blank"><i class="fa fa-print"></i></a>
                <a href="?page=page_access_edt_user_baru&id_register=<?php echo $id_register; ?>" class="btn btn-warning" target="_blank"><i class="fa fa-edit"></i></a>
              </td>
            </tr>
          <?php
          $no++;
          include "modal_edit_monthly_fee.php";
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>No Nota</th>
              <th>User</th>
              <th>Tanggal Clossing</th>
              <th>Marketing</th>
              <th>Nominal</th>
              <th width="10">PPN</th>
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

