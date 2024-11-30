<?php 
session_start();

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once "./controllers/HomeController.php";


// Require toàn bộ file Models
require_once "./models/SanPham.php";
require_once "./models/taiKhoan.php";
require_once "./models/GioHang.php";
require_once "./models/DonHang.php";

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match
match ($act) {
    // Trang chủ
    '/' => (new HomeController())->home(),
    'chi_tiet_san_pham'=> (new HomeController())->chiTietSanPham(),
    'them_gio_hang' => (new HomeController())->addGioHang(),
    'gio_hang' => (new HomeController())->gioHang(),
    'thanh_toan' => (new HomeController())->thanhToan(),
    'xu_ly_thanh_toan' => (new HomeController())->postThanhToan(),
    'lich_su_mua_hang' => (new HomeController())->lichSuMuaHang(),
    'chi_tiet_mua_hang' => (new HomeController())->chiTietMuaHang(),
    'huy_don_hang' => (new HomeController())->huyDonHang(),
    'login_client' => (new HomeController())->formLoginClient(),
    'check_login_client' => (new HomeController())->checkLoginClient(),
    'logout_client'=> (new HomeController())->logout(),
    'update_cart'=> (new HomeController())->updateCart(),
    'delete_cart'=> (new HomeController())->deleteSp(),
    default => throw new Exception("Unhandled match case '$act'"),
};