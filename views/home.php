
<?php 
    require_once './views/layout/header.php';
?>
    <?php require_once './views/layout/menu.php'; ?>


    <main>
        <!-- hero slider area start -->
        <section class="slider-area">
            <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
                <!-- single slider item start -->
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="assets/img/slider/slide1.jpg">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="assets/img/slider/slide2.jpg">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="assets/img/slider/slide3.jpg">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="assets/img/slider/slide4.jpg">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </section>
        <!-- hero slider area end -->

       

        <!-- service policy area start -->
        <div class="service-policy section-padding">
            <div class="container">
                <div class="row mtn-30">
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-plane"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Giao hàng </h6>
                                <p>Miễn phí giao hàng</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-help2"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Hỗ trợ 24/7</h6>
                                <p>Hỗ trợ 24 giờ một ngày</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-back"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Hoàn tiền</h6>
                                <p>Hoàn tiền trong 30 ngày khi lỗi</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-credit"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Thanh toán</h6>
                                <p>Bảo mật thành toán</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- service policy area end -->

        <!-- banner statistics area start -->
        <div class="banner-statistics-area">
            <div class="container">
                <div class="row row-20 mtn-20">
                    <div class="col-sm-6">
                        <figure class="banner-statistics mt-20">
                            <a href="#">
                                <img src="assets/img/banner/baner1.jpg" alt="product banner">
                            </a>
                        </figure>
                    </div>
                    
                    <div class="col-sm-6">
                        <figure class="banner-statistics mt-20">
                            <a href="#">
                                <img src="assets/img/banner/baner3.jpg" alt="product banner">
                            </a>
                        </figure>
                    </div>
                    
                    <div class="col-sm-6">
                        <figure class="banner-statistics mt-20">
                            <a href="#">
                                <img src="assets/img/banner/baner2.jpg" alt="product banner">
                            </a>
                        </figure>
                    </div>
                    
                    <div class="col-sm-6">
                        <figure class="banner-statistics mt-20">
                            <a href="#">
                                <img src="assets/img/banner/pebaner4.jpg" alt="product banner">
                            </a>
                        </figure>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- banner statistics area end -->

        <!-- product area start -->
        <section class="product-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- section title start -->
                        <div class="section-title text-center">
                            <h2 class="title">Sản phẩm của chúng tôi</h2>
                            <p class="sub-title">Cập nhật dòng sản phẩm hàng tuần với các sản phẩm mới của chúng tôi.</p>
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
                                        <?php foreach($listSanPham as $key => $sanPham) : ?>
                                        <!-- product item start -->
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a href="<?php echo BASE_URL. '?act=chi_tiet_san_pham&id_san_pham='.$sanPham['id']?>">
                                                    <img class="pri-img" src="<?php echo BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                                    <img class="sec-img" src="<?php echo BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                                    
                                                </a>
                                                <div class="product-badge">
                                                    <?php
                                                     $ngay_nhap = new DateTime($sanPham['ngay_nhap']);
                                                     $ngay_hien_tai = new DateTime();
                                                     $tinh_ngay = $ngay_hien_tai->diff($ngay_nhap);
                                                     if($tinh_ngay->days < 7){
                                                        ?>
                                                        <div class="product-label new">
                                                        <span>Mới</span>
                                                         </div>
                                                        <?php } ?>
                                                    <?php
                                                    if($sanPham['gia_khuyen_mai'] > 0){
                                                        ?>
                                                        <div class="product-label discount">
                                                        <span><?php echo round(($sanPham['gia_san_pham'] - $sanPham['gia_khuyen_mai'])/$sanPham['gia_san_pham'] * 100) ?>%</span>
                                                    </div>
                                                   
                                                        <?php } ?>
                                                     </div>
                                               
                                                <div class="cart-hover">
                                                    <button class="btn btn-cart">Xem chi tiết</button>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">
                                                <div class="product-identity">
                                                    <p class="manufacturer-name"><a href="<?php echo BASE_URL. '?act=chi_tiet_san_pham&id_san_pham='.$sanPham['id']    ?>"><?php echo $sanPham['ten_thuong_hieu'] ?></a></p>
                                                </div>
                                                <h6 class="product-name">
                                                    <a href="<?php echo BASE_URL. '?act=chi_tiet_san_pham&id_san_pham='.$sanPham['id']?>"><?php echo $sanPham['ten_san_pham'] ?></a>
                                                </h6>
                                                <div class="price-box">
                                                    <?php
                                                    if($sanPham['gia_khuyen_mai'] > 0){
                                                        ?>
                                                        <span class="price-regular"><?php echo formatPrice($sanPham['gia_khuyen_mai'])."đ" ?></span>
                                                        <span class="price-old"><del><?php echo formatPrice($sanPham['gia_san_pham'])."đ" ?></del></span>
                                                        <?php }else{ ?>
                                                        <span class="price-regular"><?php echo formatPrice($sanPham['gia_san_pham'])."đ" ?></span>
                                                        <?php }
                                                    ?>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
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
        <!-- product area end -->

        <!-- product banner statistics area start -->
        <section class="product-banner-statistics">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="product-banner-carousel slick-row-10">
                            <!-- banner single slide start -->
                            <div class="banner-slide-item">
                                <figure class="banner-statistics">
                                    <a href="#">
                                        <img src="assets/img/banner/img1-nuoc_hoa.png" alt="product banner">
                                    </a>
                                    <div class="banner-content banner-content_style2">
                                        <!-- <h5 class="banner-text3"><a href="#">BRACELATES</a></h5>
                                    </div> -->
                                </figure>
                            </div>
                            <!-- banner single slide start -->
                            <!-- banner single slide start -->
                            <div class="banner-slide-item">
                                <figure class="banner-statistics">
                                    <a href="#">
                                        <img src="assets/img/banner/img2-nuoc_hoa.jpg" alt="product banner"  >
                                    </a>
                                    <!-- <div class="banner-content banner-content_style2">
                                        <h5 class="banner-text3"><a href="#">EARRINGS</a></h5>
                                    </div> -->
                                </figure>
                            </div>
                            <!-- banner single slide start -->
                            <!-- banner single slide start -->
                            <div class="banner-slide-item">
                                <figure class="banner-statistics">
                                    <a href="#">
                                        <img src="assets/img/banner/img3-nuoc_hoa.png" alt="product banner">
                                    </a>
                                    <!-- <div class="banner-content banner-content_style2">
                                        <h5 class="banner-text3"><a href="#">NECJLACES</a></h5>
                                    </div> -->
                                </figure>
                            </div>
                            <!-- banner single slide start -->
                            <!-- banner single slide start -->
                            <div class="banner-slide-item">
                                <figure class="banner-statistics">
                                    <a href="#">
                                        <img src="assets/img/banner/img4-nuoc_hoa.png" alt="product banner">
                                    </a>
                                    <!-- <div class="banner-content banner-content_style2">
                                        <h5 class="banner-text3"><a href="#">RINGS</a></h5>
                                    </div> -->
                                </figure>
                            </div>
                            <!-- banner single slide start -->
                            <!-- banner single slide start -->
                            <div class="banner-slide-item">
                                <figure class="banner-statistics">
                                    <a href="#">
                                        <img src="assets/img/banner/img5-nuoc_hoa.png" alt="product banner">
                                    </a>
                                    <!-- <div class="banner-content banner-content_style2">
                                        <h5 class="banner-text3"><a href="#">PEARLS</a></h5>
                                    </div> -->
                                </figure>
                            </div>
                            <!-- banner single slide start -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- product banner statistics area end -->

        <!-- featured product area start -->
        <section class="feature-product section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- section title start -->
                        <div class="section-title text-center">
                            <h2 class="title">Sản phẩm nổi bật</h2>
                            <p class="sub-title">Cập nhật dòng sản phẩm hàng tuần với các sản phẩm mới của chúng tôi.</p>
                        </div>
                        <!-- section title start -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-carousel-4_2 slick-row-10 slick-arrow-style">
                            <?php foreach($listSanPham as $key => $sanPham) : ?>
                                        <!-- product item start -->
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a href="<?php echo BASE_URL. '?act=chi_tiet_san_pham&id_san_pham='.$sanPham['id']?>">
                                                    <img class="pri-img" src="<?php echo BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                                    <img class="sec-img" src="<?php echo BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                                    
                                                </a>
                                                <div class="product-badge">
                                                    <?php
                                                     $ngay_nhap = new DateTime($sanPham['ngay_nhap']);
                                                     $ngay_hien_tai = new DateTime();
                                                     $tinh_ngay = $ngay_hien_tai->diff($ngay_nhap);
                                                     if($tinh_ngay->days < 7){
                                                        ?>
                                                        <div class="product-label new">
                                                        <span>Mới</span>
                                                         </div>
                                                        <?php } ?>
                                                    <?php
                                                    if($sanPham['gia_khuyen_mai'] > 0){
                                                        ?>
                                                        <div class="product-label discount">
                                                        <span><?php echo round(($sanPham['gia_san_pham'] - $sanPham['gia_khuyen_mai'])/$sanPham['gia_san_pham'] * 100) ?>%</span>
                                                    </div>
                                                   
                                                        <?php } ?>
                                                     </div>
                                               
                                                <div class="cart-hover">
                                                    <button class="btn btn-cart">Xem chi tiết</button>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">
                                                <div class="product-identity">
                                                    <p class="manufacturer-name"><a href="<?php echo BASE_URL. '?act=chi_tiet_san_pham&id_san_pham='.$sanPham['id']    ?>"><?php echo $sanPham['ten_thuong_hieu'] ?></a></p>
                                                </div>
                                                <h6 class="product-name">
                                                    <a href="<?php echo BASE_URL. '?act=chi_tiet_san_pham&id_san_pham='.$sanPham['id']?>"><?php echo $sanPham['ten_san_pham'] ?></a>
                                                </h6>
                                                <div class="price-box">
                                                    <?php
                                                    if($sanPham['gia_khuyen_mai'] > 0){
                                                        ?>
                                                        <span class="price-regular"><?php echo formatPrice($sanPham['gia_khuyen_mai'])."đ" ?></span>
                                                        <span class="price-old"><del><?php echo formatPrice($sanPham['gia_san_pham'])."đ" ?></del></span>
                                                        <?php }else{ ?>
                                                        <span class="price-regular"><?php echo formatPrice($sanPham['gia_san_pham'])."đ" ?></span>
                                                        <?php }
                                                    ?>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                        <!-- product item end -->
         
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- featured product area end -->

        <!-- testimonial area start -->
        
        <!-- testimonial area end -->

       
        <!-- latest blog area start -->
      
        <!-- latest blog area end -->

        <!-- brand logo area start -->
        <div class="brand-logo section-padding pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="brand-logo-carousel slick-row-10 slick-arrow-style">
                            <!-- single brand start -->
                             <?php foreach($listThuongHieu as $key => $thuongHieu) : ?>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="<?php echo BASE_URL . $thuongHieu['hinh_anh'] ?>" alt="" height="50px">
                                </a>
                            </div>
                            <!-- single brand end -->
                            <?php endforeach; ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- brand logo area end -->
    </main>

    <!-- Scroll to top start -->
    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div>
    <!-- Scroll to Top End -->

   

  

    <!-- offcanvas mini cart start -->
    <div class="offcanvas-minicart-wrapper">
        <div class="minicart-inner">
            <div class="offcanvas-overlay"></div>
            <div class="minicart-inner-content">
                <div class="minicart-close">
                    <i class="pe-7s-close"></i>
                </div>
                <div class="minicart-content-box">
                    <div class="minicart-item-wrapper">
                        <ul>
                            <li class="minicart-item">
                                <div class="minicart-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/img/cart/cart-1.jpg" alt="product">
                                    </a>
                                </div>
                                <div class="minicart-content">
                                    <h3 class="product-name">
                                        <a href="product-details.html">Dozen White Botanical Linen Dinner Napkins</a>
                                    </h3>
                                    <p>
                                        <span class="cart-quantity">1 <strong>&times;</strong></span>
                                        <span class="cart-price">$100.00</span>
                                    </p>
                                </div>
                                <button class="minicart-remove"><i class="pe-7s-close"></i></button>
                            </li>
                            <li class="minicart-item">
                                <div class="minicart-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/img/cart/cart-2.jpg" alt="product">
                                    </a>
                                </div>
                                <div class="minicart-content">
                                    <h3 class="product-name">
                                        <a href="product-details.html">Dozen White Botanical Linen Dinner Napkins</a>
                                    </h3>
                                    <p>
                                        <span class="cart-quantity">1 <strong>&times;</strong></span>
                                        <span class="cart-price">$80.00</span>
                                    </p>
                                </div>
                                <button class="minicart-remove"><i class="pe-7s-close"></i></button>
                            </li>
                        </ul>
                    </div>

                    <div class="minicart-pricing-box">
                        <ul>
                            <li>
                                <span>sub-total</span>
                                <span><strong>$300.00</strong></span>
                            </li>
                            <li>
                                <span>Eco Tax (-2.00)</span>
                                <span><strong>$10.00</strong></span>
                            </li>
                            <li>
                                <span>VAT (20%)</span>
                                <span><strong>$60.00</strong></span>
                            </li>
                            <li class="total">
                                <span>total</span>
                                <span><strong>$370.00</strong></span>
                            </li>
                        </ul>
                    </div>

                    <div class="minicart-button">
                        <a href="cart.html"><i class="fa fa-shopping-cart"></i> View Cart</a>
                        <a href="cart.html"><i class="fa fa-share"></i> Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- offcanvas mini cart end -->

   <?php require_once './views/layout/footer.php';?>