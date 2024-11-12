<?php
class AdminTaiKhoanController
{
    public $moldedTaiKhoan;
    public $moldedDonHang;
    public $moldedSanPham;
    public function __construct()
    {
        $this->moldedTaiKhoan = new AdminTaiKhoan();
        // $this->moldedDonHang = new AdminDonHang();
        // $this->moldedSanPham = new AdminSanPham();
    }
    public function home()
    {
        require_once './views/home.php';
    }
    public function listTaiKhoanQuanTri()
    {
        $listQuanTri = $this->moldedTaiKhoan->getAllTaiKhoan(1);
        require_once './views/taikhoan/quantri/listQuanTri.php';
    }
    public function formAddTaiKhoanQuanTri()
    {
        require_once './views/taikhoan/quantri/AddQuanTri.php';
        //  var_dump($_SESSION);
        deleteSessionError();
    }
    public function postAddTaiKhoanQuanTri()
    {
        // var_dump($_POST);
        //kiểm tra thêm dữ liệu có phải được submit ko
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //lấy dữ liệu
            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            // xu ly upload file
            $error = [];
            if (empty($ho_ten)) {
                $error['ho_ten'] = "Họ tên không được để trống";
            }
            if (empty($email)) {
                $error['email'] = "Email không được để trống";
            }
            if (empty($so_dien_thoai)) {
                $error['so_dien_thoai'] = "Số điện thoại không được để trống";
            }
            $_SESSION['error'] = $error;
            //nếu không có lỗi tiến hành thêm danh mục
            if (empty($error)) {
                //pass mặc định
                $password = password_hash('Qlinh@369', PASSWORD_BCRYPT);
                //khai bao chức vụ
                $chuc_vu_id = 1;
                $s = $this->moldedTaiKhoan->insertTaiKhoanQuanTri($ho_ten, $email, $so_dien_thoai,$password, $chuc_vu_id);
                // var_dump($s);die();

                header('location: ' . BASE_URL_ADMIN . '?act=list_tai_khoan_quan_tri');
                exit();
            } else {

                // require_once './views/danhmuc/addDanhMuc.php';
                $_SESSION['flash'] = true;
                header('location: ' . BASE_URL_ADMIN . '?act=form_them_quan_tri');
                exit();
            }
        }

    }
    public function formEditTaiKhoanQuanTri()
    {
        $id = $_GET['id_quan_tri'] ?? '';
        $listQuanTri = $this->moldedTaiKhoan->getTaiKhoanQuanTriById($id);
        // var_dump($listQuanTri);
        require_once './views/taikhoan/quantri/editQuanTri.php';
        deleteSessionError();
    }
    public function postEditTaiKhoanQuanTri()
    {
        // var_dump($_POST);
        //kiểm tra thêm dữ liệu có phải được submit ko
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //lấy dữ liệu
            //lấy  ra dữ liệu tu form
            $quan_tri_id = $_POST['quan_tri_id'] ?? '';
            //truy vấn

            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';

            $error = [];
            if (empty($ho_ten)) {
                $error['$ho_ten'] = "Tên không được để trống";
            }
            if (empty($email)) {
                $error['email'] = "Email không được để trống";
            }

            if (empty($trang_thai)) {
                $error['trang_thai'] = "Trạng thái phải chọn";
            }


            $_SESSION['error'] = $error;

            //nếu không có lỗi tiến hành thêm danh mục
            if (empty($error)) {
                $s = $this->moldedTaiKhoan->updateTaiKhoanQuanTri(
                    $quan_tri_id,   
                    $ho_ten,
                    $email,
                    $so_dien_thoai,
                    $trang_thai,
                );
                //xưu lý abum
                // var_dump($s);die();
                header('location: ' . BASE_URL_ADMIN . '?act=list_tai_khoan_quan_tri');
                exit();
                // exit();
            } else {

                // $listDanhMuc = $this->moldedDanhMuc->getAllDanhMuc();
                // require_once './views/SanPham/addSanPham.php';
                // đặt chi thi xóa session sau khi hiên thị
                $_SESSION['flash'] = true;
                header('location: ' . BASE_URL_ADMIN . '?act=form_sua_quan_tri&id_quan_tri=' . $quan_tri_id);
                exit();

            }
        }
    }
    public function resetPassword()
    {
        $tai_khoan_id = $_GET['id_quan_tri'] ?? '';
        $tai_khoan = $this->moldedTaiKhoan->getTaiKhoanQuanTriById($tai_khoan_id);

        $password = password_hash('123@123ab', PASSWORD_BCRYPT);
        $sataus = $this->moldedTaiKhoan->resetPassword($tai_khoan_id, $password);
        if ($sataus && $tai_khoan['chuc_vu_id'] == 1) {
            header('location:' . BASE_URL_ADMIN . '?act=list_tai_khoan_quan_tri');
            exit();
        } else if ($sataus && $tai_khoan['chuc_vu_id'] == 2) {
            header('location:' . BASE_URL_ADMIN . '?act=list_tai_khoan_khach_hang');
            exit();
        } else {
            var_dump('Không thành công');
            die();
        }
    }
    
    
   
   
   
}