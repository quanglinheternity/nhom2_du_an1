
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
                                    <li class="breadcrumb-item active" aria-current="page">Đăng nhập</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- login register wrapper start -->
        <div class="login-register-wrapper section-padding">
            <div class="container" style="max-width: 40vw">
                <div class="member-area-from-wrap ">
                    <div class="row">
                        <!-- Login Content Start -->
                        <div class="col-lg-12">
                            
                            <div class="login-reg-form-wrap">
                                <h3 class="login-title text-center">Đăng nhập</h3>
                                <div class="card-body">
                                <?php if(isset($_SESSION['error']) ){  ?>
                                            <p class="text-danger text-center"><?=$_SESSION['error'];unset($_SESSION['error']) ?></p>
                                        <?php }else { ?>
                                            <p class="login-box-msg text-center">Vui lòng đăng nhập tài khoản của bạn</p>
                                            <?php
                                        }
                                            ?>
                                <form action="<?= BASE_URL . '?act=check_login_client' ?>" method="post">
                               
                                    <div class="single-input-item">
                                        <label for="" class="required">Email</label>
                                        <input type="email" placeholder="Email or Username" name="email" required />
                                    </div>
                                    <div class="single-input-item">
                                        <label for="" class="required">Password</label>
                                        <input type="text" placeholder="Enter your Password" name="password" required />
                                    </div>
                                    <div class="single-input-item">
                                        <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                            <div class="remember-meta">
                                                
                                            </div>
                                            <a href="?act=quen_mat_khau" class="forget-pwd">Quên mật khẩu ?</a>
                                        </div>
                                    </div>
                                    <div class="single-input-item">
                                        <button class="btn btn-sqr">Đăng nhập</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        <!-- Login Content End -->

                       
                    </div>
                </div>
            </div>
        </div>
        <!-- login register wrapper end -->
    </main>


   <?php require_once './views/layout/footer.php';?>
   <script>
$(document).ready(function(){   

    $('.testimonial-thumb-carousel').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: true,
        arrows: true,
        responsive: [
            {
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