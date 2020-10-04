<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="refresh" content="11">
  <title>My Posture</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="stylecss.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.8.0/p5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.8.0/addons/p5.dom.min.js"></script>
  <script src="https://unpkg.com/ml5@0.3.1/dist/ml5.min.js"></script>  
  
</head>

<body>
<?php
session_start();

$conn = mysqli_connect("localhost","root","","demo");
if ($_SESSION["username"]==true)
	
{
	$rowcount=0;
$correctPosture=0;
$defectedPosture=0;
	$uname=$_SESSION["username"];
	
//to print all rows in databasse	
$sql = "SELECT * FROM $uname";
$result = $conn->query($sql);

//calculate number of rows

$rowcount=mysqli_num_rows($result);

//count number of time posture is good
$sqll = "SELECT * FROM $uname WHERE torso = 'Correct Posture' and head = 'Head Straight'";
$resultt = $conn->query($sqll);
$correctPosture=mysqli_num_rows($resultt);

//count defected posture
$defectedPosture = $rowcount - $correctPosture;
}else
{
	header("location: login.html?");
}



//showing percentage for correct and defected posture
if($correctPosture>0 && $defectedPosture>0 ){
$correctPercent=($correctPosture / $rowcount)*100; //correct posture percentage
$correctPercent=number_format($correctPercent,2);//correct posture round off digits

$defectedPercent=($defectedPosture / $rowcount)*100; //defected posture percentage
$defectedPercent=number_format($defectedPercent,2); //defected posture round off digits
}
?>
<!--header menu started--->
<div class="container-fluid header py-3 menuholder">
	<div class="">
		<div class="float-right py-2">
			<a class="headicon fa fa-facebook-square  fa-2x px-3" href="" aria-hidden="true"></a>
			<a class="headicon fa fa-instagram  fa-2x px-3" aria-hidden="true" href=""></a>
			<a class="btn btn-outline-danger" href="logout.php" style="margin-top:-15px;">Logout</a>
		</div>
		
		<img src="logo.png" width="15%">
	
		<h5 class="welcome_user">Welcome <?php echo ucfirst($uname); ?></h5>
		
	</div>
</div>


<!--header menu ended--->

<div class="col-2 px-0" id="dash_menu_container">
<button class="btn btn-outline-warning" id="dash_menu_btn" onclick="dash_menu_show()" style="float:right;margin-right:-55px;"><span id="dash_icon" class="fa fa-bars"></button>
	<div class="dash_menu">
		<a href="#" class="dash_mitem">Profile</a><br>
		<a href="userRecord.php" class="dash_mitem active">Get DB Records</a><br>
		<a href="#" class="dash_mitem">Daily Records</a><br>
		<a href="#" class="dash_mitem">Weekly Records</a><br>
		<a href="#" class="dash_mitem">Monthly Records</a>
		
	</div>
</div>
<!--Table created-->
<div class="container pb-5" style="margin-top:100px">
	<h4 class="pb-3 text-center">Your Database Record</h4>
	<div class="row m-0">
		<DIV class="col-6 col-md-6 col-lg-6">
			<div style="" class="userTable userdataTable">
				<table style="width:100%;" class="userTable ">
				  <tr class="tableHeadingRow">
					<th style="border-top-left-radius:10px;">Torso</th>
					<th>Head</th>
					<th style="border-top-right-radius:10px;">Time</th>
				  </tr>
					<?php
					if ($result->num_rows>0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
						  if($row['torso'] == 'Correct Posture' && $row['head'] == 'Head Straight'){
							echo "<tr class='tableDataRow'> <td class='correctRecord'>" . $row["torso"]. " </td>"; 
							echo"<td class='correctRecord'>". $row["head"]. "</td> " ;
							echo"<td class='correctRecord'>". $row["time"]. "</td>  </tr>";
							}
						  else{
							echo "<tr class='tableDataRow'> <td >" . $row["torso"]. " </td>";
							echo"<td>". $row["head"]. "</td> " ;
							echo"<td>". $row["time"]. "</td>  </tr>";
						  }
					  }
					  
					}
					else
					  {
						  echo "<tr class='tableDataRow'>
								<td>Null</td>
								<td>Null</td>
								<td>Null</td>
						  </tr>";
					  }

					?>
				</table>
			</div>
		</div>
		<DIV class="col-6 col-md-6 col-lg-6">
			<table style="width:100%;" class="userTable">
			  <tr class="tableHeadingRow">
				<th style="border-top-left-radius:10px;">Total Record</th>
				<th>Acurate posture</th>
				<th style="border-top-right-radius:10px;">Defected posture</th>
			  </tr>
				<tr class="text-center tableDataRow">
				<?php
				echo"<td style='border-bottom-left-radius:10px;'>". $rowcount."</td>";
					if($correctPosture > $defectedPosture)
					{
				echo"<td class='correctRecord'>".$correctPosture."</td>";	
					}
					else if($correctPosture == $defectedPosture)
					{
				echo"<td style='background:rgba(225,225,0,0.3);'>".$correctPosture."</td>";
					}
					else
					{
				echo"<td style='background:rgba(225,0,0,0.3);'>".$correctPosture."</td>";
					}
				echo"<td style='border-bottom-right-radius:10px'>".$defectedPosture."</td>";
					
				?>
				</tr>
		</table>
			<?php if($rowcount > 0){ ?>
			<h5 class="text-center pt-5 pb-2">Percentage of correct (CP) and defected posture (DP)<h5>
			<div class="progress">
				<div class="progress-bar bg-success " style="width:<?php echo $correctPercent; ?>%">
					<?php echo $correctPercent."% CP"; ?>
				</div>
				<div class="progress-bar bg-danger " style="width:<?php echo $defectedPercent; ?>%">
					<?php echo $defectedPercent."% DP"; ?>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
	
</div>

<!--Table ended-->

<!--footer 	started-->
<div class="container-fluid py-5 pt-5" style="background:#d2d2d2;">
	<h3 class="text-dark">Corect Posture &copy; &reg;</h3>
</div>
<script>
function dash_menu_show()
{
	document.getElementById('dash_menu_btn').onclick = dash_menu_hide;
	document.getElementById('dash_menu_container').style.transform="translateX(0px)";
	document.getElementById('dash_icon').className="fa fa-caret-square-o-left";
	
}

function dash_menu_hide()
{
	document.getElementById('dash_menu_btn').onclick = dash_menu_show;
	document.getElementById('dash_menu_container').style.transform="translateX(-225px)";
	document.getElementById('dash_icon').className="fa fa-bars";
}
</script>
   
</body>

</html>