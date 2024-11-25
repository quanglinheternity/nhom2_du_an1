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
          <h1>Sửa thông tin sản phẩm: <?= $SanPham['ten_san_pham'] ?></h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-8">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Thông tin sản phẩm</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <form action="<?= BASE_URL_ADMIN . '?act=sua_san_pham' ?>" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-group">
                <input type="hidden" name="san_pham_id" value="<?= $SanPham['id'] ?>">
                <label for="ten_san_pham">Tên sản phẩm</label>
                <input type="text" id="ten_san_pham" name="ten_san_pham" class="form-control" value="<?= $SanPham['ten_san_pham'] ?>">
                <?php if (isset($_SESSION['error']['ten_san_pham'])) {  ?>
                  <p class="text-danger"><?= $_SESSION['error']['ten_san_pham'] ?></p>
                <?php } ?>
              </div>
              <div class="form-group">
                <label for="gia_san_pham">Giá sản phẩm</label>
                <input type="number" id="gia_san_pham" name="gia_san_pham" class="form-control" value="<?= $SanPham['gia_san_pham'] ?>">
              </div>
              <div class="form-group">
                <label for="gia_khuyen_mai">Giá khuyến mãi</label>
                <input type="number" id="gia_khuyen_mai" name="gia_khuyen_mai" class="form-control" value="<?= $SanPham['gia_khuyen_mai'] ?>">
              </div>
              <div class="form-group">
                <label for="hinh_anh">Hình ảnh sản phẩm</label>
                <input type="file" id="hinh_anh" name="hinh_anh" class="form-control">

              </div>
              <div class="form-group">
                <label for="so_luong">số lượng</label>
                <input type="number" id="so_luong" name="so_luong" class="form-control" value="<?= $SanPham['so_luong'] ?>">
              </div>
              <div class="form-group">
                <label for="ngay_nhap">ngày nhập</label>
                <input type="text" id="ngay_nhap" name="ngay_nhap" class="form-control" value="<?= $SanPham['ngay_nhap'] ?>">
              </div>
              <div class="form-group">
                <label for="ten_san_pham">Thương hiệu sản phẩm</label>
                <select id="inputStatus" name="thuong_hieu_id" class="form-control custom-select">
                  <?php foreach ($listThuongHieu as $Thuonghieu): ?>
                    <option <?= $Thuonghieu['id'] == $SanPham['thuong_hieu_id'] ? 'selected' : '' ?> value="<?= $Thuonghieu['id']; ?>"><?= $Thuonghieu['ten_thuong_hieu']; ?></option>

                  <?php endforeach ?>

                </select>
              </div>
              <div class="form-group">
                <label for="trang_thai">Trạng thái sản phẩm</label>
                <select id="trang_thai" name="trang_thai" class="form-control custom-select">
                  <option <?= $SanPham['trang_thai'] == 1 ? 'selected' : '' ?> value="1">Còn Bán</option>
                  <option <?= $SanPham['trang_thai'] == 2 ? 'selected' : '' ?> value="2">Dừng Bán</option>



                </select>
              </div>
              <div class="form-group">
                <label for="mo_ta">Mô tả sản phẩm</label>
                <textarea name="mo_ta" id="" class="form-control" placeholder="Nhập mô tả "><?= $SanPham['mo_ta'] ?></textarea>
              </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <button type="submit" class="btn btn-primary">Sửa Thông Tin</button>
              <a href="?act=san_pham" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
        </form>
        <!-- /.card -->
      </div>
      <div class="col-md-4">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Album ảnh sản phẩm</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0">
            <form action="<?= BASE_URL_ADMIN . '?act=sua_album_anh_san_pham' ?>" method="POST"
              enctype="multipart/form-data">
              <table id="faqs" class="table table-hover">
                <thead>
                  <tr>
                    <th>Ảnh</th>
                    <th>File</th>
                    <th>
                      <div class="text-center"><button onclick="addfaqs();" type="button"
                          class="badge badge-success"><i class="fa fa-plus"></i>
                          Add</button></div>
                    </th>

                  </tr>
                </thead>
                <tbody>
                  <input type="hidden" name="san_pham_id" value="<?= $SanPham['id'] ?>">
                  <input type="hidden" id="img_delete" name="img_delete">

                  <?php foreach ($listAnhSanPham as $key => $value): ?>


                    <tr id="faqs-row-<?= $key ?>">
                      <input type="hidden" name="current_img_ids[]" value="<?= $value['id'] ?>">
                      <td><img src="<?= BASE_URL . $value['link_hinh_anh'] ?>" alt="" style="width: 60px; height: 50px;">
                      </td>
                      <td><input type="file" name="img_array[]" class="form-control"></td>
                      <td class="mt-10"><button class="badge badge-danger" type="button"
                          onclick="removeRow(<?= $key ?>,<?= $value['id'] ?>)"><i class="fa fa-trash"></i>
                          Delete</button>
                      </td>
                    </tr>
                  <?php endforeach; ?>

                </tbody>
              </table>
              <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary" name="sua_san_pham">Sửa thông tin</button>
              </div>
            </form>
          </div>

          <!-- <a href="?act=san_pham" class="btn btn-secondary">Cancel</a> -->
        </div>

      </div>
    </div>
    <div class="row">
      <div class="col-12">

        <!-- <input type="submit" value="Save Changes" class="btn btn-success float-right"> -->
      </div>
    </div>
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
<script>
  var faqs_row = <?= count($listAnhSanPham); ?>;

  function addfaqs() {
    html = '<tr id="faqs-row-' + faqs_row + '">';
    html += '<td><img src="https://photo.znews.vn/w1920/Uploaded/yqdxwpjwq/2021_02_20/chanel.jpg" style="width:50px;height:50px" alt=""></td>';
    html += '<td><input type="file"  name="img_array[]" class="form-control"></td>';
    html += '<td class="mt-10"><button class="badge badge-danger" type="button" onclick="removeRow(' + faqs_row + ', null);"><i class="fa fa-trash"></i> Delete</button></td>';
    html += '</tr>';

    $('#faqs tbody').append(html);

    faqs_row++;
  }

  function removeRow(rowId, imgId) {
    $('#faqs-row-' + rowId).remove();
    if (imgId !== null) {
      var imgDeleteInput = document.getElementById('img_delete')
      var currentValue = imgDeleteInput.value;
      imgDeleteInput.value = currentValue ? currentValue + ',' + imgId : imgId;
    }
  }
</script>

</html>