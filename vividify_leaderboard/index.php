<html>
	<head>
	</head>
	<body>
		<audio src="media/back.mp3" autoplay ></audio>
		<img id='medal' src='img/g.png'/>
	</body>
	<script>
		String.prototype.capitalize = function() 
		{
			return this.charAt(0).toUpperCase() + this.slice(1);
		}
		function upcs()
		{
			document.getElement("h2").innerHTML.capitalize();
		}
	</script>
	<?php
	session_start();
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "web_tech";
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	mysql_select_db($dbname) or die(mysql_error());
	echo("
		<html>
			<head>
			</head>
			<body >");
	echo("
			<link rel='stylesheet' href='css/style.css'>");
	echo("
			<link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Josefin Slab'>");
	echo("
				<ol id=''scrap'><div><div>");
	$sql4 = "SELECT user_id,total_points FROM leaderboard ORDER BY total_points DESC";
	$retval4 = mysql_query( $sql4, $conn ) or die(mysql_error());
	while($row4 = mysql_fetch_array($retval4))
		{
			echo("<li id='s' ><h2>".$row4['user_id']."<h3>".$row4['total_points'])."</h3></h2></li><br>";
		}
	echo("</ol>");
	echo("
		</body>
	</html>");
mysql_close($conn);
?>
</html>