<?php
include_once 'map_config.php';
header('Content-Type: application/json');
try
	{
		$con = new PDO("mysql:host=localhost;dbname=".$db_name, $UserName, $Password); //Here we try to establish a connection by taking username and password from config.php
	}
	catch(PDOException $e){
		die("ERROR ". $e->getMessage()); //If exception is caught, we print the error message here
	}
	
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $in = $con->prepare("SELECT id,eventname,UNIX_TIMESTAMP(startingtime),UNIX_TIMESTAMP(endingtime),eventdescription FROM events ORDER BY id ASC"); //The mysql prepared statement to be executed
	 $in->execute();
	 $coordinates=array();
while($result = $in->fetch(PDO::FETCH_ASSOC)){

$row['id'] = (int)$result['id'];
$row['eventname']=$result['eventname'];
$row['startingtime']=(double)$result['UNIX_TIMESTAMP(startingtime)'];
$row['endingtime']=(double)$result['UNIX_TIMESTAMP(endingtime)'];
$row['eventdescription']=$result['eventdescription'];


array_push($coordinates,$row);
}
echo json_encode($coordinates,JSON_PRETTY_PRINT);
?>