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
			echo "
			<div class='tablesbox'>
				<h1>Cart</h1>
				<table class='thistable' rules='none'>
					<tr><th>Product Name</th><th>Current Price</th><th>Trading Place</th><th>Phone Number</th><th>Status</th><th>Seller Name</th></tr>";
			require_once "admin/admin.php";
			$conn = new mysqli($hn,$un,$pw,$db);
			if($conn->connect_error) die($conn->connect_error);
			$query = "select product.id as id,name,type,price,address,sellerphone,sellername,buyerid from cart left join product on product.id=cart.productid where cart.userid=".$_SESSION["id"];
			$res = $conn->query($query);
			if($res->num_rows == 1){
				while($row = $res->fetch_assoc()){
					echo "<tr><td><a href='buyer.php?turn=4?id=".$row["id"]."'>".$row["name"]."</a></td><td>";
					if($row["type"]=="1"){
						$qry = "select addprice from action where productid=".$row["id"]." order by addprice desc limit 1;";
						$r = $conn->query($qry);
						if($r->num_rows>0){
							while($l = $r->fetch_assoc()){
								echo $l["addprice"];
							}
						}else{
							echo $row["price"];
						}
					}else{
						echo $row["price"];
					}
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
					echo "</td><td>".$row["address"]."</td><td>".$row["sellerphone"]."</td><td>$status</td><td>".$row["sellername"]."</td></tr></table>";
				}
			}
			echo "</div>";
		}elseif($_GET["turn"]=="4"){
			$id = $_GET["id"];
			require_once "admin/admin.php";
			$conn = new mysqli($hn,$un,$pw,$db);
			if($conn->connect_error) die($conn->connect_error);
			$query = "select * from product where id=".$id;
			$res = $conn->query($query);
			if($res->num_rows == 1){
				while($row = $res->fetch_assoc()){
					echo "<div id='mianbox'>
							<div>
								<img src='productImage/".$row["pic"]."'>
							</div>
							<table id='mainboxtable'>
								<tr><td><label>Product Name:</label></td><td>".$row["name"]."</td></tr>";
					if($row["type"]=="1"){
						echo "<tr><td><label>Remain Time:</label></td><td><span id='remaintime'></span></td></tr>";
						$qry = "select addprice from action where productid=".$id." order by addprice desc limit 1;";
						$result = $conn->query($qry);
						if($result->num_rows > 0){
							while($r = $result->fetch_assoc()){
								$cprice = $r["addprice"];
								echo "<tr><td><label>Current Price:</label></td><td>".$r["addprice"]."</td></tr>";
							}
						}
					}else{
						echo "<tr><td colspan='2'><span style='font-weight:bolder;color:rgb(64,67,235)'>".$row["price"]." won</label></td></tr>";
					}
					echo "<tr><td><label>Seller Name:</label></td><td>".$row["sellername"]."</td></tr>";
					echo "<tr><td><label>Seller Phone Number:</label></td><td>".$row["sellerphone"]."</td></tr>";
					echo "<tr><td><label>Trading Place:</label></td><td>".$row["address"]."</td></tr>";
					if($row["type"]=="1"){
						echo "<tr><td><input type='number' id='newprice' placeholder='Enter Your Price'></td><td><button onclick='addBidInformation($cprice,".$_GET["id"].")' style='border-radius:0px'>BIDI</button></td></tr>";
						echo "<tr><td colspan='2'><button onclick='addtoCart(".$_GET["id"].")' class='submit'>Add to Cart</button></td></tr>";
					}else{
						echo "<tr><td><button onclick='addtoCart(".$_GET["id"].")' class='submit'>Add to Cart</button></td><td><button onclick='buyProduct(".$_GET["id"].")' class='submit'>Buy</button></td></tr>";
					}
					echo "</table></div>";
				}
			}
		}
		?>
		
		<div id="footer">
			Copyright&nbsp;&copy;&nbsp;2020&nbsp;&hearts;&nbsp;by&nbsp;ZHANG TIANHE
		</div>
		<script src="script/script.js" type="text/javascript" charset="utf-8"></script>
		<?php
		if($_GET["turn"]=="4"){
			$id = $_GET["id"];
			require_once "admin/admin.php";
			$conn = new mysqli($hn,$un,$pw,$db);
			if($conn->connect_error) die($conn->connect_error);
			$query = "select * from product where id=".$id;
			$res = $conn->query($query);
			if($res->num_rows == 1){
				while($row = $res->fetch_assoc()){
					if($row["type"]=="1"){
						if($row["endtime"]<time()){
							echo "
							<script>
								var endtime = new Date('".$row["endtime"]."')
								function setCutDown(){
									var nowtime = new Date();
									var time = endtime - nowtime;
									if(time < 0){
										location.reload();
									}
									var day = parseInt(time / 1000 / 60 / 60 / 24);
									var hour = parseInt(time / 1000 / 60 / 60 % 24);
									var minute = parseInt(time / 1000 / 60 % 60);
									var seconds = parseInt(time / 1000 % 60);
									document.getElementById('remaintime').innerHTML = day + 'd ' + hour + 'h ' + minute + 'm ' + seconds + 's ';
								}
								window.onload = setInterval('setCutDown()','1000');
							</script>";
						}else{
							echo "
							<script>
								window.onload = document.getElementById('remaintime').innerHTML='End Bidding!';
							</script>";
						}
					}
				}
			}
		}
		?>
	</body>
</html>