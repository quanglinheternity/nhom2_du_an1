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
                                <li class="breadcrumb-item"><a href="#">Sản Phẩm</a></li>
                                <li class="breadcrumb-item active" aria-current="page">chi tiết sản phẩm</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-padding pb-0">
        <div class="container">
            <div class="row">
                <!-- product details wrapper start -->
                <div class="col-lg-12 order-1 order-lg-2">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-large-slider">
                                    <?php
                                    foreach ($listAnhSanPham as $key => $anhSanPham) :
                                    ?>
                                        <div class="pro-large-img img-zoom">
                                            <img src="<?= BASE_URL . $anhSanPham['link_hinh_anh'] ?>" alt="product-details" />
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="pro-nav slick-row-10 slick-arrow-style">
                                    <?php
                                    foreach ($listAnhSanPham as $key => $anhSanPham) :
                                    ?>
                                        <div class="pro-nav-thumb">
                                            <img src="<?= BASE_URL . $anhSanPham['link_hinh_anh'] ?>" alt="product-details" />
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="product-details-des">
                                    <div class="manufacturer-name">
                                        <a href="#"><?= $sanPham['ten_thuong_hieu'] ?></a>
                                    </div>
                                    <h3 class="product-name"><?= $sanPham['ten_san_pham'] ?></h3>

                                    <div class="price-box">
                                        <?php
                                        if ($sanPham['gia_khuyen_mai'] > 0) {
                                        ?>
                                            <span class="price-regular"><?php echo formatPrice($sanPham['gia_khuyen_mai']) . " đ" ?></span>
                                            <span class="price-old"><del><?php echo formatPrice($sanPham['gia_san_pham']) . " đ" ?></del></span>
                                        <?php } else { ?>
                                            <span class="price-regular"><?php echo formatPrice($sanPham['gia_san_pham']) . " đ" ?></span>
                                        <?php }
                                        ?>
                                    </div>
                                    <div class="ratings d-flex">
                                        <div class="pro-review comment text-primary">
                                            <i class="fa fa-comment"></i>
                                            <?php $countBL = count($listBinhLuan); ?>
                                            <span><?= $countBL ?> Bình luận</span>
                                        </div>
                                        <div class="pro-review view text-warning">
                                            <i class="fa fa-eye"></i>
                                            <span><?= $sanPham['luot_xem'] ?> lượt xem</span>
                                        </div>
                                        <div class="pro-review stock text-success">
                                            <i class="fa fa-check-circle"></i>
                                            <span><?= $sanPham['so_luong'] ?> Trong kho</span>
                                        </div>
                                    </div>

                                    <p class="pro-desc"><?= $sanPham['mo_ta'] ?></p>
                                    <form action="<?= BASE_URL . '?act=them_gio_hang' ?>" method="POST">
                                        <div class="quantity-cart-box d-flex align-items-center">
                                            <h6 class="option-title">Số lượng:</h6>
                                            <div class="quantity">
                                                <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
                                                <div class="pro-qty"><input type="text" value="1" name="so_luong"></div>
                                            </div>
                                            <div class="action_link">
                                                <button class="btn btn-cart2" >Thêm vào giỏ hàng</button>
                                            </div>
                                        </div>
                                        </form>
                                    <div class="pro-size">
                                        <h6 class="option-title">size :</h6>
                                        <select class="nice-select">

                                            <?php
                                            foreach ($sizeSanPham as $key => $size) :
                                            ?>
                                                <option value="<?php echo $key ?>"><?= $size['size'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="useful-links">
                                        <a href="#" data-bs-toggle="tooltip" title="Compare"><i
                                                class="pe-7s-refresh-2"></i>compare</a>
                                        <a href="#" data-bs-toggle="tooltip" title="Wishlist"><i
                                                class="pe-7s-like"></i>wishlist</a>
                                    </div>
                                    <div class="like-icon">
                                        <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                                        <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                                        <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                                        <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details inner end -->

                    <!-- product details reviews start -->
                    <div class="product-details-reviews section-padding pb-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product-review-info">
                                    <ul class="nav review-tab">

                                        <li>
                                            <a data-bs-toggle="tab" href="#tab_three">bình luận (<?php echo $countBL ?>)</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content reviews-tab">
                                        <?php foreach ($listBinhLuan as $key => $binhLuan) : ?>
                                            <?php if ($binhLuan['trang_thai'] == 1) : ?>


                                                <div class="tab-pane fade show active" id="tab_three">
                                                    
                                                        <div class="total-reviews">
                                                            <div class="rev-avatar">
                                                                <img src="<?= $binhLuan["anh_dai_dien"] ?> " alt=""onerror="this.onerror=null;this.src='https://as2.ftcdn.net/v2/jpg/03/49/49/79/1000_F_349497933_Ly4im8BDmHLaLzgyKg2f2yZOvJjBtlw5.jpg';">
                                                            </div>
                                                            <div class="review-box">

                                                                <div class="post-author">
                                                                    <p><span><?= $binhLuan['ho_ten'] ?> -</span><?= formatDate($binhLuan['ngay_dang']) ?></p>
                                                                </div>
                                                                <p><?= $binhLuan['noi_dung'] ?></p>
                                                            </div>
                                                        </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                                    <form action="<?= BASE_URL . '?act=them_binh_luan' ?>" method="POST" class="review-form">
                                                    <div class="form-group row">
                                                        <div class="col">
                                                            <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
                                                            <input type="hidden" name="tai_khoan" value="<?=$_SESSION['user_client']?>">
                                                            <label class="col-form-label"><span class="text-danger">*</span>
                                                                Nội dung bình luận</label>
                                                            <textarea class="form-control" required name="binh_luan"></textarea>
                                                            <div class="help-block pt-10"><span
                                                                    class="text-danger">Lưu ý:</span>
                                                                Chúng tôi rất trân trọng ý kiến của bạn để cải thiện dịch vụ. Vui lòng cung cấp thông tin cụ thể và chi tiết về trải nghiệm mua hàng của bạn.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="buttons">
                                                        <button class="btn btn-sqr" type="submit">Bình luận</button>
                                                    </div>
                                                    </form> <!-- end of review-form -->
                                                </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details reviews end -->
                </div>
                <!-- product details wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->

    <!-- related products area start -->
    <section class="related-products section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Các Sản phẩm liên quan</h2>
                        <p class="sub-title">Các sản phẩm liên quan được cập nhận hàng tuần</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                        <!-- product item start -->
                        <?php foreach ($listSanPhamCungThuongHieu as $key => $sanPham) : ?>
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
                        <?php endforeach; ?>
                        <!-- product item end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- related products area end -->
</main>


<!-- Scroll to top start -->
<div class="scroll-top not-visible">
    <i class="fa fa-angle-up"></i>
</div>
<!-- Scroll to Top End -->





<!-- offcanvas mini cart start -->

<!-- offcanvas mini cart end -->

<?php require_once './views/layout/footer.php'; ?>
<script>
    $(document).ready(function() {

        $('.testimonial-thumb-carousel').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: true,
            arrows: true,
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });

        $('.testimonial-content-carousel').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            arrows: true
        });
    });
</script>