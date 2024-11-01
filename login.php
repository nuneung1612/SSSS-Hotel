<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>So Sad So Stay - Welcome</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Comic Sans MS', cursive, sans-serif;
        }

        nav {
            background-color: #584b5f;
            padding: 1rem;
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
            gap: 2rem;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
        }

        .book-now {
            background-color: white;
            color: #584b5f;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
        }

        .container {
            flex: 1;
            display: flex;
            height: calc(100vh - 60px);
        }

        .image-section {
            /* flex: 1; */
            background-image: url('image/login-hotel.jpg');
            background-size: cover;
            background-position: center;
            object-fit: cover;
            position: relative;
            overflow: hidden;
            width: 75%;
            height: 100%;
        }

        .form-section {
            flex: 0.4;
            padding: 1rem;
            margin-top: 2rem;
            align-items: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .welcome-text {
            color: #584b5f;
            font-size: 2rem;
            margin-bottom: 2rem;
        }

        .input-group {
            margin-bottom: 1rem;
        }

        input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        button {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .create-account {
            background-color: #8b4b8b;
            color: white;
        }

        .sign-in {
            background-color: white;
            color: #8b4b8b;
            border: 1px solid #8b4b8b;
        }
    </style>
</head>

<body>
    <nav>
        <a href="#" class="logo">So Sad So Stay</a>
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">Rooms</a>
            <a href="#">Contact Us</a>
            <a href="#" style="color: #584b5f" class="book-now">Book Now</a>
        </div>
    </nav>

    <div class="container">
        <div class="image-section">
            <!-- <img src="image/login-hotel.jpg"> -->
        </div>
        <div class="form-section"></div>
        <!-- <h1 class="welcome-text">Welcome !</h1>
        <h1>welcome</h1> -->
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    </br>
    </br>
    </br>
            <h1 class="welcome-text">Welcome !</h1>
            <div class="input-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Enter password" required>
            </div>
            <div class="button-group">
                <button type="submit" name="sign_in" class="create-account">Sign in</button>
                <a href="register.php" type="button" class="btn btn-primary">Create account</a>
            </div>
        </form>
    </div>
    </div>
</body>

</html>
