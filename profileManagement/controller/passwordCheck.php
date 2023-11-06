<?php
session_start();
require_once('../model/db.php');
require_once('../model/profileModel.php');

if (!isset($_SESSION['id'])) {
    header('Location: ../view/login.php');
    exit();
}

$user_id = $_SESSION['id'];
$user = getUser($user_id);

if (!$user) {
    echo "User not found.";
    exit();
}

$currentPassword = $_POST['currentPassword'];
$newPassword = $_POST['newPassword'];
$retypedPassword = $_POST['retypedPassword'];

$minPasswordLength = 8;
$requireUppercase = true;
$requireLowercase = true;
$requireDigit = true;
$requireSpecialChar = true;


$con = getConnection();
$sql = "SELECT password FROM users WHERE id = $user_id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$storedPassword = $row['password'];

if ($currentPassword !== $storedPassword) {
    echo "Current password is incorrect.";
    exit();
}
else if($currentPassword !== $storedPassword){
    header('Location: ../view/profile.php');
}


if (strlen($newPassword) < $minPasswordLength) {
    echo "New password is too short. It must be at least $minPasswordLength characters long.";
    exit();
}

if ($requireUppercase && !containsUppercase($newPassword)) {
    echo "New password must contain at least one uppercase letter.";
    exit();
}

if ($requireLowercase && !containsLowercase($newPassword)) {
    echo "New password must contain at least one lowercase letter.";
    exit();
}

if ($requireDigit && !containsDigit($newPassword)) {
    echo "New password must contain at least one digit.";
    exit();
}

if ($requireSpecialChar && !containsSpecialChar($newPassword)) {
    echo "New password must contain at least one special character.";
    exit();
}
if ($newPassword !== $retypedPassword) {
    echo "New password and retyped password do not match.";
    exit();
}
if ($result) {
    $sql = "UPDATE users SET password = '$newPassword' WHERE id = $user_id";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "Password changed successfully!";
        header('Location:../view/profile.php');
        exit();
    } else {
        echo "Password update failed. Please try again.";
    }
} else {
    echo "Password update failed. Please try again.";
}

function containsUppercase($str) {
    for ($i = 0; $i < strlen($str); $i++) {
        if ($str[$i] >= 'A' && $str[$i] <= 'Z') {
            return true;
        }
    }
    return false;
}

function containsLowercase($str) {
    for ($i = 0; $i < strlen($str); $i++) {
        if ($str[$i] >= 'a' && $str[$i] <= 'z') {
            return true;
        }
    }
    return false;
}
function containsDigit($str) {
    for ($i = 0; $i < strlen($str); $i++) {
        if ($str[$i] >= '0' && $str[$i] <= '9') {
            return true;
        }
    }
    return false;
}
function containsSpecialChar($str) {
    $specialChars = '!@#$%^&*()_+[]{}|;:,.<>?';
    for ($i = 0; $i < strlen($str); $i++) {
        if (strpos($specialChars, $str[$i]) !== false) {
            return true;
        }
    }
    return false;
}
?>
