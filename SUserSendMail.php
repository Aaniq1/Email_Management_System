<?php
class SendMail
{
    function __construct() {
        require_once('model_db.php');
        require_once('MailCatcher.php');
        require_once('SendMail.php');
      }
     
      public function sendMail($from,$password,$to,$cc,$bcc,$subject,$msg,$token,$user_id)#$password 
      {
        //   print_r("assa");
        //   exit();
        $user_model=new userModel();
        $response=$user_model->checkAcessUser($token);
        $newarray=array();
        if (!$response)
        {
            $myObj = new stdClass();
            $myObj->status = "Invalid";
            $myObj->key = 204;
            $myObj->message = "Invalid Token";
            $myObj->description = "Try again";
            echo json_encode($myObj);
           
        }
        else
        {
            $user_model->UpdateAmount($user_id);
           $response=smtp($from,$password,$cc,$bcc,$to,$subject, $msg);
           if(!$response)
           {
            $myObj = new stdClass();
            $myObj->status = "invalid";
            $myObj->key = 400;
            $myObj->message = "Mail Error";
            $myObj->description = "Try again";
            echo json_encode($myObj);
           }
           else
           {
            $myObj = new stdClass();
            $myObj->status = "Valid";
            $myObj->key = 200;
            $myObj->message = "Mail Sent Successfully";
            $myObj->description = "You mail has been send succesfully";
            echo json_encode($myObj);
           }

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
           
        
            
        
        
        
      }
}


$from=$_POST['from'];
$to=$_POST['to'];
$cc=$_POST['cc'];
$bcc=$_POST['bcc'];
$subject=$_POST['subject'];
$msg=$_POST['msg'];
$user_id=$_POST['user_id'];
$password=$_POST['password'];
$getHeaders = apache_request_headers();
$token = $getHeaders['token'];
$mail_class=new SendMail();
$mail_class->sendMail($from,$password,$to,$cc,$bcc,$subject,$msg,$token,$user_id);
?>