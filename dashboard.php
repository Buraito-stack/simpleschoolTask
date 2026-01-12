<?php
session_start();

// Check authentication first before any output
if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'models/siswa.php';
require_once 'models/guru.php';
require_once 'models/jurusan.php';
require_once 'models/mata_pelajaran.php';
require_once 'models/ekstrakurikuler.php';
require_once 'config/database.php';

// Get current page
$page = isset($_GET['page']) ? $_GET['page'] : 'siswa';

// Handle form submissions
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    
    if(isset($_POST['action'])) {
        switch($_POST['action']) {
            case 'add_siswa':
                $siswa = new Siswa($db);
                $siswa->nis = $_POST['nis'];
                $siswa->nama = $_POST['nama'];
                $siswa->kelas = $_POST['kelas'];
                $siswa->jurusan = $_POST['jurusan'];
                if($siswa->create()) {
                    $_SESSION['success'] = 'Data siswa berhasil ditambahkan!';
                } else {
                    $_SESSION['error'] = 'Gagal menambahkan data siswa!';
                }
                break;
            case 'edit_siswa':
                $siswa = new Siswa($db);
                $siswa->id = $_POST['siswa_id'];
                $siswa->nis = $_POST['nis'];
                $siswa->nama = $_POST['nama'];
                $siswa->kelas = $_POST['kelas'];
                $siswa->jurusan = $_POST['jurusan'];
                if($siswa->update()) {
                    $_SESSION['success'] = 'Data siswa berhasil diperbarui!';
                } else {
                    $_SESSION['error'] = 'Gagal memperbarui data siswa!';
                }
                break;
            case 'delete_siswa':
                $siswa = new Siswa($db);
                $siswa->id = $_POST['siswa_id'];
                if($siswa->delete()) {
                    $_SESSION['success'] = 'Data siswa berhasil dihapus!';
                } else {
                    $_SESSION['error'] = 'Gagal menghapus data siswa!';
                }
                break;
            case 'add_guru':
                $guru = new Guru($db);
                $guru->nip = $_POST['nip'];
                $guru->nama = $_POST['nama'];
                $guru->mapel = $_POST['mapel'];
                $guru->jabatan = $_POST['jabatan'];
                if($guru->create()) {
                    $_SESSION['success'] = 'Data guru berhasil ditambahkan!';
                } else {
                    $_SESSION['error'] = 'Gagal menambahkan data guru!';
                }
                break;
            case 'edit_guru':
                $guru = new Guru($db);
                $guru->id = $_POST['guru_id'];
                $guru->nip = $_POST['nip'];
                $guru->nama = $_POST['nama'];
                $guru->mapel = $_POST['mapel'];
                $guru->jabatan = $_POST['jabatan'];
                if($guru->update()) {
                    $_SESSION['success'] = 'Data guru berhasil diperbarui!';
                } else {
                    $_SESSION['error'] = 'Gagal memperbarui data guru!';
                }
                break;
            case 'delete_guru':
                $guru = new Guru($db);
                $guru->id = $_POST['guru_id'];
                if($guru->delete()) {
                    $_SESSION['success'] = 'Data guru berhasil dihapus!';
                } else {
                    $_SESSION['error'] = 'Gagal menghapus data guru!';
                }
                break;
            case 'add_jurusan':
                $jurusan = new Jurusan($db);
                $jurusan->kode_jurusan = $_POST['kode_jurusan'];
                $jurusan->nama_jurusan = $_POST['nama_jurusan'];
                $jurusan->keterangan = $_POST['keterangan'];
                if($jurusan->create()) {
                    $_SESSION['success'] = 'Data jurusan berhasil ditambahkan!';
                } else {
                    $_SESSION['error'] = 'Gagal menambahkan data jurusan!';
                }
                break;
            case 'edit_jurusan':
                $jurusan = new Jurusan($db);
                $jurusan->id = $_POST['jurusan_id'];
                $jurusan->kode_jurusan = $_POST['kode_jurusan'];
                $jurusan->nama_jurusan = $_POST['nama_jurusan'];
                $jurusan->keterangan = $_POST['keterangan'];
                if($jurusan->update()) {
                    $_SESSION['success'] = 'Data jurusan berhasil diperbarui!';
                } else {
                    $_SESSION['error'] = 'Gagal memperbarui data jurusan!';
                }
                break;
            case 'delete_jurusan':
                $jurusan = new Jurusan($db);
                $jurusan->id = $_POST['jurusan_id'];
                if($jurusan->delete()) {
                    $_SESSION['success'] = 'Data jurusan berhasil dihapus!';
                } else {
                    $_SESSION['error'] = 'Gagal menghapus data jurusan!';
                }
                break;
            case 'add_mata_pelajaran':
                $mapel = new MataPelajaran($db);
                $mapel->nama_mapel = $_POST['nama_mapel'];
                $mapel->kelas = $_POST['kelas'];
                $mapel->guru_pengajar = $_POST['guru_pengajar'];
                if($mapel->create()) {
                    $_SESSION['success'] = 'Data mata pelajaran berhasil ditambahkan!';
                } else {
                    $_SESSION['error'] = 'Gagal menambahkan data mata pelajaran!';
                }
                break;
            case 'edit_mata_pelajaran':
                $mapel = new MataPelajaran($db);
                $mapel->id = $_POST['mata_pelajaran_id'];
                $mapel->nama_mapel = $_POST['nama_mapel'];
                $mapel->kelas = $_POST['kelas'];
                $mapel->guru_pengajar = $_POST['guru_pengajar'];
                if($mapel->update()) {
                    $_SESSION['success'] = 'Data mata pelajaran berhasil diperbarui!';
                } else {
                    $_SESSION['error'] = 'Gagal memperbarui data mata pelajaran!';
                }
                break;
            case 'delete_mata_pelajaran':
                $mapel = new MataPelajaran($db);
                $mapel->id = $_POST['mata_pelajaran_id'];
                if($mapel->delete()) {
                    $_SESSION['success'] = 'Data mata pelajaran berhasil dihapus!';
                } else {
                    $_SESSION['error'] = 'Gagal menghapus data mata pelajaran!';
                }
                break;
            case 'add_ekstrakurikuler':
                $ekstra = new Ekstrakurikuler($db);
                $ekstra->nama_ekstra = $_POST['nama_ekstra'];
                $ekstra->jadwal = $_POST['jadwal'];
                $ekstra->guru_ekstra = $_POST['guru_ekstra'];
                if($ekstra->create()) {
                    $_SESSION['success'] = 'Data ekstrakurikuler berhasil ditambahkan!';
                } else {
                    $_SESSION['error'] = 'Gagal menambahkan data ekstrakurikuler!';
                }
                break;
            case 'edit_ekstrakurikuler':
                $ekstra = new Ekstrakurikuler($db);
                $ekstra->id = $_POST['ekstrakurikuler_id'];
                $ekstra->nama_ekstra = $_POST['nama_ekstra'];
                $ekstra->jadwal = $_POST['jadwal'];
                $ekstra->guru_ekstra = $_POST['guru_ekstra'];
                if($ekstra->update()) {
                    $_SESSION['success'] = 'Data ekstrakurikuler berhasil diperbarui!';
                } else {
                    $_SESSION['error'] = 'Gagal memperbarui data ekstrakurikuler!';
                }
                break;
            case 'delete_ekstrakurikuler':
                $ekstra = new Ekstrakurikuler($db);
                $ekstra->id = $_POST['ekstrakurikuler_id'];
                if($ekstra->delete()) {
                    $_SESSION['success'] = 'Data ekstrakurikuler berhasil dihapus!';
                } else {
                    $_SESSION['error'] = 'Gagal menghapus data ekstrakurikuler!';
                }
                break;
        }
        header('Location: dashboard.php?page=' . $page);
        exit();
    }
}

