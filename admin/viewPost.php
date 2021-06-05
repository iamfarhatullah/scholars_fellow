<?php include 'include/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Post</title>		
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
	require_once("include/connection.php");
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$sql = "SELECT * FROM tbl_posts
		INNER JOIN tbl_countries ON tbl_countries.id = tbl_posts.post_country
		WHERE post_ID='$id'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result)>0) {
			$row = mysqli_fetch_assoc($result);
			$title = $row['post_title'];
			$details = $row['post_details'];
			$date = $row['post_date'];
			$image = $row['post_image'];
			if (empty($image)) {
				$image = 'images/default.jpg';
			}
			$mydate = date("d-M-Y", strtotime($date));
			$country = $row['name'];
			$university = $row['post_university'];
			$type = $row['post_scholarship_type'];
			if ($user_permissions == 1) {
					$contents = "";
				}elseif ($user_permissions == 2 || $user_permissions == 3) {
					$contents = "<a href='createPost.php?id=".$id."' class='sm-primary-btn'><i class='fa fa-pencil-alt'></i> Edit Post</a>";
				}
		}else{
			header("Location: posts.php");
		}
	}elseif (!isset($_GET['id'])) {
		header("Location: posts.php");
	}				

	?>
    <div class="container-fluid">				
        <div class="content-box"> <!-- Page Contents -->
			<div class="row">
				<div class="col-md-12">
					<div class="form-wrapper">
						<div class="row">
							<div class="col-md-6 col-sm-8 col-xs-6">
								<h3 class="box-title">Post</h3>	
							</div>
							<div class="col-md-6 col-sm-4 col-xs-6">
								<div class="main-action-box">
									<!-- <a href="createPost.php?id=<?php echo $id; ?>" class="sm-primary-btn">Edit post</a> -->
									<?php echo $contents; ?>
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
									<p class="pd-description"><?php echo $details; ?></p>
									<p class="pd-text">Country: <?php echo $country; ?></p>
									<p class="pd-text"><?php echo $university; ?></p>
									<p class="pd-text">Scholarship type: <?php echo $type; ?></p>
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