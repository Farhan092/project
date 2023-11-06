<?php
session_start();
require_once('../model/db.php');
require_once('../model/profileModel.php');
require_once('../controller/profileUpdateCheck.php');

if (!isset($_SESSION['id'])) {
    echo "You have been logged out. Please log in again.";
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['id'];
$user = getUser($user_id);

if (!$user) {
    echo "User not found.";
    exit();
}

$updated = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $validationData = [
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'full_name' => $_POST['full_name'],
        'country' => $_POST['country'],
        'birthdate' => $_POST['birthdate'],
        'mobile_number' => $_POST['mobile_number'],
    ];

    $errors = validateProfileUpdate($validationData);

    if (empty($errors)) {
        $newUsername = $validationData['username'];
        $newEmail = $validationData['email'];
        $newFullName = $validationData['full_name'];
        $newCountry = $validationData['country'];
        $newBirthdate = $validationData['birthdate'];
        $newMobileNumber = $validationData['mobile_number'];

        $updated = updateUser($user_id, $newUsername, $newEmail, $newFullName, $newCountry, $newBirthdate, $newMobileNumber);

        if ($updated) {
            echo "Profile updated successfully!";
            $user = getUser($user_id);
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
</head>
<body>
<fieldset>
    <legend><h1><b>Edit Profile</b></h1></legend>
    <form method="post" action="updateUser.php">
        <b>Username:</b><input type="text" name="username" value="<?php echo isset($user['username']) ? $user['username'] : ''; ?>" required><br><br>
        <b>Email:</b><input type="email" name="email" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>" required><br><br>

        <b>Full Name:</b><input type="text" name="full_name" value="<?php echo isset($user['full_name']) ? $user['full_name'] : ''; ?>"><br><br>

        <b>Country:</b><input type="text" name="country" value="<?php echo isset($user['country']) ? $user['country'] : ''; ?>"><br><br>

        <b>Birthdate:</b><input type="date" name="birthdate" value="<?php echo isset($user['birthdate']) ? $user['birthdate'] : ''; ?>"><br><br>

        <b>Mobile Number:</b><input type="tel" name="mobile_number" value="<?php echo isset($user['mobile_number']) ? $user['mobile_number'] : ''; ?>"><br><br>
        <hr>

        <input type="submit" value="Submit">
        <h4><a href="profile.php"> Back to profile <a></h4>
    </form>
</body>
</html>
