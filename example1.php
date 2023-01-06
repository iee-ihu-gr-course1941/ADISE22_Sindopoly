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
	</head>	
	
	<body>
		
		
		<?php 				 
			//!!!Object oriented style and Procedural style!!!
		
             include("conf.php");    
	         $conn = new mysqli("127.0.0.1","it175008","#Mementomori199","sindopoly",3333);
	         
	         mysqli_set_charset($conn,"utf8");		// Procedural style	 	                                            
	         //$conn->set_charset("utf8");			// Object oriented 
	         
	         //if ($mysqli->connect_errno) {
			 //	 printf("Connect failed: %s\n", $mysqli->connect_error);
			 //	 exit();
			 //}	         
	         
	         if (mysqli_connect_errno()) {
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			 }	         
	         
             $sqlcommand = "SELECT firstname,lastname,email from teachers order by lastname";
                 
             $result = $conn->query($sqlcommand);          // Object oriented        
             //$result mysqli_query(conn,$sqlcommand);		// Procedural style	 	 
                          
             echo "<table>";
             echo "<tr><th>Ονομα</th><th>Επώνυμο</th></th><th>email</th></tr>";
			 while ($row = $result->fetch_assoc()){				 
			 //while ($row = mysqli_fetch_assoc($result)){				 
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
			
			
	
		
	
		


