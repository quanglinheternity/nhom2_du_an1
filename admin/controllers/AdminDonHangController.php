<?php
class AdminDonHangController
{
    public $moldedDonHang;

    public function __construct()
    {
        $this->moldedDonHang = new AdminDonHang();
    }

    public function danhSachDonHang()
    {
        $listDonHang = $this->moldedDonHang->getAllDonHang();
        require_once './views/donhang/listDonHang.php';
    }
    public function chiTietDonHangId(){
        $don_hang_id=$_GET['id_don_hang'];
        $donHang=$this->moldedDonHang->getChiTietDonHangId($don_hang_id);
        //lấy danh sách sảm phẩm
        $sanPhamDonHang=$this->moldedDonHang->getlistSanPhamDonHang($don_hang_id);
        $listTrangThai = $this->moldedDonHang->getAllTrangThaiDonHang();
        // var_dump($donHang);die();
        require_once './views/donhang/detailDonHang.php';
    }

    public function formEditDonHang()
    {
        $id = $_GET['id_don_hang'];
        $donHang = $this->moldedDonHang->getChiTietDonHangId($id);
        // var_dump($SanPham);die();
        $listTrangThaiDonHang = $this->moldedDonHang->getAllTrangThaiDonHang();
        // var_dump($listAnhSanPham);die();
        if ($donHang) {
            require_once './views/donhang/editDonHang.php';
            deleteSessionError();
        } else {
            header('location: ' . BASE_URL_ADMIN . '?act=don_hang');
            exit();
        }
    }
    public function postEditDonHang()
    {
        // var_dump($_POST); die();
        //kiểm tra thêm dữ liệu có phải được submit ko
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //lấy dữ liệu
            //lấy  ra dữ liệu tu form
            $don_hang_id = $_POST['don_hang_id'] ?? '';
            //truy vấn
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'] ?? '';
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'] ?? '';
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'] ?? '';
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'] ?? '';
            $ghi_chu = $_POST['ghi_chu'] ??'';
            // var_dump($ghi_chu);die();
            //xu ly lỗi
            $error = [];
            if (empty($ten_nguoi_nhan)) {
                $error['ten_nguoi_nhan'] = "Tên người nhận không được để trống";
            }
            if (empty($sdt_nguoi_nhan)) {
                $error['sdt_nguoi_nhan'] = "Sdt người nhận không được để trống";
            }
            if (empty($email_nguoi_nhan)) {
                $error['email_nguoi_nhan'] = "Email người nhận không được để trống";
            }
            if (empty($dia_chi_nguoi_nhan)) {
                $error['dia_chi_nguoi_nhan'] = "Địa chỉ người nhận không được để trống";
            }
           

            $_SESSION['error'] = $error;
        //    var_dump($error); die();
            if (empty($error)) {
                 $this->moldedDonHang->updateDonHang(
                    $don_hang_id,
                    $ten_nguoi_nhan,
                    $sdt_nguoi_nhan,
                    $email_nguoi_nhan,
                    $dia_chi_nguoi_nhan,
                    $ghi_chu,
                );

                header('location: ' . BASE_URL_ADMIN . '?act=don_hang');

                // exit();
            } else {
                $_SESSION['flash'] = true;
                header('location: ' . BASE_URL_ADMIN . '?act=form_sua_don_hang&id_don_hang=' . $don_hang_id);
                exit();

            }
        }
    }
    public function huyDonHangId(){
        // var_dump($_GET['id_don_hang']);
        $don_hang_id = $_GET['id_don_hang'];
        $trang_thai_id = 9;
        
        $this->moldedDonHang->updateHuyDonHang($don_hang_id,$trang_thai_id);
        header('location: ' . BASE_URL_ADMIN . '?act=don_hang');

    }
    
    public function capNhatDonHangId(){
        // var_dump($_GET['id_don_hang']);
        $don_hang_id = $_GET['id_don_hang'];
        $donHang=$this->moldedDonHang->getChiTietDonHangId($don_hang_id);
        $trang_thai_id=$donHang['trang_thai_id'];
        if( $trang_thai_id >=1 && $trang_thai_id < 7){
        $trang_thai_id += 1 ;
        }
        $this->moldedDonHang->updateHuyDonHang($don_hang_id,$trang_thai_id);
        header('location: ' . BASE_URL_ADMIN . '?act=chi_tiet_don_hang&id_don_hang=' . $don_hang_id);

    }
    


}
?>