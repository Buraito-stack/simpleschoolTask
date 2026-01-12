<?php
require_once __DIR__ . '/../config/database.php';

class Ekstrakurikuler {
    private $conn;
    private $table_name = "ekstrakurikuler";

    public $id;
    public $nama_ekstra;
    public $jadwal;
    public $guru_ekstra;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nama_ekstra=:nama_ekstra, jadwal=:jadwal, guru_ekstra=:guru_ekstra";
        $stmt = $this->conn->prepare($query);
        
        $this->nama_ekstra = htmlspecialchars(strip_tags($this->nama_ekstra));
        $this->jadwal = htmlspecialchars(strip_tags($this->jadwal));
        $this->guru_ekstra = htmlspecialchars(strip_tags($this->guru_ekstra));
        
        $stmt->bindParam(":nama_ekstra", $this->nama_ekstra);
        $stmt->bindParam(":jadwal", $this->jadwal);
        $stmt->bindParam(":guru_ekstra", $this->guru_ekstra);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        $query = "SELECT id, nama_ekstra, jadwal, guru_ekstra FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nama_ekstra=:nama_ekstra, jadwal=:jadwal, guru_ekstra=:guru_ekstra WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        
        $this->nama_ekstra = htmlspecialchars(strip_tags($this->nama_ekstra));
        $this->jadwal = htmlspecialchars(strip_tags($this->jadwal));
        $this->guru_ekstra = htmlspecialchars(strip_tags($this->guru_ekstra));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(":nama_ekstra", $this->nama_ekstra);
        $stmt->bindParam(":jadwal", $this->jadwal);
        $stmt->bindParam(":guru_ekstra", $this->guru_ekstra);
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
        $query = "SELECT id, nama_ekstra, jadwal, guru_ekstra FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->id = $row['id'];
            $this->nama_ekstra = $row['nama_ekstra'];
            $this->jadwal = $row['jadwal'];
            $this->guru_ekstra = $row['guru_ekstra'];
            return true;
        }
        return false;
    }
}
?>

