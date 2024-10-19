<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
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
            <li><a href="dashboard.php"><i class="fas fa-home"></i> User Dashboard</a></li>
            <li><a href="blotter_report.php"><i class="fas fa-home"></i> Report Blotter</a></li>
            <li><a href="view_announcement.php"><i class="fas fa-home"></i> Announcement</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    <div id="content">
        
      
    </div>
</body>
</html>
    