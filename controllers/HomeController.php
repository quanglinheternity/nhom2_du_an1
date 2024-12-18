<?php

class HomeController
{
  public $moldedSanPham;
  public $moldedTaiKhoan;
  public $moldedGioHang;
  public $moldedDonHang;
  public $authController;

  public function __construct()
  {
    $this->moldedSanPham = new sanPham();

    $this->moldedTaiKhoan = new taiKhoan();
    $this->moldedGioHang = new GioHang();
    $this->moldedDonHang = new donHang();
    $this->authController = new AuthController();
  }

  public function home()
  {
    $listSanPham = $this->moldedSanPham->getAllSanPham();
    // $listThuongHieu = $this->moldedSanPham->getAllThuongHieu();
    $listBinhLuan = $this->moldedSanPham->getAllBinhLuanFormKhachHang();
    require_once './views/home.php';
  }
  public function chiTietSanPham()
  {
    $id = $_GET['id_san_pham'];
    // $listThuongHieu = $this->moldedSanPham->getAllThuongHieu();
    $sanPham = $this->moldedSanPham->getSanPhamById($id);
    $listBinhLuan = $this->moldedSanPham->getBinhLuanByFormSanPham($id);
    $sizeSanPham = $this->moldedSanPham->getSizeSanPham();
    // var_dump($sizeSanPham);die();
    $listAnhSanPham = $this->moldedSanPham->getlistAnhSanPhamById($id);
    $listSanPhamCungThuongHieu = $this->moldedSanPham->getListSanPhamThuongHieu($sanPham['thuong_hieu_id']);
    // var_dump($listSanPhamCungThuongHieu);die();
    if ($sanPham) {
      require_once './views/detailSanPham.php';
    } else {
      header('location: ' . BASE_URL);
      exit();
    }
  }
  public function formLoginClient()
  {
    require_once './views/auth/formLogin.php';
    deleteSessionError();
  }
  public function checkLoginClient()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = $_POST['email'];
      $password = $_POST['password'];
      //xử lý đăng nhận kiểm tra
      $user = $this->moldedTaiKhoan->checkLogin($email, $password);
      // var_dump($user);die();

