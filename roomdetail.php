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
    <title>So Sad So Stay - Room Booking</title>
    <style>
        :root {
            --primary-purple: #4A4159;
            --light-purple: #8E8299;
            --lighter-purple: #E8E6EC;
            --white: #FFFFFF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Comic Sans MS', cursive, sans-serif;
        }

        body {
            background-color: var(--lighter-purple);
        }

        .booking-button {
            background-color: var(--lighter-purple);
            padding: 0.5rem 1rem;
            border-radius: 5px;
            color: var(--primary-purple);
        }

        .tabs {
            display: flex;
            background-color: var(--light-purple);
            padding: 0;
        }

        .tab {
            padding: 1rem 2rem;
            color: white;
            cursor: pointer;
        }

        .tab.active {
            background-color: var(--lighter-purple);
            color: var(--primary-purple);
        }

        .main-content {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .booking-title {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: var(--primary-purple);
        }

        .room-id {
            text-align: right;
            color: var(--primary-purple);
            margin-top: -3rem;
            margin-bottom: 2rem;
        }

        .booking-details {
            background: var(--white);
            padding: 2rem;
            border-radius: 15px;
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 2rem;
        }

        .room-image {
            width: 100%;
            border-radius: 10px;
        }

        .room-name {
            font-size: 1.5rem;
            margin: 1rem 0;
            color: var(--primary-purple);
        }

        .room-features {
            list-style: none;
            color: var(--primary-purple);
            line-height: 1.6;
        }

        .booking-form {
            display: grid;
            gap: 1rem;
        }

        .form-row {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .form-group {
            flex: 1;
        }

        .quantity-input {
            background: var(--lighter-purple);
            border: none;
            padding: 0.5rem;
            border-radius: 25px;
            width: 100px;
            text-align: center;
        }

        .date-select {
            background: var(--lighter-purple);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            width: 200px;
        }

        .cost-display {
            background: var(--lighter-purple);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            text-align: center;
        }

        .extensions {
            display: grid;
            gap: 0.5rem;
            margin: 1rem 0;
        }

        .extension-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary-purple);
        }

        .extension-option input[type="checkbox"] {
            width: 20px;
            height: 20px;
        }

        .note-area {
            background: var(--lighter-purple);
            border: none;
            border-radius: 15px;
            padding: 1rem;
            width: 100%;
            min-height: 100px;
            margin: 1rem 0;
        }

        .booking-buttons {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        .btn {
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
        }

        .username {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-book {
            background-color: var(--light-purple);
            color: white;
        }

        .btn-pay {
            background-color: var(--primary-purple);
            color: white;
        }

        .top-nav {
            background-color: #584b5f;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
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

        .logo {
            font-size: 1.5rem;
            color: white;
            text-decoration: none;
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
            <a id="account" class="" href="../backend/logout.php">
                <?php echo $customer['username']; ?>
            </a>
        </div>
    </nav>
    <div class="sub-nav">
        <a class="hover" href="#">Book a room</a>
        <a class="hover" href="./bookhistory.php">Booking History</a>
    </div>

    <main class="main-content">
        <h1 class="booking-title">Booking Rooms Detail</h1>
        <div class="room-id">RoomID : 1</div>

        <div class="booking-details">
            <div class="room-info">
                <img src="./image/small_room.jpg" alt="Small Room" class="room-image">
                <h2 class="room-name">Small Room</h2>
                <ul class="room-features">
                    <li>High-speed internet</li>
                    <li>Breakfast coffee or tea</li>
                    <li>Sunlight in the morning</li>
                </ul>
            </div>

            <form action="./backend/booking.php" method="POST" class="booking-form">
                <div class="form-row">
                    <div class="form-group">
                        <label>Select quantity</label>
                        <input type="number" min="1" value="1" class="quantity-input">
                        <span>room</span>
                    </div>
                    <div class="form-group">
                        <label>Select Date</label>
                        <input type="text" class="date-select" value="05/11/2024 - 16/11/2024">
                    </div>
                    <div class="form-group">
                        <label>Cost (per night)</label>
                        <div class="cost-display">1234 $</div>
                    </div>
                </div>

                <div class="extensions">
                    <label class="extension-option">
                        <input type="checkbox">
                        <span>extra 1 beds</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="extension-option">
                        <input type="checkbox">
                        <span>dinner</span>
                        <span class="checkmark"></span>
                    </label>
                    <label class="extension-option">
                        <input type="checkbox">
                        <span>pickup service</span>
                    </label>
                </div>

                <div class="total-cost">
                    <label>Total cost</label>
                    <div name="total" class="cost-display">1234 $</div>
                </div>

                <div>
                    <label>Note</label>
                    <textarea class="note-area"></textarea>
                </div>

                <div class="booking-buttons">
                    <button type="submit" name="book" onclick="document.location='./payments.php'" class="btn btn-pay">Book and pay Now</button>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Add any necessary JavaScript for date picker and calculations
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners for checkboxes to update total cost
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateTotalCost);
            });

            // Add event listener for quantity input
            const quantityInput = document.querySelector('.quantity-input');
            quantityInput.addEventListener('change', updateTotalCost);

            function updateTotalCost() {
                const basePrice = 1234;
                const quantity = parseInt(quantityInput.value) || 1;
                let total = basePrice * quantity;

                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        // Add extra costs based on selected options
                        if (checkbox.nextElementSibling.textContent.includes('beds')) total += 100;
                        if (checkbox.nextElementSibling.textContent.includes('dinner')) total += 50;
                        if (checkbox.nextElementSibling.textContent.includes('pickup')) total += 30;
                    }
                });

                document.querySelector('.total-cost .cost-display').textContent = `${total} $`;
            }
        });
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
</body>

</html>
