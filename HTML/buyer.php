<!DOCTYPE html>
<?php
	session_start();
?>
<html lang="en">
	<head>
		<title>SKKU&nbsp;&nbsp;FLEA&nbsp;&nbsp;MARKET</title>
		<link rel="stylesheet" href="style/style.css">
		<link rel="stylesheet" href="style/buyer.css">
		<?php
			if(isset($_SESSION["type"])&&$_SESSION["type"]!="buyer"){
				echo "<meta http-equiv='refresh' content='1;url=".$_SESSION["type"].".php'>";
			}elseif(!isset($_SESSION["type"])){
				echo "<style>body{display:none;}</style>";
				echo "<meta http-equiv='refresh' content='1;url=index.php'>";
			}
		?>
	</head>
	<body>
		<div id="topbar">
			<a id="logo" href="index.php">SKKU&nbsp;&nbsp;FLEA&nbsp;&nbsp;MARKET&nbsp;&nbsp;&nbsp;<font class="littlelabel">_for Buyer</font></a>
			<a style="margin-right: 1%;"><?php
			echo $_SESSION["username"];
			?></a>
			<a href="php/logout.php"><button>Sign Out</button></a>
			<div class="menubox"><a href="buyer.php">Home</a><a href="buyer.php?turn=1">Product Lists</a><a href="buyer.php?turn=2">Contact</a><a href="buyer.php?turn=3">Cart</a></div>
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
		}elseif($_GET["turn"]=="1"){
			echo "<div id='searchbox'>
					<span>Search By </span>
					<select id='searchtype' onchange='changeSearchType()'>
						<option value='1' selected='selected'>Name</option>
						<option value='2'>Price</option>
						<option value='3'>Seller Name</option>
					</select>
					<div id='searchingByName'>
						<table><tr><td style='text-align:right'><label for='searchingName'>Name:</label></td><td><input type='text' id='searchingName'></td><td><button onclick=\"searching('name')\" class='search'></button></td></tr></table>
					</div>
					<div id='searchingByPrice'>
						<table><tr><td><label for='lowprice'>Price:</label></td><td><input type='number' id='lowprice'></td><td> - </td><td><input type='number' id='hightprice'></td><td><button onclick=\"searching('price')\" class='search'></button></td></tr></table>
					</div>
					<div id='searchingBySeller'>
						<table><tr><td><label for='searchingSeller'>Seller:</label></td><td><input type='text' id='searchingSeller'></td><td></td><td><button onclick=\"searching('seller')\" class='search'></button></td></tr></table>
					</div>
				</div>
				
				<div id='searchingReasult'>
				</div>
				";
		}elseif($_GET["turn"]=="2"){
			echo "
			<div id='contentpage'>
				<div id='one'>
					<span class='title'>SungKyunKwan University</span><br>
					<span class='inner'>2066,Scobu-ro,Jangun-gu,Suwon-st,Gyeonggl-do</span><br><br>
					<span class='title'>010-1234-5678</span><br>
					<span class='inner'>Mon to Fri 9am to 6am</span><br><br>
					<span class='title'>jooohyednjs@gmail.com</span><br>
					<span class='inner'>Send us your request anytime!</span>
				</div>
				<div id='two'>
					<input type='text' placeholder='Enter Your Name' id='contentname'><br>
					<input type='text' placeholder='Enter Email Address' id='contentemail'><br>
					<input type='text' placeholder='Enter Your Type(buyer/seller)' id='type'>
				</div>
				<div id='three'>
					<textarea id='inner' cols='40'rows='13' placeholder='Enter Message'></textarea>
				</div>
			</div>
			<button id='abtn' class='submit' onclick='submitconect()'>Send Message</button>
			";
		}elseif($_GET["turn"]=="3"){
			
		}elseif($_GET["turn"]=="4"){
			$id = $_GET["id"];
			require_once "admin/admin.php";
			$conn = new mysqli($hn,$un,$pw,$db);
			if($conn->connect_error) die($conn->connect_error);
			$query = "select * from product where id=".$id;
			$res = $conn->query($query);
			if($res->num_rows == 1){
				while($row = $res->fetch_assoc()){
					echo "<div class='mianbox'><div><img src='productImage/".$row["pic"]."' id='productImage'></div><table><input type=></table></div>";
				}
			}
		}
		?>
		
		<div id="footer">
			Copyright&nbsp;&copy;&nbsp;2020&nbsp;&hearts;&nbsp;by&nbsp;ZHANG TIANHE
		</div>
		<script src="script/script.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>