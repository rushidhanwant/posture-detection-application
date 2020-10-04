<?php
$conn = mysqli_connect("localhost","root","","demo");
if(isset($_POST['clickregistration']))	
	{
		session_start();
		$name=$_POST['name'];
		$email=$_POST['email'];
		$pass=$_POST['pass'];
		mysqli_query($conn,"INSERT INTO `reg_login`(`name`, `email`, `pass`) VALUES ('$name','$email','$pass')");
		$_SESSION["username"]=$name;
		$_SESSION["password"]=$pass;
		
		$sql = "CREATE TABLE $name (
			torso VARCHAR(20) NOT NULL,
			head VARCHAR(20) NOT NULL,
			time VARCHAR(30)
			
			)";
			mysqli_query($conn, $sql);
		header("Location: myposture.php");
				
	}
		
		
		
		
	
?>