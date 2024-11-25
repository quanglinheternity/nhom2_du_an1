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
            <?php  if($donHang['trang_thai_id']==1){?>
              <a href="<?= BASE_URL_ADMIN . '?act=cap_nhat_don_hang&id_don_hang=' . $donHang['id'] ?>" onclick="return confirm('Bạn có chắc muốn cập nhật đơn hàng không?')" ><button class="btn btn-success">Xác nhật</button></a>
            <?php } else if($donHang['trang_thai_id'] >= 2 && $donHang['trang_thai_id'] < 7){?>
            <a href="<?= BASE_URL_ADMIN . '?act=cap_nhat_don_hang&id_don_hang=' . $donHang['id'] ?>" onclick="return confirm('Bạn có chắc muốn cập nhật đơn hàng không?')" ><button class="btn btn-primary">Cập nhật đơn </button></a>
            <?php } ?>
            <?php  if($donHang['trang_thai_id']==1){?>
            <a href="<?= BASE_URL_ADMIN . '?act=huy_don_hang&id_don_hang=' . $donHang['id'] ?>" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng không?')" ><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
            <?php } ?>

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
                    <i class="fas fa-globe"></i> Shop thú cưng.
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
                      <th>#</th>
                      <th>Tên sản phẩm</th>
                      <th>Đơn giá</th>
                      <th>Số lượng</th>
                      <th>Thành tiền</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tong_tien = 0;
                    foreach ($sanPhamDonHang as $key => $sanPham) :
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
                        <td><?= $tong_tien +200.000?>$</td>
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