<?php
class AdminTaiKhoan
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllTaiKhoan($chuc_vu_id)
    {
        try {
            $sql = "SELECT * FROM tai_khoans WHERE chuc_vu_id = :chuc_vu_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':chuc_vu_id' => $chuc_vu_id
                ]
            );
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function insertTaiKhoanQuanTri($ho_ten, $email,$so_dien_thoai, $password, $chuc_vu_id)
    {
        try {
            $sql = 'INSERT INTO tai_khoans(ho_ten, email ,so_dien_thoai, mat_khau,chuc_vu_id) 
        VALUES (:ho_ten, :email ,:so_dien_thoai, :password,:chuc_vu_id)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':ho_ten' => $ho_ten,
                    ':email' => $email,
                    ':so_dien_thoai' => $so_dien_thoai,
                    ':password' => $password,
                    ':chuc_vu_id' => $chuc_vu_id,
                ]
            );
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function getTaiKhoanQuanTriById($id)
    {
        try {
            $sql = "SELECT * FROM tai_khoans WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':id' => $id
                ]
            );
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function updateTaiKhoanQuanTri($id, $ho_ten, $email, $so_dien_thoai, $trang_thai)
    {
        try {
            $sql = "UPDATE tai_khoans SET ho_ten = :ho_ten, email = :email, so_dien_thoai = :so_dien_thoai, trang_thai = :trang_thai WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':id' => $id,
                    ':ho_ten' => $ho_ten,
                    ':email' => $email,
                    ':so_dien_thoai' => $so_dien_thoai,
                    ':trang_thai' => $trang_thai
                ]
            );
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function resetPassword($id, $password)
    {
        try {
            $sql = "UPDATE tai_khoans SET mat_khau = :password WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':id' => $id,
                    ':password' => $password
                ]
            );
            // var_dump($password);die();

            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    
    
   
    
    
}