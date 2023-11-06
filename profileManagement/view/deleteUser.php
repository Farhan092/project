<?php
session_start();
require_once('../model/db.php');

if (!isset($_SESSION['id'])) {
    echo "You have been logged out. Please log in again.";
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['id'];
$con = getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
    $sql = "DELETE FROM users WHERE id = $user_id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        // echo "User deleted successfully!";
        $_SESSION['delete_success'] = "User deleted successfully!";
        header('Location: login.php');
        exit();
    } else {
        echo "Deletion failed!";
        header('Location: profile.php');
        exit();
    }
}
?>
<form method="post">
    <button type="submit" name="confirm" value="1">Delete Account</button>
</form>
