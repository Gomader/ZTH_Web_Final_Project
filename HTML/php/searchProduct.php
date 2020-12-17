<?php
$type = $_POST["type"];
require_once "../admin/admin.php";
$conn = new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
if($type=="name"){
	$query = "select product.id as id,name,user.username as username,price,buyerid,sellerphone,address,endprice,endtime,product.type as type from product left join user on product.sellerid=user.id where name like '%".$_POST["key1"]."%';";
}else if($type=="price"){
	$query = "select product.id as id,name,user.username as username,price,buyerid,sellerphone,address,endprice,endtime,product.type as type from product left join user on product.sellerid=user.id where price > ".$_POST["key1"]." and price < ".$_POST["key2"].";";
}else{
	$query = "select product.id as id,name,user.username as username,price,buyerid,sellerphone,address,endprice,endtime,product.type as type from product left join user on product.sellerid=user.id where user.username like '%".$_POST["key2"]."%'";
}

$userInfo = $conn->query($query);
$inner="[";
if($userInfo->num_rows > 0){
	while($row = $userInfo->fetch_assoc()){
		if($row["type"] == 0){
			$status = "Selling";
			if($row["buyerid"]!=-1){
				$status = "Sold";
			}
		}else{
			$status = "Bidding";
			if($row["endtime"]>time()){
				$status = "End Bidding";
			}
		}
		$data = "[".$row["id"].",'".$row["name"]."',".$row["price"].",'".$row["address"]."','".$row["sellerphone"]."','$status','".$row["username"]."'],";
		$inner = $inner . $data;
	}
	$inner = $inner."]";
	echo $inner;
}else{
	echo "0";
}
?>