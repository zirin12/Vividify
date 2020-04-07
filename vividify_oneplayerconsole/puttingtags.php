<html>
	<body>
	<?php
	   session_start();
	   $dbhost = 'localhost';
	   $dbuser = 'root';
	   $dbpass = '';
	   $dbname = 'web_tech';
	   $conn = mysql_connect($dbhost, $dbuser, $dbpass);
	   $tag= $_GET['tag'];
	   $user_id=$_SESSION["user_id"];
	   $img_id=$_SESSION["random_img_id"];
	   $session_id=$_SESSION["session_id"];
	   mysql_select_db($dbname) or die(mysql_error());
	   if(!$conn )
	   {
		   die('Could not connect: ' . mysql_error());
		}
		$sql = 'INSERT INTO user_tag_table'.'(images_id,user_id,tag,session_id) '.'VALUES ("'.$img_id.'","'.$user_id.'","'.$tag.'","'.$session_id.'")';
		$retval = mysql_query( $sql, $conn );
		if(!$retval )
		{
			die('Could not enter data: ' . mysql_error());
		}
		$sql2='INSERT IGNORE INTO admin_tag_table'.'(images_id,tag)'.'VALUES ("'.$img_id.'","'.$tag.'" )';
		$retval2 = mysql_query( $sql2, $conn );
		if(!$retval2 )
		{
			die('Could not enter data: ' . mysql_error());
		}
		mysql_close($conn);
	?>
	</body>
</html>