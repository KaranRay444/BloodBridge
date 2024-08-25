<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bridge - Connecting Donors</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #fff5f5;
            color: #333;
        }

        header {
            background-color: #ff4c4c;
            padding: 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo h1 {
            color: #fff;
            font-size: 24px;
            margin-left: 20px;
        }

        nav ul {
            list-style: none;
            display: flex;
            margin-right: 20px;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        nav ul li a:hover {
            color: #ffe0e0;
        }

        .hero {
            background: url('f1.jpg') no-repeat center center/cover;
            color: #fff;
            padding: 150px 20px;
            text-align: center;
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-content {
            z-index: 2;
            max-width: 600px;
            margin: 0 auto;
        }

        .hero h2 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #ff4c4c;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 30px;
            color: #cc3c3c;
        }

        .btn {
            background-color: #ff4c4c;
            color: whitesmoke;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
        }

        .btn:hover {
            background-color: white;
            color: #ff4c4c;
            border-bottom: red 1px solid;
        }

        .read-more {
            display: inline-block;
            margin-top: 10px;
            color: red;
            text-decoration: underline;
        }

        footer {
            background-color: #222;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: 40px;
        }

        footer p {
            margin: 5px 0;
            font-size: 14px;
            line-height: 1.6;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <h1>Blood Bridge</h1>
        </div>
        <nav>
            <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Why Donate Blood</a></li>
                <li><a href="#">Become A Donor</a></li>
                <li><a href="#">Need Blood</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h2>Blood Donation is a Great Act of Kindness</h2>
            <p>One pint of blood can save three lives. Be a donor, be a savior</p>
            <a href="#" class="btn">Join Now</a>
            <a href="#" class="read-more">Read More</a>
        </div>
    </section>

    <section class="hero2">
        <h1>LOADING......</h1>
    </section>

    <footer>
        <p>&copy; 2024 Blood Bridge. All rights reserved.</p>
    </footer>
</body>

</html>
