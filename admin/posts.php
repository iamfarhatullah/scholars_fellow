<?php include 'include/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Posts</title>		
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
	<<?php include 'include/mainbar.php'; ?>
    <div class="container-fluid">				
        <div class="content-box"> <!-- Page Contents -->
			<div class="row">
				<div class="col-md-12">
					<?php if (isset($_GET['updated'])) {
						echo "<div class='callout callout-primary'>";
						echo "<p>Post updated Successfully</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					}elseif (isset($_GET['notUpdated'])) {
						echo "<div class='callout callout-danger'>";
						echo "<p>Updated failed</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					}elseif (isset($_GET['error'])) {
						echo "<div class='callout callout-danger'>";
						echo "<p>Error occured</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					}elseif (isset($_GET['created'])) {
						echo "<div class='callout callout-success'>";
						echo "<p>Post created Successfully</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					}elseif (isset($_GET['deleted'])) {
						echo "<div class='callout callout-primary'>";
						echo "<p>Post deleted Successfully</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					} ?>
					<div class="form-wrapper">
						<div class="row">
							<div class="col-md-6 col-sm-8 col-xs-6">
								<h3 class="box-title">Posts</h3>	
							</div>
							<div class="col-md-6 col-sm-4 col-xs-6">
								<div class="main-action-box">
									<a href="createPost.php" class="sm-primary-btn">Create New</a>
								</div>
							</div>
						</div>
						<div class="hr"></div>
						<?php  
						require_once("include/connection.php");
						$results_per_page = 8; 
		                $query = "SELECT * FROM `tbl_posts`";
		                $result = mysqli_query($conn, $query);
		                $number_of_result = mysqli_num_rows($result); 
		                $number_of_page = ceil($number_of_result / $results_per_page);  
		                if (!isset($_GET['page'])) {
		                    $page = 1;  
		                } else {  
		                    $page = $_GET['page'];  
		                }  
		                $page_first_result = ($page-1) * $results_per_page; 
						$sql = "SELECT * FROM tbl_posts  ORDER by post_date desc";
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result)>0) {
							while ($row = mysqli_fetch_assoc($result)) {
								$id = $row['post_ID'];
								$title = $row['post_title'];
								$university = $row['post_university'];
								if ($user_permissions == 1) {
									$contents = "";
								}elseif ($user_permissions == 2) {
									$contents = "<a href='createPost.php?id=".$id."' class='sm-primary-btn'><i class='fa fa-pencil-alt'></i></a>";
								}elseif ($user_permissions == 3) {
									$contents = "<a href='createPost.php?id=".$id."' class='sm-primary-btn'><i class='fa fa-pencil-alt'></i></a>
									<a href='removePost.php?id=".$id."' class='sm-danger-btn'><i class='fa fa-trash'></i></a>";
								}
								echo '<a href="viewPost.php?id='.$id.'" class="post-link">
										<div class="post-wrapper">
											<div class="row">
												<div class="col-md-9 col-sm-8">
													<h4 class="post-title">'.$title.'</h4>
													<span class="post-date">'.$university.'</span>
												</div>
												<div class="col-md-3 col-sm-4">
													<div class="pull-right action-box">
														'.$contents.'
													</div>
												</div>
											</div>	
										</div>
									</a>';
							}
							echo '<div class="row">';
							echo '<div class="col-md-12">';
							echo '<ul class="pagination pagination-sm">';
							for($page = 1; $page<= $number_of_page; $page++) {  
                            	echo '<li><a href="posts.php?page='.$page.'">'.$page.'</a></li>';
                        	} 
							echo '</ul>';
							echo '</div>';
							echo '</div>';
						}else{
							echo "<br>";
							echo "<i>No posts</i>";
						}

						?>
					</div>
				</div>
			</div>
		</div><!-- /Page Contents -->
	</div>
</div>
<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>