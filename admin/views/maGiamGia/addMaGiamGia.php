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
          <h1>Quản lý mã giảm giá</h1>
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
              <h3 class="card-title">Thêm mã giảm giá</h3>
            </div>


            <form action="<?= BASE_URL_ADMIN . '?act=them_ma_giam_gia' ?>" method="POST" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <label >Mã giảm giá</label>
                  <input type="text" class="form-control" name="ma" placeholder="Nhập Mã giảm giá">
                  <?php if(isset($_SESSION['error']['ma'])){  ?>
                    <p class="text-danger"><?= $_SESSION['error']['ma'] ?></p>
                  <?php } ?>
                </div>
                <div class="form-group">
                  <label >Giá trị giảm giá</label>
                  <input type="number" class="form-control" name="gia_tri_giam" placeholder="Nhập Giá trị giảm giá">
                  <?php if(isset($_SESSION['error']['gia_tri_giam'])){  ?>
                    <p class="text-danger"><?= $_SESSION['error']['gia_tri_giam'] ?></p>
                  <?php } ?>
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