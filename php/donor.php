<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become A Donor Form</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .donor-container * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .donor-container {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .donor-form {
            background-color: #ffffff;
            width: 600px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-top: 20px;
        }

        .donor-header {
            background-color: #27ae60;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .donor-header h1 {
            margin-bottom: 10px;
            font-size: 24px;
        }

        .donor-header p {
            font-size: 14px;
        }

        .form-content {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 16px;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .submit-btn {
            width: 100%;
            background-color: #27ae60;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #218c52;
        }
    </style>
</head>
<body>

<?php include('../header.php'); ?>

<div class="donor-container">
    <div class="donor-form">
        <div class="donor-header">
            <h1>Become a Donor</h1>
            <p>Please fill out this form to register as a blood donor. Your details will be securely stored.</p>
        </div>

        <div class="form-content">
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="donor-name">Full Name</label>
                    <input type="text" id="donor-name" name="donor-name" placeholder="Enter your full name" required>
                </div>

                <div class="form-group">
                    <label for="donor-age">Age</label>
                    <input type="number" id="donor-age" name="donor-age" placeholder="Enter your age" required>
                </div>

                <div class="form-group">
                    <label for="blood-type">Blood Type</label>
                    <select id="blood-type" name="blood-type" required>
                        <option value="" disabled selected>Select your blood type</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="donor-gender">Gender</label>
                    <select id="donor-gender" name="donor-gender" required>
                        <option value="" disabled selected>Select your gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="donor-weight">Weight (kg)</label>
                    <input type="number" id="donor-weight" name="donor-weight" placeholder="Enter your weight in kg" required>
                </div>

                <div class="form-group">
                    <label for="contact-number">Contact Number</label>
                    <input type="tel" id="contact-number" name="contact-number" placeholder="Enter your contact number" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email address" required>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" placeholder="Enter your full address" required></textarea>
                </div>

                <div class="form-group">
                    <label for="last-donation-date">Last Donation Date (if any)</label>
                    <input type="date" id="last-donation-date" name="last-donation-date">
                </div>

                <div class="form-group">
                    <label for="message">Additional Information (Optional)</label>
                    <textarea id="message" name="message" placeholder="Enter any additional details"></textarea>
                </div>

                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php include('../footer.php'); ?>

</body>
</html>
