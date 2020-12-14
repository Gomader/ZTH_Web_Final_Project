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
	var password = document.getElementById("password").values;
	var repassword = document.getElementById("repassword").values;
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
	
}