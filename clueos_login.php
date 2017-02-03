<?php
include_once 'config.php';
	header('Content-Type: application/json');

	
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
    $in = $con->prepare("SELECT * FROM users WHERE mobile=? LIMIT 1"); 

    //The mysql prepared statement to be executed
	
	$in->bindParam(1, $username); //binding the param to the query statement.
	$in->execute();
	$data=array();
   
	if($in->fetchColumn()!=0){
		 $check = $con->prepare("SELECT * FROM users WHERE imei=? LIMIT 1"); 

    //The mysql prepared statement to be executed
	
	    $check->bindParam(1, $password); //binding the param to the query statement.
	    $check->execute();
		//print("Success");
		if($check->fetchColumn()!=0){
			$row['valid']=true;
            $row['newuser']=false;


         array_push($data,$row);
          echo json_encode(($data),JSON_PRETTY_PRINT);

	}
	else
	{

     $row['valid']=false;
      $row['newuser']=false;


         array_push($data,$row);
          echo json_encode(($data),JSON_PRETTY_PRINT);

	}
}
	else{
		//print("Error Logging in");

			 $row['valid']=false;
            $row['newuser']=true;


            array_push($data,$row);
            echo json_encode(($data),JSON_PRETTY_PRINT);

	}
	
?>