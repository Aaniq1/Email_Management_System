<?php
class Role
{
    function __construct() {
        require_once('model_db.php');
        require_once('MailCatcher.php');
      }
      public function assignRole($user_id,$token,$role)
      {
        $user_model=new userModel();
            $response=$user_model->checkAcessMerchant($token);
            $newarray=array();
            // echo $response;
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
                if ($role==1)
                {
                        $response=$user_model-> assignRole($role,$user_id);
                        if($response)
                        {
                            $myObj = new stdClass();
                            $myObj->status = "Success";
                            $myObj->key = 200;
                            $myObj->message = "Payment Assign to user";
                            $myObj->description = "Now user can access Payment Module";
                            echo json_encode($myObj);
                        }
                }
                else if ($role==2)
                {
                    $response=$user_model-> assignRole($role,$user_id);
                    if($response)
                    {
                        $myObj = new stdClass();
                        $myObj->status = "Success";
                        $myObj->key = 200;
                        $myObj->message = "Payment Assign to user";
                        $myObj->description = "Now user can access Billing Module";
                        echo json_encode($myObj);
                    }
                }
                else
                {
               
                        $myObj = new stdClass();
                        $myObj->status = "Invalid";
                        $myObj->key = 200;
                        $myObj->message = "Invalid Role";
                        $myObj->description = "Make sure to enter valid Role for user";
                        echo json_encode($myObj);
                    
                }
            }
           
            
            
           
        
        
        
        
        
      }
}

$inputArr=['token','user_id','role'];

if (isset($_POST['token']))
{
$user_id=$_POST['user_id'];
$token=$_POST['token'];
$role=$_POST['role'];

$merchant_class=new Role();
$merchant_class->assignRole($user_id,$token,$role);
}
?>