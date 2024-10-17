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
        /* Additional CSS for dynamic margin adjustment */
        #content {
            transition: margin-left 0.3s; /* Smooth transition for margin adjustment */
        }
        #sidebar {
            width: 250px; /* Set sidebar width */
            transition: margin-left 0.3s; /* Smooth transition for sidebar */
        }
        #sidebar.hidden {
            margin-left: -250px; /* Hide sidebar offscreen */
        }
    </style>
</head>
<body>
    <div id="sidebar" class="hidden">
        <div class="logo">
            <img src="../logonav.png" alt="Logo">
        </div>
        <ul>
            <li><a href="dashboard.php"><i class="fas fa-home"></i> Admin Dashboard</a></li>
            <li><a href="staff.php"><i class="fas fa-users"></i> Manage Staff</a></li>
            <li><a href="announcement.php"><i class="fas fa-users"></i> Manage Announcement</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    
    <div id="content" style="margin-left: 0;">
        <button id="toggle-btn" class="btn btn-primary mt-3" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>

        <div class="row mt-4">
            <!-- Announcement Form (left side) -->
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

            <!-- Announcement List (right side) -->
            <div class="col-lg-8">
                <h3>Announcements List</h3>
                <div class="list-group" id="announcementList">
                    <?php
                    // Include database connection
                    include '../connections.php';

                    // Insert, Update, and Delete Logic
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $message = mysqli_real_escape_string($connections, $_POST['message']); // Escape the message
                        
                        if (isset($_POST['announcementId']) && !empty($_POST['announcementId'])) {
                            // Update announcement
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
                        echo "<strong>🐾 Pawville Annual Dog League Announcement 🐾</strong><br>"; // Sample bold title with emojis
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
        // Function to toggle sidebar visibility
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');

            if (sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden');
                content.style.marginLeft = '250px'; // Adjust margin when sidebar is open
            } else {
                sidebar.classList.add('hidden');
                content.style.marginLeft = '0'; // Reset margin when sidebar is closed
            }
        }

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
