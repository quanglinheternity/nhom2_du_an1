
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
                                    <li class="breadcrumb-item active" aria-current="#">giỏ hàng</li>
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
                        <div class="col-lg-12">
                            <!-- Cart Table Area -->
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="pro-thumbnail">Ảnh sản phẩm</th>
                                            <th class="pro-title">Tên sản phẩm</th>
                                            <th class="pro-price">Giá</th>
                                            <th class="pro-quantity">Số lượng</th>
                                            <th class="pro-subtotal">Tổng tiền</th>
                                            <th class="pro-remove">Thap tác</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                        <?php 
                                            $tong_thanh_toan=0;
                                            foreach($chiTietGioHang as $key => $sanPham) : 
                                         ?>
                                        <tr>
                                            <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="<?php echo BASE_URL . $sanPham['hinh_anh'] ?>" alt="Product" /></a></td>
                                            <td class="pro-title"><a href="#"><?php echo $sanPham['ten_san_pham'] ?></a></td>
                                            <td class="pro-price">
                                            <span>
                                                <?php if($sanPham['gia_khuyen_mai'] > 0){ ?>
                                                <?php echo formatPrice($sanPham['gia_khuyen_mai'])."đ" ?>
                                                <?php }else{ ?>
                                                <?php echo formatPrice($sanPham['gia_san_pham'])."đ" ?>
                                                <?php } ?>
                                            </span></td>
                                            <td class="pro-quantity">
                                                <input type="hidden" name="san_pham_id" value="<?php echo $sanPham['id'] ?>" id="">
                                                <div class="pro-qty"><input type="text" value="<?php echo $sanPham['so_luong']  ?>" name="so_luong"></div>
                                            </td>
                                            <td class="pro-subtotal"><span>
                                                    <?php 
                                                    $tong_tien=0;
                                                    if($sanPham['gia_khuyen_mai'] > 0){
                                                        $tong_tien = $sanPham['so_luong'] * $sanPham['gia_khuyen_mai'];
                                                    }else{
                                                        $tong_tien = $sanPham['so_luong'] * $sanPham['gia_san_pham'];
                                                    }
                                                    $tong_thanh_toan += $tong_tien;
                                                    echo formatPrice($tong_tien)."đ";
                                                    ?>
                                            </span></td>
                                            <td class="pro-remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>
                                        </tr>
                                       <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Cart Update Option -->
                            <div class="cart-update-option d-block d-md-flex justify-content-between">
                                <div class="apply-coupon-wrapper">
                                    <form action="#" method="post" class=" d-block d-md-flex"> 
                                        <input type="text" placeholder="Enter Your Coupon Code" required />
                                        <button class="btn btn-sqr">Apply Coupon</button>
                                     </form>
                                </div>
                                <div class="cart-update">
                                    <a href="#"  class="btn btn-sqr">Cập nhập giỏ hàng</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 ml-auto">
                            <!-- Cart Calculation Area -->
                            <div class="cart-calculator-wrapper">
                                <div class="cart-calculate-items">
                                    <h6>Cart Totals</h6>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <td>Tổng tiền sản phẩm</td>
                                                <td><?php echo formatPrice($tong_thanh_toan)."đ" ?></td>
                                            </tr>
                                            <tr>
                                                <td>Phí vận chuyển</td>
                                                <td>30.000 đ</td>
                                            </tr>
                                            <tr class="total">
                                                <td>Tổng thanh toán</td>
                                                <td class="total-amount"><?php echo formatPrice($tong_thanh_toan + 30000)."đ" ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <a href="<?= BASE_URL . '?act=thanh_toan' ?>" class="btn btn-sqr d-block">Thanh toán</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart main wrapper end -->
    </main>



  
   

   <?php require_once './views/layout/footer.php';?>