      if ($user == $email) {
        $_SESSION['user_client'] = $user;
        header('location: ' . BASE_URL);
        exit();
      } else {
        $_SESSION['error'] = $user;
        // var_dump($_SESSION['error']);die();
        $_SESSION['flash'] = true;
        header('location: ' . BASE_URL . '?act=login_client');
        exit();
      }
    }
  }
  public function logout()
  {
    if (isset($_SESSION['user_client'])) {
      unset($_SESSION['user_client']);
      unset($_SESSION['error']);
        session_unset();
        session_destroy();

    }
    header('location: ' . BASE_URL);
    exit();
  }
  public function addGioHang()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_SESSION['user_client'])) {
        $mail = $this->moldedTaiKhoan->getTaiKhoanFormEmail($_SESSION['user_client']);
        //   var_dump($mail['id']);
        $gioHang = $this->moldedGioHang->getGioHangFormId($mail['id']);
        //   var_dump($gioHang);die();
        if (!$gioHang) {
          $gioHangId = $this->moldedGioHang->addGioHang($mail['id']);
          $gioHang = ['id' => $gioHangId];
          $chiTietGioHang = $this->moldedGioHang->getDetailGioHang($gioHang['id']);
        } else {
          $chiTietGioHang = $this->moldedGioHang->getDetailGioHang($gioHang['id']);
        }

        $san_pham_id = $_POST['san_pham_id'];
        $so_luong = $_POST['so_luong'];
        // var_dump($so_luong); die();   

        $checkSanPham = false;
        foreach ($chiTietGioHang as $chiTiet) {
          if ($chiTiet['san_pham_id'] == $san_pham_id) {
            // var_dump($chiTiet['san_pham_id']);
            // var_dump($san_pham_id);
            // // die();
            $newSoLuong = $chiTiet['so_luong'] + $so_luong;
            // var_dump($chiTiet['so_luong']); die();   
            $this->moldedGioHang->updateSoLuongGioHang($gioHang['id'], $san_pham_id, $newSoLuong);
            $checkSanPham = true;
            break;
          }
        }

        if (!$checkSanPham) {
          //   var_dump(!$checkSanPham); die();
          $this->moldedGioHang->addChiTietGioHang($gioHang['id'], $san_pham_id, $so_luong);
        }
        //   var_dump('them thanh cong');die();
        header('location:' . BASE_URL . '?act=gio_hang');
      } else {
        header('location: ' . BASE_URL . '?act=login_client');
        exit();
      }
    }
  }
  public function gioHang()
  {
    if (isset($_SESSION['user_client'])) {
      $mail = $this->moldedTaiKhoan->getTaiKhoanFormEmail($_SESSION['user_client']);
      //   var_dump($mail['id']);
      $gioHang = $this->moldedGioHang->getGioHangFormId($mail['id']);
      $maGiam = null;
      if (isset($_POST['ma'])) {
        $maGiam = (new HomeController())->getMaGiamGia();
        // var_dump($maGiam);die();
      }

      if (!$gioHang) {
        $gioHangId = $this->moldedGioHang->addGioHang($mail['id']);
        $gioHang = ['id' => $gioHangId];
        //  var_dump(value: $maGiamGia);die();
        $chiTietGioHang = $this->moldedGioHang->getDetailGioHang($gioHang['id']);
      } else {
        $chiTietGioHang = $this->moldedGioHang->getDetailGioHang($gioHang['id']);
      }
      // var_dump($chiTietGioHang); die();
      require_once './views/gioHang.php';
    } else {
      header('location:' . BASE_URL . '?act=login_client');
      exit();
    }
  }
  public function thanhToan()
  {
    if (isset($_SESSION['user_client'])) {
      $giaGiam = $_GET['ma_id'] ?? 0;
      // if(isset($ma)){
      //   $MaGiam=$this->moldedSanPham->getMaGiamGiaByMa($ma);

      // }
      $user = $this->moldedTaiKhoan->getTaiKhoanFormEmail($_SESSION['user_client']);
      //   var_dump($mail['id']);
      $gioHang = $this->moldedGioHang->getGioHangFormId($user['id']);
      //   var_dump($gioHang);die();
      if (!$gioHang) {
        $gioHangId = $this->moldedGioHang->addGioHang($user['id']);
        $gioHang = ['id' => $gioHangId];
        $chiTietGioHang = $this->moldedGioHang->getDetailGioHang($gioHang['id']);
      } else {
        $chiTietGioHang = $this->moldedGioHang->getDetailGioHang($gioHang['id']);
      }
      //   var_dump($chiTietGioHang); die();
      require_once './views/thanhToan.php';
    } else {
      header('location:' . BASE_URL . '?act=login_client');
      exit();
    }
  }
  public function postThanhToan()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // var_dump($_POST);
      $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
      $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
      $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
      $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
      $ghi_chu = $_POST['ghi_chu'];
      $tong_tien = $_POST['tong_thanh_toan'];
      $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'];
      $ngay_dat = date('Y-m-d ');
      // var_dump($ngay_dat);
      $trang_thai_id = 1;
      $user = $this->moldedTaiKhoan->getTaiKhoanFormEmail($_SESSION['user_client']);
      $tai_khoan_id = $user['id'];
      $randomBytes = bin2hex(random_bytes(4)); // Tạo chuỗi hex 8 ký tự
      $ma_don_hang = 'DH-' . strtoupper($randomBytes);
      $donHang = $this->moldedDonHang->addDonHang(
        $ten_nguoi_nhan,
        $sdt_nguoi_nhan,
        $dia_chi_nguoi_nhan,
        $email_nguoi_nhan,
        $ghi_chu,
        $tong_tien,
        $phuong_thuc_thanh_toan_id,
        $ngay_dat,
        $trang_thai_id,
        $tai_khoan_id,
        $ma_don_hang
      );
      // var_dump("thành cong");
      $gioHang = $this->moldedGioHang->getGioHangFormId($tai_khoan_id);
      //lưu sản phẩm vào chi tiết đơn hàng
      if ($donHang) {
        //lấy ra toàn bộ sản phẩm
        $chiTietGio = $this->moldedGioHang->getDetailGioHang($gioHang['id']);
        // thêm từ sản phẩm giỏ hàng vào bảng chi tiết
        foreach ($chiTietGio as $item) {
          $donGia = $item['gia_khuyen_mai'] ?? $item['gia_san_pham'];

          $this->moldedDonHang->addChiTietDonHang(
            $donHang,
            $item['san_pham_id'],
            $donGia,
            $item['so_luong'],
            $donGia * $item['so_luong']
          );
        }
        //sau khi them xong thì phải tiến hành xóa sản phẩm trong giỏ hàng
        //xóa toàn bộ sản phẩm trong chi tiết giở hàng
        $this->moldedGioHang->clearDetailGiongHang($gioHang['id']);
        //xóa thông tin giỏ hàng người dùng
        $this->moldedGioHang->clearGiongHang($tai_khoan_id);

        header('location:' . BASE_URL . '?act=lich_su_mua_hang');
      } else {
        var_dump('lỗi đặt hàng');
      }
    }
  }
  public function lichSuMuaHang()
  {
    if (isset($_SESSION['user_client'])) {
      $user = $this->moldedTaiKhoan->getTaiKhoanFormEmail($_SESSION['user_client']);
      $tai_khoan_id = $user['id'];
      //danh sách trạng thái đơn hang
      $arrTrangThaiDonHang = $this->moldedDonHang->getTrangThaiDonHang();
      $trangThaiDonHang = array_column($arrTrangThaiDonHang, 'ten_trang_thai', 'id');
      // echo "<pre>";
      // print_r($trangThaiDonHang);
      //danh sách trạng thái thanh toán
      $arrPhuongThucThanhToan = $this->moldedDonHang->getPhuongThucDonHang();
      $phuongThucThanhToan = array_column($arrPhuongThucThanhToan, 'ten_phuong_thuc', 'id');


      //danh sách tất cả của đơn hàng tài khoản
      $donHang = $this->moldedDonHang->getDonHangFormUser($tai_khoan_id);
      // echo'<pre>';
      // print_r($donHang);
      // die();
      require_once "./views/lichSuMuaHang.php";
    } else {
      header('location:' . BASE_URL . '?act=login_client');
      exit();
    }
  }
  public function huyDonHang()
  {
    if (isset($_SESSION['user_client'])) {

      $don_hang_id = $_GET['id_don_hang'];

      $this->moldedDonHang->updateHuyDonHang($don_hang_id, 9);
      header('location: ' . BASE_URL . '?act=lich_su_mua_hang');
      exit();
    } else {
      header('location:' . BASE_URL . '?act=login_client');
      exit();
    }
  }
  public function chiTietMuaHang()
  {
    // var_dump($_GET['id_don_hang']);
    if (isset($_SESSION['user_client'])) {
      $user = $this->moldedTaiKhoan->getTaiKhoanFormEmail($_SESSION['user_client']);
      $tai_khoan_id = $user['id'];
      $don_hang_id = $_GET['id_don_hang'];
      //danh sách trạng thái đơn hang
      $arrTrangThaiDonHang = $this->moldedDonHang->getTrangThaiDonHang();
      $trangThaiDonHang = array_column($arrTrangThaiDonHang, 'ten_trang_thai', 'id');
      // echo "<pre>";
      // print_r($trangThaiDonHang);
      //danh sách trạng thái thanh toán
      $arrPhuongThucThanhToan = $this->moldedDonHang->getPhuongThucDonHang();
      $phuongThucThanhToan = array_column($arrPhuongThucThanhToan, 'ten_phuong_thuc', 'id');
      // thông tin đơn hàng theo id
      $donHang = $this->moldedDonHang->getDonHangId($don_hang_id);

      //lấy thông tin bảng chi tiết đơn hàng
      $chiTietDonHang = $this->moldedDonHang->getChiTietDonHangId($don_hang_id);
      //   echo "<pre>";
      //  print_r($donHang);
      //  print_r($chiTietDonHang);
      // var_dump($donHang['tai_khoan_id']);
      // die();
      if ($donHang['tai_khoan_id'] != $tai_khoan_id) {
        echo "bạn ko có quyền truy cập đơn hàng";
        exit();
      }
      require_once "./views/chiTietMuaHang.php";
    } else {
      header('location:' . BASE_URL . '?act=login_client');
      exit();
    }
  }

  // Phương thức xử lý cập nhật giỏ hàng
  public function   updateCart()
  {
    // Lấy dữ liệu từ yêu cầu POST (gửi từ AJAX)
    $productId = $_POST['product_id'] ?? null; // ID của sản phẩm
    $quantity = $_POST['quantity'] ?? 0;       // Số lượng sản phẩm mới

    // Kiểm tra xem ID sản phẩm và số lượng có hợp lệ không
    if ($productId > 0 && $quantity >= 0) {
      // Giả sử giỏ hàng của người dùng được lưu trong một session hoặc cơ sở dữ liệu
      // Ví dụ: lấy giỏ hàng từ session
      // Kiểm tra giỏ hàng trong session


      // Nếu có cơ sở dữ liệu, bạn có thể cập nhật ở đây
      // Ví dụ: cập nhật số lượng sản phẩm trong bảng giỏ hàng của người dùng
      $s = $this->moldedGioHang->updateCartInDatabase($productId, $quantity);
      // var_dump($s);die();
      echo json_encode(['status' => 'success', 'message' => 'Giỏ hàng đã được cập nhật!']);
    } else {
      echo json_encode(['status' => 'error', 'message' => 'Dữ liệu không hợp lệ.']);
    }
  }

  public function deleteSp()
  {
    $productId = $_POST['product_id'] ?? null; // ID của sản phẩm
    $this->moldedGioHang->deleteSpInCart($productId);
  }
  public function getMaGiamGia()
  {
    $ma = $_POST['ma'];
    // var_dump($ma);
    $MaGiam = $this->moldedSanPham->getMaGiamGiaByMa($ma);
    // var_dump($MaGiam);die();
    // require_once "./views/detailSanPham.php";
    return $MaGiam;
    // require_once "./views/detailSanPham.php";
  }
  public function formRegister()
  {
    require_once 'views/auth/formRegister.php';
    deletesessionError();
  }
  public function postRegister()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $fullname = $_POST['ho_ten'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $confirmPassword = $_POST['confirm_password'];
      $errors = [];


      if (empty($fullname)) {
        $errors[] = 'Vui lòng nhập tên';
      }
      if (empty($email)) {
        $errors[] = 'Vui lòng nhập email.';
      }

      if ($password !== $confirmPassword) {
        $_SESSION['error'] = "Mật khẩu và xác nhận mật khẩu không khớp";
        $_SESSION['flash'] = true;
        header("Location: " . BASE_URL . '?act=register');
        exit();
      }
      $result = $this->authController->register($fullname, $email, $password);
      if ($result === "Đăng ký thành công") {
        $_SESSION['success'] = $result;
        header("Location: " . BASE_URL . '?act=login_client');
        exit();
      } else {
        $_SESSION['error'] = $result;
        $_SESSION['flash'] = true;
        header("Location: " . BASE_URL . '?act=register');
      }
    }
  }
  public function themBinhLuan(){
    // var_dump($_POST);
    if (isset($_SESSION['user_client'])) {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $san_pham_id = $_POST['san_pham_id'];
        $noi_dung = $_POST['binh_luan'];
        $user = $this->moldedTaiKhoan->getTaiKhoanFormEmail($_SESSION['user_client']);
        $tai_khoan_id = $user['id'];
        $ngay_dang = date('Y-m-d H:i:s');

        $s=$this->moldedSanPham->themBinhLuan($san_pham_id, $noi_dung, $tai_khoan_id, $ngay_dang);
        // var_dump($s);die();
        Header('Location:' . BASE_URL . '?act=chi_tiet_san_pham&id_san_pham=' . $san_pham_id);
        exit();
      }
    } else {
      header('location:' . BASE_URL . '?act=login_client');
      exit();
    }
  }
  public function quenMatKhau()
    {

        require_once './views/quenMatKhau.php';
        deleteSessionError();
        deleteSessionLayMK();
    }
    public function layMatKhau()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dl

            $email = $_POST['email'] ?? '';

            $checkEmail = $this->moldedTaiKhoan->checkEmail($email);
            // var_dump($checkEmail);die();
            $tai_khoan_id=$checkEmail['id'];
            $password = password_hash('Qlinh371', PASSWORD_BCRYPT);
            $sataus = (new AdminTaiKhoan)->resetPassword($tai_khoan_id, $password);
            
            // var_dump($checkEmail['mat_khau']);die();

            if (is_array($checkEmail)) {
                //     $_SESSION['user_id'] = $checkUser[0]['id'];
                $_SESSION['layMk'] = 'Mật khẩu của bạn là: Qlinh371 ' ;

                header('Location:' . BASE_URL . '?act=quen_mat_khau');
            } else {
                $_SESSION['flash'] = true;
                $_SESSION['layMk'] = 'Email không tồn tại';

                header('Location:' . BASE_URL . '?act=quen_mat_khau');
            }
        }
    }

    public function sanPhamThuongHieu()
    {
      $ThuongHieuId=$_GET['thuong_hieu_id'];
      
      $listSanPhamCungThuongHieu = $this->moldedSanPham->getListSanPhamThuongHieu($ThuongHieuId );
      // var_dump($listSanPhamCungThuongHieu);die();
      if ($listSanPhamCungThuongHieu) {
        require_once './views/viewSanPham.php';
      } else {
        header('location: ' . BASE_URL);
        exit();
      }
    }
    public function timKiem()
    {
        $listDanhMuc = $this->moldedSanPham->getAllThuongHieu();


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $keyword = $_POST['tim_kiem'] ?? '';

            $listSanPhamTimKiem = $this->moldedSanPham->search($keyword);
            require_once './views/timKiemSp.php';


            // var_dump($timsp);die();
        }
    }
    public function suaTaiKhoan()
    {
      if (isset($_SESSION['user_client'])) {
      $thongTin = $this->moldedTaiKhoan->getTaiKhoanFormEmail($_SESSION['user_client']);
    
        // var_dump($thongTin);die();

        require_once './views/suaThongTinTaiKhoan.php';
        deleteSessionError();
        deleteSessionErrorTt();
        deleteSessionsuccessMK();
        deleteSessionsuccessAnh();


    } else {
      header('location:' . BASE_URL . '?act=login_client');
      exit();
    }
    }
    public function suaThongTinCaNhan()
    {
        // xử lý form nhập
        //var_dump($_POST);

        // Kiểm tra xem dữ dữ liệu có phải đc submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dl
            // Lấy ra dữ liệu của sản phẩm
            $tai_khoan_id = $_POST['tai_khoan_id'];
            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';


            $_SESSION['ho_ten'] = $ho_ten ?? '';
            $_SESSION['email'] = $email ?? '';




            // Tạo 1 mảng trống để chứa dl
            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Họ tên không được để trống';
            }
            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = 'Số điện thoại không được để trống';
            }
            if (empty($dia_chi)) {
                $errors['dia_chi'] = 'Địa chỉ không được để trống';
            }
            if (empty($email)) {
                $errors['email'] = 'Email không được để trống';
            }

            $_SESSION['errors'] = $errors;


            // Nếu k có lỗi thì thêm sản phẩm
            if (empty($errors)) {
                $status = $this->moldedTaiKhoan->updateTaiKhoan($tai_khoan_id, $ho_ten, $email, $so_dien_thoai, $dia_chi);

                if ($status) {
                    $_SESSION['successTt'] = "Đã đổi thông tin thành công";
                    $_SESSION['flash'] = true;
                }
                header("Location: " . BASE_URL . '?act=quan_ly_tai_khoan');
                exit();
            } else {
                // trả lỗi
                // Đặt chỉ thị xóa session sau khi hiển thị form
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL . '?act=quan_ly_tai_khoan');
                exit();
            }
        }
    }
    public function suaMatKhau()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $old_pass = $_POST['old_pass'];
            $new_pass = $_POST['new_pass'];
            $confirm_pass = $_POST['confirm_pass']; 
            $user = $this->moldedTaiKhoan->getTaiKhoanFormEmail($_SESSION['user_client']);

            //  var_dump($user['mat_khau']);
            //  var_dump($old_pass);
            $errors = [];
            $checkPass = password_verify($old_pass, $user['mat_khau']);
            if (!$checkPass) {
                $errors['old_pass'] = 'Mật đúng cũ không đúng';
            }
            if ($new_pass !== $confirm_pass) {
                $errors['confirm_pass'] = 'Mật khẩu nhập lại không đúng';
            }
            

            if (empty($old_pass)) {
                $errors['old_pass'] = 'Mật khẩu cũ không được để trống';
            }

            if (empty($new_pass)) {
                $errors['new_pass'] = 'Mật khẩu mới không được để trống';
            }

            if (empty($confirm_pass)) {
                $errors['confirm_pass'] = 'Mật khẩu nhập lại không được để trống';
            }
            $_SESSION['errors'] = $errors;
            if (!$errors) {
                $hashPass = password_hash($new_pass, PASSWORD_BCRYPT);
                $status = $this->moldedTaiKhoan->updateMatKhau($user['id'], $hashPass);
                // var_dump($status);die();
                if ($status) {
                    $_SESSION['successMk'] = "Đã đổi mật khẩu thành công";
                    $_SESSION['flash'] = true;

                    header("Location:" . BASE_URL . '?act=quan_ly_tai_khoan');
                }
            } else {
                // Lỗi thì lưu lỗi vào session
                //    $_SESSION['errors'] = $user;
                //    var_dump($_SESSION['errors']);die();

                $_SESSION['flash'] = true;

                header("Location:" . BASE_URL . '?act=quan_ly_tai_khoan');
                exit();
            }
        }
    }
    public function suaAnhTaiKhoan()
    {
        // xử lý form nhập
        //var_dump($_POST);

        // Kiểm tra xem dữ dữ liệu có phải đc submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dl
            // Lấy ra dữ liệu của sản phẩm
            $tai_khoan_id = $_POST['tai_khoan_id'];


            $thongTinCu = $this->moldedTaiKhoan->thongTinTaiKhoan($tai_khoan_id);
            // var_dump($thongTinCu);die();
            $anh_cu = $thongTinCu['anh_dai_dien'];
            // var_dump($anh_cu);die();

            $anh_dai_dien = $_FILES['anh_dai_dien'] ?? null;



            // Logic sửa ảnh
            if (isset($anh_dai_dien)) {
                // upload file ảnh mới lên
                $new_file = uploadFile($anh_dai_dien, './uploads/');
                if (!empty($old_file)) { // Nếu có ảnh cũ thì xóa đi
                    deleteFile($old_file);
                }
            } else {
                $new_file = $anh_cu;
            }

            // Nếu k có lỗi thì thêm anh
            if (empty($errors)) {
                $status = $this->moldedTaiKhoan->updateAnhDaiDien($tai_khoan_id, $new_file);
                // var_dump($status);die();

                if ($status) {
                    $_SESSION['successAnh'] = "Đã đổi thông tin thành công";
                    $_SESSION['flash'] = true;
                }
                header("Location:" . BASE_URL . '?act=quan_ly_tai_khoan');

                exit();
            } else {
                // trả lỗi
                // Đặt chỉ thị xóa session sau khi hiển thị form
                $_SESSION['flash'] = true;
                header("Location:" . BASE_URL . '?act=quan_ly_tai_khoan');

                exit();
            }
        }
    }
}
