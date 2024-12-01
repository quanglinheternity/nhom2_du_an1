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
    public function register($ho_ten, $email, $mat_khau, $chuc_vu_id = 2, $trang_thai = 1)
    {

        try {
            $sql = "SELECT * FROM tai_khoans WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();
            if ($user) {
                return "Email đã tồn tại";
            } else {
                $hashedPassword = password_hash($mat_khau, PASSWORD_BCRYPT);
                $sql = "INSERT INTO tai_khoans (ho_ten, email, mat_khau, chuc_vu_id, trang_thai) VALUES (:ho_ten, :email, :mat_khau, :chuc_vu_id, :trang_thai)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(['ho_ten' => $ho_ten, 'email' => $email, 'mat_khau' => $hashedPassword, 'chuc_vu_id' => $chuc_vu_id, 'trang_thai' => $trang_thai]);
                return "Đăng ký thành công";
            }
        } catch (\Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}