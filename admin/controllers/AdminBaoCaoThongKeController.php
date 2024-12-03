<?php 

class AdminBaoCaoThongKeController{
    public $modelThongKe;
    
    public function __construct()
    {
        $this->modelThongKe = new AdminThongKe();
    }

    public function dashboard(){
        $listTongKet = $this->modelThongKe->getAllTongKet();
        $listTongKetTheoNgay = $this->modelThongKe->listTongKetTheoNgay();
        $DonHangFormTrangThai = $this->modelThongKe->DonHangFormTrangThai();
        // echo "<pre>";
        // print_r($DonHangFormTrangThai);
        // die();
        require_once './views/dashboard.php';
    }
    public function bieuDo(){
        
        // var_dump($listThongKe);die();
        $listTongKetTheoNgay = $this->modelThongKe->listTongKetTheoNgay();

        require_once './views/bieuDo/bieuDo.php';

    }

    
}