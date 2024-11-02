<?php
session_start();
require_once './backend/config/db.php';

if (isset($_SESSION['cus_login'])) {
    $cusid = $_SESSION['cus_login'];

    try {
        $check_cus = $db->prepare('SELECT * FROM users WHERE id = :id');
        $check_cus->bindParam(':id', $cusid, PDO::PARAM_INT);
        $check_cus->execute();

        $customer = $check_cus->fetch(PDO::FETCH_ASSOC);

        if ($customer) {
            $_SESSION['cus_login_username'] = $customer['username'];
        } else {
            $_SESSION['error'] = 'ไม่พบข้อมูลผู้ใช้';
            header('location: ./loginPage.php');
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล';
        header('location: ./loginPage.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
    header('location: ./loginPage.php');
    exit();
}

// Close database connection
$db = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rooms - So Sad So Stay</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Comic Sans MS", cursive, sans-serif;
        }

        body {
            background-color: #fff;
        }

        .top-nav {
            background-color: #584b5f;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            color: white;
            font-size: 1.5rem;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
        }

        .hover:hover {
            background-color: #d6cccc;
        }

        .nav-links .rooms {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 5px;
        }

        .book-now-nav {
            color: #584b5f;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
        }

        .header {
            padding: 2rem;
            text-align: center;
        }

        .header h1 {
            font-size: 3.5rem;
            margin-bottom: 0.5rem;
        }

        .header p {
            color: #000000;
        }

        .book-now {
            background-color: #c4b1c4;
            color: black;
            padding: 0.5rem 2rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background-color 0.3s;
        }

        .hero-section {
            margin: auto;
            text-align: center;
            background-color: rgb(255, 255, 255);
            background-image: url("./image/home.jpg");
            padding-top: auto;
            padding-bottom: 650px;
            background-repeat: no-repeat;
            background-size: cover;
            background-blend-mode: multiply;
        }

        .book-now:hover {
            background-color: #ffffff;
        }
    </style>
</head>

<body>
    <nav class="top-nav">
        <a href="./" class="logo">So Sad So Stay</a>
        <div class="nav-links">
            <a class="hover" href="./index.php">Home</a>
            <a class="hover" href="./allroom.php">Rooms</a>
            <a class="hover" href="./bookroom.php" class="book-now-nav">Book Now</a>
        </div>
    </nav>
    <div class="hero-section">
        <div class="header">
            <h1>So Sad So Stay Hotel</h1>
            <p>Welcome to The So Sad So Stay Hotel</p>
            <p>
                Only on our Official Website will you find THE BEST Hotel Guranteed
                for your holiday.
            </p>
        </div>
    </div>
</body>

</html>
