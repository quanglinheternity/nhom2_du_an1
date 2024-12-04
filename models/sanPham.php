<?php
class sanPham {
    public $conn;
    public function __construct() {
        $this->conn = connectDB();

    }
    public function getAllThuongHieu()
    {
        try {
            $sql = "SELECT * FROM thuong_hieu";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function getAllSanPham() {
        
        try {
            $sql = "SELECT  san_phams.*,thuong_hieu.ten_thuong_hieu 
            FROM san_phams
            JOIN thuong_hieu ON san_phams.thuong_hieu_id = thuong_hieu.id";
            $result = $this->conn->prepare($sql);
            $result->execute();
            return $result->fetchAll();
        } catch (Exception $e) {
            echo "lỗi".$e -> getMessage();
        }
    }
    public function getAllBinhLuanFormKhachHang() {
        
        try {
            $sql = "SELECT tai_khoans.ho_ten, tai_khoans.anh_dai_dien, binh_luans.* FROM tai_khoans 
            INNER JOIN binh_luans ON tai_khoans.id = binh_luans.tai_khoan_id 
            WHERE binh_luans.trang_thai = 1 ORDER BY binh_luans.ngay_dang DESC";
            $result = $this->conn->prepare($sql);
            $result->execute();
            return $result->fetchAll();
        } catch (Exception $e) {
            echo "lỗi".$e -> getMessage();
        }
    }
    public function getSizeSanPham() {
        
        try {
            $sql = "SELECT * FROM sizes";
            $result = $this->conn->prepare($sql);
            $result->execute();
            return $result->fetchAll();
        } catch (Exception $e) {
            echo "lỗi".$e -> getMessage();
        }
    }
    public function getSanPhamById($id)
    {
        try {
            $sql = "SELECT san_phams.*, thuong_hieu.ten_thuong_hieu
            FROM san_phams
            INNER JOIN thuong_hieu ON san_phams.thuong_hieu_id = thuong_hieu.id
           
             WHERE san_phams.id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getlistAnhSanPhamById($id)
    {
        try {
            $sql = "SELECT * FROM hinh_anh_san_phams WHERE san_pham_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            $result = $stmt->fetchAll();
            return $result;

        } catch (PDOException $e) {
            return $e->getMessage();
        }


    }
    public function getBinhLuanByFormSanPham($id)
    {
        try {
            $sql = "SELECT binh_luans.*, tai_khoans.ho_ten, tai_khoans.anh_dai_dien
            FROM binh_luans
            INNER JOIN tai_khoans ON binh_luans.tai_khoan_id = tai_khoans.id
            where binh_luans.san_pham_id = :id
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':id' => $id
                ]
            );
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function getListSanPhamThuongHieu($id) {
        
        try {
            $sql = "SELECT  san_phams.*,thuong_hieu.ten_thuong_hieu  
            FROM san_phams
            JOIN thuong_hieu ON san_phams.thuong_hieu_id = thuong_hieu.id
            WHERE san_phams.thuong_hieu_id=$id
            ";
            $result = $this->conn->prepare($sql);
            $result->execute();
            return $result->fetchAll();
        } catch (Exception $e) {
            echo "lỗi".$e -> getMessage();
        }
    }
    public function getMaGiamGiaByMa($ma){
        try {
            $sql = "SELECT * FROM ma_giam_gia 
            WHERE ma=:ma";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ma'=> $ma
            ]);
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function themBinhLuan($san_pham_id, $noi_dung, $tai_khoan_id, $ngay_dang) {
        try {
            $sql = "INSERT INTO binh_luans (san_pham_id, noi_dung, tai_khoan_id, ngay_dang) VALUES (:san_pham_id, :noi_dung, :tai_khoan_id, :ngay_dang)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':san_pham_id' => $san_pham_id,
                ':noi_dung' => $noi_dung,
                ':tai_khoan_id' => $tai_khoan_id,
                ':ngay_dang' => $ngay_dang
            ]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function search($keyword)
    {
        try {
            $sql = "SELECT * FROM san_phams
            WHERE ten_san_pham LIKE :keyword
            ORDER BY luot_xem DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':keyword' => '%' . $keyword . '%',
            ]);
    
            return $stmt->fetchAll();
        } catch (Exception $e) {
            throw new Exception("Error searching for products: " . $e->getMessage());
        }
    }
}
?>