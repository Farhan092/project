<html>
<head>
    <title>Change Password</title>
</head>
<body>
    <fieldset>
        <legend><b>CHANGE PASSWORD</b></legend>
        <form action="../controller/passwordCheck.php" method="post">
            Current Password : <input type="text" name="currentPassword" value="" required> <br>
            <br>
            New Password : <input type="password" name="newPassword" value="" required> <br>
            <br>
            Retype New Password : <input type="password" name="retypedPassword" value="" required>
            <hr>
            <input type="submit" id="" name="" value="Submit">
            <h4><a href="profile.php"> Back to profile <a></h4>
        </form>
    </fieldset>
</body>
</html>