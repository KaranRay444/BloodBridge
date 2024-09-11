<?php
// Include the database connection
include 'connect.php';

// Fetch events from the database
$sql = "SELECT * FROM events";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='event-box'>";
        echo "<h3>" . htmlspecialchars($row["event_name"]) . "</h3>";
        echo "<p><strong>Date:</strong> " . htmlspecialchars($row["event_date"]) . "</p>";
        echo "<p><strong>Location:</strong> " . htmlspecialchars($row["event_location"]) . "</p>";
        echo "<p>" . htmlspecialchars($row["description"]) . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No upcoming events</p>";
}

// Close the connection
$conn->close();
?>
