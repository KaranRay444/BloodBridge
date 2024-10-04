<?php
include 'connect.php'; 

$events_result = $conn->query("SELECT * FROM events");

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM events WHERE id=$id");
    header('Location: manage_events.php');
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $event_location = $_POST['event_location'];
    $description = $_POST['description'];

    $conn->query("UPDATE events SET event_name='$event_name', event_date='$event_date', event_location='$event_location', description='$description' WHERE id=$id");
    header('Location: manage_events.php');
}

if (isset($_POST['add'])) {
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $event_location = $_POST['event_location'];
    $description = $_POST['description'];

    $conn->query("INSERT INTO events (event_name, event_date, event_location, description) VALUES ('$event_name', '$event_date', '$event_location', '$description')");
    header('Location: manage_events.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h2>Events List</h2>

    <form method="POST" action="">
        <input type="text" name="event_name" placeholder="Event Name" required>
        <input type="date" name="event_date" required>
        <input type="text" name="event_location" placeholder="Location" required>
        <textarea name="description" placeholder="Event Description" required></textarea>
        <button type="submit" name="add">Add Event</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Event Name</th>
                <th>Event Date</th>
                <th>Event Location</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($event = $events_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $event['id']; ?></td>
                    <td><?php echo $event['event_name']; ?></td>
                    <td><?php echo $event['event_date']; ?></td>
                    <td><?php echo $event['event_location']; ?></td>
                    <td><?php echo $event['description']; ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
                            <input type="text" name="event_name" value="<?php echo $event['event_name']; ?>" required>
                            <input type="date" name="event_date" value="<?php echo $event['event_date']; ?>" required>
                            <input type="text" name="event_location" value="<?php echo $event['event_location']; ?>" required>
                            <textarea name="description" required><?php echo $event['description']; ?></textarea>
                            <button type="submit" name="update">Update</button>
                        </form>

                        <a href="manage_events.php?delete=<?php echo $event['id']; ?>" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
