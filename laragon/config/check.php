<?php 
    session_start();
    require_once 'db.php';
    if(!isset($_SESSION['admin_login']) && !isset($_SESSION['user_login'])){
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
        header('location: signin.php');
    }
?>