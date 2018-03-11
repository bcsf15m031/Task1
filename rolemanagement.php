
<!DOCTYPE html>
<html>
<head>
       <link rel="stylesheet" href="login.css"></link>
<script src="SecurityManager.js" type="text/javascript"></script>
<title>Role Management</title>
    <script type="text/javascript">
     function validateRole()
    {
        var allRoles = SecurityManager.GetAllRoles();
        var rname = document.getElementById("rolename").value;
        for(var i=0;i<allRoles.length;i++)
        {
            if(rname == allRoles[i].role)
            {
              alert("Role already Exist");
              return false;
            }
        }
        return true;
    }
    function main()
    {
     var btn = doucument.getElementById("btnRuser");
     btn.onclick=function()
     {
         var rolename = documnet.getElementById("rolename").value;
         var description = document.getElementById("description").value;
         var roles = SecurityManager.GetAllRoles();
           var validate = validateRole();
                    var roleobj = {};
                    roleobj.rolename = document.getElementById("rolename").value;
                    roleobj.description = document.getElementById("description").value;
                    if(validate)
                    {
                        SecurityManager.SaveRole(roleobj, function()
                        {
                            alert("Role is saved!")
                        }, 
                        function()
                        {
                            alert("error occured!");
                        });
                    }
                    else
                    {
                        document.getElementById("rolename").value = roleobj.role;
                    }
     }
     CreateTable();
        }//end of Main
            
        function CreateTable()
        {
            var roleTable = document.getElementById("roleTable");
            var roles = SecurityManager.GetAllRoles();
            for (var i = 0; i <= (roles.length-1); i++) 
            {
                var row = document.createElement('TR');
                var td = document.createElement('TD')
                td.appendChild(document.createTextNode(roles[i].ID));
                row.appendChild(td);
                td = document.createElement('TD')
                td.appendChild(document.createTextNode(roles[i].role));
                row.appendChild(td);
                td = document.createElement('TD')
                td.appendChild(document.createTextNode(roles[i].desc));
                row.appendChild(td);
                td = document.createElement('TD')
                var a = document.createElement('a');
                a.setAttribute('href',"#");
                a.innerHTML = "Edit";
                a.setAttribute('id',i+1);
                a.setAttribute('onclick',"editRole(this)");
                td.appendChild(a);
                row.appendChild(td);
                td = document.createElement('TD')
                a = document.createElement('a');
                a.setAttribute('href',"#");
                a.innerHTML = "Delete";
                a.setAttribute('id',i+1);
                a.setAttribute('onclick',"deleteRole(this)");
                td.appendChild(a);
                row.appendChild(td);
                roleTable.appendChild(row);
            }
        }

        function editRole(row)
        {
            var id = row.id;
            id = Number(id);
            var roleId = document.getElementById("roleTable").rows[id].cells[0].innerHTML;
            var record = SecurityManager.GetRoleById(roleId);
            document.getElementById("rolename").value = record.role;
            document.getElementById("description").value = record.desc;
            var editElement = document.createElement('div');
            editElement.setAttribute('id','editUser');
            document.body.appendChild(editElement);
            SecurityManager.DeleteRole(roleId, function(){}, function(){});
        }   

        function deleteRole(row)
        {
            if(confirm("Are you sure?"))
            {
                var id = row.id;
                id = Number(id);
                var roleId = document.getElementById("roleTable").rows[id].cells[0].innerHTML;
                SecurityManager.DeleteRole(roleId,function(){
                    alert("Role deleted successfully!");
                }, function(){
                    alert(Some error occured");
                });
                CreateTable();
                location.reload();
            }
        }
    </script>
</head>
<body onload="main();">
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
<h1 align="center" style ="font:Baskerville Old Face" >WELLCOME ROLE MANAGEMENT</h1>
  <div style="float:left">
  <div class="login-page">
      <div class="form">
      <form class="login-form" id="userlogin" >
	   <h1 style="color:white">ROLE MANAGEMENT </h1>
	   <div style="color:white">RollName</div>
	   <input id="rolename" type="text1"><br>
       <div style="color:white">Description</div>
	   <input id="description" type="text2"><br>
       <input style="color:black" type="submit" value="Save" id="btnRuser" >
       	  </form>
	  </div>
	</div> 
  </div>
    <br> <br>
        <table border="3" id="roleTable">
            <tr>
                <th>ID</th>
                <th>Roll Name</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </table>
</body>
</html>