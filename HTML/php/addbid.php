<?php
$id = $_POST["id"];
$price = $_POST["price"];
require_once "../admin/admin.php";
$conn = new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
session_start();
$query = "insert into action(productid,bidderid,addprice) value($id,".$_SESSION["id"].",$price);";
$result = $conn->query($query);
if(!$result){
	echo "0";
}else{
	echo "1";
}
?>