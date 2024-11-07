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
          <h1>Quản lý thương hiệu</h1>
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
              <h3 class="card-title">Thêm thương hiệu sản phẩm</h3>
            </div>


            <form action="<?= BASE_URL_ADMIN . '?act=them_thuong_hieu' ?>" method="POST">
              <div class="card-body">
                <div class="form-group">
                  <label >Tên thương hiệu</label>
                  <input type="text" class="form-control" name="ten_thuong_hieu" placeholder="Nhập tên thương hiệu">
                  <?php if(isset($_SESSION['error']['ten_thuong_hieu'])){  ?>
                    <p class="text-danger"><?= $_SESSION['error']['ten_thuong_hieu'] ?></p>
                  <?php } ?>
                </div>
                <div class="form-group">
                  <label >Mô tả</label>
                  <textarea name="mo_ta" id="" class="form-control" placeholder="Nhập mô tả "></textarea>
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