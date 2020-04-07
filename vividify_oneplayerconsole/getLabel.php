<?php
session_start();
   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   $dbname = 'web_tech';
   $sess_id=$_SESSION["session_id"];
   $user_id=$_SESSION["user_id"];
   $conn = mysql_connect($dbhost, $dbuser, $dbpass);
   mysql_select_db($dbname) or die(mysql_error());
    if(!$conn ) {
      die('Could not connect: ' . mysql_error());
   }
   $sql = "SELECT tag FROM user_tag_table WHERE session_id='$sess_id' AND user_id='$user_id' ";
   $retval = mysql_query( $sql, $conn ) or die(mysql_error());
   while($row = mysql_fetch_array($retval))
	{
	   $tag=$row['tag'];
	   echo "<li id='nysm'>$tag</li>";
	}
?>