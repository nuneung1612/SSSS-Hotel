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

        .header {
            background-color: var(--primary-purple);
            padding: 1rem 2rem;
            color: white;
        }

        .brand {
            font-size: 1.5rem;
            color: white;
            text-decoration: none;
        }

        .nav-menu {
            display: flex;
            gap: 2rem;
            align-items: center;
            justify-content: flex-end;
            margin-top: -1.5rem;
        }


        .nav-menu a {
            color: white;
            text-decoration: none;
        }

        .nav-item {
            color: white;
            text-decoration: none;
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
    </style>
</head>
<body>
    <header class="header">
        <a href="#" class="brand">So Sad So Stay</a>
        <nav class="nav-menu">
            <a href="#" class="nav-item">HOME</a>
            <a href="#" class="nav-item">Rooms</a>
            <a href="#" class="nav-item">Contact Us</a>
            <a href="#" class="nav-item">Booking</a>
            <a href="#" class="username">
                Username
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </a>
        </nav>
    </header>

    <div class="tabs">
        <div class="tab active">Book a room</div>
        <div class="tab">My booking</div>
        <div class="tab">Booking History</div>
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

            <form class="booking-form">
                <div class="form-row">
                    <div class="form-group">
                        <label>Select quantity</label>
                        <input type="number" min="1" value="1" class="quantity-input">
                        <span>room</span>
                    </div>
                    <div class="form-group">
                        <label>Select Date</label>
                        <input type="text" class="date-select" value="01/01 - 02/01">
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
                    <div class="cost-display">1234 $</div>
                </div>

                <div>
                    <label>Note</label>
                    <textarea class="note-area"></textarea>
                </div>

                <div class="booking-buttons">
                    <button type="button" class="btn btn-book">Book Now</button>
                    <button type="button" class="btn btn-pay">Book and pay Now</button>
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
    </script>
</body>
</html>
