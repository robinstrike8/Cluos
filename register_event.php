<?php
include_once 'config.php';
	
	$eventname = $_GET['eventname']; //initializing variables to data retrived from post data.
	$startingtime = $_GET['startingtime'];
	$endingtime = $_GET['endingtime'];
	$eventdescription = $_GET['eventdescription'];

    $in = $con->prepare("INSERT INTO events (eventname, startingtime,endingtime,eventdescription)VALUES (?, ?,?,?)"); //The mysql prepared statement to be executed
	
	$in->bindParam(1, $eventname); //binding the param to the query statement.
	$in->bindParam(2, $startingtime);
    $in->bindParam(3, $endingtime);
    $in->bindParam(4, $eventdescription);


	if($in->execute())
		
  {
      echo "<body style='background: url(pikachu.jpg);'>";
      print("Event Added Successfully! Please Wait Redirecting....");
      echo "<meta http-equiv='refresh' content='3;url=listevents.php'>";
  }
	 
	else
		print("Error Adding Event");
	
?>