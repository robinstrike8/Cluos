<?php
include_once 'map_config.php';
header('Content-Type: application/json');

	
	$username = trim($_POST['lat']); //initializing variables to data retrived from post data.
	$password = trim($_POST['lng']);
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
    
    $in = $con->prepare("INSERT INTO map_table (lat,lng,radius,cluedescription)VALUES (?, ?, ?, ?)"); //The mysql prepared statement to be executed
	
	$in->bindParam(1, $username); //binding the param to the query statement.
	$in->bindParam(2, $password);
    $in->bindParam(3, $radius);
    $in->bindParam(4, $cluedescription);


	if(strlen($username)!=0 && strlen($password)!=0 && strlen($radius)!=0 && strlen($cluedescription)!=0){
	if($in->execute()) //Trying to execute the prepared statement. If passed, we point the browser back to the index page.

			echo json_encode(array('map_js'=>true), JSON_PRETTY_PRINT);
	}
	else
	{
			echo json_encode(array('map_js'=>false), JSON_PRETTY_PRINT);
    }

?>