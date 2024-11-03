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
        $book_his = $db->prepare('SELECT * FROM booking WHERE customer_id = :id');
        $book_his->bindParam(':id', $cusid, PDO::PARAM_INT);
        $book_his->execute();
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
            <a id="account" class="hover" href="../backend/logout.php">
                <?php echo $customer['username']; ?>
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
                <th>quantity</th>
                <th>cost</th>
                <th>view detail</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($book = $book_his->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($book['booking_id']) . "</td>";
                echo "<td>" . htmlspecialchars($book['room_id']) . "  </td>";
                echo "<td>" . htmlspecialchars($book['date']) . "</td>";
                echo "<td>" . htmlspecialchars($book['quantity']) . " room </td>";
                echo "<td>" . htmlspecialchars($book['cost']) . " </td>";
                echo "<td><button class='view-button'>view</button></td>";
                echo "</tr>";
            }
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
<script>
    account = document.getElementById("account");
    // เมื่อมีการ hover ที่ข้อความ
    account.addEventListener("mouseover", showLogout);
    // เมื่อออกจากข้อความ
    account.addEventListener("mouseout", hideLogout);

    function showLogout() {
        account.textContent = "ออกจากระบบ"
        // แสดงป๊อปอัพ
        // document.getElementById("logoutPopup").style.display = "block";
    }

    function hideLogout() {
        // console.log("Hide Logout Popup called");
        account.textContent = "<?php echo $customer['username']; ?>"
        // ซ่อนป๊อปอัพ
        // document.getElementById("logoutPopup").style.display = "none";
    }
</script>

</html>
