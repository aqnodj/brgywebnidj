<?php
// Include database connection
include("connections.php");

$fName = $mName = $lName = $suffix = $contact = $email = $password = $cpassword = "";
$fnameErr = $mnameErr = $lnameErr = $suffixErr = $contactErr = $emailErr = $passwordErr = $cpasswordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate First Name
    if (empty($_POST["fName"])) {
        $fnameErr = "First name is required";
    } else {
        $fName = $_POST["fName"];
    }

    // Validate Middle Name
    if (empty($_POST["mName"])) {
        $mnameErr = "Middle name is required";
    } else {
        $mName = $_POST["mName"];
    }

    // Validate Last Name
    if (empty($_POST["lName"])) {
        $lnameErr = "Last name is required";
    } else {
        $lName = $_POST["lName"];
    }

    // Validate Suffix
    if (empty($_POST["suffix"])) {
        $suffix = ""; // Suffix is optional
    } else {
        $suffix = $_POST["suffix"];
    }

    // Validate Contact Number
    if (empty($_POST["contact"])) {
        $contactErr = "Contact number is required";
    } else {
        $contact = $_POST["contact"];
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = $_POST["email"];
    }

    // Validate Password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = $_POST["password"];
    }

    // Validate Confirm Password
    if (empty($_POST["cpassword"])) {
        $cpasswordErr = "Confirm Password is required";
    } else {
        $cpassword = $_POST["cpassword"];
    }

    // Check if all required fields are filled and passwords match
    if ($fName && $mName && $lName && $contact && $email && $password && $cpassword && $password === $cpassword) {
        // Check if the email is already registered
        $check_email = mysqli_query($connections, "SELECT * FROM users WHERE email ='$email'");
        $check_email_row = mysqli_num_rows($check_email);

        if ($check_email_row > 0) {
            $emailErr = "Email is already registered";
        } else {
            // Hash the password before inserting (recommended)
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = mysqli_query($connections, "INSERT INTO users (firstname, middlename, lastname, suffix, contact, email, password, account_type) 
            VALUES ('$fName', '$mName', '$lName', '$suffix', '$contact', '$email', '$hashed_password', '3')"); // Default account type is 3 (Client)

            // Check if the query was successful
            if (!$query) {
                // Output error if the query fails
                die("Error inserting data: " . mysqli_error($connections));
            } else {
                // Redirect to login page
                header("Location: login.php"); // Change to the correct login page URL
                exit; // Ensure no further code is executed
            }
        }
    }
}
?>

<style>
    .error {
        color: red;
    }
</style>

<br>

<!-- HTML form -->
<div class="form-container">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        First Name: <input type="text" name="fName" placeholder="First Name" value="<?php echo htmlspecialchars($fName); ?>"> <br>
        <span class="error"><?php echo $fnameErr; ?></span> <br>

        Middle Name: <input type="text" name="mName" placeholder="Middle Name" value="<?php echo htmlspecialchars($mName); ?>"> <br>
        <span class="error"><?php echo $mnameErr; ?></span> <br>

        Last Name: <input type="text" name="lName" placeholder="Last Name" value="<?php echo htmlspecialchars($lName); ?>"> <br>
        <span class="error"><?php echo $lnameErr; ?></span> <br>

        Suffix: <input type="text" name="suffix" placeholder="Suffix" value="<?php echo htmlspecialchars($suffix); ?>"> <br>
        <span class="error"><?php echo $suffixErr; ?></span> <br>

        Contact: <input type="text" name="contact" placeholder="Contact Number" value="<?php echo htmlspecialchars($contact); ?>"> <br>
        <span class="error"><?php echo $contactErr; ?></span> <br>

        Email: <input type="text" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>"> <br>
        <span class="error"><?php echo $emailErr; ?></span> <br>

        Password: <input type="password" name="password" placeholder="Password"> <br>
        <span class="error"><?php echo $passwordErr; ?></span> <br>

        Confirm Password: <input type="password" name="cpassword" placeholder="Confirm Password"> <br>
        <span class="error"><?php echo $cpasswordErr; ?></span> <br>

        <input type="submit" value="Submit">

    </form>
</div>

<hr>

<div class="login-note">
    <p>Already have an account? <a href="login.php">Login</a>.</p>
</div>
