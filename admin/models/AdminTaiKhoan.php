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

    public function insertTaiKhoanQuanTri($ho_ten, $email, $so_dien_thoai, $password, $chuc_vu_id)
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

    public function checkLogin($email, $password)
    {
        try {
            $sql = "SELECT * FROM tai_khoans WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':email' => $email,
                ]
            );

            $user = $stmt->fetch();
            if ($user && password_verify($password, $user['mat_khau'])) {
                if ($user['chuc_vu_id'] == 1) {
                    if ($user['trang_thai'] == 1) {
                        return $user['email'];
                    } else {
                        return "Tài khoản bị khóa";
                    }
                } else {
                    return "Tài khoản không có quyền quản trị";
                }
            } else {
                return "Lỗi đăng nhập tài khoản mật không đúng";
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function getTaiKhoanFormEmail($email)
    {
        try {
            $sql = "SELECT * FROM tai_khoans WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':email' => $email,
                ]
            );

            $user = $stmt->fetch();
            return $user;
            
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function updateKhachHang(
        $id,
        $ho_ten,
        $email,
        $so_dien_thoai,
        $ngay_sinh,
        $gioi_tinh,
        $dia_chi,
        $trang_thai
    ) {
        try {
            $sql = "UPDATE tai_khoans SET ho_ten = :ho_ten, email = :email, so_dien_thoai = :so_dien_thoai,ngay_sinh = :ngay_sinh,gioi_tinh = :gioi_tinh,dia_chi = :dia_chi, trang_thai = :trang_thai WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':id' => $id,
                    ':ho_ten' => $ho_ten,
                    ':email' => $email,
                    ':so_dien_thoai' => $so_dien_thoai,
                    ':ngay_sinh' => $ngay_sinh,
                    ':gioi_tinh' => $gioi_tinh,
                    ':dia_chi' => $dia_chi,
                    ':trang_thai' => $trang_thai
                ]
            );
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
