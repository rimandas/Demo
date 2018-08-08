<?php
session_start();

if(!$_SESSION['email'])
{
 header("Location: login.php");//redirect to login page to secure the welcome page without login access.
}

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>cita app</title>
		
		<!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="css/style.css">
		<!-- doctors Lists -->
		 <link rel="stylesheet" href="css/doc_list.css">
		 
		<!-- javascript for popups -->
		<link rel="stylesheet" href="css/popup.css">
		
		<link rel="stylesheet" type="text/css" href="dist/timepicker.min.css">
		
        
    </head>
    <body>



        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3></h3>
                </div>

                <ul class="list-unstyled components">
                   
                    <li class="">
                        <a href="manage-doc.php">Manage Doctors</a>
                        <!--
						<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"> this is for colapse icone for submanue
						<ul class="collapse list-unstyled" id="homeSubmenu">
                            <li><a href="#">Home 1</a></li>
                            <li><a href="#">Home 2</a></li>
                            <li><a href="#">Home 3</a></li>
                        </ul>
						-->
                    </li>
                    <li class="active">
                        <a href="manage-ap.php">Manage Appointments</a>
					
                    </li>
                    <li>
                        <a href="messages.php">Messages</a>
                    </li>

                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                    
                </ul>

            </nav>

            <!-- Page Content Holder -->
            <div id="content" style="width:1050px;">

                <nav class="navbar navbar-default">
                    <div class="container-fluid">

                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="navbar-btn">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <h1>Manage Appointments</h1>
                            </ul>
                        </div>
                    </div>
                </nav>
    <?php
        include("database/db_connection.php");
        $view_users_query="select * from appointment";//select query for viewing users.
        $run=mysqli_query($dbcon,$view_users_query);//here run the sql query.

        while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.
        {
            $id=$row[0];
            $doctor_name=$row[3];
            $patient_name=$row[4]; 
    ?>

        	  <ul>
              <li><?php echo $doctor_name; ?>  <div class="patnt"> <?php echo $patient_name; ?></div><span class="view glyphicon glyphicon-eye-open" title="View" onclick="openViewModal('<?php echo $id; ?>')" ></span> </li>
              </ul>
		
    <?php } ?>	
				
			<!-- <span class="" onclick="openAddModal()" style="width:200px;">
				</span> -->

							
                 </div>
            
                 


                <div id="modal-wrapper-view" class="modal">
				  
				<form class="modal-content animate" action="manage-doc.php">
						
					<div class="imgcontainer">
					  <span onclick="document.getElementById('modal-wrapper-view').style.display='none'" class="close-btn" title="Close PopUp">&times;</span>
					 <!-- <img src="1.png" alt="Avatar" class="avatar">-->
					  <h2 style="text-align:center">Appointment Information</h2>
					</div>

					<div class="container">
					  <input class="texttype1" type="text" placeholder="Doctor's Name" name="doc_name" id="doc_name" readonly="true"><br>
					  <input class="texttype1" type="text" placeholder="Patient's Name" name="patient" id="patient" readonly="true"><br>
					  <textarea class="texttype1" placeholder="Visit Location" name="address" id="address" readonly="true"></textarea><br>
					  <input class="texttype2" type="text" placeholder="Day" name="day" id="day" readonly="true">
            <input class="texttype2" type="number" placeholder="Fees" name="fees" id="fees" readonly="true"><br> 
					  <input class="texttype2" type="text" placeholder="Visit Date" name="visit_date" id="visit_date" readonly="true">
            <input class="texttype2" type="text" placeholder="Time" name="time" id="time" readonly="true"> <br>
						<!-- <script src="dist/timepicker.min.js"></script> -->
						<!-- <script>
							document.addEventListener("DOMContentLoaded", function(event)
							{
								timepicker.load({
									interval: 15,
									defaultHour: 8
								});
							});
						</script> -->

						<br>
					</div>
					
				</form>
				  
				   </div>

				
                 </div>
        </div>
		
		
        <!-- jQuery CDN -->
		 <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
         <!-- Bootstrap Js CDN -->
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

					
					 
			<script>
			// If user clicks anywhere outside of the modal, Modal will close

			var modal = document.getElementById('modal-wrapper');
			window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
				}
			}
			</script>
		 
         <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                     $(this).toggleClass('active');
                 });
             });
         </script>

         <!-- View , Edit -->

         <script>

             function openViewModal(id)
             {
                //alert(id);
                if(id != '')
                {
                    $.ajax({
                        type:'POST',
                        url: 'get_data_ap.php?appointment_id='+id,
                        //data:{get_acno: get_acno},
                        success:function(response) {

                          // alert(response);
                          // return false;
                            if(response)
                            {
                              var data_jsons = JSON.parse(response);
                              //console.log(data_jsons);
                              $('#doc_name').val(data_jsons.doc_name);
                              $('#patient').val(data_jsons.pat_name);
                              $('#address').val(data_jsons.location);
                              $('#day').val(data_jsons.days);
                              $('#fees').val(data_jsons.fee);
                              $('#visit_date').val(data_jsons.visit_date);
                              $('#time').val(data_jsons.time);
                            }
                            $('#modal-wrapper-view').fadeIn();
                          
                        }
                    });
                }
             }

         </script>


    </body>
</html>

<?php

if(isset($_POST['submit'])){
    $doctor_name=$_POST['dname-add'];//here getting result from the post array after submitting the form.  
    $spec=$_POST['spl-add'];//same  
    $doctor_email=$_POST['email-add'];//same  
    $time=$_POST['timepicker-add'];//same  \
    $fee=$_POST['fee-add'];//same  

    echo"<script> alert('$dbcon')</script>";
  
    if($doctor_name=='')  {  
        //javascript use for input checking  
        echo"<script>alert('Please enter the doctor's name.')</script>"; exit();
       }  
  
    if($spec=='') {  
        echo"<script>alert('Please enter the specilization.')</script>";  
           exit(); 
          }  
  
    if($doctor_email=='')  
    {  
        echo"<script>alert('Please enter the email')</script>";  
        exit();  
    }  

    $check_email_query="select * from doctors WHERE email='$doctor_email'";  
    $run_query=mysqli_query($dbcon,$check_email_query);


    if(mysqli_num_rows($run_query)>0)  {  
        echo "<script>alert('Email $user_email is already exist in our database, Please try another one!')</script>";  
        exit();  
            } 

    $insert_user = "insert into doctors (user_name,email,specilization) VALUE ('$user_name','$user_email','$spec')";  
    
    echo"<script>alert('$run_query')</script>"; 

    if(mysqli_query($dbcon,$insert_user))  
            {  
                echo"<script>alert('sucess')</script>"; 

            }  else{

               

            }        


} 

?>
