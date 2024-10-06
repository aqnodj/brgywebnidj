<?php
session_start(); // Start the session

$email = $password = "";
$emailErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Email Validation
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = $_POST["email"];
    }

    // Password Validation
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = $_POST["password"];
    }


    if ($email && $password) {
        include("connections.php");

        // check if the email exist
        $check_email = mysqli_query($connections, "SELECT * FROM users WHERE email='$email'");
        $check_email_row = mysqli_num_rows($check_email);

        if ($check_email_row > 0) {
            $row = mysqli_fetch_assoc($check_email);
            $user_id = $row["id"];
            $db_password = $row["password"];
            $db_account_type = $row["account_type"];

            // Pass verif
            if (password_verify($password, $db_password)) {
                // Set session variable
                $_SESSION["id"] = $user_id;

                // redirect in depends on account type
                if ($db_account_type == "1") {
                    echo "<script>window.location.href='admin/dashboard.php';</script>";
                } elseif ($db_account_type == "2") { // Staff
                    echo "<script>window.location.href='staff/dashboard.php';</script>";
                } else {
                    echo "<script>window.location.href='users/dashboard.php';</script>";
                }
            } else {
                $passwordErr = "Invalid password.";
            }
        } else {
            $emailErr = "Email is not registered!";
        }
    }
}
?>

<style>
    .error {
        color: red;
    }
</style>

<div class="form-container">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Email: <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>"> <br>
        <span class="error"><?php echo $emailErr; ?></span> <br>

        Password: <input type="password" name="password" value=""> <br>
        <span class="error"><?php echo $passwordErr; ?></span> <br>

        <input type="submit" value="Login">
    </form>
</div>