// Handle search and pagination
$search = isset($_GET['search']) ? $_GET['search'] : '';
$page_num = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
$per_page = 5; // Items per page
$offset = ($page_num - 1) * $per_page;

$database = new Database();
$db = $database->getConnection();

// Get data based on current page
switch($page) {
    case 'siswa':
        $siswa = new Siswa($db);
        if(!empty($search)) {
            // Count total records for pagination
            $count_stmt = $db->prepare("SELECT COUNT(*) FROM siswa WHERE nama LIKE ? OR nis LIKE ? OR kelas LIKE ? OR jurusan LIKE ?");
            $searchTerm = "%$search%";
            $count_stmt->execute([$searchTerm, $searchTerm, $searchTerm, $searchTerm]);
            $total_records = $count_stmt->fetchColumn();

            // Get paginated data
            $stmt = $db->prepare("SELECT id, nis, nama, kelas, jurusan FROM siswa WHERE nama LIKE ? OR nis LIKE ? OR kelas LIKE ? OR jurusan LIKE ? ORDER BY id DESC LIMIT $per_page OFFSET $offset");
            $stmt->execute([$searchTerm, $searchTerm, $searchTerm, $searchTerm]);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // Count total records for pagination
            $count_stmt = $db->prepare("SELECT COUNT(*) FROM siswa");
            $count_stmt->execute();
            $total_records = $count_stmt->fetchColumn();

            // Get paginated data
            $stmt = $db->prepare("SELECT id, nis, nama, kelas, jurusan FROM siswa ORDER BY id DESC LIMIT $per_page OFFSET $offset");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        break;
    case 'guru':
        $guru = new Guru($db);
        if(!empty($search)) {
            // Count total records for pagination
            $count_stmt = $db->prepare("SELECT COUNT(*) FROM guru WHERE nama LIKE ? OR nip LIKE ? OR mapel LIKE ? OR jabatan LIKE ?");
            $searchTerm = "%$search%";
            $count_stmt->execute([$searchTerm, $searchTerm, $searchTerm, $searchTerm]);
            $total_records = $count_stmt->fetchColumn();

            // Get paginated data
            $stmt = $db->prepare("SELECT id, nip, nama, mapel, jabatan FROM guru WHERE nama LIKE ? OR nip LIKE ? OR mapel LIKE ? OR jabatan LIKE ? ORDER BY id DESC LIMIT $per_page OFFSET $offset");
            $stmt->execute([$searchTerm, $searchTerm, $searchTerm, $searchTerm]);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // Count total records for pagination
            $count_stmt = $db->prepare("SELECT COUNT(*) FROM guru");
            $count_stmt->execute();
            $total_records = $count_stmt->fetchColumn();

            // Get paginated data
            $stmt = $db->prepare("SELECT id, nip, nama, mapel, jabatan FROM guru ORDER BY id DESC LIMIT $per_page OFFSET $offset");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        break;
    case 'jurusan':
        $jurusan = new Jurusan($db);
        if(!empty($search)) {
            // Count total records for pagination
            $count_stmt = $db->prepare("SELECT COUNT(*) FROM jurusan WHERE nama_jurusan LIKE ? OR kode_jurusan LIKE ? OR keterangan LIKE ?");
            $searchTerm = "%$search%";
            $count_stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
            $total_records = $count_stmt->fetchColumn();

            // Get paginated data
            $stmt = $db->prepare("SELECT id, kode_jurusan, nama_jurusan, keterangan FROM jurusan WHERE nama_jurusan LIKE ? OR kode_jurusan LIKE ? OR keterangan LIKE ? ORDER BY id DESC LIMIT $per_page OFFSET $offset");
            $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // Count total records for pagination
            $count_stmt = $db->prepare("SELECT COUNT(*) FROM jurusan");
            $count_stmt->execute();
            $total_records = $count_stmt->fetchColumn();

            // Get paginated data
            $stmt = $db->prepare("SELECT id, kode_jurusan, nama_jurusan, keterangan FROM jurusan ORDER BY id DESC LIMIT $per_page OFFSET $offset");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        break;
    case 'mata_pelajaran':
        $mapel = new MataPelajaran($db);
        if(!empty($search)) {
            // Count total records for pagination
            $count_stmt = $db->prepare("SELECT COUNT(*) FROM mata_pelajaran WHERE nama_mapel LIKE ? OR kelas LIKE ? OR guru_pengajar LIKE ?");
            $searchTerm = "%$search%";
            $count_stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
            $total_records = $count_stmt->fetchColumn();

            // Get paginated data
            $stmt = $db->prepare("SELECT id, nama_mapel, kelas, guru_pengajar FROM mata_pelajaran WHERE nama_mapel LIKE ? OR kelas LIKE ? OR guru_pengajar LIKE ? ORDER BY id DESC LIMIT $per_page OFFSET $offset");
            $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // Count total records for pagination
            $count_stmt = $db->prepare("SELECT COUNT(*) FROM mata_pelajaran");
            $count_stmt->execute();
            $total_records = $count_stmt->fetchColumn();

            // Get paginated data
            $stmt = $db->prepare("SELECT id, nama_mapel, kelas, guru_pengajar FROM mata_pelajaran ORDER BY id DESC LIMIT $per_page OFFSET $offset");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        break;
    case 'ekstrakurikuler':
        $ekstra = new Ekstrakurikuler($db);
        if(!empty($search)) {
            // Count total records for pagination
            $count_stmt = $db->prepare("SELECT COUNT(*) FROM ekstrakurikuler WHERE nama_ekstra LIKE ? OR jadwal LIKE ? OR guru_ekstra LIKE ?");
            $searchTerm = "%$search%";
            $count_stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
            $total_records = $count_stmt->fetchColumn();

            // Get paginated data
            $stmt = $db->prepare("SELECT id, nama_ekstra, jadwal, guru_ekstra FROM ekstrakurikuler WHERE nama_ekstra LIKE ? OR jadwal LIKE ? OR guru_ekstra LIKE ? ORDER BY id DESC LIMIT $per_page OFFSET $offset");
            $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // Count total records for pagination
            $count_stmt = $db->prepare("SELECT COUNT(*) FROM ekstrakurikuler");
            $count_stmt->execute();
            $total_records = $count_stmt->fetchColumn();

            // Get paginated data
            $stmt = $db->prepare("SELECT id, nama_ekstra, jadwal, guru_ekstra FROM ekstrakurikuler ORDER BY id DESC LIMIT $per_page OFFSET $offset");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        break;
}

// Calculate pagination
$total_pages = ceil($total_records / $per_page);
$start_page = max(1, $page_num - 2);
$end_page = min($total_pages, $page_num + 2);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SMK TI Bali Global Denpasar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0c0c0c 0%, #1a1a1a 100%);
            color: #ffffff;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Toggle Button */
        .sidebar-toggle {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            background: rgba(0, 212, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 212, 255, 0.3);
            border-radius: 10px;
            padding: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            background: rgba(0, 212, 255, 0.3);
            transform: scale(1.05);
        }

        .sidebar-toggle i {
            font-size: 24px;
            color: #00d4ff;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .sidebar-header {
            padding: 0 30px 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 30px;
            text-align: center;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: url('https://smktibaliglobalsingaraja.sch.id/wp-content/uploads/2022/12/Logo-PNG-Tanpa-Tulisan-300x300.png') no-repeat center;
            background-size: 50px 50px;
            border-radius: 50%;
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #1a1a1a;
            font-weight: bold;
        }

        .sidebar-header h2 {
            color: #ffffff;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .sidebar-header p {
            color: #cccccc;
            font-size: 12px;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 2px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #cccccc;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(0, 212, 255, 0.1);
            color: #00d4ff;
            border-left-color: #00d4ff;
        }

        .sidebar-menu i {
            margin-right: 12px;
            width: 16px;
            text-align: center;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 12px;
            background: rgba(255, 59, 48, 0.1);
            color: #ff3b30;
            border: 1px solid rgba(255, 59, 48, 0.3);
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .logout-btn:hover {
            background: rgba(255, 59, 48, 0.2);
            transform: translateY(-2px);
        }

        .logout-btn i {
            margin-right: 8px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 30px;
            transition: margin-left 0.3s ease;
        }

        .main-content.full-width {
            margin-left: 0;
        }

        .header {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border-radius: 15px;
            padding: 25px 30px;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .header h1 {
            color: #00d4ff;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .header p {
            color: #cccccc;
            font-size: 14px;
        }

        .controls {
            background: #2d2d2d;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #404040;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .search-box {
            position: relative;
            flex: 1;
            max-width: 400px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            background: #1a1a1a;
            border: 1px solid #404040;
            border-radius: 5px;
            color: #ffffff;
            font-size: 14px;
        }

        .search-box input:focus {
            outline: none;
            border-color: #007bff;
        }

        .search-box i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #cccccc;
        }

        .add-btn {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .add-btn:hover {
            background: #0056b3;
        }

        .table-container {
            background: #2d2d2d;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #404040;
        }

        .table-header {
            background: #404040;
            padding: 15px 20px;
            border-bottom: 1px solid #404040;
        }

        .table-header h3 {
            color: #ffffff;
            font-size: 16px;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 20px;
            text-align: left;
            border-bottom: 1px solid #404040;
        }

        th {
            background: #404040;
            color: #ffffff;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
        }

        td {
            color: #cccccc;
            font-size: 14px;
        }

        tr:hover {
            background: #404040;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .btn-edit, .btn-delete {
            padding: 6px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background: #28a745;
            color: #ffffff;
        }

        .btn-edit:hover {
            background: #218838;
        }

        .btn-delete {
            background: #dc3545;
            color: #ffffff;
        }

        .btn-delete:hover {
            background: #c82333;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
            padding: 20px;
            background: #404040;
        }

        .pagination a, .pagination span {
            padding: 8px 12px;
            background: #2d2d2d;
            color: #cccccc;
            text-decoration: none;
            border-radius: 3px;
            transition: all 0.3s ease;
            border: 1px solid #404040;
            font-size: 12px;
        }

        .pagination a:hover {
            background: #007bff;
            color: #ffffff;
        }

        .pagination .current {
            background: #007bff;
            color: #ffffff;
        }

        .pagination .disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
        }

        .modal-content {
            background: #2d2d2d;
            margin: 5% auto;
            padding: 0;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            border: 1px solid #404040;
        }

        .modal-header {
            background: #404040;
            padding: 20px;
            border-bottom: 1px solid #404040;
            border-radius: 8px 8px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            color: #ffffff;
            font-size: 16px;
            font-weight: 600;
        }

        .modal-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            color: #cccccc;
            margin-bottom: 5px;
            font-weight: 500;
            font-size: 12px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            background: #1a1a1a;
            border: 1px solid #404040;
            border-radius: 3px;
            color: #ffffff;
            font-size: 14px;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #007bff;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .modal-footer {
            padding: 15px 20px;
            border-top: 1px solid #404040;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-cancel {
            background: #6c757d;
            color: #ffffff;
            border: none;
            padding: 8px 16px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: #5a6268;
        }

        .btn-save {
            background: #007bff;
            color: #ffffff;
            border: none;
            padding: 8px 16px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-save:hover {
            background: #0056b3;
        }

        .close {
            color: #cccccc;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close:hover {
            color: #dc3545;
        }

        /* Alert Messages */
        .alert {
            padding: 12px 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-weight: 500;
            font-size: 14px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
            }

            .controls {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                max-width: none;
            }

            table {
                font-size: 12px;
            }

            th, td {
                padding: 8px 12px;
            }

            .modal-content {
                width: 95%;
                margin: 10% auto;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Toggle Button -->
    <div class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </div>

    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo"></div>
                <h2>SMK TI Bali Global</h2>
                <p>Denpasar</p>
            </div>
            <ul class="sidebar-menu">
                <li><a href="?page=siswa" class="<?php echo $page == 'siswa' ? 'active' : ''; ?>"><i class="fas fa-users"></i> Data Siswa</a></li>
                <li><a href="?page=guru" class="<?php echo $page == 'guru' ? 'active' : ''; ?>"><i class="fas fa-chalkboard-teacher"></i> Data Guru</a></li>
                <li><a href="?page=jurusan" class="<?php echo $page == 'jurusan' ? 'active' : ''; ?>"><i class="fas fa-graduation-cap"></i> Data Jurusan</a></li>
                <li><a href="?page=mata_pelajaran" class="<?php echo $page == 'mata_pelajaran' ? 'active' : ''; ?>"><i class="fas fa-book"></i> Mata Pelajaran</a></li>
                <li><a href="?page=ekstrakurikuler" class="<?php echo $page == 'ekstrakurikuler' ? 'active' : ''; ?>"><i class="fas fa-futbol"></i> Ekstrakurikuler</a></li>
            </ul>
            <div class="sidebar-footer">
                <a href="auth/logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content" id="mainContent">
            <div class="header">
                <h1>Dashboard SMK TI Bali Global Denpasar</h1>
                <p>Selamat datang, <?php echo $_SESSION['user_name']; ?>!</p>
            </div>

            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <div class="controls">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari data..." value="<?php echo htmlspecialchars($search); ?>">
                </div>
                <button class="add-btn" onclick="openAddModal()">
                    <i class="fas fa-plus"></i>
                    Tambah <?php echo ucfirst(str_replace('_', ' ', $page)); ?>
                </button>
            </div>

            <div class="table-container">
                <div class="table-header">
                    <h3>Data <?php echo ucfirst(str_replace('_', ' ', $page)); ?></h3>
                </div>
                <table>
                    <thead>
                        <?php if($page == 'siswa'): ?>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Aksi</th>
                            </tr>
                        <?php elseif($page == 'guru'): ?>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Mapel</th>
                                <th>Jabatan</th>
                                <th>Aksi</th>
                            </tr>
                        <?php elseif($page == 'jurusan'): ?>
                            <tr>
                                <th>No</th>
                                <th>Kode Jurusan</th>
                                <th>Nama Jurusan</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        <?php elseif($page == 'mata_pelajaran'): ?>
                            <tr>
                                <th>No</th>
                                <th>Nama Mapel</th>
                                <th>Kelas</th>
                                <th>Guru Pengajar</th>
                                <th>Aksi</th>
                            </tr>
                        <?php elseif($page == 'ekstrakurikuler'): ?>
                            <tr>
                                <th>No</th>
                                <th>Nama Ekstra</th>
                                <th>Jadwal</th>
                                <th>Guru Ekstra</th>
                                <th>Aksi</th>
                            </tr>
                        <?php endif; ?>
                    </thead>
                    <tbody>
                        <?php if(empty($data)): ?>
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 40px; color: #cccccc;">
                                    <i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 15px; display: block;"></i>
                                    Tidak ada data
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($data as $index => $row): ?>
                                <tr>
                                    <td><?php echo $offset + $index + 1; ?></td>
                                    <?php if($page == 'siswa'): ?>
                                        <td><?php echo htmlspecialchars($row['nis']); ?></td>
                                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                        <td><?php echo htmlspecialchars($row['kelas']); ?></td>
                                        <td><?php echo htmlspecialchars($row['jurusan']); ?></td>
                                    <?php elseif($page == 'guru'): ?>
                                        <td><?php echo htmlspecialchars($row['nip']); ?></td>
                                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                        <td><?php echo htmlspecialchars($row['mapel']); ?></td>
                                        <td><?php echo htmlspecialchars($row['jabatan']); ?></td>
                                    <?php elseif($page == 'jurusan'): ?>
                                        <td><?php echo htmlspecialchars($row['kode_jurusan']); ?></td>
                                        <td><?php echo htmlspecialchars($row['nama_jurusan']); ?></td>
                                        <td><?php echo htmlspecialchars($row['keterangan']); ?></td>
                                    <?php elseif($page == 'mata_pelajaran'): ?>
                                        <td><?php echo htmlspecialchars($row['nama_mapel']); ?></td>
                                        <td><?php echo htmlspecialchars($row['kelas']); ?></td>
                                        <td><?php echo htmlspecialchars($row['guru_pengajar']); ?></td>
                                    <?php elseif($page == 'ekstrakurikuler'): ?>
                                        <td><?php echo htmlspecialchars($row['nama_ekstra']); ?></td>
                                        <td><?php echo htmlspecialchars($row['jadwal']); ?></td>
                                        <td><?php echo htmlspecialchars($row['guru_ekstra']); ?></td>
                                    <?php endif; ?>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-edit" onclick="openEditModal(<?php echo $row['id']; ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-delete" onclick="openDeleteModal(<?php echo $row['id']; ?>)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>

                <?php if($total_pages > 1): ?>
                    <div class="pagination">
                        <?php if($page_num > 1): ?>
                            <a href="?page=<?php echo $page; ?>&page_num=<?php echo $page_num - 1; ?>&search=<?php echo urlencode($search); ?>">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        <?php endif; ?>

                        <?php for($i = $start_page; $i <= $end_page; $i++): ?>
                            <?php if($i == $page_num): ?>
                                <span class="current"><?php echo $i; ?></span>
                            <?php else: ?>
                                <a href="?page=<?php echo $page; ?>&page_num=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"><?php echo $i; ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <?php if($page_num < $total_pages): ?>
                            <a href="?page=<?php echo $page; ?>&page_num=<?php echo $page_num + 1; ?>&search=<?php echo urlencode($search); ?>">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Tambah <?php echo ucfirst(str_replace('_', ' ', $page)); ?></h3>
                <span class="close" onclick="closeModal('addModal')">&times;</span>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <input type="hidden" name="action" value="add_<?php echo $page; ?>">
                    <?php if($page == 'siswa'): ?>
                        <div class="form-group">
                            <label for="nis">NIS</label>
                            <input type="text" id="nis" name="nis" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <select id="kelas" name="kelas" required>
                                <option value="">Pilih Kelas</option>
                                <option value="X TKJ">X TKJ</option>
                                <option value="XI TKJ">XI TKJ</option>
                                <option value="XII TKJ">XII TKJ</option>
                                <option value="X MM">X MM</option>
                                <option value="XI MM">XI MM</option>
                                <option value="XII MM">XII MM</option>
                                <option value="X RPL">X RPL</option>
                                <option value="XI RPL">XI RPL</option>
                                <option value="XII RPL">XII RPL</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <select id="jurusan" name="jurusan" required>
                                <option value="">Pilih Jurusan</option>
                                <option value="Teknik Komputer dan Jaringan">Teknik Komputer dan Jaringan</option>
                                <option value="Multimedia">Multimedia</option>
                                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                            </select>
                        </div>
                    <?php elseif($page == 'guru'): ?>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" id="nip" name="nip" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="mapel">Mata Pelajaran</label>
                            <input type="text" id="mapel" name="mapel" required>
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <select id="jabatan" name="jabatan" required>
                                <option value="">Pilih Jabatan</option>
                                <option value="Kepala Sekolah">Kepala Sekolah</option>
                                <option value="Wakil Kepala Sekolah">Wakil Kepala Sekolah</option>
                                <option value="Guru Senior">Guru Senior</option>
                                <option value="Guru">Guru</option>
                            </select>
                        </div>
                    <?php elseif($page == 'jurusan'): ?>
                        <div class="form-group">
                            <label for="kode_jurusan">Kode Jurusan</label>
                            <input type="text" id="kode_jurusan" name="kode_jurusan" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_jurusan">Nama Jurusan</label>
                            <input type="text" id="nama_jurusan" name="nama_jurusan" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea id="keterangan" name="keterangan" required></textarea>
                        </div>
                    <?php elseif($page == 'mata_pelajaran'): ?>
                        <div class="form-group">
                            <label for="nama_mapel">Nama Mata Pelajaran</label>
                            <input type="text" id="nama_mapel" name="nama_mapel" required>
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <select id="kelas" name="kelas" required>
                                <option value="">Pilih Kelas</option>
                                <option value="X TKJ">X TKJ</option>
                                <option value="XI TKJ">XI TKJ</option>
                                <option value="XII TKJ">XII TKJ</option>
                                <option value="X MM">X MM</option>
                                <option value="XI MM">XI MM</option>
                                <option value="XII MM">XII MM</option>
                                <option value="X RPL">X RPL</option>
                                <option value="XI RPL">XI RPL</option>
                                <option value="XII RPL">XII RPL</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="guru_pengajar">Guru Pengajar</label>
                            <input type="text" id="guru_pengajar" name="guru_pengajar" required>
                        </div>
                    <?php elseif($page == 'ekstrakurikuler'): ?>
                        <div class="form-group">
                            <label for="nama_ekstra">Nama Ekstrakurikuler</label>
                            <input type="text" id="nama_ekstra" name="nama_ekstra" required>
                        </div>
                        <div class="form-group">
                            <label for="jadwal">Jadwal</label>
                            <input type="text" id="jadwal" name="jadwal" placeholder="Contoh: Senin 15:00" required>
                        </div>
                        <div class="form-group">
                            <label for="guru_ekstra">Guru Ekstrakurikuler</label>
                            <input type="text" id="guru_ekstra" name="guru_ekstra" required>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('addModal')">Batal</button>
                    <button type="submit" class="btn-save">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit <?php echo ucfirst(str_replace('_', ' ', $page)); ?></h3>
                <span class="close" onclick="closeModal('editModal')">&times;</span>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <input type="hidden" name="action" value="edit_<?php echo $page; ?>">
                    <input type="hidden" name="<?php echo $page; ?>_id" id="edit_id">
                    <?php if($page == 'siswa'): ?>
                        <div class="form-group">
                            <label for="edit_nis">NIS</label>
                            <input type="text" id="edit_nis" name="nis" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_nama">Nama</label>
                            <input type="text" id="edit_nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_kelas">Kelas</label>
                            <select id="edit_kelas" name="kelas" required>
                                <option value="">Pilih Kelas</option>
                                <option value="X TKJ">X TKJ</option>
                                <option value="XI TKJ">XI TKJ</option>
                                <option value="XII TKJ">XII TKJ</option>
                                <option value="X MM">X MM</option>
                                <option value="XI MM">XI MM</option>
                                <option value="XII MM">XII MM</option>
                                <option value="X RPL">X RPL</option>
                                <option value="XI RPL">XI RPL</option>
                                <option value="XII RPL">XII RPL</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_jurusan">Jurusan</label>
                            <select id="edit_jurusan" name="jurusan" required>
                                <option value="">Pilih Jurusan</option>
                                <option value="Teknik Komputer dan Jaringan">Teknik Komputer dan Jaringan</option>
                                <option value="Multimedia">Multimedia</option>
                                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                            </select>
                        </div>
                    <?php elseif($page == 'guru'): ?>
                        <div class="form-group">
                            <label for="edit_nip">NIP</label>
                            <input type="text" id="edit_nip" name="nip" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_nama">Nama</label>
                            <input type="text" id="edit_nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_mapel">Mata Pelajaran</label>
                            <input type="text" id="edit_mapel" name="mapel" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_jabatan">Jabatan</label>
                            <select id="edit_jabatan" name="jabatan" required>
                                <option value="">Pilih Jabatan</option>
                                <option value="Kepala Sekolah">Kepala Sekolah</option>
                                <option value="Wakil Kepala Sekolah">Wakil Kepala Sekolah</option>
                                <option value="Guru Senior">Guru Senior</option>
                                <option value="Guru">Guru</option>
                            </select>
                        </div>
                    <?php elseif($page == 'jurusan'): ?>
                        <div class="form-group">
                            <label for="edit_kode_jurusan">Kode Jurusan</label>
                            <input type="text" id="edit_kode_jurusan" name="kode_jurusan" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_nama_jurusan">Nama Jurusan</label>
                            <input type="text" id="edit_nama_jurusan" name="nama_jurusan" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_keterangan">Keterangan</label>
                            <textarea id="edit_keterangan" name="keterangan" required></textarea>
                        </div>
                    <?php elseif($page == 'mata_pelajaran'): ?>
                        <div class="form-group">
                            <label for="edit_nama_mapel">Nama Mata Pelajaran</label>
                            <input type="text" id="edit_nama_mapel" name="nama_mapel" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_kelas">Kelas</label>
                            <select id="edit_kelas" name="kelas" required>
                                <option value="">Pilih Kelas</option>
                                <option value="X TKJ">X TKJ</option>
                                <option value="XI TKJ">XI TKJ</option>
                                <option value="XII TKJ">XII TKJ</option>
                                <option value="X MM">X MM</option>
                                <option value="XI MM">XI MM</option>
                                <option value="XII MM">XII MM</option>
                                <option value="X RPL">X RPL</option>
                                <option value="XI RPL">XI RPL</option>
                                <option value="XII RPL">XII RPL</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_guru_pengajar">Guru Pengajar</label>
                            <input type="text" id="edit_guru_pengajar" name="guru_pengajar" required>
                        </div>
                    <?php elseif($page == 'ekstrakurikuler'): ?>
                        <div class="form-group">
                            <label for="edit_nama_ekstra">Nama Ekstrakurikuler</label>
                            <input type="text" id="edit_nama_ekstra" name="nama_ekstra" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_jadwal">Jadwal</label>
                            <input type="text" id="edit_jadwal" name="jadwal" placeholder="Contoh: Senin 15:00" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_guru_ekstra">Guru Ekstrakurikuler</label>
                            <input type="text" id="edit_guru_ekstra" name="guru_ekstra" required>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('editModal')">Batal</button>
                    <button type="submit" class="btn-save">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Hapus <?php echo ucfirst(str_replace('_', ' ', $page)); ?></h3>
                <span class="close" onclick="closeModal('deleteModal')">&times;</span>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <input type="hidden" name="action" value="delete_<?php echo $page; ?>">
                    <input type="hidden" name="<?php echo $page; ?>_id" id="delete_id">
                    <p style="color: #cccccc; font-size: 14px; text-align: center;">
                        <i class="fas fa-exclamation-triangle" style="color: #dc3545; font-size: 48px; margin-bottom: 15px; display: block;"></i>
                        Apakah Anda yakin ingin menghapus data ini?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('deleteModal')">Batal</button>
                    <button type="submit" class="btn-save" style="background: #dc3545;">Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Sidebar toggle functionality
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            sidebar.classList.toggle('hidden');
            
            if (sidebar.classList.contains('hidden')) {
                mainContent.classList.add('full-width');
            } else {
                mainContent.classList.remove('full-width');
            }
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                const search = this.value;
                const currentPage = '<?php echo $page; ?>';
                window.location.href = `?page=${currentPage}&search=${encodeURIComponent(search)}`;
            }
        });

        // Modal functions
        function openAddModal() {
            document.getElementById('addModal').style.display = 'block';
        }

        function openEditModal(id) {
            // Fetch data and populate form
            fetch(`get_data.php?page=<?php echo $page; ?>&id=${id}`)
                .then(response => response.json())
                .then(data => {
                    <?php if($page == 'siswa'): ?>
                        document.getElementById('edit_id').value = data.id;
                        document.getElementById('edit_nis').value = data.nis;
                        document.getElementById('edit_nama').value = data.nama;
                        document.getElementById('edit_kelas').value = data.kelas;
                        document.getElementById('edit_jurusan').value = data.jurusan;
                    <?php elseif($page == 'guru'): ?>
                        document.getElementById('edit_id').value = data.id;
                        document.getElementById('edit_nip').value = data.nip;
                        document.getElementById('edit_nama').value = data.nama;
                        document.getElementById('edit_mapel').value = data.mapel;
                        document.getElementById('edit_jabatan').value = data.jabatan;
                    <?php elseif($page == 'jurusan'): ?>
                        document.getElementById('edit_id').value = data.id;
                        document.getElementById('edit_kode_jurusan').value = data.kode_jurusan;
                        document.getElementById('edit_nama_jurusan').value = data.nama_jurusan;
                        document.getElementById('edit_keterangan').value = data.keterangan;
                    <?php elseif($page == 'mata_pelajaran'): ?>
                        document.getElementById('edit_id').value = data.id;
                        document.getElementById('edit_nama_mapel').value = data.nama_mapel;
                        document.getElementById('edit_kelas').value = data.kelas;
                        document.getElementById('edit_guru_pengajar').value = data.guru_pengajar;
                    <?php elseif($page == 'ekstrakurikuler'): ?>
                        document.getElementById('edit_id').value = data.id;
                        document.getElementById('edit_nama_ekstra').value = data.nama_ekstra;
                        document.getElementById('edit_jadwal').value = data.jadwal;
                        document.getElementById('edit_guru_ekstra').value = data.guru_ekstra;
                    <?php endif; ?>
                    document.getElementById('editModal').style.display = 'block';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat data!');
                });
        }

        function openDeleteModal(id) {
            document.getElementById('delete_id').value = id;
            document.getElementById('deleteModal').style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>