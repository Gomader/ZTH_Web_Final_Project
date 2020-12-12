<!DOCTYPE html>
<html lang="en">
	<head>
		<title>SKKU&nbsp;&nbsp;FLEA&nbsp;&nbsp;MARKET</title>
		<link rel="stylesheet" href="style/style.css">
		<?php
			session_start();
			if(isset($_SESSION["type"])){
				echo "<meta http-equiv='refresh' content='1;url=" + $_SESSION["type"] + ".php'>";
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
					Already have an account?
				</span><br><br>
				<span>
					Login now and enjoy SKKU Flea Market!
				</span><br><br>
				<a href="login.php"><button>Login Now</button></a>
			</div>
			<div class="menubox rightbox">
				<span>
					New to our website?
				</span><br><br>
				<span>
					This web page is SKKU Flea Market!
				</span><br><br>
				<a href="signup.php"><button>Create an Account</button></a>
			</div>
		</div>
		<div id="footer">
			Copyright&nbsp;&copy;&nbsp;2020&nbsp;&hearts;&nbsp;by&nbsp;ZHANG TIANHE
		</div>
	</body>
</html>