<?php
include_once("inc_config.php");
include_once("login_user_check.php");

$_SESSION['active_menu'] = "course_highlight";

$q = $validation->urlstring_validate($_GET['q']);
if($q == "del")
{
	echo $validation->delete_permission();
	
	$coursehighlightid = $validation->urlstring_validate($_GET['coursehighlightid']);
	
	$delresult = $media->filedeletion('rb_course_highlight', 'coursehighlightid', $coursehighlightid, 'imgName', IMG_MAIN_LOC, IMG_THUMB_LOC);
	$delresult2 = $media->filedeletion('rb_course_highlight', 'coursehighlightid', $coursehighlightid, 'fileName', FILE_LOC);

	$pageQueryResult = $db->delete("rb_course_highlight", array('coursehighlightid'=>$coursehighlightid));
	if(!$pageQueryResult)
	{
		$_SESSION['error_msg'] = "Error Occurred. Please try again!!!";
		header("Location: course_highlight_view.php");
		exit();
	}

	$_SESSION['success_msg'] = "{$pageQueryResult} Record Deleted!";
	header("Location: course_highlight_view.php");
	exit();
}

if(isset($_POST['bulk_actions']) and $_POST['bulk_actions'] != "")
{
	$bulk_actions = $validation->urlstring_validate($_POST['bulk_actions']);
	$del_items = $_POST['del_items'];
	$coursehighlightids = array();
	if(empty($del_items))
	{
		$_SESSION['error_msg'] = "Please select atleast one row to perform action!";
		header("Location: course_highlight_view.php");
		exit();
	}
	if(isset($del_items) and $del_items != "")
	{
		foreach($del_items as $id)
		{
			if($bulk_actions == "delete")
			{
				array_push($coursehighlightids, "$id");
				
				$delresult = $media->filedeletion('rb_course_highlight', 'coursehighlightid', $id, 'imgName', IMG_MAIN_LOC, IMG_THUMB_LOC);
				$delresult2 = $media->filedeletion('rb_course_highlight', 'coursehighlightid', $id, 'fileName', FILE_LOC);
			}
			else if($bulk_actions == "active" || $bulk_actions == "inactive")
			{
				array_push($coursehighlightids, "$id");
			}
		}
		
		$coursehighlightids = implode(',', $coursehighlightids);
		
		if($bulk_actions == "delete")
		{
			$pageQueryResult = $db->custom("DELETE from rb_course_highlight where FIND_IN_SET(`coursehighlightid`, '$coursehighlightids')");
			if(!$pageQueryResult)
			{
				$_SESSION['error_msg'] = "Error Occurred. Please try again!!!";
				header("Location: course_highlight_view.php");
				exit();
			}
			$affected_rows = $connect->affected_rows;
			
			$_SESSION['success_msg'] = "{$affected_rows} Record(s) Deleted!";
			header("Location: course_highlight_view.php");
			exit();
		}
		else if($bulk_actions == "active" || $bulk_actions == "inactive")
		{
			$pageQueryResult = $db->custom("UPDATE rb_course_highlight SET status='$bulk_actions' where FIND_IN_SET(`coursehighlightid`, '$coursehighlightids')");
			if(!$pageQueryResult)
			{
				echo mysqli_error($connect);
				exit();
			}
			$affected_rows = $connect->affected_rows;
			
			$_SESSION['success_msg'] = "{$affected_rows} Record(s) Updated!";
			header("Location: course_highlight_view.php");
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
	
	header("Location: course_highlight_view.php?$fields_string");
	exit();
}
?>