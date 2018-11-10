<section class="content-header">
  <h1>
    Data User Trial
    <small>SoloNet</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="nav-tabs-custom">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs pull-right">
      <li <?php if(empty($_GET['id_marketing'])){ echo "Class='active'";} ?>><a href="?page=page_data_user_trial">SEMUA</a></li>
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
      <li <?php echo $active;?>><a href="?page=page_data_user_trial&id_marketing=<?php echo $id_data_marketing;?>"><?php echo $nama['0']; ?></a></li>
      <?php
      }
      ?>
      <li class="pull-left header"><i class="fa fa-inbox"></i> User Trial</li>
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
            if(isset($_GET['id_marketing'])) {
              $id_marketing = $_GET['id_marketing'];
            }
            foreach($data_user_close->select_data_user_trial_per_marketing($id_marketing) as $data) {
            ?>
            <tr>
              <td width="10" align="center"><?php echo $no; ?></td>
              <td width="100" align="center"><?php echo $data['id_register']; ?></td>
              <td align="left"><?php echo $data['nama_user']; ?></td>
              <td align="left"><?php echo $data['alamat']; ?></td>
              <td align="center"><?php echo date('d-m-Y', strtotime($data['tanggal_close'])); ?></td>
              <td align="right"><?php echo $data['harga']; ?></td>
              <?php
              ?>
            </tr>
          <?php
          $no++;
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>No</th>
              <th>ID</th>
              <th>Nama User</th>
              <th>Alamat</th>
              <th>Tanggal Close</th>
              <th>Paket</th>
            </tr>
            </tfoot>
          </table>
        </div>

      </div>
    </div>
  </div>
  <!-- /.row -->
</section>