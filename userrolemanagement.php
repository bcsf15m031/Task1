<!doctype html>
<html>
	<head>
		<title>UserRole Management</title>
		      <link rel="stylesheet" href="login.css"></link>
		<script src="SecurityManager.js"> </script>	
		<script type="text/javascript">
			function Main()
			{
				var win = document.getElementById('rolePermissions');
				var index = Number(document.URL.indexOf('?login='));
				var login = document.URL.substr(index+7,document.URL.length);
				var allUserRoles = SecurityManager.GetAllUserRoles();
				var currUserRoles = [];
				for (var i = allUserRoles.length - 1; i >= 0; i--) {
					if(allUserRoles[i].name == login)
						currUserRoles.push(allUserRoles[i].role);
				}
				if(currUserRoles.length > 0)
				{
					var allRolePermissions = SecurityManager.GetAllRolePermissions();
					var currRolePermissions = [];
					for (var j = currUserRoles.length - 1; j >= 0; j--) {
						var text = document.createElement('label');
						text.innerHTML = "<b>Role:</b> "+currUserRoles[j]+"<br>";
						win.appendChild(text);
						for (var i = allRolePermissions.length - 1; i >= 0; i--) {
							if(currUserRoles[j] == allRolePermissions[i].role)
							{
								var text = document.createElement('label');
								text.innerHTML = "<b>Permission:</b> "+allRolePermissions[i].permission+"<br>";
								win.appendChild(text);
							}
						}
					}
				}
				else
					alert("No roles and permissions assigned!");
			}
		</script>
	</head>
	<body onload="Main();">
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
		
		<h1>Welcome Home!</h1>
		<a href="login.php">Logout</a>
		<div id="rolePermissions"></div>