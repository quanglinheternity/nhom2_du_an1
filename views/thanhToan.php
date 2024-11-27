
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
                                    <li class="breadcrumb-item"><a href="shop.html">sản phẩm</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- checkout main wrapper start -->
        <div class="checkout-page-wrapper section-padding">
            <div class="container">
            <form action="<?php echo BASE_URL . '?act=xu_ly_thanh_toan' ?>" method="post">
                <div class="row">
                    <!-- Checkout Billing Details -->
                    <div class="col-lg-6">
                        <div class="checkout-billing-details-wrap">
                            <h5 class="checkout-title">Thông tin người nhận</h5>
                            <div class="billing-form-wrap">
                                    

                                    <div class="single-input-item">
                                        <label for="ten_nguoi_nhan" class="required">Tên người nhận</label>
                                        <input type="text" id="ten_nguoi_nhan" name="ten_nguoi_nhan" placeholder="Tên người nhận" value="<?php echo $user['ho_ten'] ?>" required />
                                    </div>
                                    <div class="single-input-item">
                                        <label for="email_nguoi_nhan" class="required">Địa chỉ email</label>
                                        <input type="email" id="email_nguoi_nhan" name="email_nguoi_nhan" placeholder="Địa chỉ email" value="<?php echo $user['email'] ?>" required />
                                    </div>
                                    <div class="single-input-item">
                                        <label for="sdt_nguoi_nhan" class="required">Số điện thoại người nhận</label>
                                        <input type="text" id="sdt_nguoi_nhan" name="sdt_nguoi_nhan" placeholder="Số điện thoại người nhận" value="<?php echo $user['so_dien_thoai'] ?>" required />
                                    </div>
                                    <div class="single-input-item">
                                        <label for="dia_chi_nguoi_nhan" class="required">Địa chỉ người nhận</label>
                                        <input type="text" id="dia_chi_nguoi_nhan" name="dia_chi_nguoi_nhan" placeholder="Địa chỉ người nhận" value="<?php echo $user['dia_chi'] ?>"required />
                                    </div>

                                    

                                    <div class="single-input-item">
                                        <label for="ghi_chu">Ghi chú</label>
                                        <textarea name="ghi_chu" id="ghi_chu" cols="30" rows="3" placeholder="Ghi chú về đơn đặt hàng của bạn, ví dụ: ghi chú đặc biệt để giao hàng."></textarea>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary Details -->
                    <div class="col-lg-6">
                        <div class="order-summary-details">
                            <h5 class="checkout-title">Thông tin sản phẩm</h5>
                            <div class="order-summary-content">
                                <!-- Order Summary Table -->
                                <div class="order-summary-table table-responsive text-center">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        <?php 
                                            $tong_thanh_toan=0;
                                            foreach($chiTietGioHang as $key => $sanPham) : 
                                         ?>
                                        <tr>
                                            <td class="pro-title"><a href="#"><?php echo $sanPham['ten_san_pham']  ?><strong> x <?php echo $sanPham['so_luong']  ?></strong></a></td>
                                            <td> 
                                                <?php 
                                                    $tong_tien=0;
                                                    if($sanPham['gia_khuyen_mai'] > 0){
                                                        $tong_tien = $sanPham['so_luong'] * $sanPham['gia_khuyen_mai'];
                                                    }else{
                                                        $tong_tien = $sanPham['so_luong'] * $sanPham['gia_san_pham'];
                                                    }
                                                    $tong_thanh_toan += $tong_tien;
                                                    echo formatPrice($tong_tien)." đ";
                                                ?>
                                            </td>
                                        </tr>

                                       <?php endforeach; ?>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>tổng tiền sản phẩm</td>
                                                <td><strong><?= formatPrice($tong_thanh_toan). ' đ' ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Shipping</td>
                                                <td class="d-flex justify-content-center">
                                                    <strong>30.000 đ</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tổng thanh toán</td>`
                                                <input type="hidden" name="tong_thanh_toan" value="<?= $tong_thanh_toan+30000 ?>">
                                                <td><strong><?= formatPrice($tong_thanh_toan+30000). ' đ' ?></strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- Order Payment Method -->
                                <div class="order-payment-method">

                                    <div class="single-payment-method show">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cashon"  value="1" name="phuong_thuc_thanh_toan_id" class="custom-control-input" checked />
                                                <label class="custom-control-label" for="cashon">Thanh toán khi nhận hàng</label>
                                            </div>
                                        </div>
                                        <div class="payment-method-details" >
                                            <p>Khách hàng có thể thanh toán sau khi đã nhận hàng thành công (cần xác nhận đơn hàng)</p>
                                        </div>
                                    </div>
                                    <div class="single-payment-method">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="directbank"  value="2" name="phuong_thuc_thanh_toan_id" class="custom-control-input" />
                                                <label class="custom-control-label" for="directbank">Thanh toán online</label>
                                            </div>
                                        </div>
                                        <div class="payment-method-details" >
                                            <p>Khách hàng cần thanh toán online để nhận được hàng.</p>
                                        </div>
                                    </div>
                                   
                                    <div class="summary-footer-area">
                                        <div class="custom-control custom-checkbox mb-20">
                                            <input type="checkbox" class="custom-control-input" id="terms" required />
                                            <label class="custom-control-label" for="terms">Xác nhận khi đặt hàng</label>
                                        </div>
                                        <button type="submit" class="btn btn-sqr">Tiến hành đặt hàng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
            </div>
        </div>
        <!-- checkout main wrapper end -->
    </main>



  
   

   <?php require_once './views/layout/footer.php';?>
