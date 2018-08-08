<?php

include("database/db_connection.php");

// if(!$_SESSION['email'])
// {
//   header("Location: login.php");
// }






if(isset($_GET['doctors_id']))
{
	$doctors_id = $_GET['doctors_id'];

	$sql = "SELECT * FROM doctors WHERE id = '".$doctors_id."'";
	//echo $sql;die;
	$query=mysqli_query($dbcon, $sql);
	$value = mysqli_fetch_object($query);
	echo json_encode($value);die;
	
}

if(!empty($_POST['doc_name_edit']))
{
	//print_r($_POST);die('hhhhhhh');
	$uid 				= 	$_POST['uid'];
	$doc_name 			= 	$_POST['doc_name_edit'];
	$specialization 	= 	$_POST['specialization_edit'];
	$address 			= 	$_POST['address_edit'];
	$email 				= 	$_POST['email_edit'];
	$phone 				= 	$_POST['phone_edit'];
	$time_from 			= 	$_POST['time_from_edit'];
	$time_to 			= 	$_POST['time_to_edit'];
	$normal_fee 		= 	$_POST['normal_fee_edit'];
	$offer_fee 			= 	$_POST['offer_fee_edit'];

	$sql = "UPDATE doctors SET name ='".$doc_name."', specilization ='".$specialization."', location ='".$address."', email ='".$email."', phone ='".$phone."', time_from ='".$time_from."', time_to ='".$time_to."', normal_fee ='".$normal_fee."', offer_fee ='".$offer_fee."' WHERE id ='".$uid."'";

	if (mysqli_query($dbcon, $sql)) {
	    echo "Updated successfully...";die;
	} else {
	    echo "Error updating record: " . mysqli_error($dbcon);
	}

	mysqli_close($dbcon);
	
}


if(!empty($_POST['doc_name_add']))
{
	//print_r($_POST);die('hhhhhhh');
	$doc_name 			= 	$_POST['doc_name_add'];
	$specialization 	= 	$_POST['specialization_add'];
	$address 			= 	$_POST['address_add'];
	$email 				= 	$_POST['email_add'];
	$phone 				= 	$_POST['phone_add'];
	$time_from 			= 	$_POST['time_from_add'];
	$time_to 			= 	$_POST['time_to_add'];
	$normal_fee 		= 	$_POST['normal_fee_add'];
	$offer_fee 			= 	$_POST['offer_fee_add'];
	$username 			= 	$_POST['username_add'];
	$password 			= 	$_POST['password_add'];
	$country 	 		= 	$_POST['country_add'];
	$visit_days 		= 	$_POST['days_add'];

	$visit_day = '';
    foreach ($visit_days as $v) 
    {
        $visit_day = $visit_day.','.$v;
    }

    $visits_day = ltrim($visit_day,',');

	$sql = "INSERT INTO doctors (username, email, password, name, specilization, location, normal_fee, offer_fee, days, time_from, time_to, phone, rating, country, image) VALUES ('".$username."', '".$email."', '".md5($password)."', '".$doc_name."', '".$specialization."', '".$address."', '".$normal_fee."', '".$offer_fee."', '".$visits_day."', '".$time_from."', '".$time_to."', '".$phone."', '', '".$country."', '')";

	if ((mysqli_query($dbcon, $sql)) === TRUE) 
	{
		 $id = mysqli_insert_id($dbcon);
		 if($id)
		 {
		 	echo 'Doctors added successfully...';die;
		 }
	} 
	else 
	{
    	echo "ERROR: Could not able to execute $sql. " . mysqli_error($dbcon);
	}
	mysqli_close($dbcon);

}


if(isset($_GET['delete_row_id']))
{
	$delete_id = $_GET['delete_row_id'];

	$sql = "DELETE FROM doctors WHERE id='".$delete_id."'";

	if ($dbcon->query($sql) === TRUE) {
	    echo "Deleted successfully...";
	} else {
	    echo "Error deleting record: " . $dbcon->error;
	}

	$dbcon->close();
}

if(isset($_GET['countryList']))
{
	$sql = "SELECT * FROM country WHERE status = '1'";
	//echo $sql;die;
	$result=mysqli_query($dbcon, $sql);
	//$result = mysqli_fetch_object($query);
	if ($result->num_rows > 0) 
	{
	    $country_list ='';
	    $country_list .= "<option value=''>Country</option>";
	    while($row = $result->fetch_assoc()) 
	    {
	        $country_list .= "<option value='".$row['country_name']."'>".$row['country_name']."</option>";
	    }
	}
	else
	{
	    echo "0 results";
	}
	echo $country_list;die;
	$conn->close();
	
}







?>