<?php
include_once 'config.php';
	
	$username = trim($_GET['phoneno']); //initializing variables to data retrived from post data.
	$password = trim($_GET['imei']);
	try
	{
		$con = new PDO("mysql:host=localhost;dbname=".$db_name, $UserName, $Password); //Here we try to establish a connection by taking username and password from config.php
	}
	catch(PDOException $e){
		die("ERROR ". $e->getMessage()); //If exception is caught, we print the error message here
	}
	
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Setting what type of error to show in case query fails
    $con->exec("SET NAMES utf8"); //Setting the char encoding
    $in = $con->prepare("INSERT INTO users (mobile, imei)VALUES (?, ?)"); //The mysql prepared statement to be executed
	
	$in->bindParam(1, $username); //binding the param to the query statement.
	$in->bindParam(2, $password);
	
	if($in->execute())
		print("Success");
	else
		print("Error Logging in");
	
?>