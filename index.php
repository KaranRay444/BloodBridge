<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bridge - Connecting Donors</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <?php include 'header.php'; ?>
    <section class="hero">
        <div class="hero-content">
            <h2>Blood Donation is a Great Act of Kindness</h2>
            <p>One pint of blood can save three lives. Be a donor, be a savior</p>
            <a href="/BBMS/BloodBridge/php/donor.php" class="btn">Join Now</a>
            <a href="#why_donate" class="read-more">Read More</a>
        </div>
    </section>
    <section id="why_donate" class="why">
        <div class="container">
            <h2>Why Donate Blood?</h2>
            <div class="boxes">
                <div class="box">
                    <h3>Save Lives</h3>
                    <p>Your donation can save up to three lives. Blood donations are vital for emergency treatments, surgeries, and chronic illnesses.</p>
                </div>
                <div class="box">
                    <h3>Boost Your Health</h3>
                    <p>Donating blood helps to reduce iron levels in your body, which can lower the risk of heart disease and other health issues.</p>
                </div>
                <div class="box">
                    <h3>Community Impact</h3>
                    <p>Blood donation strengthens your community by ensuring that blood is available when needed, fostering a spirit of solidarity and care with cure.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="events" class="events">
        <div class="container">
            <h2>Upcoming Events</h2>
            <div class="event-list">
                <?php include 'php/events.php'; ?>
            </div>
        </div>
    </section>

    <section id="get-in-touch" class="get-in-touch">
        <div class="form_box">
            <h2>Get in Touch</h2>
            <p>We would love to hear from you! Please fill out the form below to send us a message.</p>
            
            <form action="php/contact.php" method="POST" class="contact-form">
                <div class="form_field">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form_field">
                    <label for="email">Your Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form_field">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" required>
                </div>
                <div class="form_field">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>

                <button type="submit" class="submit-btn">Send Message</button>
            </form>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>
</html>
