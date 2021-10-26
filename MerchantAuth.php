<?php
class Auth
{
    function __construct() {
        require_once('model_db.php');
        
      }
      public function Login($email)#$password 
      {
        //   print_r("assa");
        //   exit();
        $user_model=new userModel();
        $token = bin2hex(random_bytes(64));
        $response=$user_model->merchantExistEmail($email);
        $newarray=array();
            if ($response)
            {
                $newarray=["204",'Email Does Not Exist'];
                echo json_encode($newarray);
                return 0;
            }
            // $login_response=$user_model->merchantAuth($email,md5($password));
            // if(!$login_response)
            // {
            //     $newarray=["200",'Login Successfully'];
            //     echo json_encode($newarray);
            // }
            // else{

            //     $newarray=["204",'Invalid Email or Password'];
            //     echo json_encode($newarray);
            // }
            $token_response=$user_model->generateTokenMerchant($email,$token);
            if($token_response)
            {
                $myObj = new stdClass();
                $myObj->status = "valid";
                $myObj->key = 200;
                $myObj->access_token = $token_response;
                $myObj->message = "Login Successfully";
                $myObj->description = "Now you can assign task to user";
                echo json_encode($myObj);
            }
        
            
        
        
        
      }
}

$inputArr=['email','password'];

if (isset($_POST['email']) && isset($_POST['password']))
{
$email=$_POST['email'];
$password=$_POST['password'];
$auth_class=new Auth();
$auth_class->Login($email,$password);
}
?>