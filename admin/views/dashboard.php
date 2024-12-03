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
          <h1>Báo cáo thống kê </h1>
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
              
            <!-- /.card-header -->
            <div class="card-body">
              <div class=" ">
                <h3 class="text-center">Bảng thống kê theo ngày</h3></div>
                <div class="card-header">
                <a href="<?= BASE_URL_ADMIN . '?act=bieu_do' ?>">
                  <button type="button" class="btn btn-primary">Xem biểu đồ</button>
                </a>
                </div>
            <table id="example1" class="table table-bordered table-striped table-responsive">
                  <thead>
                    <tr>
                        <th>Ngày thống kê</th>
                        <th>Số lượng đơn hàng</th>
                        <th>Số lượng sản phẩm bán</th>
                        <th>Giá cao nhất</th>
                        <th>Giá thấp nhất</th>
                        <th>Giá trung bình</th>
                       
                        <th>Tổng doanh thu</th>
              
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    // Sort the array by 'ngay' in descending order (newest first)
                    usort($listTongKetTheoNgay, function($a, $b) {
                        return strtotime($b['ngay']) - strtotime($a['ngay']);
                    });
                  ?>  
                    <?php foreach ($listTongKetTheoNgay as $thongKe) { ?>
                      <tr>
                        <td><?= formatDate($thongKe['ngay']) ?></td>
                        <td><?='Có '. $thongKe['tong_don_hang'] .' đơn hàng'?></td>
                        <td><?='Đã bán '. $thongKe['tong_san_pham_ban']. ' sản phẩm' ?></td>
                        <td><?= formatPrice( $thongKe['maxPrice'] ) .' đ'?></td>
                        <td><?= formatPrice( $thongKe['minPrice'] ) .' đ'?></td>
                        <td><?= formatPrice( $thongKe['avgPrice'] ) .' đ'?></td>
                        <td><?= formatPrice( $thongKe['doanh_thu_san_pham'] ) .' đ'?></td>
                        
                      </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                        <th>Ngày thống kê</th>
                        <th>Số đơn hàng</th>
                        <th>Số lượng sản phẩm bán</th>
                        <th>Giá cao nhất</th>
                        <th>Giá thấp nhất</th>
                        <th>Giá trung bình</th>
                        <th>Tổng doanh thu</th>
              
                    </tr>
                  </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
             <!-- /.card-header -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-8">
          <div class="card">

            <!-- /.card-header -->

            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
              
            <!-- /.card-header -->
            <div class="card-body">
              <div >
                <h3 class="text-center">Top khách hàng mua nhiều nhất</h3></div>
                
            <table id="example2" class="table table-bordered table-striped table-responsive">
                  <thead>
                    <tr>
                        <th>Top</th>
                        <th>Họ và tên</th>
                        <th>Ảnh đại diện</th>
                        <th>Số lượng đơn hàng</th>
                        <th>Tổng chi tiêu</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($DonHangFormTrangThai as $key=>$Top) { ?>
                      <tr>
                        <td><?= 'Top '.$key + 1 ?></td>
                        <td><?= $Top['ho_ten'] ?></td>
                        <td class="text-center"><img src="<?=BASE_URL . $Top['anh_dai_dien']?>" class="img-circle elevation-2" alt="User Image" width="50px" onerror="this.onerror=null;this.src='https://as2.ftcdn.net/v2/jpg/03/49/49/79/1000_F_349497933_Ly4im8BDmHLaLzgyKg2f2yZOvJjBtlw5.jpg';"></td>
                        

                        <td><?='Có '. $Top['so_don_hang'] .' đơn hàng'?></td>
                        <td><?= formatPrice( $Top['tong_chi_tieu'] ) .' đ'?></td>
                        
                      </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                       <th>Top</th>
                        <th>Họ và tên</th>
                        <th>Ảnh đại diện</th>
                        <th>Số lượng đơn hàng</th>
                        <th>Tổng chi tiêu</th>
              
                    </tr>
                  </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
             <!-- /.card-header -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-4">
          <div class="card">

            <!-- /.card-header -->

            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
              
            <!-- /.card-header -->
            <div class="card-body">
              <div >
                <h3 class="text-center">Tổng hợp</h3></div>
                
                <table id="example3" class="table table-bordered table-striped table-responsive">
                  <thead>
                    <tr>
                    <th colspan="2" class="text-center">Bảng tổng hợp chỉ số</th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <th>Tổng đơn hàng:</th>
                        <td><?= $listTongKet['tong_don_hang'] ?> đơn hàng</td>
                      </tr>
                      
                      <tr>
                        <th>Sản phẩm đã bán:</th>
                        <td> <?= $listTongKet['tong_san_pham_ban'] ?> sản phẩm</td>
                      </tr>
                      <tr>
                        <th>Sản phẩm còn:</th>
                        <td> <?= $listTongKet['tong_san_pham_con'] ?> sản phẩm</td>
                      </tr>
                      <tr>
                        <th>Tổng doanh thu:</th>
                        <td><?= formatPrice( $listTongKet['tong_doanh_thu'] ) .' đ'?></td>
                      </tr>
                  </tbody>
                
                </table>
            </div>
            <!-- /.card-body -->
             <!-- /.card-header -->
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


<!-- Code injected by live-server -->

</body>


</html>
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