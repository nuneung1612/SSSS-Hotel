<?php
session_start();
require_once './config/db.php';

if (isset($_POST["sign_in"])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validate input
    if (empty($username)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อ';
        header('location: ../loginPage.php');
        exit();
    }

    if (empty($password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header('location: ../loginPage.php');
        exit();
    }

    try {
        // Check user
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Login successful
            switch ($user['position']) {
                case 'c':
                    $_SESSION['cus_login'] = $user['id'];
                    header('location: ../bookroom.php');
                    break;
                case 'a':
                    $_SESSION['admin_login'] = $user['id'];
                    header('location: ../adminhome.php');
                    break;
                default:
                    $_SESSION['error'] = 'ตำแหน่งผู้ใช้ไม่ถูกต้อง';
                    header('location: ../loginPage.php');
            }
        } else {
            $_SESSION['error'] = 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
            header('location: ../loginPage.php');
        }
        $db = null;
    } catch (PDOException $e) {
        $_SESSION['error'] = 'เกิดข้อผิดพลาดในระบบ: ' . $e->getMessage();
        header('location: ../loginPage.php');
        $db = null;
    }
    $db = null;
    exit();
}
