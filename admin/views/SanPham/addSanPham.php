<!-- header? -->
<?php
require './views/layout/header.php'

?>
<!-- end header -->
<!-- sidebar -->
<?php
require './views/layout/sidebar.php'

?>
<!-- end sidebar -->

<!-- Navbar -->
<?php
include './views/layout/navbar.php'
?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý Sản Phẩm</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thêm sản phẩm</h3>
                        </div>


                        <form action="<?= BASE_URL_ADMIN . '?act=them_san_pham' ?>" method="POST" enctype="multipart/form-data">
                            <div class="row card-body ">
                                <div class="form-group col-6">
                                    <label>Tên Sản Phẩm</label>
                                    <input type="text" class="form-control" name="ten_san_pham" placeholder="Nhập tên sản phẩm">
                                    <?php if (isset($_SESSION['error']['ten_san_pham'])) {  ?>
                                        <p class="text-danger"><?= $_SESSION['error']['ten_san_pham'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-6">
                                    <label>Giá sản phẩm</label>
                                    <input type="number" class="form-control" name="gia_san_pham" placeholder="Nhập Giá sản phẩm">
                                    <?php if (isset($_SESSION['error']['gia_san_pham'])) {  ?>
                                        <p class="text-danger"><?= $_SESSION['error']['gia_san_pham'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-6">
                                    <label>Giá khuyến mãi</label>
                                    <input type="number" class="form-control" name="gia_khuyen_mai" placeholder="Nhập Giá khuyến mãi">
                                    <?php if (isset($_SESSION['error']['gia_khuyen_mai'])) {  ?>
                                        <p class="text-danger"><?= $_SESSION['error']['gia_khuyen_mai'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-6">
                                    <label>Hình ảnh</label>
                                    <input type="file" class="form-control" name="hinh_anh">
                                    <?php if (isset($_SESSION['error']['hinh_anh'])) {  ?>
                                        <p class="text-danger"><?= $_SESSION['error']['hinh_anh'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-6">
                                    <label>Album ảnh</label>
                                    <input type="file" class="form-control" name="img_array[]" multiple>

                                </div>
                                <div class="form-group col-6">
                                    <label>Số Lượng</label>
                                    <input type="number" class="form-control" name="so_luong" placeholder="Nhập Số Lượng">
                                    <?php if (isset($_SESSION['error']['so_luong'])) {  ?>
                                        <p class="text-danger"><?= $_SESSION['error']['so_luong'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-6">
                                    <label>Ngày Nhập</label>
                                    <input type="date" class="form-control" name="ngay_nhap" placeholder="Nhập Ngày Nhập">
                                    <?php if (isset($_SESSION['error']['ngay_nhap'])) {  ?>
                                        <p class="text-danger"><?= $_SESSION['error']['ngay_nhap'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-6">
                                    <label>Thương Hiệu</label>
                                    <select class="form-control" name="thuong_hieu_id" id="exampleFormControlSelect1">
                                        <option selected disabled>chọn thương hiệu sản phẩm</option>
                                        <?php foreach ($listThuongHieu as $ThuongHieu):    ?>
                                            <option value="<?= $ThuongHieu['id'] ?>"><?= $ThuongHieu['ten_thuong_hieu'] ?></option>

                                        <?php endforeach ?>

                                    </select>

                                    <?php if (isset($_SESSION['error']['so_luong'])) {  ?>
                                        <p class="text-danger"><?= $_SESSION['error']['so_luong'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-6">
                                    <label>Trạng Thái</label>
                                    <select class="form-control" name="trang_thai" id="exampleFormControlSelect1">
                                        <option selected disabled>chọn trạng thái sản phẩm</option>
                                        <option value="1">Còn bán </option>
                                        <option value="2">Dừng bán</option>


                                    </select>

                                    <?php if (isset($_SESSION['error']['trang_thai'])) {  ?>
                                        <p class="text-danger"><?= $_SESSION['error']['trang_thai'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group  col-6">
                                    <label>Mô tả</label>
                                    <textarea name="mo_ta" id="" class="form-control" placeholder="Nhập mô tả "></textarea>
                                </div>



                                <div class=" text-center col-12">
                                    <button type="submit" class="btn btn-primary ">Submit</button>
                                    <!-- <a href="" class="btn btn-danger">Exit</a> -->

                                    <!-- <button   >Exit</button> -->

                                </div>
                        </form>
                    </div>
                </div>

                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- footer -->
<?php
include './views/layout/footer.php'
?>
<!-- end footer -->


<!-- Code injected by live-server -->

</body>

</html>