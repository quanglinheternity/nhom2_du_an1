<?php
class GioHang {
    public $conn;
    public function __construct() {
        $this->conn = connectDB();

    }
    public function getGioHangFormId($id){
        try {
            $sql = "SELECT * FROM gio_hangs WHERE tai_khoan_id = :id";
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
    public function getDetailGioHang($id){
        try {
            $sql = "SELECT chi_tiet_gio_hangs.*, san_phams.ten_san_pham, 
            san_phams.hinh_anh, san_phams.gia_san_pham, san_phams.gia_khuyen_mai
            FROM chi_tiet_gio_hangs 
            INNER JOIN san_phams ON chi_tiet_gio_hangs.san_pham_id = san_phams.id 
            WHERE chi_tiet_gio_hangs.gio_hang_id = :id";
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
    public function addGioHang($id){
        try {
            $sql = "INSERT INTO gio_hangs (tai_khoan_id) VALUES (:tai_khoan_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
               ':tai_khoan_id' => $id
            ]);
            //lấy thêm id vừa thêm
            $result = $this->conn->lastInsertId();
            return $result;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }   
    public function updateSoLuongGioHang($gio_hang_id, $san_pham_id, $so_luong){
        try {
            $sql = "UPDATE chi_tiet_gio_hangs 
            SET so_luong = :so_luong 
            WHERE gio_hang_id = :gio_hang_id AND san_pham_id = :san_pham_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':gio_hang_id' => $gio_hang_id,
                ':san_pham_id' => $san_pham_id,
                ':so_luong' => $so_luong
            ]);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function addChiTietGioHang($gio_hang_id, $san_pham_id, $so_luong){
        try {
            $sql = "INSERT INTO chi_tiet_gio_hangs (gio_hang_id, san_pham_id, so_luong) 
            VALUES (:gio_hang_id, :san_pham_id, :so_luong)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':gio_hang_id' => $gio_hang_id,
                ':san_pham_id' => $san_pham_id,
                ':so_luong' => $so_luong
            ]);
            return true;
        }catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function clearDetailGiongHang($gio_hang_id){
        try {
            $sql="DELETE FROM chi_tiet_gio_hangs WHERE gio_hang_id=:gio_hang_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':gio_hang_id'=>$gio_hang_id
            ]);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
       
    }
    public function clearGiongHang($tai_khoan_id){
        try {
            $sql="DELETE FROM gio_hangs WHERE tai_khoan_id=:tai_khoan_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':tai_khoan_id'=>$tai_khoan_id
            ]);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
       
    }
    public function updateCartInDatabase($productId, $quantity) {
        try {
            $sql = "UPDATE chi_tiet_gio_hangs SET so_luong = :quantity WHERE id = :productId";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':productId' => $productId,
                ':quantity' => $quantity
            ]);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function deleteSpInCart($productId) {
        try {
            $sql = "DELETE FROM chi_tiet_gio_hangs WHERE id = :productId";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':productId' => $productId
            ]);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}