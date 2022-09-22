<?php
include_once("inc_config.php");

@$brandid = $_POST['brandid'];
@$categoryid = $_POST['categoryid'];
@$mode = $_POST['mode'];

if(isset($brandid) and $brandid != "")
{
	$categoryQueryResult = $db->view('categoryid,title', 'rb_categories', 'categoryid', "and brandid='$brandid' and status='active'", 'title asc');
	if($categoryQueryResult['num_rows'] >= 1)
	{
	?>
		<select NAME="categoryid" CLASS="form-control" ID="categoryid">
			<option VALUE="">--select--</option>
			<?php
			foreach($categoryQueryResult['result'] as $categoryRow)
			{
			?>
				<option VALUE="<?php echo $validation->db_field_validate($categoryRow['categoryid']); ?>" <?php if($mode == 'edit') { if($categoryRow['categoryid'] == $categoryid) echo "selected"; } ?>><?php echo $validation->db_field_validate($categoryRow['title']); ?></option>
			<?php
			}
			?>
		</select>
	<?php
	}
	else
	{
		echo '<p class="text">No Data Available!</p>';
	}
}
else
{
	echo '<p class="text">No Data Available!</p>';
}
?>