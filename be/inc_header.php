<nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar nav-top-bar" role="navigation">
	<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-ex1-collapse" aria-controls="navbar-ex1-collapse" aria-expanded="false" aria-label="Toggle navigation">
		<span CLASS="icon-bar"></span>
		<span CLASS="icon-bar"></span>
		<span CLASS="icon-bar"></span>
	</button>
	<!-- <a CLASS="navbar-brand" HREF="home.php"><img src="images/logo-inner.png" height="35" /></a> -->
	
	<ul CLASS="nav top-nav ml-auto">
		<a CLASS="navbar-brand" HREF="<?php echo BASE_URL; ?>" target="_blank"  title="Visit Website"><i CLASS="fa fa-home top_home"></i> <?php if($configRow['logo'] != "") { ?>&nbsp;<img style='background-color: #fff;' src="<?php echo IMG_MAIN_LOC.''.$validation->db_field_validate($configRow['logo']); ?>" height="33" alt="Visit Website" title="<?php echo $validation->db_field_validate($configRow['meta_title']); ?>" class="top_logoimg" /><?php } ?></a>
		<li CLASS="nav-item dropdown">
			<a HREF="#" CLASS="nav-link dropdown-toggle" id="topbar_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php if($_SESSION['be_imgName'] != "") { ?><img src="<?php echo FILE_LOC.''.$_SESSION['be_imgName']; ?>"  class="rounded-circle" height="15" /><?php } else { ?><i CLASS="fa fa-user"></i><?php } ?> &nbsp;<?php echo $_SESSION['be_display_name']; ?> <b CLASS="caret"></b></a>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="topbar_dropdown" style="max-width: 210px;left: 0px;">
				<?php if($_SESSION['be_type'] == "admin") { ?>
					<a class="dropdown-item" HREF="user_master_view.php"><i CLASS="fa fa-fw fa-user"></i> User Master</a>
					<a class="dropdown-item" HREF="config.php"><i class="fas fa-user-cog"></i> Configurations</a>
				<?php } ?>
				<a class="dropdown-item" HREF="user_password.php"><i CLASS="fa fa-fw fa-key"></i> Password</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" HREF="logout.php"><i CLASS="fa fa-fw fa-power-off"></i> Log Out</a>
			</div>
		</li>
	</ul>
	
	<div CLASS="collapse navbar-collapse navbar-ex1-collapse ml-auto">
		<ul CLASS="nav navbar-nav side-nav mr-auto" ID="SideNav">
			<?php if($_SESSION['per_read'] == "1") { ?>
				<li class="nav-item"><a HREF="home.php" class="nav-link <?php if(@$_SESSION['active_menu'] == "dashboard") echo "active"; ?>"><i CLASS="fas fa-fw fa-tachometer-alt"></i>&nbsp; Dashboard</a></li>
				<!-- <li class="nav-item"><a HREF="page_view.php" class="nav-link <?php if(@$_SESSION['active_menu'] == "pages") echo "active"; ?>"><i CLASS="fa fa-clone"></i>&nbsp;&nbsp; Menu/Pages</a></li> -->
				<li class="nav-item"><a HREF="slider_view.php" class="nav-link <?php if(@$_SESSION['active_menu'] == "slider") echo "active"; ?>"><i CLASS="fa fa-image"></i>&nbsp;&nbsp; Sliders</a></li>
				<!-- <li class="nav-item"><a HREF="logo_slider_view.php" class="nav-link <?php if(@$_SESSION['active_menu'] == "logoslider") echo "active"; ?>"><i CLASS="fa fa-image"></i>&nbsp;&nbsp; Logo Sliders</a></li>
				<li class="nav-item"><a HREF="stats_view.php" class="nav-link <?php if(@$_SESSION['active_menu'] == "stats") echo "active"; ?>"><i class="fas fa-signal"></i>&nbsp;&nbsp; Stats Section</a></li> -->
				<!-- <li class="nav-item"><a HREF="brand_solution_view.php" class="nav-link <?php if(@$_SESSION['active_menu'] == "brand_solution") echo "active"; ?>"><i class="fas fa-file-alt"></i>&nbsp;&nbsp; Brand / Solution</a></li> -->
				<li class="nav-item"><a HREF="news_view.php" class="nav-link <?php if(@$_SESSION['active_menu'] == "category") echo "active"; ?>"><i CLASS="fa fa-edit"></i>&nbsp; Announcements</a></li>
				<!-- <li class="nav-item"><a HREF="category_view.php" class="nav-link <?php if(@$_SESSION['active_menu'] == "category") echo "active"; ?>"><i CLASS="fa fa-edit"></i>&nbsp; Categories</a></li> -->
				<!-- <li class="nav-item"><a HREF="subcategory_view.php" class="nav-link <?php if(@$_SESSION['active_menu'] == "subcategory") echo "active"; ?>"><i CLASS="fa fa-edit"></i>&nbsp; Sub-Categories</a></li>
				<li class="nav-item"><a HREF="product_view.php" class="nav-link <?php if(@$_SESSION['active_menu'] == "product") echo "active"; ?>"><i class="fa fa-book"></i>&nbsp; Courses</a></li>
				<li class="nav-item"><a HREF="course_highlight_view.php" class="nav-link <?php if(@$_SESSION['active_menu'] == "course_highlight") echo "active"; ?>"><i class="fa fa-book"></i>&nbsp; Course  Highlights</a></li> -->
				<!-- <li class="nav-item"><a HREF="product_review_view.php" class="nav-link <?php if(@$_SESSION['active_menu'] == "product_reviews") echo "active"; ?>"><i class="fas fa-comments"></i>&nbsp; Product Reviews</a></li>  -->
				<!-- <li class="nav-item"><a HREF="gallery_view.php" class="nav-link <?php if(@$_SESSION['active_menu'] == "gallery") echo "active"; ?>"><i class="fas fa-images"></i>&nbsp;&nbsp; Gallery</a></li> -->
				<!-- <li class="nav-item"><a HREF="dynamic_page_view.php" class="nav-link <?php if(@$_SESSION['active_menu'] == "dynamic_pages") echo "active"; ?>"><i CLASS="fa fa-clone"></i>&nbsp; Dynamic Section</a></li>
				<li class="nav-item"><a HREF="dynamic_record_view.php" class="nav-link <?php if(@$_SESSION['active_menu'] == "dynamic_records") echo "active"; ?>"><i CLASS="fa fa-list"></i>&nbsp; Dynamic Records</a></li>
				<li class="nav-item"><a HREF="testimonial_view.php" class="nav-link <?php if(@$_SESSION['active_menu'] == "testimonial") echo "active"; ?>"><i CLASS="fa fa-list"></i>&nbsp; Testimonails</a></li>
				<li class="nav-item"><a HREF="badlink_view.php" class="nav-link <?php if(@$_SESSION['active_menu'] == "badlink") echo "active"; ?>"><i CLASS="fa fa-link"></i>&nbsp; Bad Links</a></li>
				<li class="nav-item"><a HREF="media_view.php" class="nav-link <?php if(@$_SESSION['active_menu'] == "media") echo "active"; ?>"><i CLASS="fa fa-upload"></i>&nbsp; Media</a></li>
				<li class="nav-item"><a HREF="enquiry_view.php" class="nav-link <?php if(@$_SESSION['active_menu'] == "enquiry") echo "active"; ?>"><i CLASS="fa fa-envelope"></i>&nbsp; Enquiries</a></li> -->
			<?php } ?>
		</ul>
	</div>
</nav>