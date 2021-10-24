<?php
class mSignUp
{
    function __construct() {
        require_once('model_db.php');
        require_once('MailCatcher.php');
      }
      public function signUp($email,$password,$user_name,$card_no,$address)
      {
        $user_model=new userModel();
            $response=$user_model->marchantExsistEmail($email);
            $newarray=array();
            // echo $response;
            if (!$response)
            {
                $newarray=["204",'Email Already Exsist'];
                echo json_encode($newarray);
               
            }
            $signup_response=$user_model->mSignUp($email,md5($password),$user_name,$card_no,$address);
            
            $mail_response=smtp_mailer($email,"Weclome!",'Congrats! You have credit $50');
            if($mail_response)
            {
            $myObj = new stdClass();
            $myObj->status = "valid";
            $myObj->key = 200;
            $myObj->message = "Sign Up Successfully";
            $myObj->description = "Now you can access any module";
            echo json_encode($myObj);
            }
            else
            {
            $myObj = new stdClass();
            $myObj->status = "invalid";
            $myObj->key = 400;
            $myObj->message = "Sinup Failed";
            $myObj->description = "Try again";
            echo json_encode($myObj);
            }
            
            
           
        
        
        
        
        
      }
}

$inputArr=['user_name','email','password','card_no','address'];

if (isset($_POST['email']) && isset($_POST['password'])&& isset($_POST['user_name']))
{
$email=$_POST['email'];
$password=$_POST['password'];
$user_name=$_POST['user_name'];
$card_no=$_POST['card_no'];
$address=$_POST['address'];
$merchant_class=new mSignUp();
$merchant_class->signUp($email,$password,$user_name,$card_no,$address);
}
?>