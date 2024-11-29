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
        <div class="col-4">
          <img src="<?= BASE_URL . $listKhachHang['anh_dai_dien'] ?>" style="width: 100%; " alt=""
            onerror="this.onerror=null;this.src='https://as2.ftcdn.net/v2/jpg/03/49/49/79/1000_F_349497933_Ly4im8BDmHLaLzgyKg2f2yZOvJjBtlw5.jpg';">

        </div>
        <div class="col-8">
          <table class="table table-bordered table-striped">
            <tr>
              <th>Họ tên</th>
              <td><?= $listKhachHang['ho_ten'] ?></td>
            </tr>
            <tr>
              <th>Ngày sinh</th>
              <td><?= $listKhachHang['ngay_sinh'] ?></td>
            </tr>
            <tr>
              <th>Email</th>
              <td><?= $listKhachHang['email'] ?></td>
            </tr>
            <tr>
              <th>Số điện thoại</th>
              <td><?= $listKhachHang['so_dien_thoai'] ?></td>
            </tr>
            <tr>
              <th>Giới tính</th>
              <td><?= $listKhachHang['gioi_tinh'] == 1 ? 'Nam' : 'Nữ' ?></td>
            </tr>
            <tr>
              <th>Địa chỉ</th>
              <td><?= $listKhachHang['dia_chi'] ?></td>
            </tr>
            <tr>
              <th>Trạng thái</th>
              <td><?= $listKhachHang['trang_thai'] == 1 ? 'Active' : 'Inactive' ?></td>
            </tr>

          </table>
        </div>
        <div class="col-12">
          <h2>Thông tin mua hàng</h2>
          <div>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Mã đơn hàng</th>
                  <th>Tên người nhận</th>
                  <th>Số điện thoại</th>
                  <th>Ngày đặt</th>
                  <th>Tổng tiền</th>
                  <th>Trạng thái</th>
                  <th>Thao tác</th>

                </tr>
              </thead>
              <tbody>
              <?php
                  // Sắp xếp $listDonHang theo trang_thai_id tăng dần
                      usort($listDonHang, function($a, $b) {
                        return $a['trang_thai_id'] <=> $b['trang_thai_id'];
                      });
                  foreach ($listDonHang as $key => $donHang) {
                    ?>
                    <tr>
                      <td><?= $key + 1 ?></td>
                      <td><?= $donHang['ma_don_hang'] ?></td>
                      <td><?= $donHang['ten_nguoi_nhan'] ?></td>
                      <td><?= $donHang['sdt_nguoi_nhan'] ?></td>
                      <td><?= $donHang['ngay_dat'] ?></td>
                      <td><?= formatPrice( $donHang['tong_tien'] ).' đ'?></td>
                      <td>
                        <span class="text-<?= getStatusClass($donHang['trang_thai_id']) ?>">
                        <?= $donHang['ten_trang_thai'] ?>
                        </span>
                        
                        
                      </td>
                     
                    <td>
                    <div class="btn-group btn-group-sm">
                          <a href="<?= BASE_URL_ADMIN . '?act=chi_tiet_don_hang&id_don_hang=' . $donHang['id'] ?>" ><button class="btn btn-primary" ><i class="fas fa-eye"></i></button></a>
                          <?php  if($donHang['trang_thai_id']==1){?>
                          <a href="<?= BASE_URL_ADMIN . '?act=huy_don_hang&id_don_hang=' . $donHang['id'] ?>" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng không?')" ><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
                          <?php } ?>
                        </div>
                    </td>
                  </tr>
                <?php } ?>


              </tbody>
              <tfoot>
                <tr>
                  <th>STT</th>
                  <th>Mã đơn hàng</th>
                  <th>Tên người nhận</th>
                  <th>Số điện thoại</th>
                  <th>Ngày đặt</th>
                  <th>Tổng tiền</th>
                  <th>Trạng thái</th>
                  <th>Thao tác</th>

                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <div class="col-12">
          <h2>Lịch sử bình luận</h2>
          <div>
            <table id="example2" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Sản phẩm</th>
                  <th>Nội dung</th>
                  <th>Ngày bình luận</th>
                  <th>Trạng thái</th>
                  <th>Thao tác</th>

                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($listBinhLuan as $key => $binhLuan) {
                  ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td><a target="_blank" href="<?= BASE_URL_ADMIN . '?act=chi_tiet_san_pham&id_san_pham=' . $binhLuan['san_pham_id'] ?>"><?= $binhLuan['ten_san_pham'] ?></a></td>
                    <td><?= $binhLuan['noi_dung'] ?></td>
                    <td><?= $binhLuan['ngay_dang'] ?></td>
                    <td>
                      <span class="text-<?= $binhLuan['trang_thai'] == 2 ? 'danger' : 'success' ?>"><?= $binhLuan['trang_thai'] == 1 ? 'Hiển thị' : 'Bị ẩn' ?></span>
                    </td>
                    <td>
                      
                        
                            <form action="<?= BASE_URL_ADMIN . '?act=update_trang_thai_binh_luan' ?>" method="POST">
                              <input type="hidden" name="id_binh_luan" value="<?= $binhLuan['id'] ?>">
                              <input type="hidden" name="name_view" value="detail_khach">
                              <input type="hidden" name="id_khach_hang" value="<?= $binhLuan['tai_khoan_id'] ?>">
                              <button onclick="return confirm('Bạn có muốn <?= $binhLuan['trang_thai'] == 1 ? 'Ẩn' : 'hiển thị' ?> bình luận này không?')" class="btn btn-<?= $binhLuan['trang_thai'] == 1 ? 'danger' : 'success' ?>">
                                <?= $binhLuan['trang_thai'] == 1 ? "Ẩn bỏ" : "hiển thị" ?>
                              </button>
                            </form>
            
                      
                    </td>
                  </tr>
                <?php } ?>


              </tbody>
              <tfoot>
                <tr>
                <th>STT</th>
                  <th>Sản phẩm</th>
                  <th>Nội dung</th>
                  <th>Ngày bình luận</th>
                  <th>Trạng thái</th>
                  <th>Thao tác</th>

                </tr>
              </tfoot>
            </table>
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
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
           "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
</script>

</html>