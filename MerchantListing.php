<?php
class Listing
{
    function __construct() {
        require_once('model_db.php');
      }
      public function viewRole($user_id,$token)
      {
        $user_model=new userModel();
            $response=$user_model->checkAcessMerchant($token);
            $newarray=array();
            if (!$response)
            {
                $myObj = new stdClass();
                $myObj->status = "Invalid";
                $myObj->key = 204;
                $myObj->message = "You are not authorized to access this page";
                $myObj->description = "Try again";
                echo json_encode($myObj);
               
            }
            else{
               $response=$user_model->roleListing($user_id);
               if ($response)
               {
                $myObj = new stdClass();
                $myObj->status = "valid";
                $myObj->key = 200;
                $myObj->message = $response;
                $myObj->description = "List of role assigned to User";
                echo json_encode($myObj);
               }
               else
               {
                $myObj = new stdClass();
                $myObj->status = "Invalid";
                $myObj->key = 204;
                $myObj->message = "User not found";
                $myObj->description = "Can only view if user is assigned any rolex";
                echo json_encode($myObj);
               }
            }
           
            
            
           
        
        
        
        
        
      }
}

$inputArr=['token','user_id'];

if (isset($_POST['token']))
{
$user_id=$_POST['user_id'];
$token=$_POST['token'];

$merchant_class=new Listing();
$merchant_class->viewRole($user_id,$token);
}
?>