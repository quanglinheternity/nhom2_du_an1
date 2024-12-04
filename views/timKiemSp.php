
<?php 
    require_once './views/layout/header.php';
?>
    <?php require_once './views/layout/menu.php'; ?>


   
    <main>
    <!-- breadcrumb area start -->
    
    
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    
    <!-- page main wrapper end -->

    <!-- related products area start -->
    <section class="product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Sản phẩm của tìm kiếm</h2>
                        <p class="sub-title">Sản phẩm được cập nhật hàng tuần</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-container">


                        <!-- product tab content start -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1">
                                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                    <!-- product item start -->
                                    <?php foreach ($listSanPhamTimKiem as $key => $sanPham) { ?>
                                        <?php if ($sanPham['trang_thai'] == 1) : ?>

                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a href="<?=BASE_URL.'?act=chi_tiet_san_pham&id_san_pham='  .$sanPham['id']?>">
                                                    <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                                    <img class="sec-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                                </a>
                                                <div class="product-badge">
                                                    <?php
                                                    $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                                    $ngayHienTai = new DateTime();
                                                    $tinhNgay = $ngayHienTai->diff($ngayNhap);
                                                    if ($tinhNgay->days <= 7) {    ?>

                                                        <div class="product-label new">
                                                            <span>Mới</span>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if($sanPham['gia_khuyen_mai'] >0) { ?>
                                                    <div class="product-label discount">
                                                        <span>Giảm giá</span>
                                                    </div>
                                                    <?php }?>
                                                </div>
                                            
                                                <div class="cart-hover">
                                                    
                                                    <a href="<?=BASE_URL.'?act=chi-tiet-san-pham&id_san_pham=' .$sanPham['id']?>">
                                                    <button class="btn btn-cart">Xem chi tiết</button>
                                                    </a>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">
                                                
                                                <h6 class="product-name">
                                                    <a href="<?=BASE_URL.'?act=chi-tiet-san-pham&id_san_pham=' .$sanPham['id']?>"><?= $sanPham['ten_san_pham']?></a>
                                                </h6>
                                                <div class="price-box">
                                                    <?php if($sanPham['gia_khuyen_mai'] >0){ ?>
                                                            <span class="price-regular"><?=  formatPrice($sanPham['gia_khuyen_mai']).'đ';?></span>
                                                            <span class="price-old"><del><?= formatPrice($sanPham['gia_san_pham']). 'đ';?></del></span>
                                                    <?php }else{ ?>
                                                        <span class="price-regular"><?= formatPrice($sanPham['gia_san_pham']).'đ'?></span>
                                                        
                                                        
                                                    <?php }    ?>
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                    <?php } ?>
                                    <!-- product item end -->


                                </div>
                            </div>

                        </div>
                        <!-- product tab content end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- related products area end -->
</main>


  
   

   <?php require_once './views/layout/footer.php';?>
