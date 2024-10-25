<?php
session_start();

// Check if the user is logged in and is a regular user
if (!isset($_SESSION["user_id"]) || $_SESSION["account_type"] != "3") {
    // Redirect to login page or show an error
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Current Announcement</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>

    <style>
        
        #announcementList {
            max-width: 100%;
            word-wrap: break-word; /* Ensure long words wrap properly */
            overflow-wrap: break-word;
        }

        .announcement-item {
            max-width: 100%; /* Limit each announcement to not exceed the container */
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

       
        .list-group-item {
            padding: 15px;
            border-radius: 8px;
        }

        .list-group-item h5 {
            font-weight: bold; /* Make titles bold */
        }
        
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
        <ul class="list-unstyled">
            
            <li><a href="dashboard.php"><i class="fas fa-home"></i> User Dashboard</a></li>
            <li><a href="blotter_report.php"><i class="fas fa-home"></i> Report Blotter</a></li>
            <li><a href="view_announcement.php"><i class="fas fa-home"></i> Announcement</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        
        </ul>
    </div>
    
    <div id="content" class="container" style="margin-left: 250px;">
       

        <!-- Announcement List (Read Only) -->
        <div class="mt-4">
            <h3>Current Announcements</h3>
            <div class="list-group" id="announcementList">
                <?php
                // Include database connection
                include '../connections.php';

                // Fetch and display announcements (read-only)
                $result = mysqli_query($connections, "SELECT * FROM announcement ORDER BY date DESC");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='list-group-item announcement-item mb-3'>";
                   
                    echo "<p>" . nl2br(htmlspecialchars($row['message'])) . "</p>"; // Line breaks for the message
                    echo "<small class='text-muted'>Posted on: " . $row['date'] . "</small>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
