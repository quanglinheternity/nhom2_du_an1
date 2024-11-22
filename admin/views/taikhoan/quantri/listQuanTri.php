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
                    <h1>Quản lý Tài khoản quản trị viên</h1>
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
                        <div class="card-header">
                            <a href="<?= BASE_URL_ADMIN . '?act=form_them_quan_tri' ?>">
                                <button type="button" class="btn btn-primary">Thêm tài khoản</button>
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Họ và tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Trang thái</th>
                                        <th>Thao tác</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($listQuanTri as $key => $quanTri) {
                                        ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $quanTri['ho_ten'] ?></td>
                                            <td><?= $quanTri['email'] ?></td>
                                            <td><?= $quanTri['so_dien_thoai'] ?></td>
                                            <td><?= $quanTri['trang_thai'] == 1 ? 'Active' : 'Inactive' ?></td>
                                            <td>
                                                <a
                                                    href="<?= BASE_URL_ADMIN . '?act=form_sua_quan_tri&id_quan_tri=' . $quanTri['id'] ?>"><button
                                                        class="btn btn-warning">Sửa</button></a>
                                                <a href="<?= BASE_URL_ADMIN . '?act=reset_password&id_quan_tri=' . $quanTri['id'] ?>"
                                                    onclick="return confirm('Bạn có muốn đặt lại mật khẩu không?')"><button
                                                        class="btn btn-danger">Reset</button></a>
                                            </td>
                                        </tr>
                                    <?php } ?>


                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>STT</th>
                                        <th>Họ và tên</th>
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