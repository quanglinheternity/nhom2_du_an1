<!-- Start Header Area -->
<header class="header-area header-wide">
        <!-- main header start -->
        <div class="main-header d-none d-lg-block">
            <!-- header middle area start -->
            <div class="header-main-area sticky">
                <div class="container">
                    <div class="row align-items-center position-relative">

                        <!-- start logo area -->
                        <div class="col-lg-2">
                            <div class="logo">
                                <a href="<?php echo BASE_URL ?>">
                                    <img src="assets/img/logo/Logo.png  " alt="Brand Logo" width="120px">
                                </a>
                            </div>
                        </div>
                        <!-- start logo area -->

                        <!-- main menu area start -->
                        <div class="col-lg-6 position-static">
                            <div class="main-menu-area">
                                <div class="main-menu">
                                    <!-- main menu navbar start -->
                                    <nav class="desktop-menu">
                                        <ul>
                                            <li class="active"><a href="<?php echo BASE_URL ?>">Trang chủ</a>
                                               
                                            </li>
                                           
                                            <li><a href="# ">Thương hiệu <i class="fa fa-angle-down"></i></a>
                                                <ul class="dropdown">   
                                                <?php  
                                                    $listThuongHieu=listThuongHieu();

                                                foreach($listThuongHieu as $ThuongHieu): ?>
                                                    <!-- <li><a href="#">blog left sidebar</a></li> -->
                                                     <li><a href="<?=BASE_URL.'?act=san_pham_theo_thuong_hieu&thuong_hieu_id='.$ThuongHieu['id'] ?>"><?php echo $ThuongHieu['ten_thuong_hieu']?></a></li>
                                                   <?php endforeach ?>
                                                </ul>
                                            </li>
                                            <li><a href="#">Sản phẩm</a></li>
                                            <li><a href="#">Giới thiệu</a></li>
                                            <li><a href="#">liên hệ</a></li>
                                        </ul>
                                    </nav>
                                    <!-- main menu navbar end -->
                                </div>
                            </div>
                        </div>
                        <!-- main menu area end -->

                        <!-- mini cart area start -->
                        <div class="col-lg-4">
                            <div class="header-right d-flex align-items-center justify-content-xl-between justify-content-lg-end">
                                <div class="header-search-container">
                                    <button class="search-trigger d-xl-none d-lg-block"><i class="pe-7s-search"></i></button>
                                    <form class="header-search-box d-lg-none d-xl-block" action="<?=BASE_URL.'?act=search'?>" method="POST">
                                        <input type="text" name="tim_kiem" placeholder="Nhập tên sản phẩm ..." class="header-search-field">
                                        <button class="header-search-btn"><i class="pe-7s-search"></i></button>
                                    </form>
                                </div>
                                <div class="header-configure-area">
                                    <ul class="nav justify-content-end">
                                    
                                    <li class="user-hover">
                                            <a href="#">
                                                <i class="pe-7s-user"></i>
                                            </a>
                                            <ul class="dropdown-list">
                                            <li><a href="#"><?php 
                                            
                                            if (isset($_SESSION['user_client'])){ 
                                                $name=preg_replace('/@.*/', '', $_SESSION['user_client']);
                                                echo ucfirst($name)
                                            ?></a></li>
                                            <li><a href="<?= BASE_URL.'?act=quan_ly_tai_khoan' ?>">tài khoản</a></li>
                                            <li><a href="<?= BASE_URL.'?act=lich_su_mua_hang' ?>">Lịch sử mua hàng</a></li>
                                            <li><a href="<?= BASE_URL.'?act=logout_client' ?>"onclick="return confirm('Bạn có muốn đăng xuất?')" role="button">Đăng xuất</a></li>
                                            <?php } else{
                                            ?>
                                                <li><a href="<?php echo BASE_URL . '?act=login_client' ?>">đăng nhập</a></li>
                                                <li><a href="<?='?act=register'?>">đăng ký</a></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        
                                        <li >
                                            <a href="<?php echo BASE_URL. '?act=gio_hang' ?>" class="minicart-btn">
                                                <!-- <i class="pe-7s-shopbag"></i> -->
                                                <i class="fa fa-shopping-bag"></i>

                                                 <!-- <i>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                                </svg>
                                                </i> -->
                                                <!-- <i class="bi bi-cart3"></i> -->
                                                <!-- <div class="notification">2</div> -->
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- mini cart area end -->

                    </div>
                </div>
            </div>
            <!-- header middle area end -->
        </div>
        <!-- main header start -->

    </header>
    <!-- end Header Area -->
<style>
    .cart_ani{
        animation-name: myani;
        animation-duration: 0.5s ;
    }
    @keyframes myani{
        0%{
            transform: scale(1);
        }
        25%{
            transform: scale(1.2);
        }
        50%{
            transform: scale(1);
        }
        75%{
            transform: scale(1.2);
        }
        100%{
            transform: scale(1);
        }
    }
</style>