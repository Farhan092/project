<?php
session_start();
require_once('../model/profileModel.php');

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}
$user_id = $_SESSION['id'];
$user = getUser($user_id);

if (!$user) {
    echo "User not found.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
</head>
<body>
    <fieldset>
        <legend><h1><b>Profile</b></h1></legend>
        <form action="#" method="post">
        <h2>Profile Information</h2>
        <p>
            <b>ID:</b><input type="text" name="id" value="<?php echo $user['id']; ?>" readonly><br><br>

            <b>Username:</b><input type="text" name="username" value="<?php echo $user['username']; ?>" readonly><br><br>

            <b>Email:</b><input type="text"name="email" value="<?php echo $user['email']; ?>" readonly><br><br>

            <b>Full Name:</b><input type="text" name="full_name" value="<?php echo $user['full_name']; ?>" readonly><br><br>

            <b>Country:</b><input type="text" name="country" value="<?php echo $user['country']; ?>" readonly><br><br>

            <b>Birthdate:</b><input type="text" name="birthdate" value="<?php echo $user['birthdate']; ?>" readonly><br><br>

            <b>Mobile Number:</b><input type="text" name="mobile_number" value="<?php echo $user['mobile_number']; ?>" readonly><br><br>
        </p>
        <hr>
        <h2><a href="updateUser.php"> Edit Profile </a></h2>
        <h2><a href="changePassword.php"> Change Password <a></h2>
        <h3><a href="deleteUser.php"> Delete User <a></h3>
        </form>
        <h3><a href="logout.php"> Log Out <a></h3>
    </fieldset>
</body>
</html>

