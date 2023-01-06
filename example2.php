<!DOCTYPE html>
<html>
	<head>
		<title>List of Staff</title>
		<style>
			th {
				color: white;	
				background-color: #009900
			}
			table{
				border-collapse: collapse;	
				font-family: Arial     
			}

			table, td, th {   
			   border: 1px solid black;    
			}
			tr:nth-child(even){background-color: #ccffcc}
			
		</style>	
		<script>
			function checkIfOk(){  				
			   if (document.getElementById("ln").value == ""){
				   alert("Please complete the field!");
				   return false;
			   }
			   return true; 
			}					
		</script>	
	</head>	
	
	<body>
		
		<form name='frm' action='example2.php' method='GET' onsubmit='return checkIfOk()'>
			Lastname filter: <input style='width:100%' name=lname id='ln' type=text/>
			<input style='width:30%' name='sub' type=submit value='Apply filters'/>
		</form>

		<?php 				 
             include("conf.php");    
	         $conn = new mysqli(HOST,USERNAME,DB_PWD,DATABASE);	         
	         $conn->set_charset("utf8");
             $sqlcommand = "SELECT firstname,lastname,email from teachers";
             if (isset($_GET['lname'])){			
				 //$sqlcommand = $sqlcommand." where lastname like '".$_GET['lname']."%'";
				 $criterion = mysqli_real_escape_string($conn, $_GET['lname']); //for sqlescape				 
				 $sqlcommand = $sqlcommand." where lastname like '".$criterion."%'"; 
			 }
			 $sqlcommand=$sqlcommand." order by lastname";
			 			 		 
			 echo "$sqlcommand";
                 
             $result = $conn->query($sqlcommand);                 
             
             echo "<table>";
             echo "<tr><th>Ονομα</th><th>Επώνυμο</th></th><th>email</th></tr>";
			 while ($row = $result->fetch_assoc()){				 
				echo "<tr>";
				echo "<td>".$row['firstname']."</td>";
				echo "<td>".$row['lastname']."</td>";
				echo "<td><a href='mailto:".$row['email']."'>".$row['email']."</a></td>";
				echo "</tr>";				
			   
			 }
			 echo "</table>";
			 echo "<br><br>Σύνολο:".$result->num_rows;	
			 $conn->close(); 	             	                                                        
        ?> 		
</body>
</html>
			
			
	
		
	
		


