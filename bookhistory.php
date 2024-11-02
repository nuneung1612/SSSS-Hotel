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
<html>

<head>
    <title>So Sad So Stay - Booking History</title>
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

        .booking-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #f0f0f0;
            border-radius: 10px;
            overflow: hidden;
        }

        .booking-table th {
            background-color: #a9a3b3;
            color: black;
            padding: 12px;
            text-align: left;
        }

        .booking-table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        .view-button {
            background-color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
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

        .hover:hover {
            background-color: #d6cccc;
        }
    </style>
</head>

<body>
    <nav class="top-nav">
        <a href="./" class="logo">So Sad So Stay</a>
        <div class="nav-links">
            <a class="hover" href="./">Home</a>
            <a class="hover" href="./allroom.php">Rooms</a>
            <a class="hover" href="./bookroom.php">Booking</a>
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
        <a href="./roomdetail.php">Book a room</a>
        <a href="#">Booking History</a>
    </div>

    <table class="booking-table">
        <thead>
            <tr>
                <th>BookingID</th>
                <th>RoomID</th>
                <th>Date</th>
                <th>extension</th>
                <th>quantity</th>
                <th>cost</th>
                <th>view detail</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // while ($row = $result->fetch_assoc()) {
            //     echo "<tr>";
            //     echo "<td>" . htmlspecialchars($row['BookingID']) . "</td>";
            //     echo "<td>" . htmlspecialchars($row['RoomID']) . "</td>";
            //     echo "<td>" . htmlspecialchars($row['CheckIn']) . " - " . htmlspecialchars($row['CheckOut']) . "</td>";
            //     echo "<td>" . htmlspecialchars($row['Extensions']) . "</td>";
            //     echo "<td>" . htmlspecialchars($row['Quantity']) . " room</td>";
            //     echo "<td>" . htmlspecialchars($row['Cost']) . " $</td>";
            //     echo "<td><button class='view-button' onclick='viewBooking(" . $row['BookingID'] . ")'>view</button></td>";
            //     echo "</tr>";
            // }
            ?>
        </tbody>
    </table>

    <script>
        function viewBooking(bookingId) {
            // Add your viewing logic here
            window.location.href = 'booking-details.php?id=' + bookingId;
        }
    </script>
</body>

</html>
