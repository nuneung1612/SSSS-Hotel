<?php
session_start();
require_once './config/db.php';
?>
<?php
if (isset($_POST["sign_in"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (empty($username)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อ';
        header('location: ../loginPage.php');
    } elseif (empty($password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header('location: ../loginPage.php');
    } else {

        //check customer
        $check_data_cus = $db->prepare('SELECT * FROM user WHERE username = :username');
        $check_data_cus->bindParam(':username', $username);
        $result_cus = $check_data_cus->execute();

        $rowCount_cus = 0;

        if ($result_cus) {
            while ($row_cus = $result_cus->fetchArray(SQLITE3_ASSOC)) {
                $rowCount_cus++;
            }
        }
        $row_cus = $result_cus->fetchArray(SQLITE3_ASSOC);
        if ($rowCount_cus > 0) {
            if ($username === $row_cus['username']) {
                if (password_verify($password, $row_cus['password'])) {
                    if ($row_cus['position'] == 'c') {
                        $_SESSION['cus_login'] = $row_cus['id'];
                        header('location: ../bookroom.php');
                    }
                    if ($row_cus['position'] == 'a') {
                        $_SESSION['admin_login'] = $row_cus['id'];
                        header('location: ../adminhome.php');
                    }
                } else {
                    $_SESSION['error'] = 'รหัสผ่านผิด';
                    header('location: ../loginPage.php');
                }
            } else {
                $_SESSION['error'] = 'ชื่อผู้ใช้ผิด';
                header('location: ../loginPage.php');
            }
        } else {
            $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
            header('location: ../loginPage.php');
        }
    }
    $db->close();
}
?>

