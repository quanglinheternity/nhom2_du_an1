<?php
function debug($data)
{
    echo "<pre>";

    print_r($data);

    die;
}

// Kết nối CSDL qua PDO
function connectDB() {
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}
//thêm file
function uploadFile($file, $folderUpload) {
    $pathStorage=$folderUpload . time() . $file['name'];
    $form=$file['tmp_name'];
    $to = PATH_ROOT . $pathStorage;
    if(move_uploaded_file($form, $to)) {
        return $pathStorage;
    }
    
}
//sửa file
//xóa file
function deleteFile($file) {
    $pathDelete = PATH_ROOT . $file;
    if(file_exists($pathDelete)) {
        unlink($pathDelete);
    }  
}
// xóa session sau load trang
// function deleteSessionError() {
//     if(isset($_SESSION['flash'])) {
//         unset($_SESSION['flash']);
//         session_unset();
//         // session_destroy();
//     } 
//     }
function deleteSessionError() {
    // Ensure session is started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check if the flash message is set and then unset it
    if (isset($_SESSION['flash'])) {
        unset($_SESSION['flash']);
        session_unset();
    }

    // Unset all session variables
   
    
    // Destroy the session
    // session_destroy();
}

// Upload - updeatealbum ảnh
function uploadFileAlbum($file, $folderUpload, $key) {
    $pathStorage=$folderUpload . time() . $file['name'][$key];
    $form=$file['tmp_name'][$key];
    $to = PATH_ROOT . $pathStorage;
    if(move_uploaded_file($form, $to)) {
        return $pathStorage;
    }
    
}
// fomat date
function formatDate($date) {
    return date('d/m/Y', strtotime($date));
}
function checkLoginAdmin(){
    if(!isset($_SESSION['user_admin'])) {
        //không có session thi chuyển huỳ trang login
        header('location: ' . BASE_URL_ADMIN . '?act=login_admin');
        exit();
    }
}


//format price
function formatPrice($price) {
    return number_format($price, 0, ',', '.');
}
//màu
function getStatusClass($trang_thai_id) {
    switch ($trang_thai_id) {
        case 1:
            return 'danger'; // Đỏ
        case 2:
            return 'success'; // Xanh lá
        case 3:
            return 'warning'; // Vàng
        case 4:
            return 'primary'; // Xanh dương
        case 5:
            return 'info'; // Xanh nhạt
        case 6:
            return 'secondary'; // Xám
        case 7:
            return 'success'; // Xanh lá
        case 8:
            return 'secondary'; // Xám đậm
        case 9:
            return 'danger'; // Đỏ
        default:
            return 'dark'; // Mặc định
    }
}
function getStatusClassSau($trang_thai_id) {
    $trang_thai_id = $trang_thai_id + 1;
    switch ($trang_thai_id) {
        case 1:
            return 'danger'; // Đỏ
        case 2:
            return 'success'; // Xanh lá
        case 3:
            return 'warning'; // Vàng
        case 4:
            return 'primary'; // Xanh dương
        case 5:
            return 'info'; // Xanh nhạt
        case 6:
            return 'secondary'; // Xám
        case 7:
            return 'success'; // Xanh lá
        case 8:
            return 'secondary'; // Xám đậm
        case 9:
            return 'danger'; // Đỏ
        default:
            return 'dark'; // Mặc định
    }
}
function listThuongHieu() {
    $listThuongHieu = (new sanPham())->getAllThuongHieu();
    // require_once './views/layout/menu.php';
    return $listThuongHieu;

}