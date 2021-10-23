
<?php
function dbConnection(){
$servername = "localhost";
$username = "root";
$password = "";
$db="mail_sender";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);
return $conn;
}
?>