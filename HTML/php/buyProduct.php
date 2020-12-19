<?php
session_start();
$userId = $_SESSION["id"];
$productId = $_POST["id"];
require_once "../admin/admin.php";
$conn = new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
$query = "select buyerid from product where id=$productId";
$res = $conn->query($query);
if($res->num_rows>0){
	while($row = $res->fetch_assoc()){
		if($row["buyerid"]!=-1){
			echo "0";
			return;
		}
	}
}else{
	echo "0";
	return;
}

$query = "update product set buyerid=$userId where id=$productId;";
$result = $conn->query($query);
if(!$result){
	echo "0";
}else{
	echo "1";
}
?>