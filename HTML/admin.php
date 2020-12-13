<!DOCTYPE html>
<html lang="en">
	<head>
		<title>SKKU&nbsp;&nbsp;FLEA&nbsp;&nbsp;MARKET</title>
		<link rel="stylesheet" href="style/style.css">
		<link rel="stylesheet" href="style/admin.css">
		<?php
			session_start();
			if(isset($_SESSION["type"])&&$_SESSION["type"]!="admin"){
				echo "<meta http-equiv='refresh' content='1;url=".$_SESSION["type"].".php'>";
			}elseif(!isset($_SESSION["type"])){
				echo "<meta http-equiv='refresh' content='1;url=index.php'>";
			}
		?>
	</head>
	<body>
		<div id="topbar">
			<span id="logo">SKKU&nbsp;&nbsp;FLEA&nbsp;&nbsp;MARKET</span>
			<span>Welcome Back Administrator!</span>
			<button>Sign Out</button>
		</div>
		
		<div id="footer">
			Copyright&nbsp;&copy;&nbsp;2020&nbsp;&hearts;&nbsp;by&nbsp;ZHANG TIANHE
		</div>
	</body>
</html>