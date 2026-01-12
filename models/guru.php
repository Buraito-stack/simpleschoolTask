<?php
require_once __DIR__ . '/../config/database.php';

class Guru {
    private $conn;
    private $table_name = "guru";

    public $id;
    public $nip;
    public $nama;
    public $mapel;
    public $jabatan;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nip=:nip, nama=:nama, mapel=:mapel, jabatan=:jabatan";
        $stmt = $this->conn->prepare($query);
        
        $this->nip = htmlspecialchars(strip_tags($this->nip));
        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->mapel = htmlspecialchars(strip_tags($this->mapel));
        $this->jabatan = htmlspecialchars(strip_tags($this->jabatan));
        
        $stmt->bindParam(":nip", $this->nip);
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":mapel", $this->mapel);
        $stmt->bindParam(":jabatan", $this->jabatan);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        $query = "SELECT id, nip, nama, mapel, jabatan FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nip=:nip, nama=:nama, mapel=:mapel, jabatan=:jabatan WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        
        $this->nip = htmlspecialchars(strip_tags($this->nip));
        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->mapel = htmlspecialchars(strip_tags($this->mapel));
        $this->jabatan = htmlspecialchars(strip_tags($this->jabatan));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(":nip", $this->nip);
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":mapel", $this->mapel);
        $stmt->bindParam(":jabatan", $this->jabatan);
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
        $query = "SELECT id, nip, nama, mapel, jabatan FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->id = $row['id'];
            $this->nip = $row['nip'];
            $this->nama = $row['nama'];
            $this->mapel = $row['mapel'];
            $this->jabatan = $row['jabatan'];
            return true;
        }
        return false;
    }
}
?>

