<?php
include_once 'map_config.php';
header('Content-Type: application/json');
$clueid = $_GET['getbyclueid'];
$eventid = $_GET['getbyeventid'];
try
	{
		$con = new PDO("mysql:host=localhost;dbname=".$db_name, $UserName, $Password); //Here we try to establish a connection by taking username and password from config.php
	}
	catch(PDOException $e){
		die("ERROR ". $e->getMessage()); //If exception is caught, we print the error message here
	}
	
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_GET['getbyclueid'])){
	 $in = $con->prepare("SELECT id,lat,lng,radius,cluedescription FROM clues WHERE prev_clue_id = ? LIMIT 1"); //The mysql prepared statement to be executed
         $in->bindParam(1, $clueid);
} else if (isset($_GET['getbyeventid'])){
	 $in = $con->prepare("SELECT id,lat,lng,radius,cluedescription FROM clues WHERE event_id = ? AND is_initial = true"); //The mysql to be executed
         $in->bindParam(1, $eventid);
         //$in->bindParam(2, true);
}
	 $in->execute();
	 $coordinates=array();
while($result = $in->fetch(PDO::FETCH_ASSOC)){

$row['id'] = (int)$result['id'];
$row['lat']=(double)$result['lat'];
$row['lng']=(double)$result['lng'];
$row['radius']=(int)$result['radius'];
$row['clue']=$result['cluedescription'];


array_push($coordinates,$row);
}
echo json_encode($coordinates,JSON_PRETTY_PRINT);
?>