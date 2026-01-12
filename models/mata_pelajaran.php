<?php
require_once __DIR__ . '/../config/database.php';

class MataPelajaran {
    private $conn;
    private $table_name = "mata_pelajaran";

    public $id;
    public $nama_mapel;
    public $kelas;
    public $guru_pengajar;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nama_mapel=:nama_mapel, kelas=:kelas, guru_pengajar=:guru_pengajar";
        $stmt = $this->conn->prepare($query);
        
        $this->nama_mapel = htmlspecialchars(strip_tags($this->nama_mapel));
        $this->kelas = htmlspecialchars(strip_tags($this->kelas));
        $this->guru_pengajar = htmlspecialchars(strip_tags($this->guru_pengajar));
        
        $stmt->bindParam(":nama_mapel", $this->nama_mapel);
        $stmt->bindParam(":kelas", $this->kelas);
        $stmt->bindParam(":guru_pengajar", $this->guru_pengajar);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        $query = "SELECT id, nama_mapel, kelas, guru_pengajar FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nama_mapel=:nama_mapel, kelas=:kelas, guru_pengajar=:guru_pengajar WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        
        $this->nama_mapel = htmlspecialchars(strip_tags($this->nama_mapel));
        $this->kelas = htmlspecialchars(strip_tags($this->kelas));
        $this->guru_pengajar = htmlspecialchars(strip_tags($this->guru_pengajar));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(":nama_mapel", $this->nama_mapel);
        $stmt->bindParam(":kelas", $this->kelas);
        $stmt->bindParam(":guru_pengajar", $this->guru_pengajar);
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
        $query = "SELECT id, nama_mapel, kelas, guru_pengajar FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->id = $row['id'];
            $this->nama_mapel = $row['nama_mapel'];
            $this->kelas = $row['kelas'];
            $this->guru_pengajar = $row['guru_pengajar'];
            return true;
        }
        return false;
    }
}
?>

