<?php
session_start();
$id = $_SESSION["id"];
$img = $_FILES["img"]["tmp_name"];
$name = time().".png";
$path = "../productImage/";
$productname = $_POST["productname"];
$price = $_POST["price"];
$sellerName = $_POST["sellerName"];
$sellerPhone = $_POST["sellerPhone"];
$address = $_POST["address"];
$type = $_POST["type"];

if($type=="1"){
	$endtime = $_POST["endtime"];
}
if(move_uploaded_file($img,$path.$name)){
	require_once "../admin/admin.php";
	$conn = new mysqli($hn,$un,$pw,$db);
	if($conn->connect_error) die($conn->connect_error);
	if($type == "1"){
		$query = "insert into product(name,pic,sellerid,price,address,sellerphone,type,endtime) value('$productname','$name',$id,$price,'$address',$sellerPhone,$type,data_add(now(),interval $endtime day))";
		$res = $conn->query($query);
	}else{
		$query = "insert into product(name,pic,sellerid,price,address,sellerphone,type) value('$productname','$name',$id,$price,'$address',$sellerPhone,$type)";
		$res = $conn->query($query);
	}
	if(!$res){
		echo "0";
	}else{
		echo "1";
	}
}else{
	echo "0";
}
?>