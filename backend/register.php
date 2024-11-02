<?php
session_start();
require_once 'config/db.php';

if (isset($_POST["create_account"])) {
    // Sanitize and validate input
    $firstname = trim($_POST['firstName']);
    $lastname = trim($_POST['lastName']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $position = $_POST['position'];
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

    // Validation checks
    if (empty($firstname)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อ';
        header('location: ../registerPage.php');
        exit();
    }

    if (empty($lastname)) {
        $_SESSION['error'] = 'กรุณากรอกนามสกุล';
        header('location: ../registerPage.php');
        exit();
    }

    if (empty($username)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อผู้ใช้';
        header('location: ../registerPage.php');
        exit();
    }

    if (empty($password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header('location: ../registerPage.php');
        exit();
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'กรุณากรอกอีเมลให้ถูกต้อง';
        header('location: ../registerPage.php');
        exit();
    }

    if (strlen($password) < 8 || strlen($password) > 20) {
        $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 8 ถึง 20 ตัวอักษร';
        header('location: ../registerPage.php');
        exit();
    }

    try {
        // Check if username exists
        $check_username = $db->prepare('SELECT username FROM users WHERE username = :username');
        $check_username->bindParam(':username', $username, PDO::PARAM_STR);
        $check_username->execute();

        if ($check_username->rowCount() > 0) {
            $_SESSION['warning'] = "มีชื่อผู้ใช้นี้อยู่ในระบบแล้ว <a href='../loginPage.php'>คลิกที่นี้</a> เพื่อเข้าสู่ระบบ";
            header('location: ../registerPage.php');
            exit();
        }

        // Insert new user
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users (firstname, lastname, username, password, position, email, created_at)
                             VALUES (:firstname, :lastname, :username, :password, :position, :email, NOW())");

        $stmt->bindParam(":firstname", $firstname, PDO::PARAM_STR);
        $stmt->bindParam(":lastname", $lastname, PDO::PARAM_STR);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":password", $passwordHash, PDO::PARAM_STR);
        $stmt->bindParam(":position", $position, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว <a href='../loginPage.php'>คลิกที่นี่</a> เพื่อเข้าสู่ระบบ";
            header('location: ../registerPage.php');
            exit();
        } else {
            throw new PDOException("Error inserting user");
        }
        $db = null;
    } catch (PDOException $e) {
        $_SESSION['error'] = "เกิดข้อผิดพลาด";
        header('location: ../registerPage.php');
        $db = null;
        exit();
    }
    $db = null;
}
