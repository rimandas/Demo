<?php

include("database/db_connection.php");

// if(!$_SESSION['email'])
// {
//   header("Location: login.php");
// }






if(isset($_GET['appointment_id']))
{
	$appointment_id = $_GET['appointment_id'];

	$sql = "SELECT * FROM appointment WHERE id = '".$appointment_id."'";
	//echo $sql;die;
	$query=mysqli_query($dbcon, $sql);
	$value = mysqli_fetch_object($query);
	echo json_encode($value);die;
	
}







?>