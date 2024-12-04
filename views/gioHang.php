
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
                                        <tr data-id="<?php echo $sanPham['id']; ?>">
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
                                                <input type="hidden" name="san_pham_id" value="<?php echo $sanPham['id'] ?>"  id="">
                                                <div class="pro-qty">
                                                    <input type="text" value="<?php echo $sanPham['so_luong']   ?>" class="so_luong" name="so_luong">
                                                </div>
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
                                            <td class="xoa_sp_cart pro-remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>
                                        </tr>
                                       <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Cart Update Option -->
                            <div class="cart-update-option d-block d-md-flex justify-content-between">
                                <div class="apply-coupon-wrapper">
                                    <form action="<?= BASE_URL .'?act=ma_giam_gia' ?>" method="post" class=" d-block d-md-flex"> 
                                        <input type="text" placeholder="Enter Your Coupon Code" required name="ma" />
                                        <button class="btn_ap_dung_ma btn btn-sqr">Áp dụng mã</button>
                                     </form>
                                </div>
                                <div class="cart-update">
                                    <a href="<?php echo BASE_URL . '?act=gio_hang' ?>"  class="btn_cap_nhat_gio_hang btn btn-sqr">Cập nhập giỏ hàng</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 ml-auto">
                            <!-- Cart Calculation Area -->
                             <?php if(!empty($chiTietGioHang)):?>
                            <div class="cart-calculator-wrapper">
                                <div class="cart-calculate-items">
                                    <h6>Giỏ hàng tổng</h6>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <td>Tổng tiền sản phẩm</td>
                                                <td id="tong_tien_san_pham"><?php echo formatPrice($tong_thanh_toan)." đ" ?></td>
                                            </tr>
                                            <?php if(isset($maGiam)){
                                                $maGiamGia=$maGiam[0]['gia_tri_giam'] ?? 0;    
                                            ?>
                                            <tr>
                                                <td>Giảm giá</td>
                                                <td><?= formatPrice($maGiamGia). ' đ' ?></td>
                                            </tr>
                                            <tr>
                                                <td>Phí vận chuyển</td>
                                                <td id="phi_van_chuyen">30.000 đ</td>
                                            </tr>
                                            <tr class="total">
                                                <td>Tổng thanh toán</td>
                                                <td class="total-amount" id="tong_thanh_toan"><?php echo formatPrice($tong_thanh_toan + 30000 - $maGiamGia)." đ" ?></td>
                                            </tr>
                                            <?php }else{?>
                                            <tr>
                                                <td>Phí vận chuyển</td>
                                                <td id="phi_van_chuyen">30.000 đ</td>
                                            </tr>
                                            <tr class="total">
                                                <td>Tổng thanh toán</td>
                                                <td class="total-amount" id="tong_thanh_toan"><?php echo formatPrice($tong_thanh_toan + 30000 )." đ" ?></td>
                                            </tr>
                                            <?php } ?>
                                        </table>
                                    </div>
                                </div>
                                <a href="<?= BASE_URL . '?act=thanh_toan' ?><?= isset($maGiam) ? '&ma_id=' . ($maGiam[0]['gia_tri_giam'] ?? '') : '' ?>" class="btn btn-sqr d-block">Thanh toán</a>

                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart main wrapper end -->
    </main>



  
   

   <?php require_once './views/layout/footer.php';?>
   <script>
       
jQuery(document).ready(function($) {
    $(".xoa_sp_cart").click(function(e){
        e.preventDefault();
        var tr = $(this).parent();
        var tensp = tr.children('td').eq(1).text();
        var id = tr.data('id');
        tr.remove();
        deleteSp(id);
    });

    // Xử lý khi nhấn nút "Cộng"
    $(".inc.qtybtn").on("click", function(e) {
        e.preventDefault();
        var input = $(this).siblings(".so_luong");
        var currentValue = parseInt(input.val()) || 0;
        input.val(currentValue ); // Cộng 1 vào giá trị hiện tại
        updateTotalPrice(input); // Cập nhật lại giá trị "thành tiền"
        updateCart(input); // Gửi cập nhật đến server
    });

    // Xử lý khi nhấn nút "Trừ"
    $(".dec.qtybtn").on("click", function(e) {
        e.preventDefault();
        var input = $(this).siblings(".so_luong");
        var currentValue = parseInt(input.val()) || 0;
        if (currentValue > 0) { // Đảm bảo số lượng không âm
            input.val(currentValue ); // Trừ 1 vào giá trị hiện tại
            updateTotalPrice(input); // Cập nhật lại giá trị "thành tiền"
            updateCart(input); // Gửi cập nhật đến server
        }else{
            var tr = input.closest('tr');
            var productId = tr.data('id');
            deleteSp(productId);
        }
    });

    // Xử lý khi nhập trực tiếp vào ô input
    $(".so_luong").on("change", function(e) {
        var inputValue = parseInt($(this).val()) || 0;

        // Prevent negative values
        if (inputValue <= 0) {
            $(this).val(0);
            inputValue = 0; // Update inputValue to reflect the reset
           
        }
        updateTotalPrice($(this)); // Cập nhật giá trị "thành tiền" khi thay đổi số lượng
        updateCart($(this)); // Gửi cập nhật đến server
    });

    // Hàm cập nhật giá trị thành tiền
    function updateTotalPrice(input) {
        var tr = input.closest('tr');
        var giasp = tr.children('td').eq(2).text().replace(/\./g, '').trim();
        var thanhtien = parseInt(giasp) * parseInt(input.val()) || 0;
        tr.children('td').eq(4).text(formatPricejs(thanhtien));
    }

    // Hàm gửi dữ liệu lên server để cập nhật giỏ hàng
    function updateCart(input) {
        var tr = input.closest('tr');
        var productId = tr.data('id'); // Assuming the product row has a data-id attribute
        var newQuantity = parseInt(input.val()) || 0;
        // alert(productId); 
        // console.log(tr);
        // die();

        $.ajax({
            url: '<?php echo BASE_URL . '?act=update_cart' ?>', // The PHP file that handles the update
            type: 'POST',
            data: {
                product_id: productId,
                quantity: newQuantity
            },
            success: function(response) {
                console.log(response); // Optionally show a success message or update UI based on server response
            },
            error: function() {
                alert('Có lỗi xảy ra khi cập nhật giỏ hàng');
            }
        });
    }
    function deleteSp(id) {
        $.ajax({
            url: '<?php echo BASE_URL . '?act=delete_cart' ?>', // The PHP file that handles the update
            type: 'POST',
            data: {
                product_id: id
            },
            success: function(response) {
                console.log(response); // Optionally show a success message or update UI based on server response
            },
            error: function() {
                alert('Có lỗi xảy ra khi cập nhật giỏ hàng');
            }
        });
    }
    // Hàm định dạng giá trị tiền tệ
    function formatPricejs(price) {
        price = parseInt(price) || 0;
        return price.toLocaleString('vi-VN') + 'đ';
    }
});


   </script>