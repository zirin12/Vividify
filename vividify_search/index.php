<?php	
	session_start();
?>
<!DOCTYPE html>
<html >
	<head>
		<meta charset="UTF-8">
		<title>Vividify_Search</title>
		<link rel="stylesheet" href="css/style.css">
		<style>
		/*section*/.top-movies {
			font-size: 0;
			background: #bfd5e0;
			background: radial-gradient( 400px at 50%, #d9dbd8 0%, #bfd5e0 100% );
			padding: 45px 0;
			box-shadow: inset 0 -5px 8px 0 rgba( 0, 0, 0, 0.05 );
			
			// Borrowed from https://css-tricks.com/i-left-my-system-fonts-in-san-francisco/:
			font-family: system, -apple-system,
			 ".SFNSDisplay-Regular", HelveticaNeue, LucidaGrande;
		}

		/*h1*/.top-movies__title {
			font-size: 22px;
			color: #444e50;
			margin: 0 0 14px;
			text-shadow: 0 2px 1px rgba( 255, 255, 255, 0.1 );
		}

		.section-content {
			width: 94%;
			margin: 0 auto;
			
			@include breakpoint( 1022px ) {
				width: 100%;
				max-width: 960px;
			}
		}

		/*article*/.card {
			box-shadow: 0 3px 3px 0 rgba( 0, 0, 0, 0.3 );
			position: relative;
			width: 150px;
			margin: 0 auto;
			transition: box-shadow 0.15s ease-out, transform 0.25s ease;
			perspective: 500px;
			perspective-origin: 50% 50%;
			transform-style: preserve-3d;
			
			&:hover {
				transform: scale( 1.1 );
				box-shadow: none;
			}
			
			&.hover--ending {
				transition: box-shadow 0.5s ease;
			}
			
			@include breakpoint( 540px ) {		
				display: inline-block;
			}
			
			+ .card {
				margin: 45px auto 0;
				
				@include breakpoint( 540px ) {
					margin: 0 0 0 25px;
				}
			}
		}

		/*span*/.highlight {
			display: block;
			position: absolute;
			width: 100px;
			height: 100px;
			top: 0;
			right: 0;
			opacity: 0;
			z-index: 3;
			transition: opacity 0.25s ease;
			background: radial-gradient( 60px at 50%, rgba( 255, 255, 255, 0.13 ) 0%, rgba( 255, 255, 255, 0 ) 100% );
		}

		/*a*/.card__link {
			display: block;
			position: relative;
			width: 150px;
			height: 228px;
			overflow: hidden;				
			transform-origin: center center;
			transform-style: preserve-3d;
		}

		/*img*/.card__image {
			position: absolute;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			object-fit: cover;
		}

		/*h2*/.card__title {
			font-size: 14px;
			width: 100%;
			height: 24px;
			line-height: 24px;
			text-align: center;
			color: #FFFFFF;
			position: absolute;
			left: 0;
			text-overflow: ellipsis;
			white-space: nowrap;
			overflow: hidden;
			opacity: 0;
			transition: opacity 0.15s ease-in;
			text-shadow: 0 2px 2px rgba( 0, 0, 0, 0.06 );
			
			
			/*article*/.card:hover & {
				opacity: 0.8;
			}
		}
	</style>
	<script>
	function ajaxFunc(e)
	{
		var tag=document.getElementById('doSearch').value;
        var user='parashara';
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
		ajaxReq.open("GET", "backsearch.php"+queryString, true);
		ajaxReq.onreadystatechange = function()
		{
			if(ajaxReq.readyState == 4)
			{
				var ajaxDisplay=document.getElementById('showSearch');
				ajaxDisplay.innerHTML=ajaxReq.responseText;
			}
		}
		ajaxReq.send(null); 
	}
	function startDictation()
	{
		if (window.hasOwnProperty('webkitSpeechRecognition'))
		{
			var recognition = new webkitSpeechRecognition();
			recognition.continuous = false;
			recognition.interimResults = false;
			recognition.lang = "en-US";
			recognition.start();
			recognition.onresult = function(e)
			{
				document.getElementById('transcript').value = e.results[0][0].transcript;
				document.getElementById('doSearch').value = e.results[0][0].transcript;
				recognition.stop();
			};
			recognition.onerror = function(e)
			{
				recognition.stop();
			}
		}
	}
	function play1()
	{
		var n = document.getElementById("com");
		n.play();
	} 
	</script>
</head>
<body>
	<audio src="media/based.mp3" autoplay ></audio>
	<audio src="media/complete.mp3" id="com" ></audio>
	<header>
		<div class="doSearch">
			<input id="doSearch" name="doSearch" type="text" placeholder="Search here..." required onclick="this.value='';startDictation()" src="//i.imgur.com/cHidSVu.gif" >
			<input id="simple" type="button" value="search" onmousedown="play1();" onclick="return ajaxFunc();"/>
		</div>
		<hr>
	</header>
	<div id="showSearch"></div>
	<a href="../vividify_welcome2/welcome2.html"><input id="redirect" type="button" value="HOME" ></a>
	<form id="labnol" method="get" action="https://www.google.com/search">
		<div class="speech">
			<input type="text" name="q" id="transcript" placeholder="Speak" hidden="hidden"/>
		</div>
	</form>
</body>
</html>