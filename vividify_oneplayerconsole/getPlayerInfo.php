<?php
session_start();
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "web_tech";

$conn = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db($dbname) or die(mysql_error());

$user_id=$_POST['user'];
$_SESSION["user_id"];
$_SESSION["user_id"]=$user_id;
$_SESSION["session_id"];
$user_conformation=$_POST['user_conformation'];
if(($user_id=='')||($user_conformation==''))
{
	echo("Failure! Enter all fields.");//this page ie getPlayerInfo.php should be given same background and there should be a button to redirect to form login page here
}
else
{
	if(strrev($user_conformation)==$user_id)
	{
		$sql3= "SELECT session_id FROM user_points WHERE user_id='$user_id'  ORDER BY session_id DESC LIMIT 1";
		$retval3 = mysql_query( $sql3, $conn ) or die(mysql_error());
		$last_session_id=0;
		while($row3 = mysql_fetch_array($retval3))
		{
			$last_session_id=$row3['session_id'];
		}
		if(	$last_session_id==0)
		{
			$user_points=0;
			$sql = 'INSERT INTO user_points'.'(user_id,points,session_id)'.'VALUES ("'.$user_id.'","'.$user_points.'","'.$last_session_id.'" )';
			$retval = mysql_query( $sql, $conn );
			if(!$retval )
			{
				die('Could not enter data: ' . mysql_error());
			}
		}
		$curr_session_id=$last_session_id + 1;
		$_SESSION["session_id"]=$curr_session_id;
		$sql4 = "SELECT DISTINCT images_id FROM user_tag_table WHERE user_id = '$user_id'";
		$retval4 = mysql_query( $sql4, $conn ) or die(mysql_error());
		$seen_images=array();
		$i=0;
		while($row4 = mysql_fetch_array($retval4))
		{
			$seen_images[$i]=$row4['images_id'];
			$i++;
		}
		$sql5 = "SELECT images_id FROM images_tbl ";
		$retval5= mysql_query( $sql5, $conn ) or die(mysql_error());
		$all_images=array();
		$j=0;
		$unseen_images=array();
		$z=0;
		while($row5 = mysql_fetch_array($retval5))
		{
			$all_images[$j]=$row5['images_id'];
			if(in_array($all_images[$j],$seen_images)==false)
			{
				$unseen_images[$z]=$all_images[$j];
				$z++;
			}
			$j++;
		}
		$_SESSION['unseen_images']=$unseen_images;
		$_SESSION['seen_images']=$seen_images;
		$sql6 = "SELECT SUM(points) AS totalpoints FROM user_points WHERE user_id='$user_id';";
		$t_points=0;
		$retval6 = mysql_query( $sql6, $conn ) or die(mysql_error());
			while($row6 = mysql_fetch_array($retval6))
			{
				$t_points=$row6['totalpoints'];
			}
		$_SESSION["total_points"];
		$_SESSION["total_points"]=$t_points;
		$sql7 = "SELECT user_id,SUM(points) AS totalpoints FROM user_points WHERE user_id='$user_id' ORDER BY points DESC LIMIT 1";
		$cumm_points=0;
		$retval7 = mysql_query( $sql7, $conn ) or die(mysql_error());
			while($row7 = mysql_fetch_array($retval7))
			{
				$user=$row7['user_id'];
				$cumm_points=$row7['totalpoints'];
				$sql8="INSERT INTO leaderboard "."(user_id, total_points)"."VALUES('$user','$cumm_points') ON DUPLICATE KEY UPDATE total_points='$cumm_points'";
				$retval8 = mysql_query( $sql8, $conn );
				if(!$retval8 ) {
					die('Could not enter data: ' . mysql_error());
				}
			}
		header( 'Location: index.php' );
		if(count($unseen_images)==0)
		{
			echo("GAME OVER!!OUT OF IMAGES TO TAG")."<br>";
			header( 'Location: ../vividify_welcomepage/index.html' );
		}
	}
	else
	{
		echo("Failure!enter correct field values");
	}
}
?>
