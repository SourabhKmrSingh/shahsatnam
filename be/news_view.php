<?php
include_once("inc_config.php");
include_once("login_user_check.php");

$_SESSION['active_menu'] = "news";

echo $validation->read_permission();

@$orderby = $validation->input_validate($_GET['orderby']);
@$order = $validation->input_validate($_GET['order']);

@$userid = $validation->input_validate($_GET['userid']);
@$title = strtolower($validation->input_validate($_GET['title']));
@$brandid = $validation->input_validate($_GET['brandid']);
@$title_id = strtolower($validation->input_validate($_GET['title_id']));
@$status = strtolower($validation->input_validate($_GET['status']));
@$datefrom = $validation->input_validate($_GET['datefrom']);
@$dateto = $validation->input_validate($_GET['dateto']);

$where_query = "";
if($userid != "")
{
	$where_query .= " and userid = '$userid'";
}
if($title != "")
{
	$where_query .= " and LOWER(title) LIKE '%$title%'";
}
if($title_id != "")
{
	$where_query .= " and title_id = '$title_id'";
}
if($status != "")
{
	$where_query .= " and status = '$status'";
}
if($datefrom != "" and $dateto != "")
{
	$where_query .= " and createdate between '$datefrom' and '$dateto'";
}

if($orderby != "" and $order != "")
{
	$orderby_final = "{$orderby} {$order}";
	if($orderby == "createdate")
	{
		$orderby_final .= ", createtime {$order}";
	}
}
else
{
	$orderby_final = "newsid desc";
}

$param1 = "title";
$param2 = "order_custom";
$param3 = "createdate";
include_once("inc_sorting.php");

$table = "rb_news";
$id = "newsid";
$url_parameters = "&userid=$userid&title=$title&title_id=$title_id&status=$status&datefrom=$datefrom&dateto=$dateto";

$data = $pagination->main($table, $url_parameters, $where_query, $id, $orderby_final);

echo $validation->search_filter_enable();
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
		<h1 CLASS="page-header">News & Announcements <?php if($_SESSION['per_write'] == "1") { ?><a href="news_form.php?mode=insert"  class="btn mb_inline btn-sm btn_submit ml-3 mt-1">Add New</a><?php } ?></h1>
	</div>
</div>

<form name="form_actions" method="POST" action="news_actions.php" ENCTYPE="MULTIPART/FORM-DATA">
<div class="row">
	<div class="col-sm-12 mb-0">
		<div class="form-inline">
			<select NAME="bulk_actions" CLASS="form-control mb_inline mb-2" >
				<option VALUE="">Bulk Actions</option>
				<option VALUE="delete">Delete</option>
				<option VALUE="active">Status to Active</option>
				<option VALUE="inactive">Status to Inactive</option>
			</select>
			<button type="submit" class="btn  mb_inline btn-sm btn_submit mb-2 mr-4">Apply</button>
			
			<input type="text" name="title" class="form-control mb_inline mb-2" placeholder="Title" value="<?php echo $title; ?>" />
			<input type="text" name="title_id" class="form-control mb_inline mb-2" placeholder="Title ID" value="<?php echo $title_id; ?>" />
			<select NAME="status" CLASS="form-control mb_inline mb-2">
				<option VALUE="" <?php if($status=='') echo "selected"; ?>>Status</option>
				<option VALUE="active" <?php if($status=="active") echo "selected"; ?>>Active</option>
				<option VALUE="inactive" <?php if($status=="inactive") echo "selected"; ?>>Inactive</option>
			</select>
			<p class="pt-2">From&nbsp;</p> <input type="date" name="datefrom" class="form-control mb_inline mb-2" placeholder="From" value="<?php echo $datefrom; ?>" />
			<p class="pt-2">To&nbsp;</p> <input type="date" name="dateto" class="form-control mb_inline mb-2" placeholder="To" value="<?php echo $dateto; ?>" />
			<input type="submit" value="Filter" class="btn  mb_inline btn-sm btn_submit ml-sm-2 ml-md-0 mb-2 mr-1" />
			<a href="news_view.php" class="btn  mb_inline btn-sm btn_delete ml-sm-2 ml-md-0 mb-2">Clear</a>
		</div>
	</div>
</div>

