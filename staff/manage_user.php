<?php
session_start();
include '../connections.php'; 

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
                    text: 'You do not have permission to access this page.',
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
// Add User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $first_name = $_POST['firstname'];
    $middle_name = $_POST['middlename'];
    $last_name = $_POST['lastname'];
    $suffix = $_POST['suffix'];
    $contact_number = $_POST['contact'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $account_type = 3;  // Set account type to 3 for users
    $created_at = date('Y-m-d H:i:s'); // Current timestamp

    // Insert into the users table
    $query_user = "INSERT INTO users (firstname, middlename, lastname, suffix, contact, email, password, account_type, created_at) 
              VALUES ('$first_name', '$middle_name', '$last_name', '$suffix', '$contact_number', '$email', '$password', $account_type, '$created_at')";
    
    if (mysqli_query($connections, $query_user)) {
        $_SESSION['message'] = "User added successfully.";
    } else {
        $_SESSION['message'] = "Error adding user.";
    }

    header("Location: manage_user.php");
    exit();
}

// Update User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $first_name = $_POST['firstname'];
    $middle_name = $_POST['middlename'];
    $last_name = $_POST['lastname'];
    $suffix = $_POST['suffix'];
    $contact_number = $_POST['contact'];
    $email = $_POST['email'];

    $query = "UPDATE users SET firstname='$first_name', middlename='$middle_name', lastname='$last_name', suffix='$suffix', contact='$contact_number', email='$email' WHERE id=$id";

    if (mysqli_query($connections, $query)) {
        $_SESSION['message'] = "User updated successfully.";
    } else {
        $_SESSION['message'] = "Error updating user.";
    }
    header("Location: manage_user.php");
    exit();
}
// Delete User
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // First, delete related records from blotter_report
    $query_delete_blotter = "DELETE FROM blotter_report WHERE user_id=$id";
    mysqli_query($connections, $query_delete_blotter);

    // Now delete user from users table
    $query = "DELETE FROM users WHERE id=$id";

    if (mysqli_query($connections, $query)) {
        $_SESSION['message'] = "User deleted successfully.";
    } else {
        $_SESSION['message'] = "Error deleting user.";
    }

    header("Location: manage_user.php");
    exit();
}

// Read Data
$result = mysqli_query($connections, "SELECT * FROM users WHERE account_type = 3");
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        function openUpdateModal(user) {
            document.getElementById('updateId').value = user.id;
            document.getElementById('updateFirstName').value = user.firstname;
            document.getElementById('updateMiddleName').value = user.middlename;
            document.getElementById('updateLastName').value = user.lastname;
            document.getElementById('updateSuffix').value = user.suffix;
            document.getElementById('updateContactNumber').value = user.contact;
            document.getElementById('updateEmail').value = user.email;

            const modal = new bootstrap.Modal(document.getElementById('updateModal'));
            modal.show();
        }

        function openAddModal() {
            const modal = new bootstrap.Modal(document.getElementById('addModal'));
            modal.show();
        }
    </script>

    <style>
        #sidebar {
            width: 250px;
            height: 100vh;
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        #content {
            margin-left: 250px;
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
        </ul>
    </div>
    <div id="content" class="container mt-4">
        <h1>Manage Users</h1>

        <!-- Notification -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <button class="btn btn-primary mb-3" onclick="openAddModal()">Add New User</button>

        <!-- User List -->
        <h3>User List</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                  
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= ucfirst(strtolower($user['lastname'])) . ', ' . ucfirst(strtolower($user['firstname'])) . ' ' . ucfirst(substr(strtolower($user['middlename']),0, 1)) . '.' ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['contact'] ?></td>
                    
                    <td>
                        <button class="btn btn-warning" onclick='openUpdateModal(<?= json_encode($user) ?>)'>Update</button>
                        <a href="manage_user.php?delete=<?= $user['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h7>First Name:</h7>
                        <input type="text" name="firstname" class="form-control" placeholder="First Name" required>
                        <h7>Middle Name:</h7>
                        <input type="text" name="middlename" class="form-control" placeholder="Middle Name">
                        <h7>Last Name:</h7>
                        <input type="text" name="lastname" class="form-control" placeholder="Last Name" required>
                        <h7>Suffix:</h7>
                        <input type="text" name="suffix" class="form-control" placeholder="Suffix">
                        <h7>Contact Number:</h7>
                        <input type="text" name="contact" class="form-control" placeholder="Contact Number" required>
                        <h7>Email:</h7>
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                        <h7>Password:</h7>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="create">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update User Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="updateId">
                        <h7>First Name:</h7>
                        <input type="text" name="firstname" id="updateFirstName" class="form-control" required>
                        <h7>Middle Name:</h7>
                        <input type="text" name="middlename" id="updateMiddleName" class="form-control">
                        <h7>Last Name:</h7>
                        <input type="text" name="lastname" id="updateLastName" class="form-control" required>
                        <h7>Suffix:</h7>
                        <input type="text" name="suffix" id="updateSuffix" class="form-control">
                        <h7>Contact Number:</h7>
                        <input type="text" name="contact" id="updateContactNumber" class="form-control" required>
                        <h7>Email:</h7>
                        <input type="email" name="email" id="updateEmail" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="update">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
