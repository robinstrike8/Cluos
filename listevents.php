<?php
include_once 'map_config.php';
try
	{
		$con = new PDO("mysql:host=localhost;dbname=".$db_name, $UserName, $Password); //Here we try to establish a connection by taking username and password from config.php
	}
	catch(PDOException $e){
		die("ERROR ". $e->getMessage()); //If exception is caught, we print the error message here
	}
	
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $in = $con->prepare("SELECT eventname,id FROM events ORDER BY id ASC"); //The mysql prepared statement to be executed
	 $in->execute();
	 echo "<html>";
	 echo "<head>
   <link rel=\"icon\" type=\"image/png\" href=\"images/Eye_of_the_Dragon_icon.png\"><title>Cluos Events </title>
    <style type=\"text/css\">
        <style type=\"text/css\">
.form-style-1 {
    margin:10px auto;
    max-width: 400px;
    padding: 20px 12px 10px 20px;
    font: 13px \"Lucida Sans Unicode\", \"Lucida Grande\", sans-serif;
     background: linear-gradient(#efefef, #999) fixed;
}
.form-style-1 li {
    padding: 0;
    display: block;
    list-style: none;
    margin: 10px 0 0 0;
}
.form-style-1 label{
    margin:0 0 3px 0;
    padding:0px;
    display:block;
    font-weight: bold;
}
.form-style-1 input[type=text], 
.form-style-1 input[type=date],
.form-style-1 input[type=datetime],
.form-style-1 input[type=number],
.form-style-1 input[type=search],
.form-style-1 input[type=time],
.form-style-1 input[type=url],
.form-style-1 input[type=email],
textarea, 
select{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    border:1px solid #BEBEBE;
    padding: 7px;
    margin:0px;
    -webkit-transition: all 0.30s ease-in-out;
    -moz-transition: all 0.30s ease-in-out;
    -ms-transition: all 0.30s ease-in-out;
    -o-transition: all 0.30s ease-in-out;
    outline: none;  
}
.form-style-1 input[type=text]:focus, 
.form-style-1 input[type=date]:focus,
.form-style-1 input[type=datetime]:focus,
.form-style-1 input[type=number]:focus,
.form-style-1 input[type=search]:focus,
.form-style-1 input[type=time]:focus,
.form-style-1 input[type=url]:focus,
.form-style-1 input[type=email]:focus,
.form-style-1 textarea:focus, 
.form-style-1 select:focus{
    -moz-box-shadow: 0 0 8px #88D5E9;
    -webkit-box-shadow: 0 0 8px #88D5E9;
    box-shadow: 0 0 8px #88D5E9;
    border: 1px solid #88D5E9;
}
.form-style-1 .field-divided{
    width: 49%;
}

.form-style-1 .field-long{
    width: 40%;
}
.form-style-1 .field-select{
    width: 100%;
}
.form-style-1 .field-textarea{
    height: 100px;
    width: 70%;
}
.form-style-1 input[type=submit], .form-style-1 input[type=button]{
    background: #4B99AD;
    padding: 8px 15px 8px 15px;
    border: none;
    color: #fff;
}
.form-style-1 input[type=reset], .form-style-1 input[type=button]{
    background: #4B99AD;
    padding: 8px 15px 8px 15px;
    border: none;
    color: #fff;
}
.form-style-1 input[type=submit]:hover, .form-style-1 input[type=button]:hover{
    background: #4691A4;
    box-shadow:none;
    -moz-box-shadow:none;
    -webkit-box-shadow:none;
}
.form-style-1 input[type=reset]:hover, .form-style-1 input[type=button]:hover{
    background: #4691A4;
    box-shadow:none;
    -moz-box-shadow:none;
    -webkit-box-shadow:none;
}
.form-style-1 .required{
    color:red;
}

body
{
     background: linear-gradient(#efefef, #999) fixed;
}

</style>

</head>
<body>
<h3 align=\"center\" style=\"color:#FF6F00;\">Event Management</h3>";
echo '<table id="myTbl"><thead><tr><th>Event Name</th></tr></thead><form action="mapnew.html" method="GET">';
while($row = $in->fetch(PDO::FETCH_ASSOC)){
$val = $row['id'];
echo '<tbody><tr><td><input type="radio" name="eventid" id="eventid" value="' . $val . '"/>';
echo  ($row['eventname']);
}
echo "</tbody></table><ul  class=\"form-style-1\"> <li>";

echo     "<input type=\"button\" onclick=\"location.href='registerevent.html';\" value=\"Add Event\" />
         <input type=\"submit\"  value=\"Delete Event\" formaction=\"deleteevent.php\"/>
        <input type=\"submit\"  name=\"action\" id=\"eventid\" value=\"Add Clues to an Event\" />
        <input type=\"button\" onclick=\"location.href='http://google.com';\" value=\"Go to Google\" />



    </li></ul></form></body>";
echo"</html>";
?>