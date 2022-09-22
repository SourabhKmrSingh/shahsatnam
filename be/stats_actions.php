<?php
include_once("inc_config.php");
include_once("login_user_check.php");

$_SESSION['active_menu'] = "stats";

$q = $validation->urlstring_validate($_GET['q']);
if($q == "del")
{
	echo $validation->delete_permission();
	
	$statsid = $validation->urlstring_validate($_GET['statsid']);
	
	$delresult = $media->filedeletion('rb_stats', 'statsid', $statsid, 'imgName', IMG_MAIN_LOC, IMG_THUMB_LOC);
	$delresult2 = $media->filedeletion('rb_stats', 'statsid', $statsid, 'fileName', FILE_LOC);

	$statsQueryResult = $db->delete("rb_stats", array('statsid'=>$statsid));
	if(!$statsQueryResult)
	{
		$_SESSION['error_msg'] = "Error Occurred. Please try again!!!";
		header("Location: stats_view.php");
		exit();
	}

	$_SESSION['success_msg'] = "{$statsQueryResult} Record Deleted!";
	header("Location: stats_view.php");
	exit();
}

if(isset($_POST['bulk_actions']) and $_POST['bulk_actions'] != "")
{
	$bulk_actions = $validation->urlstring_validate($_POST['bulk_actions']);
	$del_items = $_POST['del_items'];
	$statsids = array();
	if(empty($del_items))
	{
		$_SESSION['error_msg'] = "Please select atleast one row to perform action!";
		header("Location: stats_view.php");
		exit();
	}
	if(isset($del_items) and $del_items != "")
	{
		foreach($del_items as $id)
		{
			if($bulk_actions == "delete")
			{
				array_push($statsids, "$id");
				
				$delresult = $media->filedeletion('rb_stats', 'statsid', $id, 'imgName', IMG_MAIN_LOC, IMG_THUMB_LOC);
				$delresult2 = $media->filedeletion('rb_stats', 'statsid', $id, 'fileName', FILE_LOC);
			}
			else if($bulk_actions == "active" || $bulk_actions == "inactive")
			{
				array_push($statsids, "$id");
			}
		}
		
		$statsids = implode(',', $statsids);
		
		if($bulk_actions == "delete")
		{
			$statsQueryResult = $db->custom("DELETE from rb_stats where FIND_IN_SET(`statsid`, '$statsids')");
			if(!$statsQueryResult)
			{
				$_SESSION['error_msg'] = "Error Occurred. Please try again!!!";
				header("Location: stats_view.php");
				exit();
			}
			$affected_rows = $connect->affected_rows;
			
			$_SESSION['success_msg'] = "{$affected_rows} Record(s) Deleted!";
			header("Location: stats_view.php");
			exit();
		}
		else if($bulk_actions == "active" || $bulk_actions == "inactive")
		{
			$statsQueryResult = $db->custom("UPDATE rb_stats SET status='$bulk_actions' where FIND_IN_SET(`statsid`, '$statsids')");
			if(!$statsQueryResult)
			{
				echo mysqli_error($connect);
				exit();
			}
			$affected_rows = $connect->affected_rows;
			
			$_SESSION['success_msg'] = "{$affected_rows} Record(s) Updated!";
			header("Location: stats_view.php");
			exit();
		}
	}
}
else
{
	$fields = $_POST;
	
	foreach($fields as $key=>$value)
	{
		$fields_string .= $key.'='.$value.'&';
	}
	rtrim($fields_string, '&');
	$fields_string = str_replace("bulk_actions=&", "", $fields_string);
	$fields_string = substr($fields_string, 0, -1);
	
	header("Location: stats_view.php?$fields_string");
	exit();
}
?>