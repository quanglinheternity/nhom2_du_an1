<!-- header -->
<?php include './views/layout/header.php'; ?>

<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>

<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php'; ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lí sản phẩm</h1>
                </div>

            </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        

        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="col-12">
                            <img style="width:400px;height:500px" src="<?= BASE_URL . $SanPham['hinh_anh'] ?>" class="product-image" alt="Product Image">
                        </div>
                        <div class="col-12 product-image-thumbs">
                            <?php foreach ($listAnhSanPham as $key => $anhSP): ?>
                                <div class="product-image-thumb  <?= $anhSP[$key] == 0 ? 'active' : '' ?>"><img src="<?= BASE_URL . $anhSP['link_hinh_anh'] ?>" alt="Product Image"></div>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3">Tên sản phẩm: <?= $SanPham['ten_san_pham'] ?></p>
                            <hr>
                            <h4 class="mt-3">Giá tiền: <small><?= $SanPham['gia_san_pham'] ?></small></h4>
                            <h4 class="mt-3">Giá khuyến mãi: <small><?= $SanPham['gia_khuyen_mai'] ?></small></h4>
                            <h4 class="mt-3">Số lượng: <small><?= $SanPham['so_luong'] ?></small></h4>
                            <h4 class="mt-3">Lượt xem: <small><?= $SanPham['luot_xem'] ?></small></h4>
                            <h4 class="mt-3">Ngày nhập: <small><?= $SanPham['ngay_nhap'] ?></small></h4>
                            <h4 class="mt-3">Thương Hiệu: <small><?= $SanPham['thuong_hieu_id'] ?></small></h4>
                            <h4 class="mt-3">Trạng thái: <small><?= $SanPham['trang_thai'] == 1 ? 'Còn Bán' : 'Dừng Bán' ?></small></h4>
                            <h4 class="mt-3">Mô tả: <small><?= $SanPham['mo_ta'] ?></small></h4>
                    </div>
                </div>
                <div class="row mt-4">
                    <nav class="w-100">
                        <div class="nav nav-tabs col-12" id="product-tab" role="tablist">
                            <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Bình luận</a>
                        </div>
                    </nav>
                    <div class="col-12">
                        <hr>
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Người bình luận</th>
                                    <th>Nội dung</th>
                                    <th>Ngày bình luận</th>
                                    <th>Trạng Thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listBinhLuan as $key => $BinhLuan): ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td>
                                            <?php if (isset($BinhLuan['ho_ten'])): ?>
                                                <a target="_blank" href="<?= BASE_URL_ADMIN . '?act=chi_tiet_khach_hang&id_khach_hang=' . $BinhLuan['tai_khoan_id'] ?>"><?= $BinhLuan['ho_ten'] ?></a>
                                            <?php else: ?>
                                                <p>Thông tin không có</p>
                                            <?php endif; ?>
                                        </td>

                                        <td><?= $BinhLuan['noi_dung'] ?></td>
                                        <td><?= $BinhLuan['ngay_dang'] ?></td>
                                        <td><?= $BinhLuan['trang_thai'] == 1 ? 'Hiển thị' : 'Bị Ẩn' ?></td>
                                        <td>
                                            <div class="btn-group ">
                                                <form action="<?= BASE_URL_ADMIN . '?act=update_trang_thai_binh_luan' ?>" method="POST">
                                                    <input type="hidden" name="id_binh_luan" value="<?= $BinhLuan['id'] ?>">
                                                    <input type="hidden" name="name_view" value="detail_sanpham">
                                                    <input type="hidden" name="id_khach_hang" value="<?= $BinhLuan['tai_khoan_id'] ?>">
                                                    <button onclick="return confirm('Bạn có muốn ẩn bình luận này không?')" class="btn btn-warning">
                                                        <?= $BinhLuan['trang_thai'] == 1 ? "Ẩn" : "Bỏ ẩn" ?>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </section>




    <!-- /.card-body -->
</div>
<!-- /.card -->
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
<?php include './views/layout/footer.php' ?>;

<!-- end footer -->


<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script>
    $(document).ready(function() {
        $('.product-image-thumb').on('click', function() {
            var $image_element = $(this).find('img')
            $('.product-image').prop('src', $image_element.attr('src'))
            $('.product-image-thumb.active').removeClass('active')
            $(this).addClass('active')
        })
    })
</script>
<!-- Code injected by live-server -->

</body>

</html>