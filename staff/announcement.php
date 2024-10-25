<?php
session_start(); 

// Access for Staff Account only
if (!isset($_SESSION["staff_id"]) || $_SESSION["account_type"] != "2") {
    
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
                    text: 'Staff lang ang may access dito',
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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Announcement</title> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>
    <style>
        
        #sidebar {
            width: 250px; 
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
        <div class="logo">
            <img src="../logonav.png" alt="Logo">
        </div>
        <ul>
            <li><a href="dashboard.php"><i class="fas fa-user-tie"></i> Staff Dashboard</a></li>
            <li><a href="announcement.php"><i class="fas fa-bullhorn"></i> Manage Announcements</a></li>
            <li><a href="manage_user.php"><i class="fas fa-users"></i> Manage Residents</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </div>
    
    <div id="content">
        <div class="row mt-4">
            
            <div class="col-lg-4">
                <h3 id="formTitle">Add Announcement</h3>
                <form id="announcementForm" action="announcement.php" method="POST">
                    <input type="hidden" id="announcementId" name="announcementId">
                    <div class="mb-3">
                        <label for="message" class="form-label">Announcement Message:</label>
                        <textarea class="form-control" id="message" name="message" rows="4" placeholder="Enter announcement message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success" id="submitBtn">Add Announcement</button>
                </form>
            </div>

            <!-- List -->
            <div class="col-lg-8">
                <h3>Announcements List</h3>
                <div class="list-group" id="announcementList">
                    <?php
                   
                    include '../connections.php';

                    // insert delete update
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $message = mysqli_real_escape_string($connections, $_POST['message']); // Escape the message
                        
                        if (isset($_POST['announcementId']) && !empty($_POST['announcementId'])) {
                        //    update
                            $announcementId = intval($_POST['announcementId']);
                            $sql = "UPDATE announcement SET message = '$message', date = NOW() WHERE id = $announcementId";

                            if (mysqli_query($connections, $sql)) {
                                echo "<div class='alert alert-success'>Announcement updated successfully.</div>";
                            } else {
                                echo "<div class='alert alert-danger'>Error: " . mysqli_error($connections) . "</div>";
                            }
                        } else {
                            // Insert new announcement
                            $sql = "INSERT INTO announcement (message, date) VALUES ('$message', NOW())";

                            if (mysqli_query($connections, $sql)) {
                                echo "<div class='alert alert-success'>Announcement added successfully.</div>";
                            } else {
                                echo "<div class='alert alert-danger'>Error: " . mysqli_error($connections) . "</div>";
                            }
                        }
                    }

                    // Delete Announcement Logic
                    if (isset($_GET['delete_id'])) {
                        $deleteId = intval($_GET['delete_id']);
                        $sql = "DELETE FROM announcement WHERE id = $deleteId";

                        if (mysqli_query($connections, $sql)) {
                            echo "<div class='alert alert-success'>Announcement deleted successfully.</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Error: " . mysqli_error($connections) . "</div>";
                        }
                    }

                    // Fetch and display announcements
                    $result = mysqli_query($connections, "SELECT * FROM announcement ORDER BY date DESC");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='list-group-item d-flex justify-content-between align-items-center'>";
                        echo "<div class='me-auto'>";
                        echo nl2br(htmlspecialchars($row['message'])) . "<br>"; // Message with line breaks
                        echo "<small>Posted on: " . $row['date'] . "</small>";
                        echo "</div>";
                        echo "<div class='btn-group'>";
                        echo "<button class='btn btn-primary btn-sm me-2' onclick='editAnnouncement(" . $row['id'] . ", \"" . htmlspecialchars($row['message']) . "\")'>Update</button>";
                        echo "<a href='announcement.php?delete_id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this announcement?\")'>Delete</a>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Notification Area -->
        <div id="notification" class="alert alert-success mt-4" style="display: none;">
            Announcement has been successfully added/updated/deleted.
        </div>
    </div>

    <script>
        // Populate the form with announcement data for editing
        function editAnnouncement(id, message) {
            document.getElementById('announcementId').value = id;
            document.getElementById('message').value = message;
            document.getElementById('formTitle').innerText = 'Update Announcement';
            document.getElementById('submitBtn').innerText = 'Update Announcement';
        }
    </script>
</body>
</html>
