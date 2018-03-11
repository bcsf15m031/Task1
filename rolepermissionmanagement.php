
<!DOCTYPE html>
<html>
<head>
       <link rel="stylesheet" href="login.css"></link>
<script src="SecurityManager.js" type="text/javascript"></script>
<title>RolePermission Management</title>
</head>
<body>

<ul>
  <li><a href="login.php">Home</a></li>
  <li><a href="usermanagement.php">User Management</a></li>
   <li><a href="rolemanagement.php">Role Management</a></li>
  <li><a href="permissionmanagement.php">Permission Management</a></li>
   <li><a href="rolepermissionmanagement.php">Role / Permisssion Management</a></li>
  <li><a href="userrolemanagement.php">User Role Management</a></li>
   <li><a href="login.php">Logout</a></li>
    </div>
  </li>
</ul>
<h1 align="center" style ="font:Baskerville Old Face" >WELLCOME ROLE-PERMISSION MANAGEMENT</h1>
  <div style="float:left">
  <div class="login-page">
      <div class="form">
      <form class="login-form" id="userlogin" >
	   <h1 style="color:white">ROLE PERMISSION MANAGEMENT </h1>
	   <div style="color:white">Permission Name</div>
	   <input id="rpname" type="text1"><br>
       <div style="color:white">permission</div>
	   <input id="rpdescription" type="text2"><br>
       <Button style="color:black" type="submit" value="Submit" id="btnuser" onclick="validateuser()" >Save</button>
	  </form>
	  </div>
	</div> 
  </div>
</body>
</html>