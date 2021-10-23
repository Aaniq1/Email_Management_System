<?php 

class User {
    function __construct() {
        require_once('model_db.php');
        
      }
 
  function forgetPassword($email,$new_password)
  {
            $user_model=new userModel();
            $response=$user_model->existEmail($email);
            $newarray=array();
            if (!$response)
            {
                $newarray=["204",'Email Does Not Exist'];
                echo json_encode($newarray);
            }
            else
            {
                $response=$user_model->resetPassword($email,md5($new_password));
                if($response)
                {
                $newarray=["200","Password Update Successfully"];
                echo json_encode($newarray);
                }
                else
                {
                    echo json_encode("400");
                }
                
            }
            

  }
}
$inputArr=['email','new_password'];

if (isset($_POST['email']) && isset($_POST['new_password']))
{
$email=$_POST['email'];
$new_password=$_POST['new_password'];
$user_class=new User();
$user_class->forgetPassword($email,$new_password);
}
else
{
    echo json_encode("All Fields  Required");
}

?>