<?php

include_once ("models/DB.php");
include_once ("KontrakModel.php");

class TabelPembalap extends DB implements KontrakModel {

    // Konstruktor untuk inisialisasi database
    public function __construct($host, $db_name, $username, $password) {
        parent::__construct($host, $db_name, $username, $password);
    }

    // Method untuk mendapatkan semua pembalap
    public function getAllPembalap(): array {
        $q = "SELECT * FROM pembalap";
        $this->executeQuery($q);
        return $this->getAllResult();
    }

    // Method untuk mendapatkan pembalap berdasarkan ID
    public function getPembalapById($id): ?array {
        $this->executeQuery("SELECT * FROM pembalap WHERE id = :id", ['id' => $id]);
        $result = $this->getAllResult();
        return count($result) > 0 ? $result[0] : null;
    }

    // implementasikan metode CRUD di bawah ini sesuai kebutuhan
    public function addPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void{
        try {
            $sql = "INSERT INTO pembalap (nama, tim, negara, poinMusim, jumlahMenang)
                    VALUES (:nama, :tim, :negara, :poinMusim, :jumlahMenang)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(':nama', $nama, PDO::PARAM_STR);
            $stmt->bindValue(':tim', $tim, PDO::PARAM_STR);
            $stmt->bindValue(':negara', $negara, PDO::PARAM_STR);
            $stmt->bindValue(':poinMusim', $poinMusim, PDO::PARAM_INT);
            $stmt->bindValue(':jumlahMenang', $jumlahMenang, PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }   

    
    public function updatePembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void {
        try {
            $sql = "UPDATE pembalap SET
                nama = :nama,
                tim = :tim, 
                negara = :negara, 
                poinMusim = :poinMusim, 
                jumlahMenang = :jumlahMenang
            WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':nama', $nama, PDO::PARAM_STR);
            $stmt->bindValue(':tim', $tim, PDO::PARAM_STR);
            $stmt->bindValue(':negara', $negara, PDO::PARAM_STR);
            $stmt->bindValue(':poinMusim', $poinMusim, PDO::PARAM_INT);
            $stmt->bindValue(':jumlahMenang', $jumlahMenang, PDO::PARAM_INT);

            $stmt->execute();
        } catch (Throwable $e) {
            $this->error = $e->getMessage();
        }
    }
    
    public function deletePembalap($id): void {
        try {
            $sql = "DELETE FROM pembalap WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

}

?>
