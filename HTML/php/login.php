<?php

session_start();

require_once "../admin/admin.php";
$conn = new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);

$username = $_POST["id"];
$password = md5($_POST["password"]);
$type = $_POST["type"];

$query = "select id from user where username='$username' and type=$type and password='$password'";

$userInfo = $conn->query($query);

if($userInfo->num_rows > 0){
	$lifeTime = 1800;
	setcookie(session_name(),session_id(), time()+$lifeTime);
	while($row = $userInfo->fetch_assoc){
		$_SESSION["id"] = $row["id"];		
	}
	$_SESSION["username"] = $username;
	if($type=="0"){
		$_SESSION["type"] = "admin";
	}elseif($type == "1"){
		$_SESSION["type"] = "seller";
	}elseif($type=="2"){
		$SESSION["type"] = "buyer";
	}
	echo "1";
}else{
	echo "0";
}
?>