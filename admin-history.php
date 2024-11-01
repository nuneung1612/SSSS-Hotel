<!DOCTYPE html>
<html>

<head>

    <title>So Sad So Stay - Admin Reservation</title>
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
        label{
            font-size: 1.2rem;
        }
        select{
            font-size: 1rem;
            border-radius: 8px;

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

        .history-button {
            background-color: #a9a3b3;
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

        button.icon-button {
            background: url('image/icon-plus.png') no-repeat 10px center;
            padding-left: 40px;
            /* Adjust padding based on icon size */
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
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </a>
        </div>
    </nav>
    <div>
        </br>
        </br>
        <h1>&nbsp;&nbsp;&nbsp;&nbsp;Booking History&nbsp;&nbsp;&nbsp;
        </h1></br>

        <form>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label for="date">Date</label>&nbsp;&nbsp;&nbsp;
            <select class="form-control" name="date" id="date">
                <option value="0">--select all--</option>
                <?php for ($i = 1; $i <= 31; $i++): ?>
                    <option value="<?php echo $i; ?>"> <?php echo $i; ?></option>
                <?php endfor; ?>
            </select>&nbsp;&nbsp;&nbsp;
            <label for="month">Month</label>&nbsp;&nbsp;&nbsp;
            <select class="form-control" name="month" id="month">
                <option value="0">--select all--</option>
                <?php for ($i = 1; $i <= 12; $i++): ?>
                    <option value="<?php echo $i; ?>"> <?php echo $i; ?></option>
                <?php endfor; ?>
            </select>&nbsp;&nbsp;&nbsp;
            <label for="year">Year</label>&nbsp;&nbsp;&nbsp;
            <select class="form-control" name="year" id="year">
                <option value="-select all-">--select all--</option>
                <?php for ($i = 2000; $i <= 2024; $i++): ?>
                    <option value="<?php echo $i; ?>"> <?php echo $i; ?></option>
                <?php endfor; ?>
            </select>&nbsp;&nbsp;&nbsp;
            <button type="submit" class='history-button'>show history</button>
            </p>
        </form>
        </br></br>
    </div>


    <table class="booking-table">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Customer ID</th>
                <th>Room ID</th>
                <th>Date</th>
                <th>Quantity</th>
                <th>Cost</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>1</td>
                <td>2</td>
                <td>27/12/2024</td>
                <td>1</td>
                <td>1234</td>
            </tr>
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