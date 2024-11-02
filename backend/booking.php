<?php
session_start();
require_once './config/db.php';

if (isset($_POST["book"])) {
    // $insert = "INSERT INTO `booking` (`booking_id`, `customer_id`, `room_id`, `date`, `quantity`, `cost`) VALUES (NULL, 3, 1, '04/11/2024', 1, 1234);";
    $cusid = $_SESSION['cus_login'];
    $room_id = 1;
    $date_id = "05/11/2024 - 06/11/2024";
    $quantity = 1;
    $cost = 1234;
    $stmt = $db->prepare("INSERT INTO booking (customer_id, room_id, date, quantity, cost)
                             VALUES ( :customer_id, :room_id, :date, :quantity, :cost)");

    $stmt->bindParam(":customer_id", $cusid, PDO::PARAM_INT);
    $stmt->bindParam(":room_id", $room_id, PDO::PARAM_INT);
    $stmt->bindParam(":date", $date_id, PDO::PARAM_STR);
    $stmt->bindParam(":quantity", $quantity, PDO::PARAM_INT);
    $stmt->bindParam(":cost", $cost, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว <a href='../loginPage.php'>คลิกที่นี่</a> เพื่อเข้าสู่ระบบ";
        header('location: ../payments.php');
        exit();
    } else {
        throw new PDOException("Error inserting user");
    }



}

?>