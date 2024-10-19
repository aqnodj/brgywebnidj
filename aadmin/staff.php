<?php
session_start();
include '../connections.php'; 

// Add Staff
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $house_no = $_POST['house_no'];
    $street = $_POST['street'];
    $barangay = $_POST['barangay'];
    $municipality = $_POST['municipality'];
    $position = $_POST['position'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $account_type = 2;  // Set account type to 2 for staff

    // Insert into the staff table
    $query_staff = "INSERT INTO staff (last_name, first_name, middle_name, contact_number, email, password, house_no, street, barangay, municipality, position, age, sex, account_type) 
              VALUES ('$last_name', '$first_name', '$middle_name', '$contact_number', '$email', '$password', '$house_no', '$street', '$barangay', '$municipality', '$position', $age, '$sex', $account_type)";
    
    if (mysqli_query($connections, $query_staff)) {
        // Set success message
        $_SESSION['message'] = "Staff member added successfully.";
    } else {
        // Set error message
        $_SESSION['message'] = "Error adding staff member.";
    }

    // Insert into the users table for login purposes
    $query_user = "INSERT INTO users (email, password, account_type) 
              VALUES ('$email', '$password', $account_type)";

    mysqli_query($connections, $query_user);

    header("Location: staff.php");
    exit();
}

// Update Staff
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $house_no = $_POST['house_no'];
    $street = $_POST['street'];
    $barangay = $_POST['barangay'];
    $municipality = $_POST['municipality'];
    $position = $_POST['position'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];

    $query = "UPDATE staff SET last_name='$last_name', first_name='$first_name', middle_name='$middle_name', contact_number='$contact_number', email='$email', house_no='$house_no', street='$street', barangay='$barangay', municipality='$municipality', position='$position', age=$age, sex='$sex' WHERE id=$id";

    if (mysqli_query($connections, $query)) {
        $_SESSION['message'] = "Staff member updated successfully."; // Set success message
    } else {
        $_SESSION['message'] = "Error updating staff member."; // Set error message
    }
    header("Location: staff.php");
    exit();
}

// Delete Staff
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Delete staff from staff table
    $query = "DELETE FROM staff WHERE id=$id";

    if (mysqli_query($connections, $query)) {
        $_SESSION['message'] = "Staff member deleted successfully."; // Set success message
    } else {
        $_SESSION['message'] = "Error deleting staff member."; // Set error message
    }

    header("Location: staff.php");
    exit();
}

// Read Data
$result = mysqli_query($connections, "SELECT * FROM staff");
$staff = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Staff</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        function openUpdateModal(member) {
            document.getElementById('updateId').value = member.id;
            document.getElementById('updateLastName').value = member.last_name;
            document.getElementById('updateFirstName').value = member.first_name;
            document.getElementById('updateMiddleName').value = member.middle_name;
            document.getElementById('updateContactNumber').value = member.contact_number;
            document.getElementById('updateEmail').value = member.email;
            document.getElementById('updateHouseNo').value = member.house_no;
            document.getElementById('updateStreet').value = member.street;
            document.getElementById('updateBarangay').value = member.barangay;
            document.getElementById('updateMunicipality').value = member.municipality;
            document.getElementById('updatePosition').value = member.position;
            document.getElementById('updateAge').value = member.age;
            document.getElementById('updateSex').value = member.sex;

            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('updateModal'));
            modal.show();
        }

        function openAddModal() {
            const modal = new bootstrap.Modal(document.getElementById('addModal'));
            modal.show();
        }
        
    </script>

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
            <li><a href="dashboard.php"><i class="fas fa-home"></i> Admin Dashboard</a></li>
            <li><a href="staff.php"><i class="fas fa-home"></i> Manage Staff</a></li>
            <li><a href="announcement.php"><i class="fas fa-home"></i> Manage Announcement</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    <div id="content" class="container mt-4">
       
        <h1>Manage Staff</h1>

        <!-- Notification -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message']); // Clear notif pagkadisplay ?>
        <?php endif; ?>
        
        <button class="btn btn-primary mb-3" onclick="openAddModal()">Add New Staff</button>

        <!-- Staff List -->
        <h3>Staff List</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Position</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($staff as $member): ?>
                <tr>
                    <td><?= $member['last_name'] . ', ' . $member['first_name'] . ' ' . $member['middle_name'] ?></td>
                    <td><?= $member['position'] ?></td>
                    <td>
                        <button class="btn btn-warning" onclick='openUpdateModal(<?= json_encode($member) ?>)'>Update</button>
                        <a href="staff.php?delete=<?= $member['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this staff member?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Staff Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add New Staff</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h7>Last Name:</h7>
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                        <h7>First Name:</h7>
                        <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                        <h7>Middle Name:</h7>
                        <input type="text" name="middle_name" class="form-control" placeholder="Middle Name">
                        <h7>Contact Number:</h7>
                        <input type="text" name="contact_number" class="form-control" placeholder="Contact Number" required>
                        <h7>Email:</h7>
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                        <h7>Password:</h7>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <h7>House No:</h7>
                        <input type="text" name="house_no" class="form-control" placeholder="House No" required>
                        <h7>Street:</h7>
                        <input type="text" name="street" class="form-control" placeholder="Street" required>
                        <h7>Barangay:</h7>
                        <input type="text" name="barangay" class="form-control" placeholder="Barangay" required>
                        <h7>Municipality:</h7>
                        <input type="text" name="municipality" class="form-control" placeholder="Municipality" required>
                        <h7>Position:</h7>
                        <input type="text" name="position" class="form-control" placeholder="Position" required>
                        <h7>Age:</h7>
                        <input type="number" name="age" class="form-control" placeholder="Age" required>
                        <h7>Sex:</h7>
                        <select name="sex" class="form-control" required>
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="create" class="btn btn-primary">Add Staff</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Staff Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Staff Member</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="updateId">
                        <h7>Last Name:</h7>
                        <input type="text" name="last_name" id="updateLastName" class="form-control" required>
                        <h7>First Name:</h7>
                        <input type="text" name="first_name" id="updateFirstName" class="form-control" required>
                        <h7>Middle Name:</h7>
                        <input type="text" name="middle_name" id="updateMiddleName" class="form-control">
                        <h7>Contact Number:</h7>
                        <input type="text" name="contact_number" id="updateContactNumber" class="form-control" required>
                        <h7>Email:</h7>
                        <input type="email" name="email" id="updateEmail" class="form-control" required>
                        <h7>House No:</h7>
                        <input type="text" name="house_no" id="updateHouseNo" class="form-control" required>
                        <h7>Street:</h7>
                        <input type="text" name="street" id="updateStreet" class="form-control" required>
                        <h7>Barangay:</h7>
                        <input type="text" name="barangay" id="updateBarangay" class="form-control" required>
                        <h7>Municipality:</h7>
                        <input type="text" name="municipality" id="updateMunicipality" class="form-control" required>
                        <h7>Position:</h7>
                        <input type="text" name="position" id="updatePosition" class="form-control" required>
                        <h7>Age:</h7>
                        <input type="number" name="age" id="updateAge" class="form-control" required>
                        <h7>Sex:</h7>
                        <select name="sex" id="updateSex" class="form-control" required>
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update" class="btn btn-primary">Update Staff</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
