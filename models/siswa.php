<?php
require_once __DIR__ . '/../config/database.php';

class Siswa {
    private $conn;
    private $table_name = "siswa";

    public $id;
    public $nis;
    public $nama;
    public $kelas;
    public $jurusan;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nis=:nis, nama=:nama, kelas=:kelas, jurusan=:jurusan";
        $stmt = $this->conn->prepare($query);
        
        $this->nis = htmlspecialchars(strip_tags($this->nis));
        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->kelas = htmlspecialchars(strip_tags($this->kelas));
        $this->jurusan = htmlspecialchars(strip_tags($this->jurusan));
        
        $stmt->bindParam(":nis", $this->nis);
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":kelas", $this->kelas);
        $stmt->bindParam(":jurusan", $this->jurusan);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        $query = "SELECT id, nis, nama, kelas, jurusan FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nis=:nis, nama=:nama, kelas=:kelas, jurusan=:jurusan WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        
        $this->nis = htmlspecialchars(strip_tags($this->nis));
        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->kelas = htmlspecialchars(strip_tags($this->kelas));
        $this->jurusan = htmlspecialchars(strip_tags($this->jurusan));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(":nis", $this->nis);
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":kelas", $this->kelas);
        $stmt->bindParam(":jurusan", $this->jurusan);
        $stmt->bindParam(":id", $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getById($id) {
        $query = "SELECT id, nis, nama, kelas, jurusan FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->id = $row['id'];
            $this->nis = $row['nis'];
            $this->nama = $row['nama'];
            $this->kelas = $row['kelas'];
            $this->jurusan = $row['jurusan'];
            return true;
        }
        return false;
    }
}
?>