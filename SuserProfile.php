<?php
class Profile
{
    function __construct() {
        require_once('model_db.php');
        
      }
     
      public function updateProfile($token,$user_id,$picture)#$password 
      {
        //   print_r("assa");
        //   exit();
        $newName=$picture;
	
        if($picture!="")
        {
        move_uploaded_file($_FILES['picture']['tmp_name'], 'images/secondry_user/'.$newName); 
        }
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
            $response=$user_model->sUploadProfile($user_id,$newName);
            if(!$response)
            {
                $myObj = new stdClass();
                $myObj->status = "Invalid";
                $myObj->key = 204;
                $myObj->message = "Unable to upload Image";
                $myObj->description = "Try again";
                echo json_encode($myObj);
            }
            else
            {
            $myObj = new stdClass();
                $myObj->status = "Valid";
                $myObj->key = 200;
                $myObj->message = "Upload Successfully";
                $myObj->description = "Image has been upload successfully";
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
$picture=$_FILES['picture']["name"]; 
print_r($picture);
$Profile_class=new Profile();
$Profile_class->updateProfile($token,$user_id,$picture);
?>