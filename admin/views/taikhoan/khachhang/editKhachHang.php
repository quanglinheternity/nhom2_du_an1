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
          <h1>Quản lý Tài khoản khách hàng</h1>
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
              <h3 class="card-title">Sửa lại Tài khoản khách hàng: <?= $listKhachHang['ho_ten'] ?></h3>
            </div>


            <form action="<?= BASE_URL_ADMIN . '?act=sua_khach_hang' ?>" method="POST">
              <input type="hidden" name="khach_hang_id" value="<?= $listKhachHang['id'] ?>">
              <div class="card-body">
                <div class="form-group">
                  <label >Họ và tên</label>
                  <input type="text" class="form-control" name="ho_ten" value="<?= $listKhachHang['ho_ten'] ?>" placeholder="Nhập họ và tên">
                  <?php if(isset($_SESSION['error']['ho_ten'])){ ?>
                    <p class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></p>
                  <?php } ?>
                </div>
                <div class="form-group">
                  <label >Email</label>
                  <input type="email" class="form-control" name="email" value="<?= $listKhachHang['email'] ?>" placeholder="Nhập Email">
                  <?php if(isset($_SESSION['error']['email'])){ ?>
                    <p class="text-danger"><?= $_SESSION['error']['email'] ?></p>
                  <?php } ?>
                </div>
                <div class="form-group">
                  <label >Số điện thoại</label>
                  <input type="number" class="form-control" name="so_dien_thoai" value="<?= $listKhachHang['so_dien_thoai'] ?>" placeholder="Nhập số điện thoại">
                  <?php if(isset($_SESSION['error']['so_dien_thoai'])){ ?>
                    <p class="text-danger"><?= $_SESSION['error']['so_dien_thoai'] ?></p>
                  <?php } ?>
                </div>
                <div class="form-group">
                  <label >Ngày sinh</label>
                  <input type="date" class="form-control" name="ngay_sinh" value="<?= $listKhachHang['ngay_sinh'] ?>" placeholder="Nhập số điện thoại">
                  <?php if(isset($_SESSION['error']['ngay_sinh'])){ ?>
                    <p class="text-danger"><?= $_SESSION['error']['ngay_sinh'] ?></p>
                  <?php } ?>
                </div>
                <div class="form-group">
                <label for="gioi_tinh">Giới tính</label>
                <select id="gioi_tinh" name="gioi_tinh" class="form-control custom-select">
                  <option disabled>Select one</option>

                  <option <?= $listKhachHang['gioi_tinh'] == 1 ? 'selected' : '' ?> value="1">Nam</option>
                  <option <?= $listKhachHang['gioi_tinh'] !== 1 ? 'selected' : '' ?> value="2">Nữ</option>

                </select>
                </div>
                <div class="form-group">
                  <label >Địa chỉ</label>
                  <input type="text" class="form-control" name="dia_chi" value="<?= $listKhachHang['dia_chi'] ?>" placeholder="Nhập địa chỉ">
                  <?php if(isset($_SESSION['error']['dia_chi'])){ ?>
                    <p class="text-danger"><?= $_SESSION['error']['dia_chi'] ?></p>
                  <?php } ?>
                </div>
                
                <div class="form-group">
                <label for="trang_thai">Trạng thái</label>
                <select id="trang_thai" name="trang_thai" class="form-control custom-select">
                  <option disabled>Select one</option>

                  <option <?= $listKhachHang['trang_thai'] == 1 ? 'selected' : '' ?> value="1">Còn hoạt động</option>
                  <option <?= $listKhachHang['trang_thai'] !== 1 ? 'selected' : '' ?> value="2">Đừng hoạt động</option>

                </select>
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