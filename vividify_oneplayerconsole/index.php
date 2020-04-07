<?php	
	session_start();
?>
<!--game console-->
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Vividify_OnePlayerConsole</title>
	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript">
	addJS_Node (null, null, overrideSelectNativeJS_Functions);
	
	function overrideSelectNativeJS_Functions ()
	{
		window.alert = function alert (message) 
		{
			console.log (message);
		}
	}
	function addJS_Node (text, s_URL, funcToRun)
	{
		var D                                   = document;
		var scriptNode                          = D.createElement ('script');
		scriptNode.type                         = "text/javascript";
		if (text)       scriptNode.textContent  = text;
		if (s_URL)      scriptNode.src          = s_URL;
		if (funcToRun)  scriptNode.textContent  = '(' + funcToRun.toString() + ')()';
		var targ = D.getElementsByTagName ('head')[0] || D.body || D.documentElement;
		targ.appendChild (scriptNode);
	}
	String.prototype.capitalize = function() 
	{
		return this.charAt(0).toUpperCase() + this.slice(1);
	}
	function showuser()
	{
		var jesus="<?php echo $_SESSION["user_id"];?>".capitalize();
		document.getElementById('user_name').innerHTML=jesus;
	}
	function labels()
	{
		var ajaxRequest;
		try
		{
			ajaxRequest = new XMLHttpRequest();
		}
		catch (e)
		{
			try
			{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch (e)
			{
				try
				{
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e)
				{
					alert("Your browser broke!");
					return false;
				}
			}
		}
		ajaxRequest.onreadystatechange = function()
		{
			if(ajaxRequest.readyState == 4)
			{
				var ajaxDisplay = document.getElementById('displaylabel');
				ajaxDisplay.innerHTML = ajaxRequest.responseText;
			}
		}
		ajaxRequest.open("GET", "getLabel.php", true);
		ajaxRequest.send(null);
	}
	var totaltime = 0;
	function exitPage()
	{
		setTimeout(function()
		{
			$.post('getScore.php', function(){}).error(function(){alert('error... ohh no!');});
			window.alert("TIME UP..!!");window.location.assign("../vividify_welcome2/welcome2.html");}, timeExit*1000);
	}
	var timeExit=90;
	function giveup()
	{
		setTimeout(function()
		{
			$.post('getScore.php', function(){}).error(function(){alert('error... ohh no!');});
			window.alert("GAME OVER..!!");window.location.assign("../vividify_chose/index.html");}, 1000);
	}
	function set()
	{
		var count=90;
		myCounter = setInterval(function done() {
		count -= 1;
		String(count);document.getElementById('time').innerHTML=count;
		if (count == totaltime||count==0)
		{
			clearInterval(myCounter);
		}}, 1000);
	}
	function nextImage()
	{
		var ajaxRequest;
		try
		{
			ajaxRequest = new XMLHttpRequest();
		}
		catch (e)
		{
			try
			{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch (e)
			{
				try
				{
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e)
				{
					alert("Your browser broke!");
					return false;
				}
			}
		}
		ajaxRequest.onreadystatechange = function()
		{
			if(ajaxRequest.readyState == 4)
			{
				var ajaxDisplay = document.getElementById('middle_main');
				ajaxDisplay.innerHTML = ajaxRequest.responseText;
				doucument.getElementById('tag').innerHTML='';
			}
		}
		ajaxRequest.open("GET", "backendgame.php", true);
		ajaxRequest.send(null); 
	}
	function ajaxFunc(e)
	{
		e = e || window.event;
		var tag=document.getElementById('tag').value;
        var user='parashara';
		if (e.keyCode == 13)
		{
			var ajaxReq; 
			try 
			{
				ajaxReq = new XMLHttpRequest();
			}
			catch (e)
			{
				try
				{
					ajaxReq = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch (e)
				{
					try
					{
						ajaxReq = new ActiveXObject("Microsoft.XMLHTTP");
					}
					catch (e)
					{
						alert("Your browser broke!");
						return false;
					}
				}
			}
			var queryString = "?tag="+tag+"&user="+user;
			ajaxReq.open("GET", "puttingtags.php"+queryString, true);
			ajaxReq.onreadystatechange = function()
			{
				if(ajaxReq.readyState == 4)
				{
					response  = ajaxReq.responseText;
					alert(response);
				}
			}
			ajaxReq.send(null); 
			return false;
		}
		return true;
	}
	function showpoints()
	{
		document.getElementById('points').innerHTML=<?php echo $_SESSION["total_points"];?>;
	}
	var pass_count=0;
	function pass()
	{
		pass_count+=1;
		document.getElementById("pass").innerHTML=pass_count;
	}
	var spark_count=1;
	function spark()
	{
		if(pass_count!=0)
		{
			var temp_tp=<?php echo $_SESSION["total_points"]?>+pass_count;
			spark_count=Math.ceil(temp_tp/pass_count);
			document.getElementById("spark").innerHTML=spark_count;
		}
	}
	function play1()
	{
		var audio = document.getElementById("timer");
		audio.play();
	}
	function play2()
	{
		var a = document.getElementById("coin");
		a.play();
	}
	function play3()
	{
		var b = document.getElementById("started");
		b.play();
	}
	function play4()
	{
		var n = document.getElementById("n");
		n.play();
	}
	function play5()
	{
		var g = document.getElementById("g");
		g.play();
	}
	function off()
	{
		if(document.getElementById('off').value=="🔊")
		{
			document.getElementById('off').value="🔇";
			var audio = document.getElementById("timer");
			audio.pause();
		}
		else
		{
			var audio = document.getElementById("timer"); 
			document.getElementById('off').value="🔊";
			audio.play();
		}
	}
	</script>
	</head>
	<body>
		<audio src="media/give.mp3" id="g"></audio>
		<audio src="media/next.mp3" id="n"></audio>
		<audio src="media/started.mp3" id="started"></audio>
		<audio src="media/back.mp3" autoplay ></audio>
		<audio id="timer" src="media/timer.wav" loop></audio>
		<audio id="coin" src="media/c.wav"></audio>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Josefin Slab">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Audimat">
		<canvas id="c"></canvas>
			<div class="card game">
				<div class="photo" id="avatar">
					<div class="pie degree">
						<span id="time">90</span>
					</div>
				</div>
				<div><h2 id="user_name">Start the game to validate your name.</h2></div>
				<div class="left_main">
					<div class="score">
						<h1>POINTS<div id="span"><span id="points">0</span></div></h1>
						<h1>SPARK<div id="span" ><span id="spark">0</span></div></h1>
						<h1>PASS<div id="span" ><span id="pass">0</span></div><h1>
					</div>
				</div>
				<div class="middle_main" id="middle_main">
					<input id="imageload" type="button"  onclick="play3();play1();showuser();nextImage();set();showpoints();exitPage();" value="start">
				</div>
				<div class="right_main">
					<div id="vividify"><div id="icon_jessi"></div> VIVIDIFY</div>
					<div class="triggerLabel">
						<a class="button" href="#popup1" onclick="labels();">
							<input id="big" type="button" value="get my label"/>
						</a>
						<div id="popup1" class="overlay">
							<div class="popup">
								<h3>My Labels</h3>
								<ul id="displaylabel">
								
								</ul>
								<a class="close" href="#">&times;</a>
								<div class="content2" id="content2"></div>
							</div>
						</div>
					</div>
					<input id="give" type="button" value="giveup" name="giveup" onmouseover="play5();" onclick="giveup();" />
					<input id="next" type="button" value="next" name="next" onmouseover="play4();" onclick="nextImage();spark();pass();" />
					<input id="off" type="button" value="🔊" name="giveup" onmouseover="" onclick="off();" />	
					<div class="triggerLabel"></div>
				</div>
				<div id="inputs">
					<input type="text" class="submit_on_enter" required id="tag" name="tagtext" autocomplete="off" placeholder="Enter tags here...." onclick="startDictation()" onkeyup="if (event.keyCode==13){this.value='';play2();}" onkeydown=" return ajaxFunc(event);" />
					</br>Hover the picture to ZOOM in.
					<form id="labnol" method="get" action="https://www.google.com/search">
						<div class="speech">
							<input type="text" name="q" id="transcript" placeholder="Speak" hidden="hidden"/>
						</div>
					</form>
				</div>
			</div>
		<script src="js/index.js"></script>
	</body>
</html>