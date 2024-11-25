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
          <h1>Quản lý Danh Sách Nước Hoa </h1>
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
              <a href="<?= BASE_URL_ADMIN . '?act=form_them_san_pham' ?>">
                <button type="button" class="btn btn-primary">Thêm Nước Hoa Mới</button>
              </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên sản Phẩm</th>
                    <th>Ảnh Sản Phẩm</th>
                    <th>Giá Tiền</th>
                    <th>Số Lượng</th>
                    <th>Thương Hiệu </th>
                    <th>Trạng Thái</th>
                    <th>Thao tác</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($listSanPham as $key => $SanPham) { ?>
                    <tr>
                      <td><?= $key + 1 ?></td>
                      <td><?= $SanPham['ten_san_pham'] ?></td>
                      <td>
                        <img src="<?= BASE_URL . $SanPham['hinh_anh'] ?>" style="width:100px;height:100px" alt="">
                      </td>
                      <td><?= $SanPham['gia_san_pham'] ?></td>
                      <td><?= $SanPham['so_luong'] ?></td>
                      <td><?= $SanPham['ten_thuong_hieu'] ?></td>
                      <td><?= $SanPham['trang_thai'] == 1 ? 'Còn Bán' : 'Dừng Bán' ?></td>
                      <td>
                        <div class="btn-group">
                          <a href="?act=chi_tiet_san_pham&id_san_pham=<?= $SanPham['id'] ?>">
                            <button class="btn btn-primary m"><i class="fas fa-eye"></i></button></a>
                          <a href="?act=form_sua_san_pham&id_san_pham=<?= $SanPham['id'] ?>">
                            <button class="btn btn-warning m"><i class="fas fa-tools"></i></button></a>
                          <a href="?act=xoa_san_pham&id_san_pham=<?= $SanPham['id'] ?>"

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
                    <th>Tên sản Phẩm</th>
                    <th>Ảnh Sản Phẩm</th>
                    <th>Giá Tiền</th>
                    <th>Số Lượng</th>
                    <th>Thương Hiệu </th>
                    <th>Trạng Thái</th>
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