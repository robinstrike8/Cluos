<?php
include_once 'map_config.php';

	$eventid = trim($_POST['eventid']);
	$latitude = trim($_POST['lat']); //initializing variables to data retrived from post data.
	$longitude = trim($_POST['lng']);
	$radius   = trim($_POST['radius']);
	$cluedescription = trim($_POST['cluedescription']);
	try
	{
		$con = new PDO("mysql:host=localhost;dbname=".$db_name, $UserName, $Password); //Here we try to establish a connection by taking username and password from config.php
	}
	catch(PDOException $e){
		die("ERROR ". $e->getMessage()); //If exception is caught, we print the error message here
	}
	
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Setting what type of error to show in case query fails
    $con->exec("SET NAMES utf8"); //Setting the char encoding

    $in= $con->prepare("SELECT is_initial from clues WHERE event_id=?");
     $in->bindParam(1,$eventid);
    if($in->execute())
    {
      $result = $in->fetch(PDO::FETCH_ASSOC)
      if($result==1)
     {
            $in= $con->prepare("SELECT prev_clue_id from clues WHERE event_id=? ORDER BY DESC");
            $in->bindParam(1,$eventid);
            $in->execute();
            $res = $in->fetch(PDO::FETCH_ASSOC)
         
    $in = $con->prepare("INSERT INTO clues (event_id,lat,lng,radius,cluedescription,is_initial,prev_clue_id)VALUES (?, ?, ?, ?, ?,0,?)"); //The mysql prepared statement to be executed
    $in->bindParam(1,$eventid);
	$in->bindParam(2,$latitude); //binding the param to the query statement.
	$in->bindParam(3,$longitude);
    $in->bindParam(4, $radius);
    $in->bindParam(5, $cluedescription);
    $in->bindParam(6, $res);
      
  }

      else 
 {
    $in = $con->prepare("INSERT INTO clues (event_id,lat,lng,radius,cluedescription,is_initial,prev_clue_id)VALUES (?, ?, ?, ?, ?,1,0)"); //The mysql prepared statement to be executed
    $in->bindParam(1,$eventid);
	$in->bindParam(2,$latitude); //binding the param to the query statement.
	$in->bindParam(3,$longitude);
    $in->bindParam(4, $radius);
    $in->bindParam(5, $cluedescription);
}

	if(strlen($eventid)!=0 && strlen($latitude)!=0 && strlen($longitude)!=0 && strlen($radius)!=0 && strlen($cluedescription)!=0){
	if($in->execute()) //Trying to execute the prepared statement. If passed, we point the browser back to the index page.

			echo json_encode(array('map_js'=>true), JSON_PRETTY_PRINT);
			
	}
	else
	{
			echo json_encode(array('map_js'=>false), JSON_PRETTY_PRINT);
    }
}
else
{

   echo "error";

}

?>