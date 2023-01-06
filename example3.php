<!DOCTYPE html>
<html>
	<head>
		<title>Insert to DB</title>
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
			   if ((document.getElementById("ln").value == "") || (document.getElementById("fn").value == "") || (document.getElementById("email").value == "")) {
				   alert("Please complete all fields!");
				   return false;
			   }
			   return true;
			}					
		</script>	
	</head>	
	
	<body>
		
		<form name='frm' action='example3.php' method='POST' onsubmit='return checkIfOk()'>
			Last name: <input style='width:100%' name=lname id='ln' type="text"/>
			First name: <input style='width:100%' name=fname id='fn' type="text"/>
			email: <input style='width:100%' name=email id='email' type="email"/>
			<input style='width:30%' name='sub' type=submit value='Insert into DB'/>
		</form>

		<?php 				 
             if (isset($_POST['lname'])){			
				include("conf.php");    
				$conn = new mysqli(HOST,USERNAME,DB_PWD,DATABASE);
				mysqli_set_charset($conn,"utf8");
				$lastname = $_POST['lname'];	
				$firstname = $_POST['fname'];				 	                                            
				$email = $_POST['email'];				 	                                            
				$sqlcommand = "INSERT INTO teachers (lastname, firstname, email) values ('$lastname','$firstname','$email')";				 
				echo $sqlcommand;
				$conn->query($sqlcommand);
				echo "<br>Έγινε εισαγωγή του ".$lastname;
				echo "<br>Έγινε εισαγωγή του ".htmlentities($lastname);	//htmlescape - Δεν γίνεται έλεγχος σχετικά με την παραβίαση του κλειδιού (2ος φοιτητής με το ίδιο email)
				$conn->close(); 	             	                                                        
			 }
        ?> 		
</body>
</html>
			
			
	
		
	
		


