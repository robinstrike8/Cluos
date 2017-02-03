<?php
include_once 'config.php';
	foreach($_GET['checkbox'] as $value)
    {

    $in = $con->prepare("DELETE from events WHERE id= ?");
    $in->bindParam(1,$value);
    $in->execute();
		
     }
        echo "<body style='background: url(pikachu.jpg);'>";

	print("Selected Events Deleted Successfully! Please Wait Redirecting....");
	echo "<meta http-equiv='refresh' content='3;url=listevents.php'>";
	

?>
