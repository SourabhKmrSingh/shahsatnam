<?php
include_once("inc_config.php");
include_once("login_user_check.php");

$_SESSION['active_menu'] = "media";

if(isset($_GET['mode']))
{
	$mode = $validation->urlstring_validate($_GET['mode']);
}
else
{
	$_SESSION['error_msg'] = "There is a problem. Please Try Again!";
	header("Location: media_view.php");
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
	$mediaid = $validation->urlstring_validate($_GET['mediaid']);
	$mediaQueryResult = $db->view('*', 'rb_media', 'mediaid', "and mediaid = '$mediaid'");
	$mediaRow = $mediaQueryResult['result'][0];
	
	$userid = $mediaRow['userid'];
	$userQueryResult = $db->view("display_name", "rb_users", "userid", "and userid='{$userid}'");
	$userRow = $userQueryResult['result'][0];
	
	$userid_updt = $mediaRow['userid_updt'];
	$userupdtQueryResult = $db->view("display_name", "rb_users", "userid", "and userid='{$userid_updt}'");
	$userupdtRow = $userupdtQueryResult['result'][0];
}
else
{
	$max_order = $db->get_maxorder('rb_media') + 1;
}

if(isset($_GET['q']))
{
	$q = $validation->urlstring_validate($_GET['q']);
	if($q == "imgdel")
	{
		$delresult = $media->filedeletion('rb_media', 'mediaid', $mediaid, 'imgName', IMG_MAIN_LOC, IMG_THUMB_LOC);
		if($delresult)
		{
			$_SESSION['success_msg'] = "Image has been deleted Successfully!!!";
			header("Location: media_form.php?mode=edit&mediaid=$mediaid");
			exit();
		}
		else
		{
			$_SESSION['error_msg'] = "Error Occurred. Please try again!!!";
			header("Location: media_form.php?mode=edit&mediaid=$mediaid");
			exit();
		}
	}
	
	if($q == "filedel")
	{
		$delresult = $media->filedeletion('rb_media', 'mediaid', $mediaid, 'fileName', FILE_LOC);
		if($delresult)
		{
			$_SESSION['success_msg'] = "File has been deleted Successfully!!!";
			header("Location: media_form.php?mode=edit&mediaid=$mediaid");
			exit();
		}
		else
		{
			$_SESSION['error_msg'] = "Error Occurred. Please try again!!!";
			header("Location: media_form.php?mode=edit&mediaid=$mediaid");
			exit();
		}
	}
}


if($mode == "edit"){
	$class = explode(",",$mediaRow['class']);
	$subject = explode(",",$mediaRow['subject']);
	$medium = explode(",",$mediaRow['medium']);
}
?>
<!DOCTYPE html>
<html LANG="en">
<head>
<?php include_once("inc_title.php"); ?>
<?php include_once("inc_files.php"); ?>
</head>
<body>
<div ID="wrapper">
<?php include_once("inc_header.php"); ?>
<div ID="page-wrapper">
<div CLASS="container-fluid">
<div CLASS="row">
	<div CLASS="col-lg-12">
		<h1 CLASS="page-header"><?php if($mode == "insert") echo "Add New"; else echo "Update"; ?> Media</h1>
	</div>
</div>

<form name="dataform" method="post" class="form-group" action="<?php 
												switch($mode)
												{
													case "insert" : echo "media_form_inter.php?mode=$mode";
													break;
													
													case "edit" : echo "media_form_inter.php?mode=$mode&mediaid=$mediaid";
													break;
													
													default : echo "media_form_inter.php";
												}
												?>" enctype="multipart/form-data">

