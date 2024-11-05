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

    // Validation checks with specific error messages
    $errors = [];

    if (empty($firstname)) {
        $errors[] = 'กรุณากรอกชื่อ';
    }

    if (empty($lastname)) {
        $errors[] = 'กรุณากรอกนามสกุล';
    }

    if (empty($username)) {
        $errors[] = 'กรุณากรอกชื่อผู้ใช้';
    }

    if (empty($password)) {
        $errors[] = 'กรุณากรอกรหัสผ่าน';
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'กรุณากรอกอีเมลให้ถูกต้อง';
    }

    if (strlen($password) < 8 || strlen($password) > 20) {
        $errors[] = 'รหัสผ่านต้องมีความยาวระหว่าง 8 ถึง 20 ตัวอักษร';
    }

    // If there are validation errors, redirect back with all errors
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('location: ../registerPage.php');
        exit();
    }

    try {
        // Begin transaction
        $db->beginTransaction();

        // Check if username exists
        $check_username = $db->prepare('SELECT username FROM users WHERE username = :username');
        $check_username->bindParam(':username', $username, PDO::PARAM_STR);
        $check_username->execute();

        if ($check_username->rowCount() > 0) {
            $_SESSION['warning'] = "มีชื่อผู้ใช้นี้อยู่ในระบบแล้ว <a href='../loginPage.php'>คลิกที่นี้</a> เพื่อเข้าสู่ระบบ";
            header('location: ../registerPage.php');
            exit();
        }

        // Check if email exists
        $check_email = $db->prepare('SELECT email FROM users WHERE email = :email');
        $check_email->bindParam(':email', $email, PDO::PARAM_STR);
        $check_email->execute();

        if ($check_email->rowCount() > 0) {
            $_SESSION['warning'] = "มีอีเมลนี้อยู่ในระบบแล้ว";
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

        $stmt->execute();

        // Commit transaction
        $db->commit();

        $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว <a href='../loginPage.php'>คลิกที่นี่</a> เพื่อเข้าสู่ระบบ";
        header('location: ../registerPage.php');
        exit();
    } catch (PDOException $e) {
        // Rollback transaction on error
        $db->rollBack();

        // Log the error
        error_log("Registration Error: " . $e->getMessage());

        $_SESSION['error'] = "เกิดข้อผิดพลาด: " . $e->getMessage();
        header('location: ../registerPage.php');
        exit();
    } finally {
        $db = null;
    }
}
