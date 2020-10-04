<?php
$conn = mysqli_connect("localhost","root","","demo");
if(isset($_POST['clicklogin']))	
	{
		session_start();
		$username=$_POST['name'];
		$password=$_POST['pass'];
		
		
		
			$query=mysqli_query($conn,"SELECT * FROM reg_login WHERE name='$username' AND pass='$password'");
			
			$rows=mysqli_num_rows($query);
			if($rows>0){
				$_SESSION["username"]=$username;
				$_SESSION["password"]=$password;
				header("Location: myposture.php?");
				echo"";
				
			}else{
				header("Location: login.html?");
					
			}
		
		
	}	
		
		
	
?>