<?php
include 'connect.php';

// Function to update blood inventory when request is approved
function updateInventory($bloodType, $changeInMl, $mysqli) {
    // Correct column name according to your database
    $stmt = $mysqli->prepare("SELECT available_ml FROM blood_inventory WHERE blood_type = ?");
    $stmt->bind_param("s", $bloodType);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $newQuantity = $row['available_ml'] - $changeInMl; // Use subtraction for blood removal

        // Now you can update the quantity back to the database
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
if (isset($_POST['action']) && isset($_POST['request_id'])) {
    $request_id = $_POST['request_id'];
    $action = $_POST['action'];

    // Determine the status based on the action
    $status = ($action == 'approve') ? 'Approved' : 'Declined';

    // Fetch the blood group and units for the request
    $request_sql = "SELECT blood_group, no_of_units FROM need_blood WHERE id = ?";
    $stmt_request = $conn->prepare($request_sql);
    $stmt_request->bind_param("i", $request_id);
    $stmt_request->execute();
    $stmt_request->bind_result($blood_group, $no_of_units);
    $stmt_request->fetch();
    $stmt_request->close();

    // If approved, update the blood inventory
    if ($action == 'approve') {
        $isInventoryUpdated = updateInventory($blood_group, $no_of_units, $conn);
        
        // Only proceed with status update if inventory was successfully updated
        if (!$isInventoryUpdated) {
            exit();
        }
    }

    // Update the status in the `need_blood` table
    $update_sql = "UPDATE need_blood SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("si", $status, $request_id);
    if ($stmt->execute()) {
        echo "Status updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch patient and blood request details
$sql = "
    SELECT p.patient_name, p.contact, n.id, n.blood_group, n.no_of_units, n.disease, n.status 
    FROM patients p
    JOIN need_blood n ON p.id = n.patient_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Patients</title>
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
    <h2>Manage Patients and Blood Requests</h2>
    <table>
        <thead>
            <tr>
                <th>Patient Name</th>
                <th>Contact</th>
                <th>Blood Group</th>
                <th>Quantity</th>
                <th>Disease</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['patient_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['contact']); ?></td>
                    <td><?php echo htmlspecialchars($row['blood_group']); ?></td>
                    <td><?php echo htmlspecialchars($row['no_of_units']); ?></td>
                    <td><?php echo htmlspecialchars($row['disease']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td>
                        <?php if (strtolower(trim($row['status'])) == 'pending'): ?>
                            <form method="POST" style="display:inline-block;">
                                <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="action" value="approve">
                                <button type="submit" class="btn">Approve</button>
                            </form>
                            <form method="POST" style="display:inline-block;">
                                <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
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
