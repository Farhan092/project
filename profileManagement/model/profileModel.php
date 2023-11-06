<?php
    require_once('db.php');

    function login($username, $password){
        $con = getConnection();
        $sql = "select * from users where username='{$username}' and password='{$password}'";
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);

        if($count == 1){
            return true;
        }else{
            return false;
        }
    }
    function getUserByUsernameAndPassword($username, $password) {
        $con = getConnection();
    
        $sql = "SELECT `id`, `username` FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($con, $sql);
    
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            return null;
        }
    }
    
    function createUser(){

    }

    function getUser($id) {
      $con = getConnection();
  
      $sql = "select `id`, `username`, `email`, `full_name`, `country`, `birthdate`, `mobile_number` from users WHERE id = $id";
      $result = mysqli_query($con, $sql);
  
      if ($result && mysqli_num_rows($result) > 0) {
          return mysqli_fetch_assoc($result);
      } else {
          return null;
      }
    }

    
    function getAllUser(){
        $con = getConnection();
        $sql = "select `id`, `username`, `email`, `full_name`, `country`, `birthdate`, `mobile_number` from users";
        $result = mysqli_query($con, $sql);
        $users = [];
        while($row = mysqli_fetch_assoc($result)){
            array_push($users, $row);
        }

        return $users;
    } 
    function updateUser($id, $username, $email, $full_name, $country, $birthdate, $mobile_number) {
      $con = getConnection();   
      $sql = "UPDATE users SET username='$username', email='$email', full_name='$full_name', country='$country', birthdate='$birthdate', mobile_number='$mobile_number' WHERE id=$id";
          
      $result = mysqli_query($con, $sql);
          
      if ($result) {
          return true;
      } else {

          echo "Error: " . mysqli_error($con);
          return false; 
      }
  }
  

        function deleteUser($id) {
            $con = getConnection();
            $sql = "DELETE FROM users WHERE id=$id";
            $result = mysqli_query($con, $sql);
        
            if ($result) {
                return true; 
            } else {
                return false; 
            }
        }
?>
