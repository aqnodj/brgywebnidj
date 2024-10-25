<?php
include '../connections.php';



session_start();


// Access for Admin Account only
if (!isset($_SESSION["user_id"]) || $_SESSION["account_type"] != "1") {

    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Access Denied</title>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css'>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Access Denied',
                    text: 'Admin lang ang may access dito',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.history.back(); // Redirects back to the previous page
                    }
                });
            });
        </script>
    </head>
    <body>
    </body>
    </html>";
    exit();
}

// Check if a form is submitted
if (isset($_POST['assign_meeting'])) {
    $blotter_id = $_POST['blotter_id'];
    $meeting_date = $_POST['meeting_date'];
    $meeting_time = $_POST['meeting_time'];

//    update blotter report
    $query = "UPDATE blotter_report SET status='assigned', meeting_date='$meeting_date', meeting_time='$meeting_time' WHERE blotter_id='$blotter_id'";
    mysqli_query($connections, $query);

    // Redirect to refresh the page with a success message
    header("Location: manage_blotter_report.php?message=1");
    exit();
}

// Check if the cancel button is submitted
if (isset($_POST['cancel_meeting'])) {
    $blotter_id = $_POST['blotter_id'];

    // If canceled, remove the date and time
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <style>
        #sidebar {
            width: 230px; 
            height: 100vh; 
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6; 
            position: fixed; 
            top: 0; 
            left: 0; 
            z-index: 1000; /* Ensure the sidebar is above other content */
        }

        #content {
            margin-left: 250px; /* Set margin for content to avoid overlap */
        }
    </style>
</head>
<body>
    <div id="sidebar">
        <div class="logo text-center py-3">
            <img src="../logonav.png" alt="Logo" class="img-fluid">
        </div>
        <ul class="list-unstyled">

            <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Admin Dashboard</a></li>
            <li><a href="staff.php"><i class="fas fa-users-cog"></i> Manage Staff</a></li>
            <li><a href="announcement.php"><i class="fas fa-bullhorn"></i> Manage Announcements</a></li>
            <li><a href="manage_blotter_report.php"><i class="fas fa-file-invoice"></i> Manage Blotter Report</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
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
            <table class="table">
                <thead>
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Report</th>
                        <th>Reason</th>
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
                        <td><?= htmlspecialchars($row['reason']) ?></td>
                        <td><?= ucfirst(htmlspecialchars($row['status'])) ?></td>
                        <td><?= $row['meeting_date'] ?: 'N/A' ?></td>
                        <td><?= $row['meeting_time'] ?: 'N/A' ?></td>
                        <td>
                            <div class="d-flex">
                                <form method="POST" action="manage_blotter_report.php" class="me-2">
                                    <input type="hidden" name="blotter_id" value="<?= $row['blotter_id'] ?>">
                                    <input type="date" name="meeting_date" required class="form-control d-inline" style="width: auto;">
                                    <input type="time" name="meeting_time" required class="form-control d-inline" style="width: auto;">
                                    <button type="submit" name="assign_meeting" class="btn btn-primary ms-2" onclick="return confirm('Are you sure you want to assign this meeting?');">Assign</button>
                                </form>
                                <form method="POST" action="manage_blotter_report.php">
                                    <input type="hidden" name="blotter_id" value="<?= $row['blotter_id'] ?>">
                                    <button type="submit" name="cancel_meeting" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this meeting?');">Cancel</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
