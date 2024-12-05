<?php require_once 'layout/header.php'  ?>
<?php require_once 'layout/menu.php'  ?>


<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=BASE_URL?>"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tài khoản</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- my account wrapper start -->
    <div class="my-account-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- My Account Page Start -->
                        <div class="myaccount-page-wrapper">
                            <!-- My Account Tab Menu Start -->
                            <div class="row">

                                <!-- My Account Tab Menu End -->
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane col-lg-6" id="account-info" role="tabpanel">
                                    <div class="myaccount-content">
                                        <div class="col-lg-12 personal-info">
                                            <form action="<?= BASE_URL . '?act=sua_thong_tin_ca_nhan' ?>" method="POST">
                                              
                                                <input type="text" name="tai_khoan_id" id="" value="<?= $thongTin['id'] ?>" hidden>
                                                <h5>Sửa thông tin tài khoản</h5>
                                                <div class="account-details-form">
                                                <?php if (isset($_SESSION['successTt'])) { ?>
                                                    <div class="alert alert-info alert-dismissable">
                                                        <a href="" class="panel-close close" data-dismiss="alert"></a>
                                                        <i class="fa fa-coffee"></i>
                                                        <?= $_SESSION['successTt'] ?>
                                                    </div>
                                                <?php } ?>

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="ho_ten" class="required">Họ tên</label>
                                                                <input type="text" name="ho_ten" placeholder="Họ tên" value="<?= $thongTin['ho_ten'] ?>" />
                                                                <?php if (isset($_SESSION['errors']['ho_ten'])) { ?>
                                                                    <p class="text-danger"><?= $_SESSION['errors']['ho_ten'] ?></p>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="Email" class="required">Email
                                                                </label>
                                                                <input type="email" name="email" placeholder="Email" value="<?= $thongTin['email'] ?>" />
                                                                <?php if (isset($_SESSION['errors']['email'])) { ?>
                                                                    <p class="text-danger"><?= $_SESSION['errors']['email'] ?></p>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="so_dien_thoai" class="required">Số điện thoại</label>
                                                        <input type="number" name="so_dien_thoai" placeholder="Số điện thoại" value="<?= $thongTin['so_dien_thoai'] ?>" />
                                                        <?php if (isset($_SESSION['errors']['so_dien_thoai'])) { ?>
                                                            <p class="text-danger"><?= $_SESSION['errors']['so_dien_thoai'] ?></p>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="dia_chi" class="required">Địa chỉ</label>
                                                        <input type="dia_chi" name="dia_chi" placeholder="Email Address" value="<?= $thongTin['dia_chi'] ?>" />
                                                        <?php if (isset($_SESSION['errors']['dia_chi'])) { ?>
                                                            <p class="text-danger"><?= $_SESSION['errors']['dia_chi'] ?></p>
                                                        <?php } ?>
                                                    </div>

                                                    <div class="single-input-item">
                                                        <button class="btn btn-sqr" type="submit">Lưu thông tin</button>
                                                    </div>
                                            </form>


                                        </div>

                                    </div>
                                </div>
                            </div>
                                




                            <div class="tab-pane col-lg-6" id="account-info" role="tabpanel">
                                <div class="myaccount-content">
                                    <h5>Sửa ảnh đại diện</h5>

                                    <div class="account-details-form">
                                        <form action="<?= BASE_URL . '?act=sua_anh_tai_khoan' ?>" enctype="multipart/form-data" method="POST">

                                            <fieldset>
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <?php if (isset($_SESSION['successAnh'])) { ?>
                                                            <div class="alert alert-info alert-dismissable">
                                                                <a href="" class="panel-close close" data-dismiss="alert"></a>
                                                                <i class="fa fa-coffee"></i>
                                                                <?= $_SESSION['successAnh'] ?>
                                                            </div>
                                                        <?php } ?>
                                                        <input type="text" name="tai_khoan_id" id="" value="<?= $thongTin['id'] ?>" hidden>

                                                        <img src="<?= $thongTin['anh_dai_dien'] ?>" style="width:100px" class="avatar img-circle" alt="avatar">
                                                        <input type="file" name="anh_dai_dien">
                                                    </div>
                                                </div>



                                                <div class="single-input-item">
                                                    <button class="btn btn-sqr">Lưu ảnh đại diện</button>
                                                </div>



                                        </form>
                                    </div>
                                </div>
                            </div>

                            







                            <div class="tab-pane col-lg-12" id="account-info" role="tabpanel">
                                <div class="myaccount-content">

                                    <div class="account-details-form">
                                        <h5>Sửa mật khẩu</h5>
                                        <?php if (isset($_SESSION['successMk'])) { ?>
                                            <div class="alert alert-info alert-dismissable">
                                                <a href="" class="panel-close close" data-dismiss="alert"></a>
                                                <i class="fa fa-coffee"></i>
                                                <?= $_SESSION['successMk'] ?>
                                            </div>
                                        <?php } ?>

                                        <form action="<?= BASE_URL . '?act=sua_mat_khau' ?>" method="POST">

                                            <fieldset>
                                                <div class="single-input-item">
                                                    <label for="current-pwd" class="required">Mật khẩu hiện tại</label>
                                                    <input type="password" name="old_pass" placeholder="Mật khẩu hiện tại" />
                                                    <?php if (isset($_SESSION['errors']['old_pass'])) { ?>
                                                        <p class="text-danger"><?= $_SESSION['errors']['old_pass'] ?></p>
                                                    <?php } ?>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="new-pwd" class="required">Mật khẩu mới</label>
                                                            <input type="password" name="new_pass" placeholder="Mật khẩu mới" />
                                                            <?php if (isset($_SESSION['errors']['new_pass'])) { ?>
                                                                <p class="text-danger"><?= $_SESSION['errors']['new_pass'] ?></p>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="confirm-pwd" class="required">Nhập lại mật khẩu mới</label>
                                                            <input type="password" name="confirm_pass" placeholder="Nhập lại" />
                                                            <?php if (isset($_SESSION['errors']['confirm_pass'])) { ?>
                                                                <p class="text-danger"><?= $_SESSION['errors']['confirm_pass'] ?></p>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="single-input-item">
                                                <button class="btn btn-sqr">Lưu mật khẩu</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                   
                            </div>
                      
    </div> <!-- Single Tab Content End -->
    </div>
    </div> <!-- My Account Tab Content End -->
    </div>
    </div> <!-- My Account Page End -->
    </div>
   
    <!-- my account wrapper end -->
</main>


<!-- offcanvas mini cart start -->
<!-- offcanvas mini cart end -->

<?php require_once 'layout/footer.php' ?>