<?php
session_start();
if($_SESSION["type"]=="admin"){
	require_once "../admin/admin.php";
	$conn = new mysqli($hn,$un,$pw,$db);
	if($conn->connect_error) die($conn->connect_error);
	$data = json_decode($_POST["inner"], true);
	$result = 1;
	foreach($data as $d){
		$res = $conn->query($d);
		if(!$res){
			$result = 0;
		}
	}
	echo $result;
}else{
	echo "0";
}
?>