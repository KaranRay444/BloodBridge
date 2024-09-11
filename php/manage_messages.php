<?php
include 'connect.php'; // Database connection

// Fetch messages from the need_blood table
$messages_result = $conn->query("SELECT id, name, email, subject, message, created_at FROM messages");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Messages</title>
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
    </style>
</head>
<body>
    <h2>Messages List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($message = $messages_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $message['id']; ?></td>
                    <td><?php echo $message['name']; ?></td>
                    <td><?php echo $message['email']; ?></td>
                    <td><?php echo $message['subject']; ?></td>
                    <td><?php echo $message['message']; ?></td>
                    <td><?php echo $message['created_at']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
