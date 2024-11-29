
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
                        <div class="col-lg-12">
                            <!-- Cart Table Area -->
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th >Mã đơn hàng</th>
                                            <th >Ngày đặt</th>
                                            <th >Tổng tiền</th>
                                            <th >Phương thức thanh toán</th>
                                            <th >Trạng thái đơn hàng</th>
                                            <th >Thao tác</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                        <?php usort($donHang, function($a, $b) {
                                            return $a['trang_thai_id'] <=> $b['trang_thai_id'];
                                        });?>
                                        <?php foreach($donHang as $don): ?>
                                            <tr>
                                                <th class="text-center"><?= $don['ma_don_hang'] ?></th>
                                                <td><?= $don['ngay_dat'] ?></td>
                                                <td><?= formatPrice($don['tong_tien'] )?> đ</td>
                                                <td ><?=$phuongThucThanhToan[ $don['phuong_thuc_thanh_toan_id'] ]?></td>
                                                <td class="text-<?= getStatusClass($don['trang_thai_id']) ?>"><?= $trangThaiDonHang[$don['trang_thai_id']] ?></td>
                                                <td>
                                                    <a href="<?= BASE_URL . '?act=chi_tiet_mua_hang&id_don_hang=' . $don['id'] ?>"><button class="btn btn-sqr">Chi tiết</button></a>
                                                    <?php 
                                                    if($don['trang_thai_id']==1):?>
                                                    <a href="<?= BASE_URL . '?act=huy_don_hang&id_don_hang=' . $don['id'] ?>" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng không?')" ><button class="btn btn-sqr">Hủy</button></a>

                                                    
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- Cart Update Option -->
                            

                        </div>
                    </div>
                 
                </div>
            </div>
        </div>
        <!-- cart main wrapper end -->
    </main>



  
   

   <?php require_once './views/layout/footer.php';?>
