
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
    <section class="related-products section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Các Sản phẩm <?= $listSanPhamCungThuongHieu[0]['ten_thuong_hieu'] ?></h2>
                        <p class="sub-title">Các sản phẩm <?= $listSanPhamCungThuongHieu[0]['ten_thuong_hieu'] ?> được cập nhận hàng tuần</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                        <!-- product item start -->
                        <?php foreach ($listSanPhamCungThuongHieu as $key => $sanPham) : ?>
                            <?php if ($sanPham['trang_thai'] == 1) : ?>

                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="<?php echo BASE_URL . '?act=chi_tiet_san_pham&id_san_pham=' . $sanPham['id'] ?>">
                                        <img class="pri-img" src="<?php echo BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                        <img class="sec-img" src="<?php echo BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">

                                    </a>
                                    <div class="product-badge">
                                        <?php
                                        $ngay_nhap = new DateTime($sanPham['ngay_nhap']);
                                        $ngay_hien_tai = new DateTime();
                                        $tinh_ngay = $ngay_hien_tai->diff($ngay_nhap);
                                        if ($tinh_ngay->days < 7) {
                                        ?>
                                            <div class="product-label new">
                                                <span>Mới</span>
                                            </div>
                                        <?php } ?>
                                        <?php
                                        if ($sanPham['gia_khuyen_mai'] > 0) {
                                        ?>
                                            <div class="product-label discount">
                                                <span><?php echo round(($sanPham['gia_san_pham'] - $sanPham['gia_khuyen_mai']) / $sanPham['gia_san_pham'] * 100) ?>%</span>
                                            </div>

                                        <?php } ?>
                                    </div>

                                    <div class="cart-hover">
                                        <button class="btn btn-cart">Xem chi tiết</button>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a href="<?php echo BASE_URL . '?act=chi_tiet_san_pham&id_san_pham=' . $sanPham['id']    ?>"><?php echo $sanPham['ten_thuong_hieu'] ?></a></p>
                                    </div>
                                    <h6 class="product-name">
                                        <a href="<?php echo BASE_URL . '?act=chi_tiet_san_pham&id_san_pham=' . $sanPham['id'] ?>"><?php echo $sanPham['ten_san_pham'] ?></a>
                                    </h6>
                                    <div class="price-box">
                                        <?php
                                        if ($sanPham['gia_khuyen_mai'] > 0) {
                                        ?>
                                            <span class="price-regular"><?php echo formatPrice($sanPham['gia_khuyen_mai']) . "đ" ?></span>
                                            <span class="price-old"><del><?php echo formatPrice($sanPham['gia_san_pham']) . "đ" ?></del></span>
                                        <?php } else { ?>
                                            <span class="price-regular"><?php echo formatPrice($sanPham['gia_san_pham']) . "đ" ?></span>
                                        <?php }
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                        <?php endforeach; ?>
                        <!-- product item end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- related products area end -->
</main>


  
   

   <?php require_once './views/layout/footer.php';?>
