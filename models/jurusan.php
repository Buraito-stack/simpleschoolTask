<?php
require_once __DIR__ . '/../config/database.php';

class Jurusan {
    private $conn;
    private $table_name = "jurusan";

    public $id;
    public $kode_jurusan;
    public $nama_jurusan;
    public $keterangan;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET kode_jurusan=:kode_jurusan, nama_jurusan=:nama_jurusan, keterangan=:keterangan";
        
        $stmt = $this->conn->prepare($query);

        $this->kode_jurusan = htmlspecialchars(strip_tags($this->kode_jurusan));
        $this->nama_jurusan = htmlspecialchars(strip_tags($this->nama_jurusan));
        $this->keterangan = htmlspecialchars(strip_tags($this->keterangan));

        $stmt->bindParam(":kode_jurusan", $this->kode_jurusan);
        $stmt->bindParam(":nama_jurusan", $this->nama_jurusan);
        $stmt->bindParam(":keterangan", $this->keterangan);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        $query = "SELECT id, kode_jurusan, nama_jurusan, keterangan, created_at FROM " . $this->table_name . " ORDER BY id DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET kode_jurusan=:kode_jurusan, nama_jurusan=:nama_jurusan, keterangan=:keterangan WHERE id=:id";
        
        $stmt = $this->conn->prepare($query);

        $this->kode_jurusan = htmlspecialchars(strip_tags($this->kode_jurusan));
        $this->nama_jurusan = htmlspecialchars(strip_tags($this->nama_jurusan));
        $this->keterangan = htmlspecialchars(strip_tags($this->keterangan));

        $stmt->bindParam(":kode_jurusan", $this->kode_jurusan);
        $stmt->bindParam(":nama_jurusan", $this->nama_jurusan);
        $stmt->bindParam(":keterangan", $this->keterangan);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getById($id) {
        $query = "SELECT id, kode_jurusan, nama_jurusan, keterangan FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->id = $row['id'];
            $this->kode_jurusan = $row['kode_jurusan'];
            $this->nama_jurusan = $row['nama_jurusan'];
            $this->keterangan = $row['keterangan'];
            return true;
        }
        return false;
    }

    public function search($keyword) {
        $query = "SELECT id, kode_jurusan, nama_jurusan, keterangan, created_at FROM " . $this->table_name . " 
                  WHERE kode_jurusan LIKE :keyword OR nama_jurusan LIKE :keyword OR keterangan LIKE :keyword 
                  ORDER BY id DESC";
        
        $stmt = $this->conn->prepare($query);
        
        $keyword = "%{$keyword}%";
        $stmt->bindParam(":keyword", $keyword);
        $stmt->execute();
        
        return $stmt;
    }

    public function count() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name;
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row['total'];
    }

    public function readWithPagination($search = "", $from_record_num = 0, $records_per_page = 5) {
        $search_condition = "";
        if(!empty($search)) {
            $search_condition = " WHERE (kode_jurusan LIKE :keyword OR nama_jurusan LIKE :keyword OR keterangan LIKE :keyword)";
        }
        
        $query = "SELECT id, kode_jurusan, nama_jurusan, keterangan, created_at FROM " . $this->table_name . " 
                  {$search_condition} 
                  ORDER BY id DESC 
                  LIMIT :from_record_num, :records_per_page";
        
        $stmt = $this->conn->prepare($query);
        
        if(!empty($search)) {
            $keyword = "%{$search}%";
            $stmt->bindParam(":keyword", $keyword);
        }
        
        $stmt->bindParam(":from_record_num", $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(":records_per_page", $records_per_page, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt;
    }
}
?>


