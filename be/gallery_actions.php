<?php
include_once("inc_config.php");
include_once("login_user_check.php");

$_SESSION['active_menu'] = "gallery";

$q = $validation->urlstring_validate($_GET['q']);
if($q == "del")
{
	echo $validation->delete_permission();
	
	$imageid = $validation->urlstring_validate($_GET['imageid']);
	
	$delresult = $media->filedeletion('rb_gallery', 'imageid', $imageid, 'imgName', IMG_MAIN_LOC, IMG_THUMB_LOC);
	$delresult2 = $media->filedeletion('rb_gallery', 'imageid', $imageid, 'fileName', FILE_LOC);

	$galleryQueryResult = $db->delete("rb_gallery", array('imageid'=>$imageid));
	if(!$galleryQueryResult)
	{
		$_SESSION['error_msg'] = "Error Occurred. Please try again!!!";
		header("Location: gallery_view.php");
		exit();
	}

	$_SESSION['success_msg'] = "{$galleryQueryResult} Record Deleted!";
	header("Location: gallery_view.php");
	exit();
}

if(isset($_POST['bulk_actions']) and $_POST['bulk_actions'] != "")
{
	$bulk_actions = $validation->urlstring_validate($_POST['bulk_actions']);
	$del_items = $_POST['del_items'];
	$imageids = array();
	if(empty($del_items))
	{
		$_SESSION['error_msg'] = "Please select atleast one row to perform action!";
		header("Location: gallery_view.php");
		exit();
	}
	if(isset($del_items) and $del_items != "")
	{
		foreach($del_items as $id)
		{
			if($bulk_actions == "delete")
			{
				array_push($imageids, "$id");
				
				$delresult = $media->filedeletion('rb_gallery', 'imageid', $id, 'imgName', IMG_MAIN_LOC, IMG_THUMB_LOC);
				$delresult2 = $media->filedeletion('rb_gallery', 'imageid', $id, 'fileName', FILE_LOC);
			}
			else if($bulk_actions == "active" || $bulk_actions == "inactive")
			{
				array_push($imageids, "$id");
			}
		}
		
		$imageids = implode(',', $imageids);
		
		if($bulk_actions == "delete")
		{
			$galleryQueryResult = $db->custom("DELETE from rb_gallery where FIND_IN_SET(`imageid`, '$imageids')");
			if(!$galleryQueryResult)
			{
				$_SESSION['error_msg'] = "Error Occurred. Please try again!!!";
				header("Location: gallery_view.php");
				exit();
			}
			$affected_rows = $connect->affected_rows;
			
			$_SESSION['success_msg'] = "{$affected_rows} Record(s) Deleted!";
			header("Location: gallery_view.php");
			exit();
		}
		else if($bulk_actions == "active" || $bulk_actions == "inactive")
		{
			$galleryQueryResult = $db->custom("UPDATE rb_gallery SET status='$bulk_actions' where FIND_IN_SET(`imageid`, '$imageids')");
			if(!$galleryQueryResult)
			{
				echo mysqli_error($connect);
				exit();
			}
			$affected_rows = $connect->affected_rows;
			
			$_SESSION['success_msg'] = "{$affected_rows} Record(s) Updated!";
			header("Location: gallery_view.php");
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
	
	header("Location: gallery_view.php?$fields_string");
	exit();
}
?>