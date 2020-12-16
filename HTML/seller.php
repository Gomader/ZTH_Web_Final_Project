<!DOCTYPE html>
<?php
	session_start();
?>
<html lang="en">
	<head>
		<title>SKKU&nbsp;&nbsp;FLEA&nbsp;&nbsp;MARKET</title>
		<link rel="stylesheet" href="style/style.css">
		<link rel="stylesheet" href="style/seller.css">
		<?php
			if(isset($_SESSION["type"])&&$_SESSION["type"]!="seller"){
				echo "<meta http-equiv='refresh' content='1;url=".$_SESSION["type"].".php'>";
			}elseif(!isset($_SESSION["type"])){
				echo "<style>body{display:none;}</style>";
				echo "<meta http-equiv='refresh' content='1;url=index.php'>";
			}
		?>
	</head>
	<body>
		<div id="topbar">
			<a id="logo" href="index.php">SKKU&nbsp;&nbsp;FLEA&nbsp;&nbsp;MARKET&nbsp;&nbsp;&nbsp;<font class="littlelabel">_for Seller</font></a>
			<a style="margin-right: 1%;"><?php
			echo $_SESSION["username"];
			?></a>
			<a href="php/logout.php"><button>Sign Out</button></a>
			<div class="menubox"><a href="seller.php">Home</a><a href="seller.php?turn=1">Product Status</a><a href="seller.php?turn=2">Contact</a></div>
		</div>
		<?php
		if(!isset($_GET["turn"])){
			echo "
			<div id='addiv'>
				<div></div>
				<div>
					<span>Fun Shopping</span><br>
					<span>SKKU FLEA MARKET</span><br><br>
					<span>Anabada is a Korean word which has four meanings - \"Saving, Sharing, Exchanging, and Reusing\". The campaign has helped South Korea overcome financially hard times.</span>
				</div>
				<div><img src='image/0.png'></div>
			</div>
			";
		}elseif($_GET["turn"]==1){
			
		}elseif($_GET["turn"]==2){
			
		}
		?>
		
		<div id="footer">
			Copyright&nbsp;&copy;&nbsp;2020&nbsp;&hearts;&nbsp;by&nbsp;ZHANG TIANHE
		</div>
		<script src="script/script.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>