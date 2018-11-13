<section class="content-header">
  <h1>
    Data User Close
    <small>SoloNet</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="nav-tabs-custom">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs pull-right">
      <li <?php if(empty($_GET['id_marketing'])){ echo "Class='active'";} ?>><a href="?page=page_data_user_close">SEMUA</a></li>
      <?php
      foreach($data_user_close->select_data_marketing() as $data) {
      $id_data_marketing=$data['id_user'];
      $nama_user=$data['nama_user'];
      $nama = explode(" ", $nama_user);
      $active = "";
      if($id_data_marketing==$_GET['id_marketing']){
        $active = 'class="active"';
      }
      ?>
      <li <?php echo $active;?>><a href="?page=page_data_user_close&id_marketing=<?php echo $id_data_marketing;?>"><?php echo $nama['0']; ?></a></li>
      <?php
      }
      ?>
      <li class="pull-left header"><i class="fa fa-inbox"></i> User Close</li>
    </ul>
    <div class="tab-content no-padding">
      <!-- Morris chart - Sales -->
      <div class="tab-pane active" style="position: relative; ">
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>ID</th>
              <th>Nama User</th>
              <th>Alamat</th>
              <th>Tanggal Close</th>
              <th>Paket</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no=1;
            $id_marketing = "SEMUA";
            $jumlah_nominal = 0;
            if(isset($_GET['id_marketing'])) {
              $id_marketing = $_GET['id_marketing'];
            }
            foreach($data_user_close->select_data_user_close_per_marketing($id_marketing) as $data) {

              $nama_user = $data['nama_user'];
              $nama_instansi = $data['nama_instansi'];

              $nama = $nama_user;
              if(!($nama_instansi=="")){
                  $nama = $nama_instansi." <b>(".$nama_user.")</b>";
                  
              }

              $tanggal_close = date("d-m-Y", strtotime($data['tanggal_close']));
              if($data['tanggal_close']==0000-00-00){
                $tanggal_close = "?";
              }
            ?>
            <tr>
              <td width="10" align="center"><?php echo $no; ?></td>
              <td width="100" align="center"><?php echo $data['id_register']; ?></td>
              <td align="left"><?php echo $data['nama_user']; ?></td>
              <td align="left"><?php echo $data['alamat']; ?></td>
              <td align="center"><a href="#modal_edit_tanggal_clossing<?php echo $data['id_register']; ?>" role="button"  data-target = "#modal_edit_tanggal_clossing<?php echo $data['id_register']; ?>" data-toggle="modal" style="color: black;"><?php echo $tanggal_close; ?></a></td>
              <td align="right"><?php echo number_format($data['harga'],0,',','.'); ?></td>
              <?php
              ?>
            </tr>
          <?php
          $no++;
          $jumlah_nominal = $jumlah_nominal + $data['harga'];
          include "modal_edit_tanggal_clossing.php";
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th colspan='5'>Total Nominal Omset Dari User Close</th>
              <th><?php echo number_format($jumlah_nominal,0,',','.');?></th>
            </tr>
            </tfoot>
          </table>
        </div>

      </div>
    </div>
  </div>
  <!-- /.row -->
</section>