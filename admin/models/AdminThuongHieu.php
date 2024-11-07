<?php
class AdminThuongHieu
{
    public $conn;
    public function __construct()
    {
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
    public function insertThuongHieu($ten_thuong_hieu, $mo_ta)
    {
        try {
            $sql = "INSERT INTO thuong_hieu(ten_thuong_hieu, mo_ta) VALUES (:ten_thuong_hieu, :mo_ta)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [

                    ':ten_thuong_hieu' => $ten_thuong_hieu,
                    ':mo_ta' => $mo_ta
                ]
            );
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function getThuongHieuById($id)
    {
        try {
            $sql = "SELECT * FROM thuong_hieu WHERE id = :id";
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
    public function updateThuongHieu($id, $ten_thuong_hieu, $mo_ta)
    {
        try {
            $sql = "UPDATE thuong_hieu SET ten_thuong_hieu = :ten_thuong_hieu, mo_ta = :mo_ta WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [

                    ':ten_thuong_hieu' => $ten_thuong_hieu,
                    ':mo_ta' => $mo_ta,
                    ':id' => $_GET['id_thuong_hieu']
                ]
            );
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function deleteThuongHieu($id)
    {
        try {
            $sql = "DELETE FROM thuong_hieu WHERE id = :id";
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
?>