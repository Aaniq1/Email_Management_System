<?php
class Billings
{
    function __construct() {
        require_once('model_db.php');
        
      }
      public function accessPayment($token,$user_id)#$password 
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
            $response=$user_model->accessBilling($user_id);
            if(!$response)
            {
                $myObj = new stdClass();
                $myObj->status = "Invalid";
                $myObj->key = 204;
                $myObj->message = "unauthorized";
                $myObj->description = "You cannot access to this module";
                echo json_encode($myObj);
            }
            else
            {
                $response=$user_model->viewBilling($user_id);
                $myObj = new stdClass();
                $myObj->status = "Valid";
                $myObj->key = 200;
                $myObj->message = "Successfull";
                $myObj->card_no = $response['card_no'];
                $myObj->address = $response['address'];
                $myObj->description = "Your Card Information";
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


$user_id=$_POST['user_id'];
$getHeaders = apache_request_headers();
$token = $getHeaders['token'];
$billings_class=new Billings();
$billings_class->accessPayment($token,$user_id);
?>