<?php 

class HomeController
{
    public $moldedSanPham;

    public function __construct() {
       $this->moldedSanPham = new sanPham();
    }

    public function home() {
       $listSanPham = $this->moldedSanPham->getAllSanPham();
        $listThuongHieu = $this->moldedSanPham->getAllThuongHieu();
        $listBinhLuan = $this->moldedSanPham->getAllBinhLuanFormKhachHang();
        require_once './views/home.php';
    }
    public function chiTietSanPham() {
        $id = $_GET['id_san_pham'];
        $sanPham = $this->moldedSanPham->getSanPhamById($id);
        $listBinhLuan = $this->moldedSanPham->getBinhLuanByFormSanPham($id);
        $sizeSanPham = $this->moldedSanPham->getSizeSanPham();
        // var_dump($sizeSanPham);die();
        $listAnhSanPham = $this->moldedSanPham->getlistAnhSanPhamById($id);
        $listSanPhamCungThuongHieu=$this->moldedSanPham->getListSanPhamThuongHieu($sanPham['thuong_hieu_id']);
        
        // var_dump($listSanPhamCungThuongHieu);die();
        if ($sanPham) {
            require_once './views/detailSanPham.php';
            
        } else {
            header('location: ' . BASE_URL);
            exit();
        }
    }
}