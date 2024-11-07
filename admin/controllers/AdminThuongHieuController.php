<?php
class AdminThuongHieuController
{
    public $moldedThuongHieu;

    public function __construct()
    {
        $this->moldedThuongHieu = new AdminThuongHieu();
    }

    public function danhSachThuongHieu()
    {
        $listThuongHieu = $this->moldedThuongHieu->getAllThuongHieu();
        require_once './views/ThuongHieu/listThuongHieu.php';
    }
    public function formAddThuongHieu()
    {
        require_once './views/ThuongHieu/addThuongHieu.php';
        deleteSessionError();
    }
    public function postAddThuongHieu()
    {
        // var_dump($_POST);
        //kiểm tra thêm dữ liệu có phải được submit ko
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //lấy dữ liệu
            $ten_thuong_hieu = $_POST['ten_thuong_hieu'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';
            // echo $ten_thuong_hieu;die();
            // xu ly upload file
            // $error = [] ;
            if (empty($ten_thuong_hieu)) {
                $error['ten_thuong_hieu'] = "Tên thương hiệu không được để trống";
            }
            $_SESSION['error'] = $error;
            // debug($_SESSION['error'])  ;die();
            //nếu không có lỗi tiến hành thêm danh mục
            if (empty($error)) {
                $this->moldedThuongHieu->insertThuongHieu($ten_thuong_hieu, $mo_ta);
                header('location: ' . BASE_URL_ADMIN . '?act=thuong_hieu');
            } else {

                // require_once './views/ThuongHieu/addThuongHieu.php';
                $_SESSION['flash'] = true;
                // debug($_SESSION['error']);                
                header('location: ' . BASE_URL_ADMIN . '?act=form_them_thuong_hieu');
                exit();
            }
        }
    }
    public function formEditThuongHieu()
    {
        $id = $_GET['id_thuong_hieu'];
        $thuongHieu = $this->moldedThuongHieu->getThuongHieuById($id);
        require_once './views/ThuongHieu/editThuongHieu.php';
    }
    public function postEditThuongHieu()
    {
        // var_dump($_POST);
        //kiểm tra thêm dữ liệu có phải được submit ko
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //lấy dữ liệu
            $id = $_GET['id_thuong_hieu']?? '';
            $ten_thuong_hieu = $_POST['ten_thuong_hieu'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';
            // xu ly upload file
            $error = [];
            if (empty($ten_thuong_hieu)) {
                $error['ten_thuong_hieu'] = "Tên thương hiệu không được để trống";
            }
            $_SESSION['error']=$error;
            //nếu không có lỗi tiến hành thêm danh mục
            if (empty($error)) {
                $this->moldedThuongHieu->updateThuongHieu($id, $ten_thuong_hieu, $mo_ta);
                header('location: ' . BASE_URL_ADMIN . '?act=thuong_hieu');
                // var_dump($ten_thuong_hieu);
            } else {
                $_SESSION['flash'] = true;
                // debug($_SESSION['error']);                
                header('location: ' . BASE_URL_ADMIN . '?act=form_sua_thuong_hieu&id_thuong_hieu=' . $id);
                exit();
            }
        }
    }
    public function deleteThuongHieu(){
        $id = $_GET['id_thuong_hieu'];
        $this->moldedThuongHieu->deleteThuongHieu($id);
        header('location: ' . BASE_URL_ADMIN . '?act=thuong_hieu');
    }

}
?>