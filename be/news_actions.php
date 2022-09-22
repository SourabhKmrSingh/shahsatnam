<?php
include_once("inc_config.php");
include_once("login_user_check.php");

$_SESSION['active_menu'] = "news";

$q = $validation->urlstring_validate($_GET['q']);
if($q == "del")
{
	echo $validation->delete_permission();
	
	$newsid = $validation->urlstring_validate($_GET['newsid']);
	
	$delresult = $media->filedeletion('rb_news', 'newsid', $newsid, 'imgName', IMG_MAIN_LOC, IMG_THUMB_LOC);
	$delresult2 = $media->filedeletion('rb_news', 'newsid', $newsid, 'fileName', FILE_LOC);

	$categoryQueryResult = $db->delete("rb_news", array('newsid'=>$newsid));
	if(!$categoryQueryResult)
	{
		$_SESSION['error_msg'] = "Error Occurred. Please try again!!!";
		header("Location: news_view.php");
		exit();
	}

	$_SESSION['success_msg'] = "{$categoryQueryResult} Record Deleted!";
	header("Location: news_view.php");
	exit();
}

if(isset($_POST['bulk_actions']) and $_POST['bulk_actions'] != "")
{
	$bulk_actions = $validation->urlstring_validate($_POST['bulk_actions']);
	$del_items = $_POST['del_items'];
	$newsids = array();
	if(empty($del_items))
	{
		$_SESSION['error_msg'] = "Please select atleast one row to perform action!";
		header("Location: news_view.php");
		exit();
	}
	if(isset($del_items) and $del_items != "")
	{
		foreach($del_items as $id)
		{
			if($bulk_actions == "delete")
			{
				array_push($newsids, "$id");
				
				$delresult = $media->filedeletion('rb_news', 'newsid', $id, 'imgName', IMG_MAIN_LOC, IMG_THUMB_LOC);
				$delresult2 = $media->filedeletion('rb_news', 'newsid', $id, 'fileName', FILE_LOC);
			}
			else if($bulk_actions == "active" || $bulk_actions == "inactive")
			{
				array_push($newsids, "$id");
			}
		}
		
		$newsids = implode(',', $newsids);
		
		if($bulk_actions == "delete")
		{
			$categoryQueryResult = $db->custom("DELETE from rb_news where FIND_IN_SET(`newsid`, '$newsids')");
			if(!$categoryQueryResult)
			{
				$_SESSION['error_msg'] = "Error Occurred. Please try again!!!";
				header("Location: news_view.php");
				exit();
			}
			$affected_rows = $connect->affected_rows;
			
			$_SESSION['success_msg'] = "{$affected_rows} Record(s) Deleted!";
			header("Location: news_view.php");
			exit();
		}
		else if($bulk_actions == "active" || $bulk_actions == "inactive")
		{
			$categoryQueryResult = $db->custom("UPDATE rb_news SET status='$bulk_actions' where FIND_IN_SET(`newsid`, '$newsids')");
			if(!$categoryQueryResult)
			{
				echo mysqli_error($connect);
				exit();
			}
			$affected_rows = $connect->affected_rows;
			
			$_SESSION['success_msg'] = "{$affected_rows} Record(s) Updated!";
			header("Location: news_view.php");
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
	
	header("Location: news_view.php?$fields_string");
	exit();
}
?>