<?php
class AdminThongKe{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllTongKet(){
        try{
            $sql = "SELECT 
            COUNT(don_hangs.id) AS tong_don_hang,
            SUM(chi_tiet_don_hangs.thanh_tien) AS tong_doanh_thu,
            SUM(chi_tiet_don_hangs.so_luong) AS tong_san_pham_ban,
            SUM(san_phams.so_luong) - SUM(chi_tiet_don_hangs.so_luong) AS tong_san_pham_con
                FROM don_hangs
                JOIN chi_tiet_don_hangs ON don_hangs.id = chi_tiet_don_hangs.don_hang_id
                JOIN san_phams ON chi_tiet_don_hangs.san_pham_id = san_phams.id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetch();
        } catch(Exception $e){
            echo "Lỗi: ".$e->getMessage();
        }
    }
    public function listTongKetTheoNgay(){
        try{
            $sql = "SELECT 
            COUNT(don_hangs.id) AS tong_don_hang,
            SUM(chi_tiet_don_hangs.thanh_tien) AS doanh_thu_san_pham,
            SUM(chi_tiet_don_hangs.so_luong) AS tong_san_pham_ban,
            DATE(don_hangs.ngay_dat) AS ngay,
            MIN(CASE 
                    WHEN san_phams.gia_khuyen_mai > 0 THEN san_phams.gia_khuyen_mai 
                    ELSE san_phams.gia_san_pham 
                END) AS minPrice, 
            MAX(CASE 
                    WHEN san_phams.gia_khuyen_mai > 0 THEN san_phams.gia_khuyen_mai 
                    ELSE san_phams.gia_san_pham 
                END) AS maxPrice, 
            AVG(CASE 
                    WHEN san_phams.gia_khuyen_mai > 0 THEN san_phams.gia_khuyen_mai 
                    ELSE san_phams.gia_san_pham 
                END) AS avgPrice
        FROM don_hangs
        LEFT JOIN chi_tiet_don_hangs ON don_hangs.id = chi_tiet_don_hangs.don_hang_id
        LEFT JOIN san_phams ON chi_tiet_don_hangs.san_pham_id = san_phams.id
        GROUP BY DATE(don_hangs.ngay_dat)
        ORDER BY ngay DESC;
        ;";


            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch(Exception $e){
            echo "Lỗi: ".$e->getMessage();
        }
    }
    public function DonHangFormTrangThai(){
        try{
            $sql = "SELECT 
                    don_hangs.tai_khoan_id,
                    tai_khoans.ho_ten,
                    tai_khoans.email,
                    tai_khoans.anh_dai_dien,
                    COUNT(don_hangs.id) AS so_don_hang,
                    SUM(tong_tien) AS tong_chi_tieu
                FROM don_hangs
                join tai_khoans on don_hangs.tai_khoan_id = tai_khoans.id
                GROUP BY tai_khoan_id
                ORDER BY tong_chi_tieu DESC
                LIMIT 10;
            ";
                    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch(Exception $e){
            echo "Lỗi: ".$e->getMessage();
        }
    }
    
}