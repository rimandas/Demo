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
                   
                    <li>
                        <a href="manage-doc.php">Manage Doctors</a>
                        <!--
						<a href="#homeSubmenu" data-toggle="collapse"
                         aria-expanded="false"> this is for colapse icone for submanue
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
                        <a href="messages.html">Messages</a>
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
                $run=mysqli_query($dbcon, $view_users_query);//here run the sql query.
                $view_users_query_id = "select * from appointment WHERE id=2";
                //$run_id = mysqli_query($dbcon,$view_users_query_id);
               // $row_id=mysqli_query($run_id)

               
               
                while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.
                {
                    $user_id=$row[0];
                    $doc_name=$row[3];
                    $pat_name=$row[4];
                ?>
        
                      <ul>
                        <li id="btnView"> <?php echo $doc_name; ?> <div class="patnt"> 
                            <?php echo $pat_name; ?></div><span class="view glyphicon glyphicon-eye-open" title="View" onclick="openViewModal('<?php echo $user_id; ?>')" ></span>
                        </li>
                      </ul>
 <!-- onclick="document.getElementById('modal-wrapper-view').style.display='block'" -->

                <?php }           
                ?>	

              
                                            
                <div id="modal-wrapper-view" class="modal">
				  
				<form class="modal-content animate" action="manage-ap.php">
					
					<div class="imgcontainer">
                      <span onclick="document.getElementById('modal-wrapper-view').style.display='none'"
                       class="close-btn" title="Close PopUp">&times;</span>
					  <!-- <img src="1.png" alt="Avatar" class="avatar"> -->
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

         <!-- <script>
            $('.glyphicon-eye-open').on('click',function(){
                
                var idd = $(this).attr("id");   
                alert(idd);
            $('.container').load('getContent.php?id=2',function(){
            $('#modal-wrapper-view').modal({show:true});
                         });
                        });          
            </script>     -->
 
   <script>
      $(document).ready(function(){  
      $('.glyphicon-eye-open').click(function(){  
           var employee_id = $(this).attr("id");  
           // alert(employee_id);
           $.ajax({  
                url:"getAppointmentDetails.php",  
                method:"post",  
                data:{employee_id:employee_id},  
                success:function(data){  
                     $('#container').html(data);  
                     $('#modal-wrapper-view').modal("show");  
                }  
                    });  
                        });  
                       

         }); 
    </script>

    <script>
      function openViewModal()
      {
        $('#modal-wrapper-view').fadeIn();
      }
    </script>


    </body>
</html>


                
