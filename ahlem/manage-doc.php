<?php
session_start();

if(!$_SESSION['email'])
{
 header("Location: login.php");//redirect to login page to secure the welcome page without login access.
}

//print_r($_SESSION);die;

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
                   
                    <li class="active">
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
                    <li>
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
            <div id="content">

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
                                <h1>Manage Doctors</h1>
                            </ul>
                        </div>
                    </div>
                </nav>
    <?php
        include("database/db_connection.php");
        $view_users_query="select * from doctors";//select query for viewing users.
        $run=mysqli_query($dbcon,$view_users_query);//here run the sql query.

        while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.
        {
            $user_id=$row[0];
            $user_username=$row[1];
            $user_email=$row[2];
            $user_name=$row[4]; 
    ?>

        	  <ul>
              <li><?php echo $user_name; ?>  <span class="view glyphicon glyphicon-eye-open" title="View" onclick="openModal('<?php echo $user_id; ?>')" ></span> <span class="edit glyphicon glyphicon-pencil" title="Edit" onclick="openEditModal('<?php echo $user_id; ?>')"></span><span class="close glyphicon glyphicon-trash" title="Delete" onclick="DeleteDoctor('<?php echo $user_id; ?>')"></span><i</span></li>
              </ul>
		
    <?php } ?>	
				
			<button class="popup-button" onclick="openAddModal()" style="width:200px;">
				Add Doctors</button>

				<div id="modal-wrapper-add" class="modal">
				  
				  <form class="modal-content animate" name="doc_add_form" id="doc_add_form" method="post" action="manage-doc.php">
						
					<div class="imgcontainer">
					  <span onclick="document.getElementById('modal-wrapper-add').style.display='none'" class="close-btn" title="Close PopUp">&times;</span>
					 <!-- <img src="1.png" alt="Avatar" class="avatar">-->
					  <h2 style="text-align:center">Add Doctor's Information</h2>
					</div>

					<div class="container">
                      <input class="texttype1" type="text" placeholder="Doctor's Name" name="doc_name_add" id="doc_name_add"><br>
                      <input class="texttype1" type="text" placeholder="Specialization" name="specialization_add" id="specialization_add"><br>
                      <textarea class="texttype1" placeholder="Address" name="address_add" id="address_add"></textarea><br>
                      <!-- <input class="texttype1" type="text" placeholder="Country" name="country" id="country"><br> -->
                      <select class="texttype1" name="country_add" id="country_add"></select><br>
                      <input class="texttype2" type="text" placeholder="Email" name="email_add" id="email_add">
                      <input class="texttype2" type="number" placeholder="phone no." name="phone_add" id="phone_add"><br>
                      <input class="texttype2" type="text" placeholder="Username" name="username_add" id="username_add">
                      <input class="texttype2" type="text" placeholder="New Password" name="password_add" id="password_add"><br>
                      <!-- <input class="texttype2" type="text" placeholder="Visit Time From" name="time_from_add" id="time_from_add"> -->
                      <select class="texttype2" name="time_from_add" id="time_from_add" > 
                        <option value="">Visit Time From</option>
                        <?php $start=strtotime('00:00'); $end=strtotime('23:45'); for ($halfhour=$start;$halfhour<=$end;$halfhour=$halfhour+15*60) { printf('<option value="%s">%s</option>',date('H:i',$halfhour),date('g:i A',$halfhour)); } ?> 
                      </select>
                      <select class="texttype2" name="time_to_add" id="time_to_add" > 
                        <option value="">Visit Time To</option>
                        <?php $start=strtotime('00:00'); $end=strtotime('23:45'); for ($halfhour=$start;$halfhour<=$end;$halfhour=$halfhour+15*60) { printf('<option value="%s">%s</option>',date('H:i',$halfhour),date('g:i A',$halfhour)); } ?> 
                      </select><br>
                      <!-- <input class="texttype2" type="text" placeholder="Visit Time To" name="time_to_add" id="time_to_add"><br> -->
                      <input class="texttype2" type="text" placeholder="Normal Fees" name="normal_fee_add" id="normal_fee_add">
                      <input class="texttype2" type="text" placeholder="Offer Fees" name="offer_fee_add" id="offer_fee_add"><br>
                      
                      
                      <select class="texttype1" name="days_add[]" id="days_add" multiple="true">
                          <option value="" style="font-weight:bold" disabled="true">Visit Days</option>
                          <option value="Sunday">Sunday</option>
                          <option value="Monday">Monday</option>
                          <option value="Tuesday">Tuesday</option>
                          <option value="Wednesday">Wednesday</option>
                          <option value="Thursday">Thursday</option>
                          <option value="Friday">Friday</option>
                          <option value="Saturday">Saturday</option>
                      </select><br>

                      
                      <button class="popup-button2" type="button" onclick="addDoctors()">Add</button>
                    </div>
					
                        </form>
				  
				   </div>
				
                 </div>
            
                 


                <div id="modal-wrapper-view" class="modal">
				  
				<form class="modal-content animate" action="manage-doc.php">
						
					<div class="imgcontainer">
					  <span onclick="document.getElementById('modal-wrapper-view').style.display='none'" class="close-btn" title="Close PopUp">&times;</span>
					 <!-- <img src="1.png" alt="Avatar" class="avatar">-->
					  <h1 style="text-align:center">Doctor's Information</h1>
					</div>

					<div class="container">
					  <input class="texttype1" type="text" placeholder="Doctor's Name" name="doc_name" id="doc_name" readonly="true"><br>
					  <input class="texttype1" type="text" placeholder="Specialization" name="specialization" id="specialization" readonly="true"><br>
					  <textarea class="texttype1" placeholder="Address" name="address" id="address" readonly="true"></textarea><br>
					  <input class="texttype1" type="text" placeholder="Email" name="email" id="email" readonly="true"><br>
                      <input class="texttype2" type="number" placeholder="phone no." name="phone" id="phone" readonly="true">  
					  <input class="texttype2" type="text" placeholder="Visit Time" name="visit_time" id="visit_time" readonly="true"><br>
					  <input class="texttype2" type="text" placeholder="Normal Fees" name="normal_fee" id="normal_fee" readonly="true">
                      <input class="texttype2" type="text" placeholder="Offer Fees" name="offer_fee" id="offer_fee" readonly="true">  
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

                   <!-- Edit Modal -->

                   <div id="modal-wrapper-edit" class="modal">
                  
                <form class="modal-content animate" name="doc_edit_form" id="doc_edit_form" action="get_data_doc.php">
                        
                    <div class="imgcontainer">
                      <span onclick="document.getElementById('modal-wrapper-edit').style.display='none'" class="close-btn" title="Close PopUp">&times;</span>
                     <!-- <img src="1.png" alt="Avatar" class="avatar">-->
                      <h2 style="text-align:center">Edit Doctor's Information</h2>
                    </div>

                    <div class="container">
                      <input class="texttype1" type="text" placeholder="Doctor's Name" name="doc_name_edit" id="doc_name_edit"><br>
                      <input class="texttype1" type="text" placeholder="Specialization" name="specialization_edit" id="specialization_edit"><br>
                      <textarea class="texttype1" placeholder="Address" name="address_edit" id="address_edit"></textarea><br>
                      <input class="texttype2" type="text" placeholder="Email" name="email_edit" id="email_edit">
                      <input class="texttype2" type="number" placeholder="phone no." name="phone_edit" id="phone_edit"><br>
                      <select class="texttype2" name="time_from_edit" id="time_from_edit" > 
                        <option value="">Visit Time From</option>
                        <?php $start=strtotime('00:00'); $end=strtotime('23:45'); for ($halfhour=$start;$halfhour<=$end;$halfhour=$halfhour+15*60) { printf('<option value="%s">%s</option>',date('H:i',$halfhour),date('g:i A',$halfhour)); } ?> 
                      </select>
                      <select class="texttype2" name="time_to_edit" id="time_to_edit" > 
                        <option value="">Visit Time From</option>
                        <?php $start=strtotime('00:00'); $end=strtotime('23:45'); for ($halfhour=$start;$halfhour<=$end;$halfhour=$halfhour+15*60) { printf('<option value="%s">%s</option>',date('H:i',$halfhour),date('g:i A',$halfhour)); } ?> 
                      </select><br>
                      <!-- <input class="texttype2" type="text" placeholder="Visit Time From" name="time_from_edit" id="time_from_edit">
                      <input class="texttype2" type="text" placeholder="Visit Time To" name="time_to_edit" id="time_to_edit"><br> -->
                      <input class="texttype2" type="text" placeholder="Normal Fees" name="normal_fee_edit" id="normal_fee_edit">
                      <input class="texttype2" type="text" placeholder="Offer Fees" name="offer_fee_edit" id="offer_fee_edit"><br>

                      <input type="hidden" name="uid" id="uid">
                      <button class="popup-button2" type="button" onclick="submitForm()">Save Changes</button>
                    </div>
                    
                </form>
                  
                   </div>

                   <!-- Edit Modal End -->
				
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

             function openModal(id)
             {
                //alert(id);
                if(id != '')
                {
                    $.ajax({
                        type:'POST',
                        url: 'get_data_doc.php?doctors_id='+id,
                        //data:{get_acno: get_acno},
                        success:function(response) {

                            if(response)
                            {
                              var data_jsons = JSON.parse(response);
                              //console.log(data_jsons);
                              $('#doc_name').val(data_jsons.name);
                              $('#specialization').val(data_jsons.specilization);
                              $('#address').val(data_jsons.location);
                              $('#email').val(data_jsons.email);
                              $('#phone').val(data_jsons.phone);
                              $('#visit_time').val(data_jsons.time_from+' - '+data_jsons.time_to);
                              $('#normal_fee').val(data_jsons.normal_fee);
                              $('#offer_fee').val(data_jsons.offer_fee);
                            }
                            $('#modal-wrapper-view').fadeIn();
                          
                        }
                    });
                }
             }



             function openEditModal(edit_id)
             {
                //alert(edit_id);
                if(edit_id != '')
                {
                    $.ajax({
                        type:'POST',
                        url: 'get_data_doc.php?doctors_id='+edit_id,
                        //data:{get_acno: get_acno},
                        success:function(response) {

                            if(response)
                            {
                              var data_jsons = JSON.parse(response);
                              console.log(data_jsons);
                              $('#doc_name_edit').val(data_jsons.name);
                              $('#specialization_edit').val(data_jsons.specilization);
                              $('#address_edit').val(data_jsons.location);
                              $('#email_edit').val(data_jsons.email);
                              $('#phone_edit').val(data_jsons.phone);
                              // $('#time_from_edit').val(data_jsons.time_from);
                              // $('#time_to_edit').val(data_jsons.time_to);
                              $('#normal_fee_edit').val(data_jsons.normal_fee);
                              $('#offer_fee_edit').val(data_jsons.offer_fee);
                              $('#uid').val(data_jsons.id);
                            }
                            $('#modal-wrapper-edit').fadeIn();
                          
                        }
                    });
                }
                
             }


             function submitForm()
             {
                //alert('gg');
                if($('#doc_name_edit').val() == '')
                {
                    alert("Please enter Doctor's Name");
                    return false;
                }
                if($('#specialization_edit').val() == '')
                {
                    alert("Please enter Specialization");
                    return false;
                }
                if($('#address_edit').val() == '')
                {
                    alert("Please enter Address");
                    return false;
                }
                if($('#email_edit').val() == '')
                {
                    alert("Please enter Email");
                    return false;
                }
                if($('#phone_edit').val() == '')
                {
                    alert("Please enter Phone");
                    return false;
                }
                if($('#time_from_edit').val() == '')
                {
                    alert("Please enter From Time");
                    return false;
                }
                if($('#time_to_edit').val() == '')
                {
                    alert("Please enter To Time");
                    return false;
                }
                if($('#normal_fee_edit').val() == '')
                {
                    alert("Please enter Normal Fees");
                    return false;
                }
                


                $.ajax({
                   type: "POST",
                   url: 'get_data_doc.php',
                   data: $("#doc_edit_form").serialize(), // serializes the form's elements.
                   success: function(data)
                   {
                       // alert(data);
                       // return false;
                       if(data != '')
                       {
                            alert(data);
                            setTimeout(function(){location.reload();},1000);
                       }
                       else
                       {
                        return false;
                       }
                       
                   }
                });
             }


            function DeleteDoctor(id)
            {
                //alert(id);
                if(confirm("Are you confirm to delete ?"))
                {
                    $.ajax({
                        type:'POST',
                        url: 'get_data_doc.php?delete_row_id='+id,
                        //data:{get_acno: get_acno},
                        success:function(data){

                            if(data)
                            {
                                alert(data);
                                setTimeout(function(){location.reload();},1000);
                            }
                            else
                            {
                                return false;
                            }  
                        }
                    });
                }
                else
                {
                    return false;
                }
            }


            function openAddModal()
            {
                $.ajax({
                    type:'POST',
                    url: 'get_data_doc.php?countryList=1',
                    //data:{get_acno: get_acno},
                    success:function(data){

                      // alert(data);
                      // return false; 
                      $('#country_add').html(data);
                    }
                });   
                $('#modal-wrapper-add').fadeIn(700);
            }


            function addDoctors()
             {
                //alert('gg');
                if($('#doc_name_add').val() == '')
                {
                    alert("Please enter Doctor's Name");
                    return false;
                }
                if($('#specialization_add').val() == '')
                {
                    alert("Please enter Specialization");
                    return false;
                }
                if($('#address_add').val() == '')
                {
                    alert("Please enter Address");
                    return false;
                }
                if($('#country_add').val() == '')
                {
                    alert("Please select Country");
                    return false;
                }
                if($('#email_add').val() == '')
                {
                    alert("Please enter Email");
                    return false;
                }
                if($('#phone_add').val() == '')
                {
                    alert("Please enter Phone");
                    return false;
                }
                if($('#time_from_add').val() == '')
                {
                    alert("Please enter From Time");
                    return false;
                }
                if($('#time_to_add').val() == '')
                {
                    alert("Please enter To Time");
                    return false;
                }
                if($('#normal_fee_add').val() == '')
                {
                    alert("Please enter Normal Fees");
                    return false;
                }
                if($('#password_add').val() == '')
                {
                    alert("Please enter New Password");
                    return false;
                }
                if($('#username_add').val() == '')
                {
                    alert("Please enter Username");
                    return false;
                }
                if($('#days_add').val() == '')
                {
                    alert("Please select Visit Days");
                    return false;
                }
                
                $.ajax({
                   type: "POST",
                   url: 'get_data_doc.php',
                   data: $("#doc_add_form").serialize(), // serializes the form's elements.
                   success: function(data)
                   {
                       // alert(data);
                       // return false;
                       if(data != '')
                       {
                            alert(data);
                            setTimeout(function(){location.reload();},1000);
                       }
                       else
                       {
                        return false;
                       }
                       
                   }
                });
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
