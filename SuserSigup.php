<?php
ini_set('display_error',1);
class uSignUp
{
    function __construct() {
        require_once('model_db.php');
        require_once('MailCatcher.php');
      }
      public function sSignUp($user_name,$email,$password,$token)
      {
        $user_model=new userModel();
        $check_validation= $user_model->checkAcessMerchant($token);    
        if($check_validation){
            
            $merchant_id=$check_validation['user_data']['id'];
            $response=$user_model->userExistEmail($email);
            $newarray=array();
            // echo $response;
            if (!$response)
            {
                $newarray=["204",'Email Already Exsist'];
                echo json_encode($newarray);
               
            }
             $uSignUp_response=$user_model->uSignUp($merchant_id,$user_name,$email,md5($password));
        
        }    
            
            $mail_response=smtp_mailer($email,"Weclome!",'Your account created');
            if($mail_response)
            {
            $myObj = new stdClass();
            $myObj->status = "valid";
            $myObj->key = 200;
            $myObj->message = "Sign Up Successfully";
            $myObj->description = "Now you can access ";
            echo json_encode($myObj);
            }
            else
            {
            $myObj = new stdClass();
            $myObj->status = "invalid";
            $myObj->key = 400;
            $myObj->message = "Signup Failed";
            $myObj->description = "Try again";
            echo json_encode($myObj);
            }
            
            
           
        
        
        
        
        
      }
}

$inputArr=['user_name','email','password'];
if (isset($_POST['username']) && isset($_POST['password'])&& isset($_POST['email']))
{
$email=$_POST['email'];
$password=$_POST['password'];
$user_name=$_POST['username'];
$token=$_POST['token'];
$sUser_class=new uSignUp();
$sUser_class->sSignUp($user_name,$email,$password,$token);
}else{
    echo "data missing";
}
?>