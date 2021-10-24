<?php
include('smtp/PHPMailerAutoload.php');
// $html='You have credit $05';
// echo smtp_mailer('aaniq001@gmail.com','subject',$html);
function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); 
	$mail->SMTPDebug  = 3;
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->addCC("abdullay2k16@gmail.com","Abdullah");
	$mail->addBCC("abdullay2k16@gmail.com","Abdullah");
	$mail->CharSet = 'UTF-8';
	$mail->Username = "aaniq001@gmail.com";
	$mail->Password = "ubuntuking6000";
	$mail->SetFrom("aaniq001@gmail.com");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		false;
	}else{
		return true;
	}
}
?>