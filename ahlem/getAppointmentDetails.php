<?php  
 if(isset($_POST["employee_id"]))  
 {  
      
      $output = '';  
      $connect = mysqli_connect("localhost", "root", "joseph", "ahlem");  
      $query = "SELECT * FROM appointment WHERE id = '".$_POST["employee_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = mysqli_fetch_array($result))  
      {  
         
         $output .= '  
                <tr>  
                     <td width="30%"><label>Name</label></td>  
                     <td width="70%">'.$row["doc_name"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Address</label></td>  
                     <td width="70%">'.$row["pat_name"].'</td>  
                </tr>  
            
                ';  
      }  
      $output .= "</table></div>";  
      echo $output;  
 }  
 ?>
