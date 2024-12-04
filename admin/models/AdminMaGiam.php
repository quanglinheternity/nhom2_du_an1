<?php
class AdminMaGiam
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    // giảm giá
    public function listMaGiamGia(){
        try{
            $sql = "SELECT * FROM ma_giam_gia";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }
    
    public function insertMaGiam($ma, $gia_tri_giam, $ngay_tao)
    {
        try {
            $sql = "INSERT INTO ma_giam_gia(ma, gia_tri_giam, ngay_tao) VALUES (:ma,:gia_tri_giam, :ngay_tao)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [

                    ':ma' => $ma,
                    ':gia_tri_giam' => $gia_tri_giam,
                    ':ngay_tao' => $ngay_tao
                ]
            );
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function getMaGiamById($id)
    {
        try {
            $sql = "SELECT * FROM ma_giam_gia WHERE id = :id";
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
    public function updateMaGiam($id, $ma, $gia_tri_giam)
    {
        try {
            $sql = "UPDATE ma_giam_gia SET ma = :ma,gia_tri_giam = :gia_tri_giam WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [

                    ':ma' => $ma,
                    ':gia_tri_giam' => $gia_tri_giam,
                    ':id' => $id
                ]
            );
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function deleteMaGiam($id)
    {
        try {
            $sql = "DELETE FROM ma_giam_gia WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

}
