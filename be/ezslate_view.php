<?php
include_once("inc_config.php");
include_once("login_user_check.php");

$_SESSION['active_menu'] = "ezslate";

echo $validation->read_permission();

@$orderby = $validation->input_validate($_GET['orderby']);
@$order = $validation->input_validate($_GET['order']);

@$userid = $validation->input_validate($_GET['userid']);
@$name = strtolower($validation->input_validate($_GET['name']));
@$mail = strtolower($validation->input_validate($_GET['mail']));
@$fname = strtolower($validation->input_validate($_GET['fname']));
@$title_id = strtolower($validation->input_validate($_GET['title_id']));
@$status = strtolower($validation->input_validate($_GET['status']));
@$datefrom = $validation->input_validate($_GET['datefrom']);
@$dateto = $validation->input_validate($_GET['dateto']);

$where_query = "";
if($userid != "")
{
	$where_query .= " and userid = '$userid'";
}
if($fname != "")
{
	$where_query .= " and LOWER(fname) LIKE '%$fname%'";
}

if($name != "")
{
	$where_query .= " and LOWER(fname) LIKE '%$name%' or LOWER(lname) LIKE '%$name%'";
}
if($mail != "")
{
	$where_query .= " and LOWER(mail) LIKE '%$mail%'";
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
	$orderby_final = "ezdataid desc";
}

$param1 = "fname";
$param2 = "order_custom";
$param3 = "createdate";
include_once("inc_sorting.php");

$table = "rb_ezslate_form";
$id = "ezdataid";
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
		<h1 CLASS="page-header">Ezslate Data </h1>
		<!-- <?php if($_SESSION['per_write'] == "1") { ?><a href="brand_solution_form.php?mode=insert"  class="btn mb_inline btn-sm btn_submit ml-3 mt-1">Add New</a><?php } ?> -->
	</div>
</div>

<form name="form_actions" method="POST" action="ezslate_actions.php" ENCTYPE="MULTIPART/FORM-DATA">
<div class="row">
	<div class="col-sm-12 mb-0">
		<div class="form-inline">
			<!-- <select NAME="bulk_actions" CLASS="form-control mb_inline mb-2" >
				<option VALUE="">Bulk Actions</option>
				<option VALUE="delete">Delete</option>
				<option VALUE="active">Status to Active</option>
				<option VALUE="inactive">Status to Inactive</option>
			</select>
			<button type="submit" class="btn  mb_inline btn-sm btn_submit mb-2 mr-4">Apply</button> -->
			
			<input type="text" name="name" class="form-control mb_inline mb-2" placeholder="Name" value="<?php echo $name; ?>" />
			<input type="text" name="mail" class="form-control mb_inline mb-2" placeholder="Email" value="<?php echo $mail; ?>" />
			<!-- <input type="text" name="title_id" class="form-control mb_inline mb-2" placeholder="Title ID" value="<?php echo $title_id; ?>" />
			<select NAME="status" CLASS="form-control mb_inline mb-2">
				<option VALUE="" <?php if($status=='') echo "selected"; ?>>Status</option>
				<option VALUE="active" <?php if($status=="active") echo "selected"; ?>>Active</option>
				<option VALUE="inactive" <?php if($status=="inactive") echo "selected"; ?>>Inactive</option>
			</select> -->
			<p class="pt-2">From&nbsp;</p> <input type="date" name="datefrom" class="form-control mb_inline mb-2" placeholder="From" value="<?php echo $datefrom; ?>" />
			<p class="pt-2">To&nbsp;</p> <input type="date" name="dateto" class="form-control mb_inline mb-2" placeholder="To" value="<?php echo $dateto; ?>" />
			<input type="submit" value="Filter" class="btn  mb_inline btn-sm btn_submit ml-sm-2 ml-md-0 mb-2 mr-1" />
			<a href="ezslate_view.php" class="btn  mb_inline btn-sm btn_delete ml-sm-2 ml-md-0 mb-2">Clear</a>
		</div>
	</div>
</div>

<div class="table-responsive">
<table class="table table-striped table-view" cellspacing="0" width="100%">
	<thead>
	<tr>
		<th class="check-row text-center"><input type="checkbox" name="select_all" onClick="selectall(this);" /></th>
		<th class="<?php echo $th_sort1." ".$th_order_cls1; ?>"><a href="ezslate_view.php?orderby=fname&order=<?php echo $th_order1; echo $url_parameters; ?>"><span>Name</span> <span class="sorting-indicator"></span></a></th>
		<th>Username</th>
		<th>Email</th>
		<th>Mobile</th>
		<th>City</th>
		<th>State</th>
		<th>Zipcode</th>
		<th class="<?php echo $th_sort3." ".$th_order_cls3; ?>"><a href="ezslate_view.php?orderby=createdate&order=<?php echo $th_order3.''.$url_parameters; ?>"><span>Date</span> <span class="sorting-indicator"></span></a></th>
	</tr>
	</thead>
	<tbody>
	<?php
	if($data['num_rows'] >= 1)
	{
		foreach($data['result'] as $pageRow)
		{
			$userid = $pageRow['userid'];
			$userQueryResult = $db->view("display_name", "rb_users", "userid", "and userid='{$userid}'");
			$userRow = $userQueryResult['result'][0];
		?>
		<tr class="text-center has-row-actions">
			<td class="text-center" data-label=""><input type="checkbox" name="del_items[]" value="<?php echo $validation->db_field_validate($pageRow['brandid']); ?>"/></td>
			<td data-label="Name - ">
				<a href="#" class="fw-500"><?php echo $validation->db_field_validate($pageRow['fname'] . " " . $pageRow['lname']); ?></a>
				
				<!-- <div class="row row-actions">
					<div class="col-sm-12">
						<?php if($_SESSION['per_update'] == "1") { ?>
							<a href="brand_solution_form.php?mode=edit&brandid=<?php echo $validation->db_field_validate($pageRow['brandid']); ?>">Edit</a>
							 | 
						<?php } ?>
						<?php if($_SESSION['per_delete'] == "1") { ?>
							<a href="ezslate_actions.php?q=del&brandid=<?php echo $validation->db_field_validate($pageRow['brandid']); ?>" onClick="return del();" class="delete">Delete</a>
						<?php } ?> -->
							  
						<!--| <a href="dynamic_record_view.php?brandid=<?php echo $validation->db_field_validate($pageRow['brandid']); ?>">Product(s)</a> -->
					<!-- </div>
				</div> -->
			</td>
			<td data-label="Username - "><?php echo $validation->db_field_validate($pageRow['username']); ?></td>
			<td data-label="Email - "><?php echo $validation->db_field_validate($pageRow['mail']); ?></td>
			<td data-label="Mobile - "><?php echo $validation->db_field_validate($pageRow['mob']); ?></td>
			<td data-label="City - "><?php echo $validation->db_field_validate($pageRow['city']); ?></td>
			<td data-label="State - "><?php echo $validation->db_field_validate($pageRow['state']); ?></td>
			<td data-label="Zipcode - "><?php echo $validation->db_field_validate($pageRow['zipcode']); ?></td>
			<!-- <td data-label="Status - "><font color="<?php if($pageRow['status'] == "active") { echo "green"; } else { echo "red"; } ?>"><?php echo $validation->db_field_validate(ucfirst($pageRow['status'])); ?></font></td> -->
			<td class="date" data-label="Date - "><?php echo $validation->date_format_custom($pageRow['createdate']); ?> <br class="mb-hidden" />(<?php echo $validation->timecount("{$pageRow['createdate']} {$pageRow['createtime']}"); ?>)</td>
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