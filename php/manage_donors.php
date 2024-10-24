<?php
include 'connect.php';

// Function to update blood inventory when donation is approved
function updateInventory($bloodType, $noOfUnits, $mysqli) {
    // Get current available amount of blood in milliliters
    $stmt = $mysqli->prepare("SELECT available_ml FROM blood_inventory WHERE blood_type = ?");
    $stmt->bind_param("s", $bloodType);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentQuantity = $row['available_ml'];

        // Calculate the new quantity: current quantity + donated quantity
        $newQuantity = $currentQuantity + ($noOfUnits); // Assuming noOfUnits is in milliliters

        // Update the inventory with the new amount
        $stmt = $mysqli->prepare("UPDATE blood_inventory SET available_ml = ? WHERE blood_type = ?");
        $stmt->bind_param("is", $newQuantity, $bloodType);
        if ($stmt->execute()) {
            $stmt->close();
            return true; // Successfully updated inventory
        } else {
            echo "Error updating inventory: " . $stmt->error;
            return false;
        }
    } else {
        echo "No such blood type found.";
        return false;
    }
}

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
        if ($action == 'approve') {
            // Get blood type and quantity for inventory update
            $donation_sql = "SELECT blood_type, no_of_units FROM donations WHERE id = ?";
            $stmt_donation = $conn->prepare($donation_sql);
            $stmt_donation->bind_param("i", $donation_id);
            $stmt_donation->execute();
            $stmt_donation->bind_result($blood_type, $no_of_units);
            $stmt_donation->fetch();
            $stmt_donation->close();

            // Update the inventory based on approved donation
            updateInventory($blood_type, $no_of_units, $conn);
        }
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
                <th>Quantity (Units)</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['donor_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['contact']); ?></td>
                    <td><?php echo htmlspecialchars($row['blood_type']); ?></td>
                    <td><?php echo htmlspecialchars($row['no_of_units']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
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
                            <span><?php echo htmlspecialchars($row['status']); ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
