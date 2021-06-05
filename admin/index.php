<?php include 'include/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Dashboard</title>		
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
    <div class="container-fluid">				
        <div class="content-box"> <!-- Page Contents -->
<?php
    require_once("include/connection.php");
    $sql= " SELECT count(post_ID) AS total FROM tbl_posts";
    $result = mysqli_query($conn, $sql);
    $values = mysqli_fetch_assoc($result);
    $totalPosts = $values['total'];
?>
<?php
    require_once("include/connection.php");
    $sql= " SELECT count(blog_ID) AS total FROM tbl_blogs";
    $result = mysqli_query($conn, $sql);
    $values = mysqli_fetch_assoc($result);
    $totalBlogs = $values['total'];
?>
<?php
    require_once("include/connection.php");
    $sql= " SELECT count(user_ID) AS total FROM tbl_users";
    $result = mysqli_query($conn, $sql);
    $values = mysqli_fetch_assoc($result);
    $totalUsers = $values['total'];
?>
<?php 
	if ($user_permissions == 4) {
		echo "Welcome!";
	}else{
?>		
        <div class="row">
	        	<div class="col-md-4 col-sm-6">
	        		<div class="widgets">
	               		<div class="row">
	               			<div class="col-md-4 col-xs-4">
	               				<center>
	               					<span style="padding-top: 20px;" class="widgets-span-danger far fa-clone fa-3x "></span>				
	               				</center>
	               			</div>
	               			<div class="col-md-8 col-xs-8">
	               				<h3 style="color: #73879c; padding-bottom: 5px;"> <span style="font-weight: 700; font-size: 42px;"><?php echo $totalPosts; ?></span> Posts</h3>			
	               			</div>
	               		</div>
	               	</div><br>
				</div>
				<div class="col-md-4 col-sm-6">
	        		<div class="widgets">
	               		<div class="row">
	               			<div class="col-md-4 col-xs-4">
	               				<center>
	               					<span style="padding-top: 20px;" class="widgets-span-danger fas fa-rss fa-3x "></span>				
	               				</center>
	               			</div> 
	               			<div class="col-md-8 col-xs-8">
	               				<h3 style="color: #73879c; padding-bottom: 5px;"> <span style="font-weight: 700; font-size: 42px;"><?php echo $totalBlogs; ?> </span>Blogs</h3>			
	               			</div>
	               		</div>
	               	</div><br>
				</div>
				<div class="col-md-4 col-sm-12">
	        		<div class="widgets">
	               		<div class="row">
	               			<div class="col-md-4 col-xs-4">
	               				<center>
	               					<span style="padding-top: 20px;" class="widgets-span-danger fas fa-user-friends fa-3x "></span>				
	               				</center>
	               			</div>
	               			<div class="col-md-8 col-xs-8">
	               				<h3 style="color: #73879c; padding-bottom: 5px;"> <span style="font-weight: 700; font-size: 42px;"><?php echo $totalUsers; ?></span> Users</h3>			
	               			</div>
	               		</div>
	               	</div><br>
				</div>
			</div>
			<br>
<?php
	}
 ?>
	
<?php 
if ($user_permissions == 3 || $user_permissions == 2) {
	?>

			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<?php if (isset($_GET['blogApproved'])) {
						echo "<div class='callout callout-success'>";
						echo "<p>Blog Approved!</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					}elseif (isset($_GET['Error'])) {
						echo "<div class='callout callout-danger'>";
						echo "<p>Failed</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					}
					?>
					<div class="form-wrapper">
						<h3 class="form-title">Blogs for approval</h3>
					<?php  
					require_once("include/connection.php");
					$sql = "SELECT * FROM tbl_blogs
					INNER JOIN tbl_profile ON tbl_profile.user_FK = tbl_blogs.user_FK
					WHERE blog_status='0'";
					$result = mysqli_query($conn, $sql);
					if (mysqli_num_rows($result)>0) {
						while ($row = mysqli_fetch_assoc($result)) {
							$blog_ID = $row['blog_ID'];
							$title = $row['blog_title'];
							$first = $row['profile_first_name'];
							$last = $row['profile_last_name'];
							echo '<a href="viewBlog.php?id='.$blog_ID.'" class="post-link">
								<div class="post-wrapper">
									<div class="row">
										<div class="col-md-9 col-sm-8 col-xs-8">
											<h4 class="post-title ellipse">'.$title.'<br> <span class="post-date pull-left">-- '.$first.' '.$last.'</span>
											</h4>
											
										</div>
										<div class="col-md-3 col-sm-4 col-xs-4">
											<div class="pull-right action-box">
												<a href="approveBlog.php?blog_ID='.$blog_ID.'" class="sm-success-btn"><i class="fa fa-check"></i> Approve</a>
						 						</div>
										</div>
									</div>	
								</div>
							</a>';
						}
					}else{
						echo "<i>No blogs</i>";
					}
					?>
					
						
						
						<br>
					</div>
				</div><br>
			</div>

	<?php
}

 ?>
			

		</div><!-- /Page Contents -->
	</div>
</div>
<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>