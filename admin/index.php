<?php
session_start();

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/DashboardController.php';
require_once './controllers/AdminThuongHieuController.php';

require_once './controllers/AdminsanPhamController.php';


require_once './controllers/AdminTaiKhoanController.php';
require_once './controllers/AdminDonHangController.php';




// Require toàn bộ file Models
require_once './models/AdminThuongHieu.php';

require_once './models/AdminSanPham.php';


require_once './models/AdminTaiKhoan.php';
require_once './models/AdminDonHang.php';



// Route
$act = $_GET['act'] ?? '/';
// if(!isset($_SESSION['error']))
// if($act !== 'login_admin' && $act !== 'logout_admin' && $act !== 'check_login_admin' && !isset($_SESSION['error'])) checkLoginAdmin();

// Danh sách các hành động không cần kiểm tra đăng nhập
$allowedActions = ['login_admin', 'logout_admin', 'check_login_admin'];

if (!in_array($act, $allowedActions) && empty($_SESSION['error'])) {
    checkLoginAdmin();
}


// if($act !== 'login_admin'&& $act !== 'logout_admin' && $act !== 'check_login_admin') checkLoginAdmin();
// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match
// Các Thầy.Cô có thể dùng Switch-Case
match ($act) {
    // Trang chủ
    '/' => (new DashboardController)->dashboard(),
    'thuong_hieu' => (new AdminThuongHieuController())->danhSachThuongHieu(),
    'form_them_thuong_hieu' => (new AdminThuongHieuController())->formAddThuongHieu(),
    'them_thuong_hieu' => (new AdminThuongHieuController())->postAddThuongHieu(),
    'form_sua_thuong_hieu' => (new AdminThuongHieuController())->formEditThuongHieu(),
    'sua_thuong_hieu' => (new AdminThuongHieuController())->postEditThuongHieu(),
    'xoa_thuong_hieu' => (new AdminThuongHieuController())->deleteThuongHieu(),
    // tài khoản quản trị
    'list_tai_khoan_quan_tri'=>(new AdminTaiKhoanController())->listTaiKhoanQuanTri(),
    'form_them_quan_tri'=>(new AdminTaiKhoanController())->formAddTaiKhoanQuanTri(),
    'them_quan_tri'=>(new AdminTaiKhoanController())->postAddTaiKhoanQuanTri(),
    'form_sua_quan_tri'=>(new AdminTaiKhoanController())->formEditTaiKhoanQuanTri(),
    'sua_quan_tri'=>(new AdminTaiKhoanController())->postEditTaiKhoanQuanTri(),
    'reset_password'=>(new AdminTaiKhoanController())->resetPassword(),
    
    
 // don hang
    'don_hang'=>(new AdminDonHangController())->danhSachDonHang(),
    'form_sua_don_hang'=>(new AdminDonHangController())->formEditDonHang(),
    'sua_don_hang'=>(new AdminDonHangController())->postEditDonHang(),
    'chi_tiet_don_hang'=>(new AdminDonHangController())->chiTietDonHangId(),
    'huy_don_hang'=>(new AdminDonHangController())->huyDonHangId(),
    'cap_nhat_don_hang'=>(new AdminDonHangController())->capNhatDonHangId(),
    'list_tai_khoan_quan_tri' => (new AdminTaiKhoanController())->listTaiKhoanQuanTri(),
    'form_them_quan_tri' => (new AdminTaiKhoanController())->formAddTaiKhoanQuanTri(),
    'them_quan_tri' => (new AdminTaiKhoanController())->postAddTaiKhoanQuanTri(),
    'form_sua_quan_tri' => (new AdminTaiKhoanController())->formEditTaiKhoanQuanTri(),
    'sua_quan_tri' => (new AdminTaiKhoanController())->postEditTaiKhoanQuanTri(),
    'reset_password' => (new AdminTaiKhoanController())->resetPassword(),

    //route auth
    'login_admin'=>(new AdminTaiKhoanController())->formLogin(),
    'check_login_admin'=>(new AdminTaiKhoanController())->login(),
    'logout_admin'=>(new AdminTaiKhoanController())->logOut(),
    'login_admin' => (new AdminTaiKhoanController())->formLogin(),
    'check_login_admin' => (new AdminTaiKhoanController())->login(),
    'logout_admin' => (new AdminTaiKhoanController())->logOut(),


    //san pham 
    'san_pham' => (new AdminSanPhamController())->danhSachSanPham(),
    'form_them_san_pham' => (new AdminSanPhamController())->formAddSanPham(),
    'them_san_pham' => (new AdminSanPhamController())->postAddSanPham(),
    'form_sua_san_pham' => (new AdminSanPhamController())->formEditSanPham(),
    'sua_san_pham' => (new AdminSanPhamController())->postEditSanPham(),
    'xoa_san_pham' => (new AdminSanPhamController())->deleteSanPham(),
    'sua_album_anh_san_pham' => (new AdminSanPhamController())->postEditAnhSanPham(),
    'chi_tiet_san_pham' => (new AdminSanPhamController())->detailSanPham(),

    //binh luan
    'update_trang_thai_binh_luan' => (new AdminSanPhamController())->updateTrangThaiBinhLuan(),
    
};
