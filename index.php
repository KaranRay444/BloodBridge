<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bridge - Connecting Donors</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>Blood Bridge</h1>
        </div>
        <nav>
            <ul>
                <li><a href="./donor.php">Become A Donor</a></li>
                <li><a href="#why_donate">Why Donate Blood</a></li>
                <li><a href="#events">Events</a></li>
                <li><a href="./need.php">Need Blood</a></li>
                <li><a href="#">About Us</a></li>
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
                <p>Blood donation strengthens your community by ensuring that blood is available when needed, fostering a spirit of solidarity and care.</p>
            </div>
        </div>
    </div>
</section>
<section id="events" class="events">
    <div class="container">
        <h2>Upcoming Events</h2>
        <div class="event-list">
            <div class="event-box">
                <h3>Blood Donation Camp</h3>
                <p><strong>Date:</strong> August 25, 2024</p>
                <p><strong>Location:</strong> Health City Community Hall</p>
                <p>Join us for a day of saving lives! All eligible donors are welcome to contribute.</p>
            </div>
            <div class="event-box">
                <h3>Awareness Seminar</h3>
                <p><strong>Date:</strong> September 10, 2024</p>
                <p><strong>Location:</strong> XYZ University Auditorium</p>
                <p>Learn about the importance of blood donation and how you can get involved.</p>
            </div>
            <div class="event-box">
                <h3>Community Outreach Program</h3>
                <p><strong>Date:</strong> October 5, 2024</p>
                <p><strong>Location:</strong> ABC Park</p>
                <p>Our team will be providing free health check-ups and spreading awareness about blood donation.</p>
            </div>
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
<footer class="footer">
    <div class="footer-content">
        <div class="about-us">
            <h4>About Us</h4>
            <p>
                We are a dedicated team committed to saving lives through efficient blood donation management. Our mission is to connect donors with those in need, ensuring that no one suffers due to a lack of blood availability.
            </p>
        </div>

        <div class="contact-us">
            <h4>Contact Us</h4>
            <p>Email: contact@BloodBridge.com</p>
            <p>Phone: +91 2223 4563 78</p>
            <p>Address: 213 Health center ,Surat</p>
        </div>

        <div class="quick-links">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#events">Events</a></li>
                <li><a href="#why_donate">Why Donate</a></li>
                <li><a href="#get-in-touch">Get in Touch</a></li>
            </ul>
        </div>

        <div class="social-media">
            <h4>Follow Us</h4>
            <ul>
                <li><a href="#" class="social-icon facebook">Facebook</a></li>
                <li><a href="#" class="social-icon twitter">Twitter</a></li>
                <li><a href="#" class="social-icon instagram">Instagram</a></li>
                <li><a href="#" class="social-icon linkedin">LinkedIn</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 Blood Bridge. All rights reserved.</p>
    </div>
</footer>

</body>

</html>