<div class="form-rows-custom mt-3">
	
	 <div class="row mb-3">
		<div class="col-sm-3">
			<label for="class">Class *</label>
		</div>
		<div class="col-sm-9">
		<select NAME="class[]" CLASS="form-control chosen" ID="class" multiple required>
			<option value="" disabled >--- Class ---</option>
			<option value="12" <?php if($mode == "edit"){ if(in_array("12", $class)){ echo "selected"; } }?>>12th</option>
			<option value="11" <?php if($mode == "edit"){ if(in_array("11", $class)){ echo "selected"; } }?>>11th</option>
			<option value="10" <?php if($mode == "edit"){ if(in_array("10", $class)){ echo "selected"; } }?>>10th</option>
			<option value="9" <?php if($mode == "edit"){ if(in_array("9", $class)){ echo "selected"; } }?>>9th</option>
			<option value="8" <?php if($mode == "edit"){ if(in_array("8", $class)){ echo "selected"; } }?>>8th</option>
			<option value="7" <?php if($mode == "edit"){ if(in_array("7", $class)){ echo "selected"; } }?>>7th</option>
			<option value="6" <?php if($mode == "edit"){ if(in_array("6", $class)){ echo "selected"; } }?>>6th</option>
			<option value="5" <?php if($mode == "edit"){ if(in_array("5", $class)){ echo "selected"; } }?>>5th</option>
			<option value="4" <?php if($mode == "edit"){ if(in_array("4", $class)){ echo "selected"; } }?>>4th</option>
			<option value="3" <?php if($mode == "edit"){ if(in_array("3", $class)){ echo "selected"; } }?>>3rd</option>
			<option value="2" <?php if($mode == "edit"){ if(in_array("2", $class)){ echo "selected"; } }?>>2nd</option>
			<option value="1" <?php if($mode == "edit"){ if(in_array("1", $class)){ echo "selected"; } }?>>1st</option>
		</select>
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-sm-3">
			<label for="subject">Subject</label>
		</div>
		<div class="col-sm-9">
		<select NAME="subject[]" CLASS="form-control chosen" ID="subject" multiple required>
			<option value="" disabled>-- Subject --</option>
			<option value="Biology" <?php if($mode == "edit"){ if(in_array("Biology", $subject)){ echo "selected"; } }?>>Biology</option>
			<option value="Math" <?php if($mode == "edit"){ if(in_array("Math", $subject)){ echo "selected"; } }?>>Math</option>
			<option value="English" <?php if($mode == "edit"){ if(in_array("English", $subject)){ echo "selected"; } }?>>English</option>
			<option value="Hindi" <?php if($mode == "edit"){ if(in_array("Hindi", $subject)){ echo "selected"; } }?>>Hindi</option>
			<option value="Physics" <?php if($mode == "edit"){ if(in_array("Physics", $subject)){ echo "selected"; } }?>>Physics</option>
			<option value="Art" <?php if($mode == "edit"){ if(in_array("Art", $subject)){ echo "selected"; } }?>>Art</option>
			<option value="Computer Science" <?php if($mode == "edit"){ if(in_array("Computer Science", $subject)){ echo "selected"; } }?>>Computer Science</option>
		</select>
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-sm-3">
			<label for="medium">Medium </label>
		</div>
		<div class="col-sm-9">
		<select NAME="medium[]" CLASS="form-control chosen" ID="medium" multiple required>
			<option value="" disabled >-- Medium --</option>
			<option value="Hindi" <?php if($mode == 'edit'){ if(in_array("Hindi", $medium)){ echo "selected"; } }?>>Hindi</option>
			<option value="English" <?php if($mode == 'edit'){ if(in_array("English", $medium)){ echo "selected"; } }?>>English</option>
		</select>
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-sm-3">
			<label for="title"><strong>Title *</strong></label>
		</div>
		<div class="col-sm-9">
			<input type="text" name="title" id="title" class="form-control" value="<?php if($mode == 'edit') echo $validation->db_field_validate($mediaRow['title']); ?>" required />
		</div>
	</div>
	
	<div class="row mb-3">
		<div class="col-sm-3">
			<label for="title_id">Title ID <em>(Optional)</em></label>
		</div>
		<div class="col-sm-9">
			<input type="text" name="title_id" id="title_id" class="form-control" value="<?php if($mode == 'edit') echo $validation->db_field_validate($mediaRow['title_id']); ?>" />
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-sm-3">
			<label for="youtube_url">Youtube Url *</label>
		</div>
		<div class="col-sm-9">
			<input type="text" required name="youtube_url" onChange= "get_youtubeId(this.value)" id="youtube_url" class="form-control" value="<?php if($mode == 'edit') echo $validation->db_field_validate($mediaRow['youtube_url']); ?>" />

			<input type="hidden" name="youtube_video_id" id='youtube_video_id' value="<?php if($mode == 'edit') echo $validation->db_field_validate($mediaRow['youtube_video_id']); ?>">
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-sm-3">
			<label for="order_custom">Order</label>
		</div>
		<div class="col-sm-9">
			<input type="number" name="order_custom" id="order_custom" class="form-control" value="<?php if($mode == 'edit') echo $validation->db_field_validate($mediaRow['order_custom']); else echo $max_order; ?>" />
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-sm-3">
			<label for="btn_url">Get Admission Buttom Url</label>
		</div>
		<div class="col-sm-9">
			<input type="text" name="btn_url" id="youtube_url" class="form-control" value="<?php if($mode == 'edit') echo $validation->db_field_validate($mediaRow['btn_url']); ?>" />
		</div>
	</div>
	
	<div class="row mb-3">
		<div class="col-sm-3">
			<label for="imgName">Upload Image</label>
		</div>
		<div class="col-sm-9">
			<input type="file" name="imgName" id="imgName">
			<input type="hidden" name="old_imgName" id="old_imgName" value="<?php if($mode == 'edit') echo $validation->db_field_validate($mediaRow['imgName']); ?>" />
			<?php if($mode == 'edit' and $mediaRow['imgName'] != "") { ?>
				<div class="mt-2 links">
					<img src="<?php echo IMG_THUMB_LOC; echo $validation->db_field_validate($mediaRow['imgName']); ?>" title="<?php echo $validation->db_field_validate($mediaRow['imgName']); ?>" class="img-responsive mh-51" /><br>
					<a href="<?php echo IMG_MAIN_LOC; echo $validation->db_field_validate($mediaRow['imgName']); ?>" target="_blank">Click to Download</a> | <a href="media_form.php?mode=edit&mediaid=<?php echo $mediaid; ?>&q=imgdel" onClick="return del();">Delete</a>
				</div>
			<?php } ?>
			<em class="d-block mt-1">File should be Image and size under <?php echo $validation->convertToReadableSize($configRow['image_maxsize']); ?><br>Image extension should be .jpg, .jpeg, .png, .gif</em>
		</div>
	</div>
	
	<div class="row mb-3">
		<div class="col-sm-3">
			<label for="fileName">Upload File</label>
		</div>
		<div class="col-sm-9">
			<input type="file" name="fileName" id="fileName">
			<input type="hidden" name="old_fileName" id="old_fileName" value="<?php if($mode == 'edit') echo $validation->db_field_validate($mediaRow['fileName']); ?>" />
			<?php if($mode == 'edit' and $mediaRow['fileName'] != "") { ?>
				<div class="mt-2 links">
					<a href="<?php echo FILE_LOC; echo $validation->db_field_validate($mediaRow['fileName']); ?>" target="_blank">Click to Download</a> | <a href="media_form.php?mode=edit&mediaid=<?php echo $mediaid; ?>&q=filedel" onClick="return del();">Delete</a>
				</div>
			<?php } ?>
			<em class="d-block mt-1">File size under <?php echo $validation->convertToReadableSize($configRow['file_maxsize']); ?><br>File extension should be .pdf, .docx, .doc, .xlsx, .csv, .zip</em>
		</div>
	</div>
	
	<div class="row mb-3">
		<div class="col-sm-3">
			<label for="priority">Priority ?</label>
		</div>
		<div class="col-sm-9">
			<input type="checkbox" name="priority" id="priority" <?php if($mode == 'edit') { if($mediaRow['priority'] == "1") echo "checked"; } ?> />
		</div>
	</div>
	
	<div class="row mb-3">
		<div class="col-sm-3">
			<label for="status">Status *</label>
		</div>
		<div class="col-sm-9">
			<select name="status" id="status" class="form-control" required >
				<option value="active" <?php if($mode == 'edit') { if($validation->db_field_validate($mediaRow['status']) == "active") echo "selected"; } ?>>Active</option>
				<option value="inactive" <?php if($mode == 'edit') { if($validation->db_field_validate($mediaRow['status']) == "inactive") echo "selected"; } ?>>Inactive</option>
			</select>
		</div>
	</div>
	
	<?php if($mode == 'edit') { ?>
	<div class="row mb-3">
		<div class="col-sm-3">
			<label>Author</label>
		</div>
		<div class="col-sm-9">
			<p class="text"><a href="media_view.php?userid=<?php echo $userid; ?>"><?php echo $validation->db_field_validate($userRow['display_name']); ?></a></p>
		</div>
	</div>
	
	<div class="row mb-3">
		<div class="col-sm-3">
			<label>Author (Modified By)</label>
		</div>
		<div class="col-sm-9">
			<p class="text"><a href="media_view.php?userid=<?php echo $userid_updt; ?>"><?php echo $validation->db_field_validate($userupdtRow['display_name']); ?></a></p>
		</div>
	</div>
	
	<div class="row mb-3">
		<div class="col-sm-3">
			<label>User's IP Address</label>
		</div>
		<div class="col-sm-9">
			<p class="text"><?php echo $validation->db_field_validate($mediaRow['user_ip']); ?></p>
			<input type="hidden" name="user_ip" value="<?php if($mode == 'edit') echo $validation->db_field_validate($mediaRow['user_ip']); ?>" />
		</div>
	</div>
	
	<div class="row mb-3">
		<div class="col-sm-3">
			<label>Modification Date & Time</label>
		</div>
		<div class="col-sm-9">
			<?php if($mediaRow['modifydate'] != "") { ?>
				<p class="text"><?php echo $validation->date_format_custom($mediaRow['modifydate'])." at ".$validation->time_format_custom($mediaRow['modifytime']); ?></p>
			<?php } ?>
		</div>
	</div>
	
	<div class="row mb-3">
		<div class="col-sm-3">
			<label>Creation Date & Time</label>
		</div>
		<div class="col-sm-9">
			<?php if($mediaRow['createdate'] != "") { ?>
				<p class="text"><?php echo $validation->date_format_custom($mediaRow['createdate'])." at ".$validation->time_format_custom($mediaRow['createtime']); ?></p>
			<?php } ?>
		</div>
	</div>
	<?php } ?>
	
	<div class="row mt-4 mb-4">
		<div class="col-sm-12">
			<?php
			if($mode == "insert")
			{
			?>
				<button type="submit" class="btn  btn-sm mr-2 btn_submit"><i class="fa fa-arrow-circle-right"></i>&nbsp;&nbsp;Add</button>
				<button type="reset" class="btn  btn-sm btn_delete"><i class="fas fa-sync-alt"></i>&nbsp;&nbsp;Reset</button>
			<?php
			}
			elseif($mode == "edit")
			{
			?>
				<button type="submit" name="submit" class="btn  btn-sm mr-2 btn_submit"><i class="fas fa-save"></i>&nbsp;&nbsp;Update</button>
				<?php if($_SESSION['per_delete'] == "1") { ?>
					<a HREF="media_actions.php?q=del&mediaid=<?php echo $mediaRow['mediaid']; ?>" class="btn  btn-sm btn_delete" onClick="return del();"><i class="fas fa-trash"></i>&nbsp;&nbsp;Delete</a>
				<?php } ?>
			<?php
			}
			?>
		</div>
	</div>
</div>
</form>
</div>
</div>
</div>
<script>
	 function get_youtubeId(url) {
        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        var match = url.match(regExp);
        if (match && match[2].length == 11) {
            $("#youtube_video_id").val(match[2]);
        } 
    }
</script>
</body>
</html>