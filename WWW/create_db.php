<?php
session_start();
require_once 'config/db.php';  // เรียกไฟล์เชื่อมต่อฐานข้อมูล


if (isset($_POST['post'])) {
    // ตรวจสอบข้อมูลจากฟอร์ม
    $category_id = $_POST['category_id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    if(isset($_SESSION['admin_login'])){
        $user_id = $_SESSION['admin_login'];
    }else if(isset($_SESSION['user_login'])){
        $user_id = $_SESSION['user_login'];
    }
    // ตรวจสอบว่าไม่มีช่องว่าง
    if(empty($category_id)){
        $_SESSION['error'] = 'กรุณาใส่หัวข้อ';
        header('Location: create.php');
        exit();
    }else if(empty($title)) {
        $_SESSION['error'] = 'กรุณาใส่หัวข้อ';
        header('Location: create.php');
        exit();
    }else if(empty($content)){
        $_SESSION['error'] = 'กรุณาใส่รายละเอียด';
        header('Location: create.php');
        exit();
    }
    echo $user_id;
        try {
            $stmt = $conn->prepare("INSERT INTO posts (category_id, post_title, post_content, user_id) VALUES (:category_id, :post_title, :post_content , :user_id)");
            $stmt->bindParam(":category_id", $category_id);
            $stmt->bindParam(":post_title", $title);
            $stmt->bindParam(":post_content", $content);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->execute();
            // บันทึกโพสต์ลงฐานข้อมูล
            if (!isset($_SESSION['error'])){
                $_SESSION['success'] = 'โพสต์ถูกสร้างเรียบร้อยแล้ว';
                header('Location: create.php');
                exit(); // หน้าแสดงผลโพสต์
            } else {
                $_SESSION['error'] = 'เกิดข้อผิดพลาดในการสร้างโพสต์';
                header("location: create.php");
                exit();
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
?>