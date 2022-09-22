<?php
include_once("inc_config.php");
include_once("login_user_check.php");

$_SESSION['active_menu'] = "testimonial";

$q = $validation->urlstring_validate($_GET['q']);
if($q == "del")
{
	echo $validation->delete_permission();
	
	$testimonialid = $validation->urlstring_validate($_GET['testimonialid']);
	
	$delresult = $media->filedeletion('rb_testimonial', 'testimonialid', $testimonialid, 'imgName', IMG_MAIN_LOC, IMG_THUMB_LOC);
	$delresult2 = $media->filedeletion('rb_testimonial', 'testimonialid', $testimonialid, 'fileName', FILE_LOC);

	$pageQueryResult = $db->delete("rb_testimonial", array('testimonialid'=>$testimonialid));
	if(!$pageQueryResult)
	{
		$_SESSION['error_msg'] = "Error Occurred. Please try again!!!";
		header("Location: testimonial_view.php");
		exit();
	}

	$_SESSION['success_msg'] = "{$pageQueryResult} Record Deleted!";
	header("Location: testimonial_view.php");
	exit();
}

if(isset($_POST['bulk_actions']) and $_POST['bulk_actions'] != "")
{
	$bulk_actions = $validation->urlstring_validate($_POST['bulk_actions']);
	$del_items = $_POST['del_items'];
	$testimonialids = array();
	if(empty($del_items))
	{
		$_SESSION['error_msg'] = "Please select atleast one row to perform action!";
		header("Location: testimonial_view.php");
		exit();
	}
	if(isset($del_items) and $del_items != "")
	{
		foreach($del_items as $id)
		{
			if($bulk_actions == "delete")
			{
				array_push($testimonialids, "$id");
				
				$delresult = $media->filedeletion('rb_testimonial', 'testimonialid', $id, 'imgName', IMG_MAIN_LOC, IMG_THUMB_LOC);
				$delresult2 = $media->filedeletion('rb_testimonial', 'testimonialid', $id, 'fileName', FILE_LOC);
			}
			else if($bulk_actions == "active" || $bulk_actions == "inactive")
			{
				array_push($testimonialids, "$id");
			}
		}
		
		$testimonialids = implode(',', $testimonialids);
		
		if($bulk_actions == "delete")
		{
			$pageQueryResult = $db->custom("DELETE from rb_testimonial where FIND_IN_SET(`testimonialid`, '$testimonialids')");
			if(!$pageQueryResult)
			{
				$_SESSION['error_msg'] = "Error Occurred. Please try again!!!";
				header("Location: testimonial_view.php");
				exit();
			}
			$affected_rows = $connect->affected_rows;
			
			$_SESSION['success_msg'] = "{$affected_rows} Record(s) Deleted!";
			header("Location: testimonial_view.php");
			exit();
		}
		else if($bulk_actions == "active" || $bulk_actions == "inactive")
		{
			$pageQueryResult = $db->custom("UPDATE rb_testimonial SET status='$bulk_actions' where FIND_IN_SET(`testimonialid`, '$testimonialids')");
			if(!$pageQueryResult)
			{
				echo mysqli_error($connect);
				exit();
			}
			$affected_rows = $connect->affected_rows;
			
			$_SESSION['success_msg'] = "{$affected_rows} Record(s) Updated!";
			header("Location: testimonial_view.php");
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
	
	header("Location: testimonial_view.php?$fields_string");
	exit();
}
?>