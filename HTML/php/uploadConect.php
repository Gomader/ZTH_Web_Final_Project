<?php
$name = $_POST["name"];
$email = $_POST["email"];
$type = $_POST["type"];
$inner = $_POST["inner"];
require_once "../admin/admin.php";
$conn = new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
$query = "insert into conect(name,email,usertype,message) value('$name','$email',$type,'$inner')";
$res = $conn->query($query);
if(!$res){
	echo "0";
}else{
	echo "1";
}
?>