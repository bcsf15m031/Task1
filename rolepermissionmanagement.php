
<!DOCTYPE html>
<html>
<head>
       <link rel="stylesheet" href="login.css"></link>
       <script src="SecurityManager.js" type="text/javascript"></script>
       <title>RolePermission Management</title>
       <script type="text/javascript">
       function validateData()
        {
            var role =  document.getElementById("roles").options[document.getElementById("roles").selectedIndex].text;
            var permission =  document.getElementById("permissions").options[document.getElementById("permissions").selectedIndex].text;
            if (role == "--Select--") 
            {
                alert("Select role");
                return false;
            }
            else if (permission == "--Select--") 
            {
                alert("Select permission");
                return false;
            }
            else
                return true;
        }
            function Main()
            {
                var roles = SecurityManager.GetAllRoles();
                var cmb = document.getElementById('roles')
                for(var i=0;i<roles.length;i++)
                {
                    var opt = document.createElement("option");
                    opt.setAttribute("value",roles[i].role);
                    opt.innerText = roles[i].role;
                    cmb.appendChild(opt);
                }

                var permissions = SecurityManager.GetAllPermissions();
                var cmb = document.getElementById('permissions')
                for(var i=0;i<permissions.length;i++)
                {
                    var opt = document.createElement("option");
                    opt.setAttribute("value",permissions[i].permission);
                    opt.innerText = permissions[i].permission;
                    cmb.appendChild(opt);
                }


                var btn = document.getElementById("btnSave");
                btn.onclick = function() 
                {
                    if(validateData())
                    {
                        var role =  document.getElementById("roles").options[document.getElementById("roles").selectedIndex].text;
                        var permission =  document.getElementById("permissions").options[document.getElementById("permissions").selectedIndex].text;
                        var permRoles = SecurityManager.GetAllRolePermissions();
                        var flag = false;
                        var edit = false;
                        if(document.getElementById('editUser') != null)
                            edit = true;
                        for (var i = permRoles.length - 1; !edit && flag==false && i >= 0; i--) 
                        {
                                if(permRoles[i].role.toLowerCase() == role.toLowerCase() && permRoles[i].permission.toLowerCase(0) == permission.toLowerCase())
                                    flag = true;
                        }
                        if (flag==true) 
                           alert("Role/Permission already exists");
                        else
                        {
                            var record = {};
                            record.role = role;
                            record.permission = permission;
                            SecurityManager.SaveRolePermission(record,function() {
                                alert("Role/Permission is saved successfully!");
                            },function(){
                                alert("Error Occured");
                            }); // save role  
                            CreateTable();
                            location.reload();
                        }
                    }
                 };
            CreateTable();
        }//end of Main
            
        function CreateTable()
        {
            var table = document.getElementById("rolePermTable");
            var permissions = SecurityManager.GetAllRolePermissions();
            for (var i = 0; i <= (permissions.length-1); i++) 
            {
                var row = document.createElement('TR');
                var td = document.createElement('TD')
                td.appendChild(document.createTextNode(permissions[i].ID));
                row.appendChild(td);
                td = document.createElement('TD')
                td.appendChild(document.createTextNode(permissions[i].role));
                row.appendChild(td);
                td = document.createElement('TD')
                td.appendChild(document.createTextNode(permissions[i].permission));
                row.appendChild(td);
                td = document.createElement('TD')
                var a = document.createElement('a');
                a.setAttribute('href',"#");
                a.innerHTML = "Edit";
                a.setAttribute('id',i+1);
                a.setAttribute('onclick',"editRolePermission(this)");
                td.appendChild(a);
                row.appendChild(td);
                td = document.createElement('TD')
                a = document.createElement('a');
                a.setAttribute('href',"#");
                a.innerHTML = "Delete";
                a.setAttribute('id',i+1);
                a.setAttribute('onclick',"deleteRolePermission(this)");
                td.appendChild(a);
                row.appendChild(td);
                table.appendChild(row);
            }
        }

        function editRolePermission(row)
        {
            var id = row.id;
            id = Number(id);
            var permId = document.getElementById("rolePermTable").rows[id].cells[0].innerHTML;
            var record = SecurityManager.GetRolePermissionById(permId);
            document.getElementById("roles").options[ document.getElementById("roles").selectedIndex].text = record.role;
            document.getElementById("permissions").options[document.getElementById("permissions").selectedIndex].text = record.permission;
            var editElement = document.createElement('div');
            editElement.setAttribute('id','editUser');
            document.body.appendChild(editElement);
            SecurityManager.DeleteRolePermission(permId, function(){}, function(){});
        }   

        function deleteRolePermission(row)
        {
            if(confirm("Are you sure?"))
            {
                var id = row.id;
                id = Number(id);
                var permId = document.getElementById("rolePermTable").rows[id].cells[0].innerHTML;
                SecurityManager.DeleteRolePermission(permId,function(){
                    alert("Role/Permission deleted successfully");
                }, function(){
                    alert("Some error occured");
                });
                CreateTable();
                location.reload();
            }
        }
        </script>
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
            <div style="color:white">ROLE</div>
            <select id="roles">
            <option>----Select----</option>
            </select> <br>
          <div style="color:white">PERMISSION</div>
            <select id="permissions">
                <option>----Select----</option>
            </select> <br>
            <input type="submit" id="btnSave" value="Save">
            <input type="reset" id="clear" value="Clear">
	  </form>
	  </div>
	</div> 
  </div>
    
        <br> <br>
        <table border="3" id="rolePermTable">
            <tr>
                <th>ID</th>
                <th>Role</th>
                <th>Permission</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </table>
</body>
</html>