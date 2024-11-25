<!-- header? -->
<?php
require './views/layout/header.php'

  ?>
<!-- end header -->
<!-- sidebar -->
<?php
require './views/layout/sidebar.php'

  ?>
<!-- end sidebar -->

<!-- Navbar -->
<?php
include './views/layout/navbar.php'
  ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Quản lý đơn hàng</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Sửa đơn hàng: <?php echo $donHang['ma_don_hang'] ?></h3>
            </div>


            <form action="<?= BASE_URL_ADMIN . '?act=sua_don_hang&id_don_hang=' . $donHang['id'] ?>" method="POST">
              <input type="hidden" name="don_hang_id" value="<?= $donHang['id'] ?>">
              <div class="card-body">
                <div class="form-group">
                  <label>Tên người nhận</label>
                  <input type="text" class="form-control" name="ten_nguoi_nhan"
                    value="<?= $donHang['ten_nguoi_nhan'] ?>" placeholder="Nhập tên người nhận">
                  <?php if (isset($error['ten_nguoi_nhan'])) { ?>
                    <p class="text-danger"><?= $error['ten_nguoi_nhan'] ?></p>
                  <?php } ?>
                </div>
                <div class="form-group">
                  <label>Số điện thoại</label>
                  <input type="text" class="form-control" name="sdt_nguoi_nhan"
                    value="<?= $donHang['sdt_nguoi_nhan'] ?>" placeholder="Nhập số điện điện thoại người nhận">
                  <?php if (isset($error['sdt_nguoi_nhan'])) { ?>
                    <p class="text-danger"><?= $error['sdt_nguoi_nhan'] ?></p>
                  <?php } ?>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" name="email_nguoi_nhan"
                    value="<?= $donHang['email_nguoi_nhan'] ?>" placeholder="Nhập email.người nhận">
                  <?php if (isset($error['email_nguoi_nhan'])) { ?>
                    <p class="text-danger"><?= $error['email_nguoi_nhan'] ?></p>
                  <?php } ?>
                </div>
                <div class="form-group">
                  <label>Địa chỉ</label>
                  <input type="text" class="form-control" name="dia_chi_nguoi_nhan"
                    value="<?= $donHang['dia_chi_nguoi_nhan'] ?>" placeholder="Nhập địa chỉ người nhận">
                  <?php if (isset($error['dia_chi_nguoi_nhan'])) { ?>
                    <p class="text-danger"><?= $error['dia_chi_nguoi_nhan'] ?></p>
                  <?php } ?>
                </div>
                <div class="form-group">
                  <label for="ghi_chu">Ghi chú</label>
                  <textarea name="ghi_chu" id="ghi_chu" class="form-control" row="4" ><?=$donHang['ghi_chu'] ?></textarea>
                </div>
                
              


                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
          </div>
        </div>

        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- footer -->
<?php
include './views/layout/footer.php'
  ?>
<!-- end footer -->


<!-- Code injected by live-server -->

</body>

</html>