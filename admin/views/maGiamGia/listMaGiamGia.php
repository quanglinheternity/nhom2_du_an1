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
          <h1>Quản lý mã giảm giá </h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">

            <!-- /.card-header -->

            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <a href="<?= BASE_URL_ADMIN . '?act=form_them_ma_giam_gia' ?>">
                <button type="button" class="btn btn-primary">Thêm mã giảm giá</button>
              </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Code mã giảm giá</th>
                    <th>Giá  trị mã giảm giá</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($listMaGiamGia as $key => $maGia) { ?>
                    <tr>
                      <td><?= $key + 1 ?></td>
                      <td><?= $maGia['ma'] ?></td>
                      <td><?= formatPrice($maGia['gia_tri_giam'] ).' đ'?></td>
                      <td><?= formatDate($maGia['ngay_tao']) ?></td>
                      
                      <td>
                        <div class="btn-group">
                          
                          <a href="?act=form_sua_ma_giam&id_ma_giam=<?= $maGia['id'] ?>">
                            <button class="btn btn-warning m"><i class="fas fa-tools"></i></button></a>
                          <a href="?act=xoa_ma_giam_gia&id_ma_giam=<?= $maGia['id'] ?>"

                            onclick="return confirm('Bạn có muốn xóa không?')">
                            <button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>

                        </div>



                      </td>
                    </tr>
                  <?php } ?>


                </tbody>
                <tfoot>
                   <tr>
                    <th>STT</th>
                    <th>Code mã giảm giá</th>
                    <th>Giá  trị mã giảm giá</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
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

<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- Code injected by live-server -->

</body>

</html>