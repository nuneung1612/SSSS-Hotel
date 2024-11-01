

<!DOCTYPE html>
<html>
<head>
    <title>So Sad So Stay Hotel</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Comic Sans MS', cursive, sans-serif;
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

        .header {
            background-color: #6b617c;
            padding: 15px;
            color: white;
            margin-bottom: 20px;
        }

        .nav-menu {
            background-color: #a9a3b3;
            padding: 10px;
            margin-bottom: 20px;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
        }

        .main-title {
            font-size: 24px;
            margin: 20px 0;
        }

        .lists-container {
            display: flex;
            gap: 20px;
        }

        .list-section {
            flex: 1;
            padding: 20px;
            border-radius: 10px;
        }

        .checkin-list {
            background-color: #98FB98;
        }

        .checkout-list {
            background-color: #FFA07A;
        }

        .list-title {
            font-size: 18px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 5px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .status {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 14px;
        }

        .status-checked-in {
            color: green;
        }

        .status-not-yet {
            color: red;
        }

        .action-button {
            background-color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
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
    </style>
</head>
<body>
    <nav class="top-nav">
        <a href="#" class="logo">So Sad So Stay</a>
        <div class="nav-links">
            <a href="adminhome.php">HOME</a>
            <a href="admin-history.php">History</a>
            <a href="admin-manage-room.php">Manage Room</a>
            <a href="admin-reservation.php">Reservation</a>
            <a href="#" class="username">
                Username
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </a>
        </div>
    </nav>

    <div class="lists-container">
        <!-- Check-in List -->
        <div class="list-section checkin-list">
            <h2 class="list-title">Check in list</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Room</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // if ($checkin_result->num_rows > 0) {
                    //     while($row = $checkin_result->fetch_assoc()) {
                    //         echo "<tr>";
                    //         echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    //         echo "<td>" . htmlspecialchars($row['room_number']) . "</td>";
                    //         echo "<td>" . htmlspecialchars($row['guest_name']) . "</td>";
                    //         echo "<td><span class='status status-checked-in'>" .
                    //              htmlspecialchars($row['status']) . "</span></td>";
                    //         echo "<td><button class='action-button' onclick='handleCheckin(" .
                    //              $row['id'] . ")'>checkin</button></td>";
                    //         echo "</tr>";
                    //     }
                    // }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Check-out List -->
        <div class="list-section checkout-list">
            <h2 class="list-title">Check out list</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Room</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // if ($checkout_result->num_rows > 0) {
                    //     while($row = $checkout_result->fetch_assoc()) {
                    //         echo "<tr>";
                    //         echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    //         echo "<td>" . htmlspecialchars($row['room_number']) . "</td>";
                    //         echo "<td>" . htmlspecialchars($row['guest_name']) . "</td>";
                    //         echo "<td><span class='status status-not-yet'>" .
                    //              htmlspecialchars($row['status']) . "</span></td>";
                    //         echo "<td><button class='action-button' onclick='handleCheckout(" .
                    //              $row['id'] . ")'>checkout</button></td>";
                    //         echo "</tr>";
                    //     }
                    // }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function handleCheckin(id) {
            if (confirm('Confirm check-in for guest?')) {
                window.location.href = `process-checkin.php?id=${id}`;
            }
        }

        function handleCheckout(id) {
            if (confirm('Confirm check-out for guest?')) {
                window.location.href = `process-checkout.php?id=${id}`;
            }
        }
    </script>
</body>
</html>
