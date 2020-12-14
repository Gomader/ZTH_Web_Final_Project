<?php
session_start();
if($_SESSION["type"]=="admin"){
	require_once "../admin/admin.php";
	$conn = new mysqli($hn,$un,$pw,$db);
	if($conn->connect_error) die($conn->connect_error);
	
	$id = $_POST["id"];
	
	$query = "delete from user where id=$id;";
	
	$res = $conn->query($query);
	if(!$res){
		echo "0";
	}else{
		echo "1";
	}
}else{
	echo "0";
}
?>