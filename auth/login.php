<?php
session_start();
require_once __DIR__ . '/../models/user.php';
require_once __DIR__ . '/../config/database.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    
    $user = new User($db);
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if($user->login($email, $password)) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->nama;
        $_SESSION['user_email'] = $user->email;
        header('Location: ../dashboard.php');
        exit();
    } else {
        $_SESSION['error'] = 'Email atau password salah';
        header('Location: ../login.php');
        exit();
    }
} else {
    header('Location: ../login.php');
    exit();
}
?>
