<?php
include_once("inc_config.php");
include_once("login_user_check.php");

$_SESSION['active_menu'] = "logoslider";

if(isset($_GET['mode']))
{
	$mode = $validation->urlstring_validate($_GET['mode']);
}
else
{
	$_SESSION['error_msg'] = "There is a problem. Please Try Again!";
	header("Location: logo_slider_view.php");
	exit();
}

if($mode == "edit")
{
	echo $validation->update_permission();
}
else
{
	echo $validation->write_permission();
}

if($mode == "edit")
{
	if(isset($_GET['logo_sliderid']))
	{
		$logo_sliderid = $validation->urlstring_validate($_GET['logo_sliderid']);
		if($_SESSION['search_filter'] != "")
		{
			$search_filter = "?".$_SESSION['search_filter'];
		}
	}
	else
	{
		$_SESSION['error_msg'] = "There is a problem. Please Try Again!";
		header("Location: logo_slider_view.php");
		exit();
	}
}

$title = $validation->input_validate($_POST['title']);
$title_id = $validation->input_validate($_POST['title_id']);
if($title_id == "")
{
	$title_id = $title;
}
$title_id = $validation->friendlyURL($title_id);
$tagline = $validation->input_validate($_POST['tagline']);
$order_custom = $validation->input_validate($_POST['order_custom']);
if($order_custom=='')
{
	$order_custom = 0;
}
$btnTitle = $validation->input_validate($_POST['btnTitle']);

if($btnTitle == ""){
	$btnTitle = 'Explore Us';
}

$url = $validation->input_validate($_POST['url']);
$url_target = $validation->input_validate($_POST['url_target']);
$description = mysqli_real_escape_string($connect, $_POST['description']);
if(isset($_POST['priority']))
{
	$priority = 1;
}
else
{
	$priority = 0;
}
$status = $validation->input_validate($_POST['status']);
$old_imgName = $validation->input_validate($_POST['old_imgName']);

$user_ip_array = ($_POST['user_ip']!='') ? explode(", ", $validation->input_validate($_POST['user_ip'])) : array();
array_push($user_ip_array, $user_ip);
$user_ip_array = array_unique($user_ip_array);
$user_ip = implode(", ", $user_ip_array);

// $dupresult = $db->check_duplicates('rb_logo_sliders', 'logo_sliderid', $logo_sliderid, 'title_id', strtolower($title_id), $mode);
// if($dupresult >= 1)
// {
	// $_SESSION['error_msg'] = "Title ID already exists!";
	// header("Location: logo_slider_view.php");
	// exit();
// }

$imgTName = $_FILES['imgName']['name'];
if($imgTName != "")
{
	$handle = new Upload($_FILES['imgName']);
    if($handle->uploaded)
	{
		$handle->file_force_extension = true;
		$handle->file_max_size = $validation->db_field_validate($configRow['image_maxsize']);
		$handle->allowed = array('image/*');
		if($configRow['large_width'] != "0" and $configRow['large_height'] != "0")
		{
			$handle->image_resize = true;
			$handle->image_x = $validation->db_field_validate($configRow['large_width']);
			$handle->image_y = $validation->db_field_validate($configRow['large_height']);
			$handle->image_no_enlarging = ($configRow['large_ratio'] === "false") ? false : true;
			$handle->image_ratio = ($configRow['large_ratio'] === "false") ? false : true;
		}
		
		$handle->process(IMG_MAIN_LOC);
		if($handle->processed)
		{
			$imgName = $handle->file_dst_name;
		}
		else
		{
			$_SESSION['error_msg'] = $handle->error.'!';
			header("Location: logo_slider_view.php");
			exit();
		}
		
		// Thumbnail Image
		$handle->file_force_extension = true;
		$handle->file_max_size = $validation->db_field_validate($configRow['image_maxsize']);
		$handle->allowed = array('image/*');
		if($configRow['thumb_width'] != "0" and $configRow['thumb_height'] != "0")
		{
			$handle->image_resize = true;
			$handle->image_x = $validation->db_field_validate($configRow['thumb_width']);
			$handle->image_y = $validation->db_field_validate($configRow['thumb_height']);
			$handle->image_no_enlarging = ($configRow['thumb_ratio'] === "false") ? false : true;
			$handle->image_ratio = ($configRow['thumb_ratio'] === "false") ? false : true;
		}
		
		$handle->process(IMG_THUMB_LOC);
		if($handle->processed)
		{
		}
		else
		{
			$_SESSION['error_msg'] = $handle->error.'!';
			header("Location: logo_slider_view.php");
			exit();
		}
		
		$handle-> clean();
	}
	else
	{
		$_SESSION['error_msg'] = $handle->error.'!';
		header("Location: logo_slider_view.php");
		exit();
    }
	
	if($mode == "edit")
	{
		$delresult = $media->filedeletion('rb_logo_sliders', 'logo_sliderid', $logo_sliderid, 'imgName', IMG_MAIN_LOC, IMG_THUMB_LOC);
	}
}

if($imgName == "")
{
	$imgName = $old_imgName;
}

	$fields = array('title'=>$title, 'title_id'=>$title_id,'btnTitle'=>$btnTitle, 'tagline'=>$tagline, 'order_custom'=>$order_custom, 'url'=>$url, 'url_target'=>$url_target, 'description'=>$description, 'imgName'=>$imgName, 'priority'=>$priority, 'status'=>$status, 'user_ip'=>$user_ip);

if($mode == "insert")
{
	$fields['userid'] = $userid;
	$fields['createtime'] = $createtime;
	$fields['createdate'] = $createdate;
	
	$logo_sliderQueryResult = $db->insert("rb_logo_sliders", $fields);
	if(!$logo_sliderQueryResult)
	{
		echo mysqli_error($connect);
		exit();
	}
	
	$_SESSION['success_msg'] = "Record Added!";
	header("Location: logo_slider_view.php");
	exit();
}
else if($mode == "edit")
{
	$fields['userid_updt'] = $userid;
	$fields['modifytime'] = $createtime;
	$fields['modifydate'] = $createdate;
	
	$logo_sliderQueryResult = $db->update("rb_logo_sliders", $fields, array('logo_sliderid'=>$logo_sliderid));
	if(!$logo_sliderQueryResult)
	{
		echo mysqli_error($connect);
		exit();
	}
	
	$_SESSION['success_msg'] = "Record Updated!";
	header("Location: logo_slider_view.php$search_filter");
	exit();
}
?>