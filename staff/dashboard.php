<?php
session_start();


// Access for staff Account only
if (!isset($_SESSION["staff_id"]) || $_SESSION["account_type"] != "2") {
    // Redirect to login page or show an error
    header("Location: ../login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff</title>
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

        /* Content styles */
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
            
                <li><a href="dashboard.php"><i class="fas fa-home"></i> Staff Dashboard</a></li>
                <li><a href="announcement.php"><i class="fas fa-bullhorn"></i> Manage Announcement</a></li>
                <li><a href="manage_user.php"><i class="fas fa-sign-out-alt"></i> Manage Residents</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>

        </ul>
    </div>
    <div id="content">
        
        
    </div>
</body>
</html>
    