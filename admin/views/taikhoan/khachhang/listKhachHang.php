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
                    <h1>Quản lý Tài khoản khách hàng</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <!-- /.card-header -->

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Họ và tên</th>
                                        <th>Ảnh đại điện</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Trang thái</th>
                                        <th>Thao tác</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($listKhachHang as $key => $khachHang) {
                                        ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $khachHang['ho_ten'] ?></td>
                                            <td>
                                                <img src="<?=BASE_URL . $khachHang['anh_dai_dien'] ?>" style="max-width: 120px; max-height: 100px" alt="" onerror="this.onerror=null;this.src='https://as2.ftcdn.net/v2/jpg/03/49/49/79/1000_F_349497933_Ly4im8BDmHLaLzgyKg2f2yZOvJjBtlw5.jpg';">
                                            </td>
                                            <td><?= $khachHang['email'] ?></td>
                                            <td><?= $khachHang['so_dien_thoai'] ?></td>
                                            <td><?= $khachHang['trang_thai'] == 1 ? 'Active' : 'Inactive' ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a
                                                        href="<?= BASE_URL_ADMIN . '?act=chi_tiet_khach_hang&id_khach_hang=' . $khachHang['id'] ?>"><button
                                                            class="btn btn-primary"><i class="fas fa-eye"></i></button></a>
                                                    <a
                                                        href="<?= BASE_URL_ADMIN . '?act=form_sua_khach_hang&id_khach_hang=' . $khachHang['id'] ?>"><button
                                                            class="btn btn-warning"><i class="fas fa-tools"></i></button></a>
                                                </div>
                                               
                                            </td>
                                        </tr>
                                    <?php } ?>


                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>STT</th>
                                        <th>Họ và tên</th>
                                        <th>Ảnh đại điện</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Trang thái</th>
                                        <th>Thao tác</th>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
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
<?php
include './views/layout/footer.php'
    ?>
<!-- end footer -->

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
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
<!-- Code injected by live-server -->

</body>

</html>