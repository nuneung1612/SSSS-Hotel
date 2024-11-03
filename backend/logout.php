<?php
session_start();
if (isset($_SESSION['admin_login'])) {
    unset($_SESSION['admin_login']);
}

if (isset($_SESSION['cus_login'])) {
    unset($_SESSION['cus_login']);
}

// ส่งผู้ใช้กลับไปยังหน้าแรก
header('location: ../');
exit();
