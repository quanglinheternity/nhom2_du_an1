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
      // var_dump($maGiam); die();
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
}
