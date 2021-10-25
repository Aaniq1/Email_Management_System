<?php
require_once('connection.php');


class userModel
{
    public $dd="hdh";
    function __construct() {
        global $conn;
        $conn=dbConnection();
      }
      
    function existEmail($email)
    { 

        global $conn;
        $sql = "SELECT * FROM admin  WHERE email='$email'";
        $result =  mysqli_query($conn,$sql);
        if ($result->num_rows > 0) {
            return true;
        }
        else
        {
            return false;
        }
        
      
    }
    function merchantExistEmail($email)
    { 
        
        global $conn;
        $sql = "SELECT * FROM  merchant  WHERE email='$email'";
        $result = mysqli_query($conn,$sql);

        if ($result->num_rows>0) {
            return false;
        }
        else
        {
            return true;
        }
        
      
    }
    function userExistEmail($email)
    { 
        
        global $conn;
        $sql = "SELECT * FROM  secodary_user  WHERE email='$email'";
        $result = mysqli_query($conn,$sql);

        if ($result->num_rows>0) {
            return false;
        }
        else
        {
            return true;
        }
        
      
    }


    function adminAuth($email,$password)
    {
        global $conn;
        $sql = "SELECT * FROM admin  WHERE email='$email' AND password='$password' ";
        $result =  mysqli_query($conn,$sql);
        if ($result->num_rows > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }
    function mSignUp($email,$password,$user_name,$card_no,$address)
    {
        global $conn;
        $sql = "INSERT INTO merchant (name, email, password)VALUES ('$user_name', '$email', '$password')";
        $result =  mysqli_query($conn,$sql);
        $last_id = $conn->insert_id;
        $sql = "INSERT INTO billing_info (user_id,card_no,address)VALUES ('$last_id','$card_no','$address')";
        $result =  mysqli_query($conn,$sql);
        $sql = "INSERT INTO payments (user_id,amount)VALUES ('$last_id','50')";
        $result =  mysqli_query($conn,$sql);
        

    }
    function uSignUp($merchant_id,$user_name,$email,$password)
    {
        global $conn;

        $sql = "INSERT INTO secondry_user (merchant_id,name, email, password)VALUES ('$merchant_id','$user_name', '$email', '$password')";
        
        $result =  mysqli_query($conn,$sql);
        $last_id = $conn->insert_id;
        $sql = "INSERT INTO billing_info (user_id)VALUES ('$last_id')";
        $result =  mysqli_query($conn,$sql);
        $sql = "INSERT INTO payments (user_id,amount)VALUES ('$last_id','50')";
        $result =  mysqli_query($conn,$sql);
        
    }

    function generateToken($email,$token)
    {
        global $conn;
        $sql = "UPDATE admin SET token='$token' WHERE email='$email'";
        $result = mysqli_query($conn,$sql);
        $sql = "SELECT * FROM admin  WHERE email='$email'";
        $result =  mysqli_query($conn,$sql);
        while($row = $result->fetch_assoc()) {
            return $row['token'];
          }
        
    }
    function generateTokenMerchant($email,$token)
    {
        global $conn;
        $sql = "UPDATE merchant SET token='$token' WHERE email='$email'";
        $result = mysqli_query($conn,$sql);
        $sql = "SELECT * FROM merchant  WHERE email='$email'";
        $result =  mysqli_query($conn,$sql);
        while($row = $result->fetch_assoc()) {
            return $row['token'];
          }
        
    }
   
    function generateTokensUser($email,$token)
    {
        global $conn;
        $sql = "UPDATE secondary_user SET token='$token' WHERE email='$email'";
        $result = mysqli_query($conn,$sql);
        $sql = "SELECT * FROM secodary_user  WHERE email='$email'";
        $result =  mysqli_query($conn,$sql);
        while($row = $result->fetch_assoc()) 
        {
            return $row['token'];
          }
        
    }
    function merchantAuth($email,$password)
    {
        global $conn;
        $sql = "SELECT * FROM merchant  WHERE email='$email' AND password='$password' ";
        $result =  mysqli_query($conn,$sql);
        
        if ($result->num_rows > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }
    function checkAcessMerchant($token)
    {
        global $conn;
        $sql = "SELECT * FROM merchant  WHERE token='$token' ";
        $result =  mysqli_query($conn,$sql);
        $user_valid=mysqli_fetch_assoc($result);
        if ($result->num_rows > 0) {
            return array("valid"=>1,"user_data"=>$user_valid);
        }
        else
        {
            return false;
        }
    }
    function checkAcessAdmin($token)
    {
        global $conn;
        $sql = "SELECT * FROM admin  WHERE token='$token' ";
        $result =  mysqli_query($conn,$sql);
        if ($result->num_rows > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }
    function assignRole($role,$user_id)
    {
        global $conn;
        $sql = "INSERT INTO assign_role (user_id, role_id)VALUES ('$user_id', '$role')";
        $result =  mysqli_query($conn,$sql);
        return $result;
        
    }
    function roleListing($user_id)
    {
        global $conn;
        $sql = "SELECT *
        FROM role
        LEFT JOIN assign_role ON role.id = assign_role.role_id WhERE user_id='$user_id'";
        $array=array();
        $result =  mysqli_query($conn,$sql);
        while($row = $result->fetch_assoc()) {
            array_push($array,$row['role_name']);
          }
        return $array;
        
    }
    function merchentListing()
    {
        global $conn;
        $sql = "SELECT *
        FROM merchant m , role r, assign_role a,payments p,billing_info b
        WHERE r.id = a.role_id
        AND m.id = p.user_id
        AND m.id = b.user_id;
        ";
        $array=array();
        $result =  mysqli_query($conn,$sql);
        while($row = $result->fetch_assoc()) {
            array_push($array,$row);
          }
        return $array;
        
    }
    
}
?>