<div class="table-responsive">
<table class="table table-striped table-view" cellspacing="0" width="100%">
	<thead>
	<tr>
		<th class="check-row text-center"><input type="checkbox" name="select_all" onClick="selectall(this);" /></th>
		<th class="<?php echo $th_sort1." ".$th_order_cls1; ?>"><a href="news_view.php?orderby=title&order=<?php echo $th_order1; echo $url_parameters; ?>"><span>Title</span> <span class="sorting-indicator"></span></a></th>
		<th>Author</th>
		<th>Brand / Solution</th>
		<th class="<?php echo $th_sort2." ".$th_order_cls2; ?>"><a href="news_view.php?orderby=order_custom&order=<?php echo $th_order2; echo $url_parameters; ?>"><span>Order</span> <span class="sorting-indicator"></span></a></th>
		<th>Title ID</th>
		<th>Status</th>
		<th class="<?php echo $th_sort3." ".$th_order_cls3; ?>"><a href="news_view.php?orderby=createdate&order=<?php echo $th_order3.''.$url_parameters; ?>"><span>Date</span> <span class="sorting-indicator"></span></a></th>
	</tr>
	</thead>
	<tbody>
	<?php
	if($data['num_rows'] >= 1)
	{
		foreach($data['result'] as $categoryRow)
		{
			$userid = $categoryRow['userid'];
			$userQueryResult = $db->view("display_name", "rb_users", "userid", "and userid='{$userid}'");
			$userRow = $userQueryResult['result'][0];

			$brandid = $categoryRow['brandid'];
			$brandQueryResult = $db->view("title", "rb_brand_solution", "brandid", "and brandid='{$brandid}'");
			$brandRow = $brandQueryResult['result'][0];
		?>
		<tr class="text-center has-row-actions">
			<td class="text-center" data-label=""><input type="checkbox" name="del_items[]" value="<?php echo $validation->db_field_validate($categoryRow['newsid']); ?>"/></td>
			<td data-label="Title - ">
				<a href="news_form.php?mode=edit&newsid=<?php echo $validation->db_field_validate($categoryRow['newsid']); ?>" class="fw-500"><?php echo $validation->db_field_validate($categoryRow['title']); ?></a>
				
				<div class="row row-actions">
					<div class="col-sm-12">
						<?php if($_SESSION['per_update'] == "1") { ?>
							<a href="news_form.php?mode=edit&newsid=<?php echo $validation->db_field_validate($categoryRow['newsid']); ?>">Edit</a>
							 | 
						<?php } ?>
						<?php if($_SESSION['per_delete'] == "1") { ?>
							<a href="news_actions.php?q=del&newsid=<?php echo $validation->db_field_validate($categoryRow['newsid']); ?>" onClick="return del();" class="delete">Delete</a>
							 | 
						<?php } ?>
						
						<a href="product_view.php?newsid=<?php echo $validation->db_field_validate($categoryRow['newsid']); ?>">Product(s)</a>
					</div>
				</div>
			</td>
			<td data-label="Author - "><a href="news_view.php?userid=<?php echo $userid; ?>"><?php echo $validation->db_field_validate($userRow['display_name']); ?></a></td>
			<td data-label="Brand / Solution - "><a href="news_view.php?mode=edit&brandid=<?php echo $validation->db_field_validate($categoryRow['brandid']); ?>" class="fw-500"><?php echo $validation->db_field_validate($brandRow['title']); ?></a></td>
			<td data-label="Order - "><?php echo $validation->db_field_validate($categoryRow['order_custom']); ?></td>
			<td data-label="Title ID - "><?php echo $validation->db_field_validate($categoryRow['title_id']); ?></td>
			<td data-label="Status - "><font color="<?php if($categoryRow['status'] == "active") { echo "green"; } else { echo "red"; } ?>"><?php echo $validation->db_field_validate(ucfirst($categoryRow['status'])); ?></font></td>
			<td class="date" data-label="Date - "><?php echo $validation->date_format_custom($categoryRow['createdate']); ?> <br class="mb-hidden" />(<?php echo $validation->timecount("{$categoryRow['createdate']} {$categoryRow['createtime']}"); ?>)</td>
		</tr>
		<?php
		}
	}
	else
	{
	?>
		<tr class="text-center">
			<td class="text-center" colspan="7">No Record is Available!</td>
		</tr>
	<?php
	}
	?>
	</tbody>
</table>
</div>
</form>

<hr />
<?php echo $data['content']; ?>
<hr />
</div>
</div>
</div>
</body>
</html>