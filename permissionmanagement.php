
<!DOCTYPE html>
<html>
<head>
       <link rel="stylesheet" href="login.css"></link>
<script src="SecurityManager.js" type="text/javascript"></script>
<title>Permission Management</title>
  <script type="text/javascript">
   function main()
    {

                var btn = document.getElementById("btnpsave");
                btn.onclick = function() 
                {}
                    var perm = document.getElementById("pname").value;
                    var descp = document.getElementById("description").value;
                    var permissions = SecurityManager.GetAllPermissions();
                    var flag = false;
                    var edit = false;
                    if(document.getElementById('editUser') != null)
                        edit = true;
                    for (var i = permissions.length - 1; !edit && flag==false && i >= 0; i--) 
                    {
                        if(permissions[i].permission.toLowerCase() == perm.toLowerCase())
                            flag = true;
                    }
                    if (flag==true) 
                       alert("Permission already exists!");
                    else
                    {
                        var record = {};
                        record.permission = perm;
                        record.desc = descp;
                        SecurityManager.SavePermission(record,function() {
                            alert("Permission is saved successfully!");
                        },function(){
                            alert("Error Occured");
                        }); // save role  
                        CreateTable();
                        location.reload();
                    }
                };
 CreateTable();
    }//end of Main
            
        function CreateTable()
        {     var permTable = document.getElementById("permTable");
            var permissions = SecurityManager.GetAllPermissions();
            for (var i = 0; i <= (permissions.length-1); i++) 
            {
                var row = document.createElement('TR');
                var td = document.createElement('TD')
                td.appendChild(document.createTextNode(permissions[i].ID));
                row.appendChild(td);
                td = document.createElement('TD')
                td.appendChild(document.createTextNode(permissions[i].permission));
                row.appendChild(td);
                td = document.createElement('TD')
                td.appendChild(document.createTextNode(permissions[i].desc));
                row.appendChild(td);
                td = document.createElement('TD')
                var a = document.createElement('a');
                a.setAttribute('href',"#");
                a.innerHTML = "Edit";
                a.setAttribute('id',i+1);
                a.setAttribute('onclick',"editPermission(this)");
                td.appendChild(a);
                row.appendChild(td);
                td = document.createElement('TD')
                a = document.createElement('a');
                a.setAttribute('href',"#");
                a.innerHTML = "Delete";
                a.setAttribute('id',i+1);
                a.setAttribute('onclick',"deletePermission(this)");
                td.appendChild(a);
                row.appendChild(td);
                permTable.appendChild(row);
            }
        }

        function editPermission(row)
        {
            var id = row.id;
            id = Number(id);
            var permId = document.getElementById("permTable").rows[id].cells[0].innerHTML;
            var record = SecurityManager.GetPermissionById(permId);
            document.getElementById("pname").value = record.permission;
            document.getElementById("description").value = record.desc;
            var editElement = document.createElement('div');
            editElement.setAttribute('id','editUser');
            document.body.appendChild(editElement);
            SecurityManager.DeletePermission(permId, function(){}, function(){});
        }   

        function deletePermission(row)
        {
            if(confirm("Are you sure?"))
            {
                var id = row.id;
                id = Number(id);
                var permId = document.getElementById("permTable").rows[id].cells[0].innerHTML;
                SecurityManager.DeletePermission(permId,function(){
                    alert("Permission deleted successfully!");
                }, function(){
                    alert("Some error Occured!");
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
<h1 align="center" style ="font:Baskerville Old Face" >WELLCOME PERMISSION MANAGEMENT</h1>
  <div style="float:left">
  <div class="login-page">
      <div class="form">
      <form class="login-form" id="userlogin" >
	   <h1 style="color:white">PERMISSION MANAGEMENT </h1>
	   <div style="color:white">Permission Name</div>
	   <input id="pname" type="text1"><br>
       <div style="color:white">Description</div>
	   <input id="pdescription" type="text2"><br>
     <input style="color:black" type="submit" value="Save" id="btnpsave" >
     	</form>
	  </div>
	</div> 
  </div>
   <br> <br>
        <table border="3" id="permTable">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </table>
</body>
</html>