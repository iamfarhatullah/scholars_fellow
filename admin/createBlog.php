<?php include 'include/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Create blog</title>		
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
	if ($user_permissions == 4) {
		$status = 0;
	}else{
		$status = 1;
	}
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		require_once("include/connection.php");
		$sql = "SELECT * FROM tbl_blogs WHERE blog_ID='$id'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result)>0) {
			$row = mysqli_fetch_assoc($result);
			$title = $row['blog_title'];
			$details = $row['blog_details'];
			$date = $row['blog_date'];
			$date = date("Y-m-d", strtotime($date));
			$image = $row['blog_image'];
			$actionBtn = 'updateBlog';
		}else{
			header("Location: blogs.php");
		}

	}else{
		$id=null;
		$title = '';
		$details = '';
		$date = date("Y-m-d");
		$image = '';
		$actionBtn = 'submitBlog';
	}
	?>
    <div class="container-fluid">				
        <div class="content-box"> <!-- Page Contents -->
			<div class="row">
				<div class="col-md-12">
					<div class="form-wrapper">
						<h3 class="form-title">Create blog</h3>
						<form action="submitBlog.php" method="post" enctype="multipart/form-data"><br>
							<div class="row">
								<div class="col-md-2 col-sm-3">
									<label class="pull-right">Title *</label>		
								</div>
								<div class="col-md-6 col-sm-9">
									<input type="text" name="title" value="<?php echo $title; ?>" class="form-field" placeholder="Title">		
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-2 col-sm-3">
									<label class="pull-right">Details *</label>		
								</div>
								<div class="col-md-6 col-sm-9">
									<textarea class="textarea-field" name="details" rows="5" placeholder="Write details"><?php echo $details; ?></textarea>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-2 col-sm-3">
									<label class="pull-right">Image</label>		
								</div>
								<div class="col-md-6 col-sm-9">
									<input type="hidden" name="storedImage" value="<?php echo $image; ?>">
									<input type="file" name="image" class="form-field" accept="image/*">		
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-2 col-sm-3">
									<label class="pull-right">Date *</label>		
								</div>
								<div class="col-md-6 col-sm-9">
									<input type="date" name="date" value="<?php echo $date; ?>" class="form-field" placeholder="Date">		
								</div>
							</div>
							<input type="hidden" name="userId" value="<?php echo $user_ID; ?>">
							<input type="hidden" name="status" value="<?php echo $status; ?>">
							<input type="hidden" name="blogId" value="<?php echo $id; ?>">
							<br>
							<hr>
							<div class="row">
								<div class="col-md-offset-2 col-md-6 col-sm-offset-3">
									<input type="reset" class="primary-btn" value="Reset">
									<input type="submit" name="<?php echo $actionBtn; ?>" class="success-btn" value="Submit"><br><br>
								</div>
							</div>
						</form>	
					</div>
				</div>
			</div>

		</div><!-- /Page Contents -->
	</div>
</div>
<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>