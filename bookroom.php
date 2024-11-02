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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms - So Sad So Stay</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Comic Sans MS", cursive, sans-serif;
        }

        body {
            background-color: #f0e6f0;
        }

        .top-nav {
            background-color: #584b5f;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .logo {
            font-size: 1.5rem;
            color: white;
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

        .booking-button {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 5px;
        }

        .username {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sub-nav {
            background-color: #6c5f73;
            display: flex;
            justify-content: space-between;
            padding: 0;
        }

        .sub-nav a {
            flex: 1;
            color: white;
            text-decoration: none;
            padding: 1rem;
            text-align: center;
            transition: background-color 0.3s;
        }

        .sub-nav a:hover {
            background-color: #7d6e84;
        }

        .rooms-title {
            text-align: center;
            font-size: 2.5rem;
            padding: 2rem;
            background-color: #e6dde6;
        }

        .rooms-container {
            display: flex;
            justify-content: center;
            gap: 2rem;
            padding: 2rem;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
        }

        .room-card {
            background: white;
            border-radius: 10px;
            padding: 1rem;
            width: 300px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .room-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .room-title {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .room-details {
            list-style: none;
            margin-bottom: 1rem;
        }

        .room-details li {
            margin-bottom: 0.3rem;
        }

        .availability {
            color: #666;
            margin-bottom: 1rem;
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
            transition: background-color 0.3s;
        }

        .hover:hover {
            background-color: #d6cccc;
        }

        .book-now:hover {
            background-color: #b3a0b3;
        }
    </style>
</head>

<body>
    <nav class="top-nav">
        <a href="./" class="logo">So Sad So Stay</a>
        <div class="nav-links">
            <a class="hover" href="./">Home</a>
            <a class="hover" href="./allroom.php">Rooms</a>
            <a class="hover" href="#">Booking</a>
            <a class="hover" href="#" class="username">
                <?php echo $customer['username']; ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </a>
        </div>
    </nav>

    <div class="sub-nav">
        <a class="hover" href="#">Book a room</a>
        <a class="hover" href="./bookhistory.php">Booking History</a>
    </div>

    <h1 class="rooms-title">Rooms</h1>

    <div class="rooms-container">
        <div class="room-card">
            <img src="./image/small_room.jpg" alt="Small Room" class="room-image">
            <h2 class="room-title">Small Room</h2>
            <ul class="room-details">
                <li>1 Bed</li>
                <li>High-speed internet</li>
                <li>Breakfast coffee or tea</li>
                <li>Sunlight in the morning</li>
            </ul>
            <p class="availability">available : 10 rooms</p>
            <a href="./roomdetail.php" class="book-now">Book Now</a>
        </div>
    </div>
</body>

</html>
