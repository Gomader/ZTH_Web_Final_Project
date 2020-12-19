<?php
session_start();
$userId = $_SESSION["id"];
$productId = $_POST["id"];
require_once "../admin/admin.php";
$conn = new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
$query = "insert into cart(userid,productid) value($userId,$productId);";
$result = $conn->query($query);
if(!$result){
	echo "0";
}else{
	echo "1";
}
?>