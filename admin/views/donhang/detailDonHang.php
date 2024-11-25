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
        <div class="col-sm-10">
          <h1>Quản lý danh sách đơn hàng - Đơn hàng: <?= $donHang['ma_don_hang'] ?></h1>
        </div>
        <div class="col-sm-2">
          <?php
          foreach ($listTrangThai as $trangThai) {
            if ($trangThai['id'] == $donHang['trang_thai_id']) {
              // Xác định trạng thái tiếp theo
              $trangThaiSau = null;
              foreach ($listTrangThai as $nextTrangThai) {
                if (($nextTrangThai['id'] == $donHang['trang_thai_id'] + 1) && $nextTrangThai['id'] <= 7) {
                  $trangThaiSau = $nextTrangThai;
                  break;
                }
              }
              ?>

              <!-- Hiển thị nút với tên trạng thái kế tiếp -->
              <?php if ($nextTrangThai['id'] <= 7) { ?>
                <a href="<?= BASE_URL_ADMIN . '?act=cap_nhat_don_hang&id_don_hang=' . $donHang['id'] ?>"
                  onclick="return confirm('Bạn có chắc muốn cập nhật đơn hàng sang trạng thái: <?= $trangThaiSau['ten_trang_thai'] ?? 'kế tiếp' ?> không?')">
                  <button class="btn btn-<?= getStatusClassSau($trangThai['id']) ?>">
                    <?= $trangThaiSau['ten_trang_thai'] ?? 'Kế tiếp' ?>
                  </button>
                </a>
                <?php if ($donHang['trang_thai_id'] == 1) { ?>
                  <a href="<?= BASE_URL_ADMIN . '?act=huy_don_hang&id_don_hang=' . $donHang['id'] ?>"
                    onclick="return confirm('Bạn có chắc muốn hủy đơn hàng không?')"><button class="btn btn-danger"><i
                        class="fas fa-trash"></i></button></a>
                <?php } ?>
                <?php
              }
            }
          }
          ?>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="alert alert-<?= getStatusClass($donHang['trang_thai_id']) ?>" role="alert">
            Đơn Hàng : <?= $donHang['ten_trang_thai'] ?>
          </div>


          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z"/>
                </svg>   Shop bán nước hoa
                  <small class="float-right">Ngày đặt: <?php echo formatDate($donHang['ngay_dat']) ?></small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                Thông tin người đặt
                <address>
                  <strong><?= $donHang['ho_ten'] ?></strong><br>
                  Email: <?= $donHang['email'] ?><br>
                  Số điện thoại: <?= $donHang['so_dien_thoai'] ?><br><br>

                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                Người nhận
                <address>
                  <strong><?= $donHang['ten_nguoi_nhan'] ?></strong><br>
                  Email: <?= $donHang['email_nguoi_nhan'] ?><br>
                  Số điện thoại: <?= $donHang['sdt_nguoi_nhan'] ?><br>
                  Địa chi: <?= $donHang['dia_chi_nguoi_nhan'] ?><br>
                </address>
              </div>
              <div class="col-sm-4 invoice-col">
                Người nhận
                <address>
                  <strong>Mã đơn hàng: <?= $donHang['ma_don_hang'] ?></strong><br>
                  <b> Tổng tiền: </b><?= $donHang['tong_tien'] ?><br>
                  <b> Ghi chú:</b><?= $donHang['ghi_chu'] ?><br>
                  <b>Thanh toán: </b><?= $donHang['ten_phuong_thuc'] ?><br>
                </address>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Mã đơn hàng</th>
                      <th>Tên sản phẩm</th>
                      <th>Đơn giá</th>
                      <th>Số lượng</th>
                      <th>Thành tiền</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $tong_tien = 0;
                    foreach ($sanPhamDonHang as $key => $sanPham):
                      ?>
                      <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $sanPham['ten_san_pham'] ?></td>
                        <td><?= $sanPham['don_gia'] ?></td>
                        <td><?= $sanPham['so_luong'] ?></td>
                        <td><?= $sanPham['thanh_tien'] ?></td>
                      </tr>
                      <?php
                      $tong_tien += $sanPham['thanh_tien'];
                    endforeach;
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <!-- accepted payments column -->

              <!-- /.col -->
              <div class="col-6">
                <p class="lead">Ngày đặt hàng: <?= formatDate($donHang['ngay_dat']) ?></p>

                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <th style="width:50%">Thành tiền:</th>
                      <td><?= $tong_tien ?>$</td>
                    </tr>
                    <tr>
                      <th>Vận chuyển:</th>
                      <td>200.000$</td>
                    </tr>
                    <tr>
                      <th>Tổng tiền:</th>
                      <td><?= $tong_tien + 200.000 ?>$</td>
                    </tr>
                  </table>
                </div>
              </div>

              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->

          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->

  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- footer -->
<?php
include './views/layout/footer.php'
  ?>
<!-- end footer -->

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
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