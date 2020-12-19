function checkid(){
	var type;
	var b = document.getElementById("typeB").checked;
	var s = document.getElementById("typeS").checked;
	if(s==true){
		type = "1";
	}else if(b==true){
		type = "2";
	}else{
		type = "0";
	}
	var id = document.getElementById("ID").value;
	if(id == ""){
		alert("Please input ID!");
	}else{
		var xhr = new XMLHttpRequest();
		xhr.open("POST","php/signup.php",true);
		xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xhr.send("dup="+id+"&type="+type);
		xhr.onreadystatechange = function(){
			if(xhr.readyState===4){
				if (xhr.readyState == 4 && (xhr.status >= 200 && xhr.status < 400)){
					console.log(xhr.responseText);
					if(xhr.responseText == "1"){
						var s = document.getElementById("state");
						s.style.color = "green";
						s.innerHTML = "OK!";
					}else{
						var s = document.getElementById("state");
						s.style.color = "red";
						s.innerHTML = "Exists!";
					}
				}
			}
		}
	}
}


function typecheck(who){
	if(who=='s'){
		document.getElementById("typeB").checked = false;
	}else{
		document.getElementById("typeS").checked = false;
	}
}


function submit(){
	var type;
	var b = document.getElementById("typeB").checked;
	var s = document.getElementById("typeS").checked;
	if(s==true){
		type = "1";
	}else if(b == true){
		type = "2";
	}else{
		alert("Please choose your account type");
		return;
	}
	
	var id = document.getElementById("ID").value;
	var state = document.getElementById("state").innerText;
	var email = document.getElementById("email").value;
	var password = document.getElementById("password").value;
	var repassword = document.getElementById("repassword").value;
	if(id==""){
		alert("Please input ID!");
	}else if(state!="OK!"){
		alert("Check your ID!");
	}else if(password!=repassword){
		alert("The two passwords do not match!");
	}else{
		var xhr = new XMLHttpRequest();
		xhr.open("POST","php/signup.php",true);
		xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xhr.send("id="+id+"&type="+type+"&email="+email+"&password="+password);
		xhr.onreadystatechange = function(){
			if(xhr.readyState===4){
				if (xhr.readyState == 4 && (xhr.status >= 200 && xhr.status < 400)){
					if(xhr.responseText == "1"){
						alert("Sign Up Succeed!");
						window.location.href = "login.php";
					}else{
						alert("Sign Up Failed!");
					}
				}
			}
		}
	}
}


function login(){
	var type;
	var logined;
	var b = document.getElementById("typeB").checked;
	var s = document.getElementById("typeS").checked;
	if(s==true){
		type = "1";
		logined = "seller.php";
	}else if(b == true){
		type = "2";
		logined = "buyer.php";
	}else{
		type = "0";
		logined = "admin.php";
	}
	var id = document.getElementById("ID").value;
	var password = document.getElementById("password").value;
	if(id==""){
		alert("Please input your ID!")
	}else if(password==""){
		alert("Please input your password!");
	}else{
		var xhr = new XMLHttpRequest();
		xhr.open("POST","php/login.php",true);
		xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xhr.send("id="+id+"&type="+type+"&password="+password);
		xhr.onreadystatechange = function(){
			if(xhr.readyState===4){
				if (xhr.readyState == 4 && (xhr.status >= 200 && xhr.status < 400)){
					if(xhr.responseText == "1"){
						alert("Log In Succeed!");
						window.location.href = logined;
					}else{
						alert("Log In Failed!");
					}
				}
			}
		}
	}
}


function deleteuser(id){
	if(confirm("Are you Sure???")){
		var xhr = new XMLHttpRequest();
		xhr.open("POST","php/deleteuser.php",true);
		xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xhr.send("id="+id);
		xhr.onreadystatechange = function(){
			if(xhr.readyState===4){
				if (xhr.readyState == 4 && (xhr.status >= 200 && xhr.status < 400)){
					if(xhr.responseText=="1"){
						alert("Delete Succeed!");
						document.getElementById("id"+id).style.display = "none";
					}else{
						alert("Something Wrong!");
					}
				}
			}
		}
	}
}


