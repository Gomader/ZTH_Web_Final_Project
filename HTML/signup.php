<!DOCTYPE html>
<html lang="en">
	<head>
		<title>SKKU&nbsp;&nbsp;FLEA&nbsp;&nbsp;MARKET&nbsp;&nbsp;SIGN&nbsp;&nbsp;UP</title>
		<link rel="stylesheet" href="style/style.css">
		<link rel="stylesheet" href="style/signup.css">
		<?php
			session_start();
			if(isset($_SESSION["type"])){
				echo "<meta http-equiv='refresh' content='1;url=" + $_SESSION["type"] + ".php'>";
			}
		?>
	</head>
	<body>
		<div id="topbar">
			<a id="logo" href="index.php">SKKU&nbsp;&nbsp;FLEA&nbsp;&nbsp;MARKET</a>
		</div>
		<div id="bigboxmenu">
			<div class="menubox leftbox">
				<span>
					Already have an account?
				</span><br><br>
				<span>
					Login now and enjoy SKKU Flea Market!
				</span><br><br>
				<a href="login.php"><button>Login Now</button></a>
			</div>
			<div class="menubox rightbox">
				<span>
					Create&nbsp;&nbsp;AN&nbsp;&nbsp;ACCOUNT
				</span><br><br>
				<input type="checkbox" id="typeS" onclick="typecheck('s')"/><label for="typeS" id="s">Seller</label>
				<input type="checkbox" id="typeB" onclick="typecheck('b')"/><label for="typeB" id="b">Buyer</label>
				<br><br><br>
				<input type="text" id="ID" placeholder="ID"><span id="state"></span>
				<br>
				<button onclick="checkid()" id="checkid">Duplicate</button>
				<br><br>
				<input type="email" id="email" placeholder="Email Address"><br>
				<input type="password" id="password" placeholder="Password"><br>
				<input type="password" id="repassword" placeholder="Confirm Password">
				<button onclick="submit()" id="submit">REGISTER</button>
			</div>
		</div>
		<div id="footer">
			Copyright&nbsp;&copy;&nbsp;2020&nbsp;&hearts;&nbsp;by&nbsp;ZHANG TIANHE
		</div>
		<script src="script/script.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>