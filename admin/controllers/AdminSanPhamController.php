<?php
class AdminSanPhamController
{
    public $moldedSanPham;
    public $moldedThuongHieu;

    public function __construct()
    {
        $this->moldedSanPham = new AdminSanPham();
        $this->moldedThuongHieu = new AdminThuongHieu();
    }

    public function danhSachSanPham()
    {
        $listSanPham = $this->moldedSanPham->getAllSanPham();
        require_once './views/SanPham/listSanPham.php';
    }
    public function formAddSanPham()
    {
        $listThuongHieu = $this->moldedThuongHieu->getAllThuongHieu();
        require_once './views/Sanpham/addSanPham.php';

        deleteSessionError();
    }
    public function postAddSanPham()
    {
        // var_dump($_POST);
        //kiểm tra thêm dữ liệu có phải được submit ko
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //lấy dữ liệu
            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia_san_pham = $_POST['gia_san_pham'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $ngay_nhap = $_POST['ngay_nhap'] ?? '';
            $thuong_hieu_id = $_POST['thuong_hieu_id'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';
            $hinh_anh = $_FILES['hinh_anh']  ?? null;

            $img_array = $_FILES['img_array'];

            $file_thumb = uploadFile($hinh_anh, './uploads/');





            // xu ly upload file
            $error = [];
            if (empty($ten_san_pham)) {
                $error['ten_san_pham'] = "Tên sản phẩm không được để trống";
            }
            if (empty($gia_san_pham)) {
                $error['gia_san_pham'] = "giá sản phẩm không được để trống";
            }
            if (empty($gia_khuyen_mai)) {
                $error['gia_khuyen_mai'] = "Giá Khuyến mãi sản phẩm  không được để trống";
            }
            if (empty($so_luong)) {
                $error['so_luong'] = "Số lượng sản phẩm không được để trống";
            }
            if (empty($ngay_nhap)) {
                $error['ngay_nhap'] = "Ngaỳ nhập sản phẩm không được để trống";
            }
            if (empty($thuong_hieu_id)) {
                $error['thuong_hieu_id'] = "Danh Mục sản phẩm phải chọn";
            }
            if (empty($trang_thai)) {
                $error['trang_thai'] = "Trạng thái sản phẩm phải chọn";
            }
            if ($hinh_anh['error'] !== 0) {
                $error['hinh_anh'] = "Hình ảnh sản phẩm phải chọn";
            }
            $_SESSION['error'] = $error;
            // debug($_SESSION['error'])  ;die();
            //nếu không có lỗi tiến hành thêm danh mục
            if (empty($error)) {
                $san_pham_id = $this->moldedSanPham->insertSanPham($ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $thuong_hieu_id, $trang_thai, $mo_ta, $file_thumb);


                if (!empty($img_array['name'])) {
                    foreach ($img_array['name'] as $key => $value) {
                        $file = [
                            'name' => $img_array['name'][$key],
                            'type' => $img_array['type'][$key],
                            'tmp_name' => $img_array['tmp_name'][$key],
                            'error' => $img_array['error'][$key],
                            'size' => $img_array['size'][$key]



                        ];
                        $link_hinh_anh = uploadFile($file, './uploads/');
                        $this->moldedSanPham->insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh);
                    }
                }


                header('location: ' . BASE_URL_ADMIN . '?act=san_pham');
                exit();
            } else {

                // require_once './views/SanPham/addSanPham.php';
                $_SESSION['flash'] = true;
                // debug($_SESSION['error']);                
                header('location: ' . BASE_URL_ADMIN . '?act=form_them_san_pham');
                exit();
            }
        }
    }
    public function formEditSanPham()
    {
        $id = $_GET['id_san_pham'];
        $SanPham = $this->moldedSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->moldedSanPham->getListAnhSanPham($id);
        $listThuongHieu = $this->moldedThuongHieu->getAllThuongHieu();
        if ($SanPham) {
            require_once './views/SanPham/editSanpham.php';
            deleteSessionError();
        } else {
            header('location :' . BASE_URL_ADMIN . '?act=san_pham');
            exit();
        }
        // require_once './views/SanPham/editsanPham.php';
    }

