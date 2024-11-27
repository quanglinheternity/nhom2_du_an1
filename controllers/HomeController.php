<?php 

class HomeController
{
    public $moldedSanPham;
    public $moldedTaiKhoan;


    public function __construct() {
       $this->moldedSanPham = new sanPham();

       $this->moldedTaiKhoan = new taiKhoan();

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
}