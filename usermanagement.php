
<!DOCTYPE html>
<html>
<head>
    
    <script src="SecurityManager.js" type="text/javascript"></script>
    <script> 
    function validateEmail(email)
    {
		 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail.value))
			  	return true;
    	 alert("Invalid email address!");
    	 return false;
    }
    function validateUser()
    {
        var allUsers = SecurityManager.GetAllUsers();
        var login = document.getElementById("userMlogin").value;
        var email = document.getElementById("userMemail").value;
        var flag = true;
        for(var i=0;i<allUsers.length;i++)
        {
            if(login == allUsers[i].login)
            {
              alert("User already Exist");
              return false;
            }
            if(email == allUsers[i].email)
            {
              alert("Email already Exist");
              return false;
            }
        }
        return true;
    }
    function Main()
    {
            var countries = SecurityManager.GetCountries();
            var cmb = document.getElementById('cmbCountries');
            for(var i=0;i<countries.length;i++)
            {
                var opt = document.createElement("option");
                opt.setAttribute("value",countries[i].CountryID);
                opt.innerText = countries[i].Name;
                cmb.appendChild(opt);
            }

            cmb.onchange = function()
            {
                var citycmb = document.getElementById('cmbCities');
                //Remove all child elements (e.g. options)
                citycmb.innerHTML = '';
                var cities = SecurityManager.GetCitiesByCountryId(cmb.value);
                for(var i=0;i<cities.length;i++)
                {
                    var opt = document.createElement("option");
                    opt.setAttribute("value",cities[i].CityID);
                    opt.innerText = cities[i].Name;
                    citycmb.appendChild(opt);
                }   

                var btn =document.getElementById("btnMuser");
                btn.onclick =function()
                {
                    var validate = validateUser();
                    var userObj = {};
                    userObj.login = document.getElementById("userMlogin").value;
                    userObj.pass = document.getElementById("userMpass").value;
                    userObj.name = document.getElementById("userMname").value;
                    userObj.email = document.getElementById("userMemail").value;
                    userObj.country = document.getElementById("cmbCountries").options[document.getElementById("cmbCountries").selectedIndex].text;
                    userObj.city = document.getElementById("cmbCities").options[document.getElementById("cmbCities").selectedIndex].text;
                    if(validate)
                    {
                        SecurityManager.SaveUser(userObj, function()
                        {alert("user is saved!")}, function(){alert("error occured!");});
                    }
                    else
                    {
                        document.getElementById("userMlogin").value = userObj.login;
                        document.getElementById("userMpass").value = userObj.pass;
                        document.getElementById("userMname").value = userObj.name ;
                        document.getElementById("userMemail").value = userObj.email;
                        document.getElementById("cmbCountries").options[document.getElementById("cmbCountries").selectedIndex].text = userObj.country;
                        document.getElementById("cmbCities").options[document.getElementById("cmbCities").selectedIndex].text = userObj.city ;
                    }
                };
            }  //end of onchange
            CreateTable();
    }   
 function CreateTable()
        {
            var userTable = document.getElementById("userTable");
            var users = SecurityManager.GetAllUsers();
            for (var i = 0; i < users.length ; i++) 
            {
                var row = document.createElement('TR');
                var td = document.createElement('TD')
                td.appendChild(document.createTextNode(users[i].ID));
                row.appendChild(td);
                td = document.createElement('TD')
                td.appendChild(document.createTextNode(users[i].name));
                row.appendChild(td);
                td = document.createElement('TD')
                td.appendChild(document.createTextNode(users[i].email));
                row.appendChild(td);
                td = document.createElement('TD')
                var a = document.createElement('a');
                a.setAttribute('href',"#");
                a.innerHTML = "Edit";
                a.setAttribute('id',i+1);
                a.setAttribute('onclick',"editUser(this)");
                td.appendChild(a);
                row.appendChild(td);
                td = document.createElement('TD')
                a = document.createElement('a');
                a.setAttribute('href',"#");
                a.innerHTML = "Delete";
                a.setAttribute('id',i+1);
                a.setAttribute('onclick',"deleteUser(this)");
                td.appendChild(a);
                row.appendChild(td);
                userTable.appendChild(row);
            }
        }

        function EditUser(row)
        {
           var id = row.id;
            id = Number(id);
            var userId = document.getElementById("userTable").rows[id].cells[0].innerHTML;
            var user = SecurityManager.GetUserById(userId);
            document.getElementById("userMlogin").value = user.login;
            document.getElementById("userMpass").value = user.password;
            document.getElementById("userMname").value = user.name;
            document.getElementById("userMemail").value = user.email;
            document.getElementById("cmbCountries").options[ document.getElementById("cmbCountries").selectedIndex].text = user.country;
            document.getElementById("cmbCities").options[ document.getElementById("cmbCities").selectedIndex].text = user.city;
            var editElement = document.createElement('div');
            editElement.setAttribute('id','EditUser');
            document.body.appendChild(editElement);
            SecurityManager.DeleteUser(userId, function(){}, function(){});
        }   

        function deleteUser(row)
        {
            if(confirm("Are you sure?"))
            {
                var id = row.id;
                id = Number(id);
                var userId = document.getElementById("userTable").rows[id].cells[0].innerHTML;
                SecurityManager.DeleteUser(userId);
                CreateTable();
                location.reload();
            }
        }
    </script>
    <link rel="stylesheet" href="login.css"></link>
<title>Welcome User Management</title>
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
<h1 align="center" style ="font:Baskerville Old Face" >WELLCOME USER MANAGEMENT</h1>
<div style="margin:auto">
      <form name="form1">
	   <h1 style="color:black">User Management </h1>
	   <div style="color:black">Loign</div>
       <input id="userMlogin" type="text1" ><br>
       <div style="color:black">Password</div>
       <input id="userMpass" type="password" ><br>
        <idv style="color:black" >Name</div>
        <input id="userMname" type="text2" ><br>
        <div style="color:black">Email</div>
        <input id="userMemail" type="email" onchange="validateEmail(ducument.form1.userMemail)" required><br>
        <lable>Country</lable><br>
        <select id="cmbCountries">
             <option> Select </option>
        </select><br>
        <lable>City</lable><br>
        <select id="cmbCities">
             <option> Select </option>
        </select><br>
        
       <input style="color:black" type="submit" value="Save" id="btnMuser" >
       <input style="color:black" type="reset" value="Clear" id="btnClear" >
	  </form>
	</div> 
     <br> <br>
     <div align="center">
        <table border="5" id="userTable">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </table>
        </div>
</body>
</html>