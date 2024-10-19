<?php
include '../connections.php'; // Include the database connection

// Check if the form to assign a meeting is submitted
if (isset($_POST['assign_meeting'])) {
    $blotter_id = $_POST['blotter_id'];
    $meeting_date = $_POST['meeting_date'];
    $meeting_time = $_POST['meeting_time'];

    // Update the blotter report status to 'assigned' with the meeting date and time
    $query = "UPDATE blotter_report SET status='assigned', meeting_date='$meeting_date', meeting_time='$meeting_time' WHERE blotter_id='$blotter_id'";
    mysqli_query($connections, $query);

    // Redirect to refresh the page with a success message
    header("Location: manage_blotter_report.php?message=1");
    exit();
}

// Check if the form to cancel a meeting is submitted
if (isset($_POST['cancel_meeting'])) {
    $blotter_id = $_POST['blotter_id'];

    // Update the blotter report status to 'canceled' and remove the meeting date and time
    $query = "UPDATE blotter_report SET status='canceled', meeting_date=NULL, meeting_time=NULL WHERE blotter_id='$blotter_id'";
    mysqli_query($connections, $query);

    // Redirect to refresh the page with a cancellation message
    header("Location: manage_blotter_report.php?message=2");
    exit();
}

// Fetch blotter reports with user information for the admin to manage, ordered by created_at descending
$blotter_query = "SELECT br.*, u.firstname, u.lastname FROM blotter_report br JOIN users u ON br.user_id = u.id ORDER BY br.created_at DESC";
$blotter_result = mysqli_query($connections, $blotter_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Blotter Reports</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <style>
        /* Sidebar styles */
        #sidebar {
            width: 250px; /* Set sidebar width */
            height: 100vh; /* Full height */
            background-color: #f8f9fa; /* Background color */
            border-right: 1px solid #dee2e6; /* Optional: sidebar border */
            position: fixed; /* Keep sidebar fixed */
            top: 0; /* Align to the top */
            left: 0; /* Align to the left */
            z-index: 1000; /* Ensure the sidebar is above other content */
        }

        /* Content styles */
        #content {
            margin-left: 250px; /* Set margin for content to avoid overlap */
            padding: 20px; /* Add padding for content */
        }
    </style>
</head>
<body>
    <div id="sidebar">
        <div class="logo text-center py-3">
            <img src="../logonav.png" alt="Logo" class="img-fluid">
        </div>
        <ul class="list-unstyled">
            <li><a href="#" class="text-decoration-none text-dark"><i class="fas fa-home"></i> Admin Dashboard</a></li>
            <li><a href="logout.php" class="text-decoration-none text-dark"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    <div id="content">
        <h2 class="mb-4">Manage Blotter Reports</h2>

        <script>
            // Check for messages to show SweetAlert
            <?php if (isset($_GET['message'])): ?>
                let message = <?= json_encode($_GET['message']) ?>;
                if (message == 1) {
                    swal("Success!", "Meeting assigned successfully!", "success");
                } else if (message == 2) {
                    swal("Success!", "Meeting canceled successfully!", "success");
                }
            <?php endif; ?>
        </script>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Report</th>
                        <th>Status</th>
                        <th>Meeting Date</th>
                        <th>Meeting Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($blotter_result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['firstname']) ?></td>
                        <td><?= htmlspecialchars($row['lastname']) ?></td>
                        <td><?= htmlspecialchars($row['report_content']) ?></td>
                        <td><?= ucfirst(htmlspecialchars($row['status'])) ?></td>
                        <td><?= $row['meeting_date'] ?: 'N/A' ?></td>
                        <td><?= $row['meeting_time'] ?: 'N/A' ?></td>
                        <td>
                            <form method="POST" action="manage_blotter_report.php" style="display:inline-block;">
                                <input type="hidden" name="blotter_id" value="<?= $row['blotter_id'] ?>">
                                <input type="date" name="meeting_date" required class="form-control d-inline" style="width: auto;">
                                <input type="time" name="meeting_time" required class="form-control d-inline" style="width: auto;">
                                <button type="submit" name="assign_meeting" class="btn btn-primary" onclick="return confirm('Are you sure you want to assign this meeting?');">Assign</button>
                            </form>
                            <form method="POST" action="manage_blotter_report.php" style="display:inline-block;">
                                <input type="hidden" name="blotter_id" value="<?= $row['blotter_id'] ?>">
                                <button type="submit" name="cancel_meeting" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this meeting?');">Cancel</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
