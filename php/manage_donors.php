<?php
include 'connect.php';

// Approve or Decline operation
if (isset($_POST['action']) && isset($_POST['donation_id'])) {
    $donation_id = $_POST['donation_id'];
    $action = $_POST['action'];

    // Determine the status based on the action
    $status = ($action == 'approve') ? 'Approved' : 'Declined';

    // Update the status in the `donations` table
    $update_sql = "UPDATE donations SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("si", $status, $donation_id);
    if ($stmt->execute()) {
        echo "Status updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch donor and donation details
$sql = "
    SELECT donors.donor_name, donors.contact, donations.id, donations.blood_type, donations.no_of_units, donations.status 
    FROM donors 
    JOIN donations ON donors.id = donations.donor_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Donors</title>
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
        .btn {
            padding: 5px 10px;
            color: white;
            background-color: green;
            border: none;
            cursor: pointer;
            margin-right: 5px;
        }
        .btn.decline {
            background-color: red;
        }
    </style>
</head>
<body>
    <h2>Manage Donors and Donations</h2>
    <table>
        <thead>
            <tr>
                <th>Donor Name</th>
                <th>Contact</th>
                <th>Blood Type</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['donor_name']; ?></td>
                    <td><?php echo $row['contact']; ?></td>
                    <td><?php echo $row['blood_type']; ?></td>
                    <td><?php echo $row['no_of_units']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <?php if (strtolower(trim($row['status'])) == 'pending'): ?>
                            <form method="POST" style="display:inline-block;">
                                <input type="hidden" name="donation_id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="action" value="approve">
                                <button type="submit" class="btn">Approve</button>
                            </form>
                            <form method="POST" style="display:inline-block;">
                                <input type="hidden" name="donation_id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="action" value="decline">
                                <button type="submit" class="btn decline">Decline</button>
                            </form>
                        <?php else: ?>
                            <span><?php echo $row['status']; ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
