<html>
	<body>
	<?php
	   session_start();
	   $dbhost = 'localhost';
	   $dbuser = 'root';
	   $dbpass = '';
	   $dbname = 'web_tech';
	   global $iter;
	   $conn = mysql_connect($dbhost, $dbuser, $dbpass);
	   $tag= $_GET["tag"];
	   $user_id=$_GET["user"];
	   mysql_select_db($dbname) or die(mysql_error());
	   if(!$conn )
	   {
		   die('Could not connect: ' . mysql_error());
		}
		$query= "SELECT images_id FROM admin_tag_table WHERE tag='$tag' ";
		$result = mysql_query($query) or die(mysql_error());
		$idArray=array();
		$num_rows = mysql_num_rows($result);
		if($num_rows==0)
		{
			echo "<label>no results to show!</label>";
		}
		else
		{
			while($row = mysql_fetch_array($result))
			{
				array_push($idArray,$row['images_id']);
			}
			foreach ($idArray as $imgid)
			{
				$iter++;
				echo"<div id='vessel'>";
				$sql2= "SELECT images_path FROM images_tbl WHERE images_id='$imgid'";
				$result2 = mysql_query($sql2) or die(mysql_error());
				while($row2 = mysql_fetch_array($result2))
				{
					$path=$row2['images_path'];
					echo "<img src='$path' alt='image' />";
				}
				$sql3= "SELECT COUNT(user_id) AS frequency FROM user_tag_table WHERE images_id='$imgid' AND tag='$tag'";
				$result3 = mysql_query($sql3) or die(mysql_error());
				while($row3 = mysql_fetch_array($result3))
				{
					$frequency=$row3['frequency'];
					echo "<p>User tag frequency : <strong>$frequency</strong></p>";
				}
				echo"</div>";
			}
			echo"<label><span>$iter</span> results found</label>";
		}
		mysql_close($conn);
	?>
	</body>
</html>