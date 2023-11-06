<?php 
session_start();
require_once('../model/profileModel.php');
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

if ($username == "" || $password == "") {
    echo "null username/password!";
} else {
    $user = getUserByUsernameAndPassword($username, $password); // Assuming you have a function like this

    if ($user) {
        $_SESSION['id'] = $user['id']; // Set the user's ID in the session
        $_SESSION['flag'] = "true";
        header('location: ../view/profile.php');
    } else {
        echo "invalid user!";
    }
}
?>
