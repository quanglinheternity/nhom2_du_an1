<?php 
session_start();

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/DashboardController.php';
require_once './controllers/AdminThuongHieuController.php';
require_once './controllers/AdminsanPhamController.php';




// Require toàn bộ file Models
require_once './models/AdminThuongHieu.php';
require_once './models/AdminSanPham.php';



// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match
// Các Thầy.Cô có thể dùng Switch-Case
match ($act) {
    // Trang chủ
    '/' => (new DashboardController)->dashboard(),
    'thuong_hieu'=>(new AdminThuongHieuController())->danhSachThuongHieu(),
    'form_them_thuong_hieu'=>(new AdminThuongHieuController())->formAddThuongHieu(),
    'them_thuong_hieu'=>(new AdminThuongHieuController())->postAddThuongHieu(),
    'form_sua_thuong_hieu'=>(new AdminThuongHieuController())->formEditThuongHieu(),
    'sua_thuong_hieu'=>(new AdminThuongHieuController())->postEditThuongHieu(),
    'xoa_thuong_hieu'=>(new AdminThuongHieuController())->deleteThuongHieu(),
     


    //san pham 
    'san_pham'=>(new AdminSanPhamController())->danhSachSanPham(),
    'form_them_san_pham'=>(new AdminSanPhamController())->formAddSanPham(),
    'them_san_pham'=>(new AdminSanPhamController())->postAddSanPham(),
    'form_sua_san_pham'=>(new AdminSanPhamController())->formEditSanPham(),
    'sua_san_pham'=>(new AdminSanPhamController())->postEditSanPham(),
    'xoa_san_pham'=>(new AdminSanPhamController())->deleteSanPham(),
    'chi_tiet_san_pham'=>(new AdminSanPhamController())->detailSanPham()
 
};