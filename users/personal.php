<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Personal Information</title>
    <link rel="stylesheet" href="personal.css">
</head>
<body>
    <div class="container">
        <h1>Edit Personal Information</h1>
        <form action="update_info.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>

            <div class="form-group">
                <label for="middle_name">Middle Name:</label>
                <input type="text" id="middle_name" name="middle_name">
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>

            <div class="form-group">
                <label for="street">Street:</label>
                <input type="text" id="street" name="street">
            </div>

            <div class="form-group">
                <label for="brgy">Barangay:</label>
                <input type="text" id="brgy" name="brgy">
            </div>

            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city">
            </div>

            <div class="form-group">
                <label for="province">Province:</label>
                <input type="text" id="province" name="province">
            </div>

            <div class="form-group">
                <label for="citizenship">Citizenship:</label>
                <input type="text" id="citizenship" name="citizenship">
            </div>

            <div class="form-group">
                <label for="religion">Religion:</label>
                <input type="text" id="religion" name="religion">
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="birthdate">Birthdate:</label>
                <input type="date" id="birthdate" name="birthdate" required>
            </div>

            <div class="form-group">
                <label for="birthplace">Birthplace:</label>
                <input type="text" id="birthplace" name="birthplace">
            </div>

            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" required>
            </div>

            <div class="form-group">
                <label for="civil_status">Civil Status:</label>
                <select id="civil_status" name="civil_status" required>
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                    <option value="divorced">Divorced</option>
                    <option value="widowed">Widowed</option>
                </select>
            </div>

            <div class="form-group">
                <label for="profession">Profession/Occupation:</label>
                <input type="text" id="profession" name="profession">
            </div>

            <div class="form-group">
                <label for="contact_number">Contact Number:</label>
                <input type="tel" id="contact_number" name="contact_number" required>
            </div>

            <div class="form-group">
                <label for="id">ID Number:</label>
                <input type="text" id="id" name="id" required>
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
            </div>

            <button type="submit">Update Information</button>
        </form>
    </div>
</body>
</html>
