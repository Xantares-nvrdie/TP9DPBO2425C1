<?php
include_once("models/DB.php");
include_once("KontrakSponsor.php"); 

class TabelSponsor extends DB implements KontrakSponsor { // Implementasi KontrakSponsor

    public function __construct($host, $db_name, $username, $password){
        parent::__construct($host, $db_name, $username, $password);
    }

    public function getAllSponsor(): array {
        $this->executeQuery("SELECT * FROM sponsor");
        return $this->getAllResult();
    }

    public function getSponsorById($id): ?array {
        $this->executeQuery("SELECT * FROM sponsor WHERE id = :id", ['id' => $id]);
        $result = $this->getAllResult();
        return count($result) > 0 ? $result[0] : null; // Cek count > 0 untuk safety
    }

    public function addSponsor($nama, $negara, $pendanaan): void {
        $sql = "INSERT INTO sponsor (nama, negara, pendanaan) VALUES (:nama, :negara, :pendanaan)";
        $stmt = $this->conn->prepare($sql);
        // Gunakan bindValue/execute array agar konsisten dan aman
        $stmt->execute([
            ':nama' => $nama,
            ':negara' => $negara,
            ':pendanaan' => $pendanaan
        ]);
    }

    public function updateSponsor($id, $nama, $negara, $pendanaan): void {
        $sql = "UPDATE sponsor SET nama = :nama, negara = :negara, pendanaan = :pendanaan WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':nama' => $nama,
            ':negara' => $negara,
            ':pendanaan' => $pendanaan
        ]);
    }

    public function deleteSponsor($id): void {
        $stmt = $this->conn->prepare("DELETE FROM sponsor WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
}
?>
