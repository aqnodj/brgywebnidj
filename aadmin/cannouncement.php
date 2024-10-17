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
        /* Limit the announcement container to fit nicely within the screen */
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

        /* Add padding/margins to ensure proper spacing */
        .list-group-item {
            padding: 15px;
            border-radius: 8px;
        }

        .list-group-item h5 {
            font-weight: bold; /* Make titles bold */
        }
    </style>
</head>
<body>
    <div id="sidebar">
        <div class="logo">
            <img src="../logonav.png" alt="Logo">
        </div>
        <ul class="list-unstyled">
            <li><a href="#"><i class="fas fa-home"></i> User Dashboard</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    
    <div id="content" class="container" style="margin-left: 250px;">
        <button id="toggle-btn" class="btn btn-primary mt-3"><i class="fas fa-bars"></i></button>

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
                    echo "<h5>🐾 Pawville Annual Dog League Announcement 🐾</h5>"; // Bold and emojis for the title
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
