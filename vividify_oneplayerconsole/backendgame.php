<?php
	session_start();
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "web_tech";

	mysql_connect($dbhost, $dbuser, $dbpass);
	mysql_select_db($dbname) or die(mysql_error());

	$cur_unseen_images=$_SESSION['unseen_images'];
	$cur_seen_images=$_SESSION['seen_images'];
	$_SESSION["random_img_id"]=array_shift($cur_unseen_images);
	$randomid=$_SESSION["random_img_id"];
	$_SESSION['unseen_images']=$cur_unseen_images;
	array_push($_SESSION['seen_images'],$randomid);
	$query = "SELECT * FROM images_tbl WHERE images_id='$randomid'";
	$qry_result = mysql_query($query) or die(mysql_error());
	while($row = mysql_fetch_array($qry_result))
	{
		$path=$row['images_path'];
		echo "<img src='$path' alt='image' />";
	}
?>