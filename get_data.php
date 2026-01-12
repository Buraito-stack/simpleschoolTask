<?php
session_start();

// Check authentication
if(!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

require_once 'models/siswa.php';
require_once 'models/guru.php';
require_once 'models/jurusan.php';
require_once 'models/mata_pelajaran.php';
require_once 'models/ekstrakurikuler.php';
require_once 'config/database.php';

$page = isset($_GET['page']) ? $_GET['page'] : '';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if(empty($page) || $id <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid parameters']);
    exit();
}

try {
    $database = new Database();
    $db = $database->getConnection();
    
    switch($page) {
        case 'siswa':
            $siswa = new Siswa($db);
            if($siswa->getById($id)) {
                echo json_encode([
                    'id' => $siswa->id,
                    'nis' => $siswa->nis,
                    'nama' => $siswa->nama,
                    'kelas' => $siswa->kelas,
                    'jurusan' => $siswa->jurusan
                ]);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Data not found']);
            }
            break;
            
        case 'guru':
            $guru = new Guru($db);
            if($guru->getById($id)) {
                echo json_encode([
                    'id' => $guru->id,
                    'nip' => $guru->nip,
                    'nama' => $guru->nama,
                    'mapel' => $guru->mapel,
                    'jabatan' => $guru->jabatan
                ]);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Data not found']);
            }
            break;
            
        case 'jurusan':
            $jurusan = new Jurusan($db);
            if($jurusan->getById($id)) {
                echo json_encode([
                    'id' => $jurusan->id,
                    'kode_jurusan' => $jurusan->kode_jurusan,
                    'nama_jurusan' => $jurusan->nama_jurusan,
                    'keterangan' => $jurusan->keterangan
                ]);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Data not found']);
            }
            break;
            
        case 'mata_pelajaran':
            $mapel = new MataPelajaran($db);
            if($mapel->getById($id)) {
                echo json_encode([
                    'id' => $mapel->id,
                    'nama_mapel' => $mapel->nama_mapel,
                    'kelas' => $mapel->kelas,
                    'guru_pengajar' => $mapel->guru_pengajar
                ]);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Data not found']);
            }
            break;
            
        case 'ekstrakurikuler':
            $ekstra = new Ekstrakurikuler($db);
            if($ekstra->getById($id)) {
                echo json_encode([
                    'id' => $ekstra->id,
                    'nama_ekstra' => $ekstra->nama_ekstra,
                    'jadwal' => $ekstra->jadwal,
                    'guru_ekstra' => $ekstra->guru_ekstra
                ]);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Data not found']);
            }
            break;
            
        default:
            http_response_code(400);
            echo json_encode(['error' => 'Invalid page']);
    }
    
} catch(Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error']);
}
?>
