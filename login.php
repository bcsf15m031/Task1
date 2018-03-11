<html>
<head>
<link rel="stylesheet" href="login.css"></link>
<script src="SecurityManager.js"></script>
<title>Login</title>
<script type="text/javascript">
function validateuser()
{
     var username = document.getElementById("username").value;
	 var userpass = document.getElementById("userpass").value;
	 if(username=="humna" && userpass=="123")
	 {
	     
	  alert("Successful login");
	  return true;
	 }
	 else
	 {
	  alert("UnSuccessful login");
	  return false;
	 }
}
function validateadmin()
	{
		var adminname = document.getElementById("adminname").value;
		var adminpass = document.getElementById("adminpass").value;
		if(SecurityManager.ValidateAdmin(adminname,adminpass))
		{
		window.location.href="adminwelcom.php";
		alert("Successful login");
		
		}
		else
		{
		alert("Incorrect Name and Paqssword");
		}
	}
</script>
</head>
<body>
	<h1 align="center">LOGIN PAGE</h1>
<div style="float:left">
  <div class="login-page">
      <div class="form">
      <div class="login-form" id="adminlogin">
	   <h1 style="color:white">ADMIN LOGIN </h1>
	  <div style="color:azure">Name</div>
	  <input id="adminname" type="text1" ><br>
       <div style="color:white"> Password</div>
	   <input style="color:white" id="adminpass" type="password" ><br>
      <Button style="color:black" type="submit" value="Submit" id="btnadmin" onclick="validateadmin()" >login</button>
	  </div >
	  </div>
	</div> 
  </div>
  <div style="float:left">
  <div class="login-page">
      <div class="form">
      <div class="login-form" id="userlogin" >
	   <h1 style="color:white">USER LOGIN </h1>
	   <div style="color:white">Name</div>
	   <input id="username" type="text2"><br>
       <div style="color:white">Password</div>
	   <input id="userpass" type="password"><br>
       <Button style="color:black" type="submit" value="Submit" id="btnuser" onclick="validateuser()" >login</button>
	  </div>
	  </div>
	</div> 
  </div>
</body>
</html>