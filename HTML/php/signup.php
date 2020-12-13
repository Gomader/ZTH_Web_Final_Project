<?php
require_once "../admin/admin.php";
$conn = new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
if(isset($_POST['dup'])){
	$id = $_POST['dup'];
	$type = $_POST['type'];
	$query = "select username from user where username='$id' and type='$type';";
	$userInfo = $conn->query($query);
	if ($userInfo->num_rows > 0){
		echo "0";
	}else{
		echo "1";
	}
}else{
	$username = $_POST["id"];
	$password = md5($_POST["password"]);
	$type = $_POST["type"];
	$email = $_POST["email"];
	$query = "insert into user(username,password,email,type) value('$username','$password','$email',$type);";
	$res = $conn->query($query);
	if(!$res){
		echo "0";
	}else{
		echo "1";
	}
}
?>