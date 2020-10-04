<?php
	
	session_start();

if ($_SESSION["username"]==true)
{
	$uname=$_SESSION["username"];
	
	$datatorse=$_POST['datatorse'];
	$datahead=$_POST['datahead'];
	$datatime=$_POST['datatime'];
	
	
	$con = mysqli_connect("localhost","root","","demo");
	
	$sql="INSERT INTO $uname (`torso`, `head`, `time`) VALUES ('$datatorse','$datahead','$datatime');";
	mysqli_query($con, $sql);
	
}	


?>