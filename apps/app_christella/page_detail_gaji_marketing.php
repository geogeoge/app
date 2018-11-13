 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Gaji Marketing
        <small>SoloNET</small>
        <div class="tombol_tambah">
          <a href="?page=page_pendapatan_marketing" class="btn btn-primary">&nbsp;Kembali</a>
        </div>
      </h1>
    </section>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> SoloNET.
            <small class="pull-right"><b><?php echo date('d')." ".$bulan_indonesia[date('m')]." ".date('Y');?></b></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Marketing
          <address>
            <strong>
            <?php 
              $subsidi = $select->select_data_subsidi_bulan_ini($_GET['id_marketing']);
              $id_marketing = $_GET['id_marketing'];
              include "modal_edit_subsidi_bulan_ini.php";


              $query = mysqli_query($koneksi,"select * from sale_marketing where id_marketing='$_GET[id_marketing]'");
              $data = mysqli_fetch_array($query);

              echo $data['nama_marketing']; 
            ?></strong><br>
          </address>
        </div>
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th width="10">No</th>
              <th>Paketan</th>
              <th>Harga</th>
              <th>Jumlah</th>
              <th>Bonus</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no=1;
            $total=0;
            foreach ($select->select_data_paket_internet() as $data) {
              $id_paket = $data['id_paket'];
              $jumlah = $select->select_data_user_seusai_paket_sesuai_marketing($_GET['id_marketing'], $id_paket);
              if($jumlah>=1){
                $subtotal = $jumlah * $data['bonus_marketing'];
            ?>
            <tr>
              <td align="center"><?php echo $no;?></td>
              <td align="center"><?php echo $data['nama_paket'];?></td>
              <td align="center"><?php echo number_format($data['harga'],0,',','.');?></td>
              <td align="center"><?php echo $jumlah;?></td>
              <td align="right"><?php echo number_format($data['bonus_marketing'],0,',','.');?></td>
              <td align="right"><?php echo number_format($subtotal,0,',','.');?></td>
            </tr>
            <?php
                $no++;
                $total=$total+$subtotal;
              }
            }
            ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Total :</th>
                <td align="right"><?php echo number_format($total,0,',','.');?></td>
              </tr>
              <tr>
                <th style="width:50%">Subsidi :</th>
                <td align="right"><a href="#edit_subsidi<?php echo $id_marketing; ?>" role="button"  data-target = "#edit_subsidi<?php echo $id_marketing; ?>" data-toggle="modal"><font color="black"><?php echo number_format($subsidi,0,',','.'); ?></font></a></td>
              </tr>
              <tr>
                <th style="width:50%">GAJI BERSIH :</th>
                <td align="right"><b><?php echo number_format($subsidi+$total,0,',','.');?></b></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>