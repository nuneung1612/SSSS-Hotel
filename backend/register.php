<?php
session_start();
require_once 'config/db.php';
?>
<?php
if (isset($_POST["create_account"])) {
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $position = $_POST['position'];
    $email = $_POST['email'];
    echo $username;
    if (empty($firstname)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อ';
        header('location: ../registerPage.php');
    } else if (empty($lastname)) {
        $_SESSION['error'] = 'กรุณากรอกนามกสุล';
        header('location: ../registerPage.php');
    } elseif (empty($username)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อผู้ใช้';
        header('location: ../registerPage.php');
    } elseif (empty($password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header('location: ../registerPage.php');
    } elseif (empty($email)) {
        $_SESSION['error'] = 'กรุณากรอกอีเมล';
        header('location: ../registerPage.php');
    } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 8) {
        $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 8 ถึง 20 ตัวอักษร';
        header('location: ../registerPage.php');
    } else {
        $check_username_cus = $db->prepare('SELECT username FROM user WHERE username = :username');
        $check_username_cus->bindParam(':username', $username);
        $result_cus = $check_username_cus->execute();

        $row_cus = $result_cus->fetchArray(SQLITE3_ASSOC);
        var_dump($row_cus);
        print_r($row_cus);
        if ($row_cus['username'] == $username) {
            $_SESSION['warning'] = "มีชื่อผู้ใช้นี้อยู่ในระบบเเล้ว <a href='../loginPage.php'>คลิกที่นี้</a> เพื่อเข้าสู่ระบบ";
            header('location: ../registerPage.php');
            if (!isset($_SESSION['error'])) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $db->prepare("INSERT INTO user (firstname, lastname, username, password, position, email)
                                              VALUES(:firstname, :lastname, :username, :password, :position, :email)");
                $stmt->bindParam(":firstname", $firstname);
                $stmt->bindParam(":lastname", $lastname);
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":password", $passwordHash);
                $stmt->bindParam(":position", $position);
                $stmt->bindParam(":email", $email);
                $stmt->execute();

                $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยเเล้ว <a href='../loginPage.php'>คลิกที่นี่</a> เพื่อเข้าสู่ระบบ";
                header('location: ../registerPage.php');
            } else {
                $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                header('location: ../registerPage.php');
            }
        } else {
            if (!isset($_SESSION['error'])) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $db->prepare("INSERT INTO user (firstname, lastname, username, password, position, email)
                                              VALUES(:firstname, :lastname, :username, :password, :position, :email)");
                $stmt->bindParam(":firstname", $firstname);
                $stmt->bindParam(":lastname", $lastname);
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":password", $passwordHash);
                $stmt->bindParam(":position", $position);
                $stmt->bindParam(":email", $email);
                $stmt->execute();

                $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยเเล้ว <a href='../loginPage.php'>คลิกที่นี่</a> เพื่อเข้าสู่ระบบ";
                header('location: ../registerPage.php');
            } else {
                $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                header('location: ../registerPage.php');
            }
        }
        $db->close();
    }
}
