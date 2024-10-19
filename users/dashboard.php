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
         
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    <div id="content">
        
      
    </div>
</body>
</html>
    