<?php
$db_name="pc_vodafone";
$UserName="digita1err0r";
$Password="Castiel312#!@";
try
	{
		$con = new PDO("mysql:host=localhost;dbname=".$db_name, $UserName, $Password); //Here we try to establish a connection by taking username and password from config.php
	}
	catch(PDOException $e){
		die("ERROR ". $e->getMessage()); //If exception is caught, we print the error message here
	}
	
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Setting what type of error to show in case query fails
    $con->exec("SET NAMES utf8");
?>