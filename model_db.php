<?php
require_once('connection.php');


class userModel
{
      
      function __construct() {
        global $conn;
        $conn=dbConnection();
      }
      
    function existEmail($email)
    { 

        global $conn;
        $sql = "SELECT * FROM user  WHERE email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return true;
        }
        else
        {
            return false;
        }
        
      
    }
    function resetPassword($email,$new_password)
    {
        global $conn;
        $sql = "UPDATE user SET password='$new_password' WHERE email='$email'";
        $result = mysqli_query($conn,$sql);
        return $result;
    }
}
?>