<?php include 'include/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Blog</title>		
<script src="js/jquery-3.2.1.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>﻿
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="../font-awesome-5.3.1/css/all.css">
<link rel="icon" href="../img/logo/logo.png" type="image/png">
</head>
<body>
<div class="wrapper">
	<?php include 'include/sidebar.php'; ?>
<!-- Page Content Holder -->
<div id="content">
	<?php include 'include/mainbar.php'; ?>
	<?php 
		
		if (isset($_GET['id'])) {
			require_once("include/connection.php");
			$id = $_GET['id'];
			$sql = "SELECT * FROM tbl_blogs 
				INNER JOIN tbl_users ON tbl_users.user_ID = tbl_blogs.user_FK 
				INNER JOIN tbl_profile ON tbl_profile.user_FK = tbl_blogs.user_FK
				WHERE blog_ID='$id'";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result)>0) {
				$id;
				if ($user_permissions == 1) {
					$contents = "";
				}elseif ($user_permissions == 2 || $user_permissions == 3 || $user_permissions == 4) {
					$contents = "<a href='createBlog.php?id=".$id."' class='sm-primary-btn'><i class='fa fa-pencil-alt'></i> Edit Blog</a>";
				}
				while ($row = mysqli_fetch_assoc($result)) {
					$id = $row['blog_ID'];
					$title = $row['blog_title'];
					$details = $row['blog_details'];
					$date = $row['blog_date'];
					$image = $row['blog_image'];
					if (empty($image)) {
						$image = 'images/default.jpg';
					}
					$mydate = date("d-M-Y", strtotime($date));
					$first_name = $row['profile_first_name'];
					$last_name = $row['profile_last_name'];
				}
			}else{
				header("Location: blogs.php");
			}
		}elseif (!isset($_GET['id'])) {
			header("Location: blogs.php");
		}	
	 ?>
    <div class="container-fluid">				
        <div class="content-box"> <!-- Page Contents -->
			<div class="row">
				<div class="col-md-12">
					<div class="form-wrapper">
						<div class="row">
							<div class="col-md-6 col-sm-8 col-xs-6">
								<h3 class="box-title">Blog</h3>	
							</div>
							<div class="col-md-6 col-sm-4 col-xs-6">
								<div class="main-action-box">
									<?php echo $contents; ?>
									<!-- <a href="createBlog.php?id=<?php echo $id; ?>" class="sm-primary-btn">Edit Blog</a> -->
								</div>
							</div>
						</div>
						<div class="hr"></div>
						<div class="pd-wrapper">
							<div class="row">
								<div class="col-md-4">
									<img src="<?php echo $image; ?>" class="img-responsive">
								</div>
								<div class="col-md-8">
									<h3 class="pd-title"><?php echo $title; ?></h3>
									<span class="pd-date"><?php echo $mydate; ?></span>
									<span class="pd-date"><?php echo  'Posted by: '.$first_name.' '.$last_name; ?></span>
									<p class="pd-description"><?php echo $details; ?></p>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div><!-- /Page Contents -->
	</div>
</div>
<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>