function saveChange(){
	var lists = document.getElementsByName("items");
	var array = new Array();
	for(var i = 0;i < lists.length;i++){
		if(lists[i].style.display!="none"){
			var id = lists[i].getAttribute("data-text");
			var username = document.getElementById("username"+id).innerText;
			var password = document.getElementById("password"+id).innerText;
			var email = document.getElementById("email"+id).innerText;
			var type = document.getElementById("type"+id).innerText;
			if(type==""){
				type = 0;
			}else if(type=="seller"){
				type = 1;
			}else if(type=="buyer"){
				type = 2;
			}
			array[i] = "update user set username='"+username+"',password='"+password+"',email='"+email+"',type="+type+" where id="+id+";";
		}
	}
	var data = JSON.stringify(array);
	var xhr = new XMLHttpRequest();
	xhr.open("POST","php/updateall.php",true);
	xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhr.send("inner="+data);
	xhr.onreadystatechange = function(){
		if(xhr.readyState===4){
			if (xhr.readyState == 4 && (xhr.status >= 200 && xhr.status < 400)){
				if(xhr.responseText=="1"){
					alert("Save Succeed!");
				}else{
					alert("Something Wrong!");
				}
			}
		}
	}
}

function change(id){
	var inner = document.getElementById(id).innerText;
	var changed = prompt("Change",inner);
	document.getElementById(id).innerText = changed;
}

function uploadimage(){
	document.getElementById("chooseImage").click();
}

function showImage(obj){
	var img = getObjectURL(obj.files[0]);
	document.getElementById("productImage").style.display="none";
	document.getElementById("pic").style.display = "block";
	document.getElementById("picImage").src = img;
}

function getObjectURL(file) {
	var url = null ;
	if(window.createObjectURL!=undefined) {
		url = window.createObjectURL(file) ;
	}else if(window.URL!=undefined) {
		url = window.URL.createObjectURL(file) ;
	}else if(window.webkitURL!=undefined) {
		url = window.webkitURL.createObjectURL(file) ;
	}
	return url ;
}

function selectSellType(id){
	var status = document.getElementById(id).checked;
	if(id=="flea"&&status==true){
		document.getElementById("auction").checked = false;
		document.getElementById("endtime").style.display = "none";
	}else if(id=="auction"&&status==true){
		document.getElementById("flea").checked=false;
		document.getElementById("endtime").style.display="block";
	}else{
		document.getElementById("endtime").style.display="none";
	}
}

function showaddpage(){
	if(document.getElementById("uploadtable").style.display=="none"){
		document.getElementById("uploadtable").style.display = "block";
	}else{
		document.getElementById("uploadtable").style.display = "none";
	}
	
}

function submitProduct(){
	var img = document.getElementById("chooseImage").files[0];
	var productname = document.getElementById("productName").value;
	var price = document.getElementById("productPrice").value;
	var sellerName = document.getElementById("sellerName").value;
	var sellerPhone = document.getElementById("sellerPhone").value;
	var address = document.getElementById("address").value;
	if(document.getElementById("flea").checked==true){
		var type = "0";
	}else if(document.getElementById("auction").checked==true){
		var type = "1";
	}else{
		var type = "-1"
	}
	if(img==undefined || productname=="" || price=="" || sellerName=="" || sellerName=="" || sellerPhone=="" || address=="" || type=="-1"){
		alert("Please Complete Your Product Information!");
		return;
	}
	var fd = new FormData();
	fd.append("img",img);
	fd.append("productname",productname);
	fd.append("price",price);
	fd.append("sellerName",sellerName);
	fd.append("sellerPhone",sellerPhone);
	fd.append("address",address);
	fd.append("type",type);
	if(type==1){
		var endtime = document.getElementById("endtimeitem").value;
		fd.append("endtime",endtime);
	}
	var xhr = new XMLHttpRequest();
	xhr.open("POST","php/uploadProduct.php",true);
	xhr.send(fd);
	xhr.onreadystatechange = function(){
		if(xhr.readyState===4){
			if (xhr.readyState == 4 && (xhr.status >= 200 && xhr.status < 400)){
				console.log(xhr.responseText);
				if(xhr.responseText=="1"){
					alert("Upload Succeed!");
					location.reload();
				}else{
					alert("Something Wrong!");
				}
			}
		}
	}
}


function submitconect(){
	var name = document.getElementById("contentname").value;
	var email = document.getElementById("contentemail").value;
	if(document.getElementById("type").value=="buyer"){
		var type = "2";
	}else if(document.getElementById("type").value=="seller"){
		var type = "1";
	}else{
		alert("Please Enter Correct Type!");
		return;
	}
	
	var inner = document.getElementById("inner").value;
	var xhr = new XMLHttpRequest();
	xhr.open("POST","php/uploadConect.php",true);
	xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhr.send("name="+name+"&email="+email+"&type="+type+"&inner="+inner);
	xhr.onreadystatechange = function(){
		if(xhr.readyState===4){
			if (xhr.readyState == 4 && (xhr.status >= 200 && xhr.status < 400)){
				console.log(xhr.responseText);
				if(xhr.responseText=="1"){
					alert("Send Succeed!");
					location.reload();
				}else{
					alert("Something Wrong!");
				}
			}
		}
	}
}

