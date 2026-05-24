<?php
session_start();
require_once 'config/db.php';  // เรียกไฟล์เชื่อมต่อฐานข้อมูล


if (isset($_POST['postcomment'])) {
    // ตรวจสอบข้อมูลจากฟอร์ม
    $post_id = $_POST['post_id'];
    $com_detail = $_POST['comment'];
    if(isset($_SESSION['admin_login'])){
        $user_id = $_SESSION['admin_login'];
    }else if(isset($_SESSION['user_login'])){
        $user_id = $_SESSION['user_login'];
    }

    unset($_SESSION['error']);
    // ตรวจสอบว่าไม่มีช่องว่าง
    if(empty($com_detail)){
        $_SESSION['error'] = 'กรุณาพิมพ์คอมเม้นต์';
        header('Location: postDetail.php?post_id='.$post_id);
        exit();
    }
        try {
            $stmt = $conn->prepare("INSERT INTO comments (comment_id, com_detail, post_id, user_id) VALUES (:comment_id, :com_detail, :post_id , :user_id)");
            $stmt->bindParam(":comment_id", $comment_id);
            $stmt->bindParam(":com_detail", $com_detail);
            $stmt->bindParam(":post_id", $post_id);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->execute();
            // บันทึกโพสต์ลงฐานข้อมูล
            if (!isset($_SESSION['error'])){
                $_SESSION['success'] = 'คอมเม้นต์ถูกโพสต์เรียบร้อยแล้ว';
                header('Location: postDetail.php?post_id='.$post_id);
                exit(); // หน้าแสดงผลโพสต์
            } else {
                $_SESSION['error'] = 'เกิดข้อผิดพลาดในการโพสต์คอมเม้นต์';
                header("location: postDetail.php?post_id=".$post_id);
                exit();
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
?>