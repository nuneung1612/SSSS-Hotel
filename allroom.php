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
            font-family: 'Comic Sans MS', cursive, sans-serif;
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
            background-color: #e6dde6;
            padding: 2rem;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .header p {
            color: #666;
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
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .room-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .room-title {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
        }

        .room-details {
            list-style: none;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            color: #333;
        }

        .room-details li {
            margin-bottom: 0.2rem;
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

        .book-now:hover {
            background-color: #b3a0b3;
        }
    </style>
</head>
<body>
    <nav class="top-nav">
        <a href="#" class="logo">So Sad So Stay</a>
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#" class="rooms">Rooms</a>
            <a href="#">Contact Us</a>
            <a href="#" class="book-now-nav">Book Now</a>
        </div>
    </nav>

    <div class="header">
        <h1>Rooms</h1>
        <p>See our rooms!</p>
    </div>

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
            <a href="#" class="book-now">Book Now</a>
        </div>
    </div>
</body>
</html>