function changeSearchType(){
	var type = document.getElementById("searchtype").value;
	if(type==1){
		document.getElementById("searchingByPrice").style.display='none';
		document.getElementById("searchingByName").style.display='block';
		document.getElementById("searchingBySeller").style.display='none';
	}else if(type==2){
		document.getElementById("searchingByPrice").style.display='block';
		document.getElementById("searchingByName").style.display='none';
		document.getElementById("searchingBySeller").style.display='none';
	}else if(type==3){
		document.getElementById("searchingByPrice").style.display='none';
		document.getElementById("searchingByName").style.display='none';
		document.getElementById("searchingBySeller").style.display='block';
	}
}

function searching(type){
	if(type=="name"){
		var key1 = document.getElementById("searchingName").value;
	}else if(type=="price"){
		var key1 = document.getElementById("lowprice").value;
		var key2 = document.getElementById("hightprice").value;
	}else if(type=="seller"){
		var key1 = document.getElementById("searchingSeller").value;
	}else{
		return;
	}
	var xhr = new XMLHttpRequest();
	xhr.open("POST","php/searchProduct.php",true);
	xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	if(type=="name"||type=="seller"){
		xhr.send("type="+type+"&key1="+key1);
	}else{
		xhr.send("type="+type+"&key1="+key1+"&key2="+key2);
	}
	xhr.onreadystatechange = function(){
		if(xhr.readyState===4){
			if (xhr.readyState == 4 && (xhr.status >= 200 && xhr.status < 400)){
				var res =  eval(xhr.responseText);
				var inner = "<table rules='none'><tr><th>Product Name</th><th>Current Price</th><th>Trading Place</th><th>Phone Number</th><th>Status</th><th>Seller Name</th></tr>";
				if(res.length == undefined){
					inner += "<tr><td colspan='6' style='text-align:center'>No Data</td></tr>"
				}else{
					for(var i = 0;i < res.length;i++){
						inner += "<tr><td><a href='buyer.php?turn=4&id="+res[i][0]+"'>" + res[i][1] + "</a></td><td>" +res[i][2]+"</td><td>"+res[i][3]+"</td><td>"+res[i][4]+"</td><td>"+res[i][5]+"</td><td>"+res[i][6]+"</td></tr>";
					}
				}
				inner += "</table>";
				console.log(inner);
				document.getElementById("searchingReasult").innerHTML=inner;
			}
		}
	}
}

function addBidInformation(oldprice,id){
	var price = document.getElementById("newprice").value;
	if(price < oldprice){
		alert("Poor man, spend more money!");
		return;
	}
	var xhr = new XMLHttpRequest();
	xhr.open("POST","php/addbid.php",true);
	xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhr.send("id="+id+"&price="+price);
	xhr.onreadystatechange = function(){
		if(xhr.readyState===4){
			if (xhr.readyState == 4 && (xhr.status >= 200 && xhr.status < 400)){
				if(xhr.responseText=="1"){
					alert("Bid Succeed!");
				}else{
					alert("Something Wrong!");
				}
			}
		}
	}
}

function addtoCart(id){
	var xhr = new XMLHttpRequest();
	xhr.open("POST","php/addtoCart.php",true);
	xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhr.send("id="+id);
	xhr.onreadystatechange = function(){
		if(xhr.readyState===4){
			if (xhr.readyState == 4 && (xhr.status >= 200 && xhr.status < 400)){
				if(xhr.responseText=="1"){
					alert("It's waiting you in your Cart!");
				}else{
					alert("Something Wrong!");
				}
			}
		}
	}
}

function buyProduct(id){
	var xhr = new XMLHttpRequest();
	xhr.open("POST","php/buyProduct.php",true);
	xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhr.send("id="+id);
	xhr.onreadystatechange = function(){
		if(xhr.readyState===4){
			if (xhr.readyState == 4 && (xhr.status >= 200 && xhr.status < 400)){
				console.log(xhr.responseText);
				if(xhr.responseText=="1"){
					alert("Succeed!");
				}else{
					alert("Something Wrong!");
				}
			}
		}
	}
}