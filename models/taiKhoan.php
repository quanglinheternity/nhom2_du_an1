<?php
class taiKhoan
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function checkLogin($email, $password){
        try {
            $sql = "SELECT * FROM tai_khoans WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':email' => $email,
                ]
            );

            $user = $stmt->fetch();
            if($user && password_verify($password, $user['mat_khau'] )){
                if( $user['chuc_vu_id'] == 2){
                    if($user['trang_thai'] == 1){
                        return $user['email'];
                    }else{
                        return "Tài khoản bị khóa";
                    }
                }else {
                    return "Tài khoản không có quyền đăng nhập";
                }
            }else{
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
                    ':email' => $email
                ]
            );
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}