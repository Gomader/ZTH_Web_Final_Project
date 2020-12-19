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
		}elseif($_GET["turn"]=="1"){
			echo "
			<div id='productstatus'>
				<button onclick='showaddpage()' class='submit'>Upload Product</button>
				<table rules='none'>
					<tr><th>Product Name</th><th>Current Price</th><th>Wish List Person</th><th>Status</th><th>History</th></tr>";
			require_once "admin/admin.php";
			$conn = new mysqli($hn,$un,$pw,$db);
			if($conn->connect_error) die($conn->connect_error);
			$query = "select * from product where sellerid=".$_SESSION["id"];

			$userInfo = $conn->query($query);
			
			if($userInfo->num_rows > 0){
				while($row = $userInfo->fetch_assoc()){
					if($row["type"] == 0){
						$status = "Selling";
						if($row["buyerid"]!=-1){
							$status = "Sold";
						}
						echo "<tr><td>".$row["name"]."</td><td>".$row["price"]."</td><td></td><td>$status</td><td></td></tr>";
					}else{
						$status = "Bidding";
						if($row["endtime"]>time()){
							$status = "End Bidding";
						}
						$qry = "select * from action left join user on user.id = action.bidderid where productid=".$row["id"]." order by addprice desc;";
						$dataInfor = $conn->query($qry);
						$dataInfortemp = $dataInfor;
						
						echo "<tr><td>".$row["name"]."</td><td>";
						$addprice = 0;
						$user = "";
						while($r = $dataInfor->fetch_assoc()){
							$addprice = $r["addprice"];
							$user = $r["username"];
							break;
						}
						echo "$addprice</td><td>$user</td><td>$status</td><td>";
						while($r = $dataInfortemp->fetch_assoc()){
							echo "<span>".$r["username"].":".$r["time"]."</span><br>";
						}
						echo "</td></tr>";
					}
					
				}
			}else{
				echo "<tr><td colspan=5 style='test-align:center'>No Data</td></tr>";
			}
				
			echo "</table></div>
			<div id='uploadtable'>
				<div id='productImage' onclick='uploadimage()'>
					<span>Click here to browse</span><br><span>your product image file</span>
				</div>
				<div id='pic' onclick='uploadimage()' style='display:none'><img src='' id='picImage'></div>
				<table id='informationTable'>
					<tr><td><input type='text' placeholder='Enter Product Name' id='productName' class='inputstyle'></td></tr>
					<tr><td><input type='text' placeholder='Enter Product Price' id='productPrice' class='inputstyle'></td></tr>
					<tr><td><input type='text' placeholder='Enter Your Name' id='sellerName' class='inputstyle'></td></tr>
					<tr><td><input type='telephone' placeholder='Enter Your Phone Number' id='sellerPhone' class='inputstyle'></td></tr>
					<tr><td><input type='text' placeholder='Enter Trading Place' id='address' class='inputstyle'></td></tr>
					<tr><td><input type='checkbox' id='flea' onclick=\"selectSellType('flea')\"><label for='flea'>Flea Market</label></td></tr>
					<tr><td><input type='checkbox' id='auction' onclick=\"selectSellType('auction')\"><label for='auction'>Auction</label></td></tr>
					<tr id='endtime'><td><label for='endtime'>Auction Time</label><select id='endtimeitem'>
						<option value='1' selected='selected'>1 Day</option>
						<option value='2'>2 Day</option>
						<option value='3'>3 Day</option>
						<option value='4'>4 Day</option>
						<option value='5'>5 Day</option>
						<option value='6'>6 Day</option>
						<option value='7'>7 Day</option>
						<option value='8'>8 Day</option>
						<option value='9'>9 Day</option>
						<option value='10'>10 Day</option>
					</select></td></tr>
					<tr><td style='float:right;'><button onclick='submitProduct()' class='submit'>Register Product</button></td></tr>
				</table>
			</div>
			<input type='file' accept='image/*' style='display:none' id='chooseImage' onchange='showImage(this)'>
			
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
		}
		?>
		
		<div id="footer">
			Copyright&nbsp;&copy;&nbsp;2020&nbsp;&hearts;&nbsp;by&nbsp;ZHANG TIANHE
		</div>
		<script src="script/script.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>