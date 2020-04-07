<?php
session_start();
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "web_tech";
$sess_id=$_SESSION["session_id"];
$user_id=$_SESSION["user_id"];
$user_points=0;
$conn = mysql_connect($dbhost, $dbuser, $dbpass);

mysql_select_db($dbname) or die(mysql_error());
if(!$conn ) 
{
     die('Could not connect: ' . mysql_error());
}
$sql = "SELECT tag FROM user_tag_table WHERE session_id='$sess_id' AND user_id='$user_id'";
$retval = mysql_query( $sql, $conn ) or die(mysql_error());
while($row = mysql_fetch_array($retval))
{
	$tag=$row['tag'];
	$sql2 = "SELECT tag FROM admin_tag_table WHERE tag='$tag'";
	$retval2 = mysql_query( $sql, $conn ) or die(mysql_error());
	$num_rows = mysql_num_rows($retval2);
	if($num_rows>0)
	{
		$user_points+=10;
	}
	else
	{
		$user_points+=5;
	}
}
$_SESSION["user_points"]=$user_points;
echo($sess_id);
echo($user_points);
$sql3 = 'INSERT IGNORE INTO user_points'.'(user_id,points,session_id)'.'VALUES ("'.$user_id.'","'.$user_points.'","'.$sess_id.'" )';
$retval3 = mysql_query( $sql3, $conn );
if(!$retval3 )
{
	die('Could not enter data: ' . mysql_error());
}
?>