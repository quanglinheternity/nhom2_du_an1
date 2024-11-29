
<?php 
    require_once './views/layout/header.php';
?>
    <?php require_once './views/layout/menu.php'; ?>


    <main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#">sản phẩm</a></li>
                                    <li class="breadcrumb-item active" aria-current="#">Lịch sử mua hàng</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- cart main wrapper start -->
        <div class="cart-main-wrapper section-padding">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-7">
                            <!-- Thông tin san phẩm -->
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="5">Thông tin sản phẩm</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                    <tr class="text-center">
                                       <th>Hình ảnh</th>
                                       <th>Tên sản phẩm</th>
                                       <th>Đơn giá</th>
                                       <th>Số lượng</th>
                                       <th>Thành tiền</th>
                                    </tr>
                                    <?php foreach($chiTietDonHang as $item): ?>
                                        <tr>
                                            <td><img class="img-fluid" src="<?php echo BASE_URL . $item['hinh_anh'] ?>" alt="Product"  width="100px"/></td>
                                            <td><?= $item['ten_san_pham'] ?></td>
                                            <td><?= formatPrice($item['don_gia']).' đ' ?></td>
                                            <td><?= $item['so_luong'] ?></td>
                                            <td><?= formatPrice( $item['thanh_tien']) .' đ'?></td>
                                          
                                        </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                       
                            <!-- Cart Update Option -->

                        </div>
                        <div class="col-lg-5">
                            <!-- Cart Table Area -->
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Thông tin Đơn hàng</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                    <tr class="text-center">
                                       <th>Mã đơn hàng:</th>
                                       <td><?= $donHang['ma_don_hang'] ?></td>
                                    </tr>
                                    <tr class="text-center">
                                       <th>Người nhận:</th>
                                       <td><?= $donHang['ten_nguoi_nhan'] ?></td>
                                    </tr>
                                    <tr class="text-center">
                                       <th>Email:</th>
                                       <td><?= $donHang['email_nguoi_nhan'] ?></td>
                                    </tr>
                                    <tr class="text-center">
                                       <th>Số điện thoại:</th>
                                       <td><?= $donHang['sdt_nguoi_nhan'] ?></td>
                                    </tr>
                                    <tr class="text-center">
                                       <th>Địa chỉ nhận hàng:</th>
                                       <td><?= $donHang['dia_chi_nguoi_nhan'] ?></td>
                                    </tr>
                                    <tr class="text-center">
                                       <th>Ngày đặt:</th>
                                       <td><?= $donHang['ngay_dat'] ?></td>
                                    </tr>
                                    <tr class="text-center">
                                       <th>Ghi chú:</th>
                                       <td><?= $donHang['ghi_chu'] ?></td>
                                    </tr>
                                    <tr class="text-center">
                                       <th>Phương thức thanh toán:</th>
                                       <td><?=$phuongThucThanhToan[ $donHang['phuong_thuc_thanh_toan_id'] ]?></td>
                                    </tr>
                                    <tr class="text-center">
                                       <th>Trạng thái đơn hàng:</th>
                                       <td><?= $trangThaiDonHang[$donHang['trang_thai_id']] ?></td>
                                    </tr>
                                    <tr class="text-center">
                                       <th>Tổng tiền:</th>
                                       <td><?= formatPrice($donHang['tong_tien']) .' đ' ?></td>
                                    </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>
        <!-- cart main wrapper end -->
    </main>



  
    <?php require_once './views/miniCart.php';?>
   

   <?php require_once './views/layout/footer.php';?>
