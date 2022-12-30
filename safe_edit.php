<!-- 
SEED Lab: SQL Injection Education Web plateform
Author: Kailiang Ying
Email: kying@syr.edu
-->

<!DOCTYPE html>
<html>
<body>


<?php
   session_start(); 
   $input_email = $_GET['Email'];
   $input_nickname = $_GET['NickName'];
   $input_address= $_GET['Address'];
   $input_pwd = $_GET['Password']; 
   $input_phonenumber = $_GET['PhoneNumber']; 
   $input_id = $_SESSION['id'];
   $conn = getDB();
  
   if($input_pwd!=''){
   	$input_pwd = sha1($input_pwd);
   	    $sql=$conn->prepare("UPDATE credential SET nickname = ?, email= ?, address= ?, Password=$input_pwd, PhoneNumber=? where ID=$input_id");
   }else{
   	    $sql=$conn->prepare("UPDATE credential SET nickname = ?, email= ?, address= ?, PhoneNumber=? where ID=$input_id");
   }
	$sql->bind_param("ssss", $input_nickname, $input_email, $input_address, $input_phonenumber);
	$sql->execute();
   $sql->close();	
   header("Location: unsafe_credential.php");
   exit();

function getDB() {
   $dbhost="localhost";
   $dbuser="root";
   $dbpass="seedubuntu";
   $dbname="Users";


   // Create a DB connection
   $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
   if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error . "\n");
   }
return $conn;
}
 
?>

</body>
</html> 








