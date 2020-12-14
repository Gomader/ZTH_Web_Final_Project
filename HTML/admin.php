<!DOCTYPE html>
<?php
	session_start();
?>
<html lang="en">
	<head>
		<title>SKKU&nbsp;&nbsp;FLEA&nbsp;&nbsp;MARKET</title>
		<link rel="stylesheet" href="style/style.css">
		<link rel="stylesheet" href="style/admin.css">
		<?php
			if(isset($_SESSION["type"])&&$_SESSION["type"]!="admin"){
				echo "<meta http-equiv='refresh' content='1;url=".$_SESSION["type"].".php'>";
			}elseif(!isset($_SESSION["type"])){
				echo "<style>body{display:none;}</style>";
				echo "<meta http-equiv='refresh' content='1;url=index.php'>";
			}
		?>
	</head>
	<body>
		<div id="topbar">
			<span id="logo">SKKU&nbsp;&nbsp;FLEA&nbsp;&nbsp;MARKET</span>
			<a>Administrator</a>
			<a href="php/logout.php"><button>Sign Out</button></a>
		</div>
		
		<div id="memberTable">
			<table rules="none">
				<tr><th>Student ID(Name)</th><th>Password</th><th>E-mail</th><th>Buyer/Seller</th><th>Delete</th></tr>
				<?php
					require_once "admin/admin.php";
					$conn = new mysqli($hn,$un,$pw,$db);
					if($conn->connect_error) die($conn->connect_error);
					
					$query = "select * from user";
					
					$userInfo = $conn->query($query);
					
					if($userInfo->num_rows > 0){
						while($row = $userInfo->fetch_assoc()){
							$type="";
							if($row['type']=="1"){
								$type = "seller";
							}elseif($row['type']=="2"){
								$type = "buyer";
							}
							echo "<tr id='id".$row["id"]."'><td>".$row['username']."</td><td>".$row["password"]."</td><td>".$row['email']."</td><td>$type</td><td><button onclick='deleteuser(".$row['id'].")'>Delete</button></td></tr>";
						}
					}
				?>
			</table>
		</div>
		<button onclick="saveChange()" id="save">SAVE</button>
		<div id="footer">
			Copyright&nbsp;&copy;&nbsp;2020&nbsp;&hearts;&nbsp;by&nbsp;ZHANG TIANHE
		</div>
		<script src="script/script.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>