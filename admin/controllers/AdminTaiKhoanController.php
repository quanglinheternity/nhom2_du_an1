<?php
class AdminTaiKhoanController
{
    public $moldedTaiKhoan;
    public $moldedDonHang;
    public $moldedSanPham;
    public function __construct()
    {
        $this->moldedTaiKhoan = new AdminTaiKhoan();
        $this->moldedDonHang = new AdminDonHang();
        $this->moldedSanPham = new AdminSanPham();
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
                $password = password_hash('Qlinh371', PASSWORD_BCRYPT);
                //khai bao chức vụ
                $chuc_vu_id = 1;
                $s = $this->moldedTaiKhoan->insertTaiKhoanQuanTri($ho_ten, $email, $so_dien_thoai, $password, $chuc_vu_id);
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

        $password = password_hash('Qlinh371', PASSWORD_BCRYPT);
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
    public function formLogin()
    {
        require_once './views/auth/formLogin.php';
        deleteSessionError();
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            // var_dump($email,$password);die();
            //xử lý đăng nhận kiểm tra
            $user = $this->moldedTaiKhoan->checkLogin($email, $password);
            if ($user == $email) {
                $_SESSION['user_admin'] = $user;
                header('location: ' . BASE_URL_ADMIN);
                exit();
            } else {
                $_SESSION['error'] = $user;
                // var_dump($_SESSION['error']);die();
                $_SESSION['flash'] = true;
                header('location: ' . BASE_URL_ADMIN . '?act=login_admin');
                exit();
            }
        }
    }
    public function logout()
    {
        if (isset($_SESSION['user_admin'])) {
            unset($_SESSION['user_admin']);
            unset($_SESSION['error']);
        }
        header('location: ' . BASE_URL_ADMIN . '?act=login_admin');
        exit();
    }
    public function listKhachHang()
    {

        $listKhachHang = $this->moldedTaiKhoan->getAllTaiKhoan(2);
        require_once './views/taikhoan/khachhang/listKhachHang.php';
    }
    public function formEditKhachHang()
    {
        $id_khach_hang = $_GET['id_khach_hang'] ?? '';
        $listKhachHang = $this->moldedTaiKhoan->getTaiKhoanQuanTriById($id_khach_hang);
        // var_dump($listKhachHang);die();

        require_once './views/taikhoan/khachhang/editKhachHang.php';
        deleteSessionError();
    }
    public function postEditKhachHang()
    {
        // var_dump($_POST);
        //kiểm tra thêm dữ liệu có phải được submit ko
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //lấy dữ liệu
            //lấy  ra dữ liệu tu form
            $khach_hang_id = $_POST['khach_hang_id'] ?? '';
            //truy vấn

            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';

            $error = [];
            if (empty($ho_ten)) {
                $error['$ho_ten'] = "Tên không được để trống";
            }
            if (empty($email)) {
                $error['email'] = "Email không được để trống";
            }
            if (empty($ngay_sinh)) {
                $error['ngay_sinh'] = "Ngày sinh không được để trống";
            }
            if (empty($gioi_tinh)) {
                $error['gioi_tinh'] = "Giới tính không được để trống";
            }
            // if (empty($dia_chi)) {
            //     $error['dia_chi'] = "Địa chi không được để trống";
            // }

            if (empty($trang_thai)) {
                $error['trang_thai'] = "Trạng thái phải chọn";
            }


            $_SESSION['error'] = $error;

            //nếu không có lỗi tiến hành thêm danh mục
            if (empty($error)) {
                $s = $this->moldedTaiKhoan->updateKhachHang(
                    $khach_hang_id,
                    $ho_ten,
                    $email,
                    $so_dien_thoai,
                    $ngay_sinh,
                    $gioi_tinh,
                    $dia_chi,
                    $trang_thai
                );
                //xưu lý abum
                // var_dump($so_dien_thoai);die();
                header('location: ' . BASE_URL_ADMIN . '?act=list_tai_khoan_khach_hang');
                exit();
                // exit();
            } else {

                // $listDanhMuc = $this->moldedDanhMuc->getAllDanhMuc();
                // require_once './views/SanPham/addSanPham.php';
                // đặt chi thi xóa session sau khi hiên thị
                $_SESSION['flash'] = true;
                header('location: ' . BASE_URL_ADMIN . '?act=form_sua_khach_hang&id_khach_hang=' . $khach_hang_id);
                exit();
            }
        }
    }
    public function chiTietKhachHang()
    {
        $id_khach_hang = $_GET['id_khach_hang'];
        $listKhachHang = $this->moldedTaiKhoan->getTaiKhoanQuanTriById($id_khach_hang);
        // var_dump($listKhachHang);die();
        $listDonHang = $this->moldedDonHang->getDonHangFromKhachHang($id_khach_hang);
        $listBinhLuan = $this->moldedSanPham->getBinhLuanByIdKhachHang($id_khach_hang);
        // var_dump($listBinhLuan);die();


        require_once './views/taikhoan/khachhang/chiTietKhachHang.php';
    }
    public function getTaiKhoanByIdFormLayout()
    {
        $emailTaikhoan = $_SESSION['user_admin'];
        $listTaiKhoan = $this->moldedTaiKhoan->getTaiKhoanFormEmail($emailTaikhoan);
        return $listTaiKhoan;
    }

    public function formEditCaNhanQuanTri()
    {
        $email = $_SESSION['user_admin'];
        $thongTin = $this->moldedTaiKhoan->getTaiKhoanformemail($email);
        // var_dump($thongTin);die();

        require_once './views/taikhoan/canhan/EditCaNhan.php';
        deleteSessionError();
    }
    public function postEditMatKhauCaNhan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $old_pass = $_POST['old_pass'];
            $new_pass = $_POST['new_pass'];
            $confirm_pass = $_POST['confirm_pass'];




            $user = $this->moldedTaiKhoan->getTaiKhoanformemail($_SESSION['user_admin']);
            //  var_dump($user);die;
            $checkPass = password_verify($old_pass, $user['mat_khau']);

            $errors = [];

            if (!$checkPass) {
                $errors['old_pass'] = "Mật khẩu người dùng không đúng";
            }
            if ($new_pass !== $confirm_pass) {
                $errors['confirm_pass'] = "Mật khẩu nhập lại không đúng";
            }
            if (empty($old_pass)) {
                $errors['old_pass'] = "Vui lòng điền trường dữ liệu này ";
            }
            if (empty($new_pass)) {
                $errors['new_pass'] = "Vui lòng điền trường dữ liệu này ";
            }
            if (empty($confirm_pass)) {
                $errors['confirm_pass'] = "Vui lòng điền trường dữ liệu này ";
            }

            $_SESSION['error'] = $errors;

            if (!$errors) {
                $hashPass = password_hash($new_pass, PASSWORD_BCRYPT);
                $status = $this->moldedTaiKhoan->resetPassword($user['id'], $hashPass);
                if ($status) {
                    $_SESSION['success'] = "Đã đổi mật khẩu thành công";
                    $_SESSION['flash'] = true;
                    header('location: ' . BASE_URL_ADMIN . '?act=form_sua_thong_tin_ca_nhan_quan_tri');
                }
            } else {

                // var_dump($_SESSION['error']);die();
                $_SESSION['flash'] = true;
                header('location: ' . BASE_URL_ADMIN . '?act=form_sua_thong_tin_ca_nhan_quan_tri');
                exit();
            }
        }
    }
    public function postEditCaNhanQuanTri()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // var_dump($_POST); die();
            $ca_nhan_id = $_POST['ca_nhan_id'] ?? '';
            // var_dump($ca_nhan_id); die();
            




            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
            // $hinh_anh = $_FILES['hinh_anh']  ?? null;


            $errors = [];

            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Tên người dùng không được để trống ';
            }
            if (empty($email)) {
                $errors['email'] = 'Email người dùng không được để trống ';
            }

            if (empty($ngay_sinh)) {
                $errors['ngay_sinh'] = 'Ngày sinh người dùng không được để trống ';
            }

            if (empty($gioi_tinh)) {
                $errors['gioi_tinh'] = 'Giới tính người dùng không được để trống ';
            }

            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Vui lòng chọn trạng thái';
            }

            $_SESSION['error'] = $errors;
            // var_dump($error); die();



            if (empty($errors)) {
                $p =  $this->moldedTaiKhoan->updateCaNhan(
                    $ca_nhan_id,
                    $ho_ten,
                    $email,
                    $so_dien_thoai,
                    $ngay_sinh,
                    $gioi_tinh,
                    $dia_chi,
                    $trang_thai

                );
                // var_dump($p);die();
                header("Location: " . BASE_URL_ADMIN . '?act=form_sua_thong_tin_ca_nhan_quan_tri');
                exit();
            } else {
                $_SESSION['flash'] = true;

                header("Location: " . BASE_URL_ADMIN . '?act=form_sua_thong_tin_ca_nhan_quan_tri=' . $ca_nhan_id);
                exit();
            }
        }
    }
}