    public function postEditSanPham()
    {
        // var_dump($_POST);
        //kiểm tra thêm dữ liệu có phải được submit ko
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //lấy dữ liệu
            $san_pham_id = $_POST['san_pham_id'] ?? '';

            $SanPhamOld = $this->moldedSanPham->getDetailSanPham($san_pham_id);
            $old_file = $SanPhamOld['hinh_anh'];




            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia_san_pham = $_POST['gia_san_pham'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $ngay_nhap = $_POST['ngay_nhap'] ?? '';
            $thuong_hieu_id = $_POST['thuong_hieu_id'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';
            $hinh_anh = $_FILES['hinh_anh']  ?? null;





            // xu ly upload file
            $error = [];
            if (empty($ten_san_pham)) {
                $error['ten_san_pham'] = "Tên sản phẩm không được để trống";
            }
            if (empty($gia_san_pham)) {
                $error['gia_san_pham'] = "giá sản phẩm không được để trống";
            }
            if (empty($gia_khuyen_mai)) {
                $error['gia_khuyen_mai'] = "Giá Khuyến mãi sản phẩm  không được để trống";
            }
            if (empty($so_luong)) {
                $error['so_luong'] = "Số lượng sản phẩm không được để trống";
            }
            if (empty($ngay_nhap)) {
                $error['ngay_nhap'] = "Ngaỳ nhập sản phẩm không được để trống";
            }
            if (empty($thuong_hieu_id)) {
                $error['thuong_hieu_id'] = "Danh Mục sản phẩm phải chọn";
            }
            if (empty($trang_thai)) {
                $error['trang_thai'] = "Trạng thái sản phẩm phải chọn";
            }

            $_SESSION['error'] = $error;


            if (isset($hinh_anh) && $hinh_anh['error'] == UPLOAD_ERR_OK) {
                $new_file = uploadFile($hinh_anh, './uploads/');
                if (!empty($old_file)) {
                    deleteFile($old_file);
                }
            } else {
                $new_file = $old_file;
            }
            // debug($_SESSION['error'])  ;die();
            //nếu không có lỗi tiến hành thêm danh mục
            if (empty($error)) {
                $this->moldedSanPham->updateSanPham($san_pham_id, $ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $thuong_hieu_id, $trang_thai, $mo_ta, $new_file);


                header('location: ' . BASE_URL_ADMIN . '?act=san_pham');
                exit();
            } else {

                // require_once './views/SanPham/addSanPham.php';
                $_SESSION['flash'] = true;
                // debug($_SESSION['error']);                
                header('location: ' . BASE_URL_ADMIN . '?act=form_sua_san_pham&id_san_pham=' . $san_pham_id);
                exit();
            }
        }
    }
    public function postEditAnhSanPham()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $san_pham_id = $_POST['san_pham_id'];
            // lấy  danh sách sản phẩm hiện tại
            $listAnhSanPhamCurrent = $this->moldedSanPham->getListAnhSanPham($san_pham_id);
            // xử lý các ảnh  được gửi từ form
            $img_arry = $_FILES['img_array'];
            $img_delete = isset($_POST['img_delete']) ? explode(',', $_POST['img_delete']) : [];
            $current_img_ids = $_POST['current_img_ids'] ?? [];
            // var_dump($current_img_ids) ; die();
            // khai báo mảng để lưu ảnh  thêm mới  hoặc thay thế ảnh cũ
            $upload_file = [];
            //Upload ảnh mới hoặc thay thế ảnh cũ
            foreach ($img_arry['name'] as $key => $value) {
                if ($img_arry['error'][$key] == UPLOAD_ERR_OK) {
                    $new_file = uploadFileAlbum($img_arry, './uploads/', $key);
                    if ($new_file) {
                        $upload_file[] = [
                            'id' => $current_img_ids[$key] ?? null,
                            'file' => $new_file
                        ];
                    }
                }
            }
            // lưu ảnh vào db và xóa ảnh cũ nếu có
            foreach ($upload_file as $file_info) {
                if ($file_info['id']) {
                    // var_dump($file_info['id']); die();

                    $old_file = $this->moldedSanPham->getDetailAnhSanPham($file_info['id'])['link_hinh_anh'];

                    // cập nhập ảnh cũ
                    $this->moldedSanPham->updateAnhSanPham($file_info['id'], $file_info['file']);
                    // var_dump($file_info['id']); die();
                    // xóa ảnh cũ
                    deleteFile($old_file);
                } else {
                    $this->moldedSanPham->insertAlbumAnhSanPham($san_pham_id, $file_info['file']);
                }
            }

            // xử lý ảnh
            foreach ($listAnhSanPhamCurrent as $anhSP) {
                $anh_id = $anhSP['id'];
                if (in_array($anh_id, $img_delete)) {
                    //xóa ảnh
                    $this->moldedSanPham->destroyAnhSanPham($anh_id);
                    // xóa file ảnh
                    deleteFile($anhSP['link_hinh_anh']);
                }
            }
            header('location: ' . BASE_URL_ADMIN . '?act=form_sua_san_pham&id_san_pham=' . $san_pham_id);
            exit();
        }
    }


    public function deleteSanPham()
    {
        $id = $_GET['id_san_pham'];
        $SanPham = $this->moldedSanPham->getDetailSanPham($id);

        if ($SanPham) {
            deleteFile($SanPham['hinh_anh']);
            $this->moldedSanPham->destroySanPham($id);
        }
        header('location: ' . BASE_URL_ADMIN . '?act=san_pham');
        exit;
    }
    public function detailSanPham()
    {
        $id = $_GET['id_san_pham'];
        $SanPham = $this->moldedSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->moldedSanPham->getListAnhSanPham($id);
        $listBinhLuan = $this->moldedSanPham->getBinhLuanFromSanPham($id);
        if ($SanPham) {
            require_once './views/SanPham/detailSanpham.php';
        } else {
            header('location :' . BASE_URL_ADMIN . '?act=san_pham');
            exit();
        }
        // require_once './views/SanPham/editsanPham.php';
    }
    public function updateTrangThaiBinhLuan()
    {
        $id_binh_luan = $_POST['id_binh_luan'];
        $name_view = $_POST['name_view'];
        $id_khach_hang = $_POST['id_khach_hang'];
        $BinhLuan = $this->moldedSanPham->getDetailBinhLuan($id_binh_luan);

        if ($BinhLuan) {
            $trang_thai_update = '';
            if ($BinhLuan['trang_thai'] == 1) {
                $trang_thai_update = 2;
            } else {
                $trang_thai_update = 1;
            }

            $status =  $this->moldedSanPham->updateTrangThaiBinhLuan($id_binh_luan, $trang_thai_update);
            if ($status) {
                if ($name_view == 'detail_khach') {
                    header("location:" . '?act=chi_tiet_khach_hang&id_khach_hang=' . $id_khach_hang);
                } else {
                    header("location:" . '?act=chi_tiet_san_pham&id_san_pham=' . $BinhLuan['san_pham_id']);
                }
            }
        }
    }
}
