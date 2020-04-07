<?php
session_start();
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "web_tech";
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db($dbname) or die(mysql_error());
$user_id=$_POST['user'];

$sql3= "SELECT session_id FROM user_points WHERE user_id='$user_id'  ORDER BY session_id DESC LIMIT 1";
$retval3 = mysql_query( $sql3, $conn ) or die(mysql_error());
$last_session_id = 0;
while($row3 = mysql_fetch_array($retval3))
{
	$last_session_id=$row3['session_id'];
}
$cur_session_id=$last_session_id + 1;

$sql4 = "SELECT DISTINCT images_id FROM user_tag_table WHERE user_id = '$user_id'";
$retval4 = mysql_query( $sql4, $conn ) or die(mysql_error());
$seen_images=array();
while($row4 = mysql_fetch_array($retval4))
{
	array_push($seen_images,$row4['images_id']);
}

$sql5 = "SELECT images_id FROM images_tbl ";
$retval5= mysql_query( $sql5, $conn ) or die(mysql_error());
$all_images=array();
while($row5 = mysql_fetch_array($retval5))
{
	array_push($all_images,$row5['images_id']);
}

$unseen_images=array_diff($all_images,$seen_images);
print_r($all_images);
print_r($seen_images);
print_r($unseen_images);
?>