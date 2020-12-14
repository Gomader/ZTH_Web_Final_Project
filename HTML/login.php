<!DOCTYPE html>
<html lang="en">
	<head>
		<title>SKKU&nbsp;&nbsp;FLEA&nbsp;&nbsp;MARKET&nbsp;&nbsp;LOGIN</title>
		<link rel="stylesheet" href="style/style.css">
		<link rel="stylesheet" href="style/login.css">
		<?php
			session_start();
			if(isset($_SESSION["type"])){
				echo "<meta http-equiv='refresh' content='1;url=".$_SESSION["type"].".php'>";
			}
		?>
	</head>
	<body>
		<div id="topbar">
			<span id="logo">SKKU&nbsp;&nbsp;FLEA&nbsp;&nbsp;MARKET</span>
		</div>
		<div id="bigboxmenu">
			<div class="menubox leftbox">
				<span>
					New to our website?
				</span><br><br>
				<span>
					This web page is SKKU Flea Market!
				</span><br><br>
				<a href="signup.php"><button>Create an Account</button></a>
			</div>
			<div class="menubox rightbox">
				<span>LOG IN TO ENTER</span><br>
				<input type="checkbox" id="typeS" onclick="typecheck('s')"/><label for="typeS" id="s">Seller</label>
				<input type="checkbox" id="typeB" onclick="typecheck('b')"/><label for="typeB" id="b">Buyer</label>
				<br>
				<input type="text" id="ID" placeholder="ID"><span id="state"></span><br>
				<input type="password" id="password" placeholder="Password"><br>
				<button onclick="login()" id="submit">Log In</button>
			</div>
		</div>
		<div id="footer">
			Copyright&nbsp;&copy;&nbsp;2020&nbsp;&hearts;&nbsp;by&nbsp;ZHANG TIANHE
		</div>
		<script src="script/script.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>