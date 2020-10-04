<html>

<head>
  <meta charset="UTF-8">
  <title>My Posture</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet" />
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
$uname=$_SESSION["username"];
}
else
{
	header("Location: login.html?");
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
	
		<div class=" time  text-center mr-5 align-items-center" id="timecontainer">
			<div class="innertimecontainer">
				<p class="pt-3 text-success">On Screen Time: </p><p id="ontime" class="ml-1 pt-3 text-success ">00:00:00</p>
			</div>
			<div class="innertimecontainer">
				<p class="pt-2 text-warning">Off Screen Time: </p><p id="offtime" class="ml-1 pt-2 text-warning ">00:00:00</p>
			</div>
		</div>
		<h5 class="welcome_user">Welcome <?php echo ucfirst($uname); ?></h5>
		<div class="bg-dark text-center text-light datarecorded" id="datarecorded">
			<p class="p-2" style="margin-bottom:0px;">Data Recorded</p>
		</div>
	</div>
</div>


<!--header menu ended--->

<div class="col-2 px-0" id="dash_menu_container">
<button class="btn btn-outline-warning" id="dash_menu_btn" onclick="dash_menu_show()" style="float:right;margin-right:-55px;"><span id="dash_icon" class="fa fa-bars"></button>
	<div class="dash_menu">
		<a href="#" class="dash_mitem" >Profile</a><br>
		<a href="userRecord.php" class="dash_mitem" target="_blank">Get DB Records</a><br>
		<a href="#" class="dash_mitem">Daily Records</a><br>
		<a href="#" class="dash_mitem">Weekly Records</a><br>
		<a href="#" class="dash_mitem">Monthly Records</a>
		
	</div>
</div>
<div class="container " style="margin-top:100px;">
<div class="alert alert-warning text-center" id="stopnoti">No Person detected, previous data saved successfully.</div>
	<div class="row m-0" id="upper_section">
		<div class="col-12 col-md-3 col-lg-3 py-3">
			<div class=" canvascontainer ">
				<canvas id="canvas" class="animated fadeInUp" ></canvas>
			</div>
			
		</div> 
		<div class="col-12 col-md-6 col-lg-6  py-3 ">
			
			<div class="row m-0">
				<div class="toggle_btn " id="toggle_btn">
					<h6 class="pl-2 mt-2" id="not_status" style="color:rgba(0,0,0,0.5); line-height:10px;">Toggle ON/OFF Notification </h6>
					<label class="switch">
						<input type="checkbox" onclick="onn()" id="tbtn">
						<span class="slider round" ></span>
					</label>
			
				</div>	
				<div class="col-12 col-md-6 col-lg-6 text-center mt-3">
					<div class="border px-2" style="border-radius:5px;">
						<h6 class="py-2 text-dark">Torso position</h6>
						<div id="quotion" class=" py-5" style="width:100% !important"></div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-6 text-center mt-3">
					<div class="border px-2" style="border-radius:5px;">
						<h6 class="py-2 text-dark">Head position</h6>
						<div id="showvalue1" class=" py-5" style="width:100% !important"></div>
					</div>
				</div>
			<button onclick="reconfig()" id="reconfig_btn" class=" btn btn-outline-warning mt-2 text-center w-100"><img src="refresh.gif" width="4%"> </img>Reconfig posture</button>
			</div>
			
			
		</div>
		<div class="col-12 col-md-3 col-lg-3  py-3">
			<div class="qutionsection ">
			<div class="content_img alert alert-danger mx-auto quotionSectionFB py-3" id="forwardBend">
				<h5 class="text-center animated bounceIn infinite">Leaning Forward</h5>
				<img class="animated fadeIn float-right"  src="forward.png" width="">
				<p>In forward head posture (FHP), the head protrudes forward from the sagittal plane and 
				appears to be positioned in front of the body, and this condition is considered the most 
				common postural deformity.</p>
			</div>
			
			<div class="content_img alert alert-danger mx-auto quotionSectionFB py-3 " id="backwardBend">
				<h5 class="text-center animated bounceIn infinite">Leaning Backward</h5>
				<img class="animated fadeIn float-right"  src="backward.png" width="">
				<p>In leaning back posture, You will get pressure on your lower neck and lower back.
				which will be acute in initial stages but will converted to chronic in later phase.
				30% of people are suffering from this deformity.</p>
			</div>
			
			<div class="content_img alert alert-success mx-auto quotionSectionstraight py-3" id="straight">
				<h5 class="text-center ">Sitting Straight</h5>
				<img class="animated fadeIn float-right"  src="straight.png" width="">
				<p>Very well mate! You are doing good by sitting straight and
				working on your system this will increase your concerntration 
				while working and give you long and healthy life ahead.</p>
			</div>
			<div class="nofaceimg alert alert-warning mx-auto quotionSectionstraight py-3" id="noface">
			</div>
			</div>
		</div> 
	</div>
</div>
<!--instruction popup started-->
<div id="instructionpopup" class="instruction animated fadeInDown text-center">
				<div class="head " style="background:#f3f3f3; position:sticky; top:-1px; width:100%; z-index:1;">
				
					<h5 class="text-center py-3 " ><a class="btn btn-outline-success float-left ml-2" href="#goto" >X</a>Sitting Istructions</h5>
						 
				</div>
				<div class="block py-3 alert alert-success" style="">
					<img src="straight.png" class="float-right">
					
					<p><span class="fa fa-thumbs-up"></span> Hey mate! whenever you work on your system you should keep ur spine straight with respect
					to your head. This position will take care to reduce your acute neck pain and protect your 
					spine from future injuries.</p>
				</div>
				<hr>
				<div class="block py-3 alert alert-warning">
					<img src="forward.png" class="float-right">
					<p><span class="fa fa-thumbs-down"></span> We are very concern with your posture it's our duety to inform that you should not sit 
					slouching forward while working on your system. This will lead to a slouching habbit which in future
					converted to cronic backpains and neck cramps.</p>
				</div>
				<hr>
				<div class="block py-3 alert alert-warning">
					<img src="backward.png " class="float-right">
					<p><span class="fa fa-thumbs-down"></span> Wlile working on your system you should not lean back on your chair because this will create a
					intence pressure on your lower back and if you continue to do so with your posture it might happen
					your lower back pain force you to take bedrest form couple of months</p>
				</div>
				<div class="block py-3 mb-2">
					<button onclick="closeinstruction()" id="goto" class="btn btn-success float-left">Get Started</button>
				</div>
			</div>
<!--instruction popup ended-->

<!--video popup started-->
<div id="videopopup" >
	<div id="" class="videoreceiver animated fadeInUp">
		<h5 class="text-center alert alert-warning animated flash infinite mt-5" id="videostatus"><span  class="fa fa-pause" style="color:red;"> Collecting Data<span></h5>
		<h5 class="text-center alert alert-success mt-5" id="videostatus_done"><span  class="" style="color:green;"><img src="tick.gif" width="2%"> Setting Up Data<span></h5>
		<h5 class="text-center alert alert-warning mt-5" id="videostatus_reconfig"><span  class="" style="color:green;"><img src="refresh.gif" width="2%"> Reconfig Data<span></h5>

	</div>
</div>
<!--video popup ended-->
<div class="container-fluid" id="below_section">
	<div class="row m-0">
		<div class="col-12 col-md-3 col-lg-3  text-center">
		<h5 class="py-2"> Desk Excerises To Be followed</h5>
			<div id="demo" class="carousel slide d-flex  justify-content-center" data-ride="carousel">
				<!-- Indicators --->
			  <ul class="carousel-indicators">
				<li data-target="#demo" data-slide-to="0" class="active"></li>
				<li data-target="#demo" data-slide-to="1"></li>
				<li data-target="#demo" data-slide-to="2"></li>
			  </ul>

			  <!-- The slideshow -->
			  <div class="carousel-inner">
				<div class="carousel-item active">
					<img src="exc/exc1.gif" >
				</div>
				<div class="carousel-item">
					<img src="exc/exc2.gif">
				</div>
				<div class="carousel-item">
					<img src="exc/exc3.gif">
				</div>
			  </div>

			  <!-- Left and right controls -->
			  <a class="carousel-control-prev text-dark" href="#demo" data-slide="prev">
				<span class="fa fa-chevron-left "></span>
			  </a>
			  <a class="carousel-control-next text-dark" href="#demo" data-slide="next">
				<span class="fa fa-chevron-right"></span>
			  </a>

			</div>
			
		</div>
		<div class="col-12 col-md-6 col-lg-6  py-2 d-flex align-items-center justify-content-center">
		
			<img src="logo.png" >
		</div>
		<div class="col-12 col-md-3 col-lg-3 py-2 text-center">
		<h5 class="py-2">User Posture Real Time Chart</h5>
		<div class="chart_container" id="chart_container">
			<div id="curve_chart" style="width: 100%; height: 100%;"></div>
			</div>
		</div>
	</div>
</div>
<!--footer 	started-->
<div class="container-fluid py-5 mt-5" style="background:#d2d2d2;">
	<h3 class="text-dark">Corect Posture &copy; &reg;</h3>
</div>


<script>
function datarecorded(){
	setInterval(function(){ 
		datatorse = document.getElementById('quotion').textContent;
		datahead = document.getElementById('showvalue1').textContent;
		datatime = document.getElementById('ontime').textContent;
		document.getElementById('datarecorded').style.transform="translateX(30px)";
		var httpr = new XMLHttpRequest();
		httpr.open("POST","loadphp.php",true);
		httpr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		httpr.onreadystatechange=function(){
			if(httpr.readyState==4 && httpr.status==200){
				//alert(httpr.responseText);
			}
		}
		httpr.send("datatorse="+datatorse+"&datahead="+datahead+"&datatime="+datatime);

	}, 10000);
	
	setInterval(function(){
		document.getElementById('datarecorded').style.transform="translateX(-135px)";
	},10500);
}
</script>
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
<!--data inserted into table-->

<!--chart sript-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Time', 'straight', 'forward', 'backward'],
          ['15 min',  0,0, 0],
          ['30 min',  0, 0, 0],
          ['45 min',  -2,2, 0],
          ['1 hour',  0,0, 0],
          ['1.15 hour',0,0, 0]
        ]);

        var options = {
          title: 'User Posture',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
<script>
function camera_noti()
{
	const notification = new Notification("My Posture",{
		body:"Keep camera parallel to your face."
		
	});
}
function leaningR_noti()
{
	const notification = new Notification("My Posture",{
		body:"You were leaning right quite long. Correct your Posture",
		icon:"warningicon.png"
	});
}
function leaningL_noti()
{
	const notification = new Notification("My Posture",{
		body:"You were leaning left quite long. Correct your Posture",
		icon:"warningicon.png"
		
	});
}

	console.log(Notification.permission);
	
	if(Notification.permission === "granted"){
		//noti();
	} 
	else if (Notification.permission !== "denied")
	{
		Notification.requestPermission().then(permission => {
		if (permission === "granted"){
		//noti();
		console.log(permission);
		}
		});
	}
</script>

<script>
function closeinstruction()
{
	document.getElementById('instructionpopup').style.display="none";
	document.getElementById('upper_section').className="container text-light animated fadeInUp"
	document.getElementById('upper_section').style.display="inline-flex";
	document.getElementById('timecontainer').style.display="block";
	datarecorded();
	
}

//  let model, webcam, ctx, labelContainer, maxPredictions;
    var count=0;
    var mes=0;
    var sholdr=0;
    var sholdl=0;
    var video;
    var poseNet;
    var pose;
    var skeleton;
	
   async function setup() {
        createCanvas(640, 480);
        video = createCapture(VIDEO);
		
       video.hide();
        poseNet = ml5.poseNet(video, modelLoaded);
        poseNet.on('pose', gotPoses);
        camera_noti();
      }

    function gotPoses(poses) {
	   //console.log(poses); 
        if (poses.length > 0) {
          pose = poses[0].pose;
          skeleton = poses[0].skeleton;
		  if(ton===0)
            {
                on=setInterval(oncounter , 1000);
                ton=1;
            }
            toff=0;
            clearInterval(off); 
			
			document.getElementById('stopnoti').style.display="none";
        }else if(poses.length == poses.length)
		{
			if(toff===0) {
                off=setInterval(offcounter , 1000);
                toff=1;
			
            }
            ton=0;
            clearInterval(on); 
			document.getElementById('stopnoti').style.display="block";
			document.getElementById('stopnoti').className="animated bounceInDown text-center alert alert-warning"
		}
      }
	  
      function modelLoaded() {
        console.log('poseNet ready');
		document.getElementById('videostatus').innerHTML="";
		  document.getElementById('videostatus').innerHTML="Showlder should be seen";
		 
		  
      }
//    async function init() {
//        const modelURL = URL + "model.json";
//        const metadataURL = URL + "metadata.json";
//        model = await tmPose.load(modelURL, metadataURL);
//        maxPredictions = model.getTotalClasses();
//
//        const size = 250;
//        const flip = true; 
//        webcam = new tmPose.Webcam(size, size, flip); // width, height, flip
//        await webcam.setup(); // request access to the webcam
//		document.getElementById('videostatus').style.display="none";
//		document.getElementById('videostatus_done').style.display="block";
//		
//        await webcam.play();
//        window.requestAnimationFrame(loop);
//        // append/get elements to the DOM
//        const canvas = document.getElementById("canvas");
//        canvas.width = size; canvas.height = size;
//        ctx = canvas.getContext("2d");
//        labelContainer = document.getElementById("label-container");
//        for (let i = 0; i < maxPredictions; i++) { 
//            if (i == 0)
//            {
//                labelContainer.appendChild(document.getElementById("right"));
//            }
//            if (i == 1)
//            {
//                labelContainer.appendChild(document.getElementById("left"));
//            }
//            if (i == 2)
//            {
//                labelContainer.appendChild(document.getElementById("straight2"));
//            }
//        }	
//    }
    
     var on;
     var off;
     var ontime=0;
     var offtime=0;
    var timelr= 0;
    var timell=0;
    var tlr=0;
    var tll=0;
    var LR;
    var LL;
     var ton=0;
     var toff=0;
    function oncounter(){
		
        let seconds = ontime % 60;
        let minutes = Math.floor(ontime / 60);
        let hour    = Math.floor(minutes / 60);
            minutes = minutes % 60;
        if(Math.floor(seconds/10)===0&&Math.floor(minutes/10)===0&&Math.floor(hour/10)===0)
        {
            document.getElementById("ontime").innerHTML ="0"+hour + ":0" +minutes + ":0" + seconds;
        }
        else if(Math.floor(minutes/10)===0&&Math.floor(hour/10)===0&&Math.floor(seconds/10)!==0)
        {
            document.getElementById("ontime").innerHTML ="0"+hour + ":0" +minutes + ":" + seconds;
        }
        else if(Math.floor(hour/10)===0&&Math.floor(seconds/10)===0&&Math.floor(minutes/10)!==0)
        {
            document.getElementById("ontime").innerHTML ="0"+hour + ":" +minutes + ":0" + seconds;
        }
        else if(Math.floor(hour/10)===0&&Math.floor(seconds/10)!==0&&Math.floor(minutes/10)!==0)
        {
            document.getElementById("ontime").innerHTML ="0"+hour + ":" +minutes + ":" + seconds;
        }
        else
        {
            document.getElementById("ontime").innerHTML =""+hour + ":" +minutes + ":" + seconds;
        }
        ontime++;
		//document.getElementById('showvalue1').style.display="block";
		//document.getElementById('noface').style.display="none";
	
    }
    function offcounter(){
        let seconds = offtime % 60;
        let minutes = Math.floor(offtime / 60);
        let hour    = Math.floor(minutes / 60);
            minutes = minutes % 60;
        
        if(Math.floor(seconds/10)===0&&Math.floor(minutes/10)===0&&Math.floor(hour/10)===0)
        {
            document.getElementById("offtime").innerHTML ="0"+hour + ":0" +minutes + ":0" + seconds;
        }
        else if(Math.floor(minutes/10)===0&&Math.floor(hour/10)===0&&Math.floor(seconds/10)!==0)
        {
            document.getElementById("offtime").innerHTML ="0"+hour + ":0" +minutes + ":" + seconds;
        }
        else if(Math.floor(hour/10)===0&&Math.floor(seconds/10)===0&&Math.floor(minutes/10)!==0)
        {
            document.getElementById("offtime").innerHTML ="0"+hour + ":" +minutes + ":0" + seconds;
        }
        else if(Math.floor(hour/10)===0&&Math.floor(seconds/10)!==0&&Math.floor(minutes/10)!==0)
        {
            document.getElementById("offtime").innerHTML ="0"+hour + ":" +minutes + ":" + seconds;
        }
        else
        {
            document.getElementById("offtime").innerHTML =""+hour + ":" +minutes + ":" + seconds;
        }
        offtime++;
	}
	
	function onn(){
		document.getElementById('tbtn').onclick = notification_onn;
		document.getElementById('not_status').innerHTML = "";
		document.getElementById('not_status').style.color = "green";
		document.getElementById('not_status').innerHTML = "Notification are ON";
//		//setTimeout(function(){ alert("Notification Turned ON !"); }, 500);
	}

	function notification_onn(){
		document.getElementById('tbtn').onclick = onn;
		document.getElementById('not_status').innerHTML = "";
		document.getElementById('not_status').style.color = "#808080";
		document.getElementById('not_status').innerHTML = "Notification are OFF";
	
		//setTimeout(function(){alert("Notification Turned OFF !");},500);
	}
	
	function LRcheck(){
        let seconds = timelr;
		if (document.getElementById('tbtn').onclick == notification_onn){
        if(seconds === 5)
        {
            //document.getElementById("timecheck").innerHTML ="You were Leaning Right for 20 sec straight.Correct your posture ";
			//alert("You were Leaning Right for 20 sec . Correct your posture !");
			leaningR_noti();
        }
        timelr++;
		}
    }
    function LLcheck(){
	if (document.getElementById('tbtn').onclick == notification_onn){
        let seconds = timell;
        if(seconds === 5)
        {
            //document.getElementById("timecheck").innerHTML ="You were Leaning left for 20 sec straight.Correct your posture ";
			//alert("You were Leaning Left for 20 sec . Correct your posture !");
			leaningL_noti();
		}
        timell++;
		}
    }
	
//    async function loop(timestamp) {
//        webcam.update(); // update the webcam frame
//        await predict();
//	window.requestAnimationFrame(loop);
//    }
	var inst=0;
    function reconfig()
    {
		count=0;
        mes=0;
        sholdr=0;
        sholdl=0;
		inst= 1;
    }
        function draw() {
        // Prediction #1: run input through posenet
        // estimatePose can take in an image, video or canvas html element
		translate(video.width,0);
		scale(-1,1);
		image(video, 0, 0, video.width, video.height);
        
        var z;
        var h;
        var t;
        var p;
        // Prediction 2: run input through teachable machine classification model	
		
	if(pose){
	
            for (var i = 0; i < pose.keypoints.length; i++) {
            var x = pose.keypoints[i].position.x;
            var y = pose.keypoints[i].position.y;
            fill(0,255,0);
            ellipse(x,y,16,16);
              }
            /*if(ton===0)
            {
                on=setInterval(oncounter , 1000);
                ton=1;
            }
            toff=0;
            clearInterval(off); */  
//yaha pr tha kode
            var eyeR = pose.rightEye;
            var eyeL = pose.leftEye;
            var ls = pose.leftShoulder;
            var rs = pose.rightShoulder;
            var le = pose.leftEar;
            var re = pose.rightEar;
            var resd =dist(ls.x, ls.y, le.x, le.y); 
            var lesd =dist(rs.x, rs.y, re.x, re.y); 
            var d = dist(eyeR.x, eyeR.y, eyeL.x, eyeL.y);  
            
            //started: to check correct distance from screen with leanig forward or leanig backward or correct position
            if (count<101)
            {
                count=count+1;
				 h=count;
               
             
             //document.getElementById("dist").innerHTML=h;
			 if(h==60){
			 document.getElementById('videostatus').style.display="none";
				document.getElementById('videostatus_done').style.display="block";
             
			 }else if(h==70)
			 {
				document.getElementById("defaultCanvas0").style.display="none";
				document.getElementById("videopopup").style.display="none";
			 }
				
			 
            }
			if(count==90)
			{
				
				 if(inst == 0)
				{
					document.getElementById('instructionpopup').style.display="block";
				}
				//document.getElementById('timecontainer').style.display="block";
				
				document.getElementById('toggle_btn').className = "toggle_btn animated bounceInDown";
				document.getElementById('chart_container').className = "chart_container animated zoomIn";
				document.getElementById('demo').className = "carousel slide d-flex  justify-content-center animated zoomIn";
				document.getElementById('below_section').style.visibility="visible";
				document.getElementById('reconfig_btn').style.display="inline";
				
				
				//document.getElementById('videopopup').style.display="none";
			}
			if(h<100) {
				//document.getElementById('videopopup').style.display="block";
                mes = mes + Math.round(d);
                sholdr=sholdr+Math.round(resd);
                sholdl=sholdl+Math.round(lesd);
                document.getElementById("quotion").innerHTML = "Recalabrating Posture" ;
                document.getElementById("quotion").className="animated flash infinite fa fa-pause alert alert-warning";
                document.getElementById('noface').style.display="none";
				document.getElementById('showvalue1').style.display="none";
            }
            else {
                z=mes/100;
                t=sholdr/100;
                p=sholdl/100;
                if((d/z)>1.1) {
				
                    document.getElementById("quotion").innerHTML = "Leaning Forward" ;
                    document.getElementById("quotion").className="animated flash infinite fa fa-times alert alert-danger";
                    document.getElementById('noface').style.display="none";
                     document.getElementById("forwardBend").style.display="inline-block";
                     document.getElementById("backwardBend").style.display="none";
                    document.getElementById("straight").style.display="none";
					//document.getElementById('showvalue1').style.display="none";
                }
                /*else if((d/z)<0.9) {
                    document.getElementById("quotion").innerHTML = " Leaning Backwards" ;
                    document.getElementById('quotion').className = "animated flash infinite fa fa-times alert alert-danger";
                   document.getElementById('noface').style.display="none";
                     document.getElementById("backwardBend").style.display="inline-block";
                    document.getElementById("forwardBend").style.display="none";
                    document.getElementById("straight").style.display="none";
                    //document.getElementById('showvalue1').style.display="none";
                }*/
                else if((d/z)>0.9 || (d/z)<=1.1){ 
                    document.getElementById("quotion").innerHTML = "Correct Posture" ;
                   document.getElementById("quotion").className=" fa fa-check alert alert-success";
                   document.getElementById('noface').style.display="none";
                    document.getElementById("forwardBend").style.display="none";
                    document.getElementById("backwardBend").style.display="none";
                    document.getElementById("straight").style.display="inline-block";
					document.getElementById('showvalue1').style.display="block";
                                    }
					
					
				if ( (resd/t) < 1.0 && (lesd/p)> 1.1 ) {
                                    //if (document.getElementById('tbtn').onclick == notification_onn){
						timelr=0;
						if(tll===0) {
							LL=setInterval(LLcheck , 1000);
							tll=1;
						}
						tlr=0;
						clearInterval(LR);
						//}
						document.getElementById('showvalue1').innerHTML = "";
						document.getElementById('showvalue1').className = "animated flash infinite fa fa-exclamation-triangle alert alert-danger";
						if (document.getElementById('showvalue1').innerHTML !="Leaning Right")
						{
						document.getElementById('showvalue1').innerHTML +="Leaning Left" ;
						}
					
					}
					else if ( (resd/t) >1.1 && (lesd/p)< 1.0) {	
                                            //if (document.getElementById('tbtn').onclick == notification_onn){
						timell=0;
                                            if(tlr===0) {
                                                LR=setInterval(LRcheck , 1000);
                                                tlr=1;
                                            }
                                            tll=0;
                                            clearInterval(LL);
					//	}
						document.getElementById('showvalue1').innerHTML = "";
						document.getElementById('showvalue1').className = "animated flash infinite fa fa-exclamation-triangle alert alert-danger";
						if (document.getElementById('showvalue1').innerHTML !="Leaning Left")
						{
						document.getElementById('showvalue1').innerHTML +="Leaning Right" ;
						}
					}
					else if((resd/t)<1.1||(resd/t)>1.0||(lesd/p)<1.1||(lesd/p)>1.0) {
					//if (document.getElementById('tbtn').onclick == notification_onn){
						timelr=0;
						timell=0;
						tll=0;
                                                clearInterval(LL);
                                                tlr=0;
                                                clearInterval(LR);
						//}
                        //document.getElementById('timecheck').innerHTML = " ";
						document.getElementById('showvalue1').innerHTML = "";
						document.getElementById('showvalue1').className = "fa fa-check alert alert-success";
						if (document.getElementById('showvalue1').innerHTML !="Head Straight")
						{
						document.getElementById('showvalue1').innerHTML +="Head Straight" ;
						}	
					}
                                    }
                }
				
				
				
				
				
				
                /*else {
            if(toff===0) {
                off=setInterval(offcounter , 1000);
                toff=1;
            }
            ton=0;
            clearInterval(on); 
        } */
		
        // finally draw the poses
       
    }
	
</script>
</body>

</html>